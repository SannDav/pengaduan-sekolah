<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingSiswa extends Model
{
    protected $table = 'pending_siswas';

    protected $fillable = [
        'nis', 'nama', 'kelas', 'password', 'status', 'reject_reason'
    ];

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}