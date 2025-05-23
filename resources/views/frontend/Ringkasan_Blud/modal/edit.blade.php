@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
    
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <form class="needs-validation" action="{{ route('validasi_modal_admins.update', $rkbuBarangJasa->id_rkbu) }}"  method="POST" id="confirmSubmitForm" enctype="multipart/form-data" validate>
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
                                        <div class="form-floating form-floating-outline">
                                            <div class="input-group input-group-merge">
                                                <div class="input-group">
                                                    <input type="text" name="nama_barang" id="nama_komponen" value="{{ $rkbuBarangJasa->nama_barang }}" class="form-control" placeholder="cari data komponen klik tombol cari -->" aria-label="Example text with button addon" aria-describedby="button-addon1" />
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
                                                    <span>ID RKBU : {{ $rkbuBarangJasa->id_rkbu }}</span>
                                                </h6>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group">
                                                        <input type="hidden" name="jumlah_vol" value="{{ $rkbuBarangJasa->jumlah_vol }}" class="form-control">
                                                        <input type="hidden" name="status_komponen" value="{{ $rkbuBarangJasa->status_komponen }}" class="form-control">
                                                        <input type="hidden" name="sisa_vol_rkbu" value="{{ $rkbuBarangJasa->sisa_vol_rkbu }}" class="form-control">
                                                        <input type="hidden" name="nama_lengkap" class="form-control" value="{{ $rkbuBarangJasa->nama_lengkap }}">
                                                        <input type="hidden" name="id_user" value="{{ $rkbuBarangJasa->id_user }}">
                                                        <input type="hidden" name="nama_tahun_anggaran" value="{{ $rkbuBarangJasa->nama_tahun_anggaran }}">    
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
                        <h5 class="card-header">Detail Komponen</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <input type="number" id="vol1" onkeyup="sum();" name="vol_1" value="{{$rkbuBarangJasa->vol_1}}" class="form-control" placeholder="Vol 1" required />
                                                <label for="paymentName">Volume</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <select name="satuan_1" id="satuan_1" class="select2 form-select form-select-lg" data-allow-clear="true" required>
                                                    <option value="{{$rkbuBarangJasa->satuan_1}}">{{$rkbuBarangJasa->satuan_1}}</option>
                                                    @foreach ($uraian_satu as $item)
                                                    <option value="{{$item->nama_uraian_1}}">{{$item->nama_uraian_1}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="floatingSelect">Satuan 1</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <input type="number" id="vol2" onkeyup="sum();" name="vol_2" value="{{$rkbuBarangJasa->vol_2}}" class="form-control" placeholder="Vol 2" required />
                                                <label for="paymentName">Koefisien</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <select name="satuan_2" id="satuan_2" class="select2 form-select form-select-lg" data-allow-clear="true" required>
                                                    <option value="{{$rkbuBarangJasa->satuan_2}}">{{$rkbuBarangJasa->satuan_2}}</option>
                                                    @foreach ($uraian_dua as $item)
                                                    <option value="{{$item->nama_uraian_2}}">{{$item->nama_uraian_2}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="floatingSelect">Satuan 2</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <textarea class="form-control" name="spek" id="spek" rows="5" placeholder="Spesifikasi" required>{{$rkbuBarangJasa->spek}}</textarea>
                                                    <label for="paymentCard">Spesifikasi Komponen</label>
                                                </div>
                                                <span class="input-group-text cursor-pointer p-1" id="paymentCard2"><span class="card-type"></span></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                            <small class="text-light fw-semibold">Pilih Prioritas Usulan Barang</small>
                                            <div class="form-check mt-3">
                                                <input name="rating" class="form-check-input" type="radio" value="Prioritas 1" id="defaultRadio1" />
                                                <label class="form-check-label" for="defaultRadio1"> Prioritas 1 </label>
                                            </div>
                                            <div class="form-check">
                                                <input name="rating" class="form-check-input" type="radio" value="Prioritas 2" id="defaultRadio2" checked />
                                                <label class="form-check-label" for="defaultRadio2"> Prioritas 2 </label>
                                            </div>
                                            <div class="form-check">
                                                <input name="rating" class="form-check-input" type="radio" value="Prioritas 3" id="defaultRadio2" checked />
                                                <label class="form-check-label" for="defaultRadio2"> Prioritas 3 </label>
                                            </div>
                                            <hr>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                                                <input id="harga_barang" name="harga_satuan" onkeyup="sum();" value="{{$rkbuBarangJasa->harga_satuan}}" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
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
                                        <div class="col-12 col-md-4">
                                            <div class="form-floating form-floating-outline">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">PPN</span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="number" step="0.01" min="0" max="100" class="form-control" value="{{$rkbuBarangJasa->ppn}}" id="persen" name="ppn" onkeyup="sum();" aria-label="Amount (to the nearest dollar)" />
                                                        <label>PPN</label>
                                                    </div>
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-8">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">Rp.</span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" name="total_anggaran" id="hasil" class="form-control" value="{{$rkbuBarangJasa->total_anggaran}}" placeholder=" 1,000,000" aria-label="Total" readonly />
                                                    <label>Total Anggaran</label>
                                                </div>
                                                <span class="input-group-text">,-</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-12">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">Link Ekatalog</span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" name="link_ekatalog" class="form-control" value="{{$rkbuBarangJasa->link_ekatalog}}" aria-label="Amount (to the nearest dollar)" />
                                                    <label>Link Ekatalog</label>
                                                </div>
                                                <span class="input-group-text">.com</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-12">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">[*]</span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" name="penempatan" class="form-control" value="{{$rkbuBarangJasa->penempatan}}" aria-label="Amount (to the nearest dollar)" />
                                                    <label>Penemapatan Barang</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-12 mb-4">
                                            <div class="form-floating form-floating-outline">
                                                <select id="subKategoriSelect" name="id_sub_kategori_rkbu" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                    <option value="{{$rkbuBarangJasa->id_sub_kategori_rkbu}}">{{ $rkbuBarangJasa->sub_kategori_rkbu->kode_sub_kategori_rkbu }}. {{ $rkbuBarangJasa->sub_kategori_rkbu->nama_sub_kategori_rkbu }}</option>
                                                    @foreach($sub_kategori_rkbus as $sub_kategori)
                                                        <option value="{{ $sub_kategori->id_sub_kategori_rkbu }}">{{ $sub_kategori->kode_sub_kategori_rkbu }}. {{ $sub_kategori->nama_sub_kategori_rkbu }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="form-floating mt-3">
                                                    <input type="text" id="id_sub_kategori_rekening" name="id_sub_kategori_rekening" value="{{$rkbuBarangJasa->id_sub_kategori_rekening}}" class="form-control" placeholder="Jenis Belanja">
                                                    <input type="text" id="id_kode_rekening_belanja" name="id_kode_rekening_belanja" value="9cf603bb-bfd0-4b1e-8a24-7339459d9507" class="form-control" placeholder="ID Kategori RKBU" readonly>
                                                </div>
                                                <label for="floatingSelect">Sub Kategori Belanja</label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-12 mb-4">
                                            <div class="form-floating form-floating-outline">
                                                <select id="subKategoriSelect2" name="id_kode_rekening_belanja" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                    <option value="{{$rkbuBarangJasa->id_kode_rekening_belanja}}">{{ $rkbuBarangJasa->rekening_belanjas->kode_rekening_belanja}}. {{ $rkbuBarangJasa->rekening_belanjas->nama_rekening_belanja}}</option>
                                                    @foreach($rekening_belanja as $sub_kategori)
                                                        <option value="{{ $sub_kategori->id_kode_rekening_belanja }}">{{ $sub_kategori->kode_rekening_belanja }}. {{ $sub_kategori->nama_rekening_belanja }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="floatingSelect">Rekening Belanja</label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-12 mb-4">
                                            <div class="form-floating form-floating-outline">
                                                <select  name="id_user" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                    <option value="{{$rkbuBarangJasa->id_user}}">{{ $rkbuBarangJasa->users->nama_lengkap}}</option>
                                                    @foreach( $user as $sub_kategori)
                                                        <option value="{{ $sub_kategori->id_user }}">{{ $sub_kategori->nama_lengkap }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="floatingSelect">Pengusul</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="alert alert-primary mb-4 alert-dismissible" role="alert">
                                        <h6 class="alert-heading mb-1 d-flex align-items-end">
                                            <i class="mdi mdi-alert-outline mdi-20px me-2"></i>
                                            <span>Informasi Sub Belanja</span>
                                        </h6>
                                        <div class="accordion mt-3" id="accordionWithIcon">
                                            <span id="nama_kategori_rekening"></span><br>
                                            <span id="nama_sub_kategori_rekening"></span><br>
                                            {{-- <span id="nama_aktivitas"></span><br> --}}
                                            {{-- <span id="nama_program"></span><br>
                                            <span id="nama_kegiatan"></span><br>
                                            <span id="nama_sub_kegiatan"></span><br>
                                            <span id="nama_jenis_belanja"></span><br>
                                            <span id="nama_kategori_rkbu"></span><br> --}}
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
                                        <select name="id_status_validasi_rka" class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option value="{{ $rkbuBarangJasa->id_status_validasi_rka }}">
                                                {{ $rkbuBarangJasa->status_validasi_rka->nama_validasi_rka }}
                                            </option>
                                            @foreach ($status_validasi_rka as $item)
                                                <option value="{{ $item->id_status_validasi_rka }}"> 
                                                    {{ $item->nama_validasi_rka}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="id_status_validasi_rka">Status Validasi</label>
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
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <select name="id_status_validasi" class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option value="{{ $rkbuBarangJasa->id_status_validasi }}">
                                                {{ $rkbuBarangJasa->status_validasi->nama_validasi }}
                                            </option>
                                            @foreach ($status_validasi as $item)
                                                <option value="{{ $item->id_status_validasi }}"> 
                                                    {{ $item->nama_validasi}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="id_status_validasi_rka">Status Validasi KSP/Ka.Ins</label>
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
                        <h5 class="card-header">Upload Data Komponen</h5>
                        <div class="card-body">
                            <div id="formAccountSettings">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="creditCardForm" class="row g-4">
                                            <div class="col-12">
                                                <div class="form-floating form-floating-outline">
                                                    <div class="mb-3">
                                                        <label for="formFileMultiple" class="form-label">Upload Dokumen KAP (Kerangka Acuan Perencanaan)</label>
                                                        <input class="form-control" type="file" name="upload_file_1" id="formFileMultiple" multiple />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating form-floating-outline">
                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">Upload SPH 1</label>
                                                        <input class="form-control" type="file" name="upload_file_2" id="formFile" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="formFileMultiple" class="form-label">Upload SPH 2</label>
                                                        <input class="form-control" type="file" name="upload_file_3" id="formFileMultiple" multiple />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="formFileMultiple" class="form-label">Upload SPH 3</label>
                                                        <input class="form-control" type="file" name="upload_file_4" id="formFileMultiple" multiple />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-5 mt-md-0">
                                        <h6>Contoh File Dokumen Kerangka Acuan Perencanaan (KAP)</h6>
                                        <div class="added-cards">
                                            <div class="cardMaster bg-lighter p-3 rounded mb-3">
                                                <div class="d-flex justify-content-between flex-sm-row flex-column">
                                                    <div class="row">
                                                        <div class="col-3 md-3">
                                                        <img src="assets/img/illustrations/123.png" alt="girl-verify-password-light" width="100" height="75" class="img-fluid" data-app-light-img="illustrations/123.png" data-app-dark-img="illustrations/123.png" />
                                                        </div>
                                                        <div class="col-9 md-3">
                                                            <p><a href="" class="tooltip-test text-primary" data-bs-toggle="tooltip" title="download!">This link download Format</a> Analisa/Telaah Staf/KAK</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        @include('backend.partials.modal_komponen')
                                        @include('frontend.partials.modal_fase_penetapan')
                                        <!--/ Modal -->
                                    </div>
                                </div>
                                    {{-- <div class="mt-2">
                                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#onboardImageModal" onclick="saveChanges()">Save changes</button>
                                        <a href="" class="btn btn-outline-secondary">Discard</a>
                                    </div> --}}
                                    <div class="mt-2">
                                        @if (session('nama_fase') == 'Penetapan')
                                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#onboardImageModal" onclick="saveChanges()">Save changes</button>
                                        <a href="{{route('validasi_barang_jasa_admins.index')}}" class="btn btn-outline-secondary">Kembali</a>
                                        @else
                                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                        <a href="{{route('validasi_barang_jasa_admins.index')}}" class="btn btn-outline-secondary">Kembali</a>
                                        @endif
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
</div>
@endsection