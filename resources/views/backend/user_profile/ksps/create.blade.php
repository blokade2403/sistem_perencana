@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form class="needs-validation" method="POST" action="{{ route(('ksps.store')) }}">
            @csrf
            <div class="col-xl-12">
                <div class="card-body">
                    <div class="card mb-4">
                        <!-- Current Plan -->
                        <h5 class="card-header">Tambah Data KSP/Ka. Ins</h5>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nama_ksp" id="basic-addon11" placeholder="Isi Nama KSP" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama KSP/Ka. Ins</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nip_ksp" id="basic-addon11" placeholder="Isi" aria-label="pejabatname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">NIP KSP/Ka. Ins</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="hidden" class="form-control" name="status" value="aktif" />
                                                    <select class="select2 form-select form-select-lg" data-allow-clear="true" name="id_fungsional" >
                                                        <option value="">Please Select</option>
                                                        @foreach ($fungsionals as $fungsional)
                                                            <option value="{{$fungsional->id_fungsional}}">{{$fungsional->jabatan_fungsional}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="basic-addon11">Jabatan KSP/Ka. Ins</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select name="id_pejabat" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                        <option data-display="Select">Please select</option>
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
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2" onclick="return confirmSubmit()">Simpan</button>
                                    <a href="{{route('ksps.index')}}" class="btn btn-outline-secondary">Kembali</a>
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