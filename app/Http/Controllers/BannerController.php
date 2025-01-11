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
        $request->validate([
            'nama_banner' => 'required|string|max:255',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('banner') && $request->file('banner')->isValid()) {
            $foto = $request->file('banner');

            $extension = $foto->getClientOriginalExtension();

            $filename = date('YmdHis') . '.' . $extension;

            $foto->storeAs('public/banner', $filename);

            Banner::create([
                'nama_banner' => $request->nama_banner,
                'link' => $filename,  
                'status' => 'off',    
            ]);
            return redirect()->route('admin.index.banner')->with('success', 'Banner added successfully!');
        }
        return back()->with('error', 'Image upload failed or file is not valid!');
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

    public function updateStatus(Request $request)
    {

        // Ambil banner berdasarkan ID
        $banner = Banner::findOrFail($request->id_banner);

        // Periksa apakah status dikirim dengan benar
        $banner->status = $request->status == 'on' ? 'on' : 'off';
        $banner->save();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }
}
