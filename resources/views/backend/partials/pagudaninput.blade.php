<div class="d-flex bg-label-primary p-3 border rounded my-3">
    <div class="border border-2 border-primary rounded me-3 p-2 d-flex align-items-center justify-content-center w-px-40 h-px-40">
        <i class="mdi mdi-cash mdi-10px"></i>
    </div>
    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
        <div class="me-2">
            <h6 class="mb-0 fw-semibold text-secondary">Total Terinput</h6>
            <hr>
            <h6 class="mb-0 fw-semibold text-primary">Selisih Pagu dengan Inputan</h6>
            @if ($selisih > 0)
            <a href="javascript:void(0)" class="small" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">Lebih</a>
            @elseif($selisih < 0)
            <a href="javascript:void(0)" class="small" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">Kurang</a>
            @endif
        </div>
        <div class="user-progress">
            <div class="d-flex justify-content-center">
                <sup class="mt-3 mb-0 fw-semibold text-heading small">Rp.</sup>
                <h3 class="fw-medium mb-0"> {{number_format($total_anggaran)}}</h3>
                <sub class="mt-auto mb-2 text-heading small">,-</sub>
            </div>
            <div class="d-flex justify-content-center">
                <sup class="mt-3 mb-0 text-heading small">Rp. </sup>
                @if ($selisih > 0)
                <h3 class="fw-small mb-0 text-danger">{{number_format($selisih, 0,',','.')}}</h3>
                @elseif($selisih < 0)
                <h3 class="fw-small mb-0 text-danger">{{number_format($selisih, 0,',','.')}}</h3>
                @endif
                <sub class="mt-auto mb-2 text-heading small">,-</sub>
            </div>
        </div>
    </div>
</div>