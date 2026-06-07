<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [
            ['name' => 'Ann Oliver',      'email' => 'ann@bea.test',     'teacher_id' => 'TEA101', 'experience' => '5 years'],
            ['name' => 'Bob Smith',       'email' => 'bob@bea.test',     'teacher_id' => 'TEA102', 'experience' => '3 years'],
            ['name' => 'Carol White',     'email' => 'carol@bea.test',   'teacher_id' => 'TEA103', 'experience' => '7 years'],
            ['name' => 'David Brown',     'email' => 'david@bea.test',   'teacher_id' => 'TEA104', 'experience' => '2 years'],
            ['name' => 'Emma Davis',      'email' => 'emma@bea.test',    'teacher_id' => 'TEA105', 'experience' => '4 years'],
            ['name' => 'Frank Wilson',    'email' => 'frank@bea.test',   'teacher_id' => 'TEA106', 'experience' => '6 years'],
            ['name' => 'Grace Lee',       'email' => 'grace@bea.test',   'teacher_id' => 'TEA107', 'experience' => '8 years'],
            ['name' => 'Henry Taylor',    'email' => 'henry@bea.test',   'teacher_id' => 'TEA108', 'experience' => '1 year'],
            ['name' => 'Isabella Moore',  'email' => 'isabella@bea.test','teacher_id' => 'TEA109', 'experience' => '10 years'],
            ['name' => 'Jack Anderson',   'email' => 'jack@bea.test',    'teacher_id' => 'TEA110', 'experience' => '3 years'],
            ['name' => 'Karen Thomas',    'email' => 'karen@bea.test',   'teacher_id' => 'TEA111', 'experience' => '5 years'],
            ['name' => 'Liam Jackson',    'email' => 'liam@bea.test',    'teacher_id' => 'TEA112', 'experience' => '2 years'],
            ['name' => 'Mia Harris',      'email' => 'mia@bea.test',     'teacher_id' => 'TEA113', 'experience' => '4 years'],
            ['name' => 'Noah Martin',     'email' => 'noah@bea.test',    'teacher_id' => 'TEA114', 'experience' => '7 years'],
            ['name' => 'Olivia Garcia',   'email' => 'olivia@bea.test',  'teacher_id' => 'TEA115', 'experience' => '6 years'],
            ['name' => 'Paul Martinez',   'email' => 'paul@bea.test',    'teacher_id' => 'TEA116', 'experience' => '9 years'],
            ['name' => 'Quinn Robinson',  'email' => 'quinn@bea.test',   'teacher_id' => 'TEA117', 'experience' => '3 years'],
            ['name' => 'Rachel Clark',    'email' => 'rachel@bea.test',  'teacher_id' => 'TEA118', 'experience' => '5 years'],
            ['name' => 'Samuel Lewis',    'email' => 'samuel@bea.test',  'teacher_id' => 'TEA119', 'experience' => '2 years'],
            ['name' => 'Tina Walker',     'email' => 'tina@bea.test',    'teacher_id' => 'TEA120', 'experience' => '4 years'],
        ];

        foreach ($teachers as $row) {
            $user = User::create([
                'name'     => $row['name'],
                'email'    => $row['email'],
                'password' => Hash::make('password'),
                'role'     => 'teacher',
            ]);

            Teacher::create([
                'user_id'    => $user->id,
                'teacher_id' => $row['teacher_id'],
                'experience' => $row['experience'],
            ]);
        }
    }
}
