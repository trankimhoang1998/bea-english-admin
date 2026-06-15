<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LearningMaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'uploaded_by',
    ];

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class);
    }
}
