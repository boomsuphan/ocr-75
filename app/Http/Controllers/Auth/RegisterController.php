<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\Faculty;
use App\Models\Major;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fullname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'unique:users'],
            'std_id'   => ['required', 'string', 'max:20', 'unique:users'],
            'phone'    => ['required', 'string', 'max:15'], // เพิ่มเบอร์โทร
            'faculty'  => ['required', 'exists:faculties,id'], // ใช้ชื่อ faculty ตาม DB
            'major'    => ['required', 'exists:majors,id'],   // ใช้ชื่อ major ตาม DB
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'photo'    => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ], [
            'username.unique' => 'ชื่อผู้ใช้งานนี้ถูกใช้ไปแล้ว',
            'email.unique' => 'อีเมลนี้ถูกใช้งานไปแล้ว',
            'std_id.unique' => 'รหัสนักศึกษานี้ลงทะเบียนไปแล้ว',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // 1. จัดการอัปโหลดรูปภาพ
        $photoPath = null;
        if (isset($data['photo'])) {
            // บันทึกไฟล์ลง storage/app/public/profile_photos
            $photoPath = $data['photo']->store('profile_photos', 'public');
        }

        // 2. บันทึกข้อมูล (Map ให้ตรงกับ $fillable ใน User.php)
        return User::create([
            'name'      => $data['fullname'],
            'fullname'  => $data['fullname'],
            'username'  => $data['username'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
            
            'std_id'    => $data['std_id'],
            'faculty'   => $data['faculty'],
            'major'     => $data['major'],
            'phone'     => $data['phone'],
            'photo'     => $photoPath,
            
            // กำหนดค่า Default
            'role'      => null,
            'status'    => 'Pending',
        ]);
    }

    public function showRegistrationForm()
    {
        $faculties = Faculty::all();
        return view('auth.register', compact('faculties'));
    }

    public function getMajors($faculty_id)
    {
        $majors = Major::where('faculty_id', $faculty_id)->get();
        return response()->json($majors);
    }
}
