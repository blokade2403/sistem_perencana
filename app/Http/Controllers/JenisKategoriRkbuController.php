<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisKategoriRkbu;
use Illuminate\Support\Facades\Validator;

class JenisKategoriRkbuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis_kategori_rkbus   = JenisKategoriRkbu::all();
        return view('backend.master_setting.jenis_kategori_rkbus.index', compact('jenis_kategori_rkbus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.master_setting.jenis_kategori_rkbus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator  = Validator::make(
            $request->all(),
            [
                'kode_jenis_kategori_rkbu' => 'required',
                'nama_jenis_kategori_rkbu' => 'required'
            ],
            [
                'kode_jenis_kategori_rkbu'  => 'Kode Harud Diisi',
                'nama_jenis_kategori_rkbu'  => 'Nama Harud Diisi',

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

        $jenis_kategori_rkbu = new JenisKategoriRkbu(
            [
                'kode_jenis_kategori_rkbu'   => $request->kode_jenis_kategori_rkbu,
                'nama_jenis_kategori_rkbu'   => $request->nama_jenis_kategori_rkbu,
            ]
        );

        $jenis_kategori_rkbu->save();
        return redirect()->route('jenis_kategori_rkbus.index')->with('success', 'Nama jenis_kategori_rkbu Delete Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisKategoriRkbu $jenisKategoriRkbu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisKategoriRkbu $jenisKategoriRkbu)
    {
        // $jenis_kategori_rkbus = JenisKategoriRkbu::all();
        return view('backend.master_setting.jenis_kategori_rkbus.edit', compact('jenisKategoriRkbu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisKategoriRkbu $jenisKategoriRkbu)
    {
        $validator  = Validator::make(
            $request->all(),
            ['kode_jenis_kategori_rkbu' => 'required'],
            ['nama_jenis_kategori_rkbu'  => 'Nama Harud Diisi']
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

        $jenisKategoriRkbu->update($request->all());
        return redirect()->route('jenis_kategori_rkbus.index')->with('success', 'Nama level_user Delete Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisKategoriRkbu $jenisKategoriRkbu)
    {
        //
    }
}
