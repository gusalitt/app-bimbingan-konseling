<?= $this->extend('index'); ?>

<?= $this->section('content'); ?>
<!-- Breadcrumb -->
<ul class="flex items-center gap-2 mb-3 pl-1">
    <li><a href="<?= site_url('/dashboard'); ?>" class="text-light-text dark:text-dark-text text-xs md:text-sm">Dashboard</a></li>
    <li class="text-light-text dark:text-dark-text text-xs md:text-sm">/</li>
    <li><p class="text-light-text dark:text-dark-text text-xs md:text-sm">Pelanggaran</p></li>
    <li class="text-light-text dark:text-dark-text text-xs md:text-sm">/</li>
    <li><a href="<?= $_SERVER['REQUEST_URI']; ?>" class="text-danger m-0 text-xs md:text-sm">Riwayat Pelanggaran</a></li>
</ul>

<div class="w-full">
    <ul class="w-full ">
        <li class="w-full bg-custom-gradient h-44 rounded-tr-md rounded-tl-md">
            <div class="flex flex-col text-white py-3 px-4">
                <h1 class="text-lg font-semibold"><?= esc($pelanggaranData[0]['nama_siswa']); ?></h1>
                <p class="text-sm"><?= esc($pelanggaranData[0]['kelass']); ?></p>
            </div>
        </li>
        <li class="w-full bg-light-card dark:bg-dark-card h-full relative flex items-end pb-3 rounded-bl-md rounded-br-md shadow-sm">
            <div class="set-flex w-32 h-32 rounded-[50%] overflow-hidden absolute -top-16 left-[50.3%] -translate-x-1/2 border-8 border-light-card dark:border-dark-card">
                <img src="<?= site_url('/uploads/img_siswa/' . esc($pelanggaranData[0]['foto'])); ?>" alt="foto_siswa" class="w-full">
            </div>
            <ul class="flex flex-col md:flex-row gap-5 md:gap-0 justify-around items-center w-full pt-20 text-light-text dark:text-dark-text">
                <li class="set-flex flex-col">
                    <span class="text-2xl font-semibold"><?= $totalPelanggaran['total_ringan']; ?></span>
                    <p class="text-lg">Pelanggaran Ringan</p>
                </li>
                <li class="set-flex flex-col">
                    <span class="text-2xl font-semibold"><?= $totalPelanggaran['total_sedang']; ?></span>
                    <p class="text-lg">Pelanggaran Sedang</p>
                </li>
                <li class="set-flex flex-col">
                    <span class="text-2xl font-semibold"><?= $totalPelanggaran['total_berat']; ?></span>
                    <p class="text-lg">Pelanggaran Berat</p>
                </li>
            </ul>
        </li>
    </ul>

    <ul>
        <?php $previousDate = null; ?>
        <?php $no = 1; ?>

        <?php foreach ($pelanggaranData as $index => $pelanggaran) : ?>

            <?php $currentDate = $pelanggaran['tanggal']; ?>
            <?php if ($previousDate != $currentDate) : ?>
                <?php $no = 1; ?>
                <li class="mt-12 flex justify-center flex-col gap-1">
                    <span class="bg-purple-700 w-max rounded-md text-white py-1.5 px-4 text-lg font-semibold"><?= indoDateFormat(esc($currentDate)); ?></span>
                    <div class="border-l-[6px] border-l-slate-300 dark:border-l-slate-700 ml-5 md:ml-7 mt-2 flex flex-col gap-8">
                        <ul class="flex flex-col gap-5">
            <?php endif; ?>

                            <li class="relative">
                                <span class="bg-pink-600 absolute top-0 -left-5 rounded-[50%] size-9 set-flex text-white"><?= $no; ?></span>
                                <div class="bg-light-card dark:bg-dark-card shadow-md border-2 border-light-shadow dark:border-dark-shadow ml-9 rounded-md flex flex-col py-2 px-4 gap-6">
                                    <?php
                                    $bg = match (esc($pelanggaran['tingkat_pelanggaran'])) {
                                        'ringan' => 'bg-green-600',
                                        'sedang' => 'bg-yellow-500',
                                        'berat'  => 'bg-red-600',
                                        default  => 'bg-gray-600',
                                    };
                                    ?>
                                    <h3 class="text-lg pb-1.5 border-b-2 border-purple-800 text-purple-600 font-semibold">Pelanggaran <span class="<?= $bg; ?> text-white px-3 py-px rounded-md"><?= esc($pelanggaran['tingkat_pelanggaran']); ?></span></h3>
                                    <p class="text-sm text-light-text dark:text-dark-text"><?= esc($pelanggaran['pelanggaran']); ?></p>
                                </div>
                            </li>
                            <li class="relative">
                                <span class="bg-fuchsia-600 absolute top-0 -left-5 rounded-[50%] size-9 set-flex text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                        <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z" clip-rule="evenodd" />
                                        <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375Zm9.586 4.594a.75.75 0 0 0-1.172-.938l-2.476 3.096-.908-.907a.75.75 0 0 0-1.06 1.06l1.5 1.5a.75.75 0 0 0 1.116-.062l3-3.75Z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <div class="bg-light-card dark:bg-dark-card shadow-md border-2 border-light-shadow dark:border-dark-shadow  ml-9 rounded-md flex flex-col py-2 px-4 gap-6">
                                    <h3 class="text-lg pb-1 border-b-2 border-purple-800 text-purple-600 font-semibold">Tindakan yang diberikan</h3>
                                    <p class="text-sm text-light-text dark:text-dark-text"><?= esc($pelanggaran['tindakan']); ?></p>
                                </div>
                            </li>

            <?php if (($index + 1 == count($pelanggaranData)) || ($pelanggaranData[$index + 1]['tanggal'] != $currentDate)) : ?>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>

            <?php $previousDate = $currentDate; ?>
            <?php $no++; ?>
        <?php endforeach; ?>
    </ul>
</div>


<?= $this->endSection('content'); ?>