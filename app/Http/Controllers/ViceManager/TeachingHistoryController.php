<?php

namespace App\Http\Controllers\ViceManager;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeachingHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TeachingHistoryController extends Controller
{
    public function index(Request $request): View
    {
        $query = TeachingHistory::with('teacher.user', 'student.user');

        if ($request->filled('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }
        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
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

        $histories = $query->orderByDesc('taught_date')->orderByDesc('time_from')->paginate(10)->withQueryString();
        $teachers  = Teacher::with('user')->orderBy('id')->get();
        $students  = Student::with('user')->orderBy('id')->get();

        return view('vice-manager.histories.index', compact('histories', 'teachers', 'students'));
    }

    public function show(TeachingHistory $history): View
    {
        $history->load('teacher.user', 'student.user');

        return view('vice-manager.histories.show', compact('history'));
    }

    public function streamVideo(TeachingHistory $history)
    {
        if (!$history->video_path) {
            abort(404);
        }

        return Storage::disk('local')->response($history->video_path);
    }

    public function downloadVideo(TeachingHistory $history)
    {
        if (!$history->video_path) {
            abort(404);
        }

        return Storage::disk('local')->download($history->video_path, basename($history->video_path));
    }
}
