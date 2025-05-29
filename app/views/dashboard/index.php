<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Halo, <?= $data['user']['nama_lengkap']; ?>! Selamat Datang di Dashboard Anda.</h1>

    <?php Flasher::flash(); ?>

    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Aktivitas Cepat</h2>
        <a href="<?= BASEURL; ?>/artikel/create" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
            + Buat Artikel Baru
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Artikel Saya</h2>
        <?php if (empty($data['artikel_saya'])) : ?>
            <p class="text-gray-600">Anda belum memiliki artikel. Ayo buat yang pertama!</p>
        <?php else : ?>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 text-left text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Judul Artikel</th>
                            <th class="py-3 px-6 text-left">Tanggal Publikasi</th>
                            <th class="py-3 px-6 text-left">Status</th>
                            <th class="py-3 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm font-light">
                        <?php foreach ($data['artikel_saya'] as $artikel) : ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <a href="<?= BASEURL; ?>/artikel/detail/<?= $artikel['slug']; ?>" class="font-medium text-blue-600 hover:underline">
                                        <?= $artikel['judul']; ?>
                                    </a>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <?= date('d M Y H:i', strtotime($artikel['tanggal_publikasi'])); ?>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <span class="py-1 px-3 rounded-full text-xs font-semibold
                                        <?php
                                            switch ($artikel['status']) {
                                                case 'published': echo 'bg-green-200 text-green-800'; break;
                                                case 'draft': echo 'bg-yellow-200 text-yellow-800'; break;
                                                case 'pulled': echo 'bg-red-200 text-red-800'; break;
                                                default: echo 'bg-gray-200 text-gray-800'; break;
                                            }
                                        ?>
                                    ">
                                        <?= ucfirst($artikel['status']); ?>
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center space-x-2">
                                        <a href="<?= BASEURL; ?>/artikel/edit/<?= $artikel['slug']; ?>" class="w-8 h-8 flex justify-center items-center rounded-full bg-yellow-200 text-yellow-800 hover:bg-yellow-300 transition duration-200" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <?php if ($artikel['status'] === 'published') : ?>
                                        <form action="<?= BASEURL; ?>/artikel/pull/<?= $artikel['id']; ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menarik artikel ini? Ini akan membuatnya tidak terlihat oleh publik.');">
                                            <?php CSRF::field(); ?>
                                            
                                            <input type="hidden" name="<?= CSRF::getTokenFieldName(); ?>" value="<?= CSRF::generateToken(); ?>">
                                            <button type="submit" class="w-8 h-8 flex justify-center items-center rounded-full bg-red-200 text-red-800 hover:bg-red-300 transition duration-200" title="Tarik Artikel">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>