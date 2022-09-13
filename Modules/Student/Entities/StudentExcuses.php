<?php

namespace Modules\Student\Entities;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use DB;

class StudentExcuses extends Model {

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
    protected $table = 'student_excuses';
    protected $fillable=['academic_year_id','term_id','student_id','level_id','division_id','reason','attachment','created_at','updated_at'];

    /**
     * folder name of the application
     *
     * @var String
     */
     
     public function getAttachmentUrlAttribute() {
        return url('/uploads/excuses') . "/" .  $this->attachment;
    }

    public function student() {
        return $this->belongsTo('Modules\Student\Entities\Student', 'student_id');
    }
   



}
