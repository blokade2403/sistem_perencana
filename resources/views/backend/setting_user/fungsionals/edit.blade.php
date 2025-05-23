@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
        <form class="needs-validation" method="POST" action="{{route('fungsionals.update', $fungsional->id_fungsional)}}">
            @csrf
            @method('PUT')
            <div class="col-xl-12">
                <div class="card-body">
                    <div class="card mb-4">
                        <!-- Current Plan -->
                        <h5 class="card-header"> Create Jabatan Fungsional</h5>
                        <div class="card-body pt-1">
                            <div class="row">
                                 <div class="col-md-12">
                                    <div id="creditCardForm" class="row g-4">
                                         <div class="col-12 col-md-12">
                                            <h5 class="card-header">Nama Jabatan Fungsional</h5>
                                            <div class="card-body">
                                              <div class="form-floating form-floating-outline">
                                                <input type="text" name="jabatan_fungsional" value="{{$fungsional->jabatan_fungsional}}" class="form-control" id="floatingInput" placeholder="Jabatan" aria-describedby="floatingInputHelp">
                                                <label for="floatingInput">Jabatan Fungsional</label>
                                                <div id="floatingInputHelp" class="form-text">
                                                  Isi dengan nama jabatan fungsional dalam struktur organisasi.
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Update</button>
                                    <a href="{{route('fungsionals.index')}}" class="btn btn-outline-secondary">Kembali</a>
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