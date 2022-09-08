<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Group;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function index(Group $group)
    {
        $subjects=$group->subject;
        return view('Group.Students.index',compact('subjects'));
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
            'designation' => ['required', 'string', 'max:255'],
        ]);
        Subject::create([
            'group_id' => $group->id,
            'designation' => $request->designation,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group, Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group, Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group, Subject $subject)
    {
        $subject->delete();
        return back();
    }

    //Assignments
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @param  \App\Models\Subject  $subject
     */
    public function assignments(Group $group,Subject $subject)
    {
        return 'something';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function assignmentsCreate(Group $group,Subject $subject)
    {
        return view('Teacher.Groups.Subjects.Assignments.create',compact('subject'));

    }
    public function assignmentsStore(Request $request,Group $group,Subject $subject)
    {
        $request->validate([
            'title' => ['required','string'],
            'body' => ['required','string'],
            'attachment' => ['required']
        ]);
        Assignment::create([
            'subject_id' => $subject->id,
            'title' => $request->title,
            'body' => $request->body,
            'attachment' => $request->file('attachment')->store('assignments.attachments')
        ]);
        return 'success';
    }

    public function assignmentEdit(Group $group,Subject $subject,Assignment $assignment)
    {
        //
    }
    public function assignmentUpdate(Request $request,Group $group,Subject $subject, Assignment $assignment)
    {
        //
    }
    public function assignmentDelete(Group $group,Subject $subject, Assignment $assignment)
    {
        //
    }
}
