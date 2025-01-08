<?php

helper('getAdminProfileData');
$profile = getAdminProfileData();

if ($profile instanceof \CodeIgniter\HTTP\RedirectResponse) {
    return $profile;
}

?>

<header class="w-full fixed top-0 left-0 right-0 z-30">
    <nav class="w-full bg-light-card dark:bg-dark-card h-14 flex justify-between px-2 text-light-text dark:text-dark-text">
        <!-- Left Content Navbar -->
        <div class="set-flex gap-2 md:gap-[0.9rem]">
            <!-- Hamburger Icon -->
            <button class="relative set-flex group hover:bg-light-shadow dark:hover:bg-dark-shadow transition-all duration-300 cursor-pointer p-2 rounded-[50%]" id="hamburger">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>

                <p class="absolute left-[130%] top-1/2 -translate-y-1/2 bg-light-bg dark:bg-dark-bg text-light-text dark:text-dark-text p-1 min-w-28 w-full rounded-[4px] text-xs
                before:content-[''] before:absolute before:right-full before:top-1/2 before:-translate-y-1/2 before:border-transparent before:border-[6px] before:border-r-light-bg dark:before:border-r-dark-bg hidden md:group-hover:block">Sidebar (Ctrl + B)</p>
            </button>
            <div class="set-flex gap-1">
                <!-- APP_BK Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 md:size-8">
                    <path d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                    <path d="M13.06 15.473a48.45 48.45 0 0 1 7.666-3.282c.134 1.414.22 2.843.255 4.284a.75.75 0 0 1-.46.711 47.87 47.87 0 0 0-8.105 4.342.75.75 0 0 1-.832 0 47.87 47.87 0 0 0-8.104-4.342.75.75 0 0 1-.461-.71c.035-1.442.121-2.87.255-4.286.921.304 1.83.634 2.726.99v1.27a1.5 1.5 0 0 0-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.66a6.727 6.727 0 0 0 .551-1.607 1.5 1.5 0 0 0 .14-2.67v-.645a48.549 48.549 0 0 1 3.44 1.667 2.25 2.25 0 0 0 2.12 0Z" />
                    <path d="M4.462 19.462c.42-.419.753-.89 1-1.395.453.214.902.435 1.347.662a6.742 6.742 0 0 1-1.286 1.794.75.75 0 0 1-1.06-1.06Z" />
                </svg>

                <h1 class="font-bold text-sm md:text-[1.2rem] tracking-wide">App Bimbingan Konseling</h1>
            </div>
        </div>

        <!-- Right Content Navbar -->
        <div class="set-flex gap-2 md:gap-3">
            <div class="relative">
                <img src="<?= base_url('/assets/img/admin.png'); ?>" alt="profile-img" class="w-7 md:w-9 cursor-pointer rounded-[50%]" id="profileImg">

                <div class="mx-3 md:mx-1 w-80 bg-light-card dark:bg-dark-card pb-3 rounded-md overflow-hidden absolute -right-14 top-14 shadow-md shadow-light-shadow dark:shadow-dark-shadow hidden" id="profileData">
                    <ul class="set-flex flex-col bg-custom-gradient pt-5 pb-3 px-5 text-white">
                        <li class="mb-1"><img src="<?= base_url('/assets/img/admin.png'); ?>" alt="profile-img" class="w-14 cursor-pointer rounded-[50%]"></li>
                        <li>
                            <p class="text-sm">Admin</p>
                        </li>
                        <li>
                            <p class="text-sm set-flex gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z" clip-rule="evenodd" />
                                </svg>

                                <span><?= convertToBaliTime($profile['tglTerdaftar']); ?></span>
                            </p>
                        </li>
                    </ul>

                    <div class="set-flex flex-col items-start pt-3 pb-4 gap-2">
                        <p class="flex items-center gap-2 w-full border-b border-dark-bg dark:border-light-bg">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 border-r border-dark-bg dark:border-light-bg w-9 ml-1">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                            </svg>

                            <span class="truncate w-4/5"><?= $profile['username']; ?></span>
                        </p>
                        <p class="flex items-center gap-2 w-full border-b border-dark-bg dark:border-light-bg">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 border-r border-dark-bg dark:border-light-bg w-9 ml-1">
                                <path d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                                <path d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                            </svg>

                            <span class="truncate w-4/5"><?= $profile['email']; ?></span>
                        </p>
                    </div>
                    <a href="<?= site_url('/logout'); ?>" class="btn-gradient w-max py-1.5 px-4 ml-3" onclick="return confirm('Apakah anda yakin ingin logout?')">Logout</a>
                </div>
            </div>

            <button class="set-flex hover:bg-light-shadow dark:hover:bg-dark-shadow transition-all duration-300 cursor-pointer p-2 rounded-[50%]" name="mode" id="mode-toggle">
                <div id="light-toggle" class="block">
                    <!-- Sun Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 md:size-6">
                        <path d="M12 2.25a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM7.5 12a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM18.894 6.166a.75.75 0 0 0-1.06-1.06l-1.591 1.59a.75.75 0 1 0 1.06 1.061l1.591-1.59ZM21.75 12a.75.75 0 0 1-.75.75h-2.25a.75.75 0 0 1 0-1.5H21a.75.75 0 0 1 .75.75ZM17.834 18.894a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 1 0-1.061 1.06l1.59 1.591ZM12 18a.75.75 0 0 1 .75.75V21a.75.75 0 0 1-1.5 0v-2.25A.75.75 0 0 1 12 18ZM7.758 17.303a.75.75 0 0 0-1.061-1.06l-1.591 1.59a.75.75 0 0 0 1.06 1.061l1.591-1.59ZM6 12a.75.75 0 0 1-.75.75H3a.75.75 0 0 1 0-1.5h2.25A.75.75 0 0 1 6 12ZM6.697 7.757a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 0 0-1.061 1.06l1.59 1.591Z" />
                    </svg>
                </div>

                <div id="dark-toggle" class="hidden">
                    <!-- Moon Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 md:size-6">
                        <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 0 1 .162.819A8.97 8.97 0 0 0 9 6a9 9 0 0 0 9 9 8.97 8.97 0 0 0 3.463-.69.75.75 0 0 1 .981.98 10.503 10.503 0 0 1-9.694 6.46c-5.799 0-10.5-4.7-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 0 1 .818.162Z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </div>
    </nav>
</header>