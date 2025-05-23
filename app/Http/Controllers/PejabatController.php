<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pejabat;
use Illuminate\Http\Request;

class PejabatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pejabats = Pejabat::with('jabatan')->get();
        return view('backend.user_profile.pejabats.index', compact('pejabats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatans = Jabatan::all();
        return view('backend.user_profile.pejabats.create', compact('jabatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_jabatan'    => 'required',
            'nama_pejabat'  => 'required',
            'nip_pejabat'   => 'required|numeric',
            'status'        => 'required|in:aktif,tidak aktif',
        ]);

        $pejabat = new Pejabat([
            'id_jabatan'            => $request->id_jabatan,
            'nama_pejabat'          => $request->nama_pejabat,
            'nip_pejabat'           => $request->nip_pejabat,
            'status'                => $request->status,
        ]);

        // dd($pejabat);

        $pejabat->save();

        return redirect()->route('pejabats.index')->with('success', 'Pejabat created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pejabat $pejabat)
    {
        return view('backend.user_profile.pejabats.show', compact('pejabat'));
    }

    public function edit($id)
    {
        $pejabat = Pejabat::with('jabatan')->findOrFail($id);
        $jabatans = Jabatan::all(); // Mengambil semua data Jabatan
        $pejabats = Pejabat::with('jabatan')->get(); // Mengambil semua data Pejabat dengan relasi Jabatan
        return view('backend.user_profile.pejabats.edit', compact('pejabat', 'jabatans'));
    }


    // public function edit(Pejabat $pejabat)
    // {

    //     // dd($pejabat->jabatan);
    //     // $pejabat = Pejabat::with('jabatan')->get();
    //     return view('backend.pejabats.edit', compact('pejabat'));
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pejabat $pejabat)
    {
        $request->validate([
            'id_jabatan'    => 'required',
            'nama_pejabat'  => 'required',
            'nip_pejabat'   => 'required|numeric',
            'status'        => 'required|in:aktif,tidak aktif',
        ]);

        // dd($request);

        $pejabat->update($request->all());
        return redirect()->route('pejabats.index')
            ->with('success', 'Pejabat updated successfully.');
    }

    public function destroy(Pejabat $pejabat)
    {
        $pejabat->delete();

        return redirect()->route('pejabats.index')
            ->with('success', 'Pejabat deleted successfully.');
    }
}
