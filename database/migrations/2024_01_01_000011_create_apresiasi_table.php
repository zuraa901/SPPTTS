<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('apresiasi', function (Blueprint $table) {
            $table->string('id_apresiasi', 20)->primary();
            $table->string('nisn', 20);
            $table->string('kode_apresiasi', 10);
            $table->string('nip_pemberi', 20);
            $table->date('tanggal');
            $table->string('tahun_ajaran', 9);
            $table->enum('semester', ['ganjil', 'genap']);
            // Salinan poin saat diberikan (snapshot dari jenis_apresiasi).
            $table->integer('poin');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('nisn')->references('nisn')->on('siswa')->onDelete('cascade');
            $table->foreign('kode_apresiasi')->references('kode_apresiasi')->on('jenis_apresiasi');
            $table->foreign('nip_pemberi')->references('nip')->on('guru');

            $table->index(['nisn', 'tahun_ajaran', 'semester']);
            $table->index('tanggal');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apresiasi');
    }
};
