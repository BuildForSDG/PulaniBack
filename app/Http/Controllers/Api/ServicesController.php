<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Hash;

use App\Service;
use Auth;
use App\Http\Resources\Service as ServiceResource;
use App\Http\Requests;

class ServicesController extends Controller
{
    
    public function index()
    {
         //Show services
         $services = Service::all();

         //Return collection
         $result = ServiceResource::Collection($services);
         if($result){
             return response()->json(['services'=>$result, 'error'=>false, 'message'=>'Details succesfully fetched']);
         }
         else if(code ==404){
             return $result->response()->json(['error'=>true, 'message'=>'Details Not found']);
         }
         else return response()->json(['error'=>true, 'message'=>'Error fetching data']);
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        //Get user id
         //Validate before inserting user records
         $this->validate($request, [

            'earnings'          => 'required',
            'savings'           => 'required',
            'costsIncurred'     => 'required',
            'personalExpenses'  => 'required',

        ]);

        $service = $request->isMethod('put') ? Service::findOrFail($request->id) : new Service;

        $service->earnings = $request->input('earnings');
        $service->savings = $request->input('savings');
        $service->costsIncurred = $request->input('costsIncurred');
        $service->personalExpenses = $request->input('personalExpenses');
        $service->date = date("Y-m-d");

        $service->user = Auth::user()->id;
        $service->save();
        return response()->json(['error' => false, 'message' => 'Service Succesfully Recorded']);
        
    }

    
    public function show($id)
    {
        //Get single Service

        $service = Service::find($id);

        //Return user details
        $result = new ServiceResource($service);

        if($service){
            return response()->json(['service'=>$result, 'error'=>false, 'message'=>'Details succesfully fetched']);
        }
        else return response()->json(['error'=>true, 'message'=>'Error fetching data']);
    }

    // public function edit($id)
    // {
    //     //
    // }

    
    // public function update(Request $request, $id)
    // {
    //     //
    // }
    
    // public function destroy($id)
    // {
    //     //
    // }
}
