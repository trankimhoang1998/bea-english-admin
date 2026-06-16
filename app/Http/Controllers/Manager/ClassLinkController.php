<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\ClassLink;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
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

        return view('manager.class-links.index', compact('classLinks', 'teachers'));
    }

    public function update(Request $request, ClassLink $classLink): RedirectResponse
    {
        $data = $request->validate([
            'class_id'   => ['nullable', 'string', 'max:100'],
            'class_link' => ['nullable', 'string', 'max:500'],
        ]);
        $classLink->update($data);

        return redirect()->route('manager.class-links.index')->with('success', 'Class link updated.');
    }

    public function destroy(ClassLink $classLink): RedirectResponse
    {
        $classLink->delete();
        return back()->with('success', 'Class link deleted.');
    }
}
