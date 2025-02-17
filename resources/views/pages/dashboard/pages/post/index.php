<?php include "../resources/views/partials/header.php" ?>
<?php include "../resources/views/components/sidebar.php" ?>

<div class="p-4 sm:ml-64">
  <h1 class="font-bold text-xl">Post</h1>



  <div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-6 py-3">
            Image
          </th>
          <th scope="col" class="px-6 py-3">
            Title
          </th>
          <th scope="col" class="px-6 py-3">
            Description
          </th>
          <th scope="col" class="px-6 py-3">
            Author
          </th>
          <th scope="col" class="px-6 py-3">
            Publish At
          </th>
          <th scope="col" class="px-6 py-3">
            Action
          </th>
        </tr>
      </thead>
      <tbody>
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            <img src="https://placehold.co/250?text=contoh" alt="contoh">
          </th>
          <td class="px-6 py-4">
            Lorem ipsum dolor sit.
          </td>
          <td class="px-6 py-4">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur tempora ullam laborum magni, ipsam
            voluptatum sint recusandae alias omnis adipisci.
          </td>
          <td class="px-6 py-4">
            Aldi Pratama
          </td>
          <td class="px-6 py-4">
            Senin, 17 February 2025
          </td>
          <td class="px-6 py-4">
            <div class="flex gap-2">
              <button class="bg-blue-500 rounded-lg px-4 py-2 text-white cursor-pointer">View</button>
              <button class="bg-blue-500 rounded-lg px-4 py-2 text-white cursor-pointer">Edit</button>
              <button class="bg-blue-500 rounded-lg px-4 py-2 text-white cursor-pointer">Visible</button>
              <button class="bg-blue-500 rounded-lg px-4 py-2 text-white cursor-pointer">Delete</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="mt-5 flex justify-center">
    <div aria-label="Page navigation example">
      <ul class="inline-flex -space-x-px text-sm">
        <li>
          <a href="#"
            class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
        </li>
        <li>
          <a href="#" aria-current="page"
            class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">1</a>
        </li>
        <li>
          <a href="#"
            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
        </li>
        <li>
          <a href="#"
            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">3</a>
        </li>
        <li>
          <a href="#"
            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>
        </li>
        <li>
          <a href="#"
            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>
        </li>
        <li>
          <a href="#"
            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
        </li>
      </ul>
    </div>
  </div>

</div>


<?php include "../resources/views/partials/footer.php" ?>