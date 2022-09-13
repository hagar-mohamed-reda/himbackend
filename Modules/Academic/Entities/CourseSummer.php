<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Account\Entities\AccountSetting;

class CourseSummer extends Model
{
    // table of bank
    protected $table = "academic_courses_summer";
    
    protected $fillable = [
        'course_id', 'division_id', 'term_id', 'academic_year_id', 'date', 'user_id', 'created_at', 'updated_at'
    ];
      
    public static function currentOpenCoursesSummer() {
        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();

        return CourseSummer::where('term_id', $term->id)->where('academic_year_id', $year->id);
    }
       
    public static function currentCoursesSummer() { 
        $ids = self::currentOpenCoursesSummer()->pluck('course_id')->toArray();

        return Course::whereIn('id', $ids)->get();
    }

}
