<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('insiden', function (Blueprint $table) {
            $table->id();
            $table->timestamp('waktu');
            $table->string('area'); // 2 Titik lokasi
            $table->string('informasi'); // Ringkasan singkat
            $table->text('keterangan')->nullable(); // Detail
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insiden');
    }
};
