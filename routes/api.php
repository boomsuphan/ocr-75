<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('majors/{faculty_id}', 'Auth\RegisterController@getMajors');

Route::get('/get_data_create_booking/{room_id}', 'BookingController@get_data_create_booking');
Route::post('/approve_member', 'BookingController@approve_member');
Route::post('/approve_all_members', 'BookingController@approve_all_members');
Route::post('/add_member', 'BookingController@add_member');
