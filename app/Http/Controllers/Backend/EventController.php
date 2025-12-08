<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $event=Event::latest()->paginate(10);
        // Kirimkan ke view
        return view('Backend.Event.index', compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.Event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        // Validasi input
        $request->validate([
            'title'       => 'required|string|max:255',            
            'event_date'  => 'required|date',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'content'     => 'required',
            'location'    => 'nullable|string|max:255',
            'status'      => 'required|in:draft,published',           
        ]);

        // Generate slug otomatis
        $slug = Str::slug($request->title) . '-' . time();

        //  Upload gambar jika ada
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            // Menyimpan file ke storage/app/public/events
            $thumbnailPath = $request->file('thumbnail')->store('events', 'public');
        }

        //  Simpan ke database
        Event::create([
            'title'       => $request->title,
            'slug'        => $slug,
            'event_date'  => $request->event_date,
            'location'    => $request->location,
            'thumbnail'   => $thumbnailPath,
            'content'     => $request->content,
            'status'      => $request->status,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('event.index')
                        ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::findOrFail($id);

        return view('Backend.event.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);

        return view('Backend.Event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi
        $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'content' => 'required',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Ambil data event
        $event = Event::findOrFail($id);

        $slug = Str::slug($request->title);       
        
        
        // Simpan path foto lama jika tidak diganti
        $thumbnailPath = $event->thumbnail;

        // Jika ada upload foto baru
        if ($request->hasFile('thumbnail')) {

            // Hapus foto lama kalau ada
            if ($event->photo && file_exists(storage_path('app/public/events/' . $event->thumbnail))) {
                unlink(storage_path('app/public/events/' . $event->thumbnail));
            }

            // Upload file baru ke storage/app/public/members
            $thumbnailPath = $request->file('thumbnail')->store('events', 'public');
        }
        
         // Update data
        $event->update([
            'title'       => $request->title,
            'slug'        => $slug,
            'event_date'  => $request->event_date,
            'location'    => $request->location,
            'thumbnail'   => $thumbnailPath,
            'content'     => $request->content,
            'status'      => $request->status,
        ]);

        return redirect()->route('event.index')->with('success', 'Kegiatan berhasil diperbarui!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);

        // Hapus thumbnail jika ada
        if ($event->thumbnail && file_exists(storage_path('app/public/' . $event->thumbnail))) {
            unlink(storage_path('app/public/' . $event->thumbnail));
        }

        // Hapus data dari database
        $event->delete();

        return redirect()->route('event.index')->with('success', 'Kegiatan berhasil dihapus!');
    }
}
