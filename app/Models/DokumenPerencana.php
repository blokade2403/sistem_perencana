<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPerencana extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'dokumen_perencanas';
    protected $primaryKey = 'id_dokumen_perencana';
    protected $fillable =
    [
        'id_kategori_upload_dokumen',
        'nama_dokumen_perencana',
        'status_dokumen',
        'upload_file',
        'tahun_dokumen',
    ];

    public function KategoriUploadDokumen()
    {
        return $this->belongsTo(KategoriUploadDokumen::class, 'id_kategori_upload_dokumen');
    }
}
