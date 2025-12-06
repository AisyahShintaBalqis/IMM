<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page=Page::latest()->paginate(10);
        // Kirimkan ke view
            return view('Backend.Page.index', compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.Page.create');
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
            $thumbnailPath = $request->file('thumbnail')->store('page', 'public');
        }

        // Simpan ke database
        Page::create([
            'title'     => $request->title,
            'slug'      => $slug,
            'content'   => $request->content,
            'thumbnail' => $thumbnailPath,
            'status'    => $request->status,
        ]);

        return redirect()->route('page.index')->with('success', 'Berita berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $page = Page::findOrFail($id);

        return view('Backend.page.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page = Page::findOrFail($id);

        return view('Backend.Page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $page = Page::findOrFail($id);

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
        $thumbnailPath = $page->thumbnail;

        if ($request->hasFile('thumbnail')) {

            // Hapus file lama kalau ada
            if ($page->thumbnail && file_exists(storage_path('app/public/' . $page->thumbnail))) {
                unlink(storage_path('app/public/' . $page->thumbnail));
            }

        // Upload file baru
        $thumbnailPath = $request->file('thumbnail')->store('page', 'public');

        }

        // Update data
        $page->update([
            'title'     => $request->title,
            'slug'      => $slug,
            'content'   => $request->content,
            'thumbnail' => $thumbnailPath,
            'status'    => $request->status,
        ]);

    return redirect()->route('page.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $page = Page::findOrFail($id);

        // Hapus thumbnail jika ada
        if ($page->thumbnail && file_exists(storage_path('app/public/' . $page->thumbnail))) {
            unlink(storage_path('app/public/' . $page->thumbnail));
        }

        // Hapus data dari database
        $page->delete();

        return redirect()->route('page.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
