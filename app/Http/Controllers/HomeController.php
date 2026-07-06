<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home.index');
    }

    public function gioiThieu(): View
    {
        return view('home.gioi-thieu');
    }

    public function phuongPhap(): View
    {
        return view('home.phuong-phap');
    }

    public function khoaHoc(): View
    {
        return view('home.khoa-hoc');
    }

    public function nguoiLon(): View
    {
        return view('home.nguoi-lon');
    }

    public function luyenThiIelts(): View
    {
        return view('home.luyen-thi-ielts');
    }

    public function tinTuc(Request $request): View
    {
        $query = Article::with('category', 'author', 'tags')
            ->published()
            ->latest('published_at');

        if ($categoryId = $request->input('category_id')) {
            $query->where('article_category_id', $categoryId);
        }

        $articles   = $query->paginate(9)->withQueryString();
        $categories = ArticleCategory::withCount(['articles' => fn($q) => $q->published()])
            ->having('articles_count', '>', 0)
            ->orderBy('sort_order')
            ->get();

        return view('home.tin-tuc', compact('articles', 'categories'));
    }

    public function articleDetail(string $slug): View
    {
        $article = Article::with('category', 'author', 'tags')
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        $wordCount   = preg_match_all('/\S+/u', strip_tags($article->content));
        $readingTime = max(1, (int) ceil($wordCount / 200));

        $related = Article::with('category')
            ->published()
            ->where('id', '!=', $article->id)
            ->when($article->article_category_id, fn($q) =>
                $q->where('article_category_id', $article->article_category_id))
            ->latest('published_at')
            ->limit(3)
            ->get();

        if ($related->count() < 3) {
            $excludeIds = $related->pluck('id')->push($article->id)->toArray();
            $fill = Article::with('category')
                ->published()
                ->whereNotIn('id', $excludeIds)
                ->latest('published_at')
                ->limit(3 - $related->count())
                ->get();
            $related = $related->merge($fill);
        }

        return view('home.article-detail', compact('article', 'readingTime', 'related'));
    }

    public function sitemap(): Response
    {
        $pages = [
            ['url' => route('home'),             'priority' => '1.0', 'changefreq' => 'weekly'],
            ['url' => route('home.gioi-thieu'),  'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('home.phuong-phap'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('home.khoa-hoc'),    'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('home.nguoi-lon'),   'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('home.ielts'),        'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('home.tin-tuc'),     'priority' => '0.7', 'changefreq' => 'daily'],
        ];

        Article::published()->latest('published_at')->get()->each(function ($a) use (&$pages) {
            $pages[] = [
                'url'        => route('home.article-detail', $a->slug),
                'priority'   => '0.6',
                'changefreq' => 'monthly',
                'lastmod'    => $a->updated_at->toAtomString(),
            ];
        });

        $content = view('home.sitemap', compact('pages'))->render();

        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }
}
