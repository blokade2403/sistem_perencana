<?php

namespace App\Http\Controllers;

use App\Models\Rkbu;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class RkbuPersediaanImportController extends Controller
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

            Rkbu::create([
                'id_sub_kategori_rkbu'                  =>  $row['A'],
                'id_sub_kategori_rekening'              =>  $row['B'],
                'id_kode_rekening_belanja'              =>  $row['C'],
                'id_status_validasi'                    =>  $row['D'],
                'id_status_validasi_rka'                =>  $row['E'],
                'id_user'                               =>  $row['F'],
                'nama_tahun_anggaran'                   =>  $row['G'],
                'nama_barang'                           =>  $row['H'],
                'vol_1'                                 =>  $row['I'],
                'satuan_1'                              =>  $row['J'],
                'vol_2'                                 =>  $row['K'],
                'satuan_2'                              =>  $row['L'],
                'spek'                                  =>  $row['M'],
                'jumlah_vol'                            =>  $row['N'],
                'harga_satuan'                          =>  $row['O'],
                'ppn'                                   =>  $row['P'],
                'total_anggaran'                        =>  $row['Q'],
                'rating'                                =>  $row['R'],
                'link_ekatalog'                         =>  $row['S'],
                'penempatan'                            =>  $row['T'],
                'stok'                                  =>  $row['U'],
                'rata_rata_pemakaian'                   =>  $row['V'],
                'kebutuhan_per_bulan'                   =>  $row['W'],
                'buffer'                                =>  $row['X'],
                'pengadaan_sebelumnya'                  =>  $row['Y'],
                'proyeksi_sisa_stok'                    =>  $row['X'],
                'kebutuhan_plus_buffer'                 =>  $row['AA'],
                'kebutuhan_tahun_x1'                    =>  $row['AB'],
                'rencana_pengadaan_tahun_x1'            =>  $row['AC'],
                'nama_pegawai'                          =>  $row['AD'],
                'tempat_lahir'                          =>  $row['AE'],
                'tanggal_lahir'                         =>  $row['AF'],
                'pendidikan'                            =>  $row['AG'],
                'jabatan'                               =>  $row['AH'],
                'status_kawin'                          =>  $row['AI'],
                'nomor_kontrak'                         =>  $row['AJ'],
                'tmt_pegawai'                           =>  $row['AK'],
                'bulan_tmt'                             =>  $row['AL'],
                'tahun_tmt'                             =>  $row['AM'],
                'gaji_pokok'                            =>  $row['AN'],
                'remunerasi'                            =>  $row['AO'],
                'koefisien_remunerasi'                  =>  $row['AP'],
                'koefisien_gaji'                        =>  $row['AQ'],
                'bpjs_kesehatan'                        =>  $row['AR'],
                'bpjs_tk'                               =>  $row['AS'],
                'bpjs_jht'                              =>  $row['AT'],
                'total_gaji_pokok'                      =>  $row['AU'],
                'total_remunerasi'                      =>  $row['AV'],
                'sisa_vol_rkbu'                         =>  $row['AW'],
                'sisa_anggaran_rkbu'                    =>  $row['AX'],

            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil diimport!');
    }
}
