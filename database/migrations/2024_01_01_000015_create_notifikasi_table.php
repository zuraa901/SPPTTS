<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id('id_notif');
            $table->string('nisn', 20);
            $table->text('pesan');
            $table->boolean('dibaca')->default(false);
            $table->dateTime('waktu');

            $table->foreign('nisn')->references('nisn')->on('siswa')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
