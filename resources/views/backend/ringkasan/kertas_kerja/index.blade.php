@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Header -->
                <div class="card col-12 mb-4">
                    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                            <img src="assets/img/illustrations/012.png" height="157" width="175" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                        </div>
                        <div class="flex-grow-1 mt-3 mt-sm-5">
                            <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                <div class="user-profile-info">
                                    <h4> {{session('nama_lengkap')}}</h4>
                                    <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-account-convert me-1 mdi-20px"></i><span class="badge rounded-pill bg-label-danger"> {{session('tahun_anggaran')}}</span>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-calendar-blank-outline me-1 mdi-20px"></i><span class="fw-semibold"><?php echo date('l, d-m-Y  H:i:s'); ?></span>
                                        </li>
                                    </ul>
                                    <div class="demo-inline-spacing">
                                        <div class="d-flex justify-content-start align-items-center gap-2">
                                            <a href="{{route('kertas_kerjas.downloadPDF_kertas_kerja')}}" class="btn btn-icon btn-outline-info waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" data-bs-original-title="Print PDF Kertas Kerja">
                                                <span class="tf-icons mdi mdi-printer"></span>
                                            </a>
                                            <a href="{{route('realisasi_rba.downloadPDF_realisasi_kertas_kerja')}}" class="btn btn-icon btn-outline-info waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" data-bs-original-title="Print PDF Realisasi Anggaran">
                                                <span class="tf-icons mdi mdi-printer"></span>
                                            </a>
                                            <a href="" class="btn btn-icon btn-outline-danger waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-danger" data-bs-original-title="Download Kertas Kerja">
                                                <span class="tf-icons mdi mdi-download"></span>
                                            </a>
                                            <a href="" class="btn btn-icon btn-outline-primary waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-primary" data-bs-original-title="Download Realisasi RBA">
                                                <span class="tf-icons mdi mdi-tray-arrow-down"></span>
                                            </a>
                                        </div>
                                </div>
                          
                        </div>
                        <!-- /////// -->
                    </div>
                </div>
                    </div>
                </div>

        <div class="col-lg-12">
            <div class="card h-100">
                <div class="card-body">
                    @foreach ($logo as $item)
                    <div class="row mb-2 align-items-center">
                        <div class="col-md-2 align-items-center">
                            <img class="img-fluid" src="{{ asset('storage/uploads/' . basename($item->gambar2)) }}" width="100" height="300" align="center" alt="">
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-5 center">
                            <div class="text-center"><strong class="fa-sm">RENCANA BISNIS DAN ANGGARAN (RBA)</strong> </div>
                            <div class="text-center"><span class="fa-sm">TAHUN ANGGARAN </span></div>
                            <div class="text-center"><span class="fa-sm"></span></div>
                            <div class="text-center"><span class="fa-sm"></span></div>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-2 align-items-center">
                            <img class="img-fluid" src="{{ asset('storage/uploads/' . basename($item->gambar1)) }}" width="120" height="600" align="center" alt="">
                        </div>
                    </div>
                    @endforeach
                    <div class="row"><br /></div>
                    <div class="row">
                        <div class="col-md-0"></div>
                        <div class="col-md-2">
                            <div class="text-left"><span class="fa-sm"><strong>Program</strong></span></div>
                            <div class="text-left"><span class="fa-sm">Kegiatan</span></div>
                            <div class="text-left"><span class="fa-sm">Sub Kegiatan</span></div>
                            <div class="text-left"><span class="fa-sm">Rincian Sub Kegiatan</span></div>
                        </div>
                        <div class="col-md-8">
                            <div class="text-left"><span class="fa-sm">: {{$namaProgram}}</span></div>
                            <div class="text-left"><span class="fa-sm">: {{$namaKegiatan}}</span></div>
                            <div class="text-left"><span class="fa-sm">: {{$namaSubKegiatan}}</span></div>
                            <div class="text-left"><span class="fa-sm">: Peningkatan Layanan Umum Daerah</span></div>
                        </div>
                    </div>
                 
                    <div class="row"><br /></div>
                    <div class="row">
                        <div class="col-md-0"></div>
                        <div class="col-md-2">
                            <div class="text-left"><span class="fa-sm">Indikator</span></div>
                            <div class="text-left"><span class="fa-sm">Input</span></div>
                            <div class="text-left"><span class="fa-sm">Output</span></div>
                        </div>
                        <div class="col-md-8">
                            <div class="text-center"><span class="fa-sm"><strong>Tolak Ukur Kinerja</strong></span></div>
                            <div class="text-left"><span class="fa-sm">: Dana yang dibutuhkan</span></div>
                            <div class="text-left"><span class="fa-sm">: Persentase Rumah Sakit Milik Pemerintah yang menyelenggarakan Pelayanan Sesuai Standar</span></div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center"><strong><span class="fa-sm">Target Kinerja</span></strong></div>
                            <div class="text-center"><strong><span class="fa-sm">Total Anggaran Keseluruhan</span></strong></div>
                            <div class="text-center"><strong><span class="fa-sm">100%</span></strong></div>
                        </div>
                    </div>
                    <div class="row"><br /></div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="thead-primary">
                                <tr class="col-md-12">
                                    <th class="text-left fs-14 text" width="2%">#</th>
                                    <th class="text-left fs-14 text" width="45%">Kode Rek. Belanja / Keg. / Sub Kegiatan</th>
                                    <th class="text-center fs-14 text" width="11%">Anggaran Berdasarkan Validasi Kabag/Kabid</th>
                                    <th class="text-center fs-14 text" width="11%">Realisasi Anggaran</th>
                                    <th class="text-center fs-14 text" width="11%">Sisa Anggaran</th>
                                    <th class="text-center fs-14 text" width="3%">%</th>
                                </tr>
                            </thead>
                    
                            @if ($dataKosong)
                                <div class="alert alert-warning text-center">
                                    <strong>Data tidak tersedia!</strong>
                                </div>
                            @else
                                @foreach ($categories as $jenisBelanja)
                                    <thead class="fa-sm text-primary">
                                        <tr>
                                            <td colspan="2" class="fa-sm">
                                                <strong>{{ $jenisBelanja->kode_jenis_belanja }}. {{ $jenisBelanja->nama_jenis_belanja }}</strong>
                                            </td>
                                            <td class="text-center fa-sm">
                                                <strong>{{ number_format($jenisBelanja->total_anggaran, 0, ',', '.') }}</strong>
                                            </td>
                                            <td class="text-center fa-sm">
                                                <strong>{{ number_format($jenisBelanja->realisasi_anggaran, 0, ',', '.') }}</strong>
                                            </td>
                                            <td class="text-center fa-sm">
                                                {{ number_format($jenisBelanja->total_anggaran - $jenisBelanja->realisasi_anggaran, 0, ',', '.') }}
                                            </td>
                                            <td class="text-center fa-sm">
                                                @if($jenisBelanja->total_anggaran > 0)
                                                    {{ number_format(($jenisBelanja->realisasi_anggaran / $jenisBelanja->total_anggaran) * 100, 2, ',', '.') }}%
                                                @else
                                                    0%
                                                @endif
                                            </td>
                                        </tr>
                                    </thead>
                    
                                    @foreach ($jenisBelanja->jenis_kategori_rkbus as $jenisKategori)
                                        <thead>
                                            <tr class="fa-md" style="background-color: #e0e9f4; color: rgb(63, 63, 63); opacity: 212;">
                                                <th colspan="2">{{ $jenisKategori->kode_jenis_kategori_rkbu }}. {{ $jenisKategori->nama_jenis_kategori_rkbu }}</th>
                                                <td class="text-center fa-sm">
                                                    <small>{{ number_format($jenisKategori->total_anggaran, 0, ',', ',') }}</small>
                                                </td>
                                                <td class="text-center fa-sm">
                                                    <small>{{ number_format($jenisKategori->realisasi_anggaran, 0, ',', ',') }}</small>
                                                </td>
                                                <td class="text-center fa-sm"> {{ number_format($jenisKategori->total_anggaran - $jenisKategori->realisasi_anggaran, 0, ',', '.') }}</td>
                                                <td class="text-center fa-sm">
                                                    @if($jenisKategori->total_anggaran > 0)
                                                        {{ number_format(($jenisKategori->realisasi_anggaran / $jenisKategori->total_anggaran) * 100, 2, ',', '.') }}%
                                                    @else
                                                        0%
                                                    @endif
                                                </td>
                                            </tr>
                                        </thead>
                    
                                        @foreach ($jenisKategori->obyek_belanjas as $obyekBelanja)
                                            @foreach ($obyekBelanja->kategori_rkbus as $kategoriRkbu)
                                                <thead>
                                                    <tr style="background-color: #f2f3f3; color: rgb(63, 63, 63); opacity: 212;">
                                                        <th colspan="2">{{ $kategoriRkbu->kode_kategori_rkbu }}. {{ $kategoriRkbu->nama_kategori_rkbu }}</th>
                                                        <td class="text-center fa-sm">
                                                            <small>{{ number_format($kategoriRkbu->total_anggaran, 0, ',', ',') }}</small>
                                                        </td>
                                                        <td class="text-center fa-sm">
                                                            <small>{{ number_format($kategoriRkbu->realisasi_anggaran, 0, ',', ',') }}</small>
                                                        </td>
                                                        <td class="text-center fa-sm"> {{ number_format($kategoriRkbu->total_anggaran - $kategoriRkbu->realisasi_anggaran, 0, ',', '.') }}</td>
                                                        <td class="text-center fa-sm">
                                                            @if($kategoriRkbu->total_anggaran > 0)
                                                                {{ number_format(($kategoriRkbu->realisasi_anggaran / $kategoriRkbu->total_anggaran) * 100, 2, ',', '.') }}%
                                                            @else
                                                                0%
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </thead>
                    
                                                @foreach ($kategoriRkbu->sub_kategori_rkbus as $subKategoriRkbu)
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th class="text-left fa-sm text-nowrap">
                                                                <small>{{ $subKategoriRkbu->kode_sub_kategori_rkbu }}. {{ $subKategoriRkbu->nama_sub_kategori_rkbu }}</small>
                                                            </th>
                                                            <td class="text-center fa-sm">
                                                                <small>{{ number_format($subKategoriRkbu->total_anggaran, 0, ',', ',') }}</small>
                                                            </td>
                                                            <td class="text-center fa-sm">
                                                                <small>{{ number_format($subKategoriRkbu->realisasi_anggaran, 0, ',', ',') }}</small>
                                                            </td>
                                                            <td class="text-center fa-sm"> {{ number_format($subKategoriRkbu->total_anggaran - $subKategoriRkbu->realisasi_anggaran, 0, ',', '.') }}</td>
                                                            <td class="text-center fa-sm">
                                                                @if($subKategoriRkbu->total_anggaran > 0)
                                                                    {{ number_format(($subKategoriRkbu->realisasi_anggaran / $subKategoriRkbu->total_anggaran) * 100, 2, ',', '.') }}%
                                                                @else
                                                                    0%
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endif
                    
                            <tfoot class="thead-primary">
                                <tr>
                                    <th></th>
                                    <th class="text-center fs-14 text">Total Anggaran</th>
                                    <th class="text-left fs-14 text">{{ number_format($total_anggaran_blud, 0, ',', '.') }}</th>
                                    <th class="text-left fs-14 text"></th>
                                    <th class="text-left fs-14 text"></th>
                                    <th class="text-center fs-14 text">%</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    

                       
            </div>
        </div>
        <!--/ Header -->

    </div>
@endsection