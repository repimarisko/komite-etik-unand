@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-6">
    <div class="bg-white shadow rounded-2xl p-6">
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Penugasan Lay Person</h1>
                <p class="text-gray-500 text-sm">Tinjau daftar pengajuan yang sudah dipetakan kepada Anda.</p>
            </div>
            <div class="text-sm text-gray-500">
                {{ $assignments->count() }} penugasan terbaru
            </div>
        </div>

        <div class="mt-6 space-y-4">
            @forelse($assignments as $assignment)
            <div class="border border-gray-100 rounded-xl p-5 flex flex-col gap-3">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <div class="text-sm font-semibold text-gray-900">{{ Str::limit($assignment->judul_penelitian, 120) }}</div>
                        <div class="text-xs text-gray-500 mt-1">
                            {{ $assignment->nomor_pengajuan ?? 'Nomor belum tersedia' }}
                            • Submit: {{ optional($assignment->tanggal_submit)->translatedFormat('d M Y') ?? '-' }}
                        </div>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-800">
                        {{ Str::title($assignment->status ?? 'draft') }}
                    </span>
                </div>
                <div class="text-sm text-gray-600">
                    Peneliti: {{ $assignment->peneliti_utama ?? 'Tidak tersedia' }}
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('lay-person.forms') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-unand-600 text-white text-xs font-semibold hover:bg-unand-700">
                        Mulai Isi Form
                    </a>
                    <button class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-200 text-xs font-semibold text-gray-700 hover:bg-gray-50">
                        Lihat Detail Pengajuan
                    </button>
                </div>
            </div>
            @empty
            <div class="border border-dashed border-gray-200 rounded-xl p-8 text-center text-sm text-gray-500">
                Belum ada penugasan untuk Anda. Silakan hubungi verifikator jika membutuhkan info terbaru.
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
