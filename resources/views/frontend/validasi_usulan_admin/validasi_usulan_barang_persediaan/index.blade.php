@extends('layouts.main')
@section('container')
    <div class="card-body">
        <!-- Header -->
            <div class="row">
                <div class="col-12">
                    <div class="card col-12 mb-4">
                        <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                            <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                                <img src="assets/img/illustrations/trophy.png" height="157" width="175" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                            </div>
                            <div class="flex-grow-1 mt-3 mt-sm-5">
                                <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                    <div class="user-profile-info">
                                        <h4> {{session('nama_lengkap')}}</h4>
                                        <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                            <li class="list-inline-item">
                                                <i class="mdi mdi-account-convert me-1 mdi-20px"></i><span class="badge rounded-pill bg-label-danger"> {{session('tahun_anggaran')}}</span>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="mdi mdi-calendar-blank-outline me-1 mdi-20px"></i><span class="fw-semibold"><?php echo date('l, d-m-Y  H:i:s'); ?></span>
                                            </li>
                                        </ul>
                                            <div class="demo-inline-spacing">
                                                <button class="btn rounded-pill btn-label-info waves-effect" data-bs-toggle="modal" data-bs-target="#referAndEarn">
                                                    <span class="tf-icons mdi mdi-book-plus-multiple me-1"></span>Tambah Data
                                                </button>
                                                <a href="" class="btn rounded-pill btn-label-secondary waves-effect">
                                                    <span class="tf-icons mdi mdi-download me-1"></span>Download Report
                                                </a>
                                                <a href="" class="btn rounded-pill btn-label-warning waves-effect">
                                                    <span class="tf-icons mdi mdi-printer me-1"></span>Print
                                                </a>
                                            </div>
                                        <div class="card-body pb-3 transaction-details d-flex flex-wrap justify-content-between align-items-center">
                                            <div class="me-3 mb-3">
                                                <p class="mb-2">Status</p>
                                                <h6 class="mb-0">Validasi</h6>
                                            </div>
                                                <div class="me-3 mb-3">
                                                    <p class="mb-2 "></p>
                                                    <span class="badge bg-info"></span>
                                                </div>
                                                <div class="me-3 mb-3">
                                                    <p class="mb-2 "></p>
                                                    <span class="badge bg-success"></span>
                                                </div>
                                        </div>
                                    </div>
                                    <!-- /////// -->
                                    <div class="d-flex bg-label-primary p-3 border rounded my-3">
                                        <div class="border border-2 border-primary rounded me-3 p-2 d-flex align-items-center justify-content-center w-px-40 h-px-40">
                                            <i class="mdi mdi-cash mdi-10px"></i>
                                        </div>
                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0 fw-semibold">Total Terinput</h6>
                                                    <a href="javascript:void(0)" class="small" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">Lebih</a>
                                                    <a href="javascript:void(0)" class="small" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">Kurang</a>
                                            </div>
                                            <div class="user-progress">
                                                <div class="d-flex justify-content-center">
                                                    <sup class="mt-3 mb-0 fw-semibold text-heading small"></sup>
                                                    <h3 class="fw-medium mb-0"> </h3>
                                                    <sub class="mt-auto mb-2 text-heading small">,-</sub>
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <sup class="mt-3 mb-0 text-heading small">Rp. </sup>
                                                    <h3 class="fw-small mb-0 text-danger"></h3>
                                                    <sub class="mt-auto mb-2 text-heading small">,-</sub>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /////// -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('validasi_usulan_persediaans.index') }}" method="GET">
                            @include('frontend.partials.filter_usulan_belanja')
                        </form>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                <th>ID Usulan</th>
                                <th>ID SUB</th>
                                <th>No Usulan Barang</th>
                                <th>Status</th>
                                <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                                $no = 1;
                                                @endphp
                                            @foreach ($id_usulan as $keyIndex => $key)
                                            <tr>
                                            <td>{{$no++}}</td>
                                            <td class="fs-14 text-wrap" ><small>No. ID Usulan <br />{{$key->id_usulan_barang}}</small></td>
                                            <td class="fs-14"><strong><small><span class="fs-14 text-primary">{{$key->sub_kategori_rkbu->kode_sub_kategori_rkbu}}. {{$key->sub_kategori_rkbu->nama_sub_kategori_rkbu}}</span></small></strong><br /><span><small>Nama Pengusul : {{$key->nama_pengusul_barang}}</small></br><small>Tanggal Usulan : {{$key->created_at}}</small></br><small>Unit : {{$key->user->unit->nama_unit}}</small></span></td>
                                            <td class="fs-14"><strong><small><span class="fs-14 text-secondary" >{{$key->no_usulan_barang}}</span></small></strong><br /></td>
                                            <td>
                                                @include('backend.pengadaan.usulan_belanja.partials.status_usulan_belanja')
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                     {{-- Tombol Hapus --}}
                                                     @if ($key->usulanBarangDetails->isEmpty())
                                                     <form action="{{ route('validasi_usulan_persediaans.delete', $key->id_usulan_barang) }}" method="POST" class="delete-form m-0">
                                                         @csrf
                                                         @method('DELETE')
                                                         <button type="submit" class="btn btn-icon btn-outline-danger waves-effect">
                                                             <span class="tf-icons mdi mdi-delete-forever"></span>
                                                         </button>
                                                     </form>
                                                 @else
                                                     <a href="#" class="btn btn-icon btn-outline-danger waves-effect disabled-link" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus terlebih dahulu data detailnya">
                                                         <i class="tf-icons mdi mdi-delete-alert-outline"></i>
                                                     </a>
                                                 @endif

                                                    @if (session('nama_level_user') == 'Administrator' && $key->status_permintaan_barang == 'Perlu Validasi Perencana') 
                                                    <a href="{{ route('validasi_usulan_persediaans.keranjang', $key->id_usulan_barang) }}" class="btn btn-icon btn-warning waves-effect waves-light">
                                                        <span class="tf-icon mdi mdi-account-alert-outline"></span>
                                                    </a>
                                                    @elseif (session('nama_level_user') == 'Administrator' && $key->status_validasi_perencana == 'Disetujui Perencana')
                                                    <a href="{{route('validasi_usulan_persediaans.show', $key->id_usulan_barang)}}" class="btn btn-icon btn-primary waves-effect waves-light">
                                                        <span class="tf-icon mdi mdi-checkbox-marked-circle-outline"></span>
                                                    </a>
                                                    @endif
                                                  
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                <th>ID Usulan</th>
                                <th>ID SUB</th>
                                <th>No Usulan Barang</th>
                                <th>Status</th>
                                <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
        

        @include('frontend.partials.modal_usulan_barang_sub_kategori')
    <!-- Form with Image horizontal Modal -->
    @endsection