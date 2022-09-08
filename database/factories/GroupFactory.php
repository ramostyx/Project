<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'teacher_id'=>1,
            'designation'=>'Class '.fake()->randomLetter(),
            'capacity'=>fake()->numberBetween(20,45),
            'level'=>fake()->word(),
            'year'=>fake()->year(),
            'code'=>Str::random(6),
        ];
    }
}
