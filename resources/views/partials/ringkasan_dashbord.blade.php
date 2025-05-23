<div class="col-lg-12 col-12">
    <div class="card">
        <div class="card-header text-center mt-2"> {{date('l, d-m-Y  H:i:s')}} <strong>
            <h5>Ringkasan Belanja RBA BLUD</h5>
        </strong> </div>
        <div class="table-responsive rounded-3">
            <table class="table">
                <thead>
                  <tr>
                    <th class="center"><strong>Kode</strong></th>
                    <th><strong>Uraian</strong></th>
                    <th><strong>Pendapatan BLUD</strong></th>
                    <th class="right"><strong>Sumber Dana Dari Silpa</strong></th>
                    <th class="center"><strong>Jumlah (Rp)</strong></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="center">
                      <small class="bg-blue circle"></small><small><strong>4</strong></small>
                    </td>
                    <td class="left strong">
                      <small></small><small><strong>PENDAPATAN</strong></small>
                    </td>
                    <td class="left"></td>
                    <td class="right"></td>
                    <td class="center"></td>
                    <td class="center"></td>
                  </tr>
                  <tr>
                    <td class="center">
                      <small class="bg-blue circle"></small><small>4.1.4.12.01</small>
                    </td>
                    <td class="left strong">
                      <small class="bg-blue circle"></small><small>Jasa Layanan Umum BLUD</small>
                    </td>
                    <td class="left"></td>
                    <td class="right"></td>
                    <td class="center"></td>
                  </tr>
                  <tr>
                    <td class="center">
                      <small class="bg-blue circle"></small><small>4.1.4.12.03</small>
                    </td>
                    <td class="left strong">
                      <small class="bg-blue circle"></small><small>Lain-lain Pendapatan BLUD yang Sah</small>
                    </td>
                    <td class="left"></td>
                    <td class="right"></td>
                    <td class="center"></td>
                  </tr>
                  <tr>
                    <td class="center">
                      <small class="bg-blue circle"></small><small>4.1.4.12.02</small>
                    </td>
                    <td class="left strong">
                      <small class="bg-blue circle"></small><small>Hasil Kerjasama dengan Pihak Lain</small>
                    </td>
                    <td class="left"></td>
                    <td class="right"></td>
                    <td class="center"></td>
                  </tr>
                  <tr>
                    <td class="center">
                      <small class="bg-blue circle"></small><small>4.1.4.12.04</small>
                    </td>
                    <td class="left strong">
                      <small class="bg-blue circle"></small><small>Hibah BLUD</small>
                    </td>
                    <td class="left"></td>
                    <td class="right"></td>
                    <td class="center"></td>
                  </tr>
                  <tr>
                    <td class="center">
                      <small class="bg-blue circle"></small><small></small>
                    </td>
                    <td class="left strong">
                      <small class="bg-blue circle"></small><small><strong>Jumlah Pendapatan<strong></small>
                    </td>
                    <td class="left"></td>
                    <td class="right"></td>
                    <td class="center"></td>
                    <td class="right"></td>
                  </tr>

                  <tr>
                    <td class="center">
                      <small class="bg-blue circle"></small><small><strong>5</strong></small>
                    </td>
                    <td class="left strong">
                      <small class="bg-blue circle"></small><small><strong>BELANJA</strong></small>
                    </td>
                    <td class="left">
                      <small class="bg-blue circle"></small><small><strong>Anggaran RKBU Terinput</strong></small>
                    </td>
                    <td class="left">
                      <small class="bg-blue circle"></small><small><strong>Anggaran Disetujui KSP/Ka.Ins</strong></small>
                    </td>
                    <td class="left">
                      <small class="bg-blue circle"></small><small><strong>Anggaran Disetujui Kabag.Kabid</strong></small>
                    </td>
                    <td class="left">
                      <small class="bg-blue circle"></small><small><strong>Jumlah Anggaran</strong></small>
                    </td>
                    <td class="center"></td>
                  </tr>
                  <tr>
                    <td class="center">
                      <small class="bg-blue circle"></small><small><strong>5.1</strong></small>
                    </td>
                    <td class="left strong">
                      <small class="text-black"><strong>Belanja Operasi</strong></small>
                    </td>
                    <td class="left">
                      <small class="text-black"><strong>Rp. {{number_format($belanja_operasi_all, 0, ',','.')}} ,-</strong></small>
                    </td>
                    <td class="left">
                      <small class="text-black"><strong>Rp. {{number_format($total_anggaran_operasi_ksp, 0, ',','.')}} ,-</strong></small>
                    </td>
                    <td class="left">
                      <small class="bg-blue circle"></small><small class="fs-14 text-primary"><strong>Rp. {{number_format($belanja_operasi, 0, ',','.')}} ,-</strong></small>
                    </td>
                    <td class="left">
                      <small class="bg-blue circle"></small><small class="fs-14 text-primary"><strong>Rp. {{number_format($belanja_operasi, 0, ',','.')}} ,-</strong></small>
                    </td>
                    <td class="center"></td>
                  </tr>
                  <tr>
                    <td class="center">
                      <small class="bg-blue circle"></small><small>5.1.01.99.99.9999</small>
                    </td>
                    <td class="left strong">
                      <small class="bg-blue circle"></small><small>Belanja Pegawai</small>
                    </td>
                    <td class="right">
                      <small class="text-black"></small><small> Rp. {{ number_format($total_anggaran_jenis_pegawai_admin_all) }},-</small>
                    </td>
                    <td class="left">
                      <small class="text-black"></small><small>Rp. {{ number_format($total_anggaran_pegawai_ksp + $total_anggaran_pegawai_ksp_apbd) }},-</small>
                    </td>
                    <td class="left">
                      <small class="fs-14 text-primary">Rp.{{number_format($total_anggaran_jenis_pegawai_admin, 0, ',','.')}},-</small>
                    </td>
                    <td class="left">
                    
                      <small class="fs-14 text-primary">Rp.{{number_format($total_anggaran_jenis_pegawai_admin, 0, ',','.')}},-</small>
                    </td>
                  </tr>
                  <tr>
                    <td class="center">
                      <small class="bg-blue circle"></small><small>5.1.03.06.01.0001</small>
                    </td>
                    <td class="left strong">
                      <small class="bg-blue circle"></small><small>Belanja Bunga</small>
                    </td>
                    <td class="left"><span class="fa-xs">Rp. 0</span></td>
                    <td class="right"><span class="fa-xs">Rp. 0</span></td>
                    <td><span class="fa-xs  text-primary">Rp. {{$total_anggaran_jenis_bunga_admin}}</span></td>
                    <td><span class="fa-xs  text-primary">Rp. {{$total_anggaran_jenis_bunga_admin}}</span></td>
                  </tr>
                  <tr>
                    <td class="center">
                      <small class="bg-blue circle"></small><small>5.1.02.99.99.9999</small>
                    </td>
                    <td class="left strong">
                      <small class="bg-blue circle"></small><small>Belanja Barang dan Jasa</small>
                    </td>
                    <td class="right">
                     
                      <small class="text-black"></small><small> Rp. {{number_format($total_anggaran_jenis_barjas_admin_all, 0, ',', '.')}} ,-</small>
                    </td>
                    <td class="left">
                     
                      <small class="text-black"></small><small> Rp. {{number_format($total_anggaran_barjas_ksp + $total_anggaran_barjas_ksp_apbd)}} ,-</small>
                    </td>
                    <td class="left">
                     
                      <small class="fs-14 text-primary">Rp.{{number_format($total_anggaran_jenis_barjas_admin, 0, ',', '.')}},-</small>
                    </td>
                    <td class="left">
                    
                      <small class="fs-14 text-primary">Rp. {{number_format($total_anggaran_jenis_barjas_admin, 0, ',', '.')}},-</small>
                    </td>
                  </tr>
                  <tr>
                    <td class="center">
                      <small class="bg-blue circle"></small><small>-</small>
                    </td>
                    <td class="left strong">
                      <small class="bg-blue circle"></small><small>Belanja Lain-Lain</small>
                    </td>
                    <td class="right">
                     
                      <small class="text-black"></small><small>Rp. ,-</small>
                    </td>
                    <td class="left">
                      
                      <small class="text-black"></small><small> Rp. ,-</small>
                    </td>
                    <td class="left">
                     
                      <small class="fs-14 text-primary">Rp.  ,-</small>
                    </td>
                    <td class="left">
                     
                      <small class="fs-14 text-primary">Rp.  ,-</small>
                    </td>
                  </tr>
                  <tr>
                    <td class="center">
                      <small class="text-black"><strong>5.2</strong></small>
                    </td>
                    <td class="left strong">
                      <small class="text-black"><strong>Belanja Modal</strong></small>
                    </td>
                    <td class="right">
                    
                      <small class="text-black"><strong> Rp. {{number_format($belanja_modal_ringkasan_all, 0, ',','.')}} ,-</strong></small>
                    </td>
                    <td class="left">
                   
                      <small class="text-black"><strong> Rp.  ,-</strong></small>
                    </td>
                    <td class="left">
                     
                      <small class="fs-14 text-primary"><strong> Rp. {{number_format($belanja_modal_ringkasan, 0, ',','.')}} ,-</strong></small>
                    </td>
                    <td class="left">
                     
                      <small class="fs-14 text-primary"><strong> Rp.{{number_format($belanja_modal_ringkasan, 0, ',','.')}} ,-</strong></small>
                    </td>
                  </tr>
                  <tr>
                    <td class="center">
                      <small class="bg-blue circle"></small><small>5.2.01.01.99.9999</small>
                    </td>
                    <td class="left strong">
                      <small class="bg-blue circle"></small><small>Belanja Tanah</small>
                    </td>
                    <td class="left"><span class="fa-xs">Rp. 0</span></td>
                    <td class="right"><span class="fa-xs">Rp. 0</span></td>
                    <td><span class="fa-xs  text-primary">Rp. {{number_format($total_anggaran_jenis_modal_tanah_admin, 0, ',', '.')}}</span></td>
                    <td><span class="fa-xs  text-primary">Rp. {{number_format($total_anggaran_jenis_modal_tanah_admin, 0, ',', '.')}}</span></td>
                  </tr>
                  <tr>
                    <td class="center">
                      <small class="bg-blue circle"></small><small>5.2.02.99.99.9999</small>
                    </td>
                    <td class="left strong">
                      <small class="bg-blue circle"></small><small>Belanja Peralatan dan Mesin</small>
                    </td>
                    <td class="right">
                     
                      <small class="text-black"></small><small>Rp. {{number_format($total_anggaran_jenis_modal_mesin_admin_all, 0, ',', '.')}} ,-</small>
                    </td>
                    <td class="left">
                     
                      <small class="text-black"></small><small>Rp. {{number_format($total_anggaran_modal_ksp, 0, ',','.')}}  ,-</small>
                    </td>
                    <td class="left">
                     
                      <small class="fs-14 text-primary">Rp. {{number_format($total_anggaran_jenis_modal_mesin_admin, 0, ',', '.')}} ,-</small>
                    </td>
                    <td class="left">
                      
                      <small class="fs-14 text-primary">Rp. {{number_format($total_anggaran_jenis_modal_mesin_admin, 0, ',', '.')}},-</small>
                    </td>
                  </tr>
                  <tr>
                    <td class="center">
                      <small class="bg-blue circle"></small><small>5.2.03.99.99.9999</small>
                    </td>
                    <td class="left strong">
                      <small class="bg-blue circle"></small><small>Belanja Gedung dan Bangunan</small>
                    </td>
                    <td class="left"><span class="fa-xs">Rp. 0</span></td>
                    <td class="right"><span class="fa-xs">Rp. 0</span></td>
                    <td><span class="fa-xs  text-primary">Rp. {{number_format($total_anggaran_jenis_modal_gedung_admin, 0, ',', '.')}}</span></td>
                    <td><span class="fa-xs  text-primary">Rp. {{number_format($total_anggaran_jenis_modal_gedung_admin, 0, ',', '.')}}</span></td>
                  </tr>
                  <tr>
                    <td class="center">
                      <small class="bg-blue circle"></small><small>5.2.04.99.99.9999</small>
                    </td>
                    <td class="left strong">
                      <small class="bg-blue circle"></small><small>Belanja Jalan, Irigasi dan Jaringan</small>
                    </td>
                    <td class="left"><span class="fa-xs">Rp. 0</span></td>
                    <td class="right"><span class="fa-xs">Rp. 0</span></td>
                    <td><span class="fa-xs  text-primary">Rp. 0</span></td>
                    <td><span class="fa-xs  text-primary">Rp. 0</span></td>
                  </tr>
                  <tr>
                    <td class="center">
                      <small class="bg-blue circle"></small><small>5.2.05.99.99.9999</small>
                    </td>
                    <td class="left strong">
                      <small class="bg-blue circle"></small><small>Belanja Aset Tetap Lainnya</small>
                    </td>
                    <td class="left"><span class="fa-xs">Rp. 0</span></td>
                    <td class="right"><span class="fa-xs">Rp. 0</span></td>
                    <td><span class="fa-xs  text-primary">Rp. 0</span></td>
                    <td><span class="fa-xs  text-primary">Rp. 0</span></td>
                  </tr>
                  <tr>
                    <td class="center">
                      <small class="bg-blue circle"></small><small></small>
                    </td>
                    <td class="left strong">
                      <small class="text-black"><strong>Jumlah Belanja</strong></small>
                    </td>
                    <td class="left">
                      <small class="text-black"><strong>Rp. {{number_format($belanja_total_all, 0, ',','.')}} ,-</strong></small>
                    </td>
                    <td class="left">
                      <small class="text-black"><strong>Rp. {{number_format($total_anggaran_ksp, 0, ',','.')}} ,-</strong></small>
                    </td>
                    <td class="left">
                      <small class="bg-blue circle"></small><small class="fs-14 text-primary"><strong>Rp. {{number_format($total_anggaran_jenis_admin,0,',','.')}} ,-</strong></small>
                    </td>
                    <td class="left">
                      <small class="bg-blue circle"></small><small class="fs-14 text-primary"><strong>Rp. {{number_format($total_anggaran_jenis_admin,0,',','.')}},-</strong></small>
                    </td>
                  </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>