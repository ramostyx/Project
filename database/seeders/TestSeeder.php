<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\GroupStudent;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(25)->create();
        Student::factory(20)->create();
        Teacher::factory(1)->create();
        Group::factory(2)->create();
        $teachers=Teacher::all();
        $students=Student::all();
        foreach ($teachers as $teacher)
        {
            $teacher->user->assignRole('teacher');
        }
        foreach ($students as $student)
        {
            $student->user->assignRole('student');
            GroupStudent::create([
                'group_id'=> 1,
                'student_id'=> $student->id,
            ]);
        }

    }
}
