-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Des 2022 pada 04.59
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_atokoku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` int(11) NOT NULL,
  `tanggal_buat` datetime DEFAULT current_timestamp(),
  `nama_barang` varchar(100) DEFAULT NULL,
  `id_created` int(11) DEFAULT NULL,
  `harga` int(12) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `warning` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `tanggal_buat`, `nama_barang`, `id_created`, `harga`, `stock`, `warning`) VALUES
(1, '2022-01-25 15:00:03', 'Garuda', 1, 10, 10, 10),
(2, '2022-01-25 16:06:26', 'Kacang', 1, 10000, 50, 10),
(4, '2022-03-03 10:36:28', 'Kancing', 1, 1000, 100, 10),
(5, '2022-03-14 15:38:28', 'kucir', 1, 15000, 500, 20),
(6, '2022-03-14 16:02:12', 'ucup', 1, 61994, 846, 36),
(8, '2022-03-14 16:10:08', 'Odading', 1, 65000, 6000, 600);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_notifikasi`
--

CREATE TABLE `tbl_notifikasi` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `judul` varchar(30) DEFAULT NULL,
  `isi` varchar(255) DEFAULT NULL,
  `tujuan` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `jenis_created` tinyint(4) DEFAULT NULL,
  `approve` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_notifikasi`
--

INSERT INTO `tbl_notifikasi` (`id`, `tanggal`, `judul`, `isi`, `tujuan`, `status`, `created`, `jenis_created`, `approve`) VALUES
(9, '2022-03-17 08:58:28', 'oke', 'jsjhdhd', 2, 1, 1, 1, 0),
(10, '2022-03-17 11:57:29', 'tulung', 'bantu', 2, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `judul_transaksi` varchar(250) DEFAULT NULL,
  `tanggal_transaksi` datetime DEFAULT current_timestamp(),
  `total_transaksi` int(12) DEFAULT NULL,
  `id_created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `judul_transaksi`, `tanggal_transaksi`, `total_transaksi`, `id_created`) VALUES
(1, 'warung', '2022-01-25 14:58:58', 200000, 1),
(10, 'Warung Lampung', '2022-01-25 20:02:14', 0, 1),
(11, 'oncom', '2022-03-23 01:23:50', 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_transaksi_barang`
--

CREATE TABLE `tbl_transaksi_barang` (
  `id_transaksi_barang` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `harga_barang` int(12) DEFAULT NULL,
  `qty` int(12) DEFAULT NULL,
  `total` int(12) DEFAULT NULL,
  `tanggal_transaksi_barang` datetime DEFAULT current_timestamp(),
  `id_created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_transaksi_barang`
--

INSERT INTO `tbl_transaksi_barang` (`id_transaksi_barang`, `id_transaksi`, `id_barang`, `nama_barang`, `harga_barang`, `qty`, `total`, `tanggal_transaksi_barang`, `id_created`) VALUES
(2, 1, 1, 'Garuda', 10000, 20, 200000, '2022-01-25 15:00:52', 1),
(5, NULL, 1, 'Garuda', 10000, 76, 760000, '2022-01-25 20:00:17', 1),
(6, NULL, 3, 'Kucing', 20000, 20, 400000, '2022-01-25 20:01:11', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `tanggal_buat` datetime DEFAULT current_timestamp(),
  `jenis` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `nama_user`, `tanggal_buat`, `jenis`) VALUES
(1, 'admin', 'admin', 'Administrator', '2022-01-25 14:57:16', 1),
(4, 'lagi', 'lagi', 'Staff Gudang Lagi', '2022-01-25 20:04:59', 2),
(6, 'Widya', '1234', 'Widya dungs', '2022-03-17 11:59:34', 1),
(7, 'lupa', 'lupa', 'lupa', '2022-07-22 14:10:58', 1),
(8, 'asd', 'asd', 'asd', '2022-09-15 08:57:04', 3),
(9, 'kasir2', 'kasir2', 'Kasir 2', '2022-10-14 18:17:23', 3),
(10, 'gudang2', 'gudang2', 'Gudang2', '2022-10-14 18:21:01', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tbl_notifikasi`
--
ALTER TABLE `tbl_notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `tbl_transaksi_barang`
--
ALTER TABLE `tbl_transaksi_barang`
  ADD PRIMARY KEY (`id_transaksi_barang`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_notifikasi`
--
ALTER TABLE `tbl_notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tbl_transaksi_barang`
--
ALTER TABLE `tbl_transaksi_barang`
  MODIFY `id_transaksi_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
