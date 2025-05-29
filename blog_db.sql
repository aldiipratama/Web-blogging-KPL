-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 29, 2025 at 03:19 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `tanggal_publikasi` datetime DEFAULT CURRENT_TIMESTAMP,
  `penulis_id` int NOT NULL,
  `gambar_url` varchar(255) DEFAULT NULL,
  `isi_artikel` text NOT NULL,
  `kata_kunci` varchar(255) DEFAULT NULL,
  `status` enum('published','draft','pulled') DEFAULT 'draft',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `slug`, `tanggal_publikasi`, `penulis_id`, `gambar_url`, `isi_artikel`, `kata_kunci`, `status`, `created_at`, `updated_at`) VALUES
(1, 'post 1', 'post-1', '2025-05-29 19:25:57', 6, '', 'testing aja', 'teknologi,berita', 'published', '2025-05-29 19:25:57', '2025-05-29 19:25:57'),
(2, 'post 2', 'post-2', '2025-05-29 19:48:47', 6, '', 'testtt', 'tutorial', 'published', '2025-05-29 19:48:47', '2025-05-29 19:48:47'),
(3, 'post 3', 'post-3', '2025-05-29 19:49:06', 6, '', 'testttttt woi', 'apalah', 'published', '2025-05-29 19:49:06', '2025-05-29 19:49:06'),
(4, 'post 4', 'post-4', '2025-05-29 19:49:39', 6, '', 'hahahaha', 'berita', 'pulled', '2025-05-29 19:49:39', '2025-05-29 19:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `artikel_revisi`
--

CREATE TABLE `artikel_revisi` (
  `id` int NOT NULL,
  `artikel_id` int NOT NULL,
  `judul_lama` varchar(255) DEFAULT NULL,
  `gambar_url_lama` varchar(255) DEFAULT NULL,
  `isi_artikel_lama` text,
  `perubahan` text,
  `tanggal_revisi` datetime DEFAULT CURRENT_TIMESTAMP,
  `revisor_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `artikel_revisi`
--

INSERT INTO `artikel_revisi` (`id`, `artikel_id`, `judul_lama`, `gambar_url_lama`, `isi_artikel_lama`, `perubahan`, `tanggal_revisi`, `revisor_id`) VALUES
(1, 4, 'post 4', '', 'hahahaha', 'Status diubah dari \'draft\' menjadi \'pulled\'', '2025-05-29 19:49:58', 6),
(2, 4, 'post 4', '', 'hahahaha', 'Status diubah dari \'pulled\' menjadi \'published\'', '2025-05-29 19:50:11', 6),
(3, 4, 'post 4', '', 'hahahaha', 'Status diubah dari \'published\' menjadi \'pulled\'', '2025-05-29 19:50:23', 6);

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id` int NOT NULL,
  `artikel_id` int NOT NULL,
  `nama_komentator` varchar(100) NOT NULL,
  `email_komentator` varchar(100) DEFAULT NULL,
  `isi_komentar` text NOT NULL,
  `tanggal_komentar` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('approved','pending') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `artikel_id`, `nama_komentator`, `email_komentator`, `isi_komentar`, `tanggal_komentar`, `status`) VALUES
(1, 1, 'aldi', '', 'good bro', '2025-05-29 19:26:24', 'approved'),
(2, 1, 'aldi', '', 'test', '2025-05-29 19:30:58', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `created_at`, `updated_at`) VALUES
(6, 'aldiipratama', '$2y$10$CDJiudBfs5yT7SiFRpzXIOQrEtehRpsvJPUqSznJKP1LTftz60S4O', 'Aldi Pratama', '2025-05-29 19:23:31', '2025-05-29 19:23:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `penulis_id` (`penulis_id`);

--
-- Indexes for table `artikel_revisi`
--
ALTER TABLE `artikel_revisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artikel_id` (`artikel_id`),
  ADD KEY `revisor_id` (`revisor_id`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artikel_id` (`artikel_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `artikel_revisi`
--
ALTER TABLE `artikel_revisi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `artikel_ibfk_1` FOREIGN KEY (`penulis_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `artikel_revisi`
--
ALTER TABLE `artikel_revisi`
  ADD CONSTRAINT `artikel_revisi_ibfk_1` FOREIGN KEY (`artikel_id`) REFERENCES `artikel` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `artikel_revisi_ibfk_2` FOREIGN KEY (`revisor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`artikel_id`) REFERENCES `artikel` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
