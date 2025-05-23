@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form class="needs-validation" method="POST" action="{{ route('ksps.update', $ksps->id_ksp) }}">
            @csrf
            @method('PUT')
            <div class="col-xl-12">
                <div class="card-body">
                    <div class="card mb-4">
                        <!-- Current Plan -->
                        <h5 class="card-header">Edit KSP/Ka. Ins</h5>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nama_ksp" value="{{$ksps->nama_ksp}}" id="basic-addon11" placeholder="Isi Nama KSP" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama KSP/Ka. Ins</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nip_ksp" value="{{$ksps->nip_ksp}}" id="basic-addon11" placeholder="Isi" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">NIP KSP/Ka. Ins</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="hidden" class="form-control" name="status" value="aktif" />
                                                    <select class="select2 form-select form-select-lg" data-allow-clear="true" name="id_fungsional" >
                                                        <option value="{{$ksps->id_fungsional}}">{{$ksps->fungsional->jabatan_fungsional}}</option>
                                                        @foreach ($fungsionals as $fungsional)
                                                            <option value="{{$fungsional->id}}">{{$fungsional->jabatan_fungsional}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="basic-addon11">Jabatan KSP/Ka. Ins</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select name="id_pejabat" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                        <option value="{{$ksps->id_pejabat}}">{{$ksps->pejabat->nama_pejabat}}</option>
                                                        @foreach ($pejabats as $pejabat)
                                                            <option value="{{$pejabat->id_pejabat}}">{{$pejabat->nama_pejabat}}</option>   
                                                        @endforeach
                                                    </select>
                                                    <label for="floatingSelect">Atasan/Pejabat</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="col-md-8">
                                        <div class="row">
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
                                    <div class="col-6">
                                        <div class="input-group input-group-merge">
                                            <div class="form-floating form-floating-outline">
                                                <select name="status" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                    <option value="{{$ksps->status}}">{{$ksps->status}}</option>
                                                    <option value="aktif">Aktif</option>
                                                    <option value="tidak aktif">Non Aktif</option>
                                                </select>
                                                <label for="floatingSelect">Status</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2" onclick="return confirmSubmit()">Save changes</button>
                                    <a href="/ksps" class="btn btn-outline-secondary">Back</a>
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