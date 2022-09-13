<?php

namespace Modules\Account\Entities;
use Modules\Account\Entities\Discount;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StudentBalance extends Student
{
    protected $table = "students";
    
   

    /**
     * calculate old balance of the student
     * @return float
     */
     
     
    public function getOldBalance() {
        // current academic year
        $academicYear = AccountSetting::getCurrentAcademicYear();

        // caculated balance
        $balance = 0;

        $studentOldBalance = StudentOldBalance::where('student_id', $this->id)->first();

        $balance += optional($studentOldBalance)->value;

        // check on payment value
        $balance -= Payment::where('student_id', $this->id)->whereIn('model_type', ['old_academic_year_expense'])->sum('value');

        // check if there is paid installment for old value
        $balance -= Installment::where('student_id', $this->id)->where('type', 'old')->where('paid', '1')->sum('value');

        // sum balance reset
        $balanceResets = BalanceReset::where('student_id', $this->id)->where('type', 'old')->sum('value');

        // decreate reset balance
        $balance -= $balanceResets;

        return $balance;
    }

    public function isAcademicYearExpenseDetailPaid($ids) {
        $paidValue = Payment::where('model_type', 'academic_year_expense')
        ->where('student_id', $this->id)
        ->whereIn('model_id', $ids)
        ->sum('value');
        $discounts = Discount::where('student_id',$this->id)->whereIn('model_id', $ids)->sum('value');
     
        
        $requiredValue = AcademicYearExpenseDetail::whereIn('id', $ids)->sum('value') - $discounts;
        // dd($requiredValue);
        
        return  $paidValue >= $requiredValue? true : false;
    }

    public function getCurrrentAcademicYearExpenseDetail() {
        // current academic year
        $academicYear = AccountSetting::getCurrentAcademicYear();
        $currentTerm = AccountSetting::getCurrentTerm();
        // current date
        $date = date('Y-m-d');
        //
        $academicYearExpenses = AcademicYearExpense::query()
            ->where('academic_year_id', $academicYear->id)
            ->where('level_id', $this->level_id)
            ->first();

        $priorties = $academicYearExpenses->details()
        ->orderBy('priorty')
        ->pluck('priorty')
        ->toArray();

        $currentPriorty = null;
        $details = null;
        foreach($priorties as $priorty) {
            $details = $academicYearExpenses
                ->details()
                ->where('priorty', $priorty)
                ->get();

            $ids = [];
            foreach($details as $detail) {
                if ($detail->registeration_status_id) {
                    if ($detail->registeration_status_id ==$this->registration_status_id) {
                        $ids[] = $detail->id;
                    }
                } else {
                    $ids[] = $detail->id;
                }
            }
            
          
            $expenses = AcademicYearExpenseDetail::whereIn('id', $ids)->get();
          
            if ($priorty == 1) {
                if (!$this->isAcademicYearExpenseDetailPaid($ids) && $this->case_constraint_id == 1) {
                    return $expenses;
                }
            } else if ($priorty == 2) {
                if (!$this->isAcademicYearExpenseDetailPaid($ids) && $currentTerm->id == 2) {
                    return $expenses;
                }
            } else {
                if (!$this->isAcademicYearExpenseDetailPaid($ids)) {
                    return $expenses ;
                }
            }


        }

        return null;
    }

    public function getCurrentBalanceV2() {
        // current academic year
        $academicYear = AccountSetting::getCurrentAcademicYear();
        // current date
        $date = date('Y-m-d');
        //
        $currentDetails = $this->getCurrrentAcademicYearExpenseDetail();
        // dd($currentDetails);
        
        // $discounts = Discount::where('student_id',$this->id)->whereIn('model_id', $ids)->sum('value');
        
        // $requiredValue = AcademicYearExpenseDetail::whereIn('id', $ids)->sum('value') - $discounts;
        
        $balance = 0;
        if ($currentDetails){
            $discounts = Discount::where('student_id',$this->id)->where('model_id', $currentDetails[0]->id)->sum('value');
            $balance = $currentDetails->sum('value') - $discounts;
        }

        // sum balance reset
        $balanceResets = BalanceReset::where('student_id', $this->id)->where('type', 'new')->sum('value');

        // decreate reset balance
        $balance -= $balanceResets;
        // $balance = 100;
    //   dd($balance);
        return $balance;
    }


    public function getCurrentBalanceTotal() {
        // current academic year
        
        // dd($this->discount_total);
        
        $academicYear = AccountSetting::getCurrentAcademicYear();

        $academicYearExpenses = AcademicYearExpense::query()
            ->where('academic_year_id', $academicYear->id)
            ->where('level_id', $this->level_id)
            ->first();

        $ids = $academicYearExpenses->details()->where('service_id', '12')->pluck('id')->toArray();
        $total = $academicYearExpenses->details()->where('service_id', '12')->sum('value') - $this->discount_total;
        
        // dd($total);
        //$details = $academicYearExpenses->details()->where('service_id', '12')->get();
        /*foreach($details as $detail) {
            if ($detail->priorty == 1) {
                if ($this->case_constraint_id == 1) { 
                    if ($detail->registeration_status_id) {
                        if ($detail->registeration_status_id == $this->registration_status_id)
                            $total += $detail->value;
                    } else
                        $total += $detail->value;
                }
            } else {
                $total += $detail->value;
            }
        }*/
        //
        $paid = Payment::whereIn('model_id', $ids)->where('student_id', $this->id)->sum('value');
        // 
        $remind = $total - $paid ;
        $remind += $this->getOldBalance();
        // dd($remind);
        return $remind ;
    }
    /**
     * calculate current balance of the student
     * @return float
     */
    public function getCurrentBalance($term = null) {
        return $this->getCurrentBalanceV2();
    }


    public function getReadyInstallment($type) {
        $date = date('Y-m-d');
        $installment = Installment::where('student_id', $this->id)
            ->where('type', $type)
            ->where('paid', '0')
            ->where('date', '<=', $date)
            ->first();

        return $installment;
    }

    /**
     * get paid value when student go to store
     *
     * @return float
     */
    public function getPaidValue() {
        // current term
        $term = AccountSetting::getCurrentTerm();
        // old balance
        $oldBalance = $this->getOldBalance();
        // current balance of year
        $currentBalance = $this->getCurrentBalance($term->id);
        // dd($currentBalance);
        // value should pay in store
        $value = 0;

        if ($oldBalance > 0) {
            if ($this->is_old_installed) {
                $installment = $this->getReadyInstallment('old');
                $value = optional($installment)->value;
            } else
                $value = $oldBalance;
        } else {
            if ($this->is_current_installed) {
                $installment = $this->getReadyInstallment('new');
                $value = optional($installment)->value;
            } else
                $value = $currentBalance;
        }
        return $value;
    }




}
