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
            $table->string('status_hutang')->nullable()->after('tgl_verif_bendahara');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_spjs', function (Blueprint $table) {
            //
        });
    }
};
