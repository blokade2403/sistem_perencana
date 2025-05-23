<div class="col-md-6">
    <div class="card mb-4">
        <form class="needs-validation" method="POST" id="form-konfirm" action="" novalidate>
            <h5 class="card-header"> Verifikasi PPBJ</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div id="creditCardForm" class="row g-4">
                    <div class="col-12">
                        <span class="switch-label bg-label-danger rounded-1 "><span class="fa-xs">Tanggal Verifikasi: </span></span>
                    </div>
                    <div class="col-6 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="datetime-local" name="tgl_verif_ppbj" value="{{$no_inv->tgl_verif_ppbj; }}" class="form-control" id="html5-datetime-local-input" placeholder="----/--/--">
                            <input type="hidden" name="id_spj" value="{{$no_inv->id_spj; }}" readonly="" class="form-control bg-lighter" id="basic-addon21" readonly aria-label="Username" aria-describedby="basic-addon21" />
                            <input type="hidden" name="id_usulan_spj" value="{{$no_inv->id_usulan_spj; }}" readonly="" class="form-control bg-lighter" id="basic-addon21" readonly aria-label="Username" aria-describedby="basic-addon21" />
                            <input type="hidden" name="id_usulan_barang" value="{{$no_inv->id_usulan_barang }}" readonly="" class="form-control bg-lighter" id="basic-addon21" readonly aria-label="Username" aria-describedby="basic-addon21" />
                            <label for="paymentExpiryDate">Tanggal Verifikasi SPJ</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <select name="id_status_spj" class="select2 form-select form-select-lg" data-allow-clear="true">
                                <option value="{{$no_inv->id_status_spj; }}">{{$no_inv->nama_status_spj; }}</option>
                                <option value="12">Proses Verifikasi PPBJ</option>
                            </select>
                            <label for="floatingSelect">Status</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="switch">
                            <input type="checkbox" class="switch-input" />
                            <span class="switch-toggle-slider">
                                <span class="switch-on"></span>
                                <span class="switch-off"></span>
                            </span>
                            <span class="switch-label">Save card for future billing?</span>
                        </label>
                    </div>
                    <div class="mt-2">
                        @if ($no_inv->status_proses_verifikasi_ppk == 'Selesai')
                        <button type="submit" id="btn-konfirm" class="btn btn-primary me-2" disabled>Save changes</button>
                        <a href="" class="btn btn-outline-secondary">Discard</a>
                        @else
                        <button type="submit" id="btn-konfirm" class="btn btn-primary me-2">Save changes</button>
                        <a href="" class="btn btn-outline-secondary">Discard</a>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>