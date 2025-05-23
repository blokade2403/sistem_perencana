<?php

namespace App\Http\Controllers;

use TCPDF;
use App\Pdf\MYPDF;
use App\Models\Rkbu;
use App\Models\Pejabat;
use App\Models\MasterSpj;
use App\Models\JudulHeader;
use App\Models\JenisBelanja;
use Illuminate\Http\Request;
use App\Models\TahunAnggaran;
use App\Models\SubKategoriRkbu;
use App\Models\StatusValidasiRka;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PdfControllerRealisasiMasterSpj extends Controller
{
    public function downloadPDF(Request $request)
    {
        // Ambil id_user dari session
        $tahunAnggaran          = Session::get('tahun_anggaran');

        $id_tahun_anggaran   = TahunAnggaran::where('nama_tahun_anggaran', $tahunAnggaran)->value('id');
        $id_fase = session('id_fase');
        // Ambil sub kategori rkbu berdasarkan id_user dari session dan id_jenis_kategori_rkbu
        $sub_kategori_rkbus = SubKategoriRkbu::whereHas('rkbus', function ($query) {
            $query->whereHas('subKategoriRkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu', function ($query) {
                $query->where('rkbus.id_status_validasi_rka', '9cfb1f87-238b-4ea2-98f0-4255e578b1d1');
            });
        })->get();

        $status_validasi_rka = StatusValidasiRka::all(); // Ambil status validasi dari model terkait

        $tanggal_perencanaans = DB::table('tanggal_perencanaans')
            ->join('tahun_anggarans', 'tanggal_perencanaans.id_tahun_anggaran', '=', 'tahun_anggarans.id')
            ->where('tanggal_perencanaans.id_tahun_anggaran', $id_tahun_anggaran)
            ->where('tanggal_perencanaans.id_fase', $id_fase)
            ->select('tanggal_perencanaans.tanggal')
            ->get()
            ->map(function ($item) {
                return \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y');
            })
            ->toArray();


        // Query dengan relasi dan filter yang dibutuhkan
        $query = Rkbu::with([
            'rekening_belanjas.aktivitas.sub_kegiatan.sumber_dana',
            'rekening_belanjas.aktivitas.sub_kegiatan.kegiatan.program',
            'subKategoriRkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu',
        ])
            ->where('nama_tahun_anggaran', session('tahun_anggaran'))
            ->whereHas('subKategoriRkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu', function ($query) {
                // Filter berdasarkan id_jenis_kategori_rkbu
                $query->where('rkbus.id_status_validasi_rka', '9cfb1f87-238b-4ea2-98f0-4255e578b1d1');
            });

        $query_dev = Rkbu::join('users', 'rkbus.id_user', '=', 'users.id_user')
            ->join('ksps', 'users.id_ksp', '=', 'ksps.id_ksp')
            ->join('pejabats', 'users.id_pejabat', '=', 'pejabats.id_pejabat')
            ->join('jabatans', 'pejabats.id_jabatan', '=', 'jabatans.id_jabatan')
            ->join('sub_kategori_rkbus', 'rkbus.id_sub_kategori_rkbu', '=', 'sub_kategori_rkbus.id_sub_kategori_rkbu')
            ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
            // ->where('pejabats.id_pejabat', $id_pejabat)
            ->join('rekening_belanjas', 'rekening_belanjas.id_kode_rekening_belanja', '=', 'rkbus.id_kode_rekening_belanja')
            ->join('aktivitas', 'aktivitas.id_aktivitas', '=', 'rekening_belanjas.id_aktivitas')
            ->join('sub_kegiatans', 'sub_kegiatans.id_sub_kegiatan', '=', 'aktivitas.id_sub_kegiatan')
            ->join('sumber_danas', 'sumber_danas.id_sumber_dana', '=', 'sub_kegiatans.id_sumber_dana')
            ->whereIn('rkbus.id_kode_rekening_belanja', [
                '9cf603bb-bfd0-4b1e-8a24-7339459d9507',
                '9cf603e2-e748-49f0-949f-6c3c30d42c3e',
                '9cf6040a-2759-4d16-a3cf-3eee5194a2d5',
            ])
            ->where('rkbus.nama_tahun_anggaran', $tahunAnggaran)
            ->where('sumber_danas.id_sumber_dana', '!=', '9cdfcedb-cc19-4b65-b889-4a5e2dc0ebe3')
            ->where('id_status_validasi_rka', '9cfb1f87-238b-4ea2-98f0-4255e578b1d1');


        // Cek apakah ada filter sub_kategori_rkbu yang dipilih
        if ($request->has('sub_kategori_rkbu') && $request->sub_kategori_rkbu != '') {
            $query->where('id_sub_kategori_rkbu', $request->sub_kategori_rkbu);
        }

        // Filter berdasarkan id_status_validasi_rka
        if ($request->has('id_status_validasi_rka') && $request->id_status_validasi_rka != '') {
            $query->where('id_status_validasi_rka', $request->id_status_validasi_rka);
        }

        $rkbus = Rkbu::with([
            'subKategoriRkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu'
        ])
            ->where('nama_tahun_anggaran', $tahunAnggaran)
            ->where('id_status_validasi_rka', '9cfb1f87-238b-4ea2-98f0-4255e578b1d1')
            ->get();


        // Ambil semua id_jenis_kategori_rkbu
        $id_jenis_kategori_rkbu = $rkbus->pluck('subKategoriRkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu.id_jenis_kategori_rkbu')
            ->unique();

        $id_jenis_belanja = $rkbus->pluck('subKategoriRkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu.jenis_belanja.id_jenis_belanja')
            ->unique();


        // Pastikan $rkbus ada dan tidak kosong
        if ($rkbus->isNotEmpty()) {
            // Ambil data program, kegiatan, dan sub kegiatan dengan pengecekan null yang lebih aman
            $firstRkbu = $rkbus->first();

            $namaProgram = optional($firstRkbu->rekening_belanjas->aktivitas->sub_kegiatan->kegiatan->program)->nama_program ?? 'Nama Program Tidak Ada';
            $kodeProgram = optional($firstRkbu->rekening_belanjas->aktivitas->sub_kegiatan->kegiatan->program)->kode_program ?? 'Kode Program Tidak Ada';

            $namaKegiatan = optional($firstRkbu->rekening_belanjas->aktivitas->sub_kegiatan->kegiatan)->nama_kegiatan ?? 'Nama Kegiatan Tidak Ada';
            $kodeKegiatan = optional($firstRkbu->rekening_belanjas->aktivitas->sub_kegiatan->kegiatan)->kode_kegiatan ?? 'Kode Kegiatan Tidak Ada';

            $namaSubKegiatan = optional($firstRkbu->rekening_belanjas->aktivitas->sub_kegiatan)->nama_sub_kegiatan ?? 'Nama Sub Kegiatan Tidak Ada';
            $kodeSubKegiatan = optional($firstRkbu->rekening_belanjas->aktivitas->sub_kegiatan)->kode_sub_kegiatan ?? 'Kode Sub Kegiatan Tidak Ada';
        } else {
            // Jika tidak ada data di $rkbus, berikan nilai default
            $namaProgram = 'Nama Program Tidak Ada';
            $kodeProgram = 'Kode Program Tidak Ada';
            $namaKegiatan = 'Nama Kegiatan Tidak Ada';
            $kodeKegiatan = 'Kode Kegiatan Tidak Ada';
            $namaSubKegiatan = 'Nama Sub Kegiatan Tidak Ada';
            $kodeSubKegiatan = 'Kode Sub Kegiatan Tidak Ada';
        }

        $tahunAnggaran = Session::get('tahun_anggaran');
        // Ambil id_jenis_kategori_rkbu dari data yang didapatkan

        // Pastikan bahwa $id_jenis_kategori_rkbu tidak kosong
        if (!$id_jenis_kategori_rkbu) {
            return redirect()->back()->with('error', 'Data id_jenis_kategori_rkbu tidak ditemukan.');
        }

        // Cek apakah ada filter sub_kategori_rkbu yang dipilih
        if ($request->has('sub_kategori_rkbu') && $request->sub_kategori_rkbu != '') {
            $query->where('id_sub_kategori_rkbu', $request->sub_kategori_rkbu);
        }

        // Filter berdasarkan id_status_validasi_rka
        if ($request->has('id_status_validasi_rka') && $request->id_status_validasi_rka != '') {
            $query->where('id_status_validasi_rka', $request->id_status_validasi_rka);
        }

        $total_anggaran_per_jenis_kategori = DB::table('rkbus')
            ->join('sub_kategori_rkbus', 'rkbus.id_sub_kategori_rkbu', '=', 'sub_kategori_rkbus.id_sub_kategori_rkbu')
            ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('obyek_belanjas', 'kategori_rkbus.id_obyek_belanja', '=', 'obyek_belanjas.id_obyek_belanja')
            ->join('jenis_kategori_rkbus', 'obyek_belanjas.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
            ->where('rkbus.nama_tahun_anggaran', $tahunAnggaran)
            ->where('rkbus.id_status_validasi_rka', '9cfb1f87-238b-4ea2-98f0-4255e578b1d1') // Validasi status RKA
            ->select('jenis_kategori_rkbus.id_jenis_kategori_rkbu', DB::raw('SUM(rkbus.total_anggaran) as total_anggaran'))
            ->groupBy('jenis_kategori_rkbus.id_jenis_kategori_rkbu')
            ->get();

        $total_anggaran_per_jenis_belanja = DB::table('rkbus')
            ->join('sub_kategori_rkbus', 'rkbus.id_sub_kategori_rkbu', '=', 'sub_kategori_rkbus.id_sub_kategori_rkbu')
            ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('obyek_belanjas', 'kategori_rkbus.id_obyek_belanja', '=', 'obyek_belanjas.id_obyek_belanja')
            ->join('jenis_kategori_rkbus', 'obyek_belanjas.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
            ->join('jenis_belanjas', 'jenis_kategori_rkbus.id_jenis_belanja', '=', 'jenis_belanjas.id_jenis_belanja')
            ->where('rkbus.nama_tahun_anggaran', $tahunAnggaran)
            ->where('rkbus.id_status_validasi_rka', '9cfb1f87-238b-4ea2-98f0-4255e578b1d1') // Validasi status RKA
            ->select('jenis_belanjas.id_jenis_belanja', DB::raw('SUM(rkbus.total_anggaran) as total_anggaran'))
            ->groupBy('jenis_belanjas.id_jenis_belanja')
            ->get();

        $total_anggaran_blud = DB::table('rkbus')
            ->where('nama_tahun_anggaran', $tahunAnggaran)
            ->where('id_status_validasi_rka', '9cfb1f87-238b-4ea2-98f0-4255e578b1d1') // Validasi status RKA
            ->whereIn('id_kode_rekening_belanja', [
                '9cf603bb-bfd0-4b1e-8a24-7339459d9507',
                '9cf603e2-e748-49f0-949f-6c3c30d42c3e',
                '9cf6040a-2759-4d16-a3cf-3eee5194a2d5',
            ])
            ->sum('total_anggaran');

        // Tampilkan hasil untuk masing-masing id_jenis_kategori_rkbu
        // dd($total_anggaran_per_jenis_belanja);


        // Ambil hierarki berdasarkan rkbus yang tersedia
        $categories1 = JenisBelanja::whereHas('jenis_kategori_rkbus.obyek_belanjas.kategori_rkbus.sub_kategori_rkbus.rkbus', function ($query) use ($tahunAnggaran) {
            // Filter di level rkbus
            $query->where('rkbus.nama_tahun_anggaran', $tahunAnggaran);
        })
            ->with([
                'jenis_kategori_rkbus' => function ($query) use ($tahunAnggaran) {
                    // Filter pada jenis_kategori_rkbus berdasarkan rkbus
                    $query->whereHas('obyek_belanjas.kategori_rkbus.sub_kategori_rkbus.rkbus', function ($query) use ($tahunAnggaran) {
                        $query->where('nama_tahun_anggaran', $tahunAnggaran);
                    });
                },
                'jenis_kategori_rkbus.obyek_belanjas' => function ($query) use ($tahunAnggaran) {
                    // Filter pada obyek_belanjas berdasarkan rkbus
                    $query->whereHas('kategori_rkbus.sub_kategori_rkbus.rkbus', function ($query) use ($tahunAnggaran) {
                        $query->where('nama_tahun_anggaran', $tahunAnggaran);
                    });
                },
                'jenis_kategori_rkbus.obyek_belanjas.kategori_rkbus' => function ($query) use ($tahunAnggaran) {
                    // Filter pada kategori_rkbus berdasarkan rkbus
                    $query->whereHas('sub_kategori_rkbus.rkbus', function ($query) use ($tahunAnggaran) {
                        $query->where('nama_tahun_anggaran', $tahunAnggaran);
                    });
                },
                'jenis_kategori_rkbus.obyek_belanjas.kategori_rkbus.sub_kategori_rkbus' => function ($query) use ($tahunAnggaran) {
                    // Filter pada sub_kategori_rkbus berdasarkan rkbus
                    $query->whereHas('rkbus', function ($query) use ($tahunAnggaran) {
                        $query->where('nama_tahun_anggaran', $tahunAnggaran);
                    });
                },
                'jenis_kategori_rkbus.obyek_belanjas.kategori_rkbus.sub_kategori_rkbus.rkbus' => function ($query) use ($tahunAnggaran) {
                    // Filter di level rkbus
                    $query->where('rkbus.nama_tahun_anggaran', $tahunAnggaran)
                        ->where('id_status_validasi_rka', '9cfb1f87-238b-4ea2-98f0-4255e578b1d1')
                        ->whereIn('rkbus.id_kode_rekening_belanja', [
                            '9cf603bb-bfd0-4b1e-8a24-7339459d9507',
                            '9cf603e2-e748-49f0-949f-6c3c30d42c3e',
                            '9cf6040a-2759-4d16-a3cf-3eee5194a2d5',
                        ]);
                }
            ])
            ->get();

        //   // Hitung total anggaran berdasarkan kategori
        foreach ($categories1 as $jenisBelanja) {
            $total_anggaran_jenis = 0;

            foreach ($jenisBelanja->jenis_kategori_rkbus as $jenisKategori) {
                $total_anggaran_kategori = 0;

                foreach ($jenisKategori->obyek_belanjas as $obyekBelanja) {
                    foreach ($obyekBelanja->kategori_rkbus as $kategoriRkbu) {
                        $total_anggaran_kategori_rkbu = 0;

                        foreach ($kategoriRkbu->sub_kategori_rkbus as $subKategoriRkbu) {
                            // Perhitungan total anggaran untuk sub_kategori_rkbu
                            $total_anggaran_sub_kategori = $subKategoriRkbu->rkbus->sum('total_anggaran');

                            // Simpan total anggaran ke dalam properti subKategoriRkbu
                            $subKategoriRkbu->total_anggaran = $total_anggaran_sub_kategori;

                            // Tambahkan total anggaran sub_kategori_rkbu ke total anggaran kategori_rkbu
                            $total_anggaran_kategori_rkbu += $total_anggaran_sub_kategori;
                        }

                        // Simpan total anggaran kategori_rkbu
                        $kategoriRkbu->total_anggaran = $total_anggaran_kategori_rkbu;

                        // Tambahkan total anggaran kategori_rkbu ke total anggaran kategori
                        $total_anggaran_kategori += $total_anggaran_kategori_rkbu;
                    }
                }

                // Simpan total anggaran kategori
                $jenisKategori->total_anggaran = $total_anggaran_kategori;

                // Tambahkan total anggaran kategori ke total anggaran jenis belanja
                $total_anggaran_jenis += $total_anggaran_kategori;
            }

            // Simpan total anggaran jenis belanja
            $jenisBelanja->total_anggaran = $total_anggaran_jenis;
        }

        // Ambil sub kategori rkbu berdasarkan id_user dari session dan id_jenis_kategori_rkbu
        $sub_kategori_rkbus = SubKategoriRkbu::join('rkbus', 'rkbus.id_sub_kategori_rkbu', '=', 'sub_kategori_rkbus.id_sub_kategori_rkbu')
            ->join('usulan_barangs', 'usulan_barangs.id_sub_kategori_rkbu', '=', 'sub_kategori_rkbus.id_sub_kategori_rkbu')
            ->join('spj_details', 'spj_details.id_usulan_barang', '=', 'usulan_barangs.id_usulan_barang')
            ->join('spjs', 'spj_details.id_spj', '=', 'spjs.id_spj')
            ->join('master_spjs', 'master_spjs.id_spj', '=', 'spjs.id_spj')
            ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
            ->join('users', 'rkbus.id_user', '=', 'users.id_user')
            ->where('rkbus.nama_tahun_anggaran', $tahunAnggaran)
            ->select('sub_kategori_rkbus.*', 'master_spjs.id_master_spj') // Tambahkan id_master_spj ke hasil select
            ->distinct() // Hilangkan duplikasi
            ->get();


        // Query dengan relasi dan filter yang dibutuhkan
        $invo = MasterSpj::join('spjs', 'spjs.id_spj', '=', 'master_spjs.id_spj')
            ->leftJoin('perusahaans', 'perusahaans.id_perusahaan', '=', 'master_spjs.id_perusahaan')
            ->join('spj_details', 'spj_details.id_spj', '=', 'spjs.id_spj')
            ->join('usulan_barangs', 'usulan_barangs.id_usulan_barang', '=', 'spjs.id_usulan_barang')
            ->join('sub_kategori_rkbus', 'sub_kategori_rkbus.id_sub_kategori_rkbu', '=', 'usulan_barangs.id_sub_kategori_rkbu')
            ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('users', 'users.id_user', '=', 'usulan_barangs.id_user')
            ->join('units', 'users.id_unit', '=', 'units.id_unit')
            ->where('master_spjs.tahun_anggaran', $tahunAnggaran)
            ->distinct()
            ->select('master_spjs.*', 'usulan_barangs.*', 'sub_kategori_rkbus.*')
            ->get();

        $sum_total_spj = MasterSpj::join('spjs', 'spjs.id_spj', '=', 'master_spjs.id_spj')
            ->leftJoin('perusahaans', 'perusahaans.id_perusahaan', '=', 'master_spjs.id_perusahaan')
            ->join('spj_details', 'spj_details.id_spj', '=', 'spjs.id_spj')
            ->join('usulan_barangs', 'usulan_barangs.id_usulan_barang', '=', 'spjs.id_usulan_barang')
            ->join('sub_kategori_rkbus', 'sub_kategori_rkbus.id_sub_kategori_rkbu', '=', 'usulan_barangs.id_sub_kategori_rkbu')
            ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('users', 'users.id_user', '=', 'usulan_barangs.id_user')
            ->join('units', 'users.id_unit', '=', 'units.id_unit')
            ->where('master_spjs.tahun_anggaran', $tahunAnggaran)
            ->where('master_spjs.status_proses_pesanan', 'Selesai')
            ->distinct()
            ->select('master_spjs.*', 'usulan_barangs.*', 'sub_kategori_rkbus.*')
            ->sum('master_spjs.bruto');

        $sum_total_spj_dibayar = MasterSpj::join('spjs', 'spjs.id_spj', '=', 'master_spjs.id_spj')
            ->leftJoin('perusahaans', 'perusahaans.id_perusahaan', '=', 'master_spjs.id_perusahaan')
            ->join('spj_details', 'spj_details.id_spj', '=', 'spjs.id_spj')
            ->join('usulan_barangs', 'usulan_barangs.id_usulan_barang', '=', 'spjs.id_usulan_barang')
            ->join('sub_kategori_rkbus', 'sub_kategori_rkbus.id_sub_kategori_rkbu', '=', 'usulan_barangs.id_sub_kategori_rkbu')
            ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('users', 'users.id_user', '=', 'usulan_barangs.id_user')
            ->join('units', 'users.id_unit', '=', 'units.id_unit')
            ->where('master_spjs.tahun_anggaran', $tahunAnggaran)
            ->where('master_spjs.status_proses_pesanan', 'Selesai')
            ->distinct()
            ->select('master_spjs.*', 'usulan_barangs.*', 'sub_kategori_rkbus.*')
            ->sum('master_spjs.pembayaran');

        // Ambil total anggaran berdasarkan id_user dari session

        $query = Rkbu::join('users', 'rkbus.id_user', '=', 'users.id_user')
            ->join('ksps', 'users.id_ksp', '=', 'ksps.id_ksp')
            ->join('pejabats', 'users.id_pejabat', '=', 'pejabats.id_pejabat')
            ->join('jabatans', 'pejabats.id_jabatan', '=', 'jabatans.id_jabatan')
            ->join('sub_kategori_rkbus', 'rkbus.id_sub_kategori_rkbu', '=', 'sub_kategori_rkbus.id_sub_kategori_rkbu')
            ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
            ->where('rkbus.nama_tahun_anggaran', $tahunAnggaran)
            ->join('rekening_belanjas', 'rekening_belanjas.id_kode_rekening_belanja', '=', 'rkbus.id_kode_rekening_belanja')
            ->join('aktivitas', 'aktivitas.id_aktivitas', '=', 'rekening_belanjas.id_aktivitas')
            ->join('sub_kegiatans', 'sub_kegiatans.id_sub_kegiatan', '=', 'aktivitas.id_sub_kegiatan')
            ->join('sumber_danas', 'sumber_danas.id_sumber_dana', '=', 'sub_kegiatans.id_sumber_dana')
            // ->where('sumber_danas.id_sumber_dana', '!=', '9cdfcedb-cc19-4b65-b889-4a5e2dc0ebe3')
            ->where('jenis_kategori_rkbus.id_jenis_kategori_rkbu', '9cf70e31-9b9e-4dea-8b39-5459f23f3f51');

        // Dapatkan data rkbu
        $rkbus = $query->with([
            'rekening_belanjas.aktivitas.sub_kegiatan.kegiatan.program'
        ])->get();

        // Pastikan $rkbus ada dan tidak kosong
        if ($rkbus->isNotEmpty()) {
            // Ambil data program, kegiatan, dan sub kegiatan dengan pengecekan null yang lebih aman
            $firstRkbu = $rkbus->first();

            $namaProgram = optional($firstRkbu->rekening_belanjas->aktivitas->sub_kegiatan->kegiatan->program)->nama_program ?? 'Nama Program Tidak Ada';
            $kodeProgram = optional($firstRkbu->rekening_belanjas->aktivitas->sub_kegiatan->kegiatan->program)->kode_program ?? 'Kode Program Tidak Ada';

            $namaKegiatan = optional($firstRkbu->rekening_belanjas->aktivitas->sub_kegiatan->kegiatan)->nama_kegiatan ?? 'Nama Kegiatan Tidak Ada';
            $kodeKegiatan = optional($firstRkbu->rekening_belanjas->aktivitas->sub_kegiatan->kegiatan)->kode_kegiatan ?? 'Kode Kegiatan Tidak Ada';

            $namaSubKegiatan = optional($firstRkbu->rekening_belanjas->aktivitas->sub_kegiatan)->nama_sub_kegiatan ?? 'Nama Sub Kegiatan Tidak Ada';
            $kodeSubKegiatan = optional($firstRkbu->rekening_belanjas->aktivitas->sub_kegiatan)->kode_sub_kegiatan ?? 'Kode Sub Kegiatan Tidak Ada';
        } else {
            // Jika tidak ada data di $rkbus, berikan nilai default
            $namaProgram = 'Nama Program Tidak Ada';
            $kodeProgram = 'Kode Program Tidak Ada';
            $namaKegiatan = 'Nama Kegiatan Tidak Ada';
            $kodeKegiatan = 'Kode Kegiatan Tidak Ada';
            $namaSubKegiatan = 'Nama Sub Kegiatan Tidak Ada';
            $kodeSubKegiatan = 'Kode Sub Kegiatan Tidak Ada';
        }


        $categories = DB::table('sub_kategori_rkbus')
            // ->join('rkbus', 'sub_kategori_rkbus.id_sub_kategori_rkbu', '=', 'rkbus.id_sub_kategori_rkbu')
            ->join('usulan_barangs', 'sub_kategori_rkbus.id_sub_kategori_rkbu', '=', 'usulan_barangs.id_sub_kategori_rkbu')
            ->join('usulan_barang_details', 'usulan_barang_details.id_usulan_barang', '=', 'usulan_barangs.id_usulan_barang')
            ->join('rkbus', 'usulan_barang_details.id_rkbu', '=', 'rkbus.id_rkbu') // Pastikan join dengan tabel rkbus
            ->join('spjs', 'spjs.id_usulan_barang', '=', 'usulan_barangs.id_usulan_barang')
            ->join('spj_details', 'spjs.id_spj', '=', 'spj_details.id_spj')
            ->join('master_spjs', 'master_spjs.id_spj', '=', 'spjs.id_spj')
            ->Join('perusahaans', 'perusahaans.id_perusahaan', '=', 'master_spjs.id_perusahaan')
            ->join('users', 'rkbus.id_user', '=', 'users.id_user')
            ->join('units', 'users.id_unit', '=', 'units.id_unit')
            ->where('master_spjs.status_proses_pesanan', 'Selesai')
            ->where('master_spjs.tahun_anggaran', $tahunAnggaran)
            ->select(
                'usulan_barangs.id_sub_kategori_rkbu',
                'sub_kategori_rkbus.kode_sub_kategori_rkbu',
                'sub_kategori_rkbus.nama_sub_kategori_rkbu',

                'spjs.no_usulan_barang',
                'spjs.status_spj',
                'master_spjs.id_perusahaan',
                'perusahaans.nama_perusahaan', // Tambahkan ini
                'master_spjs.idpaket',
                'master_spjs.pembayaran',
                'master_spjs.sisa_pembayaran',
                'master_spjs.rincian_belanja',
                'master_spjs.status_pembayaran',
                'master_spjs.status_hutang',
                'usulan_barangs.nama_pengusul_barang',

                'usulan_barang_details.id_rkbu',
                'rkbus.nama_barang as rkbu_nama_barang',
                'rkbus.sisa_vol_rkbu as sisa_vol_rkbu',
                'rkbus.sisa_anggaran_rkbu as sisa_anggaran_rkbu',
                'usulan_barang_details.jumlah_usulan_barang',
                'usulan_barang_details.vol_1_detail',
                'usulan_barang_details.satuan_1_detail',
                'usulan_barang_details.vol_2_detail',
                'usulan_barang_details.satuan_2_detail',
                'usulan_barang_details.harga_barang',
                'usulan_barang_details.total_ppn',
                'usulan_barang_details.total_anggaran_usulan_barang',
            )
            ->distinct() // Ini memastikan hasil tidak duplikat
            ->get();

        $hierarchy = $categories->groupBy('id_sub_kategori_rkbu')->map(function ($items, $subKategoriId) {
            $namaSubKategori = $items->first()->nama_sub_kategori_rkbu;
            return [
                'id_sub_kategori_rkbu' => $namaSubKategori,
                'details' => $items->groupBy('no_usulan_barang')->map(function ($subItems, $noUsulanBarang) {
                    return [
                        'no_usulan_barang'        => $noUsulanBarang,
                        'status_spj'              => $subItems->first()->status_spj,
                        'status_pembayaran'       => $subItems->first()->status_pembayaran,
                        'status_hutang'           => $subItems->first()->status_hutang,
                        'id_perusahaan'           => $subItems->first()->nama_perusahaan,
                        'idpaket'                 => $subItems->first()->idpaket,
                        'pembayaran'              => $subItems->first()->pembayaran,
                        'sisa_pembayaran'         => $subItems->first()->sisa_pembayaran,
                        'rincian_belanja'         => $subItems->first()->rincian_belanja,
                        'nama_pengusul_barang'    => $subItems->first()->nama_pengusul_barang,
                        'items' => $subItems->map(function ($item) {
                            return [
                                'id_rkbu'                       => $item->rkbu_nama_barang,
                                'jumlah_usulan_barang'          => $item->jumlah_usulan_barang,
                                'total_ppn'                     => $item->total_ppn,
                                'total_anggaran_usulan_barang'  => $item->total_anggaran_usulan_barang,
                                'vol_1_detail'                  => $item->vol_1_detail,
                                'satuan_1_detail'               => $item->satuan_1_detail,
                                'vol_2_detail'                  => $item->vol_2_detail,
                                'satuan_2_detail'               => $item->satuan_2_detail,
                                'harga_barang'                  => $item->harga_barang,
                                'sisa_vol_rkbu'                 => $item->sisa_vol_rkbu,
                                'sisa_anggaran_rkbu'            => $item->sisa_anggaran_rkbu,
                            ];
                        })->toArray()
                    ];
                })->values()->toArray()
            ];
        })->values()->toArray();

        // return response()->json($hierarchy);


        $first_pejabat  = $query->select('pejabats.*', 'jabatans.nama_jabatan')->first();

        $first_direktur = Pejabat::join('jabatans', 'jabatans.id_jabatan', '=', 'pejabats.id_jabatan')
            ->where('jabatans.nama_jabatan', 'Direktur')
            ->select('jabatans.*', 'pejabats.nama_pejabat', 'pejabats.nip_pejabat') // Pilih kolom yang ingin diambil
            ->first();

        $first_kabag = Pejabat::join('jabatans', 'jabatans.id_jabatan', '=', 'pejabats.id_jabatan')
            ->where('jabatans.id_jabatan', '9cdfc135-d1dc-452f-8953-570df9133468')
            ->select('jabatans.*', 'pejabats.nama_pejabat', 'pejabats.nip_pejabat') // Pilih kolom yang ingin diambil
            ->first();

        // Inisialisasi variabel dengan nilai default
        $jabatan_kabag      = '...............';
        $nama_pejabat       = '...............';
        $nip_pejabat_kabag  = '...............';
        $nama_direktur      = '...............';
        $nip_direktur       = '...............';
        $nama_kabag      = '...............';
        $nip_kabag       = '...............';

        // dd($first_pejabat->nip_pejabat);

        if ($first_pejabat) {
            // Ambil nama valid perencana, kabag, dan direktur
            $nama_pejabat       = $first_pejabat->nama_pejabat ?? '...............';
            $nip_pejabat_kabag  = $first_pejabat->nip_pejabat ?? '...............';
            $jabatan_kabag      = $first_pejabat->nama_jabatan ?? '...............';
        }

        if ($first_direktur) {
            // Ambil nama valid perencana, kabag, dan direktur
            $nama_direktur      = $first_direktur->nama_pejabat ?? '...............';
            $nip_direktur       = $first_direktur->nip_pejabat ?? '...............';
        }

        if ($first_kabag) {
            // Ambil nama valid perencana, kabag, dan direktur
            $nama_kabag      = $first_kabag->nama_pejabat ?? '...............';
            $nip_kabag       = $first_kabag->nip_pejabat ?? '...............';
        }

        // Inisialisasi TCPDF
        $pdf = new MYPDF();

        // Set informasi dokumen
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nama Penulis');
        $pdf->SetTitle('Laporan RKBU');
        $pdf->SetSubject('Laporan RKBU');
        $pdf->SetKeywords('TCPDF, PDF, RKBU, example');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->SetFont('helvetica', '', 5); // Set font utama

        // Set resolusi halaman - menggunakan ukuran kertas F4 dalam orientasi landscape
        // $ukuranF4 = array(330, 210); // mm (lebar 330 mm, tinggi 210 mm)
        // $pdf->SetPageFormat($ukuranF4, 'L');

        $pdf->SetCompression(true);
        // Mengatur margin halaman dan auto page break
        $pdf->SetMargins(15, 10, 15);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(10);
        $pdf->SetAutoPageBreak(true, 25); // Auto page break dengan margin bawah
        $pdf->setCellPaddings(1, 1, 1, 1); // Padding cell

        // Cek data judul headers dari database
        $judulHeaders = JudulHeader::first();

        // Cek dan atur gambar, gunakan gambar default jika tidak tersedia
        $gambar1 = $judulHeaders->gambar1 ? asset('storage/uploads/' . basename($judulHeaders->gambar1)) : asset('storage/uploads/foto.png');
        $gambar2 = $judulHeaders->gambar2 ? asset('storage/uploads/' . basename($judulHeaders->gambar2)) : asset('storage/uploads/foto.png');

        $nama_rumah_sakit = $judulHeaders->nama_rs;
        // Tambahkan halaman pertama (tidak perlu mendefinisikan orientasi lagi karena sudah diatur)
        $pdf->AddPage('L', array(330, 210));


        // Buat konten HTML untuk tabel header
        $html = '
                <table border="0">
                    <tr>
                        <td width="20%" align="left">
                            <img src="' . $gambar2 . '" width="45" height="45" />
                        </td>
                        <td width="60%" align="center">
                            <h3 style="font-size:8px; font-weight: normal;">' . $judulHeaders->header1 . '</h3>
                            <h3 style="font-weight: normal; font-size:8px; line-height:0;">' . $judulHeaders->nama_rs . '</h3>
                            <h3 style="font-size:8px; font-weight: normal;">RINGKASAN REALISASI RBA</h3>
                            <h3 style="font-weight: normal; font-size:8px; line-height:0;">TAHUN ANGGARAN ' . $tahunAnggaran . '</h3>
                        </td>
                        <td width="20%" align="right">
                            <img src="' . $gambar1 . '" width="75" height="45" />
                        </td>
                    </tr>
                </table>';

        // Tambahkan header ke PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        //Cek dan tambahkan halaman baru jika diperlukan sebelum menulis konten tabel
        $requiredSpace = 50; // Tentukan tinggi yang diperlukan untuk elemen (misalnya tabel)
        $this->checkPageBreak($pdf, $requiredSpace);

        //Tambahkan konten body dari view 'print_rkbu_modal_kantor'
        $htmlBodyContent = view('backend.ringkasan.kertas_kerja.print_master_spj', compact(
            'jabatan_kabag',
            'nama_rumah_sakit',
            'total_anggaran_blud',
            'status_validasi_rka',
            'categories1',
            'total_anggaran_jenis',
            'total_anggaran_kategori',
            'total_anggaran_kategori_rkbu',
            'nama_pejabat',
            'nip_pejabat_kabag',
            'nip_direktur',
            'nama_direktur',
            'pdf',
            'sub_kategori_rkbus',
            'hierarchy',
            'namaProgram',
            'namaKegiatan',
            'namaSubKegiatan',
            'kodeProgram',
            'kodeKegiatan',
            'kodeSubKegiatan'
        ))->render();

        // Sisipkan style global untuk memaksa font-size 5px menggunakan !important
        $htmlBody = '
            <style>
                * {
                    font-size: 5px !important;
                }
            </style>
            ' . $htmlBodyContent;

        // Tuliskan konten body ke PDF
        $pdf->writeHTML($htmlBody, true, false, true, false, '');

        checkPageBreak($pdf, 30); // 50 untuk memastikan ruang yang cukup untuk tanda tangan
        $htmlSignatureTable = '
            <table rules="none">
                <tr class="table-rows-he">
                    <th scope="row" width="20%" align="center"></th>
                    <th width="55%" align="center"></th>
                    <th width="20%" align="center"></th> 
                </tr>   
                <tr class="table-rows" bgcolor="#ffffff">
                    <th scope="row" width="20%" align="center"></th>
                    <th width="45%" align="center"></th>
                    <th width="30%" align="center">Jakarta, </th>  
                </tr>
                <tr class="table-rows" bgcolor="#ffffff">
                    <th scope="row" width="20%" align="center">Kepala Program</th>
                    <th width="45%" align="center"></th>
                    <th width="30%" align="center">Direktur ' . ucwords(strtolower($nama_rumah_sakit)) . '</th> 
                </tr>
                <p></p>
                <tr class="table-rows" bgcolor="#ffffff">
                    <th scope="row" width="20%" align="center">' . $nama_kabag . '</th>
                    <th width="45%" align="center"></th>
                    <th width="30%" align="center">' . $nama_direktur . '</th> 
                </tr>
                <tr class="table-rows" bgcolor="#ffffff">
                    <th scope="row" width="20%" align="center">' . $nip_kabag . '</th>
                    <th width="45%" align="center"></th>
                    <th width="30%" align="center">' . $nip_direktur . '</th> 
                </tr>
            </table>';

        $pdf->writeHTML($htmlSignatureTable, true, false, true, false, '');

        // $filePath = storage_path('app/public/rkbu_data_preview.pdf');
        // $pdf->Output($filePath, 'F'); // Simpan file ke lokasi yang ditentukan

        // // Berikan respons download
        // return response()->download($filePath)->deleteFileAfterSend(true); // Hapus setelah diunduh

        // Tampilkan PDF sebagai preview di browser
        $pdf->Output('rkbu_data_preview.pdf', 'I');

        // Fungsi untuk memeriksa pemecahan halaman sebelum menambah konten baru

    }

    function CheckPageBreak($pdf, $height)
    {
        // Get the current position
        $currentY = $pdf->GetY();

        // Get the height of the page
        $pageHeight = $pdf->getPageHeight();

        // Check if the current Y position + the height of the next row will exceed the page height minus bottom margin
        if ($currentY + $height > $pageHeight - $pdf->getBreakMargin()) {
            // Add a new page if space is insufficient
            $pdf->AddPage();
        }
    }
}
