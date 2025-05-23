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
          <div class="bg-label-warning px-2 py-1 rounded-2 me-auto mb-3">
            <p class="mb-1 fw-semibold text-heading">
              Tanggal BAST : {{$tgl_bast ?? 'Tanggal belum di Update'}}
            </p>
          </div>
         
        </div>
        <div class="my-3">
            <table>
                <tbody>
                    <tr>
                        <td class="pe-3 fw-medium">No BA Pemeriksaan Pekerjaan</td>
                        <td>:</td>
                        <td>{{$master_spj->no_ba_bp ?? 'null'}}</td>
                    </tr>
                    <tr>
                        <td class="pe-3 fw-medium">No BA Serah Terima Pekerjaan</td>
                        <td>:</td>
                        <td>{{$master_spj->no_ba ?? 'null'}}</td>
                    </tr>
                    <tr>
                        <td class="pe-3 fw-medium">No BA Pemeriksaan Barang/ Pekerjaan</td>
                        <td>:</td>
                        <td>{{$master_spj->no_ba_hp ?? 'null'}}</td>
                    </tr>
                    <tr>
                        <td class="pe-3 fw-medium">No DPA</td>
                        <td>:</td>
                        <td>{{$master_spj->no_dpa ?? 'null'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
      <div class="card-body border-top">
        <div class="progress mb-3 rounded rounded" style="height: 8px">
          <div
            class="progress-bar rounded"
            role="progressbar"
            style="width: 95%"
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
            <small class="text-muted"><a href="{{route('bast_pk.downloadPDF_BAST_PK', $master_spj->id_master_spj)}}"><i class="mdi mdi-download-outline mdi-24px me-2"></i> Download BAST Pemeriksa Pekerjaan</a></small>
          </div>
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
              </li>
              <li></li>
            </ul>
          </div>
          <div class="ms-auto">
            <small class="text-muted"><a href="{{route('bast_bp.downloadPDF_BAST_BP', $master_spj->id_master_spj)}}"><i class="mdi mdi-download-outline mdi-24px me-2"></i> Download BAST Barang / Pekerjaan</a></small>
          </div>
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
              </li>
              <li></li>
            </ul>
          </div>
          <div class="ms-auto">
            <small class="text-muted"><a href="{{route('bast_hp.downloadPDF_BAST_HP', $master_spj->id_master_spj)}}"><i class="mdi mdi-download-outline mdi-24px me-2"></i> Download BAST Hasil Pekerjaan</a></small>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="d-flex justify-content-between flex-wrap">
    <div class="my-3">
      
    </div>
</div>