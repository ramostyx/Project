<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class,'attachable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }

    public function students($status='turned in')
    {
        return $this->belongsToMany(Student::class)->wherePivot('status',$status)->withPivot('status','file','created_at');
    }
}
