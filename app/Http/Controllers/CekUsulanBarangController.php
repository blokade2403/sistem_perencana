<?php

namespace App\Http\Controllers;

use App\Models\JudulHeader;
use App\Models\UsulanBarang;
use Illuminate\Http\Request;
use App\Models\SubKategoriRkbu;
use App\Models\StatusValidasiRka;
use App\Models\UsulanBarangDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CekUsulanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil id_ksp dari session
        $id_ksp = session('id_ksp');
        $id_user = session('id_user');
        $tahunAnggaran = Session::get('tahun_anggaran');
        $status_validasi_rka = StatusValidasiRka::all(); // Ambil status validasi dari model terkait
        $inputIdUsulanBarang = request()->input('id_usulan_barang'); // Ambil input id_usulan_barang dari request

        $usulan_barangs = UsulanBarang::join('sub_kategori_rkbus', 'sub_kategori_rkbus.id_sub_kategori_rkbu', '=', 'usulan_barangs.id_sub_kategori_rkbu')
            ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
            ->where('status_usulan_barang', 'Selesai')
            ->where('jenis_kategori_rkbus.id_jenis_kategori_rkbu', '9cdfd354-e43a-4461-9747-e15fb74038ac')
            ->where('usulan_barangs.id_user', $id_user)
            ->where('usulan_barangs.tahun_anggaran', $tahunAnggaran)
            ->orderby('usulan_barangs.id_usulan_barang', 'DESC')
            ->select('usulan_barangs.*')
            ->distinct()
            ->get();



        // dd($usulan_barangs);

        return view('frontend.cek_usulan_barang.index', compact('usulan_barangs'));
    }

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
    public function show(UsulanBarang $usulanBarang, $id_usulan_barang)
    {
        // Ambil id_ksp dari session
        $id_ksp = session('id_ksp');
        $id_user = session('id_user');
        $tahunAnggaran = Session::get('tahun_anggaran');
        $status_validasi_rka = StatusValidasiRka::all(); // Ambil status validasi dari model terkait
        $inputIdUsulanBarang = request()->input('id_usulan_barang'); // Ambil input id_usulan_barang dari request

        $usulan_barangs = UsulanBarang::join('sub_kategori_rkbus', 'sub_kategori_rkbus.id_sub_kategori_rkbu', '=', 'usulan_barangs.id_sub_kategori_rkbu')
            ->join('rkbus', 'rkbus.id_sub_kategori_rkbu', '=', 'sub_kategori_rkbus.id_sub_kategori_rkbu')
            ->join('users', 'rkbus.id_user', '=', 'users.id_user')
            ->join('ksps', 'users.id_ksp', '=', 'ksps.id_ksp')
            ->where('status_usulan_barang', 'Selesai')
            ->where('rkbus.id_status_validasi', '9cfb1edc-2263-401f-b249-361db4017932')
            ->where('ksps.id_ksp', $id_ksp)
            ->where('usulan_barangs.id_user', $id_user)
            ->where('rkbus.nama_tahun_anggaran', $tahunAnggaran)
            ->orderby('usulan_barangs.id_usulan_barang', 'DESC')
            ->select('usulan_barangs.*', 'rkbus.*')
            ->distinct()
            ->get();

        $id_usulan = UsulanBarang::join('sub_kategori_rkbus', 'sub_kategori_rkbus.id_sub_kategori_rkbu', '=', 'usulan_barangs.id_sub_kategori_rkbu')
            ->where('status_usulan_barang', 'Pending')
            ->where('id_user', $id_user)
            ->where('tahun_anggaran', $tahunAnggaran)
            ->orderby('usulan_barangs.id_usulan_barang', 'DESC')
            ->select('usulan_barangs.*')
            ->distinct()
            ->get();

        //Ambil sub kategori rkbu berdasarkan id_user dari session dan id_jenis_kategori_rkbu
        $sub_kategori_rkbus = SubKategoriRkbu::join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
            ->join('rkbus', 'rkbus.id_sub_kategori_rkbu', '=', 'sub_kategori_rkbus.id_sub_kategori_rkbu')
            ->join('users', 'rkbus.id_user', '=', 'users.id_user')
            ->join('ksps', 'users.id_ksp', '=', 'ksps.id_ksp')
            ->where('ksps.id_ksp', $id_ksp)
            ->where('rkbus.id_status_validasi_rka', '9cfb1f87-238b-4ea2-98f0-4255e578b1d1')
            ->where('jenis_kategori_rkbus.id_jenis_kategori_rkbu', '9cdfd354-e43a-4461-9747-e15fb74038ac')
            ->select('sub_kategori_rkbus.*') // Pilih kolom yang diinginkan dari sub_kategori_rkbus
            ->distinct() // Menghapus duplikasi berdasarkan sub_kategori_rkbus yang sama
            ->get();

        // Ambil detail invoice berdasarkan id_usulan_barang
        $invoice = UsulanBarangDetail::where('id_usulan_barang', $id_usulan_barang)->first();
        $judul_headers = JudulHeader::first();


        // Pastikan variabel judul_headers ada
        $judul_header1          = $judul_headers->header1 ?? 'Judul Tidak Ada';
        $nama                   = $judul_headers->nama_rs ?? 'Nama Tidak Ada';
        $alamat                 = $judul_headers->alamat_rs ?? 'Alamat Tidak Ada';
        $tlp                    = $judul_headers->tlp_rs ?? 'Tlp Tidak Ada';
        $email                  = $judul_headers->email_rs ?? 'Email Tidak Ada';
        $website                = $judul_headers->header3 ?? 'Website Tidak Ada';
        $gambar1                = $judul_headers->gambar1 ?? 'Website Tidak Ada';
        $gambar2                = $judul_headers->gambar2 ?? 'Website Tidak Ada';

        // Ambil total anggaran usulan barang
        $sum_total_anggaran_usulan_barang = UsulanBarangDetail::where('id_usulan_barang', $id_usulan_barang)
            ->sum('total_anggaran_usulan_barang');

        $sum_total_ppn = UsulanBarangDetail::where('id_usulan_barang', $id_usulan_barang)
            ->sum('total_ppn');

        $invo = DB::table('usulan_barang_details')
            ->join('usulan_barangs', 'usulan_barangs.id_usulan_barang', '=', 'usulan_barang_details.id_usulan_barang')
            ->join('rkbus', 'rkbus.id_rkbu', '=', 'usulan_barang_details.id_rkbu')
            ->join('sub_kategori_rkbus', 'sub_kategori_rkbus.id_sub_kategori_rkbu', '=', 'rkbus.id_sub_kategori_rkbu')
            ->join('kategori_rkbus', 'kategori_rkbus.id_kategori_rkbu', '=', 'sub_kategori_rkbus.id_kategori_rkbu')
            ->join('sub_kategori_rekenings', 'sub_kategori_rekenings.id_sub_kategori_rekening', '=', 'sub_kategori_rkbus.id_sub_kategori_rekening')
            ->join('rekening_belanjas', 'rekening_belanjas.id_kode_rekening_belanja', '=', 'rkbus.id_kode_rekening_belanja')
            ->join('aktivitas', 'aktivitas.id_aktivitas', '=', 'rekening_belanjas.id_aktivitas')
            ->join('sub_kegiatans', 'sub_kegiatans.id_sub_kegiatan', '=', 'aktivitas.id_sub_kegiatan')
            ->join('kegiatans', 'kegiatans.id_kegiatan', '=', 'sub_kegiatans.id_kegiatan')
            ->join('programs', 'programs.id_program', '=', 'kegiatans.id_program')
            ->join('sumber_danas', 'sumber_danas.id_sumber_dana', '=', 'sub_kegiatans.id_sumber_dana')
            ->join('users', 'users.id_user', '=', 'usulan_barangs.id_user')
            ->join('units', 'users.id_unit', '=', 'units.id_unit')
            ->where('usulan_barang_details.id_usulan_barang', $id_usulan_barang) // Filter by id_usulan_barang
            ->select(
                'usulan_barang_details.*',
                'sub_kategori_rkbus.nama_sub_kategori_rkbu',
                'sub_kategori_rkbus.kode_sub_kategori_rkbu',
                'kategori_rkbus.kode_kategori_rkbu',
                'kategori_rkbus.nama_kategori_rkbu',
                'rekening_belanjas.*',
                'sub_kegiatans.*',
                'programs.*',
                'kegiatans.*',
                'aktivitas.*',
                'users.nama_lengkap as nama_pengusul_barang',
                'units.nama_unit as unit',
                'sumber_danas.id_sumber_dana', // Retrieving id_sumber_dana
                'sumber_danas.nama_sumber_dana', // Retrieving sumber_danas field
                'usulan_barangs.*'
            )
            ->first();

        // Cek apakah invoice ditemukan
        if ($invoice) {
            $keranjang = UsulanBarangDetail::where('usulan_barang_details.id_usulan_barang', $invoice->id_usulan_barang)
                ->join('rkbus', 'rkbus.id_rkbu', '=', 'usulan_barang_details.id_rkbu') // Join ke tabel rkbus
                ->select('usulan_barang_details.*', 'rkbus.nama_barang', 'rkbus.spek') // Select kolom yang diinginkan dari rkbus
                ->get();
        } else {
            $keranjang = collect(); // Jika tidak ada, gunakan collection kosong
        }

        // dd($invoice);

        $gambar1 = $judul_headers->gambar1 ? asset('storage/uploads/' . basename($judul_headers->gambar1)) : asset('storage/uploads/foto.png');

        // Cek apakah gambar2 ada, jika tidak gunakan gambar alias
        $gambar2 = $judul_headers->gambar2 ? asset('storage/uploads/' . basename($judul_headers->gambar2)) : asset('storage/uploads/foto.png');

        // Siapkan data untuk dikirim ke view
        $data = [
            'no_inv'            => $invo,
            'invoice'           => $invoice,
            'keranjang'         => $keranjang,
            'get_total'         => $sum_total_anggaran_usulan_barang,
            'ppn'               => $sum_total_ppn,
            'judul_header1'     => $judul_header1,
            'nama'              => $nama,
            'alamat'            => $alamat,
            'tlp'               => $tlp,
            'email'             => $email,
            'website'           => $website,
            'gambar1'           => $gambar1,
            'gambar2'           => $gambar2,
        ];

        // dd($data);

        return view('frontend.cek_usulan_barang.cek_usulan_invoice', $data, compact('sub_kategori_rkbus', 'usulan_barangs', 'id_usulan', 'invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "hello";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
