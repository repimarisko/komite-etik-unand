@extends('layouts.app')

@section('title', 'Data Dosen')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Data Dosen SIPPMI</h1>
            <button onclick="refreshData()" class="bg-unand-600 hover:bg-unand-700 text-white px-4 py-2 rounded-lg transition-colors">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Refresh
            </button>
        </div>

        <!-- Search Box -->
        <div class="mb-6">
            <div class="relative">
                <input type="text" id="searchInput" placeholder="Cari dosen berdasarkan nama atau NIDN..." 
                       class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-unand-500 focus:border-unand-500">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>

        <!-- Status Display -->
        <div id="statusMessage" class="mb-4">
            @if($result['success'])
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ $result['message'] }}
                </div>
            @else
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ $result['message'] }}
                </div>
            @endif
        </div>

        <!-- Data Table -->
        <div id="dataContainer">
            @if($result['success'] && $result['data'])
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIDN</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fakultas</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program Studi</th>
                            </tr>
                        </thead>
                        <tbody id="dosenTableBody" class="bg-white divide-y divide-gray-200">
                            @foreach($result['data'] as $index => $dosen)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $dosen['nidn'] ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $dosen['nama'] ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $dosen['fakultas'] ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $dosen['prodi_name'] ?? ($dosen['prodi'] ?? '-') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4 text-sm text-gray-600">
                    Total: {{ count($result['data']) }} dosen
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data</h3>
                    <p class="mt-1 text-sm text-gray-500">Data dosen tidak dapat dimuat.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
let searchTimeout;

// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    clearTimeout(searchTimeout);
    const query = this.value;
    
    searchTimeout = setTimeout(() => {
        searchDosen(query);
    }, 500);
});

function searchDosen(query) {
    fetch(`/api/dosen/search?q=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(data => {
            updateTable(data);
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('Terjadi kesalahan saat mencari data', 'error');
        });
}

function refreshData() {
    document.getElementById('searchInput').value = '';
    
    fetch('/api/dosen')
        .then(response => response.json())
        .then(data => {
            updateTable(data);
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('Terjadi kesalahan saat memuat data', 'error');
        });
}

function updateTable(result) {
    const container = document.getElementById('dataContainer');
    
    if (result.success && result.data) {
        let tableHTML = `
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIDN</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fakultas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program Studi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
        `;
        
        result.data.forEach((dosen, index) => {
            tableHTML += `
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${index + 1}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${dosen.nidn || '-'}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${dosen.nama || '-'}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${dosen.fakultas || '-'}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${dosen.prodi_name || dosen.prodi || '-'}</td>
                </tr>
            `;
        });
        
        tableHTML += `
                    </tbody>
                </table>
            </div>
            <div class="mt-4 text-sm text-gray-600">
                Total: ${result.data.length} dosen
            </div>
        `;
        
        container.innerHTML = tableHTML;
    } else {
        container.innerHTML = `
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data</h3>
                <p class="mt-1 text-sm text-gray-500">${result.message || 'Data dosen tidak dapat dimuat.'}</p>
            </div>
        `;
    }
    
    showMessage(result.message, result.success ? 'success' : 'error');
}

function showMessage(message, type) {
    const statusDiv = document.getElementById('statusMessage');
    const className = type === 'success' ? 
        'bg-green-100 border border-green-400 text-green-700' : 
        'bg-red-100 border border-red-400 text-red-700';
    
    statusDiv.innerHTML = `
        <div class="${className} px-4 py-3 rounded">
            ${message}
        </div>
    `;
}
</script>
@endsection