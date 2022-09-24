<?php

namespace Modules\Academic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Academic\Entities\StudentResult;
use Modules\Academic\Entities\Student;
use Modules\Academic\Entities\Course;
use Modules\Academic\Entities\StudentGroup;
use Modules\Academic\Entities\StudentSection;
use Modules\Academic\Entities\OpenCourse;
use Modules\Student\Entities\Student as StudentOrigin;
use Modules\Account\Entities\AccountSetting;
use DB;


class StudentSectionController extends Controller
{
    /**
     * return list of courses
     * @return Response
     */
    public function index(Request $request)
    {
        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();
        
        $student_sections = StudentSection::with('division','course','group','level','term');
        if(isset($request->division_id))
        {
            $student_sections->where('division_id',$request->division_id);
        }

        if(isset($request->level_id))
        {
            $student_sections->where('level_id',$request->level_id);
        }

        if(isset($request->course_id))
        {
            $student_sections->where('course_id',$request->course_id);
        }

        if(isset($request->term_id))
        {
            $student_sections->where('term_id',$request->term_id);
        }
        if(isset($request->year_id))
        {
            $student_sections->where('year_id',$request->year_id);
        }
        // ->where('division_id',$request->division_id)
        //                     ->where('level_id',$request->level_id)->where('course_id',$request->course_id)->where('term_id',$request->term_id)->where('year_id',$request->year_id)->get();
      
        return $student_sections->get();
        
    }
    
     public function getNumbers(Request $request)
    {
        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();
        
        $student_division_num= Student::where('level_id', $request->level_id)
                                        ->where('division_id', $request->division_id)
                                        ->where('is_application', 0)->count();
       
        return ["students_num"=>$student_division_num,"term"=>$term->id];
        
    }

    /**
     * add the result of student if not exist
     * or update on it if it exist
     * @param Request $request
     * @return type
     */
    public function store(Request $request) {
        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();
        
         $validator = validator($request->all(), [
                'group_id' => "required" ,
                'course_id' => "required",
                'division_id' => "required",
                'term_id' => "required",
                'academicYear_id' => "required",
                'number' => "required",

            ]);

            if ($validator->failed()) {
                return 0;
            }
            
            // return $request/;
            

        try{
            

        //  $courses = Course::where('term',$request->term_id)->where('division_id',$request->division_id)
        //  ->where('level_id',$request->level_id)->get();
         $courses = OpenCourse::currentCourses();
         
        //  return $courses;

         for($i=1; $i <= $request->number; $i++){
             
             foreach($courses as $course){
                $student_section = StudentSection::create([
                'name' => $i,
                'group_id' => $request->group_id,
                'course_id' => $course->id,
                'division_id' => $request->division_id,
                'level_id' => $request->level_id,
                'term_id' => $request->term_id,
                'year_id' => $request->academicYear_id,
                ]);
             }
          

         }
              return 1;

         
         } catch (\Exception $th) {
            return $th;
        }
        

    }
    
     public function updateNumber(Request $request, $resource) {
        try {
            $validator = validator($request->all(), [
                'section_id' => "required", 
                'std_num' => "required", 
            ]);

            if ($validator->failed()) {
                return 0;
            }
            
            $section = StudentSection::FindOrFail($resource);
            $section->std_num = $request->std_num;
            $section->update(); 

            return 1;
            
        } catch (\Exception $th) {
            return 0;
        }

        //
    }
    
     public function destroy($id)
    {
        $student_section = StudentSection::find($id);
        if ($student_section) {
            // watch(__('remove Group ') . $student_group->name, "fa fa-book");
        	$student_section->delete();
        }
        return 1;
    }







}
