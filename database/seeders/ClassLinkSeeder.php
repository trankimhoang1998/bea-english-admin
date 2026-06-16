<?php

namespace Database\Seeders;

use App\Models\ClassLink;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class ClassLinkSeeder extends Seeder
{
    public function run(): void
    {
        $tIds = Teacher::pluck('id', 'teacher_id');
        $sIds = Student::pluck('id', 'student_id');

        $links = [
            ['TEA101', 'STU1011', '536-053-706', 'https://voovmeeting.com/dm/LngItGq4Ga1L'],
            ['TEA101', 'STU1014', '412-871-293', 'https://voovmeeting.com/dm/Kp3mRxTvYw8N'],
            ['TEA101', 'STU1015', '784-302-615', 'https://voovmeeting.com/dm/Qd7fZsHbUn2J'],
            ['TEA101', 'STU1016', '291-648-037', 'https://voovmeeting.com/dm/Wc5aEvMjXr9P'],
            ['TEA102', 'STU1017', '653-917-482', 'https://voovmeeting.com/dm/Yt4kBpOgFl6D'],
            ['TEA102', 'STU1018', '837-264-159', 'https://voovmeeting.com/dm/Am9nCwShVe3K'],
            ['TEA103', 'STU1019', '174-583-926', 'https://voovmeeting.com/dm/Rj2uDqTiZb7G'],
            ['TEA103', 'STU1020', '962-431-758', 'https://voovmeeting.com/dm/Nf8lGvUcXo4M'],
            ['TEA104', 'STU1021', '348-796-021', 'https://voovmeeting.com/dm/Hx6yIkWmAe1Q'],
            ['TEA105', 'STU1027', '715-028-364', 'https://voovmeeting.com/dm/Bs3zJrYnPt5F'],
        ];

        foreach ($links as [$tea, $stu, $classId, $classLink]) {
            ClassLink::create([
                'teacher_id' => $tIds[$tea],
                'student_id' => $sIds[$stu],
                'class_id'   => $classId,
                'class_link' => $classLink,
            ]);
        }
    }
}
