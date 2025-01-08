<?php $modalType = (session()->getFlashdata('modalType') === 'add')?>

<form action="<?= $urlToAddForm; ?>" method="post" enctype="multipart/form-data" class="w-full bg-light-card dark:bg-dark-card text-light-text dark:text-dark-text py-8 px-9 rounded-xl relative">

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
        <h1 class="text-2xl font-semibold">Tambah Siswa</h1>
    </div>

    <!-- Foto Siswa -->
    <div class="mb-5">
        <label for="fotoSiswa" class="block text-sm font-bold mb-2">Foto Siswa:</label>
        <input
            type="file"
            id="fotoSiswa"
            name="fotoSiswa"
            placeholder="Masukkan foto siswa"
            class="basic-input focus:outline-none focus:shadow-outline <?= ($validation->hasError('fotoSiswa') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>"
            value="<?= $oldAddData['fotoSiswa'] ?? ''; ?>">
        <?php if ($validation->hasError('fotoSiswa') && $modalType) : ?>
            <div class="text-danger">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <?= $validation->getError('fotoSiswa'); ?>
            </div>
        <?php endif ?>
    </div>

    <!-- Nama Siswa -->
    <div class="mb-5">
        <label for="namaSiswa" class="block text-sm font-bold mb-2">Nama Siswa:</label>
        <input
            type="text"
            id="namaSiswa"
            name="namaSiswa"
            placeholder="Masukkan nama siswa"
            required
            class="basic-input focus:outline-none focus:shadow-outline <?= ($validation->hasError('namaSiswa') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>"
            value="<?= $oldAddData['namaSiswa'] ?? ''; ?>">
        <?php if ($validation->hasError('namaSiswa') && $modalType) : ?>
            <div class="text-danger">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <?= $validation->getError('namaSiswa'); ?>
            </div>
        <?php endif ?>
    </div>

    <!-- NISN Siswa -->
    <div class="mb-5">
        <label for="nisn" class="block text-sm font-bold mb-2">NISN:</label>
        <input
            type="number"
            id="nisn"
            name="nisn"
            placeholder="Masukkan NISN siswa"
            inputmode="numeric"
            required
            class="basic-input focus:outline-none focus:shadow-outline <?= ($validation->hasError('nisn') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>"
            value="<?= $oldAddData['nisn'] ?? ''; ?>">
        <?php if ($validation->hasError('nisn') && $modalType) : ?>
            <div class="text-danger">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <?= $validation->getError('nisn'); ?>
            </div>
        <?php endif ?>
    </div>

    <!-- Kelas Siswa -->
    <div class="mb-5">
        <label for="kelas" class="block text-sm font-bold mb-2">Kelas:</label>
        <input
            type="text"
            id="kelas"
            name="kelas"
            placeholder="Masukkan kelas siswa"
            required
            class="basic-input focus:outline-none focus:shadow-outline <?= ($validation->hasError('kelas') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>"
            value="<?= $oldAddData['kelas'] ?? ''; ?>">
        <?php if ($validation->hasError('kelas') && $modalType) : ?>
            <div class="text-danger">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <?= $validation->getError('kelas'); ?>
            </div>
        <?php endif ?>
    </div>

    <!-- Jurusan Siswa -->
    <div class="mb-5">
        <label for="jurusan" class="block text-sm font-bold mb-2">Jurusan:</label>
        <select
            id="jurusan"
            name="jurusan"
            required
            class="basic-input focus:outline-none focus:shadow-outline appearance-auto <?= ($validation->hasError('jurusan') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>">
            <option value="" selected disabled>Pilih Jurusan</option>
            <?php if (isset($jurusan)) : ?>
                <?php foreach ($jurusan as $row) : ?>
                    <option value="<?= esc($row['nama_jurusan']); ?>"
                        <?= (($oldAddData['jurusan'] ?? '') == esc($row['nama_jurusan'])) ? 'selected' : '' ?>>
                        <?= esc($row['nama_jurusan']); ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <?php if ($validation->hasError('jurusan') && $modalType) : ?>
            <div class="text-danger">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <?= $validation->getError('jurusan'); ?>
            </div>
        <?php endif ?>
    </div>

    <!-- Submit Button -->
    <div class="flex items-center justify-between">
        <button type="submit"
            class="btn-gradient">
            Tambah Siswa
        </button>
    </div>
</form>