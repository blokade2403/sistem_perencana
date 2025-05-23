<?php

namespace App\Http\Controllers;

use App\Models\KategoriRkbu;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class KategoriRkbuImportController extends Controller
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

            KategoriRkbu::create([
                'id_jenis_kategori_rkbu' => $row['A'],  // Asumsi kolom A adalah id_jenis_kategori_rkbu
                'id_obyek_belanja'       => $row['B'],  // Kolom B adalah id_obyek_belanja
                'kode_kategori_rkbu'     => $row['C'],  // Kolom C adalah kode_kategori_rkbu
                'nama_kategori_rkbu'     => $row['D'],  // Kolom D adalah nama_kategori_rkbu
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil diimport!');
    }
}
