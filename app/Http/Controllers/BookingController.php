<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
            return redirect('scan_qr')->with('error', 'ไม่สามารถทำรายการได้ สถานะปัจจุบัน: '.$bookings->status);
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

        return redirect('scan_qr')->with('flash_message', 'รับคืนกุญแจเรียบร้อย! (รหัสยืนยันถูกต้อง)');
    }

    public function get_data_create_booking($room_id)
    {
        $rooms = Booking::where('room_id' , $room_id)->get();
        return response()->json($rooms);

    }
}
