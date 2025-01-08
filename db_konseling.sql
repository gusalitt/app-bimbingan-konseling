-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Des 2024 pada 17.44
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_konseling`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) UNSIGNED NOT NULL,
  `slug` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tanggal_terdaftar` datetime NOT NULL,
  `status` enum('aktif','non-aktif') NOT NULL DEFAULT 'aktif',
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `slug`, `username`, `email`, `password`, `tanggal_terdaftar`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'vzulaika', 'vzulaika', 'kamila.usamah@example.net', '$2y$10$HHI1Pi22zciJxh3ayO.lyeHbReCeYFV7UDO5S75AVjzUFIOyZcIbO', '2024-08-26 20:55:35', 'aktif', NULL, '1983-12-10 19:01:12', '1975-07-12 00:28:46'),
(2, 'cahyonosaragih', 'cahyono.saragih', 'tamba.opung@example.com', '$2y$10$NFRDFqL2tNNxdFxC4GiXoe5NNGz2Ys8sbDOfiy/bKkVrKuooIztPO', '2024-10-17 11:22:07', 'non-aktif', NULL, '1996-08-05 09:00:27', '2024-11-10 16:26:48'),
(3, 'yessimandasari', 'yessi.mandasari', 'lintang.maryati@example.net', '$2y$10$9KB8GzosJrBdehhx1mZZg.teDqumdfN7qFXBiExmFOIhapWK5BeM6', '2024-03-21 13:03:25', 'aktif', NULL, '1971-03-18 03:43:29', '2009-05-08 06:22:51'),
(4, 'taswirwaluyo', 'taswir.waluyo', 'pertiwi.rika@example.net', '$2y$10$Rrc5PGEQMgywLzRoY2kjGOmZLyYgfCrW6ISHQvOCOHMTGevkRu8QC', '2024-01-21 16:43:37', 'non-aktif', NULL, '1988-02-29 17:55:57', '2024-11-10 16:26:13'),
(5, 'iwijayanti', 'iwijayanti', 'wulandari.nasrullah@example.org', '$2y$10$q933qiqeo5ReZK.jFg2ZKOOUfom3RpWEV.31jRjjgl7CH38xRrQgC', '2024-05-29 15:18:47', 'aktif', NULL, '1976-03-03 07:25:20', '1972-07-15 17:01:13'),
(6, 'amustofa', 'amustofa', 'farah42@example.org', '$2y$10$hEEgbZ5.lG6EkTm.E94MDuw7mBls26zj8pd1TDNeUU8SPkx06Sb8y', '2024-07-09 09:53:10', 'aktif', NULL, '1975-08-21 13:22:33', '1991-10-19 01:41:49'),
(7, 'xprasasta', 'xprasasta', 'ivan58@example.org', '$2y$10$8BEepSFBwSznYpcEHLjekOOslvLiASQk5sX8x4SA.9JfaC1.SOR7q', '2024-05-01 10:46:49', 'non-aktif', NULL, '1971-09-16 17:06:50', '2024-11-10 16:26:21'),
(8, 'jamalia23', 'jamalia23', 'paiman.santoso@example.org', '$2y$10$JeM5iUlAARqJ.6rkhxwlf.tdjtPvwh9f7nlpaddznMiSjLa9hUe4K', '2024-06-04 19:41:49', 'aktif', NULL, '2014-10-28 01:20:58', '1992-05-26 17:32:18'),
(9, 'gawati27', 'gawati27', 'qsimbolon@example.net', '$2y$10$yCQh/C89jav7WbfD5Q2E0u0mzZzw/DhJDPKXmBi19HtHVAxmnIp6.', '2024-06-05 10:25:37', 'aktif', NULL, '2019-06-25 09:54:56', '1983-04-23 17:41:15'),
(10, 'patriciairawan', 'patricia.irawan', 'dsaputra@example.net', '$2y$10$JnGj/opdf536Z13yIRR6E.Yh7/mnaCcfydJbq7XSyXMx/3kl18jtq', '2024-02-20 15:37:15', 'non-aktif', NULL, '2020-01-25 20:01:34', '2024-11-10 16:26:33'),
(11, 'npangestu', 'npangestu', 'vanya.putra@example.com', '$2y$10$aaQOTcfzGmYlr3GubKf2kuuullL.waolkLytis9R7a5oeD0EsbwWi', '2024-01-06 00:48:54', 'aktif', NULL, '2009-11-08 23:58:37', '1972-06-27 15:03:16'),
(12, 'jamalpudjiastuti', 'jamal.pudjiastuti', 'putra.paramita@example.com', '$2y$10$dx/s9Pym9vK0LKKJeMVtn.0fPK9NNSeQJRRAoRkQcBrV8Mx6fcG.K', '2024-10-28 17:48:22', 'non-aktif', NULL, '2005-09-18 01:48:47', '1985-10-19 18:08:06'),
(17, 'testwkwk', 'testwkwk', 'contoh123@gmail.com', '$2y$10$OZlQjZI6n2ClCC/rM8G5UOAliv.aVRgBFZ9HHgkyymtNx49E8tYAW', '2024-11-16 17:45:02', 'aktif', '1924963d2f60c20ac6c67f73eaa352b7d70ee83b4dd6dce6189eb093c6c8e1e41e4ebd7d5c5a70a272df588bc40b4d1ff8f5516270a487c90ea7f98fb94b0ce4', '2024-11-16 17:45:02', '2024-11-17 16:29:09'),
(18, 'john', 'john', 'john@gmail.com', '$2y$10$Ylrz6hAXN0OJ7QVAzm66Ne8rCYSOan8zJNaLqCm0Kkor1LSfwX/wS', '2024-11-17 08:41:28', 'aktif', '93e6be312c46359711686deb98b8dbd1e3b9579b9f1d451a0b04b3b13f418d218383ae69c127c90372b86208a72e24664bca84c8b43c84640ba3ef4adcd0cdf0', '2024-11-17 08:41:28', '2024-11-21 12:56:45'),
(19, 'george123', 'George123', 'george@gmail.com', '$2y$10$e0Y185osbOfmSJD8JmtrZ.LqsrrLrZFUvOVQTHaWXbeqRO2QG43o.', '2024-11-17 17:15:12', 'aktif', NULL, '2024-11-17 17:15:12', '2024-12-01 05:48:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) UNSIGNED NOT NULL,
  `slug` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT '-',
  `nama_guru` varchar(100) NOT NULL,
  `mata_pelajaran` varchar(100) NOT NULL,
  `wali_kelas` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id_guru`, `slug`, `foto`, `nama_guru`, `mata_pelajaran`, `wali_kelas`, `created_at`, `updated_at`) VALUES
(1, 'dimaz-mandala', '1731254958_390315e53d6e2ce34387.png', 'Dimaz Mandala', 'Sejarah', '11', '2007-12-20 23:33:04', '2024-11-10 16:09:18'),
(2, 'cici-hartati', '1731254978_a4cc8bae086e2097108d.png', 'Cici Hartati', 'IPS', '11', '1987-04-15 04:15:35', '2024-11-10 16:09:38'),
(3, 'mila-hamima-hasanah', '1731254969_0e5b007744629b48a3cf.png', 'Mila Hamima Hasanah', 'PPKN', '10', '1992-04-26 23:10:26', '2024-11-10 16:09:29'),
(4, 'chelsea-usada', '1731254912_fc3014506d7df1a1656d.png', 'Chelsea Usada', 'IPA', '12', '2020-08-01 18:01:08', '2024-11-10 16:12:27'),
(5, 'purwanto-prakasa', '1731254949_ce2583f44f1d13a7196c.png', 'Purwanto Prakasa', 'Sejarah', '12', '2010-10-09 01:42:28', '2024-11-10 16:09:09'),
(6, 'zulaikha-rini-astuti-sip', '1731254939_6cc62a4c6993301146c5.png', 'Zulaikha Rini Astuti S.IP', 'IPA', '12', '2011-07-07 10:45:02', '2024-11-10 16:08:59'),
(7, 'malika-citra-farida-spt', '1731254988_bfa4a1f08ffc8865fb70.png', 'Malika Citra Farida S.Pt', 'Bahasa Inggris', '11', '1986-08-09 04:44:25', '2024-11-10 16:09:48'),
(8, 'maida-diah-widiastuti-sei', '1731254904_9fc77312ccf780e65954.png', 'Maida Diah Widiastuti S.E.I', '-', '11', '2023-06-14 07:32:07', '2024-11-10 16:08:24'),
(9, 'queen-usamah', '1731254921_8efb9ce8c97a6b3e98d3.png', 'Queen Usamah', 'Bahasa Indonesia', '12', '2020-01-08 18:37:39', '2024-11-10 16:08:41'),
(10, 'johan-prasetyo-mandala-spd', '1731254930_e3aadd44fbe89c5a967f.png', 'Johan Prasetyo Mandala S.Pd', '-', '12', '2018-04-27 03:41:25', '2024-11-10 16:08:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `industri`
--

CREATE TABLE `industri` (
  `id_industri` int(11) UNSIGNED NOT NULL,
  `id_siswa` int(11) UNSIGNED NOT NULL,
  `slug` varchar(100) NOT NULL,
  `tempat_industri` varchar(255) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `status` enum('aktif','non-aktif') NOT NULL DEFAULT 'aktif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `industri`
--

INSERT INTO `industri` (`id_industri`, `id_siswa`, `slug`, `tempat_industri`, `tgl_mulai`, `tgl_selesai`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 'industri-3', 'PT ABC', '2024-01-01', '2024-12-31', 'aktif', '2024-11-10 15:52:33', '2024-11-10 15:52:33'),
(2, 3, 'industri-28', 'PT XYZ', '2024-02-01', '2024-11-30', 'non-aktif', '2024-11-10 15:52:33', '2024-11-10 15:52:33'),
(4, 7, 'sarah-lailasari', 'a', '2024-11-21', '2024-11-23', 'aktif', '2024-11-12 14:02:58', '2024-11-12 14:02:58'),
(5, 7, 'sarah-lailasari-1', 'qq', '2024-11-30', '2024-12-07', 'aktif', '2024-11-14 15:32:16', '2024-11-14 15:32:16'),
(6, 1, 'tira-nova-susanti-sikom', 'a', '2024-11-27', '2024-12-27', 'aktif', '2024-11-26 17:25:40', '2024-11-26 17:25:40'),
(7, 4, 'hartaka-latupono', 'q', '2024-11-30', '2025-01-30', 'aktif', '2024-11-26 17:28:30', '2024-11-30 14:09:32'),
(8, 8, 'hilda-zamira-nurdiyanti-mfarm', 'g', '2024-11-28', '2025-01-28', 'non-aktif', '2024-11-27 03:50:40', '2024-11-30 14:10:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) UNSIGNED NOT NULL,
  `slug` varchar(50) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `slug`, `nama_jurusan`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'perhotelan', 'Perhotelan', 'Et sed aperiam iste officia aut doloremque.', '1987-08-23 15:39:15', '2024-11-10 15:56:46'),
(2, 'kuliner', 'Kuliner', 'Debitis culpa enim numquam sit hic aliquam officiis.', '1997-09-24 12:42:24', '2024-11-10 15:56:37'),
(3, 'tkc', 'TKC', 'Dolor et aut ut impedit.', '1989-03-16 15:44:05', '2024-11-10 15:56:29'),
(4, 'pplg', 'PPLG', 'Qui qui qui nostrum illo repellendus amet.', '1995-08-25 09:19:10', '2024-11-10 15:56:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konseling`
--

CREATE TABLE `konseling` (
  `id_konseling` int(11) UNSIGNED NOT NULL,
  `id_siswa` int(11) UNSIGNED NOT NULL,
  `id_konselor` int(11) UNSIGNED NOT NULL,
  `slug` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `permasalahan` text NOT NULL,
  `tindakan` text NOT NULL,
  `catatan` text NOT NULL,
  `status` enum('Dijadwalkan','Selesai','Dibatalkan') NOT NULL DEFAULT 'Dijadwalkan',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `konseling`
--

INSERT INTO `konseling` (`id_konseling`, `id_siswa`, `id_konselor`, `slug`, `tanggal`, `permasalahan`, `tindakan`, `catatan`, `status`, `created_at`, `updated_at`) VALUES
(3, 8, 2, 'hilda-zamira-nurdiyanti-mfarm', '2024-11-19', '-', '-', '-', 'Dijadwalkan', '2024-11-10 18:47:28', '2024-11-10 18:47:28'),
(4, 3, 5, 'soleh-wijaya', '2024-11-19', '-', '-', '-', 'Selesai', '2024-11-10 18:47:47', '2024-11-10 18:48:43'),
(5, 1, 7, 'tira-nova-susanti-sikom', '2024-11-19', '-', '-', '-', 'Dibatalkan', '2024-11-10 18:48:07', '2024-11-10 18:48:35'),
(6, 9, 7, 'mulya-kusumo', '2024-11-19', '-', '-', '-', 'Dijadwalkan', '2024-11-10 18:49:03', '2024-11-10 18:49:03'),
(7, 8, 3, 'hilda-zamira-nurdiyanti-mfarm-1', '2024-11-30', '-', '-', '-', 'Dijadwalkan', '2024-11-10 18:49:55', '2024-11-10 18:50:52'),
(8, 6, 3, 'setya-opung-marbun-mfarm', '2024-11-13', '-', '-', '-', 'Selesai', '2024-11-10 18:51:29', '2024-11-27 16:21:44'),
(9, 6, 1, 'setya-opung-marbun-mfarm-1', '2024-11-24', '-', '-', '-', 'Dijadwalkan', '2024-11-10 18:52:38', '2024-11-10 18:52:38'),
(10, 4, 5, 'hartaka-latupono', '2024-12-25', '-', '-', '-', 'Dijadwalkan', '2024-11-10 18:53:38', '2024-11-10 18:53:38'),
(11, 1, 10, 'tira-nova-susanti-sikom-1', '2024-12-25', '-', '-', '-', 'Selesai', '2024-11-10 18:55:08', '2024-11-10 18:55:44'),
(12, 10, 2, 'saka-prasetyo-spsi', '2024-12-26', '-', '-', '-', 'Dibatalkan', '2024-11-10 18:57:23', '2024-11-10 18:57:46'),
(13, 7, 10, 'sarah-lailasari', '2024-11-28', '-', '-', '-', 'Selesai', '2024-11-12 14:12:44', '2024-11-12 14:15:03'),
(14, 2, 4, 'kartika-rika-susanti-sh', '2024-12-15', 'a', 'b', 'a', 'Dijadwalkan', '2024-11-26 13:12:36', '2024-11-30 14:00:58'),
(15, 8, 7, 'hilda-zamira-nurdiyanti-mfarm-2', '2024-12-21', '-', '-', '-', 'Dijadwalkan', '2024-11-26 13:15:12', '2024-11-26 13:15:12'),
(16, 13, 2, 'qwertyuiop', '2024-12-09', '-', '-', '-', 'Dijadwalkan', '2024-11-26 13:22:11', '2024-11-30 14:01:23'),
(17, 6, 1, 'setya-opung-marbun-mfarm-2', '2024-11-19', '-', '-', '-', 'Dijadwalkan', '2024-12-01 05:07:47', '2024-12-01 05:07:47'),
(18, 8, 7, 'hilda-zamira-nurdiyanti-mfarm-3', '2024-11-19', '-', '-', '-', 'Dijadwalkan', '2024-12-01 05:08:22', '2024-12-01 05:08:22'),
(19, 2, 6, 'kartika-rika-susanti-sh-1', '2024-11-19', '-', '-', '-', 'Dijadwalkan', '2024-12-01 05:09:32', '2024-12-01 05:09:32'),
(20, 1, 5, 'tira-nova-susanti-sikom-2', '2024-12-19', '-', '-', '-', 'Dijadwalkan', '2024-12-01 05:13:56', '2024-12-01 05:13:56'),
(21, 1, 5, 'tira-nova-susanti-sikom-3', '2024-11-19', '-', '-', '-', 'Dijadwalkan', '2024-12-01 05:14:37', '2024-12-01 05:14:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konselor`
--

CREATE TABLE `konselor` (
  `id_konselor` int(11) UNSIGNED NOT NULL,
  `slug` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT '-',
  `nama_konselor` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `total_konseling` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `konselor`
--

INSERT INTO `konselor` (`id_konselor`, `slug`, `foto`, `nama_konselor`, `no_telp`, `total_konseling`, `created_at`, `updated_at`) VALUES
(1, 'setya-dono-dabukke-sked', '1731255454_f5170d4b7beec42b99e5.png', 'Setya Dono Dabukke S.Ked', '0838455644', 2, '2001-03-16 13:13:23', '2024-11-10 16:17:34'),
(2, 'asman-erik-mansur-sei', '1731255443_6c6aca302afaa932095e.png', 'Asman Erik Mansur S.E.I', '088915553828', 3, '2023-09-02 23:08:42', '2024-11-10 16:17:23'),
(3, 'mustofa-situmorang', '1731255433_87758a811e7a6ce9d7d9.png', 'Mustofa Situmorang', '0857211842897', 2, '1991-01-09 08:22:39', '2024-11-10 16:17:13'),
(4, 'gilang-hidayanto', '1731255422_c3f36836ed835b0492d0.png', 'Gilang Hidayanto', '066033779633', 3, '1979-10-27 12:11:53', '2024-11-10 16:17:02'),
(5, 'eka-haryanti-sh', '1731255412_90ac467fe7112bd79ff5.png', 'Eka Haryanti S.H.', '082677995079', 5, '2020-01-18 09:41:56', '2024-11-10 16:16:52'),
(6, 'sabrina-susanti', '1731255401_2d32f45dc5bdfa7ea62c.png', 'Sabrina Susanti', '0881871392459', 1, '1993-11-01 13:45:28', '2024-11-10 16:16:41'),
(7, 'hari-saka-prakasa-st', '1731255390_7654cebdcbc407f40a92.png', 'Hari Saka Prakasa S.T.', '082224467916', 4, '1990-06-19 08:53:38', '2024-11-10 16:16:30'),
(8, 'maryadi-santoso-st', '1731255378_63522cdf5dc9e4a4ab54.png', 'Maryadi Santoso S.T.', '0876982671381', 0, '1989-05-09 09:16:08', '2024-11-10 16:16:18'),
(9, 'lanang-kawaca-simbolon', '1731255369_0d67d27e3427d6bbeac1.png', 'Lanang Kawaca Simbolon', '08013196938', 2, '2010-05-25 04:45:05', '2024-11-10 16:16:09'),
(10, 'lalita-haryanti', '1731255356_f2696c90b7e95de6cb50.png', 'Lalita Haryanti', '088006551319', 3, '1995-07-06 00:24:09', '2024-11-10 16:15:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-10-19-053314', 'App\\Database\\Migrations\\Siswa', 'default', 'App', 1731253501, 1),
(2, '2024-10-19-054300', 'App\\Database\\Migrations\\Jurusan', 'default', 'App', 1731253501, 1),
(3, '2024-10-19-054604', 'App\\Database\\Migrations\\Guru', 'default', 'App', 1731253501, 1),
(4, '2024-10-19-054736', 'App\\Database\\Migrations\\Konselor', 'default', 'App', 1731253501, 1),
(5, '2024-10-26-043218', 'App\\Database\\Migrations\\Pelanggaran', 'default', 'App', 1731253501, 1),
(6, '2024-11-04-060318', 'App\\Database\\Migrations\\Industri', 'default', 'App', 1731253501, 1),
(7, '2024-11-04-061124', 'App\\Database\\Migrations\\Konseling', 'default', 'App', 1731253501, 1),
(8, '2024-11-08-172345', 'App\\Database\\Migrations\\Admin', 'default', 'App', 1731253501, 1),
(9, '2024-11-12-172041', 'App\\Database\\Migrations\\AddTanggalColumnToPelanggaranTable', 'default', 'App', 1731432286, 2),
(11, '2024-11-16-155319', 'App\\Database\\Migrations\\AddColumnRememberTokenToAdminTable', 'default', 'App', 1731772731, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggaran`
--

CREATE TABLE `pelanggaran` (
  `id_pelanggaran` int(11) UNSIGNED NOT NULL,
  `id_siswa` int(11) UNSIGNED NOT NULL,
  `slug` varchar(100) NOT NULL,
  `pelanggaran` varchar(100) NOT NULL,
  `tingkat_pelanggaran` enum('berat','sedang','ringan') NOT NULL DEFAULT 'ringan',
  `tindakan` varchar(100) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggaran`
--

INSERT INTO `pelanggaran` (`id_pelanggaran`, `id_siswa`, `slug`, `pelanggaran`, `tingkat_pelanggaran`, `tindakan`, `tanggal`, `created_at`, `updated_at`) VALUES
(2, 3, 'oni-kuswandari', 'Eos voluptates architecto.', 'sedang', 'Perferendis quasi fuga fugiat autem voluptate.', '2024-11-01', '1983-10-15 04:20:55', '2009-11-06 18:46:45'),
(3, 8, 'sari-andriani', 'Temporibus voluptatum voluptas.', 'berat', 'Fugiat ut vero unde occaecati non explicabo et dolores.', '2024-11-08', '2007-05-08 07:12:05', '1971-07-08 19:04:16'),
(4, 5, 'raden-kenzie-firmansyah-sei', 'Ad accusantium ipsam assumenda.', 'berat', 'Dignissimos molestiae debitis reprehenderit deleniti et alias ut enim neque aut.', '2024-11-17', '1985-09-06 01:13:35', '1982-01-20 00:56:43'),
(5, 3, 'rahayu-padmasari-mfarm', 'Distinctio modi possimus rerum.', 'berat', 'Corrupti ducimus nam ducimus ut non dolores.', '2024-11-03', '1971-01-20 18:59:54', '2023-12-03 08:47:13'),
(6, 1, 'maya-palastri', 'Reiciendis asperiores.', 'ringan', 'Earum odit sit mollitia beatae repellat enim.', '2024-11-27', '1995-01-17 13:40:57', '2009-05-09 09:52:07'),
(7, 4, 'karimah-maryati-se', 'Reiciendis esse sint totam.', 'sedang', 'Quia quos atque quidem cupiditate reprehenderit iure.', '2024-11-09', '1984-10-25 08:43:20', '2023-05-04 14:01:17'),
(8, 1, 'galiono-anom-maryadi', 'Accusamus quisquam vitae numquam.', 'sedang', 'Aspernatur quis voluptate beatae voluptatem sunt qui dolores dolorum.', '2024-11-11', '1995-08-31 16:18:48', '2001-02-28 15:58:49'),
(9, 7, 'sarah-lailasari', 'Soluta ducimus iusto officia.', 'ringan', 'Neque minus commodi voluptate perspiciatis dolorum corporis corporis qui rerum iusto.', '2024-11-20', '2011-11-03 21:26:07', '2024-11-12 13:58:55'),
(13, 7, 'sarah-lailasari-1', 'merokok', 'berat', '-', '2024-11-06', '2024-11-12 17:32:38', '2024-11-12 17:32:49'),
(14, 7, 'sarah-lailasari-2', 'gak tau', 'sedang', 'wkkwkw', '2024-11-11', '2024-11-12 18:39:43', '2024-11-12 18:39:43'),
(15, 7, 'sarah-lailasari-3', 'zzz', 'ringan', 'zzzz', '2024-11-06', '2024-11-12 18:42:07', '2024-11-12 18:42:07'),
(16, 5, 'hana-halimah', 'a', 'berat', 'h', '2024-12-09', '2024-11-27 03:51:53', '2024-11-27 15:29:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) UNSIGNED NOT NULL,
  `slug` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT '-',
  `nama_siswa` varchar(100) NOT NULL,
  `nisn` char(10) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `slug`, `foto`, `nama_siswa`, `nisn`, `kelas`, `jurusan`, `created_at`, `updated_at`) VALUES
(1, 'tira-nova-susanti-sikom', '1731254554_dcaf04c4eadf3eac6bfc.png', 'Tira Nova Susanti S.I.Kom', '1164010479', '11', 'TKC', '1980-05-10 03:00:19', '2024-11-10 16:02:34'),
(2, 'kartika-rika-susanti-sh', '1731254520_a2a809c0c5c4db05cacb.png', 'Kartika Rika Susanti S.H.', '7335532719', '12', 'Kuliner', '1992-10-03 02:50:22', '2024-11-10 16:02:00'),
(3, 'soleh-wijaya', '1731254461_0c622757de57f60d11e6.png', 'Soleh Wijaya', '0715376542', '10', 'TKC', '2000-05-14 19:20:40', '2024-11-10 16:01:01'),
(4, 'hartaka-latupono', '1731254533_70c4275b5a64c31d836e.png', 'Hartaka Latupono', '2687144732', '12', 'PPLG', '1992-01-29 14:13:23', '2024-11-10 16:02:13'),
(5, 'hana-halimah', '1731254566_6c08f3be3506a0374465.png', 'Hana Halimah', '0573494263', '11', 'Kuliner', '1975-02-28 11:32:29', '2024-11-10 16:02:46'),
(6, 'setya-opung-marbun-mfarm', '1731254544_aa56214c33f1a557626e.png', 'Setya Opung Marbun M.Farm', '3532927399', '11', 'Kuliner', '1982-10-16 05:56:19', '2024-11-10 16:02:24'),
(7, 'sarah-lailasari', '1731254325_e6e019f2847cbc55f106.png', 'Sarah Lailasari', '3719663106', '11', 'Perhotelan', '2023-02-23 21:22:57', '2024-11-17 14:31:39'),
(8, 'hilda-zamira-nurdiyanti-mfarm', '1731254474_a9e7dd9f2bb6f7cb13ac.png', 'Hilda Zamira Nurdiyanti M.Farm', '5514364196', '10', 'PPLG', '1995-09-04 19:14:10', '2024-11-27 03:49:58'),
(9, 'mulya-kusumo', '1731254436_9dec630aef890e0ce55e.png', 'Mulya Kusumo', '5508360363', '11', 'Kuliner', '2015-08-17 20:21:45', '2024-11-10 16:00:36'),
(10, 'saka-prasetyo-spsi', '1731254445_385bb5f51df6a314e884.png', 'Saka Prasetyo S.Psi', '5350061250', '11', 'Kuliner', '2002-10-11 17:09:32', '2024-11-30 08:38:01'),
(13, 'qwertyuiop', '-', 'qwertyuiop', '1234', '12', 'PPLG', '2024-11-26 13:19:56', '2024-11-28 15:31:26');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indeks untuk tabel `industri`
--
ALTER TABLE `industri`
  ADD PRIMARY KEY (`id_industri`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `industri_id_siswa_foreign` (`id_siswa`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indeks untuk tabel `konseling`
--
ALTER TABLE `konseling`
  ADD PRIMARY KEY (`id_konseling`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `konseling_id_siswa_foreign` (`id_siswa`),
  ADD KEY `konseling_id_konselor_foreign` (`id_konselor`);

--
-- Indeks untuk tabel `konselor`
--
ALTER TABLE `konselor`
  ADD PRIMARY KEY (`id_konselor`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD PRIMARY KEY (`id_pelanggaran`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `pelanggaran_id_siswa_foreign` (`id_siswa`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD UNIQUE KEY `nisn` (`nisn`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `industri`
--
ALTER TABLE `industri`
  MODIFY `id_industri` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `konseling`
--
ALTER TABLE `konseling`
  MODIFY `id_konseling` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `konselor`
--
ALTER TABLE `konselor`
  MODIFY `id_konselor` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pelanggaran`
--
ALTER TABLE `pelanggaran`
  MODIFY `id_pelanggaran` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `industri`
--
ALTER TABLE `industri`
  ADD CONSTRAINT `industri_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `konseling`
--
ALTER TABLE `konseling`
  ADD CONSTRAINT `konseling_id_konselor_foreign` FOREIGN KEY (`id_konselor`) REFERENCES `konselor` (`id_konselor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `konseling_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD CONSTRAINT `pelanggaran_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
