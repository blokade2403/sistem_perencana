<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanggalPerencanaan extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = 'id_tanggal_perencanaan';
    protected $fillable = ['id_tahun_anggaran', 'id_fase', 'tanggal', 'no_dpa', 'kota', 'status'];
    protected $table = 'tanggal_perencanaans';

    public function TahunAnggaran()
    {
        return $this->belongsTo(TahunAnggaran::class, 'id_tahun_anggaran');
    }

    public function Fase()
    {
        return $this->belongsTo(Fase::class, 'id_fase');
    }
}
