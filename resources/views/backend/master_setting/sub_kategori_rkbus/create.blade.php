@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
            
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form id="confirmSubmitForm" class="needs-validation" method="POST" action="{{ route(('sub_kategori_rkbus.store')) }}">
            @csrf
            <div class="col-xl-12">
                <div class="card-body">
                    <div class="card mb-4">
                        <!-- Current Plan -->
                        <h5 class="card-header">Create Sub Kategori RKBU</h5>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="col-md-8">
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="kode_sub_kategori_rkbu" id="basic-addon11" placeholder="Isi Nama kategori_rkbu" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Kode Sub Kategori RKBU</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nama_sub_kategori_rkbu" id="basic-addon11" placeholder="Isi Nama kategori_rkbu" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Sub Kategori RKBU</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select class="select2 form-select form-select-lg" data-allow-clear="true" name="id_kategori_rkbu" >
                                                        <option data-display="Select">Please Select</option>
                                                        @foreach ($kategori_rkbus as $key)
                                                            <option value="{{$key->id_kategori_rkbu}}">{{$key->kode_kategori_rkbu}}. {{$key->nama_kategori_rkbu}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="basic-addon11">Kategori RKBU</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select class="select2 form-select form-select-lg" data-allow-clear="true" name="id_kode_rekening_belanja" >
                                                        <option data-display="Select">Please Select</option>
                                                        @foreach ($rekening_belanjas as $key)
                                                            <option value="{{$key->id_kode_rekening_belanja}}">{{$key->kode_rekening_belanja}}. {{$key->nama_rekening_belanja}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="basic-addon11">Rekening Belanja</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select name="id_admin_pendukung_ppk" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                        <option data-display="Select">Please select</option>
                                                        @foreach ($admin_pendukungs as $pejabat)
                                                            <option value="{{$pejabat->id_admin_pendukung_ppk}}">{{$pejabat->nama_pendukung_ppk}}</option>   
                                                        @endforeach
                                                    </select>
                                                    <label for="floatingSelect">Pendukung PPK</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select name="id_sub_kategori_rekening" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                        <option data-display="Select">Please select</option>
                                                        @foreach ($sub_kategori_rekenings as $pejabat)
                                                            <option value="{{$pejabat->id_sub_kategori_rekening}}">{{$pejabat->kode_sub_kategori_rekening}}.{{$pejabat->nama_sub_kategori_rekening}}</option>   
                                                        @endforeach
                                                    </select>
                                                    <label for="floatingSelect">Sub Kategori Rekening</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5 class="card-header">Status</h5>
                                                <div class="alert alert-warning mb-4 alert-dismissible" role="alert">
                                                    <div class="input-group input-group-merge">
                                                        <div class="form-floating form-floating-outline">
                                                            <select name="status" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                                <option data-display="Select">Please select</option>
                                                                    <option value="aktif">Aktif</option>   
                                                                    <option value="non aktif">Non Aktif</option>   
                                                            </select>
                                                            <label for="floatingSelect">Status</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2" onclick="return confirmSubmit()">Save changes</button>
                                    <a href="{{route('sub_kategori_rkbus.index')}}" class="btn btn-outline-secondary">Back</a>
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