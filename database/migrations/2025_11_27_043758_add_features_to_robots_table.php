<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan kolom features sebagai JSON.
     */
    public function up(): void
    {
        Schema::table('robots', function (Blueprint $table) {
            // Tambahkan kolom hanya jika belum ada
            if (!Schema::hasColumn('robots', 'features')) {
                $table->json('features')->nullable()->after('robot_id');
            }
        });
    }

    /**
     * Hapus kolom features (rollback).
     */
    public function down(): void
    {
        Schema::table('robots', function (Blueprint $table) {
            if (Schema::hasColumn('robots', 'features')) {
                $table->dropColumn('features');
            }
        });
    }
};
