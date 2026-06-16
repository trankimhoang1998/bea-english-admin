<?php

namespace App\Http\Controllers\ViceManager;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index(Request $request): View
    {
        $query = Teacher::with('user');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->whereHas('user', fn($u) => $u->where('name', 'like', "%{$s}%"))
                  ->orWhere('teacher_id', 'like', "%{$s}%");
            });
        }

        $teachers = $query->latest()->paginate(10)->withQueryString();

        return view('vice-manager.teachers.index', compact('teachers'));
    }

    public function show(Teacher $teacher): View
    {
        $teacher->load('user', 'schedules.student.user', 'teachingHistories.student.user');

        return view('vice-manager.teachers.show', compact('teacher'));
    }
}
