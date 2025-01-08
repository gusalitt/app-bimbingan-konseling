<?= $this->extend('index'); ?>

<?= $this->section('content'); ?>

<div class="w-full">
    <!-- Breadcrumb -->
    <ul class="flex items-center gap-2">
        <li><a href="<?= site_url('/dashboard'); ?>" class="text-light-text dark:text-dark-text text-xs md:text-sm">Dashboard</a></li>
        <li class="text-light-text dark:text-dark-text text-xs md:text-sm">/</li>
        <li>
            <p class="text-light-text dark:text-dark-text text-xs md:text-sm">Pelanggaran</p>
        </li>
        <li class="text-light-text dark:text-dark-text text-xs md:text-sm">/</li>
        <li>
            <a href="<?= site_url('/pelanggaran'); ?>" class="text-danger m-0 text-xs md:text-sm">Data Pelanggaran</a>
        </li>
    </ul>

    <!-- Header Section -->
    <header class="mb-3 mt-5 flex justify-between flex-row gap-2 md:gap-0">
        <h1 class="text-xl md:text-2xl font-bold pt-1 text-light-text dark:text-dark-text">Data Pelanggaran (<span><?= $totalPelanggaran; ?></span>)</h1>
        <div class="flex items-center justify-end gap-2">
            <button onclick="printData()" type="button" class="btn-basic relative group">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd" d="M7.875 1.5C6.839 1.5 6 2.34 6 3.375v2.99c-.426.053-.851.11-1.274.174-1.454.218-2.476 1.483-2.476 2.917v6.294a3 3 0 0 0 3 3h.27l-.155 1.705A1.875 1.875 0 0 0 7.232 22.5h9.536a1.875 1.875 0 0 0 1.867-2.045l-.155-1.705h.27a3 3 0 0 0 3-3V9.456c0-1.434-1.022-2.7-2.476-2.917A48.716 48.716 0 0 0 18 6.366V3.375c0-1.036-.84-1.875-1.875-1.875h-8.25ZM16.5 6.205v-2.83A.375.375 0 0 0 16.125 3h-8.25a.375.375 0 0 0-.375.375v2.83a49.353 49.353 0 0 1 9 0Zm-.217 8.265c.178.018.317.16.333.337l.526 5.784a.375.375 0 0 1-.374.409H7.232a.375.375 0 0 1-.374-.409l.526-5.784a.373.373 0 0 1 .333-.337 41.741 41.741 0 0 1 8.566 0Zm.967-3.97a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H18a.75.75 0 0 1-.75-.75V10.5ZM15 9.75a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V10.5a.75.75 0 0 0-.75-.75H15Z" clip-rule="evenodd" />
                </svg>
                <span class="icon-tooltip">Print</span>
                <span class="hidden md:inline">Print</span>
            </button>

            <!-- To Print Data -->
            <iframe id="printFrame" style="display:none;"></iframe>
            <?= $this->include('print/print_data'); ?>

            <button class="open-modal btn-gradient relative group">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
                </svg>
                <span class="icon-tooltip">Tambah Data</span>
                <span class="hidden md:inline">Tambah Data</span>
            </button>
        </div>

        <!-- Form modal for Add data -->
        <div class="modal opacity-0 pointer-events-none transition-all duration-200 fixed inset-0 z-50 bg-dark-bg/60 dark:bg-light-bg/10 set-flex items-start">
            <div class="modal-content scale-0 transition-all duration-200 shadow-md w-full lg:w-3/5 overflow-auto m-0 max-h-screen">
                <?= $this->include('pages/pelanggaran/tambah_pelanggaran'); ?>
            </div>
        </div>
    </header>

    <!-- Search Form -->
    <section class="w-full">
        <form action="" method="get" autocomplete="off">
            <ul class="set-flex flex-col items-start md:items-center md:flex-row  bg-light-card dark:bg-dark-card p-4 gap-3 rounded-xl shadow-md mb-6">
                <li class="w-full">
                    <label for="key" class="block mb-1 text-light-text dark:text-dark-text">Apa yang ingin anda cari?</label>
                    <div class="box-search-input">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 mx-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <input type="search" name="key" id="key" class="search-input" placeholder="Cari untuk nama siswa, jenis pelanggaran dan lain - lain" value="<?= $keyword ?? ''; ?>">
                    </div>

                </li>
                <li class="w-full md:w-1/2">
                    <label for="kategoriTingkatPelanggaran" class="block mb-1 text-light-text dark:text-dark-text">Kategori Tingkat Pelanggaran</label>
                    <select name="kategoriTingkatPelanggaran" id="kategoriTingkatPelanggaran" class="category-input">
                        <option value="" selected>Semua</option>
                        <option value="ringan" <?= is_selected($kategori_tingkat_pelanggaran, 'ringan'); ?>>Ringan</option>
                        <option value="sedang" <?= is_selected($kategori_tingkat_pelanggaran, 'sedang'); ?>>Sedang</option>
                        <option value="berat" <?= is_selected($kategori_tingkat_pelanggaran, 'berat'); ?>>Berat</option>
                    </select>
                </li>
                <li class="self-start md:self-end">
                    <button type="submit" class="btn-gradient px-6 py-1.5 md:py-2 md:px-8 mb-0">Cari</button>
                </li>
            </ul>
        </form>
    </section>

    <!-- Table Data -->
    <section class="flex flex-col bg-light-card dark:bg-dark-card shadow-md rounded-xl">
        <ul class="flex items-start justify-between flex-col lg:flex-row gap-4 lg:gap-0 w-full p-4 text-light-text dark:text-dark-text">
            <li class="w-full flex items-start lg:items-center flex-col md:flex-row lg:flex-row gap-3 lg:gap-0 m-0 lg:ml-1">
                <div class="w-full md:w-1/2 md:set-flex md:flex-col md:gap-y-1 md:items-start lg:w-auto lg:block">
                    <label for="show">Show : </label>
                    <select name="show" id="show" class="show-select category-input w-full lg:w-36 m-0 lg:mr-[0.8rem] lg:ml-2"">
                        <?php $options = [5, 10, 15, 20, 25]; ?>

                        <?php foreach ($options as $option) : ?>
                            <?php if ($totalPelanggaran >= $option) : ?>
                                <option value="<?= $option; ?>" <?= is_selected($show, $option, $totalPelanggaran); ?>><?= $option; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <option value="<?= $totalPelanggaran; ?>" <?= is_selected($show, $totalPelanggaran, $totalPelanggaran); ?>>Semua Baris</option>
                    </select>
                </div>

                <div class="w-full md:w-1/2 md:set-flex md:flex-col md:gap-y-1 md:items-start lg:w-auto lg:block">
                    <label for="sort">Urutkan : </label>
                    <select name="sort" id="sort" class="sort-select category-input w-full lg:w-40 m-0 lg:mr-[0.8rem] lg:ml-2">
                        <option value="nama_siswa" <?= is_selected($sort, 'nama_siswa'); ?>>Nama siswa</option>
                        <option value="pelanggaran" <?= is_selected($sort, 'pelanggaran'); ?>>Pelanggaran</option>
                        <option value="tingkat_pelanggaran" <?= is_selected($sort, 'tingkat_pelanggaran'); ?>>Tingkat Pelanggaran</option>
                        <option value="tindakan" <?= is_selected($sort, 'tindakan'); ?>>Tindakan</option>
                        <option value="tanggal" <?= is_selected($sort, 'tanggal'); ?>>Tanggal</option>
                        <option value="terlama" <?= is_selected($sort, 'terlama'); ?>>Data Terlama</option>
                        <option value="terbaru" <?= is_selected($sort, 'terbaru'); ?>>Data Terbaru</option>
                    </select>
                </div>
            </li>

            <!-- Pagination -->
            <li class="self-center lg:self-auto">
                <?= $pager->links('default', 'pelanggaran_pagination'); ?>
            </li>
        </ul>

        <div class="overflow-x-auto bg-light-card dark:bg-dark-card shadow-md rounded-xl overflow-hidden">
            <table class="w-full bg-light-card dark:bg-dark-card text-light-text dark:text-dark-text border border-none">
                <thead>
                    <tr>
                        <th class="border border-light-shadow dark:border-dark-shadow px-3 py-3">No</th>
                        <th class="border border-light-shadow dark:border-dark-shadow px-3 py-3">Nama siswa</th>
                        <th class="border border-light-shadow dark:border-dark-shadow px-3 py-3">Kelas</th>
                        <th class="border border-light-shadow dark:border-dark-shadow px-3 py-3">Pelangaran</th>
                        <th class="border border-light-shadow dark:border-dark-shadow px-1 py-3">Tingkat Pelanggaran</th>
                        <th class="border border-light-shadow dark:border-dark-shadow px-3 py-3">Tindakan</th>
                        <th class="border border-light-shadow dark:border-dark-shadow px-3 py-3">Tanggal</th>
                        <th class="border border-light-shadow dark:border-dark-shadow px-3 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = $itemStart + 1; ?>
                    <?php if (isset($pelanggaran) && !empty($pelanggaran)) : ?>
                        <?php foreach ($pelanggaran as $plngrn) : ?>
                            <tr class="odd-even-row">
                                <th class="border border-light-shadow dark:border-dark-shadow px-4 py-2"><?= $no++; ?></th>
                                <td class="border border-light-shadow dark:border-dark-shadow px-4 py-2"><?= esc($plngrn['nama_siswa']); ?></td>
                                <td class="border border-light-shadow dark:border-dark-shadow px-4 py-2"><?= esc($plngrn['kelass']); ?></td>
                                <td class="border border-light-shadow dark:border-dark-shadow px-4 py-2"><?= esc($plngrn['pelanggaran']); ?></td>
                                <td class="border border-light-shadow dark:border-dark-shadow px-4 py-2">

                                    <?php
                                    $bg = match (esc($plngrn['tingkat_pelanggaran'])) {
                                        'ringan' => 'bg-green-600',
                                        'sedang' => 'bg-yellow-500',
                                        'berat'  => 'bg-red-600',
                                        default  => 'bg-gray-600',
                                    };
                                    ?>
                                    <span class="<?= $bg; ?> rounded-3xl py-1 px-3 w-max inline-block text-center text-sm text-white"><?= ucwords(esc($plngrn['tingkat_pelanggaran'])); ?></span>

                                </td>
                                <td class="border border-light-shadow dark:border-dark-shadow px-4 py-2"><?= esc($plngrn['tindakan']); ?></td>
                                <td class="border border-light-shadow dark:border-dark-shadow px-4 py-2"><?= date('d-m-Y', strtotime(esc($plngrn['tanggal']))); ?></td>
                                <td class="border border-light-shadow dark:border-dark-shadow px-2 py-2.5">
                                    <div class="set-flex gap-1.5">
                                        <a href="<?= $urlsToEditPelanggaran[$plngrn['id_pelanggaran']]; ?>" class="btn-basic mb-0 px-4 py-1">Edit</a>
                                        <form action="<?= site_url('/pelanggaran/delete/' . esc($plngrn['id_pelanggaran']) . '?' . http_build_query($_GET)); ?>" method="post">

                                            <?= csrf_field(); ?>

                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn-basic mb-0 px-4 py-1" onclick="return confirm('Yakin ingin hapus???')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr class="text-center">
                            <td class="border border-light-shadow dark:border-dark-shadow px-4 py-5 text-xl" colspan="8">Data Pelanggaran belum ada.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<!-- Form modal for Edit data -->
<div class="modal opacity-0 pointer-events-none transition-all duration-200 fixed inset-0 z-50 bg-dark-bg/60 dark:bg-light-bg/10 set-flex items-start">
    <div class="modal-content scale-0 transition-all duration-200 shadow-md w-full lg:w-3/5 overflow-auto m-0 max-h-screen">
        <?php if (isset($plngrn)) : ?>
            <?= $this->include('pages/pelanggaran/edit_pelanggaran'); ?>
        <?php endif; ?>
    </div>
</div>

<!-- Alert Message-->
<?= $this->include('layout/modal_message'); ?>

<!-- Modal Logic -->
<?= $this->include('layout/modal_logic'); ?>

<?= $this->endSection('content'); ?>