<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FrontendLab</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<!-- Navbar -->
<?php include(__DIR__ . '/../../components/navbar.php'); ?>

<body class="bg-gray-100">

    <!-- Content Placeholder -->
    <div class="max-w-screen-xl mx-auto mt-4">
        <img src="/img/laptop.png" alt="Laptop" class="w-full rounded-lg shadow-lg">
    </div>
    <main class="max-w-screen-xl mx-auto py-8">
        <h2 class="text-2xl font-bold">Tutorial HTML Pemula</h2>
        <p class="mt-2 text-gray-700">
            HTML diciptakan oleh Sir Tim Berners-lee pada akhir tahun 1991 namun tidak dirilis secara resmi.
            Sir Tim Berners-lee merilis HTML versi pertama pada tahun 1993 dengan tujuan untuk berbagi informasi
            yang dapat dibaca dan diakses melalui web browser. Hingga saat ini versi HTML sudah mencapai versi 5
            yang dirilis pada tahun 2012, Versi HTML 5 ini merupakan terusan dari perpanjangan versi HTML 4.01 yang
            sebelumnya digunakan oleh kebanyakan orang. HTML adalah singkatan dari Hypertext Markup Language, HTML
            merupakan salah satu bahasa pengkodean atau pemrograman yang digunakan untuk membuat halaman website.
        </p>
    </main>

    <!-- Konten Baru dengan Background Hitam -->
    <div class="bg-black text-white text-center py-8">
        <h2 class="text-2xl font-bold">Tutorial Mas Aldi yang lainnya</h2>
        <p class="mt-2">Ini adalah konten tambahan di dalam div berwarna hitam.</p>
    </div>
</body>

<!-- Footer -->
<?php include(__DIR__ . '/../../components/footer.php'); ?>