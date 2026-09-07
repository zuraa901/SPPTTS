<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_perjanjian', function (Blueprint $table) {
            $table->string('id_sp', 20)->primary();
            $table->string('nisn', 20);
            $table->enum('jenis_sp', ['SP1', 'SP2', 'SP3']);
            $table->date('tanggal_terbit');
            $table->string('nip_pembuat', 20);
            $table->string('path_file', 255)->nullable();
            $table->text('keterangan')->nullable();

            $table->foreign('nisn')->references('nisn')->on('siswa')->onDelete('cascade');
            $table->foreign('nip_pembuat')->references('nip')->on('guru');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_perjanjian');
    }
};
