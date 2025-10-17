@extends('layouts.app')

@section('title', 'Form Pengajuan Baru')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-700 to-blue-900 text-white p-6 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-8">
            <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.3"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#grid)" />
            </svg>
        </div>
        
        <!-- Header Content -->
        <div class="relative z-10 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <!-- University Logo/Icon -->
                <div class="bg-white bg-opacity-25 rounded-full p-3 border border-white border-opacity-30">
                    <img src="{{ asset('images/logo-unand.png') }}" alt="Logo Unand" class="w-8 h-8">
                </div>
                <!-- Title and Subtitle -->
                <div>
                    <h1 class="text-2xl font-bold tracking-wide text-white drop-shadow-sm">FORM PENGAJUAN ETIK</h1>
                    <p class="text-white text-base mt-1 font-semibold drop-shadow-sm tracking-wide">KOMITE ETIK PENELITIAN UNIVERSITAS ANDALAS</p>
                </div>
            </div>
            
            {{-- <!-- Status Indicator -->
            <div class="hidden md:flex items-center space-x-2 bg-white bg-opacity-25 rounded-full px-4 py-2 border border-white border-opacity-30">
                <div class="w-2 h-2 bg-green-300 rounded-full animate-pulse shadow-sm"></div>
                <span class="text-sm font-semibold text-white">Sistem Aktif</span>
            </div> --}}
        </div>
        
        <!-- Progress Steps Indicator -->
        <div class="mt-4 flex items-center space-x-2">
            <div class="flex items-center space-x-1">
                <div class="w-3 h-3 bg-white rounded-full shadow-sm"></div>
                <span class="text-xs text-blue-50 font-medium">Pengisian Form</span>
            </div>
            <div class="flex-1 h-px bg-blue-300 mx-2"></div>
            <div class="flex items-center space-x-1">
                <div class="w-3 h-3 bg-blue-300 rounded-full"></div>
                <span class="text-xs text-blue-100 font-medium">Review</span>
            </div>
            <div class="flex-1 h-px bg-blue-300 mx-2"></div>
            <div class="flex items-center space-x-1">
                <div class="w-3 h-3 bg-blue-300 rounded-full"></div>
                <span class="text-xs text-blue-100 font-medium">Selesai</span>
            </div>
        </div>
    </div>

    <!-- Success and Error messages are now handled by SweetAlert in the main layout -->

    <!-- Error Messages -->
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded m-4" role="alert">
            <div class="font-bold">Terjadi kesalahan:</div>
            <ul class="mt-2 list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Debug Information (hanya tampil jika ada error) -->
    @if($errors->any() && config('app.debug'))
        <div class="bg-yellow-50 border border-yellow-400 text-yellow-800 px-4 py-3 rounded m-4" role="alert">
            <div class="font-bold mb-2">Informasi Debug:</div>
            <div class="text-sm">
                <strong>Method:</strong> {{ request()->method() }}<br>
                <strong>URL:</strong> {{ request()->url() }}<br>
                <strong>Route:</strong> {{ request()->route() ? request()->route()->getName() : 'N/A' }}<br>
                <strong>Timestamp:</strong> {{ now()->format('Y-m-d H:i:s') }}<br>
                @if(session('debug_message'))
                    <strong>Debug Message:</strong> {{ session('debug_message') }}<br>
                @endif
                @if(session('validation_errors'))
                    <strong>Validation Details:</strong>
                    <pre class="mt-2 text-xs bg-yellow-100 p-2 rounded overflow-x-auto">{{ json_encode(session('validation_errors'), JSON_PRETTY_PRINT) }}</pre>
                @endif
                @if(session('exception_details'))
                    <strong>Exception Details:</strong>
                    <pre class="mt-2 text-xs bg-yellow-100 p-2 rounded overflow-x-auto">{{ json_encode(session('exception_details'), JSON_PRETTY_PRINT) }}</pre>
                @endif
            </div>
        </div>
    @endif

    <!-- Modal custom telah digantikan dengan SweetAlert -->

    <!-- Form -->
    <form action="{{ route('pengajuan-baru.store') }}" method="POST" class="p-6 space-y-6">
        @csrf
        
        <!-- Anda Civitas Unand -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
            <label class="text-sm font-medium text-gray-700">• Anda Civitas Universitas Andalas :</label>
            <select name="anda_civitas_unand" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="">--Pilih--</option>
                <option value="ya">Ya</option>
                <option value="tidak">Tidak</option>
            </select>
            <div class="flex items-center space-x-2">
                <label class="text-sm text-gray-700">Fakultas :</label>
                <select name="fakultas" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">--Pilih--</option>
                    <option value="kedokteran">Kedokteran</option>
                    <option value="kedokteran_gigi">Kedokteran Gigi</option>
                    <option value="farmasi">Farmasi</option>
                    <option value="keperawatan">Keperawatan</option>
                    <option value="kesehatan_masyarakat">Kesehatan Masyarakat</option>
                </select>
            </div>
        </div>

        <!-- Penunjukan -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
            <label class="text-sm font-medium text-gray-700">• Penunjukan :</label>
            <select name="penunjukan" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="">--Pilih--</option>
                <option value="dosen">Dosen</option>
                <option value="mahasiswa">Mahasiswa</option>
                <option value="peneliti">Peneliti</option>
            </select>
            <div class="flex items-center space-x-2">
                <label class="text-sm text-gray-700">Jenjang :</label>
                <select name="jenjang" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">--Pilih--</option>
                    <option value="s1">S1</option>
                    <option value="s2">S2</option>
                    <option value="s3">S3</option>
                    <option value="profesi">Profesi</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm text-gray-700">Kelompok :</label>
                <select name="kelompok" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">--Pilih--</option>
                    <option value="individu">Individu</option>
                    <option value="kelompok">Kelompok</option>
                </select>
            </div>
        </div>

        <!-- Multisenter -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-gray-700">• Multisenter :</label>
                <select name="multisenter" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">--Pilih--</option>
                    <option value="ya">Ya</option>
                    <option value="tidak">Tidak</option>
                </select>
            </div>
        </div>

        <!-- Senter Penelitian Utama -->
        <div class="space-y-2">
            <label class="text-sm font-medium text-gray-700">• Senter Penelitian Utama :</label>
            <input type="text" name="senter_penelitian_utama" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Satelit -->
        <div class="space-y-2">
            <label class="text-sm font-medium text-gray-700">• Satelit :</label>
            <input type="text" name="satelit" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Penyandang Dana -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-gray-700">• Penyandang Dana :</label>
                <select name="penyandang_dana" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">--Pilih--</option>
                    <option value="mandiri">Mandiri</option>
                    <option value="hibah">Hibah</option>
                    <option value="sponsor">Sponsor</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm text-gray-700">sebutkan detailnya :</label>
                <input type="text" name="sebut_detailnya" class="flex-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <!-- Judul Penelitian -->
        <div class="space-y-2">
            <label class="text-sm font-medium text-gray-700">• Judul Penelitian :</label>
            <textarea name="judul_penelitian" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            <p class="text-xs text-gray-500">Jangan menggunakan tanda petik (")</p>
        </div>

        <!-- Lokasi Penelitian -->
        <div class="space-y-2">
            <label class="text-sm font-medium text-gray-700">• Lokasi Penelitian :</label>
            <input type="text" name="lokasi_penelitian" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Instansi Pengusul -->
        <div class="space-y-2">
            <label class="text-sm font-medium text-gray-700">• Prodi/Departemen/Pusat Studi :</label>
            <input type="text" name="prodi_departemen" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <div class="text-right">
                <button type="button" class="text-blue-600 text-sm hover:underline">contoh penulisan Sarjana Kedokteran</button>
            </div>
        </div>

        <!-- Nama Fakultas/Jurusan/Bagian -->
        <div class="space-y-2">
            <label class="text-sm font-medium text-gray-700">• Nama Fakultas/Jurusan/Bagian :</label>
            <input type="text" name="nama_fakultas" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <div class="text-right">
                <button type="button" class="text-blue-600 text-sm hover:underline">contoh penulisan Fakultas Kedokteran</button>
            </div>
        </div>

        <!-- Nama Universitas/Instansi -->
        <div class="space-y-2">
            <label class="text-sm font-medium text-gray-700">• Nama Universitas/Instansi :</label>
            <input type="text" name="nama_universitas" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <div class="text-right">
                <button type="button" class="text-blue-600 text-sm hover:underline">contoh penulisan Universitas Padjadjaran</button>
            </div>
        </div>

        <!-- Alamat Institusi -->
        <div class="space-y-2">
            <label class="text-sm font-medium text-gray-700">• Alamat Institusi :</label>
            <textarea name="alamat_institusi" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
        </div>

        <!-- Nama Peneliti Utama -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Nama Peneliti Utama :</label>
                <input type="text" name="nama_peneliti_utama" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Nama Kontak Person :</label>
                <input type="text" name="nama_kontak_person" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>

        <!-- Periode Penelitian -->
        <div class="space-y-2">
            <label class="text-sm font-medium text-gray-700">• Periode Penelitian :</label>
            <input type="text" name="periode_penelitian" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Periode Awal harus lebih dari tanggal hari ini ditambah 14 hari kedepan" required>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                <div class="text-right">
                    <span class="text-sm text-gray-600">NIP : 082298556758</span>
                </div>
                <div class="text-right">
                    <span class="text-sm text-gray-600">Contoh Periode Penelitian : 01-02-1975</span>
                </div>
            </div>
        </div>

        <!-- Jumlah Subjek/Responden -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Jumlah Subjek/Responden :</label>
                <input type="text" name="jumlah_subjek" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <p class="text-xs text-gray-500">Jumlah daerah penelitian</p>
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Jenis Hewan :</label>
                <input type="text" name="jenis_hewan" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-xs text-gray-500">Sesuai daerah</p>
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">Asal :</label>
                <div class="flex space-x-2">
                    <button type="button" class="px-3 py-1 bg-gray-200 text-sm rounded">Jumlah</button>
                    <button type="button" class="px-3 py-1 bg-gray-200 text-sm rounded">Asal</button>
                </div>
            </div>
        </div>

        <!-- Jenis Data -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-gray-700">• Jenis Data :</label>
                <select name="jenis_data" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">--Pilih--</option>
                    <option value="primer">Primer</option>
                    <option value="sekunder">Sekunder</option>
                    <option value="campuran">Campuran</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-gray-700">• Metode Penelitian :</label>
                <select name="metode_penelitian" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">--Pilih--</option>
                    <option value="kuantitatif">Kuantitatif</option>
                    <option value="kualitatif">Kualitatif</option>
                    <option value="mixed_method">Mixed Method</option>
                </select>
            </div>
        </div>

        <!-- Keterkaitan Penelitian Dengan Dosen -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Keterkaitan Penelitian Dengan Dosen, Disil Jika Mahasiswa UNAND</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-center space-x-2">
                    <label class="text-sm font-medium text-gray-700">• Terikat Penelitian Dosen :</label>
                    <select name="terikat_penelitian_dosen" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">--Pilih--</option>
                        <option value="ya">Ya</option>
                        <option value="tidak">Tidak</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Nama Dosen :</label>
                    <input type="text" name="nama_dosen" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Peran :</label>
                    <select name="peran" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">--Pilih--</option>
                        <option value="pembimbing">Pembimbing</option>
                        <option value="supervisor">Supervisor</option>
                        <option value="peneliti_utama">Peneliti Utama</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">Jika Lainnya Sebutkan :</label>
                    <input type="text" name="jika_lainnya" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">• Judul Penelitian Payung :</label>
                <textarea name="judul_penelitian_payung" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-center space-x-2">
                    <label class="text-sm font-medium text-gray-700">• Apakah ada Pembimbing atau Peneliti Lainnya yang terlibat dalam penelitian ini :</label>
                    <select name="apakah_ada_pembimbing" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">--Pilih--</option>
                        <option value="ya">Ya</option>
                        <option value="tidak">Tidak</option>
                    </select>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700">Isian dibawah wajib diisi jika ada, karena akan dimasukkan pada Surat Persetujuan ETIK, anda bertanggung jawab penuh akan kebenaran data ini.</label>
                <div class="bg-gray-50 p-4 rounded border">
                    <table class="w-full" id="pembimbingTable">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2 text-left">No</th>
                                <th class="border p-2 text-left">Nama Pembimbing atau Peneliti Lainnya (wajib diisi) karena ini ada dicantumkan pada Surat Persetujuan ETIK</th>
                                <th class="border p-2 text-left">Fungsi</th>
                                <th class="border p-2 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="pembimbingTableBody">
                            <!-- Data pembimbing akan ditambahkan di sini -->
                        </tbody>
                    </table>
                    <div class="mt-2 flex space-x-2">
                        <button type="button" id="btnCariPembimbing" class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Cari Pembimbing</button>
                        <button type="button" id="btnTambahManual" class="px-3 py-1 bg-green-500 text-white text-sm rounded hover:bg-green-600">Tambah Manual</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hidden input untuk data pembimbing -->
        <input type="hidden" name="pembimbing_data" id="pembimbingDataInput" value="">

        <!-- Submit Buttons -->
        <div class="flex justify-end space-x-4 pt-6 border-t">
            <button type="button" class="px-6 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition duration-200">
                Batal
            </button>
            <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition duration-200">
                Ulangi
            </button>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-200">
                Simpan
            </button>
        </div>
    </form>
</div>

<!-- Modal Pencarian Pembimbing -->
<div id="modalCariPembimbing" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Cari Pembimbing/Peneliti</h3>
                <button id="closeModal" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Search Input -->
            <div class="mb-4">
                <input type="text" id="searchInput" placeholder="Cari berdasarkan nama atau NIDN..." 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <!-- Loading -->
            <div id="loadingSearch" class="hidden text-center py-4">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
                <p class="mt-2 text-gray-600">Mencari data...</p>
            </div>
            
            <!-- Search Results -->
            <div id="searchResults" class="max-h-96 overflow-y-auto">
                <!-- Results will be populated here -->
            </div>
            
            <!-- No Results -->
            <div id="noResults" class="hidden text-center py-8 text-gray-500">
                <p>Tidak ada data ditemukan</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Manual -->
<div id="modalTambahManual" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Tambah Pembimbing Manual</h3>
                <button id="closeManualModal" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <form id="formTambahManual">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="namaManual" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIDN (Opsional)</label>
                        <input type="text" id="nidnManual" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fakultas (Opsional)</label>
                        <input type="text" id="fakultasManual" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Program Studi (Opsional)</label>
                        <input type="text" id="prodiManual" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fungsi</label>
                        <select id="fungsiManual" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Fungsi</option>
                            <option value="pembimbing">Pembimbing</option>
                            <option value="peneliti">Peneliti</option>
                            <option value="ko-peneliti">Ko-Peneliti</option>
                        </select>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" id="cancelManual" 
                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Batal</button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Global variables
let pembimbingData = [];
let pembimbingCounter = 0;

// DOM Elements
const btnCariPembimbing = document.getElementById('btnCariPembimbing');
const btnTambahManual = document.getElementById('btnTambahManual');
const modalCariPembimbing = document.getElementById('modalCariPembimbing');
const modalTambahManual = document.getElementById('modalTambahManual');
const closeModal = document.getElementById('closeModal');
const closeManualModal = document.getElementById('closeManualModal');
const searchInput = document.getElementById('searchInput');
const searchResults = document.getElementById('searchResults');
const loadingSearch = document.getElementById('loadingSearch');
const noResults = document.getElementById('noResults');
const formTambahManual = document.getElementById('formTambahManual');
const pembimbingTableBody = document.getElementById('pembimbingTableBody');

// Event Listeners
btnCariPembimbing.addEventListener('click', () => {
    modalCariPembimbing.classList.remove('hidden');
    searchInput.focus();
});

btnTambahManual.addEventListener('click', () => {
    modalTambahManual.classList.remove('hidden');
    document.getElementById('namaManual').focus();
});

closeModal.addEventListener('click', () => {
    modalCariPembimbing.classList.add('hidden');
    clearSearchResults();
});

closeManualModal.addEventListener('click', () => {
    modalTambahManual.classList.add('hidden');
    formTambahManual.reset();
});

document.getElementById('cancelManual').addEventListener('click', () => {
    modalTambahManual.classList.add('hidden');
    formTambahManual.reset();
});

// Close modals when clicking outside
modalCariPembimbing.addEventListener('click', (e) => {
    if (e.target === modalCariPembimbing) {
        modalCariPembimbing.classList.add('hidden');
        clearSearchResults();
    }
});

modalTambahManual.addEventListener('click', (e) => {
    if (e.target === modalTambahManual) {
        modalTambahManual.classList.add('hidden');
        formTambahManual.reset();
    }
});

// Search functionality
let searchTimeout;
searchInput.addEventListener('input', (e) => {
    clearTimeout(searchTimeout);
    const query = e.target.value.trim();
    
    if (query.length < 2) {
        clearSearchResults();
        return;
    }
    
    searchTimeout = setTimeout(() => {
        searchDosen(query);
    }, 500);
});

// Search dosen function
async function searchDosen(query) {
    showLoading(true);
    
    try {
        const response = await fetch(`/api/dosen?search=${encodeURIComponent(query)}`);
        const result = await response.json();
        
        showLoading(false);
        
        if (result.success && result.data && result.data.length > 0) {
            displaySearchResults(result.data);
        } else {
            showNoResults();
        }
    } catch (error) {
        console.error('Error searching dosen:', error);
        showLoading(false);
        showNoResults();
    }
}

// Display search results
function displaySearchResults(data) {
    searchResults.innerHTML = '';
    noResults.classList.add('hidden');
    
    data.forEach(dosen => {
        const resultItem = document.createElement('div');
        resultItem.className = 'border-b border-gray-200 p-3 hover:bg-gray-50 cursor-pointer';
        resultItem.innerHTML = `
            <div class="flex justify-between items-center">
                <div>
                    <h4 class="font-medium text-gray-900">${dosen.nama || 'Nama tidak tersedia'}</h4>
                    <p class="text-sm text-gray-600">NIDN: ${dosen.nidn || 'Tidak tersedia'}</p>
                    <p class="text-sm text-gray-600">${dosen.fakultas || 'Fakultas tidak tersedia'}</p>
                    <p class="text-sm text-gray-600">${dosen.prodi_name || dosen.prodi || 'Program Studi tidak tersedia'}</p>
                </div>
                <button class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600" 
                        onclick="selectDosen(${JSON.stringify(dosen).replace(/"/g, '&quot;')})">
                    Pilih
                </button>
            </div>
        `;
        searchResults.appendChild(resultItem);
    });
}

// Select dosen function
function selectDosen(dosen) {
    // Show function selection modal
    showFunctionSelectionModal(dosen);
}

// Show function selection modal
function showFunctionSelectionModal(dosen) {
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50';
    modal.innerHTML = `
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/3 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Pilih Fungsi untuk ${dosen.nama}</h3>
                <div class="space-y-3">
                    <button onclick="addPembimbing('${dosen.nama}', '${dosen.nidn || ''}', '${dosen.fakultas || ''}', '${dosen.prodi_name || dosen.prodi || ''}', 'pembimbing'); document.body.removeChild(this.closest('.fixed'))" 
                            class="w-full p-3 text-left border border-gray-300 rounded hover:bg-gray-50">
                        <div class="font-medium">Pembimbing</div>
                        <div class="text-sm text-gray-600">Dosen pembimbing penelitian</div>
                    </button>
                    <button onclick="addPembimbing('${dosen.nama}', '${dosen.nidn || ''}', '${dosen.fakultas || ''}', '${dosen.prodi_name || dosen.prodi || ''}', 'peneliti'); document.body.removeChild(this.closest('.fixed'))" 
                            class="w-full p-3 text-left border border-gray-300 rounded hover:bg-gray-50">
                        <div class="font-medium">Peneliti</div>
                        <div class="text-sm text-gray-600">Peneliti utama atau anggota tim</div>
                    </button>
                    <button onclick="addPembimbing('${dosen.nama}', '${dosen.nidn || ''}', '${dosen.fakultas || ''}', '${dosen.prodi_name || dosen.prodi || ''}', 'ko-peneliti'); document.body.removeChild(this.closest('.fixed'))" 
                            class="w-full p-3 text-left border border-gray-300 rounded hover:bg-gray-50">
                        <div class="font-medium">Ko-Peneliti</div>
                        <div class="text-sm text-gray-600">Ko-peneliti atau peneliti pendamping</div>
                    </button>
                </div>
                <div class="flex justify-end mt-4">
                    <button onclick="document.body.removeChild(this.closest('.fixed'))" 
                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Batal</button>
                </div>
            </div>
        </div>
    `;
    document.body.appendChild(modal);
}

// Add pembimbing function
function addPembimbing(nama, nidn, fakultas, prodi, fungsi) {
    pembimbingCounter++;
    
    const pembimbing = {
        id: pembimbingCounter,
        nama: nama,
        nidn: nidn,
        fakultas: fakultas,
        prodi: prodi,
        fungsi: fungsi
    };
    
    pembimbingData.push(pembimbing);
    updatePembimbingTable();
    
    // Close search modal
    modalCariPembimbing.classList.add('hidden');
    clearSearchResults();
}

// Manual form submission
formTambahManual.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const nama = document.getElementById('namaManual').value.trim();
    const nidn = document.getElementById('nidnManual').value.trim();
    const fakultas = document.getElementById('fakultasManual').value.trim();
    const prodi = document.getElementById('prodiManual').value.trim();
    const fungsi = document.getElementById('fungsiManual').value;
    
    if (nama && fungsi) {
        addPembimbing(nama, nidn, fakultas, prodi, fungsi);
        modalTambahManual.classList.add('hidden');
        formTambahManual.reset();
    }
});

