<?php

namespace App\Imports;

use App\Models\KategoriRkbu;
use Maatwebsite\Excel\Concerns\ToModel;

class KategoriRkbuImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new KategoriRkbu([
            //
        ]);
    }
}
