<?php if (isset($indstr)) : ?>
    <?php $modalType = (session()->getFlashdata('modalType') === 'edit') ?>

    <form action="<?= $urlToEditForm; ?>" method="post" class="w-full bg-light-card dark:bg-dark-card text-light-text dark:text-dark-text py-8 px-9 rounded-xl relative">

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

            <h1 class="text-2xl font-semibold">Edit Industri</h1>
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
            <label for="namaSiswaEdit" class="block text-sm font-bold mb-2">Nama Siswa:</label>
            <div class="relative">
                <input
                    type="text"
                    id="namaSiswaEdit"
                    name="namaSiswa"
                    placeholder="Cari nama siswa"
                    autocomplete="off"
                    required
                    class="basic-input focus:outline-none focus:shadow-outline <?= ($validation->hasError('namaSiswa') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>"
                    value="<?= esc($oldEditData['namaSiswa'] ?? "{$indstr['nama_siswa']}   ({$indstr['kelass']})"); ?>">
                <div id="autocomplete-list-edit" class="autocomplete-items"></div>
            </div>
            <?php if ($validation->hasError('namaSiswa') && $modalType) : ?>
                <div class="text-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <?= $validation->getError('namaSiswa'); ?>
                </div>
            <?php endif ?>
            <input type="hidden" name="siswa_id" id="siswa_id_edit" value="<?= $oldEditData['siswa_id'] ?? esc($indstr['id_siswa']); ?>">
            <input type="hidden" name="oldSlug" value="<?= esc($indstr['industri_slug']); ?>">
        </div>

        <!-- Tempat Industri  -->
        <div class="mb-5">
            <label for="tempat_industri_edit" class="block text-sm font-bold mb-2">Tempat Industri:</label>
            <input
                type="text"
                id="tempat_industri_edit"
                name="tempat_industri"
                placeholder="Masukkan tempat industri siswa"
                required
                class="basic-input focus:outline-none focus:shadow-outline <?= ($validation->hasError('tempat_industri') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>"
                value="<?= $oldEditData['tempat_industri'] ?? esc($indstr['tempat_industri']); ?>">
            <?php if ($validation->hasError('tempat_industri') && $modalType) : ?>
                <div class="text-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <?= $validation->getError('tempat_industri'); ?>
                </div>
            <?php endif ?>
        </div>

        <!-- Tanggal Mulai  -->
        <div class="mb-5">
            <label for="tgl_mulai_edit" class="block text-sm font-bold mb-2">Tanggal Mulai:</label>
            <input
                type="date"
                id="tgl_mulai_edit"
                name="tgl_mulai"
                placeholder="Masukkan tanggal mulai industri siswa"
                required
                class="basic-input focus:outline-none focus:shadow-outline <?= ($validation->hasError('tgl_mulai') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>"
                value="<?= $oldEditData['tgl_mulai'] ?? esc($indstr['tgl_mulai']); ?>">
            <?php if ($validation->hasError('tgl_mulai') && $modalType) : ?>
                <div class="text-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <?= $validation->getError('tgl_mulai'); ?>
                </div>
            <?php endif ?>
        </div>

        <!-- Tanggal Selesai  -->
        <div class="mb-5">
            <label for="tgl_selesai_edit" class="block text-sm font-bold mb-2">Tanggal Selesai:</label>
            <input
                type="date"
                id="tgl_selesai_edit"
                name="tgl_selesai"
                placeholder="Masukkan tanggal selesai industri siswa"
                required
                class="basic-input focus:outline-none focus:shadow-outline <?= ($validation->hasError('tgl_selesai') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>"
                value="<?= $oldEditData['tgl_selesai'] ?? esc($indstr['tgl_selesai']); ?>">
            <?php if ($validation->hasError('tgl_selesai') && $modalType) : ?>
                <div class="text-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <?= $validation->getError('tgl_selesai'); ?>
                </div>
            <?php endif ?>
        </div>

        <!-- Status -->
        <div class="mb-5">
            <label for="statusEdit" class="block text-sm font-bold mb-2">Status:</label>
            <select
                id="statusEdit"
                name="status"
                required
                class="basic-input focus:outline-none focus:shadow-outline appearance-auto <?= ($validation->hasError('status') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>">
                <option value="" selected disabled>Pilih Status</option>
                <option value="aktif" <?= is_selected(($oldEditData['status'] ?? esc($indstr['status'])), 'aktif'); ?>>Aktif</option>
                <option value="non-aktif" <?= is_selected(($oldEditData['status'] ?? esc($indstr['status'])), 'non-aktif'); ?>>Non-Aktif</option>
            </select>
            <?php if ($validation->hasError('status') && $modalType) : ?>
                <div class="text-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <?= $validation->getError('status'); ?>
                </div>
            <?php endif ?>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between">
            <button type="submit"
                class="btn-gradient">
                Edit Industri
            </button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dataSIswa = <?= json_encode($siswaList ?? []); ?>

            const siswaInput = document.getElementById('namaSiswaEdit');
            const siswaId = document.getElementById('siswa_id_edit');
            const autocompleteList = document.getElementById('autocomplete-list-edit');

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
            const dateInput1 = document.getElementById("tgl_mulai_edit");
            dateInput1.addEventListener("click", () => {
                if (dateInput1.showPicker) {
                    dateInput1.showPicker();
                } else {
                    dateInput1.focus();
                }
            });
            const dateInput2 = document.getElementById("tgl_selesai_edit");
            dateInput2.addEventListener("click", () => {
                if (dateInput2.showPicker) {
                    dateInput2.showPicker();
                } else {
                    dateInput2.focus();
                }
            });
        });
    </script>

<?php endif; ?>