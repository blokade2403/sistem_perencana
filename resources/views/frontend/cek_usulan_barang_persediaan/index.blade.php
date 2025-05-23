@extends('layouts.main')
@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></h4>
        <!-- Header -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                            <img src="assets/img/illustrations/file.png" width="245" height="65" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                        </div>
                        <div class="flex-grow-1 mt-3 mt-sm-5">
                            <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                <div class="user-profile-info">
                                    <h4></h4>
                                    <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-invert-colors me-1 mdi-20px"></i><span class="fw-semibold">UX Designer</span>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="btn-group" id="dropdown-icon-demo">
    
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-calendar-blank-outline me-1 mdi-20px"></i><span class="fw-semibold"> Joined April 2021</span>
                                        </li>
                                    </ul>
                                    <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group" role="group" aria-label="First group">
                                            <a href="" class="btn btn-outline-secondary">
                                                <i class="tf-icons mdi mdi-pencil-plus-outline">Add</i>
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
                                    </div>
                                </div>
                            </div>
                        </div>
    
                    </div>
                </div>
            </div>
        </div>
            <form method="POST" action="" id="form-delete">
                <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID SUB</th>
                                    <th>No Usulan Barang</th>
                                    <th witdh=100%>Detail Usulan</th>
                                    <th>Status Usulan</th>
                                    <th>Status Proses</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($usulan_barangs as $item)
                                
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td class="fs-14" style="width: 30%"><small>No. ID {{$item->sub_kategori_rkbu->kode_sub_kategori_rkbu}}. {{$item->sub_kategori_rkbu->nama_sub_kategori_rkbu}}</small></td>
                                        <td class="fs-14"><strong><small><span class="fs-14 text-primary"></span></small></strong><br /><span class="badge bg-label-danger"><small>No Usulan : {{$item->no_usulan_barang}} </small></span><br /><span><small>Nama Pengusul : {{$item->nama_pengusul_barang}} </small></span><br /></td>
                                        <td>
                                            <a href="{{route('cek_usulan_persediaans.show', $item->id_usulan_barang)}}" class="btn btn-sm btn-success">
                                                <span class="tf-icons mdi mdi-eye-check-outline me-1"></span>
                                            </a>
                                        </td>
                                        <td>{{$item->status_usulan_barang}}</td>
                                        <td>
                                            <ul class="timeline card-timeline mb-0">
                                                @if ($item->status_permintaan_barang == 'Perlu Validasi Perencana')
                                                <li class="timeline-item timeline-item-transparent">
                                                    <span class="timeline-point timeline-point-primary"></span>
                                                    <div class="">
                                                        <div class="timeline-header mb-1">
                                                            <span class="badge bg-label-primary"><small class="mb-2 fw-2">Perlu Validasi Perencana : </small></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endif
                                                @if ($item->status_permintaan_barang == 'Disetujui Perencana')
                                                    <li class="timeline-item timeline-item-transparent">
                                                        <span class="timeline-point timeline-point-warning"></span>
                                                        <div class="">
                                                            <div class="timeline-header mb-1">
                                                                <span class="badge bg-label-warning"><small class="mb-2 fw-2">Validasi Perencana : {{ \Carbon\Carbon::parse($item->tgl_validasi_perencana)->translatedFormat('d F Y') }} </small></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if ($item->status_permintaan_barang == 'Ditolak Perencana')
                                                    <li class="timeline-item timeline-item-transparent">
                                                        <span class="timeline-point timeline-point-danger"></span>
                                                        <div class="">
                                                            <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="">
                                                                <span class="badge bg-label-danger"><small class="mb-2 fw-2">Ditolak Perencana : {{ \Carbon\Carbon::parse($item->tgl_validasi_perencana)->translatedFormat('d F Y') }} </small></span>
                                                            </a>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if ($item->status_permintaan_barang == 'Validasi Kabag')
                                                <li class="timeline-item timeline-item-transparent">
                                                    <span class="timeline-point timeline-point-warning"></span>
                                                    <div class="">
                                                        <div class="timeline-header mb-1">
                                                            <span class="badge bg-label-warning"><small class="mb-2 fw-2">Validasi Perencana : {{ \Carbon\Carbon::parse($item->tgl_validasi_perencana)->translatedFormat('d F Y') }} </small></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                    <li class="timeline-item timeline-item-transparent">
                                                        <span class="timeline-point timeline-point-info"></span>
                                                        <div class="">
                                                            <div class="timeline-header mb-1">
                                                                <span class="badge bg-label-info"><small class="mb-2 fw-2">Validasi Kabag/Kabid : {{ \Carbon\Carbon::parse($item->tgl_validasi_kabag)->translatedFormat('d F Y') }} </small></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if ($item->status_permintaan_barang == 'Ditolak Kabag')
                                                    <li class="timeline-item timeline-item-transparent">
                                                        <span class="timeline-point timeline-point-danger"></span>
                                                        <div class="">
                                                            <div class="timeline-header mb-1">
                                                                <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="">
                                                                    <span class="badge bg-label-danger"><small class="mb-2 fw-2">Ditolak Kabag/Kabid : {{ \Carbon\Carbon::parse($item->tgl_validasi_kabag)->translatedFormat('d F Y') }} </small></span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endif
                                                    @if ($item->status_permintaan_barang == 'Validasi Direktur')
                                                    <li class="timeline-item timeline-item-transparent">
                                                        <span class="timeline-point timeline-point-warning"></span>
                                                        <div class="">
                                                            <div class="timeline-header mb-1">
                                                                <span class="badge bg-label-warning"><small class="mb-2 fw-2">Validasi Perencana : {{ \Carbon\Carbon::parse($item->tgl_validasi_perencana)->translatedFormat('d F Y') }} </small></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                        <li class="timeline-item timeline-item-transparent">
                                                            <span class="timeline-point timeline-point-info"></span>
                                                            <div class="">
                                                                <div class="timeline-header mb-1">
                                                                    <span class="badge bg-label-info"><small class="mb-2 fw-2">Validasi Kabag/Kabid : {{ \Carbon\Carbon::parse($item->tgl_validasi_kabag)->translatedFormat('d F Y') }} </small></span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <li class="timeline-item timeline-item-transparent">
                                                        <span class="timeline-point timeline-point-success"></span>
                                                        <div class="">
                                                            <div class="timeline-header mb-1">
                                                                <span class="badge bg-label-success"><small class="mb-2 fw-2">Validasi Direktur : {{ \Carbon\Carbon::parse($item->tgl_validasi_direktur)->translatedFormat('d F Y') }} </small></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endif
                                                    @if ($item->status_permintaan_barang == 'Ditolak Direktur')
                                                    <li class="timeline-item timeline-item-transparent">
                                                        <span class="timeline-point timeline-point-danger"></span>
                                                        <div class="">
                                                            <div class="timeline-header mb-1">
                                                                <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="">
                                                                    <span class="badge bg-label-danger"><small class="mb-2 fw-2">Ditolak Direktur : {{ \Carbon\Carbon::parse($item->tgl_validasi_direktur)->translatedFormat('d F Y') }} </small></span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endif
                                            </ul>
                                        </td>
                                        {{-- <td>
                                            <div class="demo-inline-spacing">
                                                    <a href="" class="btn btn-icon btn-label-pinterest">
                                                        <i class="tf-icons mdi mdi-delete"></i>
                                                    </a>
                                                    <span class="btn btn-icon btn-label-github"><i class="tf-icons mdi mdi-delete-off"></i></span>
                                            </div>
                                        </td> --}}
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>ID SUB</th>
                                    <th>No Usulan Barang</th>
                                    <th witdh=100%>Detail Usulan</th>
                                    <th>Status</th>
                                    <th>Status Proses</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            </form>
    </div>
</div>
    @endsection