<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Faculty;
use App\Models\Major;

use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $perPage = 25;
        $room = Room::all();

        return view('home', compact('room'));
    }

    public function pending_status(){
        return view('pending_status');
    }

    public function profile(Request $request)
    {
        $user = Auth::user();
        $data_user = User::with(['facultyDetail', 'majorDetail'])
                        ->where('id', $user->id)
                        ->firstOrFail();

        // ดึงข้อมูลคณะ
        $faculties = Faculty::all();

        return view('profile', compact('data_user', 'faculties'));
    }

    public function update_profile(Request $request)
    {
        $user = Auth::user();

        // --- 1. กำหนดกฎการตรวจสอบ ---
        $rules = [
            'fullname' => 'required|string|max:255',
            'faculty'  => 'required',
            'major'    => 'required',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
            // รหัสนักศึกษาห้ามซ้ำ ยกเว้นของตัวเอง
            'std_id'   => [
                'required',
                Rule::unique('users', 'std_id')->ignore($user->id),
            ],
        ];

        // --- 2. ตรวจสอบอีเมล ---
        // ถ้ามีการกรอกอีเมลมา เช็คห้ามซ้ำ
        if (!empty($request->email)) {
            $rules['email'] = [
                'email',
                Rule::unique('users', 'email')->ignore($user->id)
            ];
        }

        $request->validate($rules, [
            'std_id.unique' => 'รหัสนักศึกษานี้มีอยู่ในระบบแล้ว',
            'email.unique'  => 'อีเมลนี้ถูกใช้งานแล้ว',
            'photo.image'   => 'ไฟล์ที่อัปโหลดต้องเป็นรูปภาพเท่านั้น',
            'photo.max'     => 'รูปภาพต้องมีขนาดไม่เกิน 2MB',
        ]);

        // --- 3. อัปเดตข้อมูล ---
        $userUpdate = User::find($user->id);

        $userUpdate->fullname   = $request->fullname;
        $userUpdate->std_id     = $request->std_id;
        $userUpdate->faculty_id = $request->faculty;
        $userUpdate->major_id   = $request->major;

        // อีเมล ถ้าว่างให้เก็บเป็น NULL
        $userUpdate->email = empty($request->email) ? null : $request->email;

        // --- 4. จัดการรูปภาพ (ถ้ามีการอัปโหลดใหม่) ---
        if ($request->hasFile('photo')) {
            // ลบรูปเก่าทิ้ง
            if ($userUpdate->photo && Storage::disk('public')->exists($userUpdate->photo)) {
                Storage::disk('public')->delete($userUpdate->photo);
            }

            // บันทึกรูปใหม่
            $path = $request->file('photo')->store('profile_photos', 'public');
            $userUpdate->photo = $path;
        }

        $userUpdate->save();

        return redirect()->back()->with('success', 'บันทึกข้อมูลส่วนตัวเรียบร้อยแล้ว');
    }
}
