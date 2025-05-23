<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriUploadDokumen;
use Illuminate\Support\Facades\Validator;

class KategoriUploadDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori_upload_dokumen = KategoriUploadDokumen::all();
        return view('backend.master_setting.kategori_upload_dokumen.index', compact('kategori_upload_dokumen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.master_setting.kategori_upload_dokumen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, KategoriUploadDokumen $KategoriUploadDokumen)
    {
        $request->validate([
            'nama_kategori_upload_dokumen'  => 'required',
        ]);

        $KategoriUploadDokumen = new KategoriUploadDokumen([
            'nama_kategori_upload_dokumen'       => $request->nama_kategori_upload_dokumen,

        ]);

        // dd($KategoriUploadDokumen);

        $KategoriUploadDokumen->save();

        return redirect()->route('kategori_upload_dokumens.index')
            ->with('success', 'Tahun Anggaran updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriUploadDokumen $KategoriUploadDokumen)
    {
        return view('backend.master_setting.kategori_upload_dokumen.show', compact('KategoriUploadDokumen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriUploadDokumen $KategoriUploadDokumen)
    {
        return view('backend.master_setting.kategori_upload_dokumen.edit', compact('KategoriUploadDokumen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriUploadDokumen $KategoriUploadDokumen)
    {
        // Validasi input
        $validator = Validator::make(
            $request->all(),
            [
                'nama_kategori_upload_dokumen' => 'required|string|max:255',
            ]
        );

        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Update data KategoriUploadDokumen
            $KategoriUploadDokumen->update([
                'nama_kategori_upload_dokumen' => $request->input('nama_kategori_upload_dokumen'),
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('kategori_upload_dokumens.index')
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
    public function destroy(KategoriUploadDokumen $KategoriUploadDokumen)
    {
        $KategoriUploadDokumen->delete();

        return redirect()->route('kategori_upload_dokumens.index')
            ->with('success', 'Tahun Anggaran deleted successfully.');
    }
}
