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
        //
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
            $photoName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/members'), $photoName);

        }

        // Simpan ke database
    Member::create([
        'name'      => $request->name,
        'position'  => $request->position,
        'division'  => $request->division,
        'photo'     => $photoName,
        'order'     => $request->order ?? 1,
    ]);

    return redirect()->route('member.create')->with('success', 'Pengurus berhasil ditambahkan');

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
