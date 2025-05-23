<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="assets/"
    data-template="vertical-menu-template">
@include('layouts_login.head')
<body>
    <!-- Content -->
    <div class="authentication-wrapper authentication-cover">
        <!-- Logo -->
        <a href="index.html" class="auth-cover-brand d-flex align-items-center gap-2">
            <span class="app-brand-logo demo">
                <span style="color: var(--bs-primary)">
                    @foreach ($logo_login as $item)
                    <img src="{{ asset('storage/uploads/' . basename($item->gambar1)) }}" alt="" height="100" width="200" class="mb-3" />
                    @endforeach
                </span>
            </span>
        </a>
        <!-- /Logo -->
        <div class="authentication-inner row m-0">
            @yield('content')
        </div>
    </div>
    <!-- /Left Section -->
    @include('layouts_login.footer')
</body>
</html>
