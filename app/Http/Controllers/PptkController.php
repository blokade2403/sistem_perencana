<?php

namespace App\Http\Controllers;

use App\Models\Pptk;
use App\Models\TahunAnggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PptkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pptks  = Pptk::with('tahun_anggaran')->get();
        return view('backend.setting_user.pptks.index', compact('pptks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tahun_anggarans    = TahunAnggaran::all();
        // dd($tahun_anggarans);
        return view('backend.setting_user.pptks.create', compact('tahun_anggarans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator  = Validator::make(
            $request->all(),
            [
                'nama_pptk'     => 'required',
                'nip_pptk'     => 'required',
                'id_tahun_anggaran'     => 'required',
                'status_pptk'     => 'required',
            ],
            [
                'nama_pptk'         => 'Nama Harus Terisi',
                'nip_pptk'          => 'NIP Harus Terisi',
                'id_tahun_anggaran' => 'Tahun Anggaran Harus Terisi',
                'status_pptk'            => 'status_pptk Harus Terisi',
            ]
        );

        if ($validator->fails()) {
            $errors     = $validator->errors();
            $errorMessages  = implode(' ', $errors->all());

            return redirect()->back()->withInput()->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
        }

        $pptks = new Pptk(
            [
                'nama_pptk'             => $request->nama_pptk,
                'nip_pptk'              => $request->nip_pptk,
                'id_tahun_anggaran'     => $request->id_tahun_anggaran,
                'status_pptk'                => $request->status_pptk,
            ]
        );


        $pptks->save();
        return redirect()->route('pptks.index')->with('success', 'Data Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pptk $pptk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pptk $pptk)
    {
        $tahun_anggarans    = TahunAnggaran::all();
        return view('backend.setting_user.pptks.edit', compact('pptk', 'tahun_anggarans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pptk $pptk)
    {
        $validator  = Validator::make(
            $request->all(),
            [
                'nama_pptk'     => 'required',
                'nip_pptk'      => 'required',
                'id_tahun_anggaran'      => 'required',
                'status_pptk'      => 'required',
            ],

        );
        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
        if ($validator->fails()) {
            $errors = $validator->errors();

            // dd($errors);

            $errorMessages = implode(' ', $errors->all());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
        }

        // dd($request);

        $pptk->update($request->all());
        return redirect()->route('pptks.index')->with('success', 'Program Edit Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pptk $pptk)
    {
        $pptk->delete();
        return redirect()->route('pptks.index')->with('success', 'Data Berhasil di Hapus');
    }
}
