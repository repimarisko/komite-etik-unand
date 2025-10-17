@extends('layouts.app')

@section('title', 'Registrasi Berhasil')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="flex justify-center">
            <img class="h-12 w-auto" src="{{ asset('images/logo-unand.png') }}" alt="UNAND Logo">
        </div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Registrasi Berhasil!
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Komite Etik Penelitian Universitas Andalas
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                    <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-medium text-gray-900">
                    Pendaftaran Anda Telah Diterima
                </h3>
                <p class="mt-2 text-sm text-gray-600">
                    Terima kasih telah mendaftar! Kami telah mengirimkan email verifikasi ke alamat email Anda.
                </p>
            </div>

            <div class="mt-6">
                <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                    <h4 class="text-sm font-medium text-blue-800 mb-3">Langkah Selanjutnya:</h4>
                    <ol class="text-sm text-blue-700 space-y-2">
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-medium mr-3 mt-0.5">1</span>
                            <span>Periksa email Anda dan klik link verifikasi</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-medium mr-3 mt-0.5">2</span>
                            <span>Tunggu persetujuan dari administrator</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-medium mr-3 mt-0.5">3</span>
                            <span>Anda akan menerima email berisi username dan password</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-medium mr-3 mt-0.5">4</span>
                            <span>Login menggunakan kredensial yang diberikan</span>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="mt-6">
                <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-medium text-yellow-800">Penting!</h4>
                            <p class="mt-1 text-sm text-yellow-700">
                                Jika Anda tidak menerima email verifikasi dalam 5 menit, periksa folder spam/junk Anda atau klik tombol "Kirim Ulang" di halaman verifikasi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 space-y-3">
                <a href="{{ route('verification.notice') }}"
                   class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                    Lanjut ke Verifikasi Email
                </a>
                
                <div class="text-center">
                    <a href="{{ route('login') }}"
                       class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                        Kembali ke Halaman Login
                    </a>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <p class="text-xs text-gray-500 text-center">
                    Butuh bantuan? Hubungi kami di 
                    <a href="mailto:komite.etik@unand.ac.id" class="text-indigo-600 hover:text-indigo-500">
                        komite.etik@unand.ac.id
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection