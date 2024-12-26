<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PemilikUmkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Cek untuk user biasa (pelanggan atau admin)
        $user = User::where('username', $credentials['username'])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);

            // Cek apakah pengguna adalah pelanggan atau admin
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'pelanggan') {
                // Jika pelanggan, arahkan kembali ke index
                return redirect()->route('index');
            }
        }

        // Cek untuk pemilik UMKM menggunakan guard 'umkm'
        $umkmOwner = PemilikUmkm::where('username', $credentials['username'])->first();
        if ($umkmOwner && Hash::check($credentials['password'], $umkmOwner->password)) {
            Auth::guard('umkm')->login($umkmOwner);
            return redirect()->route('umkm.dashboard'); // Redirect untuk pemilik UMKM
        }

        return back()->withErrors(['username' => 'Username atau password salah.']);
    }

    public function logout(Request $request)
    {
        if (Auth::guard('umkm')->check()) {
            Auth::guard('umkm')->logout();
        } elseif (Auth::check()) {
            Auth::logout();
        } elseif (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index');
    }

    public function showRegisterForm()
    {
        return view('register_user');
    }

    // Menangani registrasi pelanggan
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|unique:user,username',
            'nama_lengkap' => 'required|string|max:255',
            'password' => 'required|min:6|confirmed',
        ]);

        // Membuat user baru
        $user = new User();
        $user->username = $request->username;
        $user->nama_lengkap = $request->nama_lengkap;
        $user->password = Hash::make($request->password); // Hash password
        $user->role = 'pelanggan'; // Secara otomatis role di-set ke 'pelanggan'
        $user->save();

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login!');
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {}

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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
