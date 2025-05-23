<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKategoriRekening extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = 'id_sub_kategori_rekening';
    protected $fillable =
    [
        'id_kategori_rekening',
        'kode_sub_kategori_rekening',
        'nama_sub_kategori_rekening'
    ];

    public function kategori_rekening()
    {
        return $this->belongsTo(KategoriRekening::class, 'id_kategori_rekening');
    }
}
