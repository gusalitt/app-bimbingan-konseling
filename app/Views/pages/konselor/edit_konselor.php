<?php if (isset($kslr)) : ?>
    <?php $modalType = (session()->getFlashdata('modalType') === 'edit') ?>

    <form action="<?= $urlToEditForm; ?>" method="post" enctype="multipart/form-data" class="w-full bg-light-card dark:bg-dark-card text-light-text dark:text-dark-text py-8 px-9 rounded-xl relative"">

        <?= csrf_field(); ?>

        <div class="close-modal absolute right-0 top-0 p-2 rounded-tr-xl rounded-bl-xl cursor-pointer bg-custom-gradient text-white">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>

        </div>

        <div class="flex items-center gap-1 mb-5">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8">
                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
            </svg>

            <h1 class="text-2xl font-semibold">Edit Konselor</h1>
        </div>

        <!-- Foto Konselor -->
        <div class="mb-5">
            <label for="fotoKonselorEdit" class="block text-sm font-bold mb-2">Foto Konselor:</label>
            <input
                type="file"
                id="fotoKonselorEdit"
                name="fotoKonselor"
                placeholder="Masukkan foto Konselor"
                class="basic-input focus:outline-none focus:shadow-outline <?= ($validation->hasError('fotoKonselor') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>"
                value="<?= $oldEditData['fotoKonselor'] ?? esc($kslr['foto']); ?>">
            <?php if ($validation->hasError('fotoKonselor') && $modalType) : ?>
                <div class="text-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <?= $validation->getError('fotoKonselor'); ?>
                </div>
            <?php endif ?>
        </div>

        <!-- Nama Konselor -->
        <div class="mb-5">
            <label for="namaKonselorEdit" class="block text-sm font-bold mb-2">Nama Konselor:</label>
            <input
                type="text"
                id="namaKonselorEdit"
                name="namaKonselor"
                placeholder="Masukkan nama konselor"
                required
                class="basic-input focus:outline-none focus:shadow-outline <?= ($validation->hasError('namaKonselor') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>"
                value="<?= $oldEditData['namaKonselor'] ?? esc($kslr['nama_konselor']); ?>">
            <?php if ($validation->hasError('namaKonselor') && $modalType) : ?>
                <div class="text-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <?= $validation->getError('namaKonselor'); ?>
                </div>
            <?php endif ?>
        </div>

        <!-- No Telp -->
        <div class="mb-5">
            <label for="noTelpEdit" class="block text-sm font-bold mb-2">No Telp:</label>
            <input
                type="number"
                id="noTelpEdit"
                name="noTelp"
                placeholder="Masukkan no telp"
                inputmode="numeric"
                required
                class="basic-input focus:outline-none focus:shadow-outline <?= ($validation->hasError('noTelp') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>"
                value="<?= $oldEditData['noTelp'] ?? esc($kslr['no_telp']); ?>">
            <?php if ($validation->hasError('noTelp') && $modalType) : ?>
                <div class="text-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <?= $validation->getError('noTelp'); ?>
                </div>
            <?php endif ?>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between">
            <button type="submit"
                class="btn-gradient">
                Edit Konselor
            </button>
        </div>
    </form>

<?php endif; ?>