<?php

namespace Modules\Academic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Academic\Entities\StudentResult;
use Modules\Academic\Entities\Student;
use Modules\Academic\Entities\Course;
use Modules\Academic\Entities\StudentGroup;
use Modules\Student\Entities\Student as StudentOrigin;
use Modules\Account\Entities\AccountSetting;
use DB;


class StudentGroupController extends Controller
{
    /**
     * return list of courses
     * @return Response
     */
    public function index()
    {
       $groups = StudentGroup::with('level','term','year','division')->get();
      
       return $groups;
        
    }

    /**
     * add the result of student if not exist
     * or update on it if it exist
     * @param Request $request
     * @return type
     */
    public function store(Request $request) {
      
        $student_group = StudentGroup::create([
            'name' => $request->name,
            'level_id' => $request->level_id,
            'year_id' => $request->year_id,
            'term_id' => $request->term_id,
            'division_id' => $request->division_id,
            ]);
            
        if($student_group)
            return 1;
           else return 0;


    }
    
      public function update(Request $request, $resource) {
        try {
            $validator = validator($request->all(), [
                'name' => "required", 
            ]);
            $student_group = StudentGroup::find($resource);

            if ($validator->failed()) {
                return responseJson(0, __('fill all required data'));
            }

            $data = $request->all();
            $student_group->update($data); 

            // delete old 

          
            watch(__('update Group ') . $student_group->name, "fa fa-user");
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }

        return 1;
        //
    }
    
     public function destroy($id)
    {
        $student_group = StudentGroup::find($id);
        if ($student_group) {
            // watch(__('remove Group ') . $student_group->name, "fa fa-book");
        	$student_group->delete();
        }
        return 1;
    }
 






}
