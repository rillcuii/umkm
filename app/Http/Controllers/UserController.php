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

        $user = User::where('username', $credentials['username'])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'pelanggan') {
                return redirect()->route('index');
            }
        }

        $umkmOwner = PemilikUmkm::where('username', $credentials['username'])->first();
        if ($umkmOwner && Hash::check($credentials['password'], $umkmOwner->password)) {
            Auth::guard('umkm')->login($umkmOwner);
            return redirect()->route('umkm.dashboard'); 
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

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:user,username',
            'nama_lengkap' => 'required|string|max:255',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->nama_lengkap = $request->nama_lengkap;
        $user->password = Hash::make($request->password); 
        $user->role = 'pelanggan'; 
        $user->save();

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login!');
    }

}
