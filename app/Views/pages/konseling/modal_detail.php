<?php if (isset($konselingDetail) && isset($allKonselingData)) : ?>
    <div class="w-full relative bg-transparent py-[3.3rem] md:py-10 px-0 md:px-14 m-0 overflow-hidden">
        <div class="close-modal absolute right-0 top-0 overflow-visible text-light-text dark:text-dark-text set-flex bg-light-shadow dark:bg-dark-shadow transition-all duration-300 cursor-pointer p-2 rounded-[50%]">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-7 md:size-8">
                <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="set-flex flex-col md:flex-row bg-white rounded-xl overflow-hidden h-full md:max-h-[28rem]">

            <!-- Left Content -->
            <div class="w-full bg-custom-gradient px-4 py-3 h-[28rem]">
                <div class="flex justify-between items-center w-full">
                    <h3 class="text-base text-white self-start"><?= esc($konselingDetail['nama_konselor']); ?></h3>
                    <div class="flex flex-col items-end">
                        <span class="text-base text-white"><?= date("d - m - Y", strtotime(esc($konselingDetail['tanggal']))); ?></span>
                        <span class="text-xs italic text-white"><?= esc($konselingDetail['status']); ?></span>
                    </div>
                </div>

                <div class="set-flex flex-col mt-10 text-center">
                    <img src="<?= base_url('/uploads/img_siswa/' . esc($konselingDetail['foto'])); ?>" alt="profile image" class="size-24 rounded-[50%]">
                    <h3 class="text-lg text-white mt-2"><?= esc($konselingDetail['nama_siswa']); ?></h3>
                    <span class="text-base text-white"><?= esc($konselingDetail['kelass']); ?></span>
                </div>

                <!-- History Counseling Section -->
                <?php if ($allKonselingData != []) : ?>
                    <div class="mt-8">
                        <h4 class="text-lg text-white">Riwayat Konseling (<?= count($allKonselingData); ?>):</h4>
                        <div class="overflow-auto max-h-[8rem] mt-2 flex flex-col gap-3 pb-3">
                            <?php foreach ($allKonselingData as $data) : ?>
                                <div class="bg-light-card dark:bg-dark-card text-light-text dark:text-dark-text rounded-md py-3 px-4 h-full">
                                    <p class="text-sm font-bold">Tanggal: <?= date("d - m - Y", strtotime(esc($data['tanggal']))); ?></p>
                                    <p class="text-sm">Isu atau Permasalahan: <?= esc($data['permasalahan']); ?></p>
                                    <p class="text-sm">Tindakan: <?= esc($data['tindakan']); ?></p>
                                    <p class="text-sm">Catatan: <?= esc($data['catatan']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else :  ?>
                    <div class="mt-10">
                        <h4 class="text-lg text-white">Riwayat Konseling (<?= count($allKonselingData); ?>):</h4>
                        <div class="overflow-auto h-[7.4rem] mt-2 pb-2">
                            <div class="bg-light-card dark:bg-dark-card text-light-text dark:text-dark-text rounded-md py-3 h-full px-4 set-flex">
                                <p class="text-lg font-bold text-center">Belum ada riwayat konseling untuk siswa ini.</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>


            <!-- Right Content -->
            <div class="w-full set-flex items-start flex-col bg-light-card dark:bg-dark-card text-light-text dark:text-dark-text px-5 py-4 gap-4">
                <div class="flex flex-col gap-1 w-full">
                    <h4 class="text-base">Isu atau Permasalahan :</h4>
                    <div class="bg-light-shadow dark:bg-dark-shadow py-2 px-3 rounded-md overflow-auto min-h-20 max-h-20 h-full w-full">
                        <p><?= esc($konselingDetail['permasalahan']); ?></p>
                    </div>
                </div>
                <div class="flex flex-col gap-1 w-full">
                    <h4 class="text-base">Tindakan yang diberikan :</h4>
                    <div class="bg-light-shadow dark:bg-dark-shadow py-2 px-3 rounded-md overflow-auto min-h-20 max-h-20 h-full w-full">
                        <p><?= esc($konselingDetail['tindakan']); ?></p>
                    </div>
                </div>
                <div class="flex flex-col gap-1 w-full">
                    <h4 class="text-base">Catatan atau kesimpulan :</h4>
                    <div class="bg-light-shadow dark:bg-dark-shadow py-2 px-3 rounded-md overflow-auto min-h-20 max-h-20 h-full w-full">
                        <p><?= esc($konselingDetail['catatan']); ?></p>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="set-flex gap-1.5 mt-2">
                    <a href="<?= site_url('/jadwal/edit/' . esc($konselingDetail['konseling_slug']) . '?' . http_build_query($_GET)); ?>" class="btn-basic bg-custom-gradient text-white">Edit</a>
                    <form action="<?= site_url('/jadwal/delete/' . esc($konselingDetail['id_konseling']) . '?' . http_build_query($_GET)); ?>" method="post">

                        <?= csrf_field(); ?>

                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn-basic" onclick="return confirm('Yakin ingin hapus???')">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>