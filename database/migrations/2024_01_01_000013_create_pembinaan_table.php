<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembinaan', function (Blueprint $table) {
            $table->string('id_pembinaan', 20)->primary();
            $table->string('nisn', 20);
            $table->string('nip_bk', 20);
            $table->date('tanggal');
            $table->text('catatan');
            $table->text('tindak_lanjut')->nullable();

            $table->foreign('nisn')->references('nisn')->on('siswa')->onDelete('cascade');
            $table->foreign('nip_bk')->references('nip')->on('guru');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembinaan');
    }
};
