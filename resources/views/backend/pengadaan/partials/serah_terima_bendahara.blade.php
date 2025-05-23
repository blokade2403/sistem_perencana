<form class="needs-validation" action="{{ route('master_spj.updateSerahTerimaBendahara', $master_spj->id_master_spj) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card mb-4">
        @if (($master_spj->status_serah_terima_bendahara == 'Selesai'))
        <h5 class="card-header bg-label-success mb-4">Serah Terima SPJ</h5>
        @else
        <h5 class="card-header bg-label-info mb-4">Serah Terima SPJ</h5>
        @endif
        <div class="card-body">
            <div id="formAccountSettings">
                <div class="row">
                    <div class="col-md-6">
                        <div id="creditCardForm" class="row g-4">
                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <div class="input-group input-group-merge divider-primary">
                                        <span class="input-group-text">Rp.</span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="number" onkeyup="spj_pengadaan();" id="harga_bruto" name="bruto" value="{{$master_spj->bruto }}" class="form-control" aria-label="Amount (to the nearest dollar)" />
                                            <label>Total Harga Bruto</label>
                                        </div>
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">PPN</span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="number" step="0.01" min="0" max="100" class="form-control" id="ppn_pengadaan" name="ppn" onkeyup="spj_pengadaan();" value="{{$master_spj->ppn; }}" aria-label="Amount (to the nearest dollar)" />
                                            <label>PPN</label>
                                        </div>
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-8">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">Rp.</span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" name="harga_dasar" id="harga_dasar_pengadaan" value="{{$master_spj->harga_dasar; }}" readonly="" class="form-control" aria-label="Amount (to the nearest dollar)" />
                                        <label>Harga Dasar</label>
                                    </div>
                                    <span class="input-group-text">,-</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="date" name="tanggal_penyerahan_spj" value="{{$master_spj->tanggal_penyerahan_spj; }}" class="form-control" id="html5-datetime-local-input" placeholder="----/--/--">
                                    <input type="hidden" name="bulan_penyerahan_spj" value="{{date('M'); }}">
                                    <label for="paymentExpiryDate">Tanggal Penyerahan SPJ</label>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-md-6 mt-5 mt-md-0">
                        <h6>Status Serah Terima</h6>
                        <div class="added-cards">
                            <div class="added-cards">
                                <div class="cardMaster bg-lighter p-3 rounded mb-3">
                                    <div class="d-flex justify-content-between flex-sm-row flex-column">
                                            <div class="col-12 col-md-12">
                                                <div class="form-floating form-floating-outline">
                                                    <select name="status_serah_terima_bendahara" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                        <option value="{{ $master_spj->status_serah_terima_bendahara }}">{{ $master_spj->status_serah_terima_bendahara }}</option>
                                                        <option value="Selesai">Selesai</option>
                                                        <option value="Revisi">Revisi SPJ</option>
                                                    </select>
                                                    <label for="floatingSelect">Status</label>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="cardMaster bg-label-warning p-3 rounded mb-3">
                                <div class="d-flex justify-content-between flex-sm-row flex-column">
                                        <div class="col-12 col-md-12">
                                            <div class="form-floating form-floating-outline">
                                               Updaload Dokumen SPJ
                                            </div>
                                            <div class="input-group col-12 col-md-12 mb-3">
                                            <label class="input-group-text" for="inputGroupFile01">File SPJ 1</label>
                                                <input class="form-control" name="upload_spj_1" type="file" id="formFile"/>
                                            </label>
                                            </div>
                                            <div class="input-group col-12 col-md-12 mb-3">
                                                <label class="input-group-text" for="inputGroupFile01">File SPJ 2</label>
                                                <input class="form-control" name="upload_spj_2" type="file" id="formFile"/>
                                            </label>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    @if ($master_spj->status_serah_terima_bendahara == 'Selesai')
                    <button type="submit" id="submit345" class="btn btn-primary me-2" disabled>Save changes</button>
                    @else
                    <button type="submit" id="submit345" class="btn btn-primary me-2">Save changes</button>
                    @endif
                    <a href="{{route('master_spj.index')}}" class="btn btn-outline-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</form>