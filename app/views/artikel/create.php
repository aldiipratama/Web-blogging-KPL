<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Buat Artikel Baru</h1>

    <?php Flasher::flash(); ?>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="<?= BASEURL; ?>/artikel/store" method="POST">
            <?php CSRF::field(); ?>
            
            <input type="hidden" name="<?= CSRF::getTokenFieldName(); ?>" value="<?= $data['csrf_token']; ?>">

            <div class="mb-4">
                <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul Artikel:</label>
                <input type="text" id="judul" name="judul" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan judul artikel" required>
            </div>

            <div class="mb-4">
                <label for="gambar_url" class="block text-gray-700 text-sm font-bold mb-2">URL Gambar Pelengkap (Opsional):</label>
                <input type="url" id="gambar_url" name="gambar_url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Contoh: http://example.com/gambar.jpg">
            </div>

            <div class="mb-4">
                <label for="isi_artikel" class="block text-gray-700 text-sm font-bold mb-2">Isi Artikel (Rich Text):</label>
                <textarea id="isi_artikel" name="isi_artikel" rows="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Tulis isi artikel Anda di sini..." required></textarea>
            </div>

            <div class="mb-6">
                <label for="kata_kunci" class="block text-gray-700 text-sm font-bold mb-2">Kata Kunci (Dipisahkan koma, Opsional):</label>
                <input type="text" id="kata_kunci" name="kata_kunci" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Contoh: berita, teknologi, tutorial">
            </div>

            <div class="mb-6">
                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status Publikasi:</label>
                <select id="status" name="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="draft">Draft</option>
                    <option value="published">Publikasikan</option>
                </select>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Terbitkan Artikel
                </button>
                <a href="<?= BASEURL; ?>/dashboard" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>