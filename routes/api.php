<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//User API routes
Route::get ('/users', [
    'as' => 'users.index',
     'uses' => 'Api\UsersController@index'
]);

Route::get ('/user/{id}', [
    'as' => 'user.show',
     'uses' => 'Api\UsersController@show'
]);

Route::post ('/user/createuser', [
    'as' => 'user.createuser',
     'uses' => 'Api\UsersController@createuser'
]);


Route::post ('/auth/login', [
    'as' => 'login',
     'uses' => 'Api\Auth\AuthController@login'
]);

Route::post ('/auth/logout', [
    'as' => 'logout',
     'uses' => 'Api\Auth\AuthController@logout'
]);

Route::post ('/auth/refresh', [
    'as' => 'refresh',
     'uses' => 'Api\Auth\AuthController@refresh'
]);

Route::post ('/auth/self', [
    'as' => 'me',
     'uses' => 'Api\Auth\AuthController@me'
]);

//Load routes
Route::get ('/loans', [
    'as' => 'loans.index',
     'uses' => 'Api\LoansController@index'
]);

Route::get ('/loan/{id}', [
    'as' => 'loans.show',
     'uses' => 'Api\LoansController@show'
]);

Route::post ('/loan/createloanrequest', [
    'as' => 'loan.createloanrequest',
     'uses' => 'Api\LoansController@createLoan'
]);

