<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKategoriRkbu extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey   = 'id_jenis_kategori_rkbu';
    protected $fillable     = ['nama_jenis_kategori_rkbu', 'kode_jenis_kategori_rkbu'];

    // Relasi ke JenisBelanja
    public function jenis_belanja()
    {
        return $this->belongsTo(JenisBelanja::class, 'id_jenis_belanja');
    }

    // Relasi ke ObyekBelanja
    public function obyek_belanjas()
    {
        return $this->hasMany(ObyekBelanja::class, 'id_jenis_kategori_rkbu');
    }
}
