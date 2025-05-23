<?php

namespace App\Http\Controllers;

use App\Models\PpkKeuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PpkKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ppk_keuangans = PpkKeuangan::all();
        return view('backend.setting_user.ppk_keuangans.index', compact('ppk_keuangans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.setting_user.ppk_keuangans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator  = Validator::make(
            $request->all(),
            [
                'nama_ppk_keuangan'     => 'required',
                'nip_ppk_keuangan'      =>  'required',
                'status'                =>  'required',
            ],
            [
                'nama_ppk_keuangan'     =>  'Nama PPK Harus diisi',
                'nip_ppk_keuangan'     =>  'Nip PPK Harus diisi',
                'status'                =>  'Status Harus diisi',
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessages  = implode(' ', $errors->all());

            return redirect()->back()->withInput()->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
        }

        $ppk_keuangans  = new PpkKeuangan(
            [
                'nama_ppk_keuangan'     => $request->nama_ppk_keuangan,
                'nip_ppk_keuangan'      => $request->nip_ppk_keuangan,
                'status'                => $request->status,
            ]
        );
        $ppk_keuangans->save();
        return redirect()->route('ppk_keuangans.index')->with('success', 'Data Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(PpkKeuangan $ppkKeuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PpkKeuangan $ppkKeuangan)
    {
        return view('backend.setting_user.ppk_keuangans.edit', compact('ppkKeuangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PpkKeuangan $ppkKeuangan)
    {
        $validator  = Validator::make(
            $request->all(),
            [
                'nama_ppk_keuangan'     => 'required',
                'nip_ppk_keuangan'      =>  'required',
                'status'                =>  'required',
            ],
            [
                'nama_ppk_keuangan'     =>  'Nama PPK Harus diisi',
                'nip_ppk_keuangan'     =>  'Nip PPK Harus diisi',
                'status'                =>  'Status Harus diisi',
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessages  = implode(' ', $errors->all());

            return redirect()->back()->withInput()->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
        }

        $ppkKeuangan->update($request->all());
        return redirect()->route('ppk_keuangans.index')->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PpkKeuangan $ppkKeuangan)
    {
        //
    }
}
