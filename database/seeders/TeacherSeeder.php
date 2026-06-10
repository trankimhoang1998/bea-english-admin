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
            ['name' => 'Ann Oliver',      'username' => 'annoliver101',     'teacher_id' => 'TEA101', 'experience' => '5 years'],
            ['name' => 'Bob Smith',        'username' => 'bobsmith102',      'teacher_id' => 'TEA102', 'experience' => '3 years'],
            ['name' => 'Carol White',      'username' => 'carolwhite103',    'teacher_id' => 'TEA103', 'experience' => '7 years'],
            ['name' => 'David Brown',      'username' => 'davidbrown104',    'teacher_id' => 'TEA104', 'experience' => '2 years'],
            ['name' => 'Emma Davis',       'username' => 'emmadavis105',     'teacher_id' => 'TEA105', 'experience' => '4 years'],
            ['name' => 'Frank Wilson',     'username' => 'frankwilson106',   'teacher_id' => 'TEA106', 'experience' => '6 years'],
            ['name' => 'Grace Lee',        'username' => 'gracelee107',      'teacher_id' => 'TEA107', 'experience' => '8 years'],
            ['name' => 'Henry Taylor',     'username' => 'henrytaylor108',   'teacher_id' => 'TEA108', 'experience' => '1 year'],
            ['name' => 'Isabella Moore',   'username' => 'isabellamoore109', 'teacher_id' => 'TEA109', 'experience' => '10 years'],
            ['name' => 'Jack Anderson',    'username' => 'jackanderson110',  'teacher_id' => 'TEA110', 'experience' => '3 years'],
            ['name' => 'Karen Thomas',     'username' => 'karenthomas111',   'teacher_id' => 'TEA111', 'experience' => '5 years'],
            ['name' => 'Liam Jackson',     'username' => 'liamjackson112',   'teacher_id' => 'TEA112', 'experience' => '2 years'],
            ['name' => 'Mia Harris',       'username' => 'miaharris113',     'teacher_id' => 'TEA113', 'experience' => '4 years'],
            ['name' => 'Noah Martin',      'username' => 'noahmartin114',    'teacher_id' => 'TEA114', 'experience' => '7 years'],
            ['name' => 'Olivia Garcia',    'username' => 'oliviagarcia115',  'teacher_id' => 'TEA115', 'experience' => '6 years'],
            ['name' => 'Paul Martinez',    'username' => 'paulmartinez116',  'teacher_id' => 'TEA116', 'experience' => '9 years'],
            ['name' => 'Quinn Robinson',   'username' => 'quinnrobinson117', 'teacher_id' => 'TEA117', 'experience' => '3 years'],
            ['name' => 'Rachel Clark',     'username' => 'rachelclark118',   'teacher_id' => 'TEA118', 'experience' => '5 years'],
            ['name' => 'Samuel Lewis',     'username' => 'samuellewis119',   'teacher_id' => 'TEA119', 'experience' => '2 years'],
            ['name' => 'Tina Walker',      'username' => 'tinawalker120',    'teacher_id' => 'TEA120', 'experience' => '4 years'],
        ];

        foreach ($teachers as $row) {
            $user = User::create([
                'name'     => $row['name'],
                'username' => $row['username'],
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
