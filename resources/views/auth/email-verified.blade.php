@extends('layouts.app')

@section('title', 'Email Terverifikasi')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="flex justify-center">
            <img class="h-12 w-auto" src="{{ asset('images/logo-unand.png') }}" alt="UNAND Logo">
        </div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Email Terverifikasi!
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-medium text-gray-900">
                    Email Anda Berhasil Diverifikasi
                </h3>
                <p class="mt-2 text-sm text-gray-600">
                    Terima kasih! Email Anda telah berhasil diverifikasi. Akun Anda sekarang menunggu persetujuan dari administrator.
                </p>
            </div>

            <div class="mt-6">
                <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                    <h4 class="text-sm font-medium text-blue-800 mb-3">Status Akun Anda:</h4>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="ml-2 text-sm text-blue-700">✓ Registrasi berhasil</span>
                        </div>
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="ml-2 text-sm text-blue-700">✓ Email terverifikasi</span>
                        </div>
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="ml-2 text-sm text-blue-700">⏳ Menunggu persetujuan admin</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-medium text-yellow-800">Langkah Selanjutnya</h4>
                            <p class="mt-1 text-sm text-yellow-700">
                                Administrator akan meninjau pendaftaran Anda dalam 1-3 hari kerja. Setelah disetujui, Anda akan menerima email berisi username dan password untuk login.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('login') }}"
                   class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                    Kembali ke Halaman Login
                </a>
            </div>

            <!-- Contact Information -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <p class="text-xs text-gray-500 text-center">
                    Ada pertanyaan? Hubungi kami di 
                    <a href="mailto:komite.etik@unand.ac.id" class="text-indigo-600 hover:text-indigo-500">
                        komite.etik@unand.ac.id
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection