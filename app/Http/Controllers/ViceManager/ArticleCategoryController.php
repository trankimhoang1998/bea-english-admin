<?php
namespace App\Http\Controllers\ViceManager;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use Illuminate\View\View;

class ArticleCategoryController extends Controller
{
    public function index(): View
    {
        $categories = ArticleCategory::with('parent')->withCount('articles')
            ->orderBy('sort_order')->orderBy('name')->get();
        return view('vice-manager.article-categories.index', compact('categories'));
    }
}
