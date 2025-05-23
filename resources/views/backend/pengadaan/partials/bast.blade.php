<form class="needs-validation" action="{{ route('master_spj.updateBast', $master_spj->id_master_spj) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card mb-4">
            @if ($master_spj->status_proses_bast == 'Selesai')
                <h5 class="card-header bg-label-success mb-4">Berita Acara Serah Terima</h5>
            @else
                <h5 class="card-header bg-label-info mb-4">Berita Acara Serah Terima</h5>
            @endif

            <div class="card-body">
                <div id="formAccountSettings">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="creditCardForm" class="row g-4">
                                <div class="col-12">
                                    <span class="switch-label bg-label-danger rounded-1">
                                        <span class="fa-xs">Tanggal BAST: {{ $master_spj->tgl_bast }}</span>
                                    </span>
                                </div>

                                <div class="col-6 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="datetime-local" name="tgl_bast" value="{{ $master_spj->tgl_bast }}" class="form-control" id="html5-datetime-local-input" placeholder="----/--/--">
                                        <label for="paymentExpiryDate">Tanggal BAST</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <select name="status_proses_bast" class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option value="{{ $master_spj->status_proses_bast }}">{{ $master_spj->status_proses_bast }}</option>
                                            <option value="Selesai">Selesai</option>
                                            <option value="Revisi">Revisi BAST</option>
                                        </select>
                                        <label for="floatingSelect">Status</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="no_ba" value="{{ $master_spj->no_ba }}" class="form-control" placeholder="BA PP" />
                                        <label for="paymentName">No. BA Pemeriksaan Pekerjaan</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="no_ba_hp" value="{{ $master_spj->no_ba_hp }}" class="form-control" placeholder="BAST HP" />
                                        <label for="paymentName">No. BA Serah Terima Hasil Pekerjaan</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="no_ba_bp" value="{{ $master_spj->no_ba_bp }}" class="form-control" placeholder="BAST TB/P" />
                                        <label for="paymentName">No BA Serah Terima Barang/Pekerjaan</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="no_dpa" value="{{ $master_spj->no_dpa }}" class="form-control" placeholder="No DPA" />
                                        <label for="paymentName">No. DPA</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-5 mt-md-0">
                            <h6>Detail ID</h6>
                            <div class="added-cards">
                                <div class="cardMaster bg-lighter p-3 rounded mb-3">
                                    <div class="d-flex justify-content-between flex-sm-row flex-column">
                                        <div class="form-floating">
                                            <input type="text" name="id_usulan_barang" value="{{ $master_spj->id_usulan_barang }}" class="form-control bg-lighter" readonly />
                                            <label for="basic-addon21">ID Usulan Barang</label>
                                        </div>
                                        <div class="form-floating">
                                            <input type="text" name="id_spj" value="{{ $master_spj->id_spj }}" class="form-control bg-lighter" readonly />
                                            <label for="basic-addon21">ID SPJ</label>
                                        </div>
                                        <div class="form-floating">
                                            <input type="text" name="id_usulan_spj" value="{{ $master_spj->id_usulan_spj }}" class="form-control bg-lighter" readonly />
                                            <label for="basic-addon21">ID Usulan SPJ</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($master_spj->status_proses_bast === 'Selesai')
                        <div class="mt-2"></div>
                    @else
                        <div class="mt-2">
                            <button type="submit" id="btn-konfirm2" class="btn btn-primary me-2">Simpan</button>
                            <a href="{{ route('master_spj.index') }}" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
