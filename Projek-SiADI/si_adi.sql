-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2024 at 04:35 AM
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
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(4, 'dark_flame_master', 'yuuta_chuunibyou');

-- --------------------------------------------------------

--
-- Table structure for table `data_dinamis`
--

CREATE TABLE `data_dinamis` (
  `tahun_arsip` int(4) DEFAULT NULL,
  `skpd` varchar(255) DEFAULT NULL,
  `pokok_masalah` varchar(255) DEFAULT NULL,
  `kode_klasifikasi` varchar(255) DEFAULT NULL,
  `no_urut_berkas` varchar(255) DEFAULT NULL,
  `no_box` varchar(255) DEFAULT NULL,
  `no_rak` varchar(255) DEFAULT NULL,
  `bentuk_penataan` varchar(255) DEFAULT NULL,
  `nama_pemberkas` varchar(255) DEFAULT NULL,
  `no_surat_arsip` varchar(255) NOT NULL,
  `indeks_judul_arsip` varchar(255) DEFAULT NULL,
  `tingkat_pengembangan_arsip` varchar(255) DEFAULT NULL,
  `nilai_guna_arsip` varchar(255) DEFAULT NULL,
  `kondisi_arsip` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `pemerian_berkas` varchar(255) DEFAULT NULL,
  `jumlah_berkas` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `lampirkan_file` longblob DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `retensi_aktif` int(11) DEFAULT NULL,
  `retensi_inaktif` int(11) DEFAULT NULL,
  `uraian_arsip` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_dinamis`
--

INSERT INTO `data_dinamis` (`tahun_arsip`, `skpd`, `pokok_masalah`, `kode_klasifikasi`, `no_urut_berkas`, `no_box`, `no_rak`, `bentuk_penataan`, `nama_pemberkas`, `no_surat_arsip`, `indeks_judul_arsip`, `tingkat_pengembangan_arsip`, `nilai_guna_arsip`, `kondisi_arsip`, `status`, `pemerian_berkas`, `jumlah_berkas`, `keterangan`, `lampirkan_file`, `tanggal_masuk`, `retensi_aktif`, `retensi_inaktif`, `uraian_arsip`) VALUES
(2013, 'DInas Perpustakaan dan Kearsipan', 'Pembentukan Perpustakaan Desa', '000 / UMUM', '1', '1', '1', 'arsip', 'jawir', '001', 'sadasddsa', 'Asli', 'Keuangan', 'bagus', 'aktif', 'asdasdasd', '133', 'sdfdsf', 0x4d656d6f7269616c5f4c6f6262795f4b617a7573612e6a7067, '2024-07-29', 2, 3, 'asdasdas'),
(2013, 'DInas Perpustakaan dan Kearsipan', 'Pembentukan Perpustakaan Desa', '000.1.15.1 / Pengawasan Kearsipan', '1', '1', '1', 'arsip', 'jawir', '01', '-', 'Tembusan', 'Hukum', 'bagus', 'aktif', '--', '133', 'sdfdsf', 0x44617461204172736970204d75736e61682e706466, '2024-07-24', 2, 3, NULL),
(2013, 'DInas Perpustakaan dan Kearsipan', 'Pembentukan Perpustakaan Desa', '041', '1', '1', '1', '-', 'admin', '041/29/32/SK/2013', 'Pembentukan Pustakaan Desa', 'Copy', 'Informasi', 'Baik', 'Musnah', '-', '1', 'surat masuk', 0x53637265656e73686f745f323032342d30372d30385f3231353331382d72656d6f766562672d707265766965772e706e67, '2013-08-14', 2, 1, NULL),
(2022, 'adsads', 'adsadsads', '000.1.15.1 / Pengawasan Kearsipan', '1112', '53544', '234', 'arsip', 'jawir', '1', 'adadadda', 'Asli', 'administrasi', 'asdsad', 'aktif', 'dadadad', '133', 'sdaasd', 0x4d656d6f7269616c5f4c6f6262795f4d696b61202831292e6a7067, '2024-07-17', 2, 3, NULL),
(2022, 'adsads', 'adsadsads', '100.12.43 / Gotong Royong', '1112', '53544', '234', 'arsip', 'jawir', '11', 'dsasdasd', 'Asli', 'administrasi', 'asdsad', 'inaktif', 'dassdasd', '133', 'sdaasd', 0x53637265656e73686f745f323032342d30372d30385f3231353331382d72656d6f766562672d707265766965772e706e67, '2021-08-26', 2, 3, NULL),
(2022, 'adsads', 'adsadsads', '000.1 / Kearsipan', '1112', '53544', '234', 'arsip', 'jawir', '111', 'dsaasddsa', 'Asli', 'keuangan', 'asdsad', 'Musnah', 'asdsdaasd', '133', 'sdaasd', 0x313331343732392e6a7067, '2018-01-09', 2, 3, NULL),
(2022, 'adsads', 'adsadsads', '000.1.15.1 / Pengawasan Kearsipan', '1112', '53544', '234', 'arsip', 'jawir', '11111', 'asdassd', 'Copy', 'keuangan', 'asdsad', 'inaktif', 'asdasdasd', '133', 'sdaasd', 0x53637265656e73686f745f323032342d30372d30385f3231353331382d72656d6f766562672d707265766965772e706e67, '2021-06-09', 2, 3, NULL),
(2013, 'DInas Perpustakaan dan Kearsipan', 'Pembentukan Perpustakaan Desa', '000 / UMUM', '1', '1', '1', 'arsip', 'jawir', '1111121', '-', 'Tembusan', 'Informasi', 'bagus', 'Musnah', 'dsfsdf', '133', 'sdfdsf', 0x53637265656e73686f745f323032342d30372d30385f3231353331382d72656d6f766562672d707265766965772e706e67, '2013-04-13', 2, 3, NULL),
(2013, 'DInas Perpustakaan dan Kearsipan', 'Pembentukan Perpustakaan Desa', '000 / UMUM', '1', '1', '1', 'arsip', 'jawir', '1111122', '-', 'Tembusan', 'Kebuktian/evidental', 'bagus', 'Musnah', 'sdasads', '133', 'sdfdsf', 0x53637265656e73686f745f323032342d30372d30385f3231353331382d72656d6f766562672d707265766965772e706e67, '2013-12-12', 2, 3, NULL),
(2013, 'DInas Perpustakaan dan Kearsipan', 'Pembentukan Perpustakaan Desa', '100.12.43 / Gotong Royong', '1', '1', '1', 'arsip', 'jawir', '1111123', '-', 'Tembusan', 'Kebuktian/evidental', 'bagus', 'Musnah', 'sdsdfdfs', '133', 'sdfdsf', 0x53637265656e73686f7420323032342d30372d3038203231353331382e706e67, '2013-02-13', 2, 3, NULL),
(2013, 'DInas Perpustakaan dan Kearsipan', 'Pembentukan Perpustakaan Desa', '000 / UMUM', '1', '1', '1', 'arsip', 'jawir', '1111124', '-', 'Asli', 'Keuangan', 'bagus', 'aktif', 'dfsdfsdf', '133', 'sdfdsf', 0x44617461204172736970204d75736e61682e706466, '2024-07-24', 2, 3, NULL),
(2022, 'adsads', 'adsadsads', '', '1112', '53544', '234', 'arsip', 'jawir', '11112', 'jkgjkgjg', 'Asli', 'hukum', 'asdsad', 'aktif', 'sdfadfssdf', '133', 'sdaasd', 0x53637265656e73686f7420323032342d30372d3038203231353331382e706e67, '2024-07-26', 2, 3, NULL),
(2022, 'adsads', 'adsadsads', '', '1112', '53544', '234', 'arsip', 'jawir', '11113', 'sdaasd', 'Copy', 'hukum', 'asdsad', 'Musnah', 'asdasddas', '133', 'sdaasd', 0x4d656d6f7269616c5f4c6f6262795f4b617a7573612e6a7067, '2017-11-15', 2, 3, NULL),
(2022, 'adsads', 'adsadsads', '000.1 / Kearsipan', '1112', '53544', '234', 'arsip', 'jawir', '11114', 'ewqewewq', 'Copy', 'administrasi', 'asdsad', 'Musnah', 'ewqqweweq', '133', 'sdaasd', 0x53637265656e73686f745f323032342d30372d30385f3231353331382d72656d6f766562672d707265766965772e706e67, '2014-05-05', 2, 3, NULL),
(2022, 'adsads', 'adsadsads', '', '1112', '53544', '234', 'arsip', 'jawir', '11115', 'asdsadsdads', 'Copy', 'informasi', 'asdsad', 'Musnah', 'asdadsads', '133', 'sdaasd', 0x53637265656e73686f745f323032342d30372d30385f3231353331382d72656d6f766562672d707265766965772e706e67, '2017-01-18', 2, 3, NULL),
(2022, 'adsads', 'adsadsads', '100.12.43 / Gotong Royong', '1112', '53544', '234', 'arsip', 'jawir', '11116', 'sdfdfssff', 'Tembusan', 'keuangan', 'asdsad', 'Musnah', 'asdasdsda', '133', 'sdaasd', 0x53637265656e73686f7420323032342d30372d3038203231353331382e706e67, '2016-05-18', 2, 3, NULL),
(2022, 'adsads', 'adsadsads', '111.123.1 / Makanan', '1112', '53544', '234', 'arsip', 'jawir', '11117', 'asdasd', 'Copy', 'hukum', 'asdsad', 'Musnah', 'dasasdsadsad', '133', 'sdaasd', 0x53637265656e73686f745f323032342d30372d30385f3231353331382d72656d6f766562672d707265766965772e706e67, '2016-05-09', 2, 3, NULL),
(2022, 'adsads', 'adsadsads', '000 / UMUM', '1112', '53544', '234', 'arsip', 'jawir', '11118', 'asdasddsa', 'Copy', 'kebuktian/evidental', 'asdsad', 'Musnah', 'asdasdsad', '133', 'sdaasd', 0x313331343732392e6a7067, '2016-06-07', 2, 3, NULL),
(2022, 'adsads', 'adsadsads', '', '1112', '53544', '234', 'arsip', 'jawir', '11119', 'dsfsdfsdf', 'Tembusan', 'Hukum', 'asdsad', 'aktif', 'fdgdfgdfg', '133', 'sdaasd', 0x53637265656e73686f7420323032342d30372d3038203231353331382e706e67, '2024-07-18', 2, 3, NULL),
(2022, 'adsads', 'adsadsads', '112.5.1.0 / JAWIR', '1112', '53544', '234', 'arsip', 'jawir', '11120', 'dsfsfd', 'Asli', 'Keuangan', 'asdsad', 'inaktif', 'dasdasasdasd', '133', 'sdaasd', 0x53637265656e73686f7420323032342d30372d3038203231353331382e706e67, '2021-06-09', 2, 3, NULL),
(2022, 'adsads', 'adsadsads', '', '1112', '53544', '234', 'arsip', 'jawir', '11233', 'sadadsasd', 'Copy', 'keuangan', 'asdsad', 'Statis', 'sadsadasd', '133', 'sdaasd', 0x53637265656e73686f745f323032342d30372d30385f3231353331382d72656d6f766562672d707265766965772e706e67, '2024-07-17', 4, 6, NULL),
(2022, 'adsads', 'adsadsads', '002.123.1 / Perpustakaan', '1112', '53544', '234', 'arsip', 'jawir', '112334', 'sadadsasd', 'Copy', 'kebuktian/evidental', 'asdsad', 'Statis', 'asdasdsad', '133', 'sdaasd', 0x53637265656e73686f745f323032342d30372d30385f3231353331382d72656d6f766562672d707265766965772e706e67, '2024-08-03', 4, 6, NULL);

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
(25, '001.1 / Genshin'),
(17, '002.123.1 / Perpustakaan'),
(26, '041'),
(15, '100.12.43 / Gotong Royong'),
(24, '111 / Bendry Lakburlawal'),
(12, '111.123.1 / Makanan'),
(23, '112.5.1.0 / JAWIR'),
(22, '115'),
(16, '123 / Honorer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_dinamis`
--
ALTER TABLE `data_dinamis`
  ADD PRIMARY KEY (`no_surat_arsip`);

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
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kode_klasifikasi`
--
ALTER TABLE `kode_klasifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
