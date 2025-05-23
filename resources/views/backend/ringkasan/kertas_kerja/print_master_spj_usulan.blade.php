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

        .text-center {
            text-align: center;
            font-size: 4px;
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
            <table border="0" cellspacing="1" cellpadding="1" width="100%">
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
            </table>
        </div>
            <table class="table-data">
                <thead>
                    <tr class="text-center">
                        <th width="4%" rowspan="2">No</th>
                        <th width="27%" rowspan="2">Rincian / Detail SPJ</th>
                        <th width="6%" rowspan="2">Jumlah</th>
                        <th colspan="4" width="28%">Uraian Koefisien</th> <!-- Menggabungkan 4 kolom untuk uraian koefisien -->
                        <th width="12%" rowspan="2">Harga Satuan</th>
                        <th width="10%" rowspan="2">PPN</th>
                        <th width="13%" rowspan="2">Jumlah Biaya</th>
                    </tr>
                    <tr>
                        <th width="4%">Vol.1</th>
                        <th width="10%">Uraian</th>
                        <th width="4%">Vol.2</th>
                        <th width="10%">Uraian</th>
                        <th colspan="2"></th> <!-- Kosongkan kolom setelah uraian koefisien -->
                    </tr>
                    <tr class="text-center">
                        <th width="4%">1</th>
                        <th width="27%">2</th>
                        <th width="6%">4=5x7</th>
                        <th width="4%">5</th>
                        <th width="10%">6</th>
                        <th width="4%">7</th>
                        <th width="10%">8</th>
                        <th width="12%">9</th>
                        <th width="10%">10</th>
                        <th width="13%">11=9x4+10</th>
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

            @foreach ($hierarchy as $subKategori)
                    <tr class="sub-header">
                        <td colspan="12" width="100%">{{ $subKategori['id_sub_kategori_rkbu'] }}</td>
                    </tr>
                    @foreach ($subKategori['details'] as $detail)
                    <tr class="sub-header-parent">
                        <td colspan="7" width="56%"><strong>No Usulan: {{ $detail['no_usulan_barang'] }}</strong></td>
                        <td colspan="4" width="31%"><strong>Status : {{ $detail['status_pembayaran'] ?? 'Proses SPJ' }}</strong></td>
                        <td colspan="4" width="13%" style="color: white; font-weight: bold; text-align:center; 
                            @if ($detail['status_hutang'] == 'Tahun Berjalan') background-color: green; 
                            @elseif ($detail['status_hutang'] == 'Hutang') background-color: red; 
                            @endif">
                            @if ($detail['status_hutang'] == 'Tahun Berjalan')  
                                Tahun Berjalan  
                            @elseif ($detail['status_hutang'] == 'Hutang')  
                                Hutang  
                            @endif
                        </td>
                    </tr>
                    <tr class="sub-header-parent">
                        <td colspan="12" width="100%">Rincian Belanja : {{ $detail['rincian_belanja'] }}</td>
                    </tr>
                    <tr class="sub-header-parent">
                        <td width="4%"></td>
                        <td width="96%" colspan="11">
                            <br/><span class="text-left">Nama Pengusul Barang: {{ $detail['nama_pengusul_barang'] }}</span>
                            <br/><span class="text-left">ID Perusahaan: {{ $detail['id_perusahaan'] }}</span>
                            <br/><span class="text-left">ID Paket: {{ $detail['idpaket'] }}</span>
                            <br/><span class="text-left">Pembayaran: Rp. {{ number_format($detail['pembayaran']) }}</span>
                            <br/><span class="text-left">Sisa Pembayaran: {{ $detail['sisa_pembayaran'] }}</span>
                        </td>
                    </tr>
                            @php
                            $itemrkbu = 1;
                            @endphp   
                            @foreach ($detail['items'] as $item)
                            <tr>
                                <td width="4%" class="text-center"></td>
                                <td width="4%" class="text-center">{{ $itemrkbu++ }}</td>
                                <td width="23%" class="text-center">{{ $item['id_rkbu'] }}</td>
                                <td width="6%" class="text-center">{{ $item['jumlah_usulan_barang'] }}</td>
                                <td width="4%" class="text-center">{{ $item['vol_1_detail'] }}</td>
                                <td width="10%" class="text-center">{{ $item['satuan_2_detail'] }}</td>
                                <td width="4%" class="text-center">{{ $item['vol_2_detail'] }}</td>
                                <td width="10%" class="text-center">{{ $item['satuan_2_detail'] }}</td>
                                <td width="12%" class="text-center">{{ number_format($item['harga_barang']) }}</td>
                                <td width="10%" class="text-center">{{ number_format($item['total_ppn']) }}</td>
                                <td width="13%" class="text-center">{{ number_format($item['total_anggaran_usulan_barang']) }}</td>
                            </tr>
                    @endforeach
            @endforeach
            @endforeach
        </tbody>
        </table>
</div>
</body>
</html>