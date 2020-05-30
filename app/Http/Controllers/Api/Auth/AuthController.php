<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        if (is_numeric($request->get('email'))) {
            return ['phone' => $request->get('email'), 'password' => $request->get('password')];
        } elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->get('email'), 'password' => $request->get('password')];
        }
        //return ['phone' => $request->get('phone'), 'password'=>$request->get('password')];
        return response()->json(['error' => false, 'message' => 'Login Succesfull']);

        //$credentials = $request->only('email', 'password');
        // if ($token = $this->guard()->attempt($credentials)) {
        //     //return $this->respondWithToken($token);
        //     return response()->json(['error' => false, 'token' => $token, 'message' => 'Login Succesfull', 'user' => $this->guard()->user()]);
        // }
        // //Response when error occurs
        // return response()->json(['error' => true, 'message' => 'Incorrect login credentials'], 401);
    }

    public function me()
    {
        return response()->json($this->guard()->user());
    }

    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => $this->guard()->factory()->getTTL() * 60,
        ]);
    }

    public function guard()
    {
        return Auth::guard('api');
    }
}
