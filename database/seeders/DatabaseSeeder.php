<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Manager account
        User::create([
            'name'     => 'Admin Manager',
            'username' => 'manager',
            'password' => Hash::make('password'),
            'role'     => 'manager',
        ]);

        $this->call([
            TeacherSeeder::class,
            StudentSeeder::class,
            ScheduleSeeder::class,
            TeachingHistorySeeder::class,
            LearningMaterialSeeder::class,
        ]);
    }
}
