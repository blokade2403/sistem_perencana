<?php

namespace App\Http\Controllers;

use App\Models\ObyekBelanja;
use Illuminate\Http\Request;
use App\Models\JenisKategoriRkbu;
use Illuminate\Support\Facades\Validator;

class ObyekBelanjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obyek_belanjas   = ObyekBelanja::all();
        return view('backend.master_setting.obyek_belanjas.index', compact('obyek_belanjas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis_kategori_rkbus = JenisKategoriRkbu::all();
        return view('backend.master_setting.obyek_belanjas.create', compact('jenis_kategori_rkbus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator      = Validator::make(
            $request->all(),
            [
                'id_jenis_kategori_rkbu'        => 'required',
                'kode_obyek_belanja'            => 'required',
                'nama_obyek_belanja'            => 'required',
            ],
            [
                'id_jenis_kategori_rkbu'        => 'id_jenis_kategori_rkbu required',
                'kode_obyek_belanja'            => 'kode_obyek_belanja required',
                'nama_obyek_belanja'            => 'nama_obyek_belanja required',
            ]
        );



        if ($validator->fails()) {
            $errors  = $validator->errors();
            $errorMessages  = implode(' ', $errors->all());

            return redirect()->back()->withInput()->with('error', 'Periksa Kembali Inputan Anda!!' . $errorMessages);
        }

        $obyek_belanjas = new ObyekBelanja(
            [
                'id_jenis_kategori_rkbu'        => $request->id_jenis_kategori_rkbu,
                'kode_obyek_belanja'            => $request->kode_obyek_belanja,
                'nama_obyek_belanja'            => $request->nama_obyek_belanja,
            ]
        );

        // dd($obyek_belanjas);

        $obyek_belanjas->save();
        return redirect()->route('obyek_belanjas.index')->with('success', 'Data Berhasil di Tambahkan !!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ObyekBelanja $obyekBelanja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jenis_kategori_rkbus = JenisKategoriRkbu::all();
        $obyekBelanja     = ObyekBelanja::with('jenis_kategori_rkbu')->findOrFail($id);
        return view('backend.master_setting.obyek_belanjas.edit', compact('jenis_kategori_rkbus', 'obyekBelanja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ObyekBelanja $obyekBelanja)
    {
        $validator  = Validator::make(
            $request->all(),
            [
                'id_jenis_kategori_rkbu'        => 'required',
                'kode_obyek_belanja'            => 'required',
                'nama_obyek_belanja'            => 'required',
            ],
            [
                'id_jenis_kategori_rkbu'        => 'id_jenis_kategori_rkbu required',
                'kode_obyek_belanja'            => 'kode_obyek_belanja required',
                'nama_obyek_belanja'            => 'nama_obyek_belanja required',
            ]
        );

        if ($validator->fails()) {
            $error = $validator->errors();
            $errorMessages  = implode(' ', $error->all());
            return redirect()->back()->withInput()->with('error', 'Periksa Kembali Updatean Data', $errorMessages);
        }

        // dd($request);

        $obyekBelanja->update($request->all());
        return redirect()->route('obyek_belanjas.index')->with('success', 'Data Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ObyekBelanja $obyekBelanja)
    {
        //
    }
}
