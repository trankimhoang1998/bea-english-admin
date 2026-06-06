<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeachingHistory extends Model
{
    protected $fillable = [
        'teacher_id',
        'student_id',
        'lesson',
        'taught_at',
        'duration',
        'video_path',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'taught_at' => 'datetime',
        ];
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
