<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\sub_kegiatan;
use App\Models\SumberDana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubKegiatanController extends Controller
{
    public function index()
    {
        $sub_kegiatans  = Sub_kegiatan::with(['kegiatan', 'sumber_dana'])->get();
        return view('backend.master_setting.sub_kegiatans.index', compact('sub_kegiatans'));
    }

    public function create()
    {
        $kegiatans  = Kegiatan::all();
        $sumber_danas = SumberDana::all();
        return view('backend.master_setting.sub_kegiatans.create', compact('kegiatans', 'sumber_danas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id_kegiatan'               =>  'required',
                'kode_sub_kegiatan'         =>  'required',
                'nama_sub_kegiatan'         =>  'required',
                'id_sumber_dana'            =>  'required',
                'tujuan_sub_kegiatan'       =>  'required',
                'indikator_sub_kegiatan'    =>  'required',
            ],
            [
                'id_kegiatan.required'          => 'ID Program Harus di Pilih',
                'kode_sub_kegiatan.required'    =>  'Kode Kegiatan Harus Diisi',
                'id_sumber_dana.required'    =>  'Nama Kegiatan harus diisi',
                'tujuan_sub_kegiatan.required'    =>  'Nama Kegiatan harus diisi',
                'indikator_sub_kegiatan.required'    =>  'Nama Kegiatan harus diisi'
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->error();

            $errorMessages = implode(' ', $errors->all());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
        }

        $kegiatan = new sub_kegiatan([
            'id_kegiatan'               =>  $request->id_kegiatan,
            'kode_sub_kegiatan'         =>  $request->kode_sub_kegiatan,
            'nama_sub_kegiatan'         =>  $request->nama_sub_kegiatan,
            'id_sumber_dana'            =>  $request->id_sumber_dana,
            'tujuan_sub_kegiatan'       =>  $request->tujuan_sub_kegiatan,
            'indikator_sub_kegiatan'    =>  $request->indikator_sub_kegiatan,
        ]);

        // dd($kegiatan);

        $kegiatan->save();
        return redirect()->route('sub_kegiatans.index')->with('success', 'Data Kegiatan Berhasil di Tambahkan');
    }

    public function show(sub_kegiatan $sub_kegiatan)
    {
        //
    }

    public function edit($id)
    {
        $sub_kegiatans   = Sub_kegiatan::with('kegiatan')->findOrFail($id);
        $sumber_danas    = SumberDana::all(); // Mengambil semua data Jabatan
        $kegiatans       = Kegiatan::all();
        return view('backend.master_setting.sub_kegiatans.edit', compact('sub_kegiatans', 'sumber_danas', 'kegiatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sub_kegiatan $sub_kegiatan)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id_kegiatan'               =>  'required',
                'kode_sub_kegiatan'         =>  'required',
                'nama_sub_kegiatan'         =>  'required',
                'id_sumber_dana'            =>  'required',
                'tujuan_sub_kegiatan'       =>  'required',
                'indikator_sub_kegiatan'    =>  'required',
            ],
            [
                'id_kegiatan.required'          => 'ID Program Harus di Pilih',
                'kode_sub_kegiatan.required'    =>  'Kode Kegiatan Harus Diisi',
                'id_sumber_dana.required'    =>  'Nama Kegiatan harus diisi',
                'tujuan_sub_kegiatan.required'    =>  'Nama Kegiatan harus diisi',
                'indikator_sub_kegiatan.required'    =>  'Nama Kegiatan harus diisi'
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

        $sub_kegiatan->update($request->all());
        return redirect()->route('sub_kegiatans.index')->with('success', 'Sub Kegiatan Delete Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sub_kegiatan $sub_kegiatan)
    {
        //
    }
}
