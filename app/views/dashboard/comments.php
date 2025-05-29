<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Moderasi Komentar</h1>

    <?php Flasher::flash(); ?>

    <?php if (empty($data['komentar'])) : ?>
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-600">Belum ada komentar untuk dimoderasi.</p>
        </div>
    <?php else : ?>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 text-left text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Artikel</th>
                            <th class="py-3 px-6 text-left">Komentator</th>
                            <th class="py-3 px-6 text-left">Isi Komentar</th>
                            <th class="py-3 px-6 text-left">Tanggal</th>
                            <th class="py-3 px-6 text-left">Status</th>
                            <th class="py-3 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm font-light">
                        <?php foreach ($data['komentar'] as $komentar) : ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <a href="<?= BASEURL; ?>/artikel/detail/<?= htmlspecialchars($komentar['judul_artikel']); ?>" class="font-medium text-blue-600 hover:underline">
                                        <?= htmlspecialchars($komentar['judul_artikel']); ?>
                                    </a>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <?= htmlspecialchars($komentar['nama_komentator']); ?><br>
                                    <span class="text-xs text-gray-500"><?= htmlspecialchars($komentar['email_komentator']); ?></span>
                                </td>
                                <td class="py-3 px-6 text-left max-w-xs overflow-hidden text-ellipsis">
                                    <?= nl2br(htmlspecialchars($komentar['isi_komentar'])); ?>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <?= date('d M Y H:i', strtotime($komentar['tanggal_komentar'])); ?>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <span class="py-1 px-3 rounded-full text-xs font-semibold
                                        <?php
                                            switch ($komentar['status']) {
                                                case 'approved': echo 'bg-green-200 text-green-800'; break;
                                                case 'pending': echo 'bg-yellow-200 text-yellow-800'; break;
                                                case 'rejected': echo 'bg-red-200 text-red-800'; break;
                                                default: echo 'bg-gray-200 text-gray-800'; break;
                                            }
                                        ?>
                                    ">
                                        <?= ucfirst($komentar['status']); ?>
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center space-x-2">
                                        <?php if ($komentar['status'] === 'pending' || $komentar['status'] === 'rejected') : ?>
                                            <form action="<?= BASEURL; ?>/dashboard/approveComment/<?= $komentar['id']; ?>" method="POST" onsubmit="return confirm('Setujui komentar ini?');">
                                                <?php CSRF::field(); ?>
                                                
                                                <input type="hidden" name="<?= CSRF::getTokenFieldName(); ?>" value="<?= $data['csrf_token']; ?>">
                                                <button type="submit" class="w-8 h-8 flex justify-center items-center rounded-full bg-green-200 text-green-800 hover:bg-green-300 transition duration-200" title="Setujui">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                        <?php if ($komentar['status'] === 'pending' || $komentar['status'] === 'approved') : ?>
                                            <form action="<?= BASEURL; ?>/dashboard/rejectComment/<?= $komentar['id']; ?>" method="POST" onsubmit="return confirm('Tolak komentar ini?');">
                                                <?php CSRF::field(); ?>
                                                
                                                <input type="hidden" name="<?= CSRF::getTokenFieldName(); ?>" value="<?= $data['csrf_token']; ?>">
                                                <button type="submit" class="w-8 h-8 flex justify-center items-center rounded-full bg-red-200 text-red-800 hover:bg-red-300 transition duration-200" title="Tolak">
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
        </div>
    <?php endif; ?>
</div>