<?php

namespace App\DataTables;

use App\Models\Asset;
use App\Models\ReklasArb;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;


class ReklasArbsDataTable extends DataTable
{

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('kode_asset', function ($row) {
                return '<span class="badge bg-label-info">' . $row->kode_asset . '</span>';
            })
            ->addColumn('action', function ($row) {
                return '<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-menu me-1"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                               <a href="' . route('reklas_arbs.edit', $row->id_asset) . '" class="dropdown-item">
                                <i class="mdi mdi-pencil"></i> Edit
                            </a>
                            </li>
                            <li>
                                <form action="' . route('reklas_arbs.destroy', $row->id_asset) . '" method="POST" class="delete-form_db">
                                        ' . csrf_field() . method_field('DELETE') . '
                                    <button type="submit" class="dropdown-item">
                                    <i class="mdi mdi-delete"></i> Hapus
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>';
            })
            ->addColumn('detail', function ($row) {
                // Tampilan HTML untuk kolom Quantity
                $hib = match ($row->hibah) {
                    'Asset Tetap' => 'badge bg-label-success',
                    'Hibah' => 'badge bg-label-warning',
                    default => 'badge bg-label-secondary',
                };
                return '
                <div style="padding: 5px; border-radius: 5px; width: 20ch;">
                    <strong><span class="fa-sm text-primary" style="font-size: 15px; margin-top: 5px;">
                        ' . $row->nama_asset . '
                    </span></strong></br>
                    <div style="font-size: 12px; padding: 2px 1px; border-radius: 3px; display: inline-block; margin-top: 5px;">Spesifikasi: ' . $row->spek . '</div>
                    <div style="font-size: 12px; padding: 2px 1px; border-radius: 3px; display: inline-block; margin-top: 0px;">Merk: ' . $row->merk . '</div>
                    <div style="font-size: 12px; padding: 2px 1px; border-radius: 3px; display: inline-block; margin-top: 5px;">Tipe: ' . $row->type . '</div>
                    <div style="font-size: 12px; padding: 2px 1px; border-radius: 3px; display: inline-block; margin-top: 0px;">Penempatan: ' . $row->penempatan_asset . '</div></br>
                    <div style="font-size: 12px; padding: 2px 1px; border-radius: 3px; display: inline-block; margin-top: 15px;">Tahun: <span class="badge bg-label-warning">' . $row->tahun_perolehan . '</span></div></br>
                    <div style="font-size: 12px; padding: 2px 1px; border-radius: 3px; display: inline-block; margin-top: 0px;">Kategori Asset: <span class="' . $hib . '">' . $row->hibah . '</span></div></br>
                </div>';
            })
            ->addColumn('actions', function ($row) {
                return '<div class="demo-inline-spacing">
                    <div class="d-flex justify-content-start align-items-center gap-2">
                        <a href="' . route('reklas_arbs.details', ['id' => $row->id_asset]) . '" 
                            class="btn btn-icon btn-outline-primary waves-effect" data-bs-toggle="tooltip" title="Detail"
                            style="display: inline-block; margin-right: 5px;">
                            <span class="tf-icons mdi mdi-comment-edit"></span>
                            </a>
                        <a href="' . route('reklas_arbs.generate_qrcode', ['id_asset' => $row->id_asset]) . '" 
                            class="btn btn-icon btn-outline-primary waves-effect" data-bs-toggle="tooltip" title="Generate QrCode"
                            style="display: inline-block;"><span class="tf-icons mdi mdi-qrcode-plus"></span></a></div></div>';
            })
            ->addColumn('qrcode_path', function ($row) {
                return $row->qrcode_path
                    ? '<a href="' . asset("storage/qrcode_assets/" . basename($row->qrcode_path)) . '" target="_blank">
                        <img src="' . asset("storage/qrcode_assets/" . basename($row->qrcode_path)) . '" width="80" height="80">
                   </a>'
                    : '<span class="text-muted">Belum Digenerate</span>';
            })
            ->addColumn('foto', function ($row) {
                return $row->foto
                    ? '<a href="' . asset("storage/foto_asset/" . basename($row->foto)) . '" target="_blank">
                        <img src="' . asset("storage/foto_asset/" . basename($row->foto)) . '" width="80" height="80">
                   </a>'
                    : '<span class="text-muted">Tidak Ada</span>';
            })
            ->addColumn('kondisi_asset', function ($row) {
                $badgeClass = match ($row->kondisi_asset) {
                    'Baik' => 'badge bg-label-success',
                    'Rusak Ringan' => 'badge bg-label-warning',
                    'Rusak Berat' => 'badge bg-label-danger',
                    default => 'badge bg-label-secondary',
                };
                return '<span class="' . $badgeClass . '">' . $row->kondisi_asset . '</span>';
            })
            ->addColumn('harga_asset', function ($row) {
                return 'Rp.' . number_format($row->harga_asset);
            })
            ->addColumn('status_asset', function ($row) {
                return '<span class="fs-14">' . $row->status_asset . '</span>';
            })
            ->filterColumn('detail', function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('nama_asset', 'like', "%{$keyword}%")
                        ->orWhere('spek', 'like', "%{$keyword}%")
                        ->orWhere('tahun_perolehan', 'like', "%{$keyword}%")
                        ->orWhere('kondisi_asset', 'like', "%{$keyword}%")
                        ->orWhere('penempatan_asset', 'like', "%{$keyword}%")
                        ->orWhere('kode_asset', 'like', "%{$keyword}%")
                        ->orWhere('harga_asset', 'like', "%{$keyword}%")
                        ->orWhere('status_asset', 'like', "%{$keyword}%")
                        ->orWhere('total_anggaran_asset', 'like', "%{$keyword}%")
                        ->orWhere('merk', 'like', "%{$keyword}%")
                        ->orWhere('no_register', 'like', "%{$keyword}%")
                        ->orWhere('type', 'like', "%{$keyword}%")
                        ->orWhere('serial_number', 'like', "%{$keyword}%");
                });
            })
            ->rawColumns(['action', 'actions', 'qrcode_path', 'foto', 'kode_asset', 'kondisi_asset', 'status_asset', 'detail']);
    }


    public function query(Asset $model): QueryBuilder
    {
        $query = $model->newQuery()
            ->join('jenis_kategori_rkbus', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu', '=', 'assets.id_jenis_kategori_rkbu')
            ->where('assets.status_reklas_arb', 'Reklas');

        return $query->select([
            'assets.*',
            'jenis_kategori_rkbus.nama_jenis_kategori_rkbu',
        ]);
    }


    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('reklas_arbs-table')
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
            ['data' => 'kode_asset', 'name' => 'kode_asset', 'title' => 'Kode Asset'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable' => true],
            ['data' => 'detail', 'name' => 'detail', 'title' => 'Detail Asset', 'orderable' => false, 'searchable' => true],
            ['data' => 'satuan', 'name' => 'satuan', 'title' => 'Satuan', 'orderable' => false, 'searchable' => true],
            ['data' => 'harga_asset', 'name' => 'harga_asset', 'title' => 'Harga Asset', 'orderable' => false, 'searchable' => true],
            ['data' => 'kondisi_asset', 'name' => 'kondisi_asset', 'title' => 'Kondisi', 'orderable' => false, 'searchable' => true],
            ['data' => 'qrcode_path', 'name' => 'qrcode_path', 'title' => 'Barcode', 'orderable' => false, 'searchable' => true],
            ['data' => 'foto', 'name' => 'foto', 'title' => 'Foto', 'orderable' => false, 'searchable' => true],
            ['data' => 'status_asset', 'name' => 'status_asset', 'title' => 'Keterangan', 'orderable' => false, 'searchable' => true],
            ['data' => 'actions', 'name' => 'actions', 'title' => 'Aksi', 'orderable' => false, 'searchable' => true],
        ];
    }


    protected function filename(): string
    {
        return 'Assets_' . date('YmdHis');
    }
}
