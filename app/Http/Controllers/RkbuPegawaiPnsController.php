<?php

namespace App\Http\Controllers;

use App\Models\Rkbu;
use App\Models\Komponen;
use App\Models\UraianDua;
use App\Models\UraianSatu;
use App\Helpers\Breadcrumb;
use App\Models\JenisBelanja;
use Illuminate\Http\Request;
use App\Models\TahunAnggaran;
use App\Models\RkbuPegawaiPns;
use App\Models\RkbuModalKantor;
use App\Models\SubKategoriRkbu;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\StatusValidasiRka;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RkbuPegawaiPnsController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumbs = Breadcrumb::generate();
        // Ambil id_user dari session
        $id_user = session('id_user');
        $tahunAnggaran = Session::get('tahun_anggaran');

        // Ambil sub kategori rkbu berdasarkan id_user dari session
        $sub_kategori_rkbus = SubKategoriRkbu::whereHas('rkbus', function ($query) use ($id_user, $tahunAnggaran) {
            $query->where('id_user', $id_user)
                ->where('nama_tahun_anggaran', $tahunAnggaran)
                ->whereHas('subKategoriRkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu', function ($query) {
                    $query->where('id_jenis_kategori_rkbu', '9cdfd329-6524-4d3f-aca5-93eade93046d');
                });
        })->get();

        $status_validasi_rka = StatusValidasiRka::all(); // Ambil status validasi dari model terkait

        // Ambil data rkbu berdasarkan filter sub_kategori_rkbu
        $query = RkbuPegawaiPns::with([
            'rekening_belanjas.aktivitas.sub_kegiatan.sumber_dana',
            'rekening_belanjas.aktivitas.sub_kegiatan.kegiatan.program',
            'sub_kategori_rkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu',
        ])
            ->where('id_user', $id_user) // Filter data berdasarkan id_user
            ->where('nama_tahun_anggaran', $tahunAnggaran)
            ->whereHas('sub_kategori_rkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu', function ($query) {
                $query->where('id_jenis_kategori_rkbu', '9cdfd329-6524-4d3f-aca5-93eade93046d');
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
        $total_anggaran = RkbuPegawaiPns::where('id_user', $id_user)
            ->whereHas('sub_kategori_rkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu', function ($query) {
                $query->where('id_jenis_kategori_rkbu', '9cdfd329-6524-4d3f-aca5-93eade93046d');
            })
            ->sum('total_anggaran');

        return view('frontend.rkbu.pegawai_pns.index', compact('rkbus', 'breadcrumbs', 'sub_kategori_rkbus', 'status_validasi_rka', 'total_anggaran'));
    }

    public function create()
    {
        $komponens              = Komponen::all();
        $sub_kategori_rkbus     = SubKategoriRkbu::join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
            ->where('jenis_kategori_rkbus.id_jenis_kategori_rkbu', '9cdfd329-6524-4d3f-aca5-93eade93046d')
            ->select('sub_kategori_rkbus.*') // Pilih kolom yang diinginkan dari sub_kategori_rkbus
            ->get();

        $uraian_satu            = UraianSatu::all();
        $uraian_dua             = UraianDua::all();
        // dd($uraian_satus);
        return view('frontend.rkbu.pegawai_pns.create', compact('komponens', 'sub_kategori_rkbus', 'uraian_satu', 'uraian_dua'));
    }

    public function store(Request $request)
    {
        // Pastikan session 'id_user' dan 'tahun_anggaran' tersedia
        if (!session()->has('id_user') || !session()->has('tahun_anggaran')) {
            return redirect()->back()->with('error', 'Data session tidak tersedia. Silakan login kembali.');
        }

        // Ambil data dari session
        $id_user = session('id_user');
        $nama_tahun_anggaran = session('tahun_anggaran');

        $tahunAnggaran       = Session::get('tahun_anggaran');
        $faseTahun  = TahunAnggaran::where('nama_tahun_anggaran', $tahunAnggaran)->value('fase_tahun');

        // Tentukan nilai status_komponen berdasarkan session 'nama_fase'
        $status_komponen = null; // Default null
        if ($faseTahun == 'Penetapan') {
            $status_komponen = 'Komponen Baru';
        } elseif ($faseTahun == 'Perubahan') {
            $status_komponen = 'Komponen Perubahan';
        }

        // Validasi input
        $validator  = Validator::make(
            $request->all(),
            [

                'id_sub_kategori_rkbu'              => 'required',
                'id_kode_rekening_belanja'          => 'required',
                'id_user'                           => 'required',
                'total_anggaran'                    => 'required',
                'nama_tahun_anggaran'               => 'required',
                'id_status_validasi'                => '',
                'nama_pegawai'                      => 'nullable',
                'tempat_lahir'                      => 'nullable',
                'tanggal_lahir'                     => 'nullable',
                'pendidikan'                        => 'nullable',
                'status_kawin'                      => 'nullable',
                'nomor_kontrak'                     => 'nullable',
                'tmt_pegawai'                       => 'nullable',
                'bulan_tmt'                         => 'nullable',
                'tahun_tmt'                         => 'nullable',
                'gaji_pokok'                        => 'nullable',
                'remunerasi'                        => 'nullable',
                'koefisien_remunerasi'              => 'nullable',
                'koefisien_gaji'                    => 'nullable',
                'bpjs_kesehatan'                    => 'nullable',
                'bpjs_tk'                           => 'nullable',
                'total_gaji_pokok'                  => 'nullable',
                'total_remunerasi'                  => 'nullable',
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


        // Ambil id_kode_rekening_belanja dari request
        $idKodeRekeningBelanja  = '9cf6040a-2759-4d16-a3cf-3eee5194a2d5'; // ID Belanja Modal Peralatan dan Mesin BLUD
        $idStatusValidasi       = '9cfb1f38-dc3f-436f-8c4a-ec4c4de2fcaf'; // Status Validasi Default

        // Inisialisasi model Rkbu dan tentukan fillable dinamis
        $RkbuPegawai = new RkbuPegawaiPns();

        $gaji_pokok                     = $request->input('gaji_pokok');
        $koefisien_gaji                 = $request->input('koefisien_gaji');
        $remunerasi                     = $request->input('remunerasi');
        $koefisien_remunerasi           = $request->input('koefisien_remunerasi');
        $koefisien_gaji                 = $request->input('koefisien_gaji');
        $bpjs_kesehatan                 = $request->input('bpjs_kesehatan');
        $bpjs_tk                        = $request->input('bpjs_tk');
        $bpjs_jht                       = $request->input('bpjs_jht');
        $total_gaji_pokok               = $gaji_pokok * $koefisien_gaji;
        $total_remunerasi               = $remunerasi * $koefisien_remunerasi;
        $jumlah_vol                     = $koefisien_remunerasi;
        $sisa_vol_rkbu                  = $jumlah_vol;

        // Update field secara manual tanpa mass assignment
        $RkbuPegawai->satuan_1                      = $request->input('satuan_1', 0);
        $RkbuPegawai->vol_2                         = $request->input('vol_2', 0);
        $RkbuPegawai->satuan_2                      = $request->input('satuan_2', 0);
        $RkbuPegawai->spek                          = $request->input('spek', 0);
        $RkbuPegawai->harga_satuan                  = $request->input('harga_satuan', 0);
        $RkbuPegawai->ppn                           = $request->input('ppn', 0);
        $RkbuPegawai->rating                        = $request->input('rating', 0);
        $RkbuPegawai->link_ekatalog                 = $request->input('link_ekatalog', 0);
        $RkbuPegawai->penempatan                    = $request->input('penempatan', 0);
        $RkbuPegawai->vol_1                         = $request->input('vol_1', 0);
        $RkbuPegawai->vol_1                         = $request->input('vol_1', 0);
        $RkbuPegawai->stok                          = $request->input('stok', 0);
        $RkbuPegawai->rata_rata_pemakaian           = $request->input('rata_rata_pemakaian', 0);
        $RkbuPegawai->kebutuhan_per_bulan           = $request->input('kebutuhan_per_bulan', 0);
        $RkbuPegawai->buffer                        = $request->input('buffer', 0);
        $RkbuPegawai->pengadaan_sebelumnya          = $request->input('pengadaan_sebelumnya', 0);
        $RkbuPegawai->proyeksi_sisa_stok            = $request->input('proyeksi_sisa_stok', 0);
        $RkbuPegawai->kebutuhan_plus_buffer         = $request->input('kebutuhan_plus_buffer', 0);
        $RkbuPegawai->kebutuhan_tahun_x1            = $request->input('kebutuhan_tahun_x1', 0);
        $RkbuPegawai->rencana_pengadaan_tahun_x1    = $request->input('rencana_pengadaan_tahun_x1', 0);
        $RkbuPegawai->id_sub_kategori_rekening    = $request->input('id_sub_kategori_rekening');
        $RkbuPegawai->id_sub_kategori_rkbu        = $request->input('id_sub_kategori_rkbu');
        $RkbuPegawai->id_kode_rekening_belanja    = $idKodeRekeningBelanja;
        $RkbuPegawai->id_user                     = $id_user;
        $RkbuPegawai->nama_barang                 = $request->input('nama_barang', 0);
        $RkbuPegawai->nama_tahun_anggaran         = $nama_tahun_anggaran;
        $RkbuPegawai->id_status_validasi          = $idStatusValidasi;
        $RkbuPegawai->id_status_validasi_rka      = $request->input('id_status_validasi_rka', '9cfb1f93-70fb-4b88-bff9-a3ae6e81ae34'); // Berikan nilai default jika kosong
        $RkbuPegawai->jumlah_vol                  = $koefisien_remunerasi;
        $RkbuPegawai->nama_pegawai                = $request->input('nama_pegawai');
        $RkbuPegawai->tempat_lahir                = $request->input('tempat_lahir');
        $RkbuPegawai->tanggal_lahir               = $request->input('tanggal_lahir');
        $RkbuPegawai->jabatan                     = $request->input('jabatan');
        $RkbuPegawai->pendidikan                  = $request->input('pendidikan');
        $RkbuPegawai->status_kawin                = $request->input('status_kawin');
        $RkbuPegawai->nomor_kontrak               = $request->input('nomor_kontrak');
        $RkbuPegawai->tmt_pegawai                 = $request->input('tmt_pegawai');
        $RkbuPegawai->bulan_tmt                   = $request->input('bulan_tmt');
        $RkbuPegawai->tahun_tmt                   = $request->input('tahun_tmt');
        $RkbuPegawai->gaji_pokok                  = $request->input('gaji_pokok');
        $RkbuPegawai->remunerasi                  = $remunerasi;
        $RkbuPegawai->koefisien_remunerasi        = $koefisien_remunerasi;
        $RkbuPegawai->koefisien_gaji              = $koefisien_gaji;
        $RkbuPegawai->bpjs_kesehatan              = $bpjs_kesehatan;
        $RkbuPegawai->bpjs_tk                     = $bpjs_tk;
        $RkbuPegawai->bpjs_jht                    = $bpjs_jht;
        $RkbuPegawai->total_gaji_pokok            = $total_gaji_pokok;
        $RkbuPegawai->total_remunerasi            = $total_remunerasi;
        $RkbuPegawai->total_anggaran              = ($remunerasi * $koefisien_remunerasi) +
            (($gaji_pokok * ($bpjs_kesehatan / 100)) * $koefisien_gaji) +
            (($gaji_pokok * ($bpjs_tk / 100)) * $koefisien_gaji) +
            (($gaji_pokok * ($bpjs_jht / 100) * $koefisien_gaji)) + ($gaji_pokok * $koefisien_gaji);
        $RkbuPegawai->sisa_vol_rkbu              = $sisa_vol_rkbu;
        $RkbuPegawai->sisa_anggaran_rkbu         = ($remunerasi * $koefisien_remunerasi) +
            (($gaji_pokok * ($bpjs_kesehatan / 100)) * $koefisien_gaji) +
            (($gaji_pokok * ($bpjs_tk / 100)) * $koefisien_gaji) +
            (($gaji_pokok * ($bpjs_jht / 100) * $koefisien_gaji)) + ($gaji_pokok * $koefisien_gaji);
        $RkbuPegawai->status_komponen            = $status_komponen;

        // dd($RkbuPegawai);

        // Simpan data
        $RkbuPegawai->save();

        // Redirect dengan pesan sukses
        return redirect()->route('rkbu_pegawai_pnss.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function show(RkbuPegawaiPns $rkbuModalKantor)
    {
        //
    }

    public function getDataBySubKategori(Request $request)
    {
        $data = DB::table('sub_kategori_rkbus')
            ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('sub_kategori_rekenings', 'sub_kategori_rkbus.id_sub_kategori_rekening', '=', 'sub_kategori_rekenings.id_sub_kategori_rekening')
            ->join('kategori_rekenings', 'sub_kategori_rekenings.id_kategori_rekening', '=', 'kategori_rekenings.id_kategori_rekening')

            ->select(
                'sub_kategori_rkbus.id_admin_pendukung_ppk',
                'sub_kategori_rkbus.id_kategori_rkbu',
                'sub_kategori_rkbus.id_sub_kategori_rekening',
                'kategori_rekenings.nama_kategori_rekening',
                'kategori_rekenings.kode_kategori_rekening',
                'sub_kategori_rekenings.id_kategori_rekening',
                'sub_kategori_rekenings.kode_sub_kategori_rekening',
                'sub_kategori_rekenings.nama_sub_kategori_rekening',
            )
            ->where('sub_kategori_rkbus.id_sub_kategori_rkbu', $request->id_sub_kategori_rkbu)
            ->first();

        return response()->json($data);
    }

    public function edit($id)
    {
        $pegawai = RkbuPegawaiPns::with([
            'rekening_belanjas.aktivitas.sub_kegiatan.sumber_dana',
            'rekening_belanjas.aktivitas.sub_kegiatan.kegiatan.program',
        ])->findOrFail($id);

        $komponens                  = Komponen::all();
        $sub_kategori_rkbus         = SubKategoriRkbu::all();

        return view('frontend.rkbu.pegawai_pns.edit', compact('pegawai', 'komponens', 'sub_kategori_rkbus'));
    }

    public function update(Request $request, $id)
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
                        'id_kode_rekening_belanja'      => 'required',
                        'id_user'                       => 'required',
                        'total_anggaran'                => 'required',
                        'nama_tahun_anggaran'           => 'required',
                        'id_status_validasi'            => '',
                        'nama_pegawai'                   => 'nullable',
                        'tempat_lahir'                   => 'nullable',
                        'tanggal_lahir'                     => 'nullable',
                        'pendidikan'                        => 'nullable',
                        'status_kawin'                      => 'nullable',
                        'nomor_kontrak'                     => 'nullable',
                        'tmt_pegawai'                       => 'nullable',
                        'bulan_tmt'                         => 'nullable',
                        'tahun_tmt'                         => 'nullable',
                        'gaji_pokok'                        => 'nullable',
                        'remunerasi'                        => 'nullable',
                        'koefisien_remunerasi'              => 'nullable',
                        'koefisien_gaji'                    => 'nullable',
                        'bpjs_kesehatan'                    => 'nullable',
                        'bpjs_tk'                           => 'nullable',
                        'total_gaji_pokok'                  => 'nullable',
                        'total_remunerasi'                  => 'nullable',
                    ]
                );


                // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
                $RkbuPegawai = RkbuPegawaiPns::find($id);
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    $errorMessages = implode(' ', $errors->all());

                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
                }


                $tahunAnggaran       = Session::get('tahun_anggaran');
                $faseTahun  = TahunAnggaran::where('nama_tahun_anggaran', $tahunAnggaran)->value('fase_tahun');

                // Tentukan nilai status_komponen berdasarkan session 'nama_fase'
                $status_komponen = null; // Default null
                if ($faseTahun == 'Penetapan') {
                    $status_komponen = 'Komponen Baru';
                } elseif ($faseTahun == 'Perubahan') {
                    $status_komponen = 'Komponen Perubahan';
                }


                // Ambil id_kode_rekening_belanja dari request
                $idKodeRekeningBelanja  = '9cf6040a-2759-4d16-a3cf-3eee5194a2d5'; // ID Belanja Modal Peralatan dan Mesin BLUD
                $idStatusValidasi       = '9cfb1f38-dc3f-436f-8c4a-ec4c4de2fcaf'; // Status Validasi Default

                // // Inisialisasi model Rkbu dan tentukan fillable dinamis
                // $RkbuPegawai = new RkbuPegawaiPns();

                $gaji_pokok                     = $request->input('gaji_pokok');
                $koefisien_gaji                 = $request->input('koefisien_gaji');
                $remunerasi                     = $request->input('remunerasi');
                $koefisien_remunerasi           = $request->input('koefisien_remunerasi');
                $koefisien_gaji                 = $request->input('koefisien_gaji');
                $bpjs_kesehatan                 = $request->input('bpjs_kesehatan');
                $bpjs_tk                        = $request->input('bpjs_tk');
                $bpjs_jht                       = $request->input('bpjs_jht');
                $total_gaji_pokok               = $gaji_pokok * $koefisien_gaji;
                $total_remunerasi               = $remunerasi * $koefisien_remunerasi;
                $jumlah_vol                     = $koefisien_remunerasi;
                $sisa_vol_rkbu                  = $jumlah_vol;

                $RkbuPegawai->satuan_1                      = $request->input('satuan_1', 0);
                $RkbuPegawai->vol_2                         = $request->input('vol_2', 0);
                $RkbuPegawai->satuan_2                      = $request->input('satuan_2', 0);
                $RkbuPegawai->spek                          = $request->input('spek', 0);
                $RkbuPegawai->harga_satuan                  = $request->input('harga_satuan', 0);
                $RkbuPegawai->ppn                           = $request->input('ppn', 0);
                $RkbuPegawai->rating                        = $request->input('rating', 0);
                $RkbuPegawai->link_ekatalog                 = $request->input('link_ekatalog', 0);
                $RkbuPegawai->penempatan                    = $request->input('penempatan', 0);
                $RkbuPegawai->vol_1                           = $request->input('vol_1', 0);
                $RkbuPegawai->vol_1                           = $request->input('vol_1', 0);
                $RkbuPegawai->stok                           = $request->input('stok', 0);
                $RkbuPegawai->rata_rata_pemakaian            = $request->input('rata_rata_pemakaian', 0);
                $RkbuPegawai->kebutuhan_per_bulan            = $request->input('kebutuhan_per_bulan', 0);
                $RkbuPegawai->buffer                         = $request->input('buffer', 0);
                $RkbuPegawai->pengadaan_sebelumnya           = $request->input('pengadaan_sebelumnya', 0);
                $RkbuPegawai->proyeksi_sisa_stok             = $request->input('proyeksi_sisa_stok', 0);
                $RkbuPegawai->kebutuhan_plus_buffer          = $request->input('kebutuhan_plus_buffer', 0);
                $RkbuPegawai->kebutuhan_tahun_x1             = $request->input('kebutuhan_tahun_x1', 0);
                $RkbuPegawai->rencana_pengadaan_tahun_x1     = $request->input('rencana_pengadaan_tahun_x1', 0);
                $RkbuPegawai->id_sub_kategori_rekening    = $request->input('id_sub_kategori_rekening');
                $RkbuPegawai->id_sub_kategori_rkbu        = $request->input('id_sub_kategori_rkbu');
                $RkbuPegawai->id_kode_rekening_belanja    = $idKodeRekeningBelanja;
                $RkbuPegawai->id_user                     = $id_user;
                $RkbuPegawai->nama_barang                 = $request->input('nama_barang', 0);
                $RkbuPegawai->nama_tahun_anggaran         = $nama_tahun_anggaran;
                $RkbuPegawai->id_status_validasi          = $idStatusValidasi;
                $RkbuPegawai->jumlah_vol                  = $koefisien_remunerasi;
                $RkbuPegawai->nama_pegawai                = $request->input('nama_pegawai');
                $RkbuPegawai->tempat_lahir                = $request->input('tempat_lahir');
                $RkbuPegawai->tanggal_lahir               = $request->input('tanggal_lahir');
                $RkbuPegawai->jabatan                     = $request->input('jabatan');
                $RkbuPegawai->pendidikan                  = $request->input('pendidikan');
                $RkbuPegawai->status_kawin                = $request->input('status_kawin');
                $RkbuPegawai->nomor_kontrak               = $request->input('nomor_kontrak');
                $RkbuPegawai->tmt_pegawai                 = $request->input('tmt_pegawai');
                $RkbuPegawai->bulan_tmt                   = $request->input('bulan_tmt');
                $RkbuPegawai->tahun_tmt                   = $request->input('tahun_tmt');
                $RkbuPegawai->gaji_pokok                  = $request->input('gaji_pokok');
                $RkbuPegawai->remunerasi                  = $remunerasi;
                $RkbuPegawai->koefisien_remunerasi        = $koefisien_remunerasi;
                $RkbuPegawai->koefisien_gaji              = $koefisien_gaji;
                $RkbuPegawai->bpjs_kesehatan              = $bpjs_kesehatan;
                $RkbuPegawai->bpjs_tk                     = $bpjs_tk;
                $RkbuPegawai->bpjs_jht                    = $bpjs_jht;
                $RkbuPegawai->total_gaji_pokok            = $total_gaji_pokok;
                $RkbuPegawai->total_remunerasi            = $total_remunerasi;
                $RkbuPegawai->total_anggaran              = ($remunerasi * $koefisien_remunerasi) +
                    (($gaji_pokok * ($bpjs_kesehatan / 100)) * $koefisien_gaji) +
                    (($gaji_pokok * ($bpjs_tk / 100)) * $koefisien_gaji) +
                    (($gaji_pokok * ($bpjs_jht / 100) * $koefisien_gaji)) + ($gaji_pokok * $koefisien_gaji);
                $RkbuPegawai->sisa_vol_rkbu              = $sisa_vol_rkbu;
                $RkbuPegawai->sisa_anggaran_rkbu         = ($remunerasi * $koefisien_remunerasi) +
                    (($gaji_pokok * ($bpjs_kesehatan / 100)) * $koefisien_gaji) +
                    (($gaji_pokok * ($bpjs_tk / 100)) * $koefisien_gaji) +
                    (($gaji_pokok * ($bpjs_jht / 100) * $koefisien_gaji)) + ($gaji_pokok * $koefisien_gaji);
                $RkbuPegawai->status_komponen            = $status_komponen;

                // dd($RkbuPegawai);

                // Simpan data
                $RkbuPegawai->update();

                // Redirect dengan pesan sukses
                return redirect()->route('rkbu_pegawai_pnss.index')->with('success', 'Data Berhasil Ditambahkan');
            }
        }
    }

    public function destroy(RkbuPegawaiPns $RkbuPegawai)
    {
        $RkbuPegawai->delete();

        return redirect()->route('rkbu_pegawai_pnss.index')
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
                    $query->where('id_jenis_kategori_rkbu', '9cdfd329-6524-4d3f-aca5-93eade93046d');
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
                $query->where('id_jenis_kategori_rkbu', '9cdfd329-6524-4d3f-aca5-93eade93046d');
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
                    ->where('id_jenis_kategori_rkbu', '9cdfd329-6524-4d3f-aca5-93eade93046d')
                    ->where('nama_tahun_anggaran', $tahunAnggaran);
            })
            ->with([
                'jenis_kategori_rkbus' => function ($query) use ($id_user, $tahunAnggaran) {
                    $query->whereHas('obyek_belanjas.kategori_rkbus.sub_kategori_rkbus.rkbus', function ($query) use ($id_user, $tahunAnggaran) {
                        // Kondisi untuk id_jenis_kategori_rkbu dan tahun_anggaran
                        $query->where('id_user', $id_user)
                            ->where('id_jenis_kategori_rkbu', '9cdfd329-6524-4d3f-aca5-93eade93046d')
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
