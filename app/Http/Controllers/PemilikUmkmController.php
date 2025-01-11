<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Regency;
use App\Models\Village;
use App\Models\District;
use App\Models\Kategori;
use App\Models\Province;
use App\Models\PemilikUmkm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PemilikUmkmController extends Controller
{
    public function showRegisterForm()
    {
        $produk = Produk::all();
        $provinces = Province::all();
        $kategori = Kategori::all();
    
        return view('register_umkm', compact('produk', 'provinces', 'kategori'));
    }

    public function getkabupaten(request $request)
    {
        $id_provinsi = $request->id_provinsi;

        $kabupatens = Regency::where('province_id', $id_provinsi)->get();

        $option = "<option>Pilih Kabupaten...</option>";

        foreach ($kabupatens as $kabupaten) {
            $option .= "<option value= '$kabupaten->id'>$kabupaten->name</option>";
        }

        echo $option;
    }

    public function getkecamatan(request $request)
    {
        $id_kabupaten = $request->id_kabupaten;

        $kecamatans = District::where('regency_id', $id_kabupaten)->get();

        $option = "<option>Pilih Kecamatan...</option>";

        foreach ($kecamatans as $kecamatan) {
            $option .= "<option value= '$kecamatan->id'>$kecamatan->name</option>";
        }
        echo $option;
    }

    public function getdesa(request $request)
    {
        $id_kecamatan = $request->id_kecamatan;

        $desas = Village::where('district_id', $id_kecamatan)->get();

        $option = "<option>Pilih Desa...</option>";

        foreach ($desas as $desa) {
            $option .= "<option value= '$desa->id'>$desa->name</option>";
        }
        echo $option;
    }


    public function register(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|email',
            'username' => 'required|string|max:10',
            'nama_lengkap' => 'required|string|max:25',
            'nama_umkm' => 'required|string|max:25',
            'foto_profil' => 'required|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_umkm' => 'required|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'usia' => 'required|integer',
            'status_kepemilikan' => 'required|in:individu,kelompok,lainnya',
            'id_kategori' => 'required',
            // 'id_produk' => 'nullable',
            'nomer_handphone' => 'required',
            'alamat_pemilik' => 'required',
            'provinsi' => 'required',
            'kabupaten_kota' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'kode_pos' => 'required|integer',
            // 'status' => 'nullable',
            'password' => 'required|string|min:8',
        ]);

        if (!Storage::exists('public/foto_profil')) {
            Storage::makeDirectory('public/foto_profil');
        }

        if ($request->hasFile('foto_profil')) {
            $foto = $request->file('foto_profil');
            $filename = date('YmdHis') . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('public/foto_profil', $filename);
            $validated['foto_profil'] = $filename;
        }

        if (!Storage::exists('public/foto_umkm')) {
            Storage::makeDirectory('public/foto_umkm');
        }

        if ($request->hasFile('foto_umkm')) {
            $fotoUmkm = $request->file('foto_umkm');
            $filenameUmkm = date('YmdHis') . '.' . $fotoUmkm->getClientOriginalExtension();
            $fotoUmkm->storeAs('public/foto_umkm', $filenameUmkm);
            $validated['foto_umkm'] = $filenameUmkm;
        }

        $validated['password'] = bcrypt($validated['password']);

        $validated['id_produk'] = $validated['id_produk'] ?? null;

        $validated['status'] = $validated['status'] ?? 'on';

        PemilikUmkm::create($validated);

        return redirect()->route('umkm.dashboard')->with('success', 'UMKM berhasil terdaftar!');
    }
}
