<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('assets', function (Blueprint $table) {
            if (!Schema::hasColumn('assets', 'hibah')) {
                $table->string('hibah')->nullable()->after('id_penempatan');
            }

            if (!Schema::hasColumn('assets', 'sumber_anggaran')) {
                $table->string('sumber_anggaran')->nullable()->after('hibah');
            }

            if (!Schema::hasColumn('assets', 'status_reklas_arb')) {
                $table->string('status_reklas_arb')->nullable()->after('sumber_anggaran');
            }

            if (!Schema::hasColumn('assets', 'kategori_asset_bergerak')) {
                $table->string('kategori_asset_bergerak')->nullable()->after('status_reklas_arb');
            }

            if (!Schema::hasColumn('assets', 'id_penempatan')) {
                $table->foreignUuid('id_penempatan')->nullable()->after('foto')
                    ->constrained('penempatans', 'id_penempatan')
                    ->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropForeign(['id_penempatan']);
            $table->dropColumn([
                'id_penempatan',
            ]);

            // Jika ingin kembalikan penanggung_jawab
            $table->string('penanggung_jawab')->nullable()->after('foto');
        });
    }
};
