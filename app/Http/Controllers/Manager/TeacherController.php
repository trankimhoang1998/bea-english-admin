<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index(): View
    {
        $teachers = Teacher::with('user')->latest()->paginate(10);

        return view('manager.teachers.index', compact('teachers'));
    }

    public function create(): View
    {
        return view('manager.teachers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'email', 'unique:users,email'],
            'password'    => ['required', 'string', 'min:8'],
            'teacher_id'  => ['required', 'string', 'max:50', 'unique:teachers,teacher_id'],
            'experience'  => ['required', 'string', 'max:100'],
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'teacher',
        ]);

        Teacher::create([
            'user_id'    => $user->id,
            'teacher_id' => $data['teacher_id'],
            'experience' => $data['experience'],
        ]);

        return redirect()->route('manager.teachers.index')
            ->with('success', 'Teacher created successfully.');
    }

    public function show(Teacher $teacher): View
    {
        $teacher->load('user', 'schedules.student.user', 'teachingHistories.student.user');

        return view('manager.teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher): View
    {
        $teacher->load('user');

        return view('manager.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher): RedirectResponse
    {
        $teacher->load('user');

        $data = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', Rule::unique('users', 'email')->ignore($teacher->user_id)],
            'password'   => ['nullable', 'string', 'min:8'],
            'teacher_id' => ['required', 'string', 'max:50', Rule::unique('teachers', 'teacher_id')->ignore($teacher->id)],
            'experience' => ['required', 'string', 'max:100'],
        ]);

        $userUpdate = ['name' => $data['name'], 'email' => $data['email']];
        if (!empty($data['password'])) {
            $userUpdate['password'] = Hash::make($data['password']);
        }
        $teacher->user->update($userUpdate);

        $teacher->update([
            'teacher_id' => $data['teacher_id'],
            'experience' => $data['experience'],
        ]);

        return redirect()->route('manager.teachers.index')
            ->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher): RedirectResponse
    {
        if ($teacher->teachingHistories()->exists()) {
            return redirect()->route('manager.teachers.index')
                ->with('error', 'Cannot delete teacher: they have existing teaching history records.');
        }

        $user = $teacher->user;
        $teacher->schedules()->delete();
        $teacher->delete();
        $user->delete();

        return redirect()->route('manager.teachers.index')
            ->with('success', 'Teacher deleted successfully.');
    }
}
