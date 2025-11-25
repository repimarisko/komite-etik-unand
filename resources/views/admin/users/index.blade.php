@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-6">
    <div class="bg-white shadow rounded-2xl p-6">
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Manajemen User</h1>
                <p class="text-sm text-gray-500">Lihat status user, role yang melekat, dan aktivitas terakhir.</p>
            </div>
            <form method="GET" class="flex flex-col md:flex-row gap-3 md:items-center text-sm">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/email"
                    class="rounded-lg border-gray-300 focus:ring-unand-500 focus:border-unand-500">
                <select name="status" class="rounded-lg border-gray-300 focus:ring-unand-500 focus:border-unand-500">
                    <option value="">Semua Status</option>
                    <option value="active" @selected(request('status') === 'active')>Aktif</option>
                    <option value="inactive" @selected(request('status') === 'inactive')>Tidak Aktif</option>
                    <option value="pending" @selected(request('status') === 'pending')>Menunggu</option>
                </select>
                <select name="role" class="rounded-lg border-gray-300 focus:ring-unand-500 focus:border-unand-500">
                    <option value="">Semua Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" @selected(request('role') === $role->name)>{{ $role->display_name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-unand-600 text-white font-semibold rounded-lg">
                    Terapkan
                </button>
            </form>
        </div>

        <div class="overflow-x-auto mt-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terakhir Login</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                    <tr>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                            <div>{{ $user->name }}</div>
                            <div class="text-xs text-gray-500">{{ $user->username ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            @php
                                $status = $user->status ?? 'pending';
                                $colors = [
                                    'active' => 'bg-green-100 text-green-800',
                                    'inactive' => 'bg-red-100 text-red-800',
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                ];
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $colors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ $user->roles->pluck('display_name')->implode(', ') ?: '-' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ optional($user->last_login_at)->diffForHumans() ?? 'Belum pernah' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-6 text-center text-sm text-gray-500">
                            Belum ada data user yang sesuai filter.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-100">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
