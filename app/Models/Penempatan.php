<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penempatan extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'penempatans';
    protected $primaryKey = 'id_penempatan';

    protected $fillable = [
        'lokasi_barang',
        'tempat_lokasi',
        'gedung',
        'penanggung_jawab',
    ];
}
