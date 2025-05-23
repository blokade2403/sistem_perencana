@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form id="confirmSubmitForm" class="needs-validation" method="POST" action="{{ route('anggarans.update', $anggaran->id_anggaran) }}">
            @csrf
            @method('PUT')
            <div class="col-xl-12">
                <div class="card-body">
                    <div class="card mb-4">
                        <!-- Current Plan -->
                        <h5 class="card-header">Create Anggaran</h5>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="col-md-8">
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nama_anggaran" value="{{$anggaran->nama_anggaran}}" id="basic-addon11" placeholder="Isi Nama Kategori RKBU" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Anggaran</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="jumlah_anggaran" value="{{$anggaran->jumlah_anggaran}}" id="basic-addon11" placeholder="Isi Kode Kategori RKBU" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Jumlah Anggaran</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select class="select2 form-select form-select-lg" data-allow-clear="true" name="id_kode_rekening_belanja" >
                                                        <option value="{{$anggaran->id_kode_rekening_belanja}}">{{$anggaran->rekening_belanjas->kode_rekening_belanja}}</option>
                                                        @foreach ($rekening_belanjas as $key)
                                                            <option value="{{$key->id_kode_rekening_belanja}}">{{$key->kode_rekening_belanja}}.{{$key->nama_rekening_belanja}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="basic-addon11">Rekening Belanja</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select name="id_sumber_dana" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                        <option value="{{$anggaran->id_sumber_dana}}">{{$anggaran->sumber_dana->nama_sumber_dana}}</option>
                                                        @foreach ($sumber_danas as $key)
                                                            <option value="{{$key->id_sumber_dana}}">{{$key->nama_sumber_dana}}</option>   
                                                        @endforeach
                                                    </select>
                                                    <label for="floatingSelect">Sumber Dana</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select name="tahun_anggaran" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                        <option value="{{$anggaran->tahun_anggaran}}">{{$anggaran->tahun_anggaran}}</option>
                                                        @foreach ($tahun_anggaran as $key)
                                                            <option value="{{$key->nama_tahun_anggaran}}">{{$key->nama_tahun_anggaran}}</option>   
                                                        @endforeach
                                                    </select>
                                                    <label for="floatingSelect">Tahun Anggaran</label>
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
                                    <a href="{{route('anggarans.index')}}" class="btn btn-outline-secondary">Back</a>
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