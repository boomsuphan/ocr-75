<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Room;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Faculty;
use App\Models\Major;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $booking = Booking::where('room_id', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('subject', 'LIKE', "%$keyword%")
                ->orWhere('name_professor', 'LIKE', "%$keyword%")
                ->orWhere('note', 'LIKE', "%$keyword%")
                ->orWhere('semester', 'LIKE', "%$keyword%")
                ->orWhere('date_booking', 'LIKE', "%$keyword%")
                ->orWhere('time_start_booking', 'LIKE', "%$keyword%")
                ->orWhere('time_end_booking', 'LIKE', "%$keyword%")
                ->orWhere('time_get_key', 'LIKE', "%$keyword%")
                ->orWhere('time_return_key', 'LIKE', "%$keyword%")
                ->orWhere('code_for_qr', 'LIKE', "%$keyword%")
                ->orWhere('id_officer_give_key', 'LIKE', "%$keyword%")
                ->orWhere('id_officer_return_key', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $booking = Booking::latest()->paginate($perPage);
        }

        return view('booking.index', compact('booking'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('booking.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();

        do {
            // สุ่มตัวอักษรและตัวเลข 8 หลัก 
            $code = Str::random(8);
            
            // แปลงเป็นตัวพิมพ์ใหญ่
            $code = strtoupper($code);

        // ตรวจสอบในตาราง bookings มี code นี้หรือยัง ถ้ามีแล้วให้ทำใหม่
        } while (Booking::where('code_for_qr', $code)->exists());

        $requestData['code_for_qr'] = $code;
        $requestData['status'] = "จองเรียบร้อย";
        
        Booking::create($requestData);

        return redirect('booking/show_qr/'.$code)->with('flash_message', 'Booking added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $booking = Booking::findOrFail($id);

        return view('booking.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);

        return view('booking.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $booking = Booking::findOrFail($id);
        $booking->update($requestData);

        return redirect('booking')->with('flash_message', 'Booking updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Booking::destroy($id);

        return redirect('booking')->with('flash_message', 'Booking deleted!');
    }

    public function create_booking(Request $request, $room_id)
    {
        
        $requestData = $request->all();

        $rooms = Room::where('id' , $room_id)->first();
        $data_user = Auth::user();

        $currentSemester = Semester::whereDate('date_start', '<=', Carbon::now())
                                   ->whereDate('date_end', '>=', Carbon::now())
                                   ->first();

        return view('booking.create_booking', compact('rooms','data_user','currentSemester'));
    }

    public function show_qr(Request $request, $code)
    {
        
        $requestData = $request->all();

        $data_user = Auth::user();
        $bookings = Booking::where('code_for_qr' , $code)->first();
        $rooms = Room::where('id' , $bookings->room_id)->first();

        return view('booking.show_qr', compact('data_user','bookings','rooms'));
    }

    public function scan_qr(Request $request)
    {
        
        $requestData = $request->all();
        $data_user = Auth::user();

        return view('admin.scan_qr', compact('data_user'));
    }

    public function check_qr($code)
    {
        $data_user = Auth::user();
        $bookings = Booking::with('user')->where('code_for_qr' , $code)->first(); 
        
        if(!$bookings) {
            return redirect('scan_qr')->with('error', 'ไม่พบข้อมูลการจอง หรือ QR Code ไม่ถูกต้อง');
        }

        $rooms = Room::where('id' , $bookings->room_id)->first();

        if ($bookings->status == 'จองเรียบร้อย') {
            // เคส 1: มาเบิกกุญแจ
            return view('admin.confirm_get_keys', compact('data_user','bookings','rooms'));

        } elseif ($bookings->status == 'รับกุญแจแล้ว') {
            // เคส 2: มาคืนกุญแจ
            return view('admin.confirm_return_key', compact('data_user','bookings','rooms'));

        } else {
            // เคส 3: สถานะอื่นๆ
            return redirect('room_detail/' . $rooms->id)->with('error', 'ไม่สามารถทำรายการได้ สถานะปัจจุบัน: '.$bookings->status);
        }
    }

    public function save_give_key(Request $request)
    {
        $booking = Booking::find($request->booking_id);
        
        $randomCode = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

        $booking->update([
            'status' => 'รับกุญแจแล้ว',
            'time_get_key' => now(),
            'id_officer_give_key' => Auth::id(),
            'return_verify_code' => $randomCode
        ]);

        return redirect('room_detail/' . $booking->room_id)->with('flash_message', 'บันทึกการเบิกกุญแจสำเร็จ');
    }

    public function save_return_key(Request $request)
    {
        $request->validate([
            'verify_code' => 'required|numeric|digits:4',
        ]);

        $booking = Booking::find($request->booking_id);

        // 1. ตรวจสอบสถานะ
        if ($booking->status != 'รับกุญแจแล้ว') {
            return redirect('scan_qr')->with('error', 'สถานะไม่ถูกต้อง');
        }

        // 2. *** ตรวจสอบรหัสยืนยัน *** 
        if ($booking->return_verify_code !== $request->verify_code) {
            return redirect()->back()->with('error', 'รหัสยืนยันไม่ถูกต้อง! กรุณาถามรหัสจากนักศึกษาใหม่อีกครั้ง');
        }

        // 3. รหัสถูกต้อง บันทึกข้อมูล
        $booking->update([
            'status' => 'คืนกุญแจแล้ว',
            'time_return_key' => now(),
            'id_officer_return_key' => Auth::id()
        ]);

        return redirect('room_detail/' . $booking->room_id)->with('flash_message', 'รับคืนกุญแจเรียบร้อย! (รหัสยืนยันถูกต้อง)');
    }

    public function get_data_create_booking($room_id)
    {
        $rooms = Booking::where('room_id' , $room_id)->get();
        return response()->json($rooms);

    }

    public function manage_user(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        // 1. จัดการ User Active
        $queryActive = User::with(['facultyDetail', 'majorDetail'])
                        ->where('status', '!=', 'Pending')
                        ->where('role', '!=', 'admin'); 

        if (!empty($keyword)) {
            $queryActive->where(function ($query) use ($keyword) {
                $query->where('username', 'LIKE', "%$keyword%")
                      ->orWhere('fullname', 'LIKE', "%$keyword%")
                      ->orWhere('std_id', 'LIKE', "%$keyword%");
            });
        }
        $user_active = $queryActive->latest()->paginate($perPage);

        // 2. จัดการ User Pending
        $user_pending = User::with(['facultyDetail', 'majorDetail'])
                        ->where('status', 'Pending')
                        ->get();

        $faculties = Faculty::all();

        return view('admin.manage_user', compact('user_active', 'user_pending', 'faculties'));
    }

    public function approve_member(Request $request) {
        $userId = $request->user_id;
        $action = $request->action; // 'approve' หรือ 'reject'
        $reason = $request->reason; // มีเฉพาะตอน reject
        
        if ($action === 'approve') {
            // อัพเดทสถานะเป็นอนุมัติ
            User::where('id', $userId)->update([
                'status' => 'Active',
                'role'   => 'students',
            ]);
            
            return response()->json(['success' => true]);
        } else {
            // อัพเดทสถานะเป็นปฏิเสธ
            User::where('id', $userId)->update([
                'status' => 'Inactive',
            ]);
            
            return response()->json(['success' => true]);
        }
    }
    public function approve_all_members(Request $request) {
        try {
            // อัพเดทสมาชิกทั้งหมดที่รอการอนุมัติ
            $updated = User::where('status', 'Pending')
                ->update([
                'status' => 'Active',
                'role'   => 'students',
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'อนุมัติสมาชิกทั้งหมดเรียบร้อยแล้ว',
                'count' => $updated
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
            ], 500);
        }
    }
    // เพิ่มใน BookingController

    // public function add_member(Request $request) {

    //     $request['faculty_id'] = $request['faculty'] ;
    //     $request['major_id'] = $request['major'] ;

    //     $fullname = $request['fullname'];
    //     $std_id = $request['std_id'];
    //     $faculty = $request['faculty_id'];
    //     $major = $request['major_id'];
    //     $email = $request['email'];
    //     $username = $request['username'];
    //     $password = uniqid();
        
   
    //     // สร้างสมาชิกใหม่
    //     $user = new User();
    //     $user->fullname = $fullname;
    //     $user->std_id = $std_id;
    //     $user->faculty = $faculty;
    //     $user->major = $major;
    //     $user->email = $email;
    //     $user->username = $username;
    //     $user->password = $password;
    //     // $user->photo = $photoPath;
    //     $user->status = $request->status ?? 'Pending';
    //     $user->role = 'นักศึกษา'; // หรือตามที่ต้องการ
    //     $user->save();
        
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'เพิ่มสมาชิกเรียบร้อยแล้ว',
    //         'user_id' => $user->id
    //     ]);
        
    // }

    public function add_member(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'std_id'   => 'required|string|max:20|unique:users,std_id',
            'faculty'  => 'required|exists:faculties,id', 
            'major'    => 'required|exists:majors,id',  
            'email'    => 'nullable|string|max:255', 
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|min:8',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'std_id.unique'   => 'รหัสนักศึกษานี้มีในระบบแล้ว',
            'username.unique' => 'Username นี้ถูกใช้งานแล้ว',
            'faculty.exists'  => 'ไม่พบข้อมูลคณะที่เลือก',
            'photo.max'       => 'รูปภาพต้องมีขนาดไม่เกิน 2MB',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ]);
        }

        // 2. จัดการรูปภาพ
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('profile_photos', 'public');
        }

        // 3. บันทึกข้อมูล
        try {
            $user = new User();
            $user->fullname = $request->fullname;
            $user->name = $request->fullname;
            $user->std_id   = $request->std_id;
            $user->faculty_id  = $request->faculty; 
            $user->major_id    = $request->major;
            $user->email    = $request->email; 
            
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            
            $user->photo    = $photoPath;
            $user->status   = $request->status; 
            $user->role     = 'students'; 
            
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'เพิ่มสมาชิกเรียบร้อยแล้ว',
                'data_user' => $user,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage()
            ]);
        }
    }

    public function admin_edit_user(Request $request, $user_id)
    {
        $data_user = User::with(['facultyDetail', 'majorDetail'])
                        ->where('id', $user_id)
                        ->firstOrFail();

        // ดึงข้อมูลคณะ
        $faculties = Faculty::all();

        return view('admin.admin_edit_user', compact('data_user', 'faculties'));
    }

    public function admin_update_user(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        $user->fullname = $request->fullname;
        $user->name = $request->fullname;
        $user->std_id = $request->std_id;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->faculty_id = $request->faculty;
        $user->major_id = $request->major;
        $user->status = $request->status;

        // ถ้ามีการกรอก Password ใหม่มา ให้ทำการ Hash และบันทึก
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // จัดการรูปภาพ
        if ($request->hasFile('photo')) {
            // ลบรูปเก่า (ถ้ามี)
            if($user->photo) Storage::disk('public')->delete($user->photo);
            $user->photo = $request->file('photo')->store('profile_photos', 'public');
        }

        $user->save();

        return redirect()->back()->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }
}
