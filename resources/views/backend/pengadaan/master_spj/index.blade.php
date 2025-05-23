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
                                                <i class="mdi mdi-calendar-blank-outline me-1 mdi-20px"></i><span class="fw-semibold">{{date('l, d-m-Y  H:i:s')}}</span>
                                            </li>
                                        </ul>
                                            <div class="demo-inline-spacing">
                                                <a href="{{route('master_spj.downloadReport')}}" class="btn rounded-pill btn-label-secondary waves-effect">
                                                    <span class="tf-icons mdi mdi-download me-1"></span>Download Report
                                                </a>
                                                <a href="{{route('master_spj.downloadPDF_report_spj')}}" class="btn rounded-pill btn-label-success waves-effect">
                                                    <span class="tf-icons mdi mdi-printer me-1"></span>Print
                                                </a>
                                                <a href="{{route('master_spj.downloadPDF_realisasi_spj')}}" class="btn rounded-pill btn-label-warning waves-effect">
                                                    <span class="tf-icons mdi mdi-printer me-1"></span>Print All
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
                                                <h6 class="mb-0 fw-semibold text-secondary">Total Terinput</h6>
                                                <hr>
                                                <h6 class="mb-0 fw-semibold text-primary">Total Terbayarkan</h6>
                                                <a href="javascript:void(0)" class="small" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">Upgrade Plan</a>
                                            </div>
                                            <div class="user-progress">
                                                <div class="d-flex justify-content-center">
                                                    <sup class="mt-3 mb-0 fw-semibold text-heading small">Rp.</sup>
                                                    <h3 class="fw-medium mb-0"> {{number_format($sum_total_spj)}}</h3>
                                                    <sub class="mt-auto mb-2 text-heading small">,-</sub>
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <sup class="mt-3 mb-0 text-heading small">Rp. </sup>
                                                    <h3 class="fw-small mb-0 text-danger">{{number_format($sum_total_spj_dibayar)}}</h3>
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
                        <form action="{{ route('master_spj.index') }}" method="GET">
                            @include('frontend.partials.filter_master_spj')
                        </form>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Detail Usulan</th>
                                        <th>Uraian SPJ</th>
                                        <th>Detail SPJ</th>
                                        <th>Detail Biaya</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @include('backend.pengadaan.partials.isi_spj_invo')
                                   @include('backend.pengadaan.partials.isi_spj_invo_pendukung_ppk')
                                    @if(session('nama_level_user') === 'Pengurus Barang')
                                        @include('backend.pengadaan.partials.isi_spj_invo_pb')
                                    @endif
                                    @if(session('nama_level_user') === 'Direktur')
                                    @include('backend.pengadaan.partials.isi_spj_invo_direktur')
                                    @endif
                                    @if(session('nama_level_user') === 'Validasi')
                                    @include('backend.pengadaan.partials.isi_spj_invo_ksp')
                                    @endif
                                    @if(session('nama_level_user') === 'Bendahara')
                                    @include('backend.pengadaan.partials.isi_spj_invo_bendahara')
                                    @endif
                                    @if(session('nama_level_user') === 'PPTK Umum')
                                        @include('backend.pengadaan.partials.isi_spj_invo_pptk_umum')
                                    @endif
                                    @if(session('nama_level_user') === 'PPTK Alkes')
                                        @include('backend.pengadaan.partials.isi_spj_invo_pptk_alkes')
                                    @endif
                                    @if(session('nama_level_user') === 'PPTK')
                                        @include('backend.pengadaan.partials.isi_spj_invo_pptk_penmed')
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Detail Usulan</th>
                                        <th>Uraian SPJ</th>
                                        <th>Detail SPJ</th>
                                        <th>Detail Biaya</th>
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

<div class="modal fade" id="modalDetailMasterSpj" tabindex="-1" aria-labelledby="modalDetailMasterSpjLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Konten Detail akan diisi oleh JavaScript -->
                <div id="modalDetailContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
        

    <!-- Form with Image horizontal Modal -->
    @endsection