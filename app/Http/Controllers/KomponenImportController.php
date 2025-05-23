<?php

namespace App\Http\Controllers;

use App\Models\Komponen;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class KomponenImportController extends Controller
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

            Komponen::create([
                'id_jenis_kategori_rkbu'    =>  $row['A'],
                'kode_barang'               =>  $row['B'],
                'kode_komponen'             =>  $row['C'],
                'nama_barang'               =>  $row['D'],
                'satuan'                    =>  $row['E'],
                'spek'                      =>  $row['F'],
                'harga_barang'              =>  $row['G'],
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil diimport!');
    }
}
