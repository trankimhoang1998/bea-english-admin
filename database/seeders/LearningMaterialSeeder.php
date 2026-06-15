<?php

namespace Database\Seeders;

use App\Models\LearningMaterial;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class LearningMaterialSeeder extends Seeder
{
    public function run(): void
    {
        $managerId = User::where('username', 'manager')->value('id');

        $s = fn(string $id) => Student::where('student_id', $id)->value('id');

        $materials = [
            // Open to all students
            ['title' => 'Unit 1 – Greetings Worksheet',         'description' => 'Practice common greetings and introductions: Hello, Good morning, Nice to meet you.',         'file_path' => 'materials/unit1-greetings.pdf',      'students' => []],
            ['title' => 'Unit 2 – Numbers & Colors Flashcards', 'description' => 'Flashcard set covering numbers 1–100 and basic color vocabulary with illustrations.',          'file_path' => 'materials/unit2-numbers.pdf',        'students' => []],
            ['title' => 'Unit 3 – Family Tree Template',         'description' => 'Fill-in template for describing family members and relationships using possessive forms.',      'file_path' => 'materials/unit3-family.pdf',         'students' => []],
            ['title' => 'Unit 4 – Daily Routines Reading',       'description' => 'Reading passage about a typical day; includes comprehension questions and new vocabulary.',    'file_path' => 'materials/unit4-routines.pdf',       'students' => []],
            ['title' => 'Unit 5 – Food and Drinks Vocabulary',   'description' => 'Word list and picture matching exercises for food, drinks, and ordering at a café.',           'file_path' => 'materials/unit5-food.pdf',           'students' => []],

            // Assigned to specific students
            ['title' => 'Unit 6 – Weather Expressions',          'description' => 'Vocabulary and speaking prompts for describing weather conditions and seasons.',                'file_path' => 'materials/unit6-weather.pdf',        'students' => ['STU1011', 'STU1014', 'STU1015', 'STU1022', 'STU1025']],
            ['title' => 'Unit 7 – At the Supermarket',           'description' => 'Role-play script and vocabulary list for shopping dialogues including quantities and prices.',  'file_path' => 'materials/unit7-supermarket.pdf',    'students' => ['STU1011', 'STU1016', 'STU1023', 'STU1027', 'STU1029']],
            ['title' => 'Unit 8 – Telling the Time',             'description' => 'Clock exercises and phrases for asking and telling the time in both formal and casual English.', 'file_path' => 'materials/unit8-time.pdf',           'students' => ['STU1017', 'STU1018', 'STU1022', 'STU1026', 'STU1028', 'STU1031']],
            ['title' => 'Unit 9 – Transport & Directions',       'description' => 'Map-based exercises for giving and following directions; covers prepositions of place.',        'file_path' => 'materials/unit9-transport.pdf',      'students' => ['STU1019', 'STU1020', 'STU1023', 'STU1027']],
            ['title' => 'Unit 10 – Health and Body Parts',       'description' => 'Vocabulary for body parts and common illnesses; includes a doctor–patient role-play.',         'file_path' => 'materials/unit10-health.pdf',        'students' => ['STU1021', 'STU1024', 'STU1025', 'STU1026', 'STU1028']],
            ['title' => 'Unit 11 – Hobbies and Interests',       'description' => 'Speaking and writing activities about free-time activities using like/love/enjoy + gerund.',   'file_path' => 'materials/unit11-hobbies.pdf',       'students' => ['STU1011', 'STU1014', 'STU1015', 'STU1016', 'STU1022', 'STU1023', 'STU1027', 'STU1028', 'STU1029']],
            ['title' => 'Unit 12 – At the Restaurant',           'description' => 'Menu reading, ordering food, and polite request expressions for restaurant situations.',        'file_path' => 'materials/unit12-restaurant.pdf',    'students' => []],
            ['title' => 'Unit 13 – School and Subjects',         'description' => 'Vocabulary for school subjects, classroom objects, and talking about study schedules.',         'file_path' => 'materials/unit13-school.pdf',        'students' => []],
            ['title' => 'Unit 14 – Sports and Activities',       'description' => 'Vocabulary and discussion questions about sports; covers play/do/go collocations.',             'file_path' => 'materials/unit14-sports.pdf',        'students' => ['STU1017', 'STU1018', 'STU1019', 'STU1020', 'STU1021', 'STU1022', 'STU1023', 'STU1027', 'STU1029']],
            ['title' => 'Unit 15 – Past Tense Exercises',        'description' => 'Gap-fill and story-retelling exercises practicing regular and irregular past tense verbs.',     'file_path' => 'materials/unit15-past-tense.pdf',    'students' => ['STU1011', 'STU1014', 'STU1023', 'STU1027', 'STU1028', 'STU1029']],
            ['title' => 'Unit 16 – Future Plans',                'description' => 'Writing and speaking tasks using will, going to, and present continuous for future.',           'file_path' => 'materials/unit16-future.pdf',        'students' => []],
            ['title' => 'Unit 17 – Comparative Adjectives',      'description' => 'Exercises comparing people, places, and things using comparative and superlative forms.',       'file_path' => 'materials/unit17-comparatives.pdf',  'students' => []],
            ['title' => 'Unit 18 – Modal Verbs Reference Sheet', 'description' => 'Quick-reference card for can, could, must, should, may, might with example sentences.',        'file_path' => 'materials/unit18-modals.pdf',        'students' => ['STU1015', 'STU1016', 'STU1023', 'STU1024', 'STU1027', 'STU1029', 'STU1030']],
            ['title' => 'Unit 19 – Listening Practice MP3',      'description' => 'Audio recording of native-speaker dialogues; students answer comprehension questions.',         'file_path' => 'materials/unit19-listening.mp3',     'students' => ['STU1011', 'STU1014', 'STU1015', 'STU1016', 'STU1017', 'STU1018', 'STU1023', 'STU1027', 'STU1029', 'STU1030', 'STU1032']],
            ['title' => 'Unit 20 – Final Review Test',           'description' => 'Comprehensive test covering all units: vocabulary, grammar, reading, and writing sections.',    'file_path' => 'materials/unit20-review.pdf',        'students' => ['STU1011', 'STU1014', 'STU1015', 'STU1016', 'STU1017', 'STU1018', 'STU1019', 'STU1020', 'STU1021', 'STU1023', 'STU1024']],

            // Link-based materials
            ['title' => 'Oxford Learner\'s Dictionary',        'description' => 'Free online dictionary with pronunciation audio, example sentences, and word families.',              'material_link' => 'https://www.oxfordlearnersdictionaries.com',                     'students' => []],
            ['title' => 'BBC Learning English',                'description' => 'Short video and audio lessons on grammar, vocabulary, and everyday English from BBC.',                'material_link' => 'https://www.bbc.co.uk/learningenglish',                         'students' => ['STU1011', 'STU1014', 'STU1016', 'STU1022', 'STU1025']],
            ['title' => 'Cambridge Dictionary Online',        'description' => 'Trusted English dictionary and thesaurus with clear definitions and real usage examples.',            'material_link' => 'https://dictionary.cambridge.org',                              'students' => []],
            ['title' => 'English Grammar in Use (Supplement)', 'description' => 'Extra practice exercises that accompany the Murphy Grammar in Use series.',                         'material_link' => 'https://www.cambridge.org/elt/grammar-in-use',                  'students' => ['STU1023', 'STU1027', 'STU1028', 'STU1030', 'STU1031']],
        ];

        foreach ($materials as $row) {
            $material = LearningMaterial::create([
                'title'         => $row['title'],
                'description'   => $row['description'],
                'file_path'     => $row['file_path'] ?? null,
                'material_link' => $row['material_link'] ?? null,
                'uploaded_by'   => $managerId,
            ]);

            if (!empty($row['students'])) {
                $ids = array_filter(array_map($s, $row['students']));
                $material->students()->sync($ids);
            }
        }
    }
}
