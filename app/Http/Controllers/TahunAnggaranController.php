<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAnggaran;
use Illuminate\Support\Facades\Validator;

class TahunAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahun_anggarans = TahunAnggaran::all();
        return view('backend.master_setting.tahun_anggarans.index', compact('tahun_anggarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.master_setting.tahun_anggarans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, TahunAnggaran $TahunAnggaran)
    {
        $request->validate([
            'nama_tahun_anggaran'  => 'required',
            'status'               => 'required',
            'fase_tahun'           => 'required',
        ]);

        $TahunAnggaran = new TahunAnggaran([
            'nama_tahun_anggaran'       => $request->nama_tahun_anggaran,
            'status'                    => $request->status,
            'fase_tahun'                => $request->fase_tahun,

        ]);

        // dd($tahunAnggaran);

        $TahunAnggaran->save();

        return redirect()->route('tahun_anggarans.index')
            ->with('success', 'Tahun Anggaran updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TahunAnggaran $TahunAnggaran)
    {
        return view('backend.master_setting.tahun_anggarans.show', compact('TahunAnggaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TahunAnggaran $TahunAnggaran)
    {
        return view('backend.master_setting.tahun_anggarans.edit', compact('TahunAnggaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TahunAnggaran $tahunAnggaran)
    {
        // Validasi input
        $validator = Validator::make(
            $request->all(),
            [
                'nama_tahun_anggaran' => 'required|string|max:255',
                'status'              => 'required', // Sesuaikan validasi dengan opsi yang diizinkan
                'fase_tahun'          => 'required|string|max:255',
            ]
        );

        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Update data TahunAnggaran
            $tahunAnggaran->update([
                'nama_tahun_anggaran' => $request->input('nama_tahun_anggaran'),
                'status'              => $request->input('status'),
                'fase_tahun'          => $request->input('fase_tahun'),
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('tahun_anggarans.index')
                ->with('success', 'Tahun Anggaran berhasil diperbarui.');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TahunAnggaran $TahunAnggaran)
    {
        $TahunAnggaran->delete();

        return redirect()->route('tahun_anggarans.index')
            ->with('success', 'Tahun Anggaran deleted successfully.');
    }
}
