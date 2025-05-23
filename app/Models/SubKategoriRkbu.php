<?php

namespace App\Models;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SubKategoriRkbuImport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubKategoriRkbu extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'sub_kategori_rkbus';
    protected $primaryKey = 'id_sub_kategori_rkbu';
    protected $fillable =
    [
        'id_kategori_rkbu',
        //'id_jenis_belanja',
        'id_kode_rekening_belanja',
        'id_admin_pendukung_ppk',
        'id_sub_kategori_rekening',
        'kode_sub_kategori_rkbu',
        'nama_sub_kategori_rkbu',
        'status',
    ];

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        Excel::import(new SubKategoriRkbuImport, $request->file('file'));

        return back()->with('success', 'Data berhasil diimport!');
    }

    public function kategori_rkbu()
    {
        return $this->belongsTo(KategoriRkbu::class, 'id_kategori_rkbu');
    }

    public function kategoriRkbu()
    {
        return $this->belongsTo(KategoriRkbu::class, 'id_kategori_rkbu');
    }

    public function rkbus()
    {
        return $this->hasMany(Rkbu::class, 'id_sub_kategori_rkbu', 'id_sub_kategori_rkbu');
    }

    public function usulan_barangs()
    {
        return $this->hasMany(UsulanBarang::class, 'id_sub_kategori_rkbu', 'id_sub_kategori_rkbu');
    }

    public function master_spj()
    {
        return $this->belongsTo(MasterSpj::class, 'id_master_spj');
    }

    public function jenis_kategori_rkbu()
    {
        return $this->belongsTo(JenisKategoriRkbu::class, 'id_jenis_kategori_rkbu');
    }

    public function sub_kategori_rekening()
    {
        return $this->belongsTo(SubKategoriRekening::class, 'id_sub_kategori_rekening');
    }

    public function admin_pendukung()
    {
        return $this->belongsTo(AdminPendukung::class, 'id_admin_pendukung_ppk');
    }

    public function aktivitas()
    {
        return $this->hasOne(Aktivitas::class, 'id_sub_kategori_rkbu');
    }

    public function kegiatan()
    {
        return $this->hasOne(Kegiatan::class, 'id_sub_kategori_rkbu');
    }

    public function jenis_belanja()
    {
        return $this->belongsTo(JenisBelanja::class, 'id_jenis_belanja');
    }

    public function rekening_belanja()
    {
        return $this->belongsTo(RekeningBelanja::class, 'id_kode_rekening_belanja', 'id_kode_rekening_belanja');
    }

    public function rekening_belanja2()
    {
        return $this->hasManyThrough(
            RekeningBelanja::class, // Model tujuan
            Rkbu::class,           // Model perantara
            'id_sub_kategori_rkbu', // Foreign key di tabel rkbus
            'id_kode_rekening_belanja', // Foreign key di tabel rekening_belanjas
            'id_sub_kategori_rkbu', // Local key di tabel sub_kategori_rkbus
            'id_kode_rekening_belanja'  // Local key di tabel rkbus
        );
    }

    public function realisasiAnggaran()
    {
        return $this->hasManyThrough(
            MasterSpj::class,
            SpjDetail::class,
            'id_rkbu', // Foreign key di tabel `spj_details`
            'id_spj',  // Foreign key di tabel `master_spjs`
            'id_sub_kategori_rkbu', // Primary key di tabel ini
            'id_spj' // Local key di tabel `spj_details`
        )->where('master_spjs.keterangan', 'Sudah di Bayar');
    }
}
