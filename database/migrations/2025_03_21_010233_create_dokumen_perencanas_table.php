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
        Schema::create('dokumen_perencanas', function (Blueprint $table) {
            $table->uuid('id_dokumen_perencana')->primary();
            $table->foreignUuid('id_kategori_upload_dokumen')->references('id_kategori_upload_dokumen')->on('kategori_upload_dokumens')->onDelete('cascade');
            $table->string('nama_dokumen_perencana')->nullable();
            $table->enum('status_dokumen', ['aktif', 'tidak aktif']); // menggunakan enum untuk status_user
            $table->string('upload_file')->nullable(); // menggunakan enum untuk status_user
            $table->string('tahun_dokumen')->nullable(); // menggunakan enum untuk status_user
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_perencanas');
    }
};
