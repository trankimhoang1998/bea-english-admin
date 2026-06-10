<?php

namespace Database\Seeders;

use App\Models\LearningMaterial;
use App\Models\User;
use Illuminate\Database\Seeder;

class LearningMaterialSeeder extends Seeder
{
    public function run(): void
    {
        $managerId = User::where('username', 'manager')->value('id');

        $materials = [
            ['title' => 'Unit 1 – Greetings Worksheet',         'description' => 'Practice common greetings and introductions: Hello, Good morning, Nice to meet you.',         'file_path' => 'materials/unit1-greetings.pdf'],
            ['title' => 'Unit 2 – Numbers & Colors Flashcards', 'description' => 'Flashcard set covering numbers 1–100 and basic color vocabulary with illustrations.',          'file_path' => 'materials/unit2-numbers.pdf'],
            ['title' => 'Unit 3 – Family Tree Template',         'description' => 'Fill-in template for describing family members and relationships using possessive forms.',      'file_path' => 'materials/unit3-family.pdf'],
            ['title' => 'Unit 4 – Daily Routines Reading',       'description' => 'Reading passage about a typical day; includes comprehension questions and new vocabulary.',    'file_path' => 'materials/unit4-routines.pdf'],
            ['title' => 'Unit 5 – Food and Drinks Vocabulary',   'description' => 'Word list and picture matching exercises for food, drinks, and ordering at a café.',           'file_path' => 'materials/unit5-food.pdf'],
            ['title' => 'Unit 6 – Weather Expressions',          'description' => 'Vocabulary and speaking prompts for describing weather conditions and seasons.',                'file_path' => 'materials/unit6-weather.pdf'],
            ['title' => 'Unit 7 – At the Supermarket',           'description' => 'Role-play script and vocabulary list for shopping dialogues including quantities and prices.',  'file_path' => 'materials/unit7-supermarket.pdf'],
            ['title' => 'Unit 8 – Telling the Time',             'description' => 'Clock exercises and phrases for asking and telling the time in both formal and casual English.', 'file_path' => 'materials/unit8-time.pdf'],
            ['title' => 'Unit 9 – Transport & Directions',       'description' => 'Map-based exercises for giving and following directions; covers prepositions of place.',        'file_path' => 'materials/unit9-transport.pdf'],
            ['title' => 'Unit 10 – Health and Body Parts',       'description' => 'Vocabulary for body parts and common illnesses; includes a doctor–patient role-play.',         'file_path' => 'materials/unit10-health.pdf'],
            ['title' => 'Unit 11 – Hobbies and Interests',       'description' => 'Speaking and writing activities about free-time activities using like/love/enjoy + gerund.',   'file_path' => 'materials/unit11-hobbies.pdf'],
            ['title' => 'Unit 12 – At the Restaurant',           'description' => 'Menu reading, ordering food, and polite request expressions for restaurant situations.',        'file_path' => 'materials/unit12-restaurant.pdf'],
            ['title' => 'Unit 13 – School and Subjects',         'description' => 'Vocabulary for school subjects, classroom objects, and talking about study schedules.',         'file_path' => 'materials/unit13-school.pdf'],
            ['title' => 'Unit 14 – Sports and Activities',       'description' => 'Vocabulary and discussion questions about sports; covers play/do/go collocations.',             'file_path' => 'materials/unit14-sports.pdf'],
            ['title' => 'Unit 15 – Past Tense Exercises',        'description' => 'Gap-fill and story-retelling exercises practicing regular and irregular past tense verbs.',     'file_path' => 'materials/unit15-past-tense.pdf'],
            ['title' => 'Unit 16 – Future Plans',                'description' => 'Writing and speaking tasks using will, going to, and present continuous for future.',           'file_path' => 'materials/unit16-future.pdf'],
            ['title' => 'Unit 17 – Comparative Adjectives',      'description' => 'Exercises comparing people, places, and things using comparative and superlative forms.',       'file_path' => 'materials/unit17-comparatives.pdf'],
            ['title' => 'Unit 18 – Modal Verbs Reference Sheet', 'description' => 'Quick-reference card for can, could, must, should, may, might with example sentences.',        'file_path' => 'materials/unit18-modals.pdf'],
            ['title' => 'Unit 19 – Listening Practice MP3',      'description' => 'Audio recording of native-speaker dialogues; students answer comprehension questions.',         'file_path' => 'materials/unit19-listening.mp3'],
            ['title' => 'Unit 20 – Final Review Test',           'description' => 'Comprehensive test covering all units: vocabulary, grammar, reading, and writing sections.',    'file_path' => 'materials/unit20-review.pdf'],
        ];

        foreach ($materials as $row) {
            LearningMaterial::create([
                'title'       => $row['title'],
                'description' => $row['description'],
                'file_path'   => $row['file_path'],
                'uploaded_by' => $managerId,
            ]);
        }
    }
}
