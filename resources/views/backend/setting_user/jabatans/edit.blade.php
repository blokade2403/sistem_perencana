@extends('layouts.main')
@section('container')
<div class="content-wrapper">
    <!-- Content -->
        <form id="confirmSubmitForm" class="needs-validation" method="POST" action="{{route('jabatans.update', $jabatan->id_jabatan)}}">
            @csrf
            @method('PUT')
            <div class="col-xl-12">
                <div class="card-body">
                    <div class="card mb-4">
                        <!-- Current Plan -->
                        <h5 class="card-header"> Update Data Struktur Jabatan</h5>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="creditCardForm" class="row g-4">
                                        <div class="col-12 col-md-12">
                                            <h5 class="card-header">Nama Struktur Jabatan</h5>
                                            <div class="card-body">
                                              <div class="form-floating form-floating-outline">
                                                <input type="text" name="nama_jabatan" value="{{$jabatan->nama_jabatan}}" class="form-control" id="floatingInput" placeholder="Lantai 1" aria-describedby="floatingInputHelp">
                                                <label for="floatingInput">Struktur Jabatan</label>
                                                <div id="floatingInputHelp" class="form-text">
                                                  Isi dengan nama jabatan dalam struktur organisasi.
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Update</button>
                                    <a href="{{route('jabatans.index')}}" class="btn btn-outline-secondary">Kembali</a>
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