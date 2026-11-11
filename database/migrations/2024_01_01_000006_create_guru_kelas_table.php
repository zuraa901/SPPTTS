<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guru_kelas', function (Blueprint $table) {
            $table->string('nip', 20);
            $table->string('kode_kelas', 10);
            $table->string('tahun_ajaran', 9);
            $table->enum('peran', ['wali_kelas', 'guru_mapel'])->default('guru_mapel');

            $table->primary(['nip', 'kode_kelas', 'tahun_ajaran']);
            $table->foreign('nip')->references('nip')->on('guru')->onDelete('cascade');
            $table->foreign('kode_kelas')->references('kode_kelas')->on('kelas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guru_kelas');
    }
};
