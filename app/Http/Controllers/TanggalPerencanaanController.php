<?php

namespace App\Http\Controllers;

use App\Models\Fase;
use App\Models\TahunAnggaran;
use Illuminate\Http\Request;
use App\Models\TanggalPerencanaan;
use Illuminate\Support\Facades\Validator;

class TanggalPerencanaanController extends Controller
{
    public function index()
    {
        $tahun_anggarans    = TahunAnggaran::all();
        $fases              = Fase::all();
        $tanggal_perencanaans = TanggalPerencanaan::all();
        return view('backend.master_setting.tanggal_perencanaan.index', compact('tanggal_perencanaans', 'tahun_anggarans', 'fases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tahun_anggarans    = TahunAnggaran::all();
        $fases              = Fase::all();
        // dd($tahun_anggarans);
        return view('backend.master_setting.tanggal_perencanaan.create', compact('tahun_anggarans', 'fases'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validator = Validator::make(
            $request->all(),
            [
                'id_tahun_anggaran' => 'required', // Validasi tanggal dengan tipe date
                'id_fase'           => 'required', // Validasi tanggal dengan tipe date
                'tanggal'           => 'required|date', // Validasi tanggal dengan tipe date
                'no_dpa'            => 'required|string|max:255', // Validasi nomor DPA sebagai string
                'kota'              => 'required|string|max:255', // Validasi nama kota sebagai string
                'status'            => 'required|in:aktif,tidak aktif', // Validasi nilai status hanya 'aktif' atau 'tidak aktif'
            ],
            [
                'id_tahun_anggaran.required'        => 'Tahun Anggaran harus dalam format tanggal yang valid.',
                'id_fase.required'                  => 'Fase harus dalam format tanggal yang valid.',
                'tanggal.date'                      => 'Tanggal perencanaan harus dalam format tanggal yang valid.',
                'no_dpa.required'                   => 'Nomor DPA harus diisi.',
                'kota.string'                       => 'Nama kota harus berupa teks.',
                'status.in'                         => 'Status hanya boleh bernilai "aktif" atau "tidak aktif".',
            ]
        );


        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
        if ($validator->fails()) {
            // Mengambil semua pesan error
            $errors = $validator->errors();

            // Menyusun pesan error menjadi string
            $errorMessages = implode(' ', $errors->all());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
        }

        // Simpan data ke dalam database
        $tanggal_perencanaans = new TanggalPerencanaan([
            'id_tahun_anggaran'     => $request->id_tahun_anggaran,
            'id_fase'               => $request->id_fase,
            'tanggal'               => $request->tanggal,
            'no_dpa'                => $request->no_dpa,
            'kota'                  => $request->kota,
            'status'                => $request->status,
        ]);

        // dd($kategori_rkbu);

        $tanggal_perencanaans->save();

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('tanggal_perencanaans.index')->with('success', 'Tanggal Perencanaan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TanggalPerencanaan $tanggal_perencanaans)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Ambil data berdasarkan primary key
        $tahun_anggarans    = TahunAnggaran::all();
        $fases              = Fase::all();
        $tanggal_perencanaans = TanggalPerencanaan::findOrFail($id);
        return view('backend.master_setting.tanggal_perencanaan.edit', compact('tanggal_perencanaans', 'fases', 'tahun_anggarans'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data input
        $validator = Validator::make(
            $request->all(),
            [
                'id_tahun_anggaran' => 'required', // Validasi tanggal dengan tipe date
                'id_fase'           => 'required', // Validasi tanggal dengan tipe date
                'tanggal'           => 'required|date', // Validasi tanggal dengan tipe date
                'no_dpa'            => 'required|string|max:255', // Validasi nomor DPA sebagai string
                'kota'              => 'required|string|max:255', // Validasi nama kota sebagai string
                'status'            => 'required|in:aktif,tidak aktif', // Validasi nilai status hanya 'aktif' atau 'tidak aktif'
            ],
            [
                'id_tahun_anggaran.required'        => 'Tahun Anggaran harus dalam format tanggal yang valid.',
                'id_fase.required'                  => 'Fase harus dalam format tanggal yang valid.',
                'tanggal.date'                      => 'Tanggal perencanaan harus dalam format tanggal yang valid.',
                'no_dpa.required'                   => 'Nomor DPA harus diisi.',
                'kota.string'                       => 'Nama kota harus berupa teks.',
                'status.in'                         => 'Status hanya boleh bernilai "aktif" atau "tidak aktif".',
            ]
        );

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Cari data berdasarkan primary key
            $tanggal_perencanaans = TanggalPerencanaan::findOrFail($id);

            // Update data
            $tanggal_perencanaans->update([
                'id_tahun_anggaran' => $request->input('id_tahun_anggaran'),
                'id_fase'           => $request->input('id_fase'),
                'tanggal'           => $request->input('tanggal'),
                'no_dpa'            => $request->input('no_dpa'),
                'kota'              => $request->input('kota'),
                'status'            => $request->input('status'),
            ]);

            return redirect()->route('tanggal_perencanaans.index')
                ->with('success', 'Data Tanggal Perencanaan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        $tanggalPerencanaan = TanggalPerencanaan::find($id);

        if (!$tanggalPerencanaan) {
            return redirect()->route('tanggal_perencanaans.index')
                ->with('error', 'Data tidak ditemukan.');
        }

        $tanggalPerencanaan->delete();

        return redirect()->route('tanggal_perencanaans.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
