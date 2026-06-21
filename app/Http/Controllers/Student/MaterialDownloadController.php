<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LearningMaterial;
use App\Models\MaterialCategory;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialDownloadController extends Controller
{
    public function index(Request $request)
    {
        $student = Student::where('user_id', auth()->id())->firstOrFail();

        $query = LearningMaterial::whereHas('students', fn($q) => $q->where('students.id', $student->id));

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

        if ($categoryId = $request->input('category_id')) {
            $query->where('material_category_id', $categoryId);
        }

        $materials  = $query->with('category')->latest()->paginate(10)->withQueryString();
        $categories = $this->flatCategoryOptions();

        return view('student.materials.index', compact('materials', 'categories'));
    }

    private function flatCategoryOptions(): array
    {
        $all  = MaterialCategory::orderBy('sort_order')->orderBy('name')->get();
        $flat = $this->flattenTree($all);

        return array_map(fn($row) => [
            'id'    => $row['item']->id,
            'label' => str_repeat('└─ ', $row['depth']) . $row['item']->name,
        ], $flat);
    }

    private function flattenTree($categories, ?int $parentId = null, int $depth = 0): array
    {
        $result = [];
        foreach ($categories->where('parent_id', $parentId) as $cat) {
            $result[] = ['item' => $cat, 'depth' => $depth];
            $result   = array_merge($result, $this->flattenTree($categories, $cat->id, $depth + 1));
        }
        return $result;
    }

    public function download(LearningMaterial $material)
    {
        $student = Student::where('user_id', auth()->id())->firstOrFail();

        if (!$material->students()->where('students.id', $student->id)->exists()) {
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
