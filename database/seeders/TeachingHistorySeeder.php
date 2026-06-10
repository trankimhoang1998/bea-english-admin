<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeachingHistory;
use Illuminate\Database\Seeder;

class TeachingHistorySeeder extends Seeder
{
    public function run(): void
    {
        $t = fn(string $id) => Teacher::where('teacher_id', $id)->value('id');
        $s = fn(string $id) => Student::where('student_id', $id)->value('id');

        $histories = [
            // Ann Oliver × Mai Huong (5 sessions)
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1011'), 'lesson_number' => 1, 'taught_at' => '2026-05-01 18:00:00', 'duration' => 25, 'note' => 'Good pronunciation, needs more vocabulary.'],
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1011'), 'lesson_number' => 2, 'taught_at' => '2026-05-05 18:00:00', 'duration' => 25, 'note' => 'Excellent progress.'],
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1011'), 'lesson_number' => 3, 'taught_at' => '2026-05-08 18:00:00', 'duration' => 50, 'note' => null],
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1011'), 'lesson_number' => 4, 'taught_at' => '2026-05-12 18:00:00', 'duration' => 25, 'note' => 'Student struggled with "usually" vs "often".'],
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1011'), 'lesson_number' => 5, 'taught_at' => '2026-05-15 18:00:00', 'duration' => 50, 'note' => 'Great speaking session.'],

            // Ann Oliver × Kim Hoang (4 sessions)
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1014'), 'lesson_number' => 1, 'taught_at' => '2026-05-02 19:00:00', 'duration' => 25, 'note' => 'Shy but improving.'],
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1014'), 'lesson_number' => 2, 'taught_at' => '2026-05-06 19:00:00', 'duration' => 25, 'note' => null],
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1014'), 'lesson_number' => 3, 'taught_at' => '2026-05-09 19:00:00', 'duration' => 50, 'note' => 'Very good today.'],
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1014'), 'lesson_number' => 4, 'taught_at' => '2026-05-13 19:00:00', 'duration' => 25, 'note' => 'Homework not done.'],

            // Ann Oliver × Lan Nguyen (3 sessions)
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1015'), 'lesson_number' => 1, 'taught_at' => '2026-05-03 18:00:00', 'duration' => 25, 'note' => 'Fast learner.'],
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1015'), 'lesson_number' => 2, 'taught_at' => '2026-05-07 18:00:00', 'duration' => 50, 'note' => null],
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1015'), 'lesson_number' => 3, 'taught_at' => '2026-05-10 18:00:00', 'duration' => 25, 'note' => 'Good session.'],

            // Bob Smith × Hoa Le (3 sessions)
            ['teacher_id' => $t('TEA102'), 'student_id' => $s('STU1017'), 'lesson_number' => 1, 'taught_at' => '2026-05-04 17:00:00', 'duration' => 25, 'note' => 'Needs practice.'],
            ['teacher_id' => $t('TEA102'), 'student_id' => $s('STU1017'), 'lesson_number' => 2, 'taught_at' => '2026-05-08 17:00:00', 'duration' => 25, 'note' => null],
            ['teacher_id' => $t('TEA102'), 'student_id' => $s('STU1017'), 'lesson_number' => 3, 'taught_at' => '2026-05-11 17:00:00', 'duration' => 50, 'note' => 'Good effort.'],

            // Bob Smith × Nam Pham (2 sessions)
            ['teacher_id' => $t('TEA102'), 'student_id' => $s('STU1018'), 'lesson_number' => 1, 'taught_at' => '2026-05-05 17:00:00', 'duration' => 25, 'note' => 'Confident speaker.'],
            ['teacher_id' => $t('TEA102'), 'student_id' => $s('STU1018'), 'lesson_number' => 2, 'taught_at' => '2026-05-09 17:00:00', 'duration' => 25, 'note' => null],

            // Carol White × Linh Dao (2 sessions)
            ['teacher_id' => $t('TEA103'), 'student_id' => $s('STU1019'), 'lesson_number' => 1, 'taught_at' => '2026-05-06 20:00:00', 'duration' => 50, 'note' => 'Strong student.'],
            ['teacher_id' => $t('TEA103'), 'student_id' => $s('STU1019'), 'lesson_number' => 2, 'taught_at' => '2026-05-11 20:00:00', 'duration' => 25, 'note' => null],

            // Carol White × Tuan Vo (1 session)
            ['teacher_id' => $t('TEA103'), 'student_id' => $s('STU1020'), 'lesson_number' => 1, 'taught_at' => '2026-05-07 20:00:00', 'duration' => 25, 'note' => 'Needs more confidence.'],
        ];

        foreach ($histories as $row) {
            TeachingHistory::create($row);
        }
    }
}
