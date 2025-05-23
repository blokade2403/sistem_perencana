<h6 class="text-center mb-3 bg-label-success" style="padding: 10px 20px; font-size: 16px;">
    Data SPJ Pengiriman Barang
</h6>
<div class="col-xl-12 col-lg-12 col-md-6">
    <div class="card">
      <div class="card-header">
        <div class="d-flex align-items-finish">
          <div class="d-flex align-items-finish">
            <div class="avatar me-3">
              <img
                src="../../assets/img/icons/brands/react-label.png"
                alt="Avatar"
                class="rounded-circle" />
            </div>
            <div class="me-2">
                <h5 class="mb-1">
                  <span>Pengiriman Barang</span>
                </h5>
                <div class="client-info">
                  <span class="fw-semibold">di update oleh: </span><span class="text-body">{{$master_spj->adminPendukung->nama_pendukung_ppk ?? '-'}}</span>
                </div>
            </div>
          </div>
        </div>
      </div>
      @php
      $foto_url_1 = $master_spj->foto_barang_datang ? asset('storage/spjs/barang_datang/' . basename($master_spj->foto_barang_datang)) : asset('assets/img/products/no_image.png');
      $foto_url_2 = $master_spj->foto_barang_datang_2 ? asset('storage/spjs/barang_datang/' . basename($master_spj->foto_barang_datang_2)) : asset('assets/img/products/no_image.png');
      $foto_url_3 = $master_spj->foto_barang_datang_3 ? asset('storage/spjs/barang_datang/' . basename($master_spj->foto_barang_datang_3)) : asset('assets/img/products/no_image.png');
      @endphp
      <div class="card-body">
        <div class="my-3">
            <div class="row">
                <div class="col-md-12 mt-5 mt-md-3">
                    <div class="added-cards">
                        <div class="cardMaster bg-lighter p-3 rounded mb-3">
                            <div class="d-flex justify-content-between flex-sm-row flex-column">
                                <!-- Foto Barang 1 -->
                                <div class="card-information me-2">
                                    <a href="{{ $foto_url_1 }}" target="_blank">
                                        <img src="{{ $foto_url_1 }}" alt="Foto Barang 1" width="120" height="120" class="d-block w-px-120 h-px-120 rounded" />
                                    </a>
                                </div>
                                <!-- Foto Barang 2 -->
                                <div class="card-information me-2">
                                    <a href="{{ $foto_url_2 }}" target="_blank">
                                        <img src="{{ $foto_url_2 }}" alt="Foto Barang 2" width="120" height="120" class="d-block w-px-120 h-px-120 rounded" />
                                    </a>
                                </div>
                                <!-- Foto Barang 3 -->
                                <div class="card-information me-2">
                                    <a href="{{ $foto_url_3 }}" target="_blank">
                                        <img src="{{ $foto_url_3 }}" alt="Foto Barang 3" width="120" height="120" class="d-block w-px-120 h-px-120 rounded" />
                                    </a>
                                </div>
                                <!-- Keterangan dan Tanggal -->
                                <div class="card-information me-5">
                                    <span class="fa-sm">Keterangan:</span><br />
                                    <span class="fa-sm">{{ $master_spj->keterangan_barang_datang ?? '-' }}</span><br /><br />
                                    <span class="fa-sm">Tanggal:</span><br />
                                    <span class="fa-sm">{{ formatTanggal($master_spj->tgl_barang_datang) ?? '-' }}</span><br />
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <h6>Keterangan Barang Pesanan :</h6>
                        </div>
                    </div>
            </div>
        </div>
        <p class="mb-0">
          {{$master_spj->keterangan_verif_pengurus_barang ?? 'Tidak Ada Keterangan'}}
        </p>
      </div>
      <div class="card-body border-top">
        <div class="d-flex align-items-center mb-3">
          <p class="mb-1 text-heading fw-semibold">
            Status Validasi Pengurus Barang: <span class="text-muted fw-normal"></span>
          </p>
          <span class="badge bg-label-warning ms-auto rounded-pill">{{$master_spj->status_verifikasi_pengurus_barang ?? 'Belum di Validasi'}}</span>
        </div>
        <div class="progress mb-3 rounded rounded" style="height: 8px">
          <div
            class="progress-bar rounded"
            role="progressbar"
            style="width: 82%"
            aria-valuenow="42"
            aria-valuemin="0"
            aria-valuemax="100"></div>
        </div>
      </div>
    </div>
</div>

<div class="d-flex justify-content-between flex-wrap">
    <div class="my-3">
    </div>
</div>