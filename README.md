# Tugas Keamanan Perangkat Lunak

[![PHP Version](https://img.shields.io/badge/PHP-8.1%2B-blue.svg)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/Database-MySQL-orange.svg)](https://www.mysql.com/)
[![Tailwind CSS](https://img.shields.io/badge/CSS-TailwindCSS-06B6D4.svg)](https://tailwindcss.com/)

Proyek ini adalah sistem blog sederhana yang dibangun menggunakan **PHP Native** dengan arsitektur **Model-View-Controller (MVC)**, tanpa menggunakan framework PHP apa pun. Dirancang untuk memahami fundamental PHP dan praktik keamanan web dasar, proyek ini juga mengimplementasikan styling dengan **Tailwind CSS**.

## Instalasi Cepat

Proyek ini dirancang untuk kemudahan instalasi.

### Prasyarat

* PHP (misalnya: >= 8.0)
* Composer
* Node.js & NPM
* Web Server (Apache, Nginx, atau server PHP bawaan)
* Database (MySQL, PostgreSQL, dll. - jika digunakan)

### Langkah-langkah

1.  **Clone Repositori**
    ```bash
    git clone [https://github.com/aldiipratama/Web-blogging-KPL.git](https://github.com/aldiipratama/Web-blogging-KPL.git)
    cd Web-blogging-KPL
    ```

2.  **Instalasi & Setup Otomatis**
    Jalankan skrip berikut. Skrip ini akan:
    * Menginstal dependensi Node.js (`npm i`)
    * Mengupdate dependensi PHP (`composer update`)
    * Membuat file `.env` (jika belum ada)

    ```bash
    npm run start
    ```

3.  **Konfigurasi Tambahan (Penting!)**
    Setelah `npm run start` selesai, buka file `.env` yang telah dibuat.
    **Anda WAJIB menyesuaikan konfigurasi database** (seperti `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) dan variabel lingkungan lainnya agar sesuai dengan pengaturan lokal Anda.

    Contoh isi `.env` yang mungkin perlu disesuaikan:
    ```env
    APP_NAME="Web Blogging KPL"
    APP_ENV=development

    DB_HOST=localhost
    DB_USER=username_database_anda_disini
    DB_PASS=password_database_anda_disini
    DB_NAME=nama_database_anda_disini

    BASEURL="http://tubes.test"

    RECAPTCHA_SITE_KEY="kunci-recaptcha-disini"
    RECAPTCHA_SECRET_KEY="kunci-rahasia-recaptcha-disini"

    CSRF_SECRET_KEY="" generate otomatis menggunakan npm run key:generate
    ```

4.  **Build & Jalankan Tailwind CSS (Untuk Development)**
    * Untuk build awal atau sekali build:
        ```bash
        npm run tailwind:build
        ```
    * Untuk memantau perubahan dan otomatis build saat development:
        ```bash
        npm run tailwind:watch
        ```

## Struktur Proyek

```
.
├── app/
│   ├── config/              # Konfigurasi aplikasi (misal: dimuat dari .env, kunci reCAPTCHA)
│   ├── controllers/         # Logika aplikasi (Home, Artikel, Auth, Dashboard, NotFound)
│   ├── core/                # Core framework (App, Controller, Database, CSRF, Log, Flasher)
│   ├── models/              # Interaksi dengan database (Artikel_model, User_model, Komentar_model)
│   └── views/               # Tampilan UI (HTML dengan Tailwind CSS)
│       ├── 404/             # Halaman 404 Not Found
│       ├── artikel/         # Tampilan terkait artikel
│       ├── auth/            # Tampilan autentikasi
│       ├── dashboard/       # Tampilan dashboard penulis
│       ├── home/            # Tampilan halaman utama
│       └── templates/       # Header & footer (layout dasar)
├── public/                  # Document Root web server (file yang bisa diakses publik)
│   ├── css/                 # File CSS (termasuk output Tailwind)
│   ├── js/                  # File JavaScript
│   ├── img/                 # Folder gambar
│   └── index.php            # Single entry point aplikasi
├── scripts/                 # Script CLI kustom (misal: generate-app-key.php)
├── vendor/                  # Dependensi Composer (otomatis digenerate)
├── .env                     # File konfigurasi lingkungan (TIDAK DI-COMMIT!)
├── .gitignore               # File yang diabaikan Git
├── composer.json            # Definisi dependensi Composer
├── composer.lock            # Kunci versi dependensi Composer
├── package.json             # Definisi dependensi NPM & skrip
├── tailwind.config.js       # Konfigurasi Tailwind CSS
└── README.md                # Dokumentasi proyek ini
```