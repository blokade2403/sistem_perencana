<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusValidasi;
use Illuminate\Support\Facades\Validator;

class StatusValidasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status_validasis   = StatusValidasi::all();
        return view('backend.setting_input.status_validasi.index', compact('status_validasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.setting_input.status_validasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_validasi'  => 'required',
            ],
            [
                'nama_validasi'     => 'Nama Status Validasi Tidak Boleh Kosong'
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessages = implode(' ', $errors->all());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
        }

        $status_validasis = new StatusValidasi();
        $status_validasis->nama_validasi = $request->nama_validasi;
        $status_validasis->save();

        // Set session flash
        return redirect()->route('status_validasis.index')
            ->with('success', 'Data berhasil ditambahkan.');
    }


    public function show($id)
    {
        $obj = StatusValidasi::findOrFail($id);
        return view('backend.setting_input.status_validasi.show', compact('obj'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StatusValidasi $statusValidasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StatusValidasi $statusValidasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StatusValidasi $statusValidasi)
    {
        //
    }
}
