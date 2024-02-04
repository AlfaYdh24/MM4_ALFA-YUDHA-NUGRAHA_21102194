-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 13, 2023 at 04:37 PM
-- Server version: 8.0.35-cll-lve
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kelasmm2_taufiq`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(8, 'IF09MM1', '2023-12-05 06:34:31', '2023-12-05 06:34:31'),
(9, 'IF09MM2', '2023-12-05 06:34:31', '2023-12-05 06:34:31'),
(10, 'IF09MM3', '2023-12-05 06:34:31', '2023-12-05 06:34:31'),
(11, 'IF09MM4', '2023-12-05 06:34:31', '2023-12-05 06:34:31'),
(12, 'IF09SC1', '2023-12-05 06:34:31', '2023-12-05 06:34:31'),
(14, 'IF09TI1', '2023-12-05 06:34:31', '2023-12-05 06:34:31'),
(15, 'IF09TI2', '2023-12-05 06:34:31', '2023-12-05 06:34:31'),
(16, 'IF09TI3', '2023-12-05 06:34:31', '2023-12-05 06:34:31');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int NOT NULL,
  `nama_lengkap` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kelas_id` int DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama_lengkap`, `kelas_id`, `alamat`, `created_at`, `updated_at`) VALUES
(39, 'Lutfi Zulfian', 14, 'Purbalingga ', '2023-12-05 08:20:22', '2023-12-05 08:20:22'),
(40, 'Bagas Arya Amirul Jawad', 9, 'Surabaya ', '2023-12-05 13:06:36', '2023-12-05 13:06:36'),
(41, 'Fadli Muzaki', 8, 'Cilacap', '2023-12-05 14:38:50', '2023-12-05 14:38:50'),
(42, 'hai', 8, 'hehe', '2023-12-06 03:54:50', '2023-12-06 03:54:50'),
(44, 'Taupok', 8, 'Ulin', '2023-12-08 12:44:10', '2023-12-08 12:44:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
