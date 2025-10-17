@extends('layouts.app')

@section('title', 'Modul KTD-SAE')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
    <!-- Header -->
    <div class="bg-red-600 text-white p-4">
        <h1 class="text-xl font-bold">MODUL PELAPORAN KTD (KEJADIAN TIDAK DIINGINKAN) & SAE (SERIOUS ADVERSE EVENT)</h1>
    </div>

    <!-- Success and Error messages are now handled by SweetAlert in the main layout -->

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded m-4" role="alert">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('ktd-sae.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
        @csrf
        
        <!-- Informasi Penelitian -->
        <div class="bg-blue-50 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-blue-800 mb-4">Informasi Penelitian</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Nomor Surat Persetujuan Etik :</label>
                    <input type="text" name="nomor_surat_persetujuan" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                    <p class="text-xs text-gray-500">Contoh: 123/UN6.KEP/EC/2024</p>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Tanggal Surat Persetujuan :</label>
                    <input type="date" name="tanggal_surat" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                </div>
            </div>
            
            <div class="space-y-2 mt-4">
                <label class="text-sm font-medium text-gray-700">• Judul Penelitian :</label>
                <textarea name="judul_penelitian" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required></textarea>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Nama Peneliti Utama :</label>
                    <input type="text" name="nama_peneliti_utama" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Institusi/Universitas :</label>
                    <input type="text" name="institusi" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                </div>
            </div>
        </div>

        <!-- Jenis Laporan -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Jenis Laporan</h3>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Jenis Laporan :</label>
                <select name="jenis_laporan" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                    <option value="">--Pilih Jenis Laporan--</option>
                    <option value="ktd">KTD (Kejadian Tidak Diinginkan)</option>
                    <option value="sae">SAE (Serious Adverse Event)</option>
                </select>
                <div class="text-xs text-gray-600 mt-1">
                    <p><strong>KTD:</strong> Kejadian medis yang tidak diinginkan yang terjadi pada subjek penelitian</p>
                    <p><strong>SAE:</strong> Kejadian serius yang mengancam jiwa, memerlukan rawat inap, atau menyebabkan kecacatan</p>
                </div>
            </div>
        </div>

        <!-- Detail Kejadian -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Detail Kejadian</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Tanggal Kejadian :</label>
                    <input type="date" name="tanggal_kejadian" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Waktu Kejadian (Opsional) :</label>
                    <input type="time" name="waktu_kejadian" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Lokasi Kejadian :</label>
                    <input type="text" name="lokasi_kejadian" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                </div>
            </div>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Deskripsi Detail Kejadian :</label>
                <textarea name="deskripsi_kejadian" rows="5" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Jelaskan secara detail kejadian yang terjadi, termasuk gejala, tanda-tanda, dan kronologi..." required></textarea>
            </div>
        </div>

        <!-- Informasi Subjek -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Informasi Subjek Terlibat</h3>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Identitas Subjek (Inisial/Kode) :</label>
                <input type="text" name="subjek_terlibat" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Contoh: AB atau S001" required>
                <p class="text-xs text-gray-500">Gunakan inisial atau kode subjek untuk menjaga kerahasiaan</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Usia Subjek (Opsional) :</label>
                    <input type="number" name="usia_subjek" min="0" max="150" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Jenis Kelamin (Opsional) :</label>
                    <select name="jenis_kelamin_subjek" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="">--Pilih Jenis Kelamin--</option>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Kondisi Medis Subjek Sebelumnya (Opsional) :</label>
                <textarea name="kondisi_medis_subjek" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Jelaskan kondisi medis atau riwayat penyakit subjek yang relevan..."></textarea>
            </div>
        </div>

        <!-- Analisis Kejadian -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Analisis Kejadian</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Tingkat Keparahan :</label>
                    <select name="tingkat_keparahan" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                        <option value="">--Pilih Tingkat Keparahan--</option>
                        <option value="ringan">Ringan</option>
                        <option value="sedang">Sedang</option>
                        <option value="berat">Berat</option>
                        <option value="mengancam_jiwa">Mengancam Jiwa</option>
                        <option value="fatal">Fatal</option>
                    </select>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Hubungan dengan Penelitian :</label>
                    <select name="hubungan_dengan_penelitian" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                        <option value="">--Pilih Hubungan--</option>
                        <option value="pasti_terkait">Pasti Terkait</option>
                        <option value="mungkin_terkait">Mungkin Terkait</option>
                        <option value="tidak_terkait">Tidak Terkait</option>
                        <option value="tidak_dapat_dinilai">Tidak Dapat Dinilai</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Tindakan yang Diambil -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Tindakan yang Diambil</h3>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Tindakan Segera yang Diambil :</label>
                <textarea name="tindakan_segera" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Jelaskan tindakan medis atau non-medis yang segera dilakukan..." required></textarea>
            </div>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Tindakan Korektif (Opsional) :</label>
                <textarea name="tindakan_korektif" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Jelaskan tindakan untuk memperbaiki situasi..."></textarea>
            </div>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Tindakan Preventif (Opsional) :</label>
                <textarea name="tindakan_preventif" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Jelaskan tindakan untuk mencegah kejadian serupa..."></textarea>
            </div>
        </div>

        <!-- Status Subjek -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Status Subjek Saat Ini</h3>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Status Pemulihan Subjek :</label>
                <select name="status_subjek" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                    <option value="">--Pilih Status Subjek--</option>
                    <option value="pulih_sempurna">Pulih Sempurna</option>
                    <option value="pulih_dengan_gejala_sisa">Pulih dengan Gejala Sisa</option>
                    <option value="belum_pulih">Belum Pulih</option>
                    <option value="memburuk">Memburuk</option>
                    <option value="meninggal">Meninggal</option>
                    <option value="tidak_diketahui">Tidak Diketahui</option>
                </select>
            </div>
        </div>

        <!-- Pelaporan ke Pihak Lain -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Pelaporan ke Pihak Lain</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Dilaporkan ke Sponsor :</label>
                    <select name="dilaporkan_ke_sponsor" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                        <option value="">--Pilih--</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Tanggal Laporan ke Sponsor :</label>
                    <input type="date" name="tanggal_laporan_sponsor" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Dilaporkan ke Otoritas Kesehatan :</label>
                    <select name="dilaporkan_ke_otoritas" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                        <option value="">--Pilih--</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Tanggal Laporan ke Otoritas :</label>
                    <input type="date" name="tanggal_laporan_otoritas" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
            </div>
        </div>

        <!-- Upload Dokumen -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Dokumen Pendukung</h3>
            
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Upload Dokumen Pendukung (Opsional) :</label>
                <input type="file" name="dokumen_pendukung" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                <p class="text-xs text-gray-500">Format yang diizinkan: PDF, DOC, DOCX, JPG, PNG. Maksimal 10MB.</p>
                <p class="text-xs text-gray-500">Contoh: Rekam medis, foto, hasil lab, dokumentasi lainnya</p>
            </div>
        </div>

        <!-- Informasi Pelapor -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Informasi Pelapor</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Nama Pelapor :</label>
                    <input type="text" name="pelapor_nama" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Jabatan/Posisi :</label>
                    <input type="text" name="pelapor_jabatan" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">• Kontak (Email/Telepon) :</label>
                    <input type="text" name="pelapor_kontak" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                </div>
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
                    <h3 class="text-sm font-medium text-red-800">PERINGATAN PENTING</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li><strong>SAE harus dilaporkan dalam 24 jam</strong> setelah peneliti mengetahui kejadian</li>
                            <li><strong>KTD harus dilaporkan dalam 7 hari</strong> setelah kejadian diketahui</li>
                            <li>Jaga kerahasiaan identitas subjek - gunakan inisial atau kode</li>
                            <li>Berikan informasi yang akurat dan lengkap</li>
                            <li>Segera ambil tindakan medis yang diperlukan untuk keselamatan subjek</li>
                            <li>Dokumentasikan semua tindakan yang diambil</li>
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
            <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition duration-200">
                Kirim Laporan KTD/SAE
            </button>
        </div>
    </form>
</div>
@endsection