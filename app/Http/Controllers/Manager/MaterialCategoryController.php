<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\MaterialCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

        return view('manager.materials.categories.index', compact('tree'));
    }

    public function create(): View
    {
        $parentOptions = $this->buildSelectOptions();

        return view('manager.materials.categories.create', compact('parentOptions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:100'],
            'parent_id'   => ['nullable', 'exists:material_categories,id'],
            'description' => ['nullable', 'string', 'max:500'],
            'sort_order'  => ['nullable', 'integer', 'min:0', 'max:999'],
        ]);

        $data['slug']       = $this->uniqueSlug($data['name']);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        MaterialCategory::create($data);

        return redirect()->route('manager.materials.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(MaterialCategory $category): View
    {
        $parentOptions = $this->buildSelectOptions(
            exclude: [$category->id, ...$category->allDescendantIds()]
        );

        return view('manager.materials.categories.edit', compact('category', 'parentOptions'));
    }

    public function update(Request $request, MaterialCategory $category): RedirectResponse
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:100'],
            'parent_id'   => ['nullable', 'exists:material_categories,id'],
            'description' => ['nullable', 'string', 'max:500'],
            'sort_order'  => ['nullable', 'integer', 'min:0', 'max:999'],
        ]);

        if ($data['parent_id'] == $category->id) {
            return back()->withInput()->withErrors(['parent_id' => 'A category cannot be its own parent.']);
        }

        if ($category->name !== $data['name']) {
            $data['slug'] = $this->uniqueSlug($data['name'], $category->id);
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;

        $category->update($data);

        return redirect()->route('manager.materials.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(MaterialCategory $category): RedirectResponse
    {
        if ($category->children()->exists()) {
            return back()->withErrors(['delete' => 'Cannot delete a category that has sub-categories. Remove sub-categories first.']);
        }

        if ($category->materials()->exists()) {
            return back()->withErrors(['delete' => 'Cannot delete a category that has materials assigned to it.']);
        }

        $category->delete();

        return redirect()->route('manager.materials.categories.index')
            ->with('success', 'Category deleted.');
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

    private function buildSelectOptions(array $exclude = []): array
    {
        $all = MaterialCategory::orderBy('sort_order')->orderBy('name')->get();
        $flat = $this->flattenTree($all->whereNotIn('id', $exclude));

        return array_map(fn($row) => [
            'id'    => $row['item']->id,
            'label' => str_repeat('└─ ', $row['depth']) . $row['item']->name,
        ], $flat);
    }

    private function uniqueSlug(string $name, ?int $excludeId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i    = 1;

        while (
            MaterialCategory::where('slug', $slug)
                ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
                ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}
