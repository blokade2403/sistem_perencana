@extends('layouts.main')
@section('container')
    <!-- Content -->
            <form class="needs-validation" method="POST" action="{{route(('judul_headers.store'))}}" enctype="multipart/form-data" validate>
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
                                            <div class="col-12 col-md-12">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" name="nama_rs" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                        <label for="basic-addon11">Nama Rumah Sakit</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" name="tlp_rs" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                        <label for="basic-addon11">Telepon</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" name="kode_pos" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                        <label for="basic-addon11">Kode Pos</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" name="email_rs" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                        <label for="basic-addon11">Email</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" name="wilayah" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                        <label for="basic-addon11">Nama Wilayah</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <textarea name="alamat_rs" class="form-control h-px-100" id="exampleFormControlTextarea1"></textarea>
                                                        <label for="basic-addon11">Alamat</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="creditCardForm" class="row g-4">
                                        <div class="col-12 col-md-12">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="header1" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Judul Header 1</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="header2" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Judul Header 2</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="header3" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Judul Header 3</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="header4" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Judul Header 4</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="header5" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Judul Header 5</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="header6" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Judul Header 6</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">Gambar 1</label>
                                                        <input type="file" class="form-control" name="gambar1" id="formFile">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">Gambar 2</label>
                                                        <input type="file" class="form-control" name="gambar2" id="formFile">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">Gambar 3</label>
                                                        <input type="file" class="form-control" name="header7" id="formFile">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <a href="{{route('judul_headers.index')}}" class="btn btn-outline-secondary">Discard</a>
                                </div>
                            </div>
    
                            <!-- /Current Plan -->
                        </div>
                    </div>
                </div>
            </form>
@endsection
    
        


