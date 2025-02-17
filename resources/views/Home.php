<?php include "../resources/views/partials/header.php"; ?>
<?php include "../resources/views/components/navbar.php" ?>

<!-- Hero -->
<div class="py-25 bg-linear-to-t from-[#5a1018] via-[#B82132] to-[#B82132] max-w-full pt-10 ">
  <div class="mx-auto flex flex-wrap items-center justify-center md:flex-row container">
    <div class="mb-14 lg:mb-0">
      <div
        class="max-w-xl text-[2.9rem] text-white font-extrabold font-sans text-center lg-text-5xl lg:text-left lg:leading-tight mb-5">
        <h1>Tingkatkan Kemampuan</h1>
        <h1 class="text-[#FFEE00]"> Frontend </h1>
        <h1>anda untuk masa depan yang cerah</h1>
      </div>
      <p class="max-w-xl text-[1.2rem] text-center text-white lg:text-left lg:max-w-md">
        Anda dapat menemukan panduan praktis, tips, dan best practice dalam membangun antarmuka web yang
        interaktif dan responsif.
    </div>
    <div class="lg:w-[250px] self-start">
      <img class="ml-auto" src="../img/circle-hero.png" alt="circle hero img">
    </div>
    <div class="lg:w-[400px]">
      <img class="ml-auto" src="../img/hero.png" alt="hero img">
    </div>
  </div>
</div>

