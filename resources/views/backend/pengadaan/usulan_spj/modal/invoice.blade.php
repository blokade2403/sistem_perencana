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
                       <p class="mt-1 mb-1"><strong> DATA USULAN BELANJA BARANG / JASA</strong></p>
                   </div>
                   <!-- /Current Plan -->
                   <div class="card-body">
                       <div class="d-flex justify-content-between flex-wrap">
                           <div class="m-3">
                               <h6 class="pb-2">ID USULAN: <span class="badge bg-info">{{ $no_inv->no_usulan_barang }}</span></h6>
                                {{-- @dd($no_inv) --}}
                               <table>
                                   <tbody>
                                       <tr>
                                           <td class="pe-3 fw-medium"><span class="fa-sm">Program</span></td>
                                           <td><span class="fa-sm">{{$no_inv->kode_program}}. {{$no_inv->nama_program}}</span></td>
                                       </tr>
                                       <tr>
                                           <td class="pe-3 fw-medium"><span class="fa-sm">Kegiatan</span></td>
                                           <td><span class="fa-sm">{{$no_inv->kode_kegiatan}}. {{$no_inv->nama_kegiatan}}</span></td>
                                       </tr>
                                       <tr>
                                           <td class="pe-3 fw-medium"><span class="fa-sm">Rekening Belanja:</span></td>
                                           <td><span class="fa-sm">{{$no_inv->kode_rekening_belanja}}. {{$no_inv->nama_rekening_belanja}}</span></td>
                                       </tr>
                                       <tr>
                                           <td class="pe-3 fw-medium"><span class="fa-sm">Kategori</span></td>
                                           <td><span class="fa-sm">{{$no_inv->kode_kategori_rkbu}}. {{$no_inv->nama_kategori_rkbu}}</span></td>
                                       </tr>
                                       <tr>
                                           <td class="pe-3 fw-medium"><span class="fa-sm">Sub Kategori</span></td>
                                           <td><span class="fa-sm">{{$no_inv->kode_sub_kategori_rkbu}}. {{$no_inv->nama_sub_kategori_rkbu}}</span></td>
                                       </tr>
                                   </tbody>
                               </table>
                           </div>

                           <div class="m-4">
                               <h6 class="pb-2"><span class="fa-sm"></span></h6>
                               <table>
                                   <tbody>
                                       <tr>
                                           <td class="pe-3 fw-medium"><span class="fa-sm">Pengusul: {{$no_inv->nama_pengusul_barang}}</span></td>
                                           <td><span class="fa-sm"></td>
                                       </tr>
                                       <tr>
                                           <td class="pe-3 fw-medium"><span class="fa-sm">Unit : {{$no_inv->unit}}</span></td>
                                           <td><span class="fa-sm"></span></td>
                                       </tr>
                                       <tr>
                                           <hr>
                                       </tr>
                                       <tr>
                                           <td class="pe-3 fw-medium"><span class="fa-sm">Sumber Dana : {{$no_inv->nama_sumber_dana}}</span></td>
                                           <td><span class="fa-sm"></span></td>
                                       </tr>
                                   </tbody>
                               </table>
                           </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="table-responsive mb-4 col-md-12 text-nowrap">
                           <table id="example" class="table table-striped">
                               <thead class="table-light border-top">
                                   <tr>
                                       <th>No</th>
                                       <th>Nama Barang</th>
                                       <th>Spesifikasi</th>
                                       <th>harga Satuan</th>
                                       <th>Vol</th>
                                       <th>PPN</th>
                                       <th>Harga</th>
                                       <th>Action</th>
                                   </tr>
                               </thead>
                             
                               <span class="fa-xs">
                                   <a href="" class="btn btn-xs rounded-pill btn-outline-secondary waves-effect">
                                       <span class="tf-icons mdi mdi-download-outline me-1"></span> Download Excel
                                   </a>
                               </span><br />
                               <tbody>
                                @foreach($keranjang as $key => $item)
                                <tr>
                                    <td class="text-nowrap"><small class="text-info">{{ $key+1 }}</small></td>
                                    <td class="text-nowrap">
                                        <small class="text-info">{{ $item->nama_barang }}</small><br />
                                        <span class="fa-xs">ID RKBU: {{ $item->id_rkbu }}</span>
                                    </td>
                                    <td class="fy-2 text-wrap"><span class="fa-sm">{{ $item->spek_detail }}</span></td>
                                    <td><small>Rp. {{ number_format($item->harga_barang, 2) }}</small></td>
                                    <td><small>{{ $item->jumlah_usulan_barang }} {{ $item->satuan_1_detail }}/{{ $item->satuan_2_detail }}</small></td>
                                    <td><small>Rp. {{ number_format($item->harga_barang * $item->ppn / 100, 0, ',','.') }}</small></td>
                                    <td><small>Rp. {{ number_format($item->total_anggaran_usulan_barang, 0, ',','.') }}</small></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-item-center gap-2">
                                            <a href="{{ route('usulan_spj_modals.edit', $item->id_usulan_barang_detail) }}" class="btn btn-icon btn-outline-primary waves-effect">
                                                <span class="tf-icons mdi mdi-checkbox-marked-circle-outline"></span>
                                            </a>
                                            <form action="{{ route('usulan_spj_modals.delete', $item->id_spj_detail) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-icon btn-outline-danger waves-effect">
                                                    <span class="tf-icons mdi mdi-delete-forever"></span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                               </tbody>
                           </table>
                           <table class="table m-0">
                               <thead class="table-light border-top">
                               </thead>
                               <tbody>
                                   <tr>
                                       <td colspan="4" class="align-top px-4 py-3">
                                           <p class="mb-2">
                                               <span class="me-1 fw-semibold">Status: <span class="badge bg-label-success">{{$no_inv->status_permintaan_barang}}</span> </span>
                                           </p>
                                               <span class="badge bg-warning mb-3"></span>
                                               <span class="badge bg-success mb-3"></span>
                                               <span class="badge bg-info mb-3"></span>
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
                   </div>
                   <form action="{{ route('usulan_spj_modals.updateStatus', $no_inv->id_spj) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    {{-- {{$no_inv->id_spj}} --}}
                    <input type="hidden" value="{{$no_inv->tanggal_validasi_pengadaan}}" name="tanggal_validasi_pengadaan">
                    <input type="hidden" name="id_usulan_barang" value="{{ $no_inv->id_usulan_barang }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5 mb-md-0 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <select name="status_validasi_pengadaan" id="status_validasi_pengadaan" class="select2 form-select form-select-lg" data-allow-clear="true">
                                        <option value="{{$no_inv->status_validasi_pengadaan}}">{{$no_inv->status_validasi_pengadaan}}</option>
                                        <option value="Proses Pengadaan Barang">Proses Pengadaan Barang</option>
                                        <option value="Pending Pengadaan">Di Pending</option>
                                    </select>
                                    <label for="floatingSelect">Status Proses Pengadaan Barang</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="note" class="form-label fw-bold">Catatan:</label>
                                    <textarea class="form-control" rows="2" id="note" name="keterangan_validasi_pengadaan" placeholder="Invoice note">{{$no_inv->keterangan_validasi_pengadaan}}</textarea>
                                </div>
                            </div>
                        </div>
                       
                        <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Kirim Usualan</button>
                                <a href="{{route('usulan_spj_modals.index')}}" class="btn btn-label-secondary">
                                    Kembali
                                </a>
                                <a href="{{ route('cek_usulan_barang_modals.downloadPDF_modal', ['id_usulan_barang' => $invoice->id_usulan_barang]) }}" class="btn btn-info waves-primary waves-effect">
                                    <span class="tf-icons mdi mdi-printer-outline"></span>
                                </a>
                        </div>
                    </div>
                    </form>
                   <div class="card-body">
                       <div class="row">
                           <div class="col-12">
                               <span class="fw-bold">Note:</span>
                               <span>Harap Menunggu, Barang Pesanan anda sedang dalam prosess. Terima Kasih </span><br />
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           <!-- /Invoice -->
       </div>
   </div>
@endsection
