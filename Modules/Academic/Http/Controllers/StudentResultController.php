<?php

namespace Modules\Academic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Academic\Entities\StudentResult;
use Modules\Academic\Entities\StudentGpa;
use Modules\Academic\Entities\Student;
use Modules\Academic\Entities\Course;
use Modules\Student\Entities\Student as StudentOrigin;
use Modules\Account\Entities\AccountSetting;
use DB;


class StudentResultController extends Controller
{
    /**
     * return list of courses
     * @return Response
     */
    public function get(Request $request)
    {
        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();
        // $term = DB::table('terms')->where('id',request()->term_id)->first();
        
        if(!$term)
          return null;
          
		$course = Course::find(request()->course_id);
		
		 $registerIds = DB::table('academic_student_register_courses');
        
         if ($term){
            $registerIds->where('term_id',$term->id);
        }
        if ($year){
            $registerIds->where('academic_year_id',$year->id);
        }
        if (request()->course_id){
            $registerIds->where('course_id',request()->course_id);
        }
       
        
        $registerIds = $registerIds->pluck('student_id')->toArray();
        // dd($registerIds);
        

        $query = DB::table('students')->select(
                'id', 'code', 'set_number', 'name', 'level_id', 'division_id',
                DB::raw('id as student_id'),
                DB::raw($term->id.' as term_id'),
                DB::raw($year->id.' as academic_year_id'),
                DB::raw('(select name from academic_years where academic_years.id = academic_year_id) as academic_year_name'),
                DB::raw('(select name from terms where terms.id = term_id) as term_name'),
                DB::raw('(select name from levels where levels.id = level_id) as level_name'),
                DB::raw('(select name from divisions where divisions.id = division_id) as division_name'),
                DB::raw('(select final_degree from academic_student_courses_result where student_id = students.id and term_id='.$term->id.' and academic_year_id='.$year->id.' and course_id='.request()->course_id.') as final_degree '),
                DB::raw('(select work_year_degree from academic_student_courses_result where student_id = students.id and term_id='.$term->id.' and academic_year_id='.$year->id.' and course_id='.request()->course_id.') as work_year_degree '),
                DB::raw('(select mid_degree from academic_student_courses_result where student_id = students.id and term_id='.$term->id.' and academic_year_id='.$year->id.' and course_id='.request()->course_id.') as mid_degree '),
                DB::raw('(select final_tahrery_degree from academic_student_courses_result where student_id = students.id and term_id='.$term->id.' and academic_year_id='.$year->id.' and course_id='.request()->course_id.') as final_tahrery_degree '),
                DB::raw('(select amly_degree from academic_student_courses_result where student_id = students.id and term_id='.$term->id.' and academic_year_id='.$year->id.' and course_id='.request()->course_id.') as amly_degree '),
                DB::raw('(select gpa from academic_student_courses_result where student_id = students.id and term_id='.$term->id.' and academic_year_id='.$year->id.' and course_id='.request()->course_id.') as gpa '),
                DB::raw('(select gpa_word from academic_student_courses_result where student_id = students.id and term_id='.$term->id.' and academic_year_id='.$year->id.' and course_id='.request()->course_id.') as gpa_word '),
                DB::raw('(select date from academic_student_courses_result where student_id = students.id and term_id='.$term->id.' and academic_year_id='.$year->id.' and course_id='.request()->course_id.') as date '),
                DB::raw('(select course_id from academic_student_courses_result where student_id = students.id and term_id='.$term->id.' and academic_year_id='.$year->id.' and course_id='.request()->course_id.') as course_id '),
                DB::raw('(select name from academic_student_courses_result, academic_courses where academic_courses.id=academic_student_courses_result.course_id and student_id = students.id and term_id='.$term->id.' and academic_year_id='.$year->id.' and course_id='.request()->course_id.') as course_name '),
                DB::raw('(select large_degree from academic_student_courses_result, academic_courses where academic_courses.id=academic_student_courses_result.course_id and student_id = students.id and term_id='.$term->id.' and academic_year_id='.$year->id.' and course_id='.request()->course_id.') as large_degree '),
                DB::raw('(select small_degree from academic_student_courses_result, academic_courses where academic_courses.id=academic_student_courses_result.course_id and student_id = students.id and term_id='.$term->id.' and academic_year_id='.$year->id.' and course_id='.request()->course_id.') as small_degree '),
                DB::raw('(select code from academic_student_courses_result, academic_courses where academic_courses.id=academic_student_courses_result.course_id and student_id = students.id and term_id='.$term->id.' and academic_year_id='.$year->id.' and course_id='.request()->course_id.') as course_code ')
                )->whereIN('students.id',$registerIds)->orderby('set_number');

        $query = $query->whereRaw('(select count(id) from academic_student_register_courses where student_id = students.id and term_id='.$term->id.' and academic_year_id='.$year->id.' and course_id='.request()->course_id.' ) > 0');

        // if (request()->level_id > 0)
        //     $query = $query->where('level_id', request()->level_id);


		$response = $query->paginate(300);

		// add result to db
		foreach($response as $item) {
			if (!$item->course_id) {
				$item->course_id = optional($course)->id;
				$item->course_code = optional($course)->code;
				$item->course_name = optional($course)->name;
				$item->large_degree = optional($course)->large_degree;
			}
		}

        return $response;
    }
    
