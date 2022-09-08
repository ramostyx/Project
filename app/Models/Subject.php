<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function grade()
    {
        return $this->hasMany(Grade::class);
    }

    public function assignment()
    {
        return $this->hasMany(Assignment::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
