<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('robots', function (Blueprint $table) {
            // Ubah / buat kolom features menjadi JSON nullable
            if (!Schema::hasColumn('robots', 'features')) {
                $table->json('features')->nullable()->after('robot_id');
            } else {
                $table->json('features')->nullable()->change();
            }
        });
    }

    public function down(): void
    {
        Schema::table('robots', function (Blueprint $table) {
            // Kalau mau di-rollback, boleh dihapus atau ubah kembali ke text
            // $table->text('features')->nullable()->change();
        });
    }
};
