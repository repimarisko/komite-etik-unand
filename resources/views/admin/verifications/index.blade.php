@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-6">
    <div class="bg-white shadow rounded-2xl p-6">
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Verifikasi Pengajuan</h1>
                <p class="text-gray-500 text-sm">Daftar pengajuan yang memerlukan verifikasi/penilaian.</p>
            </div>
            <div class="flex items-center gap-4 text-sm">
                <div>
                    <div class="text-gray-500">Total Pending</div>
                    <div class="text-xl font-semibold text-unand-700">{{ $pendingPengajuan->total() }}</div>
                </div>
                <div class="h-12 w-px bg-gray-200"></div>
                <div>
                    <div class="text-gray-500">Registrasi Pending</div>
                    <div class="text-xl font-semibold text-unand-700">{{ $pendingRegistrations->total() }}</div>
                </div>
            </div>
        </div>

        <div class="mt-6 grid gap-6 lg:grid-cols-2">
            <div class="border border-gray-100 rounded-xl overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-900">Pengajuan Menunggu Review</h2>
                    <p class="text-sm text-gray-500">Fokuskan ke proposal yang sudah masuk tahap review.</p>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($pendingPengajuan as $pengajuan)
                    <div class="px-5 py-4">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <div class="text-sm font-semibold text-gray-900">{{ Str::limit($pengajuan->judul_penelitian, 80) }}</div>
                                <div class="text-xs text-gray-500 mt-1">
                                    {{ $pengajuan->nomor_pengajuan ?? 'Nomor belum tersedia' }} • {{ $pengajuan->peneliti_utama }}
                                </div>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                {{ Str::title($pengajuan->status ?? 'draft') }}
                            </span>
                        </div>
                        <div class="mt-3 flex flex-wrap gap-2 text-xs text-gray-500">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-gray-100">Jenis: {{ ucfirst($pengajuan->jenis_pengajuan ?? 'baru') }}</span>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-gray-100">Submit: {{ optional($pengajuan->tanggal_submit)->translatedFormat('d M Y') ?? '-' }}</span>
                        </div>
                    </div>
                    @empty
                    <div class="px-5 py-8 text-center text-sm text-gray-500">
                        Belum ada pengajuan yang menunggu verifikasi.
                    </div>
                    @endforelse
                </div>
                <div class="px-5 py-3 bg-gray-50 border-t border-gray-100">
                    {{ $pendingPengajuan->links() }}
                </div>
            </div>

            <div class="border border-gray-100 rounded-xl overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-900">Registrasi User Menunggu Persetujuan</h2>
                    <p class="text-sm text-gray-500">Verifikasikan identitas sebelum memberikan akses.</p>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($pendingRegistrations as $registration)
                    <div class="px-5 py-4">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <div class="text-sm font-semibold text-gray-900">{{ $registration->name }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ $registration->email }}</div>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                Menunggu
                            </span>
                        </div>
                        <div class="mt-3 text-xs text-gray-500 space-y-1">
                            <div>Instansi: {{ $registration->institution ?? '-' }}</div>
                            <div>Departemen: {{ $registration->department ?? '-' }}</div>
                            <div>Alasan: {{ Str::limit($registration->reason_for_registration, 80) }}</div>
                        </div>
                    </div>
                    @empty
                    <div class="px-5 py-8 text-center text-sm text-gray-500">
                        Tidak ada registrasi yang menunggu verifikasi.
                    </div>
                    @endforelse
                </div>
                <div class="px-5 py-3 bg-gray-50 border-t border-gray-100">
                    {{ $pendingRegistrations->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
