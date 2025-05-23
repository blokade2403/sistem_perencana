<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sub_kategori_rkbus', function (Blueprint $table) {
            $table->enum('status', ['aktif', 'tidak aktif'])->after('nama_sub_kategori_rkbu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_kategori_rkbus', function (Blueprint $table) {
            //
        });
    }
};
