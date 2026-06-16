<?php

namespace App\Http\Controllers\ViceManager;

use App\Http\Controllers\Controller;
use App\Models\LearningMaterial;
use App\Models\MaterialCategory;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LearningMaterialController extends Controller
{
    public function index(Request $request): View
    {
        $query = LearningMaterial::with('uploader', 'students.user', 'teachers.user', 'category');

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

        if ($studentId = $request->input('student_id')) {
            $query->whereHas('students', fn($q) => $q->where('students.id', $studentId));
        }

        if ($categoryId = $request->input('category_id')) {
            $query->where('material_category_id', $categoryId);
        }

        if ($teacherId = $request->input('teacher_id')) {
            $query->whereHas('teachers', fn($q) => $q->where('teachers.id', $teacherId));
        }

        $materials  = $query->latest()->paginate(10)->withQueryString();
        $students   = Student::with('user')->orderBy('id')->get();
        $teachers   = Teacher::with('user')->orderBy('id')->get();
        $categories = $this->flatCategoryOptions();

        return view('vice-manager.materials.index', compact('materials', 'students', 'teachers', 'categories'));
    }

    public function download(LearningMaterial $material)
    {
        if ($material->material_link) {
            return redirect($material->material_link);
        }

        if (!$material->file_path) {
            abort(404);
        }

        return Storage::disk('local')->download($material->file_path, $material->title);
    }

    private function flatCategoryOptions(): array
    {
        $all  = MaterialCategory::orderBy('sort_order')->orderBy('name')->get();
        $flat = $this->flattenCategoryTree($all);

        return array_map(fn($row) => [
            'id'    => $row['item']->id,
            'label' => str_repeat('└─ ', $row['depth']) . $row['item']->name,
        ], $flat);
    }

    private function flattenCategoryTree($categories, ?int $parentId = null, int $depth = 0): array
    {
        $result = [];
        foreach ($categories->where('parent_id', $parentId) as $cat) {
            $result[] = ['item' => $cat, 'depth' => $depth];
            $result   = array_merge($result, $this->flattenCategoryTree($categories, $cat->id, $depth + 1));
        }
        return $result;
    }
}
