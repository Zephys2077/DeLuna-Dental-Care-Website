-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 04:37 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_deluna`
--

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `No` int(11) NOT NULL,
  `jenis_layanan` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `waktu_pengerjaan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`No`, `jenis_layanan`, `harga`, `waktu_pengerjaan`) VALUES
(2, 'Scalling', '150000.00', '1 Jam'),
(3, 'Kawat gigi (orthodonti)', '1500000.00', '1 Jam'),
(4, 'Veener', '350000.00', '1 Jam'),
(5, 'Pemutihan gigi (bleaching)', '700000.00', '1 Jam'),
(7, 'Penambalan gigi', '100000.00', '1 jam'),
(8, 'Gigi palsu lepasan', '700000.00', '1 Jam'),
(9, 'Gigi palsu permanen', '1200000.00', '1 Jam'),
(10, 'Penambalan gigi (belakang)', '150000.00', '1 Jam'),
(11, 'Penambalan gigi (depan)', '200000.00', '1 Jam'),
(12, 'Pencabutan gigi (susu)', '130000.00', '1 Jam'),
(13, 'Pencabutan gigi (permanen)', '180000.00', '1 Jam'),
(15, 'Perawatan Cegah Gigi Berlubang', '100000.00', '1 Jam');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `expired` date NOT NULL,
  `harga` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `deskripsi`, `stok`, `expired`, `harga`) VALUES
(7, 'paracetamol', 'Aman untuk anak-anak dan dewasa, pereda nyeri ringan', 12, '2029-10-30', '20000.00'),
(8, 'Ibuprofen', 'Antiinflamasi dan pereda nyeri. Cocok untuk nyeri sedang', 299, '2029-10-23', '10000.00'),
(9, 'Amoxicillin', 'Antibiotik (Jika Ada Infeksi Bakteri)', 100, '2029-10-16', '20000.00'),
(10, 'Metronidazole', 'Untuk infeksi anaerob seperti abses gusi', 100, '2029-11-29', '20000.00'),
(11, 'Chlorhexidine Gluconate 0.12%', 'Antiseptik kuat, diresepkan untuk radang gusi dan infeksi', 98, '2029-11-07', '20000.00');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `No` int(11) NOT NULL,
  `id_pasien` varchar(10) NOT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tempat_tgl_lahir` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`No`, `id_pasien`, `nama_pasien`, `no_hp`, `alamat`, `tempat_tgl_lahir`) VALUES
(5, 'D016', 'Perdi', '087844513170', 'tirtajaya', 'karawang, 21-05-2025'),
(6, 'D017', 'Ginar Tri', '0812836483674', 'Kw8', 'karawang, 13-05-2025'),
(7, 'D018', 'Fikri P', '0812836483674', 'Dengklok', 'karawang, 14-05-2025'),
(16, 'P174637062', 'aully', '087844513170', 'krw', 'karawang, 27-05-2025'),
(38, 'D56', 'Greesela', '089625628401', 'perumahan bogor baru', 'Bogor, 16-01-2005'),
(39, 'D18', 'ginartri', '082211836567', 'kw8', 'jakarta, 01 May 2025'),
(65, 'D5440', 'Perdizx', '085810592167', 'bogor', 'karawanf, 13-05-2025'),
(66, 'D1933', 'ryuuuji', '0822118836567', 'bogor', 'karawanf, 05-05-2025'),
(67, 'D80', 'Pa Taufik', '087852490591', 'karawang', 'karawang, 08 February 2012'),
(69, 'D5176', 'nivia', '081298119743', 'cipucuk', 'krw, 25-02-2005'),
(70, 'D32', 'rendi', '0889512345', 'karawang', 'karwang, 24 May 2025'),
(71, 'D84', 'rendi', '0812345678', 'karawang', 'karawang, 24 May 2025');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `id` int(11) NOT NULL,
  `id_pasien` varchar(20) DEFAULT NULL,
  `id_layanan` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `keluhan` text DEFAULT NULL,
  `diagnosa` text DEFAULT NULL,
  `tindakan` text DEFAULT NULL,
  `obat` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rekam_medis`
