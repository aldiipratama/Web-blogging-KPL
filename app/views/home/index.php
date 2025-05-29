<div class="container mx-auto p-4">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Berita Terkini</h1>

    <?php Flasher::flash(); ?>

    <?php if (empty($data['main_article'])) : ?>
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <p class="text-gray-600">Belum ada artikel yang dipublikasikan. Ayo tunggu berita menarik lainnya!</p>
        </div>
    <?php else : ?>
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <a href="<?= BASEURL; ?>/artikel/detail/<?= htmlspecialchars($data['main_article']['slug']); ?>">
                <?php if (!empty($data['main_article']['gambar_url'])) : ?>
                    <img class="w-full h-96 object-cover" src="<?= htmlspecialchars($data['main_article']['gambar_url']); ?>" alt="<?= htmlspecialchars($data['main_article']['judul']); ?>">
                <?php else : ?>
                    <div class="w-full h-96 bg-gray-200 flex items-center justify-center text-gray-500 text-2xl font-bold">
                        HEADLINE - NO IMAGE
                    </div>
                <?php endif; ?>
            </a>
            <div class="p-8">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-3 leading-tight">
                    <a href="<?= BASEURL; ?>/artikel/detail/<?= htmlspecialchars($data['main_article']['slug']); ?>" class="hover:text-blue-700 transition-colors duration-200">
                        <?= htmlspecialchars($data['main_article']['judul']); ?>
                    </a>
                </h2>
                <p class="text-gray-600 text-md mb-4">
                    Oleh <span class="font-semibold"><?= htmlspecialchars($data['main_article']['nama_penulis']); ?></span> pada
                    <?= date('d M Y H:i', strtotime($data['main_article']['tanggal_publikasi'])); ?>
                </p>
                <p class="text-gray-800 text-lg leading-relaxed mb-6">
                    <?= htmlspecialchars(strip_tags(substr($data['main_article']['isi_artikel'], 0, 300))) . (strlen($data['main_article']['isi_artikel']) > 300 ? '...' : ''); ?>
                </p>
                <a href="<?= BASEURL; ?>/artikel/detail/<?= htmlspecialchars($data['main_article']['slug']); ?>" class="inline-block bg-blue-600 hover:bg-blue-800 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-200">
                    Baca Berita Lengkap
                </a>
            </div>
        </div>

        <?php if (!empty($data['other_articles'])) : ?>
            <h2 class="text-3xl font-bold text-gray-900 mb-6 border-b-2 border-blue-500 pb-2">Artikel Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($data['other_articles'] as $artikel) : ?>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-xl">
                        <a href="<?= BASEURL; ?>/artikel/detail/<?= htmlspecialchars($artikel['slug']); ?>">
                            <?php if (!empty($artikel['gambar_url'])) : ?>
                                <img class="w-full h-48 object-cover" src="<?= htmlspecialchars($artikel['gambar_url']); ?>" alt="<?= htmlspecialchars($artikel['judul']); ?>">
                            <?php else : ?>
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                    Tidak Ada Gambar
                                </div>
                            <?php endif; ?>
                        </a>
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                                <a href="<?= BASEURL; ?>/artikel/detail/<?= htmlspecialchars($artikel['slug']); ?>" class="hover:text-blue-600">
                                    <?= htmlspecialchars($artikel['judul']); ?>
                                </a>
                            </h3>
                            <p class="text-gray-600 text-xs mb-2">
                                Oleh <span class="font-semibold"><?= htmlspecialchars($artikel['nama_penulis']); ?></span> |
                                <?= date('d M Y H:i', strtotime($artikel['tanggal_publikasi'])); ?>
                            </p>
                            <p class="text-gray-700 text-sm line-clamp-3">
                                <?= htmlspecialchars(strip_tags(substr($artikel['isi_artikel'], 0, 150))) . (strlen($artikel['isi_artikel']) > 150 ? '...' : ''); ?>
                            </p>
                            <div class="mt-4">
                                <a href="<?= BASEURL; ?>/artikel/detail/<?= htmlspecialchars($artikel['slug']); ?>" class="text-blue-500 hover:text-blue-700 text-sm font-semibold">
                                    Baca Selengkapnya &raquo;
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>