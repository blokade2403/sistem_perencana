<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSpj extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = 'id_master_spj';
    protected $table = 'master_spjs';

    protected $fillable = [
        'id_spj',
        'id_user',
        'tanggal_faktur',
        'tgl_kwitansi',
        'status_proses_tukar_faktur',
        'tgl_proses_faktur',
    ];

    protected $guarded = [];

    public function sub_kategori_rkbu()
    {
        return $this->belongsTo(SubKategoriRkbu::class, 'id_sub_kategori_rkbu');
    }

    public function kategori_rkbu()
    {
        return $this->belongsTo(KategoriRkbu::class, 'id_kategori_rkbu');
    }

    public function rekening_belanjas()
    {
        return $this->belongsTo(RekeningBelanja::class, 'id_kode_rekening_belanja', 'id_kode_rekening_belanja');
    }

    public function aktivitas()
    {
        return $this->belongsTo(Aktivitas::class, 'id_aktivitas');
    }

    public function sub_kegiatans()
    {
        return $this->belongsTo(Sub_kegiatan::class, 'id_sub_kegiatan');
    }

    public function kegiatans()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'id_program');
    }

    public function pendukung_ppk()
    {
        return $this->belongsTo(AdminPendukung::class, 'id_admin_pendukung_ppk');
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan', 'id_perusahaan');
    }

    public function sumber_dana()
    {
        return $this->belongsTo(SumberDana::class, 'id_sumber_dana');
    }

    public function status_validasi()
    {
        return $this->belongsTo(StatusValidasi::class, 'id_status_validasi');
    }

    public function status_validasi_rka()
    {
        return $this->belongsTo(StatusValidasiRka::class, 'id_status_validasi_rka');
    }

    public function uraian1()
    {
        return $this->belongsTo(UraianSatu::class, 'id_uraian_1');
    }

    public function uraian2()
    {
        return $this->belongsTo(UraianDua::class, 'id_uraian_2');
    }

    public function usulan_barang_detail()
    {
        return $this->belongsTo(UsulanBarangDetail::class, 'id_usulan_barang_detail');
    }

    public function usulanBarangDetails()
    {
        return $this->hasMany(UsulanBarangDetail::class, 'id_usulan_barang', 'id_usulan_barang');
    }

    public function usulanBarang()
    {
        return $this->belongsTo(UsulanBarang::class, 'id_usulan_barang', 'id_usulan_barang');
    }

    public function ksp()
    {
        return $this->belongsTo(Ksp::class, 'id_ksp');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'id_unit');
    }

    public function adminPendukung()
    {
        return $this->belongsTo(AdminPendukung::class, 'id_admin_pendukung_ppk', 'id_admin_pendukung_ppk');
    }

    public function spj()
    {
        return $this->belongsTo(Spj::class, 'id_spj', 'id_spj');
    }
}
