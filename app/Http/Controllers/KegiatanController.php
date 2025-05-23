<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::all();
        return view('backend.master_setting.kegiatans.index', compact('kegiatans'));
    }

    public function create()
    {
        $programs  = Program::all();
        return view('backend.master_setting.kegiatans.create', compact('programs'));
    }

    public function getProgramDetails($id)
    {
        $kegiatan = Kegiatan::with('program')->find($id);

        if ($kegiatan) {
            return response()->json([
                'kode_program' => $kegiatan->program->kode_program,
                'nama_program' => $kegiatan->program->nama_program
            ]);
        }

        return response()->json(['error' => 'Data not found'], 404);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id_program'        =>  'required',
                'kode_kegiatan'     =>  'required',
                'nama_kegiatan'     =>  'required',
            ],
            [
                'id_program.required'       => 'ID Program Harus di Pilih',
                'kode_kegiatan.required'    =>  'Kode Kegiatan Harus Diisi',
                'nama_kegiatan.required'    =>  'Nama Kegiatan harus diisi'
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->error();

            $errorMessages = implode(' ', $errors->all());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
        }

        $kegiatan = new Kegiatan([
            'id_program'        =>  $request->id_program,
            'kode_kegiatan'     =>  $request->kode_kegiatan,
            'nama_kegiatan'     =>  $request->nama_kegiatan,
        ]);

        $kegiatan->save();
        return redirect()->route('kegiatans.index')->with('success', 'Data Kegiatan Berhasil di Tambahkan');
    }

    public function show(Kegiatan $kegiatan)
    {
        $programs   = Program::all();
        return view('backend.master_setting.kegiatans.edit', compact('kegiatans'));
    }

    public function edit($id)
    {
        $kegiatans          = Kegiatan::with('program')->findOrFail($id);
        $programs           = Program::all();
        return view('backend.master_setting.kegiatans.edit', compact('kegiatans', 'programs'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        //
    }

    public function destroy(Kegiatan $kegiatan)
    {
        //
    }
}
