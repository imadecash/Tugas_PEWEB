-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2025 at 01:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_umkm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(8, 'Kuliner / Makanan & Minuman'),
(9, 'Fashion & Aksesoris'),
(10, 'Kerajinan / Craft'),
(11, 'Jasa & Layanan'),
(12, 'Pertanian & Peternakan'),
(13, 'Perdagangan / Retail'),
(14, 'Teknologi & Digital'),
(15, 'Kecantikan & Perawatan');

-- --------------------------------------------------------

--
-- Table structure for table `umkm`
--

CREATE TABLE `umkm` (
  `id_umkm` int(11) NOT NULL,
  `nama_umkm` varchar(100) DEFAULT NULL,
  `pemilik` varchar(100) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kontak` varchar(50) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `link_maps` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `umkm`
--

INSERT INTO `umkm` (`id_umkm`, `nama_umkm`, `pemilik`, `id_kategori`, `alamat`, `kontak`, `deskripsi`, `foto`, `link_maps`) VALUES
(7, 'Dapur Bunda Rina', 'Rina Marlina', 8, 'Jl. Kenanga No. 12, Kota Gorontalo', '0812-3344-5577', 'Menyediakan aneka makanan rumahan, catering harian, dan pesanan acara.', 'download (1).jpeg', 'https://maps.app.goo.gl/Ayt4aRi9gSgPzrDw9'),
(8, 'FreshWell Juice Bar', 'Dion Arfan', 8, 'Jl. Sudirman No. 88, Makassar', '0853-9931-2210', 'Menjual jus buah segar, smoothies, dan healthy bowl.', 'download (2).jpeg', 'https://maps.app.goo.gl/Ayt4aRi9gSgPzrDw9'),
(9, 'Aurora Batik Craft', 'Wati Suryani', 9, 'Jl. Mawar No. 4, Pekalongan', '0821-7750-3321', 'Produksi batik tulis modern dan pakaian batik ready-to-wear.', 'download (3).jpeg', 'https://maps.app.goo.gl/Ayt4aRi9gSgPzrDw9'),
(10, 'StepGo Footwear', 'Andri Pratama', 9, 'Jl. Cenderawasih No. 2, Bandung', '0819-5567-9945', 'Sepatu handmade berbahan kulit sintetis dan kain tenun.', 'download (4).jpeg', 'https://maps.app.goo.gl/Ayt4aRi9gSgPzrDw9'),
(11, 'Karawo Art House', 'Nisa Daud', 10, 'Jl. Raja Eyato No. 16, Kota Gorontalo', '0812-6655-1022', 'Produksi kerajinan bordir Karawo berupa pakaian, tas, dan souvenir.', 'download (5).jpeg', 'https://maps.app.goo.gl/Ayt4aRi9gSgPzrDw9'),
(12, 'Kayu Indah Craft', 'Rudi Hartono', 10, 'Jl. Palem No. 9, Kendari', '0822-9901-4433', 'Kerajinan ukiran kayu, miniatur, dan dekorasi rumah.', 'download (6).jpeg', 'https://maps.app.goo.gl/Ayt4aRi9gSgPzrDw9');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `umkm`
--
ALTER TABLE `umkm`
  ADD PRIMARY KEY (`id_umkm`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `umkm`
--
ALTER TABLE `umkm`
  MODIFY `id_umkm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `umkm`
--
ALTER TABLE `umkm`
  ADD CONSTRAINT `umkm_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` int(11) NOT NULL AUTO_INCREMENT,
  `id_umkm` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `komentar` text NOT NULL,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_ulasan`),
  FOREIGN KEY (`id_umkm`) REFERENCES `umkm`(`id_umkm`) ON DELETE CASCADE,
  FOREIGN KEY (`id_user`) REFERENCES `users`(`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
