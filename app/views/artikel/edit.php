<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Ubah Artikel: <span class="text-blue-600"><?= $data['artikel']['judul']; ?></span></h1>

    <?php Flasher::flash(); ?>

    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <form action="<?= BASEURL; ?>/artikel/update" method="POST">
            <?php CSRF::field(); ?>
            
            <input type="hidden" name="<?= CSRF::getTokenFieldName(); ?>" value="<?= $data['csrf_token']; ?>">
            <input type="hidden" name="id" value="<?= $data['artikel']['id']; ?>">
            <input type="hidden" name="artikel_slug_lama" value="<?= $data['artikel']['slug']; ?>"> <div class="mb-4">
                <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul Artikel:</label>
                <input type="text" id="judul" name="judul" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?= htmlspecialchars($data['artikel']['judul']); ?>" required>
            </div>

            <div class="mb-4">
                <label for="gambar_url" class="block text-gray-700 text-sm font-bold mb-2">URL Gambar Pelengkap (Opsional):</label>
                <input type="url" id="gambar_url" name="gambar_url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?= htmlspecialchars($data['artikel']['gambar_url']); ?>">
            </div>

            <div class="mb-4">
                <label for="isi_artikel" class="block text-gray-700 text-sm font-bold mb-2">Isi Artikel (Rich Text):</label>
                <textarea id="isi_artikel" name="isi_artikel" rows="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required><?= htmlspecialchars($data['artikel']['isi_artikel']); ?></textarea>
            </div>

            <div class="mb-6">
                <label for="kata_kunci" class="block text-gray-700 text-sm font-bold mb-2">Kata Kunci (Dipisahkan koma, Opsional):</label>
                <input type="text" id="kata_kunci" name="kata_kunci" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?= htmlspecialchars($data['artikel']['kata_kunci']); ?>">
            </div>

            <div class="mb-6">
                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status Publikasi:</label>
                <select id="status" name="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="draft" <?= ($data['artikel']['status'] == 'draft') ? 'selected' : ''; ?>>Draft</option>
                    <option value="published" <?= ($data['artikel']['status'] == 'published') ? 'selected' : ''; ?>>Publikasikan</option>
                    <option value="pulled" <?= ($data['artikel']['status'] == 'pulled') ? 'selected' : ''; ?>>Ditarik</option>
                </select>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Artikel
                </button>
                <a href="<?= BASEURL; ?>/dashboard" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 mt-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Riwayat Revisi</h2>
        <?php if (empty($data['riwayat_revisi'])) : ?>
            <p class="text-gray-600">Belum ada riwayat revisi untuk artikel ini.</p>
        <?php else : ?>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 text-left text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Tanggal Revisi</th>
                            <th class="py-3 px-6 text-left">Revisor</th>
                            <th class="py-3 px-6 text-left">Perubahan</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm font-light">
                        <?php foreach ($data['riwayat_revisi'] as $revisi) : ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <?= date('d M Y H:i:s', strtotime($revisi['tanggal_revisi'])); ?>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <?= htmlspecialchars($revisi['nama_revisor'] ?? 'Penulis dihapus'); ?>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <pre class="whitespace-pre-wrap text-sm"><?= htmlspecialchars($revisi['perubahan']); ?></pre>
                                    <?php if ($revisi['judul_lama'] && $revisi['judul_lama'] != $data['artikel']['judul']): ?>
                                        <p class="text-xs text-gray-500">Judul Lama: "<?= htmlspecialchars($revisi['judul_lama']); ?>"</p>
                                    <?php endif; ?>
                                    <?php if ($revisi['gambar_url_lama'] && $revisi['gambar_url_lama'] != $data['artikel']['gambar_url']): ?>
                                        <p class="text-xs text-gray-500">Gambar Lama: "<?= htmlspecialchars($revisi['gambar_url_lama']); ?>"</p>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>