<form class="needs-validation" action="{{ route('master_spj.tukarfaktur', $master_spj->id_master_spj) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card mb-4">
        @if ($master_spj->status_proses_tukar_faktur == 'Selesai')
            <h5 class="card-header bg-label-success mb-4">Proses Tukar Faktur</h5>
        @else
            <h5 class="card-header bg-label-info mb-4">Proses Tukar Faktur</h5>
        @endif
        <div class="card-body">
            <div id="formAccountSettings">
                <div class="row">
                    <div class="col-md-6">
                        <div id="creditCardForm" class="row g-4">
                            <div class="col-12">
                                <span class="switch-label bg-label-danger rounded-1">
                                    <span class="fa-xs">Tanggal Tukar Faktur: {{ $master_spj->tgl_proses_faktur }}</span>
                                </span>
                            </div>
                            <div class="col-6 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="date" name="tanggal_faktur" value="{{ $no_inv->tanggal_faktur }}" class="form-control"  placeholder="----/--/--">
                                    <label for="paymentExpiryDate">Tanggal Tukar Faktur</label>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="date" name="tgl_kwitansi" value="{{ $no_inv->tgl_kwitansi }}" class="form-control" placeholder="----/--/--">
                                    <label for="paymentExpiryDate">Tanggal Kwitansi</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-5 mt-md-0">
                        <h6>Detail ID</h6>
                        <div class="added-cards">
                            <div class="cardMaster bg-lighter p-3 rounded mb-3">
                                <div class="d-flex justify-content-between flex-sm-row flex-column">
                                    <div class="card-information me-2">
                                        <div class="input-group input-group-floating">
                                            <div class="form-floating">
                                                <input type="text" name="id_usulan_barang" value="{{ $no_inv->id_usulan_barang }}" readonly class="form-control bg-lighter" />
                                                <label>ID Usulan Barang</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating">
                                        <input type="text" name="id_spj" value="{{ $no_inv->id_spj }}" readonly class="form-control bg-lighter" />
                                        <label>ID SPJ</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="text" name="id_usulan_spj" value="{{ $no_inv->id_usulan_spj }}" readonly class="form-control bg-lighter" />
                                        <label>ID Usulan SPJ</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($master_spj->status_proses_tukar_faktur == 'Selesai')
                <div class="mt-2"></div>
                @else
                    <div class="mt-2">
                        <button type="submit" id="btn-konfirm3" class="btn btn-primary me-2">Simpan</button>
                        <a href="{{route('master_spj.index')}}" class="btn btn-outline-secondary">Kembali</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</form>
