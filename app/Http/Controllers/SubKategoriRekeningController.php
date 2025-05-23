<?php

namespace App\Http\Controllers;

use App\Models\KategoriRekening;
use App\Models\SubKategoriRekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubKategoriRekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sub_kategori_rekenings     = SubKategoriRekening::all();
        return view('backend.master_setting.sub_kategori_rekenings.index', compact('sub_kategori_rekenings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori_rekenings     = KategoriRekening::all();
        return view('backend.master_setting.sub_kategori_rekenings.create', compact('kategori_rekenings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator  = Validator::make(
            $request->all(),
            [
                'id_kategori_rekening'          =>  'required',
                'kode_sub_kategori_rekening'    =>  'required',
                'nama_sub_kategori_rekening'    =>  'required',
            ],

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
        $sub_kategori_rekening = new SubKategoriRekening([
            'id_kategori_rekening'          => $request->id_kategori_rekening,
            'kode_sub_kategori_rekening'    => $request->kode_sub_kategori_rekening,
            'nama_sub_kategori_rekening'    => $request->nama_sub_kategori_rekening,
        ]);

        // dd($ksp);

        $sub_kategori_rekening->save();

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('sub_kategori_rekenings.index')->with('success', 'KSP berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubKategoriRekening $subKategoriRekening)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sub_kategori_rekenings           = SubKategoriRekening::with('kategori_rekening')->findOrFail($id);
        $kategori_rekenings               = KategoriRekening::all(); // Mengambil semua data Jabatan

        // dd($kategori_rekenings);
        return view('backend.master_setting.sub_kategori_rekenings.edit', compact('sub_kategori_rekenings', 'kategori_rekenings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubKategoriRekening $subKategoriRekening)
    {
        $validator  = Validator::make(
            $request->all(),
            [
                'id_kategori_rekening'          =>  'required',
                'kode_sub_kategori_rekening'    =>  'required',
                'nama_sub_kategori_rekening'    =>  'required',
            ],

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

        $subKategoriRekening->update($request->all());
        return redirect()->route('sub_kategori_rekenings.index')->with('success', 'Data Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubKategoriRekening $subKategoriRekening)
    {
        $subKategoriRekening->delete();

        return redirect()->route('sub_kategori_rekenings.index')
            ->with('success', 'Sub Kategori Rekening deleted successfully.');
    }
}
