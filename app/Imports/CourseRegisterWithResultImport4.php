<?php

namespace App\Imports;

use Modules\Academic\Entities\StudentRegisterCourse2;
use Modules\Academic\Entities\StudentResult;
use Modules\Account\Entities\AccountSetting;
use Maatwebsite\Excel\Concerns\ToModel;
use Modules\Student\Entities\Student;
use Modules\Academic\Entities\Course;
use Modules\Academic\Entities\DegreeMap;
use Modules\Academic\Entities\StudentRegisterCourse;
use App\Imports\StudentImport;
use App\Imports\CourseImport;
use App\Term;
use DB;

class CourseRegisterWithResultImport4 implements ToModel {
    
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
        
        $code = str_replace(" ", "", $row[2] ?? '');
        $mid_degree = str_replace(" ", "", $row[5] ?? '');
        $work_year_degree = str_replace(" ", "", $row[6] ?? '');
        $final_tahrery_degree = str_replace(" ", "", $row[7] ?? '');
        
        // validation on values 
        // if(!is_numeric($mid_degree))
        //     $mid_degree = 0;
        if(!is_numeric($work_year_degree))
            $work_year_degree = 0;
        if($final_tahrery_degree == null)
            $final_tahrery_degree = 0;


        try {
        
                    $course = Course::where('id', $this->courseId ?? '')->first();
                    $student = Student::where('code', $code ?? '')->first();
                    $year = AccountSetting::getCurrentAcademicYear();
                    $term = AccountSetting::getCurrentTerm();
                                                
        
                    if(!$student || !$course)
                        return null;
                     
                     $resource = StudentResult::query()
                                ->where('student_id', $student->id)
                                ->where('course_id', $course->id)
                                ->where('academic_year_id', $year->id)
                                ->where('term_id', $term->id)
                                ->first();
                                
                    if(!$resource){
                        return null;
                    }

                        
                
            
                   
                     if ($resource) {
                             $mid_degree = $resource->mid_degree;
                            if(!is_numeric($mid_degree))
                                $mid_degree = 0;
                                
                          switch(strtolower(trim($final_tahrery_degree))) {
                            case('ab'):
                               $degreeMap = DegreeMap::where('key', "=", "AB")->first();
                                $final_degree = $mid_degree + $work_year_degree;
                                $resource->final_tahrery_degree= 0;
                                break;
                            case('ad'):
                                $degreeMap = DegreeMap::where('key', "=", "AD")->first();
                                $final_degree = $mid_degree + $work_year_degree;
                                $resource->final_tahrery_degree= 0;
                                break;
                            case('ac'):
                                $degreeMap = DegreeMap::where('key', "=", "AC")->first();
                                $final_degree = $mid_degree + $work_year_degree;
                                $resource->final_tahrery_degree= 0;
                                break;
                            case('w'):
                                $degreeMap = DegreeMap::where('key', "=", "W")->first();
                                $final_degree = $mid_degree + $work_year_degree;
                                $resource->final_tahrery_degree= 0;
                                break;
                            default:
                                $final_degree = $mid_degree + $work_year_degree + $final_tahrery_degree;
                                $percent = ($final_degree / $course->large_degree) * 100;
                                $coursePercent = ($final_tahrery_degree / $course->academic_degree) * 100 ;
                                if($coursePercent < 40)
                                    $degreeMap = DegreeMap::where('percent_from', "=", -5)->first();
                                else 
                                    $degreeMap = DegreeMap::where('percent_from', "<=", $percent)->where('percent_to', '>', $percent)->first();
                                $resource->final_tahrery_degree= $final_tahrery_degree;
                            }
                            $degree = $degreeMap;
                            // $resource->mid_degree = $mid_degree;
                            $resource->work_year_degree = $work_year_degree;
                            $resource->gpa = optional($degree)->gpa;
                            $resource->gpa_word = optional($degree)->key;
                            $resource->final_degree = $final_degree;
                            $resource->update();
                            
                            $studentRegisterCourse = StudentRegisterCourse::where('student_id', $resource->student_id)
                            ->where('course_id', $resource->course_id)
                            ->latest()
                            ->first();
            
            
                            if ($studentRegisterCourse) {
                                $studentRegisterCourse->update([
                                "degree_map_id" => optional($degree)->id,
                                "gpa" => optional($degree)->gpa,
                                "gpa_word" => optional($degree)->key,
                                "student_degree" => $final_degree,
                                ]);
                            }
                            
                            
                            // if($resource->final_degree != null)
                            // $student->startCalculateGpa($request->term_id);
             
                     }else{
                         
                     }
                                   
           

                    


            return $resource ?? '';
        } catch (Exception $exc) {
            return null;
        }  
    }

}