<!-- Top Tutorial -->
<div class="container mx-auto my-10">
  <h2
    class="max-w-xl text-[2.0rem] text-black font-bold font-sans text-center lg-text-5xl lg:text-left lg:leading-tight mb-5">
    Top Tutorial</h2>
  <div class="flex flex-warp justify-center gap-5">
    <?php for ($i = 0; $i < 4; $i++) { ?>
      <div class="max-w-sm bg-white rounded-lg shadow-xl dark:border-gray-700 pt-1">
        <div class="flex flex-warp">
          <a href="#">
            <img class="w-10 h-10 mb-3 mt-3 ms-5 me-3 rounded-full shadow-lg" src="../img/user.jpg" alt="user img" />
          </a>
          <ul class="self-center">
            <a href="#">
              <li class="font-semibold text-base">Herdy</li>
            </a>
            <li class="font-light text-xs">12 Januari 2025</li>
          </ul>
        </div>
        <a href="#">
          <img class="" src="../img/work.jpg" alt="" />
        </a>
        <div class="p-3">
          <a href="#" class="flex gap-2 mb-2">
            <svg class="w-6 h-6 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" fill="currentColor" viewBox="0 0 24 24">
              <path fill-rule="evenodd"
                d="M3 6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-6.616l-2.88 2.592C8.537 20.461 7 19.776 7 18.477V17H5a2 2 0 0 1-2-2V6Zm4 2a1 1 0 0 0 0 2h5a1 1 0 1 0 0-2H7Zm8 0a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2h-2Zm-8 3a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2H7Zm5 0a1 1 0 1 0 0 2h5a1 1 0 1 0 0-2h-5Z"
                clip-rule="evenodd" />
            </svg>
            <p class="text-gray-400">213 Komentar</p>
          </a>
          <a href="#">
            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 ">Tutorial HTML Pemula</h5>
            <p class="mb-3 font-normal text-sm text-black leading-4">HTML adalah singkatan dari Hypertext Markup
              Language, HTML merupakan salah satu bahasa pengkodean atau pemograman yang digunakan untuk
              membuat halaman website ...</p>
          </a>
          <a href="#" class="grid grid-cols-2 py-2 text-sm font-medium text-[#B82132]">
            <p class="">
              Baca Selengkapnya
            </p>
            <svg class="place-self-end w-6 h-6 text-[#B82132]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
              width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
              <path fill-rule="evenodd"
                d="M10.271 5.575C8.967 4.501 7 5.43 7 7.12v9.762c0 1.69 1.967 2.618 3.271 1.544l5.927-4.881a2 2 0 0 0 0-3.088l-5.927-4.88Z"
                clip-rule="evenodd" />
            </svg>
          </a>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<!-- Dari FrontendLab -->
<div class="container mx-auto my-10">
  <div class="bg-white rounded-lg shadow-xl">
    <h2
      class="max-w-xl text-[2.0rem] leading-none m-5 text-black font-bold font-sans text-center lg-text-5xl lg:text-left lg:leading-tight mb-5">
      Dari FrontendLab</h2>
    <div id="gallery" class="relative w-full" data-carousel="slide">
      <!-- Carousel wrapper -->
      <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
        <?php for ($i = 0; $i < 5; $i++) { ?>
          <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="./img/dari-fl.jpg"
              class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
          </div>
        <?php } ?>
      </div>
      <!-- Slider controls -->
      <button type="button"
        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-prev>
        <span
          class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
          <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 1 1 5l4 4" />
          </svg>
          <span class="sr-only">Previous</span>
        </span>
      </button>
      <button type="button"
        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-next>
        <span
          class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
          <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 9 4-4-4-4" />
          </svg>
          <span class="sr-only">Next</span>
        </span>
      </button>
    </div>
  </div>
</div>

<div class="container mx-auto my-10">
  <div class="grid grid-cols-2 gap-5">
    <!-- Mungkin Anda Sukai -->
    <div class="container">
      <?php for ($i = 0; $i < 3; $i++) { ?>
        <div class="bg-white rounded-lg shadow-lg mb-5">
          <div class="flex flex-warp">
            <a href="#">
              <img class="w-10 h-10 mb-3 mt-3 ms-5 me-3 rounded-full shadow-lg" src="../img/user.jpg"
                alt="Bonnie image" />
            </a>
            <ul class="self-center">
              <a href="#">
                <li class="font-semibold text-base">Herdy</li>
              </a>
              <li class="font-light text-xs">12 Januari 2025</li>
            </ul>
          </div>
          <div class="flex flex-warp items-center md:flex-row md:max-w-xl">
            <a href="#">
              <img class="" src="../img/work.jpg" alt="">
            </a>
            <div class="flex flex-col justify-between p-4 leading-normal">
              <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-black">Tutorial HTML Pemula</h5>
                <p class="mb-3 font-normal text-sm text-black leading-4">HTML adalah singkatan dari
                  Hypertext Markup Language, HTML merupakan salah satu bahasa pengkodean atau pemograman
                  yang digunakan untuk membuat halaman website ...</p>
              </a>
            </div>
          </div>
          <a href="#" class="grid grid-cols-2 py-2 text-sm font-medium text-[#B82132]">
            <p class="ms-3">
              Baca Selengkapnya
            </p>
            <svg class=" w-6 h-6 text-[#B82132]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" fill="currentColor" viewBox="0 0 24 24">
              <path fill-rule="evenodd"
                d="M10.271 5.575C8.967 4.501 7 5.43 7 7.12v9.762c0 1.69 1.967 2.618 3.271 1.544l5.927-4.881a2 2 0 0 0 0-3.088l-5.927-4.88Z"
                clip-rule="evenodd" />
            </svg>
          </a>
        </div>
      <?php } ?>
    </div>

    <!-- Terbaru -->
    <div class="grid grid-cols-2 justify-center gap-5">
      <?php for ($i = 0; $i < 4; $i++) { ?>
        <div class="max-w-sm bg-white rounded-lg shadow-xl dark:border-gray-700 pt-1">
          <div class="flex flex-warp">
            <a href="#">
              <img class="w-10 h-10 mb-3 mt-3 ms-5 me-3 rounded-full shadow-lg" src="../img/user.jpg" alt="user img" />
            </a>
            <ul class="self-center">
              <a href="#">
                <li class="font-semibold text-base">Herdy</li>
              </a>
              <li class="font-light text-xs">12 Januari 2025</li>
            </ul>
          </div>
          <a href="#">
            <img class="" src="../img/work.jpg" alt="" />
          </a>
          <div class="p-3">
            <a href="#" class="flex gap-2 mb-2">
              <svg class="w-6 h-6 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                  d="M3 6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-6.616l-2.88 2.592C8.537 20.461 7 19.776 7 18.477V17H5a2 2 0 0 1-2-2V6Zm4 2a1 1 0 0 0 0 2h5a1 1 0 1 0 0-2H7Zm8 0a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2h-2Zm-8 3a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2H7Zm5 0a1 1 0 1 0 0 2h5a1 1 0 1 0 0-2h-5Z"
                  clip-rule="evenodd" />
              </svg>
              <p class="text-gray-400">213 Komentar</p>
            </a>
            <a href="#">
              <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 ">Tutorial HTML Pemula</h5>
            </a>
            <p class="mb-3 font-normal text-sm text-black leading-4">HTML adalah singkatan dari Hypertext Markup
              Language, HTML merupakan salah satu bahasa pengkodean atau pemograman yang digunakan untuk
              membuat halaman website ...</p>
            <a href="#" class="grid grid-cols-2 py-2 text-sm font-medium text-[#B82132]">
              <p class="">
                Baca Selengkapnya
              </p>
              <svg class="place-self-end w-6 h-6 text-[#B82132]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                  d="M10.271 5.575C8.967 4.501 7 5.43 7 7.12v9.762c0 1.69 1.967 2.618 3.271 1.544l5.927-4.881a2 2 0 0 0 0-3.088l-5.927-4.88Z"
                  clip-rule="evenodd" />
              </svg>
            </a>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>

<?php include "../resources/views/components/footer.php" ?>
<?php include "../resources/views/partials/footer.php"; ?>