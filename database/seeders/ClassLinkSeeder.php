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
            ['TEA101', 'STU1011', 'https://meet.google.com/ant-uixp-pia'],
            ['TEA101', 'STU1014', 'https://meet.google.com/bcd-vwxy-qrs'],
            ['TEA101', 'STU1015', 'https://meet.google.com/cef-ghij-klm'],
            ['TEA101', 'STU1016', 'https://meet.google.com/dfg-nopq-rst'],
            ['TEA102', 'STU1017', 'https://meet.google.com/egh-uvwx-yza'],
            ['TEA102', 'STU1018', 'https://meet.google.com/fhi-bcde-fgh'],
            ['TEA103', 'STU1019', 'https://meet.google.com/gij-ijkl-mno'],
            ['TEA103', 'STU1020', 'https://meet.google.com/hjk-pqrs-tuv'],
            ['TEA104', 'STU1021', 'https://meet.google.com/ikl-wxyz-abc'],
            ['TEA105', 'STU1027', 'https://meet.google.com/jlm-defg-hij'],
        ];

        foreach ($links as [$tea, $stu, $link]) {
            ClassLink::create([
                'teacher_id' => $tIds[$tea],
                'student_id' => $sIds[$stu],
                'link'       => $link,
            ]);
        }
    }
}
