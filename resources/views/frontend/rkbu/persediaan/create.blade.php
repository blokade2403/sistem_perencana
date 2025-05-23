@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
    
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <form class="needs-validation" action="{{route('rkbu_persediaans.store')}}"  method="POST" id="confirmSubmitForm" enctype="multipart/form-data" validate>
            @csrf
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
                                                    <input type="text" name="barang" id="nama_komponen" readonly class="form-control" placeholder="cari data komponen klik tombol cari -->" aria-label="Example text with button addon" aria-describedby="button-addon1" />
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exLargeModal">
                                                        <i class="mdi mdi-magnify"></i></button>
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
                                                                <input type="text" name="nama_barang" class="form-control" placeholder="Nama Kebutuhan Barang">
                                                                <input type="hidden" name="id_status_validasi" class="form-control" value="">
                                                                <input type="hidden" name="jumlah_vol" class="form-control">
                                                                <input type="hidden" name="status_komponen" class="form-control">
                                                                <input type="hidden" name="sisa_vol_rkbu" class="form-control">
                                                                <input type="hidden" name="nama_lengkap" class="form-control" value="">
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
                        <h5 class="card-header">Detail Komponen</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="col-12 col-md-6">
                                            <div class="input-group">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="number" class="form-control" id="sisa_stok" name="stok" onkeyup="total();" placeholder="1" aria-label="Amount (to the nearest dollar)" id="vol1" onkeyup="sum();" required />
                                                    <label for="basic-addon11">Sisa Stok s/d Des {{$angka_kurang_2}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <select name="satuan_1" id="satuan_1" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                    <option data-display="Select">-- Please Select --</option>
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
                                                    <input type="number" class="form-control" id="rata_rata_pemakaian" name="rata_rata_pemakaian" onkeyup="total();" placeholder="1" aria-label="Amount (to the nearest dollar)" />
                                                    <label for="basic-addon11">Rata-rata Pemakaian {{$angka_kurang_1}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="number" class="form-control" id="pengadaan_sebelumnya" name="pengadaan_sebelumnya" onkeyup="total();" placeholder="1" aria-label="Amount (to the nearest dollar)" />
                                                    <label for="basic-addon11">Pengadaan {{$angka_kurang_1}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="number" class="form-control" id="kebutuhan_per_bulan" name="kebutuhan_per_bulan" onkeyup="total();" placeholder="1" aria-label="Amount (to the nearest dollar)" />
                                                    <label for="basic-addon11">Kebutuhan (Bulan)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="number" class="form-control" id="buffer" name="buffer" onkeyup="total();" placeholder="1" aria-label="Amount (to the nearest dollar)" />
                                                    <label for="basic-addon11">Buffer</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <textarea class="form-control" name="spek" id="spek" rows="5" placeholder="Spesifikasi" required></textarea>
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
                                                                <input id="harga_satuan" name="harga_satuan" onkeyup="total();" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
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
                                                            <input id="proyeksi_sisa_stok" name="proyeksi_sisa_stok" onkeyup="total();" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
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
                                                        <input id="kebutuhan_tahun_x1" name="kebutuhan_tahun_x1" onkeyup="total();" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
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
                                                        <input id="kebutuhan_plus_buffer" name="kebutuhan_plus_buffer" onkeyup="total();" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
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
                                                        <input id="rencana_pengadaan_tahun_x1" name="rencana_pengadaan_tahun_x1" onkeyup="total();" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
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
                                                        <input type="number" step="0.01" min="0" max="100" class="form-control" id="persen" name="ppn" onkeyup="total();" aria-label="Amount (to the nearest dollar)" />
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
                                                    <input type="text" name="total_anggaran" id="total_persediaan" class="form-control" placeholder=" 1,000,000" aria-label="Total" readonly />
                                                    <label>Total Anggaran</label>
                                                </div>
                                                <span class="input-group-text">,-</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-12">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">Link Ekatalog</span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" name="link_ekatalog" class="form-control" aria-label="Amount (to the nearest dollar)" />
                                                    <label>Link Ekatalog</label>
                                                </div>
                                                <span class="input-group-text">.com</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-12">
                                            <div class="form-floating form-floating-outline">
                                                <select id="subKategoriSelect" name="id_sub_kategori_rkbu" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                    <option data-display="Select">Pilih Sub Kategori RKBU</option>
                                                    @foreach($sub_kategori_rkbus as $sub_kategori)
                                                        <option value="{{ $sub_kategori->id_sub_kategori_rkbu }}">{{ $sub_kategori->kode_sub_kategori_rkbu }}. {{ $sub_kategori->nama_sub_kategori_rkbu }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="floatingSelect">Sub Kategori Belanja</label>
                                                 <div class="form-floating mt-3 mb-3">
                                                    <input type="hidden" id="id_sub_kategori_rekening" name="id_sub_kategori_rekening" class="form-control" placeholder="Jenis Belanja">
                                                    <input type="hidden" id="id_kode_rekening_belanja" name="id_kode_rekening_belanja" value="9cf603bb-bfd0-4b1e-8a24-7339459d9507" class="form-control" placeholder="ID Kategori RKBU" readonly>
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
                                        <!--/ Modal -->
                                    </div>
                                </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                        <a href="{{route('rkbu_persediaans.index')}}" class="btn btn-outline-secondary">Kembali</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
</div>
@endsection