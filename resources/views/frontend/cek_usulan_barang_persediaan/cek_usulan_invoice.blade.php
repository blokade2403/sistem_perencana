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
                               <h6 class="pb-2">ID USULAN: <span class="badge bg-info">{{$no_inv->no_usulan_barang}}</span></h6>

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
                                    <th>Detail Usulan</th>
                                    <th>Rata-rata Pemakaian</th>
                                    <th>harga Satuan</th>
                                    <th>Jumlah Usulan</th>
                                    <th>PPN</th>
                                    <th>Anggaran</th>
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
                                </tr>
                                @endforeach
                               </tbody>
                           </table>
                           <table class="table m-0">
                               <thead class="table-light border-top">
                               </thead>
                               <tbody>
                                   <tr>
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
                   </div>
                       <form action="" method="POST" enctype="multipart/form-data">
                           <input type="hidden" value="" name="no_usulan_barang">
                           <div id="formAccountSettings">
                               <div class="row">
                                   <div class="col-md-4 m-3">
                                       <div class="demo-inline-spacing">
                                           <div class="mb-3">
                                               <a href="javascript:history.go(-1);" class="btn btn-label-secondary">
                                                   Back
                                               </a>
                                               <a href="{{ route('cek_usulan_persediaans.downloadPDF', ['id_usulan_barang' => $invoice->id_usulan_barang]) }}" class="btn btn-info waves-primary waves-effect">
                                                   <span class="tf-icons mdi mdi-printer-outline"></span>
                                               </a>
                                           </div>
                                       </div>
                                   </div>
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
