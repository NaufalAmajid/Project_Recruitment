-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: my_db
-- Waktu pembuatan: 26 Jun 2024 pada 15.47
-- Versi server: 11.4.2-MariaDB-ubu2404
-- Versi PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recruitment`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_admin`
--

CREATE TABLE `detail_admin` (
  `id_admin` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_admin`
--

INSERT INTO `detail_admin` (`id_admin`, `user_id`, `nama`) VALUES
(2, 3, 'osamu dazai'),
(3, 4, 'nakahara chuya'),
(4, 5, 'Nakajima Atsushi'),
(5, 6, 'akutagawa ryounosuke');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_hrd`
--

CREATE TABLE `detail_hrd` (
  `id_hrd` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_hrd`
--

INSERT INTO `detail_hrd` (`id_hrd`, `user_id`, `nama`) VALUES
(1, 1, 'Yukichi Fukuzawa'),
(2, 2, 'Ogari Mori');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_karyawan`
--

CREATE TABLE `detail_karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jenkel` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `tempat_lahir` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `status_karyawan` int(11) DEFAULT NULL,
  `posisi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_karyawan`
--

INSERT INTO `detail_karyawan` (`id_karyawan`, `user_id`, `nama`, `nik`, `alamat`, `jenkel`, `tempat_lahir`, `tanggal_lahir`, `no_hp`, `status_karyawan`, `posisi_id`) VALUES
(1, 7, 'Bram Stoker', '00340000345', 'Solo', 'Laki-laki', 'Surakarta', '2008-01-02', '789789', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id_hak_akses` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hak_akses`
--

INSERT INTO `hak_akses` (`id_hak_akses`, `role_id`, `menu_id`) VALUES
(1, 1, 5),
(2, 1, 6),
(3, 1, 7),
(4, 2, 1),
(5, 2, 3),
(6, 2, 4),
(7, 3, 1),
(8, 3, 2),
(9, 1, 8),
(10, 2, 8),
(11, 3, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(20) DEFAULT NULL,
  `direktori` varchar(20) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `direktori`, `icon`) VALUES
(1, 'lowongan kerja', 'lowongan_kerja', 'bx bx-news'),
(2, 'tes & orientasi', 'tes_orientasi', 'bx bx-calendar-edit'),
(3, 'tes dasar skill', 'test_skill', 'bx bx-highlight'),
(4, 'data karyawan', 'data_karyawan', 'bx bx-body'),
(5, 'file lamaran', 'file_lamaran', 'bx bx-file-find'),
(6, 'penjadwalan', 'penjadwalan', 'bx bx-calendar-edit'),
(7, 'master', 'master', 'bx bx-layer'),
(8, 'profile', 'profile', 'bx bx-user-circle');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posisi`
--

CREATE TABLE `posisi` (
  `id_posisi` int(11) NOT NULL,
  `nama_posisi` varchar(50) DEFAULT NULL,
  `divisi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(50) DEFAULT NULL,
  `simple_nama_role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `nama_role`, `simple_nama_role`) VALUES
(1, 'Admin Recruitment', 'admin'),
(2, 'Human Resource Development (HRD)', 'hrd'),
(3, 'Pelamar', 'pelamar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `submenu`
--

CREATE TABLE `submenu` (
  `id_submenu` int(11) NOT NULL,
  `nama_submenu` varchar(20) DEFAULT NULL,
  `direktori` varchar(20) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `submenu`
--

INSERT INTO `submenu` (`id_submenu`, `nama_submenu`, `direktori`, `menu_id`) VALUES
(1, 'data user', 'data_user', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `is_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `role_id`, `photo`, `is_active`) VALUES
(1, 'fukuzawa', 'fukuzawa@gmail.com', '202cb962ac59075b964b07152d234b70', 2, 'yukichifukuzawa_1.png', 1),
(2, 'mori', 'mori@gmail.com', '202cb962ac59075b964b07152d234b70', 2, 'ogarimori_2.jpg', 1),
(3, 'dazai', 'dazai@gmail.com', '202cb962ac59075b964b07152d234b70', 1, NULL, 1),
(4, 'chuya', 'chuya@gmail.com', '202cb962ac59075b964b07152d234b70', 1, NULL, 1),
(5, 'atsushi', 'atsushi@gmail.com', '250cf8b51c773f3f8dc8b4be867a9a02', 1, 'nakajimaatsushi_5.jpg', 1),
(6, 'akutagawa', 'akutagawa@gmail.com', '202cb962ac59075b964b07152d234b70', 1, NULL, 0),
(7, 'bram', 'bramstoker@gmail.com', '202cb962ac59075b964b07152d234b70', 3, 'bramstoker_7.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_admin`
--
ALTER TABLE `detail_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `detail_admin_user_FK` (`user_id`);

--
-- Indeks untuk tabel `detail_hrd`
--
ALTER TABLE `detail_hrd`
  ADD PRIMARY KEY (`id_hrd`),
  ADD KEY `detail_hrd_user_FK` (`user_id`);

--
-- Indeks untuk tabel `detail_karyawan`
--
ALTER TABLE `detail_karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `detail_karyawan_user_FK` (`user_id`),
  ADD KEY `detail_karyawan_posisi_FK` (`posisi_id`);

--
-- Indeks untuk tabel `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indeks untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id_hak_akses`),
  ADD KEY `hak_akses_role_FK` (`role_id`),
  ADD KEY `hak_akses_menu_FK` (`menu_id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `posisi`
--
ALTER TABLE `posisi`
  ADD PRIMARY KEY (`id_posisi`),
  ADD KEY `posisi_divisi_FK` (`divisi_id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`id_submenu`),
  ADD KEY `submenu_menu_FK` (`menu_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `user_role_FK` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_admin`
--
ALTER TABLE `detail_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `detail_hrd`
--
ALTER TABLE `detail_hrd`
  MODIFY `id_hrd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `detail_karyawan`
--
ALTER TABLE `detail_karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id_hak_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `posisi`
--
ALTER TABLE `posisi`
  MODIFY `id_posisi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id_submenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_admin`
--
ALTER TABLE `detail_admin`
  ADD CONSTRAINT `detail_admin_user_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_hrd`
--
ALTER TABLE `detail_hrd`
  ADD CONSTRAINT `detail_hrd_user_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_karyawan`
--
ALTER TABLE `detail_karyawan`
  ADD CONSTRAINT `detail_karyawan_posisi_FK` FOREIGN KEY (`posisi_id`) REFERENCES `posisi` (`id_posisi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_karyawan_user_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD CONSTRAINT `hak_akses_menu_FK` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hak_akses_role_FK` FOREIGN KEY (`role_id`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `posisi`
--
ALTER TABLE `posisi`
  ADD CONSTRAINT `posisi_divisi_FK` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `submenu`
--
ALTER TABLE `submenu`
  ADD CONSTRAINT `submenu_menu_FK` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_role_FK` FOREIGN KEY (`role_id`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
