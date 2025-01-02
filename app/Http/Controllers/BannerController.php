<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banner = Banner::get();

        return view('dashboard.admin.banner.index_banner', compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.banner.tambah_banner');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Banner::create([
            'nama_banner' => $request->nama_banner,
            'link' => $request->link,
            'status' => 'off',
        ]);
        return redirect()->route('admin.index.banner');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $id_banner)
    {
        // Menghapus banner berdasarkan instance yang diterima
        $id_banner->delete();

        // Redirect setelah penghapusan dengan pesan sukses
        return redirect()->route('admin.index.banner')->with('success', 'Banner berhasil dihapus.');
    }
}
