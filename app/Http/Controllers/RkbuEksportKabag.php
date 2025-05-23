<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\RkbuExportKabag;
use Maatwebsite\Excel\Facades\Excel;

class RkbuEksportKabag extends Controller
{
    public function downloadReport()
    {
        return Excel::download(new RkbuExportKabag, 'rkbu_report.xlsx');
    }
}
