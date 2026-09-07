<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->string('kode_kelas', 10)->primary();
            $table->integer('tingkat');
            $table->string('jurusan', 20);
            $table->string('nama_kelas', 20);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
