<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function requestsExist()
    {
        foreach ($this->groups as $group){
            if(GroupStudent::where('group_id',$group->id)->where('status','pending')->first())
            {
                return true;
            }
        }
        return false;
    }

    public function uploadsExist($assignments)
    {
        foreach($assignments as $assignment){
            if(AssignmentStudent::where('assignment_id',$assignment->id)->where('status','turned in')->first())
            {
                return true;
            }
        }
        return false;
    }
}
