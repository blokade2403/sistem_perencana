<h6 class="text-center mb-3 bg-label-success" style="padding: 10px 20px; font-size: 16px;">
    Data Pembayaran SPJ
</h6>
<div class="col-xl-12 col-lg-12 col-md-6">
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-start">
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
                    <span>Pembayaran SPJ</span>
                  </h5>
                  <div class="client-info">
                    <span class="fw-semibold">di update oleh: </span><span class="text-body">{{$master_spj->nama_validasi_keuangan}}</span>
                  </div>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <sup class="h5 pricing-currency mt-3 mb-0 me-1 text-primary">Rp</sup>
            <h1 class="fw-bold display-3 mb-0 text-primary">{{number_format($master_spj->pembayaran) ?? '0'}}</h1>
            <sub class="h5 pricing-duration mt-auto mb-2 fw-normal">/<span class="text-danger">{{$master_spj->status_hutang}}</span></sub>
          </div>
        </div>
        
      </div>
      <div class="card-body">
        <div class="d-flex align-items-center flex-wrap">
          <div class="bg-label-warning px-2 py-1 rounded-2 me-auto mb-3">
            <p class="mb-1 fw-semibold text-heading">
              Tanggal Pembayaran : {{$tgl_pembayaran ?? 'Tanggal belum di Update'}}
            </p>
          </div>
         
        </div>
        <h5 class="card-header">Detail Pembayaran</h5>
    <div class="card-body">
      <div class="row">
        <div class="col-xl-6 order-1 order-xl-0">
          <table>
            <tbody>
                <tr>
                    <td class="pe-3 fw-medium">Total Bruto</td>
                    <td>:</td>
                    <td>Rp. {{number_format($master_spj->bruto) ?? 'null'}}</td>
                </tr>
                <tr>
                    <td class="pe-3 fw-medium">Harga Dasar</td>
                    <td>:</td>
                    <td>Rp. {{number_format($master_spj->harga_dasar) ?? 'null'}}</td>
                </tr>
                <tr>
                    <td class="pe-3 fw-medium">PPN</td>
                    <td>:</td>
                    <td>{{$master_spj->ppn ?? 'null'}}</td>
                </tr>
                <tr>
                    <td class="pe-3 fw-medium">No DPA</td>
                    <td>:</td>
                    <td>{{$master_spj->no_dpa ?? 'null'}}</td>
                </tr>
                <tr>
                  <td class="pe-3 fw-medium"></td>
                  <td></td>
                  <td></td>
              </tr>
                
                <tr>
                  <td class="pe-3 fw-medium">Dokumen SPJ 1</td>
                  <td>:</td>
                  <td>
                      @if ($master_spj->upload_spj_1)
                          <a href="{{ asset('storage/' . $master_spj->upload_spj_1) }}" target="_blank" class="text-primary">
                              Lihat Dokumen
                          </a>
                      @else
                          <span class="text-danger">Tidak Ada Dokumen</span>
                      @endif
                  </td>
              </tr>
              <tr>
                  <td class="pe-3 fw-medium">Dokumen SPJ 2</td>
                  <td>:</td>
                  <td>
                      @if ($master_spj->upload_spj_2)
                          <a href="{{ asset('storage/' . $master_spj->upload_spj_2) }}" target="_blank" class="text-primary">
                              Lihat Dokumen
                          </a>
                      @else
                          <span class="text-danger">Tidak Ada Dokumen</span>
                      @endif
                  </td>
              </tr>
              
            </tbody>
        </table>
        </div>
        <div class="col-xl-6 order-0 order-xl-0">
          <div class="alert alert-warning mb-4" role="alert">
              <h6 class="alert-heading mb-1">Bukti Pembayaran</h6>
          </div>
          @php
              $bukti_bayar_path = $master_spj->bukti_bayar 
                  ? asset('storage/spjs/bukti_bayar/' . basename($master_spj->bukti_bayar)) 
                  : null;
              $is_pdf = $bukti_bayar_path && Str::endsWith($bukti_bayar_path, '.pdf'); // Cek apakah file adalah PDF
              $default_image = asset('assets/img/products/no_image.png');
              $foto_url_1 = $is_pdf ? null : ($bukti_bayar_path ?? $default_image);
          @endphp
      
          @if ($is_pdf)
              <div class="plan-statistics">
                  <div class="d-flex justify-content-center align-items-center">
                      <a href="{{ $bukti_bayar_path }}" target="_blank" class="btn btn-warning">
                          <i class="mdi mdi-file-pdf"></i> Lihat PDF
                      </a>
                  </div>
              </div>
          @else
              <div class="plan-statistics">
                  <div class="d-flex justify-content-center align-items-center">
                      <a href="{{ $foto_url_1 }}" target="_blank">
                          <img 
                              src="{{ $foto_url_1 }}" 
                              alt="Foto Bukti Pembayaran" 
                              width="220" 
                              height="220" 
                              class="d-block w-px-120 h-px-120 rounded" 
                          />
                      </a>
                  </div>
              </div>
          @endif
      </div>
      
        <div class="col-12 order-2 order-xl-0">
          <button
            class="btn btn-primary me-2 my-2"
            data-bs-toggle="modal"
            data-bs-target="#upgradePlanModal">
            {{$master_spj->status_pembayaran}}
          </button>
          <button class="btn btn-outline-danger cancel-subscription">Sisa Pembayaran : Rp. {{number_format($master_spj->sisa_pembayaran) ?? 'null'}}</button>
        </div>
      </div>
    </div>
      </div>
      <div class="card-body border-top">
        <div class="progress mb-3 rounded rounded" style="height: 8px">
          <div
            class="progress-bar rounded"
            role="progressbar"
            style="width: 100%"
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
