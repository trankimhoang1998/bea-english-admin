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
            'username'   => ['required', 'string', 'max:50', 'unique:users,username'],
            'password'   => ['required', 'string', 'min:8'],
            'student_id' => ['required', 'string', 'max:50', 'unique:students,student_id'],
            'age'        => ['required', 'integer', 'min:5', 'max:99'],
            'course'     => ['required', 'string', 'max:100'],
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'username' => $data['username'],
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

    public function show(Student $student, Request $request): View
    {
        $student->load('user', 'schedules.teacher.user');

        $historyTeacherIds = $student->teachingHistories()->distinct()->pluck('teacher_id');

        $historyTeachers = \App\Models\Teacher::with('user')
            ->whereIn('id', $historyTeacherIds)
            ->get()
            ->map(fn($t) => ['id' => $t->id, 'name' => $t->user->name])
            ->sortBy('name')
            ->values();

        $totalHistories = $student->teachingHistories()->count();

        $query = $student->teachingHistories()->with('teacher.user')->orderByDesc('taught_date')->orderByDesc('time_from');
        if ($request->filled('teacher_id')) $query->where('teacher_id', $request->teacher_id);
        if ($request->filled('date_from'))  $query->whereDate('taught_date', '>=', $request->date_from);
        if ($request->filled('date_to'))    $query->whereDate('taught_date', '<=', $request->date_to);
        if ($request->filled('duration'))   $query->where('duration', $request->duration);
        if ($request->filled('time_from'))  $query->where('time_from', '>=', $request->time_from);
        if ($request->filled('time_to'))    $query->where('time_to', '<=', $request->time_to);

        $histories = $query->paginate(20)->withQueryString();

        return view('manager.students.show', compact('student', 'histories', 'historyTeachers', 'historyTeacherIds', 'totalHistories'));
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
            'username'   => ['required', 'string', 'max:50', Rule::unique('users', 'username')->ignore($student->user_id)],
            'password'   => ['nullable', 'string', 'min:8'],
            'student_id' => ['required', 'string', 'max:50', Rule::unique('students', 'student_id')->ignore($student->id)],
            'age'        => ['required', 'integer', 'min:5', 'max:99'],
            'course'     => ['required', 'string', 'max:100'],
        ]);

        $userUpdate = ['name' => $data['name'], 'username' => $data['username']];
        if (!empty($data['password'])) {
            $userUpdate['password'] = Hash::make($data['password']);
        }
        $student->user->update($userUpdate);

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
        $student->learningMaterials()->detach();
        $student->delete();
        $user->delete();

        return redirect()->route('manager.students.index')
            ->with('success', 'Student deleted successfully.');
    }
}
