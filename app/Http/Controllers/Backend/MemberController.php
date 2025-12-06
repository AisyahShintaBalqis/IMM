<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $member=Member::latest()->paginate(10);

         // Kirimkan ke view
            return view('Backend.Member.index', compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.Member.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        // Validasi input
        $request->validate([
            'name'      => 'required|string|max:255',
            'position'  => 'required|string|max:255',
            'division'  => 'required|string|max:255',
            'photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'order'     => 'nullable|integer|min:1'
        ]);

        // Upload foto jika ada
        $photoName = null;

        if ($request->hasFile('photo')) {
            $photoName = $request->file('photo')->store('members', 'public');
        }

        

        // Simpan ke database
    Member::create([
        'name'      => $request->name,
        'position'  => $request->position,
        'division'  => $request->division,
        'photo'     => $photoName,
        'order'     => $request->order ?? 1,
    ]);

    return redirect()->route('member.index')->with('success', 'Pengurus berhasil ditambahkan');

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
        $member = Member::findOrFail($id);

        return view('Backend.Member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $member = Member::findOrFail($id);

        // Validasi
        $request->validate([
            'name'      => 'required|string|max:255',
            'position'  => 'required|string|max:255',
            'division'  => 'required|string|max:255',
            'order'     => 'nullable|integer',
            'status'    => 'required|in:active,inactive',
            'photo'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Simpan path foto lama jika tidak diganti
        $photoPath = $member->photo;

        // Jika ada upload foto baru
        if ($request->hasFile('photo')) {

            // Hapus foto lama kalau ada
            if ($member->photo && file_exists(storage_path('app/public/members/' . $member->photo))) {
                unlink(storage_path('app/public/members/' . $member->photo));
            }

            // Upload file baru ke storage/app/public/members
            $photoPath = $request->file('photo')->store('members', 'public');
        }

        // Update data
        $member->update([
            'name'      => $request->name,
            'position'  => $request->position,
            'division'  => $request->division,
            'order'     => $request->order,
            'status'    => $request->status,
            'photo'     => $photoPath,
        ]);

        return redirect()->route('member.index')
            ->with('success', 'Data member berhasil diperbarui!');

        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = Member::findOrFail($id);

        // Hapus thumbnail jika ada
        if ($member->photo && file_exists(storage_path('app/public/' . $member->photo))) {
            unlink(storage_path('app/public/' . $member->photo));
        }

        // Hapus data dari database
        $member->delete();

        return redirect()->route('member.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
