@extends('layouts.app')

@section('title', 'Verifikasi Email')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="flex justify-center">
            <img class="h-12 w-auto" src="{{ asset('images/logo-unand.png') }}" alt="UNAND Logo">
        </div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Email Tidak Perlu Diverifikasi
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Komite Etik Penelitian Universitas Andalas
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100">
                    <svg class="h-6 w-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-medium text-gray-900">
                    Email Anda Otomatis Terverifikasi
                </h3>
                <p class="mt-2 text-sm text-gray-600">
                    Kami tidak lagi menggunakan verifikasi email. Operator dan super admin akan meninjau data Anda sebelum akun diaktifkan.
                </p>
            </div>

            <div class="mt-6 space-y-4">
                <a href="{{ route('login') }}"
                   class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                    Kembali ke Halaman Login
                </a>
            </div>

            <!-- Instructions -->
            <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-md">
                <h4 class="text-sm font-medium text-blue-800 mb-2">Petunjuk:</h4>
                <ul class="text-sm text-blue-700 space-y-1">
                    <li>• Operator akan memverifikasi kelengkapan data Anda</li>
                    <li>• Super admin akan memberikan persetujuan akhir</li>
                    <li>• Email berisi username & password akan dikirim setelah akun disetujui</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
