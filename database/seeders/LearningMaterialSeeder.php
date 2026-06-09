<?php

namespace Database\Seeders;

use App\Models\LearningMaterial;
use App\Models\User;
use Illuminate\Database\Seeder;

class LearningMaterialSeeder extends Seeder
{
    public function run(): void
    {
        $managerId = User::where('email', 'manager@bea.test')->value('id');

        $materials = [
            ['title' => 'Unit 1 – Greetings Worksheet',        'file_path' => 'materials/unit1-greetings.pdf'],
            ['title' => 'Unit 2 – Numbers & Colors Flashcards','file_path' => 'materials/unit2-numbers.pdf'],
            ['title' => 'Unit 3 – Family Tree Template',        'file_path' => 'materials/unit3-family.pdf'],
            ['title' => 'Unit 4 – Daily Routines Reading',      'file_path' => 'materials/unit4-routines.pdf'],
            ['title' => 'Unit 5 – Food and Drinks Vocabulary',  'file_path' => 'materials/unit5-food.pdf'],
            ['title' => 'Unit 6 – Weather Expressions',         'file_path' => 'materials/unit6-weather.pdf'],
            ['title' => 'Unit 7 – At the Supermarket',          'file_path' => 'materials/unit7-supermarket.pdf'],
            ['title' => 'Unit 8 – Telling the Time',            'file_path' => 'materials/unit8-time.pdf'],
            ['title' => 'Unit 9 – Transport & Directions',      'file_path' => 'materials/unit9-transport.pdf'],
            ['title' => 'Unit 10 – Health and Body Parts',      'file_path' => 'materials/unit10-health.pdf'],
            ['title' => 'Unit 11 – Hobbies and Interests',      'file_path' => 'materials/unit11-hobbies.pdf'],
            ['title' => 'Unit 12 – At the Restaurant',          'file_path' => 'materials/unit12-restaurant.pdf'],
            ['title' => 'Unit 13 – School and Subjects',        'file_path' => 'materials/unit13-school.pdf'],
            ['title' => 'Unit 14 – Sports and Activities',      'file_path' => 'materials/unit14-sports.pdf'],
            ['title' => 'Unit 15 – Past Tense Exercises',       'file_path' => 'materials/unit15-past-tense.pdf'],
            ['title' => 'Unit 16 – Future Plans',               'file_path' => 'materials/unit16-future.pdf'],
            ['title' => 'Unit 17 – Comparative Adjectives',     'file_path' => 'materials/unit17-comparatives.pdf'],
            ['title' => 'Unit 18 – Modal Verbs Reference Sheet','file_path' => 'materials/unit18-modals.pdf'],
            ['title' => 'Unit 19 – Listening Practice MP3',     'file_path' => 'materials/unit19-listening.mp3'],
            ['title' => 'Unit 20 – Final Review Test',          'file_path' => 'materials/unit20-review.pdf'],
        ];

        foreach ($materials as $row) {
            LearningMaterial::create([
                'title'       => $row['title'],
                'description' => null,
                'file_path'   => $row['file_path'],
                'uploaded_by' => $managerId,
            ]);
        }
    }
}
