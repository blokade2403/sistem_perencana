<?php

namespace App\Http\Controllers;

use App\Models\UsulanBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NotifikasiUsulanBelanjaController extends Controller
{

    public function viewAllNotifications()
    {
        $id_ksp = session('id_ksp');
        $id_user = session('id_user');
        $id_pejabat          = session('id_pejabat');
        $tahunAnggaran = Session::get('tahun_anggaran');

        $notifications = UsulanBarang::join('users', 'usulan_barangs.id_user', '=', 'users.id_user')
            ->join('ksps', 'users.id_ksp', '=', 'ksps.id_ksp')
            ->join('pejabats', 'users.id_pejabat', '=', 'pejabats.id_pejabat')
            ->where('users.id_pejabat', $id_pejabat)
            ->where('usulan_barangs.tahun_anggaran', $tahunAnggaran)
            ->where('usulan_barangs.status_usulan_barang', 'Selesai')
            ->where('usulan_barangs.status_permintaan_barang', 'Disetujui Perencana')
            ->join('sub_kategori_rkbus', 'sub_kategori_rkbus.id_sub_kategori_rkbu', '=', 'usulan_barangs.id_sub_kategori_rkbu')
            ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
            ->leftJoin('usulan_barang_details', 'usulan_barang_details.id_usulan_barang', '=', 'usulan_barangs.id_usulan_barang')
            ->select('usulan_barangs.*', 'usulan_barang_details.id_usulan_barang_detail') // Ambil detail barang juga jika diperlukan
            ->distinct() // Menghapus duplikasi jika ada
            ->get();

        $notifications2 = UsulanBarang::join('users', 'usulan_barangs.id_user', '=', 'users.id_user')
            //->join('ksps', 'users.id_ksp', '=', 'ksps.id_ksp')
            //->join('pejabats', 'users.id_pejabat', '=', 'pejabats.id_pejabat')
            //->where('users.id_pejabat', $id_pejabat)
            ->where('usulan_barangs.tahun_anggaran', $tahunAnggaran)
            ->where('usulan_barangs.status_usulan_barang', 'Selesai')
            ->where('usulan_barangs.status_permintaan_barang', 'Di Tolak')
            ->join('sub_kategori_rkbus', 'sub_kategori_rkbus.id_sub_kategori_rkbu', '=', 'usulan_barangs.id_sub_kategori_rkbu')
            ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            //->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
            //->leftJoin('usulan_barang_details', 'usulan_barang_details.id_usulan_barang', '=', 'usulan_barangs.id_usulan_barang')
            //->select('usulan_barangs.*', 'usulan_barang_details.id_usulan_barang_detail') // Ambil detail barang juga jika diperlukan
            ->distinct() // Menghapus duplikasi jika ada
            ->get();

        $notifications3 = UsulanBarang::join('users', 'usulan_barangs.id_user', '=', 'users.id_user')
            ->join('ksps', 'users.id_ksp', '=', 'ksps.id_ksp')
            ->join('pejabats', 'users.id_pejabat', '=', 'pejabats.id_pejabat')
            //->where('users.id_pejabat', $id_pejabat)
            ->where('usulan_barangs.tahun_anggaran', $tahunAnggaran)
            ->where('usulan_barangs.status_usulan_barang', 'Selesai')
            ->where('usulan_barangs.status_permintaan_barang', 'Validasi Kabag')
            ->join('sub_kategori_rkbus', 'sub_kategori_rkbus.id_sub_kategori_rkbu', '=', 'usulan_barangs.id_sub_kategori_rkbu')
            ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
            ->leftJoin('usulan_barang_details', 'usulan_barang_details.id_usulan_barang', '=', 'usulan_barangs.id_usulan_barang')
            ->select('usulan_barangs.*', 'usulan_barang_details.id_usulan_barang_detail') // Ambil detail barang juga jika diperlukan
            ->distinct() // Menghapus duplikasi jika ada
            ->get();

        // Tampilkan ke view notifications.index
        return view('notifications.index', compact('notifications', 'notifications2', 'notifications3'));
    }
}
