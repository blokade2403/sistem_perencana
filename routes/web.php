<?php

use App\Models\Jabatan;
use App\Models\Perusahaan;
use App\Models\ObyekBelanja;
use App\Models\TahunAnggaran;
use App\Models\StatusValidasi;
use App\Models\RekeningBelanja;
use App\Models\RkbuModalKantor;
use App\Models\StatusValidasiRka;
use App\Exports\UsulanDetailExport;
use App\Models\SubKategoriRekening;
use Maatwebsite\Excel\Facades\Excel;
use App\DataTables\KomponenDataTable;
use App\DataTables\KomponensDataTable;
use App\Imports\RkbuPersediaanImport;
use Illuminate\Support\Facades\Route;
use App\Exports\SubKategoriRkbuExport;
use App\Http\Controllers\KspController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FaseController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PptkController;
use App\Http\Controllers\RkbuController;
use App\Http\Controllers\RkbuEksportKsp;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KertasKerjaApbd;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RkbuEksportUser;
use App\Http\Controllers\MasterSpjEksport;
use App\Http\Controllers\RkbuEksportAdmin;
use App\Http\Controllers\RkbuEksportKabag;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PejabatController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KomponenController;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\LevelUserController;
use App\Http\Controllers\UraianDuaController;
use App\Http\Controllers\FungsionalController;
use App\Http\Controllers\SumberDanaController;
use App\Http\Controllers\UraianSatuController;
use App\Http\Controllers\GambarLoginController;
use App\Http\Controllers\JudulHeaderController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\PpkKeuanganController;
use App\Http\Controllers\RkbuHistoryController;
use App\Http\Controllers\SubKegiatanController;
use App\Http\Controllers\JenisBelanjaController;
use App\Http\Controllers\KategoriRkbuController;
use App\Http\Controllers\ObyekBelanjaController;
use App\Http\Controllers\PdfControllerMasterSpj;
use App\Http\Controllers\UsulanBarangController;
use App\Http\Controllers\PdfControllerModalAlkes;
use App\Http\Controllers\PdfControllerRkbuBarjas;
use App\Http\Controllers\TahunAnggaranController;
use App\Http\Controllers\AdminPendukungController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetImport;
use App\Http\Controllers\ExportUsulanBarangDetail;
use App\Http\Controllers\KertasKerjaRbaController;
use App\Http\Controllers\KomponenImportController;
use App\Http\Controllers\RkbuBarangJasaController;
use App\Http\Controllers\RkbuModalAlkesController;
use App\Http\Controllers\RkbuPegawaiPnsController;
use App\Http\Controllers\RkbuPersediaanController;
use App\Http\Controllers\StatusValidasiController;
use App\Http\Controllers\UsulanBarangDetailImport;
use App\Http\Controllers\CekUsulanBarangController;
use App\Http\Controllers\PdfControllerRealisasiRba;
use App\Http\Controllers\RekeningBelanjaController;
use App\Http\Controllers\RkbuModalKantorController;
use App\Http\Controllers\SubKategoriRkbuController;
use App\Http\Controllers\KategoriRekeningController;
use App\Http\Controllers\PejabatPengadaanController;
use App\Http\Controllers\PerusahaanImportController;
use App\Http\Controllers\RkbuHistoryModalController;
use App\Http\Controllers\Erba\PdfControllerErbaAdmin;
use App\Http\Controllers\JenisKategoriRkbuController;
use App\Http\Controllers\PdfControllerCekUsulanModal;
use App\Http\Controllers\PdfControllerRkbuPegawaiPns;
use App\Http\Controllers\PdfControllerRkbuPersediaan;
use App\Http\Controllers\RkbuPegawaiNonPnsController;
use App\Http\Controllers\StatusValidasiRkaController;
use App\Http\Controllers\UsulanBarangModalController;
use App\Http\Controllers\KategoriRkbuImportController;
use App\Http\Controllers\PdfControllerKertasKerjaApbd;
use App\Http\Controllers\PdfControllerKertasKerjaBlud;
use App\Http\Controllers\PdfControllerRkbuModalKantor;
use App\Http\Controllers\RekapUsulanBelanjaController;
use App\Http\Controllers\TanggalPerencanaanController;
use App\Http\Controllers\PdfControllerValidasiModalKsp;
use App\Http\Controllers\Pengadaan\MasterSpjController;
use App\Http\Controllers\SubKategoriRekeningController;
use App\Http\Controllers\Validasi\ValidasiRkbuModalKsp;
use App\Http\Controllers\CekUsulanBarangModalController;
use App\Http\Controllers\PdfControllerRkbuPegawaiNonPns;
use App\Http\Controllers\PdfControllerValidasiBarjasKsp;
use App\Http\Controllers\Pengadaan\PerusahaanController;
use App\Http\Controllers\RkbuPersediaanImportController;
use App\Http\Controllers\Validasi\ValidasiRkbuBarjasKsp;
use App\Http\Controllers\ValidasiBelanjaModalController;
use App\Http\Controllers\PdfControllerRealisasiMasterSpj;
use App\Http\Controllers\PdfControllerUsulanBelanjaPrint;
use App\Http\Controllers\PdfControllerValidasiModalKabag;
use App\Http\Controllers\RkbuHistoryPersediaanController;
use App\Http\Controllers\SubKategoriRkbuImportController;
use App\Http\Controllers\ValidasiRkbuBarjasKspController;
use App\Http\Controllers\Erba\PdfControllerErbaModalAdmin;
use App\Http\Controllers\PdfControllerCekUsulanPersediaan;
use App\Http\Controllers\PdfControllerValidasiBarjasKabag;
use App\Http\Controllers\Pengadaan\PdfControllerSPJBastBP;
use App\Http\Controllers\Pengadaan\PdfControllerSPJBastHP;
use App\Http\Controllers\Pengadaan\PdfControllerSpjBastPK;
use App\Http\Controllers\UsulanBarangPersediaanController;
use App\Http\Controllers\KertasKerjaRealisasiRbaController;
use App\Http\Controllers\NotifikasiUsulanBelanjaController;
use App\Http\Controllers\Validasi_Rka\ValidasiRkbuModalRka;
use App\Http\Controllers\Erba\PdfControllerErbaPegawaiAdmin;
use App\Http\Controllers\PdfControllerCekUsulanBarangBarjas;
use App\Http\Controllers\PdfControllerValidasiPegawaiPnsKsp;
use App\Http\Controllers\PdfControllerValidasiPersediaanKsp;
use App\Http\Controllers\Pengadaan\UsulanSpjModalController;
use App\Http\Controllers\Validasi\ValidasiRkbuPegawaiPnsKsp;
use App\Http\Controllers\Validasi\ValidasiRkbuPersediaanKsp;
use App\Http\Controllers\Validasi_Rka\ValidasiRkbuBarjasRka;
use App\Http\Controllers\CekUsulanBarangPersediaanController;
use App\Http\Controllers\DokumenPerencanaController;
use App\Http\Controllers\Pengadaan\UsulanSpjBarjasController;
use App\Http\Controllers\ValidasiBelanjaBarangJasaController;
use App\Http\Controllers\ValidasiBelanjaPersediaanController;
use App\Http\Controllers\PdfControllerValidasiPegawaiPnsKabag;
use App\Http\Controllers\PdfControllerValidasiPersediaanKabag;
use App\Http\Controllers\Ringkasan_Blud\BarangJasaAdminImport;
use App\Http\Controllers\Erba\PdfControllerErbaPersediaanAdmin;
use App\Http\Controllers\PdfControllerValidasiPegawaiNonPnsKsp;
use App\Http\Controllers\Validasi\ValidasiRkbuPegawaiNonPnsKsp;
use App\Http\Controllers\Pengadaan\PdfControllerSpjSuratPesanan;
use App\Http\Controllers\Validasi_Rka\ValidasiRkbuPegawaiPnsRka;
use App\Http\Controllers\Validasi_Rka\ValidasiRkbuPersediaanRka;
use App\Http\Controllers\PdfControllerValidasiPegawaiNonPnsKabag;
use App\Http\Controllers\Pengadaan\UsulanSpjPersediaanController;
use App\Http\Controllers\Erba\PdfControllerErbaPegawaiNonPnsAdmin;
use App\Http\Controllers\GambarSlideController;
use App\Http\Controllers\KategoriUploadDokumenController;
use App\Http\Controllers\LaporanKirController;
use App\Http\Controllers\PdfControllerSptjmAsset;
use App\Http\Controllers\PenempatanController;
use App\Http\Controllers\Pengadaan\UsulanBarangadminPpkController;
use App\Http\Controllers\Validasi_Rka\ValidasiRkbuPegawaiNonPnsRka;
use App\Http\Controllers\Ringkasan_Blud\ValidasiControllerModalAdmin;
use App\Http\Controllers\Pengadaan\UsulanBarangModaladminPpkController;
use App\Http\Controllers\Ringkasan_Blud\PdfControllerValidasiModalAdmin;
use App\Http\Controllers\ValidasiBelanja\ValidasiUsulanBarangController;
use App\Http\Controllers\Ringkasan_Apbd\ValidasiControllerModalApbdAdmin;
use App\Http\Controllers\Ringkasan_Blud\PdfControllerValidasiBarjasAdmin;
use App\Http\Controllers\Ringkasan_Blud\ValidasiControllerBarangjasaAdmin;
use App\Http\Controllers\Ringkasan_Blud\ValidasiControllerPegawaiPnsAdmin;
use App\Http\Controllers\Ringkasan_Blud\ValidasiControllerPersediaanAdmin;
use App\Http\Controllers\ValidasiBelanja\ValidasiUsulanBarangRkaController;
use App\Http\Controllers\Pengadaan\UsulanBarangPersediaanadminPpkController;
use App\Http\Controllers\ReklasArb;
use App\Http\Controllers\Ringkasan_Apbd\PdfControllerValidasiModalApbdAdmin;
use App\Http\Controllers\Ringkasan_Apbd\PdfControllerValidasiBarjasApbdAdmin;
use App\Http\Controllers\Ringkasan_Apbd\PdfControllerValidasiNonPnsApbdAdmin;
use App\Http\Controllers\Ringkasan_Blud\PdfControllerValidasiPegawaiPnsAdmin;
use App\Http\Controllers\Ringkasan_Blud\PdfControllerValidasiPersediaanAdmin;
use App\Http\Controllers\Ringkasan_Blud\ValidasiControllerPegawaiNonPnsAdmin;
use App\Http\Controllers\ValidasiBelanja\ValidasiUsulanBarangModalController;
use App\Http\Controllers\Ringkasan_Apbd\ValidasiControllerBarangjasaApbdAdmin;
use App\Http\Controllers\Ringkasan_Blud\PdfControllerValidasiPegawaiNonPnsAdmin;
use App\Http\Controllers\ValidasiBelanja\ValidasiUsulanBarangDirekturController;
use App\Http\Controllers\ValidasiBelanja\ValidasiUsulanBarangModalRkaController;
use App\Http\Controllers\Ringkasan_Apbd\PdfControllerValidasiPegawaiPnsApbdAdmin;
use App\Http\Controllers\Ringkasan_Apbd\ValidasiControllerPegawaiNonPnsApbdAdmin;
use App\Http\Controllers\UsulanBarangApbdController;
use App\Http\Controllers\UsulanBarangModalApbdController;
use App\Http\Controllers\UsulanBarangPersediaanApbdController;
use App\Http\Controllers\ValidasiBelanja\ValidasiUsulanBarangPersediaanController;
use App\Http\Controllers\ValidasiBelanja\ValidasiUsulanBarangModalDirekturController;
use App\Http\Controllers\ValidasiBelanja\ValidasiUsulanBarangPersediaanRkaController;
use App\Http\Controllers\ValidasiBelanja\ValidasiUsulanBarangPersediaanDirekturController;
use App\Models\KategoriUploadDokumen;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('layouts.main');
// });

// Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance');

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::get('/dashbord', [DashbordController::class, 'index'])->name('dashbord');
    Route::get('/pejabat_pengadaans', [PejabatPengadaanController::class, 'index'])->name('pejabat_pengadaans');
    Route::put('/pejabatPengadaan/{pejabatPengadaan}', [PejabatPengadaanController::class, 'update'])->name('pejabatPengadaan.update');
    // Route::put('/admin_pendukung/{admin_pendukung}', [AdminPendukungController::class, 'update'])->name('admin_pendukungs.update');
    Route::resource('/dasbords', DashbordController::class);
    Route::resource('/anggarans', AnggaranController::class);
    Route::resource('/users', UserController::class);
    Route::post('/update-status/{id}', [UserController::class, 'updateStatus'])->name('update.status');
    Route::post('/update-status-aktif/{id}', [UserController::class, 'updateStatusAktif'])->name('update.status.aktif');
    Route::post('/update-status-perencanaan/{id}', [UserController::class, 'updateStatusPerencanaan'])->name('update.status.perencanaan');
    Route::post('/update-status-penetapan/{id}', [UserController::class, 'updateStatusPenetapan'])->name('update.status.penetapan');
    Route::post('/update-status-perubahan/{id}', [UserController::class, 'updateStatusPerubahan'])->name('update.status.perubahan');
    Route::resource('/ksps', KspController::class);
    Route::resource('/pejabats', PejabatController::class);
    Route::resource('tahun_anggarans', TahunAnggaranController::class);
    Route::resource('sumber_danas', SumberDanaController::class);
    Route::resource('jabatans', JabatanController::class);
    Route::resource('fungsionals', FungsionalController::class);
    Route::resource('units', UnitController::class);
    Route::resource('level_users', LevelUserController::class);
    Route::resource('fases', FaseController::class);
    Route::resource('programs', ProgramController::class);
    Route::resource('kegiatans', KegiatanController::class);
    Route::resource('obyek_belanjas', ObyekBelanjaController::class);
    Route::resource('sub_kegiatans', SubKegiatanController::class);
    Route::resource('jenis_kategori_rkbus', JenisKategoriRkbuController::class);
    Route::resource('kategori_rekenings', KategoriRekeningController::class);
    Route::resource('sub_kategori_rekenings', SubKategoriRekeningController::class);
    Route::resource('jenis_belanjas', JenisBelanjaController::class);
    Route::resource('aktivitass', AktivitasController::class);
    //Route::delete('/aktivitas/{aktivitas}', [AktivitasController::class, 'destroy'])->name('aktivitas.destroy');
    Route::resource('rekening_belanjas', RekeningBelanjaController::class);
    Route::resource('kategori_rkbus', KategoriRkbuController::class);
    Route::resource('sub_kategori_rkbus', SubKategoriRkbuController::class);
    Route::get('komponens/data', function (KomponensDataTable $dataTable) {
        return $dataTable->ajax();
    })->name('komponens.data');
    Route::resource('komponens', KomponenController::class);
    Route::get('komponens/{id_komponen}/edit', [KomponenController::class, 'edit'])->name('komponens.edit');
    Route::delete('komponens/{id_komponen}', [KomponenController::class, 'destroy'])->name('komponens.destroy');

    //Route::resource('barang_assets', AssetController::class);
    Route::post('/barang_assets/store', [AssetController::class, 'store'])->name('barang_assets.store');
    Route::get('/barang_assets/create', [AssetController::class, 'create'])->name('barang_assets.create');
    Route::get('/barang_assets/{id}/edit', [AssetController::class, 'edit'])->name('barang_assets.edit');
    Route::put('/barang_assets/{id_asset}', [AssetController::class, 'update'])->name('barang_assets.update');
    Route::get('/barang_assets/{id_asset}/reklas', [AssetController::class, 'reklas_update'])->name('barang_assets.reklas_update');
    // Route::put('/barang_assets/{id_asset}', [AssetController::class, 'reklas_update'])->name('barang_assets.reklas_update');
    Route::delete('/barang_assets/{asset}', [AssetController::class, 'destroy'])->name('barang_assets.destroy');
    Route::get('/barang_assets', [AssetController::class, 'index'])->name('barang_assets.index');
    Route::post('barang_assets/import', [AssetImport::class, 'import'])->name('barang_assets.import');
    Route::get('barang_assets/download', [AssetImport::class, 'downloadReport'])->name('barang_assets.downloadReport');
    Route::get('/barang_assets/generate_qrcode/{id_asset}', [AssetController::class, 'generateQrCode'])->name('barang_assets.generate_qrcode');
    Route::get('/barang_assets/export', [AssetController::class, 'export'])->name('barang_assets.export');
    Route::get('/barang_assets/cetak-qrcode', [AssetController::class, 'cetakQRCode'])->name('barang_assets.cetakQRCode');
    Route::get('/barang_assets/download/{id_asset}', [AssetController::class, 'downloadSptjm'])->name('barang_assets.download');
    Route::get('/PdfControllerSptjmAsset/{id_asset}', [PdfControllerSptjmAsset::class, 'downloadPDF'])->name('barang_assets.PdfControllerSptjmAsset');

    // Route Laporan KIR
    Route::resource('laporan_kirs', LaporanKirController::class);
    Route::get('laporan_kirs/print/{id_penempatan}', [LaporanKirController::class, 'print'])->name('laporan_kirs.print');



    //Route::resource('reklas_arbs', AssetController::class);
    Route::post('/reklas_arbs/store', [ReklasArb::class, 'store'])->name('reklas_arbs.store');
    Route::get('/reklas_arbs/{id}/edit', [ReklasArb::class, 'edit'])->name('reklas_arbs.edit');
    Route::put('/reklas_arbs/{id_asset}', [ReklasArb::class, 'update'])->name('reklas_arbs.update');
    Route::delete('/reklas_arbs/{asset}', [ReklasArb::class, 'destroy'])->name('reklas_arbs.destroy');
    Route::get('/reklas_arbs', [ReklasArb::class, 'index'])->name('reklas_arbs.index');
    Route::post('reklas_arbs/import', [AssetImport::class, 'import'])->name('reklas_arbs.import');
    Route::get('reklas_arbs/download', [AssetImport::class, 'downloadReport'])->name('reklas_arbs.downloadReport');
    Route::get('/reklas_arbs/generate_qrcode/{id_asset}', [ReklasArb::class, 'generateQrCode'])->name('reklas_arbs.generate_qrcode');
    Route::get('/reklas_arbs/export', [ReklasArb::class, 'export'])->name('reklas_arbs.export');
    Route::get('/reklas_arbs/cetak-qrcode', [ReklasArb::class, 'cetakQRCode'])->name('reklas_arbs.cetakQRCode');

    Route::resource('dokumen_perencanas', DokumenPerencanaController::class);
    Route::resource('kategori_upload_dokumens', KategoriUploadDokumenController::class);
    Route::resource('gambar_slide', GambarSlideController::class);
    Route::resource('uraian_satus', UraianSatuController::class);
    Route::resource('uraian_duas', UraianDuaController::class);
    Route::resource('status_validasis', StatusValidasiController::class);
    Route::resource('status_validasi_rkas', StatusValidasiRkaController::class);
    Route::resource('admin_pendukungs', AdminPendukungController::class);
    Route::resource('pejabat_pengadaans', PejabatPengadaanController::class);
    Route::resource('pptks', PptkController::class);
    Route::resource('ppk_keuangans', PpkKeuanganController::class);
    Route::resource('judul_headers', JudulHeaderController::class);
    Route::post('/kegiatans/import', [KegiatanController::class, 'importExcel'])->name('kegiatans.import');

    Route::resource('gambar_logins', GambarLoginController::class);
    Route::get('/gambar_logins/create', [GambarLoginController::class, 'create'])->name('gambar_logins.create');
    Route::post('/gambar_logins/store', [GambarLoginController::class, 'store'])->name('gambar_logins.store');

    Route::resource('tanggal_perencanaans', TanggalPerencanaanController::class);
    Route::get('/tanggal_perencanaans/create', [TanggalPerencanaanController::class, 'create'])->name('tanggal_perencanaans.create');
    Route::post('/tanggal_perencanaans/store', [TanggalPerencanaanController::class, 'store'])->name('tanggal_perencanaans.store');
    Route::get('/tanggal_perencanaans/{id}/edit', [TanggalPerencanaanController::class, 'edit'])->name('tanggal_perencanaans.edit');
    Route::put('/tanggal_perencanaans/{id}/update', [TanggalPerencanaanController::class, 'update'])->name('tanggal_perencanaans.update');
    Route::delete('/tanggal_perencanaans/{id}', [TanggalPerencanaanController::class, 'destroy'])->name('tanggal_perencanaans.delete');

    // Kertas Kerja
    Route::resource('/kertas_kerjas', KertasKerjaRbaController::class);
    Route::get('/download_Kertas_kerja_BLUD', [PdfControllerKertasKerjaBlud::class, 'downloadPDF'])->name('kertas_kerjas.downloadPDF_kertas_kerja');

    // Realisasi RBA
    Route::resource('/realisasi_rba', KertasKerjaRealisasiRbaController::class);
    Route::get('/download_Realisasi_Kertas_kerja_BLUD', [PdfControllerRealisasiRba::class, 'downloadPDF'])->name('realisasi_rba.downloadPDF_realisasi_kertas_kerja');

    // Kertas Kerja Program
    Route::resource('/kertas_kerjas_APBD', KertasKerjaApbd::class);
    Route::get('/download_Kertas_kerja_APBD', [PdfControllerKertasKerjaApbd::class, 'downloadPDF'])->name('kertas_kerjas.downloadPDF_kertas_kerja_apbd');

    // ------------------- Pengadaan ------------------ //
    Route::resource('perusahaans', PerusahaanController::class);
    Route::resource('usulan_belanja_barjas_admin_ppks', UsulanBarangadminPpkController::class);
    Route::resource('usulan_belanja_per_admin_ppks', UsulanBarangPersediaanadminPpkController::class);
    Route::resource('usulan_belanja_modal_admin_ppks', UsulanBarangModaladminPpkController::class);
    Route::get('/usulan-belanja-modal-admin-ppks/show/{id_usulan_barang}', [UsulanBarangModaladminPpkController::class, 'show'])->name('usulan_belanja_modal_admin_ppks.show');
    Route::get('/usulan-belanja-barjas-admin-ppks/show/{id_usulan_barang}', [UsulanBarangadminPpkController::class, 'show'])->name('usulan_belanja_barjas_admin_ppks.show');
    Route::get('/usulan-belanja-per-admin-ppks/show/{id_usulan_barang}', [UsulanBarangPersediaanadminPpkController::class, 'show'])->name('usulan_belanja_per_admin_ppks.show');

    Route::resource('usulan_spj_barjass', UsulanSpjBarjasController::class);
    Route::post('/usulan-spj/add', [UsulanSpjBarjasController::class, 'add'])->name('usulan_spj_barjass.add');
    Route::post('/usulan-spj/store', [UsulanSpjBarjasController::class, 'store'])->name('usulan_spj_barjass.store');
    Route::put('/usulan-spj-barjass/{id_spj}/update-status', [UsulanSpjBarjasController::class, 'updateStatus'])
        ->name('usulan_spj_barjass.updateStatus');
    Route::get('/usulan_spj_barjass/show/{id_spj}', [UsulanSpjBarjasController::class, 'show'])->name('usulan_spj_barjas.show');
    Route::delete('/usulan_spj_barjass/{id_spj}', [UsulanSpjBarjasController::class, 'destroy'])->name('usulan_spj_barjass.destroy');
    Route::delete('/usulan_spj_detail_barjass/{id_spj_detail}', [UsulanSpjBarjasController::class, 'delete'])->name('usulan_spj_barjass.delete');

    Route::resource('usulan_spj_modals', UsulanSpjModalController::class);
    Route::post('/usulan-spj_modals/add', [UsulanSpjModalController::class, 'add'])->name('usulan_spj_modals.add');
    Route::post('/usulan-spj_modals/store', [UsulanSpjModalController::class, 'store'])->name('usulan_spj_modals.store');
    Route::put('/usulan-spj-modals/{id_spj}/update-status', [UsulanSpjModalController::class, 'updateStatus'])
        ->name('usulan_spj_modals.updateStatus');
    Route::get('/usulan_spj_modals/show/{id_spj}', [UsulanSpjModalController::class, 'show'])->name('usulan_spj_modals.show');
    Route::delete('/usulan_spj_modals/{id_spj}', [UsulanSpjModalController::class, 'destroy'])->name('usulan_spj_modals.destroy');
    Route::delete('/usulan_spj_detail_modals/{id_spj_detail}', [UsulanSpjModalController::class, 'delete'])->name('usulan_spj_modals.delete');

    Route::resource('usulan_spj_persediaans', UsulanSpjPersediaanController::class);
    Route::post('/usulan-spj_persediaan/add', [UsulanSpjPersediaanController::class, 'add'])->name('usulan_spj_persediaans.add');
    Route::post('/usulan-spj_persediaan/store', [UsulanSpjPersediaanController::class, 'store'])->name('usulan_spj_persediaans.store');
    Route::put('/usulan-spj-persediaans/{id_spj}/update-status', [UsulanSpjPersediaanController::class, 'updateStatus'])
        ->name('usulan_spj_persediaans.updateStatus');
    Route::get('/usulan_spj_persediaans/show/{id_spj}', [UsulanSpjPersediaanController::class, 'show'])->name('usulan_spj_persediaans.show');
    Route::delete('/usulan_spj_persediaans/{id_spj}', [UsulanSpjPersediaanController::class, 'destroy'])->name('usulan_spj_persediaans.destroy');
    Route::delete('/usulan_spj_detail_persediaans/{id_spj_detail}', [UsulanSpjPersediaanController::class, 'delete'])->name('usulan_spj_persediaans.delete');

    ///////////////////////// Master SPJ ////////////////////////////////////////////////////////
    Route::resource('master_spj', MasterSpjController::class);
    Route::get('/master-spj', [MasterSpjController::class, 'index'])->name('master_spj.index');
    Route::get('/master-spj/{id}/show', [MasterSpjController::class, 'show'])->name('master_spj.show');
    Route::put('/master-spj/{id}/update-surat-pesanan', [MasterSpjController::class, 'updateSuratPesanan'])
        ->name('master_spj.updateSuratPesanan');
    Route::put('/master-spj/{id}/update-barang-datang', [MasterSpjController::class, 'updateBarangDatang'])
        ->name('master_spj.updateBarangDatang');
    Route::put('/master-spj/{id}/update-tukar-faktur', [MasterSpjController::class, 'tukarfaktur'])
        ->name('master_spj.tukarfaktur');
    Route::put('/master-spj/{id}/update-bast', [MasterSpjController::class, 'updateBast'])
        ->name('master_spj.updateBast');
    Route::put('/master-spj/{id}/update-verif-pb', [MasterSpjController::class, 'updateVerifPB'])
        ->name('master_spj.updateVerifPB');
    Route::put('/master-spj/{id}/update-verif-ppk', [MasterSpjController::class, 'updateVerifPPK'])
        ->name('master_spj.updateVerifPPK');
    Route::put('/master-spj/{id}/update-verif-ppbj', [MasterSpjController::class, 'updateVerifPPBJ'])
        ->name('master_spj.updateVerifPPBJ');
    Route::put('/master-spj/{id}/update-verif-pptk', [MasterSpjController::class, 'updateVerifPPTK'])
        ->name('master_spj.updateVerifPPTK');
    Route::put('/master-spj/{id}/update-verif-Verifikator', [MasterSpjController::class, 'updateVerifVerifikator'])
        ->name('master_spj.updateVerifVerifikator');
    Route::put('/master-spj/{id}/update-verif-PPK-Keuangan', [MasterSpjController::class, 'updateVerifPPKKeuangan'])
        ->name('master_spj.updateVerifPPKKeuangan');
    Route::put('/master-spj/{id}/update-verif-Direktur', [MasterSpjController::class, 'updateVerifDirektur'])
        ->name('master_spj.updateVerifDirektur');
    Route::put('/master-spj/{id}/update-serah-terima-Bendahara', [MasterSpjController::class, 'updateSerahTerimaBendahara'])
        ->name('master_spj.updateSerahTerimaBendahara');
    Route::put('/master-spj/{id}/update-verifikasi-Bendahara', [MasterSpjController::class, 'updateverifikasiBendahara'])
        ->name('master_spj.updateverifikasiBendahara');

    Route::get('/downloadPDF_Spj_surat_pesanan/{id}', [PdfControllerSpjSuratPesanan::class, 'downloadPDF'])->name('spj_surat_pesanan.downloadPDF_Spj_surat_pesanan');
    Route::get('/downloadPDF_Spj_BAST_PK/{id}', [PdfControllerSpjBastPK::class, 'downloadPDF'])->name('bast_pk.downloadPDF_BAST_PK');
    Route::get('/downloadPDF_Spj_BAST_BP/{id}', [PdfControllerSPJBastBP::class, 'downloadPDF'])->name('bast_bp.downloadPDF_BAST_BP');
    Route::get('/downloadPDF_Spj_BAST_HP/{id}', [PdfControllerSPJBastHP::class, 'downloadPDF'])->name('bast_hp.downloadPDF_BAST_HP');
    Route::get('/rkbu/download-report-spj', [MasterSpjEksport::class, 'downloadReport'])->name('master_spj.downloadReport');
    Route::get('/downloadPDF-report-spj', [PdfControllerMasterSpj::class, 'downloadPDF'])->name('master_spj.downloadPDF_report_spj');
    Route::get('/downloadPDF-realisasi-report-spj', [PdfControllerRealisasiMasterSpj::class, 'downloadPDF'])->name('master_spj.downloadPDF_realisasi_spj');


    // Notifikation
    Route::get('/navbar-notifications', [NotifikasiUsulanBelanjaController::class, 'getNotifications']);
    Route::get('/view-all-notifications', [NotifikasiUsulanBelanjaController::class, 'viewAllNotifications'])->name('view_all_notifications');
    Route::get('/get-navbar-notifications', [NotifikasiUsulanBelanjaController::class, 'getNavbarNotifications']);

    // Route Validasi
    Route::resource('validasi_barang_jasas', ValidasiRkbuBarjasKsp::class);
    Route::resource('validasi_modals', ValidasiRkbuModalKsp::class);
    Route::resource('validasi_persediaans', ValidasiRkbuPersediaanKsp::class);
    Route::resource('validasi_pegawai_pnss', ValidasiRkbuPegawaiPnsKsp::class);
    Route::resource('validasi_pegawai_non_pnss', ValidasiRkbuPegawaiNonPnsKsp::class);
    Route::get('/downloadPDF_ValidasiKsp', [PdfControllerValidasiBarjasKsp::class, 'downloadPDF'])->name('validasi_barang_jasas.downloadPDF_ValidasiKsp');
    Route::get('/downloadPDF_ValidasiModalKsp', [PdfControllerValidasiModalKsp::class, 'downloadPDF'])->name('validasi_modals.downloadPDF_ValidasiModalKsp');
    Route::get('/downloadPDF_ValidasipersediaanKsp', [PdfControllerValidasiPersediaanKsp::class, 'downloadPDF'])->name('validasi_persediaans.downloadPDF_ValidasipersediaanKsp');
    Route::get('/downloadPDF_ValidasiPegawaiPnsKsp', [PdfControllerValidasiPegawaiPnsKsp::class, 'downloadPDF'])->name('validasi_pegawai_pnss.downloadPDF_ValidasiPegawaiPnsKsp');
    Route::get('/downloadPDF_ValidasiPegawaiNonPnsKsp', [PdfControllerValidasiPegawaiNonPnsKsp::class, 'downloadPDF'])->name('validasi_pegawai_non_pnss.downloadPDF_ValidasiPegawaiNonPnsKsp');

    Route::resource('validasi_barang_jasa_rkas', ValidasiRkbuBarjasRka::class);
    Route::post('/validasi-barang-jasa-rkas/mass-validasi', [ValidasiRkbuBarjasRka::class, 'massValidasi'])->name('validasi_barang_jasa_rkas.massValidasi');
    Route::post('/validasi-modal-rkas/mass-validasi', [ValidasiRkbuModalRka::class, 'massValidasi'])->name('validasi_modal_rkas.massValidasi');
    Route::post('/validasi-persediaan-rkas/mass-validasi', [ValidasiRkbuPersediaanRka::class, 'massValidasi'])->name('validasi_persediaan_rkas.massValidasi');
    Route::resource('validasi_modal_rkas', ValidasiRkbuModalRka::class);
    Route::resource('validasi_persediaan_rkas', ValidasiRkbuPersediaanRka::class);
    Route::resource('validasi_pegawai_pns_rkas', ValidasiRkbuPegawaiPnsRka::class);
    Route::resource('validasi_pegawai_non_pns_rkas', ValidasiRkbuPegawaiNonPnsRka::class);
    Route::get('/downloadPDF_ValidasiKabag', [PdfControllerValidasiBarjasKabag::class, 'downloadPDF'])->name('validasi_barang_jasa_rkas.downloadPDF_ValidasiKsp');
    Route::get('/downloadPDF_ValidasiModalKabag', [PdfControllerValidasiModalKabag::class, 'downloadPDF'])->name('validasi_modal_rkas.downloadPDF_ValidasiModalKabag');
    Route::get('/downloadPDF_ValidasipersediaanKabag', [PdfControllerValidasiPersediaanKabag::class, 'downloadPDF'])->name('validasi_persediaan_rkas.downloadPDF_ValidasipersediaanKabag');
    Route::get('/downloadPDF_ValidasiPegawaiPnsKabag', [PdfControllerValidasiPegawaiPnsKabag::class, 'downloadPDF'])->name('validasi_pegawai_pns_rkas.downloadPDF_ValidasiPegawaiPnsKabag');
    Route::get('/downloadPDF_ValidasiPegawaiNonPnsKabag', [PdfControllerValidasiPegawaiNonPnsKabag::class, 'downloadPDF'])->name('validasi_pegawai_non_pns_rkas.downloadPDF_ValidasiPegawaiNonPnsKabag');

    // RINGKASAN RBA ADMIN
    Route::get('/validasi-barang-jasa_admin', [ValidasiControllerBarangjasaAdmin::class, 'index'])->name('validasi_barang_jasa_admins.index');
    Route::get('/validasi-barang-jasa_admin/create', [ValidasiControllerBarangjasaAdmin::class, 'create'])->name('validasi_barang_jasa_admins.create');
    Route::get('/validasi-barang-jasa_admin/{id}/edit', [ValidasiControllerBarangjasaAdmin::class, 'edit'])->name('validasi_barang_jasa_admins.edit');
    Route::post('/validasi_barang_jasa_admins/mass-validasi', [ValidasiControllerBarangjasaAdmin::class, 'massValidasi'])->name('validasi_barang_jasa_admins.massValidasi');
    Route::put('/validasi-barang-jasa_admin/{id}', [ValidasiControllerBarangjasaAdmin::class, 'update'])->name('validasi_barang_jasa_admins.update');
    Route::delete('/validasi/barangjasa/{id}', [ValidasiControllerBarangjasaAdmin::class, 'destroy'])->name('validasi_barang_jasa_admins.destroy');
    //Route::resource('validasi_barang_jasa_admins', ValidasiControllerBarangjasaAdmin::class);
    // Route::post('/validasi_barang_jasa_admins/mass-validasi', [ValidasiControllerBarangjasaAdmin::class, 'massValidasi'])->name('validasi_barang_jasa_admins.massValidasi');
    Route::get('/downloadPDF_ValidasiAdmin', [PdfControllerValidasiBarjasAdmin::class, 'downloadPDF'])->name('validasi_barang_jasa_admins.downloadPDF_ValidasiAdmin');
    Route::post('barang-jasa/import', [BarangJasaAdminImport::class, 'import'])->name('barang_jasa_admin.import');

    Route::resource('validasi_modal_admins', ValidasiControllerModalAdmin::class);
    Route::post('/validasi-modal-admin/mass-validasi', [ValidasiControllerModalAdmin::class, 'massValidasi'])->name('validasi_modal_admins.massValidasi');
    Route::get('/downloadPDF_ValidasiModalAdmin', [PdfControllerValidasiModalAdmin::class, 'downloadPDF'])->name('validasi_modal_admins.downloadPDF_ValidasiModalAdmin');

    Route::resource('validasi_persediaan_admins', ValidasiControllerPersediaanAdmin::class);
    Route::get('/downloadPDF_ValidasipersediaanAdmin', [PdfControllerValidasiPersediaanAdmin::class, 'downloadPDF'])->name('validasi_persediaan_admins.downloadPDF_ValidasipersediaanAdmin');
    Route::post('/validasi-persediaan-admin/mass-validasi', [ValidasiControllerPersediaanAdmin::class, 'massValidasi'])->name('validasi_persediaan_admins.massValidasi');

    Route::resource('validasi_pegawai_pns_admins', ValidasiControllerPegawaiPnsAdmin::class);
    Route::get('/downloadPDF_ValidasiPegawaiPnsAdmin', [PdfControllerValidasiPegawaiPnsAdmin::class, 'downloadPDF'])->name('validasi_pegawai_pns_admins.downloadPDF_ValidasiPegawaiPnsAdmin');
    Route::post('/validasi-pegawai-pns-admin/mass-validasi', [ValidasiControllerPegawaiPnsAdmin::class, 'massValidasi'])->name('validasi_pegawai_pns_admins.massValidasi');
    Route::resource('validasi_pegawai_non_pns_admins', ValidasiControllerPegawaiNonPnsAdmin::class);
    Route::get('/downloadPDF_ValidasiPegawaiNonPnsAdmin', [PdfControllerValidasiPegawaiNonPnsAdmin::class, 'downloadPDF'])->name('validasi_pegawai_non_pns_admins.downloadPDF_ValidasiPegawaiNonPnsAdmin');

    /////////// E-RBA /////////////////////////
    Route::get('downloadPDF_erbaAdmin', [PdfControllerErbaAdmin::class, 'downloadPDF'])
        ->name('downloadPDF_erbaAdmin');
    Route::get('downloadPDF_erba_PersediaanAdmin', [PdfControllerErbaPersediaanAdmin::class, 'downloadPDF'])
        ->name('downloadPDF_erba_PersediaanAdmin');
    Route::get('downloadPDF_erba_ModalAdmin', [PdfControllerErbaModalAdmin::class, 'downloadPDF'])
        ->name('downloadPDF_erba_ModalAdmin');
    Route::get('downloadPDF_erba_PnsAdmin', [PdfControllerErbaPegawaiAdmin::class, 'downloadPDF'])
        ->name('downloadPDF_erba_PnsAdmin');
    Route::get('downloadPDF_erba_NonPnsAdmin', [PdfControllerErbaPegawaiNonPnsAdmin::class, 'downloadPDF'])
        ->name('downloadPDF_erba_NonPnsAdmin');


    /////////// DOWNLOAD FILE /////////////////////////
    Route::get('/download/{filename}', [FileController::class, 'download'])->name('file.download');

    // RINGKASAN RBA APBD ADMIN
    Route::resource('validasi_non_pns_apbd_admins', ValidasiControllerPegawaiNonPnsApbdAdmin::class);
    Route::get('/downloadPDF_ValidasiNonPnsApbdAdmin', [PdfControllerValidasiNonPnsApbdAdmin::class, 'downloadPDF'])->name('validasi_non_pns_apbd_admins.downloadPDF_ValidasiNonPnsApbdAdmin');
    Route::resource('validasi_barang_jasa_apbd_admins', ValidasiControllerBarangjasaApbdAdmin::class);
    Route::get('/downloadPDF_ValidasiApbdAdmin', [PdfControllerValidasiBarjasApbdAdmin::class, 'downloadPDF'])->name('validasi_barang_jasa_apbd_admins.downloadPDF_ValidasiApbdAdmin');
    Route::resource('validasi_modal_apbd_admins', ValidasiControllerModalApbdAdmin::class);
    Route::get('/downloadPDF_ValidasiModalApbdAdmin', [PdfControllerValidasiModalApbdAdmin::class, 'downloadPDF'])->name('validasi_modal_apbd_admins.downloadPDF_ValidasiModalApbdAdmin');
    Route::post('/validasi-modal-admin-apbd/mass-validasi', [ValidasiControllerModalApbdAdmin::class, 'massValidasi'])->name('validasi_modal_apbd_admins.massValidasi');
    // Route::post('/validasi_barang_jasa_admins/mass-validasi', [ValidasiControllerBarangjasaAdmin::class, 'massValidasi'])->name('validasi_barang_jasa_admins.massValidasi');
    // Route::post('/validasi-modal-admin/mass-validasi', [ValidasiControllerModalAdmin::class, 'massValidasi'])->name('validasi_modal_admin.massValidasi');

    // Route::resource('validasi_persediaan_admins', ValidasiControllerPersediaanAdmin::class);
    // Route::get('/downloadPDF_ValidasipersediaanAdmin', [PdfControllerValidasiPersediaanAdmin::class, 'downloadPDF'])->name('validasi_persediaan_admins.downloadPDF_ValidasipersediaanAdmin');
    // Route::post('/validasi-persediaan-admin/mass-validasi', [ValidasiControllerPersediaanAdmin::class, 'massValidasi'])->name('validasi_persediaan_admins.massValidasi');

    // Route Validasi Usulan Barang Admin
    Route::resource('validasi_usulan_barangs', ValidasiUsulanBarangController::class);
    Route::get('/validasi-usulan-barangs/{id_sub_kategori_rkbu?}', [ValidasiUsulanBarangController::class, 'index'])->name('validasi_usulan_barangs.index');
    Route::get('/validasi_usulan_barangs/keranjang/{id}', [ValidasiUsulanBarangController::class, 'keranjang'])->name('validasi_usulan_barangs.keranjang');
    Route::put('/validasi-usulan-barangs/{no_usulan_barang}', [ValidasiUsulanBarangController::class, 'updateValidasi'])->name('validasi_usulan_barangs.updateValidasi');
    Route::get('/validasi-usulan-barangs/show/{no_usulan_barang}', [ValidasiUsulanBarangController::class, 'show'])->name('validasi_usulan_barangs.show');
    Route::delete('/validasi-usulan-barangs/{id_usulan_barang}', [ValidasiUsulanBarangController::class, 'doDelete'])
        ->name('validasi_usulan_barangs.delete');


    Route::resource('validasi_usulan_barang_modals', ValidasiUsulanBarangModalController::class);
    Route::put('/validasi-usulan-barang_modals/{no_usulan_barang}', [ValidasiUsulanBarangModalController::class, 'updateValidasi'])->name('validasi_usulan_barang_modals.updateValidasi');
    Route::get('/validasi_usulan_barang_modals/keranjang/{id}', [ValidasiUsulanBarangModalController::class, 'keranjang'])->name('validasi_usulan_barang_modals.keranjang');
    Route::get('/validasi-usulan-barang_modals/show/{no_usulan_barang}', [ValidasiUsulanBarangModalController::class, 'show'])->name('validasi_usulan_barang_modals.show');
    Route::delete('/validasi-usulan-barang_modals/{id_usulan_barang}', [ValidasiUsulanBarangModalController::class, 'doDelete'])
        ->name('validasi_usulan_barang_modals.delete');

    Route::resource('validasi_usulan_persediaans', ValidasiUsulanBarangPersediaanController::class);
    Route::get('/validasi_usulan_persediaans/keranjang/{id}', [ValidasiUsulanBarangPersediaanController::class, 'keranjang'])->name('validasi_usulan_persediaans.keranjang');
    Route::put('/validasi-usulan-persediaans/{no_usulan_barang}', [ValidasiUsulanBarangPersediaanController::class, 'updateValidasi'])->name('validasi_usulan_persediaans.updateValidasi');
    Route::get('/validasi-usulan-persediaans/show/{no_usulan_barang}', [ValidasiUsulanBarangPersediaanController::class, 'show'])->name('validasi_usulan_persediaans.show');
    Route::delete('/validasi-usulan-persediaans/{id_usulan_barang}', [ValidasiUsulanBarangPersediaanController::class, 'doDelete'])
        ->name('validasi_usulan_persediaans.delete');

    // Route Validasi Usulan Barang RKA
    Route::resource('validasi_usulan_barang_rkas', ValidasiUsulanBarangRkaController::class);
    Route::get('/validasi_usulan_barang_rkas/keranjang/{id}', [ValidasiUsulanBarangRkaController::class, 'keranjang'])->name('validasi_usulan_barang_rkas.keranjang');
    Route::get('/validasi_usulan_barang_rkas/show/{usulanBarang}', [ValidasiUsulanBarangRkaController::class, 'show'])->name('cek_usulan_barang_barjas_rkas.show');
    Route::put('/validasi-usulan-barang_rkas/{no_usulan_barang}', [ValidasiUsulanBarangRkaController::class, 'updateValidasi'])->name('validasi_usulan_barang_rkas.updateValidasi');

    Route::resource('validasi_usulan_barang_modal_rkas', ValidasiUsulanBarangModalRkaController::class);
    Route::get('/validasi_usulan_barang_modal_rkas/keranjang/{id}', [ValidasiUsulanBarangModalRkaController::class, 'keranjang'])->name('validasi_usulan_barang_modal_rkas.keranjang');
    Route::get('/validasi_usulan_barang_modal_rkas/show/{usulanBarang}', [ValidasiUsulanBarangModalRkaController::class, 'show'])->name('validasi_usulan_barang_modal_rkas.show');
    Route::put('/validasi-usulan-barang_modal_rkas/{no_usulan_barang}', [ValidasiUsulanBarangModalRkaController::class, 'updateValidasi'])->name('validasi_usulan_barang_modal_rkas.updateValidasi');

    Route::resource('validasi_usulan_persediaan_rkas', ValidasiUsulanBarangPersediaanRkaController::class);
    Route::get('/validasi_usulan_persediaan_rkas/keranjang/{id}', [ValidasiUsulanBarangPersediaanRkaController::class, 'keranjang'])->name('validasi_usulan_persediaan_rkas.keranjang');
    Route::put('/validasi-usulan-persediaan_rkas/{no_usulan_barang}', [ValidasiUsulanBarangPersediaanRkaController::class, 'updateValidasi'])->name('validasi_usulan_persediaan_rkas.updateValidasi');

    //Route Validasi Usulan Barang Direktur
    Route::resource('validasi_usulan_barang_direkturs', ValidasiUsulanBarangDirekturController::class);
    Route::get('/validasi_usulan_barang_direkturs/show/{usulanBarang}', [ValidasiUsulanBarangDirekturController::class, 'show'])->name('cek_usulan_barang_barjas_direkturs.show');
    Route::get('/validasi_usulan_barang_direkturs/keranjang/{id}', [ValidasiUsulanBarangDirekturController::class, 'keranjang'])->name('validasi_usulan_barang_direkturs.keranjang');
    Route::put('/validasi-usulan-barang_direkturs/{no_usulan_barang}', [ValidasiUsulanBarangDirekturController::class, 'updateValidasi'])->name('validasi_usulan_barang_direkturs.updateValidasi');

    Route::resource('validasi_usulan_modal_direkturs', ValidasiUsulanBarangModalDirekturController::class);
    Route::get('/validasi_usulan_modal_direkturs/show/{usulanBarang}', [ValidasiUsulanBarangModalDirekturController::class, 'show'])->name('cek_usulan_modal_direkturs.show');
    Route::get('/validasi_usulan_modal_direkturs/keranjang/{id}', [ValidasiUsulanBarangModalDirekturController::class, 'keranjang'])->name('validasi_usulan_modal_direkturs.keranjang');
    Route::put('/validasi-usulan-modal_direkturs/{no_usulan_barang}', [ValidasiUsulanBarangModalDirekturController::class, 'updateValidasi'])->name('validasi_usulan_modal_direkturs.updateValidasi');

    Route::resource('validasi_usul_persediaan_dirs', ValidasiUsulanBarangPersediaanDirekturController::class);
    Route::get('/validasi_usul_persediaan_dirs/show/{usulanBarang}', [ValidasiUsulanBarangPersediaanDirekturController::class, 'show'])->name('cek_usul_persediaan_dirs.show');
    Route::get('/validasi_usul_persediaan_dirs/keranjang/{id}', [ValidasiUsulanBarangPersediaanDirekturController::class, 'keranjang'])->name('validasi_usul_persediaan_dirs.keranjang');
    Route::put('/validasi-usul-persediaan_dirs/{no_usulan_barang}', [ValidasiUsulanBarangPersediaanDirekturController::class, 'updateValidasi'])->name('validasi_usul_persediaan_dirs.updateValidasi');

    //Route Usulan Belanja Barjas
    Route::resource('usulan_barang_barjass', UsulanBarangController::class);
    Route::get('/usulan-barang_barjass/{id_usulan_barang}/show', [UsulanBarangController::class, 'show'])->name('usulan_barang_barjass.show');
    Route::post('/usulan_barang_barjass/update-status/{id}', [UsulanBarangController::class, 'updateStatus'])->name('usulan_barang_barjass.updateStatus');
    Route::delete('/usulan_barang_barjass/{usulan_barang}', [UsulanBarangController::class, 'destroy'])->name('usulan_barang_barjass.destroy');
    Route::delete('/usulan_barang_barjass.delete/{id_usulan_barang}', [UsulanBarangController::class, 'doDelete'])->name('usulan_barang_barjass.delete');
    Route::delete('/usulan_barang_barjass.delete_detail/{id_usulan_barang_detail}', [UsulanBarangController::class, 'doDeleteDetailKeranjang'])->name('usulan_barang_barjass.delete_detail');
    Route::post('usulan_barang_barjass/get_data_by_subkategori', [UsulanBarangController::class, 'getDataBySubKategori'])->name('usulan_barang_barjass.get_data_by_subkategori');
    Route::get('/get-rkbu-data', [UsulanBarangController::class, 'getRkbuData']);
    Route::post('/add-to-cart/{id_usulan_barang}', [UsulanBarangController::class, 'addToCart'])->name('add-to-cart');
    Route::post('/add-to-cart-multiple-barjas', [UsulanBarangController::class, 'addToCartMultiple'])->name('add-to-cart-multiple-barjas');
    Route::get('/usulan_barang_barjass/keranjang/{id}', [UsulanBarangController::class, 'keranjang'])->name('usulan_barang_barjass.keranjang');

    //Route Usulan Belanja Persediaan
    Route::resource('usulan_barang_persediaans', UsulanBarangPersediaanController::class);
    Route::get('usulan-barang_persediaans/{id_usulan_barang}/show', [UsulanBarangPersediaanController::class, 'show'])->name('usulan_barang_persediaans.show');
    Route::post('/usulan_barangs/update-status/{id}', [UsulanBarangPersediaanController::class, 'updateStatus'])->name('usulan_barangs.updateStatus');
    Route::delete('/usulan_barang_persediaans/{usulan_barang}', [UsulanBarangPersediaanController::class, 'destroy'])->name('usulan_barang_persediaans.destroy');
    Route::delete('/usulan_barang_persediaans.delete/{id_usulan_barang}', [UsulanBarangPersediaanController::class, 'doDelete'])->name('usulan_barang_persediaans.delete');
    Route::delete('/usulan_barang_persediaans.delete_detail/{id_usulan_barang_detail}', [UsulanBarangPersediaanController::class, 'doDeleteDetailKeranjang'])->name('usulan_barang_persediaans.delete_detail');
    Route::post('usulan_barang_persediaans/get_data_by_subkategori', [UsulanBarangPersediaanController::class, 'getDataBySubKategori'])->name('usulan_barang_persediaans.get_data_by_subkategori');
    Route::get('/get-rkbu-data', [UsulanBarangPersediaanController::class, 'getRkbuData']);
    Route::post('/add-to-cart-persediaan/{id_usulan_barang}', [UsulanBarangPersediaanController::class, 'addToCart'])->name('add-to-cart-persediaan');
    Route::post('/add-to-cart-multiple', [UsulanBarangPersediaanController::class, 'addToCartMultiple'])->name('add-to-cart-multiple');
    Route::get('/usulan_barang_persediaans/keranjang/{id}', [UsulanBarangPersediaanController::class, 'keranjang'])->name('usulan_barang_persediaans.keranjang');

    //Route Usulan Belanja Modal
    Route::resource('usulan_barang_modals', UsulanBarangModalController::class);
    Route::get('/usulan-barang_modals/{id_usulan_barang}/show', [UsulanBarangModalController::class, 'show'])->name('usulan_barang_modals.show');
    Route::post('/usulan_barang_modals/update-status/{id}', [UsulanBarangModalController::class, 'updateStatus'])->name('usulan_barang_modals.updateStatus');
    Route::delete('/usulan_barang_modals/{usulan_barang}', [UsulanBarangModalController::class, 'destroy'])->name('usulan_barang_modals.destroy');
    Route::delete('/belanja/keranjang/{id_usulan_barang}', [UsulanBarangModalController::class, 'doDelete'])->name('usulan_barang_modals.delete');
    Route::delete('/belanja/keranjang/detail/{id_usulan_barang_detail}', [UsulanBarangModalController::class, 'doDeleteDetailKeranjang'])->name('usulan_barang_modals.delete_detail');
    Route::post('usulan_barang_modals/get_data_by_subkategori', [UsulanBarangModalController::class, 'getDataBySubKategori'])->name('usulan_barang_modals.get_data_by_subkategori');
    Route::get('/get-rkbu-data', [UsulanBarangModalController::class, 'getRkbuData']);
    Route::post('/add-to-cart-modal/{id_usulan_barang}', [UsulanBarangModalController::class, 'addToCart'])->name('add-to-cart-modal');
    Route::post('/add-to-cart-multiple-modal', [UsulanBarangModalController::class, 'addToCartMultiple'])->name('add-to-cart-multiple-modal');
    Route::get('/usulan-barang/keranjang/{id}', [UsulanBarangModalController::class, 'keranjang'])->name('usulan_barang_modals.keranjang');

    //Route Usulan Belanja Barjas APBD
    Route::resource('usulan_barang_barjas_apbds', UsulanBarangApbdController::class);

    //Route Usulan Belanja Persediaan APBD
    Route::resource('usulan_barang_persediaan_apbds', UsulanBarangPersediaanApbdController::class);

    //Route Usulan Belanja Modal APBD
    Route::resource('usulan_barang_modal_apbds', UsulanBarangModalApbdController::class);


    //Route Cek Usulan Belanja
    Route::resource('cek_usulan_barang_barjass', CekUsulanBarangController::class);
    Route::get('cek_usulan_barang_barjass/{usulanBarang}', [CekUsulanBarangController::class, 'show'])->name('cek_usulan_barang_barjass.show');
    Route::get('/downloadPDF/{id_usulan_barang}', [PdfControllerCekUsulanBarangBarjas::class, 'downloadPDFCekBarjas'])->name('cek_usulan_barang_barjass.downloadPDF');

    //Route Cek Usulan Belanja Modal
    Route::resource('cek_usulan_barang_modals', CekUsulanBarangModalController::class);
    Route::get('cek_usulan_barang_modals/{usulanBarang}', [CekUsulanBarangModalController::class, 'show'])->name('cek_usulan_barang_modals.show');
    Route::get('/downloadPDF_modal/{id_usulan_barang}', [PdfControllerCekUsulanModal::class, 'downloadPDFCekModal'])->name('cek_usulan_barang_modals.downloadPDF_modal');

    //Route Cek Usulan Belanja Persediaan
    Route::resource('cek_usulan_persediaans', CekUsulanBarangPersediaanController::class);
    Route::get('cek_usulan_persediaans/{usulanBarang}', [CekUsulanBarangPersediaanController::class, 'show'])->name('cek_usulan_persediaans.show');
    Route::get('/downloadPDF_persediaan/{id_usulan_barang}', [PdfControllerCekUsulanPersediaan::class, 'downloadPDF'])->name('cek_usulan_persediaans.downloadPDF');

    //Route RKBU Barjas
    Route::resource('rkbu_barang_jasas', RkbuBarangJasaController::class);
    Route::get('/rkbu_barang_jasas/{id}/show', [RkbuBarangJasaController::class, 'show'])->name('rkbu_barang_jasas.show');
    Route::get('/rkbu-barang-barjas/{id}/edit', [RkbuBarangJasaController::class, 'edit'])->name('rkbu_barang_barjass.edit');
    //Route::delete('/rkbu-barang-barjas/{id}', [RkbuBarangJasaController::class, 'destroy'])->name('rkbu_barang_barjass.destroy');
    Route::post('rkbu_barang_jasas/get-data', [RkbuBarangJasaController::class, 'getDataBySubKategori'])
        ->name('rkbu_barang_jasas.getData');
    Route::get('/get-data-by-sub-kategori', [RkbuBarangJasaController::class, 'getDataBySubKategori']);
    Route::post('rkbu_barang_jasas/get_data_by_subkategori', [RkbuBarangJasaController::class, 'getDataBySubKategori'])->name('rkbu_barang_jasas.get_data_by_subkategori');
    Route::post('rkbu_barang_jasas/get_data_by_subkategori_rekening_belanja', [RkbuBarangJasaController::class, 'getDataBySubKategoriRekeningBelanja'])->name('rkbu_barang_jasas.get_data_by_subkategori_rekening_belanja');
    Route::get('/downloadPDF', [PdfControllerRkbuBarjas::class, 'downloadPDF'])->name('rkbu_barang_jasas.downloadPDF');
    Route::get('/rkbu/download-report', [RkbuEksportUser::class, 'downloadReport'])->name('rkbu_barang_jasa_user.downloadReport');
    Route::get('/rkbu/download-report-admin', [RkbuEksportAdmin::class, 'downloadReport'])->name('rkbu_barang_jasa_admin.downloadReport');
    Route::get('/rkbu/download-report-kabag', [RkbuEksportKabag::class, 'downloadReport'])->name('rkbu_barang_jasa_kabag.downloadReport');
    Route::get('/rkbu/download-report-ksp', [RkbuEksportKsp::class, 'downloadReport'])->name('rkbu_barang_jasa_ksp.downloadReport');


    // Import Route RKBU Persediaan
    Route::get('rkbu_persediaan_import/import', [RkbuPersediaanImportController::class, 'importForm'])->name('rkbu_persediaan_import.importForm');
    Route::post('rkbu_persediaan_import/import', [RkbuPersediaanImportController::class, 'import'])->name('rkbu_persediaan_import.import');
    Route::get('/rkbu/download-file-upload', [RkbuPersediaanController::class, 'downloadReport'])->name('rkbu_persediaans.downloadReport');
    Route::get('/rkbu_barjas_admin/download-file-upload', [BarangJasaAdminImport::class, 'downloadReport'])->name('barang_jasa_admin_import.downloadReport');

    //Route RKBU Pegawai
    Route::resource('rkbu_pegawai_pnss', RkbuPegawaiPnsController::class);
    Route::get('/rkbu-pegawai-pns/{id}/edit', [RkbuPegawaiPnsController::class, 'edit'])->name('rkbu_pegawai_pnss.edit');
    Route::delete('/rkbu-pegawai-pns/{id}', [RkbuPegawaiPnsController::class, 'destroy'])->name('rkbu_pegawai_pnss.destroy');
    Route::post('rkbu_pegawai_pnss/get-data', [RkbuPegawaiPnsController::class, 'getDataBySubKategori'])
        ->name('rkbu_pegawai_pnss.getData');
    Route::get('/get-data-by-sub-kategori', [RkbuPegawaiPnsController::class, 'getDataBySubKategori']);
    Route::post('rkbu_pegawai_pnss/get_data_by_subkategori', [RkbuPegawaiPnsController::class, 'getDataBySubKategori'])->name('rkbu_pegawai_pnss.get_data_by_subkategori');
    Route::get('/downloadPDF_pegawai_pns', [PdfControllerRkbuPegawaiPns::class, 'downloadPDF'])->name('rkbu_pegawai_pnss.downloadPDF');

    //Route RKBU Non Pegawai
    Route::resource('rkbu_pegawai_non_pnss', RkbuPegawaiNonPnsController::class);
    Route::get('/rkbu-pegawai-non-pns/{id}/edit', [RkbuPegawaiNonPnsController::class, 'edit'])->name('rkbu_pegawai_non_pnss.edit');
    Route::delete('/rkbu-pegawai-non-pns/{id}', [RkbuPegawaiNonPnsController::class, 'destroy'])->name('rkbu_pegawai_non_pnss.destroy');
    Route::post('rkbu_pegawai_non_pnss/get-data', [RkbuPegawaiNonPnsController::class, 'getDataBySubKategori'])
        ->name('rkbu_pegawai_non_pnss.getData');
    Route::get('/get-data-by-sub-kategori', [RkbuPegawaiNonPnsController::class, 'getDataBySubKategori']);
    Route::post('rkbu_pegawai_non_pnss/get_data_by_subkategori', [RkbuPegawaiNonPnsController::class, 'getDataBySubKategori'])->name('rkbu_pegawai_non_pnss.get_data_by_subkategori');
    Route::get('/downloadPDF_pegawai_non_pns', [PdfControllerRkbuPegawaiNonPns::class, 'downloadPDF'])->name('rkbu_pegawai_non_pnss.downloadPDF');

    //Route History
    Route::resource('history_barjas', RkbuHistoryController::class);
    Route::resource('history_modal', RkbuHistoryModalController::class);
    Route::resource('history_persediaan', RkbuHistoryPersediaanController::class);
    //Route RKBU MODAL
    Route::resource('rkbu_modal_kantors', RkbuModalKantorController::class);
    Route::get('/rkbu_modal_kantors/{id}/show', [RkbuModalKantorController::class, 'show'])->name('rkbu_modal_kantors.show');
    Route::post('rkbu_modal_kantors/get-data', [RkbuModalKantorController::class, 'getDataBySubKategori'])
        ->name('rkbu_modal_kantors.getData');
    Route::resource('rkbu_modal_alkess', RkbuModalAlkesController::class);
    Route::post('rkbu_modal_alkess/get-data', [RkbuModalAlkesController::class, 'getDataBySubKategori'])
        ->name('rkbu_modal_alkess.getData');
    Route::get('/downloadPDFModalKantor', [PdfControllerRkbuModalKantor::class, 'downloadPDFModalKantor'])->name('rkbu_modal_kantors.downloadPDFModalKantor');
    Route::get('/downloadPDFModalAlkes', [PdfControllerModalAlkes::class, 'downloadPDFModalAlkes'])->name('rkbu_modal_alkess.downloadPDFModalAlkes');

    // Route REKAP USULAN BELANJA
    Route::resource('rekap_usulans', RekapUsulanBelanjaController::class);
    Route::get('/rekap_usulans/edit_keranjang/{id}', [RekapUsulanBelanjaController::class, 'edit_keranjang'])->name('rekap_usulans.edit_keranjang');
    Route::put('/rekap-usulans/update-validasi/{no_usulan_barang}', [RekapUsulanBelanjaController::class, 'updateValidasi'])
        ->name('rekap_usulans.updateValidasi');
    Route::get('/rekap-usulan-belanja', [RekapUsulanBelanjaController::class, 'index'])->name('rekap_usulans.index');
    Route::get('/rekap-usulan-belanja/data', [RekapUsulanBelanjaController::class, 'getData'])->name('rekap_usulans.data');
    Route::get('/downloadPDF_rekap_usulans', [PdfControllerUsulanBelanjaPrint::class, 'downloadPDF'])->name('rekap_usulans.downloadPDF_rekap_usulans');
    // Route::put('/rekap_usulans/{no_usulan_barang}', [RekapUsulanBelanjaController::class, 'updateValidasi'])->name('rekap_usulans.updateValidasi');

    // Route::get('rekap-usulan/index/{id_usulan_barang}', [RekapUsulanBelanjaController::class, 'index']);
    // Route Penempatan
    Route::resource('penempatans', PenempatanController::class);


    //Route RKBU PERSEDIAAN
    Route::resource('rkbu_persediaans', RkbuPersediaanController::class);
    Route::get('/rkbu_persediaans/{id}/show', [RkbuPersediaanController::class, 'show'])->name('rkbu_persediaans.show');
    Route::post('rkbu_persediaans/get-data', [RkbuPersediaanController::class, 'getDataBySubKategori'])
        ->name('rkbu_persediaans.getData');
    Route::delete('/rkbu-persediaan/{id}', [RkbuPersediaanController::class, 'destroy'])->name('rkbu_persediaans.destroy');
    Route::get('/downloadPDF_rkbu_persediaans', [PdfControllerRkbuPersediaan::class, 'downloadPDFPersediaan'])->name('rkbu_persediaans.downloadPDFPersediaan');

    Route::get('kategori-rkbu/import', [KategoriRkbuImportController::class, 'importForm'])->name('kategori_rkbu.importForm');
    Route::post('kategori-rkbu/import', [KategoriRkbuImportController::class, 'import'])->name('kategori_rkbu.import');
    Route::get('sub-kategori-rkbu/import', [SubKategoriRkbuImportController::class, 'importForm'])->name('sub_kategori_rkbu.importForm');
    Route::post('sub-kategori-rkbu/import', [SubKategoriRkbuImportController::class, 'import'])->name('sub_kategori_rkbu.import');
    Route::post('perusahaan/import', [PerusahaanImportController::class, 'import'])->name('perusahaan.import');
    Route::get('/perusahaan/download-file-upload', [PerusahaanImportController::class, 'downloadReport'])->name('perusahaan.downloadReport');
    Route::post('usulan_barang_details/import', [UsulanBarangDetailImport::class, 'import'])->name('usulan_barang_details.import');
    Route::get('/usulan_barang_details/download-file-upload', [UsulanBarangDetailImport::class, 'downloadReport'])->name('usulan_barang_details.downloadReport');
    Route::get('download-sub-kategori', function () {
        return Excel::download(new SubKategoriRkbuExport, 'sub_kategori_rkbu.xlsx');
    })->name('sub_kategori_rkbu.download');
    Route::get('/usulan_barang_details/download-report-export/{id_usulan_barang}', [ExportUsulanBarangDetail::class, 'downloadReportExport'])
        ->name('usulan_barang_details.downloadReportExport');

    // KOmponen //
    Route::get('komponens/import', [KomponenImportController::class, 'importForm'])->name('komponens.importForm');
    Route::post('komponens/import', [KomponenImportController::class, 'import'])->name('komponens.import');
    //Route::get('/rkbu-barang-jasas/download-pdf', [RkbuBarangJasaController::class, 'downloadPDF'])->name('rkbu_barang_jasas.downloadPDF');
});

Route::get('/get-program-details/{id}', [App\Http\Controllers\KegiatanController::class, 'getProgramDetails']);
// Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('login', function () {
    return view(
        'login.index',
        [
            'tahun_anggarans'   => \App\Models\TahunAnggaran::where('status', 'aktif')->get(),
            'gambar_login'      => \App\Models\GambarLogin::where('status_gambar', 'Aktif')->get(),
            'logo_login'        => \App\Models\JudulHeader::get()
        ]
    );
})->name('login');
Route::get('/barang_assets/details/{id}', [AssetController::class, 'show'])->name('barang_assets.details');
Route::get('/reklas_arbs/details/{id}', [ReklasArb::class, 'show'])->name('reklas_arbs.details');
