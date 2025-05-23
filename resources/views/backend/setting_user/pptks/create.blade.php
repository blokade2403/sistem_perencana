@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
        <form id="confirmSubmitForm" class="needs-validation" method="POST" action="{{route(('pptks.store'))}}">
            @csrf
            <div class="col-xl-12">
                <div class="card-body">
                    <div class="card mb-4">
                        <!-- Current Plan -->
                        <h5 class="card-header"> Tambah Data User PPTK</h5>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nama_pptk" id="basic-addon11" placeholder="Nama PPTK" aria-label="tahun_anggaranname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama PPTK</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nip_pptk" id="basic-addon11" placeholder="Nomor Induk" aria-label="tahun_anggaranname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">NIP PPTK</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select name="id_tahun_anggaran" class="select2 form-select form-select-lg" >
                                                    <option data-display="Select">Please select</option>
                                                    @foreach ($tahun_anggarans as $item)
                                                    <option value="{{$item->id}}">{{$item->nama_tahun_anggaran}}</option>
                                                    @endforeach
                                                </select>
                                                    <label for="floating-select">Tahun Anggaran</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select name="status_pptk" class="select2 form-select form-select-lg" >
                                                    <option data-display="Select">Please select</option>
                                                    <option value="aktif">Aktif</option>
                                                    <option value="tidak aktif">Non Aktif</option>
                                                </select>
                                                    <label for="floating-select">Status</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                    <a href="{{route('pptks.index')}}" class="btn btn-outline-secondary">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
</div>
@endsection