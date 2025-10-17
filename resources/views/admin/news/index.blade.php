@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 fill-current">Kelola Berita</h1>
                <p class="text-gray-600 mt-1 fill-current">Kelola berita dan pengumuman untuk dashboard</p>
            </div>
            <a href="{{ route('admin.news.create') }}" class="inline-flex items-center px-4 py-2 bg-white text-unand-600 border border-unand-600 font-semibold rounded-lg hover:bg-unand-50 transition-colors duration-200 shadow-lg">
                <svg class="w-5 h-5 mr-2 fill-current" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Berita
            </a>
        </div>
        <!-- News List -->
        @if($news->count() > 0)
        <div class="grid gap-4">
            @foreach($news as $item)
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-start justify-between">
                    <div class="flex-1 flex">
                        <!-- Preview Gambar -->
                        <div class="mr-4 flex-shrink-0">
                            @if($item->banner_image)
                                <div class="w-24 h-24 rounded-lg overflow-hidden bg-cover bg-center border border-gray-200" style="background-image: url('{{ asset('storage/' . $item->banner_image) }}')"></div>
                            @else
                                <div class="w-24 h-24 rounded-lg overflow-hidden bg-gray-200 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <!-- Konten Berita -->
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $item->title }}</h3>
                                @if($item->is_featured)
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">UTAMA</span>
                                @endif
                                @if($item->is_published)
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">PUBLISHED</span>
                                @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs font-semibold rounded-full">DRAFT</span>
                                @endif
                            </div>
                            <p class="text-gray-600 mb-3">{{ $item->getExcerptAttribute(150) }}</p>
                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                <span>Dibuat: {{ $item->created_at->format('d M Y H:i') }}</span>
                                @if($item->published_at)
                                <span>Dipublikasikan: {{ $item->formatted_published_date }}</span>
                                @endif
                                <span>Oleh: {{ $item->created_by }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 ml-4">
                        <a href="{{ route('admin.news.edit', $item) }}" class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $news->links() }}
        </div>
        @else
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-800 mb-2">Belum ada berita</h3>
            <p class="text-gray-600 mb-4">Mulai dengan membuat berita pertama Anda</p>
            <a href="{{ route('admin.news.create') }}" class="inline-flex items-center px-4 py-2 bg-unand-600 text-white font-semibold rounded-lg hover:bg-unand-700 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Berita
            </a>
        </div>
        @endif
    </div>
</div>
@endsection