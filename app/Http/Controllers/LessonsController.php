<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Group;
use App\Models\GroupStudent;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\User;
use http\Exception\BadConversionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use function Symfony\Component\String\s;

class LessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function index(Group $group, Subject $subject)
    {
        if (Auth::user()->hasRole('teacher') and User::groupOwner($group)) {
            if ($group->subject->contains($subject)) {
                $lessons = $subject->lessons;
                return view('Teacher.Groups.Subjects.Lessons.index', compact('group', 'subject', 'lessons'));
            }
            return back()->with('error', 'This subject does not belong to this group');
        }
        else if(Auth::user()->hasRole('student') and GroupStudent::where('student_id',Auth::user()->student->id)->where('group_id',$group->id))
        {
            if($group->subject->contains($subject))
            {
                $lessons=$subject->lessons;
                return view('Student.Groups.Subjects.lessons.index',compact('group','subject','lessons'));
            }
            return back()->with('error','This subject does not belong to this group');
        }
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function create(Group $group, Subject $subject)
    {
        if (Auth::user()->hasRole('teacher') and User::groupOwner($group)) {
            return view('Teacher.Groups.Subjects.lessons.create', compact('subject', 'group'));
        }
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Group $group, Subject $subject)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'attachment' => ['required']
        ]);
        $lesson = Lesson::create([
            'subject_id' => $subject->id,
            'title' => $request->title,
        ]);
        foreach ($request->file('attachment') as $file) {
            $filename = $file->getClientOriginalName();
            $path = 'storage/lessons/attachments/' . $filename;
            $attachment = Attachment::create([
                'filename' => $filename,
                'type' => $file->getClientOriginalExtension(),
                'path' => $path,
                'attachable_id' => $lesson->id,
                'attachable_type' => 'App\Models\Lesson'
            ]);

            $file->storeAs('lessons/attachments', $filename);

        }
        return redirect()->route('groups.subjects.lessons.index', [$group->id, $subject->id])->with('success', 'Lesson posted Succesfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Subject $subject
     * @param \App\Models\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject, Lesson $lesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Subject $subject
     * @param \App\Models\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group, Subject $subject, Lesson $lesson)
    {
        if (Auth::user()->hasRole('teacher') and User::groupOwner($group)) {
            return view('Teacher.Groups.Subjects.Lessons.edit', compact('group', 'subject', 'lesson'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Subject $subject
     * @param \App\Models\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group, Subject $subject, Lesson $lesson)
    {
        $request->validate([
            'title' => ['required', 'string'],
        ]);
        $lesson->update([
            'title' => $request->title,
        ]);
        if ($request->file('attachment')) {
            foreach ($request->file('attachment') as $file) {
                $filename = $file->getClientOriginalName();
                $path = 'storage/assignments/attachments/' . $filename;
                Attachment::create([
                    'filename' => $filename,
                    'type' => $file->getClientOriginalExtension(),
                    'path' => $path,
                    'attachable_id' => $lesson->id,
                    'attachable_type' => 'App\Models\Lesson'
                ]);

                $file->storeAs('lessons/attachments', $filename);

            }
        }

        return redirect()->route('groups.subjects.lessons.index', [$group->id, $subject->id])->with('success', 'Lesson updated Succesfuly');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Subject $subject
     * @param \App\Models\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group, Subject $subject, Lesson $lesson)
    {
        $lesson->delete();
        return back()->with('success','Lesson deleted successfully');
    }

    public function redirect($gId=null)
    {
        if($gId) {
            return $this->gIDredirect($gId);
        }
        else{
            $role=Auth::user()->roles()->first()->name;
            $group=Auth::user()->$role->groups->first();
            if($group)
            {
                $subject = $group->subject->first();
                if($subject)
                    return redirect()->route('groups.subjects.lessons.index',[$group->id,$subject->id]);
                return back()->with('error','This group does not have any subjects as of yet');
            }
            return back()->with('error','You need to create a group first');
        }
    }

    public function gIDredirect($gId)
    {

        $group=Group::find($gId);
        if($group) {
            $subject = $group->subject->first();
            if($subject){
                return redirect()->route('groups.subjects.lessons.index', [$group->id,$subject->id]);
            }
            return back()->with('error','This group does not have any subjects as of yet');
        }
        return back()->with('error','You need to create a group first');;
    }
}

