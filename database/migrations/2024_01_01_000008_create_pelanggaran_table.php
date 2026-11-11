<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelanggaran', function (Blueprint $table) {
            $table->string('id_pelanggaran', 20)->primary();
            $table->string('nisn', 20);
            $table->string('kode_pelanggaran', 10);
            $table->string('nip_pencatat', 20);
            $table->date('tanggal');
            $table->string('tahun_ajaran', 9);
            $table->enum('semester', ['ganjil', 'genap']);
            // Salinan poin saat dicatat, supaya riwayat tidak berubah
            // jika bobot di jenis_pelanggaran diubah kemudian.
            $table->integer('poin');
            // Hanya pelanggaran 'terverifikasi' yang dihitung ke total poin siswa.
            $table->enum('status', ['menunggu_verifikasi', 'terverifikasi', 'dalam_keberatan', 'dibatalkan'])
                ->default('terverifikasi');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('nisn')->references('nisn')->on('siswa')->onDelete('cascade');
            $table->foreign('kode_pelanggaran')->references('kode_pelanggaran')->on('jenis_pelanggaran');
            $table->foreign('nip_pencatat')->references('nip')->on('guru');

            $table->index(['nisn', 'tahun_ajaran', 'semester']);
            $table->index('tanggal');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggaran');
    }
};
