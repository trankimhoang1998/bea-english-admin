<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeachingHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
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

        return view('manager.histories.index', compact('histories', 'teachers', 'students'));
    }

    public function show(TeachingHistory $history): View
    {
        $history->load('teacher.user', 'student.user');

        return view('manager.histories.show', compact('history'));
    }

    public function edit(TeachingHistory $history): View
    {
        $history->load('teacher.user', 'student.user');
        $teachers = Teacher::with('user')->orderBy('id')->get();
        $students = Student::with('user')->orderBy('id')->get();

        return view('manager.histories.edit', compact('history', 'teachers', 'students'));
    }

    public function update(Request $request, TeachingHistory $history): RedirectResponse
    {
        $rules = [
            'teacher_id'  => ['required', 'exists:teachers,id'],
            'student_id'  => ['required', 'exists:students,id'],
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
            'teacher_id'  => $data['teacher_id'],
            'student_id'  => $data['student_id'],
            'taught_date' => $data['taught_date'],
            'time_from'   => $data['time_from'],
            'time_to'     => $data['time_to'],
            'duration'    => $data['duration'],
            'note'        => $data['note'] ?? null,
            'video_path'  => $videoPath,
            'video_link'  => $videoLink,
        ]);

        return redirect()->route('manager.histories.show', $history)
            ->with('success', 'Teaching history updated successfully.');
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

        $filename = 'Lesson-' . str_pad($history->lesson_number, 2, '0', STR_PAD_LEFT) . '.mp4';

        return Storage::disk('local')->download($history->video_path, $filename);
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
