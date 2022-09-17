<?php

namespace Modules\Academic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Academic\Entities\Student;

class AcademicController extends Controller
{

    /**
     * return student info
     *
     * @return type
     */
    public function getStudentInfo()
    {
        $student = null;
        if (request()->student_id) {
            $student = Student::query()
                ->with([
                    'level', 'division', 'case_constraint',
                    'constraint_status', 'installments',
                    'payments', 'registerationStatus',
                    'nationality', 'discount_requests', 'balanceResets',
                    'courses'
                ])
                ->find(request()->student_id);
        }

        $student->date = date("Y-m-d");
        return $student;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getRegisterCoursePrintPreview(Student $student)
    {
        return view('academic::register_course_print', compact('student'));
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getRegisterCourseUserPrintPreview(Student $student)
    {
        return view('academic::register_course_user_print', compact('student'));
    }
    public function getRegisterCourseUserPrintPreview2(Student $student)
    {
        return view('academic::register_course_schedule_print', compact('student'));
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getRegisterCourseStudentPrintPreview(Student $student)
    {
        return view('academic::register_course_student_print', compact('student'));
    }


    public function getTopGpaStudents(Request $req)
    {

        $validator = validator($req->all(), [
            'year_id' => 'required',
            'level_id' => 'required',
        ], [
            "year_id.required" => __('fill all required data'),
            "level_id.required" => __('fill all required data'),
        ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first());
        }

        $students = Student::query()->where([
            ['academic_years_id', $req->year_id],
            ['level_id', $req->level_id]
        ]);
        if ($req->division_id > 0) {
            $students->where('division_id', $req->division_id);
        }

        $gpas = collect();

        $students->chunk(500, function ($students) use ($gpas , $req) {
            foreach ($students as $std) {
                $gpa = $std->getGpaByYearAndTerm($req->year_id , $req->term_id);
                $gpas->push([
                    'student_name' => $std->name,
                    'gpa' => round($gpa , 2)
                ]);
            }
        });

        $gpas =  $gpas->sortByDesc(function($item){
            return $item['gpa'];
        })->forPage(1 , 10)->all();

        return view('academic::topten' , compact('gpas'));
    }
}
