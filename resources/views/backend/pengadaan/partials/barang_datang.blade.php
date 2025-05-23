
    <div class="card mb-4">
        @if ($master_spj->status_proses_pengiriman_barang === 'Selesai')
        <h5 class="card-header bg-label-success mb-4">Proses Pengiriman Barang</h5>
        @else
        <h5 class="card-header bg-label-info mb-4">Proses Pengiriman Barang</h5>
        @endif
        <div class="card-body">
            <div class="row">
                    @if ((session('nama_level_user') == 'Pengurus Barang'))
                    <form class="needs-validation" method="POST" action="{{ route('master_spj.updateVerifPB', $master_spj->id_master_spj) }}" id="confirmSubmitForm" enctype="multipart/form-data" validate>
                        @csrf
                        @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <h6>Status Verifikasi Pengurus Barang: <span class="badge bg-label-danger">{{$master_spj->status_verifikasi_pengurus_barang ?? 'Belum ada Status' }}</span></h6> 
                            <div class="added-cards">
                                <div class="col-10 col-md-12 mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <select name="status_verifikasi_pengurus_barang" id="satuan_1" class="select2 form-select form-select-lg" data-allow-clear="true" required>
                                            <option data-display="Select">Open this select menu</option>
                                            <option value="Selesai">Verifikasi OK</option>
                                            <option value="Revisi">Perlu Perbaikan</option>
                                        </select>
                                        <label for="floatingSelect">Status</label>
                                    </div>
                                </div>
                            </div>
                            <div class="added-cards">
                                <div class="col-10 col-md-12 mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <textarea class="form-control h-px-75" name="keterangan_verif_pengurus_barang" aria-label="With textarea">{{$master_spj->keterangan_verif_pengurus_barang}}</textarea>
                                        <label for="floatingSelect">Keterangan Verifikasi</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" id="btn-konfirm3" class="btn btn-primary me-2">Simpan</button>
                                <a href="" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <h6>Detail Foto Barang Pesanan</h6>
                            <div class="added-cards">
                                <div class="cardMaster bg-lighter p-3 rounded mb-3">
                                    <div class="d-flex justify-content-between flex-sm-row flex-column">
                                        @php
                                            $foto_url_1 = $master_spj->foto_barang_datang ? asset('storage/spjs/barang_datang/' . basename($master_spj->foto_barang_datang)) : asset('assets/img/products/no_image.png');
                                            $foto_url_2 = $master_spj->foto_barang_datang_2 ? asset('storage/spjs/barang_datang/' . basename($master_spj->foto_barang_datang_2)) : asset('assets/img/products/no_image.png');
                                            $foto_url_3 = $master_spj->foto_barang_datang_3 ? asset('storage/spjs/barang_datang/' . basename($master_spj->foto_barang_datang_3)) : asset('assets/img/products/no_image.png');
                                        @endphp
                                        <div class="card-information me-2">
                                            <a href="{{ $foto_url_1 }}" target="_blank">
                                                <img src="{{ $foto_url_1 }}" alt="Foto Barang 1" width="120" height="120" class="d-block w-px-120 h-px-120 rounded" />
                                            </a>
                                        </div>
                                        <div class="card-information me-2">
                                            <a href="{{ $foto_url_2 }}" target="_blank">
                                                <img src="{{ $foto_url_2 }}" alt="Foto Barang 2" width="120" height="120" class="d-block w-px-120 h-px-120 rounded" />
                                            </a>
                                        </div>
                                        <div class="card-information me-2">
                                            <a href="{{ $foto_url_3 }}" target="_blank">
                                                <img src="{{ $foto_url_3 }}" alt="Foto Barang 3" width="120" height="120" class="d-block w-px-120 h-px-120 rounded" />
                                            </a>
                                        </div>
                                        <div class="card-information me-2">
                                            <span class="fa-sm">Keterangan:</span><br />
                                            <span class="fa-sm">{{ $master_spj->keterangan_barang_datang ?? '-' }}</span><br /><br />
                                            <span class="fa-sm">Tanggal:</span><br />
                                            <span class="fa-sm">{{ $master_spj->tgl_barang_datang ?? '-' }}</span><br />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        @endif

                        @php
                $dataakses = ['Pendukung PPK', 'Administrator'];
                @endphp
                  @if (in_array(session('nama_level_user'), $dataakses) && !empty($master_spj->tgl_barang_datang))
                        <div class="col-md-6 ">
                            <h6>Detail Foto Barang Pesanan</h6>
                            <div class="added-cards">
                                <div class="cardMaster bg-lighter p-3 rounded mb-3">
                                    <div class="d-flex justify-content-between flex-sm-row flex-column">
                                        @php
                                            $foto_url_1 = $master_spj->foto_barang_datang ? asset('storage/spjs/barang_datang/' . basename($master_spj->foto_barang_datang)) : asset('assets/img/products/no_image.png');
                                            $foto_url_2 = $master_spj->foto_barang_datang_2 ? asset('storage/spjs/barang_datang/' . basename($master_spj->foto_barang_datang_2)) : asset('assets/img/products/no_image.png');
                                            $foto_url_3 = $master_spj->foto_barang_datang_3 ? asset('storage/spjs/barang_datang/' . basename($master_spj->foto_barang_datang_3)) : asset('assets/img/products/no_image.png');
                                        @endphp
                                        <div class="card-information me-2">
                                            <a href="{{ $foto_url_1 }}" target="_blank">
                                                <img src="{{ $foto_url_1 }}" alt="Foto Barang 1" width="120" height="120" class="d-block w-px-120 h-px-120 rounded" />
                                            </a>
                                        </div>
                                        <div class="card-information me-2">
                                            <a href="{{ $foto_url_2 }}" target="_blank">
                                                <img src="{{ $foto_url_2 }}" alt="Foto Barang 2" width="120" height="120" class="d-block w-px-120 h-px-120 rounded" />
                                            </a>
                                        </div>
                                        <div class="card-information me-2">
                                            <a href="{{ $foto_url_3 }}" target="_blank">
                                                <img src="{{ $foto_url_3 }}" alt="Foto Barang 3" width="120" height="120" class="d-block w-px-120 h-px-120 rounded" />
                                            </a>
                                        </div>
                                        <div class="card-information me-2">
                                            <span class="fa-sm">Keterangan:</span><br />
                                            <span class="fa-sm">{{ $master_spj->keterangan_barang_datang ?? '-' }}</span><br /><br />
                                            <span class="fa-sm">Tanggal:</span><br />
                                            <span class="fa-sm">{{ $master_spj->tgl_barang_datang ?? '-' }}</span><br />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @elseif(in_array(session('nama_level_user'), $dataakses))
                <form class="needs-validation" method="POST" action="{{ route('master_spj.updateBarangDatang', $master_spj->id_master_spj) }}" id="confirmSubmitForm" enctype="multipart/form-data" validate>
                    @csrf
                    @method('PUT')
                    <div class="row">
                    <div class="col-12 col-md-6">
                        <h6>Status Verifikasi Pengurus Barang: <span class="badge bg-label-danger">{{$master_spj->status_verifikasi_pengurus_barang ?? 'Belum ada Status' }}</span></h6> 
                        <div class="added-cards">
                            <div class="button-wrapper">
                                <!-- Upload Foto 1 -->
                                <label for="formFile" class="me-2 mb-3" tabindex="0">
                                    <input class="form-control" name="foto_barang_datang" type="file" id="formFile"/>
                                </label>
                
                                <!-- Upload Foto 2 -->
                                <label for="formFile" class="me-2 mb-3" tabindex="0">
                                    <input class="form-control" name="foto_barang_datang_2" type="file" id="formFile"/>
                                </label>
                
                                <!-- Upload Foto 3 -->
                                <label for="formFile" class="me-2 mb-3" tabindex="0">
                                    <input class="form-control" name="foto_barang_datang_3" type="file" id="formFile"/>
                                </label>
                                <div class="added-cards">
                                    <div class="col-10 col-md-12 mb-3">
                                        <div class="form-floating form-floating-outline">
                                            <textarea class="form-control h-px-75" name="keterangan_barang_datang" aria-label="With textarea">{{$master_spj->keterangan_barang_datang}}</textarea>
                                            <label for="floatingSelect">Keterangan Verifikasi</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-outline-secondary me-2 mb-3">
                                    <i class="mdi mdi-reload d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Save</span>
                                </button>
                                <div class="text-muted small">Allowed JPG, GIF, or PNG. Max size of 800KB</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <h6>Detail Foto Barang</span></h6> 
                        <div class="cardMaster bg-lighter p-3 rounded mb-3">
                            <div class="d-flex justify-content-between flex-sm-row flex-column">
                                @php
                                    $foto_url_1 = $master_spj->foto_barang_datang ? asset('storage/spjs/barang_datang/' . basename($master_spj->foto_barang_datang)) : asset('assets/img/products/no_image.png');
                                    $foto_url_2 = $master_spj->foto_barang_datang_2 ? asset('storage/spjs/barang_datang/' . basename($master_spj->foto_barang_datang_2)) : asset('assets/img/products/no_image.png');
                                    $foto_url_3 = $master_spj->foto_barang_datang_3 ? asset('storage/spjs/barang_datang/' . basename($master_spj->foto_barang_datang_3)) : asset('assets/img/products/no_image.png');
                                @endphp
                                <div class="card-information me-2">
                                    <a href="{{ $foto_url_1 }}" target="_blank">
                                        <img src="{{ $foto_url_1 }}" alt="Foto Barang 1" width="120" height="120" class="d-block w-px-120 h-px-120 rounded" />
                                    </a>
                                </div>
                                <div class="card-information me-2">
                                    <a href="{{ $foto_url_2 }}" target="_blank">
                                        <img src="{{ $foto_url_2 }}" alt="Foto Barang 2" width="120" height="120" class="d-block w-px-120 h-px-120 rounded" />
                                    </a>
                                </div>
                                <div class="card-information me-2">
                                    <a href="{{ $foto_url_3 }}" target="_blank">
                                        <img src="{{ $foto_url_3 }}" alt="Foto Barang 3" width="120" height="120" class="d-block w-px-120 h-px-120 rounded" />
                                    </a>
                                </div>
                                <div class="card-information me-2">
                                    <span class="fa-sm">Keterangan:</span><br />
                                    <span class="fa-sm">{{ $master_spj->keterangan_barang_datang ?? '-' }}</span><br /><br />
                                    <span class="fa-sm">Tanggal:</span><br />
                                    <span class="fa-sm">{{ $master_spj->tgl_barang_datang ?? '-' }}</span><br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                @endif
            </div>
            </div>
        </div>