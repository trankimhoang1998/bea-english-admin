<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    public function index(Request $request): View
    {
        $query = Schedule::with('teacher.user', 'student.user');

        if ($request->filled('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }
        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }
        if ($request->filled('day_of_week')) {
            $query->where('day_of_week', $request->day_of_week);
        }
        if ($request->filled('time_from')) {
            $query->where('start_time', '>=', $request->time_from);
        }
        if ($request->filled('time_to')) {
            $query->where('start_time', '<=', $request->time_to);
        }

        $schedules = $query->orderByRaw("CASE day_of_week
            WHEN 'mon' THEN 1 WHEN 'tue' THEN 2 WHEN 'wed' THEN 3
            WHEN 'thu' THEN 4 WHEN 'fri' THEN 5 WHEN 'sat' THEN 6
            WHEN 'sun' THEN 7 END")
            ->orderBy('start_time')
            ->paginate(10)
            ->withQueryString();

        $teachers = Teacher::with('user')->orderBy('id')->get();
        $students = Student::with('user')->orderBy('id')->get();

        return view('manager.schedules.index', compact('schedules', 'teachers', 'students'));
    }

    public function create(): View
    {
        $teachers = Teacher::with('user')->orderBy('id')->get();
        $students = Student::with('user')->orderBy('id')->get();

        return view('manager.schedules.create', compact('teachers', 'students'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'teacher_id'  => ['required', 'exists:teachers,id'],
            'student_id'  => ['required', 'exists:students,id'],
            'day_of_week' => ['required', 'in:mon,tue,wed,thu,fri,sat,sun'],
            'start_time'  => ['required', 'date_format:H:i'],
            'end_time'    => ['required', 'date_format:H:i', 'after:start_time'],
        ]);

        if ($error = $this->checkConflict($data)) {
            return back()->withInput()->withErrors(['start_time' => $error]);
        }

        Schedule::create($data);

        return redirect()->route('manager.schedules.index')
            ->with('success', 'Schedule created successfully.');
    }

    public function edit(Schedule $schedule): View
    {
        $schedule->load('teacher.user', 'student.user');
        $teachers = Teacher::with('user')->orderBy('id')->get();
        $students = Student::with('user')->orderBy('id')->get();

        return view('manager.schedules.edit', compact('schedule', 'teachers', 'students'));
    }

    public function update(Request $request, Schedule $schedule): RedirectResponse
    {
        $data = $request->validate([
            'teacher_id'  => ['required', 'exists:teachers,id'],
            'student_id'  => ['required', 'exists:students,id'],
            'day_of_week' => ['required', 'in:mon,tue,wed,thu,fri,sat,sun'],
            'start_time'  => ['required', 'date_format:H:i'],
            'end_time'    => ['required', 'date_format:H:i', 'after:start_time'],
        ]);

        if ($error = $this->checkConflict($data, $schedule->id)) {
            return back()->withInput()->withErrors(['start_time' => $error]);
        }

        $schedule->update($data);

        return redirect()->route('manager.schedules.index')
            ->with('success', 'Schedule updated successfully.');
    }

    private function checkConflict(array $data, ?int $excludeId = null): ?string
    {
        $base = fn(string $col, mixed $val) => Schedule::where($col, $val)
            ->where('day_of_week', $data['day_of_week'])
            ->where('start_time', '<', $data['end_time'])
            ->where('end_time', '>', $data['start_time'])
            ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId));

        if ($base('teacher_id', $data['teacher_id'])->exists()) {
            return 'This teacher already has a schedule that overlaps this time slot on this day.';
        }

        if ($base('student_id', $data['student_id'])->exists()) {
            return 'This student already has a schedule that overlaps this time slot on this day.';
        }

        return null;
    }

    public function destroy(Schedule $schedule): RedirectResponse
    {
        $schedule->delete();

        return redirect()->route('manager.schedules.index')
            ->with('success', 'Schedule deleted successfully.');
    }
}
