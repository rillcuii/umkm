<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\DataUmkmController;
use App\Http\Controllers\PemilikUmkmController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Models\Banner;
use App\Models\PemilikUmkm;
use App\Models\Produk;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

// AUTH
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/register-pelanggan', [UserController::class, 'showRegisterForm'])->name('register.pelanggan');
Route::post('/register-pelanggan', [UserController::class, 'register'])->name('register.pelanggan.submit');
Route::get('/umkm/register', [PemilikUmkmController::class, 'showRegisterForm'])->name('umkm.register');
Route::post('/umkm/register', [PemilikUmkmController::class, 'register'])->name('umkm.register.submit');
Route::post('/getkabupaten', [PemilikUmkmController::class, 'getkabupaten'])->name('getkabupaten');
Route::post('/getkecamatan', [PemilikUmkmController::class, 'getkecamatan'])->name('getkecamatan');
Route::post('/getdesa', [PemilikUmkmController::class, 'getdesa'])->name('getdesa');



// Route untuk admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'chart'])->name('admin.dashboard');

    //banner
    Route::get('/admin/banner', [BannerController::class, 'index'])->name('admin.index.banner');
    Route::get('/admin/tambah_banner', [BannerController::class, 'create'])->name('admin.tambah.banner');
    Route::post('/admin/banner/simpan', [BannerController::class, 'store'])->name('admin.simpan.banner');
    Route::post('/admin/update-status', [BannerController::class, 'updateStatus'])->name('admin.update.status');
    Route::delete('admin/delete/{id_banner}', [BannerController::class, 'destroy'])->name('admin.banner.delete');


    //data umkm
    Route::get('/admin/data_umkm', [DataUmkmController::class, 'index'])->name('admin.index.umkm');
    Route::get('/admin/data_umkm/detail/{id_umkm}', [DataUmkmController::class, 'detail'])->name('admin.detail.umkm');
    Route::delete('admin/delete/{id_umkm}', [DataUmkmController::class, 'delete'])->name('umkm.delete');
});


// Route untuk pemilik UMKM
Route::middleware(['auth:umkm'])->group(function () {
    Route::get('/umkm', function () {
        $id_umkm = auth()->user()->id_umkm;

        $produk = Produk::where('id_umkm', $id_umkm)->get();

        return view('dashboard.umkm.dashboard', compact('produk', 'id_umkm'));
    })->name('umkm.dashboard');

    //produk
    Route::get('/umkm/{id_umkm}/produk', [ProdukController::class, 'index'])->name('umkm.index.produk');
    Route::get('/umkm/{id_umkm}/tambah_produk', [ProdukController::class, 'create'])->name('umkm.tambah.produk');
    Route::post('/umkm/{id_umkm}/store', [ProdukController::class, 'store'])->name('umkm.simpan.produk');
    Route::post('/umkm/update-status', [ProdukController::class, 'updateStatus'])->name('umkm.update.status');
    Route::get('/umkm/{id_produk}/produk/{id_umkm}/edit', [ProdukController::class, 'edit'])->name('umkm.edit.produk');
    Route::put('/umkm/{id_produk}/produk/{id_umkm}/update', [ProdukController::class, 'update'])->name('umkm.update.produk');
});
