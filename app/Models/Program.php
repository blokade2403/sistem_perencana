<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory, HasUuids;

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class, 'id_program', 'id_program');
    }

    protected $primaryKey = 'id_program';
    protected $fillable = [
        'kode_program',
        'nama_program'
    ];
}
