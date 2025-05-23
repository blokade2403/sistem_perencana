@include('layouts.head')
@include('layouts.sidebar')
@include('layouts.navbar')
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            @if(session('success'))
            <script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif
            <div class="container-xxl flex-grow-1 container-p-y">
              <script>
                @if(session('error'))
                    toastr.error("{{ session('error') }}");
                @endif
            </script>
             @if(session('error'))
             <script>
                 Swal.fire({
                     title: 'Gagal!',
                     text: '{{ session('error') }}',
                     icon: 'error',
                     confirmButtonText: 'OK'
                 })
             </script>
         @endif
            @yield('container')
           
            </div>
            <!-- / Content -->
@include('layouts.footer')
@include('layouts.js')

           