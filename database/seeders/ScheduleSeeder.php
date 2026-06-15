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
        $tIds = Teacher::pluck('id', 'teacher_id');
        $sIds = Student::pluck('id', 'student_id');

        $schedules = [
            // ── TEA101 · Ann Oliver ─────────────────────────────────────────
            // STU1011 · Mai Huong — 50-min, Mon & Wed 18:00–18:50
            ['TEA101', 'STU1011', 'mon', '18:00', '18:50'],
            ['TEA101', 'STU1011', 'wed', '18:00', '18:50'],
            // STU1014 · Kim Hoang — 25-min, Tue & Thu 19:00–19:25
            ['TEA101', 'STU1014', 'tue', '19:00', '19:25'],
            ['TEA101', 'STU1014', 'thu', '19:00', '19:25'],
            // STU1015 · Lan Nguyen — 25-min, Tue 18:00–18:25 & Fri 18:00–18:25
            ['TEA101', 'STU1015', 'tue', '18:00', '18:25'],
            ['TEA101', 'STU1015', 'fri', '18:00', '18:25'],
            // STU1016 · Minh Tran — 25-min, Wed 19:00–19:25 & Fri 18:30–18:55
            ['TEA101', 'STU1016', 'wed', '19:00', '19:25'],
            ['TEA101', 'STU1016', 'fri', '18:30', '18:55'],

            // ── TEA102 · Bob Smith ──────────────────────────────────────────
            // STU1017 · Hoa Le — 25-min, Mon & Thu 17:00–17:25
            ['TEA102', 'STU1017', 'mon', '17:00', '17:25'],
            ['TEA102', 'STU1017', 'thu', '17:00', '17:25'],
            // STU1018 · Nam Pham — 25-min, Tue & Fri 17:00–17:25
            ['TEA102', 'STU1018', 'tue', '17:00', '17:25'],
            ['TEA102', 'STU1018', 'fri', '17:00', '17:25'],
            // STU1022 · Bao Nguyen — 25-min, Mon 17:30–17:55 & Wed 17:00–17:25
            ['TEA102', 'STU1022', 'mon', '17:30', '17:55'],
            ['TEA102', 'STU1022', 'wed', '17:00', '17:25'],
            // STU1025 · Thu Bui — 25-min, Thu 17:30–17:55 & Sat 09:00–09:25
            ['TEA102', 'STU1025', 'thu', '17:30', '17:55'],
            ['TEA102', 'STU1025', 'sat', '09:00', '09:25'],

            // ── TEA103 · Carol White ────────────────────────────────────────
            // STU1019 · Linh Dao — 25-min, Mon & Wed 20:00–20:25
            ['TEA103', 'STU1019', 'mon', '20:00', '20:25'],
            ['TEA103', 'STU1019', 'wed', '20:00', '20:25'],
            // STU1020 · Tuan Vo — 25-min, Tue 20:00–20:25 & Sat 09:00–09:25
            ['TEA103', 'STU1020', 'tue', '20:00', '20:25'],
            ['TEA103', 'STU1020', 'sat', '09:00', '09:25'],
            // STU1023 · Yen Truong — 25-min, Thu & Fri 20:00–20:25
            ['TEA103', 'STU1023', 'thu', '20:00', '20:25'],
            ['TEA103', 'STU1023', 'fri', '20:00', '20:25'],

            // ── TEA104 · David Brown ────────────────────────────────────────
            // STU1021 · Ha Dang — 50-min, Sun 09:00–09:50
            ['TEA104', 'STU1021', 'sun', '09:00', '09:50'],
            // STU1024 · Duc Phan — 25-min, Mon & Wed 15:00–15:25
            ['TEA104', 'STU1024', 'mon', '15:00', '15:25'],
            ['TEA104', 'STU1024', 'wed', '15:00', '15:25'],
            // STU1026 · Long Nguyen — 50-min, Tue & Thu 15:00–15:50
            ['TEA104', 'STU1026', 'tue', '15:00', '15:50'],
            ['TEA104', 'STU1026', 'thu', '15:00', '15:50'],

            // ── TEA105 · Emma Davis ─────────────────────────────────────────
            // STU1027 · Phuong Le — 50-min, Mon & Thu 16:00–16:50
            ['TEA105', 'STU1027', 'mon', '16:00', '16:50'],
            ['TEA105', 'STU1027', 'thu', '16:00', '16:50'],
            // STU1028 · Quang Tran — 25-min, Tue & Fri 16:00–16:25
            ['TEA105', 'STU1028', 'tue', '16:00', '16:25'],
            ['TEA105', 'STU1028', 'fri', '16:00', '16:25'],
            // STU1029 · Van Hoang — 25-min, Wed 16:00–16:25 & Sat 10:00–10:25
            ['TEA105', 'STU1029', 'wed', '16:00', '16:25'],
            ['TEA105', 'STU1029', 'sat', '10:00', '10:25'],

            // ── TEA106 · Frank Wilson ───────────────────────────────────────
            // STU1030 · Anh Pham — 50-min, Mon & Wed 14:00–14:50 & Fri 15:00–15:50
            ['TEA106', 'STU1030', 'mon', '14:00', '14:50'],
            ['TEA106', 'STU1030', 'wed', '14:00', '14:50'],
            ['TEA106', 'STU1030', 'fri', '15:00', '15:50'],
            // STU1031 · Dung Dao — 25-min, Tue & Thu 14:00–14:25 & Sat 14:00–14:25
            ['TEA106', 'STU1031', 'tue', '14:00', '14:25'],
            ['TEA106', 'STU1031', 'thu', '14:00', '14:25'],
            ['TEA106', 'STU1031', 'sat', '14:00', '14:25'],
            // STU1032 · Thanh Vo — 50-min, Fri 14:00–14:50 & Sun 10:00–10:50 & Wed 15:00–15:50
            ['TEA106', 'STU1032', 'fri', '14:00', '14:50'],
            ['TEA106', 'STU1032', 'sun', '10:00', '10:50'],
            ['TEA106', 'STU1032', 'wed', '15:00', '15:50'],

            // ── Additional slots (3rd session/week for each student) ─────────

            // TEA101
            ['TEA101', 'STU1011', 'fri', '19:00', '19:50'], // after STU1015 18:00 & STU1016 18:30
            ['TEA101', 'STU1014', 'sat', '19:00', '19:25'],
            ['TEA101', 'STU1015', 'thu', '18:00', '18:25'], // before STU1014 19:00
            ['TEA101', 'STU1016', 'mon', '19:00', '19:25'], // after STU1011 18:00–18:50

            // TEA102
            ['TEA102', 'STU1017', 'sat', '17:00', '17:25'], // after STU1025 09:00
            ['TEA102', 'STU1018', 'wed', '17:30', '17:55'], // after STU1022 17:00–17:25
            ['TEA102', 'STU1022', 'fri', '17:30', '17:55'], // after STU1018 17:00–17:25
            ['TEA102', 'STU1025', 'tue', '17:30', '17:55'], // after STU1018 17:00–17:25

            // TEA103
            ['TEA103', 'STU1019', 'fri', '19:00', '19:25'], // before STU1023 20:00
            ['TEA103', 'STU1020', 'thu', '19:00', '19:25'], // before STU1023 20:00
            ['TEA103', 'STU1023', 'sat', '10:00', '10:25'], // after STU1020 09:00–09:25

            // TEA104
            ['TEA104', 'STU1021', 'fri', '09:00', '09:50'],
            ['TEA104', 'STU1024', 'fri', '15:00', '15:25'], // after STU1021 09:00–09:50
            ['TEA104', 'STU1026', 'sat', '15:00', '15:50'],

            // TEA105
            ['TEA105', 'STU1027', 'sat', '16:00', '16:50'], // after STU1029 10:00–10:25
            ['TEA105', 'STU1028', 'wed', '16:30', '16:55'], // after STU1029 16:00–16:25
            ['TEA105', 'STU1029', 'fri', '17:00', '17:25'], // after STU1028 16:00–16:25
        ];

        foreach ($schedules as [$tea, $stu, $day, $start, $end]) {
            Schedule::create([
                'teacher_id'  => $tIds[$tea],
                'student_id'  => $sIds[$stu],
                'day_of_week' => $day,
                'start_time'  => $start,
                'end_time'    => $end,
            ]);
        }
    }
}
