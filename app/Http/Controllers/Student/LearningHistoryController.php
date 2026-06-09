<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\TeachingHistory;
use Illuminate\Support\Facades\Storage;

class LearningHistoryController extends Controller
{
    private function student()
    {
        $student = auth()->user()->student;
        abort_unless($student, 403);

        return $student;
    }

    public function dashboard()
    {
        $student = $this->student()->load('schedules.teacher.user');

        $days = [
            'mon' => 'Mon',
            'tue' => 'Tue',
            'wed' => 'Wed',
            'thu' => 'Thu',
            'fri' => 'Fri',
            'sat' => 'Sat',
            'sun' => 'Sun',
        ];

        return view('student.dashboard', compact('student', 'days'));
    }

    public function index()
    {
        $student = $this->student();

        $histories = TeachingHistory::where('student_id', $student->id)
            ->with('teacher.user')
            ->latest('taught_at')
            ->paginate(10);

        return view('student.history.index', compact('histories'));
    }

    public function show(TeachingHistory $history)
    {
        if ($history->student_id !== $this->student()->id) {
            abort(403);
        }

        $history->load('teacher.user');

        return view('student.history.show', compact('history'));
    }

    public function downloadVideo(TeachingHistory $history)
    {
        if ($history->student_id !== $this->student()->id) {
            abort(403);
        }

        if (!$history->video_path) {
            abort(404);
        }

        $filename = 'Lesson-' . str_pad($history->lesson_number, 2, '0', STR_PAD_LEFT) . '.mp4';

        return Storage::disk('local')->download($history->video_path, $filename);
    }
}
