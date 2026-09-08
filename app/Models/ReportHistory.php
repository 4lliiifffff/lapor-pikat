<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'status',
        'note',
        'changed_by',
    ];

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Laporan Diterima (Menunggu Verifikasi)',
            'reviewing' => 'Laporan Sedang Ditinjau',
            'investigating' => 'Laporan Sedang Ditindaklanjuti',
            'resolved' => 'Laporan Selesai Ditangani',
            'rejected' => 'Laporan Ditolak',
            default => ucfirst($this->status),
        };
    }
}
