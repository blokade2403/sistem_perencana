@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
    
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Title</h4>
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <form class="needs-validation" action="{{route('validasi_pegawai_non_pnss.update', $pegawai->id_rkbu)}}"  method="POST" id="confirmSubmitForm" enctype="multipart/form-data" validate>
            @csrf
            @method('PUT')
            <div class="col-xl-12">
                <div class="card-body">
                    <div class="card mb-4">
                        <h5 class="card-header">Komponen Belanja</h5>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="mb-4">
                                        <h6 class="mb-1 fw-semibold mb-3">Pilih Komponen Belanja</h6>
                                        <div class="form-floating form-floating-outline">
                                            <div class="input-group input-group-merge">
                                                <div class="input-group">
                                                    <input type="text" name="nama_pegawai" id="nama_pegawai" value="{{$pegawai->nama_pegawai}}" class="form-control" placeholder="Nama Pegawai" aria-label="Example text with button addon" aria-describedby="button-addon1" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="assets/img/illustrations/123.png" alt="girl-verify-password-light" width="100" height="75" class="img-fluid" data-app-light-img="illustrations/123.png" data-app-dark-img="illustrations/123.png" />
                                        </div>
                                        <div class="col-md-10">
                                            <div class="alert alert-warning mb-4 alert-dismissible" role="alert">
                                                <h6 class="alert-heading mb-1 d-flex align-items-end">
                                                    <i class="mdi mdi-alert-outline mdi-20px me-2"></i>
                                                    <span>We need your attention!</span>
                                                </h6>
                                                <span class="ms-4 ps-1">Jika tidak ada Pilihan Komponen Input Manual!</span>
                                                <div class="accordion mt-3" id="accordionWithIcon">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header d-flex align-items-center">
                                                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-2" aria-expanded="false">
                                                                <i class="mdi mdi-briefcase me-2"></i>
                                                                Option Input Manual
                                                            </button>
                                                        </h2>
                                                        <div id="accordionWithIcon-2" class="accordion-collapse collapse">
                                                            <div class="accordion-body">
                                                                <input type="hidden" name="jumlah_vol" class="form-control">
                                                                <input type="hidden" name="sisa_vol_rkbu" class="form-control">
                                                                <input type="hidden" name="nama_lengkap" class="form-control" value="{{ session('nama_lengkap') }}">
                                                                <input type="hidden" name="id_user" value="{{ session('id_user') }}">
                                                                <input type="hidden" name="nama_tahun_anggaran" value="{{ session('tahun_anggaran') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <h5 class="card-header">Detail Pegawai</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control" name="tempat_lahir" value="{{$pegawai->tempat_lahir}}" placeholder="1" aria-label="Amount (to the nearest dollar)" id="vol1" onkeyup="sum();" required />
                                                <label for="basic-addon11">Tempat Lahir</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <div class="form-floating form-floating-outline">
                                                    <input class="form-control" type="text" name="tanggal_lahir" value="{{$pegawai->tanggal_lahir}}" placeholder="YYYY-MM-DD" id="flatpickr-date" />
                                                    <label for="basic-addon11">Tanggal Lahir</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control" name="jabatan" value="{{$pegawai->jabatan}}" placeholder="1" aria-label="Amount (to the nearest dollar)" />
                                                <label for="basic-addon11">Jabatan</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="pendidikan" value="{{$pegawai->pendidikan}}" placeholder="1" aria-label="Amount (to the nearest dollar)" />
                                                    <label for="basic-addon11">Pendidikan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select name="status_kawin" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                        <option value="{{$pegawai->status_kawin}}">{{$pegawai->status_kawin}}</option>
                                                            <option value="K0 Tidak Menikah">K0 Tidak Menikah</option>
                                                            <option value="K1 Menikah">K1 Menikah</option>
                                                            <option value="K2 Menikah 1 Anak">K2 Menikah 1 Anak</option>
                                                            <option value="K3 Menikah 2 Anak">K3 Menikah 2 Anak</option>
                                                    </select>
                                                    <label for="floatingSelect">Status Kawin</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 ">
                                    <h6>Detail Barang</h6>
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="added-cards">
                                            <div class="cardMaster bg-lighter p-3 rounded mb-3">
                                                <div class="d-flex justify-content-between flex-sm-row flex-column">
                                                    <div class="card-information me-2">
                                                        <div class="d-flex align-items-center mb-1 flex-wrap gap-2">
                                                            <h6 class="mb-0 me-2 fw-semibold">Harga Satuan Komponen : </h6>
                                                        </div>
                                                        <div class="input-group input-group-floating">
                                                            <span class="input-group-text bg-lighter">Rp.</span>
                                                            <div class="form-floating">
                                                                <input id="" name="" onkeyup="sum();" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
                                                                <label for="basic-addon21">Harga Satuan</label>
                                                            </div>
                                                            <span class="form-floating-focused"></span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column text-start text-lg-end">

                                                        <small class="mt-sm-auto mt-2 order-sm-1 order-0 text-muted">Card expires at 12/26</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">[*]</span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" value="{{$pegawai->nomor_kontrak}}" name="nomor_kontrak" aria-label="Amount (to the nearest dollar)" />
                                                        <label>Nomor Kontrak</label>
                                                    </div>
                                                    <span class="input-group-text"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">[*]</span>
                                                <div class="form-floating form-floating-outline">
                                                    <input name="tmt_pegawai" value="{{$pegawai->tmt_pegawai}}" type="text" placeholder="YYYY-MM-DD" id="flatpickr-disabled-range" class="form-control" aria-label="Total" />
                                                    <label>TMT Pegawai</label>
                                                </div>
                                                <span class="input-group-text"></span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">[*]</span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" name="tahun_tmt" value="{{$pegawai->tahun_tmt}}" class="form-control" aria-label="Total" />
                                                    <label>Tahun TMT</label>
                                                </div>
                                                <span class="input-group-text"></span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">[*]</span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" name="bulan_tmt" value="{{$pegawai->bulan_tmt}}" class="form-control" aria-label="Total" />
                                                    <label>Bulan TMT</label>
                                                </div>
                                                <span class="input-group-text"></span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-12 mb-4">
                                            <div class="form-floating form-floating-outline">
                                                <select id="subKategoriSelect" name="id_sub_kategori_rkbu" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                    <option value="{{$pegawai->id_sub_kategori_rkbu}}">{{$pegawai->sub_kategori_rkbu->kode_sub_kategori_rkbu}}. {{$pegawai->sub_kategori_rkbu->nama_sub_kategori_rkbu}}</option>
                                                    @foreach($sub_kategori_rkbus as $sub_kategori)
                                                        <option value="{{ $sub_kategori->id_sub_kategori_rkbu }}">{{ $sub_kategori->kode_sub_kategori_rkbu }}. {{ $sub_kategori->nama_sub_kategori_rkbu }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="form-floating mt-3">
                                                    <input type="text" id="id_sub_kategori_rekening" name="id_sub_kategori_rekening" value="{{$pegawai->sub_kategori_rekening->id_sub_kategori_rekening}}" class="form-control" placeholder="Jenis Belanja">
                                                    <input type="text" id="id_kode_rekening_belanja" name="id_kode_rekening_belanja" value="9cf603bb-bfd0-4b1e-8a24-7339459d9507" class="form-control" placeholder="ID Kategori RKBU" readonly>
                                                </div>
                                                <label for="floatingSelect">Sub Kategori Belanja</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="card mb-4">
                            <h5 class="card-header">Status Validasi Komponen</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <select name="id_status_validasi" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                <option value="{{ $pegawai->id_status_validasi }}">
                                                    {{ $pegawai->status_validasi->nama_validasi }}
                                                </option>
                                                @foreach ($status_validasi as $item)
                                                    <option value="{{ $item->id_status_validasi }}"> 
                                                        {{ $item->nama_validasi}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="id_status_validasi">Status Validasi</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="alert alert-danger mb-4 alert-dismissible" role="alert">
                                            <h6 class="alert-heading mb-1 d-flex align-items-end">
                                                <i class="mdi mdi-alert-outline mdi-20px me-2"></i>
                                                <span>Cek Terlebih dahulu kesesuaian Data !!!</span>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    <div class="card mb-4">
                        <h5 class="card-header">Detail Penghasilan</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Penghasilan Pegawai</h6>
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="added-cards">
                                            <div class="cardMaster bg-lighter p-3 rounded mb-3">
                                                <div class="d-flex justify-content-between flex-sm-row flex-column">
                                                    <div class="card-information me-2">
                                                        <div class="d-flex align-items-center mb-1 flex-wrap gap-2">
                                                            <h6 class="mb-0 me-2 fw-semibold">Harga Gaji Pokok : </h6>
                                                        </div>
                                                        <div class="input-group input-group-floating">
                                                            <span class="input-group-text bg-lighter">Rp.</span>
                                                            <div class="form-floating">
                                                                <input type="text" id="gaji_pokok" value="{{$pegawai->gaji_pokok}}" name="gaji_pokok" onkeyup="tot_remunerasi();" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
                                                                <label for="basic-addon21">Harga Satuan</label>
                                                            </div>
                                                            <span class="form-floating-focused"></span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column text-start text-lg-end">
                                                        <div class="input-group input-group-floating">
                                                            <span class="input-group-text bg-lighter">x</span>
                                                            <div class="form-floating">
                                                                <input type="number" id="koefisien_gaji" value="{{$pegawai->koefisien_gaji}}" name="koefisien_gaji" onkeyup="tot_remunerasi();" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
                                                                <label for="basic-addon21">Koefisien Gaji</label>
                                                            </div>
                                                            <span class="form-floating-focused"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">[*]</span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="number" class="form-control" value="{{$pegawai->bpjs_kesehatan}}" id="bpjs_kesehatan" name="bpjs_kesehatan" onkeyup="tot_remunerasi();" aria-label="Amount (to the nearest dollar)" />
                                                        <label>BPJS Kesehatan</label>
                                                    </div>
                                                    <span class="input-group-text"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">[*]</span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="number" id="bpjs_tk" value="{{$pegawai->bpjs_tk}}" name="bpjs_tk" onkeyup="tot_remunerasi();" class="form-control" aria-label="Total" />
                                                    <label>BPJS TK</label>
                                                </div>
                                                <span class="input-group-text"></span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">[*]</span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="bpjs_jht" value="{{$pegawai->bpjs_jht}}" name="bpjs_jht" onkeyup="tot_remunerasi();" class="form-control" aria-label="Total" />
                                                    <label>BPJS JHT</label>
                                                </div>
                                                <span class="input-group-text"></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <h6>Penghasilan Pegawai</h6>
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="added-cards">
                                            <div class="cardMaster bg-lighter p-3 rounded mb-3">
                                                <div class="d-flex justify-content-between flex-sm-row flex-column">
                                                    <div class="card-information me-2">
                                                        <div class="d-flex align-items-center mb-1 flex-wrap gap-2">
                                                            <h6 class="mb-0 me-2 fw-semibold">Harga Remunerasi : </h6>
                                                        </div>
                                                        <div class="input-group input-group-floating">
                                                            <span class="input-group-text bg-lighter">Rp.</span>
                                                            <div class="form-floating">
                                                                <input type="text" id="remunerasi" value="{{$pegawai->remunerasi}}" name="remunerasi" onkeyup="tot_remunerasi();" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
                                                                <label for="basic-addon21">Harga Satuan</label>
                                                            </div>
                                                            <span class="form-floating-focused"></span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column text-start text-lg-end">
                                                        <div class="input-group input-group-floating">
                                                            <span class="input-group-text bg-lighter">x</span>
                                                            <div class="form-floating">
                                                                <input type="number" id="koefisien_remunerasi" value="{{$pegawai->koefisien_remunerasi}}" name="koefisien_remunerasi" onkeyup="tot_remunerasi();" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
                                                                <label for="basic-addon21">Koefisien Remunerasi</label>
                                                            </div>
                                                            <span class="form-floating-focused"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="added-cards">
                                            <div class="cardMaster bg-lighter p-3 rounded mb-3">
                                                <div class="d-flex justify-content-between flex-sm-row flex-column">
                                                    <div class="card-information me-2">
                                                        <div class="d-flex align-items-center mb-1 flex-wrap gap-2">
                                                            <h6 class="mb-0 me-2 fw-semibold">Total Gaji Pokok : </h6>
                                                        </div>
                                                        <div class="input-group input-group-floating">
                                                            <span class="input-group-text bg-lighter">Rp.</span>
                                                            <div class="form-floating">
                                                                <input id="tot_gaji_pokok" name="total_gaji_pokok" value="{{$pegawai->total_gaji_pokok}}" onkeyup="tot_remunerasi();" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
                                                                <label for="basic-addon21">Total Gaji</label>
                                                            </div>
                                                            <span class="form-floating-focused"></span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column text-start text-lg-end">
                                                        <div class="d-flex align-items-center mb-1 flex-wrap gap-2">
                                                            <h6 class="mb-0 me-2 fw-semibold">Total Remunerasi : </h6>
                                                        </div>
                                                        <div class="input-group input-group-floating">
                                                            <span class="input-group-text bg-lighter">Rp.</span>
                                                            <div class="form-floating">
                                                                <input type="number" id="remun" value="{{$pegawai->total_remunerasi}}" name="total_remunerasi" onkeyup="tot_remunerasi();" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
                                                                <label for="basic-addon21">Total Remun</label>
                                                            </div>
                                                            <span class="form-floating-focused"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="added-cards">
                                            <div class="cardMaster bg-lighter p-3 rounded mb-3">
                                                <div class="d-flex justify-content-between flex-sm-row flex-column">
                                                    <div class="card-information me-2">
                                                        <div class="d-flex align-items-center mb-1 flex-wrap gap-2">
                                                            <h6 class="mb-0 me-2 fw-semibold">Total Penghasilan </h6>
                                                        </div>
                                                        <div class="input-group input-group-floating">
                                                            <span class="input-group-text bg-lighter">Rp.</span>
                                                            <div class="form-floating">
                                                                <input id="total_pegawai" value="{{$pegawai->total_anggaran}}" name="total_anggaran" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
                                                                <label for="basic-addon21">Total Penghasilan</label>
                                                            </div>
                                                            <span class="form-floating-focused"></span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="{{route('validasi_pegawai_non_pnss.index')}}" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
</div>
@endsection