<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Regency;
use App\Models\Village;
use App\Models\District;
use App\Models\Province;
use App\Models\Transaksi;
use App\Models\PemilikUmkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_umkm = auth()->user()->id_umkm;
        $transaksi = Transaksi::with('user')
            ->where('id_umkm', $id_umkm)
            ->get();

        return view('dashboard.umkm.transaksi.index_transaksi', compact('transaksi', 'id_umkm'));
    }

    public function detail($id_umkm, $id_transaksi)
    {
        $transaksi = Transaksi::join('provinces', function ($join) {
            $join->on(DB::raw('transaksi.provinsi COLLATE utf8mb4_unicode_ci'), '=', DB::raw('provinces.id COLLATE utf8mb4_unicode_ci'));
        })
            ->join('regencies', function ($join) {
                $join->on(DB::raw('transaksi.kabupaten_kota COLLATE utf8mb4_unicode_ci'), '=', DB::raw('regencies.id COLLATE utf8mb4_unicode_ci'));
            })
            ->join('districts', function ($join) {
                $join->on(DB::raw('transaksi.kecamatan COLLATE utf8mb4_unicode_ci'), '=', DB::raw('districts.id COLLATE utf8mb4_unicode_ci'));
            })
            ->join('villages', function ($join) {
                $join->on(DB::raw('transaksi.kelurahan COLLATE utf8mb4_unicode_ci'), '=', DB::raw('villages.id COLLATE utf8mb4_unicode_ci'));
            })
            ->select(
                'transaksi.id_transaksi',
                'transaksi.*',
                'provinces.name as provinsi_name',
                'regencies.name as kabupaten_kota_name',
                'districts.name as kecamatan_name',
                'villages.name as kelurahan_name'
            )
            ->where('transaksi.id_umkm', $id_umkm) 
            ->where('transaksi.id_transaksi', $id_transaksi) 
            ->first();


        return view('dashboard.umkm.transaksi.detail_transaksi', compact('transaksi', 'id_umkm'));
    }


    /**
     * Show the form for creating a new resource.
     */
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

    public function create($id_umkm, $id_produk)
    {
        $provinces = Province::all();
        $umkm = PemilikUmkm::findOrFail($id_umkm);
        $produk = Produk::findOrFail($id_produk);

        return view('dashboard.pelanggan.transaksi.tambah_transaksi', compact('umkm', 'produk', 'provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        // $userId = auth()->user()->id;
        // dd($userId);

        $request->validate([
            'nama_lengkap' => 'required|string',
            'nomor_telepon' => 'required|string',
            'email' => 'required|email',
            'jumlah' => 'required|integer|min:1',
            'alamat' => 'required|string',
            'provinsi' => 'required|string',
            'kabupaten_kota' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
        ]);

        Transaksi::create([
            'id_user' => auth()->user()->id_user,
            'id_umkm' => $request->id_umkm,
            'id_produk' => $request->id_produk,
            'nama_lengkap' => $request->nama_lengkap,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'jumlah' => $request->jumlah,
            'alamat' => $request->alamat,
            'provinsi' => $request->provinsi,
            'kabupaten_kota' => $request->kabupaten_kota,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'status' => 'diproses',
        ]);

        $produk = Produk::findOrFail($request->id_produk);
        $produk->stok = $produk->stok - $request->jumlah;
        $produk->save();

        // dd($request->all());

        return redirect()->route('index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function history()
    {
        $transaksis = Transaksi::where('id_user', auth()->user()->id_user)->get();

        return view('dashboard.pelanggan.transaksi.history_transaksi', compact('transaksis'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
