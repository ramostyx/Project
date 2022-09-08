<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public static function findGradeorReplace($suID,$stID,$semester,$evaluation,$replacement=null)
    {
        $grade= Grade::findGrade($suID,$stID,$semester,$evaluation);
        if($grade)
        {
            return $grade->grade;
        }
        else{
            return $replacement;
        }
    }
    public static function findGrade($suID,$stID,$semester,$evaluation)
    {
        return Grade::where('subject_id',$suID)
            ->where('student_id',$stID)
            ->where('semester',$semester)
            ->where('evaluation',$evaluation)
            ->first();
    }
}
