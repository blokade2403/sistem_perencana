<?php

namespace App\Http\Controllers\ValidasiBelanja;

use App\Models\Rkbu;
use App\Models\UraianDua;
use App\Models\UraianSatu;
use Endroid\QrCode\QrCode;
use App\Models\JudulHeader;
use Illuminate\Support\Str;
use App\Models\UsulanBarang;
use Illuminate\Http\Request;
use App\Models\SubKategoriRkbu;
use App\Models\StatusValidasiRka;
use App\Models\UsulanBarangDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
//use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log; // Impor Log
use Illuminate\Support\Facades\Storage; // Import Storage

class ValidasiUsulanBarangRkaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id_sub_kategori_rkbu = null)
    {
        // dd(session()->all());

        $id_ksp = session('id_ksp');
        $id_user = session('id_user');
        $id_pejabat          = session('id_pejabat');
        $tahunAnggaran = Session::get('tahun_anggaran');
        $inputIdUsulanBarang = request()->input('id_usulan_barang'); // Ambil input id_usulan_barang dari request
        $id_sub_kategori_rkbu = request()->input('id_sub_kategori_rkbu');

        // Ambil usulan barang yang pending
        $usulan_barangs = UsulanBarang::join('sub_kategori_rkbus', 'sub_kategori_rkbus.id_sub_kategori_rkbu', '=', 'usulan_barangs.id_sub_kategori_rkbu')
            ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
            //->where('usulan_barangs.id_user', $id_user)
            ->where('tahun_anggaran', $tahunAnggaran)
            ->where('status_usulan_barang', 'Selesai')
            ->where('jenis_kategori_rkbus.id_jenis_kategori_rkbu', '9cdfd354-e43a-4461-9747-e15fb74038ac')
            ->select('usulan_barangs.*')
            ->get();

        $id_usulan = UsulanBarang::join('users', 'usulan_barangs.id_user', '=', 'users.id_user')
            ->join('ksps', 'users.id_ksp', '=', 'ksps.id_ksp')
            ->join('pejabats', 'users.id_pejabat', '=', 'pejabats.id_pejabat')

            // Filter berdasarkan id_pejabat dan id_ksp bawahan
            //->where('users.id_ksp', $id_ksp)
            ->where('users.id_pejabat', $id_pejabat)

            // Filter berdasarkan tahun anggaran dan status
            ->where('usulan_barangs.tahun_anggaran', $tahunAnggaran)
            ->where('usulan_barangs.status_usulan_barang', 'Selesai')

            // Jika diperlukan join ke tabel lain untuk kategori
            ->join('sub_kategori_rkbus', 'sub_kategori_rkbus.id_sub_kategori_rkbu', '=', 'usulan_barangs.id_sub_kategori_rkbu')
            ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')

            // Optional filter kategori, uncomment jika diperlukan
            ->where('jenis_kategori_rkbus.id_jenis_kategori_rkbu', '9cdfd354-e43a-4461-9747-e15fb74038ac')

            // Join ke tabel usulan_barang_details jika detail barang juga diperlukan
            ->leftJoin('usulan_barang_details', 'usulan_barang_details.id_usulan_barang', '=', 'usulan_barangs.id_usulan_barang')

            // Select kolom yang ingin diambil
            ->select('usulan_barangs.*', 'usulan_barangs.id_usulan_barang') // Ambil detail barang juga jika diperlukan
            // ->select('usulan_barangs.*', 'usulan_barang_details.id_usulan_barang_detail') // Ambil detail barang juga jika diperlukan

            ->distinct() // Menghapus duplikasi jika ada
            ->get();

        $sub_kategori_rkbus = SubKategoriRkbu::join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
            ->join('rkbus', 'rkbus.id_sub_kategori_rkbu', '=', 'sub_kategori_rkbus.id_sub_kategori_rkbu')
            ->join('users', 'rkbus.id_user', '=', 'users.id_user')
            ->join('ksps', 'users.id_ksp', '=', 'ksps.id_ksp')

            //->where('ksps.id_ksp', $id_ksp)
            ->where('rkbus.id_status_validasi_rka', '9cfb1f87-238b-4ea2-98f0-4255e578b1d1')
            ->where('jenis_kategori_rkbus.id_jenis_kategori_rkbu', '9cdfd354-e43a-4461-9747-e15fb74038ac')
            ->select('sub_kategori_rkbus.*') // Pilih kolom yang diinginkan dari sub_kategori_rkbus
            ->distinct() // Menghapus duplikasi berdasarkan sub_kategori_rkbus yang sama
            ->get();

        // Ambil semua barang sesuai dengan sub_kategori_rkbu dan usulan yang diinputkan
        $get_barangs = [];

        foreach ($usulan_barangs as $yek) {
            $barang = Rkbu::join('users', 'rkbus.id_user', '=', 'users.id_user')
                ->join('ksps', 'users.id_ksp', '=', 'ksps.id_ksp')
                ->join('pejabats', 'ksps.id_pejabat', '=', 'pejabats.id_pejabat')
                ->where('rkbus.id_status_validasi', '9cfb1edc-2263-401f-b249-361db4017932')
                ->where('ksps.id_ksp', $id_ksp)
                ->where('ksps.id_ksp', $id_pejabat)
                ->where('rkbus.nama_tahun_anggaran', $tahunAnggaran)
                ->where('rkbus.id_sub_kategori_rkbu', $yek->id_sub_kategori_rkbu) // Filter by sub_kategori_rkbu for this usulan
                ->select('rkbus.*')
                ->get();

            // Simpan data barang per usulan
            $get_barangs[$yek->id_usulan_barang] = $barang;
        }

        return view('frontend.validasi_usulan_rka.validasi_usulan_barang.index', compact('usulan_barangs', 'get_barangs', 'id_usulan', 'sub_kategori_rkbus'));
    }

    public function updateValidasi(Request $request, $no_usulan_barang)
    {
        // Validasi input dari form
        $request->validate([
            'status_validasi_kabag' => 'required',
            'keterangan_kabag' => 'nullable|string',
        ]);

        // Cari data berdasarkan no_usulan_barang
        $usulanBarang = UsulanBarang::where('no_usulan_barang', $no_usulan_barang)->firstOrFail();

        // Update data
        $usulanBarang->status_permintaan_barang = $request->input('status_validasi_kabag');
        $usulanBarang->tgl_validasi_kabag = now(); // Set tanggal validasi ke waktu saat ini
        $usulanBarang->keterangan_kabag = $request->input('keterangan_kabag');
        $usulanBarang->status_validasi_kabag = $request->input('status_validasi_kabag');
        $usulanBarang->nama_valid_rka = auth()->user()->id_user; // Menyimpan id_user yang sedang login ke nama_valid_kabag

        // Pastikan data relasi ksp tidak null
        $nipKsp = $usulanBarang->validRka ? $usulanBarang->validRka->nip_user : 'NIP Tidak Ditemukan';
        $namaPengusul = $usulanBarang->validRka ? $usulanBarang->validRka->nama_lengkap : 'Pengusul Tidak Ditemukan';

        // Data untuk QR code
        $dataQR = "Telah divalidasi oleh: " . $namaPengusul .
            "\nNIP: " . $nipKsp .
            "\nNo Usulan: " . $usulanBarang->no_usulan_barang .
            "\nTanggal: " . $usulanBarang->tgl_validasi_kabag->format('d-m-Y');

        // Generate QR code
        $qrcode = new QrCode($dataQR);

        // Mengatur ukuran QR Code
        $qrcode->setSize(300);

        // Menggunakan PngWriter untuk menulis QR code ke file PNG
        $writer = new PngWriter();
        $result = $writer->write($qrcode);

        // Simpan QR Code sebagai string (data gambar)
        $qrcodeImage = $result->getString();

        // Simpan QR Code ke folder public/qrcodes dengan nama yang unik
        $qrcodePath = 'qrcodes/qrcode_kabag' . $usulanBarang->no_usulan_barang . '.png';
        Storage::disk('public')->put($qrcodePath, $qrcodeImage);

        // Simpan path QR code ke kolom qrcode_pengusul
        $usulanBarang->qrcode_kabag = $qrcodePath;

        // dd($usulanBarang);
        // Simpan perubahan ke database
        $usulanBarang->save();

        // Redirect dengan pesan sukses
        return redirect()->route('validasi_usulan_barang_rkas.index')
            ->with('success', 'Data usulan barang berhasil divalidasi dan QR code berhasil dihasilkan.');
    }

    public function keranjang($id_usulan_barang)
    {
        // Ambil detail invoice berdasarkan id_usulan_barang
        $invoice = UsulanBarangDetail::where('id_usulan_barang', $id_usulan_barang)->first();
        $judul_headers = JudulHeader::first();

        // Cek apakah invoice ditemukan (null atau tidak)
        if (is_null($invoice)) {
            // Jika null, kembalikan dengan pesan error atau lakukan tindakan lain
            return redirect()->back()->with('error', 'Data belum dipilih atau tidak ditemukan. Klik tombol +Barang Terlebih Dahulu');
        }

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

        // Ambil data invoice cetak
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

        // dd($keranjang);

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

        // dd($invo);

        // Return view dengan data yang disiapkan
        return view('frontend.validasi_usulan_rka.validasi_usulan_barang.keranjang', $data);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id_usulan_barang)
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

        return view('frontend.validasi_usulan_rka.validasi_usulan_barang.invoice', $data, compact('sub_kategori_rkbus', 'usulan_barangs', 'id_usulan', 'invoice'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
