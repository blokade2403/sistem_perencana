
<ul class="timeline card-timeline mb-0">
    @if (!empty($key->status_proses_pesanan) == 'Selesai')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-primary"></span>
            <div>
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-primary">
                        <small class="mb-2 fw-2">Pemesanan Barang : {{ $key->tgl_proses_pemesanan}}</small>
                    </span>
                </div>
            </div>
        </li>
    @else
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-primary"></span>
            <div>
                <div class="timeline-header mb-1">
                    <span class="badge bg-primary">
                        <small class="mb-2 fw-2">Proses Pengadaan Barang</small>
                    </span>
                </div>
            </div>
        </li>
    @endif

    @if (($key->status_proses_pengiriman_barang) == 'Selesai')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-info"></span>
            <div>
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-info">
                        <small class="mb-2 fw-2">Proses Pengiriman Barang : {{ $key->tgl_barang_datang}}</small>
                    </span>
                </div>
            </div>
        </li>
    @endif

    @if (($key->status_verifikasi_pengurus_barang) == 'Selesai')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-warning"></span>
            <div>
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-warning">
                        <small class="mb-2 fw-2">Verifikasi Pengurus Barang : {{ $key->tgl_verif_pengurus_barang}}</small>
                    </span>
                </div>
            </div>
        </li>
    @elseif(($key->status_verifikasi_pengurus_barang) == 'Revisi')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-warning"></span>
            <div>
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-danger">
                        <small>Revisi Pengurus Barang : {{ $key->tgl_verif_pengurus_barang }}</small>
                    </span>
                    <small><a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ket Revisi : {{$key->keterangan_verif_pengurus_barang}}"><i class="mdi mdi-account-alert" style="color: red;"></i> </a></small>
                </div>
            </div>
        </li>
    @endif


    @if (($key->status_proses_bast) == 'Selesai')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-secondary"></span>
            <div>
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-secondary">
                        <small class="mb-2 fw-2">Proses BAST : {{ $key->tgl_bast }}</small>
                    </span>
                </div>
            </div>
        </li>
    @endif

    @if (($key->status_proses_tukar_faktur) == 'Selesai')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-warning"></span>
            <div>
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-warning">
                        <small class="mb-2 fw-2">Proses Tukar Faktur : {{ $key->tgl_proses_faktur }}</small>
                    </span>
                </div>
            </div>
        </li>
    @endif

    @if (($key->status_verifikasi_ppbj) == 'Selesai')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-warning"></span>
            <div>
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-warning">
                        <small class="mb-2 fw-2">Proses Verifikasi PPBJ : {{ $key->tgl_verif_ppbj }}</small>
                    </span>
                </div>
            </div>
        </li>
        @elseif(($key->status_verifikasi_ppbj) == 'Revisi')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-warning"></span>
            <div>
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-danger">
                        <small>Revisi PPBJ : {{ $key->tgl_verif_ppbj }}</small>
                    </span>
                    <small><a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ket Revisi : {{$key->ket_verif_ppbj}}"><i class="mdi mdi-account-alert" style="color: red;"></i> </a></small>
                </div>
            </div>
        </li>
    @endif

    @if (($key->status_verifikasi_ppk) == 'Selesai')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-warning"></span>
            <div>
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-warning">
                        <small class="mb-2 fw-2">Proses Verifikasi PPK : {{ $key->tgl_verif }}</small>
                    </span>
                </div>
            </div>
        </li>
        @elseif(($key->status_verifikasi_ppk) == 'Revisi')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-warning"></span>
            <div>
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-danger">
                        <small>Revisi PPK : {{ $key->tgl_verif }}</small>
                    </span>
                    <small><a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ket Revisi : {{$key->ket_verif_ppk}}"><i class="mdi mdi-account-alert" style="color: red;"></i> </a></small>
                </div>
            </div>
        </li>
    @endif

    @if (($key->status_verifikasi_pptk) == 'Selesai')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-warning"></span>
            <div>
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-warning">
                        <small class="mb-2 fw-2">Proses Verifikasi PPTK : {{ $key->tgl_verif_pptk }}</small>
                    </span>
                </div>
            </div>
        </li>
        @elseif(($key->status_verifikasi_pptk) == 'Revisi')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-warning"></span>
            <div>
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-danger">
                        <small>Revisi PPTK : {{ $key->tgl_verif_pptk }}</small>
                    </span>
                    <small><a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ket Revisi : {{$key->ket_verif_verifikator}}"><i class="mdi mdi-account-alert" style="color: red;"></i> </a></small>
                </div>
            </div>
        </li>
    @endif

    @if (($key->status_verifikasi_verifikator) == 'Selesai')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-warning"></span>
            <div>
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-warning">
                        <small class="mb-2 fw-2">Proses Verifikator : {{ $key->tgl_verif_verifikator }}</small>
                    </span>
                </div>
            </div>
        </li>
    @endif

    @if (($key->status_verifikasi_ppk_keuangan) == 'Selesai')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-warning"></span>
            <div>
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-warning">
                        <small class="mb-2 fw-2">Proses PPK Keuangan: {{ $key->tgl_verif_ppk_keuangan }}</small>
                    </span>
                </div>
            </div>
        </li>
        @elseif(($key->status_verifikasi_ppk_keuangan) == 'Revisi')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-warning"></span>
            <div>
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-danger">
                        <small>Revisi PPK Keuangan : {{ $key->tgl_verif_ppk_keuangan }}</small>
                    </span>
                    <small><a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ket Revisi : {{$key->ket_verif_ppk_keuangan}}"><i class="mdi mdi-account-alert" style="color: red;"></i> </a></small>
                </div>
            </div>
        </li>
    @endif
    

    @if (($key->status_verifikasi_direktur) == 'Selesai')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-success"></span>
            <div>
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-success">
                        <small class="mb-2 fw-2">Proses Verif Direktur : {{ $key->tgl_verif_direktur }}</small>
                    </span>
                </div>
            </div>
        </li>
        @elseif(($key->status_verifikasi_direktur) == 'Revisi')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-warning"></span>
            <div>
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-danger">
                        <small>Revisi Verif Direktur : {{ $key->tgl_verif_direktur }}</small>
                    </span>
                    <small><a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ket Revisi : {{$key->ket_verif_direktur}}"><i class="mdi mdi-account-alert" style="color: red;"></i> </a></small>
                </div>
            </div>
        </li>
    @endif
       

    @if (($key->status_serah_terima_bendahara) == 'Selesai')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-success"></span>
            <div>
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-success">
                        <small class="mb-2 fw-2">Serah Terima SPJ Bendahara : {{ $key->tanggal_penyerahan_spj }}</small>
                    </span>
                </div>
            </div>
        </li>
    @elseif (($key->status_serah_terima_bendahara) == 'Revisi')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-success"></span>
            <div>
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-success">
                        <small class="mb-2 fw-2">Serah Terima SPJ Bendahara : {{ $key->tanggal_revisi_spj }}</small>
                    </span>
                </div>
            </div>
        </li>
    @endif

    @if (($key->status_pembayaran) == 'Sudah di Bayar')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-success"></span>
            <div>
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-success">
                        <small class="mb-2 fw-2">Sudah Dibayar: {{ $key->tanggal_pembayaran }}</small>
                    </span>
                </div>
            </div>
        </li>
    @endif
</ul>