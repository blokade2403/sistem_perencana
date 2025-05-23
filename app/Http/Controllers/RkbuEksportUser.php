<?php

namespace App\Http\Controllers;

use App\Exports\RkbuExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RkbuEksportUser extends Controller
{
    public function downloadReport()
    {
        return Excel::download(new RkbuExport, 'rkbu_report.xlsx');
    }
}
