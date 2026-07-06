<?php
namespace App\Http\Controllers\ViceManager;

use App\Http\Controllers\Controller;
use App\Models\ArticleTag;
use Illuminate\View\View;

class ArticleTagController extends Controller
{
    public function index(): View
    {
        $tags = ArticleTag::withCount('articles')->orderBy('name')->paginate(20);
        return view('vice-manager.article-tags.index', compact('tags'));
    }
}
