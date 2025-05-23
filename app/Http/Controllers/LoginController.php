<?php

namespace App\Http\Controllers;

use App\Models\GambarLogin;
use App\Models\GambarSlide;
use App\Models\Login;
use Illuminate\Http\Request;
use App\Models\TahunAnggaran;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // Ambil tahun anggaran jika diperlukan
        $tahun_anggarans = TahunAnggaran::all(); // Ganti dengan model dan data yang sesuai
        $gambar_login = GambarLogin::all();
        return view('login.index', compact('tahun_anggarans', 'gambar_login'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'tahun_anggaran' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Login::attempt($credentials)) {
            // Auth::attempt akan mengecek user berdasarkan username dan password
            return redirect()->intended('dashboard')->with('success', 'Login berhasil.');
        }

        return redirect()->back()->withErrors(['username' => 'Username atau password salah.'])->withInput();
    }

    public function logout()
    {
        Login::logout();
        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
