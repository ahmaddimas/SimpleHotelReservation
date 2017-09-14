-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 14 Sep 2017 pada 12.17
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--
CREATE DATABASE IF NOT EXISTS `hotel` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hotel`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_booking`
--

CREATE TABLE `tb_booking` (
  `id_booking` int(11) NOT NULL,
  `kode_booking` varchar(9) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `pelanggan` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telepon` int(12) NOT NULL,
  `payment` int(11) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `confirm` int(1) NOT NULL DEFAULT '0',
  `done` int(1) NOT NULL DEFAULT '0',
  `bukti` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_booking`
--

INSERT INTO `tb_booking` (`id_booking`, `kode_booking`, `id_kamar`, `pelanggan`, `email`, `telepon`, `payment`, `checkin`, `checkout`, `confirm`, `done`, `bukti`) VALUES
(1, '1709139', 1, 'Ahmad', 'ahmad@ahmad.com', 812323, 0, '2017-09-12', '2017-09-13', 0, 0, ''),
(1709158, '170914140', 3, 'Aqshal', 'nabilaql98@gmail.com', 2147483647, 800000, '2017-09-19', '2017-09-20', 0, 0, ''),
(1709159, '170914140', 3, 'Aqshal', 'nabilaql98@gmail.com', 2147483647, 800000, '2017-09-19', '2017-09-20', 0, 0, ''),
(1709160, '170914141', 2, 'Aqshal', 'nabilaqonitah@gmail.com', 4453453, 700000, '2017-09-14', '2017-09-15', 1, 0, 'images/confirmation/hotel (1).jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_fasilitas`
--

CREATE TABLE `tb_fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `fasilitas` varchar(100) NOT NULL,
  `icon` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_fasilitas`
--

INSERT INTO `tb_fasilitas` (`id_fasilitas`, `fasilitas`, `icon`) VALUES
(1, 'TV', 'fa-tv'),
(2, 'WiFi', 'fa-wifi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_fasilitas_relation`
--

CREATE TABLE `tb_fasilitas_relation` (
  `id` int(11) NOT NULL,
  `tipe_kamar` int(11) NOT NULL,
  `id_fasilitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_fasilitas_relation`
--

INSERT INTO `tb_fasilitas_relation` (`id`, `tipe_kamar`, `id_fasilitas`) VALUES
(1, 2, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kamar`
--

CREATE TABLE `tb_kamar` (
  `id_kamar` int(11) NOT NULL,
  `tipe_kamar` int(11) NOT NULL,
  `paket_kamar` varchar(150) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `ukuran` int(11) NOT NULL,
  `image1` text NOT NULL,
  `image2` text NOT NULL,
  `image3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kamar`
--

INSERT INTO `tb_kamar` (`id_kamar`, `tipe_kamar`, `paket_kamar`, `kapasitas`, `harga`, `ukuran`, `image1`, `image2`, `image3`) VALUES
(1, 1, 'Deluxe', 3, 700000, 0, 'images/img26.jpg', 'images/img26.jpg', 'images/img26.jpg'),
(2, 2, 'Superior', 2, 500000, 0, 'images/img25.jpg', 'images/img25.jpg', 'images/img26.jpg'),
(3, 2, 'Superior', 2, 500000, 0, 'images/img25.jpg', 'images/img25.jpg', 'images/img26.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_promo`
--

CREATE TABLE `tb_promo` (
  `id_promo` int(11) NOT NULL,
  `kode_promo` varchar(6) NOT NULL,
  `potongan_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_promo`
--

INSERT INTO `tb_promo` (`id_promo`, `kode_promo`, `potongan_harga`) VALUES
(1, 'xRt56a', 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_review`
--

CREATE TABLE `tb_review` (
  `id_review` int(11) NOT NULL,
  `tipe_kamar` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` int(11) NOT NULL,
  `email` int(11) NOT NULL,
  `nama` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_booking`
--
ALTER TABLE `tb_booking`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indexes for table `tb_fasilitas`
--
ALTER TABLE `tb_fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indexes for table `tb_fasilitas_relation`
--
ALTER TABLE `tb_fasilitas_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kamar`
--
ALTER TABLE `tb_kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `tb_promo`
--
ALTER TABLE `tb_promo`
  ADD PRIMARY KEY (`id_promo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_booking`
--
ALTER TABLE `tb_booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1709161;
--
-- AUTO_INCREMENT for table `tb_fasilitas`
--
ALTER TABLE `tb_fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_fasilitas_relation`
--
ALTER TABLE `tb_fasilitas_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_kamar`
--
ALTER TABLE `tb_kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_promo`
--
ALTER TABLE `tb_promo`
  MODIFY `id_promo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
