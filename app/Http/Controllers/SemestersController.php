<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Semester;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SemestersController extends Controller
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
            $semesters = Semester::where('name', 'LIKE', "%$keyword%")
                ->orWhere('date_start', 'LIKE', "%$keyword%")
                ->orWhere('date_end', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $semesters = Semester::latest()->paginate($perPage);
        }

        return view('semesters.index', compact('semesters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('semesters.create');
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
        
        Semester::create($requestData);

        return redirect('semesters')->with('flash_message', 'Semester added!');
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
        $semester = Semester::findOrFail($id);

        return view('semesters.show', compact('semester'));
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
        $semester = Semester::findOrFail($id);

        return view('semesters.edit', compact('semester'));
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
        
        $semester = Semester::findOrFail($id);
        $semester->update($requestData);

        return redirect('semesters')->with('flash_message', 'Semester updated!');
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
        Semester::destroy($id);

        return redirect('semesters')->with('flash_message', 'Semester deleted!');
    }

    public function create_semesters()
    {
        $semesters = Semester::orderBy('id', 'desc')->get();
        return view('semesters.create_semesters', compact('semesters'));
    }

    public function save_semesters(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date_start' => 'required|date',
            'date_end' => 'required|date|after_or_equal:date_start',
        ], [
            'date_end.after_or_equal' => 'วันสิ้นสุดต้องอยู่หลังวันเริ่มต้น'
        ]);

        Semester::create([
            'name' => $request->name,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
        ]);

        return back()->with('success', 'เพิ่มภาคการศึกษาเรียบร้อยแล้ว');
    }

    public function delete_semester($id)
    {
        Semester::find($id)->delete();
        return back()->with('success', 'ลบข้อมูลเรียบร้อยแล้ว');
    }
}
