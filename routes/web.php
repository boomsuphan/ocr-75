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

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::get('/pending_status', 'HomeController@pending_status');

Auth::routes();

Route::get('/demo/home', function () {
    return view('demo/home');
});
Route::get('/demo/qrcode', function () {
    return view('demo/qrcode');
});
Route::get('/demo/history', function () {
    return view('demo/history');
});
Route::get('/demo/history2', function () {
    return view('demo/history2');
});
Route::get('/demo/home2', function () {
    return view('demo/home2');
});
Route::get('/demo/manage_user', function () {
    return view('demo/manage_user');
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
    // Route::resource('room', 'RoomController');
});

// แอดมิน, เจ้าหน้าที่
Route::middleware(['auth', 'role:admin,officer'])->group(function () {

    // จัดการ semesters
    Route::get('create_semesters', 'SemestersController@create_semesters');
    Route::post('save_semesters', 'SemestersController@save_semesters');
    Route::get('delete_semester/{id}', 'SemestersController@delete_semester');

    // จัดการห้องเรียน
    Route::get('/create_room', 'RoomController@create_room');
    Route::post('/save_room', 'RoomController@save_room');
    Route::post('/delete_room', 'RoomController@delete_room');

    Route::get('scan_qr', 'BookingController@scan_qr');
    Route::get('check_qr/{code}', 'BookingController@check_qr');
    Route::get('data_of_booking/{code}', 'BookingController@data_of_booking');
    Route::post('save_give_key', 'BookingController@save_give_key');
    Route::post('save_return_key', 'BookingController@save_return_key');
    Route::get('manage_user', 'BookingController@manage_user');
    Route::resource('faculties', 'FacultiesController');
    Route::resource('majors', 'MajorsController');
    Route::get('admin/user/{id}/edit', 'BookingController@admin_edit_user')->name('admin.user.edit');
    Route::post('admin/user/{id}/update', 'BookingController@admin_update_user')->name('admin.user.update');
    Route::get('admin/manage_room', 'RoomController@manage_room');
    Route::get('room_detail/{room_id}', 'RoomController@room_detail');
    Route::post('/cancel_booking', 'BookingController@cancel_booking');
    Route::post('/room/add_recurring', 'RoomController@addRecurringSchedule');

    Route::get('/admin/report', 'RoomController@report_index');
    Route::post('/admin/report/export', 'RoomController@export_excel');
});

// แอดมิน, เจ้าหน้าที่, อาจารย์
Route::middleware(['auth', 'role:admin,officer,professor'])->group(function () {
    // 
});

// แอดมิน, เจ้าหน้าที่, อาจารย์, นักศึกษา
Route::middleware(['auth', 'role:admin,officer,professor,students'])->group(function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('booking', 'BookingController')->except(['create','show']);
    Route::get('create_booking/{room_id}', 'BookingController@create_booking');
    Route::get('booking/show_qr/{code}', 'BookingController@show_qr');
    Route::get('get_data_create_booking/{room_id}', 'BookingController@get_data_create_booking');
    Route::get('history', 'BookingController@booking_history');
    Route::get('profile', 'HomeController@profile');
    Route::post('profile/update', 'HomeController@update_profile');
});


