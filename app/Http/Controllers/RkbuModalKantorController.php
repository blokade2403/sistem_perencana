<?php

namespace App\Http\Controllers;

use App\Models\Rkbu;
use App\Models\Komponen;
use App\Models\UraianDua;
use App\Models\UraianSatu;
use App\Models\JenisBelanja;
use Illuminate\Http\Request;
use App\Models\TahunAnggaran;
use App\Models\RkbuModalKantor;
use App\Models\SubKategoriRkbu;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\StatusValidasiRka;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RkbuModalKantorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil id_user dari session
        $id_user = session('id_user');
        $tahunAnggaran = Session::get('tahun_anggaran');

        // Ambil sub kategori rkbu berdasarkan id_user dari session
        $sub_kategori_rkbus = SubKategoriRkbu::whereHas('rkbus', function ($query) use ($id_user, $tahunAnggaran) {
            $query->where('id_user', $id_user)
                ->where('nama_tahun_anggaran', $tahunAnggaran)
                ->whereHas('subKategoriRkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu', function ($query) {
                    $query->where('id_jenis_kategori_rkbu', '9cf70e1d-18e7-40fe-bdd3-b7dabf61877d');
                });
        })->get();

        $status_validasi_rka = StatusValidasiRka::all(); // Ambil status validasi dari model terkait

        // Ambil data rkbu berdasarkan filter sub_kategori_rkbu
        $query = RkbuModalKantor::with([
            'rekening_belanjas.aktivitas.sub_kegiatan.sumber_dana',
            'rekening_belanjas.aktivitas.sub_kegiatan.kegiatan.program',
            'sub_kategori_rkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu',
        ])
            ->where('id_user', $id_user) // Filter data berdasarkan id_user
            ->where('nama_tahun_anggaran', $tahunAnggaran)
            ->whereHas('sub_kategori_rkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu', function ($query) {
                $query->where('id_jenis_kategori_rkbu', '9cf70e1d-18e7-40fe-bdd3-b7dabf61877d');
            });

        // Cek apakah ada filter sub_kategori_rkbu yang dipilih
        if ($request->has('sub_kategori_rkbu') && $request->sub_kategori_rkbu != '') {
            $query->where('id_sub_kategori_rkbu', $request->sub_kategori_rkbu);
        }

        // Filter berdasarkan id_status_validasi_rka
        if ($request->has('id_status_validasi_rka') && $request->id_status_validasi_rka != '') {
            $query->where('id_status_validasi_rka', $request->id_status_validasi_rka);
        }

        // Dapatkan data rkbu
        $rkbus = $query->select('rkbus.*')->get();

        // Ambil total anggaran berdasarkan id_user dari session
        $total_anggaran = $rkbus->sum('total_anggaran');

        return view('frontend.rkbu.modal_kantor.index', compact('rkbus', 'sub_kategori_rkbus', 'status_validasi_rka', 'total_anggaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $komponens              = Komponen::all();
        $sub_kategori_rkbus     = SubKategoriRkbu::join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
            ->where('jenis_kategori_rkbus.id_jenis_kategori_rkbu', '9cf70e1d-18e7-40fe-bdd3-b7dabf61877d')
            ->select('sub_kategori_rkbus.*') // Pilih kolom yang diinginkan dari sub_kategori_rkbus
            ->get();

        $uraian_satu            = UraianSatu::all();
        $uraian_dua             = UraianDua::all();
        // dd($uraian_satus);
        return view('frontend.rkbu.modal_kantor.create', compact('komponens', 'sub_kategori_rkbus', 'uraian_satu', 'uraian_dua'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Pastikan session 'id_user' dan 'tahun_anggaran' tersedia
        if (!session()->has('id_user') || !session()->has('tahun_anggaran')) {
            return redirect()->back()->with('error', 'Data session tidak tersedia. Silakan login kembali.');
        }

        // Ambil data dari session
        $id_user = session('id_user');
        $nama_tahun_anggaran = session('tahun_anggaran');

        // Tentukan nilai status_komponen berdasarkan session 'nama_fase'
        $tahunAnggaran       = Session::get('tahun_anggaran');
        $faseTahun           = TahunAnggaran::where('nama_tahun_anggaran', $tahunAnggaran)->value('fase_tahun');

        // Tentukan nilai status_komponen berdasarkan session 'nama_fase'
        $status_komponen = null; // Default null
        if ($faseTahun == 'Penetapan') {
            $status_komponen = 'Komponen Baru';
        } elseif ($faseTahun == 'Perubahan') {
            $status_komponen = 'Komponen Perubahan';
        }

        // Validasi input
        $validator = Validator::make(
            $request->all(),
            [
                'id_sub_kategori_rkbu'          => 'required',
                'id_kode_rekening_belanja'      => 'nullable',
                'id_sub_kategori_rekening'      => 'required',
                'barang'                        => 'nullable|string|max:255|required_without_all:nama_barang',
                'nama_barang'                   => 'nullable|string|max:255|required_without_all:barang',
                'vol_1'                         => 'required|numeric|min:0',
                'satuan_1'                      => 'required|string|max:255',
                'id_status_validasi'            => 'nullable',
                'vol_2'                         => 'nullable|numeric|min:0',
                'satuan_2'                      => 'nullable|string|max:255',
                'spek'                          => 'nullable|string|max:1000',
                'harga_satuan'                  => 'required|numeric|min:0',
                'ppn'                           => 'required|numeric|min:0|max:100',
                'rating'                        => 'nullable',
                'link_ekatalog'                 => 'required|string',
                'penempatan'                    => 'nullable|string|max:255',
                'upload_file_1'                 => 'nullable|mimes:pdf|max:2048',
                'upload_file_2'                 => 'nullable|mimes:pdf|max:2048',
                'upload_file_3'                 => 'nullable|mimes:pdf|max:2048',
                'upload_file_4'                 => 'nullable|mimes:pdf|max:2048',
            ],
            [
                'id_sub_kategori_rkbu.required'     => 'ID Sub Kategori RKBU wajib diisi.',
                'id_sub_kategori_rekening.required' => 'ID Sub Kategori Rekening wajib diisi.',
                'barang.required_without_all'       => 'Kolom Barang atau Nama Barang wajib diisi.',
                'nama_barang.required_without_all'  => 'Kolom Barang atau Nama Barang wajib diisi.',
                'vol_1.required'                    => 'Volume 1 wajib diisi dan harus berupa angka.',
                'satuan_1.required'                 => 'Satuan 1 wajib diisi.',
                'harga_satuan.required'             => 'Harga satuan wajib diisi dan harus berupa angka.',
                'ppn.required'                      => 'PPN wajib diisi dan harus berupa angka antara 0 hingga 100.',
                'ppn.min'                           => 'PPN tidak boleh kurang dari 0.',
                'ppn.max'                           => 'PPN tidak boleh lebih dari 12.',
                'link_ekatalog.required'            => 'Mohon cantumkan link e-katalog',
                'upload_file_1.mimes'               => 'File yang diunggah harus berformat PDF.',
                'upload_file_1.max'                 => 'Ukuran file PDF tidak boleh lebih dari 2MB.',
                'upload_file_2.mimes'               => 'File yang diunggah harus berformat PDF.',
                'upload_file_2.max'                 => 'Ukuran file PDF tidak boleh lebih dari 2MB.',
                'upload_file_3.mimes'               => 'File yang diunggah harus berformat PDF.',
                'upload_file_3.max'                 => 'Ukuran file PDF tidak boleh lebih dari 2MB.',
                'upload_file_4.mimes'               => 'File yang diunggah harus berformat PDF.',
                'upload_file_4.max'                 => 'Ukuran file PDF tidak boleh lebih dari 2MB.',
            ]
        );

        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessages = implode(' ', $errors->all());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
        }

        // Prioritaskan 'nama_barang' (input manual), jika ada
        $barang = $request->input('nama_barang') ?? $request->input('barang');

        // Mengatur file upload hanya jika file ada
        $namaFile1 = $request->hasFile('upload_file_1') ? $request->file('upload_file_1')->store('public/uploads') : null;
        $namaFile2 = $request->hasFile('upload_file_2') ? $request->file('upload_file_2')->store('public/uploads') : null;
        $namaFile3 = $request->hasFile('upload_file_3') ? $request->file('upload_file_3')->store('public/uploads') : null;
        $namaFile4 = $request->hasFile('upload_file_4') ? $request->file('upload_file_4')->store('public/uploads') : null;


        // Menghitung total anggaran
        $vol1 = $request->input('vol_1');
        $vol2 = $request->input('vol_2', 1);
        $harga_satuan = (int) str_replace('.', '', $request->input('harga_satuan'));
        $ppn = $request->input('ppn', 0);

        $jumlahVol = $vol1 * $vol2;
        $totalAnggaran = ($jumlahVol * $harga_satuan) + ($ppn / 100 * ($jumlahVol * $harga_satuan));
        $sisa_vol_rkbu = $jumlahVol;
        $sisa_anggaran_rkbu = $totalAnggaran;

        // Ambil id_kode_rekening_belanja dari request
        $idKodeRekeningBelanja  = '9cf603e2-e748-49f0-949f-6c3c30d42c3e'; // ID Belanja Modal Peralatan dan Mesin BLUD
        $idStatusValidasi       = '9cfb1f38-dc3f-436f-8c4a-ec4c4de2fcaf'; // Status Validasi Default

        // Inisialisasi model Rkbu dan tentukan fillable dinamis
        $rkbuBarangJasa = new Rkbu();

        // Isi data sesuai request
        $rkbuBarangJasa->fill([
            'id_sub_kategori_rekening'      => $request->input('id_sub_kategori_rekening'),
            // 'id_kategori_rkbu'              => $request->input('id_kegiatan'),
            'id_sub_kategori_rkbu'          => $request->input('id_sub_kategori_rkbu'),
            'id_kode_rekening_belanja'      => $idKodeRekeningBelanja,
            'id_user'                       => $id_user,
            'nama_barang'                   => $barang,
            'vol_1'                         => $vol1,
            'satuan_1'                      => $request->input('satuan_1'),
            'id_status_validasi'            => $idStatusValidasi,
            'vol_2'                         => $vol2,
            'satuan_2'                      => $request->input('satuan_2'),
            'jumlah_vol'                    => $jumlahVol,
            'spek'                          => $request->input('spek'),
            'harga_satuan'                  => $harga_satuan,
            'ppn'                           => $ppn,
            'total_anggaran'                => $totalAnggaran,
            'rating'                        => $request->input('rating'),
            'link_ekatalog'                 => $request->input('link_ekatalog'),
            'nama_tahun_anggaran'           => $nama_tahun_anggaran,
            'penempatan'                    => $request->input('penempatan'),
            'upload_file_1'                  => $namaFile1,
            'upload_file_2'                  => $namaFile2,
            'upload_file_3'                  => $namaFile3,
            'upload_file_4'                  => $namaFile4,
            'id_status_validasi_rka'         => $request->input('id_status_validasi_rka', '9cfb1f93-70fb-4b88-bff9-a3ae6e81ae34'), // Berikan nilai default jika kosong
            'stok'                           => $request->input('stok', 0),
            'rata_rata_pemakaian'            => $request->input('rata_rata_pemakaian', 0),
            'kebutuhan_per_bulan'            => $request->input('kebutuhan_per_bulan', 0),
            'buffer'                         => $request->input('buffer', 0),
            'pengadaan_sebelumnya'           => $request->input('pengadaan_sebelumnya', 0),
            'proyeksi_sisa_stok'             => $request->input('proyeksi_sisa_stok', 0),
            'kebutuhan_plus_buffer'          => $request->input('kebutuhan_plus_buffer', 0),
            'kebutuhan_tahun_x1'             => $request->input('kebutuhan_tahun_x1', 0),
            'rencana_pengadaan_tahun_x1'     => $request->input('rencana_pengadaan_tahun_x1', 0),
            'nama_pegawai'                   => $request->input('nama_pegawai', 0),
            'tempat_lahir'                   => $request->input('tempat_lahir', 0),
            'tanggal_lahir'                     => $request->input('tanggal_lahir', 0),
            'pendidikan'                        => $request->input('pendidikan', 0),
            'jabatan'                        => $request->input('jabatan', 0),

            'status_kawin'                      => $request->input('status_kawin', 0),
            'nomor_kontrak'                     => $request->input('nomor_kontrak', 0),
            'tmt_pegawai'                       => $request->input('tmt_pegawai', 0),
            'bulan_tmt'                         => $request->input('bulan_tmt', 0),
            'tahun_tmt'                         => $request->input('tahun_tmt', 0),
            'gaji_pokok'                        => $request->input('gaji_pokok', 0),
            'remunerasi'                        => $request->input('remunerasi', 0),
            'koefisien_remunerasi'              => $request->input('koefisien_remunerasi', 0),
            'koefisien_gaji'                    => $request->input('koefisien_gaji', 0),
            'bpjs_kesehatan'                    => $request->input('bpjs_kesehatan', 0),
            'bpjs_tk'                           => $request->input('bpjs_tk', 0),
            'total_gaji_pokok'                  => $request->input('total_gaji_pokok', 0),
            'total_remunerasi'                  => $request->input('total_remunerasi', 0),
            'sisa_vol_rkbu'                     => $sisa_vol_rkbu,
            'sisa_anggaran_rkbu'                => $sisa_anggaran_rkbu,
            'status_komponen'                   => $status_komponen, // Menyimpan status komponen berdasarkan session 'nama_fase'
            'standar_kebutuhan'                 => $request->input('standar_kebutuhan'),
            'eksisting'                         => $request->input('eksisting'),
            'kondisi_baik'                      => $request->input('kondisi_baik'),
            'kondisi_rusak_berat'               => $request->input('kondisi_rusak_berat'),
        ]);

        // dd($rkbuBarangJasa);

        // Simpan data
        $rkbuBarangJasa->save();

        // Redirect dengan pesan sukses
        return redirect()->route('rkbu_modal_kantors.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rkbuBarangJasa = RkbuModalKantor::with([
            'rekening_belanjas.aktivitas.sub_kegiatan.sumber_dana',
            'rekening_belanjas.aktivitas.sub_kegiatan.kegiatan.program',
            'sub_kategori_rkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu',
        ])->findOrFail($id);

        $total_anggaran = $rkbuBarangJasa->total_anggaran;
        $ppn            = $total_anggaran * (($rkbuBarangJasa->ppn) / 100);
        $sub_total      = $total_anggaran - $ppn;

        // dd($rkbuBarangJasa);

        return view('frontend.partials.detail_rkbu', compact('rkbuBarangJasa', 'ppn', 'sub_total'));
    }



    public function edit($id)
    {
        $rkbuBarangJasa = RkbuModalKantor::with([
            'rekening_belanjas.aktivitas.sub_kegiatan.sumber_dana',
            'rekening_belanjas.aktivitas.sub_kegiatan.kegiatan.program',
        ])->findOrFail($id);

        $komponens              = Komponen::all();
        $sub_kategori_rkbus     = SubKategoriRkbu::join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
            ->where('jenis_kategori_rkbus.id_jenis_kategori_rkbu', '9cf70e1d-18e7-40fe-bdd3-b7dabf61877d')
            ->select('sub_kategori_rkbus.*') // Pilih kolom yang diinginkan dari sub_kategori_rkbus
            ->get();
        $uraian_satu                = UraianSatu::all();
        $uraian_dua                 = UraianDua::all();

        return view('frontend.rkbu.modal_kantor.edit', compact('rkbuBarangJasa', 'komponens', 'sub_kategori_rkbus', 'uraian_satu', 'uraian_dua'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RkbuModalKantor $rkbuModalKantor)
    { { {
                // Pastikan session 'id_user' dan 'tahun_anggaran' tersedia
                if (!session()->has('id_user') || !session()->has('tahun_anggaran')) {
                    return redirect()->back()->with('error', 'Data session tidak tersedia. Silakan login kembali.');
                }

                // Ambil data dari session
                $id_user = session('id_user');
                $nama_tahun_anggaran = session('tahun_anggaran');

                // Validasi input
                $validator  = Validator::make(
                    $request->all(),
                    [
                        'id_sub_kategori_rkbu'          => 'required',
                        'id_kode_rekening_belanja'      => '',
                        'barang'                        => 'nullable',
                        'nama_barang'                   => 'nullable',
                        'vol_1'                         => 'required|numeric',
                        'satuan_1'                      => 'required',
                        'id_status_validasi'            => '',
                        'vol_2'                         => 'nullable|numeric',
                        'satuan_2'                      => 'nullable',
                        'spek'                          => 'nullable',
                        'harga_satuan'                  => 'required|numeric',
                        'ppn'                           => 'required|numeric',
                        'rating'                        => 'nullable',
                        'link_ekatalog'                 => 'nullable',
                        'penempatan'                    => 'nullable',
                        'upload_file_1'                  => 'nullable|mimes:pdf',
                        'upload_file_2'                  => 'nullable|mimes:pdf',
                        'upload_file_3'                  => 'nullable|mimes:pdf',
                        'upload_file_4'                  => 'nullable|mimes:pdf',
                        'standar_kebutuhan'             => 'nullable',
                        'eksisting'                     => 'nullable',
                        'kondisi_baik'                  => 'nullable',
                        'kondisi_rusak_berat'           => 'nullable',
                    ]
                );

                // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    $errorMessages = implode(' ', $errors->all());

                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
                }

                // Prioritaskan 'nama_barang' (input manual), jika ada
                $barang = $request->input('nama_barang') ?? $request->input('barang');

                // Mengatur file upload hanya jika file ada
                $rkbuModalKantor->upload_file_1 = $request->hasFile('upload_file_1') ? $request->file('upload_file_1')->store('public/uploads') : $rkbuModalKantor->upload_file_1;
                $rkbuModalKantor->upload_file_2 = $request->hasFile('upload_file_2') ? $request->file('upload_file_2')->store('public/uploads') : $rkbuModalKantor->upload_file_2;
                $rkbuModalKantor->upload_file_3 = $request->hasFile('upload_file_3') ? $request->file('upload_file_3')->store('public/uploads') : $rkbuModalKantor->upload_file_3;
                $rkbuModalKantor->upload_file_4 = $request->hasFile('upload_file_4') ? $request->file('upload_file_4')->store('public/uploads') : $rkbuModalKantor->upload_file_4;


                // Menghitung total anggaran
                $vol1 = $request->input('vol_1');
                $vol2 = $request->input('vol_2', 1);
                $harga_satuan = (int) str_replace('.', '', $request->input('harga_satuan'));
                $ppn = $request->input('ppn', 0);

                $jumlahVol = $vol1 * $vol2;
                $totalAnggaran = ($jumlahVol * $harga_satuan) + ($ppn / 100 * ($jumlahVol * $harga_satuan));
                $sisa_vol_rkbu = $jumlahVol;
                $sisa_anggaran_rkbu = $totalAnggaran;

                // Ambil id_kode_rekening_belanja dari request
                $idKodeRekeningBelanja  = '9cf603e2-e748-49f0-949f-6c3c30d42c3e';
                $idStatusValidasi       = '9cfb1f38-dc3f-436f-8c4a-ec4c4de2fcaf';

                // Isi data sesuai request
                $rkbuModalKantor->fill([
                    'id_sub_kategori_rekening'      => $request->input('id_sub_kategori_rekening'),
                    // 'id_kategori_rkbu'              => $request->input('id_kegiatan'),
                    'id_sub_kategori_rkbu'          => $request->input('id_sub_kategori_rkbu'),
                    'id_kode_rekening_belanja'      => $idKodeRekeningBelanja,
                    'id_user'                       => $id_user,
                    'nama_barang'                   => $barang,
                    'vol_1'                         => $vol1,
                    'satuan_1'                      => $request->input('satuan_1'),
                    'id_status_validasi'            => $idStatusValidasi,
                    'vol_2'                         => $vol2,
                    'satuan_2'                      => $request->input('satuan_2'),
                    'jumlah_vol'                    => $jumlahVol,
                    'spek'                          => $request->input('spek'),
                    'harga_satuan'                  => $harga_satuan,
                    'ppn'                           => $ppn,
                    'total_anggaran'                => $totalAnggaran,
                    'rating'                        => $request->input('rating'),
                    'link_ekatalog'                 => $request->input('link_ekatalog'),
                    'nama_tahun_anggaran'           => $nama_tahun_anggaran,
                    'penempatan'                    => $request->input('penempatan'),
                    'upload_file_1'                 => $rkbuModalKantor->upload_file_1,
                    'upload_file_2'                 => $rkbuModalKantor->upload_file_2,
                    'upload_file_3'                 => $rkbuModalKantor->upload_file_3,
                    'upload_file_4'                 => $rkbuModalKantor->upload_file_4,
                    'id_status_validasi_rka'         => $request->input('id_status_validasi_rka', '9cfb1f93-70fb-4b88-bff9-a3ae6e81ae34'), // Berikan nilai default jika kosong
                    'stok'                           => $request->input('stok', 0),
                    'rata_rata_pemakaian'            => $request->input('rata_rata_pemakaian', 0),
                    'kebutuhan_per_bulan'            => $request->input('kebutuhan_per_bulan', 0),
                    'buffer'                         => $request->input('buffer', 0),
                    'pengadaan_sebelumnya'           => $request->input('pengadaan_sebelumnya', 0),
                    'proyeksi_sisa_stok'             => $request->input('proyeksi_sisa_stok', 0),
                    'kebutuhan_plus_buffer'          => $request->input('kebutuhan_plus_buffer', 0),
                    'kebutuhan_tahun_x1'             => $request->input('kebutuhan_tahun_x1', 0),
                    'rencana_pengadaan_tahun_x1'     => $request->input('rencana_pengadaan_tahun_x1', 0),
                    'nama_pegawai'                   => $request->input('nama_pegawai', 0),
                    'tempat_lahir'                   => $request->input('tempat_lahir', 0),
                    'tanggal_lahir'                   => $request->input('tanggal_lahir', 0),
                    'pendidikan'                     => $request->input('pendidikan', 0),
                    'jabatan'                        => $request->input('jabatan', 0),

                    'status_kawin'                     => $request->input('status_kawin', 0),
                    'nomor_kontrak'                     => $request->input('nomor_kontrak', 0),
                    'tmt_pegawai'                     => $request->input('tmt_pegawai', 0),
                    'bulan_tmt'                     => $request->input('bulan_tmt', 0),
                    'tahun_tmt'                     => $request->input('tahun_tmt', 0),
                    'gaji_pokok'                     => $request->input('gaji_pokok', 0),
                    'remunerasi'                     => $request->input('remunerasi', 0),
                    'koefisien_remunerasi'           => $request->input('koefisien_remunerasi', 0),
                    'koefisien_gaji'                     => $request->input('koefisien_gaji', 0),
                    'bpjs_kesehatan'                     => $request->input('bpjs_kesehatan', 0),
                    'bpjs_tk'                     => $request->input('bpjs_tk', 0),
                    'total_gaji_pokok'                     => $request->input('total_gaji_pokok', 0),
                    'total_remunerasi'                     => $request->input('total_remunerasi', 0),
                    'sisa_vol_rkbu'                     => $sisa_vol_rkbu,
                    'sisa_anggaran_rkbu'                     => $sisa_anggaran_rkbu,
                    'standar_kebutuhan'                 => $request->input('standar_kebutuhan'),
                    'eksisting'                         => $request->input('eksisting'),
                    'kondisi_baik'                      => $request->input('kondisi_baik'),
                    'kondisi_rusak_berat'               => $request->input('kondisi_rusak_berat'),

                ]);

                // dd($rkbuModalKantor);

                // Simpan data
                $rkbuModalKantor->update();

                // Redirect dengan pesan sukses
                return redirect()->route('rkbu_modal_kantors.index')->with('success', 'Data Berhasil Ditambahkan');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RkbuModalKantor $rkbuModalKantor)
    {
        $rkbuModalKantor->delete();

        return redirect()->route('rkbu_modal_kantors.index')
            ->with('success', 'RKBU Modal Kantor deleted successfully.');
    }

    public function downloadPDFModalKantor(Request $request)
    {
        // Ambil id_user dari session
        $id_user = session('id_user');
        // Ambil tahun_anggaran dari session
        $tahunAnggaran = Session::get('tahun_anggaran');

        // Ambil sub kategori rkbu berdasarkan id_user dari session dan id_jenis_kategori_rkbu
        $sub_kategori_rkbus = SubKategoriRkbu::whereHas('rkbus', function ($query) use ($id_user, $tahunAnggaran) {
            $query->where('id_user', $id_user)
                ->where('nama_tahun_anggaran', $tahunAnggaran) // Tambahkan filter tahun anggaran
                ->whereHas('subKategoriRkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu', function ($query) {
                    $query->where('id_jenis_kategori_rkbu', '9cf70e1d-18e7-40fe-bdd3-b7dabf61877d');
                });
        })->get();

        // Ambil status validasi dari model terkait
        $status_validasi_rka = StatusValidasiRka::all();

        // Ambil data rkbu berdasarkan filter sub_kategori_rkbu
        $query = Rkbu::with([
            'subKategoriRkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu',
        ])
            ->where('id_user', $id_user) // Filter data berdasarkan id_user
            ->where('nama_tahun_anggaran', $tahunAnggaran) // Filter berdasarkan tahun anggaran dari session
            ->whereHas('subKategoriRkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu', function ($query) {
                $query->where('id_jenis_kategori_rkbu', '9cf70e1d-18e7-40fe-bdd3-b7dabf61877d');
            });

        // Cek apakah ada filter sub_kategori_rkbu yang dipilih
        if ($request->has('sub_kategori_rkbu') && $request->sub_kategori_rkbu != '') {
            $query->where('id_sub_kategori_rkbu', $request->sub_kategori_rkbu);
        }

        // Filter berdasarkan id_status_validasi_rka
        if ($request->has('id_status_validasi_rka') && $request->id_status_validasi_rka != '') {
            $query->where('id_status_validasi_rka', $request->id_status_validasi_rka);
        }

        // Dapatkan data rkbu
        $rkbus = $query->get();

        // Ambil total anggaran berdasarkan id_user dari session
        $total_anggaran = Rkbu::where('id_user', $id_user)
            ->where('nama_tahun_anggaran', $tahunAnggaran) // Filter berdasarkan tahun anggaran dari session
            ->sum('total_anggaran');

        // Ambil hierarki berdasarkan rkbus yang tersedia
        $categories = JenisBelanja::where('id_jenis_belanja', '9cdfd042-e7cc-4008-ad0e-96d0a5452721') // Filter berdasarkan id_jenis_belanja
            ->whereHas('jenis_kategori_rkbus.obyek_belanjas.kategori_rkbus.sub_kategori_rkbus.rkbus', function ($query) use ($id_user, $tahunAnggaran) {
                // Kondisi untuk id_jenis_kategori_rkbu yang spesifik dan tahun_anggaran
                $query->where('id_user', $id_user)
                    ->where('id_jenis_kategori_rkbu', '9cf70e1d-18e7-40fe-bdd3-b7dabf61877d')
                    ->where('nama_tahun_anggaran', $tahunAnggaran);
            })
            ->with([
                'jenis_kategori_rkbus' => function ($query) use ($id_user, $tahunAnggaran) {
                    $query->whereHas('obyek_belanjas.kategori_rkbus.sub_kategori_rkbus.rkbus', function ($query) use ($id_user, $tahunAnggaran) {
                        // Kondisi untuk id_jenis_kategori_rkbu dan tahun_anggaran
                        $query->where('id_user', $id_user)
                            ->where('id_jenis_kategori_rkbu', '9cf70e1d-18e7-40fe-bdd3-b7dabf61877d')
                            ->where('nama_tahun_anggaran', $tahunAnggaran);
                    });
                },
                'jenis_kategori_rkbus.obyek_belanjas' => function ($query) use ($id_user, $tahunAnggaran) {
                    $query->whereHas('kategori_rkbus.sub_kategori_rkbus.rkbus', function ($query) use ($id_user, $tahunAnggaran) {
                        // Tampilkan hanya data dengan id_user yang sesuai
                        $query->where('id_user', $id_user)
                            ->where('nama_tahun_anggaran', $tahunAnggaran);
                    });
                },
                'jenis_kategori_rkbus.obyek_belanjas.kategori_rkbus' => function ($query) use ($id_user, $tahunAnggaran) {
                    $query->whereHas('sub_kategori_rkbus.rkbus', function ($query) use ($id_user, $tahunAnggaran) {
                        // Tampilkan hanya data dengan id_user yang sesuai
                        $query->where('id_user', $id_user)
                            ->where('nama_tahun_anggaran', $tahunAnggaran);
                    });
                },
                'jenis_kategori_rkbus.obyek_belanjas.kategori_rkbus.sub_kategori_rkbus' => function ($query) use ($id_user, $tahunAnggaran) {
                    $query->whereHas('rkbus', function ($query) use ($id_user, $tahunAnggaran) {
                        // Tampilkan hanya data dengan id_user dan tahun anggaran yang sesuai
                        $query->where('id_user', $id_user)
                            ->where('nama_tahun_anggaran', $tahunAnggaran);
                    });
                }
            ])->get();

        // Generate PDF dengan data
        $pdf = PDF::loadView('frontend.prints.print_rkbu_modal_kantor', compact('rkbus', 'sub_kategori_rkbus', 'status_validasi_rka', 'total_anggaran', 'categories'));

        // Tampilkan PDF sebagai preview di browser
        return $pdf->stream('rkbu_data_preview.pdf');
    }
}
