@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-6">
    <div class="bg-white shadow rounded-2xl p-6">
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Export Data</h1>
                <p class="text-gray-500 text-sm">Unduh data pengajuan, pelaporan, dan user sesuai peran.</p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-unand-100 text-unand-800">
                Beta Feature
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
            <div class="p-4 rounded-xl border border-gray-100 bg-gray-50">
                <div class="text-sm text-gray-500">Total Pengajuan</div>
                <div class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_pengajuan']) }}</div>
            </div>
            <div class="p-4 rounded-xl border border-gray-100 bg-gray-50">
                <div class="text-sm text-gray-500">Pengajuan Disetujui</div>
                <div class="text-2xl font-bold text-gray-900">{{ number_format($stats['pengajuan_selesai']) }}</div>
            </div>
            <div class="p-4 rounded-xl border border-gray-100 bg-gray-50">
                <div class="text-sm text-gray-500">Total User Aktif</div>
                <div class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_user']) }}</div>
            </div>
        </div>

        <div class="mt-6 grid gap-4 sm:grid-cols-2">
            <div class="border border-gray-100 rounded-xl p-5">
                <h2 class="text-lg font-semibold text-gray-900">Export Pengajuan</h2>
                <p class="text-sm text-gray-500 mt-1">Gunakan untuk kebutuhan monitoring dan pelaporan periodik.</p>
                <div class="mt-4 flex flex-wrap gap-3">
                    <button class="inline-flex items-center px-4 py-2 rounded-lg bg-unand-600 text-white text-sm font-semibold shadow hover:bg-unand-700 transition">
                        Unduh Excel
                    </button>
                    <button class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-200 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Unduh CSV
                    </button>
                </div>
            </div>

            <div class="border border-gray-100 rounded-xl p-5">
                <h2 class="text-lg font-semibold text-gray-900">Export User & Lay Person</h2>
                <p class="text-sm text-gray-500 mt-1">Pantau status registrasi user, operator, dan lay person.</p>
                <div class="mt-4 flex flex-wrap gap-3">
                    <button class="inline-flex items-center px-4 py-2 rounded-lg bg-unand-600 text-white text-sm font-semibold shadow hover:bg-unand-700 transition">
                        Unduh User Aktif
                    </button>
                    <button class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-200 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Unduh Lay Person
                    </button>
                </div>
                <ul class="mt-4 text-xs text-gray-500 space-y-1">
                    <li>• Lay Person terdaftar: {{ number_format($stats['total_lay_person']) }}</li>
                    <li>• Pengusul aktif: {{ number_format($stats['total_pengusul']) }}</li>
                </ul>
            </div>
        </div>

        <div class="mt-6 p-4 rounded-xl bg-unand-50 text-sm text-unand-900 border border-unand-100">
            Fitur export akan dilepas bertahap. Hubungi Super Admin untuk membuka format khusus atau menambahkan template export baru.
        </div>
    </div>
</div>
@endsection
