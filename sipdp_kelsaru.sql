-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 07, 2020 at 03:28 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipdp_kelsaru`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_admin`
--

CREATE TABLE `m_admin` (
  `id_admin` char(4) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nama_admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_admin`
--

INSERT INTO `m_admin` (`id_admin`, `username`, `password`, `nama_admin`) VALUES
('A-01', 'admin1', 'e00cf25ad42683b3df678c61f42c6bda', 'Admin 1'),
('A-02', 'admin2', 'c84258e9c39059a89ab77d846ddab909', 'Admin 2');

-- --------------------------------------------------------

--
-- Table structure for table `m_penduduk`
--

CREATE TABLE `m_penduduk` (
  `nik` bigint(16) NOT NULL,
  `id_rw` char(5) NOT NULL,
  `id_rt` char(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `no_kk` bigint(16) NOT NULL,
  `nama_penduduk` varchar(50) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `kelurahan` varchar(30) NOT NULL,
  `kecamatan` varchar(30) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `provinsi` varchar(30) NOT NULL,
  `pekerjaan` enum('Belum/Tidak Bekerja','Mahasiswa/Pelajar','Mengurus Rumah Tangga','Pegawai Negeri Sipil','Karyawan Swasta','Wiraswasta') NOT NULL,
  `pendidikan` enum('SD/Sederajat','SMP/Sederajat','SLTA/Sederajat','D1','D2','D3','S1','S2') NOT NULL,
  `agama` enum('Islam','Protestan','Katolik','Hindu','Budha','Konghucu') NOT NULL,
  `status_kawin` enum('Belum Kawin','Sudah Kawin') NOT NULL,
  `status_penduduk` enum('Tetap','Pendatang','Pindah','Meninggal') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_penduduk`
--

INSERT INTO `m_penduduk` (`nik`, `id_rw`, `id_rt`, `username`, `password`, `no_kk`, `nama_penduduk`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `provinsi`, `pekerjaan`, `pendidikan`, `agama`, `status_kawin`, `status_penduduk`) VALUES
(1234567890123410, 'RW-01', 'RT-02', 'penduduk5', '9f09caf4edc633337e54cc2981861f90', 1234567890123410, 'Toni Sucipto', 'Jakarta', '1997-06-10', 'Laki-laki', 'Jl. Mawar Raya No. 34', 'Sawah Baru', 'Ciputat', 'Tangerang Selatan', 'Banten', 'Karyawan Swasta', 'D3', 'Hindu', 'Belum Kawin', 'Tetap'),
(1234567890123411, 'RW-01', 'RT-02', 'penduduk6', 'f6288797e2c592dbcb02bd8a711316d0', 1234567890123411, 'Joko Priyono', 'Tangerang', '1990-10-16', 'Laki-laki', 'Jl. Pahlawan Raya No. 22', 'Sawah Baru', 'Ciputat', 'Tangerang Selatan', 'Banten', 'Pegawai Negeri Sipil', 'S1', 'Islam', 'Sudah Kawin', 'Tetap'),
(1234567890123412, 'RW-01', 'RT-02', 'penduduk7', 'e6e14ad0d25dcc41b82e0cc7bd969005', 1234567890123412, 'Budi Raharjo Setiawan', 'Bandung', '2020-08-04', 'Laki-laki', 'Jl. Mekar Raya No. 11', 'Sawah Baru', 'Ciputat', 'Tangerang Selatan', 'Banten', 'Pegawai Negeri Sipil', 'S1', 'Islam', 'Belum Kawin', 'Meninggal'),
(1234567890123456, 'RW-01', 'RT-01', 'penduduk1', '65a0c9e699ab103cec217d62ed857d7c', 1234567890123456, 'Yuni', 'Jakarta', '2001-02-16', 'Perempuan', 'Jl. Pahlawan Raya No. 21', 'Sawah Baru', 'Ciputat', 'Tangerang Selatan', 'Banten', 'Mengurus Rumah Tangga', 'SLTA/Sederajat', 'Islam', 'Belum Kawin', 'Tetap'),
(1234567890123457, 'RW-01', 'RT-01', 'penduduk2', '202cb962ac59075b964b07152d234b70', 2222222222222, 'Dina Astuti', 'Bandung', '1998-06-08', 'Perempuan', 'Jl. Merdeka No. 11', 'Sawah Baru', 'Ciputat', 'Tangerang Selatan', 'Banten', 'Pegawai Negeri Sipil', 'S1', 'Islam', 'Belum Kawin', 'Tetap'),
(1234567890123458, 'RW-01', 'RT-01', 'penduduk3', '4c1d3007078f1d7ebcd2cacc166abbd4', 1234567890123458, 'Bambang', 'Bogor', '1996-06-16', 'Laki-laki', 'Kp. Mawar No. 21', 'Sawah Baru', 'Ciputat', 'Tangerang Selatan', 'Banten', 'Karyawan Swasta', 'SLTA/Sederajat', 'Islam', 'Belum Kawin', 'Tetap'),
(1234567890123459, 'RW-01', 'RT-01', 'penduduk4', '52e27f205933acdd9fd08f8372a62ba0', 1234567890123459, 'Meli Guslow', 'Bekasi', '1996-06-04', 'Perempuan', 'Jl. Melati Raya No. 21', 'Sawah Baru', 'Ciputat', 'Tangerang Selatan', 'Banten', 'Mahasiswa/Pelajar', 'SLTA/Sederajat', 'Islam', 'Belum Kawin', 'Tetap'),
(3674021625152615, 'RW-01', 'RT-03', 'penduduk8', 'b1aab3811e11268e50b5d8853dccb631', 3674021625152615, 'Beni Widodo', 'Jakarta', '1995-02-04', 'Laki-laki', 'Villa Mutiara', 'Sawah Baru', 'Ciputat', 'Tangerang Selatan', 'Banten', 'Karyawan Swasta', 'D3', 'Islam', 'Belum Kawin', 'Pindah'),
(3674041112950064, 'RW-01', 'RT-05', 'penduduk12', 'ae269ecbad05bbefefe7551da92a7343', 3674041112950064, 'Christopher Imannuel', 'Jakarta', '1995-12-11', 'Laki-laki', 'Jl. Merpati No. 24', 'Sawah Baru', 'Ciputat', 'Tangerang Selatan', 'Banten', 'Karyawan Swasta', 'S1', 'Katolik', 'Belum Kawin', 'Tetap'),
(3674041311950045, 'RW-01', 'RT-05', 'penduduk13', '6bb450f43eecbe9c6f354bbed38d88fb', 3674041311950045, 'Ahmad Sudirja', 'Tangerang', '1995-11-13', 'Laki-laki', 'Jl. Merpati No. 01', 'Sawah Baru', 'Ciputat', 'Tangerang Selatan', 'Banten', 'Karyawan Swasta', 'S1', 'Islam', 'Belum Kawin', NULL),
(3674044205970002, 'RW-01', 'RT-04', 'penduduk10', 'f416aa832695382d81bc906ec8f10187', 3674044205970002, 'Tini Astuti', 'Tangerang', '1997-05-02', 'Perempuan', 'Jl. Merpati No. 21', 'Sawah Baru', 'Ciputat', 'Tangerang Selatan', 'Banten', 'Mengurus Rumah Tangga', 'SLTA/Sederajat', 'Islam', 'Sudah Kawin', NULL),
(3674044302970091, 'RW-01', 'RT-04', 'penduduk11', '7dfcfb2a38a01351425a410f2dec1987', 3674044302970091, 'Reni Angraini', 'Tangerang', '1997-02-03', 'Perempuan', 'Jl. Merpati No. 22', 'Sawah Baru', 'Ciputat', 'Tangerang Selatan', 'Banten', 'Karyawan Swasta', 'SLTA/Sederajat', 'Islam', 'Belum Kawin', NULL),
(3674044908980013, 'RW-01', 'RT-03', 'penduduk9', '30e8c993f922f4a57e3361401bd0f44f', 3674044908980013, 'Sifa Yohana', 'Tangerang', '1998-08-09', 'Perempuan', 'Villa Mutiara', 'Sawah Baru', 'Ciputat', 'Tangerang Selatan', 'Banten', 'Mahasiswa/Pelajar', 'SLTA/Sederajat', 'Islam', 'Belum Kawin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_rt`
--

CREATE TABLE `m_rt` (
  `id_rt` char(5) NOT NULL,
  `id_rw` char(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `no_rt` int(3) NOT NULL,
  `nama_rt` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_rt`
--

INSERT INTO `m_rt` (`id_rt`, `id_rw`, `username`, `password`, `no_rt`, `nama_rt`) VALUES
('RT-01', 'RW-01', 'rt1rw1', '6bcfd28d644bef21f37dcea4bee74536', 1, 'RT 1 RW 1'),
('RT-02', 'RW-01', 'rt2rw1', '722a829a454d2662b208bcc4c4633401', 2, 'RT 2 RW 1'),
('RT-03', 'RW-01', 'rt3rw1', '57dad6b5850a492d8f2f75c34be367b9', 3, 'RT 3 RW 1'),
('RT-04', 'RW-01', 'rt4rw1', 'cedfa9b210253e64c0d59589181c20c1', 4, 'RT 4 RW 1'),
('RT-05', 'RW-01', 'rt5rw1', '659ab04bfc64e41154048808ccbb8052', 5, 'RT 5 RW 1'),
('RT-06', 'RW-02', 'rt1rw2', '990ab85a6fc31fff82b8aaf2490af64a', 1, 'RT 1 RW 2'),
('RT-07', 'RW-02', 'rt2rw2', '6860df9fb35674bfce801d5d2847af12', 2, 'RT 2 RW 2'),
('RT-08', 'RW-02', 'rt3rw2', 'a92e2d1bd19f56bc3c38c0a7b37dc57d', 3, 'RT 3 RW 2'),
('RT-09', 'RW-02', 'rt4rw2', '64dc1dd532c510617d6889c0b5392c9a', 4, 'RT 4 RW 2'),
('RT-10', 'RW-02', 'rt5rw2', '0a5564b4e7451372a6d0c523b787bc36', 5, 'RT 5 RW 2'),
('RT-11', 'RW-03', 'rt1rw3', 'a6264c0185633afc54fd5810fc556c57', 1, 'RT 1 RW 3'),
('RT-12', 'RW-03', 'rt2rw3', '486d445acbdf18ec9c198c0e7fd51ef7', 2, 'RT 2 RW 3'),
('RT-13', 'RW-03', 'rt3rw3', 'a8082763c98f5a23b3a5f8cc75bbc3c2', 3, 'RT 3 RW 3'),
('RT-14', 'RW-03', 'rt4rw3', '161bf441416a2d4b591dcefb9454ecec', 4, 'RT 4 RW 3'),
('RT-15', 'RW-03', 'rt5rw3', '6b9998dad51c8ac53c13aa7b3d0de6f6', 5, 'RT 5 RW 3'),
('RT-16', 'RW-04', 'rt1rw4', 'bb8b00f9f0ec7ed72d611b1736de3725', 1, 'RT 1 RW 4'),
('RT-17', 'RW-04', 'rt2rw4', '8d196ea1d4cd2fae8c13055417d23767', 2, 'RT 2 RW 4'),
('RT-18', 'RW-04', 'rt3rw4', 'b6886cf61c2d9cf033e63d20ec644377', 3, 'RT 3 RW 4'),
('RT-19', 'RW-04', 'rt4rw4', 'fb2a542a8988c6e3a2f0b93e89ac1902', 4, 'RT 4 RW 4'),
('RT-20', 'RW-04', 'rt5rw4', '364acde907c548fe827034368188874e', 5, 'RT 5 RW 4'),
('RT-21', 'RW-05', 'rt1rw5', 'a0f9dc547da7a1f874e9346238f32dab', 1, 'RT 1 RW 5'),
('RT-22', 'RW-05', 'rt2rw5', '4ac786ce381fa65aeabec062cf52b99d', 2, 'RT 2 RW 5'),
('RT-23', 'RW-05', 'rt3rw5', 'd9a32466ff1a66939510311882b1e903', 3, 'RT 3 RW 5'),
('RT-24', 'RW-05', 'rt4rw5', '8f179ef6f2a64c6b15feefbbae8ab7cc', 4, 'RT 4 RW 5'),
('RT-25', 'RW-05', 'rt5rw5', '295c54823241684b3328192e7a599e98', 5, 'RT 5 RW 5');

-- --------------------------------------------------------

--
-- Table structure for table `m_rw`
--

CREATE TABLE `m_rw` (
  `id_rw` char(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `no_rw` int(3) NOT NULL,
  `nama_rw` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_rw`
--

INSERT INTO `m_rw` (`id_rw`, `username`, `password`, `no_rw`, `nama_rw`) VALUES
('RW-01', 'rw1', '03ee4397148131a65aa50cfe517a21ca', 1, 'RW 1'),
('RW-02', 'rw2', 'e8524d3a3d9039935ed14d6ab1c86952', 2, 'RW 2'),
('RW-03', 'rw3', '8f3fbacd2c2a9c2b83fc96425f82b3bb', 3, 'RW 3'),
('RW-04', 'rw4', 'f0c77a669054a455bd3c6359b87a0405', 4, 'RW 4'),
('RW-05', 'rw5', '1acd312117ce5a646f1e84676efe23de', 5, 'RW 5');

-- --------------------------------------------------------

--
-- Table structure for table `p_datang`
--

CREATE TABLE `p_datang` (
  `no_datang` char(10) NOT NULL,
  `nik` bigint(16) NOT NULL,
  `tgl_datang` date NOT NULL,
  `alamat_asal` text NOT NULL,
  `kelurahan_asal` varchar(30) NOT NULL,
  `kecamatan_asal` varchar(30) NOT NULL,
  `kota_asal` varchar(30) NOT NULL,
  `provinsi_asal` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_datang`
--

INSERT INTO `p_datang` (`no_datang`, `nik`, `tgl_datang`, `alamat_asal`, `kelurahan_asal`, `kecamatan_asal`, `kota_asal`, `provinsi_asal`) VALUES
('PD-0000001', 3674041311950045, '2020-03-11', 'Jl. Pondok Kacang Raya No. 12 RT. 002 RW. 004', 'Pondok Kacang Timur', 'Pondok Aren', 'Tangerang Selatan', 'Banten');

-- --------------------------------------------------------

--
-- Table structure for table `p_lahir`
--

CREATE TABLE `p_lahir` (
  `no_lahir` char(10) NOT NULL,
  `nik` bigint(16) NOT NULL,
  `nama_bayi` varchar(50) NOT NULL,
  `hari_lahir` enum('Senin','Selasa','Rabu','Kamis','Jum''at','Sabtu','Minggu') NOT NULL,
  `jam_lahir` time NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `berat_badan` decimal(3,1) NOT NULL,
  `nama_ayah` varchar(50) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `validasi_rt` enum('Sudah Validasi','Belum Validasi') NOT NULL,
  `validasi_rw` enum('Sudah Validasi','Belum Validasi') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_lahir`
--

INSERT INTO `p_lahir` (`no_lahir`, `nik`, `nama_bayi`, `hari_lahir`, `jam_lahir`, `tgl_lahir`, `tempat_lahir`, `jenis_kelamin`, `berat_badan`, `nama_ayah`, `nama_ibu`, `validasi_rt`, `validasi_rw`) VALUES
('PL-0000002', 3674041311950045, 'Muhammad Aminullah', 'Selasa', '20:30:00', '2019-12-12', 'Jakarta', 'Laki-laki', '2.5', 'Ahmad Sudirja', 'Siti Aminah', 'Sudah Validasi', 'Sudah Validasi');

-- --------------------------------------------------------

--
-- Table structure for table `p_meninggal`
--

CREATE TABLE `p_meninggal` (
  `no_meninggal` char(10) NOT NULL,
  `nik` bigint(16) NOT NULL,
  `umur` int(3) NOT NULL,
  `hari_kematian` enum('Senin','Selasa','Rabu','Kamis','Jum''at','Sabtu','Minggu') NOT NULL,
  `tgl_kematian` date NOT NULL,
  `tempat_kematian` varchar(50) NOT NULL,
  `penyebab_kematian` varchar(50) NOT NULL,
  `validasi_rt` enum('Sudah Validasi','Belum Validasi') NOT NULL,
  `validasi_rw` enum('Sudah Validasi','Belum Validasi') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_meninggal`
--

INSERT INTO `p_meninggal` (`no_meninggal`, `nik`, `umur`, `hari_kematian`, `tgl_kematian`, `tempat_kematian`, `penyebab_kematian`, `validasi_rt`, `validasi_rw`) VALUES
('PM-0000001', 1234567890123412, 34, 'Selasa', '2020-09-01', 'Jakarta', 'Kecelakaan Lalu Lintas', 'Sudah Validasi', 'Sudah Validasi');

-- --------------------------------------------------------

--
-- Table structure for table `p_pindah`
--

CREATE TABLE `p_pindah` (
  `no_pindah` char(10) NOT NULL,
  `nik` bigint(16) NOT NULL,
  `tgl_pindah` date NOT NULL,
  `alasan_pindah` varchar(50) NOT NULL,
  `validasi_rt` enum('Sudah Validasi','Belum Validasi') NOT NULL,
  `validasi_rw` enum('Sudah Validasi','Belum Validasi') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_pindah`
--

INSERT INTO `p_pindah` (`no_pindah`, `nik`, `tgl_pindah`, `alasan_pindah`, `validasi_rt`, `validasi_rw`) VALUES
('PP-0000001', 3674021625152615, '2020-09-02', 'Jauh dengan lokasi kantor', 'Sudah Validasi', 'Sudah Validasi');

-- --------------------------------------------------------

--
-- Table structure for table `p_tetap`
--

CREATE TABLE `p_tetap` (
  `no_tetap` char(10) NOT NULL,
  `nik` bigint(16) NOT NULL,
  `tgl_menetap` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_tetap`
--

INSERT INTO `p_tetap` (`no_tetap`, `nik`, `tgl_menetap`) VALUES
('PT-0000001', 1234567890123457, '2020-08-05'),
('PT-0000002', 1234567890123410, '2020-08-07'),
('PT-0000003', 1234567890123411, '2020-08-13'),
('PT-0000004', 3674041112950064, '2020-09-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_admin`
--
ALTER TABLE `m_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `m_penduduk`
--
ALTER TABLE `m_penduduk`
  ADD PRIMARY KEY (`nik`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_rw` (`id_rw`),
  ADD KEY `id_rt` (`id_rt`);

--
-- Indexes for table `m_rt`
--
ALTER TABLE `m_rt`
  ADD PRIMARY KEY (`id_rt`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_rw` (`id_rw`);

--
-- Indexes for table `m_rw`
--
ALTER TABLE `m_rw`
  ADD PRIMARY KEY (`id_rw`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `p_datang`
--
ALTER TABLE `p_datang`
  ADD PRIMARY KEY (`no_datang`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `p_lahir`
--
ALTER TABLE `p_lahir`
  ADD PRIMARY KEY (`no_lahir`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `p_meninggal`
--
ALTER TABLE `p_meninggal`
  ADD PRIMARY KEY (`no_meninggal`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `p_pindah`
--
ALTER TABLE `p_pindah`
  ADD PRIMARY KEY (`no_pindah`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `p_tetap`
--
ALTER TABLE `p_tetap`
  ADD PRIMARY KEY (`no_tetap`),
  ADD KEY `nik` (`nik`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_penduduk`
--
ALTER TABLE `m_penduduk`
  ADD CONSTRAINT `m_penduduk_ibfk_1` FOREIGN KEY (`id_rw`) REFERENCES `m_rw` (`id_rw`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `m_penduduk_ibfk_2` FOREIGN KEY (`id_rt`) REFERENCES `m_rt` (`id_rt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `m_rt`
--
ALTER TABLE `m_rt`
  ADD CONSTRAINT `m_rt_ibfk_1` FOREIGN KEY (`id_rw`) REFERENCES `m_rw` (`id_rw`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `p_datang`
--
ALTER TABLE `p_datang`
  ADD CONSTRAINT `p_datang_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `m_penduduk` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `p_lahir`
--
ALTER TABLE `p_lahir`
  ADD CONSTRAINT `p_lahir_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `m_penduduk` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `p_meninggal`
--
ALTER TABLE `p_meninggal`
  ADD CONSTRAINT `p_meninggal_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `m_penduduk` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `p_pindah`
--
ALTER TABLE `p_pindah`
  ADD CONSTRAINT `p_pindah_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `m_penduduk` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `p_tetap`
--
ALTER TABLE `p_tetap`
  ADD CONSTRAINT `p_tetap_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `m_penduduk` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
