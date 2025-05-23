@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
            
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form id="confirmSubmitForm" class="needs-validation" method="POST" action="{{ route(('aktivitass.store')) }}">
            @csrf
            <div class="col-xl-12">
                <div class="card-body">
                    <div class="card mb-4">
                        <!-- Current Plan -->
                        <h5 class="card-header">Create Aktivitas</h5>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="col-md-8">
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="kode_aktivitas" id="basic-addon11" placeholder="Isi Nama aktivitas" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Kode Aktivitas</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nama_aktivitas" id="basic-addon11" placeholder="Isi Nama aktivitas" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Aktivitas</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select class="select2 form-select form-select-lg" data-allow-clear="true" name="id_program" >
                                                        <option data-display="Select">Please Select</option>
                                                        @foreach ($programs as $fungsional)
                                                            <option value="{{$fungsional->id_program}}">{{$fungsional->kode_program}}. {{$fungsional->nama_program}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="basic-addon11">Program</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select name="id_sub_kegiatan" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                        <option data-display="Select">Please select</option>
                                                        @foreach ($sub_kegiatans as $pejabat)
                                                            <option value="{{$pejabat->id_sub_kegiatan}}">{{$pejabat->kode_sub_kegiatan}}. {{$pejabat->nama_sub_kegiatan}}</option>   
                                                        @endforeach
                                                    </select>
                                                    <label for="floatingSelect">Sub Kegiatan</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src="{{asset('assets/img/illustrations/verification-img.png')}}" alt="verification-img" width="100" height="475" class="img-fluid" data-app-light-img="illustrations/verification-img.png" data-app-dark-img="illustrations/verification-img.png" />
                                            </div>
                                            <div class="col-md-10">
                                                <div class="alert alert-warning mb-4 alert-dismissible" role="alert">
                                                    <h6 class="alert-heading mb-1 d-flex align-items-end">
                                                        <i class="mdi mdi-alert-outline mdi-20px me-2"></i>
                                                        <span>We need your attention!</span>
                                                    </h6>
                                                    <div class="accordion mt-3" id="accordionWithIcon">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header d-flex align-items-center">
                                                            </h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2" onclick="return confirmSubmit()">Save changes</button>
                                    <a href="/aktivitas" class="btn btn-outline-secondary">Back</a>
                                </div>
                            </div>
                        </div>

                        <!-- /Current Plan -->
                    </div>
                </div>
            </div>
        </form>
    <!--/ Header -->
</div>
@endsection