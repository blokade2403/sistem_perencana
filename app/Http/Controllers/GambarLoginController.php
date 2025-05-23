<?php

namespace App\Http\Controllers;

use App\Models\GambarLogin;
use App\Models\TahunAnggaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GambarLoginController extends Controller
{
    public function index()
    {
        $gambarLogin  = GambarLogin::all();
        return view('backend.master_setting.gambar_login.index', compact('gambarLogin'));
    }

    public function create()
    {
        $tahun_anggaran = TahunAnggaran::all();
        return view('backend.master_setting.gambar_login.create', compact('tahun_anggaran'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'gambar_login'       => 'nullable|image|mimes:png|max:2048',
                'status_gambar'      => 'required|in:Aktif,Non Aktif',
                'tahun_anggaran'     => 'required',
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessages = implode(' ', $errors->all());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
        }


        // Proses upload file gambar
        $namaFile1 = $request->hasFile('gambar_login') ? $request->file('gambar_login')->store('public/gambar_login') : null;

        $gambarLogin = new GambarLogin([
            'gambar_login'      => $namaFile1,
            'tahun_anggaran'    => $request->tahun_anggaran,
            'status_gambar'     => $request->status_gambar,
        ]);

        // dd($gambarLogin);

        $gambarLogin->save();

        return  redirect()->route('gambar_logins.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function show(string $id)
    {
        $gambarLogin = GambarLogin::findOrFail($id);
        return response()->json($gambarLogin);
    }

    public function edit(GambarLogin $gambarLogin)
    {
        $tahun_anggaran = TahunAnggaran::all();
        return view('backend.master_setting.gambar_login.edit', compact('gambarLogin', 'tahun_anggaran'));
    }

    public function update(Request $request, GambarLogin $gambarLogin)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'gambar_login'       => 'nullable|image|mimes:png|max:2048',
                'status_gambar'      => 'required|in:Aktif,Non Aktif',
                'tahun_anggaran'     => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator)
                ->with('error', 'Periksa Kembali Inputan Anda !!!');
        }

        // Proses upload file gambar
        if ($request->hasFile('gambar_login')) {
            // Delete the old image file if exists
            if ($gambarLogin->gambar_login && Storage::exists($gambarLogin->gambar_login)) {
                Storage::delete($gambarLogin->gambar_login);
            }

            // Store the new image
            $namaFile1 = $request->file('gambar_login')->store('public/gambar_login');
        } else {
            // If no new image, keep the old one
            $namaFile1 = $gambarLogin->gambar_login;
        }

        // Update the record
        $gambarLogin->update([
            'gambar_login'      => $namaFile1,
            'tahun_anggaran'    => $request->tahun_anggaran,
            'status_gambar'     => $request->status_gambar,
        ]);

        return redirect()->route('gambar_logins.index')->with('success', 'Data Berhasil Diperbarui');
    }


    public function destroy(string $id)
    {
        $gambarLogin = GambarLogin::findOrFail($id);

        // Hapus semua file gambar terkait
        foreach (range(1, 6) as $i) {
            $fileKey = "gambar{$i}";
            if ($gambarLogin->$fileKey) {
                Storage::delete('public/' . $gambarLogin->$fileKey);
            }
        }

        $gambarLogin->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
