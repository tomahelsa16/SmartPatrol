<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('penugasans', function (Blueprint $table) {

            // =============
            // Drop foreign key SAFE MODE
            // =============

            $fkList = [
                'titik_1',
                'titik_2',
                'titik_3',
                'titik_4',
                'titik_5',
                'titik_6'
            ];

            foreach ($fkList as $col) {
                if (Schema::hasColumn('penugasans', $col)) {
                    // Coba drop FK kalau ada
                    try {
                        $table->dropForeign(['' . $col . '']);
                    } catch (\Exception $e) { /* abaikan */
                    }
                }
            }

            // =============
            // Drop columns SAFE MODE
            // =============

            foreach ($fkList as $col) {
                if (Schema::hasColumn('penugasans', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }

    public function down()
    {
        Schema::table('penugasans', function (Blueprint $table) {
            $table->unsignedBigInteger('titik_1')->nullable();
            $table->unsignedBigInteger('titik_2')->nullable();
            $table->unsignedBigInteger('titik_3')->nullable();
            $table->unsignedBigInteger('titik_4')->nullable();
            $table->unsignedBigInteger('titik_5')->nullable();
            $table->unsignedBigInteger('titik_6')->nullable();
        });
    }
};
