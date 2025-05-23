<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsulanBarangDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UsulanBarangDetailImport extends Controller
{
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

            UsulanBarangDetail::create([
                'id_usulan_barang'                  =>  $row['A'],
                'id_rkbu'                           =>  $row['B'],
                'id_sub_kategori_rkbu'              =>  $row['C'],
                'harga_barang'                      =>  $row['D'],
                'ppn'                               =>  $row['E'],
                'total_ppn'                         =>  $row['F'],
                'jumlah_usulan_barang'              =>  $row['G'],
                'total_anggaran_usulan_barang'      =>  $row['H'],
                'rata2_pemakaian'                   =>  $row['I'],
                'sisa_stok'                         =>  $row['J'],
                'stok_minimal'                      =>  $row['K'],
                'buffer_stok'                       =>  $row['L'],
                'jumlah_vol_rkbu'                   =>  $row['M'],
                'vol_1_detail'                      =>  $row['N'],
                'satuan_1_detail'                   =>  $row['O'],
                'satuan_2_detail'                   =>  $row['P'],
                'spek_detail'                       =>  $row['Q'],
                'created_by'                        =>  $row['R'],
            ]);
            // Update sisa_vol_rkbu dan sisa_anggaran_rkbu di tabel rkbus
            $id_rkbu = $row['B'];

            // Ambil data RKBU terkait
            $rkbu = DB::table('rkbus')->where('id_rkbu', $id_rkbu)->first();

            if ($rkbu) {
                // Hitung total jumlah usulan barang terkait RKBU ini
                $totalUsulanBarang = DB::table('usulan_barang_details')
                    ->where('id_rkbu', $id_rkbu)
                    ->sum('jumlah_usulan_barang');

                // Hitung total anggaran usulan barang terkait RKBU ini
                $totalAnggaranUsulanBarang = DB::table('usulan_barang_details')
                    ->where('id_rkbu', $id_rkbu)
                    ->sum('total_anggaran_usulan_barang');

                // Hitung sisa volume dan sisa anggaran
                $sisa_vol_rkbu = $rkbu->jumlah_vol - $totalUsulanBarang;
                $sisa_anggaran_rkbu = $rkbu->total_anggaran - $totalAnggaranUsulanBarang;

                // Perbarui sisa_vol_rkbu dan sisa_anggaran_rkbu di tabel rkbus
                DB::table('rkbus')
                    ->where('id_rkbu', $id_rkbu)
                    ->update([
                        'sisa_vol_rkbu' => $sisa_vol_rkbu,
                        'sisa_anggaran_rkbu' => $sisa_anggaran_rkbu,
                    ]);
            }
        }

        return redirect()->back()->with('success', 'Data berhasil diimport dan sisa volume serta anggaran diperbarui.');
    }

    public function downloadReport()
    {
        // Tentukan path file yang akan didownload
        $filePath = storage_path('app/public/download/usulan_barang_details.xls');

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
