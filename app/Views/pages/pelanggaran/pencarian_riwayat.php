<?= $this->extend('index'); ?>

<?= $this->section('content'); ?>

<!-- Breadcrumb -->
<ul class="flex items-center gap-2 mb-3">
    <li><a href="<?= site_url('/dashboard'); ?>" class="text-light-text dark:text-dark-text text-xs md:text-sm">Dashboard</a></li>
    <li class="text-light-text dark:text-dark-text text-xs md:text-sm">/</li>
    <li>
        <p class="text-light-text dark:text-dark-text text-xs md:text-sm">Pelanggaran</p>
    </li>
    <li class="text-light-text dark:text-dark-text text-xs md:text-sm">/</li>
    <li>
        <a href="<?= site_url('/riwayat-pelanggaran/cari'); ?>" class="text-danger m-0 text-xs md:text-sm">Pencarian Riwayat</a>
    </li>
</ul>

<div class="w-full bg-light-card dark:bg-dark-card rounded-lg set-flex flex-col pb-5 shadow-md" id="historySearch" style="height: calc(100vh - 5.25rem);">
    <h1 class="text-light-text dark:text-dark-text px-5 md:p-0 text-center text-xl md:text-3xl">Cari riwayat pelanggaran siswa disini</h1>

    <form action="<?= site_url('/riwayat-pelanggaran/detail'); ?>" method="get" class="w-full set-flex flex-col mt-5" id="searchForm">
        <div class="relative w-[85%] md:p-0 md:w-2/3 set-flex h-12">
            <input type="search" name="search" id="namaSiswa" placeholder="Cari nama siswa..." class="basic-input h-full rounded-br-none rounded-tr-none focus:outline-none <?= (session('errors.search')) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>" autocomplete="off" value="<?= old('search') ?: ''; ?>">

            <button type="submit" class="bg-custom-gradient w-[30%] md:w-[15%] h-full set-flex rounded-br-lg rounded-tr-lg">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-white font-bold">
                    <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                </svg>
            </button>

            <div id="autocomplete-list" class="autocomplete-items" style="max-height: 160px;"></div>
        </div>
        <?php if (session('errors.search')) : ?>
            <div class="text-danger">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <?= session('errors.search'); ?>
            </div>
        <?php endif ?>
    </form>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const historySearch = document.getElementById('historySearch')

        const dataSIswa = <?= json_encode($siswaList ?? []); ?>;
        const siswaInput = document.getElementById('namaSiswa');
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

                item.innerHTML = `<strong>${matchText}</strong>${reaminingText}`;

                item.addEventListener('click', function() {
                    siswaInput.value = siswa.nama_siswa;
                    autocompleteList.innerHTML = '';
                });
                autocompleteList.append(item);
            });
        }
    })
</script>

<!-- Alert Message-->
<?= $this->include('layout/modal_message'); ?>

<!-- Modal Logic -->
<?= $this->include('layout/modal_logic'); ?>

<?= $this->endSection('content'); ?>