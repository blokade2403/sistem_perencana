   <!-- Bordered Table -->
   <div class="col-lg-12 col-12">
   <div class="card">
    <h5 class="card-header">Data Input RKBU</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped" style="width:100%">
          <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama Unit</th>
                <th class="text-center" rowspan="2">Total Anggaran Terinput</th>
                <th class="text-center" colspan="3">Total Anggaran Validasi KSP/Ka.Ins</th>
                <th class="text-center" colspan="3">Total Anggaran Validasi Kabag/Kabid</th>
            </tr>
            <tr>
                <th class="text-center">Perlu Validasi</th>
                <th class="text-center">Validasi</th>
                <th class="text-center">Di Tolak</th>
                <th class="text-center">Perlu Validasi</th>
                <th class="text-center">Validasi</th>
                <th class="text-center">Di Tolak</th>
            </tr>
          </thead>
          <tbody>
            @php $no = 1; @endphp
            @foreach ($total_unit as $item)
                <tr>
                    <td class="fa-sm text-wrap">{{ $no++ }}</td>
                    <td class="fa-sm text-wrap" style="word-wrap: break-word; white-space: normal; line-height: 1.5;">{{ $item->nama_unit }}</td>
                    <td class="fa-sm text-center">{{ number_format($item->total_anggaran_terinput, 0, ',', '.') }}</td>
                    <td class="fa-sm text-center">{{ number_format($item->anggaran_ksp_perlu_validasi, 0, ',', '.') }}</td>
                    <td class="fa-sm text-center">{{ number_format($item->anggaran_ksp_validasi, 0, ',', '.') }}</td>
                    <td class="fa-sm text-center">{{ number_format($item->anggaran_ksp_ditolak, 0, ',', '.') }}</td>
                    <td class="fa-sm text-center">{{ number_format($item->anggaran_kabag_perlu_validasi, 0, ',', '.') }}</td>
                    <td class="fa-sm text-center">{{ number_format($item->anggaran_kabag_validasi, 0, ',', '.') }}</td>
                    <td class="fa-sm text-center">{{ number_format($item->anggaran_kabag_ditolak, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
  <!--/ Bordered Table -->
