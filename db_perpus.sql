-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2023 at 11:25 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_admin`
--

CREATE TABLE `t_admin` (
  `id_admin` int(11) NOT NULL,
  `nm_admin` varchar(35) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_admin`
--

INSERT INTO `t_admin` (`id_admin`, `nm_admin`, `username`, `password`) VALUES
(1, 'Muhammad Ridho Sapura', 'ridho', '$2y$10$Iut7XNKPw13P6BGO4HBX4.ER4AW3gdxjywUcIUb3aPbm0vc6YYwA2');

-- --------------------------------------------------------

--
-- Table structure for table `t_anggota`
--

CREATE TABLE `t_anggota` (
  `id_anggota` int(11) NOT NULL,
  `nm_anggota` varchar(35) NOT NULL,
  `jenis_kelamin` varchar(35) NOT NULL,
  `alamat_anggota` varchar(35) NOT NULL,
  `status` varchar(35) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_anggota`
--

INSERT INTO `t_anggota` (`id_anggota`, `nm_anggota`, `jenis_kelamin`, `alamat_anggota`, `status`, `gambar`) VALUES
(89, 'Siska Amelia', 'perempuan', 'Amuntai', 'Mahasiswa/Pelajar', '../img/UploadedImg/64d319fe49368.jpg'),
(91, 'Ririn', 'perempuan', 'Banjarmasin', 'Mahasiswa/Pelajar', '../img/UploadedImg/64d33c864b8ca.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `t_buku`
--

CREATE TABLE `t_buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `tahun_terbit` date NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `harga_buku` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_buku`
--

INSERT INTO `t_buku` (`id_buku`, `judul`, `penulis`, `tahun_terbit`, `penerbit`, `harga_buku`) VALUES
(20, 'Belajar Excel 2015', 'Firman', '2017-02-18', 'PT . SumInformatika', 80000),
(21, 'Belajar Pemograman Python ', 'Rifaldi', '2019-02-09', 'PT. SumberIndah', 120000),
(22, 'Tutorial Adobe Photoshop Pemula', 'Kiki', '2022-05-19', 'Riyandi Z', 70000),
(23, 'Belajar Web Pemula', 'Ridho', '2022-09-18', 'PT . Sukma Jaya Indah', 110000),
(24, 'Kamus Semua Bahasa', 'Drs. Sanjoyo S.Kom M.Pd', '2009-03-18', 'PT. Global Sinardo', 1150000),
(25, 'IPS', 'Riyanto S.Sos', '2016-02-19', 'PT. Arunia', 55000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_admin`
--
ALTER TABLE `t_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `t_anggota`
--
ALTER TABLE `t_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `t_buku`
--
ALTER TABLE `t_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_admin`
--
ALTER TABLE `t_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_anggota`
--
ALTER TABLE `t_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `t_buku`
--
ALTER TABLE `t_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
