<?php

namespace App\Http\Controllers;

use App\Models\Fungsional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FungsionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fungsionals = Fungsional::all();
        return view('backend.setting_user.fungsionals.index', compact('fungsionals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.setting_user.fungsionals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jabatan_fungsional'    => 'required'
        ]);

        $fungsionals = new Fungsional([
            'jabatan_fungsional' => $request->jabatan_fungsional
        ]);

        // dd($fungsionals);

        $fungsionals->save();
        return redirect()->route('fungsionals.index')->with('success', 'Penambahan Data Jabatan Fungsional Berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fungsional $fungsional)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fungsional $fungsional)
    {
        return view('backend.setting_user.fungsionals.edit', compact('fungsional'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fungsional $fungsional)
    {
        $validator = Validator::make(
            $request->all(),
            ['jabatan_fungsional' => 'required'],
            ['jabatan_fungsional' => 'Nama Jabatan Fungsional belum diisi']
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessage   = implode(' ', $errors->all());

            return redirect()->back()->withInput()->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali:', $errorMessage);
        }


        // dd($jabatan);

        $fungsional->update($request->all());
        return redirect()->route('fungsionals.index')->with('success', 'Data Jabatan Fungsional Berhasil di Tambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fungsional $fungsional)
    {
        $fungsional->delete();

        return redirect()->route('fungsionals.index')
            ->with('success', 'Fungsional Jabatan deleted successfully.');
    }
}
