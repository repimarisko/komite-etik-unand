@extends('layouts.app')

@section('title', 'Form Pengajuan Perbaikan')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
    <!-- Header -->
    <div class="bg-green-600 text-white p-4">
        <h1 class="text-xl font-bold">FORM PENGAJUAN PERBAIKAN</h1>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded m-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('perbaikan.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
        @csrf
        
        <!-- Informasi Surat Persetujuan -->
        <div class="bg-blue-50 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-blue-800 mb-4">Informasi Surat Persetujuan Etik Sebelumnya</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Nomor Surat Persetujuan Etik :</label>
                    <input type="text" name="nomor_surat_persetujuan" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    <p class="text-xs text-gray-500">Contoh: 123/UN6.KEP/EC/2024</p>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Tanggal Surat Persetujuan :</label>
                    <input type="date" name="tanggal_surat" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>
            </div>
        </div>

        <!-- Judul Penelitian -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Informasi Penelitian</h3>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Judul Penelitian Asli (sesuai surat persetujuan) :</label>
                <textarea name="judul_penelitian_asli" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required></textarea>
            </div>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Judul Penelitian Setelah Perbaikan :</label>
                <textarea name="judul_penelitian_perbaikan" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required></textarea>
            </div>
        </div>

        <!-- Informasi Peneliti -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Informasi Peneliti</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Nama Peneliti Utama :</label>
                    <input type="text" name="nama_peneliti_utama" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Institusi/Universitas :</label>
                    <input type="text" name="institusi" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>
            </div>
        </div>

        <!-- Detail Perbaikan -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Detail Perbaikan</h3>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Alasan Perbaikan :</label>
                <textarea name="alasan_perbaikan" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Jelaskan alasan mengapa perlu dilakukan perbaikan pada penelitian ini..." required></textarea>
            </div>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Bagian yang Diperbaiki :</label>
                <textarea name="bagian_yang_diperbaiki" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Sebutkan secara detail bagian mana saja yang diperbaiki (metodologi, sampel, instrumen, dll)..." required></textarea>
            </div>
        </div>

        <!-- Upload Dokumen -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Dokumen Pendukung</h3>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Upload Dokumen Pendukung (Opsional) :</label>
                <input type="file" name="dokumen_pendukung" accept=".pdf,.doc,.docx" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                <p class="text-xs text-gray-500">Format yang diizinkan: PDF, DOC, DOCX. Maksimal 2MB.</p>
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
                    <h3 class="text-sm font-medium text-yellow-800">Catatan Penting</h3>
                    <div class="mt-2 text-sm text-yellow-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Pastikan semua informasi yang diisi sesuai dengan surat persetujuan etik sebelumnya</li>
                            <li>Perbaikan hanya dapat dilakukan untuk penelitian yang sudah mendapat persetujuan etik</li>
                            <li>Proses review perbaikan membutuhkan waktu 7-14 hari kerja</li>
                            <li>Jika ada perubahan signifikan, mungkin diperlukan pengajuan baru</li>
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
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition duration-200">
                Kirim Pengajuan Perbaikan
            </button>
        </div>
    </form>
</div>
@endsection