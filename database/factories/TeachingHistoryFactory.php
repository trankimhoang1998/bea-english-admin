<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeachingHistory>
 */
class TeachingHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'teacher_id'    => Teacher::factory(),
            'student_id'    => Student::factory(),
            'lesson_number' => fake()->numberBetween(1, 30),
            'taught_date'   => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'time_from'   => fake()->time('H:i'),
            'time_to'     => fake()->time('H:i'),
            'duration'   => fake()->randomElement([25, 50]),
            'video_path' => null,
            'note'       => fake()->optional(0.6)->sentence(),
        ];
    }
}
