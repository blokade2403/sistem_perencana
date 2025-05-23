<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriRekening;
use Illuminate\Support\Facades\Validator;

class KategoriRekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori_rekenings = KategoriRekening::all();
        return view('backend.master_setting.kategori_rekenings.index', compact('kategori_rekenings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.master_setting.kategori_rekenings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'kode_kategori_rekening'    => 'required',
                'nama_kategori_rekening'    => 'required'
            ],

            [
                'kode_kategori_rekening'          => 'Kode Kategori Rekening Harus di Isi',
                'nama_kategori_rekening'          => 'Nama Kategori Rekening Harus di Isi'
            ]
        );

        if ($validator->fails()) {
            // Mengambil semua pesan error
            $errors = $validator->errors();
            // dd($errors);
            // Menyusun pesan error menjadi string
            $errorMessages = implode(' ', $errors->all());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
        }

        // dd($request);

        $kategori_rekening = new KategoriRekening([
            'kode_kategori_rekening'   => $request->kode_kategori_rekening,
            'nama_kategori_rekening'   => $request->nama_kategori_rekening,
        ]);

        $kategori_rekening->save();
        return redirect()->route('kategori_rekenings.index')->with('success', 'Nama kategori_rekening Delete Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriRekening $kategoriRekening)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriRekening $kategoriRekening)
    {
        return view('backend.master_setting.kategori_rekenings.edit', compact('kategoriRekening'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriRekening $kategoriRekening)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'kode_kategori_rekening'    => 'required',
                'nama_kategori_rekening'    => 'required'
            ],

            [
                'kode_kategori_rekening'          => 'Kode Kategori Rekening Harus di Isi',
                'nama_kategori_rekening'          => 'Nama Kategori Rekening Harus di Isi'
            ]
        );

        if ($validator->fails()) {
            // Mengambil semua pesan error
            $errors = $validator->errors();
            // dd($errors);
            // Menyusun pesan error menjadi string
            $errorMessages = implode(' ', $errors->all());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
        }

        $kategoriRekening->update($request->all());
        return redirect()->route('kategori_rekenings.index')->with('success', 'Nama level_user Delete Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriRekening $kategoriRekening)
    {
        //
    }
}
