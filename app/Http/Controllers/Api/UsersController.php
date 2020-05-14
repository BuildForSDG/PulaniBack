<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Loan;
use App\Role;
use Auth;
use App\Http\Resources\User as UserResource;
use App\Http\Requests;

class UsersController extends Controller
{
     //Create new user via API

     public function createuser(Request $request){
          //Validate before inserting

       $user = $request ->isMethod('put')? User :: findOrFail
       ($request->$id) : new User;

        $user -> title = $request->input ('title');
        $user -> lastName = $request->input ('lastName');
        $user -> firstName = $request->input ('firstName');
        $user -> otherName = $request->input ('otherName');
        $user -> dateOfBirth = $request->input ('dateOfBirth');
       
        $user -> phone = $request->input ('phone');
        $user -> email = $request->input ('email');
        $user -> idtype = $request->input ('idtype');
        $user -> idNumber = $request->input ('idNumber');
        $user -> idDateOfIssue = $request->input ('idDateOfIssue');
        $user -> idExpiryDate = $request->input ('idExpiryDate');
        $user -> businesName = $request->input ('businesName');
        $user -> businessAddress = $request->input ('businessAddress');

        $user -> yearsOfBusiness = $request->input ('yearsOfBusiness');
        $user -> totalBusinessCapital = $request->input ('totalBusinessCapital');
        $user -> areaOfResidence = $request->input ('areaOfResidence');
        $user -> numberOfDependants = $request->input ('numberOfDependants');
        $user -> nextOfKin = $request->input ('nextOfKin');
        $user -> password = Hash::make($request->input ('password'));

        $isEmailExists = User::where('email', $user['email'])->count();
        $isPhoneValid = User::where('phone', $user['phone'])->count();
        if($isEmailExists){
            return response()->json(['error' => true, 'message'=> 'User already Registered']);
        
        } else if($isPhoneValid){
            return response()->json(['error' => true, 'message'=> 'Phone already in use']); 
        }   
            else{
                $user->save();
                //$user->save();
                //Very important. You should save before attaching a role
                $role = Role :: select ('id')->where('name', 'user')->first();
                $user->attachRole($role); // parameter can be a Role object, array, id or the role string name
                return response()->json(['error' => false, 'message'=> 'User Succesfully Registered']);
        }
     }

    /**
     * Display users
     *
     * @return \Illuminate\Http\Response
     */
    //User User api function
     public function index()
    {
       //Show Users
       $users = User ::  latest()->paginate(9);

       //Return collection
       return UserResource :: collection ($users);
    }


    /**
     * Displays Users list
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        //Get single User

        $user = User ::findOrFail($id);

        //Return user details
        return new UserResource ($user);
         
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $user = User::findOrFail($id);
        $roles = Role::all();
        //Check right user
        return new UserResource ($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request,
        [   
            'name'        => 'required|string|min:4',
            'phone' => 'required|min:10',
            'email' => 'email|min:10|required',
            'country' => 'max:30',
            'password' => 'required|min:5|max:30',
            'confirm-password' => 'same:password',
        ]
    );
        //Update users

            $user = User::findOrFail($id);
            $user -> name = $request->input ('name');
            $user -> phone = $request->input ('phone');
            $user -> email = $request->input ('email');
            $user -> country = $request->input ('country');
            $user -> password = Hash::make($request->input ('password'));
            $user->save();
            return new UserResource ($user);
            
            }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        
        $user = User ::findOrFail($id);

        //Check before deleting
        if ($user->delete()){
            return new UserResource ($user);
        }
        
    }

}
