<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Account\Entities\Student;
use Modules\Academic\Entities\Student as StudentAcademic;
use Modules\Academic\Entities\Course;
use Modules\Student\Entities\Theater;
use Modules\Student\Entities\Commission;
use Modules\Student\Http\Requests\StudentRequest;
use Modules\Settings\Entities\QualificationTypes;
use Modules\Settings\Entities\StudentCodeSeries;
use Modules\Settings\Entities\AcademicYear;
use Modules\Adminsion\Entities\Application;
use Modules\Adminsion\Http\Controllers\validation\ApplicationValidation;
use Modules\Adminsion\Http\Controllers\ApplicationStoreController;
use Illuminate\Support\Facades\Auth;
use Modules\Account\Entities\StudentOldBalance;
use DB;
use Modules\Divisions\Entities\Division;
use Modules\Divisions\Entities\Level;
use App\Term;
use Modules\Academic\Entities\CoursePrerequsite;
use Modules\Academic\Entities\StudentRegisterCourse;
use Modules\Academic\Entities\StudentGroup;
use Modules\Academic\Entities\StudentSection;
use Modules\Academic\Entities\DegreeMap;
use Modules\Account\Entities\AccountSetting;
use Modules\Student\Entities\StudentCaseConstraint;


class ReportController extends Controller
{

    /**re
     * Display a listing of the resource.قث
     * @return Response
     */
    public function report1(Request $request)
    {

        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();
        $division = Division::where('id', request()->division_id)->first();
        $level = Level::where('id', request()->level_id)->first();
        $query = Student::where('set_number', '!=', null)->orderBy('name')->get();
        // $theater = Theater::where('id', $commission->theater_id)->first();
        $theater = null;

        if ($request->commission_id > 0)
            $commissions = Commission::where('id', $request->commission_id)->get();
        else
            $commissions = Commission::where('division_id', $request->division_id)->where('commission_type_id', 1)->get();




        return view('report.report1', compact('commissions', 'theater', 'level', 'division', 'year', 'term'));
    }



    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function report2(Request $request)
    {
        $query = Student::with(['academicYear', 'qualification', 'level', 'registerationStatus', 'department']);

        $academicYear = AcademicYear::find(request()->academic_year_id);
        $level = Level::find(request()->level_id);
        $division = Division::find(request()->division_id);

        if (request()->nationality_id > 0)
            $query->where('nationality_id', request()->nationality_id);

        if (request()->academic_years_id > 0)
            $query->where('academic_years_id', request()->academic_years_id);

        if (request()->level_id > 0)
            $query->where('level_id', request()->level_id);

        if (request()->qualification_types_id > 0)
            $query->where('qualification_types_id', request()->qualification_types_id);

        if (request()->search_key) {
            $query
                ->where('name', 'like', '%' . $request->search_key . '%')
                ->orWhere('code', 'like', '%' . $request->search_key . '%')
                ->orWhere('id', '=',  $request->search_key)
                ->orWhere('phone_1', 'like', '%' . $request->search_key . '%')
                ->orWhere('national_id', 'like', '%' . $request->search_key . '%');
        }

        $students = $query->orderby('name', 'ASC')->get();

        return view('report.report2', compact('students', 'level', 'division', 'academicYear'));
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function report3(Request $request) {
        // return $request->all();
        $query = Student::with(['academicYear', 'qualification', 'level', 'registerationStatus', 'department']);

        $academicYear = AcademicYear::find(request()->academic_year_id);
        $level = Level::find(request()->level_id);
        $division = Division::find(request()->division_id);

        if (request()->nationality_id > 0)
            $query->where('nationality_id', request()->nationality_id);


        if (request()->academic_year_id)
            $query->where('academic_years_id', request()->academic_year_id);

        if (request()->gender == 0 && request()->gender != null)
            $query->where('gender', 'female');

        if (request()->gender == 1 && request()->gender != null)
            $query->where('gender', 'male');

        if (request()->isVaccinated  == 1 || request()->isVaccinated == 0 && request()->isVaccinated != null)
            $query->where('iscorona', request()->isVaccinated);



        if (request()->division_id > 0)
            $query->where('division_id', request()->division_id);

        if (request()->qualification_id > 0)
            $query->where('qualification_id', request()->qualification_id);

        if (request()->created_at > 0) {
            $myDate = \Carbon\Carbon::now();
            $myDateParse = \Carbon\Carbon::parse($myDate)->format('Y-m-d');
            $query->whereDate('created_at', $myDateParse);
        }

        if (request()->level_id > 0)
            $query->where('level_id', request()->level_id);


        if (request()->qualification_types_id > 0)
            $query->where('qualification_types_id', request()->qualification_types_id);

        if (request()->is_adult == 1) {
            $newDateTime = \Carbon\Carbon::now()->subYears(18);
            $newDateTimeParse = \Carbon\Carbon::parse($newDateTime)->format('Y-m-d');
            $query->whereDate('birthdate', '<', $newDateTimeParse);
        }
        if (request()->is_adult == 2) {
            $newDateTime = \Carbon\Carbon::now()->subYears(18);
            $newDateTimeParse = \Carbon\Carbon::parse($newDateTime)->format('Y-m-d');
            $query->whereDate('birthdate', '>', $newDateTimeParse);
        }

        if (request()->from_date > 0 && request()->to_date > 0) {
            $query->whereBetween('birthdate', [request()->from_date, request()->to_date]);
        }

         if(isset(request()->case_constraint_id))
         {
            $query->where('case_constraint_id',request()->case_constraint_id);
         }

        if (request()->search_key) {
            $query
                ->where('name', 'like', '%' . $request->search_key . '%')
                ->orWhere('code', 'like', '%' . $request->search_key . '%')
                ->orWhere('id', '=',  $request->search_key)
                ->orWhere('phone_1', 'like', '%' . $request->search_key . '%')
                ->orWhere('national_id', 'like', '%' . $request->search_key . '%');
        }

        $students = $query->orderby('name', 'ASC')->get();

        return view('report.report3', compact('students', 'level', 'division', 'academicYear'));
    }
    public function report11(Request $request)
    {
        $query = Student::with(['academicYear', 'qualification', 'level', 'registerationStatus', 'department'])
            ->where('gender', 'male')->where('case_constraint_id', 2);



        $academicYear = AcademicYear::find(request()->academic_year_id);
        $level = Level::find(request()->level_id);
        $division = Division::find(request()->division_id);


        $students = $query->orderby('triple_number_order')->get();
        // dd($students);

        $governments = DB::select('SELECT * FROM governments WHERE id IN (SELECT government_id FROM students WHERE is_application = 0 and government_id is NOT null and gender != "female") ');

        $birthAddresses = DB::table('students')->where('gender', '=', 'male')->where('case_constraint_id', 2)->where('triple_number_order', '!=', null)->select('triple_number_order')->groupby('triple_number_order')->orderby('triple_number_order')->get();

        return view('report.report11', compact('students', 'level', 'division', 'academicYear', 'governments', 'birthAddresses'));
    }
    public function report15(Request $request)
    {

        $registerIds = DB::table('academic_student_register_courses');

        if (request()->level_id) {
            $registerIds->where('level_id', request()->level_id);
        }
        if (request()->term_id) {
            $registerIds->where('term_id', request()->term_id);
        }
        if (request()->academic_year_id) {
            $registerIds->where('academic_year_id', request()->academic_year_id);
        }

        $registerIds = $registerIds->pluck('student_id')->toArray();


        $query = Student::with(['academicYear', 'qualification', 'level', 'registerationStatus', 'department'])
            ->where('gender', 'male')->whereIn('id', $registerIds);



        $academicYear = AcademicYear::find(request()->academic_year_id);
        $level = Level::find(request()->level_id);
        $division = Division::find(request()->division_id);


        $students = $query->orderby('triple_number_order')->get();



        $governments = DB::select('SELECT * FROM governments WHERE id IN (SELECT government_id FROM students WHERE is_application = 0 and government_id is NOT null and gender != "female") ');

        $birthAddresses = DB::table('students')->where('gender', '=', 'male')->where('case_constraint_id', 2)->where('triple_number_order', '!=', null)->select('triple_number_order')->groupby('triple_number_order')->orderby('triple_number_order')->get();

        // dd($birthAddresses);

        return view('report.report15', compact('students', 'level', 'division', 'academicYear', 'governments', 'birthAddresses'));
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function report4(Request $request)
    {
        // $query = Student::with(['academicYear', 'qualification', 'level', 'registerationStatus', 'department']);


        $academicYear = AcademicYear::find(request()->academic_year_id);
        $level = Level::find(request()->level_id);
        $division = Division::find(request()->division_id);
        $section = '';

        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();

        // $query = StudentRegisterCourse::join('students', 'posts.user_id', '=', 'users.id');
        $query = StudentRegisterCourse::select('academic_student_register_courses.*')
            ->join('students', 'academic_student_register_courses.student_id', '=', 'students.id');
        // dd($query);

        $query->where('term_id', $term->id);
        $query->where('academic_year_id', $year->id);

        if (request()->academic_years_id > 0)
            $query->where('academic_years_id', request()->academic_years_id);

        if (request()->term_id) {
            $query->where('term_id', request()->term_id);
        }

        if (request()->level_id > 0)
            $query->where('academic_student_register_courses.level_id', request()->level_id);


        if (request()->division_id > 0)
            $query->where('academic_student_register_courses.division_id', request()->division_id);



        if (request()->group_id) {
            $query->where('group_id', request()->group_id);
        }
        if (request()->course_id) {
            $query->where('course_id', request()->course_id);
        }
        if (request()->section_id) {
            $query->where('section_id', request()->section_id);
            $section = StudentSection::FindOrFail($request->section_id);
        }
        $course = Course::FindOrFail($request->course_id);
        $group = StudentGroup::FindOrFail($request->group_id);


        $responses = $query->orderby('students.name')->get();
        // 	dd($responses);

        return view('report.report4', compact('responses', 'level', 'division', 'academicYear', 'course', 'group', 'section'));
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function report5(Request $request)
    {

        $query = Student::with(['academicYear', 'qualification', 'level', 'registerationStatus', 'department']);

        $academicYear = AcademicYear::find(request()->academic_year_id);
        $level = Level::find(request()->level_id);
        $division = Division::find(request()->division_id);

        if (request()->academic_years_id > 0)
            $query->where('academic_years_id', request()->academic_years_id);

        if (request()->level_id > 0)
            $query->where('level_id', request()->level_id);

        if (request()->division_id > 0)
            $query->where('division_id', request()->division_id);

        if (request()->is_application == 0)
            $query->where('is_application', 0);

        if (request()->is_application == 1)
            $query->where('is_application', 1);


        $students = $query->orderby('name', 'ASC')->get();
        // foreach($students->chunk(3) as $row)
        // foreach($row as $user){
        //                  return $user;
        // }

        // return $students;

        return view('report.report5', compact('students', 'level', 'division', 'academicYear'));
    }

    public function report6(Request $request)
    {
        $query = Student::query();

        $academicYear = AcademicYear::find(request()->academic_year_id);
        $level = Level::find(request()->level_id);
        $division = Division::find(request()->division_id);

        if (request()->nationality_id > 0)
            $query->where('nationality_id', request()->nationality_id);

        if (request()->academic_years_id > 0)
            $query->where('academic_years_id', request()->academic_years_id);

        if (request()->division_id > 0)
            $query->where('division_id', request()->division_id);

        if (request()->qualification_id > 0)
            $query->where('qualification_id', request()->qualification_id);

        if (request()->is_application > 0)
            $query->where('is_application', request()->is_application);

        if (request()->created_at > 0)
            $query->whereDate('created_at', request()->created_at);

        if (request()->level_id > 0)
            $query->where('level_id', request()->level_id);

        if (request()->qualification_types_id > 0)
            $query->where('qualification_types_id', request()->qualification_types_id);

        if (request()->search_key) {
            $query
                ->where('name', 'like', '%' . $request->search_key . '%')
                ->orWhere('code', 'like', '%' . $request->search_key . '%')
                ->orWhere('id', '=',  $request->search_key)
                ->orWhere('phone_1', 'like', '%' . $request->search_key . '%')
                ->orWhere('national_id', 'like', '%' . $request->search_key . '%');
        }

        $students = $query->orderby('name', 'ASC')->with(['academicYear', 'qualification', 'level', 'registerationStatus', 'department'])->get();

        return view('report.report6', compact('students', 'level', 'division', 'academicYear'));
    }

    public function report7(Request $request)
    {
        $year = AccountSetting::getCurrentAcademicYear();
        $course = Course::where('id', $request->course_id)->first();
        $division = Division::find($request->division_id);
        $level = Level::find(request()->level_id);
        $term = DB::table('terms')->where('id', request()->term_id)->first();


        $commissions = DB::table('commissions')->get();
        // $theater = Theater::where('id', $commission->id)->first();

        // dd($request->level_id);


        return view('report.report7', compact('level', 'year', 'term', 'division', 'course', 'commissions'));
    }

    public function report8(Request $request)
    {

        $students = StudentAcademic::query()
            ->with([
                'level', 'division', 'case_constraint',
                'constraint_status', 'installments',
                'payments', 'registerationStatus',
                'nationality', 'discount_requests', 'balanceResets',
                'courses'
            ])->where('commission_id', '=', $request->commission_id)->orderBy('name')->get();
        // return $students;

        return view('report.report8', compact('students'));
    }
    public function fetchDataReport8(Request $request)
    {
        if ($request->ajax()) {
            $students = StudentAcademic::query()
                ->with([
                    'level', 'division', 'case_constraint',
                    'constraint_status', 'installments',
                    'payments', 'registerationStatus',
                    'nationality', 'discount_requests', 'balanceResets',
                    'courses'
                ])->where('level_id', '=', $request->level_id)->orderBy('name')->paginate(100);
            return view('report.fetch_data_report8', compact('students'))->render();
        }
    }

    public function report9(Request $request)
    {
        $student = StudentAcademic::query()
            ->with([
                'level', 'division', 'case_constraint',
                'constraint_status', 'installments',
                'payments', 'registerationStatus',
                'nationality', 'discount_requests', 'balanceResets',
                'courses'
            ])->where('id', '=', $request->student_id)->get();

        // return $student;
        return view('report.report9', compact('student'));
    }

    public function report13(Request $request)
    {
        //  $query = StudentRegisterCourse::query()
        //   ->with(['student']);


        // $term = DB::table('terms')->get();
        // $level = Level::find(request()->level_id);
        // $division = Division::find(request()->division_id);        





        // // return $student;
        // return view('report.report13',compact('students' , 'level', 'division', 'term'));
    }


    public function getResultAdvertsment(Request $request)
    {
        // dd(request()->year_id);
        $academicYear = AcademicYear::find(request()->year_id);
        $term = DB::table('terms')->where('id', request()->term_id)->first();

        $division = Division::where('id', request()->division_id)->get();

        $courses = null;

        // $students = StudentAcademic::get();
        // foreach($students as $student){
        //     $student->startCalculateGpa();

        // }


        $registerIds = DB::table('academic_student_register_courses');

        if (request()->term_id) {
            $registerIds->where('term_id', request()->term_id);
        }
        if (request()->academic_year_id) {
            $registerIds->where('academic_year_id', request()->year_id);
        }

        if (request()->division_id) {
            $registerIds->where('division_id', request()->division_id);
        }


        $registerIds = $registerIds->pluck('student_id')->toArray();

        $query = StudentAcademic::query();
        $query->whereIN('id', $registerIds)->orderby('name');


        if (request()->division_id) {
            $courses = Course::where('division_id', request()->division_id)
                ->where('level_id', 1)->where('term', request()->term_id)->orderby('id')->get();
            $query->where('division_id', request()->division_id);
        }


        $responses = $query->paginate(2000);
        // 	dd($responses);


        return view('report.result_advertisment', compact('responses', 'courses', 'division', 'term', 'academicYear'));
    }

    public function getResultAdvertsmentShow(Request $request)
    {

        $academicYear = AcademicYear::find(request()->year_id);
        $term = DB::table('terms')->where('id', request()->term_id)->first();

        $division = Division::where('id', request()->division_id)->first();

        $courses = null;


        $registerIds = DB::table('academic_student_register_courses');

        if (request()->term_id) {
            $registerIds->where('term_id', request()->term_id);
        }
        if (request()->academic_year_id) {
            $registerIds->where('academic_year_id', request()->year_id);
        }

        if (request()->division_id) {
            $registerIds->where('division_id', request()->division_id);
        }


        $registerIds = $registerIds->pluck('student_id')->toArray();

        $query = StudentAcademic::query();
        $query->whereIN('id', $registerIds)->orderby('name');


        if (request()->division_id) {
            $courses = Course::where('division_id', request()->division_id)
                ->where('level_id', 1)->where('term', request()->term_id)->orderby('id')->get();
            $query->where('division_id', request()->division_id);
        }
        if (request()->government_id) {
            $query->where('government_id', request()->government_id);
        }


        $responses = $query->paginate(2000);

        return view('report.result_advertisment_show', compact('responses', 'courses', 'division', 'term', 'academicYear'));
    }

    public function getResultStatistics(Request $request)
    {
      
        $academic_year_id =request()->year_id;
        $term_id = request()->term_id;
        $degree_id = request()->degree_id;
      
        $courses = Course::where('level_id',request()->level_id)
                            ->where('term',request()->term_id)->where('division_id',request()->division_id)
                            ->get();

        return view('report.result_statistics',compact('courses','degree_id','academic_year_id','term_id'));

        return view('report.result_statistics', compact('courses', 'academic_year_id', 'term_id'));
    }
    public function getCoursesStatistics(Request $request)
    {
        $academic_year_id = request()->year_id;
        $term_id = request()->term_id;
        $degree_id = request()->degree_id;
        $degree = DegreeMap::find($degree_id);
        $courses = Course::where('level_id',request()->level_id)
                            ->where('term',request()->term_id)->where('division_id',request()->division_id)
                            ->get();
        // return $courses;
        return view('report.courses_statistics',compact('courses','degree','degree_id','academic_year_id','term_id'));
    }

    public function getResultAbsence(Request $request)
    {

        $academic_year_id = request()->year_id;
        $term_id = request()->term_id;
        $course_id = request()->course_id;

        $query = DB::table('students')
            ->join('academic_student_register_courses as register', 'register.student_id', '=', 'students.id')
            ->select('*', DB::raw('(select academic_courses.name from academic_courses where course_id = academic_courses.id) as course_name'))
            ->where('register.term_id', $term_id);

        if ($request->course_id)
            $query->where('register.course_id', $course_id);

        if ($request->attendance == 0)
            $query->where('register.gpa_word');

        if ($request->attendance == 1)
            $query->where('register.gpa_word', '!=', 'AB');

        if ($request->attendance == 2)
            $query->where('register.gpa_word', '=', 'AB');

        $students = $query->get();


        return view('report.result_absence', compact('students', 'academic_year_id', 'term_id'));
    }

    public function report16(Request $request)
    {

        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();
        $division = Division::where('id', request()->division_id)->first();
        $level = Level::where('id', request()->level_id)->first();

        $courses = null;

        $registerIds = DB::table('academic_student_register_courses');

        if (request()->term_id) {
            $registerIds->where('term_id', request()->term_id);
        }
        if (request()->year_id) {
            $registerIds->where('academic_year_id', request()->year_id);
        }

        if (request()->division_id) {
            $registerIds->where('division_id', request()->division_id);
        }

        $registerIds = $registerIds->pluck('student_id')->toArray();

        // $query = StudentAcademic::query();
        $query = StudentAcademic::with(['academicYear', 'qualification', 'level', 'registerationStatus', 'department']);

        $query->whereIN('id', $registerIds)->orderby('name');

        if (request()->division_id) {
            $courses = Course::where('division_id', request()->division_id)->orderby('id')->get();
            $query->where('division_id', request()->division_id);
        }

        $responses = $query->paginate(2000);

        return view('report.report16', compact('responses', 'courses', 'division', 'level'));
    }

    public function report17(Request $request)
    {


        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();

        $query = StudentRegisterCourse::query();

        $query->where('term_id', $term->id);
        $query->where('academic_year_id', $year->id);

        if (request()->division_id) {
            $query->where('division_id', request()->division_id);
        }
        if (request()->level_id) {
            $query->where('level_id', request()->level_id);
        }
        if (request()->term_id) {
            $query->where('term_id', request()->term_id);
        }
        if (request()->academic_year_id) {
            $query->where('academic_year_id', request()->academic_year_id);
        }
        if (request()->group_id) {
            $query->where('group_id', request()->group_id);
        }
        if (request()->course_id) {
            $query->where('course_id', request()->course_id);
        }
        if (request()->section_id) {
            $query->where('section_id', request()->section_id);
        }




        $responses = $query->get();


        return view('report.report17', compact('responses'));
    }

    public function report18(Request $request)
    {
        // dd($request);
        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();
        $course = null;
        $registerIds = DB::table('academic_student_register_courses');
        if (request()->term_id) {
            $registerIds->where('term_id', request()->term_id);
        }
        if (request()->academic_year_id) {
            $registerIds->where('academic_year_id', request()->academic_year_id);
        }
        if (request()->course_id) {
            $registerIds->where('course_id', request()->course_id);
            $course = Course::find(request()->course_id)->name;
        }
        if (request()->division_id) {
            $registerIds->where('division_id', request()->division_id);
        }
        $registerIds = $registerIds->pluck('student_id')->toArray();
        // dd($registerIds);
        $query = DB::table('students')->select(
            'students.id',
            'students.name as std_name',
            'code',
            'national_id',
            'phone_1',
            'set_number',
            'parent_phone',
            DB::raw('(select academic_student_register_courses.created_at from academic_student_register_courses where academic_student_register_courses.student_id = students.id ORDER BY academic_student_register_courses.created_at DESC LIMIT 1) as registeration_date'),
            DB::raw('(select governments.name from governments where students.government_id = governments.id ) as government_name'),
            DB::raw('(select levels.name from levels where students.level_id = levels.id ) as level_name'),
            DB::raw('(select divisions.name from divisions where students.division_id = divisions.id ) as division_name')
        );


        if (request()->division_id) {
            $query->where('division_id', request()->division_id);
        }
        if ($request->registered == 1) {
            $query->whereIn('students.id', $registerIds);
        } elseif ($request->registered == 0) {
            $query->whereNotIn('students.id', $registerIds);
        } else {
        }
        $responses = $query->orderby('std_name')->get();
        return view('report.report18', compact('responses', 'course'));
    }
    public function report19(Request $request)
    {

        // dd($request);

        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();

        $query = Student::query();


        if (request()->level_id) {
            $query->where('level_id', request()->level_id);
        }
        if (request()->division_id) {
            $query->where('division_id', request()->division_id);
        }


        if (request()->distributed == 1) {
            $query->where('commission_id', '!=', null);
            if (request()->commission_id) {
                $query->where('commission_id', request()->commission_id);
            }
        }
        if (request()->distributed == 0) {
            $query->where('commission_id', null);
        }








        $responses = $query->get();

        // 	dd($responses);


        return view('report.report19', compact('responses'));
    }

    public function report20(Request $request)
    {

        // dd($request);

        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();




        return view('report.report20');
    }

    public function report21(Request $request)
    {

        $registerIds = DB::table('academic_student_register_courses');

        if (request()->level_id) {
            $registerIds->where('level_id', request()->level_id);
        }
        if (request()->term_id) {
            $registerIds->where('term_id', request()->term_id);
        }
        if (request()->academic_year_id) {
            $registerIds->where('academic_year_id', request()->academic_year_id);
        }

        $registerIds = $registerIds->pluck('student_id')->toArray();


        $query = Student::with(['academicYear', 'qualification', 'level', 'registerationStatus', 'department'])
            ->where('gender', 'male')->whereIn('id', $registerIds);



        $academicYear = AcademicYear::find(request()->academic_year_id);
        $level = Level::find(request()->level_id);
        $division = Division::find(request()->division_id);


        $students = $query->orderby('name')->get();



        return view('report.report21', compact('students', 'level', 'division', 'academicYear'));
    }

    public function report22(Request $request)
    {
        // dd(request()->year_id);
        $academicYear = AcademicYear::find(request()->year_id);
        $term = DB::table('terms')->where('id', request()->term_id)->first();

        $division = Division::where('id', request()->division_id)->first();

        $courses = null;


        $registerIds = DB::table('academic_student_register_courses');


        if (request()->academic_year_id) {
            $registerIds->where('academic_year_id', request()->year_id);
        }

        if (request()->division_id) {
            $registerIds->where('division_id', request()->division_id);
        }


        $registerIds = $registerIds->pluck('student_id')->toArray();

        $query = StudentAcademic::select(['*', DB::raw('set_number IS NULL AS setNumberNull')])
            ->orderBy('setNumberNull')
            ->orderBy('set_number');




        if (request()->division_id) {
            $courses = Course::where('division_id', request()->division_id)
                ->where('level_id', request()->level_id)->orderby('id')->get();
            $query->where('division_id', request()->division_id);
        }


        $responses = $query->paginate(2000);
        // 	dd($responses);


        return view('report.report22', compact('responses', 'courses', 'division', 'term', 'academicYear'));
    }
    public function report23(Request $request)
    {
        // dd(request()->year_id);
        $academicYear = AcademicYear::find(request()->year_id);
        $term = DB::table('terms')->where('id', request()->term_id)->first();
        $level = DB::table('levels')->where('id', request()->level_id)->first();



        $courses = null;


        $registerIds = DB::table('academic_student_register_courses');


        if (request()->academic_year_id) {
            $registerIds->where('academic_year_id', request()->year_id);
        }
        if (request()->term_id) {
            $registerIds->where('term_id', request()->term_id);
        }



        $registerIds = $registerIds->pluck('student_id')->toArray();


        $query = DB::table('academic_student_courses_result')
            ->select('students.name', 'students.code', 'students.set_number')
            ->join('students', 'students.id', '=', 'academic_student_courses_result.student_id')
            ->where('academic_student_courses_result.mid_degree', null)
            ->whereIn('students.id', $registerIds)->groupby('academic_student_courses_result.student_id');

        if (request()->course_id) {
            $query->where('course_id', request()->course_id);
        }


        $responses = $query->paginate(2000);
        // 	dd($responses);


        return view('report.report23', compact('responses', 'courses', 'term', 'academicYear'));
    }


    public function report24(Request $request)
    {
        $academicYear = AcademicYear::find(request()->year_id);
        $level = DB::table('levels')->where('id', request()->level_id)->first();
        $division = Division::find(request()->division_id);
        $government = DB::table('governments')->where('id', request()->government_id)->first();
        $degree_id = request()->degree_id;
        $students = [];
        $courses = null;
        $registerIds = DB::table('academic_student_register_courses');
        if (request()->academic_year_id) {
            $registerIds->where('academic_year_id', request()->year_id);
        }
        if (request()->level_id) {
            $registerIds->where('level_id', request()->level_id);
        }
        if (request()->division_id) {
            $registerIds->where('division_id', request()->division_id);
        }
        $registerIds = $registerIds->pluck('student_id')->toArray();
        $query = StudentAcademic::select(['*', DB::raw('set_number IS NULL AS setNumberNull')]);
        if (request()->government_id) {
            $query->where('government_id', request()->government_id);
        }

        $responses = $query
            ->orderBy('setNumberNull')
            ->orderBy('set_number')->get();



        // $collection = collect([$responses]);
        // $concatenated = [];
        // foreach($collection as $student){
        //     $concatenated = $collection->concat($student['id'])->concat(['CGPA' => $student->getCGPA()]);
        // }
        // dd($concatenated);

        return view('report.report24', compact('responses', 'division'));
    }




    // public function report25(Request $request)
    // {
    //     $year = AccountSetting::getCurrentAcademicYear();
    //     $term = AccountSetting::getCurrentTerm();
    //     $division = Division::where('id',request()->division_id)->first();
    //     $level = Level::where('id',request()->level_id)->first();

    //    // $courses = null;
    //     $registerIds = DB::table('academic_student_gpa');
    //     if (request()->term_id){
    //         $registerIds->where('term_id',request()->term_id);
    //     }
    //     if (request()->year_id){
    //         $registerIds->where('academic_year_id',request()->year_id);
    //     }
    //     if (request()->division_id){
    //         $registerIds->where('division_id',request()->division_id);
    //     }
    //      if (request()->division_id){
    //         $registerIds->where('division_id',request()->division_id);
    //     }
    //     $registerIds = $registerIds->pluck('student_id')->toArray();

    //     $query = DB::table("academic_student_gpa")->get();
    //     $query->whereIN('id',$registerIds)->orderby('name');

    // 	$responses = $query->paginate(2000);
    //     return view('report.report25', compact('responses','courses','division','level'));
    // }
    public function report26(Request $request)
    {
    }
    public function report27(Request $request)
    {
        $academicYear = AcademicYear::find(request()->year_id);
        $level = DB::table('levels')->where('id', request()->level_id)->first();
        $term = DB::table('terms')->where('id', request()->term_id)->first();
        $division = Division::find(request()->division_id);

        $studentCaseConsraints = StudentCaseConstraint::with('student', 'caseConstraint');

        if (request()->year_id) {
            $studentCaseConsraints->where('academic_year_id', request()->year_id);
        }
        if (request()->level_id) {
            $studentCaseConsraints->where('level_id', request()->level_id);
        }
        if (request()->term_id) {
            $studentCaseConsraints->where('term_id', request()->term_id);
        }
        if (request()->division_id) {
            $studentCaseConsraints->where('division_id', request()->division_id);
        }
        if (request()->case_constraint) {
            $studentCaseConsraints->where('term_id', request()->term_id);
        }
        $responses = $studentCaseConsraints->get();

        return view('report.report27', compact('responses', 'academicYear', 'level', 'term', 'division'));
    }

    public function coursePrequests(Request $request)
    {
        $courses = Course::query();
        // return $courses;
        if(isset(request()->level_id))
        {
            $courses->where('level_id',request()->level_id);
        }

        if(isset(request()->term_id))
        {
            $courses->where('term',request()->term_id);
        }
        
        if(isset(request()->course_id))
        {
            $courses->where('id',request()->course_id);
        }
        // if(isset(request()->year_id))
        // {
        //     $courses->join('academic_open_courses','academic_open_courses.course_id','academic_courses.id')->where('academic_year_id',request()->year_id);
        // }
        // $courses = $courses->get();
        // return $courses;
        $course_id =  $courses->pluck('academic_courses.id');
        $course_name = Course::find(request()->course_id);
        $prerequests = CoursePrerequsite::whereIn('course_id',$course_id)->get();
        // return $prerequests;
        return view('report.prerquest',compact('prerequests','course_name'));
    }
}
