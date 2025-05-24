<?php

namespace App\Http\Controllers;

use TCPDF;
use App\Pdf\MYPDF;
use App\Models\Rkbu;
use App\Models\Asset;
use App\Models\Jabatan;
use App\Models\Pejabat;
use App\Models\JudulHeader;
use App\Models\JenisBelanja;
use Illuminate\Http\Request;
use App\Models\TahunAnggaran;
use App\Models\SubKategoriRkbu;
use App\Models\PejabatPengadaan;
use App\Models\StatusValidasiRka;
use App\Models\TanggalPerencanaan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PdfControllerSptjmAsset extends Controller
{
    public function downloadPDF($id = null)
    {
        if (!$id) {
            return 'ID tidak ditemukan';
        }

        $tahunAnggaran = Session::get('tahun_anggaran');
        $judul_headers = JudulHeader::first();
        // $invoice = Spj::where('id_spj', $master_spj->id_spj)->first();

        $first_direktur = Pejabat::join('jabatans', 'jabatans.id_jabatan', '=', 'pejabats.id_jabatan')
            ->where('jabatans.nama_jabatan', 'Direktur')
            ->select('jabatans.*', 'pejabats.nama_pejabat', 'pejabats.nip_pejabat') // Pilih kolom yang ingin diambil
            ->first();


        $nama_direktur      = '...............';
        $nip_direktur       = '...............';

        if ($first_direktur) {
            // Ambil nama valid perencana, kabag, dan direktur
            $nama_direktur      = $first_direktur->nama_pejabat ?? '...............';
            $nip_direktur       = $first_direktur->nip_pejabat ?? '...............';
        }

        // Pastikan variabel judul_headers ada
        $judul_header1          = $judul_headers->header1 ?? 'Judul Tidak Ada';
        $nama                   = $judul_headers->nama_rs ?? 'Nama Tidak Ada';
        $alamat                 = $judul_headers->alamat_rs ?? 'Alamat Tidak Ada';
        $tlp                    = $judul_headers->tlp_rs ?? 'Tlp Tidak Ada';
        $email                  = $judul_headers->email_rs ?? 'Email Tidak Ada';
        $website                = $judul_headers->header3 ?? 'Website Tidak Ada';
        $gambar1                = $judul_headers->gambar1 ?? 'Website Tidak Ada';
        $gambar2                = $judul_headers->gambar2 ?? 'Website Tidak Ada';

        $invo = Asset::leftJoin('penempatans', 'penempatans.id_penempatan', '=', 'assets.id_penempatan')
            ->select('assets.*', 'penempatans.*')
            ->where('assets.id_asset', $id)
            ->first();

        // dd($invo);
        if (!$invo) {
            return abort(404, 'Data asset tidak ditemukan');
        }

        $gambar1 = $judul_headers->gambar1 ? asset('storage/uploads/' . basename($judul_headers->gambar1)) : asset('storage/uploads/foto.png');
        $gambar2 = $judul_headers->gambar2 ? asset('storage/uploads/' . basename($judul_headers->gambar2)) : asset('storage/uploads/foto.png');

        $pengurus_barang = PejabatPengadaan::first();

        $pdf = new MYPDF();

        // Set informasi dokumen
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nama Penulis');
        $pdf->SetTitle('Laporan RKBU');
        $pdf->SetSubject('Laporan RKBU');
        $pdf->SetKeywords('TCPDF, PDF, RKBU, example');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->SetFont('helvetica', '', 7); // Set font utama

        // Mengatur ukuran kertas F4 secara manual (210 x 330 mm)
        $f4PageSize = [210, 330]; // Dimensi dalam mm (lebar x tinggi)

        // Mengatur margin halaman dan auto page break
        $pdf->SetMargins(15, 10, 15, 20);
        $pdf->SetHeaderMargin(10);
        $pdf->SetFooterMargin(10);
        $pdf->SetAutoPageBreak(true, 25); // Auto page break dengan margin bawah
        $pdf->setCellPaddings(1, 1, 1, 1); // Padding cell

        // Cek data judul headers dari database
        $judulHeaders = JudulHeader::first();

        // Cek dan atur gambar, gunakan gambar default jika tidak tersedia
        $gambar1 = $judulHeaders->gambar1 ? asset('storage/uploads/' . basename($judulHeaders->gambar1)) : asset('storage/uploads/foto.png');
        $gambar2 = $judulHeaders->gambar2 ? asset('storage/uploads/' . basename($judulHeaders->gambar2)) : asset('storage/uploads/foto.png');

        $nama_rumah_sakit = $judulHeaders->nama_rs;
        // Tambahkan halaman pertama
        $pdf->AddPage('P', $f4PageSize);

        // Buat konten HTML untuk tabel header
        $html = '<table lines="none" bgcolor="white">
                <thead>
               <tr bgcolor="#ffffff">
               <th  width="20%" align="left"><h4></h4>
                    <h6 align="top" style="line-height:11;"><img src="assets/foto_rs/jakarta.png" width="65" height="65"  ></h6>
               </th> 
               <th  width="70%" align="center">
               <h4 style="font-weight: normal; font-size:11px;">' . $judulHeaders->header1 . '</h4>
               <h5 style="font-weight: bold; font-size:12px; line-height:0;">' . $judulHeaders->header4 . '</h5>
               <h5 style="font-weight: bold; font-size:12px; line-height:1;">' . $judulHeaders->nama_rs . '</h5>
                    <h3 style="font-weight: normal; font-size:11px; line-height:0;" align="center">' . $judulHeaders->alamat_rs . '. Telepon : ' . $judulHeaders->tlp_rs . ' </h3>
                    <h3 style="font-weight: normal; font-size:11px; line-height:1;" align="center">Telp. ' . $judulHeaders->tlp_rs . ' Faksimile. ' . $judulHeaders->tlp_rs . '  </h3>
                    <h3 style="font-weight: normal; font-size:11px; line-height:0;" align="center">' . $judulHeaders->header3 . '</h3>
                    <h3 style="font-weight: normal; font-size:11px; line-height:1;" align="center">' . $judulHeaders->wilayah . '</h3>
               </th>
               <hr>
               </tr>
               <tr bgcolor="#ffffff">
               <th  width="90%" align="right">
               <h5 style="font-weight: normal; font-size:11px; line-height:1; align:right;">Kode Pos 14130</h5>
               </th>
               </tr>
               </thead>';
        $html .= '</table>';


        // Tambahkan header ke PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Tambahkan konten body dari view 'print_rkbu_modal_kantor'
        $htmlBody = view('asset.pdf_sptjm_pengguna_asset', compact('invo', 'judulHeaders', 'pengurus_barang'))->render();

        // Tuliskan konten body ke PDF
        $pdf->writeHTML($htmlBody, true, false, true, false, '');


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
