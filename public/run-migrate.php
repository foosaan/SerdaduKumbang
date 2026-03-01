<?php
/**
 * Jalankan file ini via browser: https://serdadukumbang.biz.id/run-migrate.php
 * HAPUS FILE INI SETELAH SELESAI!
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

echo "<h2>🔧 Menjalankan Migrasi: add_dokumentasi_to_kegiatans_table</h2>";

try {
    if (Schema::hasColumn('kegiatans', 'dokumentasi')) {
        echo "<p style='color:orange;'>⚠️ Kolom <strong>dokumentasi</strong> sudah ada di tabel kegiatans. Tidak perlu migrasi lagi.</p>";
    } else {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->json('dokumentasi')->nullable()->after('gambar');
        });
        echo "<p style='color:green;'>✅ Kolom <strong>dokumentasi</strong> berhasil ditambahkan ke tabel kegiatans!</p>";
    }
} catch (\Exception $e) {
    echo "<p style='color:red;'>❌ Error: " . $e->getMessage() . "</p>";
}

echo "<br><p><strong>⚠️ PENTING:</strong> Hapus file <code>run-migrate.php</code> ini dari hosting setelah selesai!</p>";
