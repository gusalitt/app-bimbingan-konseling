<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Bimbingan Konseling</title>
    <!-- TailwindCSS -->
    <link rel="stylesheet" href="<?= base_url('./src/output.css'); ?>">
    <!-- Font Nunito -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('./assets/css/style.css'); ?>">
</head>

<body class="font-Nunito bg-light-bg dark:bg-dark-bg">

    <!-- Header & Navbar -->
    <?= $this->include('layout/navbar'); ?>

    <!-- Content -->
    <div class="w-full mt-14 h-full set-flex bg-light-bg relative">
        <!-- Sidebar Menu -->
        <?= $this->include('layout/sidebar'); ?>

        <!-- Content Menu -->
        <main class="absolute right-0 top-0 px-5 pt-3 w-calc-100-250 overflow-auto transition-all duration-200" id="content-container">
            <div class="pb-10 mx-auto">
                <?= $this->renderSection('content'); ?>
            </div>
        </main>
    </div>
    

    <script src="<?= base_url('./assets/js/script.js'); ?>"></script>
    <script src="<?= base_url('./assets/js/sidebar.js'); ?>"></script>
    <script src="<?= base_url('./assets/js/modal_function.js'); ?>"></script>
</body>

</html>