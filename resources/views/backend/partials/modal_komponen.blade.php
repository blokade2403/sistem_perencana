<div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary mb-1">
                <h4 class="modal-title" id="exampleModalLabel4"><span class="text-white fw-white">Form Komponen / Tambah Komponen</h4></span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr class="text fs-12">
                                    <th></th>
                                    <th>No</th>
                                    <th>Kode Komponen</th>
                                    <th>Nama Barang</th>
                                    <th>Satuan</th>
                                    <th>Spek</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($komponens as $item)
                                    <tr>
                                        <td>
                                            <div class="form-check custom-checkbox ms-2">
                                                <input type="radio" class="form-check-input" name="selected_barang" value="{{ $item->nama_barang }}" data-harga="{{ $item->harga_barang }}" data-spek="{{ $item->spek }}" data-satuan_1="{{ $item->satuan_1 }}" />
                                            </div>
                                        </td>
                                        <td class="fs-14"><small>{{ $loop->iteration }}</small></td>
                                        <td class="fs-14"><small>{{ $item->kode_barang }}</small></td>
                                        <td class="fs-14"><small>{{ $item->nama_barang }}</small></td>
                                        <td class="fs-14"><small>{{ $item->satuan }}</small></td>
                                        <td class="fs-14"><small>{{ $item->spek }}</small></td>
                                        <td class="fs-14"><small>{{ $item->harga_barang }}</small></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>Kode Komponen</th>
                                    <th>Nama Barang</th>
                                    <th>Satuan</th>
                                    <th>Spek</th>
                                    <th>Harga</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="pilihBarang">Save changes</button>
            </div>
        </div>
    </div>
</div>
