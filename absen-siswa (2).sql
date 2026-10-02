-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 02, 2026 at 03:35 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absen-siswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `izin`
--

CREATE TABLE `izin` (
  `id_izin` int NOT NULL,
  `id_siswa` int NOT NULL,
  `id_jenis` int NOT NULL,
  `tanggal` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `alasan` text NOT NULL,
  `file_surat` varchar(255) NOT NULL,
  `status` enum('menunggu','disetujui','ditolak') NOT NULL,
  `tgl_dibuat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `izin`
--

INSERT INTO `izin` (`id_izin`, `id_siswa`, `id_jenis`, `tanggal`, `waktu_mulai`, `waktu_selesai`, `alasan`, `file_surat`, `status`, `tgl_dibuat`) VALUES
(1, 1, 1, '2026-09-09', '12:24:00', '13:24:00', 'hgfhtf', '1788920697_Screenshot 2026-02-05 011836.png', 'menunggu', '2026-09-02 06:23:00'),
(3, 10, 1, '2026-09-18', '10:26:00', '12:25:00', 'gggdg', '1788920751_Screenshot 2026-02-11 082801.png', 'ditolak', '2026-09-09 02:25:51'),
(4, 2, 20, '2026-09-12', '10:59:00', '11:55:00', 'sfdf', '1789095314_Screenshot 2026-02-04 114440.png', 'disetujui', '2026-09-11 02:55:14'),
(5, 10, 20, '2026-09-08', '10:56:00', '13:56:00', 'daddddd', '1789095503_Screenshot 2026-02-05 011836.png', 'disetujui', '2026-09-11 02:56:31'),
(6, 10, 12, '2026-09-12', '12:30:00', '12:34:00', 'vfdgdf', '1789101016_Screenshot 2026-02-04 114440.png', 'menunggu', '2026-09-11 04:30:16'),
(7, 10, 12, '2026-09-24', '12:57:00', '14:58:00', 'cvxvvcx', '1789102689_Screenshot 2026-02-12 234328.png', 'menunggu', '2026-09-11 04:58:09'),
(12, 10, 20, '2026-09-11', '10:10:00', '10:13:00', 'karena ada odalan di rumah jadi tidak bisa mengikuti pembelajaran hari ini tolong di maklumkan pabak atau ibuk yang mengajar hari ini', '1789179071_Screenshot 2026-09-11 123134.png', 'disetujui', '2026-09-12 02:11:11'),
(13, 16, 20, '2026-09-19', '21:29:00', '22:29:00', 'sdfsggdf', '1789223369_Screenshot 2026-02-04 114440.png', 'disetujui', '2026-09-12 14:29:29'),
(14, 5, 22, '2026-09-10', '22:33:00', '22:35:00', '2 hari demam tidak turun-turun', '1789223667_Screenshot 2026-03-13 102928.png', 'disetujui', '2026-09-12 14:34:27'),
(15, 5, 20, '2026-09-19', '22:47:00', '22:48:00', 'ffdfdsdf', '1789224268_Screenshot 2026-02-12 234328.png', 'disetujui', '2026-09-12 14:44:28'),
(16, 16, 20, '2026-09-24', '11:43:00', '11:44:00', 'f', '1789357225_Screenshot 2026-02-12 235630.png', 'menunggu', '2026-09-14 03:40:25'),
(17, 16, 12, '2026-09-12', '11:46:00', '11:46:00', 'y', '1789357437_Screenshot 2026-02-12 203434.png', 'menunggu', '2026-09-14 03:43:57'),
(18, 16, 20, '2026-09-17', '19:32:00', '23:29:00', 'rf', '1789471789_Screenshot 2026-09-12 230238.png', 'menunggu', '2026-09-15 11:29:49');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_izin`
--

CREATE TABLE `jenis_izin` (
  `id_jenis` int NOT NULL,
  `nama_jenis` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jenis_izin`
--

INSERT INTO `jenis_izin` (`id_jenis`, `nama_jenis`, `deskripsi`) VALUES
(1, 'sakit', 'demamtinggi'),
(12, 'demam', 'batuk pilek'),
(20, 'izin', 'odalan'),
(22, 'sakit', 'pusing'),
(32, 'izin ', 'mual-mual muntah'),
(346, 'sekarat', 'hampir mati');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int NOT NULL,
  `nama_kelas` varchar(20) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `tingkat` varchar(10) NOT NULL,
  `wali_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `jurusan`, `tingkat`, `wali_kelas`) VALUES
(2, 'NEXUZ', 'PPLG', '12', 'arikasss'),
(13, 'kapal', 'kapal', '11', 'doniputra'),
(22, 'TKC', 'majapahit', '32', 'jarjit'),
(23, 'PH', 'tkc', '11', 'papan'),
(44, 'KULINER', 'majapahitttt', '12', 'kusumakusuma');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int NOT NULL,
  `id_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama_siswa` varchar(20) NOT NULL,
  `id_kelas` int NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_user`, `nis`, `nama_siswa`, `id_kelas`, `tgl_lahir`, `jenis_kelamin`, `alamat`, `no_hp`) VALUES
(1, '1', '09878878879', 'putra', 23, '2009-06-02', 'L', 'br.bbkn kangin', '0987654778'),
(2, '2', '434422', 'doniputra', 23, '2026-08-20', 'L', 'jl.uma anyar', '08987678321'),
(3, '5', '8080899', 'ketut tuttut', 2, '2026-08-29', 'L', 'jl.uma anyar', '08987678321'),
(5, '8', '8080866666', 'kusuma', 23, '2026-08-29', 'P', 'jl.uma anyar', '08987678321'),
(6, '32', '23332', 'jarr', 2, '2026-08-13', 'P', 'jl.uma anyar', '08987678321'),
(10, '7', '434422', 'ketut', 44, '2026-08-15', 'P', 'br.bbkn kangin kk', '08987678321'),
(11, '233', '32233sdfsd', 'saputra', 22, '2026-08-29', 'L', 'sfsdf', '3425344535'),
(12, '32323', '3232', 'putrii', 22, '2026-08-01', 'L', 'br.bbkn kangin kk', '2333333222'),
(14, '77', '434422656', 'donkkk', 23, '2026-08-02', 'L', 'br.bbkn kangin', '08987678321'),
(15, '3', '4344', 'gagaguguu', 22, '2026-08-29', 'L', 'jl.uma anyar', '08987678321'),
(16, '4', '12345', 'ketut', 23, '2026-09-11', 'L', 'br.bbkn', '08987678321');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `role` enum('admin','guru','siswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama_lengkap`, `email`, `no_hp`, `role`) VALUES
(1, 'admin', 'admin', 'doni23', 'admin33@gmail.com', '00987654647887', 'admin'),
(2, 'doni', '1234', 'wayan', 'ewee@gmail.com', '08987678321', 'admin'),
(3, 'doni', 'sdasdd', 'nama_lengkap', 'dade@gmail.com', '08987678321', 'siswa'),
(4, 'putrasaja', 'dscf', 'putaakusuma', 'dsfds@gmail.com', '8093284', 'siswa'),
(21, 'putra', '123', 'doniputra', 'wayandoni237@gmail.com', '0898767999', 'admin'),
(23, 'wayan', '1234', 'wayanputra', 'wayandoni237@gmail.com', '8093284545', 'siswa'),
(24, 'kusuma', '222', 'kusumakusuma', 'wann@gmail.com', '0898767888', 'guru'),
(25, 'doni', '1234', 'wayandoni', 'wayandoni237@gmail.com', '8093284', 'guru');

