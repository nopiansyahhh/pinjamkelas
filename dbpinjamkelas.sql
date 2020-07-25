-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Jul 2020 pada 13.38
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpinjamkelas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dosenmatkul_id` int(11) NOT NULL,
  `dosen_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mahasiswa_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `tapin` time DEFAULT NULL,
  `in_time` time DEFAULT NULL,
  `tapout` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_absen` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id`, `dosenmatkul_id`, `dosen_id`, `mahasiswa_id`, `tanggal`, `tapin`, `in_time`, `tapout`, `status_absen`, `out_time`, `created_at`, `updated_at`) VALUES
(1, 1, '3000', '0110217003', '2020-06-21', '03:50:00', NULL, NULL, 'belum tapout', NULL, NULL, NULL),
(2, 1, '3000', '0110217004', '2020-06-21', '03:51:00', NULL, NULL, 'belum tapout', NULL, NULL, NULL),
(4, 2, '3000', '0110217004', '2020-06-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 2, '3000', '0110217004', '2020-07-19', '11:11:00', NULL, '11:14:00', 'hadir', NULL, NULL, NULL),
(6, 1, '3000', '0110217003', '2020-07-19', NULL, NULL, NULL, 'izin', NULL, NULL, NULL),
(7, 1, '3000', '0110217004', '2020-07-19', '11:11:00', NULL, '11:14:00', 'sakit', NULL, NULL, NULL),
(8, 2, '3000', '0110217004', '2020-07-22', NULL, NULL, NULL, 'mangkir', NULL, NULL, NULL),
(9, 1, '3000', '0110217003', '2020-07-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, '3000', '0110217004', '2020-07-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 2, '3000', '0110217004', '2020-07-25', '16:58:00', NULL, '16:58:00', 'hadir', NULL, NULL, NULL),
(12, 1, '3000', '0110217003', '2020-07-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 1, '3000', '0110217004', '2020-07-25', '16:58:00', NULL, '16:58:00', 'hadir', NULL, NULL, NULL),
(14, 2, '3000', '0110217004', '2020-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 1, '3000', '0110217003', '2020-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 1, '3000', '0110217004', '2020-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen_dosen`
--

CREATE TABLE `absen_dosen` (
  `id` int(11) NOT NULL,
  `dosenmatkul_id` int(11) DEFAULT NULL,
  `dosen_id` varchar(20) DEFAULT NULL,
  `dosen_tanggal_absen` date DEFAULT NULL,
  `dosen_status_absen` varchar(15) DEFAULT NULL,
  `topik` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `absen_dosen`
--

INSERT INTO `absen_dosen` (`id`, `dosenmatkul_id`, `dosen_id`, `dosen_tanggal_absen`, `dosen_status_absen`, `topik`, `created_at`, `updated_at`) VALUES
(1, 1, '3000', '2020-07-25', 'izin', 'sdfsfdsdf sdf sdf', NULL, NULL),
(2, 2, '3000', '2020-07-25', 'mangkir', 'sedang dalam perjalanan', NULL, NULL),
(3, 2, '3000', '2020-08-01', NULL, NULL, NULL, NULL),
(4, 1, '3000', '2020-08-01', NULL, NULL, NULL, NULL),
(5, 2, '3000', '2020-07-19', NULL, NULL, NULL, NULL),
(6, 1, '3000', '2020-07-19', 'hadir', 'topik sampai dengan penggunaan javascript inline', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosenmatkul`
--

CREATE TABLE `dosenmatkul` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dosen_id` smallint(6) NOT NULL,
  `matkul_id` smallint(6) NOT NULL,
  `statusbtntap` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0= disable, 1=tapin enable,2=tapout enable, 3=both enable',
  `generate_tapin` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_tapout` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_generate` int(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dosenmatkul`
--

INSERT INTO `dosenmatkul` (`id`, `dosen_id`, `matkul_id`, `statusbtntap`, `generate_tapin`, `generate_tapout`, `status_generate`, `created_at`, `updated_at`) VALUES
(1, 3000, 1, '0', 'f25ce07ad16ed29704d0377f2197013a', 'c912804067881f516a4be6badd196725', 1, NULL, NULL),
(2, 3000, 2, '0', '', '', 0, NULL, NULL),
(3, 5000, 3, '0', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gedung`
--

CREATE TABLE `gedung` (
  `id` int(10) UNSIGNED NOT NULL,
  `gedung` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `gedung`
--

INSERT INTO `gedung` (`id`, `gedung`, `status`, `created_at`, `updated_at`) VALUES
(1, 'B1', 'Aktif', '2019-06-30 07:41:22', '2019-12-20 11:02:04'),
(2, 'B2', 'Aktif', '2019-06-30 07:41:27', '2020-01-17 02:05:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `krs`
--

CREATE TABLE `krs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dosenmatkul_id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `krs`
--

INSERT INTO `krs` (`id`, `dosenmatkul_id`, `mahasiswa_id`, `created_at`, `updated_at`) VALUES
(1, 1, 110217003, NULL, NULL),
(2, 1, 110217004, NULL, NULL),
(3, 2, 110217004, NULL, NULL),
(4, 3, 110217003, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jk` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempatlahir` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggalahir` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nohp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodi` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `email`, `jk`, `tempatlahir`, `tanggalahir`, `semester`, `nohp`, `prodi`, `alamat`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(1, '0110217001', 'Nopiansyahhh', 'nopiansyahhh@gmail.com', 'L', NULL, '1945-12-01', '20181', '0172031872', 'TI', 'aafsdfssdsadf beneran', '0110217001_checklist.png', 'AKTIF', NULL, '2019-07-24 20:16:47'),
(7, '0110217002', 'piannnn', 'pian@pian.com', 'L', NULL, '2019-06-26', '01231', '234243', 'TI', 'asdasdfsdf', '0110217002_checklist.png', 'AKTIF', '2019-06-26 01:44:44', '2019-07-24 10:20:59'),
(9, '0110217003', 'Nopiansyah', 'nopiansyahhh@gmail.com', 'L', NULL, '2019-06-03', '12312', '342342', 'TI', 'df ksdfbks', '0110217003_checklist-png-5.png', 'AKTIF', '2019-06-26 03:01:33', '2019-07-25 01:32:37'),
(10, '0110217004', 'Pian', NULL, 'L', NULL, '2019-07-09', '1', 'sdfsf', 'TI', 'dfsf', '0110217004_back_clock_history_time_timer-512.png', 'AKTIF', '2019-07-24 21:38:55', '2019-07-25 01:39:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `matkul`
--

CREATE TABLE `matkul` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sks` smallint(6) DEFAULT NULL,
  `hari` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `matkul`
--

INSERT INTO `matkul` (`id`, `nama`, `sks`, `hari`, `jam_mulai`, `jam_selesai`, `created_at`, `updated_at`) VALUES
(1, 'Pemrograman Web', 3, 'RABU', '18:30:00', '20:30:00', NULL, NULL),
(2, 'Pemrograman Mobile', 2, 'KAMIS', '20:30:00', '22:00:00', NULL, NULL),
(3, 'Agama Islam', 2, 'JUMAT', '20:30:00', '22:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2019_06_13_042110_create_table_gedung', 1),
(10, '2019_06_13_043214_create_table_ruangan', 1),
(11, '2019_06_13_043554_create_table_mahasiswa', 1),
(12, '2019_06_13_044111_create_table_peminjaman', 1),
(13, '2019_12_25_060958_add_api_token_on_users_table', 2),
(14, '2020_03_23_031727_add_field_dosen_on_users_table', 2),
(15, '2020_03_23_065403_create_matkul', 3),
(16, '2020_03_23_073336_create_dosenmatkul', 4),
(18, '2020_03_23_073647_add_field_time_on_matkul', 5),
(19, '2020_03_23_075134_create_krs', 6),
(20, '2020_03_23_080103_create_absensi', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(10) UNSIGNED NOT NULL,
  `ruangan_id` int(11) NOT NULL,
  `mahasiswa_id` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci,
  `kettolak` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `ruangan_id`, `mahasiswa_id`, `tanggal`, `ket`, `kettolak`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '0110217003', '2019-07-08', NULL, NULL, 'DISETUJUI', '2019-07-03 02:58:01', '2019-07-05 22:17:59'),
(2, 1, '0110217003', '2019-07-15', NULL, NULL, 'Menunggu Konfirmasi', '2019-07-03 03:13:00', '2019-07-03 03:13:00'),
(3, 1, '0110217003', '2019-07-22', 'm', 'yang bener klo minjem kelasss bangcaatttttt', 'DITOLAK', '2019-07-03 06:32:02', '2019-07-03 06:35:12'),
(4, 2, '0110217003', '2019-07-08', NULL, NULL, 'Menunggu Konfirmasi', '2019-07-03 19:23:30', '2019-07-03 19:23:30'),
(5, 2, '0110217003', '2019-07-15', NULL, NULL, 'Menunggu Konfirmasi', '2019-07-03 19:44:16', '2019-07-03 19:44:16'),
(6, 3, '0110217003', '2019-07-08', NULL, NULL, 'Menunggu Konfirmasi', '2019-07-03 19:46:32', '2019-07-03 19:46:32'),
(8, 1, '0110217003', '2019-07-29', NULL, NULL, 'Menunggu Konfirmasi', '2019-07-03 23:47:00', '2019-07-03 23:47:00'),
(19, 1, '0110217003', '2019-08-12', 'pinjem yak', NULL, 'Menunggu Konfirmasi', '2019-07-16 08:19:00', '2019-07-16 08:19:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `id` int(10) UNSIGNED NOT NULL,
  `gedung_id` int(11) DEFAULT NULL,
  `ruangan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hari` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jamawal` time NOT NULL,
  `jamakhir` time NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`id`, `gedung_id`, `ruangan`, `hari`, `jamawal`, `jamakhir`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '101', 'senin', '08:00:00', '10:30:00', 'Aktif', '2019-06-30 07:42:09', '2019-07-16 02:03:50'),
(2, 1, '101', 'senin', '10:00:00', '11:00:00', 'Aktif', '2019-06-30 07:42:47', '2019-12-20 10:07:55'),
(3, 2, '201', 'senin', '13:00:00', '14:00:00', 'Aktif', '2019-06-30 07:43:11', '2019-12-20 09:42:30'),
(4, 2, '201', 'senin', '14:00:00', '16:00:00', 'Aktif', '2019-06-30 07:43:34', '2019-12-20 09:37:58'),
(5, 1, '105', 'selasa', '13:00:00', '15:00:00', 'Aktif', '2019-07-05 07:50:14', '2019-07-05 07:50:14'),
(7, 1, '101', 'senin', '10:11:00', '11:00:00', 'Aktif', '2019-07-08 06:31:11', '2019-07-08 06:31:23'),
(8, 1, '105', 'rabu', '09:00:00', '10:00:00', 'Aktif', '2019-07-08 07:11:27', '2019-07-08 07:11:27'),
(10, 2, '209', 'senin', '09:00:00', '11:00:00', 'Aktif', '2019-07-16 01:59:16', '2019-07-16 01:59:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `nohp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nim`, `name`, `role`, `email`, `alamat`, `nohp`, `foto`, `email_verified_at`, `password`, `remember_token`, `api_token`, `created_at`, `updated_at`) VALUES
(6, '0110217003', 'Nopiansyah', 'mahasiswa', '', '', '', '', NULL, '$2y$10$g3tseiiO8xG0Z1YUZJlk3eQoiPkBBn9u3Tuvo5qFbV4WkNEfpHkiq', 'brdQ5aGC8AremjxZeMUEFTFmuTsUQrNCHnHohMOJZQ0xZKj16Nrs8EJe1P1a', '', '2019-06-26 03:01:33', '2019-06-26 03:01:33'),
(10, '111111', 'piannnn', 'administrator', '', '', '', '', NULL, '$2y$10$K8IZTb5Nu4XR2IzAdAJpIeFCCnSzvURT/oW1.y8NOLEdtl344Ualq', 'pq7f1fWduJd4feK0vOYe3mNxxtBUkOqLANFabY3lyJsDBgEV04wphNIl0wYS', '', '2019-06-26 23:31:23', '2019-07-24 21:37:44'),
(12, '0010', 'Admin BAAK', 'baak', '', '', '', '', NULL, '$2y$10$Ak1l0CsNWS4f7mN40ayo5eucZSdo1Wa7saEXWo8ZROwzVkGWK8TqC', NULL, '', '2019-07-02 12:15:37', '2019-07-24 21:37:57'),
(14, '0110217004', 'Pian', 'mahasiswa', '', '', '', '', NULL, '$2y$10$hgkd0pTv/AWJ7ffxg8lsMeUT1AY/4lUEfAlqU.Bcph2YX18XHso42', '2QIJnpVv11M95v0iBY8NjdWLI6pfwyks1rocpiptNQkK0bLfsbqqdPaGV2gs', '', '2019-07-24 21:38:55', '2019-07-24 21:38:55'),
(15, '22222', 'chaca', 'baak', '', '', '', '', NULL, '$2y$10$A5G7JQwF1simgU5At5aO0uaJNWfBOD4TQMIW2qtWIp95FhxqgQ/u6', NULL, '', '2019-07-25 04:43:40', '2019-07-25 04:43:40'),
(16, 'adminpek', 'pian', 'dosen', '', '', '', '', NULL, '$2y$10$IKOyTr7Mf0/.CT1jICUlG.v5vgJF1VsdF4bn4QK1kDXIe9Q3thLrO', NULL, '', '2019-12-11 07:26:44', '2019-12-11 07:26:44'),
(17, 'adminpin', 'adminpin', 'administrator', '', '', '', '', NULL, '$2y$10$9tPnmfkXUVTAAmg1tdm3PudHfPo09E2W5WcmmjMBomjwnAD8XRCfG', NULL, '', '2019-12-11 07:27:06', '2019-12-11 07:27:06'),
(18, '5000', 'adminpian', 'dosen', '', '', '', '', NULL, '$2y$10$bPh8ipzXK.9Ijraxwiez3uy6WR7X7QO38qOkgMl4Cbf5sasVdPIhC', NULL, 'Ak8M6bASmIrOMopOGbFFGy3VuGsZDm79yIJm5pqqqmv8M4HR1LvjLYoE1r6t5czpuI9D9cAP2Sxr3U2ezrYeBw3qheiOs8kiIhfy', '2019-12-24 23:17:56', '2019-12-24 23:17:56'),
(19, '3000', 'HILMI', 'dosen', 'hilmi@nurulfikri.ac.id', NULL, NULL, NULL, NULL, '$2y$10$Sglo/5..2nRMfQJFK3mIyeSHY3/VOCTY.XYPl2oHBtRZxQSg1Ejg.', NULL, NULL, '2020-03-22 23:01:53', '2020-07-19 08:58:34');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `absen_dosen`
--
ALTER TABLE `absen_dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dosenmatkul`
--
ALTER TABLE `dosenmatkul`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gedung`
--
ALTER TABLE `gedung`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mahasiswa_nim_unique` (`nim`);

--
-- Indeks untuk tabel `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `absen_dosen`
--
ALTER TABLE `absen_dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `dosenmatkul`
--
ALTER TABLE `dosenmatkul`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `gedung`
--
ALTER TABLE `gedung`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `krs`
--
ALTER TABLE `krs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `matkul`
--
ALTER TABLE `matkul`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
