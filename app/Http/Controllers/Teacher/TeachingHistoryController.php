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

    public function index(Request $request): View
    {
        $teacher = $this->teacher();

        $query = TeachingHistory::where('teacher_id', $teacher->id)->with('student.user');

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
        $students  = Student::whereHas('schedules', fn($q) => $q->where('teacher_id', $teacher->id))
            ->with('user')->get();

        return view('teacher.histories.index', compact('histories', 'students'));
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

        $rules = [
            'student_id'  => ['required', Rule::exists('schedules', 'student_id')->where('teacher_id', $teacher->id)],
            'taught_date' => ['required', 'date'],
            'time_from'   => ['required', 'date_format:H:i'],
            'time_to'     => ['required', 'date_format:H:i', 'after:time_from'],
            'duration'    => ['required', 'in:25,50'],
            'note'        => ['nullable', 'string', 'max:2000'],
            'video_type'  => ['required', 'in:file,link'],
        ];
        if ($request->input('video_type') === 'link') {
            $rules['video_link'] = ['required', 'url', 'max:500'];
        } else {
            $rules['video'] = ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/quicktime', 'max:512000'];
        }
        $data = $request->validate($rules);

        $lessonNumber = TeachingHistory::where('student_id', $data['student_id'])->count() + 1;

        $videoPath = null;
        $videoLink = null;
        if ($request->input('video_type') === 'link') {
            $videoLink = $request->input('video_link');
        } elseif ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos');
        }

        TeachingHistory::create([
            'teacher_id'    => $teacher->id,
            'student_id'    => $data['student_id'],
            'lesson_number' => $lessonNumber,
            'taught_date'   => $data['taught_date'],
            'time_from'     => $data['time_from'],
            'time_to'       => $data['time_to'],
            'duration'      => $data['duration'],
            'note'          => $data['note'] ?? null,
            'video_path'    => $videoPath,
            'video_link'    => $videoLink,
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

        $rules = [
            'student_id'  => ['required', Rule::exists('schedules', 'student_id')->where('teacher_id', $this->teacher()->id)],
            'taught_date' => ['required', 'date'],
            'time_from'   => ['required', 'date_format:H:i'],
            'time_to'     => ['required', 'date_format:H:i', 'after:time_from'],
            'duration'    => ['required', 'in:25,50'],
            'note'        => ['nullable', 'string', 'max:2000'],
            'video_type'  => ['required', 'in:file,link'],
        ];
        if ($request->input('video_type') === 'link') {
            $rules['video_link'] = ['required', 'url', 'max:500'];
        } else {
            $rules['video'] = ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/quicktime', 'max:512000'];
        }
        $data = $request->validate($rules);

        $videoPath = $history->video_path;
        $videoLink = $history->video_link;
        if ($request->input('video_type') === 'link') {
            if ($videoPath) {
                Storage::disk('local')->delete($videoPath);
                $videoPath = null;
            }
            $videoLink = $request->input('video_link');
        } elseif ($request->hasFile('video')) {
            if ($videoPath) {
                Storage::disk('local')->delete($videoPath);
            }
            $videoPath = $request->file('video')->store('videos');
            $videoLink = null;
        }

        $history->update([
            'student_id'  => $data['student_id'],
            'taught_date' => $data['taught_date'],
            'time_from'   => $data['time_from'],
            'time_to'     => $data['time_to'],
            'duration'    => $data['duration'],
            'note'        => $data['note'] ?? null,
            'video_path'  => $videoPath,
            'video_link'  => $videoLink,
        ]);

        return redirect()->route('teacher.histories.index')
            ->with('success', 'Teaching history updated successfully.');
    }

    public function streamVideo(TeachingHistory $history)
    {
        if ($history->teacher_id !== $this->teacher()->id) {
            abort(403);
        }

        if (!$history->video_path) {
            abort(404);
        }

        return Storage::disk('local')->response($history->video_path);
    }

    public function downloadVideo(TeachingHistory $history)
    {
        if ($history->teacher_id !== $this->teacher()->id) {
            abort(403);
        }

        if (!$history->video_path) {
            abort(404);
        }

        $filename = 'Lesson-' . str_pad($history->lesson_number, 2, '0', STR_PAD_LEFT) . '.mp4';

        return Storage::disk('local')->download($history->video_path, $filename);
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
