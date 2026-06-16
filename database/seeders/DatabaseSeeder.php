<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\MaterialCategorySeeder;
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

        // Vice-Manager account
        User::create([
            'name'     => 'Vice Manager',
            'username' => 'vicemanager',
            'password' => Hash::make('password'),
            'role'     => 'vice-manager',
        ]);

        $this->call([
            TeacherSeeder::class,
            StudentSeeder::class,
            ScheduleSeeder::class,
            TeachingHistorySeeder::class,
            MaterialCategorySeeder::class,
            LearningMaterialSeeder::class,
        ]);
    }
}
