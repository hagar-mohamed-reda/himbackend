<?php

namespace Modules\Academic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Academic\Entities\CoursePrerequsite;
use Modules\Academic\Entities\StudentResult;
use Modules\Academic\Entities\Student;
use Modules\Academic\Entities\Course;
use Modules\Academic\Entities\StudentGpa;
use Modules\Student\Entities\Student as StudentOrigin;
use Modules\Account\Entities\AccountSetting;
use Modules\Settings\Entities\AcademicYear;
use Modules\Settings\Entities\Term;

use DB;


class ReportController extends Controller
{
    /**
     * return list of courses
     * @return Response
     */
    public function getResult()
    {
        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();
        //request()->courses = "";

        $query = DB::table('students')
                ->join('academic_student_courses_result', 'academic_student_courses_result.student_id', '=', 'students.id')
                ->where('term_id', 1)
                ->where('academic_year_id', $year->id)
                ->select(
                'code', 'set_number', 'name', 'division_id', 'final_degree','mid_degree','work_year_degree','amly_degree','final_tahrery_degree','final_degree','gpa','gpa_word',
                DB::raw('students.id as student_id'),
                DB::raw('students.id as id'),
                DB::raw('(select academic_courses.name from academic_courses where course_id = academic_courses.id) as course_name'),
                DB::raw('(select academic_courses.code from academic_courses where course_id = academic_courses.id) as course_code'),
                DB::raw('(select credit_hour from academic_courses where course_id = academic_courses.id) as hours'),
                DB::raw('(select large_degree from academic_courses where course_id = academic_courses.id) as large_degree'))->orderby('students.set_number');
                

        if (request()->levels > 0)
            $query = $query->whereIn('students.level_id', request()->levels);

        if (request()->divisions > 0)
            $query = $query->whereIn('division_id', request()->divisions);

        if (request()->courses)
            $query = $query->whereIn('course_id', request()->courses);

        if (request()->student_id > 0)
            $query->where('student_id', request()->student_id);

	$response = $query->paginate(2000);
// 	dd($response);
	

        return  $response;
    }
    
    public function getResultAdvertsment()
    {
        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();
        //request()->courses = "";

        $query = DB::table('students')
                ->join('academic_student_courses_result', 'academic_student_courses_result.student_id', '=', 'students.id')
                ->where('academic_student_courses_result.term_id', $term->id)
                ->where('academic_student_courses_result.academic_year_id', $year->id)
                ->select(
                'students.code', 'students.set_number', 'students.name', 'students.division_id','academic_student_courses_result.final_degree','academic_student_courses_result.mid_degree','academic_student_courses_result.work_year_degree','academic_student_courses_result.final_tahrery_degree','academic_student_courses_result.final_degree','academic_student_courses_result.gpa_word',
                // DB::raw('(select academic_degree_map.key from academic_degree_map where course_id = academic_courses.id) as kanon')

              
                DB::raw('(select academic_student_gpa.gpa from academic_student_gpa where academic_student_gpa.student_id = students.id) as gpa_term'),


                DB::raw('(select academic_student_register_courses.gpa from academic_student_register_courses where course_id = 1 and student_id =1) as principles_of_law'),
                DB::raw('(select academic_student_register_courses.gpa from academic_student_register_courses where course_id = 2 and student_id =1) as principles_of_management'),
                DB::raw('(select academic_student_register_courses.gpa from academic_student_register_courses where course_id = 3 and student_id =1) as economics'),
                DB::raw('(select academic_student_register_courses.gpa from academic_student_register_courses where course_id = 5 and student_id =1) as principles_of_accounting'),
                DB::raw('(select academic_student_register_courses.gpa from academic_student_register_courses where course_id = 4 and student_id =1) as english')


                )->orderby('students.name');
                

      

    	$responses = $query->paginate(20);

        return view('report.result_advertisment', compact('responses'));

	
	

        // return $response;
    }
    
