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
        <form class="needs-validation" action="{{route('validasi_persediaans.update', $rkbuPersediaan->id_rkbu)}}"  method="POST" id="confirmSubmitForm" enctype="multipart/form-data" validate>
            @csrf
            @method('PUT')
            <div class="col-xl-12">
                <div class="card-body">
                    <div class="card mb-4">
                        <h5 class="card-header">Komponen Belanja 2</h5>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="mb-4">
                                        <div class="form-floating form-floating-outline">
                                            <div class="input-group input-group-merge">
                                                <div class="input-group">
                                                    <input type="text" name="nama_barang" id="nama_komponen" value="{{ $rkbuPersediaan->nama_barang }}" class="form-control" placeholder="cari data komponen klik tombol cari -->" aria-label="Example text with button addon" aria-describedby="button-addon1" />
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
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group">
                                                        <input type="hidden" name="jumlah_vol" value="{{ $rkbuPersediaan->jumlah_vol }}" class="form-control">
                                                        <input type="hidden" name="status_komponen" value="{{ $rkbuPersediaan->status_komponen }}" class="form-control">
                                                        <input type="hidden" name="sisa_vol_rkbu" value="{{ $rkbuPersediaan->sisa_vol_rkbu }}" class="form-control">
                                                        <input type="hidden" name="nama_lengkap" class="form-control" value="{{ $rkbuPersediaan->nama_lengkap }}">
                                                        <input type="hidden" name="id_user" value="{{ $rkbuPersediaan->id_user }}">
                                                        <input type="hidden" name="nama_tahun_anggaran" value="{{ $rkbuPersediaan->nama_tahun_anggaran }}">    
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
                                            <div class="input-group">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="number" class="form-control" id="sisa_stok" value="{{$rkbuPersediaan->stok}}" name="stok" onkeyup="total();" placeholder="1" aria-label="Amount (to the nearest dollar)" id="vol1" onkeyup="sum();" required />
                                                    <label for="basic-addon11">Sisa Stok s/d Des {{$angka_kurang_2}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <select name="satuan_1" id="satuan_1" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                    <option value="{{$rkbuPersediaan->satuan_1}}">{{$rkbuPersediaan->satuan_1}}</option>
                                                    @foreach ($uraian_satu as $item)
                                                    <option value="{{$item->nama_uraian_1}}">{{$item->nama_uraian_1}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="floatingSelect">Satuan 1</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="number" class="form-control" id="rata_rata_pemakaian" value="{{$rkbuPersediaan->rata_rata_pemakaian}}" name="rata_rata_pemakaian" onkeyup="total();" placeholder="1" aria-label="Amount (to the nearest dollar)" />
                                                    <label for="basic-addon11">Rata-rata Pemakaian {{$angka_kurang_1}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="number" class="form-control" id="pengadaan_sebelumnya" value="{{$rkbuPersediaan->pengadaan_sebelumnya}}" name="pengadaan_sebelumnya" onkeyup="total();" placeholder="1" aria-label="Amount (to the nearest dollar)" />
                                                    <label for="basic-addon11">Pengadaan {{$angka_kurang_1}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="number" class="form-control" id="kebutuhan_per_bulan" value="{{$rkbuPersediaan->kebutuhan_per_bulan}}" name="kebutuhan_per_bulan" onkeyup="total();" placeholder="1" aria-label="Amount (to the nearest dollar)" />
                                                    <label for="basic-addon11">Kebutuhan (Bulan)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="number" class="form-control" id="buffer" value="{{$rkbuPersediaan->buffer}}" name="buffer" onkeyup="total();" placeholder="1" aria-label="Amount (to the nearest dollar)" />
                                                    <label for="basic-addon11">Buffer</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <textarea class="form-control" name="spek" id="spek" rows="5" placeholder="Spesifikasi" required>{{$rkbuPersediaan->spek}}</textarea>
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
                                <div class="col-md-6 ">
                                    <h6>My Cards</h6>
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
                                                                <input id="harga_satuan" name="harga_satuan" value="{{$rkbuPersediaan->harga_satuan}}" onkeyup="total();" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
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
                                                    <div class="input-group input-group-floating">
                                                        <span class="input-group-text bg-lighter">[<a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Prediksi Sisa Stok s/d Desember <?php echo $angka_tahun; ?> = (Sisa Stok Desember <?php echo $angka_tahun - 2; ?> + Pengadaan Tahun <?php echo $angka_tahun - 1; ?>) - (Rata2 Pemakaian Per Bulan Selama <?php echo $angka_tahun - 1; ?> X Kebutuhan/Bulan)"><span class="tf-icons mdi mdi-information-variant me-1">]</span></a></span>
                                                        <div class="form-floating">
                                                            <input id="proyeksi_sisa_stok" name="proyeksi_sisa_stok" value="{{$rkbuPersediaan->proyeksi_sisa_stok}}" onkeyup="total();" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
                                                            <label for="basic-addon21">Prediksi Sisa Stok Tahun {{$angka_tahun}}</label>
                                                        </div>
                                                        <span class="form-floating-focused"></span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <div class="input-group input-group-floating">
                                                    <span class="input-group-text bg-lighter">[<a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kebutuhan Tahun <?php echo $angka_tahun; ?> = Rata2 Pemakaian Per Bulan Selama <?php echo $angka_tahun - 1; ?> X Kebutuhan/Bulan"><span class="tf-icons mdi mdi-information-variant me-1">]</span></a></span>
                                                    <div class="form-floating">
                                                        <input id="kebutuhan_tahun_x1" name="kebutuhan_tahun_x1" value="{{$rkbuPersediaan->kebutuhan_tahun_x1}}" onkeyup="total();" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
                                                        <label for="basic-addon21">Perkiraan Kebutuhan Tahun {{$angka_tahun}}</label>
                                                    </div>
                                                    <span class="form-floating-focused"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <div class="input-group input-group-floating">
                                                    <span class="input-group-text bg-lighter">[<a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kebutuhan Tahun <?php echo $angka_tahun; ?> + Buffer = Perkiraan Kebutuhan Tahun <?php echo $angka_tahun; ?> + (Rata2 Pemakaian Per Bulan Selama <?php echo $angka_tahun - 1; ?> X Buffer Bulan)"><span class="tf-icons mdi mdi-information-variant me-1">]</span></a></span>
                                                    <div class="form-floating">
                                                        <input id="kebutuhan_plus_buffer" name="kebutuhan_plus_buffer" value="{{$rkbuPersediaan->kebutuhan_plus_buffer}}" onkeyup="total();" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
                                                        <label for="basic-addon21">Kebutuhan Tahun {{$angka_tahun}} + Buffer</label>
                                                    </div>
                                                    <span class="form-floating-focused"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <div class="input-group input-group-floating">
                                                    <span class="input-group-text bg-lighter">[<a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Rencana Pengadaan Tahun <?php echo $angka_tahun; ?> = Kebutuhan Tahun <?php echo $angka_tahun; ?> + Buffer - Prediksi Sisa Stok s/d Desember <?php echo $angka_tahun; ?>"><span class="tf-icons mdi mdi-information-variant me-1">]</span></a></span>
                                                    <div class="form-floating">
                                                        <input id="rencana_pengadaan_tahun_x1" name="rencana_pengadaan_tahun_x1" value="{{$rkbuPersediaan->rencana_pengadaan_tahun_x1}}" onkeyup="total();" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
                                                        <label for="basic-addon21">Rencana Pengadaan Tahun {{$angka_tahun}}</label>
                                                    </div>
                                                    <span class="form-floating-focused"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-floating form-floating-outline">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">PPN</span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="number" step="0.01" min="0" max="100" class="form-control" value="{{$rkbuPersediaan->ppn}}" id="persen" name="ppn" onkeyup="total();" aria-label="Amount (to the nearest dollar)" />
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
                                                    <input type="text" name="total_anggaran" id="total_persediaan" value="{{$rkbuPersediaan->total_anggaran}}" class="form-control" placeholder=" 1,000,000" aria-label="Total" readonly />
                                                    <label>Total Anggaran</label>
                                                </div>
                                                <span class="input-group-text">,-</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-12">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">Link Ekatalog</span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" name="link_ekatalog" class="form-control" value="{{$rkbuPersediaan->link_ekatalog}}" aria-label="Amount (to the nearest dollar)" />
                                                    <label>Link Ekatalog</label>
                                                </div>
                                                <span class="input-group-text">.com</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-12">
                                            <div class="form-floating form-floating-outline">
                                                <select id="subKategoriSelect" name="id_sub_kategori_rkbu" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                    <option value="{{$rkbuPersediaan->id_sub_kategori_rkbu}}">{{$rkbuPersediaan->subKategoriRkbu->kode_sub_kategori_rkbu}}. {{$rkbuPersediaan->subKategoriRkbu->nama_sub_kategori_rkbu}}</option>
                                                    @foreach($sub_kategori_rkbus as $sub_kategori)
                                                        <option value="{{ $sub_kategori->id_sub_kategori_rkbu }}">{{ $sub_kategori->kode_sub_kategori_rkbu }}. {{ $sub_kategori->nama_sub_kategori_rkbu }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="floatingSelect">Sub Kategori Belanja</label>
                                                 <div class="form-floating mt-3 mb-3">
                                                    <input type="text" id="id_sub_kategori_rekening" value="{{$rkbuPersediaan->id_sub_kategori_rekening}}" name="id_sub_kategori_rekening" class="form-control" placeholder="Jenis Belanja">
                                                    <input type="text" id="id_kode_rekening_belanja" value="{{$rkbuPersediaan->id_kode_rekening_belanja}}" name="id_kode_rekening_belanja" value="9cf603bb-bfd0-4b1e-8a24-7339459d9507" class="form-control" placeholder="ID Kategori RKBU" readonly>
                                                </div>
                                                <input type="hidden" id="id_kategori_rkbu" name="id_kategori_rkbu" onkeyup="tea();" class="form-control">
                                            </div>
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
                    <div class="card mb-4">
                        <h5 class="card-header">Status Validasi Komponen</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <select name="id_status_validasi" class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option value="{{ $rkbuPersediaan->id_status_validasi }}">
                                                {{ $rkbuPersediaan->status_validasi->nama_validasi }}
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
                                            <div class="col-12">
                                                <label class="switch">
                                                    <input type="checkbox" class="switch-input" />
                                                    <span class="switch-toggle-slider">
                                                        <span class="switch-on"></span>
                                                        <span class="switch-off"></span>
                                                    </span>
                                                    <span class="switch-label">Save card for future billing?</span>
                                                </label>
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
                                        <!--/ Modal -->
                                    </div>
                                </div>
                                    {{-- <div class="mt-2">
                                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#onboardImageModal" onclick="saveChanges()">Save changes</button>
                                        <a href="" class="btn btn-outline-secondary">Discard</a>
                                    </div> --}}
                                    <div class="mt-2">
                                        @if ($rkbuPersediaan->id_status_validasi_rka == '9cfb1f87-238b-4ea2-98f0-4255e578b1d1')
                                        <button type="submit" class="btn btn-primary me-2" disabled>Save changes</button>
                                        @else
                                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                        @endif
                                        <a href="{{route('validasi_persediaans.index')}}" class="btn btn-outline-secondary">Kembali</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
</div>
@endsection