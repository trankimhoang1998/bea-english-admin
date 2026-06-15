<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeachingHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'student_id',
        'lesson_number',
        'taught_date',
        'time_from',
        'time_to',
        'duration',
        'video_path',
        'video_link',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'taught_date' => 'date',
        ];
    }

    protected function timeFrom(): Attribute
    {
        return Attribute::make(get: fn(string $v) => substr($v, 0, 5));
    }

    protected function timeTo(): Attribute
    {
        return Attribute::make(get: fn(string $v) => substr($v, 0, 5));
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
