<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Request;

class Breadcrumb
{
    public static function generate()
    {
        // Ambil semua segmen URI
        $segments = Request::segments();
        $breadcrumb = [];

        $path = '';

        // Loop untuk setiap segmen URI
        foreach ($segments as $key => $segment) {
            // Buat URL dari segmen
            $path .= '/' . $segment;

            // Format teks segmen (huruf kapital setiap kata)
            $title = ucwords(str_replace('-', ' ', $segment));

            // Tambahkan setiap segmen ke array breadcrumb
            $breadcrumb[] = [
                'title' => $title,
                'url' => url($path)
            ];
        }

        return $breadcrumb;
    }
}
