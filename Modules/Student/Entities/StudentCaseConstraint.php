<?php

namespace Modules\Student\Entities;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use DB;

class StudentCaseConstraint extends Model {

    /**
     * folder name of the application
     *
     * @var String
     */

    /**
     * table name of the db;
     *
     * @var type string
     */
    protected $table = 'student_case_constraints';
    protected $fillable=['academic_year_id','term_id','student_id','case_constraint_id','level_id','division_id','reason','created_at','updated_at'];

    /**
     * folder name of the application
     *
     * @var String
     */
     
     

    public function student() {
        return $this->belongsTo('Modules\Academic\Entities\Student', 'student_id');
    }
    public function caseConstraint() {
        return $this->belongsTo('Modules\Settings\Entities\CaseConstraint', 'case_constraint_id');
    }
    



}
