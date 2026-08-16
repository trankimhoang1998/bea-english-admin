<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleTag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(Request $request): View
    {
        $query = Article::with('category', 'author', 'tags')->latest();

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%");
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($categoryId = $request->input('category_id')) {
            $query->where('article_category_id', $categoryId);
        }

        $articles   = $query->paginate(10)->withQueryString();
        $all        = ArticleCategory::orderBy('sort_order')->orderBy('name')->get();
        $categories = ArticleCategory::flattenTree($all);

        return view('manager.articles.index', compact('articles', 'categories'));
    }

    public function create(): View
    {
        $categories = ArticleCategory::flattenTree(ArticleCategory::orderBy('sort_order')->orderBy('name')->get());
        $tags       = ArticleTag::orderBy('name')->get();

        return view('manager.articles.create', compact('categories', 'tags'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title'               => ['required', 'string', 'max:255'],
            'excerpt'             => ['nullable', 'string', 'max:500'],
            'content'             => ['required', 'string'],
            'status'              => ['required', 'in:draft,published,archived'],
            'article_category_id' => ['nullable', 'exists:article_categories,id'],
            'tag_ids'             => ['nullable', 'array'],
            'tag_ids.*'           => ['exists:article_tags,id'],
            'thumbnail'           => ['nullable', 'image', 'max:2048'],
        ]);

        $slug = Str::slug($data['title']);
        $slug = $this->uniqueSlug($slug);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('article-thumbnails', 'public');
        }

        $article = Article::create([
            'title'               => $data['title'],
            'slug'                => $slug,
            'excerpt'             => $data['excerpt'] ?? null,
            'content'             => $data['content'],
            'status'              => $data['status'],
            'article_category_id' => $data['article_category_id'] ?? null,
            'author_id'           => auth()->id(),
            'thumbnail'           => $thumbnailPath,
            'published_at'        => $data['status'] === 'published' ? now() : null,
        ]);

        $article->tags()->sync($data['tag_ids'] ?? []);

        return redirect()->route('manager.articles.index')
            ->with('success', 'Article saved successfully.');
    }

    public function show(Article $article): View
    {
        $article->load('category', 'author', 'tags');
        return view('manager.articles.show', compact('article'));
    }

    public function edit(Article $article): View
    {
        $categories     = ArticleCategory::flattenTree(ArticleCategory::orderBy('sort_order')->orderBy('name')->get());
        $tags           = ArticleTag::orderBy('name')->get();
        $assignedTagIds = $article->tags->pluck('id')->toArray();

        return view('manager.articles.edit', compact('article', 'categories', 'tags', 'assignedTagIds'));
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $data = $request->validate([
            'title'               => ['required', 'string', 'max:255'],
            'excerpt'             => ['nullable', 'string', 'max:500'],
            'content'             => ['required', 'string'],
            'status'              => ['required', 'in:draft,published,archived'],
            'article_category_id' => ['nullable', 'exists:article_categories,id'],
            'tag_ids'             => ['nullable', 'array'],
            'tag_ids.*'           => ['exists:article_tags,id'],
            'thumbnail'           => ['nullable', 'image', 'max:2048'],
            'remove_thumbnail'    => ['nullable', 'boolean'],
        ]);

        $updateData = [
            'title'               => $data['title'],
            'excerpt'             => $data['excerpt'] ?? null,
            'content'             => $data['content'],
            'status'              => $data['status'],
            'article_category_id' => $data['article_category_id'] ?? null,
        ];

        if ($request->boolean('remove_thumbnail')) {
            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }
            $updateData['thumbnail'] = null;
        } elseif ($request->hasFile('thumbnail')) {
            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }
            $updateData['thumbnail'] = $request->file('thumbnail')->store('article-thumbnails', 'public');
        }

        if ($data['status'] === 'published' && !$article->published_at) {
            $updateData['published_at'] = now();
        }

        $article->update($updateData);
        $article->tags()->sync($data['tag_ids'] ?? []);

        return redirect()->route('manager.articles.index')
            ->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }
        $article->delete();

        return redirect()->route('manager.articles.index')
            ->with('success', 'Article deleted successfully.');
    }

    public function uploadImage(Request $request): JsonResponse
    {
        $request->validate(['upload' => ['required', 'image', 'max:5120']]);
        $path = $request->file('upload')->store('articles/images', 'public');
        return response()->json(['url' => $request->getSchemeAndHttpHost() . '/storage/' . $path]);
    }

    private function uniqueSlug(string $base): string
    {
        $slug = $base;
        $i    = 1;
        while (Article::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }
        return $slug;
    }
}