     public function getStudentResult(Request $request)
    {
        
        if($request->year_id && $request->term_id && $request->student_id){
        $year_id = $request->year_id;
        $term_id = $request->term_id;
        
        $student = Student::find($request->student_id);
        $actualRegisterHours = $student->register_hours;  //الساعات المحققة
        $registerHours = $student->actual_register_hours;  // الساعات المسجلة
        // $CGPA = $student->getGpa();  //  التراكمي
        
        $numberParts = explode('.', $student->getCGPA());
        $CGPA = $numberParts[0];
        if (count($numberParts)>1 && 2 > 0) {
            $CGPA .= '.';
            $CGPA .= substr($numberParts[1], 0, 2);
        }

        $year = AcademicYear::find($year_id);
        $term = Term::find($term_id);
        
        $studentInfo = DB::table('students')
        ->where('id',$request->student_id)
        ->select('code','birthdate','registeration_date','qualification_date','students.name',
                DB::raw('(select levels.name from levels where level_id = levels.id) as level_name'),
                DB::raw('(select qualifications.name from qualifications where qualification_id = qualifications.id) as qualification_name'),
                DB::raw('(select registeration_status.name from registeration_status where registration_status_id = registeration_status.id) as registeration_status')
            )->get();

        $studentGpaFasly = StudentGpa::where('academic_year_id',$year_id)->where('term_id',$term_id)
                                ->where('student_id',$request->student_id)->first();
                                
        $numberParts = explode('.', $studentGpaFasly->gpa);
        $studentGpaFasly = $numberParts[0];
        if (count($numberParts)>1 && 2 > 0) {
            $studentGpaFasly .= '.';
            $studentGpaFasly .= substr($numberParts[1], 0, 2);
        }

        $query = DB::table('students')
                ->join('academic_student_courses_result', 'academic_student_courses_result.student_id', '=', 'students.id')
                ->where('term_id', $term_id)
                ->where('academic_year_id', $year_id)
                ->select(
                'code', 'set_number', 'name', 'division_id', 'final_degree','mid_degree','work_year_degree','amly_degree','final_tahrery_degree','final_degree','gpa','gpa_word',
                DB::raw('students.id as student_id'),
                DB::raw('students.id as id'),
          

                DB::raw('(select academic_courses.name from academic_courses where course_id = academic_courses.id) as course_name'),
                DB::raw('(select academic_courses.code from academic_courses where course_id = academic_courses.id) as course_code'),
                DB::raw('(select credit_hour from academic_courses where course_id = academic_courses.id) as hours'),
                DB::raw('(select large_degree from academic_courses where course_id = academic_courses.id) as large_degree'))->orderby('students.set_number');
                

        if (request()->levels > 0)
            $query = $query->whereIn('students.level_id', request()->levels);

        if (request()->divisions > 0)
            $query = $query->whereIn('division_id', request()->divisions);

        if (request()->courses)
            $query = $query->whereIn('course_id', request()->courses);

        if (request()->student_id > 0)
            $query->where('student_id', request()->student_id);

	$response = $query->get();


        return  ['registerCourses' => $response, 'studentInfo' => $studentInfo, 'student_gpa_fasly' => $studentGpaFasly ?? '',
        'year' => $year, 'term' => $term, 'ActualRegisterHours' => $actualRegisterHours, 'registerHours' => $registerHours,'CGPA' => $CGPA];
        }else{
            return null;
        }
        
    }
    
