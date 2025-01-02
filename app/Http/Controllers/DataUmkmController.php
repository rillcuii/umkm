<?php

namespace App\Http\Controllers;

use App\Models\Produk;
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
        $umkm = PemilikUmkm::findOrFail($id_umkm);

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
