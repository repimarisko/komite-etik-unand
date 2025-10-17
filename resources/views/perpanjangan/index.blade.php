@extends('layouts.app')

@section('title', 'Form Perpanjangan Penelitian')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
    <!-- Header -->
    <div class="bg-indigo-600 text-white p-4">
        <h1 class="text-xl font-bold">FORM PERPANJANGAN PENELITIAN</h1>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded m-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('perpanjangan.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
        @csrf
        
        <!-- Informasi Surat Persetujuan -->
        <div class="bg-blue-50 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-blue-800 mb-4">Informasi Surat Persetujuan Etik Sebelumnya</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Nomor Surat Persetujuan Etik :</label>
                    <input type="text" name="nomor_surat_persetujuan" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <p class="text-xs text-gray-500">Contoh: 123/UN6.KEP/EC/2024</p>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Tanggal Surat Persetujuan :</label>
                    <input type="date" name="tanggal_surat" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
            </div>
        </div>

        <!-- Informasi Penelitian -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Informasi Penelitian</h3>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Judul Penelitian :</label>
                <textarea name="judul_penelitian" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required></textarea>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Nama Peneliti Utama :</label>
                    <input type="text" name="nama_peneliti_utama" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Institusi/Universitas :</label>
                    <input type="text" name="institusi" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
            </div>
        </div>

        <!-- Jadwal Penelitian -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Jadwal Penelitian</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Tanggal Mulai (Awal) :</label>
                    <input type="date" name="tanggal_mulai_awal" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Tanggal Selesai (Rencana Awal) :</label>
                    <input type="date" name="tanggal_selesai_awal" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Tanggal Selesai (Baru) :</label>
                    <input type="date" name="tanggal_selesai_baru" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
            </div>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Durasi Perpanjangan (dalam bulan) :</label>
                <input type="number" name="durasi_perpanjangan" min="1" max="24" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                <p class="text-xs text-gray-500">Maksimal 24 bulan</p>
            </div>
        </div>

        <!-- Alasan Perpanjangan -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Alasan Perpanjangan</h3>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Alasan Utama Perpanjangan :</label>
                <textarea name="alasan_perpanjangan" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Jelaskan alasan mengapa penelitian perlu diperpanjang..." required></textarea>
            </div>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Justifikasi Ilmiah Perpanjangan :</label>
                <textarea name="justifikasi_perpanjangan" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Berikan justifikasi ilmiah mengapa perpanjangan diperlukan..." required></textarea>
            </div>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Dampak Perpanjangan terhadap Subjek (Opsional) :</label>
                <textarea name="dampak_perpanjangan" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Jelaskan dampak perpanjangan terhadap subjek penelitian..."></textarea>
            </div>
        </div>

        <!-- Perubahan Metodologi -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Perubahan Metodologi (Jika Ada)</h3>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Perubahan dalam Metodologi Penelitian (Opsional) :</label>
                <textarea name="perubahan_metodologi" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Jelaskan jika ada perubahan dalam metodologi penelitian..."></textarea>
                <p class="text-xs text-gray-500">Kosongkan jika tidak ada perubahan metodologi</p>
            </div>
        </div>

        <!-- Status Subjek -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Status Subjek Penelitian</h3>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Status Rekrutmen Subjek :</label>
                <select name="status_rekrutmen" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <option value="">--Pilih Status Rekrutmen--</option>
                    <option value="masih_berlangsung">Masih Berlangsung</option>
                    <option value="selesai">Selesai</option>
                    <option value="terhenti_sementara">Terhenti Sementara</option>
                    <option value="mengalami_kendala">Mengalami Kendala</option>
                </select>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Jumlah Subjek Saat Ini :</label>
                    <input type="number" name="jumlah_subjek_saat_ini" min="0" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Rencana Tambahan Subjek (Opsional) :</label>
                    <input type="number" name="rencana_tambahan_subjek" min="0" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>
        </div>

        <!-- Upload Dokumen -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Dokumen Pendukung</h3>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Upload Dokumen Perpanjangan (Opsional) :</label>
                <input type="file" name="dokumen_perpanjangan" accept=".pdf,.doc,.docx" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <p class="text-xs text-gray-500">Format yang diizinkan: PDF, DOC, DOCX. Maksimal 5MB.</p>
            </div>
        </div>

        <!-- Catatan Penting -->
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800">Informasi Penting</h3>
                    <div class="mt-2 text-sm text-yellow-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Permohonan perpanjangan harus diajukan minimal 30 hari sebelum berakhirnya periode penelitian</li>
                            <li>Perpanjangan maksimal 24 bulan dari jadwal awal</li>
                            <li>Jika ada perubahan metodologi, lampirkan dokumen revisi protokol</li>
                            <li>Perpanjangan akan dievaluasi berdasarkan justifikasi ilmiah dan etik</li>
                            <li>Penelitian tidak boleh dilanjutkan tanpa persetujuan perpanjangan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end space-x-4 pt-6 border-t">
            <button type="button" class="px-6 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition duration-200">
                Batal
            </button>
            <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition duration-200">
                Reset
            </button>
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition duration-200">
                Ajukan Perpanjangan
            </button>
        </div>
    </form>
</div>
@endsection