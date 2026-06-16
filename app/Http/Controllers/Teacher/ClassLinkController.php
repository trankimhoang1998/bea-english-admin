<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\ClassLink;
use App\Models\Schedule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClassLinkController extends Controller
{
    private function teacher()
    {
        $teacher = auth()->user()->teacher;
        abort_unless($teacher, 403);
        return $teacher;
    }

    public function store(Request $request): RedirectResponse
    {
        $teacher = $this->teacher();

        $data = $request->validate([
            'student_id' => ['required', 'integer', 'exists:students,id'],
            'link'       => ['required', 'url', 'max:500'],
        ]);

        // Ensure this student is actually taught by this teacher
        abort_unless(
            Schedule::where('teacher_id', $teacher->id)->where('student_id', $data['student_id'])->exists(),
            403
        );

        ClassLink::updateOrCreate(
            ['teacher_id' => $teacher->id, 'student_id' => $data['student_id']],
            ['link' => $data['link']]
        );

        return back()->with('success', 'Class link saved.');
    }

    public function update(Request $request, ClassLink $classLink): RedirectResponse
    {
        $teacher = $this->teacher();
        abort_unless($classLink->teacher_id === $teacher->id, 403);

        $data = $request->validate(['link' => ['required', 'url', 'max:500']]);
        $classLink->update($data);

        return back()->with('success', 'Class link updated.');
    }

    public function destroy(ClassLink $classLink): RedirectResponse
    {
        $teacher = $this->teacher();
        abort_unless($classLink->teacher_id === $teacher->id, 403);

        $classLink->delete();

        return back()->with('success', 'Class link removed.');
    }
}
