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
            $table->date('tanggal_buka')->nullable();
            $table->date('tanggal_tutup')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('status_forms', function (Blueprint $table) {
            $table->dropColumn(['tanggal_buka', 'tanggal_tutup']);
        });
    }
};
