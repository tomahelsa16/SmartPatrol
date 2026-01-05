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
            if (Schema::hasColumn('robots', 'sensor')) {
                $table->dropColumn('sensor');
            }
            if (Schema::hasColumn('robots', 'environment_sensor')) {
                $table->dropColumn('environment_sensor');
            }
            if (Schema::hasColumn('robots', 'camera')) {
                $table->dropColumn('camera');
            }
            if (Schema::hasColumn('robots', 'infra_camera')) {
                $table->dropColumn('infra_camera');
            }
        });
    }

    public function down()
    {
        Schema::table('robots', function (Blueprint $table) {
            // Tambahkan default saat rollback
            $table->string('sensor')->nullable();
            $table->string('environment_sensor')->nullable();
            $table->string('camera')->nullable();
            $table->string('infra_camera')->nullable();
        });
    }
};
