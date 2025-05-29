<div class="container mx-auto p-4">
    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4"><?= htmlspecialchars($data['artikel']['judul']); ?></h1>
        <p class="text-gray-600 text-sm mb-4">
            Oleh <span class="font-semibold"><?= htmlspecialchars($data['artikel']['nama_penulis']); ?></span> pada
            <?= date('d M Y H:i', strtotime($data['artikel']['tanggal_publikasi'])); ?>
        </p>

        <?php if (!empty($data['artikel']['gambar_url'])) : ?>
            <img src="<?= htmlspecialchars($data['artikel']['gambar_url']); ?>" alt="<?= htmlspecialchars($data['artikel']['judul']); ?>" class="w-full h-auto object-cover rounded-lg mb-6">
        <?php endif; ?>

        <div class="prose max-w-none text-gray-800 leading-relaxed text-lg mb-8">
            <?= nl2br(htmlspecialchars($data['artikel']['isi_artikel'])); ?>
        </div>

        <?php if (!empty($data['artikel']['kata_kunci'])) : ?>
            <div class="mb-8">
                <span class="font-semibold text-gray-700">Kata Kunci:</span>
                <?php
                $keywords = explode(',', $data['artikel']['kata_kunci']);
                foreach ($keywords as $keyword) :
                    ?>
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                        <?= trim(htmlspecialchars($keyword)); ?>
                    </span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Komentar</h2>

        <?php if (empty($data['komentar'])) : ?>
            <p class="text-gray-600 mb-6">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
        <?php else : ?>
            <?php foreach ($data['komentar'] as $komentar) : ?>
                <div class="border-b border-gray-200 pb-4 mb-4 last:border-b-0 last:pb-0 last:mb-0">
                    <p class="font-semibold text-gray-800"><?= htmlspecialchars($komentar['nama_komentator']); ?></p>
                    <p class="text-gray-500 text-xs mb-2">
                        <?= date('d M Y H:i', strtotime($komentar['tanggal_komentar'])); ?>
                    </p>
                    <p class="text-gray-700"><?= nl2br(htmlspecialchars($komentar['isi_komentar'])); ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4">Tinggalkan Komentar</h3>

        <?php Flasher::flash(); ?>

        <form action="<?= BASEURL; ?>/artikel/addKomentar" method="POST">
            <?php CSRF::field(); ?>
            
            <input type="hidden" name="<?= CSRF::getTokenFieldName(); ?>" value="<?= $data['csrf_token']; ?>">
            <input type="hidden" name="artikel_id" value="<?= $data['artikel']['id']; ?>">
            <input type="hidden" name="artikel_slug" value="<?= $data['artikel']['slug']; ?>">

            <div class="mb-4">
                <label for="nama_komentator" class="block text-gray-700 text-sm font-bold mb-2">Nama Anda:</label>
                <input type="text" id="nama_komentator" name="nama_komentator" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Nama Anda" required>
            </div>

            <div class="mb-4">
                <label for="email_komentator" class="block text-gray-700 text-sm font-bold mb-2">Email Anda (Opsional):</label>
                <input type="email" id="email_komentator" name="email_komentator" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="email@contoh.com">
            </div>

            <div class="mb-6">
                <label for="isi_komentar" class="block text-gray-700 text-sm font-bold mb-2">Komentar:</label>
                <textarea id="isi_komentar" name="isi_komentar" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Tulis komentar Anda di sini..." required></textarea>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Kirim Komentar
                </button>
            </div>
        </form>
    </div>
</div>