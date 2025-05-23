<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpkKeuangan extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = 'id_ppk_keuangan';
    protected $fillable = [
        'nama_ppk_keuangan',
        'nip_ppk_keuangan',
        'status'
    ];

    public function pejabat_pengaaans()
    {
        return $this->hasMany(PejabatPengadaan::class, 'id_pejabat_pengadaan');
    }
}
