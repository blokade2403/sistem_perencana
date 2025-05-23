<div class="pb-3 rounded-top">
    <h4 class="text-center mb-2 bg-label-secondary">DETAIL RINCIAN RKBU</h4>
    <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="my-3">
                <table>
                    <tbody>
                        <tr>
                            <td class="pe-3 fw-medium">Kategori RKBU</td>
                            <td>:</td>
                            <td>{{ $rkbuBarangJasa->sub_kategori_rkbu->kategori_rkbu->kode_kategori_rkbu }}. {{ $rkbuBarangJasa->sub_kategori_rkbu->kategori_rkbu->nama_kategori_rkbu }}</td>
                        </tr>
                        <tr>
                            <td class="pe-3 fw-medium text-wrap">Sub Kategori RKBU</td>
                            <td>:</td>
                            <td>{{ $rkbuBarangJasa->sub_kategori_rkbu->kode_sub_kategori_rkbu }}. {{ $rkbuBarangJasa->sub_kategori_rkbu->nama_sub_kategori_rkbu }}</td>
                        </tr>
                        <tr>
                            <td class="pe-3 fw-medium">Pengusul</td>
                            <td>:</td>
                            <td>{{ $rkbuBarangJasa->users->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <td class="pe-3 fw-medium">Unit</td>
                            <td>:</td>
                            <td>{{ $rkbuBarangJasa->users->unit->nama_unit ?? 'Tidak ada unit' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-between flex-wrap">
            <div class="my-3">
                <table>
                    <tbody>
                        <tr>
                            <td class="pe-3 fw-medium">Total Anggaran</td>
                            <td>:</td>
                            <td><strong> Rp. {{ number_format($rkbuBarangJasa->total_anggaran, 0, ',', '.') }}</strong></td>
                        </tr>
                        <tr>
                            <td class="pe-3 fw-medium text-wrap"></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="my-3">
                <table>
                    <tbody>
                        <tr>
                            <td class="pe-3 fw-medium">Tanggal Input</td>
                            <td>:</td>
                            <td>
                                {{ $rkbuBarangJasa->created_at->locale('id')->isoFormat('D MMMM YYYY, HH:mm') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="pe-3 fw-medium text-wrap">Sumber Dana</td>
                            <td>:</td>
                            <td>
                                <span class="badge bg-secondary"> {{ $rkbuBarangJasa->rekening_belanjas->aktivitas->sub_kegiatan->sumber_dana->nama_sumber_dana }}</span>
                               </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table m-0">
            <thead class="table-light-primary bg-primary border-top">
                <tr>
                    <th>Item</th>
                    <th>Spesifikasi</th>
                    <th>Harga Satuan</th>
                    <th>Detail Vol</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-nowrap">{{ $rkbuBarangJasa->nama_barang }}</td>
                    <td class="text-wrap" style="width: 400px;">{{ $rkbuBarangJasa->spek }}</td>
                    <td>{{ number_format($rkbuBarangJasa->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $rkbuBarangJasa->vol_1 }} {{ $rkbuBarangJasa->satuan_1 }} x {{ $rkbuBarangJasa->vol_2 }} {{ $rkbuBarangJasa->satuan_2 }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-end">
                        <p class="mb-1">Sub Total : </p>
                        <p class="mb-1">PPN : </p>
                        <p class="mb-1">Total : </p>
                    </td>
                    <td class="text-end">
                        <p class="mb-1">{{ number_format($sub_total, 0, ',', '.') }}</p>
                        <p class="mb-1">{{ number_format($ppn, 0, ',', '.') }}</p>
                        <p class="mb-1">{{ number_format($rkbuBarangJasa->total_anggaran, 0, ',', '.') }}</p>
                    </td>
                    
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-7">
                Link Ekatalog : <a href="{{$rkbuBarangJasa->link_ekatalog}}">{{$rkbuBarangJasa->link_ekatalog}}</a> 
            </div>
        </div>
        <div class="d-flex justify-content-between flex-wrap">
          <div class="my-3">
            <h6 class="pb-2">Data Pendukung:</h6>
            <table>
              <tbody>
                <tr>
                  <td class="pe-3 fw-medium">Dokumen KAP</td>
                  <td>:</td>
                  <td> <a href="{{ asset('storage/uploads/' . basename($rkbuBarangJasa->upload_file_1)) }}" target="_blank">
                    {{ basename($rkbuBarangJasa->upload_file_1) ?? 'Tidak Ada Dokumen KAP' }} 
                </a></td>
                </tr>
                <tr>
                  <td class="pe-3 fw-medium">SPH 1</td>
                  <td>:</td>
                  <td> <a href="{{ asset('storage/uploads/' . basename($rkbuBarangJasa->upload_file_2)) }}" target="_blank">
                    {{ basename($rkbuBarangJasa->upload_file_2) ?? 'Tidak Ada Dokumen KAP' }} 
                </a></td>
                </tr>
                <tr>
                  <td class="pe-3 fw-medium">SPH 2</td>
                  <td>:</td>
                  <td> 
                    <a href="{{ asset('storage/uploads/' . basename($rkbuBarangJasa->upload_file_3)) }}" target="_blank">
                    {{ basename($rkbuBarangJasa->upload_file_3) ?? 'Tidak Ada Dokumen KAP' }} 
                </a>
            </td>
                </tr>
                <tr>
                  <td class="pe-3 fw-medium">SPH 3</td>
                  <td>:</td>
                  <td> <a href="{{ asset('storage/uploads/' . basename($rkbuBarangJasa->upload_file_4)) }}" target="_blank">
                    {{ basename($rkbuBarangJasa->upload_file_4) ?? 'Tidak Ada Dokumen KAP' }} 
                </a></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="my-3">
            <div class="added-cards">
                <div class="cardMaster bg-label-warning p-3 rounded mb-3">
                  <div class="d-flex justify-content-between flex-sm-row flex-column">
                    <div class="card-information me-2">
                      <img
                        class="mb-3 img-fluid"
                        src="../../assets/img/icons/payments/mastercard.png"
                        alt="Master Card" />
                      <div class="d-flex align-items-center mb-1 flex-wrap gap-2">
                        <h4 class="mb-0 me-2 fw-semibold">{{ $rkbuBarangJasa->rating }}</h4>
                        <span class="badge bg-label-primary rounded-pill">{{ $rkbuBarangJasa->status_validasi_rka->nama_validasi_rka }}</span>
                      </div>
                      <span class="card-number"
                        >{{ $rkbuBarangJasa->id_rkbu }}</span
                      >
                    </div>
                    <div class="d-flex flex-column text-start text-lg-end">
                      <small class="mt-sm-auto mt-2 order-sm-1 order-0 text-muted"
                        >{{ $rkbuBarangJasa->created_at }}</small
                      >
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <span class="fw-bold">Note:</span>
                <span>Thank you for working with us!</span>
            </div>
        </div>
    </div>
</div>
