<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First update existing 'Agenda' records to 'Kegiatan'
        DB::table('informasis')->where('kategori', 'Agenda')->update(['kategori' => 'Kegiatan']);
        
        // Then modify the enum column
        DB::statement("ALTER TABLE informasis MODIFY kategori ENUM('Pendaftaran', 'Kegiatan', 'Lainnya') DEFAULT 'Pendaftaran'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE informasis MODIFY kategori ENUM('Pendaftaran', 'Kegiatan', 'Agenda', 'Lainnya') DEFAULT 'Pendaftaran'");
    }
};
