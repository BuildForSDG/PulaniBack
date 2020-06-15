<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistersController extends Controller
{
    public function validator(Request $request)
    {
        return Validator::make($request, [
            'title'                => 'max:20',
            'lastName'             => 'required|max:20',
            'firstName'            => 'required|max:20',
            'otherName'            => 'max:20',
            'dateOfBirth'          => 'string',
            'gender'               => 'max:20',
            'phone'                => 'required|max:20| unique:users',
            'email'                => 'required|email|unique:users',            
            'idNumber'             => 'required|max:30',         
            'businesName'          => 'string',
            'businessAddress'      => 'string',
            'yearsOfBusiness'      => 'int',
            'totalBusinessCapital' => 'int',
            'areaOfResidence'      => 'string',
            'numberOfDependants'   => 'int',
            'nextOfKin'            => 'string',
            'password'             => 'required|string|min:8|confirmed',
        ]);
    }

    public function create(Request $request)
    {        
        $user                       = $request->isMethod('put') ? User::findOrFail($request->$id) : new User;
        $user->title                = $request->input('title');
        $user->lastName             = $request->input('lastName');
        $user->firstName            = $request->input('firstName');
        $user->otherName            = $request->input('otherName');
        $user->gender               = $request->input('gender');
        $user->dateOfBirth          = $request->input('dateOfBirth');
        $user->phone                = $request->input('phone');
        $user->email                = $request->input('email');
        $user->idType               = $request->input('idType');
        $user->idNumber             = $request->input('idNumber');
        $user->idDateOfIssue        = $request->input('idDateOfIssue');
        $user->idExpiryDate         = $request->input('idExpiryDate');
        $user->businessName          = $request->input('businessName');
        $user->businessAddress      = $request->input('businessAddress');
        $user->photo                = $request->input('photo');
        $user->yearsOfBusiness      = $request->input('yearsOfBusiness');
        $user->totalBusinessCapital = $request->input('totalBusinessCapital');
        $user->areaOfResidence      = $request->input('areaOfResidence');
        $user->numberOfDependants   = $request->input('numberOfDependants');
        $user->nextOfKin            = $request->input('nextOfKin');
        $user->password             = Hash::make($request->input('password'));
        
        $isEmailExists = User::where('email', $user['email'])->count();
        $isPhoneValid  = User::where('phone', $user['phone'])->count();
        if ($isEmailExists) {
            return response()->json(['error' => true, 'message' => 'User already Registered']);
        } else if ($isPhoneValid) {
            return response()->json(['error' => true, 'message' => 'Phone already in use']);
        } else {
            $user->save();
            $role = Role::select('id')->where('name', 'user')->first();
            $user->attachRole($role); 
            return response()->json(['error' => false, 'message' => 'User Succesfully Registered']);
        }
    }
}
