<?php

return [

    /*
    |--------------------------------------------------------------------------
    | QR Code Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can configure the settings for your QR Code generation.
    |
    */

    'default' => [
        'size' => 200, // Ukuran QR Code
        'format' => 'png', // Format output (png, svg, etc.)
        'error_correction' => 'L', // Tingkat kesalahan
    ],

    // Pengaturan lain bisa ditambahkan di sini
];
