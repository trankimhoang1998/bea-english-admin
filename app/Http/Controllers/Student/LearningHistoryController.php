<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeachingHistory;
use Illuminate\Http\Request;
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

    public function index(Request $request)
    {
        $student = $this->student();

        $query = TeachingHistory::where('student_id', $student->id)->with('teacher.user');

        if ($request->filled('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }
        if ($request->filled('date_from')) {
            $query->where('taught_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->where('taught_date', '<=', $request->date_to);
        }
        if ($request->filled('time_from')) {
            $query->where('time_from', '>=', $request->time_from);
        }
        if ($request->filled('time_to')) {
            $query->where('time_to', '<=', $request->time_to);
        }
        if ($request->filled('duration')) {
            $query->where('duration', $request->duration);
        }

        $histories = $query->orderByDesc('taught_date')->orderByDesc('time_from')
            ->paginate(10)->withQueryString();

        $teachers = Teacher::whereHas('teachingHistories', fn($q) => $q->where('student_id', $student->id))
            ->with('user')->get();

        return view('student.history.index', compact('histories', 'teachers'));
    }

    public function show(TeachingHistory $history)
    {
        if ($history->student_id !== $this->student()->id) {
            abort(403);
        }

        $history->load('teacher.user');

        return view('student.history.show', compact('history'));
    }

    public function streamVideo(TeachingHistory $history)
    {
        if ($history->student_id !== $this->student()->id) {
            abort(403);
        }

        if (!$history->video_path) {
            abort(404);
        }

        return Storage::disk('local')->response($history->video_path);
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
