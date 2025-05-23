@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
        <form id="confirmSubmitForm" class="needs-validation" method="POST" action="{{route(('tahun_anggarans.store'))}}">
            @csrf
            <div class="col-xl-12">
                <div class="card-body">
                    <div class="card mb-4">
                        <!-- Current Plan -->
                        <h5 class="card-header"> Create Tahun Anggaran</h5>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="col-12 col-md-4">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nama_tahun_anggaran" id="basic-addon11" placeholder="John Doe" aria-label="tahun_anggaranname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Tahun Anggaran</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select name="status" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                        <option data-display="Select">Please select</option>
                                                            <option value="aktif">Aktif</option>   
                                                            <option value="tidak aktif">Non Aktif</option>   
                                                    </select>
                                                    <label for="basic-addon11">Status Tahun Anggaran</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 mb-3">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select name="fase_tahun" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                        <option data-display="Select">Please select</option>
                                                            <option value="Perencanaan">Perencanaan</option>   
                                                            <option value="Penetapan">Penetapan</option>   
                                                            <option value="Perubahan">Perubahan</option>   
                                                            <option value="Non Aktif">Non Aktif</option> 
                                                    </select>
                                                    <label for="basic-addon11">Status Fase Tahun</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 mb-3">
                                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                    <a href="{{route('tahun_anggarans.index')}}" class="btn btn-outline-secondary">Kembali</a>
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