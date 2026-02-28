<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->integer('jumlah_partisipan')->nullable()->after('kuota');
            $table->dropColumn(['status', 'kuota']);
        });
    }

    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropColumn('jumlah_partisipan');
            $table->integer('kuota')->nullable();
            $table->enum('status', ['Akan Datang', 'Berlangsung', 'Selesai'])->default('Akan Datang');
        });
    }
};
