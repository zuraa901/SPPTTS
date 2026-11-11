<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ambang batas poin dan sanksi bertahap, bisa diubah tanpa mengubah kode.
        Schema::create('aturan_sanksi', function (Blueprint $table) {
            $table->id();
            $table->integer('batas_poin')->unique();
            $table->string('nama_sanksi', 100);
            // Status SP yang diberikan saat batas tercapai (null = hanya pembinaan).
            $table->enum('status_sp', ['SP1', 'SP2', 'SP3'])->nullable();
            $table->text('tindakan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aturan_sanksi');
    }
};
