<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SpjDetail extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'spj_details';
    protected $primaryKey       = 'id_spj_detail';
    public $incrementing = false; // Karena menggunakan UUID
    protected $keyType = 'string'; // UUID adalah string

    protected $fillable = [
        'id_spj_detail',
        'id_spj',
        'id_rkbu',
        'id_usulan_barang',
        'id_usulan_barang_detail',
    ];

    public function programs()
    {
        return $this->belongsTo(Program::class, 'id_program');
    }

    // Event untuk mengisi id_spj_detail dengan UUID secara otomatis
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id_spj_detail = (string) Str::uuid();
        });
    }
}
