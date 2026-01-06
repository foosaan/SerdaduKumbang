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
        Schema::table('status_forms', function (Blueprint $table) {
            $table->integer('gelombang_aktif')->default(1)->after('tanggal_tutup');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('status_forms', function (Blueprint $table) {
            $table->dropColumn('gelombang_aktif');
        });
    }
};
