<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Gantilah VARCHAR(255) sesuai tipe asli kolom penempatan_asset
        DB::statement("ALTER TABLE assets CHANGE penempatan_asset pengguna_asset VARCHAR(255)NULL");
    }

    public function down(): void
    {
        // Pastikan tipe data dikembalikan dengan benar
        DB::statement("ALTER TABLE assets CHANGE pengguna_asset penempatan_asset VARCHAR(255)NULL");
    }
};
