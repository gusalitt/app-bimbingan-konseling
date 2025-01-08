<?php $modalType = (session()->getFlashdata('modalType') === 'add') ?>

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
        <h1 class="text-2xl font-semibold">Tambah Pelanggaran</h1>
    </div>

    <?php if ($validation->hasError('siswa_id') && $modalType) : ?>
        <div class="text-danger mt-0 text-md bg-red-200/50 dark:bg-red-900/20 w-full border border-red-500 rounded-lg p-2.5 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>
            <?= $validation->getError('siswa_id'); ?>
        </div>
    <?php endif; ?>

    <!-- Nama Siswa -->
    <div class="mb-5">
        <label for="namaSiswa" class="block text-sm font-bold mb-2">Nama Siswa:</label>
        <div class="relative">
            <input
                type="text"
                id="namaSiswa"
                name="namaSiswa"
                placeholder="Cari nama siswa"
                autocomplete="off"
                required
                class="basic-input focus:outline-none focus:shadow-outline <?= ($validation->hasError('namaSiswa') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>"
                value="<?= $oldAddData['namaSiswa'] ?? '' ?>">
            <div id="autocomplete-list" class="autocomplete-items"></div>
        </div>
        <?php if ($validation->hasError('namaSiswa') && $modalType) : ?>
            <div class="text-danger">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <?= $validation->getError('namaSiswa') ?>
            </div>
        <?php endif ?>
        <input type="hidden" name="siswa_id" id="siswa_id" value="<?= $oldAddData['siswa_id'] ?? ''; ?>">
    </div>

    <!-- Pelanggaran  -->
    <div class="mb-5">
        <label for="pelanggaran" class="block text-sm font-bold mb-2">Jenis Pelanggaran:</label>
        <input
            type="text"
            id="pelanggaran"
            name="pelanggaran"
            placeholder="Masukkan jenis pelanggaran siswa"
            required
            class="basic-input focus:outline-none focus:shadow-outline <?= ($validation->hasError('pelanggaran') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>"
            value="<?= $oldAddData['pelanggaran'] ?? ''; ?>">
        <?php if ($validation->hasError('pelanggaran') && $modalType) : ?>
            <div class="text-danger">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <?= $validation->getError('pelanggaran'); ?>
            </div>
        <?php endif ?>
    </div>

    <!-- Tingkat Pelanggaran Siswa -->
    <div class="mb-5">
        <label for="tingkatPelanggaran" class="block text-sm font-bold mb-2">Tingkat Pelanggaran:</label>
        <select
            id="tingkatPelanggaran"
            name="tingkatPelanggaran"
            required
            class="basic-input focus:outline-none focus:shadow-outline appearance-auto <?= ($validation->hasError('tingkatPelanggaran') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>">
            <option value="" selected disabled>Pilih Tingkat Pelanggaran</option>
            <option value="ringan" <?= is_selected(($oldAddData['tingkatPelanggaran'] ?? ''), 'ringan'); ?>>Ringan</option>
            <option value="sedang" <?= is_selected(($oldAddData['tingkatPelanggaran'] ?? ''), 'sedang'); ?>>Sedang</option>
            <option value="berat" <?= is_selected(($oldAddData['tingkatPelanggaran'] ?? ''), 'berat'); ?>>Berat</option>
        </select>
        <?php if ($validation->hasError('tingkatPelanggaran') && $modalType) : ?>
            <div class="text-danger">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <?= $validation->getError('tingkatPelanggaran'); ?>
            </div>
        <?php endif ?>
    </div>

    <!-- Tindakan  -->
    <div class="mb-5">
        <label for="tindakan" class="block text-sm font-bold mb-2">Tindakan yang diberikan :</label>
        <input
            type="text"
            id="tindakan"
            name="tindakan"
            placeholder="Masukkan tindakan yang diberikan"
            class="basic-input focus:outline-none focus:shadow-outline"
            value="<?= $oldAddData['tindakan'] ?? ''; ?>">
    </div>

    <!-- Tanggal -->
    <div class="mb-5">
        <label for="tanggalInput" class="block text-sm font-bold mb-2">Tanggal terjadinya pelanggaran :</label>
        <input
            type="date"
            id="tanggalInput"
            name="tanggal"
            placeholder="Masukkan tanggal terjadinya pelanggaran"
            required
            class="basic-input focus:outline-none focus:shadow-outline <?= ($validation->hasError('tanggal') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>" value="<?= $oldAddData['tanggal'] ?? ''; ?>">
        <?php if ($validation->hasError('tanggal') && $modalType) : ?>
            <div class="text-danger">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <?= $validation->getError('tanggal') ?>
            </div>
        <?php endif ?>
    </div>

    <!-- Submit Button -->
    <div class="flex items-center justify-between">
        <button type="submit"
            class="btn-gradient">
            Tambah Pelanggaran
        </button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dataSIswa = <?= json_encode($siswaList ?? []); ?>

        const siswaInput = document.getElementById('namaSiswa');
        const siswaId = document.getElementById('siswa_id');
        const autocompleteList = document.getElementById('autocomplete-list');

        siswaInput.addEventListener('input', function() {
            const inputSearch = this.value.toLowerCase().trim();
            if (inputSearch) {
                getSiswa(inputSearch);
            } else {
                autocompleteList.innerHTML = '';
            }
        });

        siswaInput.addEventListener('focus', function() {
            const inputValue = this.value.split('(')[0].toLowerCase().trim();
            if (inputValue) getSiswa(inputValue);
        })

        document.addEventListener('click', function(e) {
            if (e.target !== siswaInput) {
                autocompleteList.innerHTML = '';
            }
        });

        function getSiswa(search) {
            let filteredData = dataSIswa.filter(siswa => {
                return siswa.nama_siswa.toLowerCase().startsWith(search);
            });

            autocompleteList.innerHTML = '';

            if (filteredData.length == 0 && siswaInput.value != '') {
                const notFoundSiswa = document.createElement('div');
                notFoundSiswa.style.cursor = 'default';
                notFoundSiswa.style.color = '#f95656';

                notFoundSiswa.textContent = 'Siswa tidak ditemukan...';
                autocompleteList.append(notFoundSiswa);
                return;
            }

            filteredData.forEach(siswa => {
                const item = document.createElement('div');

                const matchText = siswa.nama_siswa.slice(0, search.length);
                const reaminingText = siswa.nama_siswa.slice(search.length);

                const higlightName = `<strong>${matchText}</strong>${reaminingText}`;
                item.innerHTML = `${higlightName} <span class="ml-4 font-bold">(${siswa.kelas} - ${siswa.jurusan})</span>`

                item.addEventListener('click', function() {
                    siswaInput.value = `${siswa.nama_siswa}   (${siswa.kelas} - ${siswa.jurusan})`;
                    siswaId.value = siswa.id_siswa;
                    autocompleteList.innerHTML = '';
                });
                autocompleteList.append(item);
            });
        }

        // Brings up the date widget when input is pressed
        const dateInput = document.getElementById("tanggalInput");
        dateInput.addEventListener("click", () => {
            if (dateInput.showPicker) {
                dateInput.showPicker();
            } else {
                dateInput.focus();
            }
        });

    });
</script>