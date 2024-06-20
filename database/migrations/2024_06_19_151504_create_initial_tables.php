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
        Schema::create('divisi', function (Blueprint $table) {
            $table->string('id_divisi', 10)->primary();
            $table->string('nama_divisi', 30);
        });

        Schema::create('level', function (Blueprint $table) {
            $table->increments('id_level');
            $table->string('level', 10);
        });

        Schema::create('mesin', function (Blueprint $table) {
            $table->string('id_mesin', 10)->primary();
            $table->string('nama_mesin', 50);
            $table->string('merk_mesin', 20);
            $table->string('kapasitas', 10);
            $table->string('id_divisi', 10);
            $table->integer('tahun_pembuatan');
            $table->integer('periode_pakai');
        });

        Schema::create('perawatan', function (Blueprint $table) {
            $table->string('id_jadwal', 10)->primary();
            $table->string('tgl', 10);
            $table->string('id_divisi', 10);
            $table->string('id_mesin', 10);
            $table->string('id_teknisi', 10);
            $table->string('point_chek', 30);
            $table->string('tgl_jadwal', 10);
            $table->enum('status', ['Open', 'Closed', 'Waiting'])->default('Open');
        });

        Schema::create('perbaikan', function (Blueprint $table) {
            $table->string('id_perbaikan', 10)->primary();
            $table->string('tgl_buat', 10);
            $table->string('id_mesin', 10);
            $table->string('id_user', 10);
            $table->string('judul', 30);
            $table->string('keterangan', 30)->nullable();
            $table->string('id_teknisi', 10)->nullable();
            $table->string('id_sparepart', 10)->nullable();
            $table->enum('status', ['Open', 'Closed', 'Waiting'])->default('Open');
        });

        Schema::create('user', function (Blueprint $table) {
            $table->string('id_user', 9)->primary();
            $table->string('nama_user', 20);
            $table->string('password', 255);
            $table->string('id_divisi', 10);
            $table->enum('level', ['admin', 'user', 'teknisi'])->default('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divisi');
        Schema::dropIfExists('level');
        Schema::dropIfExists('mesin');
        Schema::dropIfExists('perawatan');
        Schema::dropIfExists('perbaikan');
        Schema::dropIfExists('user');
    }
};
