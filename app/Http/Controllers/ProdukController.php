<?php

namespace App\Http\Controllers;

use App\Models\PemilikUmkm;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemilikUmkm $id_umkm) //buat nampilin data all
    {
        $produk = Produk::where('id_umkm', $id_umkm->id_umkm)->get();

        return view('dashboard.umkm.produk.index_produk', compact('produk', 'id_umkm'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id_umkm) //arahin ke halaman tambah data
    {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id_umkm)
    {
        $request->validate([
            'nama_produk' => 'required',
            'stok'        => 'required|numeric',
            'foto_produk' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'harga'       => 'required|numeric',
        ]);

        if ($request->hasFile('foto_produk')) {
            $foto = $request->file('foto_produk');
            $filename = date('YmdHis') . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('public/produk', $filename);
        }

        Produk::create([
            'id_umkm'     => $id_umkm,
            'nama_produk' => $request->nama_produk,
            'stok'        => $request->stok,
            'foto_produk' => $filename ?? null,
            'harga'       => $request->harga,
            'status'      => 'off',
        ]);

        return redirect()->route('umkm.index.produk',  ['id_umkm' => $id_umkm])->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $id_produk) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_produk, $id_umkm) //buat arahin ke halaman edit
    {

        $produk = Produk::where('id_umkm', $id_umkm)
            ->where('id_produk', $id_produk)
            ->firstOrFail();

        return view('dashboard.umkm.produk.edit_produk', compact('produk', 'id_umkm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_produk, $id_umkm)
    {
        // Validasi data inputan
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);


        // Cari produk berdasarkan ID UMKM dan ID Produk
        $produk = Produk::where('id_umkm', $id_umkm)
            ->where('id_produk', $id_produk)
            ->first();

        // Cek apakah produk ditemukan
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan!');
        }


        // Update data produk
        $produk->nama_produk = $request->nama_produk;
        $produk->stok = $request->stok;
        $produk->harga = $request->harga;

        // Jika ada foto baru, hapus foto lama dan upload yang baru
        if ($request->hasFile('foto_produk')) {
            // dd untuk memeriksa file yang diupload

            if ($produk->foto_produk && Storage::exists('public/produk/' . $produk->foto_produk)) {
                Storage::delete('public/produk/' . $produk->foto_produk);
            }

            // Simpan foto baru dan set pathnya
            $fotoPath = $request->file('foto_produk')->store('public/produk');
            $produk->foto_produk = basename($fotoPath);
        }


        // Save the changes to the database
        $produk->save();

        // Redirect kembali ke halaman produk UMKM dengan pesan sukses
        return redirect()->route('umkm.index.produk', ['id_umkm' => $id_umkm])
            ->with('success', 'Produk berhasil diperbarui!');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $id_produk) //buat hapus data
    {}

    public function updateStatus(Request $request)
    {

        // Ambil produk berdasarkan ID
        $produk = Produk::findOrFail($request->id_produk);

        // Periksa apakah status dikirim dengan benar
        $produk->status = $request->status == 'on' ? 'on' : 'off';
        $produk->save();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }
}
