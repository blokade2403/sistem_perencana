<?php

namespace App\Http\Controllers;

use App\Models\RkbuHistory;
use Illuminate\Http\Request;

class RkbuHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rkbu_history = RkbuHistory::where('id_jenis_kategori_rkbu', '9cdfd354-e43a-4461-9747-e15fb74038ac')->get();
        return view('backend.history.index', compact('rkbu_history'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
