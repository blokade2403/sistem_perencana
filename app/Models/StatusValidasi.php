<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusValidasi extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = 'id_status_validasi';
    protected $fillable = ['nama_validasi'];
}
