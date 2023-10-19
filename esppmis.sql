-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2023 at 10:37 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esppmis`
--

-- --------------------------------------------------------

--
-- Table structure for table `biaya_semester`
--

CREATE TABLE `biaya_semester` (
  `id_semester` int(5) NOT NULL,
  `semester` varchar(10) DEFAULT NULL,
  `biaya` decimal(20,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `biaya_semester`
--

INSERT INTO `biaya_semester` (`id_semester`, `semester`, `biaya`) VALUES
(2, '2023/2024', '250000'),
(3, '2023/2024', '250000');

-- --------------------------------------------------------

--
-- Table structure for table `tagihan_spp`
--

CREATE TABLE `tagihan_spp` (
  `id_spp` int(5) NOT NULL,
  `id_siswa` int(10) DEFAULT NULL,
  `id_semester` int(5) DEFAULT NULL,
  `jatuhtempo` date DEFAULT NULL,
  `bulan` varchar(20) DEFAULT NULL,
  `jumlah` decimal(20,0) DEFAULT NULL,
  `no_bayar` varchar(100) DEFAULT NULL,
  `tgl_bayar` datetime DEFAULT NULL,
  `keterangan` varchar(20) DEFAULT NULL,
  `chanel` varchar(20) DEFAULT NULL,
  `tempat` varchar(20) DEFAULT NULL,
  `id_admin` int(5) DEFAULT NULL,
  `id_users` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tagihan_spp`
--

