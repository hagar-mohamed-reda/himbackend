<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Account\Entities\Student;
use Modules\Academic\Entities\Student as StudentAcademic;
use Modules\Student\Entities\Theater;
use Modules\Student\Entities\StudentDistribution;
use Modules\Student\Entities\Commission;
use Modules\Student\Entities\CommissionType;
use Modules\Student\Http\Requests\StudentRequest;
use Modules\Settings\Entities\QualificationTypes;
use Modules\Settings\Entities\StudentCodeSeries;
use Modules\Settings\Entities\AcademicYear;
use Modules\Adminsion\Entities\Application;
use Modules\Adminsion\Http\Controllers\validation\ApplicationValidation;
use Modules\Adminsion\Http\Controllers\ApplicationStoreController;
use Illuminate\Support\Facades\Auth;
use Modules\Account\Entities\StudentOldBalance;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Divisions\Entities\Division;
use Modules\Divisions\Entities\Level;
use Modules\Divisions\Entities\Term;
use Modules\Account\Entities\AccountSetting;
use Modules\Student\Entities\StudentCaseConstraint;
use DB;

class StudentController extends Controller {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request) {
        $query = Student::with(['academicYear', 'qualification', 'level', 'registerationStatus', 'department', 'division','commission','theater'])
        ->where(function($q){
            $q->where('is_application', null)
            ->orWhere('is_application', '0');
        });

