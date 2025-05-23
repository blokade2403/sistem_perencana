<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileController extends Controller
{
    public function download($filename): BinaryFileResponse
    {
        // Pastikan file berada di folder `storage/app/public`
        $path = storage_path('app/public/download/' . $filename);

        // Cek apakah file ada
        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Kirim file untuk didownload
        return response()->download($path, $filename);
    }
}
