<?php

namespace App\Http\Controllers\ViceManager;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Student::with('user');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->whereHas('user', fn($u) => $u->where('name', 'like', "%{$s}%"))
                  ->orWhere('student_id', 'like', "%{$s}%");
            });
        }

        $students = $query->latest()->paginate(10)->withQueryString();

        return view('vice-manager.students.index', compact('students'));
    }

    public function show(Student $student): View
    {
        $student->load('user', 'schedules.teacher.user', 'teachingHistories.teacher.user');

        return view('vice-manager.students.show', compact('student'));
    }
}
