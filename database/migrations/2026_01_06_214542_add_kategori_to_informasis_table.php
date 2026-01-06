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
        Schema::table('informasis', function (Blueprint $table) {
            $table->enum('kategori', ['Pendaftaran', 'Kegiatan', 'Agenda', 'Lainnya'])->default('Pendaftaran')->after('judul');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('informasis', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }
};
