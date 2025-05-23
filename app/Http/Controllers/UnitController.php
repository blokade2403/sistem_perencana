<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    public function index()
    {
        $units  = Unit::all();
        return view('backend.setting_user.units.index', compact('units'));
    }

    public function create()
    {
        return view('backend.setting_user.units.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['nama_unit' => 'required'],
            ['nama_unit' => 'Nama Unit belum terisi']
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
        $unit = new Unit(['nama_unit'     => $request->nama_unit]);

        // dd($unit);

        $unit->save();

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('units.index')->with('success', 'KSP berhasil ditambahkan.');
    }

    public function show(Unit $unit)
    {
        //
    }

    public function edit(Unit $unit)
    {
        return view('backend.setting_user.units.edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit)
    {
        $validator = Validator::make(
            $request->all(),
            ['nama_unit' => 'required'],
            ['nama_unit' => 'Nama Unit belum terisi']
        );

        if ($validator->fails()) {
            $errors = $validator->error();

            // Menyusun pesan error menjadi string
            $errorMessages = implode(' ', $errors->all());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
        }


        // dd($unit);
        $unit->update($request->all());

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('units.index')->with('success', 'Data Unit berhasil ditambahkan.');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();

        return redirect()->route('units.index')->with('success', 'Data Berhasil di Hapus');
    }
}
