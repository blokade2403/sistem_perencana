@extends('layouts.main')
@section('container')
    <div class="card-body">
        <!-- Header -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card-body">
                        <div class="card mb-4">
                            <!-- Current Plan -->
                            <h5 class="card-header">Objek Kategori Belanja</h5>
                            <div class="card-body pt-1">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="mb-4">
                                            <div class="form-floating form-floating-outline">
                                                <select name="id_sub_kategori_rkbu" id="realisasi" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                    @if ($sub_kategori_rkbus->isNotEmpty())
                                                    @foreach ($sub_kategori_rkbus as $item)
                                                        <option value="{{ $item->id_sub_kategori_rkbu }}">{{ $item->kode_sub_kategori_rkbu }}. {{ $item->nama_sub_kategori_rkbu }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">Data tidak tersedia</option>
                                                @endif
                                                </select>
                                                <label for="floatingSelect">Objek Belanja</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src="assets/img/illustrations/girl-verify-password-light.png" alt="girl-verify-password-light" width="100" height="75" class="img-fluid" data-app-light-img="illustrations/girl-verify-password-light.png" data-app-dark-img="illustrations/girl-verify-password-dark.png" />
                                            </div>
                                            <div class="col-md-10">
                                                <div class="added-cards">
                                                    <div class="cardMaster bg-lighter p-3 rounded mb-3">
                                                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                                                            <div class="card-information me-2">
                                                                <div class="input-group input-group-floating">
                                                                    <div class="form-floating">
                                                                        <input type="text" name="id_kategori_rkbu" id="id_kategori_rkbu" value="{{$no_inv->id_kategori_rkbu }}" readonly="" class="form-control bg-lighter" id="basic-addon21" readonly aria-label="Username" aria-describedby="basic-addon21" />
                                                                        <label for="basic-addon21">ID Kategori </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-floating">
                                                                <input type="text" name="id_jenis_kategori_rkbu" id="id_jenis_kategori_rkbu" value="{{$no_inv->id_jenis_kategori_rkbu}}" readonly="" class="form-control bg-lighter" id="basic-addon21" readonly aria-label="Username" aria-describedby="basic-addon21" />
                                                                <label for="basic-addon21">ID Jenis Kategori</label>
                                                            </div>
                                                            <div class="form-floating">
                                                                <input type="text" name="id_jenis_belanja" id="id_jenis_belanja" value="{{$no_inv->id_jenis_belanja }}" readonly="" class="form-control bg-lighter" id="basic-addon21" readonly aria-label="Username" aria-describedby="basic-addon21" />
                                                                <label for="basic-addon21">ID Jenis Belanja</label>
                                                            </div>
                                                            <div class="form-floating">
                                                                <input type="text" name="id_usulan_spj" id="id_usulan_spj" value="{{$no_inv->id_usulan_spj}}" readonly="" class="form-control bg-lighter" id="basic-addon21" readonly aria-label="Username" aria-describedby="basic-addon21" />
                                                                <label for="basic-addon21">ID Usulan Barang</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <!-- /Current Plan -->
                        </div>
                        <!--- / Data Usulan Barang -->
                        <div class="card mb-4">
                            <h5 class="card-header">Data Usulan Belanja</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped">
                                                <thead class="table-light border-top">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Barang</th>
                                                        <th>Spesifikasi</th>
                                                        <th>harga Satuan</th>
                                                        <th>Vol</th>
                                                        <th>PPN</th>
                                                        <th>Harga</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    @foreach ($keranjang as $item)
                                                        <tr>
                                                            <td class="text-nowrap"><small class="text-info">{{$no++}}</small></td>
                                                            <td class="text-nowrap">
                                                                <small class="text-info">{{$item->nama_barang}}</small><br />
                                                                <span class="fa-xs">ID: {{$item->id_rkbu}} </span>
                                                            </td>
                                                            <td class="fy-2 text-wrap"><span class="fa-sm">{{$item->spek_detail}}</span></td>
                                                            <td class="text-nowrap"><small>Rp. {{number_format($item->harga_barang, 0, '.', ',')}}</small></td>
                                                            <td class="text-nowrap"><small>{{$item->jumlah_usulan_barang}} x {{$item->satuan_1_detail}}</small></td>
                                                            <td class="text-nowrap"><small>{{$item->total_ppn}}</small></td>
                                                            <td class="text-nowrap"><small>Rp. {{number_format($item->total_anggaran_usulan_barang, 0, '.', ',')}}</small></td>
                                                            <td>
                                                               
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Barang</th>
                                                        <th>Spesifikasi</th>
                                                        <th>harga Satuan</th>
                                                        <th>Vol</th>
                                                        <th>PPN</th>
                                                        <th>Harga</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <table class="table m-0">
                                                <thead class="table-light border-top">
                                                </thead>
                                                
                                                <tbody>
                                                    <tr>
                                                        <td colspan="4" class="align-top px-4 py-3">
                                                            <p class="mb-2">
                                                                <span class="me-1 fw-semibold">Status Sebelumnya: </span>
                                                            </p>
                                                            <span class="badge bg-warning mb-3"></span>
                                                            <p class="mb-2">
                                                                <span class="me-1 fw-semibold">Dokumen Pendukung: </span>
                                                            </p>
                                                            
                                                        </td>
                                                        <td class="text-end px-4 py-3">
                                                            <p class="mb-2">
                                                                <span class="me-1 fw-semibold">Sub Total:</span>
                                                                {{ number_format($get_total - $ppn, 0, ',','.') }}
                                                            </p>
                                                            <p class="mb-2">
                                                                <span class="me-1 fw-semibold">PPN:</span>
                                                                {{ number_format($ppn, 0, ',','.') }}
                                                            </p>
                                                            <p class="mb-2">
                                                                <span class="me-1 fw-semibold">Total:</span>
                                                                {{ number_format($get_total, 0, ',','.') }}
                                                            </p>
                                                        </td>
                                                        <td class="px-4 py-5">
                                                            <p class="fw-semibold mb-2 text-end"></p>
                                                            <p class="fw-semibold mb-2 text-end"></p>
                                                            <p class="fw-semibold mb-0 text-end"></p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / End Data Usulan Barang -->
                      
                        @php
                            $nama_level   = ['Administartor'];
                            $level_ksp    = ['Validasi'];
                            $level_kabag  = ['Administrator', 'Validasi RKA'];
                            $level_admin_ppk  = ['Administrator', 'Admin PPK'];
                            $level_pengadaan_ppk  = ['Administrator', 'Admin PPK', 'PPK', 'PPBJ', 'Pengurus Barang', 'PPK Keuangan', 'PPTK', 'Validasi Keuangan', 'Verifikator', 'Direktur'];
                        @endphp
                    
                @include('backend.pengadaan.partials.ceklist_verifikasi')

                @if (in_array(session('nama_level_user'), $level_admin_ppk ))
                       @include('backend.pengadaan.partials.surat_pesanan')
                       @include('backend.pengadaan.partials.barang_datang_all')
                       @include('backend.pengadaan.partials.bast')
                       @include('backend.pengadaan.partials.tukar_faktur')
                       
                       @if ($master_spj->status_verifikasi_direktur == 'Selesai')
                            @include('backend.pengadaan.partials.serah_terima_bendahara')
                       @endif
                @endif

                @if (session('nama_level_user') == 'Administrator')
                       @include('backend.pengadaan.partials.update_status_verifikasi_admin')
                @endif
                @if (in_array(session('nama_level_user'), ['Pendukung PPK', 'administrator', 'Pengurus Barang']))
                        @include('backend.pengadaan.partials.barang_datang')
                @endif
                @if (in_array(session('nama_level_user'), ['PPBJ', 'administrator']))
                        @include('backend.pengadaan.partials.verif_ppbj_1')
                 @endif
                 @if (in_array(session('nama_level_user'), ['PPK', 'administrator']))
                        @include('backend.pengadaan.partials.verif_ppk')
                 @endif
                 @if (in_array(session('nama_level_user'), ['PPTK', 'PPTK Alkes', 'PPTK Umum', 'administrator']))
                        @include('backend.pengadaan.partials.verif_pptk_1')
                 @endif
                 @if (in_array(session('nama_level_user'), ['Verifikator', 'administrator']))
                        @include('backend.pengadaan.partials.verif_verifikator_1')
                 @endif
                 @if (in_array(session('nama_level_user'), ['PPK Keuangan', 'administrator']))
                        @include('backend.pengadaan.partials.verif_ppk_keuangan_1')
                 @endif
                 @if (in_array(session('nama_level_user'), ['Direktur', 'administrator']))
                        @include('backend.pengadaan.partials.verif_direktur_1')
                 @endif
                 @if (in_array(session('nama_level_user'), ['Bendahara', 'administrator']))
                        @include('backend.pengadaan.partials.verif_bendahara')
                 @endif
                       
                    </div>
                </div>  
            </div>
    </div>
        

    <!-- Form with Image horizontal Modal -->
    @endsection