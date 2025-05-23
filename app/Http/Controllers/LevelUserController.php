<?php

namespace App\Http\Controllers;

use App\Models\LevelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LevelUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $level_users = LevelUser::all();
        return view('backend.setting_user.level_users.index', compact('level_users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.setting_user.level_users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['nama_level_user'    => 'required'],
            ['nama_level_user'    => 'Nama level_user Harus di Isi']
        );

        if ($validator->fails()) {
            // Mengambil semua pesan error
            $errors = $validator->errors();
            // dd($errors);
            // Menyusun pesan error menjadi string
            $errorMessages = implode(' ', $errors->all());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
        }

        // dd($request);

        $level_user = new LevelUser(['nama_level_user'   => $request->nama_level_user]);
        $level_user->save();
        return redirect()->route('level_users.index')->with('success', 'Nama level_user Delete Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(LevelUser $level_user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LevelUser $level_user)
    {
        // $level_user = LevelUser::all();
        return view('backend.setting_user.level_users.edit', compact('level_user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LevelUser $level_user)
    {
        $validator = Validator::make(
            $request->all(),
            ['nama_level_user'    => 'required'],
            ['nama_level_user'    => 'Nama level_user Harus di Isi']
        );

        if ($validator->fails()) {
            // Mengambil semua pesan error
            $errors = $validator->errors();

            // Menyusun pesan error menjadi string
            $errorMessages = implode(' ', $errors->all());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Ada kesalahan pada input Anda, mohon periksa kembali: ' . $errorMessages);
        }

        // dd($request);

        $level_user->update($request->all());
        return redirect()->route('level_users.index')->with('success', 'Nama level_user Delete Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LevelUser $level_user)
    {
        $level_user->delete();

        return redirect()->route('level_users.index')
            ->with('success', 'Level User deleted successfully.');
    }
}
