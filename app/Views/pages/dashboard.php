<?= $this->extend('index'); ?>

<?= $this->section('content'); ?>

<div class="w-full mt-2 text-light-text dark:text-dark-text">
    <div class="set-flex flex-col items-start gap-[2px] mb-5 ml-1">
        <h1 class="text-2xl md:text-3xl font-bold">Dashboard</h1>
        <p class="text-base md:text-lg text-slate-500">Cek total siswa, pelanggaran, konseling, dan statistik lainnya secara visual.</p>
    </div>

    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Total Siswa -->
        <li class="w-full md:w-auto hover:bg-light-shadow dark:hover:bg-dark-shadow bg-light-card dark:bg-dark-card shadow-md border-2 border-light-shadow dark:border-dark-shadow py-3 px-4 rounded-xl">
            <a href="<?= site_url('/siswa'); ?>" class="set-flex justify-start gap-3">
                <div class="box-icon w-[2.7rem] h-[2.7rem] bg-custom-gradient text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                        <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <p class="text-2xl font-bold" id="total-siswa"><?= $totalSiswa ?? 0; ?></p>
                    <h3 class="text-sm text-slate-500">Total Siswa</h3>
                </div>
            </a>
        </li>

        <!-- Total Pelanggaran -->
        <li class="w-full md:w-auto hover:bg-light-shadow dark:hover:bg-dark-shadow bg-light-card dark:bg-dark-card shadow-md border-2 border-light-shadow dark:border-dark-shadow py-3 px-4 rounded-xl">
            <a href="<?= site_url('/pelanggaran'); ?>" class="set-flex justify-start gap-3">
                <div class="box-icon w-[2.7rem] h-[2.7rem] bg-custom-gradient text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <p class="text-2xl font-bold" id="total-pelanggaran"><?= $totalPelanggaran ?? 0; ?></p>
                    <h3 class="text-sm text-slate-500">Total Pelanggaran</h3>
                </div>
            </a>
        </li>

        <!-- Total Konseling -->
        <li class="w-full md:w-auto hover:bg-light-shadow dark:hover:bg-dark-shadow bg-light-card dark:bg-dark-card shadow-md border-2 border-light-shadow dark:border-dark-shadow py-3 px-4 rounded-xl">
            <a href="<?= site_url('/konseling'); ?>" class="set-flex justify-start gap-3">
                <div class="box-icon w-[2.7rem] h-[2.7rem] bg-custom-gradient text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z" clip-rule="evenodd" />
                        <path d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <p class="text-2xl font-bold" id="total-konseling"><?= $totalKonseling ?? 0; ?></p>
                    <h3 class="text-sm text-slate-500">Total Konseling</h3>
                </div>
            </a>
        </li>

        <!-- Total Siswa Industri -->
        <li class="w-full md:w-auto hover:bg-light-shadow dark:hover:bg-dark-shadow bg-light-card dark:bg-dark-card shadow-md border-2 border-light-shadow dark:border-dark-shadow py-3 px-4 rounded-xl">
            <a href="<?= site_url('/industri'); ?>" class="set-flex justify-start gap-3">
                <div class="box-icon w-[2.7rem] h-[2.7rem] bg-custom-gradient text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M3 2.25a.75.75 0 0 0 0 1.5v16.5h-.75a.75.75 0 0 0 0 1.5H15v-18a.75.75 0 0 0 0-1.5H3ZM6.75 19.5v-2.25a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.75.75h-3a.75.75 0 0 1-.75-.75ZM6 6.75A.75.75 0 0 1 6.75 6h.75a.75.75 0 0 1 0 1.5h-.75A.75.75 0 0 1 6 6.75ZM6.75 9a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75ZM6 12.75a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 0 1.5h-.75a.75.75 0 0 1-.75-.75ZM10.5 6a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75Zm-.75 3.75A.75.75 0 0 1 10.5 9h.75a.75.75 0 0 1 0 1.5h-.75a.75.75 0 0 1-.75-.75ZM10.5 12a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75ZM16.5 6.75v15h5.25a.75.75 0 0 0 0-1.5H21v-12a.75.75 0 0 0 0-1.5h-4.5Zm1.5 4.5a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Zm.75 2.25a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75v-.008a.75.75 0 0 0-.75-.75h-.008ZM18 17.25a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <p class="text-2xl font-bold" id="total-industri"><?= $totalIndustri ?? 0; ?></p>
                    <h3 class="text-sm text-slate-500">Total Siswa Industri</h3>
                </div>
            </a>
        </li>
    </ul>

    <div class="set-flex flex-col lg:flex-row items-start mt-5 gap-6 lg:min-h-[300px] lg:h-[300px] w-full">
        <!-- Table -->
        <div class="w-full lg:w-[60%] rounded-xl bg-light-card dark:bg-dark-card border-2 border-light-shadow dark:border-dark-shadow shadow-md h-full">
            <div class="set-flex flex-col items-start m-3 mb-6 ml-4">
                <h4 class="text-lg md:text-xl font-semibold">Jadwal Konseling Mendatang</h4>
                <p class="text-sm text-slate-500">Lihat jadwal konseling yang akan berlangsung dalam waktu dekat.</p>
            </div>
            <div class="max-h-[215px] overflow-auto">
                <table class="w-full text-left rounded-lg overflow-hidden">
                    <thead class="text-slate-500 dark:text-slate-400 text-left border-b border-light-shadow dark:border-dark-shadow">
                        <tr>
                            <th class="p-4 text-sm font-semibold pl-8">Siswa</th>
                            <th class="p-4 text-sm font-semibold">Kelas</th>
                            <th class="p-4 text-sm font-semibold">Konselor</th>
                            <th class="p-4 text-sm font-semibold pr-8">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="text-left">
                        <?php if (isset($jadwalKonseling) && !empty($jadwalKonseling)) : ?>
                            <?php foreach ($jadwalKonseling as $row) : ?>
                                <tr class="border-b border-light-shadow dark:border-dark-shadow hover:bg-light-shadow dark:hover:bg-dark-shadow text-sm odd-even-row">
                                    <td class="p-4 set-flex justify-start gap-2 pl-8 text-left">

                                        <?php if (esc($row['foto_siswa'] === "-") || esc($row['foto_siswa'] === null)) : ?>
                                            <div class="rounded-[50%] size-6 bg-slate-400 set-flex"></div>
                                        <?php else : ?>
                                            <img src="<?= base_url('/uploads/img_siswa/' . esc($row['foto_siswa'])); ?>" alt="" class="size-6 rounded-[50%]">
                                        <?php endif; ?>

                                        <span class="truncate w-28"><?= esc($row['nama_siswa']); ?></span>

                                    </td>
                                    <td class="p-4 text-slate-600 dark:text-slate-400 text-left"><?= esc($row['kelass']); ?></td>
                                    <td class="p-4 set-flex justify-start gap-2 text-left">

                                        <?php if (esc($row['foto_konselor'] === "-") || esc($row['foto_konselor'] === null)) : ?>
                                            <div class="rounded-[50%] size-6 bg-slate-400 set-flex"></div>
                                        <?php else : ?>
                                            <img src="<?= base_url('/uploads/img_konselor/' . esc($row['foto_konselor'])); ?>" alt="" class="size-6 rounded-[50%]">
                                        <?php endif; ?>

                                        <span class="truncate w-28"><?= esc($row['nama_konselor']); ?></span>

                                    </td>
                                    <td class="p-4 pr-8 text-left"><?= date('d-m-Y', strtotime(esc($row['tanggal']))); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td class="text-center px-4 py-6 text-xl" colspan="4">Belum ada jadwal konseling saat ini.
                                <td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="set-flex w-full lg:w-[40%] p-5 md:p-10 h-full shadow-md bg-light-card dark:bg-dark-card border-2 border-light-shadow dark:border-dark-shadow rounded-xl">
            <div class="w-full h-full set-flex flex-col">
                <h2 class="text-lg md:text-xl font-semibold mb-3">Jumlah Siswa berdasarkan jurusan</h2>
                <div id="donut" class="w-full h-full set-flex"></div>
            </div>
        </div>
    </div>

    <div class="set-flex flex-col lg:flex-row gap-6 mt-5 md:mt-7 h-full lg:min-h-[380px] lg:h-[380px]">
        <div id="distributed-column" class="w-full lg:w-[40%] bg-light-card dark:bg-dark-card border-2 border-light-shadow dark:border-dark-shadow shadow-md rounded-xl h-full set-flex"></div>
        <div id="spline-area" class="w-full lg:w-[60%] bg-light-card dark:bg-dark-card border-2 border-light-shadow dark:border-dark-shadow shadow-md rounded-xl h-full set-flex"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        animateNumber('total-siswa', <?= $totalSiswa; ?>);
        animateNumber('total-pelanggaran', <?= $totalPelanggaran; ?>);
        animateNumber('total-konseling', <?= $totalKonseling; ?>);
        animateNumber('total-industri', <?= $totalIndustri; ?>);
    });

    function animateNumber(elementId, targetNumber) {
        const element = document.getElementById(elementId);
        let currentNumber = 0;
        const increment = Math.ceil(targetNumber / 10);

        const interval = setInterval(() => {
            currentNumber += increment;

            if (currentNumber >= targetNumber) {
                currentNumber = targetNumber;
                clearInterval(interval);
            }

            element.innerText = currentNumber;
        }, 100);
    }

    window.chartDataUrl = "<?= site_url('/dashboard/getChartData'); ?>";
</script>
<script src="<?= base_url('/assets/js/apexcharts.bundle.js'); ?>"></script>

<?php if (session()->getFlashdata('modalMessage')) : ?>
    <script>
        window.history.replaceState(null, null, '/dashboard');
    </script>
<?php endif; ?>

<!-- Alert Message-->
<?= $this->include('layout/modal_message'); ?>

<!-- Modal Logic -->
<?= $this->include('layout/modal_logic'); ?>
<?php session()->remove('modalMessage'); ?>

<?= $this->endSection('content'); ?>