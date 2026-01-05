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
        Schema::table('robots', function (Blueprint $table) {
            // Hapus kolom lama yang tidak dipakai
            if (Schema::hasColumn('robots', 'gps')) {
                $table->dropColumn('gps');
            }
            if (Schema::hasColumn('robots', 'rgb_camera')) {
                $table->dropColumn('rgb_camera');
            }

            // Pastikan fitur kolom JSON ada
            if (!Schema::hasColumn('robots', 'features')) {
                $table->json('features')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('robots', function (Blueprint $table) {
            $table->string('gps')->nullable();
            $table->string('rgb_camera')->nullable();
            $table->dropColumn('features');
        });
    }
};
