@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
        <form class="needs-validation" method="POST" action="{{route(('fases.store'))}}">
            @csrf
            <div class="col-xl-12">
                <div class="card-body">
                    <div class="card mb-4">
                        <!-- Current Plan -->
                        <h5 class="card-header"> Tambah Fase User Login</h5>
                        <div class="card-body pt-1">
                            <div class="row">
                                 <div class="col-md-12">
                                    <div id="creditCardForm" class="row g-4">
                                         <div class="col-12 col-md-12">
                                            <h5 class="card-header">Fase User Login</h5>
                                            <div class="card-body">
                                              <div class="form-floating form-floating-outline">
                                                <input type="text" name="nama_fase"  class="form-control" id="floatingInput" placeholder="Fase User" aria-describedby="floatingInputHelp">
                                                <label for="floatingInput">Fase User</label>
                                                <div id="floatingInputHelp" class="form-text">
                                                  Isi dengan Fase User Login .
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2" onclick="return confirmSubmit()">Simpan</button>
                                    <a href="{{route('fases.index')}}" class="btn btn-outline-secondary">Kembali</a>
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