<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        // Resolve teacher IDs by teacher_id string
        $t = fn(string $id) => Teacher::where('teacher_id', $id)->value('id');

        // Resolve student IDs by student_id string
        $s = fn(string $id) => Student::where('student_id', $id)->value('id');

        $schedules = [
            // Ann Oliver (TEA101) — Mai Huong (STU1011)
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1011'), 'day_of_week' => 'mon', 'start_time' => '18:00', 'end_time' => '18:25'],
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1011'), 'day_of_week' => 'mon', 'start_time' => '18:30', 'end_time' => '18:55'],
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1011'), 'day_of_week' => 'wed', 'start_time' => '18:00', 'end_time' => '18:25'],
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1011'), 'day_of_week' => 'thu', 'start_time' => '19:00', 'end_time' => '19:25'],
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1011'), 'day_of_week' => 'thu', 'start_time' => '19:30', 'end_time' => '19:55'],

            // Ann Oliver (TEA101) — Kim Hoang (STU1014)
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1014'), 'day_of_week' => 'tue', 'start_time' => '19:00', 'end_time' => '19:25'],
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1014'), 'day_of_week' => 'sat', 'start_time' => '18:30', 'end_time' => '18:55'],

            // Ann Oliver (TEA101) — Lan Nguyen (STU1015)
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1015'), 'day_of_week' => 'tue', 'start_time' => '18:00', 'end_time' => '18:25'],
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1015'), 'day_of_week' => 'fri', 'start_time' => '18:00', 'end_time' => '18:25'],

            // Ann Oliver (TEA101) — Minh Tran (STU1016)
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1016'), 'day_of_week' => 'wed', 'start_time' => '19:00', 'end_time' => '19:25'],
            ['teacher_id' => $t('TEA101'), 'student_id' => $s('STU1016'), 'day_of_week' => 'fri', 'start_time' => '18:30', 'end_time' => '18:55'],

            // Bob Smith (TEA102) — Hoa Le (STU1017)
            ['teacher_id' => $t('TEA102'), 'student_id' => $s('STU1017'), 'day_of_week' => 'mon', 'start_time' => '17:00', 'end_time' => '17:25'],
            ['teacher_id' => $t('TEA102'), 'student_id' => $s('STU1017'), 'day_of_week' => 'thu', 'start_time' => '17:00', 'end_time' => '17:25'],

            // Bob Smith (TEA102) — Nam Pham (STU1018)
            ['teacher_id' => $t('TEA102'), 'student_id' => $s('STU1018'), 'day_of_week' => 'tue', 'start_time' => '17:00', 'end_time' => '17:25'],
            ['teacher_id' => $t('TEA102'), 'student_id' => $s('STU1018'), 'day_of_week' => 'fri', 'start_time' => '17:00', 'end_time' => '17:25'],

            // Carol White (TEA103) — Linh Dao (STU1019)
            ['teacher_id' => $t('TEA103'), 'student_id' => $s('STU1019'), 'day_of_week' => 'mon', 'start_time' => '20:00', 'end_time' => '20:25'],
            ['teacher_id' => $t('TEA103'), 'student_id' => $s('STU1019'), 'day_of_week' => 'wed', 'start_time' => '20:00', 'end_time' => '20:25'],

            // Carol White (TEA103) — Tuan Vo (STU1020)
            ['teacher_id' => $t('TEA103'), 'student_id' => $s('STU1020'), 'day_of_week' => 'tue', 'start_time' => '20:00', 'end_time' => '20:25'],
            ['teacher_id' => $t('TEA103'), 'student_id' => $s('STU1020'), 'day_of_week' => 'sat', 'start_time' => '09:00', 'end_time' => '09:25'],

            // David Brown (TEA104) — Ha Dang (STU1021)
            ['teacher_id' => $t('TEA104'), 'student_id' => $s('STU1021'), 'day_of_week' => 'sun', 'start_time' => '09:00', 'end_time' => '09:50'],
        ];

        foreach ($schedules as $row) {
            Schedule::create($row);
        }
    }
}
