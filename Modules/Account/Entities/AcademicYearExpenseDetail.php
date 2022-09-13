<?php

namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model;
use DB;
class AcademicYearExpenseDetail extends Model
{
    protected $table = "account_academic_year_expenses_details";
 
    protected $fillable = [
        'name',
        'priorty',
        'value',
        'term_id',
        'registeration_status_id',
        'store_id',
        'discount',
        'academic_year_expense_id',
        'wz_value',
        'service_id'
    ];

    protected $appends = [
        'level'
    ];

    public function getLevelAttribute() {
        return optional(optional($this->academicYearExpense)->level)->name;
    }
      
    public function term() {
        return $this->belongsTo('Modules\Account\Entities\Term', 'term_id')->select(['id', 'name']);
    }
    
    public function store() {
        return $this->belongsTo('Modules\Account\Entities\Store', 'store_id')->select(['id', 'name']);
    }
     
    public function academicYearExpense() {
        return $this->belongsTo('Modules\Account\Entities\AcademicYearExpense', 'academic_year_expense_id');
    }
    
    public function canDelete() {
        $academicYear = AccountSetting::getCurrentAcademicYear();
        $valid = true;
 
        if (DB::table('account_payments')->where('model_type', 'academic_year_expense')->where('model_id', $this->id)->first())
            $valid = false;
        
        
        return $valid;
    }
}
