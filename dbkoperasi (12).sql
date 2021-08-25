-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Nov 2020 pada 13.58
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbkoperasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventaris`
--

CREATE TABLE `inventaris` (
  `id_inventaris` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kondisi` varchar(100) NOT NULL,
  `Keterangan` varchar(100) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `id_jenis` int(10) NOT NULL,
  `tanggal_register` varchar(100) NOT NULL,
  `id_ruang` int(10) NOT NULL,
  `kode_inventaris` varchar(10) NOT NULL,
  `id_petugas` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inventaris`
--

INSERT INTO `inventaris` (`id_inventaris`, `nama`, `kondisi`, `Keterangan`, `jumlah`, `id_jenis`, `tanggal_register`, `id_ruang`, `kode_inventaris`, `id_petugas`) VALUES
(2, 'Laptop', 'Baru', 'ASUS ER O GEH', 750, 1, '01-januari-2015', 1, '00001', 1),
(3, 'PC GAMING', 'Baru', 'MAHAL', 85, 1, '2020-11-26 23:59:21', 1, '00002', 1),
(4, 'PS 5', 'Baru', 'BELOM RILIS NGAB!!!', 80, 1, '2020-11-27 00:10:45', 1, '00003', 1),
(6, 'Alpat', 'Bekas', 'dimana ada rokok disitu ada alpat', 10, 1, '2020-11-27 14:24:56', 1, '00004', 1),
(8, 'GAME Assassin Creed Valhalla', 'baru', 'GAMENYA MAHAL BET TAPI GRAPIK NYA GA NGOTAK BAGUS BENER', 10, 1, '2020-11-27 19:56:03', 1, '00005', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(10) NOT NULL,
  `nama_jenis` varchar(100) NOT NULL,
  `kode_jenis` int(10) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`, `kode_jenis`, `keterangan`) VALUES
(1, 'Elektronik', 1, 'Barang Elektronik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id_level` int(10) NOT NULL,
  `nama_level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(1, 'admin'),
(2, 'operator'),
(3, 'member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(10) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `nip` varchar(10) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `nip`, `alamat`) VALUES
(1, 'Alpat', '00001', 'Alam Barzah'),
(2, 'Kitahara Yori', '00002', 'JAPAN'),
(3, 'Maulida', '00003', 'MANA SAYA TAU'),
(4, 'juna', '00004', 'Dimana ada senja disitu ada juna'),
(5, 'Gaple', '00005', 'Dimana ada rokok disitu ada gaple');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(10) NOT NULL,
  `tanggal_pinjam` varchar(100) NOT NULL,
  `tanggal_kembali` varchar(100) NOT NULL,
  `status_peminjaman` varchar(100) NOT NULL,
  `id_pegawai` int(10) NOT NULL,
  `id_inventaris` int(10) NOT NULL,
  `jumlah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `tanggal_pinjam`, `tanggal_kembali`, `status_peminjaman`, `id_pegawai`, `id_inventaris`, `jumlah`) VALUES
(10, '20-juni-2022', '', 'Belum Dikembalikan', 3, 3, '15'),
(11, '24-januari-2030', '', 'BElum Dikembalikan', 4, 4, '20'),
(12, '23-mei-2034', '', 'Belum Dikembalikan', 2, 2, '250');

--
-- Trigger `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `delete_jumlah` AFTER DELETE ON `peminjaman` FOR EACH ROW BEGIN
  UPDATE inventaris SET jumlah=jumlah+OLD.jumlah
  WHERE id_inventaris = OLD.id_inventaris;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_jumlah` AFTER INSERT ON `peminjaman` FOR EACH ROW BEGIN
  UPDATE inventaris SET jumlah=jumlah-NEW.jumlah
  WHERE id_inventaris = NEW.id_inventaris;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `id_level` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `username`, `password`, `nama_petugas`, `id_level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Natsu', 1),
(2, 'operator', '4b583376b2767b923c3e1da60d10de59', 'Tanjiro', 2),
(3, 'member', 'aa08769cdcb26674c6706093503ff0a3', 'Nezuko', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruang`
--

CREATE TABLE `ruang` (
  `id_ruang` int(10) NOT NULL,
  `nama_ruang` varchar(100) NOT NULL,
  `kode_ruang` int(10) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ruang`
--

INSERT INTO `ruang` (`id_ruang`, `nama_ruang`, `kode_ruang`, `keterangan`) VALUES
(1, 'isekai', 1, 'Ruangan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`id_inventaris`),
  ADD KEY `id_ruang` (`id_ruang`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_inventaris` (`id_inventaris`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD KEY `id_level` (`id_level`);

--
-- Indeks untuk tabel `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id_ruang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `id_inventaris` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id_ruang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `inventaris`
--
ALTER TABLE `inventaris`
  ADD CONSTRAINT `inventaris_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventaris_ibfk_2` FOREIGN KEY (`id_ruang`) REFERENCES `ruang` (`id_ruang`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventaris_ibfk_3` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_inventaris`) REFERENCES `inventaris` (`id_inventaris`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
