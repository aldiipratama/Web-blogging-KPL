<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FrontendLab</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-100">

    <!-- Navbar -->
    <?php include(__DIR__ . '/../../../components/navbar.php'); ?>

    <main class="flex-grow flex justify-center items-center">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
            <h2 class="text-2xl font-semibold text-center text-black mb-6">Login</h2>
            <form action="/login" method="">
                <div class="mb-4">
                    <label for="email" class="block text-sm text-black">Email</label>
                    <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded mt-1"
                        placeholder="Masukkan Email" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm text-black">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full p-2 border border-gray-300 rounded mt-1" placeholder="Masukkan Password" required>
                </div>

                <button type="submit"
                    class="w-full bg-black text-white py-2 rounded hover:bg-gray-800 transition duration-200">Login</button>
            </form>

            <p class="text-center text-sm text-gray-600 mt-4">
                <a href="#" class="text-cyan-700 hover:underline italic">Lupa Password</a>
            </p>
            <p class="text-center text-sm text-gray-600 mt-4">
                Belum Punya akun? <a href="../Register/register.php"
                    class="text-red-600 hover:underline italic">Register</a>
            </p>
        </div>
    </main>

    <!-- Footer -->
    <?php include(__DIR__ . '/../../../components/footer.php'); ?>

</body>

</html>