<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\DataUmkmController;
use App\Http\Controllers\PemilikUmkmController;
use App\Http\Controllers\UserController;
use App\Models\Banner;
use App\Models\PemilikUmkm;
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
    Route::post('/admin/banner/simpan', [BannerController::class ,'store'])->name('admin.simpan.banner');
    Route::delete('admin/delete/{id_banner}', [BannerController::class, 'destroy'])->name('admin.banner.delete');


    //data umkm
    Route::get('/admin/data_umkm', [DataUmkmController::class, 'index'])->name('admin.index.umkm');
    Route::get('/admin/data_umkm/detail/{id_umkm}', [DataUmkmController::class, 'detail'])->name('admin.detail.umkm');
    Route::delete('admin/delete/{id_umkm}', [DataUmkmController::class, 'delete'])->name('umkm.delete');
});


// Route untuk pemilik UMKM
Route::middleware(['auth:umkm'])->get('/umkm', function () {
    return view('dashboard.umkm.dashboard');
})->name('umkm.dashboard');
