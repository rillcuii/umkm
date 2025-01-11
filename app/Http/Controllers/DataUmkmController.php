<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Province;
use App\Models\Transaksi;
use App\Models\PemilikUmkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataUmkmController extends Controller
{
    public function index()
    {
        $umkm = PemilikUmkm::get();

        return view('dashboard.admin.data_umkm.index_umkm', compact('umkm'));
    }

    public function detail(string $id_umkm)
    {
        $umkm = DB::table('pemilik_umkm')
            ->join('provinces', function ($join) {
                $join->on(DB::raw('pemilik_umkm.provinsi COLLATE utf8mb4_unicode_ci'), '=', DB::raw('provinces.id COLLATE utf8mb4_unicode_ci'));
            })
            ->join('regencies', function ($join) {
                $join->on(DB::raw('pemilik_umkm.kabupaten_kota COLLATE utf8mb4_unicode_ci'), '=', DB::raw('regencies.id COLLATE utf8mb4_unicode_ci'));
            })
            ->join('districts', function ($join) {
                $join->on(DB::raw('pemilik_umkm.kecamatan COLLATE utf8mb4_unicode_ci'), '=', DB::raw('districts.id COLLATE utf8mb4_unicode_ci'));
            })
            ->join('villages', function ($join) {
                $join->on(DB::raw('pemilik_umkm.kelurahan COLLATE utf8mb4_unicode_ci'), '=', DB::raw('villages.id COLLATE utf8mb4_unicode_ci'));
            })
            ->join('kategori', 'pemilik_umkm.id_kategori', '=', 'kategori.id_kategori') // Join ke tabel kategori
            ->select(
                'pemilik_umkm.*',
                'provinces.name as provinsi_name',
                'regencies.name as kabupaten_kota_name',
                'districts.name as kecamatan_name',
                'villages.name as kelurahan_name',
                'kategori.nama_kategori' // Ambil nama_kategori dari tabel kategori
            )
            ->where('pemilik_umkm.id_umkm', $id_umkm)
            ->first();

        return view('dashboard.admin.data_umkm.detail_umkm', compact('umkm'));
    }

    public function delete(string $id_umkm)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Cari UMKM berdasarkan id_umkm
        $umkm = PemilikUmkm::findOrFail($id_umkm);

        // Hapus transaksi yang terkait dengan UMKM (jika ada)
        $umkm->transaksi()->delete();  // Menggunakan relasi untuk menghapus transaksi

        // Hapus UMKM itu sendiri
        $umkm->delete();

        // Aktifkan kembali pengecekan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Kembali ke halaman index UMKM
        return redirect()->route('admin.index.umkm');
    }
}
