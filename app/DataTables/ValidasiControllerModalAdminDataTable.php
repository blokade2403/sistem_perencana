<?php

namespace App\DataTables;

use App\Models\Rkbu;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\ValidasiControllerModalAdmin;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class ValidasiControllerModalAdminDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                $statusHtml = '<ul class="timeline card-timeline mb-0">';
                if ($row->id_status_validasi == '9cfb1f38-dc3f-436f-8c4a-ec4c4de2fcaf') {
                    $statusHtml .= '
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-dark"></span>
                            <div class="timeline-event">
                                <div class="timeline-header mb-1">
                                    <span class="badge bg-dark">
                                        <small class="mb-2 fw-2">Perlu Validasi <p class="mb-0">KSP/Ka.Ins</p></small>
                                    </span>
                                </div>
                            </div>
                        </li>';
                } elseif ($row->id_status_validasi == '9cfb1f45-ca37-4bd3-8dc9-514c6b9f436c') {
                    $statusHtml .= '
                         <li class="timeline-item timeline-item-transparent border-0">
                          <span class="timeline-point timeline-point-danger"></span>
                            <div class="timeline-event">
                                <div class="timeline-header mb-1">
                                    <span class="badge bg-danger">
                                        <small class="mb-2 fw-2">Ditolak <p class="mb-0">KSP/Ka.Ins</p></small>
                                    </span>
                                </div>
                            </div>
                        </li>';
                } elseif ($row->id_status_validasi == '9cfb1edc-2263-401f-b249-361db4017932') {
                    $statusHtml .= '
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-info"></span>
                            <div class="timeline-event">
                                <div class="timeline-header mb-1">
                                    <span class="badge bg-info">
                                        <small class="mb-2 fw-2">Validasi <p class="mb-0">KSP/Ka.Ins</p></small>
                                    </span>
                                </div>
                            </div>
                        </li>
                          <li class="timeline-item timeline-item-transparent">
                          <span class="timeline-point timeline-point-warning"></span>
                            <div class="timeline-event">
                                <div class="timeline-header mb-1">
                                    <span class="badge bg-label-warning">
                                        <small class="mb-2 fw-2">Perlu Validasi <p class="mb-0">Kabag/Kabid</p></small>
                                    </span>
                                </div>
                            </div>
                            <div style="position: absolute; left: 0; top: 0; bottom: 0; width: 2px; background-color: transparent;"></div>
                        </li>';
                }
                if ($row->id_status_validasi_rka == '9cfb1fa1-d0de-4e99-a368-8c218deda960') {
                    $statusHtml .= '
                        <li class="timeline-item timeline-item-transparent border-0">
                          <span class="timeline-point timeline-point-danger"></span>
                            <div class="timeline-event">
                                <div class="timeline-header mb-1">
                                    <span class="badge bg-danger">
                                        <small class="mb-2 fw-2">Di Tolak <p class="mb-0">Kabag/Kabid</p></small>
                                    </span>
                                </div>
                            </div>
                            <div style="position: absolute; left: 0; top: 0; bottom: 0; width: 2px; background-color: transparent;"></div>
                        </li>';
                }
                if ($row->id_status_validasi_rka == '9cfb1f87-238b-4ea2-98f0-4255e578b1d1') {
                    $statusHtml .= '
                        <li class="timeline-item timeline-item-transparent border-0">
                          <span class="timeline-point timeline-point-success"></span>
                            <div class="timeline-event">
                                <div class="timeline-header mb-1">
                                    <span class="badge bg-success">
                                        <small class="mb-2 fw-2">Validasi <p class="mb-0">Kabag/Kabid</p></small>
                                    </span>
                                </div>
                            </div>
                            <div style="position: absolute; left: 0; top: 0; bottom: 0; width: 2px; background-color: transparent;"></div>
                        </li>';
                }
                $statusHtml .= '</ul>';
                return $statusHtml;
            })

            ->addColumn('barang', function ($row) {
                // Tampilan HTML untuk kolom Quantity
                return '
                <div style="padding: 5px; border-radius: 5px;">
                    <strong><span class="fa-sm text-primary" style="font-size: 15px; margin-top: 5px;">
                        ' . $row->nama_barang . '
                    </span></strong>
                    <div style="font-size: 12px; padding: 2px 1px; border-radius: 3px; display: inline-block; margin-top: 5px;">Spesifikasi: ' . $row->spek . '</div>
                    <div style="font-size: 12px; padding: 2px 1px; border-radius: 3px; display: inline-block; margin-top: 15px;">Penempatan: ' . $row->penempatan . '</div></br>
                </div>';
            })

            ->addColumn('sub_kategori', function ($row) {
                // Tampilan HTML untuk kolom Quantity
                return '
                <div style="padding: 5px; border-radius: 5px;">
                    <div style="font-size: 12px; padding: 2px 1px; border-radius: 3px; display: inline-block; margin-top: 5px;">' . $row->kategori_kode . '</div></br>
                  
                    <div style="font-size: 12px; padding: 2px 1px; border-radius: 3px; display: inline-block; margin-top: 5px;">ID Sub Kategori</div>
                    <span class="fa-sm badge bg-label-warning" style="font-size: 12px; padding: 2px 5px; border-radius: 3px; display: inline-block; margin-top: 5px;">
                        ' . $row->id_sub_kategori_rkbu . '
                    </span>
                     <div style="font-size: 12px; padding: 2px 1px; border-radius: 3px; display: inline-block; margin-top: 5px;">ID  RKBU</div>
                    <span class="fa-sm badge bg-label-info" style="font-size: 12px; padding: 2px 5px; border-radius: 3px; display: inline-block; margin-top: 5px;">
                        ' . $row->id_rkbu . '
                    </span>
                    <div style="margin-top: 10px; color: #6c757d;">
                         <div style="font-size: 12px; padding: 2px 5px; border-radius: 3px; display: inline-block; margin-top: 5px;">Pengusul: ' . $row->user_name . '</div></br>
                         <div style="font-size: 12px; padding: 2px 5px; border-radius: 3px; display: inline-block; margin-top: 0px;">KSP: ' . $row->ksp . '</div></br>
                         <div style="font-size: 12px; padding: 2px 5px; border-radius: 3px; display: inline-block; margin-top: 5px;">' . $row->created_at . '</div>
                    </div>
                </div>';
            })

            ->addColumn('detail_anggaran', function ($row) {
                // Tampilan HTML untuk kolom Quantity
                return '
                <div style="padding: 5px; border-radius: 5px;">
                    <div style="font-size: 12px; padding: 2px 1px; border-radius: 3px; display: inline-block; margin-top: 5px;">Rp. ' . number_format($row->harga_satuan) . '</div></br>
                    <div style="font-size: 12px; padding: 2px 1px; border-radius: 3px; display: inline-block; margin-top: 0px;">PPN: ' . $row->ppn . '%</div></br>
                    <div style="font-size: 12px; padding: 2px 1px; border-radius: 3px; display: inline-block; margin-top: 5px;">Total Anggaran</div>
                    <span class="fa-sm badge bg-dark" style="font-size: 12px; padding: 2px 5px; border-radius: 3px; display: inline-block; margin-top: 5px;">
                        Rp. ' . number_format($row->total_anggaran) . '
                    </span>
                    <div style="margin-top: 10px; color: #6c757d;">
                         <div style="font-size: 12px; padding: 2px 5px; border-radius: 3px; display: inline-block; margin-top: 5px;">Sumber Dana:</div>
                          <span class="fa-sm badge bg-label-danger" style="font-size: 12px; padding: 2px 5px; border-radius: 3px; display: inline-block; margin-top: 5px;">
                        ' .  $row->nama_sumber_dana . '
                    </span>
                    </div>
                </div>';
            })

            ->addColumn('quantity', function ($row) {
                // Tampilan HTML untuk kolom Quantity
                return '
                <div style="padding: 10px; border-radius: 5px;">
                     <div class="fa-sm text-nowrap" style="display: block; margin-bottom: 5px;">' . $row->vol_1 . ' ' . $row->satuan_1 . ' x ' . $row->vol_2 . ' ' . $row->satuan_2 . '</div>
                    <span class="fa-sm badge bg-label-success" style="font-size: 12px; padding: 2px 5px; border-radius: 3px; display: inline-block; margin-top: 15px;">
                        Jumlah : ' . $row->jumlah_vol . '
                    </span>
                    <div style="margin-top: 5px; color: #6c757d;">
                         <div style="font-size: 12px; padding: 2px 5px; border-radius: 3px; display: inline-block; margin-top: 5px;">Sisa Jumlah Vol:</div>
                        <span style="font-size: 12px; background-color: #f8d7da; color: #721c24; padding: 2px 5px; border-radius: 3px; display: inline-block; margin-top: 2px;" class="badge bg-label-danger">
                            ' . $row->sisa_vol_rkbu . '
                        </span>
                    </div>
                    <div style="margin-top: 5px; color: #6c757d;">
                         <div style="font-size: 12px; padding: 2px 5px; border-radius: 3px; display: inline-block; margin-top: 15px;">Sisa Anggaran:</div>
                        <span style="font-size: 12px; background-color: #f8d7da; color: #721c24; padding: 2px 5px; border-radius: 3px; display: inline-block; margin-top: 2px;" class="badge bg-label-danger">
                            Rp. ' . number_format($row->sisa_anggaran_rkbu, 0, ',', '.') . '
                        </span>
                    </div>
                </div>';
            })

            ->addColumn('detail_usulan', function ($row) {
                // Menangani Link E-Katalog
                $linkEcatalog = '';
                if (strlen($row->link_ekatalog) <= 3) {
                    $linkEcatalog = htmlspecialchars($row->link_ekatalog);
                } else {
                    $linkEcatalog = '<a href="' . htmlspecialchars($row->link_ekatalog) . '" target="_blank"><span class="badge bg-primary">Lihat Link</span></a>';
                }

                // Menangani Dokumen Upload
                $dokumen = '';

                $files = [
                    'upload_file_1' => 'Dok. KAP',
                    'upload_file_2' => 'Dok. SPH1',
                    'upload_file_3' => 'Dok. SPH2',
                    'upload_file_4' => 'Dok. SPH3',
                ];

                foreach ($files as $fileKey => $label) {
                    if (!empty($row->$fileKey)) {
                        $dokumen .= '<span class="fa-sm">' . $label . ' : 
                                        <a href="' . asset('storage/uploads/' . basename($row->$fileKey)) . '" target="_blank">
                                            <span class="badge bg-primary">Lihat Dokumen</span>
                                        </a>
                                     </span><br />';
                    } else {
                        $dokumen .= '<span class="fa-sm text-danger">' . $label . ' : No File.</span><br />';
                    }
                }

                // Menyusun HTML
                return '
                <div style="padding: 10px; border-radius: 5px;">
                    <div class="fa-sm text-nowrap">' . htmlspecialchars($row->rating) . '</div>
                    <div style="font-size: 12px; padding: 2px 2px; border-radius: 3px; display: inline-block; margin-top: 15px;" class="text-nowrap">Link E-Katalog:</div>
                    <span class="fa-sm" style="font-size: 12px; padding: 2px 5px; border-radius: 3px; display: inline-block; margin-top: 5px;">
                        ' . $linkEcatalog . '
                    </span>
                    <div style="margin-top: 10px; color: #6c757d;">
                        ' . $dokumen . '
                    </div>
                </div>';
            })


            ->addColumn('action', function ($row) {
                // Cek apakah sesi level user adalah Administrator
                if (session('nama_level_user') == 'Administrator') {
                    return '
                <div class="demo-inline-spacing">
                    <div class="d-flex justify-content-start align-items-center gap-2">
                        <a href="' . route('validasi_modal_admins.edit', $row->id_rkbu) . '" class="btn btn-icon btn-primary waves-effect" data-bs-toggle="tooltip" title="Edit Data">
                            <span class="tf-icons mdi mdi-comment-edit"></span>
                        </a>
                        <a href="javascript:void(0);" onclick="showDetailRkbu(\'' . $row->id_rkbu . '\')" class="btn btn-icon btn-outline-info waves-effect" data-bs-toggle="tooltip" title="Detail Data">
                            <span class="tf-icons mdi mdi-file-document-alert-outline"></span>
                        </a>
                        <form action="' . route('validasi_modal_admins.destroy', $row->id_rkbu) . '" method="POST" class="delete-form">
                            ' . csrf_field() . method_field("DELETE") . '
                            <button type="button" class="btn btn-icon btn-outline-danger waves-effect delete-btn" data-bs-toggle="tooltip" title="Hapus Data">
                                <span class="tf-icons mdi mdi-delete-empty-outline"></span>
                            </button>
                        </form>
                    </div>
                </div>
                ';
                } else {
                    // Jika bukan Administrator, tampilkan tombol default (tanpa tombol detail)
                    return '
                <div class="demo-inline-spacing">
                    <div class="d-flex justify-content-start align-items-center gap-2">
                         <a href="javascript:void(0);" onclick="showDetailRkbu(\'' . $row->id_rkbu . '\')" class="btn btn-icon btn-outline-info waves-effect" data-bs-toggle="tooltip" title="Detail Data">
                            <span class="tf-icons mdi mdi-file-document-alert-outline"></span>
                        </a>
                    </div>
                </div>
                ';
                }
            })
            ->rawColumns(['action', 'quantity', 'barang', 'kategori_lengkap', 'status', 'sub_kategori', 'detail_anggaran', 'detail_usulan']);
    }


    public function query(Rkbu $model): QueryBuilder
    {

        $tahunAnggaran = Session::get('tahun_anggaran');
        $currentJenisKategori = request()->input('jenis_kategori_rkbu', [
            '9cf70e1d-18e7-40fe-bdd3-b7dabf61877d',
            '9cf70e31-9b9e-4dea-8b39-5459f23f3f51',
            '9cf70e44-a25e-462e-8bce-6fd930a91c0b'
        ]);

        $search = request()->input('search.value');  // Ambil parameter pencarian dari DataTable
        $subKategoriFilter = request()->input('sub_kategori_rkbu');
        $statusValidasiFilter = request()->input('id_status_validasi_rka');

        $query = $model->newQuery()
            ->join('users', 'rkbus.id_user', '=', 'users.id_user')
            ->join('ksps', 'users.id_ksp', '=', 'ksps.id_ksp')
            ->join('sub_kategori_rkbus', 'rkbus.id_sub_kategori_rkbu', '=', 'sub_kategori_rkbus.id_sub_kategori_rkbu')
            ->join('kategori_rkbus', 'sub_kategori_rkbus.id_kategori_rkbu', '=', 'kategori_rkbus.id_kategori_rkbu')
            ->join('jenis_kategori_rkbus', 'kategori_rkbus.id_jenis_kategori_rkbu', '=', 'jenis_kategori_rkbus.id_jenis_kategori_rkbu')
            ->join('rekening_belanjas', 'rekening_belanjas.id_kode_rekening_belanja', '=', 'rkbus.id_kode_rekening_belanja')
            ->join('aktivitas', 'aktivitas.id_aktivitas', '=', 'rekening_belanjas.id_aktivitas')
            ->join('sub_kegiatans', 'sub_kegiatans.id_sub_kegiatan', '=', 'aktivitas.id_sub_kegiatan')
            ->join('sumber_danas', 'sumber_danas.id_sumber_dana', '=', 'sub_kegiatans.id_sumber_dana')
            ->where('rkbus.nama_tahun_anggaran', $tahunAnggaran)
            ->whereIn('jenis_kategori_rkbus.id_jenis_kategori_rkbu', $currentJenisKategori);

        // 🔄 Filter Berdasarkan Sub Kategori
        if (!empty($subKategoriFilter)) {
            $query->where('sub_kategori_rkbus.id_sub_kategori_rkbu', $subKategoriFilter);
        }

        // 🔄 Filter Berdasarkan Status Validasi
        if (!empty($statusValidasiFilter)) {
            $query->where('rkbus.id_status_validasi_rka', $statusValidasiFilter);
        }

        // 🔍 Pencarian
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('rkbus.nama_barang', 'like', "%{$search}%")
                    ->orWhere('sub_kategori_rkbus.nama_sub_kategori_rkbu', 'like', "%{$search}%")
                    ->orWhere('kategori_rkbus.nama_kategori_rkbu', 'like', "%{$search}%")
                    ->orWhere('users.nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('ksps.nama_ksp', 'like', "%{$search}%");
            });
        }

        return $query->select([
            'rkbus.*',
            'users.nama_lengkap as user_name',
            'ksps.nama_ksp as ksp',
            'sub_kategori_rkbus.nama_sub_kategori_rkbu',
            'kategori_rkbus.nama_kategori_rkbu',
            'jenis_kategori_rkbus.nama_jenis_kategori_rkbu',
            'sumber_danas.nama_sumber_dana',
            DB::raw("CONCAT(sub_kategori_rkbus.kode_sub_kategori_rkbu,'. ', sub_kategori_rkbus.nama_sub_kategori_rkbu) as kategori_kode")
        ]);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('validasicontrollermodaladmin-table')
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

    public function getColumns(): array
    {
        return [
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => true],
            ['data' => 'sub_kategori', 'name' => 'sub_kategori', 'title' => 'Sub Kategori'],
            ['data' => 'barang', 'name' => 'barang', 'title' => 'Nama Barang dan Spek', 'orderable' => false, 'searchable' => true],
            ['data' => 'quantity', 'name' => 'quantity', 'title' => 'Quantity', 'orderable' => false, 'searchable' => true],
            ['data' => 'detail_anggaran', 'name' => 'detail_anggaran', 'title' => 'Detail Anggaran', 'orderable' => false, 'searchable' => true],
            ['data' => 'detail_anggaran', 'name' => 'detail_anggaran', 'title' => 'Detail Usulan', 'orderable' => false, 'searchable' => true],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status', 'orderable' => false, 'searchable' => true],
            ['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable' => true],
        ];
    }


    protected function filename(): string
    {
        return 'ValidasiControllerBarangJasaAdmin_' . date('YmdHis');
    }
}
