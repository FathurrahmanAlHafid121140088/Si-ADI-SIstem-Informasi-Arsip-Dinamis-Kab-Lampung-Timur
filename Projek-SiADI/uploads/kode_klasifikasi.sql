-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2024 at 07:36 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_adi`
--

-- --------------------------------------------------------

--
-- Table structure for table `kode_klasifikasi`
--

CREATE TABLE `kode_klasifikasi` (
  `id` int(11) NOT NULL,
  `kode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kode_klasifikasi`
--

INSERT INTO `kode_klasifikasi` (`id`, `kode`) VALUES
(6, '000 / UMUM'),
(11, '000.1 / Kearsipan'),
(9, '000.1.15.1 / Pengawasan Kearsipan'),
(17, '002.123.1 / Perpustakaan'),
(1, '003'),
(15, '100.12.43 / Gotong Royong'),
(12, '111.123.1 / Makanan'),
(16, '123 / Honorer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kode_klasifikasi`
--
ALTER TABLE `kode_klasifikasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kode_klasifikasi`
--
ALTER TABLE `kode_klasifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
