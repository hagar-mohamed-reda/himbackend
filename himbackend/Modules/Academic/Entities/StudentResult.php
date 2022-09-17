<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Academic\Entities\DegreeMap;
use Modules\Academic\Entities\DegreeMap2;
use Modules\Academic\Entities\Course;

class StudentResult extends Model
{
    // table of bank
    protected $table = "academic_student_courses_result";

    protected $fillable = [
  	    'course_id',
        'student_id',
        'mid_degree',
        'work_year_degree',
        'final_tahrery_degree',
        'amly_degree',
        'final_degree',
        'term_id',
        'academic_year_id',
        'level_id',
        'date',
        'user_id',
        'gpa',
        'gpa_word'
    ];


    public function course() {
        return $this->belongsTo("Modules\Academic\Entities\Course", "course_id");
    }

    public function student() {
        return $this->belongsTo("Modules\Academic\Entities\Student", "student_id");
    }

    public function academicYear() {
        return $this->belongsTo("Modules\Settings\Entities\AcademicYear", "academic_year_id");
    }

    public function level() {
        return $this->belongsTo("Modules\Settings\Entities\level", "academic_year_id");
    }

    public function term() {
        return $this->belongsTo("Modules\Settings\Entities\Term", "term_id");
    }

    public function getDegreeMap() {
        $course = Course::FindOrFail($this->course_id);
        $percent = ($this->final_degree / $this->course->large_degree) * 100;
 
        $coursePercent = ($this->final_tahrery_degree / $course->academic_degree) * 100 ;
     
        $degreeMap = DegreeMap::where('percent_from', "<=", $percent)->where('percent_to', '>', $percent)->first();

        if($coursePercent < 40)
             $degreeMap = DegreeMap::where('percent_from', "=", -5)->first();
             
        if(strtolower(trim($this->gpa_word)) == "ab") 
            $degreeMap = DegreeMap::where('key', "=", "AB")->first();
            
        if(strtolower(trim($this->gpa_word)) == "ad") 
            $degreeMap = DegreeMap::where('key', "=", "AD")->first();
            
        if(strtolower(trim($this->gpa_word)) == "ac") 
            $degreeMap = DegreeMap::where('key', "=", "AC")->first();
        
        if(strtolower(trim($this->gpa_word)) == "w") 
            $degreeMap = DegreeMap::where('key', "=", "W")->first();
        
        

        return $degreeMap;
    }


    public function calculateCourseGpa() {
        $course = Course::FindOrFail($this->course_id);
        $percent = ($this->final_degree / $this->course->large_degree) * 100;
        $coursePercent = ($this->final_tahrery_degree / $course->academic_degree) * 100 ;
        $success = null;

        $degreeMap = $this->getDegreeMap();

        $this->update([
            "gpa" => optional($degreeMap)->gpa,
            "gpa_word" => optional($degreeMap)->key,
        ]);
        

        $studentRegisterCourse = StudentRegisterCourse::where('student_id', $this->student_id)
                ->where('course_id', $this->course_id)
                ->latest()
                ->first();


        if ($studentRegisterCourse) {
                    $studentRegisterCourse->update([
                    "degree_map_id" => optional($degreeMap)->id,
                    "gpa" => optional($degreeMap)->gpa,
                    "gpa_word" => optional($degreeMap)->key,
                    "student_degree" => $this->final_degree,
                    ]);
        }

    }

}
