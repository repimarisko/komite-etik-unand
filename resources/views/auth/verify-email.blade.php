@extends('layouts.app')

@section('title', 'Verifikasi Email')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="flex justify-center">
            <img class="h-12 w-auto" src="{{ asset('images/logo-unand.png') }}" alt="UNAND Logo">
        </div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Verifikasi Email
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Komite Etik Penelitian Universitas Andalas
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            @if(session('status'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                {{ session('status') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">
                                {{ session('error') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100">
                    <svg class="h-6 w-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-medium text-gray-900">
                    Periksa Email Anda
                </h3>
                <p class="mt-2 text-sm text-gray-600">
                    Kami telah mengirimkan link verifikasi ke email Anda. Silakan periksa kotak masuk dan klik link tersebut untuk memverifikasi akun Anda.
                </p>
            </div>

            <div class="mt-6 space-y-4">
                <!-- Resend Verification Email -->
                <form action="{{ route('verification.resend') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>

                <!-- Back to Login -->
                <div class="text-center">
                    <a href="{{ route('login') }}"
                       class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                        Kembali ke Halaman Login
                    </a>
                </div>
            </div>

            <!-- Instructions -->
            <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-md">
                <h4 class="text-sm font-medium text-blue-800 mb-2">Petunjuk:</h4>
                <ul class="text-sm text-blue-700 space-y-1">
                    <li>• Periksa folder spam/junk jika email tidak ditemukan di kotak masuk</li>
                    <li>• Link verifikasi berlaku selama 24 jam</li>
                    <li>• Setelah verifikasi, akun Anda akan menunggu persetujuan admin</li>
                    <li>• Anda akan menerima email berisi username dan password setelah disetujui</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection