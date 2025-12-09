<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branch=Branch::latest()->paginate(10);
        // Kirimkan ke view
        return view('Backend.Branch.index', compact('branch'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.Branch.create');
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
            'regency'   => 'required|string|max:255',
            'chairman'  => 'required|string|max:255',
            'year'      => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'contact'   => 'nullable|string|max:255',
        ]);

        // Simpan data
        Branch::create([
            'name'      => $request->name,
            'regency'   => $request->regency,
            'chairman'  => $request->chairman,
            'year'      => $request->year,
            'contact'   => $request->contact,
        ]);

        // Redirect ke index dengan flash message
        return redirect()->route('branch.index')
            ->with('success', 'Cabang berhasil ditambahkan');

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
        $branch = Branch::findOrFail($id);

        return view('Backend.Branch.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi
        $request->validate([
            'name'      => 'required|string|max:255',
            'regency'   => 'required|string|max:255',
            'chairman'  => 'required|string|max:255',
            'year'      => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'contact'   => 'nullable|string|max:255',
        ]);

        // Ambil data event
        $branch = Branch::findOrFail($id);     
        
        
        
        
         // Update data
        $branch->update([
            'name'      => $request->name,
            'regency'   => $request->regency,
            'chairman'  => $request->chairman,
            'year'      => $request->year,
            'contact'   => $request->contact,
        ]);

        return redirect()->route('branch.index')->with('success', 'Cabang berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $branch = Branch::findOrFail($id);

        // Hapus data dari database
        $branch->delete();

        return redirect()->route('branch.index')->with('success', 'Cabang berhasil dihapus!');
    }
}
