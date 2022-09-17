<?php

namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    /**
     * pagination length for response
     * 
     * @var Integer
     */
    public static $PAGE_LENGTH = 40;
    
    protected $table = "account_installments";
  
    protected $fillable = [
        'student_id',
        'type', // ['old', 'new']
        'value',
        'date',
        'paid',
        'academic_year_id',
        'model_id'
    ];
     
    protected $appends = ['valid'];

    public function getValidAttribute() {
        return strtotime($this->date) > strtotime(date('Y-m-d'))? true : false;
    }

    public function student() {
        return $this->belongsTo('Modules\Student\Entities\Student', 'student_id');
    }
    
}