INSERT INTO `tagihan_spp` (`id_spp`, `id_siswa`, `id_semester`, `jatuhtempo`, `bulan`, `jumlah`, `no_bayar`, `tgl_bayar`, `keterangan`, `chanel`, `tempat`, `id_admin`, `id_users`) VALUES
(265, 11, 3, '2025-06-10', 'Juni 2025', '250000', '20230708083105', '2023-07-08 00:00:00', 'Lunas', 'Afdal Zikri Amanda', 'Tata Usaha', NULL, 1),
(266, 11, 3, '2025-07-10', 'Juli 2025', '250000', '20230708083109', '2023-07-08 00:00:00', 'Lunas', 'Afdal Zikri Amanda', 'Tata Usaha', NULL, 1),
(267, 11, 3, '2025-08-10', 'Agustus 2025', '250000', '20230708083117', '2023-07-08 00:00:00', 'Lunas', 'Afdal Zikri Amanda', 'Tata Usaha', NULL, 1),
(268, 11, 3, '2025-09-10', 'September 2025', '250000', '20230708083124', '2023-07-08 00:00:00', 'Lunas', 'Afdal Zikri Amanda', 'Tata Usaha', NULL, 1),
(269, 11, 3, '2025-10-10', 'Oktober 2025', '250000', '20230708083200', '2023-07-08 00:00:00', 'Lunas', 'Afdal Zikri Amanda', 'Tata Usaha', NULL, 1),
(270, 11, 3, '2025-11-10', 'November 2025', '250000', '20230708083205', '2023-07-08 00:00:00', 'Lunas', 'Afdal Zikri Amanda', 'Tata Usaha', NULL, 1),
(271, 11, 3, '2025-12-10', 'Desember 2025', '250000', '20230708083209', '2023-07-08 00:00:00', 'Lunas', 'Afdal Zikri Amanda', 'Tata Usaha', NULL, 1),
(272, 11, 3, '2026-01-10', 'januari 2026', '250000', NULL, NULL, 'belum lunas', NULL, NULL, NULL, NULL),
(273, 11, 3, '2026-02-10', 'Februari 2026', '250000', NULL, NULL, 'belum lunas', NULL, NULL, NULL, NULL),
(274, 11, 3, '2026-03-10', 'Maret 2026', '250000', NULL, NULL, 'belum lunas', NULL, NULL, NULL, NULL),
(275, 11, 3, '2026-04-10', 'April 2026', '250000', NULL, NULL, 'belum lunas', NULL, NULL, NULL, NULL),
(276, 11, 3, '2026-05-10', 'Mei 2026', '250000', NULL, NULL, 'belum lunas', NULL, NULL, NULL, NULL),
(277, 12, 3, '2025-06-10', 'Juni 2025', '250000', '20230708083226', '2023-07-08 00:00:00', 'Lunas', 'Afdal Zikri Amanda', 'Tata Usaha', NULL, 1),
(278, 12, 3, '2025-07-10', 'Juli 2025', '250000', '20230708083229', '2023-07-08 00:00:00', 'Lunas', 'Afdal Zikri Amanda', 'Tata Usaha', NULL, 1),
(279, 12, 3, '2025-08-10', 'Agustus 2025', '250000', '20230708083233', '2023-07-08 00:00:00', 'Lunas', 'Afdal Zikri Amanda', 'Tata Usaha', NULL, 1),
(280, 12, 3, '2025-09-10', 'September 2025', '250000', '20230708083236', '2023-07-08 00:00:00', 'Lunas', 'Afdal Zikri Amanda', 'Tata Usaha', NULL, 1),
(281, 12, 3, '2025-10-10', 'Oktober 2025', '250000', '20230708083241', '2023-07-08 00:00:00', 'Lunas', 'Afdal Zikri Amanda', 'Tata Usaha', NULL, 1),
(282, 12, 3, '2025-11-10', 'November 2025', '250000', '20230708083244', '2023-07-08 00:00:00', 'Lunas', 'Afdal Zikri Amanda', 'Tata Usaha', NULL, 1),
(283, 12, 3, '2025-12-10', 'Desember 2025', '250000', '20230708083248', '2023-07-08 00:00:00', 'Lunas', 'Afdal Zikri Amanda', 'Tata Usaha', NULL, 1),
(284, 12, 3, '2026-01-10', 'januari 2026', '250000', '20230708083252', '2023-07-08 00:00:00', 'Lunas', 'Afdal Zikri Amanda', 'Tata Usaha', NULL, 1),
(285, 12, 3, '2026-02-10', 'Februari 2026', '250000', '20230708083255', '2023-07-08 00:00:00', 'Lunas', 'Afdal Zikri Amanda', 'Tata Usaha', NULL, 1),
(286, 12, 3, '2026-03-10', 'Maret 2026', '250000', '20230708083300', '2023-07-08 00:00:00', 'Lunas', 'Afdal Zikri Amanda', 'Tata Usaha', NULL, 1),
(287, 12, 3, '2026-04-10', 'April 2026', '250000', '20230708083304', '2023-07-08 00:00:00', 'Lunas', 'Afdal Zikri Amanda', 'Tata Usaha', NULL, 1),
(288, 12, 3, '2026-05-10', 'Mei 2026', '250000', '20230708083308', '2023-07-08 00:00:00', 'Lunas', 'Afdal Zikri Amanda', 'Tata Usaha', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `name` varchar(120) DEFAULT NULL,
  `no_id` varchar(10) DEFAULT NULL,
  `tgl_lahir` varchar(120) DEFAULT NULL,
  `role` enum('superadmin','admin') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `name`, `no_id`, `tgl_lahir`, `role`, `created_at`) VALUES
