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
            ['name' => 'Mai Huong',   'username' => 'maihuong1011',   'student_id' => 'STU1011', 'age' => 14, 'course' => '120 lessons'],
            ['name' => 'Kim Hoang',   'username' => 'kimhoang1014',   'student_id' => 'STU1014', 'age' => 13, 'course' => '120 lessons'],
            ['name' => 'Lan Nguyen',  'username' => 'lannguyen1015',  'student_id' => 'STU1015', 'age' => 12, 'course' => '60 lessons'],
            ['name' => 'Minh Tran',   'username' => 'minhtran1016',   'student_id' => 'STU1016', 'age' => 15, 'course' => '120 lessons'],
            ['name' => 'Hoa Le',      'username' => 'hoale1017',      'student_id' => 'STU1017', 'age' => 11, 'course' => '60 lessons'],
            ['name' => 'Nam Pham',    'username' => 'nampham1018',    'student_id' => 'STU1018', 'age' => 14, 'course' => '120 lessons'],
            ['name' => 'Linh Dao',    'username' => 'linhdao1019',    'student_id' => 'STU1019', 'age' => 13, 'course' => '60 lessons'],
            ['name' => 'Tuan Vo',     'username' => 'tuanvo1020',     'student_id' => 'STU1020', 'age' => 12, 'course' => '120 lessons'],
            ['name' => 'Ha Dang',     'username' => 'hadang1021',     'student_id' => 'STU1021', 'age' => 16, 'course' => '60 lessons'],
            ['name' => 'Bao Nguyen',  'username' => 'baonguyen1022',  'student_id' => 'STU1022', 'age' => 14, 'course' => '120 lessons'],
            ['name' => 'Yen Truong',  'username' => 'yentruong1023',  'student_id' => 'STU1023', 'age' => 13, 'course' => '60 lessons'],
            ['name' => 'Duc Phan',    'username' => 'ducphan1024',    'student_id' => 'STU1024', 'age' => 15, 'course' => '120 lessons'],
            ['name' => 'Thu Bui',     'username' => 'thubui1025',     'student_id' => 'STU1025', 'age' => 11, 'course' => '60 lessons'],
            ['name' => 'Long Nguyen', 'username' => 'longnguyen1026', 'student_id' => 'STU1026', 'age' => 14, 'course' => '120 lessons'],
            ['name' => 'Phuong Le',   'username' => 'phuongle1027',   'student_id' => 'STU1027', 'age' => 12, 'course' => '60 lessons'],
            ['name' => 'Quang Tran',  'username' => 'quangtran1028',  'student_id' => 'STU1028', 'age' => 15, 'course' => '120 lessons'],
            ['name' => 'Van Hoang',   'username' => 'vanhoang1029',   'student_id' => 'STU1029', 'age' => 13, 'course' => '60 lessons'],
            ['name' => 'Anh Pham',    'username' => 'anhpham1030',    'student_id' => 'STU1030', 'age' => 14, 'course' => '120 lessons'],
            ['name' => 'Dung Dao',    'username' => 'dungdao1031',    'student_id' => 'STU1031', 'age' => 12, 'course' => '60 lessons'],
            ['name' => 'Thanh Vo',    'username' => 'thanhvo1032',    'student_id' => 'STU1032', 'age' => 16, 'course' => '120 lessons'],
        ];

        foreach ($students as $row) {
            $user = User::create([
                'name'     => $row['name'],
                'username' => $row['username'],
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
