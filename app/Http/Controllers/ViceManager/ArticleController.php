<?php
namespace App\Http\Controllers\ViceManager;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
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

        return view('vice-manager.articles.index', compact('articles', 'categories'));
    }

    public function show(Article $article): View
    {
        $article->load('category', 'author', 'tags');
        return view('vice-manager.articles.show', compact('article'));
    }
}
