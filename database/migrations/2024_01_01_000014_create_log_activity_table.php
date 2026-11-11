<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_activity', function (Blueprint $table) {
            $table->id('id_log');
            $table->string('username', 50);
            $table->string('aksi', 100);
            $table->text('keterangan')->nullable();
            $table->dateTime('waktu');

            // Sengaja tanpa foreign key: log audit harus tetap ada
            // meskipun akun pengguna dihapus.
            $table->index('username');
            $table->index('waktu');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_activity');
    }
};
