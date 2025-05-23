<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\RkbuExportKsp;
use Maatwebsite\Excel\Facades\Excel;

class RkbuEksportKsp extends Controller
{
    public function downloadReport()
    {
        return Excel::download(new RkbuExportKsp, 'rkbu_report.xlsx');
    }
}
