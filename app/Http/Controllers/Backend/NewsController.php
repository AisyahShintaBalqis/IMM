<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news=News::latest()->paginate(10);

         // Kirimkan ke view
            return view('Backend.News.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.News.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());

        // Validasi input
        $request->validate([
            'title'     => 'required|string|max:255',
            'content'   => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'    => 'required|in:draft,published',
        ]);

        // Generate slug otomatis
        $slug = Str::slug($request->title);

        // Handle upload thumbnail
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('news', 'public');
        }

        // Simpan ke database
        News::create([
            'title'     => $request->title,
            'slug'      => $slug,
            'content'   => $request->content,
            'thumbnail' => $thumbnailPath,
            'status'    => $request->status,
        ]);

        return redirect()->route('news.index')->with('success', 'Berita berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News::findOrFail($id);

        return view('Backend.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $news = News::findOrFail($id);

        return view('Backend.News.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $news = News::findOrFail($id);

        // Validasi
        $request->validate([
            'title'     => 'required|string|max:255',
            'content'   => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'    => 'required|in:draft,published',
        ]);

        // Generate slug baru
        $slug = Str::slug($request->title);

        // Handle upload thumbnail baru
        $thumbnailPath = $news->thumbnail;

        if ($request->hasFile('thumbnail')) {

            // Hapus file lama kalau ada
            if ($news->thumbnail && file_exists(storage_path('app/public/' . $news->thumbnail))) {
                unlink(storage_path('app/public/' . $news->thumbnail));
            }

        // Upload file baru
        $thumbnailPath = $request->file('thumbnail')->store('news', 'public');

        }

        // Update data
        $news->update([
            'title'     => $request->title,
            'slug'      => $slug,
            'content'   => $request->content,
            'thumbnail' => $thumbnailPath,
            'status'    => $request->status,
        ]);

    return redirect()->route('news.index')->with('success', 'Artikel berhasil diperbarui!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::findOrFail($id);

        // Hapus thumbnail jika ada
        if ($news->thumbnail && file_exists(storage_path('app/public/' . $news->thumbnail))) {
            unlink(storage_path('app/public/' . $news->thumbnail));
        }

        // Hapus data dari database
        $news->delete();

        return redirect()->route('news.index')->with('success', 'Pengurus berhasil dihapus!');

    }
}
