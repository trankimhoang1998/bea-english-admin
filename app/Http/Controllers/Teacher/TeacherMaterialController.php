<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\LearningMaterial;
use App\Models\MaterialCategory;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherMaterialController extends Controller
{
    public function index(Request $request)
    {
        $teacher = Teacher::where('user_id', auth()->id())->firstOrFail();

        $query = LearningMaterial::whereHas('teachers', fn($q) => $q->where('teachers.id', $teacher->id));

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

        return view('teacher.materials.index', compact('materials', 'categories'));
    }

    public function download(LearningMaterial $material)
    {
        $teacher = Teacher::where('user_id', auth()->id())->firstOrFail();

        if (!$material->teachers()->where('teachers.id', $teacher->id)->exists()) {
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
}
