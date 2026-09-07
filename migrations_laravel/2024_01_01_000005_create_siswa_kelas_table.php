<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa_kelas', function (Blueprint $table) {
            $table->string('nisn', 20);
            $table->string('kode_kelas', 10);
            $table->string('tahun_ajaran', 9);

            $table->primary(['nisn', 'kode_kelas', 'tahun_ajaran']);
            $table->foreign('nisn')->references('nisn')->on('siswa')->onDelete('cascade');
            $table->foreign('kode_kelas')->references('kode_kelas')->on('kelas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa_kelas');
    }
};