// Update pembimbing table
function updatePembimbingTable() {
    pembimbingTableBody.innerHTML = '';
    
    if (pembimbingData.length === 0) {
        pembimbingTableBody.innerHTML = `
            <tr>
                <td colspan="4" class="border p-4 text-center text-gray-500">
                    Belum ada pembimbing yang ditambahkan
                </td>
            </tr>
        `;
        return;
    }
    
    pembimbingData.forEach((pembimbing, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="border p-2">${index + 1}</td>
            <td class="border p-2">
                <div class="font-medium">${pembimbing.nama}</div>
                <div class="text-sm text-gray-600">NIDN: ${pembimbing.nidn || 'Tidak tersedia'}</div>
                <div class="text-sm text-gray-600">${pembimbing.fakultas || ''}</div>
                <div class="text-sm text-gray-600">${pembimbing.prodi || ''}</div>
                <input type="hidden" name="pembimbing[${index}][nama]" value="${pembimbing.nama}">
                <input type="hidden" name="pembimbing[${index}][nidn]" value="${pembimbing.nidn || ''}">
                <input type="hidden" name="pembimbing[${index}][fakultas]" value="${pembimbing.fakultas || ''}">
                <input type="hidden" name="pembimbing[${index}][prodi]" value="${pembimbing.prodi || ''}">
                <input type="hidden" name="pembimbing[${index}][fungsi]" value="${pembimbing.fungsi}">
            </td>
            <td class="border p-2">
                <span class="inline-block px-2 py-1 text-xs font-medium rounded-full ${
                    pembimbing.fungsi === 'pembimbing' ? 'bg-blue-100 text-blue-800' :
                    pembimbing.fungsi === 'peneliti' ? 'bg-green-100 text-green-800' :
                    'bg-purple-100 text-purple-800'
                }">
                    ${pembimbing.fungsi.charAt(0).toUpperCase() + pembimbing.fungsi.slice(1)}
                </span>
            </td>
            <td class="border p-2">
                <button type="button" onclick="removePembimbing(${pembimbing.id})" 
                        class="px-2 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">
                    Hapus
                </button>
            </td>
        `;
        pembimbingTableBody.appendChild(row);
    });
}

// Remove pembimbing function
function removePembimbing(id) {
    pembimbingData = pembimbingData.filter(p => p.id !== id);
    updatePembimbingTable();
}

// Helper functions
function showLoading(show) {
    if (show) {
        loadingSearch.classList.remove('hidden');
        searchResults.innerHTML = '';
        noResults.classList.add('hidden');
    } else {
        loadingSearch.classList.add('hidden');
    }
}

function showNoResults() {
    searchResults.innerHTML = '';
    noResults.classList.remove('hidden');
}

function clearSearchResults() {
    searchResults.innerHTML = '';
    noResults.classList.add('hidden');
    searchInput.value = '';
}

// Initialize table
updatePembimbingTable();

// Handle form submission
document.querySelector('form').addEventListener('submit', function(e) {
    // Update hidden input dengan data pembimbing
    const pembimbingDataInput = document.getElementById('pembimbingDataInput');
    pembimbingDataInput.value = JSON.stringify(pembimbingData);
});

// Success message is now handled by SweetAlert in the main layout
</script>

@endsection