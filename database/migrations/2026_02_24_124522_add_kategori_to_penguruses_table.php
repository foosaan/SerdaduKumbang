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
        Schema::table('pengurus', function (Blueprint $table) {
            $table->enum('kategori', ['BPH', 'Staff & Departemen'])->default('Staff & Departemen')->after('foto');
            $table->dropColumn('urutan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengurus', function (Blueprint $table) {
            $table->dropColumn('kategori');
            $table->integer('urutan')->default(0)->after('foto');
        });
    }
};
