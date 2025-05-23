<?php

namespace App\DataTables;

use App\Models\UsulanBarang;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\RekapUsulanBelanja;
use App\Models\UsulanBarangDetail;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\DataTableHtml;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class RekapUsulanBelanjaDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                 <div class="demo-inline-spacing">
                    <div class="d-flex justify-content-start align-items-center gap-2">
                        <a href="' . route('rekap_usulans.edit', $row->id_usulan_barang) . '" class="btn btn-icon btn-primary waves-effect" data-bs-toggle="tooltip" title="Edit Data">
                            <span class="tf-icons mdi mdi-comment-edit"></span>
                        </a>
                        <form action="' . route('validasi_barang_jasa_admins.destroy', $row->id_usulan_barang) . '" method="POST" class="delete-form">
                            ' . csrf_field() . method_field("DELETE") . '
                            <button type="button" class="btn btn-icon btn-outline-danger waves-effect delete-btn" data-bs-toggle="tooltip" title="Hapus Data">
                                <span class="tf-icons mdi mdi-delete-empty-outline"></span>
                            </button>
                        </form>
                    </div>
                </div>';
            })
            ->addColumn('detail_usulan', function ($row) {
                // Tampilan HTML untuk kolom Quantity
                return '
                <div style="padding: 5px; border-radius: 5px;">
                    <span class="badge bg-danger">No Usulan. ' . $row->no_usulan_barang . '</span><br />
                                                <span class="badge bg-label-danger">ID Usulan Barang.' . $row->id_usulan_barang . ' </span><br />
                                                <small><strong>' . $row->kode_kategori_rkbu . '. ' . $row->nama_kategori_rkbu . '</strong></small><br />
                                                <small><strong>' . $row->kode_sub_kategori_rkbu . '. ' . $row->nama_sub_kategori_rkbu . '</strong></small><br /> 
                                                <small class="fs-12">Nama Pengusul : ' . $row->nama_pengusul_barang . '</small><br />
                                                <small class="fs-12">Tanggal Usulan : ' . $row->created_at . '</small><br />
                                                <small class="fs-12">Unit : ' . $row->unit . '</small><br />
                                                <small class="fs-12">Nama Barang: <br /><span class="badge bg-label-info">' . $row->nama_barang . '</span></small><br /><br />
                                                <small class="fs-12">ID RKBU: <br /><span class="badge bg-label-info">' . $row->id_rkbu . '</span></small><br /><br />
                                                <small class="fs-12"><span class="fa-sm">Tahun : ' . $row->tahun . '</span></small><br />
                </div>';
            })

            ->addColumn('uraian_usulan', function ($row) {
                // Tampilan HTML untuk kolom Quantity
                return '
                <div style="padding: 10px; border-radius: 5px;">
                    <span class="text-info fa-sm">' . $row->vol_1_detail . ' ' . $row->satuan_1_detail . ' x ' . $row->vol_2_detail . ' ' . $row->satuan_2_detail . '</span><br /><br />
                                                <small class="fs-12"> Rata-rata Pemakaian : ' . $row->rata2_pemakaian . ' </small><br />
                                                <small class="fs-12"> Sisa Stok : ' . $row->sisa_stok . '</small><br />
                                                <small class="fs-12"> Stok Minimal : ' . $row->stok_minimal . '</small><br />
                                                <small class="fs-12"> Buffer Stok : ' . $row->buffer_stok . '</small><br />
                                                <small class="fs-12"> Total Usulan Barang :  <span class="badge bg-warning fa-sm"> ' . $row->jumlah_usulan_barang . ' </span></small><br /><br />
                                                <small class="fs-12"> Spesifikasi : ' . $row->spek_detail . '</small> </br>
                </div>';
            })

            ->addColumn('detail_biaya', function ($row) {
                // Tampilan HTML untuk kolom Quantity
                return '
                <div style="padding: 5px; border-radius: 5px;">
                   <small class="fs-12"> Harga Barang : Rp. ' . $row->harga_barang . '</small> </br>
                                                <small class="fs-12"> PPN : ' . $row->ppn . ' %</small> </br>
                                                <small class="fs-12"> Total PPN : Rp. ' . $row->total_ppn . ' </small> </br>
                                                <small class="fs-12"> <span class="badge bg-dark"> Total Usulan Anggaran Barang : Rp. ' . $row->total_anggaran_usulan_barang . '</span></small> </br>
                                                <small class="fs-12"> <span class="badge bg-label-warning"> Sisa Vol Barang : Rp. ' . $row->sisa_vol_rkbu . ' </span></small> </br>
                                                <small class="fs-12"> <span class="badge bg-label-warning"> Sisa Anggaran Barang : Rp. ' . $row->sisa_anggaran_rkbu . '</span></small> </br>
                                                <small class="fs-12"> <span class="badge bg-label-success"> Status BAST: </span></small> </br>
                </div>';
            })
            ->rawColumns(['action', 'detail_biaya', 'uraian_usulan', 'detail_usulan'])
            ->setRowId('id');
    }

    public function query(UsulanBarang $model): QueryBuilder
    {
        $tahunAnggaran = Session::get('tahun_anggaran');
        $currentJenisKategori = request()->input('jenis_kategori_rkbu', '9cdfd354-e43a-4461-9747-e15fb74038ac');
        $search = request()->input('search.value');  // Ambil parameter pencarian dari DataTable
        $subKategoriFilter = request()->input('sub_kategori_rkbu');
        $statusValidasiFilter = request()->input('id_status_validasi_rka');

        $query = $model->newQuery()
            ->join('sub_kategori_rkbus', 'sub_kategori_rkbus.id_sub_kategori_rkbu', '=', 'usulan_barangs.id_sub_kategori_rkbu')
            ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
            ->join('usulan_barang_details', 'usulan_barang_details.id_usulan_barang', '=', 'usulan_barangs.id_usulan_barang')
            ->join('rkbus', 'rkbus.id_rkbu', '=', 'usulan_barang_details.id_rkbu')
            ->join('sub_kategori_rekenings', 'sub_kategori_rekenings.id_sub_kategori_rekening', '=', 'sub_kategori_rkbus.id_sub_kategori_rekening')
            ->join('rekening_belanjas', 'rekening_belanjas.id_kode_rekening_belanja', '=', 'rkbus.id_kode_rekening_belanja')
            ->join('aktivitas', 'aktivitas.id_aktivitas', '=', 'rekening_belanjas.id_aktivitas')
            ->join('sub_kegiatans', 'sub_kegiatans.id_sub_kegiatan', '=', 'aktivitas.id_sub_kegiatan')
            ->join('kegiatans', 'kegiatans.id_kegiatan', '=', 'sub_kegiatans.id_kegiatan')
            ->join('programs', 'programs.id_program', '=', 'kegiatans.id_program')
            ->join('sumber_danas', 'sumber_danas.id_sumber_dana', '=', 'sub_kegiatans.id_sumber_dana')
            ->join('users', 'users.id_user', '=', 'usulan_barangs.id_user')
            ->join('units', 'users.id_unit', '=', 'units.id_unit')
            ->where('tahun_anggaran', $tahunAnggaran)
            ->where('status_usulan_barang', 'Selesai');

        // 🔍 Pencarian
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('rkbus.nama_barang', 'like', "%{$search}%")
                    ->orWhere('sub_kategori_rkbus.nama_sub_kategori_rkbu', 'like', "%{$search}%")
                    ->orWhere('kategori_rkbus.nama_kategori_rkbu', 'like', "%{$search}%")
                    ->orWhere('users.nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('usulan_barangs.no_usulan_barang', 'like', "%{$search}%");
            });
        }

        return $query->select([
            'usulan_barang_details.*',
            'sub_kategori_rkbus.nama_sub_kategori_rkbu',
            'sub_kategori_rkbus.kode_sub_kategori_rkbu',
            'kategori_rkbus.kode_kategori_rkbu',
            'kategori_rkbus.nama_kategori_rkbu',
            'rekening_belanjas.*',
            'sub_kegiatans.*',
            'programs.*',
            'rkbus.nama_barang',
            'rkbus.sisa_vol_rkbu',
            'rkbus.sisa_anggaran_rkbu',
            'kegiatans.*',
            'aktivitas.*',
            'users.nama_lengkap as nama_pengusul_barang',
            'units.nama_unit as unit',
            'sumber_danas.id_sumber_dana', // Retrieving id_sumber_dana
            'sumber_danas.nama_sumber_dana', // Retrieving sumber_danas field
            'usulan_barangs.*',
            'usulan_barangs.tahun_anggaran as tahun'
        ]);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('rekap_usulan-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    public function getColumns(): array
    {
        return [
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => true],
            ['data' => 'detail_usulan', 'name' => 'detail_usulan', 'title' => 'Detail Usulan', 'orderable' => false, 'searchable' => true],
            ['data' => 'uraian_usulan', 'name' => 'uraian_usulan', 'title' => 'Uraian Usulan', 'orderable' => false, 'searchable' => true],
            ['data' => 'detail_biaya', 'name' => 'detail_biaya', 'title' => 'Detail Biaya', 'orderable' => false, 'searchable' => true],
            ['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable' => true],
        ];
    }

    protected function filename(): string
    {
        return 'RekapUsulanBelanja_' . date('YmdHis');
    }
}
