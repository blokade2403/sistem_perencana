<?php

namespace App\Http\Controllers;

use App\Exports\MasterSpjEksport as ExportsMasterSpjEksport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MasterSpjEksport extends Controller
{
    public function downloadReport()
    {
        return Excel::download(new ExportsMasterSpjEksport, 'spj_report.xlsx');
    }
}
