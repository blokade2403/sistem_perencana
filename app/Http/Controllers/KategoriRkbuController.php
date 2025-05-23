<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\JenisKategoriRkbu;
use App\Models\KategoriRkbu;
use App\Models\ObyekBelanja;
use Illuminate\Http\Request;
use App\Models\RekeningBelanja;
use Illuminate\Support\Facades\Validator;

class KategoriRkbuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori_rkbus = KategoriRkbu::with(['obyek_belanja', 'jenis_kategori_rkbu'])->get();
        return view('backend.master_setting.kategori_rkbus.index', compact('kategori_rkbus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis_kategori_rkbus = JenisKategoriRkbu::all();
        $obyek_belanjas = ObyekBelanja::all();
        return view('backend.master_setting.kategori_rkbus.create', compact('jenis_kategori_rkbus', 'obyek_belanjas'));
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
                'id_jenis_kategori_rkbu'    => 'required',
                'id_obyek_belanja'          => 'required',
                'kode_kategori_rkbu'        => 'required',
                'nama_kategori_rkbu'        => 'required',
            ],
            [
                'id_jenis_kategori_rkbu.required'       => 'Id Jenis Kategori RKBU harus diisi.',
                'id_obyek_belanja.required'             => 'Id Obyek Belanja harus diisi.',
                'kode_kategori_rkbu.required'           => 'Nama kategori_rkbu harus diisi.',
                'nama_kategori_rkbu.required'           => 'NIP kategori_rkbu harus diisi.',

            ]
        );

        // if ($validator->fails()) {
        //     $errors = $validator->errors();
        //     dd($errors);
        // }

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
        $kategori_rkbu = new KategoriRkbu([
            'id_jenis_kategori_rkbu'    => $request->id_jenis_kategori_rkbu,
            'id_obyek_belanja'          => $request->id_obyek_belanja,
            'kode_kategori_rkbu'        => $request->kode_kategori_rkbu,
            'nama_kategori_rkbu'        => $request->nama_kategori_rkbu,
        ]);

        // dd($kategori_rkbu);

        $kategori_rkbu->save();

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('kategori_rkbus.index')->with('success', 'kategori_rkbu berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriRkbu $kategoriRkbu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategori_rkbus             = KategoriRkbu::with('obyek_belanja')->findOrFail($id);
        $jenis_kategori_rkbus       = JenisKategoriRkbu::all();
        $obyek_belanjas             = ObyekBelanja::all();
        return view('backend.master_setting.kategori_rkbus.edit', compact('kategori_rkbus', 'jenis_kategori_rkbus', 'obyek_belanjas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriRkbu $kategoriRkbu)
    {
        // Validasi data input
        $validator = Validator::make(
            $request->all(),
            [
                'id_jenis_kategori_rkbu'    => 'required',
                'id_obyek_belanja'          => 'required',
                'kode_kategori_rkbu'        => 'required',
                'nama_kategori_rkbu'        => 'required',
            ],
            [
                'id_jenis_kategori_rkbu.required'       => 'Id Jenis Kategori RKBU harus diisi.',
                'id_obyek_belanja.required'             => 'Id Obyek Belanja harus diisi.',
                'kode_kategori_rkbu.required'           => 'Nama kategori_rkbu harus diisi.',
                'nama_kategori_rkbu.required'           => 'NIP kategori_rkbu harus diisi.',
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

        // dd($request);

        $kategoriRkbu->update($request->all());
        return redirect()->route('kategori_rkbus.index')->with('success', 'kategori_rkbu Delete Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriRkbu $kategoriRkbu)
    {
        $kategoriRkbu->delete();

        return redirect()->route('kategori_rkbus.index')
            ->with('success', 'kategori_rkbu deleted successfully.');
    }
}
