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
        Schema::create('spareparts', function (Blueprint $table) {
            $table->string('id_sparepart', 10)->primary();
            $table->string('nama_sparepart', 50);
            $table->string('merk_sparepart', 20);
            $table->string('kapasitas', 10)->nullable();
            $table->string('id_divisi', 10);
            $table->year('tahun_pembuatan');
            $table->foreign('id_divisi')->references('id_divisi')->on('divisi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spareparts');
    }
};
