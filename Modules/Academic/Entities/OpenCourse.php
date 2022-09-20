<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Account\Entities\AccountSetting;
use DB;
class OpenCourse extends Model
{
    // table of bank
    protected $table = "academic_open_courses";
    
    protected $fillable = [
        'course_id',  'term_id', 'academic_year_id', 'date'
    ];
      
    public static function currentOpenCourses() {
        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();

        return OpenCourse::where('term_id', $term->id)->where('academic_year_id', $year->id);
    }
       
    public static function currentCourses() { 
        $ids = self::currentOpenCourses()->pluck('course_id')->toArray();

        return Course::whereIn('id', $ids)->get();
    }
    
    
     public static function allOpenCourses() { 
        $open_courses = OpenCourse::select('*','term_id as term',
        DB::raw('(select academic_courses.name from academic_courses where course_id = academic_courses.id)  as course_name'),
        DB::raw('(select academic_courses.division_id from academic_courses where course_id = academic_courses.id)  as division_id'),
        DB::raw('(select academic_courses.level_id from academic_courses where course_id = academic_courses.id)  as level_id')
        )->get();
        return $open_courses;
    }

    public function course(){
        return $this->belongsTo(Course::class , 'course_id');
    }

}
