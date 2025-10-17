@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Profil Komite Etik Universitas Andalas</h1>
            <p class="text-gray-600">Informasi tentang Komite Etik</p>
        </div>
        
        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Main Info -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Tentang Komite Etik -->
                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Tentang Komite Etik
                    </h2>
                    <div class="prose max-w-none text-gray-700">
                        <p class="mb-4">
                            Komite Etik Universitas Andalas (UNAND) adalah lembaga independen yang bertugas melakukan telaah etik terhadap protokol penelitian di seluruh disiplin ilmu yang melibatkan makhluk hidup sebagai subjek penelitian, mencakup bidang kedokteran, ilmu sosial, humaniora, teknik, pertanian, dan bidang keilmuan lainnya.
                        </p>
                        <p class="mb-4">
                            Komite Etik UNAND dibentuk untuk memastikan bahwa penelitian yang dilakukan di lingkungan Universitas Andalas memenuhi standar etika penelitian internasional dan nasional, serta melindungi hak, keselamatan, dan kesejahteraan subjek penelitian dalam berbagai konteks keilmuan.
                        </p>
                        <p class="mb-4">
                            Sebagai institusi pendidikan tinggi dengan reputasi nasional dan internasional, Universitas Andalas berkomitmen untuk menjaga integritas penelitian di semua fakultas dan program studi, mulai dari penelitian dasar hingga penelitian terapan yang berdampak pada masyarakat luas.
                        </p>
                        <p>
                            Komite ini bekerja berdasarkan prinsip-prinsip etika penelitian yang meliputi respect for persons, beneficence, dan justice sesuai dengan Deklarasi Helsinki, pedoman etika penelitian nasional dan internasional, serta standar etika yang berlaku untuk berbagai disiplin ilmu.
                        </p>
                    </div>
                </div>
                
                <!-- Visi dan Misi -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-blue-800 mb-3 flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Visi
                        </h3>
                        <p class="text-blue-700">
                            Menjadi komite etik penelitian yang terpercaya dan diakui secara nasional dan internasional dalam menjamin pelaksanaan penelitian yang etis dan berkualitas di seluruh disiplin ilmu di Universitas Andalas.
                        </p>
                    </div>
                    
                    <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-green-800 mb-3 flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Misi
                        </h3>
                        <ul class="text-green-700 space-y-2">
                            <li>• Melakukan telaah etik penelitian secara independen dan kompeten di semua bidang keilmuan</li>
                            <li>• Melindungi hak dan kesejahteraan subjek penelitian dalam berbagai konteks disiplin ilmu</li>
                            <li>• Meningkatkan kualitas penelitian yang etis dan berintegritas tinggi</li>
                            <li>• Memberikan edukasi etika penelitian lintas fakultas dan program studi</li>
                            <li>• Mendukung penelitian berkualitas internasional yang berdampak pada kemajuan ilmu pengetahuan</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Tugas dan Fungsi -->
                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-6 h-6 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        Tugas dan Fungsi
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-2 h-2 bg-purple-500 rounded-full mt-2 mr-3"></div>
                                <p class="text-gray-700">Menilai protokol penelitian dari aspek etika di semua bidang keilmuan</p>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-2 h-2 bg-purple-500 rounded-full mt-2 mr-3"></div>
                                <p class="text-gray-700">Memberikan persetujuan etik (ethical clearance)</p>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-2 h-2 bg-purple-500 rounded-full mt-2 mr-3"></div>
                                <p class="text-gray-700">Melakukan monitoring penelitian yang sedang berjalan</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-2 h-2 bg-purple-500 rounded-full mt-2 mr-3"></div>
                                <p class="text-gray-700">Menangani laporan kejadian tidak diharapkan</p>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-2 h-2 bg-purple-500 rounded-full mt-2 mr-3"></div>
                                <p class="text-gray-700">Memberikan edukasi etika penelitian lintas disiplin ilmu</p>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-2 h-2 bg-purple-500 rounded-full mt-2 mr-3"></div>
                                <p class="text-gray-700">Mengembangkan pedoman etika penelitian untuk berbagai bidang studi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Contact & Info -->
            <div class="space-y-6">
                <!-- Kontak -->
                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Kontak
                    </h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-start">
                            <svg class="w-4 h-4 text-gray-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <p class="text-gray-600">Limau Manis Kec. Pauh
Kota Padang , Sumatera Barat , 25163 , Indonesia</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                           
                        </div>
                        
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-700">sekretariat_lppm@unand.ac.id</p>
                        </div>
                    </div>
                </div>
                
                <!-- Jam Operasional -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-yellow-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Jam Operasional
                    </h3>
                    <div class="space-y-2 text-sm text-yellow-700">
                        <div class="flex justify-between">
                            <span>Senin - Kamis</span>
                            <span>08:00 - 16:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Jumat</span>
                            <span>08:00 - 11:30</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Sabtu - Minggu</span>
                            <span>Tutup</span>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Tautan Cepat</h3>
                    <div class="space-y-2">
                        <a href="{{ route('pengajuan-baru.index') }}" class="block p-2 text-blue-600 hover:bg-blue-50 rounded transition duration-200">
                            → Formulir Pengajuan Baru
                        </a>
                        <a href="{{ route('perbaikan.index') }}" class="block p-2 text-blue-600 hover:bg-blue-50 rounded transition duration-200">
                            → Formulir Perbaikan
                        </a>
                        <a href="{{ route('ktd-sae.index') }}" class="block p-2 text-blue-600 hover:bg-blue-50 rounded transition duration-200">
                            → Modul KTD-SAE
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection