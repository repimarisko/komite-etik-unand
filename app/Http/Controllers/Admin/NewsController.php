<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
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

        $data = $request->all();
        
        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = $request->file('banner_image')->store('news-banners', 'public');
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

        $data = $request->all();
        
        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            // Delete old image if exists
            if ($news->banner_image) {
                Storage::disk('public')->delete($news->banner_image);
            }
            $data['banner_image'] = $request->file('banner_image')->store('news-banners', 'public');
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
}
