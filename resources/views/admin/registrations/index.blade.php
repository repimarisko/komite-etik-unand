@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-6">
    <div class="bg-white shadow rounded-2xl p-6">
        @php
            $authUser = auth()->user();
            $canOperatorVerify = $authUser && $authUser->hasAnyRole(['operator', 'super_admin']);
            $canApprove = $authUser && $authUser->hasRole('super_admin');
        @endphp
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Verifikasi Registrasi User</h1>
                <p class="text-sm text-gray-500">Pastikan email sudah terverifikasi sebelum menyetujui akses.</p>
            </div>
            <span class="text-sm text-gray-500">{{ $registrations->total() }} registrasi menunggu</span>
        </div>

        <div class="mt-6 divide-y divide-gray-100">
            @forelse($registrations as $registration)
            <div class="py-5 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div>
                    <div class="text-sm font-semibold text-gray-900">{{ $registration->name }}</div>
                    <div class="text-xs text-gray-500">{{ $registration->email }} • {{ $registration->phone ?? 'No. telp belum diisi' }}</div>
                    <div class="text-xs text-gray-500 mt-1">
                        {{ $registration->institution ?? '-' }} • {{ $registration->department ?? '-' }}
                    </div>
                    <div class="mt-2 text-sm text-gray-600">
                        Alasan registrasi: {{ Str::limit($registration->reason_for_registration, 120) }}
                    </div>
                </div>
                <div class="text-xs text-gray-500">
                    Status:
                    <span class="inline-flex items-center px-3 py-1 rounded-full font-semibold @class([
                            'bg-yellow-100 text-yellow-800' => $registration->status === 'pending',
                            'bg-green-100 text-green-800' => $registration->status === 'approved',
                            'bg-red-100 text-red-800' => $registration->status === 'rejected',
                        ])">
                        @if($registration->status === 'pending')
                            {{ $registration->isOperatorVerified() ? 'Menunggu Super Admin' : 'Menunggu Operator' }}
                        @else
                            {{ \Illuminate\Support\Str::title(str_replace('_', ' ', $registration->status)) }}
                        @endif
                    </span>
                    @if($registration->operator_verified_at)
                        <span class="ml-2">Verifikasi Operator: {{ $registration->operator_verified_at->format('d M Y H:i') }}</span>
                    @endif
                </div>
                <div class="flex flex-col gap-3 w-full md:w-auto">
                    @if(!$registration->isOperatorVerified() && $canOperatorVerify)
                        <form method="POST" action="{{ route('admin.registrations.operator-verify', $registration) }}" class="flex flex-col gap-2 md:flex-row md:items-center">
                            @csrf
                            <input type="text" name="admin_notes" placeholder="Catatan operator (opsional)"
                                class="rounded-lg border-gray-300 focus:ring-unand-500 focus:border-unand-500 text-xs w-full md:w-48">
                            <button class="inline-flex items-center px-4 py-2 rounded-lg bg-blue-600 text-white text-xs font-semibold hover:bg-blue-700">
                                Verifikasi Operator
                            </button>
                        </form>
                    @endif

                    @if($registration->isOperatorVerified() && $canApprove)
                        <form method="POST" action="{{ route('admin.registrations.approve', $registration) }}" class="flex flex-col gap-2 md:flex-row md:items-center">
                            @csrf
                            <input type="text" name="admin_notes" placeholder="Catatan super admin (opsional)"
                                class="rounded-lg border-gray-300 focus:ring-unand-500 focus:border-unand-500 text-xs w-full md:w-48">
                            <button class="inline-flex items-center px-4 py-2 rounded-lg bg-green-600 text-white text-xs font-semibold hover:bg-green-700">
                                Setujui & Buat Akun
                            </button>
                        </form>
                    @endif

                    @if($canApprove)
                        <form method="POST" action="{{ route('admin.registrations.reject', $registration) }}" class="flex flex-col gap-2 md:flex-row md:items-center">
                            @csrf
                            <input type="text" name="admin_notes" required placeholder="Catatan penolakan"
                                class="rounded-lg border-gray-300 focus:ring-unand-500 focus:border-unand-500 text-xs w-full md:w-48">
                            <button class="inline-flex items-center px-4 py-2 rounded-lg bg-red-600 text-white text-xs font-semibold hover:bg-red-700">
                                Tolak
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            @empty
            <div class="py-8 text-center text-sm text-gray-500">
                Tidak ada registrasi yang menunggu verifikasi.
            </div>
            @endforelse
        </div>

        <div class="pt-4 border-t border-gray-100">
            {{ $registrations->links() }}
        </div>
    </div>
</div>
@endsection
