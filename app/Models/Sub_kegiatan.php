<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_kegiatan extends Model
{
    use HasFactory, HasUuids;
    protected $table        = 'sub_kegiatans';
    protected $primaryKey = 'id_sub_kegiatan';
    protected $fillable =
    [
        'nama_sub_kegiatan',
        'id_kegiatan',
        'kode_sub_kegiatan',
        'tujuan_sub_kegiatan',
        'indikator_sub_kegiatan',
        'id_sumber_dana'
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan');
    }

    public function sumber_dana()
    {
        return $this->belongsTo(SumberDana::class, 'id_sumber_dana', 'id_sumber_dana');
    }
}
