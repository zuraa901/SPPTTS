<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumen_pelanggaran', function (Blueprint $table) {
            $table->string('id_dokumen', 20)->primary();
            $table->string('id_pelanggaran', 20);
            $table->enum('jenis_dokumen', ['foto', 'video', 'catatan', 'lainnya']);
            $table->string('path_file', 255);

            $table->foreign('id_pelanggaran')->references('id_pelanggaran')->on('pelanggaran')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen_pelanggaran');
    }
};
