<?php

namespace App\Http\Controllers;

use App\Models\Ksp;
use App\Models\Jabatan;
use App\Models\Pejabat;
use App\Models\Fungsional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KspController extends Controller
{
    public function index()
    {
        $ksps = Ksp::with(['fungsional', 'pejabat'])->get();
        return view('backend.user_profile.ksps.index', compact('ksps'));
    }

    public function create()
    {
        // dd('create method called');

        // Ambil semua data KSPs
        // $ksps = Ksp::with('fungsional')->get();

        // Ambil semua data Jabatan
        $pejabats = Pejabat::where('id_jabatan', '!=', 1)->get();

        // Ambil semua data Fungsional
        $fungsionals = Fungsional::all();

        return view('backend.user_profile.ksps.create', compact('pejabats', 'fungsionals'));
    }


    public function store(Request $request)
    {
        // Validasi data input
        $validator = Validator::make(
            $request->all(),
            [
                'id_fungsional' => 'required',
                'id_pejabat'    => 'required',
                'nama_ksp'      => 'required',
                'nip_ksp'       => 'required|numeric',
                'status'        => 'required',
            ],
            [
                'id_fungsional.required'    => 'Id Fungsional harus diisi.',
                'id_pejabat.required'       => 'Id Pejabat harus diisi.',
                'nama_ksp.required'         => 'Nama KSP harus diisi.',
                'nip_ksp.required'          => 'NIP KSP harus diisi.',
                'nip_ksp.numeric'           => 'NIP KSP harus berupa angka.',
                'status.required'           => 'Status harus diisi.',
                'status.required'           => 'Status harus salah satu dari: aktif atau tidak aktif.',
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
        $ksp = new Ksp([
            'id_fungsional' => $request->id_fungsional,
            'id_pejabat'    => $request->id_pejabat,
            'nama_ksp'      => $request->nama_ksp,
            'nip_ksp'       => $request->nip_ksp,
            'status'        => $request->status,
        ]);

        // dd($ksp);

        $ksp->save();

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('ksps.index')->with('success', 'KSP berhasil ditambahkan.');
    }


    public function show(Ksp $ksp)
    {
        //
    }

    public function edit($id)
    {
        $ksps           = Ksp::with('pejabat')->findOrFail($id);
        $fungsionals    = Fungsional::all(); // Mengambil semua data Jabatan
        $pejabats       = Pejabat::all(); // Mengambil semua data Jabatan
        return view('backend.user_profile.ksps.edit', compact('ksps', 'fungsionals', 'pejabats'));
    }

    public function update(Request $request, Ksp $ksp)
    {
        // Validasi data input
        $validator = Validator::make(
            $request->all(),
            [
                'id_fungsional' => 'required',
                'id_pejabat'    => 'required',
                'nama_ksp'      => 'required',
                'nip_ksp'       => 'required|numeric',
                'status'        => 'required',
            ],
            [
                'id_fungsional.required'    => 'Id Fungsional harus diisi.',
                'id_pejabat.required'       => 'Id Pejabat harus diisi.',
                'nama_ksp.required'         => 'Nama KSP harus diisi.',
                'nip_ksp.required'          => 'NIP KSP harus diisi.',
                'nip_ksp.numeric'           => 'NIP KSP harus berupa angka.',
                'status.required'           => 'Status harus diisi.',
                'status.required'           => 'Status harus salah satu dari: aktif atau tidak aktif.',
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

        $ksp->update($request->all());
        return redirect()->route('ksps.index')->with('success', 'KSP Delete Success');
    }

    public function destroy(Ksp $ksp)
    {
        $ksp->delete();

        return redirect()->route('ksps.index')
            ->with('success', 'KSP deleted successfully.');
    }
}
