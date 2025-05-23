<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'pejabats';
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }

    public function ksps()
    {
        return $this->hasMany(Ksp::class, 'id_pejabat');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    protected $primaryKey = 'id_pejabat';
    protected $fillable = [
        'id_jabatan',
        'nama_pejabat',
        'nip_pejabat',
        'status',
    ];
}
