<?= $this->extend('index'); ?>

<?= $this->section('content'); ?>

<div class="w-full">
    <!-- Breadcrumb -->
    <ul class="flex items-center gap-2">
        <li><a href="<?= site_url('/dashboard'); ?>" class="text-light-text dark:text-dark-text text-xs md:text-sm">Dashboard</a></li>
        <li class="text-light-text dark:text-dark-text text-xs md:text-sm">/</li>
        <li>
            <a href="<?= site_url('/admin'); ?>" class="text-danger m-0 text-xs md:text-sm">Data Admin</a>
        </li>
    </ul>

    <!-- Header Section -->
    <header class="mb-3 mt-5 flex justify-between flex-row gap-2 md:gap-0">
        <h1 class="text-xl md:text-2xl font-bold pt-1 text-light-text dark:text-dark-text">Data Admin (<span><?= $totalAdmin; ?></span>)</h1>
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
        </div>
    </header>

    <!-- Search Form -->
    <section class="w-full">
        <form action="" method="get" autocomplete="off">
            <ul class="set-flex items-start md:items-center bg-light-card dark:bg-dark-card p-4 gap-3 rounded-xl shadow-md mb-6">
                <li class="w-full">
                    <label for="key" class="block mb-1 text-light-text dark:text-dark-text">Apa yang ingin anda cari?</label>
                    <div class="box-search-input">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 mx-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <input type="search" name="key" id="key" class="search-input" placeholder="Cari untuk username, email dan lain - lain" value="<?= $keyword ?? ''; ?>">
                    </div>

                </li>
                <li class="self-end">
                    <button type="submit" class="btn-gradient px-6 py-1.5 md:py-2 md:px-8 mb-0">Cari</button>
                </li>
            </ul>
        </form>
    </section>

    <!-- Table Data -->
    <section class="flex flex-col bg-light-card dark:bg-dark-card shadow-md rounded-xl">
        <div class="overflow-x-auto bg-light-card dark:bg-dark-card shadow-md rounded-xl overflow-hidden">
            <table class="w-full bg-light-card dark:bg-dark-card text-light-text dark:text-dark-text border border-none">
                <thead>
                    <tr>
                        <th class="border border-light-shadow dark:border-dark-shadow px-4 py-3">No</th>
                        <th class="border border-light-shadow dark:border-dark-shadow px-4 py-3">
                            <div class="set-flex gap-2">
                                <span>Username</span>
                                <a href="<?= site_url('/admin' . ($keyword ? '?key=' . $keyword . '&' : '?') . 'sort=username&order=' . ($next_order ?? 'desc')); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" fill="currentColor" class="w-2.5 cursor-pointer text-light-text dark:text-dark-text">
                                        <path d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8L32 224c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8l256 0c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                                    </svg>
                                </a>
                            </div>
                        </th>
                        <th class="border border-light-shadow dark:border-dark-shadow px-4 py-3">
                            <div class="set-flex gap-2">
                                <span>Email</span>
                                <a href="<?= site_url('/admin' . ($keyword ? '?key=' . $keyword . '&' : '?') . 'sort=email&order=' . ($next_order ?? 'desc')); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" fill="currentColor" class="w-2.5 cursor-pointer text-light-text dark:text-dark-text">
                                        <path d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8L32 224c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8l256 0c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                                    </svg>
                                </a>
                            </div>
                        </th>
                        <th class="border border-light-shadow dark:border-dark-shadow px-4 py-3">
                            <div class="set-flex gap-2">
                                <span>Tanggal Terdaftar</span>
                                <a href="<?= site_url('/admin' . ($keyword ? '?key=' . $keyword . '&' : '?') . 'sort=tanggal_terdaftar&order=' . ($next_order ?? 'desc')); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" fill="currentColor" class="w-2.5 cursor-pointer text-light-text dark:text-dark-text">
                                        <path d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8L32 224c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8l256 0c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                                    </svg>
                                </a>
                            </div>
                        </th>
                        <th class="border border-light-shadow dark:border-dark-shadow px-4 py-3">Status</th>
                        <th class="border border-light-shadow dark:border-dark-shadow px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php if (isset($admin) && !empty($admin)) : ?>
                        <?php foreach ($admin as $admn) : ?>
                            <tr class="odd-even-row">
                                <th class="border border-light-shadow dark:border-dark-shadow px-4 py-2"><?= $no++; ?></th>
                                <td class="border border-light-shadow dark:border-dark-shadow px-4 py-2"><?= esc($admn['username']); ?></td>
                                <td class="border border-light-shadow dark:border-dark-shadow px-4 py-2"><?= esc($admn['email']); ?></td>
                                <td class="border border-light-shadow dark:border-dark-shadow px-4 py-2"><?= convertToBaliTime(esc($admn['tanggal_terdaftar'])); ?></td>
                                <td class="border border-light-shadow dark:border-dark-shadow px-4 py-2">

                                    <?php
                                    $bg = match (esc($admn['status'])) {
                                        'aktif' => 'bg-green-600',
                                        'non-aktif'  => 'bg-red-600',
                                        default  => 'bg-gray-600',
                                    };
                                    ?>
                                    <span class="<?= $bg; ?> rounded-3xl py-1 px-3 w-max inline-block text-center text-sm text-white"><?= ucwords(esc($admn['status'])); ?></span>

                                </td>
                                <td class="border border-light-shadow dark:border-dark-shadow px-4 py-2.5">
                                    <div class="set-flex gap-1.5">
                                        <a href="<?= $urls[$admn['id_admin']]; ?>" class="btn-basic mb-0 px-4 py-1">Edit</a>
                                        <form action="<?= site_url('/admin/delete/' . esc($admn['id_admin']) . '?' . http_build_query($_GET)); ?>" method="post">

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
                            <td class="border border-light-shadow dark:border-dark-shadow px-4 py-5 text-xl" colspan="6">Data Admin belum ada.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<div class="modal hidden opacity-0 scale-0">
    <div class="modal-content hidden opacity-0 scale-0">
        <div class="close-modal hidden opacity-0 scale-0">
        </div>
    </div>
</div>

<!-- Form modal for Edit data -->
<div class="modal opacity-0 pointer-events-none transition-all duration-200 fixed inset-0 z-50 bg-dark-bg/60 dark:bg-light-bg/10 set-flex items-start">
    <div class="modal-content scale-0 transition-all duration-200 shadow-md w-full lg:w-3/5 overflow-auto m-0 max-h-screen mt-2">
        <?php if (isset($admn)) : ?>
            <?= $this->include('pages/admin/edit_admin'); ?>
        <?php endif; ?>
    </div>
</div>

<!-- Alert Message-->
<?= $this->include('layout/modal_message'); ?>

<!-- Modal Logic -->
<?= $this->include('layout/modal_logic'); ?>

<?= $this->endSection('content'); ?>