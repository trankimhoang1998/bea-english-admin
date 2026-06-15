<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LearningMaterial;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialDownloadController extends Controller
{
    public function index(Request $request)
    {
        $student = Student::where('user_id', auth()->id())->firstOrFail();

        $query = LearningMaterial::where(function ($q) use ($student) {
            $q->whereDoesntHave('students')
              ->orWhereHas('students', fn($q) => $q->where('students.id', $student->id));
        });

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%");
        }

        if ($type = $request->input('type')) {
            if ($type === 'file') {
                $query->whereNotNull('file_path')->whereNull('material_link');
            } elseif ($type === 'link') {
                $query->whereNotNull('material_link')->whereNull('file_path');
            }
        }

        $materials = $query->latest()->paginate(10)->withQueryString();

        return view('student.materials.index', compact('materials'));
    }

    public function download(LearningMaterial $material)
    {
        $student = Student::where('user_id', auth()->id())->firstOrFail();

        // Abort if material is restricted and student is not in the list
        if ($material->students()->exists() && !$material->students()->where('students.id', $student->id)->exists()) {
            abort(403);
        }

        if ($material->material_link) {
            return redirect($material->material_link);
        }

        if (!$material->file_path) {
            abort(404);
        }

        return Storage::disk('local')->download($material->file_path, $material->title);
    }
}
