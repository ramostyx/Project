<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function grades(Group $group)
    {
        dd($group);
        return view('Teacher.Groups.Students.Grades.index',compact('group'));
    }
}
