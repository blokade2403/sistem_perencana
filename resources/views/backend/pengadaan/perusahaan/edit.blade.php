@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
            
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form id="confirmSubmitForm" class="needs-validation" method="POST" action="{{ route('perusahaans.update', $perusahaan->id_perusahaan) }}">
            @csrf
            @method('PUT')
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
                                                    <input type="text" class="form-control" name="nama_perusahaan" value="{{$perusahaan->nama_perusahaan}}" id="basic-addon11" placeholder="Isi Nama kategori_rkbu" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Perusahaan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="email_perusahaan" value="{{$perusahaan->email_perusahaan}}" id="basic-addon11" placeholder="Isi Nama kategori_rkbu" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Email Perusahaan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                   <textarea class="form-control" name="alamat_perusahaan" cols="30" rows="40">{{$perusahaan->alamat_perusahaan}}</textarea>
                                                    <label for="paymentCard">Alamat Perusahaan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="tlp_perusahaan" value="{{$perusahaan->tlp_perusahaan}}" id="basic-addon11" placeholder="Isi Nama kategori_rkbu" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Telp Perusahaan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nama_direktur_perusahaan" value="{{$perusahaan->nama_direktur_perusahaan}}" id="basic-addon11" placeholder="Isi Nama kategori_rkbu" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Direktur Perusahaan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="jabatan_perusahaan" value="{{$perusahaan->jabatan_perusahaan}}" id="basic-addon11" placeholder="Isi Nama kategori_rkbu" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Jabatan Perusahaan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="no_npwp" value="{{$perusahaan->no_npwp}}" id="basic-addon11" placeholder="Isi Nama kategori_rkbu" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">NPWP Perusahaan</label>
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
                                    <a href="{{route('perusahaans.index')}}" class="btn btn-outline-secondary">Back</a>
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