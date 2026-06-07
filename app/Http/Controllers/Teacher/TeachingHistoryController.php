<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\TeachingHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TeachingHistoryController extends Controller
{
    private function teacher()
    {
        $teacher = auth()->user()->teacher;
        abort_unless($teacher, 403);

        return $teacher;
    }

    public function dashboard(): View
    {
        $teacher = $this->teacher()->load('schedules.student.user', 'user');

        $days = [
            'mon' => 'Mon',
            'tue' => 'Tue',
            'wed' => 'Wed',
            'thu' => 'Thu',
            'fri' => 'Fri',
            'sat' => 'Sat',
            'sun' => 'Sun',
        ];

        return view('teacher.dashboard', compact('teacher', 'days'));
    }

    public function index(): View
    {
        $teacher = $this->teacher();

        $histories = TeachingHistory::where('teacher_id', $teacher->id)
            ->with('student.user')
            ->latest('taught_at')
            ->paginate(10);

        return view('teacher.histories.index', compact('histories'));
    }

    public function create(): View
    {
        $teacher = $this->teacher();

        $students = Student::whereHas('schedules', fn($q) => $q->where('teacher_id', $teacher->id))
            ->with('user')
            ->get();

        return view('teacher.histories.create', compact('students'));
    }

    public function store(Request $request): RedirectResponse
    {
        $teacher = $this->teacher();

        $data = $request->validate([
            'student_id' => ['required', Rule::exists('schedules', 'student_id')->where('teacher_id', $this->teacher()->id)],
            'lesson'     => ['required', 'string', 'max:255'],
            'taught_at'  => ['required', 'date'],
            'duration'   => ['required', 'in:25,50'],
            'note'       => ['nullable', 'string', 'max:2000'],
            'video'      => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/quicktime', 'max:512000'],
        ]);

        $videoPath = null;
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos');
        }

        TeachingHistory::create([
            'teacher_id' => $teacher->id,
            'student_id' => $data['student_id'],
            'lesson'     => $data['lesson'],
            'taught_at'  => $data['taught_at'],
            'duration'   => $data['duration'],
            'note'       => $data['note'] ?? null,
            'video_path' => $videoPath,
        ]);

        return redirect()->route('teacher.histories.index')
            ->with('success', 'Teaching history saved successfully.');
    }

    public function show(TeachingHistory $history): View
    {
        if ($history->teacher_id !== $this->teacher()->id) {
            abort(403);
        }

        $history->load('student.user');

        return view('teacher.histories.show', compact('history'));
    }

    public function edit(TeachingHistory $history): View
    {
        if ($history->teacher_id !== $this->teacher()->id) {
            abort(403);
        }

        $teacher = $this->teacher();

        $students = Student::whereHas('schedules', fn($q) => $q->where('teacher_id', $teacher->id))
            ->with('user')
            ->get();

        $history->load('student.user');

        return view('teacher.histories.edit', compact('history', 'students'));
    }

    public function update(Request $request, TeachingHistory $history): RedirectResponse
    {
        if ($history->teacher_id !== $this->teacher()->id) {
            abort(403);
        }

        $data = $request->validate([
            'student_id' => ['required', Rule::exists('schedules', 'student_id')->where('teacher_id', $this->teacher()->id)],
            'lesson'     => ['required', 'string', 'max:255'],
            'taught_at'  => ['required', 'date'],
            'duration'   => ['required', 'in:25,50'],
            'note'       => ['nullable', 'string', 'max:2000'],
            'video'      => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/quicktime', 'max:512000'],
        ]);

        $videoPath = $history->video_path;
        if ($request->hasFile('video')) {
            if ($videoPath) {
                Storage::disk('local')->delete($videoPath);
            }
            $videoPath = $request->file('video')->store('videos');
        }

        $history->update([
            'student_id' => $data['student_id'],
            'lesson'     => $data['lesson'],
            'taught_at'  => $data['taught_at'],
            'duration'   => $data['duration'],
            'note'       => $data['note'] ?? null,
            'video_path' => $videoPath,
        ]);

        return redirect()->route('teacher.histories.index')
            ->with('success', 'Teaching history updated successfully.');
    }

    public function destroy(TeachingHistory $history): RedirectResponse
    {
        if ($history->teacher_id !== $this->teacher()->id) {
            abort(403);
        }

        if ($history->video_path) {
            Storage::disk('local')->delete($history->video_path);
        }

        $history->delete();

        return redirect()->route('teacher.histories.index')
            ->with('success', 'Record deleted.');
    }
}
