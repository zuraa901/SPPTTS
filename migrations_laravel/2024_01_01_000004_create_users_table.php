<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->enum('role', [
                'administrator',
                'kepala_sekolah',
                'wali_kelas',
                'kesiswaan',
                'guru_bk',
                'siswa',
            ]);
            $table->string('nip', 20)->nullable();
            $table->string('nisn', 20)->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('nip')->references('nip')->on('guru')->onDelete('set null');
            $table->foreign('nisn')->references('nisn')->on('siswa')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
