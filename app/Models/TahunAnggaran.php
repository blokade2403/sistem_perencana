<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAnggaran extends Model
{
    use HasFactory, HasUuids;

    public function pptks()
    {
        return $this->hasMany(Pptk::class, 'id');
    }

    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_tahun_anggaran',
        'status',
        'fase_tahun',
    ];
}
