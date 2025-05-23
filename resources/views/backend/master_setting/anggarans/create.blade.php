@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form id="confirmSubmitForm" class="needs-validation" method="POST" action="{{ route(('anggarans.store')) }}">
            @csrf
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
                                                    <input type="text" class="form-control" name="nama_anggaran" id="basic-addon11" placeholder="Isi Nama Kategori RKBU" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Anggaran</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="jumlah_anggaran" id="basic-addon11" placeholder="Isi Kode Kategori RKBU" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Jumlah Anggaran</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select class="select2 form-select form-select-lg" data-allow-clear="true" name="id_kode_rekening_belanja" >
                                                        <option data-display="Select">Please Select</option>
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
                                                        <option data-display="Select">Please select</option>
                                                        @foreach ($sumber_danas as $key)
                                                            <option value="{{$key->id_sumber_dana}}">{{$key->nama_sumber_dana}}</option>   
                                                        @endforeach
                                                    </select>
                                                    <label for="floatingSelect">Sumber Dana</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select name="tahun_anggaran" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                        <option data-display="Select">Please select</option>
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
                                <div class="mt-2 mb-3">
                                    <button type="submit" class="btn btn-primary me-2" onclick="return confirmSubmit()">Simpan</button>
                                    <a href="{{route('anggarans.index')}}" class="btn btn-outline-secondary">Kembali</a>
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