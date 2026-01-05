<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('rutes', function (Blueprint $table) {
            if (Schema::hasColumn('rutes', 'koordinat')) {
                $table->dropColumn('koordinat');
            }
        });
    }

    public function down()
    {
        Schema::table('rutes', function (Blueprint $table) {
            $table->text('koordinat')->nullable();
        });
    }
};
