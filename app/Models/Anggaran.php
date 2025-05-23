<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Anggaran extends Model
{
    use HasFactory, HasUuids;

    protected $table            = 'anggarans';
    protected $primaryKey       = 'id_anggaran';
    protected $fillable = [
        'id_kode_rekening_belanja',
        'id_sumber_dana',
        'nama_anggaran',
        'jumlah_anggaran',
        'tahun_anggaran'
    ];

    public function rekening_belanjas()
    {
        return $this->belongsTo(RekeningBelanja::class, 'id_kode_rekening_belanja');
    }

    public function sumber_dana()
    {
        return $this->belongsTo(SumberDana::class, 'id_sumber_dana');
    }
}
