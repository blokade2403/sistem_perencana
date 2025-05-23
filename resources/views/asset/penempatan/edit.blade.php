@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
        <form id="confirmSubmitForm" class="needs-validation" method="POST" action="{{route('penempatans.update', $penempatans->id_penempatan)}}">
            @csrf
            @method('PUT')
            <div class="col-xl-12">
                <div class="card-body">
                    <div class="card mb-4">
                        <!-- Current Plan -->
                        <h5 class="card-header"> Create Lokasi Barang</h5>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="lokasi_barang" value="{{$penempatans->lokasi_barang}}" id="basic-addon11" placeholder="John Doe" aria-label="tahun_anggaranname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Lokasi Barang</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select class="select2 form-select form-select-lg" data-allow-clear="true" name="tempat_lokasi" >
                                                        <option value="{{$penempatans->tempat_lokasi}}">{{$penempatans->tempat_lokasi}}</option>
                                                        <option value="Lantai 1">Lantai 1</option>
                                                        <option value="Lantai 2">Lantai 2</option>
                                                        <option value="Lantai 3">Lantai 3</option>
                                                        <option value="Lantai 4">Lantai 4</option>
                                                        <option value="Lantai 5">Lantai 5</option>
                                                        <option value="Lantai 6">Lantai 6</option>
                                                        <option value="Lantai 7">Lantai 7</option>
                                                        <option value="Lantai 8">Lantai 8</option>
                                                        <option value="Lantai 9">Lantai 9</option>
                                                    </select>
                                                    <label for="floatingSelect">Lokasi Lantai Gedung</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select class="select2 form-select form-select-lg" data-allow-clear="true" name="gedung" >
                                                        <option value="{{$penempatans->gedung}}">{{$penempatans->gedung}}</option>
                                                        <option value="Gedung A">Gedung A</option>
                                                        <option value="Gedung B">Gedung B</option>
                                                    </select>
                                                    <label for="floatingSelect">Lokasi Gedung</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="col-md-12">
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
                                    <div class="col-12 col-md-12">
                                        <div class="input-group input-group-merge">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control" name="penanggung_jawab" value="{{$penempatans->penanggung_jawab}}" id="basic-addon11" placeholder="Budi" aria-label="Penanggung Jawab" aria-describedby="basic-addon11" />
                                                <label for="floatingSelect">Penanggung Jawab</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <a href="{{route('penempatans.index')}}" class="btn btn-outline-secondary">Back</a>
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