<?php

namespace App\Http\Controllers;

use App\Events\PostCommentEvent;
use App\Models\Assignment;
use App\Models\AssignmentStudent;
use App\Models\Attachment;
use App\Models\Comment;
use App\Models\Group;
use App\Models\GroupStudent;
use App\Models\StudentAssignment;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\Assign;
use function PHPUnit\Framework\at;

class AssignmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function index(Group $group,Subject $subject)
    {
        //or GroupStudent::where('student_id',Auth::user()->student->id)->where('group_id',$group->id)
        if(Auth::user()->hasRole('teacher') and User::groupOwner($group))
        {
            if($group->subject->contains($subject))
            {
                $assignments=$subject->assignment;
                return view('Teacher.Groups.Subjects.Assignments.index',compact('group','subject','assignments'));
            }
            return back()->with('error','This group does not have subjects or this subject does not belong to this group');
        }
        else if(Auth::user()->hasRole('student') and GroupStudent::where('student_id',Auth::user()->student->id)->where('group_id',$group->id))
        {
            if($group->subject->contains($subject))
            {
                $assignments=$subject->assignment;
                return view('Student.Groups.Subjects.Assignments.index',compact('group','subject','assignments'));
            }
            return back()->with('error','This group does not have any subjects yet');
        }
        return back();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function create(Group $group,Subject $subject)
    {
        if(Auth::user()->hasRole('teacher') and User::groupOwner($group))
        {
            return view('Teacher.Groups.Subjects.Assignments.create',compact('subject','group'));
        }
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Group $group, Subject $subject)
    {
        $request->validate([
            'title' => ['required','string'],
            'body' => ['required','string'],
            'date' => ['required'],
            'attachment' => ['required'],
        ]);
        $assignement=Assignment::create([
            'subject_id' => $subject->id,
            'title' => $request->title,
            'body' => $request->body,
            'dueDate' => $request->date,
        ]);
        foreach ($group->students()->get() as $student) {
            AssignmentStudent::create([
                'student_id' => $student->id,
                'assignment_id' => $assignement->id,
            ]);
        }
        foreach($request->file('attachment') as $file)
        {
            $filename=$file->getClientOriginalName();
            $path='storage/assignments/attachments/'.$filename;
            $attachment=Attachment::create([
                'filename'=> $filename,
                'type'=>$file->getClientOriginalExtension(),
                'path'=>$path,
                'attachable_id' => $assignement->id,
                'attachable_type' => 'App\Models\Assignment'
            ]);

            $file->storeAs('assignments/attachments',$filename);

        }
        return redirect()->route('groups.subjects.assignments.index',[$group->id,$subject->id])->with('success','Assignment created Succesfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group,Subject $subject, Assignment $assignment)
    {

        if(Auth::user()->hasRole('teacher') and User::groupOwner($group))
        {
            if($group->subject->contains($subject))
            {
                if($subject->assignment->contains($assignment)) {
                    return view('Teacher.Groups.Subjects.Assignments.show', compact('group', 'subject', 'assignment'));
                }
                return back()->with('error','This assignment does not exist or does not belong to this subject');
            }
            return back()->with('error','This group does not have any subjects or this subject does not belong to this group');
        }
        else if(Auth::user()->hasRole('student') and $group->students()->get()->contains(Auth::user()->student))
        {
            if($group->subject->contains($subject))
            {
                if($subject->assignment->contains($assignment)) {

                    $status=AssignmentStudent::where('assignment_id',$assignment->id)
                        ->where('student_id',Auth::user()->student->id)->first()->status;

                    return view('Student.Groups.Subjects.Assignments.show',compact('group','subject','assignment','status'));
                }
                return back()->with('error','This assignment does not exist');
            }
            return back()->with('error','This group does not have any subjects yet');
        }
        return back();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group,Subject $subject, Assignment $assignment)
    {
        if(Auth::user()->hasRole('teacher') and User::groupOwner($group))
        {
            return view('Teacher.Groups.Subjects.Assignments.edit',compact('group','subject','assignment'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Group $group, Subject $subject, Assignment $assignment)
    {
        $request->validate([
            'title' => ['required','string'],
            'body' => ['required','string'],
        ]);
        $assignment->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);
        if($request->file('attachment')){
            foreach($request->file('attachment') as $file)
            {
                $filename=$file->getClientOriginalName();
                $path='storage/assignments/attachments/'.$filename;
                Attachment::create([
                    'filename'=> $filename,
                    'type'=>$file->getClientOriginalExtension(),
                    'path'=>$path,
                    'attachable_id' => $assignment->id,
                    'attachable_type' => 'App\Models\Assignment'
                ]);

                $file->storeAs('assignments/attachments',$filename);

            }
        }

        return redirect()->route('groups.subjects.assignments.index',[$group->id,$subject->id])->with('success','Assignment updated Succesfuly');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group,Subject $subject, Assignment $assignment)
    {
        $assignment->delete();
        return back()->with('success','Assignment deleted successfully');
    }

    public function postComment(Request $request,Assignment $assignment)
    {
        $request->validate([
            'comment' => ['required','string'],
        ]);
        $teacher=$assignment->subject->group->teacher;

        Comment::create([
            'body' => $request->comment,
            'user_id' => Auth::user()->id,
            'commentable_id' => $assignment->id,
            'commentable_type' => 'App\Models\Assignment'
        ]);
        if(Auth::user()->student)
        {
            $message=Auth::user()->fullName().' has commented on an assignment titled '.$assignment->title;
            event(new PostCommentEvent($teacher->user,$message));
        }
        return back();
    }

    public function deleteComment(Comment $comment)
    {
        $comment->delete();
        return back()->with('success','Comment deleted successfully');
    }

    public function deleteAttachment(Attachment $attachment)
    {
        Storage::delete('assignments/attachments/'.$attachment->filename);
        $attachment->delete();
        return back()->with('success','Attachment deleted successfully');
    }

    public function download(Attachment $attachment)
    {
        return response()->download($attachment->path);
    }

    public function workDownload(Request $request)
    {
        if($request->path != '_')
            return response()->download($request->path);
        return back()->with('error','No work has been turned in to download');
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
                    return redirect()->route('groups.subjects.assignments.index',[$group->id,$subject->id]);
                return back()->with('error','this group does not have any subjects yet');
            }
            if($role=='teacher')
                return back()->with('error','You need to create a group first');
            else
                return back()->with('error','You need to join or get enrolled in a group first');
        }
    }

    public function gIDredirect($gId)
    {

        $group=Group::find($gId);
        if($group) {
            $subject = $group->subject->first();
            if($subject){
                return redirect()->route('groups.subjects.assignments.index', [$group->id,$subject->id]);
            }
            return back()->with('error','this group does not have any subjects yet');;
        }
        return back()->with('error','You need to create a group first');;
    }

}


