<?php

namespace Modules\Academic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Academic\Entities\AcademicSetting;
use Modules\Academic\Entities\AcademicSettingPrerequsite;

use Modules\Settings\Entities\Level;
use Modules\Account\Entities\AccountSetting;
use Modules\Academic\Entities\PublishResult;
use DB;
use Exception;
use Modules\Academic\Entities\AcademicAdvisingPaymentDetails;

class SettingController extends Controller
{
    /**
     * return list of courses
     * @return Response
     */
    public function get()
    {
        return AcademicSetting::latest()->get();
    }
     

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $resource = null;
        try {
            foreach($request->settings as $item) {
                $setting = AcademicSetting::find($item['id']);

                if ($setting) {
                    $setting->update($item);
                }
                else {
                    $setting = AcademicSetting::create($item);
                }    
            }

            watch(__('change academic settings '), "fa fa-cogs");
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }

        return responseJson(1, __('done'), $resource);
    }
 
	public function updatePublishResult(Request $request) {
        $level = Level::find($request->level_id);
		$password = optional(AcademicSetting::find(12))->value;
        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();

        try {
			if ($request->password != $password) {
				return responseJson(0, __('password not correct'));
			}
			
			$resource = PublishResult::query()
					->where('academic_year_id', $year->id)
					->where('term_id', $term->id)
					->where('level_id', $level->id)
					->first();
					
			// publish 
			if ($request->action == 1) {
				if (!$resource) {
					$resource = DB::table('academic_publish_result')->insert([
						[
							"academic_year_id" => $year->id,
							"term_id" => $term->id,
							"level_id" => $level->id,
							"user_id" => optional($request->user)->id,
							"date" => date('Y-m-d')
						]
					]);
				}
			} else {
				if ($resource)
					$resource->delete();
			}

            watch(__('change publish result of ') . $level->name, "fa fa-cogs");
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }

        return responseJson(1, __('done'), $resource);
	}

    public function getPaymentSettings()
    {
        $restricted =  AcademicAdvisingPaymentDetails::where('case_constrain_id',2)->get();
        $unrestricted = AcademicAdvisingPaymentDetails::where('case_constrain_id',3)->get();
        return Response()->json(['status' => 1, 'message' => 'success', 'restricted' => $restricted,'unrestricted'=>$unrestricted]);
    }

    public function updatePaymentSettings(Request $request)
    {
        try{
             // get current year and term //
        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();
        
        foreach($request->paymentSettings as $payment)
        {
            if(AcademicAdvisingPaymentDetails::where('id',$payment['id'])->exists())
            {
                // update //
               $data =  AcademicAdvisingPaymentDetails::find($payment['id']);
               $data->update([
                'value'=>$payment['value']
               ]);
            }
            else{
                   // insert //
                   if(AcademicAdvisingPaymentDetails::where('acadimic_year_id',$year->id)->where('case_constrain_id',3)->count() == 5){
                    AcademicAdvisingPaymentDetails::create([
                        'acadimic_year_id'=>$year->id,
                        'term_id' => $term->id,
                        'case_constrain_id'=>2,
                        'value'=>$payment['value'],
                        'level_id'=>$payment['level'],
                    ]);
                    }elseif(AcademicAdvisingPaymentDetails::where('acadimic_year_id',$year->id)->where('case_constrain_id',2)->count() == 5){
                        AcademicAdvisingPaymentDetails::create([
                            'acadimic_year_id'=>$year->id,
                            'term_id' => $term->id,
                            'case_constrain_id'=>3,
                            'value'=>$payment['value'],
                            'level_id'=>$payment['level'],
                        ]);    
                    }
                    else
                    {
                        AcademicAdvisingPaymentDetails::create([
                            'acadimic_year_id'=>$year->id,
                            'term_id' => $term->id,
                            'case_constrain_id'=>3,
                            'value'=>$payment['value'],
                            'level_id'=>$payment['level'],
                        ]);
                    }     
            }
        }
        return responseJson(1, __('done'));
    
        }catch(Exception $e)
        {
            return $e;
        }
       
    }
 
}
