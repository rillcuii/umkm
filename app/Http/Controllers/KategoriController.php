<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::get();

        return view('dashboard.admin.kategori.index_kategori', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.kategori.tambah_kategori');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);
        return redirect()->route('admin.index.kategori')->with('success', 'kategori added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);

        return view('dashboard.admin.kategori.edit_kategori', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);
        return redirect()->route(('admin.index.kategori'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        //
    }
}
