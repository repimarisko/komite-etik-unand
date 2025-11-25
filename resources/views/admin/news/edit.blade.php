@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <!-- Header -->
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.news.index') }}" class="inline-flex items-center text-unand-600 hover:text-unand-800 mr-4">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Edit Berita</h1>
                <p class="text-gray-600 mt-1">Edit berita: {{ $news->title }}</p>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Berita</label>
                <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-unand-500 focus:border-unand-500 transition-colors duration-200" 
                       placeholder="Masukkan judul berita..." required>
                @error('title')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Current Banner -->
            @if($news->banner_image)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Banner Saat Ini</label>
                <div class="mb-4">
                    <img src="{{ $news->banner_image_url }}" alt="Current banner" class="h-32 w-auto rounded-lg shadow-md">
                </div>
            </div>
            @endif

            <!-- Banner Image -->
            <div>
                <label for="banner_image" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $news->banner_image ? 'Ganti Banner Gambar (Opsional)' : 'Banner Gambar (Opsional)' }}
                </label>
                <div class="flex items-center justify-center w-full">
                    <label for="banner_image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6" id="upload-placeholder">
                            <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 2MB</p>
                        </div>
                        <div id="image-preview" class="hidden w-full h-full relative">
                            <img id="preview-image" src="#" alt="Preview" class="w-full h-full object-contain rounded-lg">
                            <button type="button" id="remove-image" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <input id="banner_image" name="banner_image" type="file" class="hidden" accept="image/*">
                    </label>
                </div>
                @error('banner_image')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Isi Berita</label>
                <textarea name="content" id="content" rows="8" 
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-unand-500 focus:border-unand-500 transition-colors duration-200" 
                          placeholder="Tulis isi berita di sini..." required>{{ old('content', $news->content) }}</textarea>
                @error('content')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Options -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Published Date -->
                <div>
                    <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Publikasi</label>
                    <input type="datetime-local" name="published_at" id="published_at" 
                           value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-unand-500 focus:border-unand-500 transition-colors duration-200">
                    <p class="text-xs text-gray-500 mt-1">Kosongkan untuk menggunakan waktu sekarang</p>
                    @error('published_at')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Options -->
                <div class="space-y-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_published" id="is_published" value="1" 
                               {{ old('is_published', $news->is_published) ? 'checked' : '' }}
                               class="h-4 w-4 text-unand-600 focus:ring-unand-500 border-gray-300 rounded">
                        <label for="is_published" class="ml-2 block text-sm text-gray-700">
                            Publikasikan berita
                        </label>
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" 
                               {{ old('is_featured', $news->is_featured) ? 'checked' : '' }}
                               class="h-4 w-4 text-unand-600 focus:ring-unand-500 border-gray-300 rounded">
                        <label for="is_featured" class="ml-2 block text-sm text-gray-700">
                            Jadikan berita utama
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
          <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-white text-unand-600 border border-unand-600 font-semibold rounded-lg hover:bg-unand-50 transition-colors duration-200 shadow-lg">
                    <svg class="w-5 h-5 mr-2 fill-current" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Berita
                </button>
                <a href="{{ route('admin.news.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition-colors duration-200">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const bannerInput = document.getElementById('banner_image');
    const previewContainer = document.getElementById('image-preview');
    const previewImage = document.getElementById('preview-image');
    const uploadPlaceholder = document.getElementById('upload-placeholder');
    const removeButton = document.getElementById('remove-image');

    bannerInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                uploadPlaceholder.classList.add('hidden');
                previewContainer.classList.remove('hidden');
            }
            
            reader.readAsDataURL(file);
        }
    });

    removeButton.addEventListener('click', function(e) {
        e.preventDefault();
        bannerInput.value = '';
        previewImage.src = '#';
        previewContainer.classList.add('hidden');
        uploadPlaceholder.classList.remove('hidden');
    });
});
</script>
@endsection
