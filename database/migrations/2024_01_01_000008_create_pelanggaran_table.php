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
            $table->text('catatan')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('nisn')->references('nisn')->on('siswa')->onDelete('cascade');
            $table->foreign('kode_pelanggaran')->references('kode_pelanggaran')->on('jenis_pelanggaran');
            $table->foreign('nip_pencatat')->references('nip')->on('guru');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggaran');
    }
};
