@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-6">
    <div class="bg-white shadow rounded-2xl p-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Form Penilaian Lay Person</h1>
            <p class="text-sm text-gray-500 mt-1">
                Formulir berikut digunakan untuk mengisi catatan penilaian terhadap pengajuan yang sudah dipetakan kepada Anda.
            </p>
        </div>

        <div class="mt-6 space-y-4">
            @forelse($assignments as $assignment)
            <div class="border border-gray-100 rounded-xl p-5">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <div class="text-sm font-semibold text-gray-900">{{ Str::limit($assignment->judul_penelitian, 100) }}</div>
                        <div class="text-xs text-gray-500 mt-1">{{ $assignment->nomor_pengajuan ?? '-' }}</div>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                        {{ Str::title($assignment->status ?? 'draft') }}
                    </span>
                </div>
                <div class="mt-4">
                    <textarea rows="4" class="w-full rounded-xl border border-gray-200 focus:ring-unand-500 focus:border-unand-500 text-sm" placeholder="Catatan penilaian sementara..."></textarea>
                </div>
                <div class="mt-3 flex flex-wrap gap-3">
                    <button class="inline-flex items-center px-4 py-2 rounded-lg bg-unand-600 text-white text-xs font-semibold hover:bg-unand-700">
                        Simpan Draft
                    </button>
                    <button class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-200 text-xs font-semibold text-gray-700 hover:bg-gray-50">
                        Submit Penilaian
                    </button>
                </div>
            </div>
            @empty
            <div class="border border-dashed border-gray-200 rounded-xl p-8 text-center text-sm text-gray-500">
                Belum ada form penilaian aktif. Anda akan mendapatkan notifikasi ketika penugasan baru tersedia.
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
