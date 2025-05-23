<?php

namespace App\DataTables;

use App\Models\Komponen;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KomponensDataTable extends DataTable
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
                            <a href="' . route('komponens.edit', $row->id_komponen) . '" class="btn btn-icon btn-primary waves-effect" data-bs-toggle="tooltip" title="Edit Data">
                                <span class="tf-icons mdi mdi-comment-edit"></span>
                            </a>
                            <form action="' . route('komponens.destroy', $row->id_komponen) . '" method="POST" class="delete-form">
                                ' . csrf_field() . method_field("DELETE") . '
                                <button type="button" class="btn btn-icon btn-outline-danger waves-effect delete-btn" data-bs-toggle="tooltip" title="Hapus Data">
                                    <span class="tf-icons mdi mdi-delete-empty-outline"></span>
                                </button>
                            </form>
                        </div>
                    </div>
                ';
            })

            ->rawColumns(['action', 'kategori_lengkap']);
    }


    public function query(Komponen $model)
    {
        return $model->newQuery()
            ->join('jenis_kategori_rkbus', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu', '=', 'komponens.id_jenis_kategori_rkbu')
            ->select(
                'id_komponen', // Ganti 'id' dengan 'id_komponen'
                'komponens.id_jenis_kategori_rkbu',
                'jenis_kategori_rkbus.nama_jenis_kategori_rkbu as nama_kategori',
                'kode_barang',
                'kode_komponen',
                'nama_barang',
                'satuan',
                'spek',
                'harga_barang',
                DB::raw("CONCAT('<strong>', jenis_kategori_rkbus.nama_jenis_kategori_rkbu, '</strong><br><span class=\"badge bg-label-dark\">Kode : ', jenis_kategori_rkbus.kode_jenis_kategori_rkbu, '</span>') as kategori_lengkap")

            );
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('komponen-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
            ['data' => 'kategori_lengkap', 'name' => 'kategori_lengkap', 'title' => 'Nama Kategori'],
            ['data' => 'kode_barang', 'name' => 'kode_barang', 'title' => 'Kode Barang'],
            ['data' => 'nama_barang', 'name' => 'nama_barang', 'title' => 'Nama Barang'],
            ['data' => 'harga_barang', 'name' => 'harga_barang', 'title' => 'Harga', 'render' => 'function(data) { return new Intl.NumberFormat("id-ID").format(data); }'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Komponens_' . date('YmdHis');
    }
}
