<?php

// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\GambarLogin;
use App\Models\UsulanBarang;
use Illuminate\Http\Request;
use App\Models\TahunAnggaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        // Ambil tahun anggaran jika diperlukan
        $tahun_anggarans = TahunAnggaran::where('status', 'aktif')->get();
        $gambar_login = GambarLogin::all();
        return view('login.index', compact('tahun_anggarans', 'gambar_login'));
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username'          => 'required',
            'password'          => 'required',
            'tahun_anggaran'    => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        // Cek apakah user dapat diotentikasi
        if (Auth::attempt($credentials)) {
            // Ambil user yang terautentikasi
            $user = Auth::user();

            // Ambil data TahunAnggaran berdasarkan id_tahun_anggaran dari input
            $tahunAnggaran = TahunAnggaran::find($request->tahun_anggaran);

            if (!$tahunAnggaran) {
                // Jika tidak ditemukan, kembalikan error
                return redirect()->back()->withErrors(['tahun_anggaran' => 'Tahun anggaran tidak valid.'])->withInput();
            }

            // Simpan data yang dibutuhkan ke dalam session
            session([
                'id_user'                   => $user->id_user,
                'username'                  => $user->username,
                'nama_lengkap'              => $user->nama_lengkap,
                'tahun_anggaran'            => $tahunAnggaran->nama_tahun_anggaran, // Mengambil nama_tahun_anggaran dari hasil query
                'id_fase'                   => $user->id_fase,
                'id_pejabat'                => $user->id_pejabat,
                'nip_user'                  => $user->nip_user,
                'email'                     => $user->email,
                'id_level'                  => $user->id_level,
                'id_unit'                   => $user->id_unit,
                'id_ksp'                    => $user->id_ksp,
                'status_user'               => $user->status_user,
                'status_edit'               => $user->status_edit,
                'nama_unit'                 => $user->unit->nama_unit ?? null,   // Mengambil nama_unit dari relasi
                // 'nama_level'                => $user->levelUser->nama_level ?? null,   // Mengambil nama_unit dari relasi
                'nama_fase'                 => $user->fase->nama_fase ?? null,   // Mengambil nama_fase dari relasi
                'nama_ksp'                  => $user->ksp->nama_ksp ?? null,     // Mengambil nama_ksp dari relasi
                'nama_level_user'           => $user->levelUser->nama_level_user ?? null,     // Mengambil nama_ksp dari relasi
                'id_admin_pendukung_ppk'    => $user->id_admin_pendukung_ppk,     // Mengambil nama_ksp dari relasi
            ]);

            // dd(session()->all());

            // Query notifications based on user's role (nama_level_user)
            $notifications = collect(); // Default empty collection
            $notifications2 = collect();
            $notifications3 = collect();

            if (session('nama_level_user') == 'Validasi RKA') {
                $notifications = UsulanBarang::where('status_permintaan_barang', 'Disetujui Perencana')
                    ->where('users.id_pejabat', session('id_pejabat'))
                    ->where('usulan_barangs.tahun_anggaran', session('tahun_anggaran'))
                    ->where('usulan_barangs.status_usulan_barang', 'Selesai')
                    ->join('users', 'users.id_user', '=', 'usulan_barangs.id_user')
                    ->select('usulan_barangs.*', 'usulan_barangs.id_usulan_barang')
                    ->distinct()
                    ->get();
            } elseif (session('nama_level_user') == 'Administrator') {
                $notifications2 = UsulanBarang::where('status_permintaan_barang', 'Perlu Validasi Perencana')
                    ->where('usulan_barangs.tahun_anggaran', session('tahun_anggaran'))
                    ->where('usulan_barangs.status_usulan_barang', 'Selesai')
                    ->join('users', 'usulan_barangs.id_user', '=', 'users.id_user')
                    ->select('usulan_barangs.*', 'usulan_barangs.id_usulan_barang')
                    ->distinct()
                    ->get();
            } elseif (session('nama_level_user') == 'Direktur') {
                $notifications3 = UsulanBarang::where('status_permintaan_barang', 'Validasi Kabag')
                    ->where('usulan_barangs.tahun_anggaran', session('tahun_anggaran'))
                    ->where('usulan_barangs.status_usulan_barang', 'Selesai')
                    ->join('users', 'usulan_barangs.id_user', '=', 'users.id_user')
                    ->join('ksps', 'users.id_ksp', '=', 'ksps.id_ksp')
                    ->join('pejabats', 'users.id_pejabat', '=', 'pejabats.id_pejabat')
                    ->select('usulan_barangs.*', 'usulan_barangs.id_usulan_barang')
                    ->distinct()
                    ->get();
            }

            // Redirect to dashboard with notifications
            return redirect()->route('dashbord')->with([
                'success' => 'Login berhasil untuk Anggaran Tahun ' . $tahunAnggaran->nama_tahun_anggaran,
                'notifications' => $notifications,
                'notifications2' => $notifications2,
                'notifications3' => $notifications3
            ]);
        }


        // Jika autentikasi gagal, kembalikan ke halaman login dengan error
        return redirect()->back()->withErrors(['username' => 'Username atau password salah.'])->withInput();
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
