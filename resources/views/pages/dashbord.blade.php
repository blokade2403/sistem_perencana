@extends('layouts.main')
@section('container')
<div class="row gy-4 mb-4">
  <!-- Congratulations card -->
  <div class="col-md-12 col-lg-12">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-md-6 order-2 order-md-1">
          <div class="card-body">
            <h4 class="card-title mb-1 d-flex gap-2 flex-wrap">
              Selamat Datang <p><strong>{{ session('nama_lengkap') }}</strong> 🎉</p>
          </h4>
          <p class="pb-0">Total Anggaran Terinput</p>
          <h4 class="text-primary mb-1">Rp. 
            @if (session('nama_level_user') == 'User')
            {{number_format($total_anggaran_user)}}
            @elseif (session('nama_level_user') == 'Validasi')
            {{number_format($total_anggaran_ksp)}}
            @elseif (session('nama_level_user') == 'Validasi RKA')
            {{number_format($total_anggaran_kabag)}}
            @elseif (session('nama_level_user') == 'Administrator')
            {{number_format($total_anggaran_admin+$total_anggaran_admin_apbd)}}
            @endif
            </h4>
          <p class="mb-2 pb-1"></p>
            <a href="{{route('kertas_kerjas.index')}}" class="btn btn-primary waves-effect waves-light">Kertas Kerja BLUD</a>
          </div>
        </div>
        <div class="col-md-6 text-center text-md-end order-1 order-md-2">
          <div class="card-body pb-0 px-0 px-md-4 ps-0">
            <img src="../../assets/img/illustrations/file.png" height="180" alt="View Profile" data-app-light-img="illustrations/file.png" data-app-dark-img="illustrations/file.png">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Congratulations card -->

 <!-- Ratings -->
