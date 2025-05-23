@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->

        <!-- Content -->
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Title</h4>
              
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
                                            <h4>Nama Lengkap</h4>
                                            <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                                <li class="list-inline-item">
                                                    <i class="mdi mdi-map-marker-outline me-1 mdi-20px"></i><span class="fw-semibold">Nama Unit</span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="mdi mdi-calendar-blank-outline me-1 mdi-20px"></i><span class="fw-semibold">{{date(('l, d-m-Y  H:i:s'))}} </span>
                                                </li>
                                            </ul>
                                            <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group" role="group" aria-label="First group">
                                                    <a href="{{route('status_validasis.create')}}" class="btn btn-outline-secondary btn-primary">
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
                        <div class="card-body">
                        <div class="table">
                        <table id="example" class="table table-bordered" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Status Validasi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($status_validasis->isEmpty())
            <div class="alert alert-danger text-center">
                Tidak ada data yang tersedia.
            </div>
        @else
                                <tr>
                                    @foreach ($status_validasis as $key)
                                    <td>{{ $key->id_status_validasi }}</td>
                                    <td>{{ $key->nama_validasi }}</td>
                                        <td>
                                            <div class="btn-group" id="dropdown-icon-demo">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-menu me-1"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="{{ route('status_validasis.edit', $key->id_status_validasi) }}" class="dropdown-item d-flex align-items-center"><i class="mdi mdi-chevron-right scaleX-n1-rtl"></i>Edit</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('status_validasis.show', $key->id_status_validasi) }}" class="dropdown-item d-flex align-items-center"><i class="mdi mdi-chevron-right scaleX-n1-rtl"></i>Swo</a>
                                                    </li>
                                                    <form action="{{ route('status_validasis.destroy', $key->id_status_validasi) }}" method="POST" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item d-flex align-items-center"><i class="mdi mdi-chevron-right scaleX-n1-rtl"></i>Hapus</button>
                                                    </form>
                                                </ul>
                                            </div>
                                        </td>
                                </tr>
                                @endforeach
                                 @endif
                            </tbody>
                            <tfoot>
                                <th>No</th>
                                <th>Nama Status Validasi</th>
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