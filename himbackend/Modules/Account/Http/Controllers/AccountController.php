<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Account\Entities\Student;
use Modules\Academic\Entities\Student as studentAcademic;
use Modules\Account\Entities\StudentBalance;
use Modules\Account\Entities\AccountSetting;
use Modules\Account\Entities\Payment;
use Modules\Account\Entities\Store;
use Modules\Account\Entities\StudentPay;
use Modules\Account\Entities\DiscountRequest;
use Modules\Account\Entities\BalanceReset;
use Modules\Settings\Entities\AcademicYear;
use Modules\Academic\Entities\StudentGpa;


use App\User;
use DB;
use Modules\Account\Entities\ServiceTemplate;

class AccountController extends Controller
{

    /**
     * return student info
     *
     * @return type
     */
    public function getStudentAccounting()
    {
        $student = null;
        if (request()->student_id) {
            $student = Student::query()
                ->with(['level', 'division', 'case_constraint', 'constraint_status', 'installments', 'payments', 'registerationStatus', 'nationality', 'discount_requests', 'balanceResets'])
                ->find(request()->student_id);
        }

        $student->date = date("Y-m-d");
        return $student;
    }

    public function printService($request = null)
    {
        try {
            $studentId = 1;
            $serviceTemplateId = request()->service_template_id;
            $template = ServiceTemplate::find($serviceTemplateId);
             $year_id = 8;

            
            
            
            
            
            ////////////////////////////////////////////////////////
  
            
            
            
            if($studentId)
        {
            $student = studentAcademic::find($studentId);


            $actualRegisterHours = $student->register_hours;  //الساعات المحققة
            $registerHours = $student->actual_register_hours;  // الساعات المسجلة
            $CGPA = $student->getGpa();  //  التراكمي
            $year = AcademicYear::find($year_id);

            $arrayPush = [];

            $studentInfo = DB::table('students')
            ->where('id',1)
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
                                    ->where('student_id',1)->get();


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
                $query->where('student_id', 1);
    
          $response = $query->get();
    
            // return  ['registerCourses' => $response, 'studentInfo' => $studentInfo, 'student_gpa_fasly' => $studentGpaFasly ?? '',
            // 'year' => $year, 'ActualRegisterHours' => $actualRegisterHours, 'registerHours' => $registerHours,'CGPA' => $CGPA];
            }else{
                return null;
        }
        
        
        $registerCourses = $response;
        $studentInfo = $studentInfo;
        $student_gpa_fasly = $studentGpaFasly ?? '';
        $ActualRegisterHours = $actualRegisterHours;

        
        
        
            
            return view($template->path, compact('student', 'template' , 'registerCourses'  , 'studentInfo' , 'student_gpa_fasly' , 'ActualRegisterHours' , 'registerHours' , 'CGPA' ));
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    public function changePaymentStatus()
    {
        try {
            $payment = Payment::find(request()->payment_id);
            $col = request()->col;
            $value = request()->value;
            $payment->update([
                $col => $value
            ]);

            return responseJson(1, __('done'), $payment);
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
    }

    /**
     * pay money in store
     *
     */
    public function pay(Request $request)
    {
        $user = $request->user;

        $resource = null;
        try {
            $validator = validator($request->all(), [
                "value" =>  "required",
                "student_id" =>  "required"
            ]);
            if ($validator->failed()) {
                return responseJson(0, __('fill all required data'));
            }

            $student = Student::find($request->student_id);
            $resource = StudentPay::pay($request);

            $message = __('student {name} pay {value} in store');
            $message = str_replace("{name}", $student->name, $message);
            $message = str_replace("{value}", $request->value, $message);
            watch($message, "fa fa-money");
            return responseJson(1, $message, $resource);
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }

        return responseJson(1, __('done'), $resource);
    }

    /**
     * pay money in store
     *
     */
    public function refund(Request $request)
    {
        $user = $request->user;

        $resource = null;
        try {
            $validator = validator($request->all(), [
                "payment_id" =>  "required"
            ]);
            if ($validator->failed()) {
                return responseJson(0, __('fill all required data'));
            }

            $resource = StudentPay::payRefund($request);

            $message = __('student {name} refund {value} in store');
            $message = str_replace("{name}", optional($resource->student)->name, $message);
            $message = str_replace("{value}", $resource->value, $message);
            watch($message, "fa fa-money");
            return responseJson(1, $message, array($resource));
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }

        return responseJson(1, __('done'), $resource);
    }

    /**
     * pay money in store
     *
     */
    public function removePayment(Request $request)
    {
        $user = $request->user;

        $resource = null;
        try {
            $validator = validator($request->all(), [
                "payment_id" =>  "required"
            ]);
            if ($validator->failed()) {
                return responseJson(0, __('fill all required data'));
            }

            $resource = StudentPay::removePayment($request);

            $message = __('payment value removed from store ') . optional($resource->store)->name;
            watch($message, "fa fa-money");
            return responseJson(1, $message);
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }

        return responseJson(1, __('done'), $resource);
    }

    /**
     * edit payment info
     *
     */
    public function editPayment(Request $request)
    {
        $user = $request->user;

        $resource = null;
        try {
            $validator = validator($request->all(), [
                "id" =>  "required"
            ]);
            if ($validator->failed()) {
                return responseJson(0, __('fill all required data'));
            }
            $data = $request->all();
            $payment = Payment::find($request->id);

            if ($payment) {
                $request->payment_id = $request->id;
                // remove old
                StudentPay::removePayment($request);

                // add new
                $payment = Payment::addPayment($data);
            }

            watch(__('edit payment info of number ') . $payment->id, "fa fa-money");
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }

        return responseJson(1, __('done'), $resource);
    }

    /**
     * pay money in store
     *
     */
    public function updateAccountSetting(Request $request)
    {
        $user = $request->user;

        $resource = null;
        try {
            $validator = validator($request->all(), [
                "id" =>  "required",
                "value" =>  "required",
                "name" =>  "required"
            ]);
            if ($validator->failed()) {
                return responseJson(0, __('fill all required data'));
            }

            $resource = AccountSetting::updateSetting($request->id, $request->name, $request->value);

            watch(__('update old balance store settings '), "fa fa-cogs");
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }

        return responseJson(1, __('done'), $resource);
    }

    public function getSettings()
    {
        return AccountSetting::all();
    }

    public function searchStudent(Request $request)
    {
        return Student::query() //DB::table('students')
            ->where('name', 'like', '%' . $request->key . '%')
            ->orWhere('code', 'like', '%' . $request->key . '%')
            ->orWhere('id', '=',  $request->key)
            ->orWhere('phone_1', 'like', '%' . $request->key . '%')
            ->orWhere('national_id', 'like', '%' . $request->key . '%')
            ->take(10)
            ->get(["id", "name", "code"]);
    }


    public function getStudentAvailableServices(Request $request)
    {
        $user = $request->user;
        $validator = validator($request->all(), [
            "student_id" =>  "required"
        ]);
        if ($validator->failed()) {
            return [];
        }

        $student = Student::find($request->student_id);
        return $student->getAvailableServices();
    }

    public function writeStudentNote(Request $request)
    {
        $validator = validator($request->all(), [
            "notes" =>  "required",
            "student_id" =>  "required"
        ]);
        if ($validator->failed()) {
            return responseJson(0, __('write some notes'));
        }

        $student = Student::find($request->student_id);

        if ($student->notes)
            $student->notes .=  "\n" . $request->notes;
        else
            $student->notes = $request->notes;

        $student->update();
        return responseJson(1, __('done'));
    }

    public function updateStudentInfo(Request $request)
    {
        $validator = validator($request->all(), [
            "student_id" =>  "required"
        ]);
        if ($validator->failed()) {
            return responseJson(0, __('write some notes'));
        }

        $student = Student::find($request->student_id);

        $student->update($request->all());
        return responseJson(1, __('done'));
    }

    public function createBalanceReset(Request $request)
    {
        $validator = validator($request->all(), [
            "student_id" =>  "required",
            "value" =>  "required"
        ]);
        if ($validator->failed()) {
            return responseJson(0, __('fill all required data'));
        }

        try {
            $data = $request->all();
            $data['user_id'] = $request->user->id;
            $data['date'] = date('Y-m-d');

            $student = Student::find($request->student_id);

            if ($student->old_balance > 0)
                $data['type'] = 'old';
            else
                $data['type'] = 'new';

            $resource = BalanceReset::create($data);

            return responseJson(1, __('done'), $resource);
        } catch (\Exception $e) {
            return responseJson(0, $e->getMessage());
        }
    }
}
