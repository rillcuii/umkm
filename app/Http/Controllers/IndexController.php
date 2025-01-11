<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Produk;
use App\Models\Kategori;

use App\Models\PemilikUmkm;
use Illuminate\Http\Request;
use function Symfony\Component\String\b;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = Kategori::all();

        $umkms = PemilikUmkm::query()->where('status', 'on');

        if ($request->has('kategori') && $request->kategori != '') {
            $umkms->where('id_kategori', $request->kategori);
        }

        $umkms = $umkms->get();

        $banners = Banner::where('status', 'on')->get();

        return view('index', compact('umkms', 'kategoris', 'banners'));
    }
    public function show($id_umkm)
    {
        $umkm = PemilikUmkm::findOrFail($id_umkm);

        $produk = Produk::where('id_umkm', $id_umkm)
            ->where('status', 'on') 
            ->get();
        return view('detail_umkm', compact('umkm', 'produk'));
    }
}
