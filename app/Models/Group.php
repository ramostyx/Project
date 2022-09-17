<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function students($status='accepted')
    {
        return $this->belongsToMany(Student::class)->wherePivot('status',$status)->withPivot('status','created_at');
    }

    public function subject()
    {
        return $this->hasMany(Subject::class);
    }


}
