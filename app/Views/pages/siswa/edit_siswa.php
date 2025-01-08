<?php if (isset($ssw)) : ?>
<?php $modalType = (session()->getFlashdata('modalType') === 'edit')?>

    <form action="<?= $urlToEditForm; ?>" method="post" enctype="multipart/form-data" class="w-full bg-light-card dark:bg-dark-card text-light-text dark:text-dark-text py-8 px-9 rounded-xl relative">

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

            <h1 class="text-2xl font-semibold">Edit Siswa</h1>
        </div>

        <!-- Foto Siswa -->
        <div class="mb-5">
            <label for="fotoSiswaEdit" class="block text-sm font-bold mb-2">Foto siswa:</label>
            <input
                type="file"
                id="fotoSiswaEdit"
                name="fotoSiswa"
                placeholder="Masukkan foto siswa"
                class="basic-input focus:outline-none focus:shadow-outline <?= ($validation->hasError('fotoSiswa') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>"
                value="<?= $oldEditData['fotoSiswa'] ?? esc($ssw['foto']); ?>">
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
            <label for="namaSiswaEdit" class="block text-sm font-bold mb-2">Nama siswa:</label>
            <input
                type="text"
                id="namaSiswaEdit"
                name="namaSiswa"
                placeholder="Masukkan nama siswa"
                required
                class="basic-input focus:outline-none focus:shadow-outline <?= ($validation->hasError('namaSiswa') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>"
                value="<?= $oldEditData['namaSiswa'] ?? esc($ssw['nama_siswa']); ?>">
            <?php if ($validation->hasError('namaSiswa') && $modalType) : ?>
                <div class="text-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <?= $validation->getError('namaSiswa'); ?>
                </div>
            <?php endif ?>
        </div>

        <!-- NISN siswa -->
        <div class="mb-5">
            <label for="nisnEdit" class="block text-sm font-bold mb-2">NISN:</label>
            <input
                type="number"
                id="nisnEdit"
                name="nisn"
                placeholder="Masukkan NISN siswa"
                inputmode="numeric"
                required
                class="basic-input focus:outline-none focus:shadow-outline <?= ($validation->hasError('nisn') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>"
                value="<?= $oldEditData['nisn'] ?? esc($ssw['nisn']); ?>">
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
            <label for="kelasEdit" class="block text-sm font-bold mb-2">Kelas:</label>
            <input
                type="text"
                id="kelasEdit"
                name="kelas"
                placeholder="Masukkan kelas siswa"
                required
                class="basic-input focus:outline-none focus:shadow-outline <?= ($validation->hasError('kelas') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>"
                value="<?= $oldEditData['kelas'] ?? esc($ssw['kelas']); ?>">
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
            <label for="jurusanEdit" class="block text-sm font-bold mb-2">Jurusan:</label>
            <select
                id="jurusanEdit"
                name="jurusan"
                required
                class="basic-input focus:outline-none focus:shadow-outline appearance-auto <?= ($validation->hasError('jurusan') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>">
                <option value="" selected disabled>Pilih Jurusan</option>
                <?php if (isset($jurusan)) : ?>
                    <?php foreach ($jurusan as $row) : ?>
                        <option value="<?= esc($row['nama_jurusan']); ?>"
                            <?= (($oldEditData['jurusan'] ?? esc($ssw['jurusan'])) == esc($row['nama_jurusan'])) ? 'selected' : '' ?>>
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
                Edit Siswa
            </button>
        </div>
    </form>

<?php endif; ?>