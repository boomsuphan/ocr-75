<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Semester;
use Illuminate\Http\Request;

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
}
