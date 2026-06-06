<?php

namespace Database\Seeders;

use App\Models\LearningMaterial;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeachingHistory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Manager account
        $manager = User::factory()->create([
            'name'     => 'Admin Manager',
            'email'    => 'manager@bea.test',
            'password' => Hash::make('password'),
            'role'     => 'manager',
        ]);

        // Teachers
        $teacherUsers = User::factory()->count(3)->create([
            'password' => Hash::make('password'),
            'role'     => 'teacher',
        ]);

        $teachers = $teacherUsers->map(function (User $user, int $i) {
            return Teacher::create([
                'user_id'    => $user->id,
                'teacher_id' => 'TEA' . (101 + $i),
                'experience' => (3 + $i * 2) . ' years',
            ]);
        });

        // Override first teacher for demo
        $teacherUsers[0]->update(['name' => 'Ann Oliver', 'email' => 'ann@bea.test']);
        $teachers[0]->update(['teacher_id' => 'TEA101', 'experience' => '5 years']);

        // Students
        $studentUsers = User::factory()->count(5)->create([
            'password' => Hash::make('password'),
            'role'     => 'student',
        ]);

        $students = $studentUsers->map(function (User $user, int $i) {
            return Student::create([
                'user_id'    => $user->id,
                'student_id' => 'STU' . (1011 + $i),
                'age'        => 12 + $i,
                'course'     => '120 lessons',
            ]);
        });

        // Override first two students for demo
        $studentUsers[0]->update(['name' => 'Mai Huong', 'email' => 'mai@bea.test']);
        $students[0]->update(['student_id' => 'STU1011']);

        $studentUsers[1]->update(['name' => 'Kim Hoang', 'email' => 'kim@bea.test']);
        $students[1]->update(['student_id' => 'STU1014']);

        // Schedules for teacher 0
        $scheduleData = [
            ['mon', '18:00:00', '18:25:00', 0],
            ['mon', '18:30:00', '18:55:00', 0],
            ['tue', '19:00:00', '19:25:00', 1],
            ['wed', '18:00:00', '18:25:00', 0],
            ['thu', '19:00:00', '19:25:00', 0],
            ['thu', '19:30:00', '19:55:00', 0],
            ['sat', '18:30:00', '18:55:00', 1],
        ];

        foreach ($scheduleData as [$day, $start, $end, $studentIdx]) {
            Schedule::create([
                'teacher_id'  => $teachers[0]->id,
                'student_id'  => $students[$studentIdx]->id,
                'day_of_week' => $day,
                'start_time'  => $start,
                'end_time'    => $end,
            ]);
        }

        // Teaching histories
        foreach ($students->take(3) as $student) {
            TeachingHistory::factory()->count(5)->create([
                'teacher_id' => $teachers[0]->id,
                'student_id' => $student->id,
            ]);
        }

        // Learning materials
        LearningMaterial::factory()->count(5)->create([
            'uploaded_by' => $manager->id,
        ]);
    }
}
