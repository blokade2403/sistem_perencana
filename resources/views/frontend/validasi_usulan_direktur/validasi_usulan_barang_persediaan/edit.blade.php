@extends('layouts.main')
@section('container')
 
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form class="needs-validation" method="POST" action="{{ route('usulan_barang_persediaans.update', $usulan_barang_details->id_usulan_barang_detail) }}" id="confirmSubmitForm" enctype="multipart/form-data" validate>
    @csrf
    @method('PUT')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></h4>
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
                                                        <input type="text" value="{{ $usulan_barang_details->rkbus->nama_barang }}" class="form-control" aria-label="Amount (to the nearest dollar)" />
                                                        <input type="hidden" class="form-control" name="id_rkbu" value="{{ $usulan_barang_details->id_rkbu }}">
                                                        <input type="hidden" name="id_usulan_barang_detail" class="form-control" value="{{ $usulan_barang_details->id_usulan_barang_detail }}">
                                                        <label>Komponen Barang</label>
                                                    </div>
                                                    <span class="input-group-text"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <div class="alert alert-warning mb-4 alert-dismissible" role="alert">
                                                <span class="ms-4 ps-1">Sisa Volume </span><span class="text-end">:</span> <span class="text-danger fa-ms">{{ $usulan_barang_details->sisa_vol_rkbu }} {{ $usulan_barang_details->satuan_1 }}</span><br />
                                                <span class="ms-4 ps-1">Sisa Anggaran </span><span class="text-end">:</span> <span class="text-danger fa-ms">Rp. {{ number_format($usulan_barang_details->sisa_anggaran_rkbu) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- /Current Plan -->
                    </div>
                    <div class="card mb-4">
                        <div class="m-3"> </div>
                        <h5 class="card-header">Detail Komponen</h5>
                        <div class="mb-3" data-repeater-list="group-a">
                            <div class="card-body pt-1">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="creditCardForm" class="row g-4">
                                            <div class="added-cards">
                                                <div class="cardMaster bg-lighter p-3 rounded mb-3">
                                                    <div class="d-flex justify-content-between flex-sm-row flex-column">
                                                        <div class="card-information me-2">
                                                            <div class="d-flex align-items-center mb-1 flex-wrap gap-2">
                                                                <h6 class="mb-0 me-2 fw-semibold">Nama Komponen : </h6>
                                                            </div>
                                                            <div class="input-group input-group-floating">
                                                                <div class="form-floating">
                                                                    <input name="nama_barang" value="{{ $usulan_barang_details->rkbus->nama_barang }}" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column text-start text-lg-end">
                                                            <div class="d-flex align-items-center mb-1 flex-wrap gap-2">
                                                                <h6 class="mb-0 me-2 fw-semibold"></h6>
                                                            </div>
                                                            <div class="input-group input-group-floating">
                                                                <span class="input-group-text bg-lighter">Rp.</span>
                                                                <div class="form-floating">
                                                                    <input id="harga_barang" name="harga_barang" onkeyup="sum_farmasi();" value="{{ $usulan_barang_details->harga_barang }}" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-group">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="number" class="form-control" id="rata2_pemakaian" name="rata2_pemakaian" value="{{ $usulan_barang_details->rata2_pemakaian  }}" onkeyup="sum_farmasi();" placeholder="1" aria-label="Amount (to the nearest dollar)" required />
                                                        <label for="basic-addon11">Rata-rata Pemakaian</label>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="input-group">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="number" class="form-control" id="sisa_stok" name="sisa_stok" value="{{ $usulan_barang_details->sisa_stok  }}" onkeyup="sum_farmasi();" placeholder="1" aria-label="Amount (to the nearest dollar)" required />
                                                        <label for="basic-addon11">Sisa Stok</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="input-group">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="number" class="form-control" id="buffer_stok" name="buffer_stok" value="{{ $usulan_barang_details->buffer_stok  }}" onkeyup="sum_farmasi();" placeholder="1" aria-label="Amount (to the nearest dollar)" required />
                                                        <label for="basic-addon11">Buffer Stok</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="creditCardForm" class="row g-4">
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group input-group-floating">
                                                            <span class="input-group-text bg-lighter">[*]</span>
                                                            <div class="form-floating">
                                                                <input id="minimal_stok" name="stok_minimal" value="{{ $usulan_barang_details->stok_minimal  }}" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
                                                                <label for="basic-addon21">Stok Minimal</label>
                                                            </div>
                                                            <span class="form-floating-focused"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group input-group-floating">
                                                        <span class="input-group-text bg-lighter">[*]</span>
                                                        <div class="form-floating">
                                                            <input id="usulan_barang" name="jumlah_usulan_barang" onkeyup="sum_farmasi();" value="{{ $usulan_barang_details->jumlah_usulan_barang  }}" class="form-control bg-lighter" id="basic-addon21" aria-label="Username" aria-describedby="basic-addon21" />
                                                            <label for="basic-addon21">Jumlah Usulan Barang</label>
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
                                                            <input type="number" step="0.01" min="0" max="100" class="form-control" id="ppn" name="ppn" value="{{ $usulan_barang_details->ppn  }}" onkeyup="sum_farmasi();" aria-label="Amount (to the nearest dollar)" />
                                                            <input type="hidden" step="0.01" min="0" max="100" class="form-control" id="hasil_ppn" name="total_ppn" value="{{ $usulan_barang_details->total_ppn  }}" aria-label="Amount (to the nearest dollar)" />
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
                                                        <input type="text" name="total_anggaran_usulan_barang" id="total_usulan_barang_ppn" value="{{ $usulan_barang_details->total_anggaran_usulan_barang  }}" class="form-control" placeholder="1,000,000" aria-label="Total" readonly />
                                                        <label>Total Anggaran</label>
                                                    </div>
                                                    <span class="input-group-text">,-</span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="form-floating form-floating-outline">
                                                    <select name="satuan_1_detail" id="satuan_1" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                        <option value="{{ $usulan_barang_details->satuan_1_detail }}">{{ $usulan_barang_details->satuan_1_detail }}</option>
                                                        <?php foreach ($uraian1 as $key) { ?>
                                                            <option value="{{ $key->nama_uraian_1 }}">{{ $key->nama_uraian_1 }}</option>
                                                        <?php } ?>
                                                    </select>
                                                    <label for="floatingSelect">Satuan 1</label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-8">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" name="spek_detail" value="{{ $usulan_barang_details->spek_detail  }}" class="form-control" aria-label="Amount (to the nearest dollar)" />
                                                        <label>Spek</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-12">
                                    <label class="switch">
                                        <input type="checkbox" class="switch-input" />
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on"></span>
                                            <span class="switch-off"></span>
                                        </span>
                                        <span class="switch-label">Yakin dengan Inputan Anda!</span>
                                    </label>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                    <a href="{{ route('usulan_barang_persediaans.keranjang', ['id' => $usulan_barang_details->usulan_barang->id_usulan_barang]) }}" class="btn btn-outline-secondary">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Header -->
    </div>
</form>
@endsection