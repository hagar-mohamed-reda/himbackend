<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Account\Entities\Payment;
use Modules\Account\Entities\Service;

class ServiceController extends Controller
{

    public function __construct()
    {
        // permission
    }

    /**
     * return all data in json format
     * @return json
     */
    public function index()
    {
        //->where('is_academic_year_expense', '!=', '1')
        $resources = Service::with(['level', 'division', 'store'])->latest()->get();
        return $resources;
    }

    /**
     * Service a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $resource = null;
        try {

            //return dump(toClass($data)->api_token);
            $validator = validator($request->json()->all(), [
                "name" =>  "required|unique:account_services",
                "value" =>  "required",
                "type" =>  "required",
            ], [
                "name.unique" => __('name already exist'),
                "name.required" => __('fill all required data'),
                "value.required" => __('fill all required data'),
                "type.required" => __('fill all required data'),
            ]);

            if ($validator->fails()) {
                return responseJson(0, $validator->errors()->first());
            }
            $data = $request->all();

            $resource = Service::create($data);
            watch(__('add service ') . $resource->name, "fa fa-trophy");
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }

        return responseJson(1, __('done'), $resource);
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, Service $service)
    {
        try {
            $service->update($request->all());
            watch(__('edit service ') . $service->name, "fa fa-trophy");
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }

        return responseJson(1, __('done'), $service->fresh());
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Service $service)
    {
        try {
            watch(__('remove service ') . $service->name, "fa fa-trophy");
            $service->delete();
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
        return responseJson(1, __('done'));
    }
    public function getStudentServicesPayments(Request $request)
    {

        $validator = validator($request->all(), [
            'year_id' => 'required',
            'level_id' => 'required',
            'service_id' => ''
        ], [
            "year_id.required" => __('fill all required data'),
            "level_id.required" => __('fill all required data'),
        ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first());
        }
        $payments = Payment::
            // join('students' , 'students.id' , 'account_payments.student_id')
            whereHas('student', function ($query) use ($request) {
                $query->where('level_id', $request->level_id);
            })
            ->where([
                ['model_type', 'service']
            ]);
            if(isset(request()->date_from) && isset(request()->date_to))
            {
                $payments->whereBetween('date',[request()->date_from,request()->date_to]);
            }
        $payments = array($payments->get());

        $payments_data =  array_filter($payments, function ($p) use ($request) {
            if (!isset($p[0])) return false;
            $payment = $p[0];
            if (isset($payment->model_object)) {
                return
                    $payment->academic_year_id == $request->year_id &&
                    ($request->service_id ? $payment->model_object->id == $request->service_id : true);
            }
        });
        // return $payments_data;
        return view('account::student_services_payments.index', compact('payments_data'));
    }
}
