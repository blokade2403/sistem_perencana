<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusValidasiRka extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'status_validasi_rkas'; // Sesuaikan dengan nama tabel Anda
    protected $primaryKey = 'id_status_validasi_rka';
    protected $fillable = ['nama_status_validasi_rka'];

    public function rkbus()
    {
        return $this->hasMany(Rkbu::class, 'id_status_validasi_rka');
    }
}
