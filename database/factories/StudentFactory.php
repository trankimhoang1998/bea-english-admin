<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $counter = 1000;

        return [
            'user_id'    => User::factory()->state(['role' => 'student']),
            'student_id' => 'STU' . (++$counter),
            'age'        => fake()->numberBetween(8, 40),
            'course'     => fake()->randomElement(['60 lessons', '90 lessons', '120 lessons', '150 lessons']),
        ];
    }
}
