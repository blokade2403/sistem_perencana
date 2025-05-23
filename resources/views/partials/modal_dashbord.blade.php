
@if (session('notifications') && session('notifications')->isNotEmpty() || 
    session('notifications2') && session('notifications2')->isNotEmpty() || 
    session('notifications3') && session('notifications3')->isNotEmpty())
    <div
    class="modal-onboarding modal fade animate__animated"
    id="notificationModal"
    tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content text-center">
        <div class="modal-header border-0">
          <a class="text-muted close-label" href="javascript:void(0);" data-bs-dismiss="modal"
            >Skip Intro</a
          >
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body p-0">
          <div class="onboarding-media">
            <div class="mx-2">
              <img
                src="../../assets/img/illustrations/678.png"
                alt="678"
                width="335"
                class="img-fluid"
                data-app-light-img="illustrations/678.png"
                data-app-dark-img="illustrations/678.png" />
            </div>
          </div>
          <div class="onboarding-content mb-0">
            <h4 class="onboarding-title text-body">Notifikasi Validasi Belanja</h4>
            
            <div class="modal-body">
                <ul>
                    @if(session('notifications') && session('notifications')->isNotEmpty())
                    <span class="mb-1 text-truncate text-primary">Perhatian !!! </span>
                    <span class="badge rounded-pill bg-label-danger" id="notification-count">
                        {{ session('notifications')->count() }} New
                    </span>
                        @foreach (session('notifications') as $notification)    
                        <p></p>
                        <h6 class="mb-1 text-truncate"><span class="text-danger"> <a href="{{ route('validasi_usulan_barang_rkas.keranjang', $notification->id_usulan_barang) }}">{{ $notification->no_usulan_barang }}</a> </span> 🛒</h6>
                          <small class="text-truncate text-body text-wrap">Terdapat Usulan barang pada Uraian Sub Rincian Obyek <strong>{{ $notification->sub_kategori_rkbu->nama_sub_kategori_rkbu }}</strong> yang belum di Validasi</small><br/>
                          <small class="text-truncate text-body">Pengusul: {{ $notification->nama_pengusul_barang }}</small><br/>
                          <small class="text-body">Tanggal: {{ $notification->updated_at }}</small>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                              <small class="text-muted">{{ $notification->updated_at->diffForHumans() }}</small>
                          </div>
                        @endforeach
                    @endif

                    @if(session('notifications2') && session('notifications2')->isNotEmpty())
                    <span class="mb-1 text-truncate text-primary">Perhatian !!! </span>
                    <span class="badge rounded-pill bg-label-danger" id="notification-count">
                        {{ session('notifications2')->count() }} New
                    </span>
                        @foreach (session('notifications2') as $notification)
                        <p></p>
                        <h6 class="mb-1 text-truncate"><span class="text-danger"> <a href="{{ route('validasi_usulan_barangs.keranjang', $notification->id_usulan_barang) }}">{{ $notification->no_usulan_barang }}</a> </span> 🛒</h6>
                          <small class="text-truncate text-body text-wrap">Terdapat Usulan barang pada Uraian Sub Rincian Obyek <strong>{{ $notification->sub_kategori_rkbu->nama_sub_kategori_rkbu }}</strong> yang belum di Validasi</small><br/>
                          <small class="text-truncate text-body">Pengusul: {{ $notification->nama_pengusul_barang }}</small><br/>
                          <small class="text-body">Tanggal: {{ $notification->updated_at }}</small>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                              <small class="text-muted">{{ $notification->updated_at->diffForHumans() }}</small>
                          </div>
                        @endforeach
                    @endif

                    @if(session('notifications3') && session('notifications3')->isNotEmpty())
                    <span class="mb-1 text-truncate text-primary">Perhatian !!! </span>
                    <span class="badge rounded-pill bg-label-danger" id="notification-count">
                        {{ session('notifications3')->count() }} New
                    </span>
                        @foreach (session('notifications3') as $notification)
                        <p></p>
                        <h6 class="mb-1 text-truncate"><span class="text-danger"> <a href="{{ route('validasi_usulan_barangs.keranjang', $notification->id_usulan_barang) }}">{{ $notification->no_usulan_barang }}</a> </span> 🛒</h6>
                          <small class="text-truncate text-body text-wrap">Terdapat Usulan barang pada Uraian Sub Rincian Obyek <strong>{{ $notification->sub_kategori_rkbu->nama_sub_kategori_rkbu }}</strong> yang belum di Validasi</small><br/>
                          <small class="text-truncate text-body">Pengusul: {{ $notification->nama_pengusul_barang }}</small><br/>
                          <small class="text-body">Tanggal: {{ $notification->updated_at }}</small>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                              <small class="text-muted">{{ $notification->updated_at->diffForHumans() }}</small>
                          </div>
                        @endforeach
                    @endif
                </ul>
            </div>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
            Close
          </button>
          <button type="button" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>

   
@else
    <div class="alert alert-info">
        Tidak ada notifikasi validasi Usulan belanja.
    </div>
@endif

<script>
    $(document).ready(function() {
        // Show the modal if there are notifications
        @if(session('notifications') && session('notifications')->isNotEmpty() || 
           session('notifications2') && session('notifications2')->isNotEmpty() || 
           session('notifications3') && session('notifications3')->isNotEmpty())
            $('#notificationModal').modal('show');
        @endif
    });
</script>
