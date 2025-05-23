<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap">
        <div class="my-3">
            <table>
                <tbody>
                    <tr>
                        <td class="pe-3 fw-medium">Sub Kategori RKBU</td>
                        <td>:</td>
                        <td>{{ $rkbu->sub_kategori_rkbu->nama_sub_kategori_rkbu }}</td>
                    </tr>
                    <tr>
                        <td class="pe-3 fw-medium">Pengusul</td>
                        <td>:</td>
                        <td>{{ $rkbu->pengusul->nama }}</td>
                    </tr>
                    <tr>
                        <td class="pe-3 fw-medium">Total Anggaran</td>
                        <td>:</td>
                        <td>Rp. {{ number_format($rkbu->total_anggaran, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="pe-3 fw-medium">Status Validasi</td>
                        <td>:</td>
                        <td>{{ $rkbu->statusValidasi->nama_status }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table m-0">
            <thead class="table-light border-top">
                <tr>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Cost</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rkbu->items as $item)
                <tr>
                    <td class="text-nowrap">{{ $item->nama_item }}</td>
                    <td class="text-nowrap">{{ $item->deskripsi }}</td>
                    <td>Rp. {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>Rp. {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-end"><strong>Total</strong></td>
                    <td>Rp. {{ number_format($rkbu->total_anggaran, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
