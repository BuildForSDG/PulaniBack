<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Goal;
use App\Role;
use App\Http\Resources\Goal as GoalResource;
use App\Http\Requests;

class GoalsController extends Controller
{


    /**
     * Display Goals
     *
     * @return \Illuminate\Http\Response
     */
    //Goals api function
    public function index()
    {
        //Show Goals
        $goals = Goal::latest()->paginate(9);

        //Return collection
        return GoalResource::collection($goals);
    }


    /**
     * Displays Goals list
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get single Goal
        $goal = Goal::findOrFail($id);

        //Return goal details
        return new GoalResource($goal);
    }

    //Create or update goals details via API, When the request type is put, it updates else creates

    public function create(Request $request)
    {
        //Validate before inserting goal's records

        $validate = Validator::make($request->all(), [

            'name'        => 'required|max:20',
            'amount' => 'required|numeric',
            'period' => 'required|max:20',
            'unit' => 'required|max:20',

        ]);

        $goal = new Goal;

        $goal->name = $request->input('name');
        $goal->amount = $request->input('amount');
        $goal->period = $request->input('period');
        $goal->unit = $request->input('unit');
        $goal->date = date("Y-m-d");
        $goal->dateOfBirth = $request->input('dateOfBirth');

        $goal->user_id = Auth::user()->id;
        $goal->save();

        //Validate
        if ($validate->fails()) {
            return response()->json(['error' => true, 'errors' => $validate->errors()], 422);
        }


        return response()->json(['error' => false, 'message' => 'Goal Succesfully Set']);
    }

    //Delete goals ---this should be done by administrator
    public function destroy($id)
    {

        $goal = Goal::findOrFail($id);

        //Check before deleting
        if ($goal->delete()) {
            return new GoalResource($goal);
        }
    }
}
