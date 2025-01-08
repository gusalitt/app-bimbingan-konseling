<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | App Bimbingan Konseling</title>
    <!-- TailwindCSS -->
    <link rel="stylesheet" href="<?= base_url('./src/output.css'); ?>">
    <!-- Font Nunito -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>

<body class="font-Nunito bg-light-bg dark:bg-dark-bg overflow-auto py-3 text-light-text dark:text-dark-text relativ w-full">
    <button class="set-flex hover:bg-light-shadow dark:hover:bg-dark-shadow transition-all duration-300 cursor-pointer p-2 rounded-[50%] absolute top-3 right-3 z-50" name="mode" id="mode-toggle">
        <div id="light-toggle" class="block">
            <!-- Sun Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 md:size-7">
                <path d="M12 2.25a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM7.5 12a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM18.894 6.166a.75.75 0 0 0-1.06-1.06l-1.591 1.59a.75.75 0 1 0 1.06 1.061l1.591-1.59ZM21.75 12a.75.75 0 0 1-.75.75h-2.25a.75.75 0 0 1 0-1.5H21a.75.75 0 0 1 .75.75ZM17.834 18.894a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 1 0-1.061 1.06l1.59 1.591ZM12 18a.75.75 0 0 1 .75.75V21a.75.75 0 0 1-1.5 0v-2.25A.75.75 0 0 1 12 18ZM7.758 17.303a.75.75 0 0 0-1.061-1.06l-1.591 1.59a.75.75 0 0 0 1.06 1.061l1.591-1.59ZM6 12a.75.75 0 0 1-.75.75H3a.75.75 0 0 1 0-1.5h2.25A.75.75 0 0 1 6 12ZM6.697 7.757a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 0 0-1.061 1.06l1.59 1.591Z" />
            </svg>
        </div>

        <div id="dark-toggle" class="hidden">
            <!-- Moon Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 md:size-7">
                <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 0 1 .162.819A8.97 8.97 0 0 0 9 6a9 9 0 0 0 9 9 8.97 8.97 0 0 0 3.463-.69.75.75 0 0 1 .981.98 10.503 10.503 0 0 1-9.694 6.46c-5.799 0-10.5-4.7-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 0 1 .818.162Z" clip-rule="evenodd" />
            </svg>
        </div>
    </button>

    <div class="container w-full set-flex flex-col h-screen gap-2 mx-auto px-5 scale-100 lg:scale-90">
        <h1 class="text-2xl md:text-3xl font-semibold">App Bimbingan Konseling</h1>
        <form action="<?= site_url('/login'); ?>" method="post" class="set-flex py-5 flex-col w-full md:w-[450px] mx-auto bg-light-card dark:bg-dark-card rounded-xl shadow-md">

            <?= csrf_field(); ?>

            <div class="set-flex flex-col mb-4">
                <!-- APP_BK Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10">
                    <path d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                    <path d="M13.06 15.473a48.45 48.45 0 0 1 7.666-3.282c.134 1.414.22 2.843.255 4.284a.75.75 0 0 1-.46.711 47.87 47.87 0 0 0-8.105 4.342.75.75 0 0 1-.832 0 47.87 47.87 0 0 0-8.104-4.342.75.75 0 0 1-.461-.71c.035-1.442.121-2.87.255-4.286.921.304 1.83.634 2.726.99v1.27a1.5 1.5 0 0 0-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.66a6.727 6.727 0 0 0 .551-1.607 1.5 1.5 0 0 0 .14-2.67v-.645a48.549 48.549 0 0 1 3.44 1.667 2.25 2.25 0 0 0 2.12 0Z" />
                    <path d="M4.462 19.462c.42-.419.753-.89 1-1.395.453.214.902.435 1.347.662a6.742 6.742 0 0 1-1.286 1.794.75.75 0 0 1-1.06-1.06Z" />
                </svg>
                <h2 class="text-2xl md:text-3xl font-semibold">Login</h2>
            </div>

            <ul class="set-flex flex-col w-full px-4 md:px-8 gap-4">

                <!-- Email -->
                <li class="w-full">
                    <label for="email">Email:</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        required
                        placeholder="Masukkan email..."
                        class="basic-input focus:outline-none focus:shadow-outline <?= (session('errors.email')) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>"
                        value="<?= old('email') ?: ''; ?>">
                    <?php if (session('errors.email')) : ?>
                        <div class="text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>
                            <?= session('errors.email'); ?>
                        </div>
                    <?php endif ?>
                </li>

                <!-- Password -->
                <li class="w-full">
                    <label for="password">Password:</label>

                    <div class="basic-input focus:outline-none focus:shadow-outline set-flex p-0 m-0 overflow-hidden <?= (session('errors.password')) ? 'border-pink-600 ring-1 ring-pink-600' : '' ?>">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                            placeholder="Masukkan password..."
                            class="appearance-none w-full py-2.5 pl-3 pr-0 text-sm bg-ligth bg-light-bg dark:bg-dark-bg leading-tight focus:outline-none focus:shadow-outline"
                            value="<?= old('password') ?: ''; ?>">

                        <span class="px-2.5 " id="eyeBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 cursor-pointer hidden" id="eye">
                                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 cursor-pointer" id="eyeSlash">
                                <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                                <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                            </svg>
                        </span>
                    </div>
                    <?php if (session('errors.password')) : ?>
                        <div class="text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>
                            <?= session('errors.password'); ?>
                        </div>
                    <?php endif ?>
                </li>

                <!-- Remember me -->
                <li class="w-full">
                    <input type="checkbox" name="remember_me" id="remember_me">
                    <label for="remember_me">Remember me</label>
                </li>

                <!-- Login button -->
                <li class="w-full mt-px">
                    <button type="submit" class="text-white w-full py-1.5 rounded-md bg-custom-gradient shadow-md font-bold text-lg">Login</button>
                </li>

                <!-- Info -->
                <li class="w-full text-center">
                    <p>Belum punya akun? | <a href="<?= site_url('/daftar'); ?>" class="text-danger m-0 underline text-center text-lg">Daftar</a></p>
                </li>
            </ul>

        </form>
    </div>

    <!-- Alert Message-->
    <?= $this->include('layout/modal_message'); ?>

    <!-- Modal Logic -->
    <?= $this->include('layout/modal_logic'); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const eyeBtn = document.getElementById('eyeBtn');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye');
            const eyeSlashIcon = document.getElementById('eyeSlash');

            // Toggle password visibility
            eyeBtn.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.remove('hidden');
                    eyeSlashIcon.classList.add('hidden');
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.classList.add('hidden');
                    eyeSlashIcon.classList.remove('hidden');
                }
            });




            // Light & Dark Mode toggle
            const lightToggle = document.getElementById('light-toggle');
            const darkToggle = document.getElementById('dark-toggle');
            const modeToggle = document.getElementById('mode-toggle');
            const html = document.documentElement;

            if (localStorage.getItem('mode') === 'darkMode') {
                applyDarkMode();
            } else {
                applyLightMode();
            }

            function applyDarkMode() {
                html.classList.add('dark');
                lightToggle.classList.replace('block', 'hidden');
                darkToggle.classList.replace('hidden', 'block');

                localStorage.setItem('mode', 'darkMode');
            }

            function applyLightMode() {
                html.classList.remove('dark');
                lightToggle.classList.replace('hidden', 'block');
                darkToggle.classList.replace('block', 'hidden');

                localStorage.setItem('mode', 'lightMode');
            }

            function switchMode() {
                if (!html.classList.contains('dark')) {
                    applyDarkMode();
                } else {
                    applyLightMode();
                }
            }

            if (modeToggle) {
                modeToggle.addEventListener('click', () => {
                    switchMode();
                })
            }
        });
    </script>
    <script src="<?= base_url('./assets/js/modal_function.js'); ?>"></script>

    <?php if (!empty($fixUrl) && isset($fixUrl)) : ?>
        <!-- Used to fix the url to remain '/login' -->
        <script>
            window.history.replaceState(null, null, '/login');
        </script>
    <?php endif; ?>
    <?php $fixUrl = false; ?>
</body>

</html>