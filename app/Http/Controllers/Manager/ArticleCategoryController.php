<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArticleCategoryController extends Controller
{
    public function index(): View
    {
        $all  = ArticleCategory::withCount('articles')
            ->with('parent')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $tree = ArticleCategory::flattenTree($all);

        return view('manager.article-categories.index', compact('tree'));
    }

    public function create(): View
    {
        $all     = ArticleCategory::orderBy('sort_order')->orderBy('name')->get();
        $parents = ArticleCategory::flattenTree($all);
        return view('manager.article-categories.create', compact('parents'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'       => ['required', 'string', 'max:100'],
            'parent_id'  => ['nullable', 'exists:article_categories,id'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['slug'] = $this->uniqueSlug($data['name']);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        ArticleCategory::create($data);

        return redirect()->route('manager.articles.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(ArticleCategory $articleCategory): View
    {
        $all     = ArticleCategory::where('id', '!=', $articleCategory->id)
            ->orderBy('sort_order')->orderBy('name')->get();
        $parents = ArticleCategory::flattenTree($all);
        return view('manager.article-categories.edit', compact('articleCategory', 'parents'));
    }

    public function update(Request $request, ArticleCategory $articleCategory): RedirectResponse
    {
        $data = $request->validate([
            'name'       => ['required', 'string', 'max:100'],
            'parent_id'  => ['nullable', 'exists:article_categories,id'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if (!empty($data['parent_id'])) {
            $descendantIds = $this->collectDescendantIds($articleCategory);
            if ($data['parent_id'] == $articleCategory->id || in_array($data['parent_id'], $descendantIds)) {
                return back()->withInput()->withErrors(['parent_id' => 'Cannot set this category or one of its descendants as parent.']);
            }
        }

        if ($articleCategory->name !== $data['name']) {
            $data['slug'] = $this->uniqueSlug($data['name'], $articleCategory->id);
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;

        $articleCategory->update($data);

        return redirect()->route('manager.articles.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(ArticleCategory $articleCategory): RedirectResponse
    {
        if ($articleCategory->children()->exists()) {
            return back()->with('error', 'Cannot delete a category that has sub-categories. Remove sub-categories first.');
        }

        if ($articleCategory->articles()->exists()) {
            return back()->with('error', 'Cannot delete a category that has articles assigned to it.');
        }

        $articleCategory->delete();

        return redirect()->route('manager.articles.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    private function collectDescendantIds(ArticleCategory $category): array
    {
        $ids = [];
        foreach ($category->children as $child) {
            $ids[] = $child->id;
            $ids   = array_merge($ids, $this->collectDescendantIds($child));
        }
        return $ids;
    }

    private function uniqueSlug(string $name, ?int $excludeId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i    = 1;

        while (
            ArticleCategory::where('slug', $slug)
                ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
                ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}
