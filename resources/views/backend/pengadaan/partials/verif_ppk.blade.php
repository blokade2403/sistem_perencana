<form class="needs-validation" action="{{ route('master_spj.updateVerifPPK', $master_spj->id_master_spj) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card mb-4">
        @if ($master_spj->status_verifikasi_ppk == 'Selesai')
            <h5 class="card-header bg-label-success mb-4">Verifikasi PPK</h5>
        @else
            <h5 class="card-header bg-label-info mb-4">Verifikasi PPK</h5>
        @endif
        <div class="card-body">
            <div id="formAccountSettings">
                <div class="row">
                    <div class="col-md-6">
                        <div id="creditCardForm" class="row g-4">
                            <div class="col-12">
                                <span class="switch-label bg-label-danger rounded-1">
                                    <span class="fa-xs">Tanggal Verifikasi: {{ $master_spj->tgl_verif }}</span>
                                </span>
                            </div>
                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <select name="status_verifikasi_ppk" id="satuan_1" class="select2 form-select form-select-lg" data-allow-clear="true">
                                        <option value="{{ $master_spj->status_verifikasi_ppk }}">{{ $master_spj->status_verifikasi_ppk }}</option>
                                        <option value="Selesai">Sesuai</option>
                                        <option value="Revisi">Revisi</option>
                                    </select>
                                    <label for="paymentExpiryDate">Verifikasi</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <textarea class="form-control h-px-75" name="ket_verif_ppk" aria-label="With textarea">{{$master_spj->ket_verif_ppk}}</textarea>
                                    <label for="floatingSelect">Keterangan Verifikasi</label>
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
                <div class="mt-2">
                    @if ($master_spj->status_verifikasi_ppk == 'Selesai')
                    <button type="submit" id="btn-konfirm3" class="btn btn-primary me-2" disabled>Kirim</button>
                    @else
                    <button type="submit" id="btn-konfirm3" class="btn btn-primary me-2">Kirim</button>
                    @endif
                    <a href="{{route('master_spj.index')}}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</form>
