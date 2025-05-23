<div class="card mb-4">
    @if (($master_spj->status_proses_tukar_faktur == 'Selesai'))
    <h5 class="card-header bg-label-success mb-4">Proses Verifikasi SPJ</h5>
    @else
    <h5 class="card-header bg-label-info mb-4">Proses Verifikasi SPJ</h5>
    @endif
    <div class="table-responsive">
        <table class="table border-top">
            <thead class="table-light">
                <tr>
                    <th class="text-nowrap"></th>
                    <th class="text-nowrap text-center">Pengurus Barang</th>
                    <th class="text-nowrap text-center">PPBJ</th>
                    <th class="text-nowrap text-center">PPK</th>
                    <th class="text-nowrap text-center">PPTK</th>
                    <th class="text-nowrap text-center">Verifikator</th>
                    <th class="text-nowrap text-center">PPK(Keuangan)</th>
                    <th class="text-nowrap text-center">Direktur</th>
                    <th class="text-nowrap text-center">Bendahara</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-nowrap">Status Verifikasi</td>
                    <td>
                        <div class="form-check d-flex justify-content-center">
                            @if ($master_spj->status_verifikasi_pengurus_barang == 'Selesai')
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" checked disabled />
                            @else
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" disabled />
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="form-check d-flex justify-content-center">
                            @if ($master_spj->status_verifikasi_ppbj == 'Selesai')
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" checked disabled />
                            @else
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" disabled />
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="form-check d-flex justify-content-center">
                            @if ($master_spj->status_verifikasi_ppk == 'Selesai')
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" checked disabled />
                            @else
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" disabled />
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="form-check d-flex justify-content-center">
                            @if ($master_spj->status_verifikasi_pptk == 'Selesai')
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" checked disabled />
                            @else
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" disabled />
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="form-check d-flex justify-content-center">
                            @if ($master_spj->status_verifikasi_verifikator == 'Selesai')
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" checked disabled />
                            @else
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" disabled />
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="form-check d-flex justify-content-center">
                            @if ($master_spj->status_verifikasi_ppk_keuangan == 'Selesai')
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" checked disabled />
                            @else
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" disabled />
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="form-check d-flex justify-content-center">
                            @if ($master_spj->status_verifikasi_direktur == 'Selesai')
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" checked disabled />
                            @else
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" disabled />
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="form-check d-flex justify-content-center">
                            @if ($master_spj->status_serah_terima_bendahara == 'Selesai')
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" checked disabled />
                            @else
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" disabled />
                            @endif
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>