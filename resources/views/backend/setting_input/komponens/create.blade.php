@extends('layouts.main')
@section('container')
    <!-- Content -->
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">test</h4>
            <form class="needs-validation" method="POST" action="{{route(('komponens.store'))}}">
                @csrf
                <div class="col-xl-12">
                    <div class="card-body">
                        <div class="card mb-4">
                            <!-- Current Plan -->
                            <h5 class="card-header">Komponen</h5>
                            <div class="card-body pt-1">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="creditCardForm" class="row g-4">
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" name="kode_barang" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                        <label for="basic-addon11">Kode Barang</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" name="kode_komponen" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                        {{-- <input type="hidden" class="form-control" name="id_fase" value="1" /> --}}
                                                        <label for="basic-addon11">Kode Komponen</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"> <i class="mdi mdi-email me-2"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" name="nama_barang" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                        <label for="basic-addon11">Nama Barang</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"> <i class="mdi mdi-email me-2"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" name="satuan" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                        <label for="basic-addon11">Satuan</label>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="col-12 col-md-12">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"> <i class="mdi mdi-account-box-edit-outline me-2"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <textarea class="form-control h-px-100" id="exampleFormControlTextarea1" name="spek"></textarea>
                                                        <label for="basic-addon11">Spesifikasi</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <img src="{{asset('assets/img/illustrations/girl-verify-password-light.png')}}" alt="girl-verify-password-light" width="100" height="75" class="img-fluid" data-app-light-img="illustrations/girl-verify-password-light.png" data-app-dark-img="illustrations/girl-verify-password-dark.png" />
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="alert alert-warning mb-4 alert-dismissible" role="alert">
                                                        <h6 class="alert-heading mb-1 d-flex align-items-end">
                                                            <i class="mdi mdi-alert-outline mdi-20px me-2"></i>
                                                            <span>We need your attention!</span>
                                                        </h6>
                                                        <div class="accordion mt-3" id="accordionWithIcon">
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header d-flex align-items-center">
                                                                </h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="id_jenis_kategori_rkbu" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option data-display="Select">Please select</option>
                                                          @foreach ($jenis_kategori_rkbu as $item)
                                                              <option value="{{$item->id_jenis_kategori_rkbu}}">{{$item->nama_jenis_kategori_rkbu}} </option>
                                                          @endforeach
                                                        </select>
                                                        <label for="floatingSelect">Jenis Kategori RKBU</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">Rp.</span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="number" class="form-control" name="harga_barang" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                        <label for="basic-addon11">Harga Barang</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <a href="/komponens" class="btn btn-outline-secondary">Discard</a>
                                </div>
                            </div>
    
                            <!-- /Current Plan -->
                        </div>
                    </div>
                </div>
            </form>
@endsection
    
        


