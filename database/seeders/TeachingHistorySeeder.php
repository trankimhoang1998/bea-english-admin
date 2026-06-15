<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeachingHistory;
use Illuminate\Database\Seeder;

class TeachingHistorySeeder extends Seeder
{
    public function run(): void
    {
        $tIds     = Teacher::pluck('id', 'teacher_id');
        $sIds     = Student::pluck('id', 'student_id');
        $counters = [];
        $rows     = [];

        $add = function (string $tea, string $stu, string $tf, string $tt, int $dur, string $date, ?string $note, ?string $video = null)
            use ($tIds, $sIds, &$counters, &$rows): void {
            $counters[$stu] = ($counters[$stu] ?? 0) + 1;
            $rows[] = [
                'teacher_id'    => $tIds[$tea],
                'student_id'    => $sIds[$stu],
                'lesson_number' => $counters[$stu],
                'taught_date'   => $date,
                'time_from'     => $tf,
                'time_to'       => $tt,
                'duration'      => $dur,
                'note'          => $note,
                'video_path'    => $video,
            ];
        };

        // ════════════════════════════════════════════════════════════════════
        // TEA101 · Ann Oliver
        // ════════════════════════════════════════════════════════════════════

        // STU1011 · Mai Huong — 50 min · Mon 18:00–18:50 · 12 sessions
        foreach ([
            ['2026-02-09', 'Assessed level: pre-intermediate. Covered Unit 1 greetings and introductions.', null],
            ['2026-02-16', 'Pronunciation of /θ/ and /ð/ sounds — needs more practice. HW: Tongue-twister drills from handout.', null],
            ['2026-02-23', 'Vocabulary quiz: 18/20. Excellent result!', null],
            ['2026-03-02', null, null],
            ['2026-03-09', 'Introduced past simple. HW: Write 5 sentences describing last weekend.', null],
            ['2026-03-16', 'Past simple vs present perfect — some confusion. Extra drill sheet given.', null],
            ['2026-03-23', null, null],
            ['2026-03-30', 'Speaking exercise on daily routines — very confident today.', null],
            ['2026-04-06', 'Comparative adjectives introduced. HW: Compare 3 pairs of objects in writing.', null],
            ['2026-04-13', 'Mid-term review. Score: 85%. Ready for Unit 5.', null],
            ['2026-04-27', 'Covered modal verbs. HW: Write 3 sentences each for can/could/should/must.', 'videos/tea101_stu1011_lesson11.mp4'],
            ['2026-05-11', 'Type 1 conditionals — strong understanding. HW: Complete worksheet 9B.', 'videos/tea101_stu1011_lesson12.mp4'],
        ] as [$date, $note, $video]) {
            $add('TEA101', 'STU1011', '18:00', '18:50', 50, $date, $note, $video);
        }

        // STU1014 · Kim Hoang — 25 min · Tue 19:00–19:25 · 10 sessions
        foreach ([
            ['2026-03-03', 'First lesson — shy but attentive. Covered greetings and basic introductions.', null],
            ['2026-03-10', null, null],
            ['2026-03-17', 'Vocabulary review. HW: Learn 10 words from Unit 2 word list.', null],
            ['2026-03-24', 'Numbers and dates — good progress for session 4.', null],
            ['2026-03-31', null, null],
            ['2026-04-07', 'Reading comprehension. HW: Answer questions on page 18.', null],
            ['2026-04-14', 'Speaking confidence improving noticeably.', null],
            ['2026-04-21', 'Homework not submitted. Will follow up next session.', null],
            ['2026-05-05', 'Present continuous — good understanding. HW: Describe what family members are doing right now.', 'videos/tea101_stu1014_lesson09.mp4'],
            ['2026-05-19', 'Great session — student very prepared. Ready to advance to Unit 4.', 'videos/tea101_stu1014_lesson10.mp4'],
        ] as [$date, $note, $video]) {
            $add('TEA101', 'STU1014', '19:00', '19:25', 25, $date, $note, $video);
        }

        // STU1015 · Lan Nguyen — 25 min · Fri 18:00–18:25 · 8 sessions
        foreach ([
            ['2026-03-06', 'Fast learner — completed Unit 1 in single session.', null],
            ['2026-03-13', 'HW: Write a short self-introduction paragraph (50 words).', null],
            ['2026-03-20', null, null],
            ['2026-03-27', 'Irregular verbs quiz — 15/20. Review column 3 again.', null],
            ['2026-04-03', 'Question words (who/what/where/when/why). HW: Write 5 questions about a given photo.', null],
            ['2026-04-10', null, null],
            ['2026-05-01', 'Prepositions of place — solid understanding. HW: Write a description of your bedroom.', null],
            ['2026-05-15', 'Excellent session. Nearly at intermediate level.', 'videos/tea101_stu1015_lesson08.mp4'],
        ] as [$date, $note, $video]) {
            $add('TEA101', 'STU1015', '18:00', '18:25', 25, $date, $note, $video);
        }

        // STU1016 · Minh Tran — 25 min · Wed 19:00–19:25 · 7 sessions
        foreach ([
            ['2026-04-01', 'Strong grammar base, weaker vocabulary. Placed in Unit 4.', null],
            ['2026-04-08', 'Reported speech. HW: Convert 5 direct speech sentences to reported speech.', null],
            ['2026-04-15', null, null],
            ['2026-04-22', 'Writing task: informal email — good structure, minor spelling errors.', null],
            ['2026-04-29', 'Reading speed improving. HW: Read article and summarize in 3 sentences.', null],
            ['2026-05-06', null, null],
            ['2026-06-03', 'Passive voice introduced. HW: Rewrite 6 active sentences in passive form.', 'videos/tea101_stu1016_lesson07.mp4'],
        ] as [$date, $note, $video]) {
            $add('TEA101', 'STU1016', '19:00', '19:25', 25, $date, $note, $video);
        }

        // ════════════════════════════════════════════════════════════════════
        // TEA102 · Bob Smith
        // ════════════════════════════════════════════════════════════════════

        // STU1017 · Hoa Le — 25 min · Mon 17:00–17:25 · 9 sessions
        foreach ([
            ['2026-03-02', 'Enthusiastic student. Covered alphabet and basic greetings.', null],
            ['2026-03-09', null, null],
            ['2026-03-16', 'Numbers 1–100. HW: Practise counting daily using English.', null],
            ['2026-03-23', 'Colors and classroom objects — good memory retention.', null],
            ['2026-03-30', null, null],
            ['2026-04-06', 'Days of week and months. HW: Write a sample weekly schedule in English.', null],
            ['2026-04-13', 'Short reading passage — student understood main idea.', null],
            ['2026-04-27', 'Simple yes/no questions introduced. Good effort.', null],
            ['2026-05-11', 'Family vocabulary. HW: Write 5 sentences about your family members.', 'videos/tea102_stu1017_lesson09.mp4'],
        ] as [$date, $note, $video]) {
            $add('TEA102', 'STU1017', '17:00', '17:25', 25, $date, $note, $video);
        }

        // STU1018 · Nam Pham — 25 min · Tue 17:00–17:25 · 8 sessions
        foreach ([
            ['2026-03-03', 'Confident speaker — assessed at elementary level.', null],
            ['2026-03-10', 'HW: Practise introducing yourself in 3 sentences.', null],
            ['2026-03-17', null, null],
            ['2026-03-31', '"Do/does" question formation — some confusion. Worksheet given.', null],
            ['2026-04-07', null, null],
            ['2026-04-14', 'Hobbies vocabulary — good use of "like + -ing" structure.', null],
            ['2026-04-28', 'Telling the time. HW: Describe your daily schedule using time expressions.', null],
            ['2026-05-12', 'Strong session. HW: Write a paragraph about a typical school day.', 'videos/tea102_stu1018_lesson08.mp4'],
        ] as [$date, $note, $video]) {
            $add('TEA102', 'STU1018', '17:00', '17:25', 25, $date, $note, $video);
        }

        // STU1022 · Bao Nguyen — 25 min · Mon 17:30–17:55 · 6 sessions
        foreach ([
            ['2026-04-06', 'Placed at beginner level. Started Unit 1 — letters and sounds.', null],
            ['2026-04-13', 'Phonics — vowel sounds need more practice.', null],
            ['2026-04-20', null, null],
            ['2026-05-04', 'Basic greetings mastered. HW: Memorise 5 classroom phrases.', null],
            ['2026-05-18', 'Numbers 1–50 — good progress for 5 sessions.', null],
            ['2026-06-01', 'Colors and shapes covered. Ready to move to Unit 2.', 'videos/tea102_stu1022_lesson06.mp4'],
        ] as [$date, $note, $video]) {
            $add('TEA102', 'STU1022', '17:30', '17:55', 25, $date, $note, $video);
        }

        // STU1025 · Thu Bui — 25 min · Thu 17:30–17:55 · 5 sessions
        foreach ([
            ['2026-04-16', 'Young student (age 11) — very energetic. Phonics-based approach working well.', null],
            ['2026-04-23', 'Animal vocabulary — loved this topic. HW: Learn 10 animal names.', null],
            ['2026-04-30', null, null],
            ['2026-05-14', 'Basic sentences: "I see a ___." HW: Draw and label 5 animals in English.', null],
            ['2026-05-28', 'Body parts vocabulary. HW: Label a body diagram for next session.', null],
        ] as [$date, $note, $video]) {
            $add('TEA102', 'STU1025', '17:30', '17:55', 25, $date, $note, $video);
        }

        // ════════════════════════════════════════════════════════════════════
        // TEA103 · Carol White
        // ════════════════════════════════════════════════════════════════════

        // STU1019 · Linh Dao — 25 min · Mon 20:00–20:25 · 8 sessions
        foreach ([
            ['2026-03-02', 'Strong student — placed at intermediate level. Beginning Unit 4.', null],
            ['2026-03-09', 'Reading comprehension: scored 9/10. Very impressive.', null],
            ['2026-03-16', null, null],
            ['2026-03-23', 'Present perfect with already/just/yet. HW: Complete worksheet 5C.', null],
            ['2026-04-06', 'Listening exercise (BBC Level 2) — good comprehension.', null],
            ['2026-04-13', 'Formal writing. HW: Write a formal letter of complaint (150 words).', null],
            ['2026-04-27', null, null],
            ['2026-05-11', 'Mock exam preparation — estimated B1 level. Outstanding progress.', 'videos/tea103_stu1019_lesson08.mp4'],
        ] as [$date, $note, $video]) {
            $add('TEA103', 'STU1019', '20:00', '20:25', 25, $date, $note, $video);
        }

        // STU1020 · Tuan Vo — 25 min · Tue 20:00–20:25 · 7 sessions
        foreach ([
            ['2026-03-03', 'Needs more speaking confidence. Encouragement-focused session.', null],
            ['2026-03-17', 'Future forms (will/going to). HW: Write 3 predictions for next year.', null],
            ['2026-03-31', null, null],
            ['2026-04-14', 'Role play: shopping dialogue — improved confidence markedly.', null],
            ['2026-04-28', 'Unit 5 vocabulary. HW: Use 10 new words in original sentences.', null],
            ['2026-05-12', null, null],
            ['2026-06-02', 'Oral exam practice — passed with B1 equivalent score. Well done!', 'videos/tea103_stu1020_lesson07.mp4'],
        ] as [$date, $note, $video]) {
            $add('TEA103', 'STU1020', '20:00', '20:25', 25, $date, $note, $video);
        }

        // STU1023 · Yen Truong — 25 min · Thu 20:00–20:25 · 5 sessions
        foreach ([
            ['2026-04-16', 'New student — pre-intermediate. Clear learning goals set.', null],
            ['2026-04-23', 'Question tags. HW: Write 5 question tag sentences on any topic.', null],
            ['2026-05-07', null, null],
            ['2026-05-21', 'Listening task on daily routines — scored 7/10.', null],
            ['2026-06-04', 'HW: Prepare a 1-minute self-introduction for next session.', null],
        ] as [$date, $note, $video]) {
            $add('TEA103', 'STU1023', '20:00', '20:25', 25, $date, $note, $video);
        }

        // ════════════════════════════════════════════════════════════════════
        // TEA104 · David Brown
        // ════════════════════════════════════════════════════════════════════

        // STU1021 · Ha Dang — 50 min · Sun 09:00–09:50 · 8 sessions
        foreach ([
            ['2026-03-01', 'Initial assessment: upper-elementary. Very engaging student.', null],
            ['2026-03-08', 'Unit 2 covered in full. HW: Review vocabulary list and prepare summary.', null],
            ['2026-03-15', null, null],
            ['2026-03-22', 'Passive voice introduced. HW: Convert 8 active sentences to passive.', 'videos/tea104_stu1021_lesson04.mp4'],
            ['2026-03-29', 'Strong passive homework submitted. Extended to passive questions.', null],
            ['2026-04-05', 'Relative clauses. HW: Combine 5 sentence pairs using who/which/that.', null],
            ['2026-04-19', null, null],
            ['2026-05-03', 'Full reading + writing session. Essay draft reviewed — good structure.', 'videos/tea104_stu1021_lesson08.mp4'],
        ] as [$date, $note, $video]) {
            $add('TEA104', 'STU1021', '09:00', '09:50', 50, $date, $note, $video);
        }

        // STU1024 · Duc Phan — 25 min · Mon 15:00–15:25 · 7 sessions
        foreach ([
            ['2026-03-09', 'Assessed at intermediate. Reading strong, speaking needs development.', null],
            ['2026-03-16', 'Describing pictures — hesitant but improving.', null],
            ['2026-03-23', null, null],
            ['2026-04-06', 'HW: Prepare a 2-minute talk about a favourite place.', null],
            ['2026-04-20', 'Oral presentation — much more fluent than week 1. Great improvement!', 'videos/tea104_stu1024_lesson05.mp4'],
            ['2026-05-04', 'Discourse markers. HW: Write a paragraph using firstly / however / therefore.', null],
            ['2026-06-01', 'Final practice session before school exam. Student feels ready.', 'videos/tea104_stu1024_lesson07.mp4'],
        ] as [$date, $note, $video]) {
            $add('TEA104', 'STU1024', '15:00', '15:25', 25, $date, $note, $video);
        }

        // STU1026 · Long Nguyen — 50 min · Tue 15:00–15:50 · 5 sessions
        foreach ([
            ['2026-04-07', 'New student — beginner level. Very motivated.', null],
            ['2026-04-14', 'Alphabet, numbers, basic greetings. HW: Practise A–Z handwriting.', null],
            ['2026-04-28', null, null],
            ['2026-05-12', 'Simple present introduced. HW: Write 5 sentences about daily habits.', null],
            ['2026-06-02', 'Good 5-week progress. Moving to Unit 2 next session.', null],
        ] as [$date, $note, $video]) {
            $add('TEA104', 'STU1026', '15:00', '15:50', 50, $date, $note, $video);
        }

        // ════════════════════════════════════════════════════════════════════
        // TEA105 · Emma Davis
        // ════════════════════════════════════════════════════════════════════

        // STU1027 · Phuong Le — 50 min · Mon 16:00–16:50 · 6 sessions
        foreach ([
            ['2026-04-06', 'Assessment: pre-intermediate. Detailed personalised study plan created.', null],
            ['2026-04-13', 'Adverbs of frequency. HW: Rewrite 6 sentences placing adverbs correctly.', null],
            ['2026-04-20', null, null],
            ['2026-04-27', 'Listening + note-taking exercise. HW: Watch a 3-minute English video and summarise.', null],
            ['2026-05-11', 'Type 1 & 2 conditionals. Strong grasp of Type 1. HW: Complete worksheet 8A.', null],
            ['2026-06-01', 'Mock speaking exam — B1 level performance. Excellent 8-week progress.', 'videos/tea105_stu1027_lesson06.mp4'],
        ] as [$date, $note, $video]) {
            $add('TEA105', 'STU1027', '16:00', '16:50', 50, $date, $note, $video);
        }

        // STU1028 · Quang Tran — 25 min · Tue 16:00–16:25 · 5 sessions
        foreach ([
            ['2026-04-07', 'Elementary level. Focused on basic sentence structure: S+V+O.', null],
            ['2026-04-14', 'Subject-verb agreement. HW: Identify and correct 10 error sentences.', null],
            ['2026-04-21', null, null],
            ['2026-05-05', 'Present simple vs present continuous. HW: Choose correct tense in 8 sentences.', null],
            ['2026-06-02', 'Reading aloud exercise — good improvement in fluency over 5 sessions.', null],
        ] as [$date, $note, $video]) {
            $add('TEA105', 'STU1028', '16:00', '16:25', 25, $date, $note, $video);
        }

        // STU1029 · Van Hoang — 25 min · Wed 16:00–16:25 · 4 sessions
        foreach ([
            ['2026-05-06', 'New student — pre-intermediate. Placed in Unit 3.', null],
            ['2026-05-13', 'Past continuous. HW: Describe what you were doing at 5 specific times yesterday.', null],
            ['2026-05-20', null, null],
            ['2026-06-03', 'Short narrative paragraph — good use of time expressions.', null],
        ] as [$date, $note, $video]) {
            $add('TEA105', 'STU1029', '16:00', '16:25', 25, $date, $note, $video);
        }

        // ════════════════════════════════════════════════════════════════════
        // TEA106 · Frank Wilson
        // ════════════════════════════════════════════════════════════════════

        // STU1030 · Anh Pham — 50 min · Mon 14:00–14:50 · 5 sessions
        foreach ([
            ['2026-04-06', 'Assessment: intermediate. Business English focus requested by student.', null],
            ['2026-04-13', 'Formal vs informal writing. HW: Write a professional email (100 words).', null],
            ['2026-04-27', null, null],
            ['2026-05-11', 'Email reviewed — well structured. Introduced meeting/conference vocabulary.', null],
            ['2026-06-01', 'Presentation skills: opening and closing a talk. HW: Prepare a 2-minute product pitch.', 'videos/tea106_stu1030_lesson05.mp4'],
        ] as [$date, $note, $video]) {
            $add('TEA106', 'STU1030', '14:00', '14:50', 50, $date, $note, $video);
        }

        // STU1031 · Dung Dao — 25 min · Tue 14:00–14:25 · 4 sessions
        foreach ([
            ['2026-04-14', 'Beginner. Covered alphabet and basic phonics.', null],
            ['2026-04-21', 'Numbers and colors. HW: Write numbers 1–20 and all color names.', null],
            ['2026-05-05', null, null],
            ['2026-06-02', 'Greetings role play. Shy but improving steadily each week.', null],
        ] as [$date, $note, $video]) {
            $add('TEA106', 'STU1031', '14:00', '14:25', 25, $date, $note, $video);
        }

        // STU1032 · Thanh Vo — 50 min · Fri 14:00–14:50 · 4 sessions
        foreach ([
            ['2026-04-10', 'Upper-intermediate — IELTS preparation target agreed.', null],
            ['2026-04-24', 'Task 1 writing: describing a bar chart. HW: Write a full Task 1 response (150 words).', null],
            ['2026-05-08', 'Task 1 reviewed — band 6 equivalent. Good data language. HW: Draft a Task 2 introduction.', null],
            ['2026-06-05', 'Task 2 essay structure. HW: Write a full Task 2 essay on the given topic.', 'videos/tea106_stu1032_lesson04.mp4'],
        ] as [$date, $note, $video]) {
            $add('TEA106', 'STU1032', '14:00', '14:50', 50, $date, $note, $video);
        }

        foreach ($rows as $row) {
            TeachingHistory::create($row);
        }
    }
}
