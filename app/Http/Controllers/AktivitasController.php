<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Aktivitas;
use App\Models\sub_kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AktivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aktivitass = Aktivitas::with(['program', 'sub_kegiatan'])->get();
        return view('backend.master_setting.aktivitas.index', compact('aktivitass'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd('create method called');

        // Ambil semua data aktivitas
        // $aktivitas = Ksp::with('fungsional')->get();

        // Ambil semua data Jabatan
        $programs = Program::all();

        // Ambil semua data Fungsional
        $sub_kegiatans = Sub_kegiatan::all();

        return view('backend.master_setting.aktivitas.create', compact('programs', 'sub_kegiatans'));
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
                'id_program'        => 'required',
                'id_sub_kegiatan'   => 'required',
                'nama_aktivitas'    => 'required',
                'kode_aktivitas'    => 'required',
            ],
            [
                'id_program.required'       => 'Id Fungsional harus diisi.',
                'id_sub_kegiatan.required'  => 'Id Pejabat harus diisi.',
                'nama_aktivitas.required'   => 'Nama Aktivitas harus diisi.',
                'kode_aktivitas.required'   => 'Kode Aktivitas harus diisi.',
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


        // Simpan data ke dalam database
        $aktivitass = new Aktivitas([
            'id_program'       => $request->id_program,
            'id_sub_kegiatan'  => $request->id_sub_kegiatan,
            'nama_aktivitas'   => $request->nama_aktivitas,
            'kode_aktivitas'   => $request->kode_aktivitas,
        ]);

        $aktivitass->save();

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('aktivitass.index')->with('success', 'Aktivitas berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Aktivitas $aktivitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $aktivitass             = Aktivitas::with('sub_kegiatan')->findOrFail($id);
        $programs               = Program::all(); // Mengambil semua data Jabatan
        // $sub_kegiatans          = Sub_kegiatan::all(); // Mengambil semua data Jabatan
        $sub_kegiatans          = Sub_kegiatan::with('kegiatan')->get(); // Mengambil semua data Jabatan
        // dd($sub_kegiatans);
        return view('backend.master_setting.aktivitas.edit', compact('aktivitass', 'programs', 'sub_kegiatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aktivitas $aktivitass)
    {
        // Validasi data input
        $validator = Validator::make(
            $request->all(),
            [
                'id_program'            => 'required',
                'id_sub_kegiatan'       => 'required',
                'nama_aktivitas'        => 'required',
                'kode_aktivitas'        => 'required',
            ],
            [
                'id_program.required'               => 'Id Program harus diisi.',
                'id_sub_kegiatan.required'          => 'Id Sub Kegiatan harus diisi.',
                'nama_aktivitas.required'           => 'Nama Aktivitas harus diisi.',
                'kode_aktivitas.required'           => 'Kode Aktivitas harus diisi.',
            ]
        );

        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
        if ($validator->fails()) {
            $error = $validator->errors();
            $errorMessages  = implode(' ', $error->all());
            return redirect()->back()->withInput()->with('error', 'Periksa Kembali Updatean Data', $errorMessages);
        }

        // dd($request);

        $aktivitass->update($request->all());
        return redirect()->route('aktivitass.index')->with('success', 'Aktivitas Update Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aktivitas $aktivitass)
    {
        $aktivitass->delete();

        return redirect()->route('aktivitass.index')
            ->with('success', 'KSP deleted successfully.');
    }
}
