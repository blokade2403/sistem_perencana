<?php

namespace App\Http\Controllers;

use App\Models\PpkKeuangan;
use Illuminate\Http\Request;
use App\Models\TahunAnggaran;
use App\Models\PejabatPengadaan;
use Illuminate\Support\Facades\Validator;

class PejabatPengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pejabat_pengadaans = PejabatPengadaan::with('TahunAnggaran', 'ppk_keuangan')->get();
        return view('backend.setting_user.pejabat_pengadaans.index', compact('pejabat_pengadaans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tahun_anggarans  = TahunAnggaran::all();
        $ppk_keuangans   = PpkKeuangan::all();
        return view('backend.setting_user.pejabat_pengadaans.create', compact('tahun_anggarans', 'ppk_keuangans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id_tahun_anggaran'     =>  'required',
                'id_ppk_keuangan'       =>  'required',
                'nama_ppk'              =>  'required',
                'nama_ppbj'             =>  'required',
                'nip_ppk'               =>  'required',
                'nip_ppbj'              =>  'required',
                'status'                =>  'required',
                'nama_pengurus_barang'  =>  'required',
                'nip_pengurus_barang'   =>  'required',
                'nama_direktur'         =>  'required',
                'nip_direktur'          =>  'required',
                'nama_bendahara'        =>  'required',
                'nip_bendahara'         =>  'required',
            ],
            [
                'id_tahun_anggaran'     =>  'id_tahun_anggaran harus terisi',
                'id_ppk_keuangan'       =>  'id_ppk_keuangan harus terisi',
                'nama_ppk'              =>  'nama_ppk harus terisi',
                'nama_ppbj'             =>  'nama_ppbj harus terisi',
                'nip_ppk'               =>  'nip_ppk harus terisi',
                'nip_ppbj'              =>  'nip_ppbj harus terisi',
                'status'                =>  'status harus terisi',
                'nama_pengurus_barang'  =>  'nama_pengurus_barang harus terisi',
                'nip_pengurus_barang'   =>  'nip_pengurus_barang harus terisi',
                'nama_direktur'         =>  'nama_direktur harus terisi',
                'nip_direktur'          =>  'nip_direktur harus terisi',
                'nama_bendahara'        =>  'nama_bendahara harus terisi',
                'nip_bendahara'         =>  'nip_bendahara harus terisi',
            ]
        );
        if ($validator->fails()) {
            $errors  = $validator->errors();
            $errorMessage = implode(' ', $errors->all());

            return redirect()->back()->withInput()->with('error', 'Ada Kesalahan Penginputan, mohon dicek kembali :' . $errorMessage);
        }

        $pejabat_pengadaans = new PejabatPengadaan(
            [
                'id_tahun_anggaran'     =>   $request->id_tahun_anggaran,
                'id_ppk_keuangan'       =>   $request->id_ppk_keuangan,
                'nama_ppk'              =>   $request->nama_ppk,
                'nama_ppbj'             =>   $request->nama_ppbj,
                'nip_ppk'               =>   $request->nip_ppk,
                'nip_ppbj'              =>   $request->nip_ppbj,
                'status'                =>   $request->status,
                'nama_pengurus_barang'  =>   $request->nama_pengurus_barang,
                'nip_pengurus_barang'   =>   $request->nip_pengurus_barang,
                'nama_direktur'         =>   $request->nama_direktur,
                'nip_direktur'          =>   $request->nip_direktur,
                'nama_bendahara'        =>   $request->nama_bendahara,
                'nip_bendahara'         =>   $request->nip_bendahara,
            ]
        );

        // dd($pejabat_pengadaans);

        $pejabat_pengadaans->save();
        return redirect()->route('pejabat_pengadaans.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(PejabatPengadaan $pejabatPengadaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PejabatPengadaan $pejabatPengadaan)
    {
        $ppk_keuangans      = PpkKeuangan::all();
        $tahun_anggarans    = TahunAnggaran::all();
        return view('backend.setting_user.pejabat_pengadaans.edit', compact('pejabatPengadaan', 'ppk_keuangans', 'tahun_anggarans'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PejabatPengadaan $pejabatPengadaan)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id_tahun_anggaran'     =>  'required',
                'id_ppk_keuangan'       =>  'required',
                'nama_ppk'              =>  'required',
                'nama_ppbj'             =>  'required',
                'nip_ppk'               =>  'required',
                'nip_ppbj'              =>  'required',
                'status'                =>  'required',
                'nama_pengurus_barang'  =>  'required',
                'nip_pengurus_barang'   =>  'required',
                'nama_direktur'         =>  'required',
                'nip_direktur'          =>  'required',
                'nama_bendahara'        =>  'required',
                'nip_bendahara'         =>  'required',
            ],
            [
                'id_tahun_anggaran'     =>  'id_tahun_anggaran harus terisi',
                'id_ppk_keuangan'       =>  'id_ppk_keuangan harus terisi',
                'nama_ppk'              =>  'nama_ppk harus terisi',
                'nama_ppbj'             =>  'nama_ppbj harus terisi',
                'nip_ppk'               =>  'nip_ppk harus terisi',
                'nip_ppbj'              =>  'nip_ppbj harus terisi',
                'status'                =>  'status harus terisi',
                'nama_pengurus_barang'  =>  'nama_pengurus_barang harus terisi',
                'nip_pengurus_barang'   =>  'nip_pengurus_barang harus terisi',
                'nama_direktur'         =>  'nama_direktur harus terisi',
                'nip_direktur'          =>  'nip_direktur harus terisi',
                'nama_bendahara'        =>  'nama_bendahara harus terisi',
                'nip_bendahara'         =>  'nip_bendahara harus terisi',
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->error();
            $errorMessage = implode(' ', $errors->all());

            return redirect()->back()->withInput()->with('error', 'Periksa Kembali Inputan Anda !!', $errorMessage);
        }
        // dd($validator);

        $pejabatPengadaan->update($request->all());
        return redirect()->route('pejabat_pengadaans.index')->with('success', 'Data Berhasil di Update !!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PejabatPengadaan $pejabatPengadaan)
    {
        //
    }
}
