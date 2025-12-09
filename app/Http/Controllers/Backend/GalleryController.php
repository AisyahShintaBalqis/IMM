<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Nette\Utils\Image;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gallery=Gallery::latest()->paginate(10);

         // Kirimkan ke view
        return view('Backend.Gallery.index', compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.Gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('galleries', 'public');
        }

        Gallery::create([
            'title' => $request->title,
            'image' => $imageName,
        ]);

        return redirect()->route('galeri.index')->with('success', 'Gallery berhasil ditambahkan');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gallery = Gallery::findOrFail($id);

        return view('Backend.Gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageName = $gallery->image;

        if ($request->hasFile('image')) {

            // Hapus file lama
            if ($gallery->image && file_exists(storage_path('app/public/galleries' . $gallery->image))) {
                unlink(storage_path('app/public/' . $gallery->image));
            }

            // Upload file baru ke storage/app/public/members
            $imageName = $request->file('image')->store('galleries', 'public');
        }

        // Update data
        $gallery->update([
            'title' => $request->title,
            'image' => $imageName,
        ]);

        return redirect()->route('galeri.index')
            ->with('success', 'Data Galeri berhasil diperbarui!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gallery = Gallery::findOrFail($id);

        // Hapus thumbnail jika ada
        if ($gallery->photo && file_exists(storage_path('app/public/' . $gallery->image))) {
            unlink(storage_path('app/public/' . $gallery->image));
        }

        // Hapus data dari database
        $gallery->delete();

        return redirect()->route('galeri.index')->with('success', 'Gambar berhasil dihapus!');
    }
}
