<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = 'id_jabatan';
    protected $fillable = ['nama_jabatan', 'id_jabatan'];

    protected $table = 'jabatans';
    public function pejabats()
    {
        return $this->hasMany(Pejabat::class, 'id_jabatan');
    }
}