        if (request()->case_constraint_id > 0)
            $query->where('case_constraint_id', request()->case_constraint_id);
            
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
                ->where('name', 'like', '%'.$request->search_key.'%')
                ->orWhere('code', 'like', '%'.$request->search_key.'%')
                ->orWhere('id', '=',  $request->search_key)
                ->orWhere('phone_1', 'like', '%'.$request->search_key.'%')
                ->orWhere('national_id', 'like', '%'.$request->search_key.'%');
        }

        return $query->latest()->paginate(5);
    }
    
     public function syncStudents(Request $request) {
        $query = DB::table('students')->get();
      


        return response()->Json(['data' => $query]);
    }

    /**
     * get
     */
    public function get($id) {
        $resource = Student::with(['academicYear', 'qualification', 'level', 'division', 'department', 'studentRequiredDocument'])->find($id);

        return $resource;
    }
    /**
     * update old balance of student
     *
     */
    public function updateOldBalance(Student $student, $oldBalane, $notes) {
        $resource = StudentOldBalance::query()
        ->where('student_id', $student->id)
        ->first();

        if ($resource) {
            $resource->update([
                "value" => $oldBalane,
                "notes" => $notes
            ]);
        } else {
            StudentOldBalance::create([
                "value" => $oldBalane,
                "notes" => $notes,
                "student_id" => $student->id
            ]);
        }
    }

    /**
     * update isCorona fileld of student
     *
     */
    public function updateIsCorona($id, $isCorona) {
        
        $resource = Student::where('id',$id)->update(array(
                         'iscorona'=> $isCorona,
        ));

       
    }
    
    
       
        public function storeTheater(Request $request) {

           $theater = new Theater();
           $theater->name = $request->name;
           $theater->save();
           if($theater){
               return 1; 
           }else{return 0;}
       
         }
        public function editTheater(Request $request) {
               $theater = Theater::find($request->id);
                if($theater){
                    $theater->update(['name' => $request->name]);
                    return 1;
                }else{
                    return 0;
                }
                
        }
        public function deleteTheater(Request $request) {
               $theater = Theater::find($request[0]);
               if($theater){
                    $theater->delete();
                    return 1;
               }else{
                   return 0;
               }
             
        }
        
   
        
       
    
      public function storeCommission(Request $request) {
            try {
                
                $commission = Commission::where('level_id',$request->level_id)->get();
                $countCommissions = count($commission);
                $countCommissions++;
               
                 for($i = 1; $i <= $request->commission_number; $i++){
                   $level = Level::find($request->level_id);
                   $division = Division::find($request->division_id);
                   $commission = new Commission();
                   $commission->level_id = $request->level_id;
                   $commission->division_id = $request->division_id;
                   $commission->theater_id = $request->theater_id;
                   $commission->max_num = $request->max_num;
                   $commission->commission_index = $i;
                   $commission->start_num = $request->start_num;
                   $commission->commission_type_id = $request->commission_type_id;
                   $commission->name =  ' لجنة '. $countCommissions ;
                   $commission->save();
                   
                   $countCommissions++ ;
               }
               return 1;
        } catch (ModelNotFoundException $exception) {

            return 0;

        }

       
    }
    
      public function editCommission(Request $request) {
          
            try {

                   $level = Level::find($request->level_id);
                   $division = Division::find($request->division_id);
                   $commission = Commission::find($request->id);
                   $commission->level_id = $request->level_id;
                   $commission->division_id = $request->division_id;
                   $commission->theater_id = $request->theater_id;
                   $commission->max_num = $request->max_num;
                   $commission->name = $request->name ;
                   $commission->commission_type_id = $request->commission_type_id ;
                   $commission->update();
               
               return 1;
            } catch (ModelNotFoundException $exception) {
                return 0;
            }

        }
        
        public function deleteCommission(Request $request) {
               $commission = Commission::find($request[0]);
               if($commission){
                    $commission->delete();
                    return 1;
               }else{
                   return 0;
               }
             
        }
    
     public function storeStudentDistributions(Request $request) {
        //  dd('gnbn');
         
         $levels = Level::all();
         $divisions = Division::all();
         $year = AccountSetting::getCurrentAcademicYear();
         $term = AccountSetting::getCurrentTerm();
      
              foreach($levels as $level){
                
                 foreach($divisions as $division){
                     $registers = DB::table('academic_student_register_courses');
                     $registers->where('term_id', $term->id);
                     $registers->where('level_id',$level->id);
                     $registers->where('division_id', $division->id);
                     $registerIds = $registers->pluck('student_id')->toArray();
                    
                     $commissions = Commission::where('level_id',$level->id)->where('division_id',$division->id)->where('commission_type_id','=', 1)->get();
                     $commission_start_num = Commission::where('level_id',$level->id)->where('division_id',$division->id)->first()->start_num ?? '';
                     
              
                          
                         foreach($commissions as $commission){
                             
                                if($commission->distribution == 1)
                                    return 2;
                         
                                $students = Student::where('level_id', $commission->level_id)
                                ->where('division_id', $commission->division_id)
                                ->whereIn('id', $registerIds)
                                ->where('commission_id', null)
                                ->orderBy('name')->get();
                               
                                    // dd($students);

                              for ($i = 0; $i < $commission->max_num; $i++) {
                                  
                                                    if($students[$i] ?? ''){
                                                        $students[$i]->set_number = $commission_start_num ;
                                                        $students[$i]->commission_id = $commission->id;
                                                        $students[$i]->theater_id = $commission->theater_id;
                                                        $students[$i]->save();
                                                        $commission_start_num++;
                                                    } 
                                                    
                                }
                                
                         $commission->distribution = 1;
                         $commission->save();
                     }

                 }
         
             }
                return 1;
        
        
         
    }
    
     public function storeStudentDistributionsOnPrivate(Request $request) {
       

         $levels = Level::all();
         $divisions = Division::all();
         $year = AccountSetting::getCurrentAcademicYear();
         $term = AccountSetting::getCurrentTerm();
      
            
        
        
        $commissions = Commission::where('commission_type_id','=', 2)->get();
         
      
      
        foreach($commissions as $commission){
            
            if($commission->distribution == 1)
                return 2;
                 
             $commission_start_num = $commission->start_num;
             
             $registers = DB::table('academic_student_register_courses');
             $registers->where('term_id', $term->id);
             $registers->where('level_id', $commission->level_id);
             $registers->where('division_id', $commission->division_id);
             $registerIds = $registers->pluck('student_id')->toArray();
 
            $students = Student::where('level_id', $commission->level_id)
            ->where('division_id', $commission->division_id)
            ->whereIn('id', $registerIds)
            ->where('commission_id', null)
            ->orderBy('name')->get();
           
                // dd($students);

          for ($i = 0; $i < $commission->max_num; $i++) {
              
                        if($students[$i] ?? ''){
                            $students[$i]->set_number = $commission_start_num ;
                            $students[$i]->commission_id = $commission->id;
                            $students[$i]->theater_id = $commission->theater_id;
                            $students[$i]->save();
                            $commission_start_num++;
                        } 
                                
            }
            
            $commission->distribution = 1;
            $commission->save();
                    
             
         }

                 
         
             
      return 1;
    }
    
    public function getTheaters() {
        $theaters = Theater::get();

        return view('student.theaters', compact('theaters'));
    }
    
      public function setNumbers(Request $request){
        $query = Student::with('level','division');
        $level = \Modules\Divisions\Entities\Level::find(request()->level_id);
        $division = \Modules\Divisions\Entities\Division::find(request()->division_id);
        if (request()->level_id != null && request()->division_id != null && request()->start_number != null){
       
             $name = "المستوي ".$level->name . " -الشعبة ". $division->name;
             $studentDistributions = DB::table('student_distributions')->insert(
                ['name' => $name, 'level_id' => $level->id,'division_id' => $division->id, 'students_num' => request()->start_number]);
            
            if($studentDistributions)
                return 1;
        }
        else{
            return 0;
 
        }

    }
    
     public function setNumbersNull(Request $request)
    {
        $students = Student::get();
        foreach ($students as $student) {
            $student->set_number = null;
            $student->theater_id = null;
            $student->commission_id = null;
            $student->save();
        }
        $commissions = Commission::truncate();
      
        return 1;
    }
    
      public function getCommissionStudents(Request $request){
        $students = Student::where('commission_id', $request->commission_id)
        ->where('set_number', '!=', null)->orderBy('name')->get();
        
        return ['students' => $students];

    }
    
     public function getAllCommissionStudents(Request $request){
        $students = Student::where('commission_id','!=', null)->orderBy('name')->groupBy()->get();
        
        return ['students' => $students];

    }
    public function getStudentsSetnumbers(Request $request){
     
        $students = StudentAcademic::query()
            ->with([
                'level', 'division', 'case_constraint', 
                'constraint_status', 'installments', 
                'payments', 'registerationStatus', 
                'nationality', 'discount_requests', 'balanceResets',
                'courses'
                ])->where('commission_id','=', 12)->orderBy('name')->paginate(5);
        // $courses= \Modules\Academic\Entities\Course::orderBy('exam_date')->get();
            
        return $students;

    }
    
     public function storeStudentSetNumber(Request $request){

       $student = Student::FindOrFail($request->student_id);

           $commission_id = $request->commission_id;

           $student->set_number = $request->set_number;
           $student->commission_id = $commission_id;
           $student->theater_id = $commission_id;
           $student->save();
    
      

        return 1;

    }
    
     public function storeCaseConstraints(Request $request){
         
     $validator = validator($request->json()->all(), [
            "student_id" =>  "required",  
            "case_constraint_id" =>  "required", 
        ], [
            "name.required" => 'حقل الاسم مطلوب', 
            "case_constraint_id.required" => 'حقل القيد مطلوب' 
        ]);
        

       $student = Student::FindOrFail($request->student_id);
        

       $caseConstraint = StudentCaseConstraint::create([
        'student_id'=>$student->id,
        'case_constraint_id'=>$request->case_constraint_id,
        'academic_year_id'=>$request->academic_year_id,
        'term_id'=>$request->term_id,
        'level_id'=>$student->level_id,
        'division_id'=>$student->division_id,
        'reason'=>$request->reason,
       ]);
    
        if($caseConstraint)
        return responseJson(1, __('application enroll to student'));

    }
    
    
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {

        $data = $request->all();
        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();

        // assign code of application
        $data['code'] = date("Y-m-d-H:i:s") . "-" . rand(11111, 99999);

        // application validator
        $applicationValidator = new ApplicationValidation();

        // application store
        $applicationStore = new ApplicationStoreController();

        //


        try {

            // validate on request input
            if ($applicationValidator->validateOnRequest($request)['status'] == 0) {
                return responseJson(0, $applicationValidator->validateOnRequest($request)['message']);
            }

            // validate on application required inputs
            if ($applicationValidator->validateOnApplicationRequired($request)['status'] == 0) {
                return responseJson(0, $applicationValidator->validateOnApplicationRequired($request)['message']);
            }

            // validate o on application required docuements
            if ($applicationValidator->validateOnRegisterationStatusDocument($request)['status'] == 0) {
                return responseJson(0, $applicationValidator->validateOnRegisterationStatusDocument($request)['message']);
            }

            // store application data
            $student = Student::create($data);
            
            if($request->case_constraint_id){
                StudentCaseConstraint::create(['student_id'=> $student->id,'case_constraint_id'=>$request->case_constraint_id, 'academic_year_id'=>$year->id,
                'term_id' => $term->id,'level_id'=>$request->level_id ?? '', 'division_id' => $request->division_id]);
            }

            // store old balance if exist
            if ($request->old_balance) {
                $this->updateOldBalance($student, $request->old_balance, $request->old_balance_notes);
            }

            // upload personal image
            uploadImg($request->file('personal_photo'), Student::$FOLDER_PREFIX . $student->id, function($filename) use ($student) {
                $student->update([
                    'personal_photo' => Student::$FOLDER_PREFIX . $student->id . "/" . $filename
                ]);
            });

            // upload files
            $applicationStore->uploadFiles($request, $student);

            notfy(__('new student'), __('new student') . $student->name, 'fa fa-user');
        } catch (\Exception $th) {
            return $th->getMessage();

            return responseJson(0, $th->getMessage());
        }
        return responseJson(1, __('process has been success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id) {
        $resource = Student::find($id);
        return view('student::students.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id) {
        $student = Student::find($id);
        if (!$student) {
            notify()->error(__('data not found'), "", "bottomLeft");
            return redirect()->route('students.index');
        }

        return view('student::students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id) {
        if($request->isCorona != null){
            Student::where('id',$id)->update(array(
                         'iscorona'=> $request->isCorona,
        ));
        }
        else{
            
            if($request->case_constraint_id == 1)
                  $request->request->add(['is_application' => 1]);
            
        $data = $request->all();

        $student = Student::find($id);
        $application = Application::find($student->application_id);

        // application validator
        $applicationValidator = new ApplicationValidation();

        // application store
        $applicationStore = new ApplicationStoreController();

        try {

            // validate on request input
            if ($applicationValidator->validateOnRequest($request)['status'] == 0) {
                return responseJson(0, $applicationValidator->validateOnRequest($request)['message']);
            }

            // validate on application required inputs
            if ($applicationValidator->validateOnApplicationRequired($request)['status'] == 0) {
                return responseJson(0, $applicationValidator->validateOnApplicationRequired($request)['message']);
            }

            // store application data
            $student->update($data);

            // store old balance if exist
            if ($request->old_balance) {
                $this->updateOldBalance($student, $request->old_balance, $request->old_balance_notes);
            }
            // upload personal image
            uploadImg($request->file('personal_photo'), Student::$FOLDER_PREFIX . $student->id, function($filename) use ($student) {
                $student->update([
                    'personal_photo' => Student::$FOLDER_PREFIX . $student->id . "/" . $filename
                ]);
            });

            // upload files
            $applicationStore->uploadFiles($request, $student);

            notfy(__('new Student'), __('new Student') . $student->name, 'fa fa-user');
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage() . " from update student");
        }
        return responseJson(1, __('process has been success'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

    public function saveToStudents(Request $request, $id) {
        $application = Application::find($id);

        $data = [
            'personal_photo' => $application->personal_photo,
            'application_id' => $application->id,
            'name' => $application->name,
            'level_id' => $application->level_id,
            'national_id' => $application->national_id,
            'gender' => $application->gender,
            'academic_years_id' => $application->academic_years_id,
            'registeration_date' => $application->registeration_date,
            'qualification_types_id' => $application->qualification_types_id,
            'qualification_id' => $application->qualification_id,
            'qualification_date' => $application->qualification_date,
            'password' => $application->password,
        ];
            $student_code = StudentCodeSeries::
                            where('academic_year_id', $application->academic_years_id)
                            ->where('level_id', $application->level_id)->first();

            $start_code = substr($student_code->code, 0, 5);


            if ($application->language_1_id != null)
                $data['language_1_id'] = $application->language_1_id;

            if ($application->language_2_id != null)
                $data['language_1_id'] = $application->language_2_id;

            if ($application->nationality_id != null)
                $data['nationality_id'] = $application->nationality_id;

            if ($application->qualification_set_number != null)
                $data['qualification_set_number'] = $application->qualification_set_number;

            if ($application->city_id != null)
                $data['city_id'] = $application->city_id;

            if ($application->government_id != null)
                $data['government_id'] = $application->government_id;

            if ($application->country_id != null)
                $data['country_id'] = $application->country_id;

            if ($application->religion != null)
                $data['religion'] = $application->religion;

            if ($application->military_status_id != null)
                $data['military_status_id'] = $application->military_status_id;

            if ($application->military_area_id != null)
                $data['military_area_id'] = $application->military_area_id;

            if ($application->grade != null)
                $data['grade'] = $application->grade;

            if ($application->triple_number != null)
                $data['triple_number'] = $application->triple_number;

            if ($application->address != null)
                $data['address'] = $application->address;

            if ($application->birth_address != null)
                $data['birth_address'] = $application->birth_address;

            if ($application->phone_1 != null)
                $data['phone_1'] = $application->phone_1;

            if ($application->registration_status_id != null)
                $data['registration_status_id'] = $application->registration_status_id;

            if ($application->registration_method_id != null)
                $data['registration_method_id'] = $application->registration_method_id;

            if ($application->national_id_date != null)
                $data['national_id_date'] = $application->national_id_date;

            if ($application->national_id_place != null)
                $data['national_id_place'] = $application->national_id_place;

            if ($application->parent_name != null)
                $data['parent_name'] = $application->parent_name;

            if ($application->parent_national_id != null)
                $data['parent_national_id'] = $application->parent_national_id;

            if ($application->parent_job_id != null)
                $data['parent_job_id'] = $application->parent_job_id;

            if ($application->parent_address != null)
                $data['parent_address'] = $application->parent_address;

            if ($application->parent_phone != null)
                $data['parent_phone'] = $application->parent_phone;

            if ($application->personal_photo != null)
                $data['personal_photo'] = $application->personal_photo;

            if ($application->acceptance_code != null)
                $data['acceptance_code'] = $application->acceptance_code;

            if ($application->acceptance_code != null)
                $data['acceptance_date'] = $application->acceptance_date;

            if ($application->email != null)
                $data['email'] = $application->email;

            if ($application->case_constraint_id != null)
                $data['case_constraint_id '] = $application->case_constraint_id ;

            if ($application->relative_relation_id != null)
                $data['relative_relation_id '] = $application->relative_relation_id ;


            $student_last_code = Student::where('code', 'LIKE', $start_code . '%')->pluck('code')->toArray();
            if ($student_last_code != null) {
                $data['code'] = (string) (max($student_last_code) + 1);
            } else {
                $data['code'] = (string) $student_code->code;
            }


        $data['application_id'] = $application->id;
        $student = Student::create($data);
        $application->status = 1;
        $application->save();

        DB::table('student_required_documents')
        ->where('student_id', $application->id)
        ->update([
            'student_id' => $student->id
        ]);
        notfy(__('add student'), __('add student ') . $student->name, 'fa fa-building-o');
        return responseJson(1, __('application enroll to student'));
    }

}
