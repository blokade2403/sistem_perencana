@foreach ($id_usulan as $index => $yek)
<div class="modal fade" id="onboardHorizontalImageModal{{ $index }}" tabindex="1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content text-center">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="onboarding-media">
                    <h4 class="onboarding-title text-body">Daftar Komponen SPJ</h4>
                    <div class="onboarding-info">
                        Pilih komponen belanja yang akan diusulkan ke Pengadaan
                    </div>
                    <img src="{{ asset('assets/img/illustrations/file.png') }}" alt="file" width="213" class="img-fluid" />
                </div>
                <form action="{{ route('usulan_spj_modals.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_spj" value="{{ $yek->id_spj }}">
                    <input type="hidden" name="id_usulan_barang" value="{{ $yek->id_usulan_barang }}">
                    <div class="row">
                        <table id="example{{ $index }}" class="table table-striped mb-0" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Add Cart</th>
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
                                    @foreach ($get_barangs[$yek->id_usulan_barang] as $rkbu)
                                    <tr>
                                        <td>
                                            <div class="form-check custom-checkbox ms-2">
                                                <input type="checkbox" class='check-item' name="id_usulan_barang_detail[]" value="{{ $rkbu->id_usulan_barang_detail }}" class="form-check-input check-item">
                                                <label class="form-check-label"></label>
                                            </div>
                                        </td>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $rkbu->sub_kategori_rkbu->kode_sub_kategori_rkbu }}. {{ $rkbu->sub_kategori_rkbu->nama_sub_kategori_rkbu }}</td>
                                        <td>
                                            <strong>{{ $rkbu->nama_barang }}</strong><br>
                                            Spesifikasi: {{ $rkbu->spek }}
                                        </td>
                                        <td>{{ $rkbu->jumlah_usulan_barang }}</td>
                                        <td>{{ $rkbu->sisa_vol_rkbu }}</td>
                                        <td>
                                            Total Usulan: Rp.{{ number_format($rkbu->total_anggaran_usulan_barang, 0, ',', '.') }}<br>
                                            <span class="badge bg-label-danger">Sisa Anggaran: Rp.{{ number_format($rkbu->sisa_anggaran_rkbu, 0, ',', '.') }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    // Fungsi untuk menandai atau menghapus semua checkbox
    document.getElementById('checkAll').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('.check-item');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = this.checked;
        });
    });

    // Validasi sebelum mengirimkan formulir
    document.getElementById('submitBtn').addEventListener('click', function() {
        // Formulir akan dikirim tanpa memeriksa jumlah checkbox yang dipilih
        document.getElementById('form-add').submit();
    });
</script>

{{-- <script>
    document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah form submit secara default

        // Kirim data ke server
        fetch(this.action, {
            method: this.method,
            body: new FormData(this)
        }).then(response => {
            if (response.ok) {
                // Hapus baris yang sudah disubmit
                this.querySelectorAll('input[type="checkbox"]:checked').forEach(checkbox => {
                    checkbox.closest('tr').remove();
                });

                alert('Data berhasil ditransfer.');
            } else {
                alert('Terjadi kesalahan.');
            }
        });
    });
}); --}}

</script>
