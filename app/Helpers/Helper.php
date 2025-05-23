<?php

if (!function_exists('terbilang')) {
    /**
     * Fungsi untuk mengubah angka menjadi huruf (terbilang)
     *
     * @param int $jumlah
     * @return string
     */
    function terbilang($jumlah)
    {
        $angka = array(
            0 => '',
            1 => 'Satu',
            2 => 'Dua',
            3 => 'Tiga',
            4 => 'Empat',
            5 => 'Lima',
            6 => 'Enam',
            7 => 'Tujuh',
            8 => 'Delapan',
            9 => 'Sembilan',
            10 => 'Sepuluh',
            11 => 'Sebelas',
            12 => 'Dua Belas',
            13 => 'Tiga Belas',
            14 => 'Empat Belas',
            15 => 'Lima Belas',
            16 => 'Enam Belas',
            17 => 'Tujuh Belas',
            18 => 'Delapan Belas',
            19 => 'Sembilan Belas',
            20 => 'Dua Puluh'
        );

        if ($jumlah < 21) {
            return $angka[$jumlah];
        } elseif ($jumlah < 100) {
            return $angka[intval($jumlah / 10)] . ' Puluh ' . terbilang($jumlah % 10);
        } elseif ($jumlah < 200) {
            return 'Seratus ' . terbilang($jumlah - 100);
        } elseif ($jumlah < 1000) {
            return terbilang(intval($jumlah / 100)) . ' Ratus ' . terbilang($jumlah % 100);
        } elseif ($jumlah < 2000) {
            return 'Seribu ' . terbilang($jumlah - 1000);
        } elseif ($jumlah < 1000000) {
            return terbilang(intval($jumlah / 1000)) . ' Ribu ' . terbilang($jumlah % 1000);
        } elseif ($jumlah < 1000000000) {
            return terbilang(intval($jumlah / 1000000)) . ' Juta ' . terbilang($jumlah % 1000000);
        } elseif ($jumlah < 1000000000000) {
            return terbilang(intval($jumlah / 1000000000)) . ' Miliar ' . terbilang($jumlah % 1000000000);
        } else {
            return 'Angka terlalu besar';
        }
    }
}

if (!function_exists('formatTanggal')) {
    function formatTanggal($tanggal)
    {
        if (!$tanggal || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggal)) {
            return 'Tanggal tidak valid';
        }

        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $tanggalArray = explode('-', $tanggal); // Pisahkan tahun, bulan, tanggal
        $tahun = $tanggalArray[0];
        $bulanAngka = (int)$tanggalArray[1];
        $hari = $tanggalArray[2];

        return $hari . ' ' . $bulan[$bulanAngka] . ' ' . $tahun;
    }
}


if (!function_exists('terbilangUang')) {
    function terbilangUang($angka)
    {
        $angka = abs($angka);
        $satuan = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"];
        $terbilang = "";

        if ($angka < 12) {
            $terbilang = $satuan[$angka];
        } elseif ($angka < 20) {
            $terbilang = $satuan[$angka - 10] . " Belas";
        } elseif ($angka < 100) {
            $terbilang = $satuan[floor($angka / 10)] . " Puluh " . terbilangUang($angka % 10);
        } elseif ($angka < 200) {
            $terbilang = "Seratus " . terbilangUang($angka - 100);
        } elseif ($angka < 1000) {
            $terbilang = $satuan[floor($angka / 100)] . " Ratus " . terbilangUang($angka % 100);
        } elseif ($angka < 2000) {
            $terbilang = "Seribu " . terbilangUang($angka - 1000);
        } elseif ($angka < 1000000) {
            $terbilang = terbilangUang(floor($angka / 1000)) . " Ribu " . terbilangUang($angka % 1000);
        } elseif ($angka < 1000000000) {
            $terbilang = terbilangUang(floor($angka / 1000000)) . " Juta " . terbilangUang($angka % 1000000);
        } elseif ($angka < 1000000000000) {
            $terbilang = terbilangUang(floor($angka / 1000000000)) . " Milyar " . terbilangUang(fmod($angka, 1000000000));
        } elseif ($angka < 1000000000000000) {
            $terbilang = terbilangUang(floor($angka / 1000000000000)) . " Triliun " . terbilangUang(fmod($angka, 1000000000000));
        }

        return trim($terbilang);
    }

    function formatTerbilangUang($angka)
    {
        return terbilangUang($angka) . " Rupiah";
    }

    function formatTanggalIndonesia($tanggal)
    {
        // Array nama hari dan bulan
        $namaHari = [
            'Minggu',
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu'
        ];
        $namaBulan = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        // Fungsi untuk mengubah angka menjadi teks
        function angkaKeTeks($angka)
        {
            $teks = [
                0 => 'Nol',
                1 => 'Satu',
                2 => 'Dua',
                3 => 'Tiga',
                4 => 'Empat',
                5 => 'Lima',
                6 => 'Enam',
                7 => 'Tujuh',
                8 => 'Delapan',
                9 => 'Sembilan'
            ];

            if ($angka < 10) {
                return $teks[$angka];
            } elseif ($angka < 20) {
                return $teks[$angka - 10] . ' Belas';
            } elseif ($angka < 100) {
                return angkaKeTeks((int)($angka / 10)) . ' Puluh' . (($angka % 10 != 0) ? ' ' . $teks[$angka % 10] : '');
            }

            return $angka; // Untuk angka di atas 99
        }

        // Ubah tanggal menjadi timestamp
        $timestamp = strtotime($tanggal);

        // Ambil informasi hari, tanggal, bulan, dan tahun
        $hari = $namaHari[date('w', $timestamp)];
        $tanggal = (int)date('d', $timestamp);
        $bulan = $namaBulan[(int)date('m', $timestamp) - 1];
        $tahun = (int)date('Y', $timestamp);

        // Konversi tanggal ke teks
        $tanggalTeks = angkaKeTeks($tanggal);

        // Konversi tahun ke teks (pastikan urutannya benar)
        $tahunTeks = 'Dua Ribu'; // Bagian pertama adalah "Dua Ribu"
        $tahunBelakang = (int)substr($tahun, 2); // Ambil dua digit terakhir
        if ($tahunBelakang > 0) {
            $tahunTeks .= ' ' . angkaKeTeks($tahunBelakang); // Tambahkan dua digit terakhir jika tidak nol
        }

        // Format final
        return "$hari tanggal $tanggalTeks bulan $bulan tahun $tahunTeks";
    }
}
