@extends('layouts.app')

@section('content')
    <div class="bg-gradient-to-br from-unand-50 to-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-8 text-gray-900">
            <!-- Header -->
            <div class="mb-12 text-center">
                <h1
                    class="text-5xl font-bold bg-gradient-to-r from-unand-600 to-unand-800 bg-clip-text text-transparent mb-4">
                    Selamat Datang di Komite Etik Universitas Andalas</h1>
                <p class="text-xl text-gray-600 font-medium mb-2">Sistem Informasi Pengajuan Penelitian Etik</p>
                <p class="text-lg text-gray-500">Memastikan standar etika penelitian yang tinggi untuk kemajuan ilmu
                    pengetahuan</p>
                <div class="w-32 h-1 bg-gradient-to-r from-unand-400 to-unand-600 mx-auto mt-6 rounded-full"></div>
            </div>

            <!-- Feature Overview Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <div
                    class="group bg-gradient-to-br from-white to-blue-50 p-6 rounded-xl border border-blue-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center">
                        <div
                            class="p-3 rounded-full bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300 flex items-center justify-center">
                            <svg class="w-6 h-6 my-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3
                                class="text-lg font-semibold text-gray-800 group-hover:text-blue-700 transition-colors duration-300">
                                Pengajuan Etik</h3>
                            <p class="text-gray-600">Proses pengajuan etik penelitian</p>
                        </div>
                    </div>
                </div>



                <div
                    class="group bg-gradient-to-br from-white to-blue-50 p-6 rounded-xl border border-blue-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center">
                        <div
                            class="p-3 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3
                                class="text-lg font-semibold text-gray-800 group-hover:text-blue-700 transition-colors duration-300">
                                Review Etik</h3>
                            <p class="text-gray-600">Proses review profesional</p>
                        </div>
                    </div>
                </div>

                <div
                    class="group bg-gradient-to-br from-white to-green-50 p-6 rounded-xl border border-green-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center">
                        <div
                            class="p-3 rounded-full bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3
                                class="text-lg font-semibold text-gray-800 group-hover:text-green-700 transition-colors duration-300">
                                Sertifikat Etik</h3>
                            <p class="text-gray-600">Sertifikat kelayakan etik</p>
                        </div>
                    </div>
                </div>

                <div
                    class="group bg-gradient-to-br from-white to-purple-50 p-6 rounded-xl border border-purple-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center">
                        <div
                            class="p-3 rounded-full bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3
                                class="text-lg font-semibold text-gray-800 group-hover:text-purple-700 transition-colors duration-300">
                                Monitoring</h3>
                            <p class="text-gray-600">Pemantauan penelitian</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- News Section -->
            @if ($featuredNews || $latestNews->count() > 0)
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
                        <span class="bg-gradient-to-r from-unand-600 to-unand-800 bg-clip-text text-transparent">Berita &
                            Pengumuman</span>
                    </h2>

                    @if ($featuredNews)
                        <!-- Featured News Banner -->
                        <a href="{{ route('news.show', $featuredNews) }}" class="block">
                            <div
                                class="mb-8 bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-shadow duration-300">
                                @if ($featuredNews->banner_image)
                                    <div class="h-64 bg-cover bg-center relative"
                                        style="background-image: url('{{ asset('storage/' . $featuredNews->banner_image) }}')">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                            <span
                                                class="inline-block px-3 py-1 bg-unand-600 text-white text-xs font-semibold rounded-full mb-3">BERITA
                                                UTAMA</span>
                                            <h3 class="text-2xl font-bold mb-2">{{ $featuredNews->title }}</h3>
                                            <p class="text-gray-200 text-sm">{{ $featuredNews->formatted_published_date }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="h-32 bg-gradient-to-r from-unand-600 to-unand-800 relative">
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <div class="text-center text-white">
                                                <span
                                                    class="inline-block px-3 py-1 bg-white/20 text-white text-xs font-semibold rounded-full mb-3">BERITA
                                                    UTAMA</span>
                                                <h3 class="text-2xl font-bold">{{ $featuredNews->title }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="p-6">
                                    <p class="text-gray-700 leading-relaxed">{{ $featuredNews->getExcerptAttribute(200) }}</p>
                                    <div class="mt-4 flex items-center justify-between">
                                        <span class="text-sm text-gray-500">Dipublikasikan:
                                            {{ $featuredNews->formatted_published_date }}</span>
                                        <span class="text-sm text-unand-600 font-medium">{{ $featuredNews->created_by }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endif

                    @if ($latestNews->count() > 0)
                        <!-- Latest News Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach ($latestNews as $news)
                                <a href="{{ route('news.show', $news) }}" class="block">
                                    <div
                                        class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                        @if ($news->banner_image)
                                            <div class="h-48 bg-cover bg-center"
                                                style="background-image: url('{{ asset('storage/' . $news->banner_image) }}')">
                                            </div>
                                        @else
                                            <div
                                                class="h-48 bg-gradient-to-br from-unand-500 to-unand-700 flex items-center justify-center">
                                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="p-5">
                                        <h3 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2">
                                            {{ $news->title }}</h3>
                                        <p class="text-gray-600 text-sm mb-3 line-clamp-3">
                                            {{ $news->getExcerptAttribute(120) }}</p>
                                        <div class="flex items-center justify-between text-xs text-gray-500">
                                            <span>{{ $news->formatted_published_date }}</span>
                                            <span>{{ $news->created_by }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Menu Utama -->
                <div
                    class="bg-white border border-gray-200 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
                        <div class="w-1 h-6 bg-gradient-to-b from-unand-500 to-unand-700 rounded-full mr-3"></div>
                        @if (session('admin_logged_in'))
                            Menu Admin
                        @else
                            Layanan Komite Etik
                        @endif
                    </h2>
                    <div class="space-y-4">
                        <a href="{{ route('profil.index') }}"
                            class="group flex items-center p-4 bg-gradient-to-r from-gray-50 to-unand-50 hover:from-unand-50 hover:to-unand-100 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-md">
                            <div
                                class="p-3 bg-gradient-to-br from-unand-100 to-unand-200 rounded-xl mr-4 group-hover:from-unand-200 group-hover:to-unand-300 transition-all duration-300">
                                <svg class="w-5 h-5 text-unand-600 group-hover:text-unand-700 transition-colors duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3
                                    class="font-medium text-gray-800 group-hover:text-unand-700 transition-colors duration-300">
                                    Profil Komite Etik</h3>
                                <p class="text-sm text-gray-600">Informasi tentang komite etik dan anggota</p>
                            </div>
                        </a>

                        @if (session('admin_logged_in'))
                            <a href="{{ route('pengajuan-baru.index') }}"
                                class="group flex items-center p-4 bg-gradient-to-r from-gray-50 to-blue-50 hover:from-blue-50 hover:to-blue-100 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-md">
                                <div
                                    class="p-3 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl mr-4 group-hover:from-blue-200 group-hover:to-blue-300 transition-all duration-300">
                                    <svg class="w-5 h-5 text-blue-600 group-hover:text-blue-700 transition-colors duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3
                                        class="font-medium text-gray-800 group-hover:text-blue-700 transition-colors duration-300">
                                        Formulir Pengajuan Baru</h3>
                                    <p class="text-sm text-gray-600">Ajukan penelitian etik baru</p>
                                </div>
                            </a>

                            <a href="{{ route('ktd-sae.index') }}"
                                class="group flex items-center p-4 bg-gradient-to-r from-gray-50 to-red-50 hover:from-red-50 hover:to-red-100 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-md">
                                <div
                                    class="p-3 bg-gradient-to-br from-red-100 to-red-200 rounded-xl mr-4 group-hover:from-red-200 group-hover:to-red-300 transition-all duration-300">
                                    <svg class="w-5 h-5 text-red-600 group-hover:text-red-700 transition-colors duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3
                                        class="font-medium text-gray-800 group-hover:text-red-700 transition-colors duration-300">
                                        Modul KTD-SAE</h3>
                                    <p class="text-sm text-gray-600">Kejadian Tidak Diharapkan - Serious Adverse Event</p>
                                </div>
                            </a>
                        @else
                            <div
                                class="group flex items-center p-4 bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl border-2 border-dashed border-blue-200">
                                <div class="p-3 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl mr-4">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-800">Akses Formulir Pengajuan</h3>
                                    <p class="text-sm text-gray-600">Login diperlukan untuk mengakses formulir pengajuan
                                    </p>
                                    <a href="{{ route('login') }}"
                                        class="text-sm text-blue-600 hover:text-blue-800 font-medium">Login sekarang →</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Informasi -->
                <div
                    class="bg-white border border-gray-200 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
                        <div class="w-1 h-6 bg-gradient-to-b from-blue-500 to-blue-700 rounded-full mr-3"></div>
                        Informasi Penting
                    </h2>
                    <div class="space-y-4">
                        <div
                            class="p-5 bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:scale-105">
                            <div class="flex items-start">
                                <div class="p-2 bg-blue-500 rounded-lg mr-4 mt-1">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-blue-800 mb-2">Panduan Pengajuan</h3>
                                    <p class="text-sm text-blue-700 leading-relaxed">Pastikan semua dokumen telah
                                        dilengkapi sebelum mengajukan permohonan etik penelitian. Dokumen harus sesuai
                                        dengan standar internasional.</p>
                                </div>
                            </div>
                        </div>

                        <div
                            class="p-5 bg-gradient-to-r from-yellow-50 to-yellow-100 border border-yellow-200 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:scale-105">
                            <div class="flex items-start">
                                <div class="p-2 bg-yellow-500 rounded-lg mr-4 mt-1">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-yellow-800 mb-2">Waktu Proses</h3>
                                    <p class="text-sm text-yellow-700 leading-relaxed">Proses review membutuhkan waktu
                                        14-21 hari kerja setelah dokumen lengkap diterima. Pastikan dokumen sudah lengkap
                                        untuk mempercepat proses.</p>
                                </div>
                            </div>
                        </div>

                        <div
                            class="p-5 bg-gradient-to-r from-green-50 to-green-100 border border-green-200 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:scale-105">
                            <div class="flex items-start">
                                <div class="p-2 bg-green-500 rounded-lg mr-4 mt-1">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-green-800 mb-2">Kontak & Bantuan</h3>
                                    <p class="text-sm text-green-700 leading-relaxed">Hubungi sekretariat komite etik untuk
                                        bantuan lebih lanjut. Tim kami siap membantu Anda dalam proses pengajuan.</p>
                                </div>
                            </div>
                        </div>

                        @if (!session('admin_logged_in'))
                            <div
                                class="p-5 bg-gradient-to-r from-unand-50 to-unand-100 border border-unand-200 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:scale-105">
                                <div class="flex items-start">
                                    <div class="p-2 bg-unand-500 rounded-lg mr-4 mt-1">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-unand-800 mb-2">Akses Peneliti</h3>
                                        <p class="text-sm text-unand-700 leading-relaxed">Login untuk mengakses formulir
                                            pengajuan, melacak status penelitian, dan mengelola dokumen Anda.</p>
                                        <a href="{{ route('login') }}"
                                            class="inline-block mt-2 px-4 py-2 bg-unand-600 text-white text-sm font-medium rounded-lg hover:bg-unand-700 transition-colors duration-200">Login
                                            Sekarang</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if (!session('admin_logged_in'))
                <!-- Call to Action Section for Non-logged Users -->
                <div
                    class="mt-12 bg-gradient-to-r from-unand-600 to-unand-800 rounded-xl p-8 text-center text-white shadow-xl">
                    <h2 class="text-3xl font-bold mb-4">Mulai Penelitian Etik Anda</h2>
                    <p class="text-xl mb-6 text-unand-100">Bergabunglah dengan ribuan peneliti yang telah mempercayai
                        Komite Etik UNAND</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center px-6 py-3 bg-white text-unand-700 font-semibold rounded-lg hover:bg-gray-100 transition-colors duration-200 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Login Peneliti
                        </a>
                        <a href="{{ route('profil.index') }}"
                            class="inline-flex items-center px-6 py-3 bg-unand-500 text-white font-semibold rounded-lg hover:bg-unand-400 transition-colors duration-200 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
