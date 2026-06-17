<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Manager accounts
        User::create([
            'name'     => 'BEA Manager',
            'username' => 'bea.manager',
            'password' => Hash::make('BEA@Benk26!#'),
            'role'     => 'manager',
        ]);
        User::create([
            'name'     => 'BEA Manager 1',
            'username' => 'bea.manager1',
            'password' => Hash::make('BEA@Main2026!#2'),
            'role'     => 'manager',
        ]);
        User::create([
            'name'     => 'BEA Manager 2',
            'username' => 'bea.manager2',
            'password' => Hash::make('BEA@Sec2526!#6'),
            'role'     => 'manager',
        ]);

        // Vice-Manager accounts
        User::create([
            'name'     => 'BEA Vice Manager',
            'username' => 'bea.vice',
            'password' => Hash::make('BEA@ViceK2026!#'),
            'role'     => 'vice-manager',
        ]);
        User::create([
            'name'     => 'BEA Vice Manager 1',
            'username' => 'bea.vice1',
            'password' => Hash::make('BEA@Vmain26!#2'),
            'role'     => 'vice-manager',
        ]);
        User::create([
            'name'     => 'BEA Vice Manager 2',
            'username' => 'bea.vice2',
            'password' => Hash::make('BEA@Vsec2526!#6'),
            'role'     => 'vice-manager',
        ]);

        // $this->call([
        //     TeacherSeeder::class,
        //     StudentSeeder::class,
        //     ScheduleSeeder::class,
        //     TeachingHistorySeeder::class,
        //     MaterialCategorySeeder::class,
        //     LearningMaterialSeeder::class,
        // ]);
    }
}
