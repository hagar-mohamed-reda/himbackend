<?php

namespace Modules\Academic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Academic\Entities\OpenCourse; 
use Modules\Academic\Entities\Course; 
use Modules\Account\Entities\AccountSetting;
use Modules\Account\Entities\Student;
use Modules\Academic\Entities\StudentAvailableCourse;
use Modules\Academic\Entities\StudentRegisterCourse;
use DB;

class StudentRegisterController extends Controller
{
    
    public function getCourses(Request $request)
    {
        $student = Student::find($request->student_id);
        $avaibleCourse = new StudentAvailableCourse($student);
        return $avaibleCourse->getCourses();
    }
    
    public function registerCourses(Request $request) {
        return StudentRegisterCourse::updateRegisterCourses($request);
    }
    
    public function syncStudentRegister(Request $request) {
        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();
        
        $student_register = DB::table('academic_student_register_courses')
                                ->where('academic_year_id',$year->id)
                                ->where('term_id',$term->id)
                                ->select(DB::raw('(select code from students where students.id = academic_student_register_courses.student_id) as student_code'),
                                         DB::raw('(select code from academic_courses where academic_courses.id = academic_student_register_courses.course_id) as course_code'))->get();

        
        
        return response()->Json(['data' => $student_register]);
        
        
        
    }
       
}
