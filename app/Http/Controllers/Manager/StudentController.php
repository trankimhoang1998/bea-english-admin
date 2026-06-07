<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(): View
    {
        $students = Student::with('user')->latest()->paginate(10);

        return view('manager.students.index', compact('students'));
    }

    public function create(): View
    {
        return view('manager.students.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'unique:users,email'],
            'password'   => ['required', 'string', 'min:8'],
            'student_id' => ['required', 'string', 'max:50', 'unique:students,student_id'],
            'age'        => ['required', 'integer', 'min:5', 'max:99'],
            'course'     => ['required', 'string', 'max:100'],
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'student',
        ]);

        Student::create([
            'user_id'    => $user->id,
            'student_id' => $data['student_id'],
            'age'        => $data['age'],
            'course'     => $data['course'],
        ]);

        return redirect()->route('manager.students.index')
            ->with('success', 'Student created successfully.');
    }

    public function show(Student $student): View
    {
        $student->load('user', 'schedules.teacher.user', 'teachingHistories.teacher.user');

        return view('manager.students.show', compact('student'));
    }

    public function edit(Student $student): View
    {
        $student->load('user');

        return view('manager.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student): RedirectResponse
    {
        $student->load('user');

        $data = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', Rule::unique('users', 'email')->ignore($student->user_id)],
            'student_id' => ['required', 'string', 'max:50', Rule::unique('students', 'student_id')->ignore($student->id)],
            'age'        => ['required', 'integer', 'min:5', 'max:99'],
            'course'     => ['required', 'string', 'max:100'],
        ]);

        $student->user->update([
            'name'  => $data['name'],
            'email' => $data['email'],
        ]);

        $student->update([
            'student_id' => $data['student_id'],
            'age'        => $data['age'],
            'course'     => $data['course'],
        ]);

        return redirect()->route('manager.students.index')
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student): RedirectResponse
    {
        if ($student->teachingHistories()->exists()) {
            return redirect()->route('manager.students.index')
                ->with('error', 'Cannot delete student: they have existing teaching history records.');
        }

        $user = $student->user;
        $student->schedules()->delete();
        $student->delete();
        $user->delete();

        return redirect()->route('manager.students.index')
            ->with('success', 'Student deleted successfully.');
    }
}
