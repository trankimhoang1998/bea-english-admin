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
            'teacher_id' => Teacher::factory(),
            'student_id' => Student::factory(),
            'lesson'     => 'Unit ' . fake()->numberBetween(1, 30) . ': ' . fake()->sentence(3),
            'taught_at'  => fake()->dateTimeBetween('-6 months', 'now'),
            'duration'   => fake()->randomElement([25, 50]),
            'video_path' => null,
            'note'       => fake()->optional(0.6)->sentence(),
        ];
    }
}
