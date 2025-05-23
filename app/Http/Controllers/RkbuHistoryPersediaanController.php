<?php

namespace App\Http\Controllers;

use App\Models\RkbuHistory;
use Illuminate\Http\Request;

class RkbuHistoryPersediaanController extends Controller
{
    public function index()
    {
        $rkbu_history = RkbuHistory::where('id_jenis_kategori_rkbu', '9cdfd364-2946-4ea1-bec2-e1130e8d9f2c')->get();
        return view('backend.history.index_persediaan', compact('rkbu_history'));
    }
}
