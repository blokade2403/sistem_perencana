<?php

namespace App\Http\Controllers;

use App\Models\JudulHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JudulHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $judul_headers  = JudulHeader::all();
        return view('backend.master_setting.judul_header.index', compact('judul_headers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.master_setting.judul_header.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_rs'       => 'required',
                'alamat_rs'     => 'required',
                'tlp_rs'        => 'required',
                'email_rs'      => 'required|email',
                'wilayah'       => 'required',
                'kode_pos'      => 'nullable',
                'header1'       => 'nullable',
                'header2'       => 'nullable',
                'header3'       => 'nullable',
                'header4'       => 'nullable',
                'header5'       => 'nullable',
                'header6'       => 'nullable',
                'gambar1'       => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'gambar2'       => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'header7'       => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            ],
            [
                'nama_rs.required'   => 'Nama RS wajib diisi.',
                'alamat_rs.required' => 'Alamat RS wajib diisi.',
                'tlp_rs.required'    => 'Telepon RS wajib diisi.',
                'email_rs.required'  => 'Email RS wajib diisi.',
                'email_rs.email'     => 'Format email tidak valid.',
                'wilayah.required'   => 'Wilayah wajib diisi.',
                'wilayah.required'   => 'Wilayah wajib diisi.',
                'wilayah.required'   => 'Wilayah wajib diisi.',
                'gambar1.mimes'      => 'Gambar 1 harus berformat jpg, jpeg, atau png.',
                'gambar1.max'        => 'Ukuran gambar 1 tidak boleh lebih dari 2MB.',
                'gambar2.mimes'      => 'Gambar 2 harus berformat jpg, jpeg, atau png.',
                'gambar2.max'        => 'Ukuran gambar 2 tidak boleh lebih dari 2MB.',
                'header7.mimes'      => 'Gambar 3 harus berformat jpg, jpeg, atau png.',
                'header7.max'        => 'Ukuran gambar 3 tidak boleh lebih dari 2MB.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator)
                ->with('error', 'Periksa Kembali Inputan Anda !!!');
        }

        // Proses upload file gambar
        $namaFile1 = $request->hasFile('gambar1') ? $request->file('gambar1')->store('public/uploads') : null;
        $namaFile2 = $request->hasFile('gambar2') ? $request->file('gambar2')->store('public/uploads') : null;
        $namaFile3 = $request->hasFile('header7') ? $request->file('header7')->store('public/uploads') : null;

        $judul_headers = new JudulHeader([
            'nama_rs'   => $request->nama_rs,
            'alamat_rs' => $request->alamat_rs,
            'tlp_rs'    => $request->tlp_rs,
            'email_rs'  => $request->email_rs,
            'wilayah'   => $request->wilayah,
            'kode_pos'  => $request->kode_pos,
            'header1'   => $request->header1,
            'header2'   => $request->header2,
            'header3'   => $request->header3, // Kolom ini sebelumnya tidak dimasukkan
            'header4'   => $request->header4, // Kolom ini sebelumnya tidak dimasukkan
            'header5'   => $request->header5, // Kolom ini sebelumnya tidak dimasukkan
            'header6'   => $request->header6, // Kolom ini sebelumnya tidak dimasukkan
            'gambar1'   => $namaFile1,
            'gambar2'   => $namaFile2,
            'header7'   => $namaFile3,
        ]);

        $judul_headers->save();

        return redirect()->route('judul_headers.index')->with('success', 'Data Berhasil Ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(JudulHeader $judulHeader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JudulHeader $judulHeader)
    {
        return view('backend.master_setting.judul_header.edit', compact('judulHeader'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JudulHeader $judulHeader)
    {
        // Validasi input
        $validator = Validator::make(
            $request->all(),
            [
                'nama_rs'       => 'required',
                'alamat_rs'     => 'required',
                'tlp_rs'        => 'required',
                'email_rs'      => 'required|email',
                'wilayah'       => 'required',
                'kode_pos'      => 'nullable',
                'header1'       => 'nullable',
                'header2'       => 'nullable',
                'header3'       => 'nullable',
                'header4'       => 'nullable',
                'header5'       => 'nullable',
                'header6'       => 'nullable',
                'gambar1'       => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'gambar2'       => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'header7'       => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            ],
            [
                'nama_rs.required'   => 'Nama RS wajib diisi.',
                'alamat_rs.required' => 'Alamat RS wajib diisi.',
                'tlp_rs.required'    => 'Telepon RS wajib diisi.',
                'email_rs.required'  => 'Email RS wajib diisi.',
                'email_rs.email'     => 'Format email tidak valid.',
                'wilayah.required'   => 'Wilayah wajib diisi.',
                'wilayah.required'   => 'Wilayah wajib diisi.',
                'wilayah.required'   => 'Wilayah wajib diisi.',
                'gambar1.mimes'      => 'Gambar 1 harus berformat jpg, jpeg, atau png.',
                'gambar1.max'        => 'Ukuran gambar 1 tidak boleh lebih dari 2MB.',
                'gambar2.mimes'      => 'Gambar 2 harus berformat jpg, jpeg, atau png.',
                'gambar2.max'        => 'Ukuran gambar 2 tidak boleh lebih dari 2MB.',
                'header7.mimes'      => 'Gambar 3 harus berformat jpg, jpeg, atau png.',
                'header7.max'        => 'Ukuran gambar 3 tidak boleh lebih dari 2MB.',
            ]
        );

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator)
                ->with('error', 'Periksa Kembali Inputan Anda !!!');
        }

        // Proses upload file gambar, gunakan gambar yang sudah ada jika tidak ada gambar baru
        $namaFile1 = $request->hasFile('gambar1') ? $request->file('gambar1')->store('public/uploads') : $judulHeader->gambar1;
        $namaFile2 = $request->hasFile('gambar2') ? $request->file('gambar2')->store('public/uploads') : $judulHeader->gambar2;
        $namaFile3 = $request->hasFile('header7') ? $request->file('header7')->store('public/uploads') :  $judulHeader->header7;

        // Update data
        $judulHeader->update([
            'nama_rs'   => $request->nama_rs,
            'alamat_rs' => $request->alamat_rs,
            'tlp_rs'    => $request->tlp_rs,
            'email_rs'  => $request->email_rs,
            'wilayah'   => $request->wilayah,
            'kode_pos'  => $request->kode_pos,
            'header1'   => $request->header1,
            'header2'   => $request->header2,
            'header3'   => $request->header3, // Kolom ini sebelumnya tidak dimasukkan
            'header4'   => $request->header4, // Kolom ini sebelumnya tidak dimasukkan
            'header5'   => $request->header5, // Kolom ini sebelumnya tidak dimasukkan
            'header6'   => $request->header6, // Kolom ini sebelumnya tidak dimasukkan
            'gambar1'   => $namaFile1,
            'gambar2'   => $namaFile2,
            'header7'   => $namaFile3,
        ]);

        // dd($judulHeader);

        return redirect()->route('judul_headers.index')->with('success', 'Data Berhasil di Update');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JudulHeader $judulHeader)
    {
        $judulHeader->delete();

        return redirect()->route('judul_headers.index')
            ->with('success', 'kategori_rkbu deleted successfully.');
    }
}
