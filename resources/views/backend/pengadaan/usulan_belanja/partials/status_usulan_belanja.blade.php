<ul class="timeline card-timeline mb-0">
    @if (!empty($key['status_usulan_barang'] == 'Selesai'))
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-primary"></span>
            <div class="">
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-primary">
                        <small class="mb-2 fw-2">Perlu Validasi Perencana: {{ $key->created_at }}</small>
                    </span>
                </div>
            </div>
        </li>
    @endif

    @if ($key['status_validasi_perencana'] == 'Disetujui Perencana')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-warning"></span>
            <div class="">
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-warning">
                        <small class="mb-2 fw-2">Validasi Perencana: {{ $key['tgl_validasi_perencana'] }}</small>
                    </span>
                </div>
            </div>
        </li>
    @elseif ($key['status_validasi_perencana'] == 'Di Tolak')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-danger"></span>
            <div class="">
                <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $key['keterangan_perencana'] }}">
                    <span class="badge bg-label-danger">
                        <small class="mb-2 fw-2">Ditolak Perencana: {{ $key['tgl_validasi_perencana'] }}</small>
                    </span>
                </a>
            </div>
        </li>
    @endif

    @if ($key['status_validasi_kabag'] == 'Validasi Kabag')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-info"></span>
            <div class="">
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-info">
                        <small class="mb-2 fw-2">Validasi Kabag/Kabid: {{ $key['tgl_validasi_kabag'] }}</small>
                    </span>
                </div>
            </div>
        </li>
    @elseif ($key['status_validasi_kabag'] == 'Di Tolak')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-danger"></span>
            <div class="timeline-header mb-1">
                <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $key['keterangan_kabag'] }}">
                    <span class="badge bg-label-danger">
                        <small class="mb-2 fw-2">Ditolak Kabag/Kabid: {{ $key['tgl_validasi_kabag'] }}</small>
                    </span>
                </a>
            </div>
        </li>
    @endif

    @if ($key['status_validasi_direktur'] == 'Validasi Direktur')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-success"></span>
            <div class="">
                <div class="timeline-header mb-1">
                    <span class="badge bg-label-success">
                        <small class="mb-2 fw-2">Validasi Direktur: {{ $key['tgl_validasi_direktur'] }}</small>
                    </span>
                </div>
            </div>
        </li>
    @elseif ($key['status_validasi_direktur'] == 'Di Tolak')
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-danger"></span>
            <div class="timeline-header mb-1">
                <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $key['keterangan_direktur'] }}">
                    <span class="badge bg-label-danger">
                        <small class="mb-2 fw-2">Ditolak Direktur: {{ $key['tgl_validasi_direktur'] }}</small>
                    </span>
                </a>
            </div>
        </li>
    @endif
</ul>