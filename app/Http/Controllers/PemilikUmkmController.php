<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Regency;
use App\Models\Village;
use App\Models\District;
use App\Models\Province;
use App\Models\PemilikUmkm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PemilikUmkmController extends Controller
{
    public function showRegisterForm()
    {
        $produk = Produk::all();
        $provinces = Province::all();
        // $regencies = Regency::all();
        // $districts = District::all();
        // $villages = Village::all();

        // dd($produk, $provinces, $regencies, $districts, $villages);
        return view('register_umkm', compact('produk', 'provinces'));
    }

    public function getkabupaten(request $request) 
    {
        $id_provinsi = $request->id_provinsi;

        $kabupatens = Regency::where('province_id', $id_provinsi)->get();

        $option = "<option>Pilih Kabupaten...</option>";

        foreach($kabupatens as $kabupaten){
            $option .= "<option value= '$kabupaten->id'>$kabupaten->name</option>";
        }

        echo $option;
    }

    public function getkecamatan(request $request) 
    {
        $id_kabupaten = $request->id_kabupaten;

        $kecamatans = District::where('regency_id', $id_kabupaten)->get();

        $option = "<option>Pilih Kecamatan...</option>";

        foreach($kecamatans as $kecamatan){
            $option .= "<option value= '$kecamatan->id'>$kecamatan->name</option>";

        }
        echo $option;
    }

    public function getdesa(request $request) 
    {
        $id_kecamatan = $request->id_kecamatan;

        $desas = Village::where('district_id', $id_kecamatan)->get();

        $option = "<option>Pilih Desa...</option>";

        foreach($desas as $desa){
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
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'usia' => 'required|integer',
            'status_kepemilikan' => 'required|in:individu,kelompok,lainnya',
            'id_produk' => 'nullable',
            'nomer_handphone' => 'required',
            'alamat_pemilik' => 'required',
            'provinsi' => 'required',
            'kabupaten_kota' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'kode_pos' => 'required|integer',
            'password' => 'required|string|min:8',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $validated['id_produk'] = $validated['id_produk'] ?? null;

        PemilikUmkm::create($validated);

        return redirect()->route('umkm.dashboard')->with('success', 'UMKM berhasil terdaftar!');
    }
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PemilikUmkm $pemilikUmkm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PemilikUmkm $pemilikUmkm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PemilikUmkm $pemilikUmkm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PemilikUmkm $pemilikUmkm)
    {
        //
    }
}
