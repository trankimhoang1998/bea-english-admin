<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaterialCategory extends Model
{
    protected $fillable = ['name', 'slug', 'parent_id', 'description', 'sort_order'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MaterialCategory::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(MaterialCategory::class, 'parent_id')
            ->orderBy('sort_order')
            ->orderBy('name');
    }

    public function materials(): HasMany
    {
        return $this->hasMany(LearningMaterial::class, 'material_category_id');
    }

    public function allDescendantIds(): array
    {
        $ids = [];
        foreach ($this->children()->with('children')->get() as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $child->allDescendantIds());
        }
        return $ids;
    }
}
