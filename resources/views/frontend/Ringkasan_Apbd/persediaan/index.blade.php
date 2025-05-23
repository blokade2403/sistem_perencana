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
                                                    <a href="{{route('validasi_barang_jasa_admins.create')}}" class="btn rounded-pill btn-label-info waves-effect">
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
                                                    <a href="{{route('validasi_persediaan_admins.downloadPDF_ValidasipersediaanAdmin')}}" class="btn rounded-pill btn-label-warning waves-effect">
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
                                        <div class="d-flex bg-label-primary p-3 border rounded my-3">
                                            <div class="border border-2 border-primary rounded me-3 p-2 d-flex align-items-center justify-content-center w-px-40 h-px-40">
                                                <i class="mdi mdi-cash mdi-10px"></i>
                                            </div>
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0 fw-semibold">Total Terinput</h6>
                                                        <a href="javascript:void(0)" class="small" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">Lebih</a>
                                                        <a href="javascript:void(0)" class="small" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">Kurang</a>
                                                </div>
                                                <div class="user-progress">
                                                    <div class="d-flex justify-content-center">
                                                        <sup class="mt-3 mb-0 fw-semibold text-heading small">Rp. {{ number_format($total_anggaran, 0, ',', '.') }}</sup>
                                                        <h3 class="fw-medium mb-0"> </h3>
                                                        <sub class="mt-auto mb-2 text-heading small">,-</sub>
                                                    </div>
                                                    <div class="d-flex justify-content-center">
                                                        <sup class="mt-3 mb-0 text-heading small">Rp. </sup>
                                                        <h3 class="fw-small mb-0 text-danger"></h3>
                                                        <sub class="mt-auto mb-2 text-heading small">,-</sub>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                             <form action="{{ route('validasi_persediaan_admins.index') }}" method="GET">
                                @include('frontend.partials.filter_rkbu')
                            </form>
                            <form action="{{ route('validasi_persediaan_admins.massValidasi') }}" method="POST">
                                @csrf
                                @if (session('nama_level_user') == 'Administrator')
                                <button type="submit" class="btn btn-label-success">Validasi All</button>
                                @endif
                        <div class="table-responsive">
                        <table id="example" class="table table-striped" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="form-check custom-checkbox ms-2">
                                            <input type="checkbox" id="checkAll" class="form-check-input">
                                            <label for="checkAll">Check All</label>
                                        </div>
                                    </th>
                                    <th>No</th>
                                    <th>ID Sub</th>
                                    <th>Detail Usulan Barang</th>
                                    <th>Perhitungan Usulan Barang</th>
                                    <th>Detail Komponen</th>
                                    <th>Total Anggaran</th>
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
                                        <small>No. ID {{$rkbus->subKategoriRkbu->kode_sub_kategori_rkbu}}. {{$rkbus->subKategoriRkbu->nama_sub_kategori_rkbu}} <br /></small>
                                    </td>
                                    <td class="fs-14">
                                        <strong>
                                            <span class="fs-14 text-primary">
                                            {{$rkbus->nama_barang}}
                                            </span>
                                        </strong><br />
                                        <span class="fa-xs">Spesifikasi : {{$rkbus->spek}}</span><br />
                                        <small><span class="fs-12">Catatan : {{$rkbus->nama_barang}}</span></small><br /><br />
                                    </td>
                                    <td class="py-2">
                                        <span class="fa-sm">Stok Tahun {{$angka_kurang_2}} : {{$rkbus->stok}}</span><br />
                                        <span class="fa-sm">Rata2 Pemakaian {{$angka_kurang_1}} : {{$rkbus->rata_rata_pemakaian}}</span><br />
                                        <span class="fa-sm">Kebutuhan : {{$rkbus->kebutuhan_per_bulan}}</span><br />
                                        <span class="fa-sm">Pengadaan Tahun {{$angka_kurang_1}} : {{$rkbus->pengadaan_sebelumnya}}</span><br />
                                        <span class="fa-sm">Proyeksi Sisa Stok {{$angka_tahun}} : {{$rkbus->proyeksi_sisa_stok}}</span><br />
                                        <span class="fa-sm">Kebutuhan Tahun {{$angka_tahun}} : {{$rkbus->kebutuhan_tahun_x1}}</span><br />
                                        <span class="fa-sm">Buffer : {{$rkbus->buffer}}</span><br />
                                        <span class="fa-sm">Kebutuhan + Buffer : {{$rkbus->kebutuhan_plus_buffer}}</span><br />
                                        <span class="fa-sm text-danger mb-0">Rencana Pengadaan Tahun {{$angka_tahun}} : {{$rkbus->rencana_pengadaan_tahun_x1}}<strong> </strong></span><br />
                                    </td>
                                    <td class="py-2"><small>
                                            <span class="fs-14">Rp. {{number_format($rkbus->harga_satuan)}}</span><br />
                                            <span class="fs-12">PPN : {{$rkbus->ppn}} %</span><br /><br />
                                            <span class="fs-12">Total Anggaran: <br /><span class="badge bg-dark">Rp. {{number_format($rkbus->total_anggaran)}}</span></span><br /><br />
                                            <span class="fs-12">Sisa Jumlah Vol: </span><br />
                                            <span class="fs-12 badge bg-label-danger">{{$rkbus->sisa_vol_rkbu}}</span><br />
                                            <span class="fs-12">Sisa Anggaran: </span><br />
                                            <span class="fs-12 badge bg-label-danger">Rp. {{ number_format($rkbus->sisa_anggaran_rkbu) }}</span></br></br>
                                            <span class="fs-12">Sumber Dana: </span><br />
                                                <span class="badge bg-label-danger">{{ $rkbus->rekening_belanjas->aktivitas->sub_kegiatan->sumber_dana->nama_sumber_dana ?? 'Tidak ada data' }}</span>
                                        </small></td>
                                    </small></td>
                                    <td class="py-2">
                                        <span class="fa-sm">{{$rkbus->rating}}</span><br />
                                        <span class="fa-sm">TA : {{$rkbus->nama_tahun_anggaran}}</span><br />
                                        <span class="fa-sm">{{$rkbus->created_at}}</span><br />
                                        <span class="fa-sm">link e-kat: <a href="{{$rkbus->link_ekatalog}}"> {{$rkbus->link_ekatalog}}</a></span>
                                        <br />
                                        <br />
                                        @if (!empty($rkbus->upload_file_1))
                                        <span class="fa-sm">Dok. KAP : 
                                            <a href="{{ asset('storage/uploads/' . basename($rkbus->upload_file_1)) }}" target="_blank">
                                                {{ basename($rkbus->upload_file_1) }}
                                            </a>
                                        </span><br />
                                        @else
                                            <span class="fa-sm text-danger">Dok. KAP : No File.</span><br />
                                        @endif
                                        @if (!empty($rkbus->upload_file_2))
                                        <span class="fa-sm">Dok. SPH1 : 
                                            <a href="{{ asset('storage/uploads/' . basename($rkbus->upload_file_2)) }}" target="_blank">
                                                {{ basename($rkbus->upload_file_2) }}
                                            </a>
                                        </span><br />
                                        @else
                                        <span class="fa-sm text-danger">Dok. SPH1 : No File.</span><br />
                                        @endif
                                        @if (!empty($rkbus->upload_file_3))
                                        <span class="fa-sm">Dok. SPH2 : 
                                            <a href="{{ asset('storage/uploads/' . basename($rkbus->upload_file_3)) }}" target="_blank">
                                                {{ basename($rkbus->upload_file_3) }}
                                            </a>
                                        </span><br />
                                        @else
                                        <span class="fa-sm text-danger">Dok. SPH2 : No File.</span><br />
                                        @endif
                                        @if (!empty($rkbus->upload_file_4))
                                        <span class="fa-sm">Dok. SPH3 : 
                                            <a href="{{ asset('storage/uploads/' . basename($rkbus->upload_file_4)) }}" target="_blank">
                                                {{ basename($rkbus->upload_file_4) }}
                                            </a>
                                        </span><br />
                                        @else
                                        <span class="fa-sm text-danger">Dok. SPH3 : No File.</span><br />
                                        @endif
                                        </small><br />
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
                                                        <a href="{{ route('validasi_persediaan_admins.edit', $rkbus->id_rkbu) }}" class="dropdown-item d-flex align-items-center"><i class="mdi mdi-chevron-right scaleX-n1-rtl"></i>Edit</a>
                                                    </li>
                                                    <form action="{{route('validasi_persediaan_admins.destroy', $rkbus->id_rkbu)}}" method="POST" class="delete-form">
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
                                    <th>ID SUB</th>
                                    <th>Nama Barang dan Spek</th>
                                    <th>Quantity</th>
                                    <th>Detail Anggaran</th>
                                    <th>Detail Usulan</th>
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