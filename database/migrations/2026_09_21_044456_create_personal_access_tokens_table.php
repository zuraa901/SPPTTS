<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->enum('status_sp', ['normal', 'SP1', 'SP2', 'SP3', 'DO'])
                ->default('normal')
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->enum('status_sp', ['normal', 'SP1', 'SP2', 'SP3'])
                ->default('normal')
                ->change();
        });
    }
};