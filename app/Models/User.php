<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use App\Models\LevelUser;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'id_ksp',
        'id_pejabat',
        'id_unit',
        'id_level',
        'id_fase',
        'username',
        'nama_lengkap',
        'nip_user',
        'email',
        'password',
        'status_user',
        'status_edit',
        'id_admin_pendukung_ppk'
    ];

    // Definisikan relasi ke model Ksp
    public function ksp()
    {
        return $this->belongsTo(Ksp::class, 'id_ksp');
    }
    // Definisikan relasi ke model Ksp
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'id_unit');
    }

    public function levelUser()
    {
        return $this->belongsTo(LevelUser::class, 'id_level');
    }

    public function tahunAnggaran()
    {
        return $this->belongsTo(TahunAnggaran::class, 'id_tahun_anggaran');
    }

    // Definisikan relasi ke model Ksp
    public function fase()
    {
        return $this->belongsTo(Fase::class, 'id_fase');
    }

    public function pejabat()
    {
        return $this->belongsTo(Pejabat::class, 'id_pejabat');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function rekening_belanjas()
    {
        return $this->hasMany(RekeningBelanja::class, 'id_user');
    }

    public function ksps()
    {
        return $this->hasOne(Ksp::class, 'id_ksp');
    }

    public function rkbus()
    {
        return $this->hasMany(Rkbu::class, 'id_user', 'id_user');
    }

    public function admin_pendukungs()
    {
        return $this->belongsTo(AdminPendukung::class, 'id_admin_pendukung_ppk', 'id_admin_pendukung_ppk');
    }
}
