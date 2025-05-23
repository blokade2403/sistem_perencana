@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form id="confirmSubmitForm" class="needs-validation" method="POST" action="{{ route('admin_pendukungs.update', $admin_pendukungs->id_admin_pendukung_ppk) }}">
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
                                                    <input type="text" class="form-control" name="nama_pendukung_ppk" value="{{$admin_pendukungs->nama_pendukung_ppk}}" id="basic-addon11" placeholder="Isi Kode Kegiatan" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Pendukung PPK</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-7">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="jabatan_pendukung_ppk" value="{{$admin_pendukungs->jabatan_pendukung_ppk}}" id="basic-addon11" placeholder="Isi" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Jabatan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <input class="form-control" name="nrk" type="text" value="{{$admin_pendukungs->nrk}}">
                                                    <label for="basic-addon11">NRK/NIP</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="id_user" id="id_kegiatan3" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option data-display="Select">Please select</option>
                                                            @foreach ($users as $key)
                                                                <option value="{{ $key->id_user }}">{{ $key->nama_lengkap  }}</option>   
                                                            @endforeach
                                                        </select>
                                                        <label for="basic-addon11">Pejabat Pengadaan</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="id_pejabat_pengadaan" id="id_kegiatan" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option value="{{$admin_pendukungs->id_pejabat_pengadaan}}">{{$admin_pendukungs->pejabat_pengadaan->nama_ppk}} </option>
                                                            @foreach ($pejabat_pengadaans as $key)
                                                                <option value="{{ $key->id_pejabat_pengadaan }}">{{ $key->nama_ppk  }}</option>   
                                                            @endforeach
                                                        </select>
                                                        <label for="basic-addon11">Pejabat Pengadaan</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="id_pptk" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option value="{{$admin_pendukungs->id_pptk}}">{{$admin_pendukungs->pptk->nama_pptk}}</option>
                                                            @foreach ($pptks as $key)
                                                                <option value="{{$key->id_pptk}}">{{$key->nama_pptk}}</option>   
                                                            @endforeach
                                                        </select>
                                                        <label for="floatingSelect">Pejabat PPTK</label>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2" onclick="return confirmSubmit()">Save changes</button>
                                    <a href="{{route('admin_pendukungs.index')}}" class="btn btn-outline-secondary">Back</a>
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