<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        $data = $request->except('banner_image');

        try {
            $bannerPath = $this->handleBannerUpload($request);
            if ($bannerPath) {
                $data['banner_image'] = $bannerPath;
            }
        } catch (\Throwable $e) {
            Log::error('Gagal mengunggah banner berita', [
                'error' => $e->getMessage(),
                'type' => get_class($e),
            ]);

            return back()
                ->withErrors(['banner_image' => 'Gagal mengunggah banner. Pastikan format file benar dan ulangi lagi.'])
                ->withInput();
        }

        // Set published_at if not provided but is_published is true
        if ($request->is_published && !$request->published_at) {
            $data['published_at'] = now();
        }

        // Set created_by to current admin
        $data['created_by'] = session('admin_email', 'Admin');

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        $data = $request->except('banner_image');

        try {
            $bannerPath = $this->handleBannerUpload($request, $news);
            if ($bannerPath !== $news->banner_image) {
                $data['banner_image'] = $bannerPath;
            }
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui banner berita', [
                'error' => $e->getMessage(),
                'type' => get_class($e),
                'news_id' => $news->id,
            ]);

            return back()
                ->withErrors(['banner_image' => 'Banner tidak dapat diperbarui. Silakan coba lagi.'])
                ->withInput();
        }

        // Set published_at if not provided but is_published is true
        if ($request->is_published && !$request->published_at) {
            $data['published_at'] = now();
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        // Delete banner image if exists
        if ($news->banner_image) {
            Storage::disk('public')->delete($news->banner_image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus!');
    }

    /**
     * Handle banner upload & cleanup.
     */
    private function handleBannerUpload(Request $request, ?News $news = null): ?string
    {
        if (!$request->hasFile('banner_image')) {
            return $news?->banner_image;
        }

        $isLinked = $this->ensurePublicDiskIsReady();

        $file = $request->file('banner_image');

        if ($news && $news->banner_image && Storage::disk('public')->exists($news->banner_image)) {
            Storage::disk('public')->delete($news->banner_image);
        }

        Storage::disk('public')->makeDirectory('news-banners');

        $storedPath = $file->store('news-banners', 'public');

        if (!$isLinked) {
            $this->mirrorFileToPublicDirectory($storedPath);
        }

        return $storedPath;
    }

    /**
     * Ensure public disk folders & symlink exist before storing files.
     */
    private function ensurePublicDiskIsReady(): bool
    {
        $publicDiskPath = storage_path('app/public');
        $linkPath = public_path('storage');

        if (!is_dir($publicDiskPath)) {
            mkdir($publicDiskPath, 0755, true);
        }

        if (!file_exists($linkPath)) {
            try {
                symlink($publicDiskPath, $linkPath);
            } catch (\Throwable $e) {
                Log::warning('Gagal membuat symbolic link storage -> public, menggunakan fallback direktori.', [
                    'error' => $e->getMessage(),
                ]);

                if (!is_dir($linkPath)) {
                    mkdir($linkPath, 0755, true);
                }
            }
        }

        return is_link($linkPath);
    }

    /**
     * When symbolic link is not available (e.g., Windows shared hosting),
     * copy the stored file into public/storage manually as a fallback.
     */
    private function mirrorFileToPublicDirectory(string $relativePath): void
    {
        $source = storage_path('app/public/' . $relativePath);
        $destination = public_path('storage/' . $relativePath);

        if (!is_file($source)) {
            return;
        }

        $destinationDir = dirname($destination);
        if (!is_dir($destinationDir)) {
            mkdir($destinationDir, 0755, true);
        }

        try {
            copy($source, $destination);
        } catch (\Throwable $e) {
            Log::warning('Gagal menyalin banner ke direktori publik fallback.', [
                'error' => $e->getMessage(),
                'relative_path' => $relativePath,
            ]);
        }
    }
}
