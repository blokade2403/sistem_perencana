<?php

namespace App\Http\Controllers;

use App\Models\JenisBelanja;
use App\Models\KategoriRkbu;
use Illuminate\Http\Request;
use App\Models\AdminPendukung;
use App\Models\SubKategoriRkbu;
use App\Models\JenisKategoriRkbu;
use App\Models\SubKategoriRekening;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SubKategoriRkbuImport;
use App\Models\RekeningBelanja;
use Illuminate\Support\Facades\Validator;

class SubKategoriRkbuController extends Controller
{

    public function index()
    {
        $sub_kategori_rkbus = SubKategoriRkbu::with([
            'kategori_rkbu',
            'rekening_belanja',
            'admin_pendukung',
            'sub_kategori_rekening'
        ])->get();

        $kategori_rkbus = KategoriRkbu::all();
        $admin_pendukungs = AdminPendukung::all();
        $sub_kategori_rekenings = SubKategoriRekening::all();
        $rekening_belanjas = RekeningBelanja::all();

        return view('backend.master_setting.sub_kategori_rkbus.index', compact('sub_kategori_rkbus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori_rkbus = KategoriRkbu::all();
        $admin_pendukungs = AdminPendukung::all();
        $sub_kategori_rekenings = SubKategoriRekening::all();
        $rekening_belanjas = RekeningBelanja::all();
        // dd($admin_pendukungs);
        return view('backend.master_setting.sub_kategori_rkbus.create', compact('kategori_rkbus', 'admin_pendukungs', 'sub_kategori_rekenings', 'rekening_belanjas'));
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
                'id_kategori_rkbu'                      => 'required',
                'id_admin_pendukung_ppk'                => 'nullable',
                'id_sub_kategori_rekening'              => 'required',
                'id_kode_rekening_belanja'              => 'nullable',
                'kode_sub_kategori_rkbu'                => 'required',
                'nama_sub_kategori_rkbu'                => 'required',
                'status'                                => '',
            ],
            [
                'id_kategori_rkbu.required'             => 'Id Fungsional harus diisi.',
                'id_admin_pendukung_ppk'                => 'Id Admin harus diisi.',
                'id_sub_kategori_rekening.required'     => 'Id Pejabat harus diisi.',
                'id_kode_rekening_belanja'              => 'Id Pejabat harus diisi.',
                'kode_kategori_rkbu.required'           => 'Nama kategori_rkbu harus diisi.',
                'nama_kategori_rkbu.required'           => 'NIP kategori_rkbu harus diisi.',
                'status'                                => 'Status Harus diisi'
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

        // Simpan data ke dalam database
        $sub_kategori_rkbu = new SubKategoriRkbu();

        $sub_kategori_rkbu->fill([
            'id_kategori_rkbu'                  => $request->input('id_kategori_rkbu'),
            'id_admin_pendukung_ppk'            => $request->input('id_admin_pendukung_ppk'),
            'id_sub_kategori_rekening'          => $request->input('id_sub_kategori_rekening'),
            'id_kode_rekening_belanja'          => $request->input('id_kode_rekening_belanja'),
            'kode_sub_kategori_rkbu'            => $request->input('kode_sub_kategori_rkbu'),
            'nama_sub_kategori_rkbu'            => $request->input('nama_sub_kategori_rkbu'),
            'status'                            => $request->input('status'),

        ]);

        // dd($sub_kategori_rkbu);
        $sub_kategori_rkbu->save();

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('sub_kategori_rkbus.index')->with('success', 'kategori_rkbu berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubKategoriRkbu $subKategoriRkbu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // $subKategoriRkbu            = SubKategoriRkbu::all();
        $sub_kategori_rkbus         = SubKategoriRkbu::with('kategori_rkbu')->findOrFail($id);
        $kategori_rkbus             = KategoriRkbu::all();
        $admin_pendukungs           = AdminPendukung::all();
        $sub_kategori_rekenings     = SubKategoriRekening::all();
        $rekening_belanjas          = RekeningBelanja::all();
        return view('backend.master_setting.sub_kategori_rkbus.edit', compact('sub_kategori_rkbus', 'sub_kategori_rekenings', 'kategori_rkbus', 'admin_pendukungs', 'rekening_belanjas'));
        // return view('backend.master_setting.sub_kategori_rkbus.edit', compact('kategori_rkbus', 'jenis_belanjas', 'jenis_kategori_rkbus', 'admin_pendukungs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubKategoriRkbu $subKategoriRkbu)
    {
        // Validasi data input
        $validator = Validator::make(
            $request->all(),
            [
                'id_kategori_rkbu'                      => 'required',
                'id_admin_pendukung_ppk'                => 'nullable',
                'id_sub_kategori_rekening'              => 'required',
                'id_kode_rekening_belanja'              => 'required',
                'kode_sub_kategori_rkbu'                => 'required',
                'nama_sub_kategori_rkbu'                => 'required',
                'status'                                => '',
            ],
            [
                'id_kategori_rkbu.required'             => 'Id Fungsional harus diisi.',
                'id_admin_pendukung_ppk'                => 'Id Admin harus diisi.',
                'id_sub_kategori_rekening.required'     => 'Id Sub Kategori Rekening harus diisi.',
                'id_kode_rekening_belanja.required'     => 'Id Kode Rekening Belanja harus diisi.',
                'kode_kategori_rkbu.required'           => 'Nama kategori_rkbu harus diisi.',
                'nama_kategori_rkbu.required'           => 'NIP kategori_rkbu harus diisi.',
                'status'                                => 'Status Harus diisi'
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

        // Simpan data ke dalam database
        $subKategoriRkbu->fill([
            'id_kategori_rkbu'                  => $request->input('id_kategori_rkbu'),
            'kode_sub_kategori_rkbu'            => $request->input('kode_sub_kategori_rkbu'),
            'nama_sub_kategori_rkbu'            => $request->input('nama_sub_kategori_rkbu'),
            'id_admin_pendukung_ppk'            => $request->input('id_admin_pendukung_ppk'),
            'id_sub_kategori_rekening'          => $request->input('id_sub_kategori_rekening'),
            'id_kode_rekening_belanja'          => $request->input('id_kode_rekening_belanja'),
            'status'                            => $request->input('status'),

        ]);

        // dd($request);

        $subKategoriRkbu->update();
        return redirect()->route('sub_kategori_rkbus.index')->with('success', 'kategori_rkbu Delete Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubKategoriRkbu $subKategoriRkbu)
    {
        $subKategoriRkbu->delete();

        return redirect()->route('sub_kategori_rkbus.index')
            ->with('success', 'kategori_rkbu deleted successfully.');
    }
}
