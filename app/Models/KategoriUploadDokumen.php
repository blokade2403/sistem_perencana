<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriUploadDokumen extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'kategori_upload_dokumens';
    protected $primaryKey = 'id_kategori_upload_dokumen';
    protected $fillable =
    [
        'nama_kategori_upload_dokumen',
    ];
}
