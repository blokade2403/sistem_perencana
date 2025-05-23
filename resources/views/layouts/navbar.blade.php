    <!-- Layout container -->
    <div class="layout-page">
      <!-- Navbar -->

      <nav
        class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
          <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="mdi mdi-menu mdi-24px"></i>
          </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
          <!-- Search -->
          <div class="navbar-nav align-items-center">
            <div class="nav-item navbar-search-wrapper mb-0">
              <a class="nav-item nav-link search-toggler fw-normal px-0" href="javascript:void(0);">
                <i class="mdi mdi-magnify mdi-24px scaleX-n1-rtl"></i>
                <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
              </a>
            </div>
          </div>
          <!-- /Search -->
          
          <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Language -->
            <button type="button" class="btn btn-danger text-nowrap d-inline-flex position-relative me-3">
              {{session('tahun_anggaran')}}
            </button>
            <!-- Style Switcher -->
            <li class="nav-item me-1 me-xl-0">
              <a
                class="nav-link btn btn-text-secondary rounded-pill btn-icon style-switcher-toggle hide-arrow"
                href="javascript:void(0);">
                <i class="mdi mdi-24px"></i>
              </a>
            </li>
            <!--/ Style Switcher -->

            <!-- Quick links  -->
            <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-1 me-xl-0">
              <a
                class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                href="javascript:void(0);"
                data-bs-toggle="dropdown"
                data-bs-auto-close="outside"
                aria-expanded="false">
                <i class="mdi mdi-view-grid-plus-outline mdi-24px"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-end py-0">
                <div class="dropdown-menu-header border-bottom">
                  <div class="dropdown-header d-flex align-items-center py-3">
                    <h5 class="text-body mb-0 me-auto">Shortcuts</h5>
                    <a
                      href="javascript:void(0)"
                      class="dropdown-shortcuts-add text-muted"
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Add shortcuts"
                      ><i class="mdi mdi-view-grid-plus-outline mdi-24px"></i
                    ></a>
                  </div>
                </div>
                <div class="dropdown-shortcuts-list scrollable-container">
                  <div class="row row-bordered overflow-visible g-0">
                    <div class="dropdown-shortcuts-item col">
                      <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                        <i class="mdi mdi-calendar fs-4"></i>
                      </span>
                      <a href="app-calendar.html" class="stretched-link">Calendar</a>
                      <small class="text-muted mb-0">Appointments</small>
                    </div>
                    <div class="dropdown-shortcuts-item col">
                      <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                        <i class="mdi mdi-file-document-outline fs-4"></i>
                      </span>
                      <a href="app-invoice-list.html" class="stretched-link">Invoice App</a>
                      <small class="text-muted mb-0">Manage Accounts</small>
                    </div>
                  </div>
                  <div class="row row-bordered overflow-visible g-0">
                    <div class="dropdown-shortcuts-item col">
                      <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                        <i class="mdi mdi-account-outline fs-4"></i>
                      </span>
                      <a href="app-user-list.html" class="stretched-link">User App</a>
                      <small class="text-muted mb-0">Manage Users</small>
                    </div>
                    <div class="dropdown-shortcuts-item col">
                      <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                        <i class="mdi mdi-shield-check-outline fs-4"></i>
                      </span>
                      <a href="app-access-roles.html" class="stretched-link">Role Management</a>
                      <small class="text-muted mb-0">Permission</small>
                    </div>
                  </div>
                  <div class="row row-bordered overflow-visible g-0">
                    <div class="dropdown-shortcuts-item col">
                      <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                        <i class="mdi mdi-chart-pie-outline fs-4"></i>
                      </span>
                      <a href="index.html" class="stretched-link">Dashboard</a>
                      <small class="text-muted mb-0">User Profile</small>
                    </div>
                    <div class="dropdown-shortcuts-item col">
                      <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                        <i class="mdi mdi-cog-outline fs-4"></i>
                      </span>
                      <a href="pages-account-settings-account.html" class="stretched-link">Setting</a>
                      <small class="text-muted mb-0">Account Settings</small>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <!-- Quick links -->


            <!-- Notification -->
            <!-- Notification -->
            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-2 me-xl-1">
              <a class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" 
                 href="javascript:void(0);" 
                 data-bs-toggle="dropdown" 
                 data-bs-auto-close="outside" 
                 aria-expanded="false">
                  <i class="mdi mdi-bell-outline mdi-24px"></i>
          
                  <!-- Badge notifikasi baru -->
                  @if (session('nama_level_user') == 'Administrator')
                      @if($notifications2->isNotEmpty())
                          <span id="notification-badge" class="position-absolute top-0 start-50 translate-middle-y badge badge-dot bg-danger mt-2 border"></span>
                      @endif
                  @elseif (session('nama_level_user') == 'Validasi RKA')
                      @if($notifications->isNotEmpty())
                          <span id="notification-badge" class="position-absolute top-0 start-50 translate-middle-y badge badge-dot bg-danger mt-2 border"></span>
                      @endif
                  @elseif (session('nama_level_user') == 'Direktur')
                      @if($notifications3->isNotEmpty())
                          <span id="notification-badge" class="position-absolute top-0 start-50 translate-middle-y badge badge-dot bg-danger mt-2 border"></span>
                      @endif
                  @endif
              </a>
          
              <!-- Dropdown list -->
              <ul class="dropdown-menu dropdown-menu-end py-0">
                  <li class="dropdown-menu-header border-bottom">
                      <div class="dropdown-header d-flex align-items-center py-3">
                          <h6 class="mb-0 me-auto">Notifikasi Usulan Belanja</h6>
                          @if (session('nama_level_user') == 'Administrator')
                              <span class="badge rounded-pill bg-label-danger" id="notification-count">{{ $notifications2->count() }} New</span>
                          @elseif (session('nama_level_user') == 'Validasi RKA')
                              <span class="badge rounded-pill bg-label-danger" id="notification-count">{{ $notifications->count() }} New</span>
                          @elseif (session('nama_level_user') == 'Direktur')
                              <span class="badge rounded-pill bg-label-danger" id="notification-count">{{ $notifications3->count() }} New</span>
                          @endif
                      </div>
                  </li>
          
                  <li class="dropdown-notifications-list scrollable-container">
                      <ul class="list-group list-group-flush" id="notification-list">
                          @if (session('nama_level_user') == 'Administrator')
                              @if($notifications2->isEmpty())
                                  <p>No notifications available.</p>
                              @else
                                  @foreach($notifications2 as $notification)
                                      <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                          <div class="d-flex gap-2">
                                              <div class="flex-shrink-0">
                                                  <div class="avatar me-1">
                                                      <span class="avatar-initial rounded-circle bg-label-success">
                                                          <i class="mdi mdi-cart-outline"></i>
                                                      </span>
                                                  </div>
                                              </div>
                                              <div class="flex-grow-1 overflow-hidden">
                                                <span class="mb-1 text-truncate text-primary">Perhatian !!! </span>
                                                <p></p>
                                                <h6 class="mb-1 text-truncate"><span class="text-danger"> <a href="{{ route('validasi_usulan_barangs.keranjang', $notification->id_usulan_barang) }}">{{ $notification->no_usulan_barang }}</a> </span> 🛒</h6>
                                                  <small class="text-truncate text-body text-wrap">Terdapat Usulan barang pada Uraian Sub Rincian Obyek <strong>{{ $notification->sub_kategori_rkbu->nama_sub_kategori_rkbu }}</strong> yang belum di Validasi</small><br/>
                                                  <small class="text-truncate text-body">Pengusul: {{ $notification->nama_pengusul_barang }}</small><br/>
                                                  <small class="text-body">Tanggal: {{ $notification->updated_at }}</small>
                                                  <div class="flex-shrink-0 dropdown-notifications-actions">
                                                      <small class="text-muted">{{ $notification->updated_at->diffForHumans() }}</small>
                                                  </div>
                                              </div>
                                          </div>
                                      </li>
                                  @endforeach
                              @endif
                          @elseif (session('nama_level_user') == 'Validasi RKA')
                              @if($notifications->isEmpty())
                                  <p>No notifications available.</p>
                              @else
                                  @foreach($notifications as $notification)
                                      <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                          <div class="d-flex gap-2">
                                              <div class="flex-shrink-0">
                                                  <div class="avatar me-1">
                                                      <span class="avatar-initial rounded-circle bg-label-success">
                                                          <i class="mdi mdi-cart-outline"></i>
                                                      </span>
                                                  </div>
                                              </div>
                                              <div class="flex-grow-1 overflow-hidden">
                                                <span class="mb-1 text-truncate text-primary">Perhatian !!! </span>
                                                <p></p>
                                                  <h6 class="mb-1 text-truncate"><span class="text-danger"> <a href="{{ route('validasi_usulan_barang_rkas.keranjang', $notification->id_usulan_barang) }}">{{ $notification->no_usulan_barang }}</a> </span> 🛒</h6>
                                                  <small class="text-truncate text-body text-wrap">Terdapat Usulan barang pada Uraian Sub Rincian Obyek <strong>{{ $notification->sub_kategori_rkbu->nama_sub_kategori_rkbu }}</strong> yang belum di Validasi</small><br/>
                                                  <small class="text-truncate text-body">Pengusul: {{ $notification->nama_pengusul_barang }}</small><br/>
                                                  <small class="text-body">Tanggal: {{ $notification->updated_at }}</small>
                                                  <div class="flex-shrink-0 dropdown-notifications-actions">
                                                      <small class="text-muted">{{ $notification->updated_at->diffForHumans() }}</small>
                                                  </div>
                                              </div>
                                          </div>
                                      </li>
                                  @endforeach
                              @endif
                          @elseif (session('nama_level_user') == 'Direktur')
                              @if($notifications3->isEmpty())
                                  <p>No notifications available.</p>
                              @else
                                  @foreach($notifications3 as $notification)
                                      <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                          <div class="d-flex gap-2">
                                              <div class="flex-shrink-0">
                                                  <div class="avatar me-1">
                                                      <span class="avatar-initial rounded-circle bg-label-success">
                                                          <i class="mdi mdi-cart-outline"></i>
                                                      </span>
                                                  </div>
                                              </div>
                                              <div class="flex-grow-1 overflow-hidden">
                                                <span class="mb-1 text-truncate text-primary">Perhatian !!! </span>
                                                <p></p>
                                                <h6 class="mb-1 text-truncate"><span class="text-danger"> <a href="{{ route('validasi_usulan_barang_direkturs.keranjang', $notification->id_usulan_barang) }}">{{ $notification->no_usulan_barang }}</a> </span> 🛒</h6>
                                                  <small class="text-truncate text-body text-wrap">Terdapat Usulan barang pada Uraian Sub Rincian Obyek <strong>{{ $notification->sub_kategori_rkbu->nama_sub_kategori_rkbu }}</strong> yang belum di Validasi</small><br/>
                                                  <small class="text-truncate text-body">Pengusul: {{ $notification->nama_pengusul_barang }}</small><br/>
                                                  <small class="text-body">Tanggal: {{ $notification->updated_at }}</small>
                                                  <div class="flex-shrink-0 dropdown-notifications-actions">
                                                      <small class="text-muted">{{ $notification->updated_at->diffForHumans() }}</small>
                                                  </div>
                                              </div>
                                          </div>
                                      </li>
                                  @endforeach
                              @endif
                          @elseif (session('nama_level_user') == 'User')
                              <p>No notifications available.</p>
                          @endif
                      </ul>
                  </li>
                  <li class="dropdown-menu-footer border-top p-2">
                      <a href="{{ route('view_all_notifications') }}" class="btn btn-primary d-flex justify-content-center">
                          View all notifications
                      </a>
                  </li>
              </ul>
          </li>
          

            <!--/ Notification -->

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
              <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                  <img src="../../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="pages-account-settings-account.html">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                          <img src="../../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <span class="fw-semibold d-block">{{ session('nama_lengkap') }}</span>
                        <small class="text-muted">{{session('email')}}</small>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <div class="dropdown-divider"></div>
                </li>
                <li>
                  <a class="dropdown-item" href="pages-profile-user.html">
                    <i class="mdi mdi-account-outline me-2"></i>
                    <span class="align-middle">My Profile</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="">
                    <span class="d-flex align-items-center align-middle">
                      <i class="flex-shrink-0 mdi mdi-account-alert me-2"></i>
                      <span class="flex-grow-1 align-middle"><span class="badge bg-label-primary"> Fase: {{session('nama_fase')}}</span></span>
                      <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                    </span>
                  </a>
                </li>
                <li>
                  <div class="dropdown-divider"></div>
                </li>
                <li>
                  <div class="dropdown-divider"></div>
                </li>
                <li>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                  <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="mdi mdi-logout me-2"></i>
                    <span class="align-middle">Log Out</span>
                  </a>
                </li>
              </ul>
            </li>
            <!--/ User -->
          </ul>
        </div>

        <!-- Search Small Screens -->
        <div class="navbar-search-wrapper search-input-wrapper d-none">
          <input
            type="text"
            class="form-control search-input container-xxl border-0"
            placeholder="Search..."
            aria-label="Search..." />
          <i class="mdi mdi-close search-toggler cursor-pointer"></i>
        </div>
      </nav>

      <!-- / Navbar -->