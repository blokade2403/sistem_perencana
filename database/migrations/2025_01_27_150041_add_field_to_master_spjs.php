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
        Schema::table('master_spjs', function (Blueprint $table) {
            $table->string('status_pembayaran')->nullable()->after('status_verifikasi_direktur');
            $table->string('upload_spj_1')->nullable()->after('foto_barang_datang_3');
            $table->string('upload_spj_2')->nullable()->after('foto_barang_datang_3');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_spjs', function (Blueprint $table) {
            $table->dropColumn(['status_pembayaran', 'upload_spj_1', 'upload_spj_2']);
        });
    }
};
