<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = 'id_kegiatan';
    protected $fillable = [
        'id_program',
        'kode_kegiatan',
        'nama_kegiatan'
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'id_program', 'id_program');
    }

    public function sub_kegiatan()
    {
        return $this->hasMany(Sub_kegiatan::class, 'id_sub_kegiatan');
    }

    public function subKegiatans()
    {
        return $this->hasMany(SubKegiatan::class, 'id_kegiatan', 'id_kegiatan');
    }

    public function sub_kegiatans()
    {
        return $this->hasMany(SubKegiatan::class, 'id_kegiatan', 'id_kegiatan');
    }
}
