<h6 class="text-center mb-3 bg-label-success" style="padding: 10px 20px; font-size: 16px;">
    Data SPJ Pesanan Barang
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
                  <span>SPJ Pesanan Barang</span>
                </h5>
                <div class="client-info">
                  <span class="fw-semibold">di update oleh: </span><span class="text-body">{{$detail_master_spj->user->nama_lengkap}}</span>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex align-items-center flex-wrap">
          <div class="bg-lighter px-2 py-1 rounded-2 me-auto mb-3">
            <p class="mb-1 fw-semibold text-heading">
              Rp. {{number_format($get_total)}} <span class="text-muted fw-normal"></span>
            </p>
            <span class="text-muted">Total Budget</span>
          </div>
          <div class="text-end mb-3">
            <p class="mb-1 text-heading fw-semibold">
              Start Date: <span class="text-muted fw-normal">{{$tgl_pesanan}}</span>
            </p>
            <p class="mb-1 text-heading fw-semibold">
              Deadline: <span class="text-muted fw-normal">{{$tgl_pekerjaan}}</span>
            </p>
          </div>
        </div>
        <div class="my-3">
            <table>
                <tbody>
                    <tr>
                        <td class="pe-3 fw-medium">Uraian Belanja</td>
                        <td>:</td>
                        <td>{{$master_spj->rincian_belanja}}</td>
                    </tr>
                    <tr>
                        <td class="pe-3 fw-medium">ID Paket</td>
                        <td>:</td>
                        <td>{{$master_spj->idpaket}}</td>
                    </tr>
                    <tr>
                        <td class="pe-3 fw-medium">No. Surat Pesanan</td>
                        <td>:</td>
                        <td>{{$master_spj->no_surat_pesanan}}</td>
                    </tr>
                    <tr>
                        <td class="pe-3 fw-medium">Tanggal Surat Pesanan</td>
                        <td>:</td>
                        <td>{{$tgl_pesanan}}</td>
                    </tr>
                    <tr>
                        <td class="pe-3 fw-medium">Tanggal Penyelesaian Pekerjaan</td>
                        <td>:</td>
                        <td>{{$tgl_pekerjaan}}</td>
                    </tr>
                    <tr>
                        <td class="pe-3 fw-medium">Pendukung PPK</td>
                        <td>:</td>
                        <td>{{$master_spj->adminPendukung->nama_pendukung_ppk}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="mb-0">
        </p>
      </div>
      <div class="card-body border-top">
        <div class="d-flex align-items-center mb-3">
          <p class="mb-1 text-heading fw-semibold">
            Jadwal Pekerjaan: <span class="text-muted fw-normal"></span>
          </p>
          <span class="badge bg-label-warning ms-auto rounded-pill">{{$jumlah_hari_terbilang}} Hari</span>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-1">
          <small class="text-muted">Task: 12/90</small>
          <small class="text-muted">42% Completed</small>
        </div>
        <div class="progress mb-3 rounded rounded" style="height: 8px">
          <div
            class="progress-bar rounded"
            role="progressbar"
            style="width: 42%"
            aria-valuenow="42"
            aria-valuemin="0"
            aria-valuemax="100"></div>
        </div>
        <div class="d-flex align-items-center">
          <div class="d-flex align-items-center">
            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0 zindex-2">
              <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                title="Kaith D'souza"
                class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="../../assets/img/avatars/15.png" alt="Avatar" />
              </li>
              <li><small class="text-muted">di update oleh : {{$detail_master_spj->user->nama_lengkap}}</small></li>
            </ul>
          </div>
          <div class="ms-auto">
            <small class="text-muted"><a href="{{route('spj_surat_pesanan.downloadPDF_Spj_surat_pesanan', $master_spj->id_master_spj)}}"><i class="mdi mdi-download-outline mdi-24px me-2"></i> Download Surat Pesanan</a></small>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="d-flex justify-content-between flex-wrap">
    <div class="my-3">
      
    </div>
</div>