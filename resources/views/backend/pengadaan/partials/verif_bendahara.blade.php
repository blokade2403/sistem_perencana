<!-- / End Data Usulan Barang -->
<form class="needs-validation" action="{{ route('master_spj.updateverifikasiBendahara', $master_spj->id_master_spj) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card mb-4">
        <!-- Billing Address -->
        @if ($master_spj->status_pembayaran === 'Sudah di Bayar')
        <h5 class="card-header bg-label-success mb-4">Proses Pembayaran</h5>
        @else
        <h5 class="card-header bg-label-info mb-4">Proses Pembayaran</h5>
        @endif
        <div class="card-body">
            <div id="formAccountSettings">
                <div class="row">
                    <div class="col-md-6">
                        <div id="creditCardForm" class="row g-4">
                            <div class="col-12">
                                <span class="switch-label bg-label-danger rounded-1">
                                    <span class="fa-xs">Tanggal Verifikasi: {{ $master_spj->tgl_verif_bendahara }}</span>
                                </span>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <div class="input-group input-group-merge divider-primary">
                                        <span class="input-group-text">Rp.</span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="bruto" oninput="formatCurrency(this); spj();" 
                                                name="bruto" value="{{ number_format($master_spj->bruto, 0, ',', '.') }}" 
                                                class="form-control" aria-label="Amount (to the nearest dollar)" />
                                            <label>Total Harga Bruto</label>
                                        </div>
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">PPN</span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="number" step="0.01" min="0" max="100" class="form-control" id="ppn" name="ppn" onkeyup="spj();" value="{{ $master_spj->ppn; }}" aria-label="Amount (to the nearest dollar)" />
                                            <label>PPN</label>
                                        </div>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <input type="hidden" class="form-control" id="pajakppn" readonly="">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">Rp.</span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" name="harga_dasar" id="harga_dasar" value="{{ $master_spj->harga_dasar; }}" readonly="" class="form-control" aria-label="Amount (to the nearest dollar)" />
                                        <label>Harga Dasar</label>
                                    </div>
                                    <span class="input-group-text">,-</span>
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
                            <div id="creditCardForm" class="row g-4">
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">PPH22</span>
                                            <div class="form-floating form-floating-outline">
                                                <input type="number" step="0.01" min="0" max="100" value="{{ old('pph22', $defaultValue ?? $master_spj->pph22) }}" class="form-control" id="pph22" name="pph22" onkeyup="spj();"  aria-label="Amount (to the nearest dollar)" />
                                                <label>PPH22</label>
                                            </div>
                                            <span class="input-group-text">%</span>
                                            <input type="text" class="form-control" id="pajakpph22" onkeyup="spj();">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">PPH23</span>
                                            <div class="form-floating form-floating-outline">
                                                <input type="number" step="0.01" min="0" max="100" value="{{ old('pph23', $defaultValue ?? $master_spj->pph23) }}" class="form-control" id="pph23" name="pph23" onkeyup="spj();" value="{{ $master_spj->pph23; }}" aria-label="Amount (to the nearest dollar)" />
                                                <label>PPH23</label>
                                            </div>
                                            <span class="input-group-text">%</span>
                                            <input type="hidden" class="form-control" id="pajakpph23" onkeyup="spj();">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">PPH21</span>
                                            <div class="form-floating form-floating-outline">
                                                <input type="number" step="0.01" min="0" max="100" value="{{ old('pph21', $defaultValue ?? $master_spj->pph21) }}" class="form-control" id="pph21" name="pph21" onkeyup="spj();" value="{{ $master_spj->pph21; }}" aria-label="Amount (to the nearest dollar)" />
                                                <label>PPH21</label>
                                            </div>
                                            <span class="input-group-text">%</span>
                                            <input type="text" class="form-control" id="pajakpph21" onkeyup="spj();">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">PP 0,5</span>
                                            <div class="form-floating form-floating-outline">
                                                <input type="number" step="0.01" min="0" max="100" value="{{ old('pp05', $defaultValue ?? $master_spj->pph05) }}" class="form-control" id="pp05" name="pp05" onkeyup="spj();" value="{{ $master_spj->pp05; }}" aria-label="Amount (to the nearest dollar)" />
                                                <label>PP 0,5</label>
                                            </div>
                                            <span class="input-group-text">%</span>
                                            <input type="text" class="form-control" id="pajakpp05" onkeyup="spj();">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="jumlahpajak" name="jumlah_pajak" value="{{$master_spj->jumlah_pajak}}" readonly="">
                                        <label for="paymentExpiryDate">Total Pajak</label>
                                    </div>
                                </div>
                            </div>
                           
                        <div class="added-cards">
                            <div class="cardMaster bg-lighter p-3 rounded mb-3">
                                <div class="d-flex justify-content-between flex-sm-row flex-column">
                                    <div class="card-information me-2">
                                        <div class="input-group input-group-floating">
                                            <div class="form-floating">
                                                <input type="text" id="total_bruto" readonly="" class="form-control bg-lighter"  readonly aria-label="Username" aria-describedby="basic-addon21" />
                                                <label for="basic-addon21">Total Pembayaran SPJ</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating">
                                        <input type="text" id="harga_bersih" name="harga_bersih" value="{{ $master_spj->harga_bersih; }}" class="form-control bg-lighter" aria-label="Username" aria-describedby="basic-addon21" />
                                        <label for="basic-addon21">Harga Bersih</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-3">
                    </hr>
                    <h5 class="card-header">BPJS</h5>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <div class="input-group input-group-merge divider-primary">
                                    <span class="input-group-text">Rp.</span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" id="bpjs_kes" name="bpjs_kes" value="{{ old('bpjs_kes', $defaultValue ?? $master_spj->bpjs_kes) }}" onkeyup="spj()"  class="form-control" aria-label="Amount (to the nearest dollar)" />
                                        <label>BPJS Kesehatan</label>
                                    </div>
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <div class="input-group input-group-merge divider-primary">
                                    <span class="input-group-text">Rp.</span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" id="bpjs_tk" name="bpjs_tk" value="{{ old('bpjs_tk', $defaultValue ?? $master_spj->bpjs_tk) }}" onkeyup="spj()"  class="form-control" aria-label="Amount (to the nearest dollar)" />
                                        <label>BPJS Ketenaga Kerjaan</label>
                                    </div>
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- /Billing Address -->
    </div>
    <div class="alert alert-success mb-4 alert-dismissible" role="alert">
        <!-- Billing Address -->
        <h5 class="card-header">Pembayaran</h5>
        <div class="card-body">
            <div id="formAccountSettings">
                <div class="row">
                    <div class="col-md-6">
                        <div id="creditCardForm" class="row g-4">
                            <div class="col-12">
                                <div class="form-check form-check-inline">
                                    <input name="collapsible-payment" class="form-check-input" type="radio" value="" id="collapsible-payment-cc" checked="" />
                                    <label class="form-check-label" for="collapsible-payment-cc">BLUD</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="collapsible-payment" class="form-check-input" type="radio" value="" id="collapsible-payment-cash" />
                                    <label class="form-check-label" for="collapsible-payment-cash">APBD</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <div class="input-group input-group-merge divider-primary">
                                        <span class="input-group-text">Rp.</span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="number" name="pembayaran" id="pembayaran" value="{{ old('pembayaran', $defaultValue ?? $master_spj->pembayaran) }}" onkeyup="spj();" class="form-control" aria-label="Amount (to the nearest dollar)" />
                                            <label>Jumlah Yang Dibayarkan</label>
                                        </div>
                                        <span class="input-group-text">,-</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-10 mt-md-10">
                        <h6>Sisa Pembayaran</h6>
                        <div class="added-cards">
                            <div class="added-cards">
                                <div class="cardMaster bg-lighter p-3 rounded mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <div class="input-group input-group-merge divider-primary">
                                            <span class="input-group-text">Rp.</span>
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="sisa_pembayaran" name="sisa_pembayaran" value="{{$master_spj->sisa_pembayaran}}"
                                                class="form-control" oninput="formatCurrency(this);" 
                                                aria-label="Amount (to the nearest dollar)" />
                                            <label for="sisa_pembayaran">Sisa Pembayaran</label>
                                            </div>
                                            <span class="input-group-text">,-</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <!--/ Modal -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /Billing Address -->
    </div>
    <div class="card mb-4">
        <!-- Billing Address -->
        <h5 class="card-header">Detail Belanja2</h5>
        <div class="card-body">
            <div id="formAccountSettings">
                <div class="row">
                    <div class="col-md-6">
                        <div id="creditCardForm" class="row g-4">
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <div class="input-group input-group-merge divider-primary">
                                        <span class="input-group-text">[#]</span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" name="kode_billingppn" value="{{ old('kode_billingppn', $defaultValue ?? $master_spj->kode_billingppn) }}"  class="form-control" aria-label="Amount (to the nearest dollar)" />
                                            <label>Kode Billing PPN</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <div class="input-group input-group-merge divider-primary">
                                        <span class="input-group-text">[#]</span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" name="kode_billingpph22" value="{{ old('kode_billingppn', $defaultValue ?? $master_spj->kode_billingpph22) }}"  class="form-control" aria-label="Amount (to the nearest dollar)" />
                                            <label>Kode Billing PPH22</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" name="tanggal_faktur" value="{{ $master_spj->tanggal_faktur; }}" class="form-control flatpickr-input" id="flatpickr-date" placeholder="----/--/--">
                                    <input type="hidden" name="bulan_penyerahan_spj" value="{{ date('M'); }}">
                                    <input type="hidden" name="tanggal_revisi_spj">
                                    <label for="paymentExpiryDate">Tanggal Faktur</label>
                                </div>
                            </div>
                                <div class="col-6 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="tanggal_penyerahan_spj" class="form-control" value="{{ $master_spj->tanggal_penyerahan_spj; }}" readonly="">
                                        <label for="paymentExpiryDate">Tanggal Penyerahan SPJ</label>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="tanggal_revisi_spj" class="form-control" value="{{ $master_spj->tanggal_revisi_spj; }}" readonly="">
                                        <label for="paymentExpiryDate">Tanggal Revisi SPJ</label>
                                    </div>
                                </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <select name="status_pembayaran" class="select2 form-select form-select-lg" data-allow-clear="true">
                                        <option value="{{ $master_spj->status_pembayaran; }}">{{ $master_spj->status_pembayaran; }}</option>
                                        <option value="Sudah di Bayar">Sudah Di Bayar</option>
                                        <option value="Revisi">Di Tolak</option>
                                        <option value="Bayar Parsial">Bayar Parsial</option>
                                    </select>
                                    <input type="hidden" name="tanggal_pembayaran" value="{{ date('Y-m-d H:i:s') }}">
                                    <input type="hidden" name="nama_validasi_keuangan" value="{{ session('nama_lengkap') }}">
                                    <input type="hidden" name="tgl_verif_bendahara" value="{{ now()->toDateString() }}">
                                    </select>
                                    <label for="floatingSelect">Validasi SPJ</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <select class="select2 form-select form-select-lg" data-allow-clear="true" name="bulan_pembayaran" id="validationCustom04">
                                        <option value="{{$master_spj->bulan_pembayaran}}">{{$master_spj->bulan_pembayaran}}</option>
                                        <option value="Januari">Januari</option>
                                        <option value="Februari">Februari</option>
                                        <option value="Maret">Maret</option>
                                        <option value="April">April</option>
                                        <option value="Mei">Mei</option>
                                        <option value="Juni">Juni</option>
                                        <option value="Juli">Juli</option>
                                        <option value="Agustus">Agustus</option>
                                        <option value="September">September</option>
                                        <option value="Oktober">Oktober</option>
                                        <option value="November">November</option>
                                        <option value="Desember">Desember</option>
                                    </select>
                                    <label for="floatingSelect">Bulan Pembayaran</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 mt-5 mt-md-0">
                        <div class="added-cards">
                            <div class="added-cards">
                                <div class="cardMaster bg-lighter p-3 rounded mb-3">
                                    <div class="d-flex justify-content-between flex-sm-row flex-column">
                                        <label for="email" class="form-label">Keterangan Validasi Bendahara</label>
                                        <textarea class="form-control" id="validationCustom04" name="ket_verif_bendahara" rows="3">{{$master_spj->ket_verif_bendahara}}</textarea>
                                    </div>

                                </div>
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    @php
                                        $foto_url_1 = $master_spj->bukti_bayar
                                            ? asset('storage/spjs/bukti_bayar/' . basename($master_spj->bukti_bayar))
                                            : asset('assets/img/products/no_image.png');
                                    @endphp
                                       <a href="{{ $foto_url_1 }}" target="_blank">
                                        <img src="{{ $foto_url_1 }}" alt="Foto Barang 1" width="120" height="120" class="d-block w-px-120 h-px-120 rounded" />
                                    </a>
                                    <label for="formFile" class="me-2 mb-3" tabindex="0">
                                        <input class="form-control" name="bukti_bayar" type="file" id="formFile"/>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <!--/ Modal -->
                    </div>

                </div>
                <div class="mt-2">
                    @if($master_spj->status_pembayaran == 'Sudah di Bayar')
                    <button type="submit" id="btn-konfirm" class="btn btn-primary me-2" disabled>Simpan</button>
                    @else
                    <button type="submit" id="btn-konfirm" class="btn btn-primary me-2">Simpan</button>
                    @endif
                    <a href="{{route('master_spj.index')}}" class="btn btn-outline-secondary">Kembali</a>
                </div>
            </div>
        </div>
        <!-- /Billing Address -->
    </div>
</form>
         