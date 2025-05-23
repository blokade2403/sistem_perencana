<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UraianSatu extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = 'id_uraian_1';
    protected $fillable = ['nama_uraian_1'];
}
