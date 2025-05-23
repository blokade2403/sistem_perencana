@extends('layouts.main')
@section('container')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row invoice-add">
        <!-- Invoice Add-->
        <div class="col-lg-12 col-12 mb-lg-0 mb-4">
            <div class="card invoice-preview-card">
                <div class="card-body">
                    <!-- Current Plan -->
                    <div class="row">
                        <div class="col-md-1 mb-1"></div>
                        <div class="col-md-2 mb-3 mt-4">
                            <img src="{{asset('storage/uploads/'.basename($gambar2))}}" width="105" height="75" class="img-fluid" />
                        </div>
                        <div class="col-md-6 mb-0">
                            <div class="row text-center">
                                <p class="mt-4 mb-1">{{ $judul_header1 }}</p>
                                <h4 class="mt-1 mb-1">{{ $nama }}</h4>
                                <p class="mb-1">{{ $alamat }} Telepon: {{ $tlp }} Faksimile: {{ $tlp }} </p>
                                <p class="mt-1">Website: {{ $website }} Email: {{ $email }} </p>
                            </div>
                        </div>
                        <div class="col-md-1 mb-3 mt-4"></div>
                        <div class="col-md-2 mb-3 mt-4">
                            <img src="{{asset('storage/uploads/'.basename($gambar1))}}" width="145" height="105" class="img-fluid" />
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center">
                        <p class="mt-1 mb-1"><strong>DATA USULAN BELANJA BARANG / JASA</strong></p>
                    </div>
                    <br />
                    <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column">
                        <div>
                            <h6>INVOICE <span class="badge bg-info">{{ $no_inv->no_usulan_barang ?? 'N/A' }}</span></h6>
                            <div class="mb-1">
                                <span class="fa-sm">Tanggal Usulan:</span>
                                <span class="fa-sm">{{ $no_inv->created_at ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="fa-sm">Pengusul:</span>
                                <span class="fa-sm">{{ $no_inv->nama_pengusul_barang ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="fa-sm">Kategori Belanja:</span>
                                <span class="fa-sm">{{ $no_inv->nama_sub_kategori_rkbu ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- /Current Plan -->
                </div>
               
                <div class="col-12">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped">
                                <thead class="table-light border-top">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Detail Usulan</th>
                                        <th>Rata-rata Pemakaian</th>
                                        <th>harga Satuan</th>
                                        <th>Jumlah Usulan</th>
                                        <th>PPN</th>
                                        <th>Anggaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($keranjang as $key => $item)
                                    <tr>
                                        <td class="text-nowrap"><small class="text-info">{{ $key+1 }}</small></td>
                                        <td class="text-nowrap">
                                            <small class="text-info">{{ $item->nama_barang }}</small><br />
                                            <span class="fa-xs">ID RKBU: {{ $item->id_rkbu }}</span><br />
                                            <span class="fa-xs">Spesifikasi: {{ $item->spek }}</span>
                                        </td>
                                        <td class="fy-2 text-wrap">
                                            <span class="fa-sm">Sisa Stok : </span><br />
                                            <span class="fa-sm">{{ $item->sisa_stok }}</span><br />
                                            <span class="fa-sm">Stok Minimal : </span><br />
                                            <span class="fa-sm">{{ $item->stok_minimal }}</span>
                                        </td>
                                        <td class="text-wrap">
                                            <span class="fa-sm">Pemakaian:<br /> {{ $item->rata2_pemakaian }}</span><br />
                                            <span class="fa-sm">Minimal Stok:<br /> {{ $item->stok_minimal }}</span>
                                        </td>
                                        <td><small>Rp. {{ number_format($item->harga_barang) }}</small></td>
                                        <td><small> {{ $item->jumlah_usulan_barang }}  {{ $item->satuan_1_detail }}</small></td>
                                        <td><small>{{ number_format($item->total_ppn) }}</small></td>
                                        <td><small>Rp. {{ number_format($item->total_anggaran_usulan_barang) }}</small></td>
                                        <td class="text-center">
                                            <a href="{{ route('usulan_barang_persediaans.edit', $item->id_usulan_barang_detail) }}" class="btn btn-icon btn-outline-primary waves-effect">
                                                <span class="tf-icons mdi mdi-checkbox-marked-circle-outline"></span>
                                            </a>
                                            <form action="{{ route('usulan_barang_persediaans.delete_detail', $item->id_usulan_barang_detail) }}" method="POST" class="delete-form d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-icon btn-outline-danger waves-effect">
                                                    <span class="tf-icons mdi mdi-delete-outline"></span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Detail Usulan</th>
                                        <th>Rata-rata Pemakaian</th>
                                        <th>harga Satuan</th>
                                        <th>Jumlah Usulan</th>
                                        <th>PPN</th>
                                        <th>Anggaran</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <table class="table m-0">
                                <thead class="table-light border-top"></thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="align-top px-4 py-3">
                                            <p class="mb-2">
                                                <span class="me-1 fw-semibold">Status Sebelumnya: </span>
                                                <span class="badge bg-warning mb-3">{{ $no_inv->status_permintaan_barang ?? 'N/A' }}</span>
                                            </p>
                                            <p class="mb-2">
                                                <span class="me-1 fw-semibold">Dokumen Pendukung: </span>
                                            </p>
                                        </td>
                                        <td class="text-end px-4 py-3">
                                            <p class="mb-2">
                                                <span class="me-1 fw-semibold">Sub Total:</span>
                                                {{ number_format($get_total - $ppn, 2) }}
                                            </p>
                                            <p class="mb-2">
                                                <span class="me-1 fw-semibold">PPN:</span>
                                                {{ number_format($ppn, 2) }}
                                            </p>
                                            <p class="mb-2">
                                                <span class="me-1 fw-semibold">Total:</span>
                                                {{ number_format($get_total, 2) }}
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <form action="{{route('validasi_usulan_persediaan_rkas.updateValidasi', $no_inv->no_usulan_barang)}}" method="POST" id="confirmSubmitForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{$no_inv->no_usulan_barang}}" name="no_usulan_barang">
                            <input type="hidden" value="{{$no_inv->tanggal_konfirmasi}}" name="tanggal_konfirmasi">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5 mb-md-0 mb-3">
                                        <div class="form-floating form-floating-outline">
                                            <select name="status_validasi_kabag" id="status_validasi_kabag" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                <option value="{{$no_inv->status_permintaan_barang}}">{{$no_inv->status_permintaan_barang}}</option>
                                                <option value="Validasi Kabag">Validasi Kabag</option>
                                                <option value="Di Tolak">Di Tolak</option>
                                            </select>
                                            <label for="floatingSelect">Status Permintaan Barang</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="note" class="form-label fw-bold">Note:</label>
                                            <textarea class="form-control" rows="2" id="note" name="keterangan_kabag" placeholder="Invoice note">{{$no_inv->keterangan_kabag}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    @if (($no_inv->status_permintaan_barang) == 'Proses Pesanan Barang') 
                                        <button type="submit" class="btn btn-primary me-2" disabled>Simpan</button>
                                        <a href="" class="btn btn-outline-secondary">Kembali</a>
                                    @else
                                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                        <a href="{{route('validasi_usulan_persediaan_rkas.index')}}" class="btn btn-outline-secondary">Kembali</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Invoice Add-->
    </div>
</div>
<!-- / Content -->
@endsection