--

INSERT INTO `rekam_medis` (`id`, `id_pasien`, `id_layanan`, `tanggal`, `keluhan`, `diagnosa`, `tindakan`, `obat`, `keterangan`) VALUES
(20, 'P174637062', 4, '2025-05-29 09:32:00', 'tes', '-', 'tidak', 'Chlorhexidine Gluconate 0.12%', '-'),
(21, 'D56', 2, '2025-05-12 09:00:00', 'karang ', NULL, NULL, NULL, NULL),
(22, 'D56', 7, '2025-05-07 09:00:00', 'nn', '-', '-', 'Amoxicillin, Ibuprofen', '-'),
(24, 'D80', 7, '2025-05-21 11:32:00', '-', 'gigi bolong', 'penambalan', 'Chlorhexidine Gluconate 0.12%, Metronidazole', '-'),
(25, 'D5176', 7, '2025-05-26 09:00:00', 'gigi depan kropos', '', '', 'Chlorhexidine Gluconate 0.12%', ''),
(26, 'D18', 4, '2025-05-28 11:19:00', 'gigi gugu', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservasi`
--

CREATE TABLE `reservasi` (
  `No` int(11) NOT NULL,
  `tgl_jam` datetime NOT NULL,
  `id_pasien` varchar(10) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `keluhan` text DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservasi`
--

INSERT INTO `reservasi` (`No`, `tgl_jam`, `id_pasien`, `id_layanan`, `keluhan`, `harga`, `status`) VALUES
(58, '2025-05-29 09:32:00', 'P174637062', 4, 'yy', '100000.00', 'Selesai'),
(70, '2025-05-12 09:00:00', 'D56', 2, 'karang ', '150000.00', 'Selesai'),
(71, '2025-05-07 09:00:00', 'D56', 7, 'nn', '100000.00', 'Selesai'),
(72, '2025-05-14 17:40:00', 'D18', 8, 'gaada', '700000.00', 'Pending'),
(74, '2025-05-21 09:48:00', 'D18', 9, '-', '1200000.00', 'Pending'),
(75, '2025-05-16 00:31:00', 'D18', 10, 'yaaaa', '250000.00', 'Pending'),
(76, '2025-05-21 11:32:00', 'D80', 7, '-', '100000.00', 'Selesai'),
(77, '2025-05-21 18:01:00', 'D017', 2, '-', '500000.00', 'Pending'),
(78, '2025-05-30 18:08:00', 'D018', 12, 'ok', '280000.00', 'Pending'),
(79, '2025-05-26 09:00:00', 'D5176', 7, 'gigi depan kropos', '100000.00', 'Selesai'),
(80, '2025-05-28 11:19:00', 'D18', 4, 'gigi gugu', '350000.00', 'Selesai'),
(81, '2025-05-27 18:30:00', 'D18', 3, 'QWERTY', '1500000.00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `No` int(11) NOT NULL,
  `id_user` varchar(10) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`No`, `id_user`, `nama_lengkap`, `username`, `password`) VALUES
(2, 'USR002', 'Perdi Pratama', 'perdi', '$2y$10$MpG4cDgj.J2tXpo8ft2jIOAwZZf/AB4E5Pa11770savVj48XYk6e6'),
(4, 'USR003', 'Putri Risma Dewi', 'admin', '$2y$10$ppEGRTaHq2UrfZK7Oy1k8e4EAM71QCyJmlKHPA1oqtdF5DI6rcTYe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`No`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`No`),
  ADD UNIQUE KEY `id_pasien` (`id_pasien`);

--
-- Indexes for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_layanan` (`id_layanan`);

--
-- Indexes for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`No`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_layanan` (`id_layanan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`No`),
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD CONSTRAINT `rekam_medis_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`),
  ADD CONSTRAINT `rekam_medis_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`No`);

--
-- Constraints for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD CONSTRAINT `reservasi_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`),
  ADD CONSTRAINT `reservasi_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`No`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