      public function getAllStudentsResult(Request $request)
    {
        
  
        $year_id = $request->year_id;
        $division_id = $request->division_id;
        $students = Student::where('division_id',$division_id)
        ->select(['*', DB::raw('set_number IS NULL AS setNumberNull')])
        ->orderBy('setNumberNull')
        ->orderBy('set_number')->get();
        
        $terms = Term::get();
        $arrayPush = [];
        foreach($students as $student){
        $actualRegisterHours = $student->register_hours;  //الساعات المحققة
        $registerHours = $student->actual_register_hours;  // الساعات المسجلة
        
        $numberParts = explode('.', $student->getCGPA());
        $CGPA = $numberParts[0];
        if (count($numberParts)>1 && 2 > 0) {
            $CGPA .= '.';
            $CGPA .= substr($numberParts[1], 0, 2);
        }
        //   if($student->id == 568)
        //     dd($CGPA);

        $year = AcademicYear::find($year_id);

        $studentInfo = DB::table('students')
        ->where('id',$student->id)
        ->select('code','birthdate','registeration_date','qualification_date','students.name','acceptance_date','case_constraint_id',
                DB::raw('(select levels.name from levels where level_id = levels.id) as level_name'),
                DB::raw('(select qualifications.name from qualifications where qualification_id = qualifications.id) as qualification_name'),
                DB::raw('(select registeration_status.name from registeration_status where registration_status_id = registeration_status.id) as registeration_status'),
                DB::raw('(select case_constraints.name from case_constraints where case_constraint_id = case_constraints.id) as case_constraint_name')
            )->get();

        $studentGpaFasly1 = StudentGpa::where('academic_year_id',$year_id)->where('term_id',1)
                                ->where('student_id',$student->id)->first();

        $query1 = DB::table('students')
                ->join('academic_student_courses_result', 'academic_student_courses_result.student_id', '=', 'students.id')
                ->where('term_id', 1)
                ->where('academic_year_id', $year_id)
                ->where('student_id', $student->id)
                ->select(
                'code', 'set_number', 'name', 'division_id', 'final_degree','mid_degree','work_year_degree','amly_degree','final_tahrery_degree','final_degree','gpa','gpa_word',
                DB::raw('students.id as student_id'),
                DB::raw('students.id as id'),
                DB::raw('(select academic_courses.name from academic_courses where course_id = academic_courses.id) as course_name'),
                DB::raw('(select academic_courses.code from academic_courses where course_id = academic_courses.id) as course_code'),
                DB::raw('(select credit_hour from academic_courses where course_id = academic_courses.id) as hours'),
                DB::raw('(select large_degree from academic_courses where course_id = academic_courses.id) as large_degree'))->orderby('students.set_number');

	    $response1 = $query1->get();
	    
	     $studentGpaFasly2 = StudentGpa::where('academic_year_id',$year_id)->where('term_id',2)
                                ->where('student_id',$student->id)->first();
                                
        if($studentGpaFasly2){
            $numberParts = explode('.', $studentGpaFasly2->gpa);
            $studentGpaFasly2 = $numberParts[0];
            if (count($numberParts)>1 && 2 > 0) {
                $studentGpaFasly2 .= '.';
                $studentGpaFasly2 .= substr($numberParts[1], 0, 2);
            }
            // $studentGpaFasly2 =  floor($studentGpaFasly2->gpa) . substr(str_replace(floor($studentGpaFasly2->gpa), '', $studentGpaFasly2->gpa), 0, 3);
        }

       

        $query2 = DB::table('students')
                ->join('academic_student_courses_result', 'academic_student_courses_result.student_id', '=', 'students.id')
                ->where('term_id', 2)
                ->where('academic_year_id', $year_id)
                ->where('student_id', $student->id)
                ->select(
                'code', 'set_number', 'name', 'division_id', 'final_degree','mid_degree','work_year_degree','amly_degree','final_tahrery_degree','final_degree','gpa','gpa_word',
                DB::raw('students.id as student_id'),
                DB::raw('students.id as id'),
                DB::raw('(select academic_courses.name from academic_courses where course_id = academic_courses.id) as course_name'),
                DB::raw('(select academic_courses.code from academic_courses where course_id = academic_courses.id) as course_code'),
                DB::raw('(select credit_hour from academic_courses where course_id = academic_courses.id) as hours'),
                DB::raw('(select large_degree from academic_courses where course_id = academic_courses.id) as large_degree'))->orderby('students.set_number');

	    $response2 = $query2->get();


        $newCompete = ['registerCoursesTerm1' => $response1,'registerCoursesTerm2' => $response2, 'studentInfo' => $studentInfo, 'student_gpa_fasly_Term1' => $studentGpaFasly1->gpa ?? '','student_gpa_fasly_Term2' => $studentGpaFasly2 ?? '', 
        'year' => $year, 'ActualRegisterHours' => $actualRegisterHours, 'registerHours' => $registerHours,'CGPA' => $CGPA]; 
        
        array_push($arrayPush, $newCompete);

        }
        
        return $arrayPush;
        
      
    }