-- --------------------------------------------------------

--
-- Table structure for table `verifikasi`
--

CREATE TABLE `verifikasi` (
  `id_verifikasi` int NOT NULL,
  `id_izin` int NOT NULL,
  `id_guru` int NOT NULL,
  `keputusan` enum('disetujui','ditolak') NOT NULL,
  `catatan` text NOT NULL,
  `tgl_verifikasi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `verifikasi`
--

INSERT INTO `verifikasi` (`id_verifikasi`, `id_izin`, `id_guru`, `keputusan`, `catatan`, `tgl_verifikasi`) VALUES
(1, 15, 21, 'disetujui', '', '2026-09-13 13:29:49'),
(2, 14, 21, 'disetujui', 'haha', '2026-09-13 13:49:50'),
(3, 12, 21, 'disetujui', 'oky ', '2026-09-14 01:24:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `izin`
--
ALTER TABLE `izin`
  ADD PRIMARY KEY (`id_izin`);

--
-- Indexes for table `jenis_izin`
--
ALTER TABLE `jenis_izin`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `verifikasi`
--
ALTER TABLE `verifikasi`
  ADD PRIMARY KEY (`id_verifikasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `izin`
--
ALTER TABLE `izin`
  MODIFY `id_izin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `jenis_izin`
--
ALTER TABLE `jenis_izin`
  MODIFY `id_jenis` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `verifikasi`
--
ALTER TABLE `verifikasi`
  MODIFY `id_verifikasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
