<?php

namespace App\Imports;

use App\Models\Perusahaan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Concerns\ToModel;

class PerusahaanImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Perusahaan([
            'nama_perusahaan'           =>  $row['1'],
            'alamat_perusahaan'         =>  $row['2'],
            'email_perusahaan'          =>  $row['3'],
            'tlp_perusahaan'            =>  $row['4'],
            'nama_direktur_perusahaan'  =>  $row['5'],
            'jabatan_perusahaan'        =>  $row['6'],
            'no_npwp'                   =>  $row['7'],
        ]);
    }
}
