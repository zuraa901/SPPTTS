<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->string('nisn', 20)->primary();
            $table->string('nama', 100);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('alamat', 255)->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->year('tahun_masuk');
            $table->enum('status_sp', ['normal', 'SP1', 'SP2', 'SP3'])->default('normal');
            $table->integer('total_poin_pelanggaran')->default(0);
            $table->integer('total_poin_apresiasi')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