<div class="col-lg-3 col-sm-6">
    <div class="card text-white mb-3">
      <div class="row">
        <div class="col-6">
          <div class="card-body">
            <div class="card-info mb-2 pb-2">
              <h6 class="mb-2 text-nowrap">Total Anggaran BLUD</h6>
              <div class="badge bg-label-info rounded-pill lh-xs"></div>
            </div>
            <div class="d-flex align-items-end">
              <div class="user-progress">
                <div class="d-flex justify-content-center">
                  <sup class="mt-3 mb-0 text-heading small"><span class="fa-xs">Rp. </span></sup>
                  <h3 class="fw-medium mb-0"><span class="fa-xs">
                    @if (session('nama_level_user') == 'User')
                    {{ number_format($total_anggaran_user, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Validasi RKA')
                    {{ number_format($total_anggaran_kabag, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Validasi')
                    {{ number_format($total_anggaran_ksp, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Administrator')
                    {{ number_format($total_anggaran_admin, 0, ',', '.') }}
                    @endif
                  </span></h3>
                  <sub class="mt-auto mb-2 text-heading small"></sub>
                </div>
              </div>
              <h5 class="fw-medium mb-0"><span class="fa-sm"></span></h5>
            </div>
          </div>
        </div>
        <div class="col-6 text-end d-flex align-items">
          <div class="card-body pb-0 pt-3">
            <img src="{{asset('assets/img/illustrations/misc-not-authorized-object.png')}}" alt="Ratings" width="85" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Ratings -->
  
  <!-- Sessions -->
  <div class="col-lg-3 col-sm-6">
    <div class="card">
      <div class="row">
        <div class="col-6">
          <div class="card-body">
            <div class="card-info mb-2 pb-2">
              <h6 class="mb-2 text-nowrap">Belanja Pegawai BLUD</h6>
              <div class="badge bg-label-info rounded-pill lh-xs"></div>
            </div>
            <div class="d-flex align-items-end">
              <div class="user-progress">
                <div class="d-flex justify-content-center">
                  <sup class="mt-3 mb-0 text-heading small"><span class="fa-xs">Rp. </span></sup>
                  <h3 class="fw-medium mb-0"><span class="fa-xs">
                    @if (session('nama_level_user') == 'User')
                    {{ number_format($total_anggaran_pegawai_user, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Validasi')
                    {{ number_format($total_anggaran_pegawai_ksp, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Validasi RKA')
                    {{ number_format($total_anggaran_pegawai_kabag, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Administrator')
                    {{ number_format($total_anggaran_pegawai_admin, 0, ',', '.') }}
                    @endif
                  <sub class="mt-auto mb-2 text-heading small"></sub>
                </div>
              </div>
              <h5 class="fw-medium mb-0"><span class="fa-sm"></span></h5>
            </div>
          </div>
        </div>
        <div class="col-6 text-end d-flex align-items">
          <div class="card-body pb-0 pt-3">
            <img src="{{asset('assets/img/illustrations/misc-not-authorized-object.png')}}" alt="Ratings" width="85" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Sessions -->
  
  <!-- Customers -->
  <div class="col-lg-3 col-sm-6">
    <div class="card">
      <div class="row">
        <div class="col-6">
          <div class="card-body">
            <div class="card-info mb-2 pb-2">
              <h6 class="mb-2 text-nowrap">Belanja Barjas BLUD</h6>
              <div class="badge bg-label-info rounded-pill lh-xs"></div>
            </div>
            <div class="d-flex align-items-end">
              <div class="user-progress">
                <div class="d-flex justify-content-center">
                  <sup class="mt-3 mb-0 text-heading small"><span class="fa-xs">Rp. </span></sup>
                  <h3 class="fw-medium mb-0"><span class="fa-xs">
                    @if (session('nama_level_user') == 'User')
                    {{ number_format($total_anggaran_barjas_user, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Validasi')
                    {{ number_format($total_anggaran_barjas_ksp, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Validasi RKA')
                    {{ number_format($total_anggaran_barjas_kabag, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Administrator')
                    {{ number_format($total_anggaran_barjas_admin, 0, ',', '.') }}
                    @endif
                  </span></h3>
                  <sub class="mt-auto mb-2 text-heading small"></sub>
                </div>
              </div>
              <h5 class="fw-medium mb-0"><span class="fa-sm"></span></h5>
            </div>
          </div>
        </div>
        <div class="col-6 text-end d-flex align-items">
          <div class="card-body pb-0 pt-3">
            <img src="{{asset('assets/img/illustrations/misc-error-object.png')}}" alt="Ratings" width="85" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Customers -->
  
  <!-- Total Orders -->
  <div class="col-lg-3 col-sm-6">
    <div class="card">
      <div class="row">
        <div class="col-6">
          <div class="card-body">
            <div class="card-info mb-2 pb-2">
              <h6 class="mb-2 text-nowrap">Belanja Modal BLUD</h6>
              <div class="badge bg-label-info rounded-pill lh-xs"></div>
            </div>
            <div class="d-flex align-items-end">
              <div class="user-progress">
                <div class="d-flex justify-content-center">
                  <sup class="mt-3 mb-0 text-heading small"><span class="fa-xs">Rp. </span></sup>
                  <h3 class="fw-medium mb-0"><span class="fa-xs">
                    @if (session('nama_level_user') == 'User')
                    {{ number_format($total_anggaran_modal_user, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Validasi')
                    {{ number_format($total_anggaran_modal_ksp, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Validasi RKA')
                    {{ number_format($total_anggaran_modal_kabag, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Administrator')
                    {{ number_format($total_anggaran_modal_admin, 0, ',', '.') }}
                    @endif
                  </span></h3>
                  <sub class="mt-auto mb-2 text-heading small"></sub>
                </div>
              </div>
              <h5 class="fw-medium mb-0"><span class="fa-sm"></span></h5>
            </div>
          </div>
        </div>
        <div class="col-6 text-end d-flex align-items">
          <div class="card-body pb-0 pt-3">
            <img src="{{asset('assets/img/illustrations/misc-under-maintenance-object.png')}}" alt="Ratings" width="85" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Ratings -->
<div class="col-lg-3 col-sm-6">
    <div class="card text-white mb-3">
      <div class="row">
        <div class="col-6">
          <div class="card-body">
            <div class="card-info mb-2 pb-2">
              <h6 class="mb-2 text-nowrap">Total Anggaran APBD</h6>
              <div class="badge bg-label-info rounded-pill lh-xs"></div>
            </div>
            <div class="d-flex align-items-end">
              <div class="user-progress">
                <div class="d-flex justify-content-center">
                  <sup class="mt-3 mb-0 text-heading small"><span class="fa-xs">Rp. </span></sup>
                  <h3 class="fw-medium mb-0"><span class="fa-xs">
                    @if (session('nama_level_user') == 'User')
                    {{ number_format($total_anggaran_user_apbd, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Validasi RKA')
                    {{ number_format($total_anggaran_kabag_apbd, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Validasi')
                    {{ number_format($total_anggaran_ksp_apbd, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Administrator')
                    {{ number_format($total_anggaran_admin_apbd, 0, ',', '.') }}
                    @endif
                  </span></h3>
                  <sub class="mt-auto mb-2 text-heading small"></sub>
                </div>
              </div>
              <h5 class="fw-medium mb-0"><span class="fa-sm"></span></h5>
            </div>
          </div>
        </div>
        <div class="col-6 text-end d-flex align-items">
          <div class="card-body pb-0 pt-3">
            <img src="{{asset('assets/img/illustrations/456.png')}}" alt="Ratings" width="85" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Ratings -->
  
  <!-- Sessions -->
  <div class="col-lg-3 col-sm-6">
    <div class="card">
      <div class="row">
        <div class="col-6">
          <div class="card-body">
            <div class="card-info mb-2 pb-2">
              <h6 class="mb-2 text-nowrap">Belanja Pegawai APBD</h6>
              <div class="badge bg-label-info rounded-pill lh-xs"></div>
            </div>
            <div class="d-flex align-items-end">
              <div class="user-progress">
                <div class="d-flex justify-content-center">
                  <sup class="mt-3 mb-0 text-heading small"><span class="fa-xs">Rp. </span></sup>
                  <h3 class="fw-medium mb-0"><span class="fa-xs">
                    @if (session('nama_level_user') == 'User')
                    {{ number_format($total_anggaran_pegawai_user_apbd, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Validasi')
                    {{ number_format($total_anggaran_pegawai_ksp_apbd, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Validasi RKA')
                    {{ number_format($total_anggaran_pegawai_kabag_apbd, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Administrator')
                    {{ number_format($total_anggaran_pegawai_admin_apbd, 0, ',', '.') }}
                    @endif
                  <sub class="mt-auto mb-2 text-heading small"></sub>
                </div>
              </div>
              <h5 class="fw-medium mb-0"><span class="fa-sm"></span></h5>
            </div>
          </div>
        </div>
        <div class="col-6 text-end d-flex align-items">
          <div class="card-body pb-0 pt-3">
            <img src="{{asset('assets/img/illustrations/123.png')}}" alt="Ratings" width="85" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Sessions -->
  
  <!-- Customers -->
  <div class="col-lg-3 col-sm-6">
    <div class="card">
      <div class="row">
        <div class="col-6">
          <div class="card-body">
            <div class="card-info mb-2 pb-2">
              <h6 class="mb-2 text-nowrap">Belanja Barjas APBD</h6>
              <div class="badge bg-label-info rounded-pill lh-xs"></div>
            </div>
            <div class="d-flex align-items-end">
              <div class="user-progress">
                <div class="d-flex justify-content-center">
                  <sup class="mt-3 mb-0 text-heading small"><span class="fa-xs">Rp. </span></sup>
                  <h3 class="fw-medium mb-0"><span class="fa-xs">
                    @if (session('nama_level_user') == 'User')
                    {{ number_format($total_anggaran_barjas_user_apbd, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Validasi')
                    {{ number_format($total_anggaran_barjas_ksp_apbd, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Validasi RKA')
                    {{ number_format($total_anggaran_barjas_kabag_apbd, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Administrator')
                    {{ number_format($total_anggaran_barjas_admin_apbd, 0, ',', '.') }}
                    @endif
                  </span></h3>
                  <sub class="mt-auto mb-2 text-heading small"></sub>
                </div>
              </div>
              <h5 class="fw-medium mb-0"><span class="fa-sm"></span></h5>
            </div>
          </div>
        </div>
        <div class="col-6 text-end d-flex align-items">
          <div class="card-body pb-0 pt-3">
            <img src="{{asset('assets/img/illustrations/345.png')}}" alt="Ratings" width="85" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Customers -->
  
  <!-- Total Orders -->
  <div class="col-lg-3 col-sm-6">
    <div class="card">
      <div class="row">
        <div class="col-6">
          <div class="card-body">
            <div class="card-info mb-2 pb-2">
              <h6 class="mb-2 text-nowrap">Belanja Modal APBD</h6>
              <div class="badge bg-label-info rounded-pill lh-xs"></div>
            </div>
            <div class="d-flex align-items-end">
              <div class="user-progress">
                <div class="d-flex justify-content-center">
                  <sup class="mt-3 mb-0 text-heading small"><span class="fa-xs">Rp. </span></sup>
                  <h3 class="fw-medium mb-0"><span class="fa-xs">
                    @if (session('nama_level_user') == 'User')
                    {{ number_format($total_anggaran_modal_user_apbd, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Validasi')
                    {{ number_format($total_anggaran_modal_ksp_apbd, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Validasi RKA')
                    {{ number_format($total_anggaran_modal_kabag_apbd, 0, ',', '.') }}
                    @elseif (session('nama_level_user') == 'Administrator')
                    {{ number_format($total_anggaran_modal_admin_apbd, 0, ',', '.') }}
                    @endif
                  </span></h3>
                  <sub class="mt-auto mb-2 text-heading small"></sub>
                </div>
              </div>
              <h5 class="fw-medium mb-0"><span class="fa-sm"></span></h5>
            </div>
          </div>
        </div>
        <div class="col-6 text-end d-flex align-items">
          <div class="card-body pb-0 pt-3">
            <img src="{{asset('assets/img/illustrations/012.png')}}" alt="Ratings" width="85" />
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row gy-4">
    
   
    <!--/ Project Timeline Chart-->
    <div class="col-12 col-xl-12">
      <div class="row gy-4 mb-4">
        <!-- Sales Overview-->
        <div class="col-lg-12">
          <div class="card h-100">
            <div class="card-header">
              <div class="d-flex justify-content-between">
                <h4 class="mb-2">Anggaran RBA</h4>
                <div class="dropdown">
                  <button class="btn p-0" type="button" id="salesOverview" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical mdi-24px"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesOverview">
                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                    <a class="dropdown-item" href="javascript:void(0);">Update</a>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="card-body d-flex justify-content-between flex-wrap gap-3">
              <div class="d-flex gap-3">
                <div class="avatar">
                  <div class="avatar-initial bg-label-primary rounded">
                    <i class="mdi mdi-account-outline mdi-24px"></i>
                  </div>
                </div>
                <div class="card-info">
                  <h4 class="mb-0">Rp. {{number_format($total_anggaran_admin), 0, ',',','}} </h4>
                  <small class="text-muted">Belanja BLUD</small><br />
                  <small>Pagu Belanja BLUD <br /> Rp. {{number_format($total_pagu), 0, ',',','}}
                      <span><br /></span>
                  </small>
                  <small>
                    <br />Selisih <span class="badge bg-label-info text-danger text-danger">Rp. {{number_format($selisih_pagu), 0, ',',','}}</span>
                  </small>
                </div>
              </div>
              <div class="d-flex gap-3">
                <div class="avatar">
                  <div class="avatar-initial bg-label-warning rounded">
                    <i class="mdi mdi-poll mdi-24px"></i>
                  </div>
                </div>
                <div class="card-info">
                  <h4 class="mb-0">Rp. {{number_format($total_anggaran_pegawai_admin), 0, ',',','}} </h4>
                  <small class="text-muted">Belanja Pegawai</small><br />
                  <small>Pagu Belanja Pegawai <br /> Rp. {{number_format($pagu_pegawai), 0, ',',','}}
                      <span><br /></span>
                  </small>
                  <small>
                    <br />Selisih<span class="badge bg-label-info text-danger text-danger">Rp. {{number_format($selisih_pagu_pegawai), 0, ',',','}}</span>
                  </small>
                </div>
              </div>
              <div class="d-flex gap-3">
                <div class="avatar">
                  <div class="avatar-initial bg-label-info rounded">
                    <i class="mdi mdi-trending-up mdi-24px"></i>
                  </div>
                </div>
                <div class="card-info">
                  <h4 class="mb-0">Rp. {{number_format($total_anggaran_barjas_admin), 0, ',',','}}</h4>
                  <small class="text-muted">Belanja Barang dan Jasa</small><br />
                  <small>Pagu Belanja Barjas <br /> Rp. {{number_format($pagu_barjas), 0, ',',','}}
                   
                      <span><br /></span>
                  </small>
                  <small>
                    <br />Selisih<span class="badge bg-label-info text-danger text-danger">Rp. {{number_format($selisih_pagu_barjas), 0, ',',','}}</span>
                  </small>
                </div>
              </div>
              <div class="d-flex gap-3">
                <div class="avatar">
                  <div class="avatar-initial bg-label-info rounded">
                    <i class="mdi mdi-trending-up mdi-24px"></i>
                  </div>
                </div>
                <div class="card-info">
                  <h4 class="mb-0">Rp. {{number_format($total_anggaran_modal_admin), 0, ',',','}}</h4>
                  <small class="text-muted">Belanja Modal</small><br />
                  <small>Pagu Belanja Modal <br /> Rp. {{number_format($pagu_modal), 0, ',',','}}
                    <span><br /></span>
                  </small>
                  <small>
                
                    <br />Selisih<span class="badge bg-label-info text-danger">Rp. {{number_format($selisih_pagu_modal), 0, ',',','}}</span>
                  </small>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ Sales Overview-->
      </div>
    </div>

   
    <!-- Weekly Overview Chart -->

    @include('partials.daftar_unit_input')
    @include('partials.hirarki_sub_kegiatan')
   

    <!-- Roles Datatables -->
    @include('partials.ringkasan_dashbord')
    @include('partials.modal_dashbord')

</div>
@endsection