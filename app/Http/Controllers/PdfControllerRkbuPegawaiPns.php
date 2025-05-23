<?php

namespace App\Http\Controllers;

use TCPDF;
use App\Pdf\MYPDF;
use App\Models\Rkbu;
use App\Models\JenisBelanja;
use App\Models\JudulHeader;
use Illuminate\Http\Request;
use App\Models\SubKategoriRkbu;
use App\Models\StatusValidasiRka;
use Illuminate\Support\Facades\Session;

class PdfControllerRkbuPegawaiPns extends Controller
{
    public function downloadPDF(Request $request)
    {
        // Ambil id_user dari session
        // dd(session('id_user'), session('tahun_anggaran'));
        $id_user = session('id_user');
        $tahunAnggaran = Session::get('tahun_anggaran');

        // Ambil sub kategori rkbu berdasarkan id_user dari session dan id_jenis_kategori_rkbu
        $sub_kategori_rkbus = SubKategoriRkbu::whereHas('rkbus', function ($query) use ($id_user) {
            $query->where('id_user', $id_user)
                ->whereHas('subKategoriRkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu', function ($query) {
                    $query->where('id_jenis_kategori_rkbu', '9cdfd329-6524-4d3f-aca5-93eade93046d');
                });
        })->get();

        $status_validasi_rka = StatusValidasiRka::all(); // Ambil status validasi dari model terkait

        // Ambil data rkbu berdasarkan filter sub_kategori_rkbu
        // Query dengan relasi dan filter yang dibutuhkan
        $query = Rkbu::with([
            'rekening_belanjas.aktivitas.sub_kegiatan.sumber_dana',
            'rekening_belanjas.aktivitas.sub_kegiatan.kegiatan.program',
            'subKategoriRkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu',
        ])
            ->where('id_user', session('id_user'))  // Filter berdasarkan id_user
            ->where('nama_tahun_anggaran', session('tahun_anggaran'))
            ->whereHas('subKategoriRkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu', function ($query) {
                // Filter berdasarkan id_jenis_kategori_rkbu
                $query->where('id_jenis_kategori_rkbu', '9cdfd329-6524-4d3f-aca5-93eade93046d');
            });

        // dd($query);

        // Cek apakah ada filter sub_kategori_rkbu yang dipilih
        if ($request->has('sub_kategori_rkbu') && $request->sub_kategori_rkbu != '') {
            $query->where('id_sub_kategori_rkbu', $request->sub_kategori_rkbu);
        }

        // Filter berdasarkan id_status_validasi_rka
        if ($request->has('id_status_validasi_rka') && $request->id_status_validasi_rka != '') {
            $query->where('id_status_validasi_rka', $request->id_status_validasi_rka);
        }

        // Dapatkan data rkbu
        $rkbus = $query->with([
            'rekening_belanjas.aktivitas.sub_kegiatan.kegiatan.program'
        ])->get();

        // Pastikan $rkbus ada dan tidak kosong
        if ($rkbus->isNotEmpty()) {
            // Ambil data program, kegiatan, dan sub kegiatan dengan pengecekan null yang lebih aman
            $firstRkbu = $rkbus->first();

            $namaProgram = optional($firstRkbu->rekening_belanjas->first()->aktivitas->sub_kegiatan->kegiatan->program)->nama_program ?? 'Nama Program Tidak Ada';
            $kodeProgram = optional($firstRkbu->rekening_belanjas->first()->aktivitas->sub_kegiatan->kegiatan->program)->kode_program ?? 'Kode Program Tidak Ada';

            $namaKegiatan = optional($firstRkbu->rekening_belanjas->first()->aktivitas->sub_kegiatan->kegiatan)->nama_kegiatan ?? 'Nama Kegiatan Tidak Ada';
            $kodeKegiatan = optional($firstRkbu->rekening_belanjas->first()->aktivitas->sub_kegiatan->kegiatan)->kode_kegiatan ?? 'Kode Kegiatan Tidak Ada';

            $namaSubKegiatan = optional($firstRkbu->rekening_belanjas->first()->aktivitas->sub_kegiatan)->nama_sub_kegiatan ?? 'Nama Sub Kegiatan Tidak Ada';
            $kodeSubKegiatan = optional($firstRkbu->rekening_belanjas->first()->aktivitas->sub_kegiatan)->kode_sub_kegiatan ?? 'Kode Sub Kegiatan Tidak Ada';
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

        // Ambil total anggaran berdasarkan id_user dari session
        $total_anggaran = Rkbu::where('id_user', $id_user)
            ->where('nama_tahun_anggaran', $tahunAnggaran)
            ->whereHas('subKategoriRkbu.kategori_rkbu.obyek_belanja.jenis_kategori_rkbu', function ($query) {
                // Filter berdasarkan id_jenis_belanja dan id_jenis_kategori_rkbu
                $query->where('id_jenis_belanja', '9cdfcfed-6061-485b-8e20-662a776d0d06')
                    ->where('id_jenis_kategori_rkbu', '9cdfd329-6524-4d3f-aca5-93eade93046d');
            })
            ->sum('total_anggaran');

        // Ambil hierarki berdasarkan rkbus yang tersedia
        $categories = JenisBelanja::whereHas('jenis_kategori_rkbus.obyek_belanjas.kategori_rkbus.sub_kategori_rkbus.rkbus', function ($query) use ($id_user, $tahunAnggaran) {
            // Filter di level rkbus
            $query->where('rkbus.id_user', $id_user)
                ->where('rkbus.nama_tahun_anggaran', $tahunAnggaran);
        })
            ->with([
                'jenis_kategori_rkbus' => function ($query) use ($id_user, $tahunAnggaran) {
                    // Filter pada jenis_kategori_rkbus berdasarkan rkbus
                    $query->whereHas('obyek_belanjas.kategori_rkbus.sub_kategori_rkbus.rkbus', function ($query) use ($id_user, $tahunAnggaran) {
                        $query->where('id_user', $id_user)
                            ->where('nama_tahun_anggaran', $tahunAnggaran);
                    });
                },
                'jenis_kategori_rkbus.obyek_belanjas' => function ($query) use ($id_user, $tahunAnggaran) {
                    // Filter pada obyek_belanjas berdasarkan rkbus
                    $query->whereHas('kategori_rkbus.sub_kategori_rkbus.rkbus', function ($query) use ($id_user, $tahunAnggaran) {
                        $query->where('id_user', $id_user)
                            ->where('nama_tahun_anggaran', $tahunAnggaran);
                    });
                },
                'jenis_kategori_rkbus.obyek_belanjas.kategori_rkbus' => function ($query) use ($id_user, $tahunAnggaran) {
                    // Filter pada kategori_rkbus berdasarkan rkbus
                    $query->whereHas('sub_kategori_rkbus.rkbus', function ($query) use ($id_user, $tahunAnggaran) {
                        $query->where('id_user', $id_user)
                            ->where('nama_tahun_anggaran', $tahunAnggaran)
                            ->where('id_jenis_kategori_rkbu', '9cdfd329-6524-4d3f-aca5-93eade93046d');
                    });
                },
                'jenis_kategori_rkbus.obyek_belanjas.kategori_rkbus.sub_kategori_rkbus' => function ($query) use ($id_user, $tahunAnggaran) {
                    // Filter pada sub_kategori_rkbus berdasarkan rkbus
                    $query->whereHas('rkbus', function ($query) use ($id_user, $tahunAnggaran) {
                        $query->where('id_user', $id_user)
                            ->where('nama_tahun_anggaran', $tahunAnggaran);
                    });
                },
                'jenis_kategori_rkbus.obyek_belanjas.kategori_rkbus.sub_kategori_rkbus.rkbus' => function ($query) use ($id_user, $tahunAnggaran) {
                    // Filter di level rkbus
                    $query->where('rkbus.id_user', $id_user)
                        ->where('rkbus.nama_tahun_anggaran', $tahunAnggaran);
                }
            ])
            ->where('id_jenis_belanja', '9cdfcfed-6061-485b-8e20-662a776d0d06') // Filter pada jenis belanja tertentu
            ->whereHas('jenis_kategori_rkbus', function ($query) {
                $query->where('id_jenis_kategori_rkbu', '9cdfd329-6524-4d3f-aca5-93eade93046d'); // Filter pada jenis kategori rkbu tertentu
            })
            ->get();

        // Inisialisasi TCPDF
        $pdf = new MYPDF();
        // Set informasi dokumen
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nama Penulis');
        $pdf->SetTitle('Laporan RKBU');
        $pdf->SetSubject('Laporan RKBU');
        $pdf->SetKeywords('TCPDF, PDF, RKBU, example');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->SetFont('', '', 9);
        $resolusi = array(240, 355);

        // Set font
        $pdf->SetFont('helvetica', '', 7);

        // Mengatur margin halaman
        $pdf->SetMargins(15, 10, 15);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(10);
        $pdf->SetAutoPageBreak(true, 25); // Auto page break dengan margin bawah
        $pdf->setCellPaddings(1, 1, 1, 1); // Padding cell agar tidak menempel ke tepi halaman

        // Cek dan tambahkan halaman baru jika diperlukan sebelum menulis konten
        $requiredSpace = 50; // Tentukan tinggi yang diperlukan untuk elemen ini (misal tabel)
        $pdf->PageBreak($requiredSpace); // Check for page break before adding new page

        // Tambah halaman
        $pdf->AddPage('L');


        $judulHeaders = JudulHeader::first();

        // Cek apakah gambar1 ada, jika tidak gunakan gambar alias
        $gambar1 = $judulHeaders->gambar1 ? asset('storage/uploads/' . basename($judulHeaders->gambar1)) : asset('storage/uploads/foto.png');

        // Cek apakah gambar2 ada, jika tidak gunakan gambar alias
        $gambar2 = $judulHeaders->gambar2 ? asset('storage/uploads/' . basename($judulHeaders->gambar2)) : asset('storage/uploads/foto.png');

        $rowHeight = 10; // Adjust the height of each row as needed

        // Buat konten HTML untuk PDF (border tabel diatur ke 0.5)
        $html = '<table lines="none" bgcolor="white">
               <tr bgcolor="#ffffff">
               <th  width="20%" align="left"><h4></h4>
                    <h6 align="center"><img src="' . $gambar2 . '" width="45" height="45"  ></h6>
               </th> 
               <th  width="60%" align="center">
                    <h3 align="center" style="font-size:9px; font-weight: bold;">' . $judulHeaders->header1 . '</h3>
                    <h3 style="font-weight: normal; font-size:8px; line-height:0;" align="center">' . $judulHeaders->nama_rs . '</h3>
                    <h3 align="center" style="font-size:8px; font-weight: normal;">' . $judulHeaders->header2 . '</h3>
                    <h3 style="font-weight: normal; font-size:8px; line-height:0;" align="center">TAHUN ANGGARAN ' . $tahunAnggaran . '</h3>
               </th>
               <th  width="20%" align="right"><h4></h4>
                    <h6 align="center"><img src="' . $gambar1 . '" width="75" height="45"  ></h6>
               </th> 
               </tr>
        </table>';

        $html .= view('frontend.prints.print_rkbu_pegawai_pns', compact('rkbus', 'sub_kategori_rkbus', 'status_validasi_rka', 'total_anggaran', 'categories', 'namaProgram', 'namaKegiatan', 'namaSubKegiatan', 'kodeProgram', 'kodeKegiatan', 'kodeSubKegiatan'))->render();

        // Write the content to PDF
        $pdf->writeHTML($html, true, false, true, false, '');
        // $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, false, true, 'J', true);
        // $pdf->MultiCell(0, 0, '...', 0, 'J', 0, 1, '', '', true);
        $pdf->Ln(); // Memindahkan ke baris baru


        // Tampilkan PDF sebagai preview di browser
        $pdf->Output('rkbu_data_preview.pdf', 'I');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
