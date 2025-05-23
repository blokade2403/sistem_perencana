<?php

namespace App\Http\Controllers;

use App\Models\Pptk;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AdminPendukung;
use App\Models\PejabatPengadaan;
use Illuminate\Support\Facades\Validator;

class AdminPendukungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin_pendukungs   = AdminPendukung::all();
        return view('backend.setting_user.admin_pendukung_ppks.index', compact('admin_pendukungs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pejabat_pengadaans = PejabatPengadaan::all();
        $pptks = Pptk::all();
        $users = User::where('id_level', '9dba8d34-082f-495e-81a7-393dcb51d073')->get();
        $admin_pendukungs   = AdminPendukung::with(['pejabat_pengadaan', 'pptk', 'user'])->get();
        // dd($pejabat_pengadaans);
        return view('backend.setting_user.admin_pendukung_ppks.create', compact('admin_pendukungs', 'pejabat_pengadaans', 'pptks', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_pendukung_ppk'        => 'required',
                'jabatan_pendukung_ppk'     =>  'required',
                'nrk'                       =>  'required',
                'id_pejabat_pengadaan'      =>  'required',
                'id_pptk'                   =>  'required',
                'id_user'                   =>  'required'
            ],
            [
                'nama_pendukung_ppk'        =>  'Nama Pendukung Belum terisi data!!',
                'jabatan_pendukung_ppk'     =>  'Jabatan Pendukung Belum terisi data!!',
                'nrk'                       =>  'NRK Belum terisi data!!',
                'id_pejabat_pengadaan'      =>  'Pejabat Pengadaan Belum terisi data!!',
                'id_pptk'                   =>  'Nama PPTK Belum terisi data!!',
                'id_user'                   =>  'ID User Belum terisi data!!'
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->error();

            $errorMessages = implode(' ', $errors->all());
            return redirect()->back()->withInput()->with('error', 'Periksa Kembali Data Inputan Anda !!!' . $errorMessages);
        }

        $admin_pendukungs = new AdminPendukung(
            [
                'nama_pendukung_ppk'        => $request->nama_pendukung_ppk,
                'jabatan_pendukung_ppk'     => $request->jabatan_pendukung_ppk,
                'nrk'                       => $request->nrk,
                'id_pejabat_pengadaan'      => $request->id_pejabat_pengadaan,
                'id_pptk'                   => $request->id_pptk,
                'id_user'                   => $request->id_user
            ]
        );

        // dd($admin_pendukungs);
        $admin_pendukungs->save();
        return redirect()->route('admin_pendukungs.index')->with('success', 'Data Admin Pendukung Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdminPendukung $adminPendukung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $admin_pendukungs       = AdminPendukung::with('pejabat_pengadaan')->findOrFail($id);
        $pejabat_pengadaans     = PejabatPengadaan::all();
        $users                  = User::where('id_level', '9dba8d34-082f-495e-81a7-393dcb51d073')->get();
        $pptks                  = Pptk::all();
        return view('backend.setting_user.admin_pendukung_ppks.edit', compact('admin_pendukungs', 'pejabat_pengadaans', 'pptks', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminPendukung $adminPendukung)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_pendukung_ppk'        => 'required',
                'jabatan_pendukung_ppk'     =>  'required',
                'nrk'                       =>  'required',
                'id_pejabat_pengadaan'      =>  'required',
                'id_pptk'                   =>  'required',
                'id_user'                   =>  'required'
            ],
            [
                'nama_pendukung_ppk'        =>  'Nama Pendukung Belum terisi data!!',
                'jabatan_pendukung_ppk'     =>  'Jabatan Pendukung Belum terisi data!!',
                'nrk'                       =>  'NRK Belum terisi data!!',
                'id_pejabat_pengadaan'      =>  'Pejabat Pengadaan Belum terisi data!!',
                'id_pptk'                   =>  'Nama PPTK Belum terisi data!!',
                'id_user'                   =>  'ID User Belum terisi data!!'
            ]
        );

        if ($validator->fails()) {
            $errors             = $validator->error();
            $errorMessages      = implode(' ', $errors->all());
            return redirect()->back()->withInput()->with('error', 'Periksa Kembali Update Data Anda !!' . $errorMessages);
        }

        $adminPendukung->update($request->all());
        return redirect()->route('admin_pendukungs.index')->with('success', 'Data Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminPendukung $adminPendukung)
    {
        //
    }
}
