<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        // split action based on role
        if(Auth::user()->hasRole('teacher'))
        {
            $groups=Auth::user()->teacher->groups;
            return view('Teacher.Groups.index',compact('groups'));
        }
        $groups=Auth::user()->student->groups;
        return view('Student.Groups.index',compact('groups'));
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
        if(Auth::user()->hasRole('teacher') and User::isCreator($group->teacher->user->id))
        {
            return view('Teacher.Groups.edit',compact('group'));
        }
        return back();
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
            'capacity' => ['required', 'integer', 'max:255'],
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
        $groups=Auth::user()->teacher->groups;
        return view('Teacher.Groups.students',compact('groups'));
    }
    public function details(Group $group,Request $request)
    {
        if(Auth::user()->hasRole('teacher') and User::isCreator($group->teacher->user->id)){
            $students=$group->students->paginate(5);
            if($request->search)
            {
                $students=Student::search($group->id,$request->search);
            }
            $subjects=$group->subject;
            return view('Teacher.Groups.details',compact('group','students','subjects'));
        }
        return back();
    }

    public function grades(Group $group,Request $request,$semester="1st semester",$evaluation="1st evaluation")
    {
        if(Auth::user()->hasRole('teacher') and User::isCreator($group->teacher->user->id))
        {
            if($request->semester and $request->evaluation)
            {
                $semester = $request->semester;
                $evaluation = $request->evaluation;
            }
            $students=$group->students->paginate(5);
            return view('Teacher.Groups.Students.Grades.index',compact('students','group','semester','evaluation'));
        }
        return back();
    }

    /*public function filter(Group $group,$semester,$evaluation)
    {
        $this->grades($group,$semester,$evaluation);
    }*/

    public function search(Group $group,Request $request,$semester,$evaluation)
    {

        $students=Student::search($group->id,$request->search);

        return view('Teacher.Groups.Students.Grades.index',compact('students','group','semester','evaluation'));


    }

}
