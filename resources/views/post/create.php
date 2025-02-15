<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/global.css">
    <title>FrontendLab - Create Post</title>
</head>

<body class="bg-gray-100">
    <?php include "../components/navbar.php" ?>

    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4 lg:px-16">
        <div class="w-full max-w-[1250px] bg-white rounded-lg shadow-lg p-8 flex flex-col items-center">
            <h2 class="text-2xl font-bold mb-6 text-center">Buat Blog</h2>
            <form class="w-full flex flex-col items-center" method="POST" action="#">

                <!-- Judul -->
                <div class="mb-4 w-full md:w-[1045px]">
                    <label for="title" class="block text-gray-700 font-bold mb-2">Judul</label>
                    <input type="text" id="title" name="title" class="border rounded w-full h-[48px] px-3" placeholder="Masukkan Judul">
                    <div class="text-red-500 text-sm mt-1" id="title-error"></div>
                </div>

                <!-- Gambar -->
                <div class="mb-6 w-full md:w-[1045px]">
                    <label for="image" class="block text-gray-700 font-bold mb-2">Gambar</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        aria-describedby="user_avatar_help" id="image" type="file" name="image">
                    <div class="mt-1 text-sm text-gray-500">Format yang didukung: PNG, JPG (Max 2MB)</div>
                    <div class="text-red-500 text-sm mt-1" id="image-error"></div>
                </div>

                <!-- Deskripsi -->
                <div class="mb-6 w-full md:w-[1045px]">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                    <textarea id="description" name="description" class="border rounded w-full h-[150px] px-3 py-2" placeholder="Masukkan Deskripsi"></textarea>
                    <div class="text-red-500 text-sm mt-1" id="description-error"></div>
                </div>

                <!-- Visibilitas -->
                <div class="mb-6 w-full md:w-[1045px]">
                    <label class="block text-gray-700 font-bold mb-2">Visibilitas</label>
                    <div class="flex items-center space-x-6">
                        <label class="flex items-center">
                            <input type="radio" name="visibility" value="public" class="w-5 h-5 text-red-600 focus:ring-red-500 border-gray-300">
                            <span class="ml-2 text-gray-700">Publik</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="visibility" value="draft" class="w-5 h-5 text-red-600 focus:ring-red-500 border-gray-300">
                            <span class="ml-2 text-gray-700">Draft</span>
                        </label>
                    </div>
                    <div class="text-red-500 text-sm mt-1" id="visibility-error"></div>
                </div>

                <button type="submit" class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded w-[200px] h-[48px]">
                    Buat
                </button>
            </form>
        </div>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault();

            let isValid = true;

            // Validasi Judul
            const title = document.getElementById('title').value;
            const titleError = document.getElementById('title-error');
            if (title === '') {
                titleError.textContent = 'Judul tidak boleh kosong';
                isValid = false;
            } else {
                titleError.textContent = '';
            }

            // Validasi Gambar
            const image = document.getElementById('image').value;
            const imageError = document.getElementById('image-error');
            if (image === '') {
                imageError.textContent = 'Pilih gambar terlebih dahulu';
                isValid = false;
            } else {
                imageError.textContent = '';
            }

            // Validasi Deskripsi
            const description = document.getElementById('description').value;
            const descriptionError = document.getElementById('description-error');
            if (description === '') {
                descriptionError.textContent = 'Deskripsi tidak boleh kosong';
                isValid = false;
            } else {
                descriptionError.textContent = '';
            }

            // Validasi Visibilitas
            const visibility = document.querySelector('input[name="visibility"]:checked');
            const visibilityError = document.getElementById('visibility-error');
            if (!visibility) {
                visibilityError.textContent = 'Pilih visibilitas untuk blog';
                isValid = false;
            } else {
                visibilityError.textContent = '';
            }

            // Jika semua validasi lolos, submit form
            if (isValid) {
                this.submit();
            }
        });
    </script>

    <script src="../../../../node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html>