     /**
     * add the result of student if not exist
     * or update on it if it exist
     * @param Request $request
     * @return type
     */
    public function update(Request $request) {
        
        $result = $request->result;
        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();
        
        // $year = DB::table('academic_years')->where('id',$request->year_id)->first();
        // $term = DB::table('terms')->where('id',$request->term_id)->first();

        try {
            foreach($result as $item) {
                $student = Student::FindOrFail($item['student_id']);
                $item['date'] = date('Y-m-d');
                $row = StudentResult::query()
                        ->where('student_id', $item['student_id'])
                        ->where('course_id', $item['course_id'])
                        ->where('academic_year_id', $year->id)
                        ->where('term_id', $term->id)
                        ->first();
                if ($row) {
                    $row->update($item);
                } else {
                    $row = StudentResult::create($item);
                }
                
                // if(optional($row)->final_tahrery_degree == null || optional($row)->final_tahrery_degree == ''){
                //  optional($row)->final_tahrery_degree = 0;
                // }
                // if(optional($row)->mid_degree == null || optional($row)->mid_degree == '' ){
                //     optional($row)->mid_degree = 0;
                // }
                // if(optional($row)->work_year_degree == null || optional($row)->work_year_degree == ''){
                //     optional($row)->work_year_degree = 0;
                // }
              
                
                $row->final_degree = optional($row)->final_tahrery_degree ?? 0 + optional($row)->mid_degree ?? 0 + optional($row)->work_year_degree ?? 0 ;
                $row->update();
                  
            
                $row->calculateCourseGpa();

                if($row->final_tahrery_degree != null)
                $student->startCalculateGpa($term->id);
              
            }

            watch(__("assign result for the students "), "fa fa-calendar");
            return responseJson(1, __('done'));
        } catch (Exception $exc) {
            return responseJson(0, $exc->getMessage());
        }
    }
    
      /**
     * add the Sync result of student if not exist
     * @param Request $request
     * @return type
     */
    
    
    public function syncStudentResult(Request $request) {
        
        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();
        
        $student_result = DB::table('academic_student_courses_result')
                                ->where('academic_year_id',$year->id)
                                ->where('term_id',$term->id)
                                ->select(DB::raw('(select code from students where students.id = academic_student_courses_result.student_id) as student_code'),
                                         DB::raw('(select code from academic_courses where academic_courses.id = academic_student_courses_result.course_id) as course_code'),
                                         'final_degree','gpa_word')->get();

        
        
        return response()->Json(['data' => $student_result]);
        
    }
     public function syncStudentCGPA(Request $request) {
        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();
        $students = Student::all();
        $allStudentCGPA = [];
        
        
        foreach($students as $student){
            
            $student_gpa_fasly = StudentGpa::where('student_id',$student->id)->where('term_id',2)->first()->gpa ?? ''; 
              $numberParts = explode('.', $student_gpa_fasly);
                $student_gpa_fasly = $numberParts[0];
                if (count($numberParts)>1 && 2 > 0) {
                    $student_gpa_fasly .= '.';
                    $student_gpa_fasly .= substr($numberParts[1], 0, 2);
                }
                
                
            $numberParts = explode('.', $student->getCGPA());
            $CGPA = $numberParts[0];
            if (count($numberParts)>1 && 2 > 0) {
                $CGPA .= '.';
                $CGPA .= substr($numberParts[1], 0, 2);
            }
            
            array_push($allStudentCGPA, ['code' => $student->code,'fasly'=> $student_gpa_fasly,'CGPA'=> $CGPA]);
        }

        
        
        
        return response()->Json(['data' => $allStudentCGPA]);
        
    }


   





}
