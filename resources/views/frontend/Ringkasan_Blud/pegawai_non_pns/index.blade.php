@extends('layouts.main')
@section('container')
        <!-- Content -->
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Title</h4>
            <div class="card-body">
                <!-- Header -->
                <div class="row">
                    <div class="col-12">
                        <div class="card col-12 mb-4">
                            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                                <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                                    <img src="assets/img/illustrations/trophy.png" height="157" width="175" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
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
                                                    <a href="{{route('validasi_pegawai_pns_admins.create')}}" class="btn rounded-pill btn-label-info waves-effect">
                                                        <span class="tf-icons mdi mdi-book-plus-multiple me-1"></span>Tambah Data
                                                    </a>
                                                    @if (session('nama_level_user') == 'Administrator')
                                                    <a href="{{ route('rkbu_barang_jasa_admin.downloadReport') }}" class="btn rounded-pill btn-label-secondary waves-effect">
                                                        <span class="tf-icons mdi mdi-download me-1"></span>Download Report
                                                    </a>
                                                    @elseif (session('nama_level_user') == 'Validasi RKA')
                                                    <a href="{{ route('rkbu_barang_jasa_kabag.downloadReport') }}" class="btn rounded-pill btn-label-secondary waves-effect">
                                                        <span class="tf-icons mdi mdi-download me-1"></span>Download Report
                                                    </a>
                                                    @endif
                                                    <a href="{{route('validasi_pegawai_non_pns_admins.downloadPDF_ValidasiPegawaiNonPnsAdmin')}}" class="btn rounded-pill btn-label-warning waves-effect">
                                                        <span class="tf-icons mdi mdi-printer me-1"></span>Print
                                                    </a>
                                                </div>
                                            <div class="card-body pb-3 transaction-details d-flex flex-wrap justify-content-between align-items-center">
                                                <div class="me-3 mb-3">
                                                    <p class="mb-2">Status</p>
                                                    <h6 class="mb-0">Validasi</h6>
                                                </div>
                                                    <div class="me-3 mb-3">
                                                        <p class="mb-2 "></p>
                                                        <span class="badge bg-info"></span>
                                                    </div>
                                                    <div class="me-3 mb-3">
                                                        <p class="mb-2 "></p>
                                                        <span class="badge bg-success"></span>
                                                    </div>
                                            </div>
                                        </div>
                                        <!-- /////// -->
                                        @include('backend.partials.pagudaninput')
                                        <!-- /////// -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Header -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                             <!-- Filter Form -->
                        <!-- view file -->
                        <form action="{{ route('validasi_pegawai_pns_admins.index') }}" method="GET">
                            @include('frontend.partials.filter_rkbu')
                        </form>
                        <form action="{{ route('validasi_pegawai_pns_admins.massValidasi') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_jenis_kategori_rkbu" value="barjas">
                            @if (session('nama_level_user') == 'Administrator')
                            <button type="submit" class="btn btn-label-success">Validasi All</button>
                            @endif
                        <div class="table-responsive">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="form-check custom-checkbox ms-2">
                                            <input type="checkbox" id="checkAll" class="form-check-input">
                                            <label for="checkAll">Check All</label>
                                        </div>
                                    </th>
                                    <th>No</th>
                                    <th>Sub Kategori</th>
                                    <th>Profil Pegawai</th>
                                    <th>Detail Pegawai</th>
                                    <th>Detail Penggajian</th>
                                    <th>Detail Jaminan</th>
                                    <th>Detail Pendapatan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($rkbus->isEmpty())
                                <div class="alert alert-danger text-center">
                                    Tidak ada data yang tersedia.
                                </div>
                                @else
                                <tr>
                                        @php
                                        $no = 1;
                                        @endphp
                                    @foreach ($rkbus as $rkbus)
                                    <td>
                                        <div class="form-check">
                                            @php
                                                $is_checked = ($rkbus->id_status_validasi_rka == '9cfb1f87-238b-4ea2-98f0-4255e578b1d1');
                                            @endphp
                                            <input type="hidden" name="id_rkbu[{{ $rkbus->id_rkbu }}]" value="0">
                                            <input type="checkbox" class="form-check-input check-item" name="id_rkbu[]" value="{{ $rkbus->id_rkbu }}" {{ $is_checked ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>{{ $no++ }}</td>
                                    <td class="fs-14">
                                        <span class="badge bg-label-success"><span class="fa-sm">{{$rkbus->status_komponen}}</span></span><br /><br />
                                        <small>No. ID {{$rkbus->subKategoriRkbu->kode_sub_kategori_rkbu}}. {{$rkbus->subKategoriRkbu->nama_sub_kategori_rkbu}} <br /><br /></small>
                                        <small>Pengusul:  {{$rkbus->user->nama_lengkap}} <br /></small>
                                        <small>KSP:  {{$rkbus->user->ksp->nama_ksp}} <br /></small>
                                    </td>
                                    <td class="py-2"><strong>
                                        <small class="fs-14 text-primary mb-0">{{$rkbus->nama_pegawai}}</small>
                                    </strong><br />
                                    <span class="fa-xs">Tempat Lahir: {{$rkbus->tempat_lahir}}</span><br />
                                    <span class="fa-xs">Tgl Lahir : {{$rkbus->tanggal_lahir}}</span><br /><br />
                                    <span class="fa-xs">Jabatan : {{$rkbus->jabatan}}</span><br />
                                    <span class="fa-xs">Pendidikan : {{$rkbus->pendidikan}}</span><br />
                                    <span class="fa-xs">Status Kawin : {{$rkbus->id_status_kawin}}</span><br />
                                </td>
                                <td class="py-2">
                                    <span class="fa-xs">No Kontrak : {{$rkbus->nomor_kontrak}}</span><br />
                                    <span class="fa-xs">Tmt Pegawai : {{$rkbus->tmt_pegawai}}</span><br />
                                    <span class="fa-xs">Tmt Bulan : {{$rkbus->bulan_tmt}}</span><br />
                                    <span class="fa-xs">Tmt Tahun : {{$rkbus->tahun_tmt}}</span><br />

                                </td>
                                <td class="py-2">
                                    <span class="fa-xs">Gaji Pokok Rp.{{number_format($rkbus->gaji_pokok, 0, ',', ',')}}</span><br />
                                    <span class="fa-xs ">Koef. Gaji : <strong>{{$rkbus->koefisien_gaji}}</strong></span><br />
                                    <span class="fa-xs">Remunerasi Rp.{{number_format($rkbus->remunerasi, 0, ',', ',')}}</span><br />
                                    <span class="fa-xs">Koef. Remun : {{$rkbus->koefisien_remunerasi}}</span><br />
                                </td>
                                <td class="py-2">
                                    <span class="fa-xs">BPJS Kesehatan : {{$rkbus->bpjs_kesehatan}}</span><br />
                                    <span class="fa-xs">BPJS TK : Rp.{{$rkbus->bpjs_tk}}</span><br />
                                    <span class="fa-xs">BPJS JHT :{{$rkbus->bpjs_jht}}</span><br />
                                </td>
                                <td class="py-2">
                                    <span class="fa-xs">Total Gaji Rp. {{number_format($rkbus->total_gaji_pokok, 0, ',', ',')}}</span><br />
                                    <span class="fa-xs">Total Remunerasi Rp.{{number_format($rkbus->total_remunerasi, 0, ',', ',')}}</span><br /><br />
                                    <span class="fs-12">Total Anggaran: <br /><span class="badge bg-dark">Rp. {{number_format($rkbus->total_anggaran, 0, ',', ',')}}</span></span><br /><br />
                                    <span class="fs-12">Sumber Dana: </span><br />
                                    <span class="badge bg-label-danger">{{ $rkbus->rekening_belanjas->aktivitas->sub_kegiatan->sumber_dana->nama_sumber_dana ?? 'Tidak ada data' }}</span>
                                    </small>
                                </td>
                                    <td>
                                        <ul class="timeline card-timeline mb-0">
                                            @if ($rkbus->id_status_validasi == '9cfb1f38-dc3f-436f-8c4a-ec4c4de2fcaf')
                                                <li class="timeline-item timeline-item-transparent">
                                                    <span class="timeline-point timeline-point-dark"></span>
                                                    <div class="timeline-event">
                                                        <div class="timeline-header mb-1">
                                                            <span class="badge bg-dark">
                                                                <small class="mb-2 fw-2">Perlu Validasi <p class="mb-0">KSP/Ka.Ins</p></small>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                            @elseif ($rkbus->id_status_validasi == '9cfb1f45-ca37-4bd3-8dc9-514c6b9f436c')
                                                <li class="timeline-item timeline-item-transparent">
                                                    <span class="timeline-point timeline-point-danger"></span>
                                                    <div class="">
                                                        <div class="timeline-header mb-1">
                                                            <span class="badge bg-danger">
                                                                <small class="mb-2 fw-2">Ditolak <p class="mb-0">KSP/Ka.Ins</p></small>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                            @elseif ($rkbus->id_status_validasi == '9cfb1edc-2263-401f-b249-361db4017932')
                                                <li class="timeline-item timeline-item-transparent">
                                                    <span class="timeline-point timeline-point-info"></span>
                                                    <div class="timeline-event">
                                                        <div class="timeline-header mb-1">
                                                            <span class="badge bg-info">
                                                                <small class="mb-2 fw-2">Validasi <p class="mb-0">KSP/Ka.Ins</p></small>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="timeline-item timeline-item-transparent">
                                                    <span class="timeline-point timeline-point-primary"></span>
                                                    <div class="timeline-event">
                                                        <div class="timeline-header mb-1">
                                                            <span class="badge bg-primary">
                                                                <small class="mb-2 fw-2">Perlu Validasi <p class="mb-0">Kabag/Kabid</p></small>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        
                                            <!-- Validasi RKA -->
                                            @if ($rkbus->id_status_validasi_rka == '9cfb1f87-238b-4ea2-98f0-4255e578b1d1')
                                                <li class="timeline-item timeline-item-transparent">
                                                    <span class="timeline-point timeline-point-success"></span>
                                                    <div class="">
                                                        <div class="timeline-header mb-1">
                                                            <span class="badge bg-success">
                                                                <small class="mb-2 fw-2">Validasi <p class="mb-0">Kabag/Kabid</p></small>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                            @elseif ($rkbus->id_status_validasi_rka == '9cfb1fa1-d0de-4e99-a368-8c218deda960')
                                                <li class="timeline-item timeline-item-transparent">
                                                    <span class="timeline-point timeline-point-danger"></span>
                                                    <div class="">
                                                        <div class="timeline-header mb-1">
                                                            <span class="badge bg-danger">
                                                                <small class="mb-2 fw-2">Ditolak <p class="mb-0">Kabag/Kabid</p></small>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        </ul>
                                    <td>
                    </form>
                                        @if (session('nama_level_user') == 'Administrator')
                                            <div class="demo-inline-spacing">
                                                <div class="demo-inline-spacing">
                                                <div class="btn-group" id="dropdown-icon-demo">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-menu me-1"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{ route('validasi_pegawai_pns_admins.edit', $rkbus->id_rkbu) }}" class="dropdown-item d-flex align-items-center"><i class="mdi mdi-chevron-right scaleX-n1-rtl"></i>Edit</a>
                                                        </li>
                                                        <form action="{{route('validasi_pegawai_pns_admins.destroy', $rkbus->id_rkbu)}}" method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item d-flex align-items-center"><i class="mdi mdi-chevron-right scaleX-n1-rtl"></i>Hapus</button>
                                                        </form>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </td> <!-- Close the <td> tag here -->
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <th></th>
                                <th>No</th>
                                <th>Sub Kategori</th>
                                <th>Profil Pegawai</th>
                                <th>Detail Pegawai</th>
                                <th>Detail Penggajian</th>
                                <th>Detail Jaminan</th>
                                <th>Detail Pendapatan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!--/ Header -->
    <!--/ Header -->
</div>
@endsection