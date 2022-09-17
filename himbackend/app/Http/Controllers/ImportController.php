<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\StudentImport;
use App\Imports\CourseImport;
use App\Imports\CourseRegisterWithResultImport;
use App\Imports\CourseRegisterWithResultImport2;
use App\Imports\CourseRegisterWithResultImport3;
use App\Imports\CourseRegisterWithResultImport4;
use Excel;

class ImportController extends Controller
{
    
    /**
     * import excel file
     * for students 
     * [code, set_number, student_name]
     * 
     */
    public function importStudents(Request $request) { 
        try {
            Excel::import(new StudentImport, $request->file('file'));
            return responseJson(1, __("done"));
        } catch (Exception $exc) { 
            return responseJson(0, $exc->getMessage());
        } 
    }
    
    
    /**
     * import excel file
     * for courses 
     * [code, course_name]
     * 
     */
    public function importCourses(Request $request) { 
        try {
            Excel::import(new CourseImport, $request->file('file'));
            return responseJson(1, __("done"));
        } catch (\Exception $exc) { 
            return responseJson(0, $exc->getMessage());
        } 
    }
    
    
    /**
     * import excel file
     * for courses 
     * [code, course_name]
     * 
     */
    public function importResult(Request $request) { 
        // return $request;
        $courseRegisterWithResult = new CourseRegisterWithResultImport;
        $courseRegisterWithResult->courseId = $request->course_id;
        
        try {
            
            Excel::import($courseRegisterWithResult, $request->file('file'));
            return responseJson(1, __("done"));
        } catch (Exception $exc) { 
            return responseJson(0, $exc->getMessage());
        } 
    }
    
    public function importResult2(Request $request) { 
        // return $request;
        $courseRegisterWithResult2 = new CourseRegisterWithResultImport2;
        $courseRegisterWithResult2->courseId = $request->course_id;
        
        try {
            
            Excel::import($courseRegisterWithResult2, $request->file('file'));
            return responseJson(1, __("done"));
        } catch (Exception $exc) { 
            return responseJson(0, $exc->getMessage());
        } 
    }
    
    public function importResult3(Request $request) { 
        // return $request;
        $courseRegisterWithResult3 = new CourseRegisterWithResultImport3;
        $courseRegisterWithResult3->courseId = $request->course_id;
        
        try {
            
            Excel::import($courseRegisterWithResult3, $request->file('file'));
            return responseJson(1, __("done"));
        } catch (Exception $exc) { 
            return responseJson(0, $exc->getMessage());
        } 
    }
    
     public function importResult4(Request $request) { 
        // return $request;
        $courseRegisterWithResult4 = new CourseRegisterWithResultImport4;
        $courseRegisterWithResult4->courseId = $request->course_id;
        
        try {
            
            Excel::import($courseRegisterWithResult4, $request->file('file'));
            return responseJson(1, __("done"));
        } catch (Exception $exc) { 
            return responseJson(0, $exc->getMessage());
        } 
    }
}
