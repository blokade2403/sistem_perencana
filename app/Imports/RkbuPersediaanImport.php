<?php

namespace App\Imports;

use App\Models\RkbuPersediaan;
use Maatwebsite\Excel\Concerns\ToModel;

class RkbuPersediaanImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new RkbuPersediaan([
            'id_kategori_rkbu'          =>  $row[0],
            'id_admin_pendukung_ppk'    =>  $row[1],
            'id_sub_kategori_rekening'  =>  $row[2],
            'kode_sub_kategori_rkbu'    =>  $row[3],
            'nama_sub_kategori_rkbu'    =>  $row[4],
            'status'                    =>  $row[5],
        ]);
    }
}
