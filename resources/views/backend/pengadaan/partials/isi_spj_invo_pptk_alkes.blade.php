@php
$no = 1;
@endphp
@foreach ($invo_pptk_alkes as $key)
<tr>
    <td>{{$no++}}</td>
    <td class="py-2">
        <span class="badge bg-danger">No Usulan. {{$key->no_usulan_barang}}</span><br />
        <small><strong> {{$key->sub_kategori_rkbu->kode_sub_kategori_rkbu}}. {{$key->sub_kategori_rkbu->nama_sub_kategori_rkbu}}</strong></small><br />
        <small class="fs-12">Nama Pengusul : {{$key->nama_pengusul_barang}}</small><br />
        <small class="fs-12">Tanggal Usulan : {{$key->created_at}}</small><br />
        <small class="fs-12">Unit : {{$key->user->unit->nama_unit}}</small><br />
        <small class="fs-12">Status Usulan: <br /><span class="badge bg-label-info">{{$key->status_permintaan_barang}}: {{$key->tgl_validasi_direktur}}</span></small><br /><br />
        <small class="fa-sm">Status SPJ: <br /><span class="badge bg-label-danger">{{$key->status_hutang}}</span></small><br /><br />
        <small class="fs-12">Status Verifikasi Pengurus Barang: <span class="fa-sm badge bg-label-info">{{$key->status_verifikasi_pengurus_barang}}</span></small><br /><br />
        <small class="fs-12"><span class="fa-sm badge bg-label-info">Tahun Anggaran : {{$key->tahun_anggaran}}</span></small><br />
       
    </td>
    <td class="py-2">
        <strong>
        <small class="fs-12 text-secondary mb-0">Nama PT : <br>  {{$key->perusahaan?->nama_perusahaan ?? 'Data Perusahaan Belum di Input'}}</small><br />
        <small class="fs-12 text-primary mb-0">Nomor SPK :  {{$key->nomor_spk}}</small></strong><br />
    <small class="fs-12">ID Paket :  {{$key->idpaket}}</small><br /><br />
    <small class="fs-12">Keterangan Validasi Keuangan: <br /><small class="badge bg-label-danger"> {{$key->keterangan_spj}}</small></small><br />
    <small class="fs-12">Uraian Belanja : <br /> {{$key->rincian_belanja}}</small><br /><br />
    <small class="fs-12"><span class="badge bg-label-warning">ID Master SPJ:  {{$key->id_master_spj}}</span></small><br />
    <small class="fs-12"><span class="badge bg-label-info">ID SPJ:  {{$key->id_spj}}</span></small><br />
    </td>
    <td class="py-2">
    <small class="fs-12"> Tanggal Penyerahan SPJ : </br><small class="text-danger"> @if($key->tanggal_penyerahan_spj)
        {{ $key->tanggal_penyerahan_spj }}
    @else
        <span class="badge bg-warning">SPJ Proses Verifikasi</span>
    @endif
    </small></small><br />
    @if (($key->tanggal_revisi_spj) == '')
    <small class="fs-12"> Tanggal Revisi SPJ : </br><small class="fs-12">Tidak Ada Revisi</small>
    @else
    <small class="fs-12"> Tanggal Revisi SPJ : </br><small class="text-danger">
        {{$key->tanggal_revisi_spj}}
    </small></small><br />
    @endif
    </td>
    <td class="py-2">
    <small class="fs-12"><strong>Rp.  {{number_format($key->harga_dasar)}}</strong></small><br />
    <small class="fs-12">PPN :  {{$key->ppn}} %</small><br />
    <small class="fs-12">Bruto :</small><small class="badge bg-label-dark"> Rp.  {{number_format($key->bruto)}}</small><br /><br />
    <small class="fs-12">Pembayaran : <br /><small class="badge bg-label-success">Rp.  {{number_format($key->pembayaran)}}</small></small><br />
    <small class="fs-12">Tanggal Pembayaran :<br /> {{$key->tanggal_pembayaran}} </small><br />
    </td>
    <td>
@include('backend.pengadaan.partials.ul_status_isi_spj')
</td>

<td class="fs-14">
<div class="demo-inline-spacing">
    <div class="d-flex justify-content-start align-items-center gap-2">
        <a href="{{route('master_spj.edit', $key->id_master_spj)}}" class="btn btn-icon btn-primary waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-primary" data-bs-original-title="Edit Data">
            <span class="tf-icons mdi mdi-comment-edit"></span>
        </a>
        <a href="javascript:void(0);" 
        onclick="showDetailMasterSpj('{{ $key->id_master_spj }}')"  
        class="btn btn-icon btn-outline-info waves-effect" 
        data-bs-toggle="tooltip" 
        data-bs-placement="top" 
        data-bs-custom-class="tooltip-info" 
        data-bs-original-title="Detail Data">
         <span class="tf-icons mdi mdi-file-document-alert-outline"></span>
     </a>
    </div>
</div>
</td>
</tr>
@endforeach

