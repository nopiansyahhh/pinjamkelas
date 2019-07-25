-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2019 at 06:05 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

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
-- Table structure for table `gedung`
--

CREATE TABLE `gedung` (
  `id` int(10) UNSIGNED NOT NULL,
  `gedung` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gedung`
--

INSERT INTO `gedung` (`id`, `gedung`, `status`, `created_at`, `updated_at`) VALUES
(1, 'B1', 'Aktif', '2019-06-30 07:41:22', '2019-07-16 01:29:57'),
(2, 'B2', 'Aktif', '2019-06-30 07:41:27', '2019-06-30 07:41:27');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
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
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `email`, `jk`, `tempatlahir`, `tanggalahir`, `semester`, `nohp`, `prodi`, `alamat`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(1, '0110217001', 'Nopiansyahhh', 'nopiansyahhh@gmail.com', 'L', NULL, '1945-12-01', '20181', '0172031872', 'TI', 'aafsdfssdsadf beneran', '0110217001_checklist.png', 'AKTIF', NULL, '2019-07-24 20:16:47'),
(7, '0110217002', 'piannnn', 'pian@pian.com', 'L', NULL, '2019-06-26', '01231', '234243', 'TI', 'asdasdfsdf', '0110217002_checklist.png', 'AKTIF', '2019-06-26 01:44:44', '2019-07-24 10:20:59'),
(9, '0110217003', 'annisa rinjani', 'tes@tes.com', 'P', NULL, '2019-06-03', '12312', '342342', 'TI', 'df ksdfbks', '0110217003_checklist-png-5.png', 'AKTIF', '2019-06-26 03:01:33', '2019-07-24 20:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2019_06_13_042110_create_table_gedung', 1),
(10, '2019_06_13_043214_create_table_ruangan', 1),
(11, '2019_06_13_043554_create_table_mahasiswa', 1),
(12, '2019_06_13_044111_create_table_peminjaman', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
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
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `ruangan_id`, `mahasiswa_id`, `tanggal`, `ket`, `kettolak`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '0110217003', '2019-07-08', NULL, NULL, 'DISETUJUI', '2019-07-03 02:58:01', '2019-07-05 22:17:59'),
(2, 1, '0110217003', '2019-07-15', NULL, NULL, 'Menunggu Konfirmasi', '2019-07-03 03:13:00', '2019-07-03 03:13:00'),
(3, 1, '0110217003', '2019-07-22', 'm', 'yang bener klo minjem kelasss bangcaatttttt', 'DITOLAK', '2019-07-03 06:32:02', '2019-07-03 06:35:12'),
(4, 2, '0110217003', '2019-07-08', NULL, NULL, 'Menunggu Konfirmasi', '2019-07-03 19:23:30', '2019-07-03 19:23:30'),
(5, 2, '0110217003', '2019-07-15', NULL, NULL, 'Menunggu Konfirmasi', '2019-07-03 19:44:16', '2019-07-03 19:44:16'),
(6, 3, '0110217003', '2019-07-08', NULL, NULL, 'Menunggu Konfirmasi', '2019-07-03 19:46:32', '2019-07-03 19:46:32'),
(7, 4, '0110217003', '2019-07-29', NULL, NULL, 'Menunggu Konfirmasi', '2019-07-03 23:44:33', '2019-07-03 23:44:33'),
(8, 1, '0110217003', '2019-07-29', NULL, NULL, 'Menunggu Konfirmasi', '2019-07-03 23:47:00', '2019-07-03 23:47:00'),
(9, 5, '0110217003', '2019-07-16', 'pinjem dong baak, pleaseee helpp meee', 'lu minjme bersiin kga, gimana sih lu', 'DITOLAK', '2019-07-05 07:52:31', '2019-07-05 07:53:13'),
(10, 5, '0110217003', '2019-07-30', 'pinjam dong hehe', NULL, 'Menunggu Konfirmasi', '2019-07-05 20:47:03', '2019-07-05 20:47:03'),
(11, 4, '0110217003', '2019-08-05', NULL, 'gua tolak lu', 'DITOLAK', '2019-07-05 20:47:33', '2019-07-16 08:20:37'),
(12, 5, '0110217004', '2019-07-23', NULL, 'sipp cepet beres ya', 'DITOLAK', '2019-07-05 22:19:53', '2019-07-05 22:30:28'),
(13, 8, '0110217005', '2019-07-10', 'pinjam untuk nonton korea berjamaah', 'oke gunakan sebaik-baiknya', 'DISETUJUI', '2019-07-08 07:16:03', '2019-07-08 07:18:30'),
(14, 5, '0110217003', '2019-08-06', NULL, NULL, 'Menunggu Konfirmasi', '2019-07-16 00:17:16', '2019-07-16 00:17:16'),
(15, 8, '0110217004', '2019-07-24', 'HA HA HA', NULL, 'Menunggu Konfirmasi', '2019-07-16 01:51:06', '2019-07-16 01:51:06'),
(16, 8, '0110217003', '2019-07-17', 'ha ha ha', NULL, 'Menunggu Konfirmasi', '2019-07-16 01:54:34', '2019-07-16 01:54:34'),
(17, 8, '0110217003', '2019-07-31', 'ha ha ha', 'yaudsssss', 'DISETUJUI', '2019-07-16 01:56:38', '2019-07-16 01:57:29'),
(18, 10, '0110217003', '2019-07-22', 'he he', 'gua tolak lu', 'DITOLAK', '2019-07-16 02:00:42', '2019-07-16 02:01:00'),
(19, 1, '0110217003', '2019-08-12', 'pinjem yak', NULL, 'Menunggu Konfirmasi', '2019-07-16 08:19:00', '2019-07-16 08:19:00'),
(20, 4, '0110217003', '2019-09-02', 'bikin berkasnya dulu please', NULL, 'Menunggu Konfirmasi', '2019-07-24 20:58:13', '2019-07-24 20:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
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
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id`, `gedung_id`, `ruangan`, `hari`, `jamawal`, `jamakhir`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '101', 'senin', '08:00:00', '10:30:00', 'Aktif', '2019-06-30 07:42:09', '2019-07-16 02:03:50'),
(2, 1, '101', 'senin', '10:00:00', '11:00:00', 'Aktif', '2019-06-30 07:42:47', '2019-06-30 07:42:47'),
(3, 2, '201', 'senin', '13:00:00', '14:00:00', 'Aktif', '2019-06-30 07:43:11', '2019-06-30 07:43:11'),
(4, 2, '201', 'senin', '14:00:00', '16:00:00', 'Aktif', '2019-06-30 07:43:34', '2019-06-30 07:43:34'),
(5, 1, '105', 'selasa', '13:00:00', '15:00:00', 'Aktif', '2019-07-05 07:50:14', '2019-07-05 07:50:14'),
(7, 1, '101', 'senin', '10:11:00', '11:00:00', 'Aktif', '2019-07-08 06:31:11', '2019-07-08 06:31:23'),
(8, 1, '105', 'rabu', '09:00:00', '10:00:00', 'Aktif', '2019-07-08 07:11:27', '2019-07-08 07:11:27'),
(10, 2, '209', 'senin', '09:00:00', '11:00:00', 'Aktif', '2019-07-16 01:59:16', '2019-07-16 01:59:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nim`, `name`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, '0110217003', NULL, 'mahasiswa', NULL, '$2y$10$g3tseiiO8xG0Z1YUZJlk3eQoiPkBBn9u3Tuvo5qFbV4WkNEfpHkiq', 'w6cBkMh11qGhvCdToqsGtu9dVE2Ftx7Wf18qOiB4TSjXLPHtc3Bp0Zlh0Igx', '2019-06-26 03:01:33', '2019-06-26 03:01:33'),
(10, '111111', 'piann', 'administrator', NULL, '$2y$10$ngB95p/nTXadkhdX65pH7.PWVkmPdyOFHVzn5QoYKwCk4OoKWOoIe', 'YYIQYJPazdaMlRcCP968dVKK8v3bQodIrSPFXFRvQQlDrLuE5kqTO7rA176l', '2019-06-26 23:31:23', '2019-07-16 01:06:05'),
(12, '0010', 'piannn', 'baak', NULL, '$2y$10$Ak1l0CsNWS4f7mN40ayo5eucZSdo1Wa7saEXWo8ZROwzVkGWK8TqC', NULL, '2019-07-02 12:15:37', '2019-07-02 12:15:47'),
(13, '22222', 'chacha', 'baak', NULL, '$2y$10$DT6NE5Oa6A9KFmSNF/aEnefO6cjcOjmZX4fTfm32SB2CfXREOk8Dq', NULL, '2019-07-04 08:05:47', '2019-07-04 08:05:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gedung`
--
ALTER TABLE `gedung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mahasiswa_nim_unique` (`nim`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gedung`
--
ALTER TABLE `gedung`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
