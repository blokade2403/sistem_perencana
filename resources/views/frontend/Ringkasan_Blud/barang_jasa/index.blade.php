@extends('layouts.main')
@section('container')
        <!-- Content -->
        @include('backend.partials.modal_upload_rkbu_barjas')
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
                                                    <a href="{{route('validasi_barang_jasa_admins.create')}}" class="btn rounded-pill btn-label-info waves-effect">
                                                        <span class="tf-icons mdi mdi-book-plus-multiple me-1"></span>Tambah Data
                                                    </a>
                                                    @if (session('nama_level_user') == 'Administrator')
                                                    <a href="{{ route('rkbu_barang_jasa_admin.downloadReport') }}" class="btn rounded-pill btn-label-secondary waves-effect">
                                                        <span class="tf-icons mdi mdi-download me-1"></span>Download Report
                                                    </a>
                                                    @elseif (session('nama_level_user') == 'Validasi RKA')
                                                    <a href="{{ route('rkbu_barang_jasa_kabag.downloadReport') }}" class="btn rounded-pill btn-label-secondary waves-effect">
                                                        <span class="tf-icons mdi mdi-download me-1"></span>Download Report
                                                    </a>
                                                    @endif
                                                    <a href="{{route('validasi_barang_jasa_admins.downloadPDF_ValidasiAdmin')}}" class="btn rounded-pill btn-label-warning waves-effect">
                                                        <span class="tf-icons mdi mdi-printer me-1"></span>Print
                                                    </a>
                                                    <button type="button" class="btn rounded-pill btn-label-warning waves-effect" data-bs-toggle="modal" data-bs-target="#referAndEarn">
                                                        <span class="tf-icons mdi mdi-upload me-1"></span><span class="fa-sm"></span>
                                                    </button>
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
                                        @include('backend.partials.pagudaninput')
                                        <!-- /////// -->
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
                                <form action="{{ route('validasi_barang_jasa_admins.index') }}" method="GET">
                                    @include('frontend.partials.filter_rkbu')
                                </form>
                                <form action="{{ route('validasi_barang_jasa_admins.massValidasi') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_jenis_kategori_rkbu" value="barjas">
                                    @if (session('nama_level_user') == 'Administrator')
                                    <button type="submit" class="btn btn-label-success">Validasi All</button>
                                    @endif
                                <div class="table-responsive">
                                {!! $dataTable->table(['class' => 'table table-striped']) !!}
                                    @include('frontend.partials.modal_detail_rkbu')
                                </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        <!--/ Header -->
    <!--/ Header -->
</div>
@endsection