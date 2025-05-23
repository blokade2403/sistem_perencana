@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
        <form class="needs-validation" method="POST" action="{{route(('level_users.store'))}}">
            @csrf
            <div class="col-xl-12">
                <div class="card-body">
                    <div class="card mb-4">
                        <!-- Current Plan -->
                        <h5 class="card-header"> Tambah Level User</h5>
                        <div class="card-body pt-1">
                            <div class="row">
                                  <div class="col-md-12">
                                    <div id="creditCardForm" class="row g-4">
                                         <div class="col-12 col-md-12">
                                            <h5 class="card-header">Level User Login</h5>
                                            <div class="card-body">
                                              <div class="form-floating form-floating-outline">
                                                <input type="text" name="nama_level_user"  class="form-control" id="floatingInput" placeholder="Level User" aria-describedby="floatingInputHelp">
                                                <label for="floatingInput">Level User</label>
                                                <div id="floatingInputHelp" class="form-text">
                                                  Isi dengan Level User Login .
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2" onclick="return confirmSubmit()">Simpan</button>
                                    <a href="{{route('level_users.index')}}" class="btn btn-outline-secondary">Kembali</a>
                                </div>
                            </div>
                        </div>

                        <!-- /Current Plan -->
                    </div>
                </div>
            </div>
        </form>
    <!--/ Header -->

</div>
@endsection