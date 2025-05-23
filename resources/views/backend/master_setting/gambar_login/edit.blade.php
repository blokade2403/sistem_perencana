@extends('layouts.main')
@section('container')
    <!-- Content -->
            <form class="needs-validation" method="POST" action="{{route('gambar_logins.update', $gambarLogin->id_gambar_login )}}" enctype="multipart/form-data" validate>
                @csrf
                @method('PUT')
                <div class="col-xl-12">
                    <div class="card-body">
                        <div class="card mb-4">
                            <!-- Current Plan -->
                            <h5 class="card-header">Komponen</h5>
                            <div class="card-body pt-1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="creditCardForm" class="row g-4">
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <select class="select2 form-select form-select-lg" data-allow-clear="true" name="tahun_anggaran" >
                                                            <option value="{{$gambarLogin->tahun_anggaran}}">{{$gambarLogin->tahun_anggaran}}</option>
                                                            <option value="Default">Default</option>
                                                            @foreach ($tahun_anggaran as $fungsional)
                                                                <option value="{{$fungsional->nama_tahun_anggaran}}">{{$fungsional->nama_tahun_anggaran}}</option>
                                                            @endforeach
                                                        </select>
                                                        <label for="basic-addon11">Tahun Anggaran</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <select class="select2 form-select form-select-lg" data-allow-clear="true" name="status_gambar" >
                                                            <option value="{{$gambarLogin->status_gambar}}">{{$gambarLogin->status_gambar}}</option>
                                                            <option value="Aktif">Aktif</option>
                                                            <option value="Non Aktif">Non Aktif</option>
                                                        </select>
                                                        <label for="basic-addon11">Status</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-md-6 mb-3">
                                        <div id="creditCardForm" class="row g-4">
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">Gambar</label>
                                                        <input type="file" class="form-control" name="gambar_login" id="formFile">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                    <a href="{{route('gambar_logins.index')}}" class="btn btn-outline-secondary">Kembali</a>
                                </div>
                            </div>
    
                            <!-- /Current Plan -->
                        </div>
                    </div>
                </div>
            </form>
@endsection
    
        


