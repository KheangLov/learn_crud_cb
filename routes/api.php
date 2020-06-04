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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/register', 'EmployeePasswordController@register');
Route::post('auth/login', 'EmployeePasswordController@login');
Route::group(['middleware' => 'jwt.auth'], function() {
    Route::get('employee', 'EmployeePasswordController@employee');
    Route::get('refresh', 'EmployeePasswordController@refresh');
    Route::get('employees', 'EmployeePasswordController@list');
    Route::get('employee/{id}', 'EmployeePasswordController@edit');
    Route::put('employee/{id}', 'EmployeePasswordController@update');
    Route::post('employee/profile/{id}', 'EmployeePasswordController@profile_upload')->middleware('postToPut');
});
