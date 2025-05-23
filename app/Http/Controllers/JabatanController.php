<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatans = Jabatan::all();
        return view('backend.setting_user.jabatans.index', compact('jabatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.setting_user.jabatans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['nama_jabatan' => 'required'],
            ['nama_jabatan' => 'Nama Jabatan belum diisi']
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessage   = implode(' ', $errors->all());

            return redirect()->back()->withInput()->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali:', $errorMessage);
        }


        $jabatan = new Jabatan([
            'nama_jabatan'  => $request->nama_jabatan
        ]);

        // dd($jabatan);

        $jabatan->save();
        return redirect()->route('jabatans.index')->with('success', 'Data Struktur Jabatan Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        // $jabatans = Jabatan::all();
        return view('backend.setting_user.jabatans.edit', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        $validator = Validator::make(
            $request->all(),
            ['nama_jabatan' => 'required'],
            ['nama_jabatan' => 'Nama Jabatan belum diisi']
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessage   = implode(' ', $errors->all());

            return redirect()->back()->withInput()->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali:', $errorMessage);
        }


        // dd($jabatan);

        $jabatan->update($request->all());
        return redirect()->route('jabatans.index')->with('success', 'Data Struktur Jabatan Berhasil di Tambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = Jabatan::findOrFail($id);
        $delete->delete();

        return redirect()->route('jabatans.index')->with('success', 'Data Jabatan Berhasil dihapus.');
    }
}
