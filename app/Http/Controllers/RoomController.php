<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Models\Semester;
use Illuminate\Support\Facades\Hash;
use App\Models\Room;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Str;

class RoomController extends Controller
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
            $room = Room::where('name', 'LIKE', "%$keyword%")
                ->orWhere('floor', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $room = Room::latest()->paginate($perPage);
        }

        return view('room.index', compact('room'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('room.create');
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
        
        Room::create($requestData);

        return redirect('room')->with('flash_message', 'Room added!');
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
        $room = Room::findOrFail($id);

        return view('room.show', compact('room'));
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
        $room = Room::findOrFail($id);

        return view('room.edit', compact('room'));
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
        
        $room = Room::findOrFail($id);
        $room->update($requestData);

        return redirect('room')->with('flash_message', 'Room updated!');
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
        Room::destroy($id);

        return redirect('room')->with('flash_message', 'Room deleted!');
    }

    public function room_detail($id)
    {
        $room = Room::findOrFail($id);
        $booking = Booking::where('room_id' , $room->id)->orderBy('date_booking','DESC')->get();
        $semesters = Semester::get();

        return view('room.room_detail', compact('room','booking','semesters'));
    }

     public function manage_room(Request $request)
    {
        $perPage = 25;
        $room = Room::all();

        return view('admin.manage_room', compact('room'));
    }

    public function addRecurringSchedule(Request $request)
    {
        // ดึงข้อมูลภาคการศึกษา
        $semester = Semester::findOrFail($request->semester_id);
        
        // แปลงวันเริ่ม-จบ เป็น Carbon Object
        $startDate = \Carbon\Carbon::parse($semester->date_start);
        $endDate = \Carbon\Carbon::parse($semester->date_end);
        
        // วันที่เลือก (0=อาทิตย์, 1=จันทร์, ... 6=เสาร์)
        $targetDay = (int)$request->day_of_week; 

        // สูตร: (วันเป้าหมาย - วันปัจจุบัน + 7) % 7 = จำนวนวันที่ต้องบวกเพิ่ม
        $daysToAdd = ($targetDay - $startDate->dayOfWeek + 7) % 7;
        
        // ขยับวันเริ่มต้นไปให้ตรงกับวันที่เลือกเรียนวันแรก
        $startDate->addDays($daysToAdd);
        // -------------------

        $count = 0;
        $errors = [];

        // เริ่มวนลูป ทีละ 1 สัปดาห์ จนกว่าจะเลยวันปิดเทอม
        while ($startDate->lte($endDate)) {
            
            $dateStr = $startDate->format('Y-m-d');

            // --- เช็คก่อนว่าวัน/เวลานั้น ว่างไหม (เช็คการจองซ้อน) ---
            $isBusy = Booking::where('room_id', $request->room_id)
                ->where('date_booking', $dateStr)
                ->where(function($q) use ($request) {
                    // เช็คช่วงเวลาเหลื่อมกัน
                    $q->whereBetween('time_start_booking', [$request->time_start, $request->time_end])
                      ->orWhereBetween('time_end_booking', [$request->time_start, $request->time_end])
                      ->orWhere(function($sq) use ($request) {
                          $sq->where('time_start_booking', '<=', $request->time_start)
                             ->where('time_end_booking', '>=', $request->time_end);
                      });
                })
                ->where('status', '!=', 'ยกเลิก') // ไม่นับรายการที่ถูกยกเลิกไปแล้ว
                ->exists();

            if (!$isBusy) {
                // สร้างรหัสสำหรับการจอง
                $randomCode = strtoupper(Str::random(10));

                // ถ้าว่าง -> สร้าง Booking
                Booking::create([
                    'room_id' => $request->room_id,
                    'user_id' => Auth::id(),
                    'code_for_qr' => $randomCode,
                    'subject' => $request->subject,
                    'name_professor' => $request->name_professor,
                    'note' => "ตารางเรียนประจำ (Recurring)",
                    'semester' => $semester->name,
                    'date_booking' => $dateStr,
                    'time_start_booking' => $request->time_start,
                    'time_end_booking' => $request->time_end,
                    'status' => 'จองเรียบร้อย',
                ]);
                $count++;
            } else {
                // ถ้าไม่ว่าง เก็บวันที่ไว้แจ้งเตือน
                // ใช้ thaidate (ถ้ามี helper) หรือ format ธรรมดา
                $errors[] = \Carbon\Carbon::parse($dateStr)->format('d/m/Y');
            }

            // บวกไปอีก 1 สัปดาห์
            $startDate->addWeek();
        }

        // สร้างข้อความแจ้งผลลัพธ์
        $msg = "เพิ่มตารางเรียนสำเร็จ $count รายการ";
        
        if (count($errors) > 0) {
            $msg .= " (แต่มีวันที่ไม่ว่าง " . count($errors) . " วัน ได้แก่: " . implode(', ', $errors) . ")";
            // ส่งกลับพร้อมแจ้งเตือน
            return back()->with('warning', $msg); 
        }

        return back()->with('success', $msg);
    }

    public function create_room()
    {
        $rooms = Room::orderByRaw('CAST(floor AS UNSIGNED) ASC')
                ->orderBy('name', 'asc')
                ->get();
        
        return view('room.create_room', compact('rooms'));
    }

    public function update_status(Request $request)
    {
        $room = Room::find($request->room_id);
        if ($room) {
            $room->status = $request->status;
            $room->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function save_room(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:rooms,name',
            'status' => 'required|in:Active,Inactive',
        ], [
            'name.unique' => 'ชื่อห้องนี้มีอยู่ในระบบแล้ว',
        ]);

        Room::create([
            'name' => $request->name,
            'floor' => $request->floor,
            'status' => $request->status,
        ]);

        return back()->with('success', 'เพิ่มห้องเรียนเรียบร้อยแล้ว');
    }

    public function delete_room(Request $request)
    {
        // ตรวจสอบว่ามีการส่งรหัสผ่านและ ID ไหม
        $request->validate([
            'room_id' => 'required',
            'password' => 'required',
        ]);

        // ตรวจสอบรหัสผ่านของ User ปัจจุบัน
        if (!Hash::check($request->password, Auth::user()->password)) {
            return back()->with('error', 'รหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');
        }

        // ค้นหาห้อง
        $room = Room::find($request->room_id);

        if ($room) {
            // ลบประวัติการจองทั้งหมดของห้องนี้
            Booking::where('room_id', $room->id)->delete();

            // ลบห้อง
            $room->delete();

            return back()->with('success', 'ลบห้องเรียนและประวัติการจองทั้งหมดเรียบร้อยแล้ว');
        }

        return back()->with('error', 'ไม่พบข้อมูลห้องเรียน');
    }
}
