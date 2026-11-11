<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Klarifikasi / keberatan siswa atas pelanggaran yang dicatat.
        Schema::create('keberatan_pelanggaran', function (Blueprint $table) {
            $table->string('id_keberatan', 20)->primary();
            $table->string('id_pelanggaran', 20);
            $table->string('nisn', 20);
            $table->text('alasan');
            $table->date('tanggal_pengajuan');
            $table->enum('status', ['diajukan', 'diterima', 'ditolak'])->default('diajukan');
            $table->string('nip_penanggap', 20)->nullable();
            $table->text('tanggapan')->nullable();
            $table->date('tanggal_tanggapan')->nullable();
            $table->timestamps();

            $table->foreign('id_pelanggaran')->references('id_pelanggaran')->on('pelanggaran')->onDelete('cascade');
            $table->foreign('nisn')->references('nisn')->on('siswa')->onDelete('cascade');
            $table->foreign('nip_penanggap')->references('nip')->on('guru')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keberatan_pelanggaran');
    }
};
