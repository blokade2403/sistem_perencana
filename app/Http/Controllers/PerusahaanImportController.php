<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PerusahaanImportController extends Controller
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

            Perusahaan::create([
                'nama_perusahaan'           =>  $row['A'],
                'alamat_perusahaan'         =>  $row['B'],
                'email_perusahaan'          =>  $row['C'],
                'tlp_perusahaan'            =>  $row['D'],
                'nama_direktur_perusahaan'  =>  $row['E'],
                'jabatan_perusahaan'        =>  $row['F'],
                'no_npwp'                   =>  $row['G'],
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil diimport!');
    }

    public function downloadReport()
    {
        // Tentukan path file yang akan didownload
        $filePath = storage_path('app/public/download/Format_upload_data_perusahaan.xlsx');

        // Cek jika file ada
        if (File::exists($filePath)) {
            // Download file
            return response()->download($filePath);
        } else {
            // Jika file tidak ada
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
    }
}
