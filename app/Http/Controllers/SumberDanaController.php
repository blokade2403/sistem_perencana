<?php

namespace App\Http\Controllers;

use App\Models\SumberDana;
use Illuminate\Http\Request;

class SumberDanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sumber_danas = SumberDana::all();
        return view('backend.master_setting.sumber_danas.index', compact('sumber_danas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.master_setting.sumber_danas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, SumberDana $SumberDana)
    {
        $request->validate([
            'nama_sumber_dana'  => 'required',
        ]);

        $SumberDana = new SumberDana([
            'nama_sumber_dana'          => $request->nama_sumber_dana,

        ]);

        // dd($SumberDana);

        $SumberDana->save();

        return redirect()->route('sumber_danas.index')
            ->with('success', 'Sumber Dana updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SumberDana $SumberDana)
    {
        return view('backend.master_setting.sumber_danas.show', compact('SumberDana'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SumberDana $SumberDana)
    {
        return view('backend.master_setting.sumber_danas.edit', compact('SumberDana'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SumberDana $SumberDana)
    {
        $request->validate([
            'nama_sumber_dana'  => 'required',

        ]);

        // dd($request);

        $SumberDana->update($request->all());

        return redirect()->route('sumber_danas.index')
            ->with('success', 'Sumber Dana updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SumberDana $SumberDana)
    {
        $SumberDana->delete();

        return redirect()->route('sumber_danas.index')
            ->with('success', 'Sumber Dana deleted successfully.');
    }
}