  public function getStudentStatus(Request $request)
    {
        
        if($request->year_id && $request->student_id)
        {
            $year_id = $request->year_id;
            $student = Student::find($request->student_id);


            $actualRegisterHours = $student->register_hours;  //الساعات المحققة
            $registerHours = $student->actual_register_hours;  // الساعات المسجلة
            $numberParts = explode('.', $student->getCGPA());
            $CGPA = $numberParts[0];
            if (count($numberParts)>1 && 2 > 0) {
                $CGPA .= '.';
                $CGPA .= substr($numberParts[1], 0, 2);
            }  //  التراكمي
            $year = AcademicYear::find($year_id);

            $arrayPush = [];

            $studentInfo = DB::table('students')
            ->where('id',$request->student_id)
            ->select('code','birthdate','registeration_date','grade','case_constraint_id','qualification_date','students.name',
                    DB::raw('(select levels.name from levels where level_id = levels.id) as level_name'),
                    DB::raw('(select nationalities.name from nationalities where nationality_id = nationalities.id) as nationality_name'),
                    DB::raw('(select divisions.name from divisions where division_id = divisions.id) as division_type'),

                    DB::raw('(select case_constraints.name  from case_constraints where case_constraint_id = case_constraints.id) as case_constraint'),
                    DB::raw('(select qualifications.name  from qualifications 
                    where qualification_id = qualifications.id) as qualification_name'),
                    DB::raw('(select qualifications.grade  from qualifications 
                    where qualification_id = qualifications.id) as qualification_grade'),
                    DB::raw('(select registeration_status.name from registeration_status 
                    where registration_status_id = registeration_status.id) as registeration_status')
                )->get();
    
            $studentGpaFasly = StudentGpa::where('academic_year_id',$year_id)
                                    ->where('student_id',$request->student_id)->get();


    //nationalities
            $query = DB::table('students')
                    ->join('academic_student_courses_result', 'academic_student_courses_result.student_id', 
                    '=', 'students.id')
                    ->where('academic_year_id', $year_id)
                    ->select(
                    'code', 'set_number', 'name', 'division_id', 'term_id' , 'final_degree','mid_degree','work_year_degree',
                    'amly_degree','final_tahrery_degree','final_degree','gpa','gpa_word',
                    DB::raw('students.id as student_id'),
                    DB::raw('students.id as id'),
              
    
                    DB::raw('(select academic_courses.name from academic_courses where course_id = academic_courses.id) as course_name'),
                    DB::raw('(select academic_courses.code from academic_courses where course_id = academic_courses.id) as course_code'),
                    DB::raw('(select credit_hour from academic_courses where course_id = academic_courses.id) as hours'),
                    DB::raw('(select large_degree from academic_courses where course_id = academic_courses.id) as large_degree'))
                    ->orderby('students.set_number');
                    


            if (request()->levels > 0)
                $query = $query->whereIn('students.level_id', request()->levels);
    
            if (request()->divisions > 0)
                $query = $query->whereIn('division_id', request()->divisions);
    
            if (request()->courses)
                $query = $query->whereIn('course_id', request()->courses);
    
            if (request()->student_id > 0)
                $query->where('student_id', request()->student_id);
    
          $response = $query->get();
    
            return  ['registerCourses' => $response, 'studentInfo' => $studentInfo, 'student_gpa_fasly' => $studentGpaFasly ?? '',
            'year' => $year, 'ActualRegisterHours' => $actualRegisterHours, 'registerHours' => $registerHours,'CGPA' => $CGPA];
            }else{
                return null;
        }
            
    }
}
