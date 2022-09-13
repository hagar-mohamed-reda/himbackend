<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Account\Entities\AccountSetting;
use App\Setting;
use App\Notification;
use DB;

class DashboardController extends Controller
{
    /** 
     */
    public function getSettings()
    {
        $settings = [];
        $settings['current_academic_year'] = AccountSetting::getCurrentAcademicYear();
        $settings['current_term'] = AccountSetting::getCurrentTerm();

        return $settings;
    }
    
    public function updateSystemSettingsTerm(Request $request)
    {
        $validator = validator($request->all(), [
            "term_id" => "required",
        ]); 
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->getMessages(), "");
        }
        
        try {
            Setting::find(6)->update([
                'value' => $request->term_id
            ]);
            return responseJson(1, __('done'), $request);
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage()); 
        }
    }
    
    public function updateSystemSettingsYear(Request $request)
    {
        $validator = validator($request->all(), [
            "year_id" => "required",
        ]); 
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->getMessages(), "");
        }
        
        try {
            Setting::find(7)->update([
                'value' => $request->year_id
            ]);
            return responseJson(1, __('done'), $request);
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage()); 
        }
    }

    public function getNotifications(Request $request) {
        $user = $request->user;
        $query = Notification::where('user_id', $user->id)
        ->where('seen', '0');
        
        $notifications = $query->latest()->get();
        $query->update(['seen' => 1]);

        return $notifications;
    }
 
}
