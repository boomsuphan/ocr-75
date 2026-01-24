<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Faculty;
use App\Models\Major;

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
}
