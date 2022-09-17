<?php

namespace Modules\Student\Http\Controllers;

use App\Term as AppTerm;
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
use Modules\Student\Entities\StudentExcuses;
use DB;

class StudentExcusesController extends Controller {

    /**
     * Display a listing of the resource.
     * @return Response
     */
     
      public function index() {

        $resource = StudentExcuses::query();
        
        if (request()->academic_year_id) {
            $resource->where('academic_year_id', request()->academic_year_id);
        }
        
        if (request()->term_id) {
            $resource->where('term_id', request()->term_id);
        }
        
        if (request()->level_id) {
            $resource->where('level_id', request()->level_id);
        }
        if (request()->division_id) {
            $resource->where('division_id', request()->division_id);
        }
        
        $resources = $resource->latest()->get();
        // return $resource;
        $level = Level::find(request()->level_id);
        $devision = Division::find(request()->division_id);
        $acadimic = AcademicYear::find(request()->year_id); 
        return view("report.student_excuses_report",compact('resources','level','devision','acadimic'));
    }
    
    public function store(Request $request) {
         $validator = validator($request->json()->all(), [
            "student_id" =>  "required",  
            "reason" =>  "required", 
        ], [
            "name.required" => 'حقل الاسم مطلوب', 
            "reason.required" => 'حقل السبب مطلوب' 
        ]);
        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();
         
       
       $student = Student::FindOrFail($request->student_id);

       $resource = StudentExcuses::create([
        'student_id'=>$student->id,
        'academic_year_id'=>$year->id,
        'term_id'=>$term->id,
        'level_id'=>$student->level_id,
        'division_id'=>$student->division_id,
        'reason'=>$request->reason,
       ]);


         uploadImg($request->file('attachment'), "/uploads/excuses/", function($filename) use ($resource) {
                $resource->update([
                    "attachment" => $filename
                ]);
            });
    
        if($resource)
        return responseJson(1, ('تم اضافة العذر'));
    }
    
    
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, StudentExcuses $studentExcuse) {
        try { 
            
            $data = $request->all(); 
          
            $studentExcuse->update($data);
           
            watch(__('edit Excuse ') . $studentExcuse, "fa fa-newspaper-o");
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
        
        return responseJson(1, __('done'), $studentExcuse->fresh());
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(StudentExcuses $studentExcuse) { 
        try { 
            watch(__('remove excuse ') . $studentExcuse->reason, "fa fa-newspaper-o"); 
            $studentExcuse->delete();
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
        return responseJson(1, __('done'));
    }
    
   

}
