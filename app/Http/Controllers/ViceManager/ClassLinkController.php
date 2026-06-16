<?php

namespace App\Http\Controllers\ViceManager;

use App\Http\Controllers\Controller;
use App\Models\ClassLink;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClassLinkController extends Controller
{
    public function index(Request $request): View
    {
        $query = ClassLink::with('teacher.user', 'student.user');

        if ($request->filled('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }
        $classLinks = $query->orderBy('teacher_id')->orderBy('student_id')->paginate(20)->withQueryString();
        $teachers   = Teacher::with('user')->orderBy('teacher_id')->get();

        return view('vice-manager.class-links.index', compact('classLinks', 'teachers'));
    }
}
