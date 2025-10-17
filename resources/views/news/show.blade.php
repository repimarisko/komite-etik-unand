@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-unand-600 hover:text-unand-800">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Dashboard
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Judul Berita -->
        <div class="p-8 border-b border-gray-200">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">{{ $news->title }}</h1>
            <div class="mt-2 flex items-center text-gray-600">
                <span>{{ $news->formatted_published_date }}</span>
                <span class="mx-2">•</span>
                <span>{{ $news->created_by }}</span>
            </div>
        </div>
        
        <!-- Gambar Banner -->
        @if ($news->banner_image)
            <div class="w-full">
                <img src="{{ asset('storage/' . $news->banner_image) }}" 
                     alt="{{ $news->title }}" 
                     class="w-full object-cover max-h-[500px]">
            </div>
        @endif

        <!-- Konten Berita -->
        <div class="p-8">
            <div class="prose prose-lg max-w-none prose-p:my-4 prose-headings:mt-6 prose-headings:mb-4">
                {!! $news->content !!}
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tambahkan animasi atau efek lain jika diperlukan
    });
</script>
@endsection