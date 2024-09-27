-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 24, 2024 at 04:12 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_jihan`
--

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_dosen`
--

CREATE TABLE `jadwal_dosen` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_dosen`
--

INSERT INTO `jadwal_dosen` (`id`, `tanggal`, `id_dosen`, `created_at`, `updated_at`) VALUES
(1, '2024-06-15', 1, '2024-06-15 14:10:07', '2024-06-15 14:10:07');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bimbingan`
--

CREATE TABLE `tb_bimbingan` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `kategori` enum('KP','TA','Pengajuan') NOT NULL DEFAULT 'KP',
  `status` enum('Selesai','Berjalan','Batal') NOT NULL DEFAULT 'Berjalan',
  `id_mahasiswa` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_bimbingan`
--

INSERT INTO `tb_bimbingan` (`id`, `judul`, `keterangan`, `kategori`, `status`, `id_mahasiswa`, `id_dosen`, `created_at`, `updated_at`) VALUES
(1, 'Contoh Judul', 'Laporan Kerja Praktik', 'KP', 'Berjalan', 1, 1, '2024-06-18 04:25:35', '2024-06-18 04:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bimbingan_detail`
--

CREATE TABLE `tb_bimbingan_detail` (
  `id_detail` int(11) NOT NULL,
  `id_bimbingan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `paraf` enum('Bimbingan','Ditolak','Menunggu') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_bimbingan_detail`
--

INSERT INTO `tb_bimbingan_detail` (`id_detail`, `id_bimbingan`, `tanggal`, `keterangan`, `paraf`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-06-18', 'Bimbingan Judul', 'Menunggu', '2024-06-18 04:53:12', '2024-06-18 04:53:12');

-- --------------------------------------------------------

--
-- Table structure for table `tb_dosen`
--

CREATE TABLE `tb_dosen` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nip` char(30) NOT NULL,
  `no_hp` char(15) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_dosen`
--

INSERT INTO `tb_dosen` (`id`, `nama`, `nip`, `no_hp`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 'TRIASE, S.T., M.Kom', '1100000122', '08281', 3, '2024-06-14 00:12:55', '2024-06-14 00:30:44');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nim` char(15) NOT NULL,
  `no_hp` char(15) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`id`, `nama`, `nim`, `no_hp`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 'Jihan Syahira', '0702193230', '0857828528', 4, '2024-06-14 00:41:29', '2024-06-14 00:44:12'),
(2, 'Jihan', '0702173179', '0', 5, '2024-06-18 10:07:38', '2024-06-18 10:07:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` enum('Admin','Mahasiswa','Dosen') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Admin',
  `last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `level`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$.zyv.mN4ewS36HGJcBDXWua88yylf2MwZRK3603IZfRfoNZhJEvHy', 'Admin', '2024-06-18 04:18:53', '2024-01-31 06:01:00', '2024-06-18 04:18:53'),
(3, 'TRIASE, S.T., M.Kom', 'triase@uinsu.ac.id', '$2y$10$nppXCU8vkCb8bJ0qgNEd0ukvoXKQm2AlXSIEO3PyKB9dfhv99uMza', 'Dosen', '2024-06-18 05:19:26', '2024-06-14 00:30:44', '2024-06-18 05:19:26'),
(4, 'Jihan Syahira', 'jihan@gmail.com', '$2y$10$kgmnHwieAaH5L62DHGpVkekSjGMDTxbl50FCX84Vgp/D/Zjd.9SNm', 'Mahasiswa', '2024-06-18 10:10:07', '2024-06-14 00:44:12', '2024-06-18 10:10:07'),
(5, 'Jihan', 'jihan1@gmail.com', '$2y$10$dqsE5CRRa8.SD.fmcYi36uN0FbJsWxFukb62c1oMfp/I1AtgBNgS6', 'Mahasiswa', '2024-06-18 10:07:38', '2024-06-18 10:07:38', '2024-06-18 10:07:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal_dosen`
--
ALTER TABLE `jadwal_dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_bimbingan`
--
ALTER TABLE `tb_bimbingan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_bimbingan_detail`
--
ALTER TABLE `tb_bimbingan_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal_dosen`
--
ALTER TABLE `jadwal_dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_bimbingan`
--
ALTER TABLE `tb_bimbingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_bimbingan_detail`
--
ALTER TABLE `tb_bimbingan_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
