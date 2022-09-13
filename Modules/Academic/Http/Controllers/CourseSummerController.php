<?php

namespace Modules\Academic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Academic\Entities\CourseSummer; 
use Modules\Academic\Entities\Course; 
use Modules\Account\Entities\AccountSetting;


class CourseSummerController extends Controller
{
    /**
     * return list of courses
     * @return Response
     */
    public function get()
    {
        return CourseSummer::currentCoursesSummer();
    }
      
     

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, Course $resource)
    {  

        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();

        try { 
            // remove old 
            CourseSummer::currentCoursesSummer()->delete();

            // add new
            foreach ($request->courses as $item) {
                CourseSummer::create([
                    "course_id" => $item['id'],
                    "course_id" => $item['division_id'],
                    "term_id" => $term->id,
                    "academic_year_id" => $year->id,
                    "user_id" => $request->user_id,
                    "date" => date('Y-m-d'),
                ]);
            }

            watch(__('courses summer ') . $resource->name, "fa fa-book");

        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }

        return responseJson(1, __('done'), $resource);
        //
    }

    
 
}
