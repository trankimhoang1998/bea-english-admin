<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArticleCategory extends Model
{
    protected $fillable = ['name', 'slug', 'parent_id', 'sort_order'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(ArticleCategory::class, 'parent_id')
            ->orderBy('sort_order')
            ->orderBy('name');
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'article_category_id');
    }

    public static function flattenTree($categories, ?int $parentId = null, int $depth = 0): array
    {
        $result = [];
        foreach ($categories->where('parent_id', $parentId) as $cat) {
            $result[] = ['item' => $cat, 'depth' => $depth];
            $result   = array_merge($result, static::flattenTree($categories, $cat->id, $depth + 1));
        }
        return $result;
    }
}
