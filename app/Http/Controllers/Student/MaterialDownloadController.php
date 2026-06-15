<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LearningMaterial;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class MaterialDownloadController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', auth()->id())->firstOrFail();

        $materials = LearningMaterial::where(function ($q) use ($student) {
            $q->whereDoesntHave('students')
              ->orWhereHas('students', fn($q) => $q->where('students.id', $student->id));
        })->latest()->paginate(10);

        return view('student.materials.index', compact('materials'));
    }

    public function download(LearningMaterial $material)
    {
        $student = Student::where('user_id', auth()->id())->firstOrFail();

        // Abort if material is restricted and student is not in the list
        if ($material->students()->exists() && !$material->students()->where('students.id', $student->id)->exists()) {
            abort(403);
        }

        return Storage::disk('local')->download($material->file_path, $material->title);
    }
}
