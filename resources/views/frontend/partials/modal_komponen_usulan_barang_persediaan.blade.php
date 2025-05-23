<!-- Modal untuk setiap barang -->
@foreach ($usulan_barangs as $index => $yek)
<div class="modal fade" id="onboardHorizontalImageModal{{ $index }}" tabindex="1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content text-center">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="onboarding-media">
                    <h4 class="onboarding-title text-body">Daftar Komponen Belanja</h4>
                    <div class="onboarding-info">
                        Pilih komponen belanja yang akan diusulkan ke Pengadaan
                    </div>
                    <img src="{{ asset('assets/img/illustrations/file.png') }}" alt="file" width="213" class="img-fluid" />
                </div>
                <form id="cartForm{{ $index }}" method="POST" action="{{ route('add-to-cart-multiple') }}">
                    @csrf
                    <table id="example{{ $index }}" class="table table-striped mb-0" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>Pilih</th>
                                <th>No</th>
                                <th>SUB Kegiatan</th>
                                <th>Nama Barang dan Spek</th>
                                <th>Qty</th>
                                <th>Sisa Stok</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($get_barangs[$yek->id_usulan_barang] ?? [] as $rkbu)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="selected_ids[]" value="{{ $rkbu->id_rkbu }}" />
                                        <input type="hidden" name="id_usulan_barang" value="{{ $yek->id_usulan_barang }}" />
                                    </td>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $rkbu->subKategoriRkbu->kode_sub_kategori_rkbu }}. {{ $rkbu->subKategoriRkbu->nama_sub_kategori_rkbu }}</td>
                                    <td>
                                        <span class="text-primary"><strong>{{ $rkbu->nama_barang }}</strong></span><br />
                                        <span class="fa-sm"> Spesifikasi: {{ $rkbu->spek }}</span>
                                    </td>
                                    <td>{{ $rkbu->jumlah_vol }}</td>
                                    <td>{{ $rkbu->sisa_vol_rkbu }}</td>
                                    <td><span class="fa-sm text-secondary">
                                        Harga Satuan: Rp.{{ number_format($rkbu->harga_satuan, 0, ',', '.') }}</span><br />
                                        <span class="fa-sm text-secondary">Total Anggaran: Rp.{{ number_format($rkbu->total_anggaran, 0, ',', '.') }}</span><br />
                                        <span class="badge bg-label-danger">Sisa Anggaran: Rp.{{ number_format($rkbu->sisa_anggaran_rkbu, 0, ',', '.') }}</span>
                                    </span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="cartForm{{ $index }}" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>
@endforeach
