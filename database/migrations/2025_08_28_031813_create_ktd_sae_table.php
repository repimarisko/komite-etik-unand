<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ktd_sae', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_laporan')->unique();
            $table->foreignId('pengajuan_id')->constrained('pengajuan')->onDelete('cascade');
            $table->enum('jenis_kejadian', ['ktd', 'sae', 'uade']);
            $table->string('judul_penelitian');
            $table->string('peneliti_utama');
            $table->date('tanggal_kejadian');
            $table->time('waktu_kejadian')->nullable();
            $table->text('deskripsi_kejadian');
            $table->text('lokasi_kejadian');
            $table->string('subjek_terlibat');
            $table->text('kondisi_subjek_sebelum');
            $table->text('kondisi_subjek_sesudah');
            $table->enum('tingkat_keparahan', ['ringan', 'sedang', 'berat', 'mengancam_jiwa', 'fatal']);
            $table->text('tindakan_yang_diambil');
            $table->text('hasil_tindakan');
            $table->enum('hubungan_dengan_penelitian', ['pasti', 'mungkin', 'kemungkinan_kecil', 'tidak_berhubungan']);
            $table->text('analisis_penyebab');
            $table->text('tindakan_pencegahan');
            $table->json('dokumen_pendukung')->nullable();
            $table->enum('status', ['draft', 'submitted', 'under_review', 'approved', 'follow_up_required'])->default('draft');
            $table->text('catatan_reviewer')->nullable();
            $table->timestamp('tanggal_submit')->nullable();
            $table->timestamp('tanggal_review')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ktd_sae');
    }
};
