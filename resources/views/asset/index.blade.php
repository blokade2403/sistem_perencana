@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    @include('backend.partials.modal_upload_asset')
    <!-- Content -->
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
                                        <div class="demo-inline-spacing">
                                            <a href="{{route('barang_assets.create')}}" class="btn rounded-pill btn-label-info waves-effect">
                                                <span class="tf-icons mdi mdi-book-plus-multiple me-1"></span>Tambah Data
                                            </a>
                                            <a href="{{route('barang_assets.cetakQRCode')}}" class="btn rounded-pill btn-label-success waves-effect">
                                                <span class="tf-icons mdi mdi-printer me-1"></span>Print
                                            </a>
                                            <a href="{{route('barang_assets.export')}}" class="btn rounded-pill btn-label-warning waves-effect">
                                                <span class="tf-icons mdi mdi-folder-download"></span>Report
                                            </a>
                                            <button type="button" class="btn rounded-pill btn-label-warning waves-effect" data-bs-toggle="modal" data-bs-target="#referAndEarn">
                                                <span class="tf-icons mdi mdi-upload me-1"></span><span class="fa-sm">Upload</span>
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
                    <div class="table-responsive">
                        {!! $dataTable->table(['class' => 'table table-striped', 'width' => '100%']) !!}
                    </div>
                </div>
            </div>
        </div>
@endsection