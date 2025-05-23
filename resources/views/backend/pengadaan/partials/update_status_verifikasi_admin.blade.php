<div class="card mb-4">
    @if (($no_inv->status_proses_tukar_faktur == 'Selesai'))
    <h5 class="card-header bg-label-success mb-4">Proses Verifikasi SPJ</h5>
    @else
    <h5 class="card-header bg-label-info mb-4">Proses Verifikasi SPJ</h5>
    @endif
    <div class="row m-3">
        <!-- Floating (Outline) -->
        @include('backend.pengadaan.partials.verif')
        @include('backend.pengadaan.partials.verif_ppbj')
        @include('backend.pengadaan.partials.verif_pptk')
        @include('backend.pengadaan.partials.verif_verifikator')
        @include('backend.pengadaan.partials.verif_ppk_keuangan')
        @include('backend.pengadaan.partials.verif_direktur')
    </div>
</div>