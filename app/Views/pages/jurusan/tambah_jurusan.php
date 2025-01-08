<?php $modalType = (session()->getFlashdata('modalType') === 'add')?>

<form action="<?= $urlToAddForm; ?>" method="post" class="w-full bg-light-card dark:bg-dark-card text-light-text dark:text-dark-text py-8 px-9 rounded-xl relative">

    <?= csrf_field(); ?>

    <div class="close-modal absolute right-0 top-0 p-2 rounded-tr-xl rounded-bl-xl cursor-pointer bg-custom-gradient text-white">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
            <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
        </svg>

    </div>

    <div class="flex items-center gap-1 mb-5">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8">
            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
        </svg>
        <h1 class="text-2xl font-semibold">Tambah Jurusan</h1>
    </div>

    <!-- Nama Jurusan -->
    <div class="mb-5">
        <label for="jurusan" class="block text-sm font-bold mb-2">Nama Jurusan:</label>
        <input
            type="text"
            id="jurusan"
            name="jurusan"
            placeholder="Masukkan nama jurusan"
            required
            class="basic-input focus:outline-none focus:shadow-outline <?= ($validation->hasError('jurusan') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>"
            value="<?= $oldAddData['jurusan'] ?? ''; ?>">
        <?php if ($validation->hasError('jurusan') && $modalType) : ?>
            <div class="text-danger">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <?= $validation->getError('jurusan'); ?>
            </div>
        <?php endif ?>
    </div>

    <!-- Deskripsi-->
    <div class="mb-5">
        <label for="deskripsi" class="block text-sm font-bold mb-2">Deskripsi:</label>
        <input type="text" id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi jurusan"
            class="basic-input focus:outline-none focus:shadow-outline" value="<?= $oldAddData['deskripsi'] ?? ''; ?>">
    </div>

    <!-- Submit Button -->
    <div class="flex items-center justify-between">
        <button type="submit"
            class="btn-gradient">
            Tambah Jurusan
        </button>
    </div>
</form>