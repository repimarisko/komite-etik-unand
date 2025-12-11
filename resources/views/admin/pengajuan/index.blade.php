@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-2xl overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Daftar Pengajuan</h1>
                    <p class="text-gray-500 text-sm">Monitoring status pengajuan lintas role.</p>
                </div>
                <form method="GET" class="flex flex-col md:flex-row gap-3 md:items-center">
                    <div class="flex items-center gap-2">
                        <label for="status" class="text-sm text-gray-600">Status</label>
                        <select id="status" name="status"
                            class="rounded-lg border-gray-300 focus:ring-unand-500 focus:border-unand-500 text-sm">
                            <option value="">Semua Status</option>
                            @foreach ($availableStatuses as $status)
                                <option value="{{ $status }}" @selected(request('status') === $status)>
                                    {{ Str::title(str_replace('_', ' ', $status)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center gap-2">
                        <label for="search" class="text-sm text-gray-600">Cari</label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            class="rounded-lg border-gray-300 focus:ring-unand-500 focus:border-unand-500 text-sm"
                            placeholder="Judul / nomor pengajuan">
                    </div>
                    <button type="submit"
                        class="inline-flex items-center justify-center px-4 py-2 bg-unand-600 text-white text-sm font-semibold rounded-lg hover:bg-unand-700 transition">
                        Terapkan
                    </button>
                </form>
            </div>

            @php
                $isSuperAdmin = auth()->user()?->isSuperAdmin();
            @endphp

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul
                                Penelitian</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Peneliti</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Submit</th>
                            @if ($isSuperAdmin)
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Plotting</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($pengajuan as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                                    {{ $item->nomor_pengajuan ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    <div class="font-medium">{{ Str::limit($item->judul_penelitian, 70) }}</div>
                                    <div class="text-xs text-gray-500">{{ ucfirst($item->jenis_pengajuan ?? '-') }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <div>{{ $item->peneliti_utama ?? '-' }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->user?->name ?? 'Tidak terhubung' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $status = $item->status ?? 'draft';
                                        $badgeColors = [
                                            'approved' => 'bg-green-100 text-green-800',
                                            'draft' => 'bg-gray-100 text-gray-800',
                                            'submitted' => 'bg-blue-100 text-blue-800',
                                            'review' => 'bg-yellow-100 text-yellow-800',
                                            'rejected' => 'bg-red-100 text-red-800',
                                        ];
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $badgeColors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ Str::title(str_replace('_', ' ', $status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ optional($item->tanggal_submit)->translatedFormat('d M Y') ?? '-' }}
                                </td>
                                @if ($isSuperAdmin)
                                    <td class="px-6 py-4">
                                        @if ($status === 'submitted')
                                            <a href="{{ route('admin.plotting.index') }}"
                                                class="inline-flex items-center px-3 py-2 text-xs font-semibold rounded-lg bg-unand-600 text-white hover:bg-unand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-unand-500">
                                                Plotting Reviewer
                                            </a>
                                        @else
                                            <span class="text-xs text-gray-400">Menunggu pengajuan</span>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $isSuperAdmin ? 6 : 5 }}"
                                    class="px-6 py-8 text-center text-sm text-gray-500">
                                    Belum ada data pengajuan yang dapat ditampilkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-100">
                {{ $pengajuan->links() }}
            </div>
        </div>
    </div>
@endsection
