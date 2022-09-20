<?php

namespace Modules\Academic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;
use Modules\Academic\Entities\Course;
use Modules\Academic\Entities\CoursePrerequsite;
use Modules\Academic\Entities\OpenCourse;


class CourseController extends Controller
{
    /**
     * return list of courses
     * @return Response
     */
    public function get()
    {
        return Course::all();
    }

    public function getCoursesHistory(){
        return OpenCourse::join('academic_courses' , 'academic_courses.id' , 'academic_open_courses.course_id')
        ->select('term_id as term' , 'level_id','division_id' ,'name' ,  'academic_courses.id as id')
        ->get();
    }

    
    public function syncCourses()
    {
        // $courses = DB::table('academic_courses')->get();
        $courses = OpenCourse::currentCourses();
        return response()->Json(['data' => $courses]);
    }
      
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $resource = null;
 
        try {
            $validator = validator($request->all(), [
                'name' => "required",   
		        'code' => "required",    
		        'term' => "required",    
		        'year_work_degree' => "required",    
		        'practical_degree' => "required",    
		        'academic_degree' => "required",   
		        'division_id' => "required", 
		        'credit_hour' => "required",  
		        'subject_category_id' => "required",  
            ]);

            if ($validator->failed()) {
                return responseJson(0, __('fill all required data'));
            }

            $data = $request->all();
           

            $resource = Course::create($data);

            foreach($request->prerequsites as $item) {
                if ($item > 0)
                CoursePrerequsite::create([
                    "course_id" => $resource->id,
                    "related_course_id" => $item
                ]);
            }

            watch(__('create new course ') . $resource->name, "fa fa-book");
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }

        return responseJson(1, __('done'), $resource);
    }
 
 

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, Course $resource)
    {  
        try {
            $validator = validator($request->all(), [
                'name' => "required",   
		        'code' => "required",    
		        'term' => "required",    
		        'year_work_degree' => "required",    
		        'practical_degree' => "required",    
		        'academic_degree' => "required",   
		        'division_id' => "required", 
		        'credit_hour' => "required",  
		        'subject_category_id' => "required",  
            ]);

            if ($validator->failed()) {
                return responseJson(0, __('fill all required data'));
            }

            $data = $request->all(); 
            $resource->update($data);

            $resource->prequsitesCourse()->delete();
            foreach($request->prerequsites as $item) { 
                CoursePrerequsite::create([
                    "course_id" => $resource->id,
                    "related_course_id" => $item
                ]);
            }

            watch(__('update course ') . $resource->name, "fa fa-book");

        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }

        return responseJson(1, __('done'), $resource);
        //
    }
    
    public function updateExamSchedule(Request $request, Course $resource)
    {  
        try {
            $validator = validator($request->all(), [
                'course_id' => "required",   
            ]);

            if ($validator->failed()) {
                return responseJson(0, __('fill all required data'));
            }

           $course = Course::find($request->course_id);
           $course->exam_date = $request->date;
           $course->day = $request->day;
           $course->time = $request->time;
           $course->update();

          return 1;

        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }

        return responseJson(1, __('done'), $resource);
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Course $resource)
    {
        if ($resource->can_delete) {
            watch(__('remove course ') . $resource->name, "fa fa-book");
        	$resource->delete();
        }
        return responseJson(1, __('done'));
    }
 
}
