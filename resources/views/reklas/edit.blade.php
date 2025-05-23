@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
            <!-- row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card-body">
                        <form id="confirmSubmitForm"  method="POST" action="{{route('reklas_arbs.update', $asset->id_asset)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card mb-4">
                                <h5 class="card-header">Data Asset</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="col-12 mb-3">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <input id="paymentCard" name="nama_asset" value="{{$asset->nama_asset}}" class="form-control credit-card-mask" placeholder="Nama Asset" type="text" aria-describedby="paymentCard2" />
                                                        <label for="paymentCard">Nama Asset</label>
                                                    </div>
                                                    <span class="input-group-text cursor-pointer p-1" id="paymentCard2"><span class="card-type"></span></span>
                                                </div>
                                            </div>
                                            <div id="creditCardForm" class="row g-4">
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" name="kode_asset" value="{{$asset->kode_asset}}" id="paymentName" class="form-control" placeholder="Kode Barang" />
                                                        <label for="paymentName">Kode Barang</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="form-floating form-floating-outline">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" name="no_register" value="{{$asset->no_register}}" id="paymentExpiryDate" class="form-control expiry-date-mask" placeholder="MM/YY" />
                                                            <label for="paymentExpiryDate">No Registrasi</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div id="creditCardForm" class="row g-4">
                                                <div class="col-12 col-md-12 mb-3">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="hibah" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option value="{{$asset->hibah}}">{{$asset->hibah}}</option>
                                                            <option value="Asset Tetap">Asset Tetap</option>
                                                            <option value="Hibah">Hibah</option>
                                                        </select>
                                                        <label for="floatingSelect">Kategori Asset</label>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                        </div>
                                        <div class="col-md-6 mt-5 mt-md-0">
                                            <h6>Assets Detail</h6>
                                            <div class="added-cards">
                                                <div class="cardMaster bg-lighter p-3 rounded mb-3">
                                                    <div class="d-flex justify-content-between flex-sm-row flex-column">
                                                        <div class="card-information me-2">
                                                            <div class="d-flex align-items-center mb-1 flex-wrap gap-2">
                                                                <h6 class="mb-0 me-2 fw-semibold">Serial Number : </h6>
                                                            </div>
                                                            <div class="input-group input-group-floating">
                                                                <span class="input-group-text bg-lighter">[*]</span>
                                                                <div class="form-floating">
                                                                    <input name="serial_number" value="{{$asset->serial_number}}" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
                                                                    <label for="basic-addon21">SN</label>
                                                                </div>
                                                                <span class="form-floating-focused"></span>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column text-start text-lg-end">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="cardMaster bg-lighter p-3 rounded mb-3">
                                                    <div class="d-flex justify-content-between flex-sm-row flex-column">
                                                        <div class="card-information me-2">
                                                            <div class="d-flex align-items-center mb-1 flex-wrap gap-2">
                                                                <h6 class="mb-0 me-2 fw-semibold">Upload Gambar Asset : </h6>
                                                            </div>
                                                            <div class="mb-3">
                                                                <input class="form-control" type="file" name="foto" id="formFileMultiple" multiple />
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column text-start text-lg-end">

                                                            <small class="mt-sm-auto mt-2 order-sm-1 order-0 text-muted">Upload Gambar/ Take Picture</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="creditCardForm" class="row g-4">
                                                    <div class="col-12 col-md-12 mb-3">
                                                        <div class="form-floating form-floating-outline">
                                                            <input name="pengguna_asset" value="{{$asset->pengguna_asset}}" class="form-control bg-label-info" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
                                                            <label for="basic-addon21">Pengguna Asset</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- Modal -->
                                            <!-- Add New Credit Card Modal -->
                                            <div class="modal fade" id="editCCModal" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-simple modal-add-new-cc">
                                                    <div class="modal-content p-3 p-md-5">
                                                        <div class="modal-body p-md-0">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            <div class="text-center mb-4">
                                                                <h3 class="mb-2 pb-1">Edit Card</h3>
                                                                <p>Edit your saved card details</p>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="input-group input-group-merge">
                                                                    <div class="form-floating form-floating-outline">
                                                                        <input id="modalEditCard" name="modalEditCard" class="form-control credit-card-mask-edit" type="text" placeholder="4356 3215 6548 7898" value="4356 3215 6548 7898" aria-describedby="modalEditCard2" />
                                                                        <label for="modalEditCard">Card Number</label>
                                                                    </div>
                                                                    <span class="input-group-text cursor-pointer p-1" id="modalEditCard2"><span class="card-type-edit"></span></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-floating form-floating-outline">
                                                                    <input type="text" id="modalEditName" class="form-control" placeholder="John Doe" value="John Doe" />
                                                                    <label for="modalEditName">Name</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="switch">
                                                                    <input type="checkbox" class="switch-input" />
                                                                    <span class="switch-toggle-slider">
                                                                        <span class="switch-on"></span>
                                                                        <span class="switch-off"></span>
                                                                    </span>
                                                                    <span class="switch-label">Set as primary card</span>
                                                                </label>
                                                            </div>
                                                            <div class="col-12 text-center">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div id="creditCardForm" class="row g-4">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" name="tgl_bpkb" value="{{$asset->tgl_bpkb}}" class="form-control" placeholder="John Doe" />
                                                        <label for="paymentName">Tanggal BPKB</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" name="no_rangka" value="{{$asset->no_rangka}}" class="form-control" placeholder="John Doe" />
                                                            <label for="paymentName">Nomor Rangka</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div id="creditCardForm" class="row g-4">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" name="no_mesin" value="{{$asset->no_mesin}}" class="form-control" placeholder="John Doe" />
                                                        <label for="paymentName">Nomor Mesin</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" name="no_polisi" value="{{$asset->no_polisi}}" class="form-control" placeholder="John Doe" />
                                                            <label for="paymentName">Nomor Polisi</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <h5 class="card-header">Detail Asset</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div id="creditCardForm" class="row g-4">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" name="type" value="{{$asset->type}}" class="form-control" placeholder="John Doe" />
                                                        <label for="paymentName">Type</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="id_jenis_kategori_rkbu" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option  value="{{$asset->id_jenis_kategori_rkbu}}"> {{$asset->nama_jenis_kategori_rkbu}}</option>
                                                            @foreach ($jenis as $item)
                                                                <option value="{{$item->id_jenis_kategori_rkbu}}">{{$item->nama_jenis_kategori_rkbu}}</option>
                                                            @endforeach
                                                        </select>
                                                        <label for="floatingSelect">Jenis Asset</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" value="{{$asset->merk}}" name="merk" class="form-control" placeholder="merk" />
                                                        <label for="paymentName">Merk</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" name="tahun_perolehan" value="{{$asset->tahun_perolehan}}" class="form-control" placeholder="Tahun Perolehan" />
                                                        <label for="floatingSelect">Tahun Perolehan</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="input-group input-group-merge">
                                                        <div class="form-floating form-floating-outline">
                                                            <textarea class="form-control" name="spek" id="spek" rows="5" placeholder="Spesifikasi" required>{{$asset->spek}}</textarea>
                                                            <label for="paymentCard">Spesifikasi Komponen</label>
                                                        </div>
                                                        <span class="input-group-text cursor-pointer p-1" id="paymentCard2"><span class="card-type"></span></span>
                                                    </div>
                                                </div>
                                                  
                                                <div class="col-12">
                                                    <hr>
                                                    <small class="text-light fw-semibold">Pilih Kondisi Asset</small></p>
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="kondisi_asset" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option value="{{$asset->kondisi_asset}}">{{$asset->kondisi_asset}}</option>
                                                            <option value="Baik">Baik</option>
                                                            <option value="Rusak Ringan">Rusak Ringan</option>
                                                            <option value="Rusak Berat">Rusak Berat</option>
                                                        </select>
                                                        <label for="floatingSelect">Kategori Asset</label>
                                                    </div>
                                                    <hr>
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
                                                                        <input id="harga_barang" name="harga_asset" value="{{$asset->harga_asset}}" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
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
                                                            <span class="input-group-text">Jumlah</span>
                                                            <div class="form-floating form-floating-outline">
                                                                <input type="number" step="1" min="0" max="100" class="form-control" name="jumlah_asset" value="{{$asset->jumlah_asset}}" aria-label="Amount (to the nearest dollar)" />
                                                                <label>Jumlah</label>
                                                            </div>
                                                            <span class="input-group-text"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-8">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="satuan" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option value="{{$asset->satuan}}">{{$asset->satuan}}</option>
                                                            @foreach ($satuan as $item)
                                                                <option value="{{$item->nama_uraian_1}}">{{$item->nama_uraian_1}}</option>
                                                            @endforeach
                                                        </select>
                                                        <label for="floatingSelect">Satuan Asset</label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-12">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="sumber_anggaran" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option value="{{$asset->sumber_anggaran}}">{{$asset->sumber_anggaran}}</option>
                                                                <option value="APBD">APBD</option>
                                                                <option value="BLUD">BLUD</option>
                                                        </select>
                                                        <label for="floatingSelect">Sumber Anggaran</label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-12">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text">Keterangan Asset</span>
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" name="status_asset" value="{{$asset->status_asset}}" class="form-control" aria-label="Amount (to the nearest dollar)" />
                                                            <label>Status</label>
                                                        </div>
                                                        <span class="input-group-text"></span>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="id_penempatan" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            @if ($asset->penempatan)
                                                                <option value="{{ $asset->id_penempatan }}">
                                                                    {{ $asset->penempatan->lokasi_barang }}
                                                                </option>
                                                            @endif   
                                                            @foreach ($penempatan as $item)
                                                            <option value="{{$item->id_penempatan}}">{{$item->lokasi_barang}}</option>
                                                            @endforeach
                                                        </select>
                                                        <label for="floatingSelect">Penempatan Asset</label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="kategori_asset_bergerak" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option value="{{$asset->kategori_asset_bergerak}}">{{$asset->kategori_asset_bergerak}}</option>    
                                                            <option value="Handphone">Handphone</option>
                                                            <option value="Tablet">Tablet</option>
                                                            <option value="Laptop">Laptop</option>
                                                        </select>
                                                        <label for="floatingSelect">Kategori Asset Bergerak</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Save Changes</button>
                                        <a href="{{route('reklas_arbs.index')}}" class="btn btn-outline-secondary">Cancel</a>
                                    </div>
                                </div>
                        </form>

                    </div>
                </div>
            </div>
        <!--/ Header -->

    </div>
</div>
</div>
@endsection
