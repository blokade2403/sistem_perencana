@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form id="confirmSubmitForm" class="needs-validation" method="POST" action="{{ route('kategori_rkbus.update', $kategori_rkbus->id_kategori_rkbu) }}">
            @csrf
            @method('PUT')
            <div class="col-xl-12">
                <div class="card-body">
                    <div class="card mb-4">
                        <!-- Current Plan -->
                        <h5 class="card-header">Create kategori_rkbu</h5>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="col-md-8">
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="kode_kategori_rkbu" value="{{$kategori_rkbus->kode_kategori_rkbu}}" id="basic-addon11" placeholder="Isi Nama kategori_rkbu" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Kode kategori_rkbu</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nama_kategori_rkbu" value="{{$kategori_rkbus->nama_kategori_rkbu}}" id="basic-addon11" placeholder="Isi Nama kategori_rkbu" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama kategori_rkbu</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select class="select2 form-select form-select-lg" data-allow-clear="true" name="id_jenis_kategori_rkbu" >
                                                        <option value="{{$kategori_rkbus->id_jenis_kategori_rkbu}}">{{$kategori_rkbus->jenis_kategori_rkbu->kode_jenis_kategori_rkbu}}. {{$kategori_rkbus->jenis_kategori_rkbu->nama_jenis_kategori_rkbu}}</option>
                                                        @foreach ($jenis_kategori_rkbus as $key)
                                                            <option value="{{$key->id_jenis_kategori_rkbu}}">{{$key->kode_jenis_kategori_rkbu}}. {{$key->nama_jenis_kategori_rkbu}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="basic-addon11">Jenis Kategori RKBU</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select name="id_obyek_belanja" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                        <option value="{{$kategori_rkbus->id_obyek_belanja}}">{{$kategori_rkbus->obyek_belanja->kode_obyek_belanja}}. {{$kategori_rkbus->obyek_belanja->nama_obyek_belanja}}</option>
                                                        @foreach ($obyek_belanjas as $pejabat)
                                                            <option value="{{$pejabat->id_obyek_belanja}}">{{$pejabat->kode_obyek_belanja}}. {{$pejabat->nama_obyek_belanja}}</option>   
                                                        @endforeach
                                                    </select>
                                                    <label for="floatingSelect">Obyek Belanja</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
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
                                    <a href="/kategori_rkbus" class="btn btn-outline-secondary">Back</a>
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