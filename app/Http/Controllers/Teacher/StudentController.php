<?php

namespace App\Http\Controllers\Teacher;

use App\Events\JoinGroupEvent;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Group;
use App\Models\GroupStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\String\s;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function index(Group $group)
    {
        $students=$group->students;
        return view('Groups.Students.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function create(Group $group)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Group $group)
    {
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],

        ]);
        Student::create([
            'group_id' => $group->id,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
        ]);

        return redirect()->route('groups.students.index')->with('message', 'Student Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group, Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group, Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group, Student $student)
    {
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],

        ]);
        $student->update([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
        ]);

        return redirect()->route('groups.students.index')->with('message', 'Student Created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group, Student $student)
    {
        $student->delete();
    }

    public function join(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:255'],
        ]);
        $group = Group::where('code',$request->code)->first();
        $student = Auth::user()->student;
        GroupStudent::firstOrCreate([
           'group_id'=> $group->id,
            'student_id'=> $student->id,
        ]);
        event(new JoinGroupEvent($student->user,$group->teacher));
        return back();
    }

    public function Indexgrades(Request $request,Group $group, Student $Student,$semester="1st semester",$evaluation="1st evaluation")
    {
        if($request->semester)
        {
            $semester = $request->semester;
            $evaluation = $request->evaluation;
        }

        return view('Teacher.Groups.Students.Grades.create',
            compact('group','Student','semester','evaluation'));
    }

    public function Storegrades(Request $request,Group $group, Student $Student)
    {

        foreach($group->subject as $subject)
        {
            $sub=str_replace(' ','_',$subject->designation);
            $grade=Grade::findGrade($subject->id,$Student->id,$request->semester,$request->evaluation);
            if($grade){
                $grade->update([
                    'grade'=>$request->$sub,
                ]);
            }
            else{
                Grade::create([
                    'grade'=>$request->$sub,
                    'semester'=>$request->semester,
                    'evaluation'=>$request->evaluation,
                    'student_id'=>$Student->id,
                    'group_id'=>$group->id,
                    'subject_id'=>$subject->id,
                ]);
            }

        }


        return redirect()->route('grades',$group->id);
    }

    public function Deletegrades(Group $group, Student $student,$semester,$evaluation)
    {
        foreach ($group->subject as $subject)
        {
            Grade::findGrade($subject->id,$student->id,$semester,$evaluation)->delete();
        }
        return back();
    }
}
