<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    protected $fillable = [
        'title', 'slug', 'thumbnail', 'excerpt', 'content',
        'status', 'article_category_id', 'author_id', 'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(ArticleTag::class, 'article_tag', 'article_id', 'tag_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function statusBadge(): array
    {
        return match($this->status) {
            'published' => ['label' => 'Published', 'class' => 'bg-green-100 text-green-700'],
            'draft'     => ['label' => 'Draft',     'class' => 'bg-gray-100 text-gray-600'],
            'archived'  => ['label' => 'Archived',  'class' => 'bg-red-50 text-red-600'],
            default     => ['label' => $this->status, 'class' => 'bg-gray-100 text-gray-600'],
        };
    }
}
