@extends('layouts.main')
@section('container')
    <!-- Content -->
        <!-- Header -->
            <div class="card-body">
                <!-- Header -->
                <div class="row">
                    <div class="col-12">
                        <div class="card col-12 mb-4">
                            <div class="key-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                                <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                                    <img src="{{asset('assets/img/illustrations/coming-soon-img.png')}}" height="157" width="175" alt="key image" class="d-block h-auto ms-0 ms-sm-4 rounded key-profile-img" />
                                </div>
                                <div class="flex-grow-1 mt-3 mt-sm-5">
                                    <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                        <div class="key-profile-info">
                                            <h4> {{session('nama_lengkap')}}</h4>
                                            <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                                <li class="list-inline-item">
                                                    <i class="mdi mdi-account-convert me-1 mdi-20px"></i><span class="badge rounded-pill bg-label-danger"> {{session('nama_unit')}}</span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="mdi mdi-calendar-blank-outline me-1 mdi-20px"></i><span class="fw-semibold"><?php echo date('l, d-m-Y  H:i:s'); ?></span>
                                                </li>
                                            </ul>
                                            <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group" role="group" aria-label="First group">
                                                    <a href="{{route('judul_headers.create')}}" class="btn btn-outline-secondary btn-primary">
                                                        <i class="mdi mdi-account-check-outline me-1">Add</i>
                                                    </a>
                                                    <button type="button" class="btn btn-outline-secondary">
                                                        <i class="tf-icons mdi mdi-calendar-blank-outline"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-secondary">
                                                        <i class="tf-icons mdi mdi-shield-check-outline"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-secondary">
                                                        <i class="tf-icons mdi mdi-chat-processing-outline"></i>
                                                    </button>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="Third group">
                                                    <button type="button" class="btn btn-outline-secondary btn-success">
                                                        <i class="tf-icons mdi mdi-download">Download Report</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <!--/ Header -->
        <div class="col-12">
            <div class="card">
                <form method="POST" action="" id="form-delete">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr class="text-center mt-2">
                                        <th>No</th>
                                        <th>Nama RS</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Email</th>
                                        <th>Wilayah</th>
                                        <th>Kode Pos</th>
                                        <th>Header</th>
                                        <th>Header2</th>
                                        <th>Header3</th>
                                        <th>Header6</th>
                                        <th>Gambar 1</th>
                                        <th>Gambar 2</th>
                                        <th>Gambar 3</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach($judul_headers as $key)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $key->nama_rs }}</td>
                                        <td>{{ $key->alamat_rs }}</td>
                                        <td>{{ $key->tlp_rs }}</td>
                                        <td>{{ $key->email_rs }}</td>
                                        <td>{{ $key->wilayah }}</td>
                                        <td>{{ $key->kode_pos }}</td>
                                        <td>{{ $key->header1 }}</td>
                                        <td>{{ $key->header4 }}</td>
                                        <td>{{ $key->header5 }}</td>
                                        <td>{{ $key->header6 }}</td>
                                        <td>
                                            @if($key->gambar1)
                                                <img src="{{ asset('storage/uploads/' . basename($key->gambar1)) }}" alt="Gambar 1" style="max-width: 100px;">
                                            @else
                                                <span>Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($key->gambar2)
                                                <img src="{{ asset('storage/uploads/' . basename($key->gambar2)) }}" alt="Gambar 2" style="max-width: 100px;">
                                            @else
                                                <span>Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($key->header7)
                                                <img src="{{ asset('storage/uploads/' . basename($key->header7)) }}" alt="Gambar 3" style="max-width: 100px;">
                                            @else
                                                <span>Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" id="dropdown-icon-demo">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-menu me-1"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="{{ route('judul_headers.edit', $key->id_judul_header) }}" class="dropdown-item d-flex align-items-center"><i class="mdi mdi-chevron-right scaleX-n1-rtl"></i>Edit</a>
                                                    </li>
                                                    <form action="{{ route('judul_headers.destroy', $key->id_judul_header) }}" method="POST" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item d-flex align-items-center"><i class="mdi mdi-chevron-right scaleX-n1-rtl"></i>Hapus</button>
                                                    </form>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama RS</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Email</th>
                                        <th>Wilayah</th>
                                        <th>Kode Pos</th>
                                        <th>Header</th>
                                        <th>Header6</th>
                                        <th>Gambar 1</th>
                                        <th>Gambar 2</th>
                                        <th>Gambar 3</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection

