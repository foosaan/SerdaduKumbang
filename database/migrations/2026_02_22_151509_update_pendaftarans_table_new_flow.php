<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            // Data Diri - new fields
            $table->string('asal_instansi')->nullable()->after('no_hp');
            $table->date('tanggal_lahir')->nullable()->after('asal_instansi');

            // Dokumen uploads (replace single 'berkas')
            $table->string('cv')->nullable()->after('alamat');
            $table->string('follow_ig')->nullable()->after('cv');
            $table->string('follow_tiktok')->nullable()->after('follow_ig');
            $table->string('portofolio')->nullable()->after('follow_tiktok');

            // Divisi selection
            $table->string('sumber_info')->nullable()->after('portofolio');
            $table->text('motivasi')->nullable()->after('sumber_info');
            $table->string('pilihan_1')->nullable()->after('motivasi');
            $table->text('alasan_1')->nullable()->after('pilihan_1');
            $table->string('pilihan_2')->nullable()->after('alasan_1');
            $table->text('alasan_2')->nullable()->after('pilihan_2');
            $table->boolean('bersedia_divisi_lain')->default(false)->after('alasan_2');

            // Make old berkas nullable (will be deprecated)
            $table->string('berkas')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropColumn([
                'asal_instansi', 'tanggal_lahir',
                'cv', 'follow_ig', 'follow_tiktok', 'portofolio',
                'sumber_info', 'motivasi',
                'pilihan_1', 'alasan_1', 'pilihan_2', 'alasan_2',
                'bersedia_divisi_lain',
            ]);
        });
    }
};
