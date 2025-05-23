@extends('layouts.main')
@section('container')
        <!-- Content -->
            <div class="card-body">
                @include('backend.partials.modal_upload_kategori_rkbu')
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
                                                <a href="{{route('anggarans.create')}}" class="btn rounded-pill btn-label-info waves-effect">
                                                    <span class="tf-icons mdi mdi-book-plus-multiple me-1"></span>Tambah Data
                                                </a>
                                                <a href="" class="btn rounded-pill btn-label-secondary waves-effect">
                                                    <span class="tf-icons mdi mdi-download me-1"></span>Download Report
                                                </a>
                                                <button type="button" class="btn rounded-pill btn-label-warning waves-effect" data-bs-toggle="modal" data-bs-target="#referAndEarn">
                                                    <span class="tf-icons mdi mdi-upload me-1"></span><span class="fa-sm"></span>
                                                </button>
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
                                    <th>Rekening Belanja</th>
                                    <th>Nama Anggaran</th>
                                    <th>Sumber Dana</th>
                                    <th>Tahun Anggaran</th>
                                    <th>Jumlah Anggaran</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($anggarans->isEmpty())
                                    <div class="alert alert-danger text-center">
                                        Tidak ada data yang tersedia.
                                    </div>
                                @else
                                <tr>
                                    @php $no = 1; @endphp
                                    @foreach ($anggarans as $key)
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $key->rekening_belanjas->kode_rekening_belanja }}</td>
                                    <td>{{ $key->nama_anggaran }}</td>
                                    <td>{{ $key->sumber_dana->nama_sumber_dana}}</td>
                                    <td>{{ $key->tahun_anggaran }}</td>
                                    <td>Rp. {{ number_format($key->jumlah_anggaran, 0, '.',',') }}</td>
                                        <td>
                                            <div class="btn-group" id="dropdown-icon-demo">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-menu me-1"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="{{ route('anggarans.edit', $key->id_anggaran) }}" class="dropdown-item d-flex align-items-center"><i class="mdi mdi-chevron-right scaleX-n1-rtl"></i>Edit</a>
                                                    </li>
                                                    <form action="{{ route('anggarans.destroy', $key->id_anggaran) }}" method="POST" class="delete-form">
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
                                <th>Rekening Belanja</th>
                                <th>Nama Anggaran</th>
                                <th>Sumber Dana</th>
                                <th>Tahun Anggaran</th>
                                <th>Jumlah Anggaran</th>
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