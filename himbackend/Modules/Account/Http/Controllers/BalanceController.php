<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Account\Entities\Tree; 
use Modules\Account\Entities\Payment;
use Modules\Account\Entities\Solfa;
use Modules\Account\Entities\Store;
use Modules\Account\Entities\Bank;
use DB;
use Carbon\Carbon;

class BalanceController extends Controller
{

    public function __construct() {
        // permission
    } 

    /**
     * return all data in json format
     * @return json
     */
    public function index() {
         $query = Payment::with(['student'])
                //->whereIn('model_type', ['academic_year_expense', 'old_academic_year_expense'])
                ->where('store_id', request()->store_id);
                 
        $data = [];
        $store = Store::find(request()->store_id);
        
        if (!request()->date_from || !request()->date_to || !$store)
            return [];
        
        $date1 = Carbon::createFromFormat("Y-m-d", request()->date_from);
        $date2 = Carbon::createFromFormat("Y-m-d", request()->date_to);
        $days = $date1->diffInDays($date2);
        $balance = $store->init_balance;
        $all = [];
        
        $date_from = \Carbon\Carbon::parse(request()->date_from)->format('Y-m-d');
        $date_to = \Carbon\Carbon::parse(request()->date_to)->format('Y-m-d');
        
        // $incomes = DB::table('account_payments')
        //             ->select('value as incomes','date as date')
        //             ->where('store_id', request()->store_id)
        //             ->whereBetween('date', [$date_from, $date_to])->get();
        // $expenses = DB::table('account_dailies')
        //             ->select('value as expenses','date as date')
        //             ->where('store_id', request()->store_id)
        //             ->whereBetween('date', [$date_from, $date_to])->get();
        // $deposites = DB::table('account_transformations')
        //             ->select('value as deposites','date as date')
        //             ->where('type', 'store_to_bank')
        //             ->where('store_id', request()->store_id)
        //             ->whereBetween('date', [$date_from, $date_to])->get();
        // $custodies = DB::table('account_custodies')
        //             ->select('value as custodies','date as date')
        //             ->where('store_id', request()->store_id)
        //             ->whereBetween('date', [$date_from, $date_to])->get();
        // $solfa = Solfa::query()
        //             ->where('store_id', request()->store_id)
        //             ->select('value as solfa','date as date')
        //             ->whereBetween('date', [$date_from, $date_to])
        //             ->get()
        //             ->pluck('remained')->toArray();
                    
        $incomes = DB::table('account_payments')
                    ->select(DB::raw('sum(value) as incomes'),'date as date')
                    ->where('store_id', request()->store_id)
                    ->whereBetween('date', [$date_from, $date_to])->groupBy('date')->get();
        $expenses = DB::table('account_dailies')
                    ->select(DB::raw('sum(value) as expenses'),'date as date')
                    ->where('store_id', request()->store_id)
                    ->whereBetween('date', [$date_from, $date_to])->groupBy('date')->get();
        $deposites = DB::table('account_transformations')
                    ->select(DB::raw('sum(value) as deposites'),'date as date')
                    ->where('type', 'store_to_bank')
                    ->where('store_id', request()->store_id)
                    ->whereBetween('date', [$date_from, $date_to])->groupBy('date')->get();
        $custodies = DB::table('account_custodies')
                    ->select(DB::raw('sum(value) as custodies'),'date as date')
                    ->where('store_id', request()->store_id)
                    ->whereBetween('date', [$date_from, $date_to])->groupBy('date')->get();
        $solfa = Solfa::query()
                    ->where('store_id', request()->store_id)
                    ->select(DB::raw('sum(value) as solfa'),'date as date')
                    ->whereBetween('date', [$date_from, $date_to])
                    ->groupBy('date')->get()
                    ->pluck('remained')->toArray();
                    

        $collection = collect([$incomes,$expenses,$deposites,$custodies,$solfa])->collapse();
    
        $sorted = $collection->sortBy('date');
    
        $array = $sorted->values()->all();
        
        // dd($array);
        

        
        foreach($array as $row)
        {
            if($row->incomes ?? ''){
                
                 $balance += $row->incomes;
                 
                 $item = [
                "date" => $row->date,
                "incomes" => $row->incomes,
                "expenses" => 0,
                "deposites" => 0,
                "custodies" => 0,
                "solfa" => 0,
                "balance" => $balance,
                 ];
            }
            elseif($row->expenses ?? ''){
                
            $balance -= $row->expenses;
            
                 $item = [
                "date" => $row->date,
                "incomes" => 0,
                "expenses" => $row->expenses,
                "deposites" => 0,
                "custodies" => 0,
                "solfa" => 0,
                "balance" => $balance,
                ];
            }
            elseif($row->deposites ?? ''){
                
            $balance -= $row->deposites;
            
                 $item = [
                "date" => $row->date,
                "incomes" => 0,
                "expenses" => 0,
                "deposites" => $row->deposites,
                "custodies" => 0,
                "solfa" => 0,
                "balance" => $balance,
                ];
            }
              elseif($row->custodies ?? ''){
                
            $balance -= $row->custodies;
            
                 $item = [
                "date" => $row->date,
                "incomes" => 0,
                "expenses" => 0,
                "deposites" => 0,
                "custodies" => $row->custodies,
                "solfa" => 0,
                "balance" => $balance,
                ];
            }
              elseif($row->solfa ?? ''){
                
            $balance -= $row->solfa;
            
                 $item = [
                "date" => $row->date,
                "incomes" => 0,
                "expenses" => 0,
                "deposites" => 0,
                "custodies" => 0,
                "solfa" => $row->solfa,
                "balance" => $balance,
                ];
            }
            else{$item = [];}

            $data[] = $item;
        }
        
        return $data;
    }

    /**
     * return all data in json format
     * @return json
     */
    public function bankBalance() {
        $data = [];
        $bank = Bank::find(request()->bank_id);
        
        if (!request()->date_from || !request()->date_to || !$bank)
            return [];
        
        $date1 = Carbon::createFromFormat("Y-m-d", request()->date_from);
        $date2 = Carbon::createFromFormat("Y-m-d", request()->date_to);
        $days = $date1->diffInDays($date2);
        $balance = $bank->init_balance;
        
        for($index = 1; $index <= $days; $index ++) {
            $date = Carbon::create(date('Y', strtotime($date1)), date('m', strtotime($date1)), $index)->toDateString();
            $deposites = DB::table('account_transformations')
                    ->where('type', 'store_to_bank')
                    ->where('bank_id', request()->bank_id)
                    ->where('date', $date)->sum('value');
            $checks = DB::table('account_checks')
                    ->where('bank_id', request()->bank_id)
                    ->where('is_paid', '1')
                    ->where('date', $date)->sum('value'); 
            $balance += $deposites - $checks;
            
            $item = [
                "date" => $date,
                "deposites" => $deposites,
                "checks" => $checks,
                "balance" => $balance,
            ];
            $data[] = $item;
        }
         
        
        return $data;
    }
  
 
}
