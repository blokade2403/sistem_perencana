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
                                        <th>Spesifikasi</th>
                                        <th>Harga Satuan</th>
                                        <th>Vol</th>
                                        <th>PPN</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($keranjang as $key => $item)
                                    <tr>
                                        <td class="text-nowrap"><small class="text-info">{{ $key+1 }}</small></td>
                                        <td class="text-wrap">
                                            <small class="text-info">{{ $item->nama_barang }}</small><br />
                                            <span class="fa-xs">ID RKBU: {{ $item->id_rkbu }}</span>
                                        </td>
                                        <td class="fy-2 text-wrap"><span class="fa-sm">{{ $item->spek_detail }}</span></td>
                                        <td><small>Rp. {{ number_format($item->harga_barang, 0, ',','.') }}</small></td>
                                        <td><small>{{ $item->jumlah_usulan_barang }} {{ $item->satuan_1_detail }}/{{ $item->satuan_2_detail }}</small></td>
                                        <td><small>Rp. {{ number_format($item->harga_barang * $item->ppn / 100, 0, ',','.') }}</small></td>
                                        <td><small>Rp. {{ number_format($item->total_anggaran_usulan_barang, 0, ',','.') }}</small></td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('usulan_barang_modals.edit', $item->id_usulan_barang_detail) }}" class="btn btn-icon btn-outline-primary waves-effect">
                                                    <span class="tf-icons mdi mdi-checkbox-marked-circle-outline"></span>
                                                </a>
                                        
                                                <!-- Tombol Delete -->
                                                <form action="{{ route('usulan_barang_modals.delete_detail', $item->id_usulan_barang_detail) }}" method="POST" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-icon btn-outline-danger waves-effect">
                                                        <span class="tf-icons mdi mdi-delete-outline"></span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Spesifikasi</th>
                                        <th>Harga Satuan</th>
                                        <th>Vol</th>
                                        <th>PPN</th>
                                        <th>Harga</th>
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
                                                <span class="badge bg-warning mb-3">{{ $no_inv->status_sebelumnya ?? 'N/A' }}</span>
                                            </p>
                                            {{-- <p class="mb-2">
                                                <span class="me-1 fw-semibold">Dokumen Pendukung: </span>
                                            </p> --}}
                                        </td>
                                        <td class="text-end px-4 py-3">
                                            <p class="mb-2">
                                                <span class="me-1 fw-semibold">Sub Total:</span>
                                                {{ number_format($get_total - $ppn, 0, ',','.') }}
                                            </p>
                                            <p class="mb-2">
                                                <span class="me-1 fw-semibold">PPN:</span>
                                                {{ number_format($ppn, 0, ',','.') }}
                                            </p>
                                            <p class="mb-2">
                                                <span class="me-1 fw-semibold">Total:</span>
                                                {{ number_format($get_total, 0, ',','.') }}
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <form action="{{ route('usulan_barang_modals.updateStatus', $invoice->id_usulan_barang) }}" method="POST" id="confirmSubmitForm" enctype="multipart/form-data" validate>
                            @csrf
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Kirim Usulan</button>
                            <a href="{{route('usulan_barang_modals.index')}}" class="btn btn-outline-secondary">Kembali</a>
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