(3, 'Risa Satifa', '2020080723', '080723', 'admin', '2023-07-08 08:03:46'),
(4, 'Abdal Jabar', '2020090723', '080723', 'admin', '2023-07-08 08:04:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kelas`
--

CREATE TABLE `tbl_kelas` (
  `kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_kelas`
--

INSERT INTO `tbl_kelas` (`kelas`) VALUES
('I A'),
('I B'),
('II A'),
('II B'),
('III A'),
('III B'),
('IV A'),
('IV B'),
('V A'),
('V B'),
('VI A'),
('VI B');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `id_siswa` int(11) NOT NULL,
  `name` varchar(120) DEFAULT NULL,
  `nis` varchar(10) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `tahunajaran` varchar(10) DEFAULT NULL,
  `tgl_lahir` varchar(120) DEFAULT NULL,
  `biaya` int(20) DEFAULT NULL,
  `role` enum('siswa') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`id_siswa`, `name`, `nis`, `kelas`, `tahunajaran`, `tgl_lahir`, `biaya`, `role`, `created_at`) VALUES
(11, 'Jabar', '1010280623', 'I A', '2023/2024', '280623', 250000, 'siswa', '2023-07-08 08:10:00'),
(12, 'Risa', '1010290623', 'I A', '2023/2024', '290623', 250000, 'siswa', '2023-07-08 08:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id_users` int(11) NOT NULL,
  `id_siswa` int(10) DEFAULT NULL,
  `id_admin` int(10) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `username` varchar(120) DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL,
  `role` enum('superadmin','admin','siswa') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id_users`, `id_siswa`, `id_admin`, `name`, `username`, `password`, `role`, `created_at`) VALUES
(1, NULL, NULL, 'Afdal Zikri Amanda', '2020190799', '$2y$10$PgBhkfjoTzYsebi/VgWbCe.nxdOsp6mTWt0i9LA8S3L8aXH6sGBt6', 'superadmin', '2023-06-05 08:33:46'),
(13, NULL, 3, 'Risa Satifa', '2020080723', '$2y$10$vP38F9cQI3fuEaKdvXjLc.HNzSEa2QIwvH5rGolwz6NfztXpcGL3m', 'admin', '2023-07-08 08:03:46'),
(14, NULL, 4, 'Abdal Jabar', '2020090723', '$2y$10$MeSy4ngIbXd1W4hOUorb3eZXec99VoJUClghdMbiFk.2IWDG7/kpe', 'admin', '2023-07-08 08:04:19'),
(15, 11, NULL, 'Jabar', '1010280623', '$2y$10$cKRWbBfuUKuig9DYAF08kuRinPuewpKVyhCUCO2pDsj5xRKLeKbai', 'siswa', '2023-07-08 08:10:00'),
(16, 12, NULL, 'Risa', '1010290623', '$2y$10$YaomRcIIJudQNFJBYIwW3eFh5Gb39UCY8Iu8xqJeceyOFhzCut1VW', 'siswa', '2023-07-08 08:10:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biaya_semester`
--
ALTER TABLE `biaya_semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indexes for table `tagihan_spp`
--
ALTER TABLE `tagihan_spp`
  ADD PRIMARY KEY (`id_spp`),
  ADD KEY `fk_users` (`id_users`),
  ADD KEY `fk_spp_siswa` (`id_siswa`),
  ADD KEY `fk_spp_admin` (`id_admin`),
  ADD KEY `fk_spp` (`id_semester`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD PRIMARY KEY (`kelas`);

--
-- Indexes for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `fk_kelas` (`kelas`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_users`),
  ADD KEY `fk_siswa` (`id_siswa`),
  ADD KEY `fk_admin` (`id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biaya_semester`
--
ALTER TABLE `biaya_semester`
  MODIFY `id_semester` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tagihan_spp`
--
ALTER TABLE `tagihan_spp`
  MODIFY `id_spp` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tagihan_spp`
--
ALTER TABLE `tagihan_spp`
  ADD CONSTRAINT `fk_spp` FOREIGN KEY (`id_semester`) REFERENCES `biaya_semester` (`id_semester`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_spp_admin` FOREIGN KEY (`id_admin`) REFERENCES `tbl_admin` (`id_admin`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_spp_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `tbl_siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`id_users`) REFERENCES `tbl_users` (`id_users`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD CONSTRAINT `fk_kelas` FOREIGN KEY (`kelas`) REFERENCES `tbl_kelas` (`kelas`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `fk_admin` FOREIGN KEY (`id_admin`) REFERENCES `tbl_admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `tbl_siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
