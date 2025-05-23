<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriRekening extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = 'id_kategori_rekening';
    protected $fillable = ['kode_kategori_rekening', 'nama_kategori_rekening'];

    public function sub_kategori_rekening()
    {
        return $this->hasMany(SubKategoriRekening::class, 'id_sub_kategori_rekening');
    }
}
