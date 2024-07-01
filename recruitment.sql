-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jul 2024 pada 13.52
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
(2, 3, 'Osamu Dazai'),
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
(1, 7, 'Bram Stoker', '00340000345', 'Solo', 'Laki-laki', 'Surakarta', '2008-01-02', '789789', NULL, NULL),
(2, 8, 'margaret mitchell', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(50) DEFAULT NULL,
  `is_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`, `is_active`) VALUES
(1, 'Spinning', 1),
(2, 'Weaving', 1),
(3, 'Finishing', 1),
(4, 'Garment', 1),
(5, 'Knitting', 1),
(6, 'Supporting', 1),
(7, 'Teknologi', 1),
(8, 'Care', 0);

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
-- Struktur dari tabel `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `soal_id` int(11) DEFAULT NULL,
  `karyawan_id` int(11) DEFAULT NULL,
  `jawaban` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lamaran`
--

CREATE TABLE `lamaran` (
  `id_lamaran` int(11) NOT NULL,
  `loker_id` int(11) DEFAULT NULL,
  `karyawan_id` int(11) DEFAULT NULL,
  `file_lamaran` text DEFAULT NULL,
  `status_lamaran` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `loker`
--

CREATE TABLE `loker` (
  `id_loker` int(11) NOT NULL,
  `posisi_id` int(11) DEFAULT NULL,
  `divisi_id` int(11) DEFAULT NULL,
  `jumlah_kebutuhan` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `is_active` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `loker`
--

INSERT INTO `loker` (`id_loker`, `posisi_id`, `divisi_id`, `jumlah_kebutuhan`, `deskripsi`, `is_active`, `created_at`) VALUES
(1, 8, 5, 2, 'Test\r\n- adad\r\n- adwqdq\r\n- msfwf', 1, '2024-06-27 10:54:40'),
(2, 4, 6, 3, '-Pendidikan minimal S1 di bidang Marketing, Bisnis, atau setara\r\n\r\n-Pengalaman kerja minimal 2 tahun di bidang pemasaran\r\n\r\n-Memiliki kemampuan analitis dan komunikasi yang baik\r\n\r\n-Menguasai penggunaan alat-alat pemasaran digital\r\n\r\n-Kreatif, inovatif, dan mampu bekerja di bawah tekanan', 1, '2024-06-27 11:24:27'),
(3, 14, 4, 5, 'LASDQDSDF', 0, '2024-06-27 11:34:16'),
(4, 20, 3, 1, 'ASDXVXVW', 0, '2024-06-27 11:34:58');

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
  `is_active` int(11) DEFAULT 1,
  `divisi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `posisi`
--

INSERT INTO `posisi` (`id_posisi`, `nama_posisi`, `is_active`, `divisi_id`) VALUES
(1, 'Komisaris utama', 1, NULL),
(2, 'Komisaris', 1, NULL),
(3, 'Direktur Utama', 1, NULL),
(4, 'Direktur Operasional', 1, NULL),
(5, 'Direktur Keuangan', 1, NULL),
(6, 'Trainer', 1, NULL),
(7, 'direktur umum', 1, NULL),
(8, 'direktur IT', 1, NULL),
(9, 'General manager', 1, NULL),
(10, 'manager', 1, NULL),
(11, 'section head', 1, NULL),
(12, 'supervisor', 1, NULL),
(13, 'kepala shift', 1, NULL),
(14, 'kepala regu', 1, NULL),
(15, 'staff', 1, NULL),
(16, 'security', 1, NULL),
(17, 'operator', 1, NULL),
(18, 'driver', 1, NULL),
(19, 'perawat', 0, NULL),
(20, 'bidan', 1, NULL),
(21, 'dokter', 1, NULL),
(22, 'magang', 1, NULL),
(31, 'cleaning123', 0, NULL);

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
-- Struktur dari tabel `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL,
  `loker_id` int(11) DEFAULT NULL,
  `soal` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `soal`
--

INSERT INTO `soal` (`id_soal`, `loker_id`, `soal`) VALUES
(1, 1, 'Apa itu diinikan?');

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
(3, 'dazai', 'dazai@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 'osamudazai_3.jpg', 1),
(4, 'chuya', 'chuya@gmail.com', '202cb962ac59075b964b07152d234b70', 1, NULL, 1),
(5, 'atsushi', 'atsushi@gmail.com', '250cf8b51c773f3f8dc8b4be867a9a02', 1, 'nakajimaatsushi_5.jpg', 1),
(6, 'akutagawa', 'akutagawa@gmail.com', '202cb962ac59075b964b07152d234b70', 1, NULL, 0),
(7, 'bram', 'bramstoker@gmail.com', '202cb962ac59075b964b07152d234b70', 3, 'bramstoker_7.jpg', 1),
(8, 'margaret', 'margaret@gmail.com', '202cb962ac59075b964b07152d234b70', 3, NULL, 1);

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
-- Indeks untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `jawaban_detail_karyawan_FK` (`karyawan_id`),
  ADD KEY `jawaban_soal_FK` (`soal_id`);

--
-- Indeks untuk tabel `lamaran`
--
ALTER TABLE `lamaran`
  ADD PRIMARY KEY (`id_lamaran`),
  ADD KEY `lamaran_detail_karyawan_FK` (`karyawan_id`),
  ADD KEY `lamaran_loker_FK` (`loker_id`);

--
-- Indeks untuk tabel `loker`
--
ALTER TABLE `loker`
  ADD PRIMARY KEY (`id_loker`),
  ADD KEY `loker_posisi_FK` (`posisi_id`),
  ADD KEY `loker_divisi_FK` (`divisi_id`);

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
-- Indeks untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `soal_loker_FK` (`loker_id`);

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
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id_hak_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `lamaran`
--
ALTER TABLE `lamaran`
  MODIFY `id_lamaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `loker`
--
ALTER TABLE `loker`
  MODIFY `id_loker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `posisi`
--
ALTER TABLE `posisi`
  MODIFY `id_posisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id_submenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- Ketidakleluasaan untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_detail_karyawan_FK` FOREIGN KEY (`karyawan_id`) REFERENCES `detail_karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_soal_FK` FOREIGN KEY (`soal_id`) REFERENCES `soal` (`id_soal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `lamaran`
--
ALTER TABLE `lamaran`
  ADD CONSTRAINT `lamaran_detail_karyawan_FK` FOREIGN KEY (`karyawan_id`) REFERENCES `detail_karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lamaran_loker_FK` FOREIGN KEY (`loker_id`) REFERENCES `loker` (`id_loker`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `loker`
--
ALTER TABLE `loker`
  ADD CONSTRAINT `loker_divisi_FK` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id_divisi`),
  ADD CONSTRAINT `loker_posisi_FK` FOREIGN KEY (`posisi_id`) REFERENCES `posisi` (`id_posisi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `soal_loker_FK` FOREIGN KEY (`loker_id`) REFERENCES `loker` (`id_loker`) ON DELETE CASCADE ON UPDATE CASCADE;

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
