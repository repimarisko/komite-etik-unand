<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';
    
    protected $fillable = [
        'nomor_pengajuan',
        'jenis_pengajuan',
        'judul_penelitian',
        'abstrak',
        'peneliti_utama',
        'institusi',
        'email',
        'telepon',
        'anggota_peneliti',
        'pembimbing_data',
        'nama_pembimbing',
        'tanggal_mulai',
        'tanggal_selesai',
        'lokasi_penelitian',
        'metode_penelitian',
        'populasi_sampel',
        'kriteria_inklusi',
        'kriteria_eksklusi',
        'risiko_manfaat',
        'informed_consent',
        'dokumen_pendukung',
        'status',
        'catatan_reviewer',
        'tanggal_submit',
        'tanggal_review',
        'user_id'
    ];
    
    protected $casts = [
        'dokumen_pendukung' => 'array',
        'pembimbing_data' => 'array',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'tanggal_submit' => 'datetime',
        'tanggal_review' => 'datetime'
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function ktdSae(): HasMany
    {
        return $this->hasMany(KtdSae::class);
    }
}
