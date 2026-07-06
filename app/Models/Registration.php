<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model
{
    protected $fillable = ['name', 'phone', 'audience', 'status', 'notes', 'contacted_at', 'contacted_by'];

    protected $casts = [
        'contacted_at' => 'datetime',
    ];

    public function contactedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'contacted_by');
    }

    public function statusBadge(): array
    {
        return match($this->status) {
            'contacted'   => ['label' => 'Đã liên hệ',           'class' => 'bg-green-100 text-green-800'],
            'not_reached' => ['label' => 'Không liên lạc được',   'class' => 'bg-red-100 text-red-800'],
            default       => ['label' => 'Chờ liên hệ',          'class' => 'bg-amber-100 text-amber-800'],
        };
    }

    public function audienceLabel(): string
    {
        return match($this->audience) {
            'hoc-sinh-tieu-hoc' => 'Học sinh tiểu học',
            'hoc-sinh-thcs'     => 'Học sinh THCS',
            'hoc-sinh-thpt'     => 'Học sinh THPT',
            'sinh-vien'         => 'Sinh viên đại học',
            'nguoi-di-lam'      => 'Người đi làm',
            'ielts'             => 'Luyện thi IELTS',
            'khac'              => 'Khác',
            default             => $this->audience ?? '—',
        };
    }
}
