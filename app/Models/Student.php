<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Collection;
use phpDocumentor\Reflection\Types\True_;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
    public function grade()
    {
        return $this->hasMany(Grade::class);
    }

    public function LatestAssignments()
    {
        $result=collect([]);
        $groups=$this->groups;
        foreach ($groups as $group)
        {
            foreach($group->subject as $subject)
            {
                foreach($subject->assignment as $assignment)
                {
                    $result=$result->concat([$assignment]);
                }
            }
        }
        return $result;

    }

    public function LatestLessons()
    {
        $result=collect([]);
        $groups=$this->groups;
        foreach ($groups as $group)
        {
            foreach($group->subject as $subject)
            {
                foreach($subject->lessons as $lesson)
                {
                    $result=$result->concat([$lesson]);
                }
            }
        }
        return $result;

    }


    public static function search($gID,$search)
    {
        $group=Group::find($gID);
        $students=$group->students->filter(function ($student) use ($search)
        {
            return stristr($student->user->firstName,$search) or stristr($student->user->lastName,$search);
        })->paginate(8);

        return $students;

    }
}
