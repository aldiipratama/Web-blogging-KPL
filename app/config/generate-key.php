<?php
// scripts/generate-app-key.php
// Letakkan di folder scripts/ di root project Anda

// Path ke root project (level di atas scripts/)
$root_path = dirname(__DIR__);
$env_path = $root_path . '/../.env'; // Lokasi file .env yang diharapkan

echo "Generating new CSRF_SECRET_KEY and updating .env...\n";

// Generate kunci baru
$new_key = bin2hex(random_bytes(32));

$env_content = '';
$key_updated = false;

// 1. Cek apakah file .env sudah ada
if (file_exists($env_path)) {
    echo "Found existing .env file. Updating CSRF_SECRET_KEY...\n";
    $env_content = file_get_contents($env_path);

    $updated_lines = [];
    $lines = explode("\n", $env_content);

    foreach ($lines as $line) {
        // Jika baris ini adalah CSRF_SECRET_KEY, ganti dengan yang baru
        if (str_starts_with($line, 'CSRF_SECRET_KEY=')) {
            $updated_lines[] = "CSRF_SECRET_KEY=\"{$new_key}\"";
            $key_updated = true;
        } else {
            // Jika bukan, biarkan baris aslinya
            $updated_lines[] = $line;
        }
    }
    
    // Jika CSRF_SECRET_KEY belum ada di file yang sudah ada, tambahkan
    if (!$key_updated) {
        $updated_lines[] = "CSRF_SECRET_KEY=\"{$new_key}\"";
    }

    $updated_content = implode("\n", $updated_lines);

} else {
    // 2. Jika file .env belum ada, buat dengan template dasar
    echo "No .env file found. Creating a new .env file with default configuration...\n";
    $updated_content = <<<EOT
APP_NAME="Web Blogging KPL"
APP_ENV=development

DB_HOST=localhost
DB_USER=root
DB_PASS=""
DB_NAME=blog_db

BASEURL="http://tubes.test"

RECAPTCHA_SITE_KEY=""
RECAPTCHA_SECRET_KEY=""

CSRF_SECRET_KEY="{$new_key}"
EOT;
    $key_updated = true; // Karena sudah termasuk dalam template
}

// Hapus newline ekstra di akhir jika ada (akibat dari loop)
$updated_content = rtrim($updated_content, "\n");

// Tulis kembali konten yang sudah diperbarui ke file .env
if (file_put_contents($env_path, $updated_content) !== false) {
    echo "CSRF_SECRET_KEY updated/created in .env successfully!\n";
    echo "New Key: {$new_key}\n";
    echo "Remember to fill in RECAPTCHA_SITE_KEY and RECAPTCHA_SECRET_KEY in your .env file manually.\n";
} else {
    echo "Failed to write to .env file. Please check file permissions for: {$env_path}\n";
    exit(1); 
}

?>