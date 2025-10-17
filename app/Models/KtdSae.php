<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KtdSae extends Model
{
    protected $table = 'ktd_sae';
    
    protected $fillable = [
        'nomor_laporan',
        'pengajuan_id',
        'jenis_kejadian',
        'judul_penelitian',
        'peneliti_utama',
        'tanggal_kejadian',
        'waktu_kejadian',
        'deskripsi_kejadian',
        'lokasi_kejadian',
        'subjek_terlibat',
        'kondisi_subjek_sebelum',
        'kondisi_subjek_sesudah',
        'tingkat_keparahan',
        'tindakan_yang_diambil',
        'hasil_tindakan',
        'hubungan_dengan_penelitian',
        'analisis_penyebab',
        'tindakan_pencegahan',
        'dokumen_pendukung',
        'status',
        'catatan_reviewer',
        'tanggal_submit',
        'tanggal_review',
        'user_id'
    ];
    
    protected $casts = [
        'dokumen_pendukung' => 'array',
        'tanggal_kejadian' => 'date',
        'waktu_kejadian' => 'datetime:H:i',
        'tanggal_submit' => 'datetime',
        'tanggal_review' => 'datetime'
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function pengajuan(): BelongsTo
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
