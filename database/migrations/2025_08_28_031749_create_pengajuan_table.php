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
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pengajuan')->unique();
            $table->enum('jenis_pengajuan', ['baru', 'perbaikan', 'amandemen', 'laporan_akhir', 'perpanjangan']);
            $table->string('judul_penelitian');
            $table->text('abstrak');
            $table->string('peneliti_utama');
            $table->string('institusi');
            $table->string('email');
            $table->string('telepon');
            $table->text('anggota_peneliti')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->text('lokasi_penelitian');
            $table->text('metode_penelitian');
            $table->text('populasi_sampel');
            $table->text('kriteria_inklusi')->nullable();
            $table->text('kriteria_eksklusi')->nullable();
            $table->text('risiko_manfaat');
            $table->text('informed_consent');
            $table->json('dokumen_pendukung')->nullable();
            $table->enum('status', ['draft', 'submitted', 'under_review', 'approved', 'rejected', 'revision_required'])->default('draft');
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
        Schema::dropIfExists('pengajuan');
    }
};
