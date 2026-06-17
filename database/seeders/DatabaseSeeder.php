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
            'name'     => 'BEA Manager 1',
            'username' => 'bea.manager1',
            'password' => Hash::make('BEA@Mgr2026!#1'),
            'role'     => 'manager',
        ]);
        User::create([
            'name'     => 'BEA Manager 2',
            'username' => 'bea.manager2',
            'password' => Hash::make('BEA@Mgr2026!#2'),
            'role'     => 'manager',
        ]);
        User::create([
            'name'     => 'BEA Manager 3',
            'username' => 'bea.manager3',
            'password' => Hash::make('BEA@Mgr2026!#3'),
            'role'     => 'manager',
        ]);

        // Vice-Manager accounts
        User::create([
            'name'     => 'BEA Vice Manager 1',
            'username' => 'bea.vice1',
            'password' => Hash::make('BEA@Vice2026!#1'),
            'role'     => 'vice-manager',
        ]);
        User::create([
            'name'     => 'BEA Vice Manager 2',
            'username' => 'bea.vice2',
            'password' => Hash::make('BEA@Vice2026!#2'),
            'role'     => 'vice-manager',
        ]);
        User::create([
            'name'     => 'BEA Vice Manager 3',
            'username' => 'bea.vice3',
            'password' => Hash::make('BEA@Vice2026!#3'),
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
