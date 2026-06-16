<?php

namespace App\Http\Controllers\ViceManager;

use App\Http\Controllers\Controller;
use App\Models\MaterialCategory;
use Illuminate\View\View;

class MaterialCategoryController extends Controller
{
    public function index(): View
    {
        $all  = MaterialCategory::withCount('materials')
            ->with('parent')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $tree = $this->flattenTree($all);

        return view('vice-manager.materials.categories.index', compact('tree'));
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
