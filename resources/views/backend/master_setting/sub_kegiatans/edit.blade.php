@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
            
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form id="confirmSubmitForm" class="needs-validation" method="POST" action="{{ route('sub_kegiatans.update', $sub_kegiatans->id_sub_kegiatan) }}">
            @csrf
            @method('PUT')
            <div class="col-xl-12">
                <div class="card-body">
                    <div class="card mb-4">
                        <!-- Current Plan -->
                        <h5 class="card-header">Create KSP/Ka. Ins</h5>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="col-12 col-md-5">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="kode_sub_kegiatan" value="{{$sub_kegiatans->kode_sub_kegiatan}}" id="basic-addon11" placeholder="Isi Kode Kegiatan" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Kode Sub Kegiatan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-7">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nama_sub_kegiatan" value="{{$sub_kegiatans->nama_sub_kegiatan}}" id="basic-addon11" placeholder="Isi" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Sub Kegiatan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <textarea name="tujuan_sub_kegiatan" class="form-control h-px-100" id="exampleFormControlTextarea1">{{$sub_kegiatans->tujuan_sub_kegiatan}}</textarea>
                                                    <label for="basic-addon11">Tujuan Sub Kegiatan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12 mb-3">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <textarea name="indikator_sub_kegiatan" class="form-control h-px-100" id="exampleFormControlTextarea1">{{$sub_kegiatans->indikator_sub_kegiatan}}</textarea>
                                                    <label for="basic-addon11">Indikator Sub Kegiatan</label>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-warning mb-4 alert-dismissible" role="alert">
                                                    <span class="text-dark"> Kode Program: </span> <p id="kode_program"></p>
                                                    <span class="text-dark"> Nama Program: </span></br><span id="nama_program"></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="id_kegiatan" id="id_kegiatan" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option value="{{ $sub_kegiatans->id_kegiatan }}">{{ $sub_kegiatans->kegiatan->kode_kegiatan }}. {{ $sub_kegiatans->kegiatan->nama_kegiatan }}</option>
                                                            @foreach ($kegiatans as $key)
                                                                <option value="{{ $key->id_kegiatan }}">{{ $key->kode_kegiatan }}. {{ $key->nama_kegiatan }}</option>   
                                                            @endforeach
                                                        </select>
                                                        <label for="basic-addon11">Kegiatan</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="id_sumber_dana" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option value="{{$sub_kegiatans->id_sumber_dana}}">{{$sub_kegiatans->sumber_dana->nama_sumber_dana}}</option>
                                                            @foreach ($sumber_danas as $key)
                                                                <option value="{{$key->id_sumber_dana}}">{{$key->nama_sumber_dana}}</option>   
                                                            @endforeach
                                                        </select>
                                                        <label for="floatingSelect">Sumber Dana</label>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <a href="/sub_kegiatans" class="btn btn-outline-secondary">Back</a>
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