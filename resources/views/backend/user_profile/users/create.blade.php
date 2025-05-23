@extends('layouts.main')
@section('container')
    <!-- Content -->
            <form class="needs-validation" method="POST" action="{{route(('users.store'))}}">
                @csrf
                <div class="col-xl-12">
                    <div class="card-body">
                        <div class="card mb-4">
                            <!-- Current Plan -->
                            <h5 class="card-header">Tambah Data User Login</h5>
                            <div class="card-body pt-1">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="creditCardForm" class="row g-4">
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" name="username" id="basic-addon11" placeholder="Username" aria-label="Username" aria-describedby="basic-addon11" />
                                                        <label for="basic-addon11">Username</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"> <i class="mdi mdi-account me-2"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" name="nama_lengkap" id="basic-addon11" placeholder="Nama" aria-label="Username" aria-describedby="basic-addon11" />
                                                        <label for="basic-addon11">Nama Lengkap</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"> <i class="mdi mdi-badge-account-outline me-2"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="number" class="form-control" name="nip_user" id="basic-addon11" placeholder="Nomor Induk" aria-label="Username" aria-describedby="basic-addon11" />
                                                        <label for="basic-addon11">NIP User</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"> <i class="mdi mdi-email me-2"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" name="email" id="basic-addon11" placeholder="@gmail.com" aria-label="Username" aria-describedby="basic-addon11" />
                                                        <label for="basic-addon11">Email</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"> <i class="mdi mdi-lock me-2"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="password" class="form-control" name="password" id="basic-addon11" placeholder="******" aria-label="Username" aria-describedby="basic-addon11" />
                                                        <label for="basic-addon11">Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="input-group input-group-merge">
                                                        <div class="form-floating form-floating-outline">
                                                            <select name="id_admin_pendukung_ppk" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                                <option value="">Select Item</option>
                                                              @foreach ($admin_pendukungs as $item)
                                                                  <option value="{{$item->id_admin_pendukung_ppk}}">{{$item->nama_pendukung_ppk}} </option>
                                                              @endforeach
                                                            </select>
                                                            <label for="floatingSelect">ID Pendukung PPK</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="id_level" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option data-display="Select">Please select</option>
                                                          @foreach ($level_users as $item)
                                                              <option value="{{$item->id_level}}">{{$item->nama_level_user}} </option>
                                                          @endforeach
                                                        </select>
                                                        <label for="floatingSelect">Level User</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="id_fase" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option data-display="Select">Please select</option>
                                                            @foreach ($fases as $item)
                                                            <option value="{{$item->id_fase}}">{{$item->nama_fase}}</option>
                                                            @endforeach
                                                        </select>
                                                        <label for="floatingSelect">Fase User</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="id_unit" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option data-display="">Please Select</option>
                                                            @foreach ($units as $item)
                                                            <option value="{{$item->id_unit}}">{{$item->nama_unit}}</option>
                                                            @endforeach
                                                        </select>
                                                        <label for="floatingSelect">Nama Unit</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="status_user" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option data-display="Select">Please select</option>
                                                            <option value="aktif">Aktif</option>
                                                            <option value="tidak aktif">Non Aktif</option>
                                                        </select>
                                                        <label for="floatingSelect">Status User</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <!-- /Current Plan -->
                        </div>
                        <div class="card mb-4">
                            <h5 class="card-header">Detail user</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="creditCardForm" class="row g-4">
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="id_pejabat" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option data-display="Select">Please select</option>
                                                           @foreach ($pejabats as $item)
                                                           <option value="{{$item->id_pejabat}}">{{$item->nama_pejabat}}</option>
                                                           @endforeach
                                                        </select>
                                                        <label for="floatingSelect">Nama Pejabat</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="id_ksp" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option data-display="Select">Please select</option>
                                                           @foreach ($ksps as $item)
                                                           <option value="{{$item->id_ksp}}">{{$item->nama_ksp}}</option>
                                                           @endforeach
                                                        </select>
                                                        <label for="floatingSelect">Nama KSP</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div id="creditCardForm" class="row g-4">
                                            <div class="d-flex justify-content-between flex-sm-row flex-column">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="status_edit" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option data-display="Select">Please select</option>
                                                            <option value="aktif">Aktif</option>
                                                            <option value="tidak aktif">Non Aktif</option>
                                                        </select>
                                                        <label for="floatingSelect">Status Edit</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                        <a href="{{route('users.index')}}" class="btn btn-outline-secondary">Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
@endsection
    
        


