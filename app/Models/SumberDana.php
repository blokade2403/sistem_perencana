<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberDana extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = 'id_sumber_dana';
    protected $fillable = ['nama_sumber_dana'];

    // Fungsi relasi untuk sub_kegiatan
    public function sub_kegiatans()
    {
        return $this->belongsToMany(SubKegiatan::class); // Jika relasi Many-to-Many
        // return $this->hasMany(SubKegiatan::class); // Jika relasi One-to-Many
    }
}
