@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-6">
    <div class="bg-white shadow rounded-2xl p-6">
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Plotting Lay Person</h1>
                <p class="text-gray-500 text-sm">Pilih lay person yang tersedia untuk ditugaskan ke pengajuan.</p>
            </div>
            <span class="text-sm text-gray-500">Total Lay Person: {{ $layPersons->count() }}</span>
        </div>

        <div class="grid gap-6 lg:grid-cols-2 mt-6">
            <div class="border border-gray-100 rounded-xl overflow-hidden">
                <div class="px-5 py-4 bg-gray-50 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Daftar Lay Person</h2>
                    <p class="text-sm text-gray-500">Kemampuan dan riwayat aktivitas singkat.</p>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($layPersons as $person)
                    <div class="px-5 py-4 flex items-start justify-between gap-4">
                        <div>
                            <div class="text-sm font-semibold text-gray-900">{{ $person->name }}</div>
                            <div class="text-xs text-gray-500">{{ $person->email }} • {{ $person->phone ?? 'No. telp belum diisi' }}</div>
                            <div class="mt-2 inline-flex items-center px-2.5 py-1 rounded-full text-xs bg-green-50 text-green-700">
                                {{ $person->admin_activity_logs_count ?? 0 }} aktivitas terakhir
                            </div>
                        </div>
                        <button class="inline-flex items-center px-3 py-1.5 rounded-lg border border-gray-200 text-xs font-semibold text-gray-700 hover:bg-gray-100">
                            Tandai Tersedia
                        </button>
                    </div>
                    @empty
                    <div class="px-5 py-6 text-sm text-gray-500 text-center">
                        Belum ada akun lay person yang terdaftar.
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="border border-gray-100 rounded-xl overflow-hidden">
                <div class="px-5 py-4 bg-gray-50 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Pengajuan Siap Dipotting</h2>
                    <p class="text-sm text-gray-500">Daftar singkat proposal yang membutuhkan lay person.</p>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($pengajuan as $item)
                    <div class="px-5 py-4">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <div class="text-sm font-semibold text-gray-900">{{ Str::limit($item->judul_penelitian, 70) }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ $item->nomor_pengajuan ?? 'Nomor belum tersedia' }}</div>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                {{ Str::title($item->status ?? 'draft') }}
                            </span>
                        </div>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <button class="inline-flex items-center px-3 py-1.5 rounded-lg bg-unand-600 text-white text-xs font-semibold hover:bg-unand-700">
                                Plot Lay Person
                            </button>
                            <button class="inline-flex items-center px-3 py-1.5 rounded-lg border border-gray-200 text-xs font-semibold text-gray-700 hover:bg-gray-100">
                                Detail Pengajuan
                            </button>
                        </div>
                    </div>
                    @empty
                    <div class="px-5 py-6 text-sm text-gray-500 text-center">
                        Tidak ada pengajuan yang menunggu plotting.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
