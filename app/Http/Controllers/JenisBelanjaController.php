<?php

namespace App\Http\Controllers;

use App\Models\JenisBelanja;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class JenisBelanjaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            try {
                // Pastikan tabel ada di database
                $jenis_belanjas = JenisBelanja::select(['id_jenis_belanja', 'kode_jenis_belanja', 'nama_jenis_belanja']);

                return DataTables::of($jenis_belanjas)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        return '
                        <div class="demo-inline-spacing">
                         <div class="d-flex justify-content-start align-items-center gap-2">
                            <a href="' . route('jenis_belanjas.edit', $row->id_jenis_belanja) . '" class="btn btn-icon btn-primary waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-primary" data-bs-original-title="Edit Data"><span class="tf-icons mdi mdi-comment-edit"></span></a>
                            <form action="' . route('jenis_belanjas.destroy', $row->id_jenis_belanja) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\');">
                                ' . csrf_field() . method_field("DELETE") . '
                                <button type="submit" class="btn btn-icon btn-outline-danger waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" data-bs-original-title="Hapus Data"><span class="tf-icons mdi mdi-delete-empty-outline"></span></button>
                            </form>
                        </div>
                        </div>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        return view('backend.master_setting.jenis_belanjas.index');
    }


    public function create()
    {

        return view('backend.master_setting.jenis_belanjas.create');
    }

    public function store(Request $request)
    {
        $validator  = Validator::make(
            $request->all(),
            ['kode_jenis_belanja'   => 'required'],
            ['nama_jenis_belanja'   => 'Nama Harud Diisi']
        );

        if ($validator->fails()) {
            // Mengambil semua pesan error
            $errors = $validator->errors();
            // dd($errors);
            // Menyusun pesan error menjadi string
            $errorMessages = implode(' ', $errors->all());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
        }

        $jenis_belanja = new JenisBelanja(
            [
                'kode_jenis_belanja'   => $request->kode_jenis_belanja,
                'nama_jenis_belanja'   => $request->nama_jenis_belanja,
            ]
        );

        // dd($jenis_belanja);
        $jenis_belanja->save();
        return redirect()->route('jenis_belanjas.index')->with('success', 'Nama jenis_belanja Delete Success');
    }

    public function show(JenisBelanja $jenisBelanja)
    {
        //
    }

    public function edit(JenisBelanja $jenisBelanja)
    {
        return view('backend.master_setting.jenis_belanjas.edit', compact('jenisBelanja'));
    }

    public function update(Request $request, JenisBelanja $jenisBelanja)
    {
        $validator  = Validator::make(
            $request->all(),
            ['kode_jenis_belanja' => 'required'],
            ['nama_jenis_belanja'  => 'Nama Harud Diisi']
        );

        if ($validator->fails()) {
            // Mengambil semua pesan error
            $errors = $validator->errors();
            // dd($errors);
            // Menyusun pesan error menjadi string
            $errorMessages = implode(' ', $errors->all());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
        }
        // dd($request);

        $jenisBelanja->update($request->all());
        return redirect()->route('jenis_belanjas.index')->with('success', 'Nama level_user Delete Success');
    }

    public function destroy(JenisBelanja $jenisBelanja)
    {
        //
    }
}
