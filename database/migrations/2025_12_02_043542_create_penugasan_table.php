<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penugasans', function (Blueprint $table) {
            $table->id();

            // Relasi ke robot
            $table->foreignId('robot_id')->constrained('robots')->onDelete('cascade');

            // Titik rute (6 titik maksimal)
            $table->foreignId('titik_1')->constrained('rutes')->onDelete('cascade');
            $table->foreignId('titik_2')->nullable()->constrained('rutes')->nullOnDelete();
            $table->foreignId('titik_3')->nullable()->constrained('rutes')->nullOnDelete();
            $table->foreignId('titik_4')->nullable()->constrained('rutes')->nullOnDelete();
            $table->foreignId('titik_5')->nullable()->constrained('rutes')->nullOnDelete();
            $table->foreignId('titik_6')->nullable()->constrained('rutes')->nullOnDelete();

            $table->dateTime('waktu_operasional');
            $table->string('status')->default('Menunggu'); // Menunggu, Berlangsung, Selesai

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penugasans');
    }
};
