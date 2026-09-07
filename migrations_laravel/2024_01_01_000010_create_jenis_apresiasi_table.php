<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_apresiasi', function (Blueprint $table) {
            $table->string('kode_apresiasi', 10)->primary();
            $table->string('nama_apresiasi', 100);
            $table->integer('poin');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_apresiasi');
    }
};
