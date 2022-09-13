<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Account\Entities\Person; 

class PersonController extends Controller
{

    public function __construct() {
        // permission
    } 

    /**
     * return all data in json format
     * @return json
     */
    public function index() {
        $resources = Person::latest()->get();
        return $resources;
    }
 
    /**
     * Bank a newly created resource in storage.
     * @param Request $request
     * @return Response
     */ 
    public function store(Request $request) {
        $resource = null;
        // dd($request);
        try { 
              
            //return dump(toClass($data)->api_token);
            $validator = validator($request->json()->all(), [
                "name" =>  "required|unique:account_persons",  
            ], [
                "name.unique" => __('name already exist')
            ]);
            
            if ($validator->fails()) {
                return responseJson(0, $validator->errors()->first());
            }
            $data = $request->all();
            $data['name'] = $request->name;
            $data['phone'] = $request->phone;
            $data['address'] = $request->address;
            $data['notes'] = $request->notes;
            $resource = Person::create($data); 
            watch(__('add Person ') . $resource->name, "fa fa-bank");
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
    public function update(Request $request, Person $person) {
        try { 
            $person->update($request->all());
            watch(__('edit person ') . $person->name, "fa fa-bank");
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
        
        return responseJson(1, __('done'), $person->fresh());
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Person $person) { 
        try { 
            watch(__('remove Person ') . $person->name, "fa fa-bank"); 
            $person->delete();
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
        return responseJson(1, __('done'));
    }
}
