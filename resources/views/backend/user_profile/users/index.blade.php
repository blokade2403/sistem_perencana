@extends('layouts.main')
@section('container')
    <!-- Content -->
        <!-- Header -->
            <div class="card-body">
                <!-- Header -->
                <div class="row">
                    <div class="col-12">
                        <div class="card col-12 mb-4">
                            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                                <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                                    <img src="{{asset('assets/img/illustrations/coming-soon-img.png')}}" height="157" width="175" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
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
                                                    <a href="{{ route('users.create') }}" class="btn btn-icon btn-outline-info waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" data-bs-original-title="Tambah Data User">
                                                        <span class="tf-icons mdi mdi-account-plus"></span>
                                                    </a>
                                                <form action="{{ route('update.status', '9cff8aee-6b6d-49e8-a1d4-cb44f96377d8') }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-icon btn-outline-danger waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-danger" data-bs-original-title="Non Aktif Edit User">
                                                        <span class="tf-icons mdi mdi-account-off"></span>
                                                    </button>
                                                </form>
                                                <form action="{{ route('update.status.aktif', '9cff8aee-6b6d-49e8-a1d4-cb44f96377d8') }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-icon btn-outline-primary waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-primary" data-bs-original-title="Aktif Edit User">
                                                        <span class="tf-icons mdi mdi-account-lock-open"></span>
                                                    </button>
                                                </form>
                                                <form action="{{ route('update.status.perencanaan', '12345678-1234-1234-1234-123456789abc') }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-icon btn-outline-info waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" data-bs-original-title="Perencanaan">
                                                        <span class="tf-icons mdi mdi-alpha-p-box"></span>
                                                    </button>
                                                </form>
                                                <form action="{{ route('update.status.penetapan', '12345678-1234-1234-1234-123456789abc') }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-icon btn-outline-info waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" data-bs-original-title="Penetapan">
                                                        <span class="tf-icons mdi mdi-book-open"></span>
                                                    </button>
                                                </form>
                                                <form action="{{ route('update.status.perubahan', '12345678-1234-1234-1234-123456789abc') }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-icon btn-outline-info waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" data-bs-original-title="Perubahan">
                                                        <span class="tf-icons mdi mdi-bank-outline"></span>
                                                    </button>
                                                </form>
                                                </div>
                                        </div>
                                  
                                </div>
                                <!-- /////// -->
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
                                        <th>Detail User</th>
                                        <th>Unit</th>
                                        <th>Fase Anggaran</th>
                                        <th>Status Edit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <div class="timeline-event">
                                              <div class="timeline-header mb-1">
                                                <h6 class="mb-0"><span class="fa-sm text-primary">{{$user->unit->nama_unit}}</span></strong></h6>
                                                <span class="text-muted">Status User : {!! $user->status_user === 'aktif' ? '<span class="badge bg-label-success">Aktif</span>' : '<span class="badge bg-label-danger">Non Aktif</span>'!!}</span>
                                              </div></br>
                                          
                                              <!-- Avatar dan Detail di samping -->
                                              <div class="d-flex align-items-center">
                                                <div class="avatar me-3">
                                                  <img src="../../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle">
                                                </div>
                                                <div>
                                                  <h6 class="mb-0">{{ $user->nama_lengkap }} ({{ $user->levelUser->nama_level_user }})</h6>
                                                  <span class="text-muted">{{ $user->username }}</span></br>
                                                  <span class="text-muted fa-sm">NIP : {{$user->nip_user}}</span>
                                                </div>
                                              </div>
                                            </div>
                                          
                                            <!-- Info user -->
                                            <div class="mt-3">
                                              <span class="fa-sm">
                                                <span class="badge bg-label-info">ID User : {{$user->id_user}}</span>
                                              </span><br>
                                             
                                            </div>
                                        </td>
                                          
                                        <td class="py-2 text-nowrap">
                                            <div class="timeline-event">
                                                <div class="timeline-header mb-1">
                                                  <h6 class="mb-0">KSP / Ka.Ins :</h6>
                                                  <span class="text-muted">{{$user->ksp->nama_ksp}}</span>
                                                </div>
                                                <div class="timeline-header mb-1">
                                                    <h6 class="mb-0">Ka. Bagian :</h6>
                                                    <span class="text-muted">{{$user->ksp->pejabat->nama_pejabat}}</span>
                                                  </div>
                                                  <span class="fa-sm"><small>ID Admin : {{$user->id_admin_pendukung_ppk}}</small></span>
                                              </div>
                                        </td>
                                        <td>   <span class="badge bg-label-primary">{{$user->fase->nama_fase}}</span></td>
                                        <td>  {!! $user->status_edit === 'aktif' ? '<span class="badge bg-label-success">Aktif</span>' : '<span class="badge bg-label-danger">Non Aktif</span>'!!}</td>
                                        <td>
                                            <div class="btn-group" id="dropdown-icon-demo">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-menu me-1"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="{{ route('users.edit', $user->id_user) }}" class="dropdown-item d-flex align-items-center"><i class="mdi mdi-chevron-right scaleX-n1-rtl"></i>Edit</a>
                                                    </li>
                                                    <form action="{{ route('users.destroy', $user->id_user) }}" method="POST" class="delete-form">
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
                                        <th>Detail User</th>
                                        <th>Unit</th>
                                        <th>Fase Anggaran</th>
                                        <th>Status Edit</th>
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

