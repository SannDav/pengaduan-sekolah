<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AspirasiAuditLog extends Model
{
    protected $table = 'aspirasi_audit_logs';

    protected $fillable = [
        'aspirasi_id',
        'nis_siswa',
        'admin_nama',
        'action',
        'old_status',
        'new_status',
        'feedback',
        'notes',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Relasi ke Aspirasi
    public function aspirasi()
    {
        return $this->belongsTo(Aspirasi::class, 'aspirasi_id', 'id_pelaporan');
    }

    // Label action yang lebih ramah dibaca
    public function getActionLabelAttribute(): string
    {
        return match($this->action) {
            'feedback_given'   => 'Feedback Diberikan',
            'status_changed'   => 'Status Diubah',
            'bulk_status'      => 'Status Diubah (Massal)',
            'created'          => 'Laporan Dibuat',
            default            => ucfirst(str_replace('_', ' ', $this->action)),
        };
    }

    // Icon untuk setiap action (Bootstrap Icons)
    public function getActionIconAttribute(): string
    {
        return match($this->action) {
            'feedback_given'   => 'bi-chat-left-text-fill',
            'status_changed'   => 'bi-arrow-left-right',
            'bulk_status'      => 'bi-collection-fill',
            'created'          => 'bi-plus-circle-fill',
            default            => 'bi-activity',
        };
    }

    // Warna badge untuk status
    public function getStatusColorAttribute(): string
    {
        return match($this->new_status) {
            'Selesai'  => 'emerald',
            'Proses'   => 'amber',
            'Menunggu' => 'rose',
            default    => 'indigo',
        };
    }

    // Scope untuk filter berdasarkan siswa
    public function scopeForSiswa($query, $nis)
    {
        return $query->where('nis_siswa', $nis);
    }

    // Scope untuk filter berdasarkan laporan
    public function scopeForAspirasi($query, $aspirasiId)
    {
        return $query->where('aspirasi_id', $aspirasiId);
    }
}