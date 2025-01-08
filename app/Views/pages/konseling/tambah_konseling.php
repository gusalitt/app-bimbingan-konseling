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
        <h1 class="text-2xl font-semibold">Tambah Konseling</h1>
    </div>

    <?php if (($validation->hasError('siswa_id') ||  $validation->hasError('konselor_id')) && $modalType) : ?>
        <div class="text-danger mt-0 text-md bg-red-200/50 dark:bg-red-900/20 w-full border border-red-500 rounded-lg p-2.5 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>
            <?= $validation->getError('siswa_id') ?: $validation->getError('konselor_id') ?>
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
            <div id="autocomplete-list-siswa" class="autocomplete-items"></div>
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

    <!-- Nama Konselor -->
    <div class="mb-5">
        <label for="namaKonselor" class="block text-sm font-bold mb-2">Nama Konselor:</label>
        <div class="relative">
            <input
                type="text"
                id="namaKonselor"
                name="namaKonselor"
                placeholder="Cari nama konselor"
                autocomplete="off"
                required
                class="basic-input focus:outline-none focus:shadow-outline <?= ($validation->hasError('namaKonselor') && $modalType) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>"
                value="<?= $oldAddData['namaKonselor'] ?? '' ?>">
            <div id="autocomplete-list-konselor" class="autocomplete-items"></div>
        </div>
        <?php if ($validation->hasError('namaKonselor') && $modalType) : ?>
            <div class="text-danger">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <?= $validation->getError('namaKonselor') ?>
            </div>
        <?php endif ?>
        <input type="hidden" name="konselor_id" id="konselor_id" value="<?= $oldAddData['konselor_id'] ?? ''; ?>">
    </div>

    <!-- Isu atau Permasalahan:  -->
    <div class="mb-5">
        <label for="permasalahan" class="block text-sm font-bold mb-2">Isu atau Permasalahan:</label>
        <input
            type="text"
            id="permasalahan"
            name="permasalahan"
            placeholder="Masukkan isu atau permasalahan yang ingin ditangani"
            class="basic-input focus:outline-none focus:shadow-outline"
            value="<?= $oldAddData['permasalahan'] ?? ''; ?>">
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

    <!-- Catatan  -->
    <div class="mb-5">
        <label for="catatan" class="block text-sm font-bold mb-2">Catatan :</label>
        <input
            type="text"
            id="catatan"
            name="catatan"
            placeholder="Masukkan catatan atau kesimpulan dari masalah terkait"
            class="basic-input focus:outline-none focus:shadow-outline"
            value="<?= $oldAddData['catatan'] ?? ''; ?>">
    </div>

    <!-- Date -->
    <div class="mb-5">
        <label for="dateInput" class="block text-sm font-bold mb-2">Tanggal dilaksanakannya :</label>
        <input
            type="date"
            id="dateInput"
            name="tanggal"
            placeholder="Masukkan tanggal dilaksanakannya"
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

    <!-- Status -->
    <div class="mb-5">
        <input type="hidden" name="status" id="status" value="Dijadwalkan">
    </div>

    <!-- Submit Button -->
    <div class="flex items-center justify-between">
        <button type="submit"
            class="btn-gradient">
            Tambah Konseling
        </button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dataSIswa = <?= json_encode($siswaList ?? []); ?>;
        const dataKonselor = <?= json_encode($konselorList ?? []); ?>;

        const siswaInput = document.getElementById('namaSiswa');
        const siswaId = document.getElementById('siswa_id');

        const konselorInput = document.getElementById('namaKonselor');
        const konselorId = document.getElementById('konselor_id');

        const autocompleteListSiswa = document.getElementById('autocomplete-list-siswa');
        const autocompleteListKonselor = document.getElementById('autocomplete-list-konselor');

        siswaInput.addEventListener('input', function() {
            const inputSearch = this.value.toLowerCase().trim();
            if (inputSearch) {
                getSiswa(inputSearch);
            } else {
                autocompleteListSiswa.innerHTML = '';
            }
        });

        siswaInput.addEventListener('focus', function() {
            const inputValue = this.value.split('(')[0].toLowerCase().trim();
            if (inputValue) getSiswa(inputValue);
        })

        konselorInput.addEventListener('input', function() {
            const inputSearch = this.value.toLowerCase().trim();
            if (inputSearch) {
                getKonselor(inputSearch);
            } else {
                autocompleteListKonselor.innerHTML = '';
            }
        });

        konselorInput.addEventListener('focus', function() {
            const inputValue = this.value.toLowerCase().trim();
            if (inputValue) getKonselor(inputValue);
        })

        document.addEventListener('click', function(e) {
            if (e.target !== siswaInput) {
                autocompleteListSiswa.innerHTML = '';
            }
            if (e.target !== konselorInput) {
                autocompleteListKonselor.innerHTML = '';
            }
        });

        function getSiswa(search) {
            let filteredData = dataSIswa.filter(siswa => {
                return siswa.nama_siswa.toLowerCase().startsWith(search);
            });

            autocompleteListSiswa.innerHTML = '';

            if (filteredData.length == 0 && siswaInput.value != '') {
                const notFoundSiswa = document.createElement('div');
                notFoundSiswa.style.cursor = 'default';
                notFoundSiswa.style.color = '#f95656';

                notFoundSiswa.textContent = 'Siswa tidak ditemukan...';
                autocompleteListSiswa.append(notFoundSiswa);
                return;
            }

            filteredData.forEach(siswa => {
                const item = document.createElement('div');

                const matchText = siswa.nama_siswa.slice(0, search.length);
                const reaminingText = siswa.nama_siswa.slice(search.length);

                const higlightName = `<strong>${matchText}</strong>${reaminingText}`;
                item.innerHTML = `${higlightName} <span class="ml-4 font-bold">(${siswa.kelas} - ${siswa.jurusan})</span>`;

                item.addEventListener('click', function() {
                    siswaInput.value = `${siswa.nama_siswa}   (${siswa.kelas} - ${siswa.jurusan})`;
                    siswaId.value = siswa.id_siswa;
                    autocompleteListSiswa.innerHTML = '';
                });
                autocompleteListSiswa.append(item);
            });
        }

        function getKonselor(search) {
            let filteredData = dataKonselor.filter(konselor => {
                return konselor.nama_konselor.toLowerCase().startsWith(search);
            });

            autocompleteListKonselor.innerHTML = '';

            if (filteredData.length == 0 && konselorInput.value != '') {
                const notFoundKonselor = document.createElement('div');
                notFoundKonselor.style.cursor = 'default';
                notFoundKonselor.style.color = '#f95656';

                notFoundKonselor.textContent = 'Konselor tidak ditemukan...';
                autocompleteListKonselor.append(notFoundKonselor);
                return;
            }

            filteredData.forEach(konselor => {
                const item = document.createElement('div');

                const matchText = konselor.nama_konselor.slice(0, search.length);
                const reaminingText = konselor.nama_konselor.slice(search.length);

                item.innerHTML = `<strong>${matchText}</strong>${reaminingText}`;

                item.addEventListener('click', function() {
                    konselorInput.value = `${konselor.nama_konselor}`;
                    konselorId.value = konselor.id_konselor;
                    autocompleteListKonselor.innerHTML = '';
                });
                autocompleteListKonselor.append(item);
            });
        }

        // Brings up the date widget when input is pressed
        const dateInput = document.getElementById("dateInput");
        dateInput.addEventListener("click", () => {
            if (dateInput.showPicker) {
                dateInput.showPicker();
            } else {
                dateInput.focus();
            }
        });
    });
</script>