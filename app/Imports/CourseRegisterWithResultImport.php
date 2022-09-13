<?php

namespace App\Imports;

use Modules\Academic\Entities\StudentRegisterCourse;
use Modules\Academic\Entities\StudentResult;
use Modules\Account\Entities\AccountSetting;
use Maatwebsite\Excel\Concerns\ToModel;
use Modules\Student\Entities\Student;
use Modules\Academic\Entities\Course;
use Modules\Academic\Entities\DegreeMap;
use App\Imports\StudentImport;
use App\Imports\CourseImport;
use DB;

class CourseRegisterWithResultImport implements ToModel {
    
    public $courseId;
    

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row) {
        
        //     dd($this->courseId);

        
        // return $row;
        // dd($course_id);
        
        
        // init variables 
        // $degreeMap = DegreeMap::where('key', str_replace(" ", "", $row[15]))->first();
        // $gpa = $row[14];
        // $degree = $row[11];
        
        //$student = StudentImport::insertStudent(array($row[0], $row[1], $row[2]));
        //$course = CourseImport::insertCourse([$row[4], $row[5]]);


        // validate on the data 
        // if (!$student || !$course || !$degreeMap || !is_numeric($gpa) || !is_numeric($degree)) 
        //     return null;
            
        // hold transaction in db
        //DB::beginTransaction();
        // register course to student first 
        //$register = $this->register($course, $gpa, $student, $degreeMap);

        // set result to register course for student
        // $result = $this->result($register, $degree);
        $result = $this->result($row);

        // commit transaction in db
        //DB::commit();

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
    public function register($course, $gpa, $student, $degreeMap) {
        try {

            $resource = StudentRegisterCourse::create([
                        "course_id" => $course->id,
                        "gpa" => $gpa,
                        "term_id" => AccountSetting::getCurrentTerm()->id,
                        "academic_year_id" => AccountSetting::getCurrentAcademicYear()->id,
                        "student_id" => $student->id,
                        "level_id" => $student->level_id,
                        "division_id" => $student->division_id,
                        "degree_map_id" => $degreeMap->id,
                        "user_id" => request()->user_id,
            ]);

            return $resource;
        } catch (\Exception $exc) {
            return null;
        }
    }
    
     public function course_id($course_id) {

          return $course_id;
       
    }


    /**
     * set the result for register course of student
     * 
     * @param type $register
     * @param type $degree
     */
    public function result(array $row) {
        $row[0] = str_replace(" ", "", $row[0]);
        $final_tahrery = str_replace(" ", "", $row[2] ?? '');
       

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

                        
                  if ($resource) {
                      if($final_tahrery != null){
                            $resource->final_tahrery_degree=$final_tahrery;
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
                        "final_tahrery_degree" => $final_tahrery,
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
