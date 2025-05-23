<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->string('penanggung_jawab')->nullable()->after('foto');
            $table->string('hibah')->nullable()->after('penanggung_jawab');
            $table->string('sumber_anggaran')->nullable()->after('hibah');
            $table->string('status_reklas_arb')->nullable()->after('sumber_anggaran');
            $table->string('kategori_asset_bergerak')->nullable()->after('status_reklas_arb');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn([
                'penanggung_jawab',
                'hibah',
                'sumber_anggaran',
                'status_reklas_arb',
                'kategori_asset_bergerak',
            ]);
        });
    }
};
