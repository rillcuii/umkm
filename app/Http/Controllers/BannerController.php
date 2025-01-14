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
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
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
    public function edit(string $id_banner)
    {
        $banner = Banner::findOrFail($id_banner);

        return view('dashboard.admin.banner.edit_banner', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id_banner)
    {
        // Validasi input
        $request->validate([
            'nama_banner' => 'required|string|max:255',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $banner = Banner::findOrFail($id_banner);

        if ($request->hasFile('banner') && $request->file('banner')->isValid()) {
            $foto = $request->file('banner');
            $extension = $foto->getClientOriginalExtension();
            $filename = date('YmdHis') . '.' . $extension;

            $foto->storeAs('public/banner', $filename);

            $banner->update([
                'nama_banner' => $request->nama_banner,
                'link' =>  $filename,
            ]);
        } else {
            $banner->update([
                'nama_banner' => $request->nama_banner,
            ]);
        }

        return redirect()->route('admin.index.banner')->with('success', 'Banner berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $id_banner)
    {
        $id_banner->delete();

        return redirect()->route('admin.index.banner')->with('success', 'Banner berhasil dihapus.');
    }

    public function updateStatus(Request $request)
    {

        $banner = Banner::findOrFail($request->id_banner);

        $banner->status = $request->status == 'on' ? 'on' : 'off';
        $banner->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }
}
