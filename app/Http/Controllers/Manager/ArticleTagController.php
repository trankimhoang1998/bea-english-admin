<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\ArticleTag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArticleTagController extends Controller
{
    public function index(): View
    {
        $tags = ArticleTag::withCount('articles')->orderBy('name')->paginate(20);
        return view('manager.article-tags.index', compact('tags'));
    }

    public function create(): View
    {
        return view('manager.article-tags.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80', 'unique:article_tags,name'],
        ]);
        $data['slug'] = $this->uniqueSlug($data['name']);
        ArticleTag::create($data);
        return redirect()->route('manager.articles.tags.index')
            ->with('success', 'Tag created successfully.');
    }

    public function edit(ArticleTag $articleTag): View
    {
        return view('manager.article-tags.edit', ['tag' => $articleTag]);
    }

    public function update(Request $request, ArticleTag $articleTag): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80', 'unique:article_tags,name,' . $articleTag->id],
        ]);
        $data['slug'] = $this->uniqueSlug($data['name'], $articleTag->id);
        $articleTag->update($data);
        return redirect()->route('manager.articles.tags.index')
            ->with('success', 'Tag updated successfully.');
    }

    public function destroy(ArticleTag $articleTag): RedirectResponse
    {
        $articleTag->delete();
        return redirect()->route('manager.articles.tags.index')
            ->with('success', 'Tag deleted successfully.');
    }

    private function uniqueSlug(string $name, ?int $excludeId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i    = 1;
        while (
            ArticleTag::where('slug', $slug)
                ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
                ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }
        return $slug;
    }
}
