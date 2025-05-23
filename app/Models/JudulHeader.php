<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JudulHeader extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = 'id_judul_header';
    protected $fillable = [
        'nama_rs',
        'alamat_rs',
        'tlp_rs',
        'email_rs',
        'wilayah',
        'kode_pos',
        'header1',
        'header2',
        'header3',
        'header4',
        'header5',
        'header6',
        'header7',
        'gambar1',
        'gambar2',
    ];
}
