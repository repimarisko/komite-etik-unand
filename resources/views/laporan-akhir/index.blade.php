@extends('layouts.app')

@section('title', 'Form Laporan Akhir Penelitian')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
    <!-- Header -->
    <div class="bg-indigo-600 text-white p-4">
        <h1 class="text-xl font-bold">FORM LAPORAN AKHIR PENELITIAN</h1>
    </div>

    <!-- Success and Error messages are now handled by SweetAlert in the main layout -->

    <!-- Form -->
    <form action="{{ route('laporan-akhir.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
        @csrf
        
        <!-- Informasi Surat Persetujuan -->
        <div class="bg-blue-50 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-blue-800 mb-4">Informasi Surat Persetujuan Etik</h3>
            
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

        <!-- Waktu Pelaksanaan -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Waktu Pelaksanaan Penelitian</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Tanggal Mulai Penelitian :</label>
                    <input type="date" name="tanggal_mulai_penelitian" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Tanggal Selesai Penelitian :</label>
                    <input type="date" name="tanggal_selesai_penelitian" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
            </div>
        </div>

        <!-- Status Penelitian -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Status Penelitian</h3>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Status Penyelesaian Penelitian :</label>
                <select name="status_penelitian" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <option value="">--Pilih Status--</option>
                    <option value="selesai_sesuai_rencana">Selesai Sesuai Rencana</option>
                    <option value="selesai_dengan_modifikasi">Selesai dengan Modifikasi</option>
                    <option value="dihentikan_sementara">Dihentikan Sementara</option>
                    <option value="dihentikan_permanen">Dihentikan Permanen</option>
                </select>
            </div>
        </div>

        <!-- Subjek Penelitian -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Subjek Penelitian</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Jumlah Subjek Target (Rencana) :</label>
                    <input type="number" name="jumlah_subjek_target" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Jumlah Subjek Tercapai (Aktual) :</label>
                    <input type="number" name="jumlah_subjek_tercapai" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
            </div>
        </div>

        <!-- Hasil Penelitian -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Hasil Penelitian</h3>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Ringkasan Hasil Penelitian :</label>
                <textarea name="ringkasan_hasil" rows="5" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Jelaskan ringkasan hasil penelitian, temuan utama, dan kesimpulan..." required></textarea>
            </div>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Kendala/Masalah yang Dihadapi (Opsional) :</label>
                <textarea name="kendala_penelitian" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Jelaskan kendala atau masalah yang dihadapi selama penelitian..."></textarea>
            </div>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Rekomendasi untuk Penelitian Selanjutnya (Opsional) :</label>
                <textarea name="rekomendasi" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Berikan rekomendasi untuk penelitian serupa di masa depan..."></textarea>
            </div>
        </div>

        <!-- Publikasi -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Rencana Publikasi</h3>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Rencana Publikasi Hasil Penelitian :</label>
                <select name="publikasi_rencana" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <option value="">--Pilih Rencana Publikasi--</option>
                    <option value="jurnal_nasional">Jurnal Nasional</option>
                    <option value="jurnal_internasional">Jurnal Internasional</option>
                    <option value="konferensi">Konferensi/Seminar</option>
                    <option value="skripsi_tesis_disertasi">Skripsi/Tesis/Disertasi</option>
                    <option value="tidak_dipublikasi">Tidak Dipublikasikan</option>
                    <option value="belum_diputuskan">Belum Diputuskan</option>
                </select>
            </div>
        </div>

        <!-- Upload Dokumen -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Dokumen Laporan</h3>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Upload Dokumen Laporan Akhir (Opsional) :</label>
                <input type="file" name="dokumen_laporan" accept=".pdf,.doc,.docx" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <p class="text-xs text-gray-500">Format yang diizinkan: PDF, DOC, DOCX. Maksimal 5MB.</p>
            </div>
        </div>

        <!-- Catatan Penting -->
        <div class="bg-green-50 border-l-4 border-green-400 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-green-800">Informasi Penting</h3>
                    <div class="mt-2 text-sm text-green-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Laporan akhir wajib diserahkan maksimal 3 bulan setelah penelitian selesai</li>
                            <li>Laporan ini merupakan kewajiban etik peneliti kepada Komite Etik</li>
                            <li>Data dalam laporan akan digunakan untuk evaluasi dan monitoring</li>
                            <li>Sertifikat penyelesaian akan diterbitkan setelah laporan disetujui</li>
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
                Kirim Laporan Akhir
            </button>
        </div>
    </form>
</div>
@endsection