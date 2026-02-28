<?php
// === TEMPORARY DEPLOY SCRIPT - DELETE AFTER USE ===
set_time_limit(300);
echo '<pre>';

$base = __DIR__ . '/../serdadukumbang';
chdir($base);

// 1. Fix permissions & create directories
echo "=== Setting Permissions ===\n";
$dirs = [
    'storage', 'storage/app', 'storage/app/public',
    'storage/app/public/berkas', 'storage/app/public/foto',
    'storage/app/public/dokumen',
    'storage/app/public/cv', 'storage/app/public/follow_ig',
    'storage/app/public/follow_tiktok', 'storage/app/public/portofolio',
    'storage/framework', 'storage/framework/cache',
    'storage/framework/cache/data', 'storage/framework/sessions',
    'storage/framework/views', 'storage/logs',
    'bootstrap/cache',
];
foreach ($dirs as $dir) {
    $path = "$base/$dir";
    if (!is_dir($path)) { mkdir($path, 0775, true); echo "Created: $dir\n"; }
    else { chmod($path, 0775); echo "Set 775: $dir\n"; }
}

// 2. Fix storage symlink in public_html
echo "\n=== Storage Symlink ===\n";
$link = __DIR__ . '/storage';
$target = "$base/storage/app/public";
if (is_link($link)) { unlink($link); }
if (is_dir($link) && !is_link($link)) { rename($link, $link . '_bak'); }
if (!file_exists($link)) {
    symlink($target, $link);
    echo "Created: public_html/storage -> $target\n";
} else {
    echo "Symlink already exists\n";
}

// 3. Run artisan commands
$commands = [
    'php artisan migrate --force',
    'php artisan db:seed --force',
];

foreach ($commands as $cmd) {
    echo "\n=== $cmd ===\n";
    exec("$cmd 2>&1", $output, $code);
    echo implode("\n", $output) . "\n";
    echo "Exit code: $code\n";
    $output = [];
}

echo "\n=== PHP Info ===\n";
echo 'CLI: '; exec("php -v 2>&1", $o); echo $o[0] . "\n"; $o = [];
echo 'Web: ' . PHP_VERSION . "\n";

echo "\n\n========================================\n";
echo "DONE! HAPUS FILE deploy.php SEKARANG!\n";
echo "========================================\n";
echo '</pre>';
