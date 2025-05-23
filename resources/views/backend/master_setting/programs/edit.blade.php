@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
        <form class="needs-validation" method="POST" action="{{ route('programs.update', $program->id_program) }}">
            @csrf
            @method('PUT')
            <div class="col-xl-12">
                <div class="card-body">
                    <div class="card mb-4">
                        <!-- Current Plan -->
                        <h5 class="card-header"> Create Program</h5>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="col-12 col-md-4">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="kode_program" value="{{$program->kode_program}}" id="basic-addon11" placeholder="John Doe" aria-label="tahun_anggaranname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Kode Program</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nama_program" value="{{$program->nama_program}}" id="basic-addon11" placeholder="John Doe" aria-label="tahun_anggaranname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Program</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <a href="/programs" class="btn btn-outline-secondary">Back</a>
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