<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $slots = [
            ['18:00:00', '18:25:00'],
            ['18:30:00', '18:55:00'],
            ['19:00:00', '19:25:00'],
            ['19:30:00', '19:55:00'],
            ['20:00:00', '20:25:00'],
            ['20:30:00', '20:55:00'],
        ];

        $slot = fake()->randomElement($slots);

        return [
            'teacher_id'  => Teacher::factory(),
            'student_id'  => Student::factory(),
            'day_of_week' => fake()->randomElement(['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun']),
            'start_time'  => $slot[0],
            'end_time'    => $slot[1],
        ];
    }
}
