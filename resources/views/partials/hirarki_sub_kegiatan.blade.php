      <!-- Sales Overview-->
      <div class="col-lg-12 col-12">
        <div class="card">
          <div class="card-header">
          <div class="container">
            <h3>Program dan Kegiatan</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode Program</th>
                        <th>Nama Program</th>
                        <th>Total Anggaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($programs as $program)
                        <tr>
                            <td>{{ $program->kode_program }}</td>
                            <td>{{ $program->nama_program }}</td>
                            <td>
                              {{ $program->kegiatans ? $program->kegiatans->sum(fn($k) =>
                                  $k->subKegiatans ? $k->subKegiatans->sum(fn($s) =>
                                      $s->rkbus ? $s->rkbus->sum('total_anggaran') : 0
                                  ) : 0
                              ) : 0 }}
                          </td>
                          
                        </tr>
                        @foreach($program->kegiatans as $kegiatan)
                            <tr>
                                <td>-- {{ $kegiatan->kode_kegiatan }}</td>
                                <td>{{ $kegiatan->nama_kegiatan }}</td>
                                <td>
                                  {{ $program->kegiatans ? $program->kegiatans->sum(fn($k) =>
                                      $k->subKegiatans ? $k->subKegiatans->sum(fn($s) =>
                                          $s->rkbus ? $s->rkbus->sum('total_anggaran') : 0
                                      ) : 0
                                  ) : 0 }}
                              </td>
                              
                            </tr>
                            @foreach($kegiatan->sub_kegiatan as $subKegiatan)
                                <tr>
                                    <td>---- {{ $subKegiatan->kode_sub_kegiatan }}</td>
                                    <td>{{ $subKegiatan->nama_sub_kegiatan }}</td>
                                    <td>{{ $subKegiatan->rkbus->sum('total_anggaran') }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
      </div>
      <!--/ Sales Overview-->
    </div>