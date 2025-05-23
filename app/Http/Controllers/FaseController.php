<?php

namespace App\Http\Controllers;

use App\Models\Fase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fases = Fase::all();
        return view('backend.setting_user.fases.index', compact('fases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.setting_user.fases.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['nama_fase'    => 'required'],
            ['nama_fase'    => 'Nama Fase Harus di Isi']
        );

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

        $fase = new Fase(['nama_fase'   => $request->nama_fase]);
        $fase->save();
        return redirect()->route('fases.index')->with('success', 'Nama Fase Delete Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fase $fase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fase $fase)
    {
        // $fase = Fase::all();
        return view('backend.setting_user.fases.edit', compact('fase'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fase $fase)
    {
        $validator = Validator::make(
            $request->all(),
            ['nama_fase'    => 'required'],
            ['nama_fase'    => 'Nama Fase Harus di Isi']
        );

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

        $fase->update($request->all());
        return redirect()->route('fases.index')->with('success', 'Nama Fase Delete Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fase $fase)
    {
        $fase->delete();

        return redirect()->route('fases.index')
            ->with('success', 'Fase User deleted successfully.');
    }
}
