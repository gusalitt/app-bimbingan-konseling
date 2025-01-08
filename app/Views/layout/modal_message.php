<div id="successModal" class="success-modal opacity-0 pointer-events-none fixed inset-0 z-50 bg-dark-bg/60 dark:bg-light-bg/10 set-flex">
    <div id="successModalContent" class="success-modal-content scale-0 transition-all duration-200 shadow-md w-[27rem]">
        <div class="bg-light-card dark:bg-dark-card shadow-md rounded-xl relative set-flex flex-col pt-8 pb-6 px-10">
            <span class="<?= session()->getFlashdata('success') || session()->getFlashdata('error') || session()->getFlashdata('info')  ? '' : 'hidden'; ?>">

                <?php if (session()->getFlashdata('success')) : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-24 h-24 text-green-600">
                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                    </svg>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')) : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-24 h-24 text-red-600">
                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                    </svg>
                <?php endif; ?>

                <?php if (session()->getFlashdata('info')) : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-24 h-24 text-blue-600">
                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                    </svg>
                <?php endif; ?>
            </span>

            <p class="text-xl font-semibold mt-5 mb-4 text-center text-light-text dark:text-dark-text"><?= session()->getFlashdata('success') ?? session()->getFlashdata('error') ?? session()->getFlashdata('info') ?? ''; ?></p>
            <button id="closeSuccessModal" class="bg-custom-gradient py-2 px-5 text-white rounded-lg">Oke</button>
        </div>
    </div>
</div>