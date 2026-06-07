<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            ['name' => 'Mai Huong',    'email' => 'mai@bea.test',     'student_id' => 'STU1011', 'age' => 14, 'course' => '120 lessons'],
            ['name' => 'Kim Hoang',    'email' => 'kim@bea.test',     'student_id' => 'STU1014', 'age' => 13, 'course' => '120 lessons'],
            ['name' => 'Lan Nguyen',   'email' => 'lan@bea.test',     'student_id' => 'STU1015', 'age' => 12, 'course' => '60 lessons'],
            ['name' => 'Minh Tran',    'email' => 'minh@bea.test',    'student_id' => 'STU1016', 'age' => 15, 'course' => '120 lessons'],
            ['name' => 'Hoa Le',       'email' => 'hoa@bea.test',     'student_id' => 'STU1017', 'age' => 11, 'course' => '60 lessons'],
            ['name' => 'Nam Pham',     'email' => 'nam@bea.test',     'student_id' => 'STU1018', 'age' => 14, 'course' => '120 lessons'],
            ['name' => 'Linh Dao',     'email' => 'linh@bea.test',    'student_id' => 'STU1019', 'age' => 13, 'course' => '60 lessons'],
            ['name' => 'Tuan Vo',      'email' => 'tuan@bea.test',    'student_id' => 'STU1020', 'age' => 12, 'course' => '120 lessons'],
            ['name' => 'Ha Dang',      'email' => 'ha@bea.test',      'student_id' => 'STU1021', 'age' => 16, 'course' => '60 lessons'],
            ['name' => 'Bao Nguyen',   'email' => 'bao@bea.test',     'student_id' => 'STU1022', 'age' => 14, 'course' => '120 lessons'],
            ['name' => 'Yen Truong',   'email' => 'yen@bea.test',     'student_id' => 'STU1023', 'age' => 13, 'course' => '60 lessons'],
            ['name' => 'Duc Phan',     'email' => 'duc@bea.test',     'student_id' => 'STU1024', 'age' => 15, 'course' => '120 lessons'],
            ['name' => 'Thu Bui',      'email' => 'thu@bea.test',     'student_id' => 'STU1025', 'age' => 11, 'course' => '60 lessons'],
            ['name' => 'Long Nguyen',  'email' => 'long@bea.test',    'student_id' => 'STU1026', 'age' => 14, 'course' => '120 lessons'],
            ['name' => 'Phuong Le',    'email' => 'phuong@bea.test',  'student_id' => 'STU1027', 'age' => 12, 'course' => '60 lessons'],
            ['name' => 'Quang Tran',   'email' => 'quang@bea.test',   'student_id' => 'STU1028', 'age' => 15, 'course' => '120 lessons'],
            ['name' => 'Van Hoang',    'email' => 'van@bea.test',     'student_id' => 'STU1029', 'age' => 13, 'course' => '60 lessons'],
            ['name' => 'Anh Pham',     'email' => 'anh@bea.test',     'student_id' => 'STU1030', 'age' => 14, 'course' => '120 lessons'],
            ['name' => 'Dung Dao',     'email' => 'dung@bea.test',    'student_id' => 'STU1031', 'age' => 12, 'course' => '60 lessons'],
            ['name' => 'Thanh Vo',     'email' => 'thanh@bea.test',   'student_id' => 'STU1032', 'age' => 16, 'course' => '120 lessons'],
        ];

        foreach ($students as $row) {
            $user = User::create([
                'name'     => $row['name'],
                'email'    => $row['email'],
                'password' => Hash::make('password'),
                'role'     => 'student',
            ]);

            Student::create([
                'user_id'    => $user->id,
                'student_id' => $row['student_id'],
                'age'        => $row['age'],
                'course'     => $row['course'],
            ]);
        }
    }
}
