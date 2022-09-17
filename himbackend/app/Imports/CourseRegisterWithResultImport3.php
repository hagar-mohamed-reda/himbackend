<?php

namespace App\Imports;

use Modules\Academic\Entities\StudentRegisterCourse2;
use Modules\Academic\Entities\StudentResult;
use Modules\Account\Entities\AccountSetting;
use Maatwebsite\Excel\Concerns\ToModel;
use Modules\Student\Entities\Student;
use Modules\Academic\Entities\Course;
use Modules\Academic\Entities\DegreeMap;
use App\Imports\StudentImport;
use App\Imports\CourseImport;
use DB;

class CourseRegisterWithResultImport3 implements ToModel {
    
    public $courseId;
    

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row) {
        
      
        $result = $this->result($row);

        return $result;
    }

    /**
     * register course to student 
     * 
     * @param type $course
     * @param type $gpa
     * @param type $student
     * @param type $degreeMap
     * @return type
     */
   
   


    /**
     * set the result for register course of student
     * 
     * @param type $register
     * @param type $degree
     */
    public function result(array $row) {
        $row[0] = str_replace(" ", "", $row[0]);
        $work_year_degree = str_replace(" ", "", $row[4] ?? '');

        try {
            $course = Course::where('id', $this->courseId ?? '')->first();
            $student = Student::where('set_number', $row[0] ?? '')->first();
            $year = AccountSetting::getCurrentAcademicYear();
            $term = AccountSetting::getCurrentTerm();
                                        // dd($student);

            if(!$student || !$course)
                return null;
             
             $resource = StudentResult::query()
                        ->where('student_id', $student->id)
                        ->where('course_id', $course->id)
                        ->where('academic_year_id', $year->id)
                        ->where('term_id', $term->id)
                        ->first();
                // dd($resource);

                        
                  if ($resource) {
                    if($work_year_degree != null){
                    $resource->work_year_degree=$work_year_degree;
                     $resource->update();
                    }
                   
                   
                } else {

                       $resource = StudentResult::create([
                        "course_id" => $course->id,
                        "student_id" => $student->id,
                        "term_id" => AccountSetting::getCurrentTerm()->id,
                        "academic_year_id" => AccountSetting::getCurrentAcademicYear()->id,
                        "level_id" => $student->level_id,
                        "date" => date('Y-m-d'),
                        "user_id" => request()->user_id,
                        "work_year_degree" => $work_year_degree,
                        ]);

                }
                
               if(optional($resource)->final_tahrery_degree == null || optional($resource)->final_tahrery_degree == ''){
                    optional($resource)->final_tahrery_degree = 0;
                }
                if(optional($resource)->mid_degree == null || optional($resource)->mid_degree == '' ){
                    optional($resource)->mid_degree = 0;
                }
                if(optional($resource)->work_year_degree == null || optional($resource)->work_year_degree == ''){
                    optional($resource)->work_year_degree = 0;
                }
                  if(optional($resource)->amly_degree == null || optional($resource)->amly_degree == ''){
                    optional($resource)->amly_degree = 0;
                }
                

                          $resource->final_degree = optional($resource)->final_tahrery_degree + optional($resource)->mid_degree + optional($resource)->work_year_degree + optional($resource)->amly_degree;
                            $resource->update();
                             $resource->calculateCourseGpa();
                     
                     
                        
         

            return $resource;
        } catch (Exception $exc) {
            return null;
        }  
    }

}
