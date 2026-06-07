<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LearningMaterial;
use Illuminate\Support\Facades\Storage;

class MaterialDownloadController extends Controller
{
    public function index()
    {
        $materials = LearningMaterial::latest()->paginate(10);

        return view('student.materials.index', compact('materials'));
    }

    public function download(LearningMaterial $material)
    {
        return Storage::disk('local')->download($material->file_path, $material->title);
    }
}
