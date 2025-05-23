
<form class="needs-validation" method="POST" action="{{ route('master_spj.updateSuratPesanan', $master_spj->id_master_spj) }}" id="confirmSubmitForm" enctype="multipart/form-data" validate>
    @csrf
    @method('PUT')
        <div class="card mb-4">
            @if ($master_spj->status_proses_pesanan === 'Selesai')
            <h5 class="card-header bg-label-success mb-4">Proses Pesanan Barang</h5>
            @else
            <h5 class="card-header bg-label-info mb-4">Proses Pesanan Barang</h5>
            @endif
            <div class="card-body">
                <div class="col-md-12">
                    <div id="creditCardForm" class="row g-4">
                        <div class="col-6 col-md-6">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <textarea class="form-control" id="validationCustom04" name="rincian_belanja" rows="5" placeholder="Uraian Belanja">{{$master_spj->rincian_belanja }}</textarea>
                                    <label for="paymentCard">Uraian Belanja</label>
                                </div>
                                <span class="input-group-text cursor-pointer p-1" id="paymentCard2"><span class="card-type"></span></span>
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="date" name="jangka_waktu_pekerjaan" value="{{$master_spj->jangka_waktu_pekerjaan; }}" class="form-control flatpickr-input" id="date" placeholder="----/--/--">
                                <label for="paymentExpiryDate">Jangka Waktu Pekerjaan</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="date" name="tgl_surat_pesanan" value="{{$master_spj->tgl_surat_pesanan; }}" class="form-control flatpickr-input" id="date" placeholder="----/--/--">
                                <input type="hidden" name="tgl_proses_pemesanan" value="{{$master_spj->tgl_proses_pemesanan; }}" class="form-control flatpickr-input" id="date" placeholder="----/--/--">
                                <label for="paymentExpiryDate">Tanggal Surat Pesanan</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="paymentName" name="no_surat_pesanan" value="{{$master_spj->no_surat_pesanan }}" class="form-control" placeholder="No DPA" />
                                <label for="paymentName">No. Surat Pesanan</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="paymentName" name="idpaket" value="{{$master_spj->idpaket }}" class="form-control" placeholder="DPA / ---- / ----" />
                                <label for="paymentName">ID Paket</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <select name="id_admin_pendukung_ppk" id="satuan_1" class="select2 form-select form-select-lg" data-allow-clear="true">
                                    <option value="{{$master_spj->id_admin_pendukung_ppk}}">
                                        {{ optional($master_spj->pendukung_ppk)->nama_pendukung_ppk ?? 'Data Tidak Ada' }}
                                    </option>
                                    @foreach ($pendukung as $item)
                                    <option value="{{$item->id_admin_pendukung_ppk}}">{{$item->nama_pendukung_ppk}}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelect">Admin Pendukung PPK2</label>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <select name="id_perusahaan" id="perusahaan" class="select2 form-select form-select-lg" data-allow-clear="true">
                                    <option value="{{$master_spj->id_perusahaan}}">{{ optional($master_spj->perusahaan)->nama_perusahaan ?? 'Data Belum diinput'}}</option>
                                    @foreach ($perusahaan as $item)
                                    <option value="{{$item->id_perusahaan}}">{{$item->nama_perusahaan}}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelect">Perusahaan</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <select name="status_hutang" id="satuan_11" class="select2 form-select form-select-lg" data-allow-clear="true">
                                    <option value="{{$master_spj->status_hutang}}">{{$master_spj->status_hutang}}</option>
                                    <option value="Tahun Berjalan">Tahun Berjalan</option>
                                    <option value="Hutang">Hutang</option>
                                </select>
                                <label for="floatingSelect">Status SPJ Hutang</label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div id="creditCardForm" class="row g-4">
                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <div class="input-group input-group-merge divider-primary">
                                        <span class="input-group-text">Rp.</span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="number" onkeyup="spj_pengadaan();" id="harga_bruto" name="bruto" value="{{$master_spj->bruto; }}" class="form-control" aria-label="Amount (to the nearest dollar)" />
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
                                    <input type="hidden" class="form-control" name="nama_lengkap" id="validationCustomUsername" value="{{ session('nama_lengkap') }}">
                                    <input type="hidden" class="form-control" name="id_user" id="validationCustomUsername" value="{{ session('id_user') }}">
                                    <input type="hidden" class="form-control" name="tahun_anggaran" id="validationCustomUsername" value="{{ session('nama_tahun_anggaran') }}">
                                    <input type="hidden" class="form-control" name="id_status_spj" id="validationCustomUsername" value="6">
                                    <input type="hidden" class="form-control" name="status_proses_pesanan" value="{{ session('status_proses_pesanan') }}">
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
                        </div>
                    </div>
                    <div class="col-md-6 mt-5 mt-md-0">
                        <h6>Detail ID</h6>
                        <div class="added-cards">
                            <div class="added-cards">
                                <div class="cardMaster bg-lighter p-3 rounded mb-3">
                                    <div class="d-flex justify-content-between flex-sm-row flex-column">
                                        <div class="card-information me-2">
                                            <div class="input-group input-group-floating">
                                                <div class="form-floating">
                                                    <input type="text" name="id_usulan_barang" value="{{$no_inv->id_usulan_barang }}" readonly="" class="form-control bg-lighter" id="basic-addon21" readonly aria-label="Username" aria-describedby="basic-addon21" />
                                                    <label for="basic-addon21">ID USulan Barang </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating">
                                            <input type="text" name="id_spj" value="{{$no_inv->id_spj; }}" readonly="" class="form-control bg-lighter" id="basic-addon21" readonly aria-label="Username" aria-describedby="basic-addon21" />
                                            <label for="basic-addon21">ID SPJ</label>
                                        </div>
                                        <div class="form-floating">
                                            <input type="text" name="id_usulan_spj" value="{{$no_inv->id_usulan_spj; }}" readonly="" class="form-control bg-lighter" id="basic-addon21" readonly aria-label="Username" aria-describedby="basic-addon21" />
                                            <label for="basic-addon21">ID Usulan SPJ</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                   
                   
                </div>
                <div class="mt-2">
                    @if ($master_spj->status_proses_pesanan !== 'Selesai')
                    <button type="submit" id="btn-konfirm" class="btn btn-primary me-2">Simpan</button>
                    <a href="{{route('master_spj.index')}}" class="btn btn-outline-secondary">Kembali</a>
                    @else
                    <button type="submit" id="btn-konfirm" class="btn btn-primary me-2" disabled>Simpan</button>
                    <a href="{{route('master_spj.index')}}" class="btn btn-outline-secondary">Kembali</a>
                    @endif
                </div>
            </div>
        </div>
    </form>