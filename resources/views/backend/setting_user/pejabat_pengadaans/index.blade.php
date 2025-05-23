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
                                                    <i class="mdi mdi-calendar-blank-outline me-1 mdi-20px"></i><span class="fw-semibold">{{date(('l, d-m-Y  H:i:s'))}} </span>
                                                </li>
                                            </ul>
                                            <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group" role="group" aria-label="First group">
                                                    <a href="{{route('pejabat_pengadaans.create')}}" class="btn btn-outline-secondary btn-primary">
                                                        <i class="mdi mdi-account-check-outline me-1">Tambah Data</i>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                        <div class="table">
                        <table id="example" class="table table-bordered" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama PPK</th>
                                    <th>Nama PPBJ</th>
                                    <th>Nama Pengurus Barang</th>
                                    <th>Nama Direktur</th>
                                    <th>Nama Bendahara</th>
                                    <th>Tahun Anggaran</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($pejabat_pengadaans->isEmpty())
                                    <div class="alert alert-danger text-center">
                                        Tidak ada data yang tersedia.
                                    </div>
                                @else
                                <tr>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($pejabat_pengadaans as $key)
                                    <td>{{ $no++}}</td>
                                    <td>{{ $key->nama_ppk }} </br> {{ $key->nip_ppk }}</td>
                                    <td>{{ $key->nama_ppbj }} </br> {{ $key->nip_ppbj }}</td>
                                    <td>{{ $key->nama_pengurus_barang }} </br> {{ $key->nip_pengurus_barang }}</td>
                                    <td>{{ $key->nama_direktur }} </br> {{ $key->nip_direktur }}</td>
                                    <td>{{ $key->nama_bendahara }} </br> {{ $key->nip_bendahara }}</td>
                                    <td>{{ $key->TahunAnggaran->nama_tahun_anggaran }}</td>
                                    <td>
                                        @if ($key->status == 'aktif')
                                            <span class="badge bg-label-success">Aktif</span>
                                        @else
                                            <span class="badge bg-label-danger">Non Aktif</span>
                                        @endif
                                    </td>
                                        <td>
                                            <div class="btn-group" id="dropdown-icon-demo">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-menu me-1"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="{{ route('pejabat_pengadaans.edit', $key->id_pejabat_pengadaan) }}" class="dropdown-item d-flex align-items-center"><i class="mdi mdi-chevron-right scaleX-n1-rtl"></i>Edit</a>
                                                    </li>
                                                    <form action="{{ route('pejabat_pengadaans.destroy', $key->id_pejabat_pengadaan) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item d-flex align-items-center"><i class="mdi mdi-chevron-right scaleX-n1-rtl"></i>Hapus</button>
                                                    </form>
                                                </ul>
                                            </div>
                                        </td>
                                </tr>
                                @endforeach
                                 @endif
                            </tbody>
                            <tfoot>
                                <th>No</th>
                                <th>Nama PPK</th>
                                <th>Nama PPBJ</th>
                                <th>Nama Pengurus Barang</th>
                                <th>Nama Direktur</th>
                                <th>Nama Bendahara</th>
                                <th>Tahun Anggaran</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tfoot>
                        </table>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        <!--/ Header -->
    <!--/ Header -->
</div>
@endsection