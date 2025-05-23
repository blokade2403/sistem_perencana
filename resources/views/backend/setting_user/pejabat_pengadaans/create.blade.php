@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
        <form id="confirmSubmitForm" class="needs-validation" method="POST" action="{{route(('pejabat_pengadaans.store'))}}">
            @csrf
            <div class="col-xl-12">
                <div class="card-body">
                    <div class="card mb-4">
                        <!-- Current Plan -->
                        <h5 class="card-header"> Tambah Data Pejabat Pengadaan</h5>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nama_ppk" id="basic-addon11" placeholder="Nama PPK" aria-label="tahun_anggaranname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama PPK</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-alpha-n me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nip_ppk" id="basic-addon11" placeholder="Nomor Induk" aria-label="tahun_anggaranname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">NIP PPK</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nama_ppbj" id="basic-addon11" placeholder="Nama PPBJ" aria-label="tahun_anggaranname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama PPBJ</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-alpha-n me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nip_ppbj" id="basic-addon11" placeholder="Nomor Induk" aria-label="tahun_anggaranname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">NIP PPBJ</label>
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
                                        <div class="col-12 col-md-6 ">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select name="status" class="select2 form-select form-select-lg" >
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
                                <div class="col-md-6 mb-3">
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nama_pengurus_barang" id="basic-addon11" placeholder="Nama Pengurus Barang" aria-label="tahun_anggaranname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Pengurus Barang</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-alpha-n me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nip_pengurus_barang" id="basic-addon11" placeholder="Nomor Induk" aria-label="tahun_anggaranname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">NIP Pengurus Barang</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nama_direktur" id="basic-addon11" placeholder="Nama Direktur" aria-label="tahun_anggaranname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Direktur</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-alpha-n me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nip_direktur" id="basic-addon11" placeholder="Nomor Induk" aria-label="tahun_anggaranname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">NIP Direktur</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nama_bendahara" id="basic-addon11" placeholder="Nama Bendahara" aria-label="tahun_anggaranname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Bendahara</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-alpha-n me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="nip_bendahara" id="basic-addon11" placeholder="Nomor Induk" aria-label="tahun_anggaranname" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">NIP Bendahara</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select name="id_ppk_keuangan" class="select2 form-select form-select-lg" >
                                                    <option data-display="Select">Please select</option>
                                                    @foreach ($ppk_keuangans as $item)
                                                    <option value="{{$item->id_ppk_keuangan}}">{{$item->nama_ppk_keuangan}}</option>
                                                    @endforeach
                                                </select>
                                                    <label for="floating-select">PPK Keuangan</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                    <a href="{{route('pejabat_pengadaans.index')}}" class="btn btn-outline-secondary">Kembali</a>
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