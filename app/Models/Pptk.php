<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pptk extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'pptks';

    public function tahun_anggaran()
    {
        return $this->belongsTo(TahunAnggaran::class, 'id');
    }

    protected $primaryKey = 'id_pptk';
    protected $fillable = ['nama_pptk', 'nip_pptk', 'id_tahun_anggaran', 'status'];
}
