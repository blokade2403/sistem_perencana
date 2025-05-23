<?php

namespace App\DataTables;

use App\Models\Komponen;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;



class KomponenDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                <div class="btn-group">
                    <a href="' . route('komponens.edit', $row->id_komponen) . '" class="btn btn-sm btn-primary">Edit</a>
                    <form action="' . route('komponens.destroy', $row->id_komponen) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field("DELETE") . '
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </div>
                ';
            })

            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     */
    public function query(Komponen $model)
    {
        return $model->newQuery()->select(
            'id_komponen', // Ganti 'id' dengan 'id_komponen'
            'id_jenis_kategori_rkbu',
            'kode_barang',
            'kode_komponen',
            'nama_barang',
            'satuan',
            'spek',
            'harga_barang'
        );
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('komponen-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
    }

    /**
     * Get columns definition.
     */
    protected function getColumns()
    {
        return [
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
            ['data' => 'id_jenis_kategori_rkbu', 'name' => 'id_jenis_kategori_rkbu', 'title' => 'ID Komponen'],
            ['data' => 'kode_barang', 'name' => 'kode_barang', 'title' => 'Kode Barang'],
            ['data' => 'nama_barang', 'name' => 'nama_barang', 'title' => 'Nama Barang'],
            ['data' => 'harga_barang', 'name' => 'harga_barang', 'title' => 'Harga', 'render' => 'function(data) { return new Intl.NumberFormat("id-ID").format(data); }'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable' => false],
        ];
    }
}
