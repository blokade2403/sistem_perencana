<?php

namespace App\Http\Controllers;

use App\Models\UraianSatu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UraianSatuController extends Controller
{
    public function index()
    {
        $uraian_satus  = UraianSatu::all();
        return view('backend.setting_input.uraian_satus.index', compact('uraian_satus'));
    }

    public function create()
    {
        return view('backend.setting_input.uraian_satus.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['nama_uraian_1' => 'required'],
            ['nama_uraian_1' => 'Nama uraian_satu belum terisi']
        );

        if ($validator->fails()) {
            $errors = $validator->error();

            // Menyusun pesan error menjadi string
            $errorMessages = implode(' ', $errors->all());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
        }

        // Simpan data ke dalam database
        $uraian_satu = new UraianSatu(['nama_uraian_1'     => $request->nama_uraian_1]);

        // dd($uraian_satu);

        $uraian_satu->save();

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('uraian_satus.index')->with('success', 'KSP berhasil ditambahkan.');
    }

    public function show(UraianSatu $uraianSatu)
    {
        //
    }

    public function edit(UraianSatu $uraianSatu)
    {
        // $uraianSatu = UraianSatu::all();
        return view('backend.setting_input.uraian_satus.edit', compact('uraianSatu'));
    }

    public function update(Request $request, UraianSatu $uraianSatu)
    {
        $validator = Validator::make(
            $request->all(),
            ['nama_uraian_1' => 'required'],
            ['nama_uraian_1' => 'Nama uraian_satu belum terisi']
        );

        if ($validator->fails()) {
            $errors = $validator->error();

            // Menyusun pesan error menjadi string
            $errorMessages = implode(' ', $errors->all());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
        }


        // dd($uraian_satu);
        $uraianSatu->update($request->all());

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('uraian_satus.index')->with('success', 'Data uraian_satu berhasil ditambahkan.');
    }

    public function destroy(UraianSatu $uraianSatu)
    {
        //
    }
}
