<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups=Auth::user()->teacher->group;
        return view('Teacher.Groups.index',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'designation' => ['required', 'string', 'max:255'],
            'capacity' => ['required', 'integer', 'max:255'],
            'level' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:255'],
        ]);
        Group::create([
            'teacher_id' => Auth::user()->teacher->id,
            'capacity' => $request->capacity,
            'designation' => $request->designation,
            'level' => $request->level,
            'year' => $request->year,
            'code' => Str::random(6)
        ]);

        return redirect()->route('groups.index')->with('message', 'Group Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        return view('Teacher.Groups.edit',compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $request->validate([
            'capacity' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'level' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:255'],
        ]);
        $group->update([
            'capacity' => $request->capacity,
            'designation' => $request->designation,
            'level' => $request->level,
            'year' => $request->year,
        ]);
        return redirect()->route('groups.index')->with('message', 'Group Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();
        return back();
    }

    public function students()
    {
        $groups=Auth::user()->teacher->group;
        return view('Teacher.Groups.students',compact('groups'));
    }
    public function details(Group $group)
    {
        return view('Teacher.Groups.details',compact('group'));
    }
}
