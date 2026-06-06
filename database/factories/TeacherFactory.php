<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $counter = 100;

        return [
            'user_id'     => User::factory()->state(['role' => 'teacher']),
            'teacher_id'  => 'TEA' . (++$counter),
            'experience'  => fake()->numberBetween(1, 15) . ' years',
        ];
    }
}
