<div class="container mx-auto p-4 flex justify-center items-center min-h-[calc(100vh-160px)]">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login Penulis</h2>

        <?php Flasher::flash(); ?>

        <form action="<?= BASEURL; ?>/auth/processLogin" method="POST">
            <?php CSRF::field(); ?>
            
            <input type="hidden" name="<?= CSRF::getTokenFieldName(); ?>" value="<?= $data['csrf_token']; ?>">

            <div class="mb-4">
                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
                <input type="text" id="username" name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan username Anda" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" placeholder="********" required>
            </div>

            <div class="mb-6 flex justify-center">
                <div class="g-recaptcha" data-sitekey="<?= RECAPTCHA_SITE_KEY; ?>"></div>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Login
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="<?= BASEURL; ?>/auth/register">
                    Belum punya akun? Daftar di sini.
                </a>
            </div>
        </form>
    </div>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>