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
use Illuminate\Support\Facades\Auth;

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
        $mid_degree = str_replace(" ", "", $row[5] ?? null);
        $work_year_degree = str_replace(" ", "", $row[6] ?? null);
        $final_tahrery_degree = str_replace(" ", "", $row[7] ?? null);
        
        // validation on values 
        if(!is_numeric($mid_degree))
            $mid_degree = null;
        if(!is_numeric($work_year_degree))
            $work_year_degree = null;
        if($final_tahrery_degree == null)
            $final_tahrery_degree = null;
        
                        // dd($mid_degree);

        // try {
        
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
                        $resource = StudentResult::create([
                        "course_id" => $course->id,
                        "student_id" => $student->id,
                        "term_id" => AccountSetting::getCurrentTerm()->id,
                        "academic_year_id" => AccountSetting::getCurrentAcademicYear()->id,
                        "mid_degree" => $mid_degree,
                        "work_year_degree" => $work_year_degree,
                        "final_tahrery_degree" => $final_tahrery_degree,
                        "level_id" => 1,
                        // "level_id" => $student->level_id,
                        "date" => date('Y-m-d'),
                        "user_id" => request()->user_id,
                        ]);
                    }

                
            
                   
                     if ($resource) {
                            $degreeMap = null;
                            $final_degree = null;
                            
                            if($mid_degree == null)
                                $mid_degree = $resource->mid_degree;
                            if($work_year_degree == null)
                                $work_year_degree = $resource->work_year_degree;
                            if($final_tahrery_degree == null)
                                $final_tahrery_degree = $resource->final_tahrery_degree;
                                
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
                                        if($final_tahrery_degree != null && is_numeric($final_tahrery_degree)){
                                            $final_degree = $mid_degree + $work_year_degree + $final_tahrery_degree;
                                            $percent = ($final_degree / $course->large_degree) * 100;
                                            $coursePercent = ($final_tahrery_degree / $course->academic_degree) * 100 ;
                                            
                                            if($coursePercent < 40)
                                                $degreeMap = DegreeMap::where('percent_from', "=", -5)->first();
                                            else 
                                                $degreeMap = DegreeMap::where('percent_from', "<=", $percent)->where('percent_to', '>', $percent)->first();
                                                   
                                        }else{
                                            $final_tahrery_degree == 55;
                                        }
                                       
                                        $resource->final_tahrery_degree= $final_tahrery_degree;
                                    }

                                    $degree = $degreeMap;
                    
                                    $resource->gpa = optional($degree)->gpa;
                                    $resource->gpa_word = optional($degree)->key;
                                    $resource->final_degree = $final_degree;
                                    
                                    $studentRegisterCourse = StudentRegisterCourse::where('student_id', $resource->student_id)
                                    ->where('course_id', $resource->course_id)
                                    ->where('academic_year_id', $year->id)
                                    ->where('term_id', $term->id)
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
                        
                                  
                            $resource->mid_degree = $mid_degree;
                            $resource->work_year_degree = $work_year_degree;
                            $resource->update();

                     }else{
                         
                     }
                                    
                                   
           

                    


            return $resource ?? '';
        // } catch (Exception $exc) {
        //     return null;
        // }  
    }

}
