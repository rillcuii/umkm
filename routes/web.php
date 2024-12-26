<?php

use App\Http\Controllers\PemilikUmkmController;
use App\Http\Controllers\UserController;
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
Route::middleware(['auth', 'role:admin'])->get('/admin', function () {
    return view('dashboard.admin.dashboard');
})->name('admin.dashboard');

// Route untuk pemilik UMKM
Route::middleware(['auth:umkm'])->get('/umkm', function () {
    return view('dashboard.umkm.dashboard');
})->name('umkm.dashboard');
