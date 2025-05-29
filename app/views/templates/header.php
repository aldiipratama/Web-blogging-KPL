<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?> | Web Blogging KPL</title>
    <link href="<?= BASEURL; ?>/css/style.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <header class="bg-white shadow-md p-4">
        <nav class="container mx-auto flex justify-between items-center">
            <a href="<?= BASEURL . "/"; ?>" class="text-xl font-bold text-gray-800">Web Blogging KPL</a>
            <div class="space-x-4">
                <a href="<?= BASEURL; ?>/artikel" class="text-gray-600 hover:text-gray-900">Artikel Publik</a>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <a href="<?= BASEURL; ?>/dashboard" class="text-gray-600 hover:text-gray-900">Dashboard</a>
                    <a href="<?= BASEURL; ?>/dashboard/comments" class="text-gray-600 hover:text-gray-900">Moderasi Komentar</a>
                    <a href="<?= BASEURL; ?>/auth/logout" class="text-red-500 hover:text-red-700">Logout (<?= $_SESSION['username']; ?>)</a>
                <?php else : ?>
                    <a href="<?= BASEURL; ?>/auth/login" class="text-gray-600 hover:text-gray-900">Login</a>
                    <a href="<?= BASEURL; ?>/auth/register" class="text-gray-600 hover:text-gray-900">Register</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <main class="container mx-auto mt-4 p-4"></main>