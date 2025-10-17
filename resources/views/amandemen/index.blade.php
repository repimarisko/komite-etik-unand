@extends('layouts.app')

@section('title', 'Form Pengajuan Amandemen')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
    <!-- Header -->
    <div class="bg-purple-600 text-white p-4">
        <h1 class="text-xl font-bold">FORM PENGAJUAN AMANDEMEN</h1>
    </div>

    <!-- Success and Error messages are now handled by SweetAlert in the main layout -->

    <!-- Form -->
    <form action="{{ route('amandemen.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
        @csrf
        
        <!-- Informasi Surat Persetujuan -->
        <div class="bg-blue-50 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-blue-800 mb-4">Informasi Surat Persetujuan Etik Sebelumnya</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Nomor Surat Persetujuan Etik :</label>
                    <input type="text" name="nomor_surat_persetujuan" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    <p class="text-xs text-gray-500">Contoh: 123/UN6.KEP/EC/2024</p>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Tanggal Surat Persetujuan :</label>
                    <input type="date" name="tanggal_surat" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                </div>
            </div>
        </div>

        <!-- Judul Penelitian -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Informasi Penelitian</h3>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Judul Penelitian Asli (sesuai surat persetujuan) :</label>
                <textarea name="judul_penelitian_asli" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required></textarea>
            </div>
        </div>

        <!-- Informasi Peneliti -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Informasi Peneliti</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Nama Peneliti Utama :</label>
                    <input type="text" name="nama_peneliti_utama" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Institusi/Universitas :</label>
                    <input type="text" name="institusi" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                </div>
            </div>
        </div>

        <!-- Detail Amandemen -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Detail Amandemen</h3>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Jenis Amandemen :</label>
                <select name="jenis_amandemen" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    <option value="">--Pilih Jenis Amandemen--</option>
                    <option value="metodologi">Perubahan Metodologi</option>
                    <option value="sampel">Perubahan Jumlah/Kriteria Sampel</option>
                    <option value="instrumen">Perubahan Instrumen Penelitian</option>
                    <option value="lokasi">Perubahan Lokasi Penelitian</option>
                    <option value="waktu">Perubahan Waktu Penelitian</option>
                    <option value="tim_peneliti">Perubahan Tim Peneliti</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Detail Amandemen :</label>
                <textarea name="detail_amandemen" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Jelaskan secara detail perubahan yang akan dilakukan..." required></textarea>
            </div>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Alasan Amandemen :</label>
                <textarea name="alasan_amandemen" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Jelaskan alasan mengapa perlu dilakukan amandemen..." required></textarea>
            </div>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Dampak Amandemen terhadap Risiko Penelitian :</label>
                <textarea name="dampak_amandemen" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Jelaskan dampak amandemen terhadap risiko dan keselamatan subjek penelitian..." required></textarea>
            </div>
        </div>

        <!-- Upload Dokumen -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Dokumen Pendukung</h3>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Upload Dokumen Amandemen :</label>
                <input type="file" name="dokumen_amandemen" accept=".pdf,.doc,.docx" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                <p class="text-xs text-gray-500">Format yang diizinkan: PDF, DOC, DOCX. Maksimal 2MB.</p>
            </div>
        </div>

        <!-- Catatan Penting -->
        <div class="bg-red-50 border-l-4 border-red-400 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Catatan Penting</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Amandemen hanya dapat dilakukan untuk penelitian yang sudah mendapat persetujuan etik</li>
                            <li>Penelitian harus dihentikan sementara sampai amandemen disetujui</li>
                            <li>Proses review amandemen membutuhkan waktu 14-21 hari kerja</li>
                            <li>Amandemen mayor mungkin memerlukan review ulang lengkap</li>
                            <li>Pastikan semua dokumen pendukung telah dilengkapi</li>
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
            <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition duration-200">
                Kirim Pengajuan Amandemen
            </button>
        </div>
    </form>
</div>
@endsection