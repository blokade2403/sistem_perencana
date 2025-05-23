@extends('layouts.main')
@section('container')
    <!-- Content -->
            <form class="needs-validation" method="POST" action="{{route('judul_headers.update', $judulHeader->id_judul_header)}}" enctype="multipart/form-data" validate>
                @csrf
                @method('PUT')
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
                                                        <input type="text" class="form-control" name="nama_rs" value="{{$judulHeader->nama_rs}}" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                        <label for="basic-addon11">Nama Rumah Sakit</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" name="tlp_rs" value="{{$judulHeader->tlp_rs}}" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                        <label for="basic-addon11">Telepon</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" name="kode_pos" value="{{$judulHeader->kode_pos}}" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                        <label for="basic-addon11">Kode Pos</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" name="email_rs" value="{{$judulHeader->email_rs}}" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                        <label for="basic-addon11">Email</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" name="wilayah" value="{{$judulHeader->wilayah}}" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                        <label for="basic-addon11">Nama Wilayah</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <textarea name="alamat_rs" class="form-control h-px-100" id="exampleFormControlTextarea1">{{$judulHeader->alamat_rs}}</textarea>
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
                                                    <input type="text" class="form-control" name="header1" value="{{$judulHeader->header1}}" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Judul Header 1</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="header2" value="{{$judulHeader->header2}}" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Judul Header 2</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="header3" value="{{$judulHeader->header3}}" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Judul Header 3</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="header4" value="{{$judulHeader->header4}}" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Judul Header 4</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="header5" value="{{$judulHeader->header5}}" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
                                                    <label for="basic-addon11">Nama Judul Header 5</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" name="header6" value="{{$judulHeader->header6}}" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
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
                                        
                                                    <!-- Cek apakah gambar ada di database -->
                                                    @if($judulHeader->gambar1)
                                                        <!-- Tampilkan gambar yang ada di database -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Gambar Saat Ini:</label>
                                                            <img src="{{ asset('storage/uploads/' . basename($judulHeader->gambar1)) }}" alt="Gambar 1" width="120" height="150" class="img-thumbnail">
                                                        </div>
                                                    @else
                                                        <!-- Tampilkan keterangan jika tidak ada gambar -->
                                                        <div class="mb-3">
                                                            <label class="form-label">No File Gambar</label>
                                                        </div>
                                                    @endif
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
                                        
                                                    <!-- Cek apakah gambar ada di database -->
                                                    @if($judulHeader->gambar2)
                                                        <!-- Tampilkan gambar yang ada di database -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Gambar Saat Ini:</label>
                                                            <img src="{{ asset('storage/uploads/' . basename($judulHeader->gambar2)) }}" alt="Gambar 1" width="120" height="150" class="img-thumbnail">
                                                        </div>
                                                    @else
                                                        <!-- Tampilkan keterangan jika tidak ada gambar -->
                                                        <div class="mb-3">
                                                            <label class="form-label">No File Gambar</label>
                                                        </div>
                                                    @endif
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
                                        
                                                    <!-- Cek apakah gambar ada di database -->
                                                    @if($judulHeader->header7)
                                                        <!-- Tampilkan gambar yang ada di database -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Gambar Saat Ini:</label>
                                                            <img src="{{ asset('storage/uploads/' . basename($judulHeader->header7)) }}" alt="Gambar 1" width="120" height="150" class="img-thumbnail">
                                                        </div>
                                                    @else
                                                        <!-- Tampilkan keterangan jika tidak ada gambar -->
                                                        <div class="mb-3">
                                                            <label class="form-label">No File Gambar</label>
                                                        </div>
                                                    @endif
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
    
        


