@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->

        <!-- Content -->
            <div class="card-body">
                <!-- Header -->
                <div class="row">
                    <div class="col-12">
                        <div class="card col-12 mb-4">
                            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                                <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                                    <img src="{{asset('assets/img/illustrations/coming-soon-img.png')}}" height="157" width="175" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                                </div>
                                <div class="flex-grow-1 mt-3 mt-sm-5">
                                    <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                        <div class="user-profile-info">
                                            <h4> {{session('nama_lengkap')}}</h4>
                                            <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                                <li class="list-inline-item">
                                                    <i class="mdi mdi-account-convert me-1 mdi-20px"></i><span class="badge rounded-pill bg-label-danger"> {{session('nama_unit')}}</span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="mdi mdi-calendar-blank-outline me-1 mdi-20px"></i><span class="fw-semibold"><?php echo date('l, d-m-Y  H:i:s'); ?></span>
                                                </li>
                                            </ul>
                                            <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group" role="group" aria-label="First group">
                                                    <a href="{{route('uraian_satus.create')}}" class="btn btn-outline-secondary btn-primary">
                                                        <i class="mdi mdi-account-check-outline me-1">Add</i>
                                                    </a>
                                                    <button type="button" class="btn btn-outline-secondary">
                                                        <i class="tf-icons mdi mdi-calendar-blank-outline"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-secondary">
                                                        <i class="tf-icons mdi mdi-shield-check-outline"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-secondary">
                                                        <i class="tf-icons mdi mdi-chat-processing-outline"></i>
                                                    </button>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="Third group">
                                                    <button type="button" class="btn btn-outline-secondary btn-success">
                                                        <i class="tf-icons mdi mdi-download">Download Report</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Header -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="table-responsive table-striped">
                            <table id="example" class="dt-fixedcolumns table" style="width:90%">
                                <thead>
                                    <tr class="text-center me-0">
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Nama Barang</th>
                                        <th colspan="3" class="table-light border-top text-center">Sebelum</th>
                                        <th colspan="3" class="table-success border-top text-center">Sesudah</th>
                                    </tr>
                                    <tr>
                                        <th>Detail Spesifikasi</th>
                                        <th>Vol</th>
                                        <th>Detail Harga</th>
                                        <th>Detail Spesifikasi</th>
                                        <th>Vol</th>
                                        <th>Detail Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($rkbu_history as $history)
                                    @php
                                    $data_sebelum = $history->data_sebelum;

                                      // Jika data_sebelum adalah string JSON yang di-encode dua kali
                                      if (is_string($data_sebelum)) {
                                          $decoded_once = json_decode($data_sebelum, true);
                                          
                                          // Jika hasil decode pertama masih berupa string JSON
                                          if (is_string($decoded_once)) {
                                              $data_sebelum = json_decode($decoded_once, true);
                                          } else {
                                              $data_sebelum = $decoded_once;
                                          }
                                      }

                                      $data_sesudah = $history->data_sesudah;

                                      if (is_string($data_sesudah)) {
                                          $decoded_once = json_decode($data_sesudah, true);

                                          if (is_string($decoded_once)) {
                                              $data_sesudah = json_decode($decoded_once, true);
                                          } else {
                                              $data_sesudah = $decoded_once;
                                          }
                                      }
                             
                                     // Ambil sub kategori jika tersedia
                                     $sub_kategori_sebelum = \App\Models\SubKategoriRkbu::find($data_sebelum['id_sub_kategori_rkbu'] ?? null);
                                     $sub_kategori_sesudah = \App\Models\SubKategoriRkbu::find($data_sesudah['id_sub_kategori_rkbu'] ?? null);
                                 @endphp
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                <span class="fa-sm text-info"><strong>{{ $data_sebelum['nama_barang'] ?? 'N/A' }}</strong></span><br />
                                                <span class="fa-xs">Kategori: {{ $sub_kategori_sebelum->nama_sub_kategori_rkbu ?? 'N/A' }}</span><br />
                                                <span class="badge bg-danger"><span class="fa-sm">ID: {{ $history['id_rkbu'] }}</span></span><br />
                                                <span class="fa-xs">{{ $history['kode_kategori_rkbu'] . '.' . $history['kode_sub_kategori_rkbu'] . ' ' . $history['nama_sub_kategori_rkbu'] }}</span><br />
                                                <span class="fa-xs mt-3">Modified By: {{ $history->user->nama_lengkap }}</span>
                                            </td>
                                            <td style="width: 200px">
                                                <span class="fa-xs">Spek: {{ $data_sebelum['spek'] ?? 'N/A' }}</span><br />
                                                <span class="badge bg-label-info">
                                                    <span class="fa-sm">{{ optional($data_sesudah)['created_at'] ? \Carbon\Carbon::parse($data_sesudah['created_at']) : 'N/A' }}</span>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="fa-xs">Sisa Stok: {{ ($data_sebelum['stok'] ?? 0) }}</span><br />
                                                <span class="fa-xs">Rata2 Pemakaian: {{ ($data_sebelum['rata_rata_pemakaian'] ?? 0) }}</span><br />
                                                <span class="fa-xs">Kebutuhan: {{ ($data_sebelum['kebutuhan_per_bulan'] ?? 0) }} bulan</span><br />
                                                <span class="fa-xs">Buffer: {{ ($data_sebelum['buffer'] ?? 0) }}</span><br />
                                                <span class="fa-xs">Pengadaan Sebelumnya: {{ ($data_sebelum['pengadaan_sebelumnya'] ?? 0) }}</span><br />
                                            </td>
                                            <td>
                                                <span class="fa-xs">Harga Satuan Rp. {{ number_format($data_sebelum['harga_satuan'] ?? 0) }}</span><br /><br />
                                                <span class="fa-xs">PPN {{ ($data_sebelum['ppn'] ?? 0) }} %</span><br /><br />
                                                <span class="fa-xs badge bg-dark">Rp. {{ number_format($data_sebelum['total_anggaran'] ?? 0) }}</span><br />
                                            </td>
                                            <td style="width: 200px">
                                                <span class="fa-sm text-info"><strong>{{ $data_sesudah['nama_barang'] ?? 'N/A' }}</strong></span><br />
                                                <span class="fa-xs">Kategori: {{ optional(App\Models\SubKategoriRkbu::find($history->data_sebelum['id_sub_kategori_rkbu'] ?? null))->nama_sub_kategori_rkbu ?? 'N/A' }}
                                                <span class="fa-sm">{{ $data_sesudah['nama_barang'] ?? 'N/A' }}</span><br />
                                                <span class="fa-sm">  {{ $history->updated_at }} </span>

                                                <span class="fa-xs mt-3">Ket: {{ $history['keterangan_status'] }}</span><br /><br />
                                                @if (!empty($history['upload_file_5']))
                                                <span class="fa-sm">Dokumen Pendukung : 
                                                    <a href="{{ asset('storage/uploads/' . basename($history['upload_file_5'])) }}" target="_blank">
                                                        <span class="badge bg-primary">Lihat Dokumen</span>
                                                    </a>
                                                </span><br />
                                                @else
                                                <span class="fa-sm text-danger">Dok. Pendukung : No File.</span><br />
                                                @endif
                                            </td>
                                            <td>
                                                <span class="fa-xs">Sisa Stok: {{ ($data_sesudah['stok'] ?? 0) }}</span><br />
                                                <span class="fa-xs">Rata2 Pemakaian: {{ ($data_sesudah['rata_rata_pemakaian'] ?? 0) }}</span><br />
                                                <span class="fa-xs">Kebutuhan: {{ ($data_sesudah['kebutuhan_per_bulan'] ?? 0) }} bulan</span><br />
                                                <span class="fa-xs">Buffer: {{ ($data_sesudah['buffer'] ?? 0) }}</span><br />
                                                <span class="fa-xs">Pengadaan Sebelumnya: {{ ($data_sesudah['pengadaan_sebelumnya'] ?? 0) }}</span><br />
                                            <td>
                                                <span class="fa-xs">Harga Satuan Rp. {{ number_format($data_sesudah['harga_satuan'] ?? 0) }}</span><br /><br />
                                                <span class="fa-xs">PPN {{ ($data_sesudah['ppn'] ?? 0) }} %</span><br /><br />
                                                <span class="fa-xs badge bg-dark">Rp. {{ number_format($data_sesudah['total_anggaran'] ?? 0) }}</span><br /><br />
                                                <span class="fa-xs badge bg-label-info">Selisih: Rp. {{ number_format(($data_sesudah['total_anggaran'] ?? 0)- ($data_sebelum['total_anggaran'] ?? 0) ) }}</span><br />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>ID RKBU</th>
                                        <th colspan="2">Detail Data Sebelum</th>
                                        <th colspan="2">Detail Data Sesudah</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <!--/ Header -->
    <!--/ Header -->
</div>
@endsection