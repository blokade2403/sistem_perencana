<?php

namespace App\Http\Controllers\Validasi;

use App\Models\Rkbu;
use App\Models\User;
use App\Models\Komponen;
use App\Models\UraianDua;
use App\Models\UraianSatu;
use App\Models\JenisBelanja;
use Illuminate\Http\Request;
use App\Models\RkbuBarangJasa;
use App\Models\StatusValidasi;
use App\Models\SubKategoriRkbu;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\StatusValidasiRka;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ValidasiRkbuModalKsp extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil id_ksp dari session
        $id_ksp = session('id_ksp');

        $id_user = session('id_user');
        $tahunAnggaran = Session::get('tahun_anggaran');
        $status_validasi_rka = StatusValidasi::all(); // Ambil status validasi dari model terkait


        // Ambil sub kategori rkbu berdasarkan id_user dari session dan id_jenis_kategori_rkbu
        $sub_kategori_rkbus = SubKategoriRkbu::whereHas('kategoriRkbu.jenis_kategori_rkbu', function ($query) {
            $query->whereIn('id_jenis_kategori_rkbu', [
                '9cf70e1d-18e7-40fe-bdd3-b7dabf61877d',
                '9cf70e31-9b9e-4dea-8b39-5459f23f3f51'
            ]);
        })
            ->whereHas('rkbus.user.ksp', function ($query) use ($id_ksp) {
                $query->where('id_ksp', $id_ksp);
            })
            ->whereHas('rkbus', function ($query) use ($tahunAnggaran) {
                $query->where('nama_tahun_anggaran', $tahunAnggaran);
            })
            ->get();

        $query = Rkbu::join('users', 'rkbus.id_user', '=', 'users.id_user')
            ->join('ksps', 'users.id_ksp', '=', 'ksps.id_ksp')
            ->join('sub_kategori_rkbus', 'rkbus.id_sub_kategori_rkbu', '=', 'sub_kategori_rkbus.id_sub_kategori_rkbu')
            ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
            ->where('ksps.id_ksp', $id_ksp)
            ->where('rkbus.nama_tahun_anggaran', $tahunAnggaran)
            ->whereIn('jenis_kategori_rkbus.id_jenis_kategori_rkbu', ['9cf70e1d-18e7-40fe-bdd3-b7dabf61877d', '9cf70e31-9b9e-4dea-8b39-5459f23f3f51']);

        // Cek apakah ada filter sub_kategori_rkbu yang dipilih
        if ($request->filled('sub_kategori_rkbu')) {
            $query->where('rkbus.id_sub_kategori_rkbu', $request->sub_kategori_rkbu);
        }

        // Filter berdasarkan id_status_validasi_rka
        if ($request->filled('id_status_validasi_rka')) {
            $query->where('rkbus.id_status_validasi_rka', $request->id_status_validasi_rka);
        }

        // Dapatkan data rkbu setelah filter
        $rkbus = $query->select('rkbus.*')->get();

        // Hitung total anggaran dari data yang diambil
        $total_anggaran = $rkbus->sum('total_anggaran');

        return view('frontend.validasi.modal.index', compact('rkbus', 'total_anggaran', 'sub_kategori_rkbus', 'status_validasi_rka'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rkbuBarangJasa = RkbuBarangJasa::with([
            'rekening_belanjas.aktivitas.sub_kegiatan.sumber_dana',
            'rekening_belanjas.aktivitas.sub_kegiatan.kegiatan.program',
            'status_validasi' // Memastikan relasi status_validasi juga dipanggil
        ])->findOrFail($id);

        $komponens              = Komponen::all();
        $sub_kategori_rkbus     = SubKategoriRkbu::join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
            ->whereIn('jenis_kategori_rkbus.id_jenis_kategori_rkbu', ['9cf70e1d-18e7-40fe-bdd3-b7dabf61877d', '9cf70e31-9b9e-4dea-8b39-5459f23f3f51'])
            ->select('sub_kategori_rkbus.*') // Pilih kolom yang diinginkan dari sub_kategori_rkbus
            ->get();

        $id_kode_rekening_belanja       = array('9cf70e1d-18e7-40fe-bdd3-b7dabf61877d', '9cf70e31-9b9e-4dea-8b39-5459f23f3f51');

        $uraian_satu                = UraianSatu::all();
        $uraian_dua                 = UraianDua::all();
        $status_validasi            = StatusValidasi::all();

        return view('frontend.validasi.modal.edit', compact('rkbuBarangJasa', 'status_validasi', 'komponens', 'sub_kategori_rkbus', 'uraian_satu', 'uraian_dua', 'id_kode_rekening_belanja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Pastikan session 'id_user' dan 'tahun_anggaran' tersedia
        if (!session()->has('id_user') || !session()->has('tahun_anggaran')) {
            return redirect()->back()->with('error', 'Data session tidak tersedia. Silakan login kembali.');
        }

        // Ambil data dari session
        $id_user = session('id_user');
        $nama_tahun_anggaran = session('tahun_anggaran');

        // Validasi input
        $validatedData = $request->validate([
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
        ]);

        // Temukan data berdasarkan ID
        $validasiRkbuBarjasKsp = RkbuBarangJasa::find($id);

        // dd($validasiRkbuBarjasKsp);

        // Pastikan data ditemukan sebelum update
        if (!$validasiRkbuBarjasKsp) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        // Mengatur file upload hanya jika file ada
        $namaFile1 = $request->hasFile('upload_file_1') ? $request->file('upload_file_1')->store('public/uploads') : null;
        $namaFile2 = $request->hasFile('upload_file_2') ? $request->file('upload_file_2')->store('public/uploads') : null;
        $namaFile3 = $request->hasFile('upload_file_3') ? $request->file('upload_file_3')->store('public/uploads') : null;
        $namaFile4 = $request->hasFile('upload_file_4') ? $request->file('upload_file_4')->store('public/uploads') : null;

        $barang = $request->input('nama_barang') ?? $request->input('barang');

        // Menghitung total anggaran dan volume
        $vol1 = $request->input('vol_1');
        $vol2 = $request->input('vol_2', 1);
        $harga_satuan = (int) str_replace('.', '', $request->input('harga_satuan'));
        $ppn = $request->input('ppn', 0);

        $jumlahVol = $vol1 * $vol2;
        $totalAnggaran = ($jumlahVol * $harga_satuan) + ($ppn / 100 * ($jumlahVol * $harga_satuan));
        $sisa_vol_rkbu = $jumlahVol;
        $sisa_anggaran_rkbu = $totalAnggaran;

        $idKodeRekeningBelanja  = '9cf603bb-bfd0-4b1e-8a24-7339459d9507';

        // Update field secara manual tanpa mass assignment
        $validasiRkbuBarjasKsp->id_sub_kategori_rekening    = $request->input('id_sub_kategori_rekening');
        $validasiRkbuBarjasKsp->id_sub_kategori_rkbu        = $request->input('id_sub_kategori_rkbu');
        $validasiRkbuBarjasKsp->nama_barang                 = $request->input('nama_barang');
        $validasiRkbuBarjasKsp->vol_1                       = $vol1;
        $validasiRkbuBarjasKsp->vol_2                       = $vol2;
        $validasiRkbuBarjasKsp->satuan_1                    = $request->input('satuan_1');
        $validasiRkbuBarjasKsp->satuan_2                    = $request->input('satuan_2');
        $validasiRkbuBarjasKsp->jumlah_vol                  = $jumlahVol;
        $validasiRkbuBarjasKsp->harga_satuan                = $harga_satuan;
        $validasiRkbuBarjasKsp->ppn                         = $ppn;
        $validasiRkbuBarjasKsp->spek                        = $request->input('spek');
        $validasiRkbuBarjasKsp->rating                      = $request->input('rating');
        $validasiRkbuBarjasKsp->link_ekatalog               = $request->input('link_ekatalog');
        $validasiRkbuBarjasKsp->total_anggaran              = $totalAnggaran;
        $validasiRkbuBarjasKsp->id_status_validasi          = $request->input('id_status_validasi');
        $validasiRkbuBarjasKsp->penempatan                  = $request->input('penempatan');

        if (isset($upload_file_1)) {
            $validasiRkbuBarjasKsp->upload_file_1 = $upload_file_1;
        }
        if (isset($upload_file_2)) {
            $validasiRkbuBarjasKsp->upload_file_2 = $upload_file_2;
        }
        if (isset($upload_file_3)) {
            $validasiRkbuBarjasKsp->upload_file_3 = $upload_file_3;
        }
        if (isset($upload_file_4)) {
            $validasiRkbuBarjasKsp->upload_file_4 = $upload_file_4;
        }

        // Update data
        $validasiRkbuBarjasKsp->save();

        // Hitung akumulasi usulan_barang_details.jumlah_usulan_barang dan total_anggaran_usulan_barang
        $id_rkbu = $validasiRkbuBarjasKsp->id_rkbu;

        $totalJumlahUsulan = DB::table('usulan_barang_details')
            ->where('id_rkbu', $id_rkbu)
            ->sum('jumlah_usulan_barang');

        $totalAnggaranUsulan = DB::table('usulan_barang_details')
            ->where('id_rkbu', $id_rkbu)
            ->sum('total_anggaran_usulan_barang');

        // Update sisa_vol_rkbu dan sisa_anggaran_rkbu pada tabel rkbus
        DB::table('rkbus')
            ->where('id_rkbu', $id_rkbu)
            ->update([
                'sisa_vol_rkbu' => $jumlahVol - $totalJumlahUsulan,
                'sisa_anggaran_rkbu' => $totalAnggaran - $totalAnggaranUsulan
            ]);

        // Redirect dengan pesan sukses
        return redirect()->route('validasi_modals.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function downloadPDF(Request $request)
    {
        // Ambil id_user dari session
        $id_ksp = session('id_ksp');
        $id_user = session('id_user');
        $tahunAnggaran = Session::get('tahun_anggaran');
        $status_validasi_rka = StatusValidasiRka::all(); // Ambil status validasi dari model terkait

        // Ambil sub kategori rkbu berdasarkan id_user dari session dan id_jenis_kategori_rkbu
        $sub_kategori_rkbus = SubKategoriRkbu::whereHas('rkbus', function ($query) use ($tahunAnggaran) {
            $query->where('nama_tahun_anggaran', $tahunAnggaran) // Tambahkan filter tahun anggaran
                ->whereHas('subKategoriRkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu', function ($query) {
                    $query->whereIn('jenis_kategori_rkbus.id_jenis_kategori_rkbu', [
                        '9cf70e1d-18e7-40fe-bdd3-b7dabf61877d',
                        '9cf70e31-9b9e-4dea-8b39-5459f23f3f51'
                    ]);
                });
        })
            ->whereHas('rkbus.user.ksp', function ($query) use ($id_ksp) {
                $query->where('id_ksp', $id_ksp);
            })
            ->whereHas('rkbus', function ($query) use ($tahunAnggaran) {
                $query->where('nama_tahun_anggaran', $tahunAnggaran);
            })
            ->get();

        // Ambil status validasi dari model terkait
        $status_validasi_rka = StatusValidasiRka::all();

        // Ambil data rkbu berdasarkan filter sub_kategori_rkbu
        $query = Rkbu::join('users', 'rkbus.id_user', '=', 'users.id_user')
            ->join('ksps', 'users.id_ksp', '=', 'ksps.id_ksp')
            ->join('sub_kategori_rkbus', 'rkbus.id_sub_kategori_rkbu', '=', 'sub_kategori_rkbus.id_sub_kategori_rkbu')
            ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
            ->where('ksps.id_ksp', $id_ksp)
            ->where('rkbus.nama_tahun_anggaran', $tahunAnggaran)
            ->whereIn('jenis_kategori_rkbus.id_jenis_kategori_rkbu', [
                '9cf70e1d-18e7-40fe-bdd3-b7dabf61877d',
                '9cf70e31-9b9e-4dea-8b39-5459f23f3f51'
            ]);

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

        // Ambil hierarki berdasarkan rkbus yang tersedia
        $categories = JenisBelanja::where('id_jenis_belanja', '9cf5ec2e-e7c6-4cdd-8c41-24a7cd5a594e') // Filter berdasarkan id_jenis_belanja
            ->whereHas('jenis_kategori_rkbus.obyek_belanjas.kategori_rkbus.sub_kategori_rkbus.rkbus', function ($query) use ($id_ksp, $tahunAnggaran) {
                // Kondisi untuk id_jenis_kategori_rkbu yang spesifik dan tahun_anggaran
                $query->where('id_ksp', $id_ksp)
                    ->whereIn('jenis_kategori_rkbus.id_jenis_kategori_rkbu', [
                        '9cf70e1d-18e7-40fe-bdd3-b7dabf61877d',
                        '9cf70e31-9b9e-4dea-8b39-5459f23f3f51'
                    ])
                    ->where('nama_tahun_anggaran', $tahunAnggaran);
            })
            ->with([
                'jenis_kategori_rkbus' => function ($query) use ($id_ksp, $tahunAnggaran) {
                    $query->whereHas('obyek_belanjas.kategori_rkbus.sub_kategori_rkbus.rkbus', function ($query) use ($id_ksp, $tahunAnggaran) {
                        // Kondisi untuk id_jenis_kategori_rkbu dan tahun_anggaran
                        $query->where('id_ksp', $id_ksp)
                            ->whereIn('jenis_kategori_rkbus.id_jenis_kategori_rkbu', [
                                '9cf70e1d-18e7-40fe-bdd3-b7dabf61877d',
                                '9cf70e31-9b9e-4dea-8b39-5459f23f3f51'
                            ])
                            ->where('nama_tahun_anggaran', $tahunAnggaran);
                    });
                },
                'jenis_kategori_rkbus.obyek_belanjas' => function ($query) use ($id_ksp, $tahunAnggaran) {
                    $query->whereHas('kategori_rkbus.sub_kategori_rkbus.rkbus', function ($query) use ($id_ksp, $tahunAnggaran) {
                        // Tampilkan hanya data dengan id_user yang sesuai
                        $query->where('id_ksp', $id_ksp)
                            ->where('nama_tahun_anggaran', $tahunAnggaran);
                    });
                },
                'jenis_kategori_rkbus.obyek_belanjas.kategori_rkbus' => function ($query) use ($id_ksp, $tahunAnggaran) {
                    $query->whereHas('sub_kategori_rkbus.rkbus', function ($query) use ($id_ksp, $tahunAnggaran) {
                        // Tampilkan hanya data dengan id_user yang sesuai
                        $query->where('id_ksp', $id_ksp)
                            ->where('nama_tahun_anggaran', $tahunAnggaran);
                    });
                },
                'jenis_kategori_rkbus.obyek_belanjas.kategori_rkbus.sub_kategori_rkbus' => function ($query) use ($id_ksp, $tahunAnggaran) {
                    $query->whereHas('rkbus', function ($query) use ($id_ksp, $tahunAnggaran) {
                        // Tampilkan hanya data dengan id_user dan tahun anggaran yang sesuai
                        $query->where('id_ksp', $id_ksp)
                            ->where('nama_tahun_anggaran', $tahunAnggaran);
                    });
                }
            ])->get();

        // Generate PDF dengan data
        $pdf = PDF::loadView('frontend.prints.print_rkbu_barang_jasa', compact('rkbus', 'sub_kategori_rkbus', 'status_validasi_rka', 'total_anggaran', 'categories'));

        // Tampilkan PDF sebagai preview di browser
        return $pdf->stream('rkbu_data_preview.pdf');
    }
}
