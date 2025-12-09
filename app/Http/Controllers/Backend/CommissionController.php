<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data komisariat terbaru dengan relasi cabang, 10 per halaman
        $commission = Commission::with('branch')->orderBy('created_at', 'desc')->paginate(10);

        return view('Backend.Commission.index', compact('commission'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua cabang untuk dropdown
        $branches = Branch::orderBy('name')->get();

        return view('Backend.Commission.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'branch_id'       => 'required|exists:branches,id',
            'commission_name' => 'required|string|max:255',
            'university'      => 'required|string|max:255',
            'chairman'        => 'required|string|max:255',
            'contact'         => 'nullable|string|max:100',
        ]);

        // Simpan data
        Commission::create([
            'branch_id'       => $request->branch_id,
            'commission_name' => $request->commission_name,
            'university'      => $request->university,
            'chairman'        => $request->chairman,
            'contact'         => $request->contact,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('commission.index')
                        ->with('success', 'Komisariat berhasil ditambahkan.');
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
        // Ambil data komisariat berdasarkan ID
        $commission = Commission::findOrFail($id);

        // Ambil semua cabang untuk dropdown
        $branches = Branch::all();

        // Tampilkan view edit dengan data komisariat dan daftar cabang
        return view('Backend.Commission.edit', compact('commission', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         // Validasi input
        $request->validate([
            'branch_id'       => 'required|exists:branches,id',
            'commission_name' => 'required|string|max:255',
            'university'      => 'required|string|max:255',
            'chairman'        => 'required|string|max:255',
            'contact'         => 'nullable|string|max:100',
        ]);

        // Ambil data komisariat yang akan diupdate
        $commission = Commission::findOrFail($id);

        // Update data
        $commission->update([
            'branch_id'       => $request->branch_id,
            'commission_name' => $request->commission_name,
            'university'      => $request->university,
            'chairman'        => $request->chairman,
            'contact'         => $request->contact,
        ]);

        // Redirect kembali ke index dengan pesan sukses
        return redirect()->route('commission.index')->with('success', 'Data komisariat berhasil diperbarui.');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Ambil data komisariat berdasarkan ID
        $commission = Commission::findOrFail($id);

        // Hapus data komisariat
        $commission->delete();

        // Redirect ke index dengan pesan sukses
        return redirect()->route('commission.index')->with('success', 'Data komisariat berhasil dihapus.');
        
    }
}
