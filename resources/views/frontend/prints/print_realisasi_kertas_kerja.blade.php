
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rencana Bisnis Anggaran (RBA)</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    
    <link rel="stylesheet" href="{{asset("assets/vendor/libs/sweetalert2/sweetalert2.css")}}" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{asset("assets/vendor/fonts/materialdesignicons.css")}}" />
    <link rel="stylesheet" href="{{asset("assets/vendor/fonts/fontawesome.css")}}" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .header p {
            margin: 0;
        }

        .info {
            margin-bottom: 20px;
        }

        .info table {
            width: 100%;
        }

        .info td {
            vertical-align: top;
        }

        .total-anggaran {
            text-align: right;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            page-break-inside: avoid;
            padding : 3px;
        }

        table, tr, th, td {
            page-break-inside: avoid;
            white-space: nowrap;
        }

        .table-data th, .table-data td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 6px;
            border: 0.2 px solid black;
        }

        .table-data td center {
            font-size: 20px;
        }

        .table-data th {
            text-align: left; /* Posisi default tetap di kiri */
            background-color: #f2f2f2;
        }

        thead {
            display: table-header-group;
        }

        thead th, tbody td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
            font-size: 4px;
        }

        .sub-header {
            font-weight: bold;
            background-color: #f2f2f2;
            text-align: left;
        }

        .sub-header-child {
            font-weight: bold;
            background-color: #ffffff;
            text-align: left;
        }

        .sub-header-parent {
            background-color: #ffffff;
            text-align: left;
        }

        .spek{
            font-size: 6px; /* Kamu bisa menyesuaikan ukuran font */
            background-color: #ffffff;
            font-style: italic; /* Menjadikan teks miring */
        }

        .jenis{
            font-size: 6px; /* Kamu bisa menyesuaikan ukuran font */
            background-color: #bdb9b9;
            font-style: italic; /* Menjadikan teks miring */
        }

        .kategori{
            font-size: 6px; /* Kamu bisa menyesuaikan ukuran font */
            background-color: #f3ecec;
            font-style: italic; /* Menjadikan teks miring */
        }

        /* Footer Styling */
        footer {
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 12px;
            border-top: 1px solid #ccc;
            padding: 10px 0;
            background-color: #f2f2f2;
        }

        .page-number:after {
            content: counter(page);
        }

        @media print {
            footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                font-size: 6px;
                border-top: 1px solid #ccc;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header Section -->
    <div class="info">
        <table border="0" cellpadding="1" width="100%">
            <tr>
                <th width="15%" align="left">Program</th>
                <td width="80%" align="left">: {{ $kodeProgram }}. {{ $namaProgram }}</td>
            </tr>
            <tr>
                <th width="15%" align="left">Kegiatan</th>
                <td width="80%" align="left">: {{ $kodeKegiatan }}. {{ $namaKegiatan }}</td>
            </tr>
            <tr>
                <th width="15%" align="left">Sub Kegiatan</th>
                <td width="80%" align="left">: {{ $kodeSubKegiatan }}. {{ $namaSubKegiatan }}</td>
            </tr>
            <tr>
                <td colspan="2" height="10"></td> <!-- Baris ini memberikan jarak kosong -->
            </tr>
            <tr bgcolor="#ffffff">
                <th width="15%" align="left"><b>Indikator</b></th>
                <th  width="20%" align="center"></th>
                <th  width="20%" align="left"><b>Tolak Ukur Kinerja</b></th>
                <th  width="20%" align="center"></th>
                <th  width="15%" align="right"><b>Target Kinerja</b></th>
                <th  width="20%" align="left"></th>
           </tr>
            <tr bgcolor="#ffffff">
                <th width="15%" align="left">Input</th>
                <th  width="2%" align="center">:</th>
                <th  width="62%" align="left">Dana yang dibutuhkan</th>
                <th  width="15%" align="center"><h4>Rp. {{number_format($total_anggaran_blud, 0,',','.')}} ,-</h4></th>
                <th  width="6%" align="center"></th>
           </tr>
        </table>
    </div>
    <table class="table-data">
        <thead>
            <tr class="text-center">
                <th width="5%">No</th>
                <th width="25%">Kode Rekening</th>
                <th width="33%">Uraian</th>
                <th width="10%">Jumlah Anggaran</th>
                <th width="10%">Realisasi</th>
                <th width="7%">%</th>
                <th width="10%">Sisa Anggaran</th>
            </tr>
            <tr class="text-center">
                <th width="5%">1</th>
                <th width="25%">2</th>
                <th width="33%">3</th>
                <th width="10%">4</th>
                <th width="10%">5</th>
                <th width="7%">6</th>
                <th width="10%">7</th>
            </tr>
        </thead>
        
        <tbody>
            @php
            // Fungsi CheckPageBreak() eksternal untuk memeriksa margin halaman
            function checkPageBreak($pdf, $height) {
                // Mendapatkan posisi saat ini di halaman
                $currentY = $pdf->GetY();
                // Mendapatkan tinggi halaman
                $pageHeight = $pdf->getPageHeight();
                // Mendapatkan margin bawah
                $breakMargin = $pdf->getBreakMargin();
        
                // Jika posisi saat ini + tinggi konten lebih besar dari batas bawah, tambahkan halaman baru
                if ($currentY + $height > $pageHeight - $breakMargin) {
                    $pdf->AddPage();
                }
            }
            @endphp
            <!-- Looping Hierarki -->
            @foreach ($categories as $jenisBelanja)
                                    <tr class="jenis">
                                        <td colspan="2" width="63%" class="fs-14">
                                            <strong>{{ $jenisBelanja->kode_jenis_belanja }}. {{ $jenisBelanja->nama_jenis_belanja }}</strong>
                                        </td>
                                        <td style="text-align: right;" width="10%">
                                            <strong>{{ number_format($jenisBelanja->total_anggaran, 0, ',', ',') }}</strong>
                                        </td>
                                        <td style="text-align: right;" width="10%">
                                            {{ number_format($jenisBelanja->realisasi_anggaran ?? 0, 0, ',', ',') }}
                                        </td>
                                        <td style="text-align: right;" width="7%">
                                            @if($jenisBelanja->total_anggaran > 0)
                                            {{ number_format(($jenisBelanja->realisasi_anggaran / $jenisBelanja->total_anggaran) * 100, 2, ',', '.') }}%
                                        @else
                                            0%
                                        @endif
                                        </td>
                                        <td style="text-align: right;" width="10%">
                                            {{ number_format($jenisBelanja->total_anggaran - $jenisBelanja->realisasi_anggaran, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($jenisBelanja->jenis_kategori_rkbus as $JenisKategori)
                                        <tr class="kategori mb-1 mt-1">
                                            <td width="5%"></td>
                                            <td width="4%" class="text-center">{{$no++}}</td>
                                            <th colspan="2" width="54%">{{ $JenisKategori->kode_jenis_kategori_rkbu }}. {{ $JenisKategori->nama_jenis_kategori_rkbu }}</th>
                                            <td style="text-align: right;" width="10%">
                                                {{ number_format($JenisKategori->total_anggaran ?? 0, 0, ',', ',') }}
                                            </td>
                                            <td style="text-align: right;" width="10%">
                                               {{ number_format($JenisKategori->realisasi_anggaran, 0, ',', ',') }}
                                            </td>
                                            <td style="text-align: right;" width="7%">
                                                @if($JenisKategori->total_anggaran > 0)
                                                {{ number_format(($JenisKategori->realisasi_anggaran / $JenisKategori->total_anggaran) * 100, 2, ',', '.') }}%
                                            @else
                                                0%
                                            @endif
                                            </td>
                                            <td style="text-align: right;" width="10%">
                                                {{ number_format($JenisKategori->total_anggaran - $JenisKategori->realisasi_anggaran, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @php
                                    $no_child = 1;
                                    @endphp
                                    @foreach ($JenisKategori->obyek_belanjas as $ObyekBelanja)
                                        @foreach ($ObyekBelanja->kategori_rkbus as $KategoriRkbu)
                                            <tr class="mb-1 mt-1">
                                                <td width="5%"></td>
                                                <td width="4%"></td>
                                                <td width="4%" class="text-center">{{$no_child++}}</td>
                                                <th colspan="2" width="50%">{{ $KategoriRkbu->kode_kategori_rkbu }}. {{ $KategoriRkbu->nama_kategori_rkbu }}</th>
                                                <td style="text-align: right;" width="10%">
                                                    {{ number_format($KategoriRkbu->total_anggaran ?? 0, 0, ',', ',') }}
                                                </td>
                                                <td style="text-align: right;" width="10%">
                                                    {{ number_format($KategoriRkbu->realisasi_anggaran ?? 0, 0, ',', ',') }}
                                                </td>
                                                <td style="text-align: right;" width="7%">
                                                    @if($KategoriRkbu->total_anggaran > 0)
                                                        {{ number_format(($KategoriRkbu->realisasi_anggaran / $KategoriRkbu->total_anggaran) * 100, 2, ',', '.') }}%
                                                    @else
                                                        0%
                                                    @endif
                                                </td>
                                                <td style="text-align: right;" width="10%">
                                                    {{ number_format($KategoriRkbu->total_anggaran - $KategoriRkbu->realisasi_anggaran, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @php
                                        $no_children = 1;
                                        @endphp
                                        @foreach ($KategoriRkbu->sub_kategori_rkbus as $SubKategoriRkbu)
                                            <tr>
                                                <td width="5%"></td>
                                                <td width="4%"></td>
                                                <td width="4%"></td>
                                                <th class="text-left fa-14" width="50%">{{ $SubKategoriRkbu->kode_sub_kategori_rkbu }}. {{ $SubKategoriRkbu->nama_sub_kategori_rkbu }}</th>
                                                <td style="text-align: right;" width="10%">
                                                    {{ number_format($SubKategoriRkbu->total_anggaran ?? 0, 0, ',', ',') }}
                                                </td>
                                                <td style="text-align: right;" width="10%">
                                                    {{ number_format($SubKategoriRkbu->realisasi_anggaran ?? 0, 0, ',', ',') }}
                                                </td>
                                                <td style="text-align: right;" width="7%">
                                                    @if($SubKategoriRkbu->total_anggaran > 0)
                                                    {{ number_format(($SubKategoriRkbu->realisasi_anggaran / $SubKategoriRkbu->total_anggaran) * 100, 2, ',', '.') }}%
                                                    @else
                                                        0%
                                                    @endif
                                                </td>
                                                <td style="text-align: right;" width="10%">
                                                    {{ number_format($SubKategoriRkbu->total_anggaran - $SubKategoriRkbu->realisasi_anggaran, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
        </tbody>
    </table>
           
</div>
</body>
</html>
