<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\JenisBelanja;
use Illuminate\Http\Request;
use App\Models\RekeningBelanja;
use Illuminate\Support\Facades\Validator;

class RekeningBelanjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rekening_belanjas = RekeningBelanja::with(['aktivitas'])->get();
        return view('backend.master_setting.rekening_belanjas.index', compact('rekening_belanjas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd($jenis_belanjas);
        // Ambil semua data Fungsional
        $aktivitas = Aktivitas::all();

        return view('backend.master_setting.rekening_belanjas.create', compact('aktivitas'));
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
                'id_aktivitas'           => 'required',
                'kode_rekening_belanja'      => 'required',
                'nama_rekening_belanja'      => 'required',
            ],
            [
                'id_aktivitas.required'       => 'Id Pejabat harus diisi.',
                'kode_rekening_belanja'      => 'required',
                'nama_rekening_belanja.required'         => 'Nama KSP harus diisi.',

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
        $rekening_belanja = new RekeningBelanja([
            'id_aktivitas'                  => $request->id_aktivitas,
            'kode_rekening_belanja'        => $request->kode_rekening_belanja,
            'nama_rekening_belanja'        => $request->nama_rekening_belanja,

        ]);

        // dd($rekening_belanja);

        $rekening_belanja->save();

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('rekening_belanjas.index')->with('success', 'rekening_belanja berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RekeningBelanja $rekeningBelanja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rekening_belanjas      = RekeningBelanja::with('aktivitas')->findOrFail($id);
        $jenis_belanjas         = JenisBelanja::all(); // Mengambil semua data Jabatan
        $aktivitas              = Aktivitas::all(); // Mengambil semua data Jabatan

        // dd($rekening_belanjas);
        return view('backend.master_setting.rekening_belanjas.edit', compact('rekening_belanjas', 'jenis_belanjas', 'aktivitas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RekeningBelanja $rekeningBelanja)
    {
        // Validasi data input
        $validator = Validator::make(
            $request->all(),
            [
                'id_aktivitas'    => 'required',
                'nama_rekening_belanja'      => 'required',
                'kode_rekening_belanja'      => 'required',
            ],
            [
                'id_aktivitas.required'       => 'Id Pejabat harus diisi.',
                'kode_rekening_belanja'      => 'required',
                'nama_rekening_belanja.required'         => 'Nama KSP harus diisi.',
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

        $rekeningBelanja->update($request->all());
        return redirect()->route('rekening_belanja.index')->with('success', 'KSP Delete Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RekeningBelanja $rekeningBelanja)
    {
        $rekeningBelanja->delete();

        return redirect()->route('rekening_belanjas.index')
            ->with('success', 'KSP deleted successfully.');
    }
}
