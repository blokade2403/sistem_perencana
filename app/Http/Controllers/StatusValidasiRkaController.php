<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusValidasiRka;
use Illuminate\Support\Facades\Validator;

class StatusValidasiRkaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status_validasi_rkas = StatusValidasiRka::all();
        return view('backend.setting_input.status_validasi_rka.index', compact('status_validasi_rkas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.setting_input.status_validasi_rka.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['nama_validasi_rka' => 'required'],
            ['nama_validasi_rka' => 'Nama Validasi Harus Ter isi']
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessages = implode(' ', $errors->all());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
        }

        $status_validasi_rkas = new StatusValidasiRka();
        $status_validasi_rkas->nama_validasi_rka = $request->nama_validasi_rka;
        $status_validasi_rkas->save();
        return redirect()->route('status_validasi_rkas.index')->with('success', 'Nama Status Berhasil di Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(StatusValidasiRka $statusValidasiRka)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StatusValidasiRka $statusValidasiRka)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StatusValidasiRka $statusValidasiRka)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StatusValidasiRka $statusValidasiRka)
    {
        //
    }
}
