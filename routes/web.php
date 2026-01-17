<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/demo/home', function () {
    return view('demo/home');
});
Route::get('/demo/qrcode', function () {
    return view('demo/qrcode');
});
Route::get('/demo/history', function () {
    return view('demo/history');
});
Route::get('/demo/home2', function () {
    return view('demo/home2');
});
// ROLE
// ---------------------------------------------//
// admin >> แอดมิน
// officer  >> เจ้าหน้าที่
// professor >> อาจารย์
// students >> นักศึกษา
// ---------------------------------------------//

// แอดมิน
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('room', 'RoomController');
});

// แอดมิน, เจ้าหน้าที่
Route::middleware(['auth', 'role:admin,officer'])->group(function () {
    Route::get('scan_qr', 'BookingController@scan_qr');
    Route::get('check_qr/{code}', 'BookingController@check_qr');
    Route::post('save_give_key', 'BookingController@save_give_key');
    Route::post('save_return_key', 'BookingController@save_return_key');
});

// แอดมิน, เจ้าหน้าที่, อาจารย์
Route::middleware(['auth', 'role:admin,officer,professor'])->group(function () {
    // 
});

// แอดมิน, เจ้าหน้าที่, อาจารย์, นักศึกษา
Route::middleware(['auth', 'role:admin,officer,professor,students'])->group(function () {
    Route::resource('booking', 'BookingController')->except(['create','show']);
    Route::get('create_booking/{room_id}', 'BookingController@create_booking');
    Route::get('booking/show_qr/{code}', 'BookingController@show_qr');
    Route::get('room_detail/{room_id}', 'RoomController@room_detail');
});


Route::resource('semesters', 'SemestersController');