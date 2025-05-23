<!-- resources/views/auth/login.blade.php -->
@extends('layouts_login.main')
@section('content')
<div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-5 pb-2">
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            @foreach($gambar_login as $index => $gambar)
                <li data-bs-target="#carouselExample" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
            @endforeach
        </ol>

        <!-- Carousel Items -->
        <div class="carousel-inner">
            @foreach($gambar_login as $index => $gambar)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img class="d-block w-100" src="{{ asset('storage/gambar_login/' . basename($gambar->gambar_login)) }}" 
                         height="435" width="535" alt="Slide {{ $index + 1 }}" />
                    <div class="carousel-caption d-none d-md-block">
                        {{-- Tambahkan caption jika perlu --}}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Carousel Controls -->
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
</div>

<!-- Login -->
<div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg position-relative py-sm-5 px-4 py-4">
    <div class="w-px-400 mx-auto pt-5 pt-lg-0">
        <figure class="text-center mt-2 mb-3">
            @foreach ($logo_login as $item)
            <img src="{{ asset('storage/uploads/' . basename($item->header7)) }}" alt="" height="150" width="200" class="mb-3" />
            @endforeach
            <p class="mb-4">Silahkan login dengan Username Anda 👋</p>
        </figure>
        @if(session('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <h4 class="alert-heading d-flex align-items-center">
            <i class="mdi mdi-alert-circle-outline mdi-24px me-2"></i> Session Timeout !!
        </h4>
        {{ session('error') }}
    </div>
@endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <h4 class="alert-heading d-flex align-items-center">
                    <i class="mdi mdi-alert-outline mdi-24px me-2"></i> Login Gagal !!
                </h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form id="formValidationExamples" class="mb-3" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-floating form-floating-outline mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" autofocus />
                <label for="username">Username</label>
            </div>
            <div class="mb-3">
                <div class="form-password-toggle">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                            <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                            <label for="password">Password</label>
                        </div>
                        <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-floating form-floating-outline mb-3">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                            <select id="select2Basic" name="tahun_anggaran" class="select2 form-select form-select-lg" data-allow-clear="true">
                                <option selected="" disabled="">Pilih Tahun Anggaran</option>
                                @foreach($tahun_anggarans as $tahun_anggaran)
                                    <option value="{{ $tahun_anggaran->id }}">{{ $tahun_anggaran->nama_tahun_anggaran }}</option>
                                @endforeach
                            </select>
                            <label for="select2Basic">Pilih Tahun</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 d-flex justify-content-between">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Check Me out </label>
                </div>
                <a href="#" class="float-end mb-1">
                    <span>Lupa Password?</span>
                </a>
            </div>
            <button class="btn btn-primary d-grid w-100">Sign in</button>
        </form>

        {{-- <p class="text-center mt-2">
            <span>Belum punya akun?</span>
            <a href="#">
                <span>Buat Akun disini</span>
            </a>
        </p> --}}
    </div>
</div>
<!-- /Login -->
@endsection


