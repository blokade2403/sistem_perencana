<?php

namespace App\Providers;

use App\Models\UsulanBarang;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        require_once app_path('Helpers/Helper.php');

        View::composer('layouts.navbar', function ($view) {
            $notifications = UsulanBarang::where('status_permintaan_barang', 'Disetujui Perencana')
                ->join('users', 'users.id_user', '=', 'usulan_barangs.id_user')
                //->join('pejabats', 'users.id_pejabat', '=', 'pejabats.id_pejabat')
                ->where('users.id_pejabat', session('id_pejabat'))
                ->where('usulan_barangs.tahun_anggaran', Session::get('tahun_anggaran'))
                ->where('usulan_barangs.status_usulan_barang', 'Selesai')
                ->where('usulan_barangs.status_permintaan_barang', 'Disetujui Perencana')
                ->join('sub_kategori_rkbus', 'sub_kategori_rkbus.id_sub_kategori_rkbu', '=', 'usulan_barangs.id_sub_kategori_rkbu')
                ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
                ->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
                ->leftJoin('usulan_barang_details', 'usulan_barang_details.id_usulan_barang', '=', 'usulan_barangs.id_usulan_barang')
                ->select('usulan_barangs.*', 'usulan_barangs.id_usulan_barang') // Ambil detail barang juga jika diperlukan
                ->distinct() // Menghapus duplikasi jika ada
                ->get();

            $notifications2 = UsulanBarang::join('users', 'usulan_barangs.id_user', '=', 'users.id_user')
                //->join('ksps', 'users.id_ksp', '=', 'ksps.id_ksp')
                //->join('pejabats', 'users.id_pejabat', '=', 'pejabats.id_pejabat')
                //->where('users.id_pejabat', $id_pejabat)
                ->where('usulan_barangs.tahun_anggaran', Session::get('tahun_anggaran'))
                ->where('usulan_barangs.status_usulan_barang', 'Selesai')
                ->where('usulan_barangs.status_permintaan_barang', 'Perlu Validasi Perencana')
                ->join('sub_kategori_rkbus', 'sub_kategori_rkbus.id_sub_kategori_rkbu', '=', 'usulan_barangs.id_sub_kategori_rkbu')
                ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
                ->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
                ->leftJoin('usulan_barang_details', 'usulan_barang_details.id_usulan_barang', '=', 'usulan_barangs.id_usulan_barang')
                ->select('usulan_barangs.*', 'usulan_barangs.id_usulan_barang') // Ambil detail barang juga jika diperlukan
                ->distinct() // Menghapus duplikasi jika ada
                ->get();

            $notifications3 = UsulanBarang::join('users', 'usulan_barangs.id_user', '=', 'users.id_user')
                ->join('ksps', 'users.id_ksp', '=', 'ksps.id_ksp')
                ->join('pejabats', 'users.id_pejabat', '=', 'pejabats.id_pejabat')
                //->where('users.id_pejabat', $id_pejabat)
                ->where('usulan_barangs.tahun_anggaran', Session::get('tahun_anggaran'))
                ->where('usulan_barangs.status_usulan_barang', 'Selesai')
                ->where('usulan_barangs.status_permintaan_barang', 'Validasi Kabag')
                ->join('sub_kategori_rkbus', 'sub_kategori_rkbus.id_sub_kategori_rkbu', '=', 'usulan_barangs.id_sub_kategori_rkbu')
                ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
                ->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
                ->leftJoin('usulan_barang_details', 'usulan_barang_details.id_usulan_barang', '=', 'usulan_barangs.id_usulan_barang')
                ->select('usulan_barangs.*', 'usulan_barangs.id_usulan_barang') // Ambil detail barang juga jika diperlukan
                ->distinct() // Menghapus duplikasi jika ada
                ->get();

            // Mengirimkan ketiga variabel ke dalam view
            $view->with([
                'notifications' => $notifications,
                'notifications2' => $notifications2,
                'notifications3' => $notifications3
            ]);
        });
    }
}
