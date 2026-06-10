<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeachingHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TeachingHistoryManagerController extends Controller
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
            $query->whereDate('taught_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('taught_at', '<=', $request->date_to);
        }

        $histories = $query->latest('taught_at')->paginate(10)->withQueryString();
        $teachers  = Teacher::with('user')->orderBy('id')->get();
        $students  = Student::with('user')->orderBy('id')->get();

        return view('manager.histories.index', compact('histories', 'teachers', 'students'));
    }

    public function show(TeachingHistory $history): View
    {
        $history->load('teacher.user', 'student.user');

        return view('manager.histories.show', compact('history'));
    }

    public function destroy(TeachingHistory $history): RedirectResponse
    {
        if ($history->video_path) {
            Storage::disk('local')->delete($history->video_path);
        }

        $history->delete();

        return redirect()->route('manager.histories.index')
            ->with('success', 'History record deleted successfully.');
    }
}
