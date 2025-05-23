<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubKategoriRkbu;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SubKategoriRkbuImportController extends Controller
{
    public function importForm()
    {
        return view('kategori_rkbu.import');
    }

    public function import(Request $request)
    {
        // Validasi file upload
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Ambil file yang di-upload
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathName());
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        // Looping untuk memasukkan data dari file ke database
        foreach ($sheetData as $index => $row) {
            if ($index == 1) {
                // Lewati header (baris pertama)
                continue;
            }

            SubKategoriRkbu::create([
                'id_kategori_rkbu'          =>  $row['A'],
                'id_admin_pendukung_ppk'    =>  $row['B'],
                'id_sub_kategori_rekening'  =>  $row['C'],
                'kode_sub_kategori_rkbu'    =>  $row['D'],
                'nama_sub_kategori_rkbu'    =>  $row['E'],
                'status'                    =>  $row['F'],
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil diimport!');
    }
}
