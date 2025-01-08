<?= $this->extend('index'); ?>

<?= $this->section('content'); ?>

<div class="w-full">
    <!-- Breadcrumb -->
    <ul class="flex items-center gap-2">
        <li><a href="<?= site_url('/dashboard'); ?>" class="text-light-text dark:text-dark-text text-xs md:text-sm">Dashboard</a></li>
        <li class="text-light-text dark:text-dark-text text-xs md:text-sm">/</li>
        <li>
            <p class="text-light-text dark:text-dark-text text-xs md:text-sm">Konseling</p>
        </li>
        <li class="text-light-text dark:text-dark-text text-xs md:text-sm">/</li>
        <li>
            <a href="<?= $_SERVER['REQUEST_URI']; ?>" class="text-danger m-0 text-xs md:text-sm">Jadwal Konseling</a>
        </li>
    </ul>

    <!-- Calendar -->
    <div class="mt-4 border-t-4 border-t-[#ff147f] bg-light-card dark:bg-dark-card shadow-md rounded-md w-full">
        <div class="grid grid-cols-2 md:grid-cols-3 w-ful place-items-center p-6 mb-6">
            <div class="justify-self-start set-flex order-2 md:order-1">
                <button id="prevMonth" class="p-2 bg-light-shadow dark:bg-dark-shadow text-light-text dark:text-dark-text border-2 border-light-bg dark:border-dark-bg rounded-l-md hover:bg-custom-gradient hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 md:size-6">
                        <path fill-rule="evenodd" d="M7.72 12.53a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 1 1 1.06 1.06L9.31 12l6.97 6.97a.75.75 0 1 1-1.06 1.06l-7.5-7.5Z" clip-rule="evenodd" />
                    </svg>
                </button>
                <button id="nextMonth" class="p-2 bg-light-shadow dark:bg-dark-shadow text-light-text dark:text-dark-text border-2 border-light-bg dark:border-dark-bg rounded-r-md hover:bg-custom-gradient hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 md:size-6">
                        <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <h1 id="currentTime" class="w-full col-span-2 md:col-span-1 order-1 md:order-2 font-bold text-2xl lg:text-3xl text-light-text dark:text-dark-text justify-self-center text-center mb-4 md:mb-0">-</h1>

            <?php $type = $_GET['type'] ?? 'month'; ?>
            <div class="set-flex justify-self-end order-3">
                <a href="<?= site_url('/jadwal?type=month'); ?>" id="displayMonth" class="py-1.5 md:py-2 px-3 md:px-4 text-sm md:text-lg bg-light-shadow dark:bg-dark-shadow text-light-text dark:text-dark-text border-2 border-light-bg dark:border-dark-bg rounded-l-md hover:bg-custom-gradient hover:text-white <?= ($type == 'month' ? 'active' : '') ?>">Bulan</a>
                <a href="<?= site_url('/jadwal?type=year'); ?>" id="displayYear" class="py-1.5 md:py-2 px-3 md:px-4 text-sm md:text-lg bg-light-shadow dark:bg-dark-shadow text-light-text dark:text-dark-text border-2 border-light-bg dark:border-dark-bg rounded-r-md hover:bg-custom-gradient hover:text-white <?= ($type == 'year' ? 'active' : '') ?>">Tahun</a>
            </div>
        </div>
        <div class="set-flex gap-8 md:gap-40 lg:gap-48 mb-4 text-light-text dark:text-dark-text px-6">
            <div class="set-flex gap-1">
                <span class="bg-green-600 w-4 h-4"></span>
                <span class="text-xs md:text-sm">Dijadwalkan</span>
            </div>
            <div class="set-flex gap-1">
                <span class="bg-red-600 w-4 h-4"></span>
                <span class="text-xs md:text-sm">Selesai</span>
            </div>
            <div class="set-flex gap-1">
                <span class="bg-gray-600 w-4 h-4"></span>
                <span class="text-xs md:text-sm">Dibatalkan</span>
            </div>

        </div>
        <div id="calendar-content" class="p-3 md:p-6 text-light-text dark:text-dark-text">
            <?php

            if ($type == 'month') {
                echo $this->include('pages/konseling/calendar/calendar_month');
            } elseif ($type == 'year') {
                echo $this->include('pages/konseling/calendar/calendar_year');
            } else {
                echo $this->include('pages/konseling/calendar/calendar_month');
            }
            ?>
        </div>
    </div>
</div>

<!-- Modal add data -->
<div class="modal opacity-0 pointer-events-none transition-all duration-200 fixed inset-0 z-50 bg-dark-bg/60 dark:bg-light-bg/10 set-flex items-start">
    <div class="modal-content scale-0 transition-all duration-200 shadow-md w-full lg:w-3/5 overflow-auto max-h-screen">
        <?= $this->include('pages/konseling/tambah_konseling'); ?>
    </div>
</div>

<!-- Modal for Edit data -->
<div class="modal opacity-0 pointer-events-none transition-all duration-200 fixed inset-0 z-50 bg-dark-bg/60 dark:bg-light-bg/10 set-flex items-start">
    <div class="modal-content scale-0 transition-all duration-200 shadow-md w-full lg:w-3/5 overflow-auto m-0 max-h-screen">
        <?php if (isset($knslng)) : ?>
            <?= $this->include('pages/konseling/edit_konseling'); ?>
        <?php endif; ?>
    </div>
</div>

<!-- Modal details -->
<div class="modal opacity-0 pointer-events-none transition-all duration-200 fixed inset-0 z-50 bg-dark-bg/60 dark:bg-light-bg/10 set-flex items-start">
    <div class="modal-content scale-0 transition-all duration-200 shadow-md w-full lg:w-3/4 overflow-auto m-0 -mt-4 max-h-screen">
        <?= $this->include('pages/konseling/modal_detail'); ?>
    </div>
</div>



<!-- Alert Message-->
<?= $this->include('layout/modal_message'); ?>

<!-- Modal Logic -->
<?= $this->include('layout/modal_logic'); ?>

<?= $this->endSection('content'); ?>