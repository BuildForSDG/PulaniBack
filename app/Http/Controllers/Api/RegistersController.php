<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistersController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [

            'title'                => 'required|max:20',
            'lastName'             => 'required|max:20',
            'firstName'            => 'required|max:20',
            'otherName'            => 'max:20',
            'dateOfBirth'          => 'required|string',
            'gender'               => 'required:max:20',
            'phone'                => 'required|max:20| unique:users',
            'email'                => 'required|email|unique:users',
            'idType'               => 'required',
            'idNumber'             => 'required|max:30',
            'idDateOfIssue'        => 'required',
            'idExpiryDate'         => 'required',
            'businesName'          => 'required|string',
            'businessAddress'      => 'required|string',
            'yearsOfBusiness'      => 'required|int',
            'totalBusinessCapital' => 'required|int',
            'areaOfResidence'      => 'required',
            'numberOfDependants'   => 'required|int',
            'nextOfKin'            => 'required|string',
            'password'             => 'required|string|min:8|confirmed',
        ]);

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
        $user->businesName          = $request->input('businesName');
        $user->businessAddress      = $request->input('businessAddress');
        $user->photo                = $request->input('photo');
        $user->yearsOfBusiness      = $request->input('yearsOfBusiness');
        $user->totalBusinessCapital = $request->input('totalBusinessCapital');
        $user->areaOfResidence      = $request->input('areaOfResidence');
        $user->numberOfDependants   = $request->input('numberOfDependants');
        $user->nextOfKin            = $request->input('nextOfKin');
        $user->password = Hash::make($request->input('password'));

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
