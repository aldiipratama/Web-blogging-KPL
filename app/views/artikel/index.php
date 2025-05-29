<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6 text-center">Arsip Berita & Artikel</h1>

    <?php Flasher::flash(); ?>

    <?php if (empty($data['artikel'])) : ?>
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <p class="text-gray-600">Tidak ada artikel dalam arsip.</p>
        </div>
    <?php else : ?>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="divide-y divide-gray-200">
                <?php foreach ($data['artikel'] as $artikel) : ?>
                    <div class="py-4 flex flex-col md:flex-row items-start md:items-center space-y-3 md:space-y-0 md:space-x-4">
                        <?php if (!empty($artikel['gambar_url'])) : ?>
                            <div class="flex-shrink-0 w-full md:w-48 h-32 overflow-hidden rounded-lg">
                                <a href="<?= BASEURL; ?>/artikel/detail/<?= htmlspecialchars($artikel['slug']); ?>">
                                    <img class="w-full h-full object-cover transition-transform duration-300 hover:scale-105" src="<?= htmlspecialchars($artikel['gambar_url']); ?>" alt="<?= htmlspecialchars($artikel['judul']); ?>">
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="flex-grow">
                            <h2 class="text-xl font-bold text-gray-900 mb-1 leading-tight">
                                <a href="<?= BASEURL; ?>/artikel/detail/<?= htmlspecialchars($artikel['slug']); ?>" class="hover:text-blue-600">
                                    <?= htmlspecialchars($artikel['judul']); ?>
                                </a>
                            </h2>
                            <p class="text-gray-600 text-sm mb-2">
                                Oleh <span class="font-semibold"><?= htmlspecialchars($artikel['nama_penulis']); ?></span> |
                                <?= date('d M Y H:i', strtotime($artikel['tanggal_publikasi'])); ?>
                            </p>
                            <p class="text-gray-700 text-base line-clamp-2">
                                <?= htmlspecialchars(strip_tags(substr($artikel['isi_artikel'], 0, 150))) . (strlen($artikel['isi_artikel']) > 150 ? '...' : ''); ?>
                            </p>
                            <div class="mt-2">
                                <a href="<?= BASEURL; ?>/artikel/detail/<?= htmlspecialchars($artikel['slug']); ?>" class="text-blue-500 hover:text-blue-700 text-sm font-semibold">
                                    Baca Selengkapnya &raquo;
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>