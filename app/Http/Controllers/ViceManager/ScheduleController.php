<?php

namespace App\Http\Controllers\ViceManager;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Teacher;
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

        return view('vice-manager.schedules.index', compact('schedules', 'teachers', 'students'));
    }
}
