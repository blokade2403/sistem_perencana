@extends('layouts.main')
@section('container')
 
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form class="needs-validation" method="POST" action="{{ route('usulan_belanja_barjas_admin_ppks.update', $usulan_barang_details->id_usulan_barang_detail) }}" id="confirmSubmitForm" enctype="multipart/form-data" validate>
    @csrf
    @method('PUT')
        <!-- Content -->
            <div class="col-xl-12">
                <div class="card-body">
                    <div class="card mb-4">
                        <!-- Current Plan -->
                        <h5 class="card-header">Komponen Belanja</h5>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="assets/img/illustrations/girl-verify-password-light.png" alt="girl-verify-password-light" width="120" height="75" class="img-fluid" data-app-light-img="illustrations/girl-verify-password-light.png" data-app-dark-img="illustrations/girl-verify-password-dark.png" />
                                        </div>
                                        <div class="col-md-6">
                                            <div class="alert alert-warning mb-4 alert-dismissible" role="alert">
                                                <span class="ms-4 ps-1"></span>
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">Komponen</span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" name="nama_barang" value="{{$usulan_barang_details->rkbu->nama_barang}}" class="form-control" aria-label="Amount (to the nearest dollar)" />
                                                        <input type="hidden" class="form-control" name="id_rkbu" value="{{$usulan_barang_details->id_rkbu}}">
                                                        <input type="hidden" name="id_usulan_barang_detail" class="form-control" value="{{$usulan_barang_details->id_usulan_barang_detail}}">
                                                        <label>Komponen Barang</label>
                                                    </div>
                                                    <span class="input-group-text"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            @if ($rkbu)
                                                <div class="alert alert-warning mb-4 alert-dismissible" role="alert">
                                                    <span class="ms-4 ps-1">Sisa Volume : </span>
                                                    <span class="text-danger">{{ $rkbu->sisa_vol_rkbu }}</span>
                                                    <span class="text-danger fa-ms"></span><br />
                                                    <span class="ms-4 ps-1">Sisa Anggaran </span>
                                                    <span class="text-danger">Rp. {{ number_format($rkbu->sisa_anggaran_rkbu, 0, ',', '.') }}</span>
                                                    <span class="text-danger fa-ms"></span>
                                                </div>
                                            @else
                                                <div class="alert alert-danger" role="alert">
                                                    Data RKBU tidak ditemukan!
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /Current Plan -->
                    </div>
                    <div class="card mb-4">
                        <div class="m-3"> @if(session('lebih'))
                            <div class="alert alert-danger">
                                {{ session('lebih') }}
                            </div>
                            @endif</div>
                        <h5 class="card-header">Detail Komponen</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" onkeyup="sum_modal();" name="vol_1_detail" id="vol_1" value="{{$usulan_barang_details->vol_1_detail}}" class="form-control" placeholder="John Doe" />
                                                <label for="paymentName">Volume</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <select name="satuan_1_detail" id="satuan_1" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                    <option value="{{$usulan_barang_details->satuan_1_detail}}">{{$usulan_barang_details->satuan_1_detail}}</option>
                                                    @foreach ($uraian1 as $item)
                                                    <option value="{{$item->nama_uraian_1}}">{{$item->nama_uraian_1}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="floatingSelect">Satuan 1</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" onkeyup="sum_modal();" name="vol_2_detail" id="vol_2" value="{{$usulan_barang_details->vol_2_detail}}" class="form-control" placeholder="John Doe" />
                                                <label for="paymentName">Volume</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <select name="satuan_2_detail" id="satuan_2" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                    <option value="{{$usulan_barang_details->satuan_2_detail}}">{{$usulan_barang_details->satuan_2_detail}}</option>
                                                    @foreach ($uraian2 as $item)
                                                    <option value="{{$item->nama_uraian_2}}">{{$item->nama_uraian_2}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="floatingSelect">Satuan 2</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <textarea class="form-control" name="spek_detail" id="spek" rows="5" placeholder="Spesifikasi" required>{{$usulan_barang_details->spek_detail}}</textarea>
                                                    <label for="paymentCard">Spesifikasi Komponen</label>
                                                </div>
                                                <span class="input-group-text cursor-pointer p-1" id="paymentCard2"><span class="card-type"></span></span>
                                            </div>
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
                                                                <input id="harga_barang" name="harga_barang" onkeyup="sum_modal();" value="{{$usulan_barang_details->harga_barang}}" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
                                                                <label for="basic-addon21">Harga Satuan</label>
                                                            </div>
                                                            <span class="form-floating-focused"></span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column text-start text-lg-end">
                                                        <div class="form-floating">
                                                            <input id="jumlah_usulan_barang" name="jumlah_usulan_barang" value="{{$usulan_barang_details->jumlah_usulan_barang}}" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
                                                            <label for="basic-addon21">Total Usulan</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-floating form-floating-outline">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">PPN</span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" step="0.01" min="0" max="100" class="form-control" onkeyup="sum_modal();" name="ppn" id="ppn" value="{{$usulan_barang_details->ppn}}" aria-label="Amount (to the nearest dollar)" />
                                                        <input type="text" name="total_ppn" id="hasil_ppn" value="{{$usulan_barang_details->total_ppn}}" class="form-control" readonly />
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
                                                    <input type="text" name="total_anggaran_usulan_barang" id="hasil" class="form-control" value="{{$usulan_barang_details->total_anggaran_usulan_barang}}" aria-label="Total" readonly />
                                                    <label>Total Anggaran</label>
                                                </div>
                                                <span class="input-group-text">,-</span>
                                            </div>
                                        </div>
                                        {{-- <div class="col-6 col-md-12">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">Link Ekatalog</span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" name="link_ekatalog" value="" class="form-control" aria-label="Amount (to the nearest dollar)" />
                                                    <label>Link Ekatalog</label>
                                                </div>
                                                <span class="input-group-text">.com</span>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-6 col-md-12">
                                            <div class="form-floating form-floating-outline">
                                                <select name="id_sub_kategori_rkbu" id="cari_kategori" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                    <option value=""></option>
                                                </select>
                                                <label for="floatingSelect">Sub Kategori Belanja</label>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="{{route('usulan_belanja_barjas_admin_ppks.show', ['id_usulan_barang' => $usulan_barang_details->id_usulan_barang])}}" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--/ Header -->
</form>
@endsection