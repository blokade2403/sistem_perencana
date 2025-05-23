<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'fases';
    protected $primaryKey = 'id_fase';
    protected $fillable = ['nama_fase'];
}
