<?php

namespace Modules\Adminsion\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Adminsion\Entities\Application;
use Modules\Adminsion\Http\Controllers\validation\ApplicationValidation;
use Modules\Adminsion\Http\Controllers\ApplicationStoreController;
use Illuminate\Support\Facades\Auth;
use Modules\Settings\Entities\Level;
use Modules\Settings\Entities\Qualification;
use Modules\Settings\Entities\QualificationType;

class ApplicationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response String
     */
    public function index(Request $request) {
        $query = Application::with(['academicYear', 'qualification', 'level', 'studentRequiredDocument'])
        ->where('is_application', 1);

        if (request()->nationality_id > 0)
            $query->where('nationality_id', request()->nationality_id);

        if (request()->academic_year_id > 0)
            $query->where('academic_year_id', request()->academic_year_id);

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

        $resources = $query->latest()->paginate(5);
        return $resources;
    }

    public function get($id) {
        return Application::with(['academicYear', 'qualification', 'level', 'division' ,'studentRequiredDocument'])->find($id);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $data = $request->all();

        // assign code of application
        $data['application_code'] = date("Y-m-d-H:i:s") . "-" . rand(11111, 99999);
        $data['writen_by'] = $request->user->id;
        $data['is_application'] = true;
        $data['case_constraint_id'] = 1;

        // set the defualt devision
        // $data['division_id'] = 1;
        $data['department_id'] = 1;
        $data['level_id'] = 1;

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
            // validate o on application required docuements
            //if ($applicationValidator->validateOnRegisterationStatusDocument($request)['status'] == 0) {
            //    return responseJson(0, $applicationValidator->validateOnRegisterationStatusDocument($request)['message']);
            //}


            // store application data
            $application = Application::create($data);
            // upload personal image
            uploadImg($request->file('personal_photo'), Application::$FOLDER_PREFIX . $application->id, function($filename) use ($application) {
                $application->update([
                    'personal_photo' => Application::$FOLDER_PREFIX . $application->id . "/" . $filename
                ]);
            });

            // upload files
            $applicationStore->uploadFiles($request, $application);
            

            notfy(__('new application'), __('new application') . $application->name, 'fa fa-file-o');
            if ($application->level_id !='') {
                $level = Level::find($application->level_id);
                return responseJson(1, __('process has been success') . ' ' . __('student enrolled in level') . ' ' . $level->name);
            } else {
                return responseJson(1, __('process has been success'));
            }
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id) {
        $resource = Application::find($id);
        return view('adminsion::applications.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id) {
        $application = Application::find($id);
        return view('adminsion::applications.edit', compact('application'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $data = $request->all();

        $application = Application::find($id);

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

            $application->update($data);

            // upload personal image
            uploadImg($request->file('personal_photo'), Application::$FOLDER_PREFIX . $application->id, function($filename) use ($application) {
                if (file_exists(public_path($application->personal_photo))) {
                    unlink(public_path($application->personal_photo));
                }
                $application->update([
                    'personal_photo' => Application::$FOLDER_PREFIX . $application->id . "/" . $filename
                ]);
            });

            // upload files
            $files = $applicationStore->uploadFiles($request, $application);
            notfy(__('update application'), __('update application') . $application->name, 'fa fa-file-o');
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
        return responseJson(1, __('process has been success'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id) {
        $application = Application::find($id);
        if(! $application) return "ملف التقديم غير موجود";
        try {
            $application->delete();
            return ['status' => 1];
        } catch (\Exception $th) {
            return ['status' => 0];
        }
    }

}
