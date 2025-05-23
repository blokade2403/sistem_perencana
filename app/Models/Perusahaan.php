<?php

namespace App\Models;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = 'id_perusahaan';

    protected $fillable =
    [
        'nama_perusahaan',
        'alamat_perusahaan',
        'email_perusahaan',
        'tlp_perusahaan',
        'nama_direktur_perusahaan',
        'jabatan_perusahaan',
        'no_npwp',
    ];

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        Excel::import(new Perusahaan(), $request->file('file'));

        return back()->with('success', 'Data berhasil diimport!');
    }
}
