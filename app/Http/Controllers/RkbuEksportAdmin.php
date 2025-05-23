<?php

namespace App\Http\Controllers;

use App\Exports\RkbuExportAdmin;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RkbuEksportAdmin extends Controller
{
    public function downloadReport()
    {
        return Excel::download(new RkbuExportAdmin, 'rkbu_report.xlsx');
    }
}
