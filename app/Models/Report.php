<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_code',
        'is_anonymous',
        'reporter_name',
        'reporter_class',
        'reporter_phone',
        'incident_type',
        'chronology',
        'incident_date',
        'incident_location',
        'parties_involved',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
        'incident_date' => 'date',
    ];

    public function attachments(): HasMany
    {
        return $this->hasMany(ReportAttachment::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(ReportHistory::class)->orderBy('created_at', 'asc');
    }

    public static function generateUniqueTrackingCode(): string
    {
        do {
            $part1 = strtoupper(Str::random(4));
            $part2 = strtoupper(Str::random(4));
            $code = "ABT-{$part1}-{$part2}";
        } while (static::where('tracking_code', $code)->exists());

        return $code;
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Menunggu Validasi Internal',
            'reviewing' => 'Investigasi Internal',
            'recommendation' => 'Penyusunan Rekomendasi Satgas',
            'awaiting_satgas' => 'Menunggu Respon Satgas',
            'satgas_action', 'investigating' => 'Penanganan Satgas (Pemulihan & Sanksi)',
            'resolved' => 'Selesai Ditangani',
            'rejected' => 'Ditolak (Tidak Valid)',
            default => ucfirst($this->status),
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'bg-amber-50 text-amber-700 border-amber-200 ring-amber-500/20',
            'reviewing' => 'bg-blue-50 text-blue-700 border-blue-200 ring-blue-500/20',
            'recommendation' => 'bg-sky-50 text-sky-700 border-sky-200 ring-sky-500/20',
            'awaiting_satgas' => 'bg-indigo-50 text-indigo-700 border-indigo-200 ring-indigo-500/20',
            'satgas_action', 'investigating' => 'bg-purple-50 text-purple-700 border-purple-200 ring-purple-500/20',
            'resolved' => 'bg-emerald-50 text-emerald-700 border-emerald-200 ring-emerald-500/20',
            'rejected' => 'bg-rose-50 text-rose-700 border-rose-200 ring-rose-500/20',
            default => 'bg-slate-50 text-slate-700 border-slate-200 ring-slate-500/20',
        };
    }

    public function getIncidentTypeLabelAttribute(): string
    {
        return match ($this->incident_type) {
            'fisik' => 'Fisik',
            'verbal' => 'Verbal',
            'sosial' => 'Sosial',
            'online' => 'Online (Cyberbullying)',
            'lainnya' => 'Lainnya',
            default => ucfirst($this->incident_type),
        };
    }
}
