@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
            
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form id="confirmSubmitForm" class="needs-validation" method="POST" action="{{ route('tanggal_perencanaans.update', $tanggal_perencanaans->id_tanggal_perencanaan) }}">
            @csrf
            @method('PUT')
            <div class="col-xl-12">
                <div class="card-body">
                    <div class="card mb-4">
                        <!-- Current Plan -->
                        <h5 class="card-header">Create Tanggal Perencanaan</h5>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="col-md-8">
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="no_dpa" value="{{$tanggal_perencanaans->no_dpa}}" id="basic-addon11" placeholder="Isi Nomor DPA" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nomor DPA</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="kota" value="{{$tanggal_perencanaans->kota}}" id="basic-addon11" placeholder="Isi Nama Kota Daerah" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Kota Daerah</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select class="select2 form-select form-select-lg" data-allow-clear="true" name="status" >
                                                        <option value="{{$tanggal_perencanaans->status}}">{{$tanggal_perencanaans->status}}</option>
                                                        <option value="aktif" {{ $tanggal_perencanaans->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                        <option value="tidak aktif" {{ $tanggal_perencanaans->status == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                                    </select>
                                                    <label for="basic-addon11">Status</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                  <input type="date" name="tanggal" value="{{$tanggal_perencanaans->tanggal}}" class="form-control flatpickr-input" id="date" placeholder="----/--/--">
                                                    <label for="floatingSelect">Tanggal Perencanaan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select class="select2 form-select form-select-lg" data-allow-clear="true" name="id_tahun_anggaran" >
                                                        <option value="{{$tanggal_perencanaans->id_tahun_anggaran}}">{{$tanggal_perencanaans->id_tahun_anggaran}}</option>
                                                        @foreach ($tahun_anggarans as $item)
                                                        <option value="{{$item->id}}">{{$item->nama_tahun_anggaran}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="basic-addon11">Tahun Anggaran</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select class="select2 form-select form-select-lg" data-allow-clear="true" name="id_fase" >
                                                        <option value="{{$tanggal_perencanaans->id_fase}}">{{$tanggal_perencanaans->Fase->nama_fase}}</option>
                                                        @foreach ($fases as $item)
                                                        <option value="{{$item->id_fase}}">{{$item->nama_fase}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="basic-addon11">Fase Perencanaan</label>
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
                                    <a href="{{route('tanggal_perencanaans.index')}}" class="btn btn-outline-secondary">Back</a>
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