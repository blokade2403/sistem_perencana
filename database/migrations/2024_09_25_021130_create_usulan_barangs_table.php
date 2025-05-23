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
        Schema::create('usulan_barangs', function (Blueprint $table) {
            $table->uuid('id_usulan_barang')->primary();
            $table->foreignUuid('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreignUuid('id_sub_kategori_rkbu')->references('id_sub_kategori_rkbu')->on('sub_kategori_rkbus')->onDelete('cascade');
            $table->foreignUuid('id_jenis_kategori_rkbu')->references('id_jenis_kategori_rkbu')->on('jenis_kategori_rkbus')->onDelete('cascade');
            $table->string('no_usulan_barang')->unique();
            $table->string('nama_pengusul_barang');
            $table->string('status_usulan_barang');
            $table->string('status_permintaan_barang');
            $table->string('tahun_anggaran', 4);
            $table->text('keterangan')->nullable();
            $table->text('keterangan_validasi_pengadaan')->nullable();

            // Mengubah tipe kolom tanggal menjadi tipe date
            $table->date('tanggal_konfirmasi')->nullable();
            $table->date('tanggal_validasi_pengadaan')->nullable();
            $table->date('tgl_validasi_perencana')->nullable();
            $table->date('tgl_validasi_kabag')->nullable();
            $table->date('tgl_validasi_direktur')->nullable();

            // Mengubah status validasi dan qrcode menjadi string dengan batasan panjang
            $table->string('status_validasi_usulan_barang', 20)->nullable();
            $table->string('status_validasi_pengadaan')->nullable();
            $table->string('status_validasi_perencana', 20)->nullable();
            $table->string('status_validasi_kabag', 20)->nullable();
            $table->string('status_validasi_direktur', 20)->nullable();
            $table->string('qrcode_pengusul', 255)->nullable();
            $table->string('qrcode_perencana', 255)->nullable();
            $table->string('qrcode_kabag', 255)->nullable();
            $table->string('qrcode_direktur', 255)->nullable();


            // Mengubah keterangan menjadi text agar lebih fleksibel
            $table->text('keterangan_perencana')->nullable();
            $table->text('keterangan_kabag')->nullable();
            $table->text('keterangan_direktur')->nullable();

            $table->uuid('nama_valid_perencana')->nullable(); // Add your field here
            $table->uuid('nama_valid_rka')->nullable(); // Add your field here
            $table->uuid('nama_valid_direktur')->nullable(); // Add your field here

            // Menambahkan validasi sebagai boolean
            $table->boolean('validasi_perencana')->default(false);
            $table->boolean('validasi_kabag')->default(false);
            $table->boolean('validasi_direktur')->default(false);
            $table->timestamps();

            // Definisi foreign key dengan nama tabel yang benar

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usulan_barangs');
    }
};
