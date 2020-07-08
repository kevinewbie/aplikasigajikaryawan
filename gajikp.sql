-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Feb 2019 pada 18.12
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gajikp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_gaji`
--

CREATE TABLE `tbl_gaji` (
  `idgaji` int(4) NOT NULL,
  `nama_karyawan` varchar(25) NOT NULL,
  `nomor_karyawan` int(15) NOT NULL,
  `divisi_karyawan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_gaji`
--

INSERT INTO `tbl_gaji` (`idgaji`, `nama_karyawan`, `nomor_karyawan`, `divisi_karyawan`) VALUES
(4, 'Doni Saputra', 806, 'Supervisor'),
(5, 'Andika Wicaksana', 902, 'Manager');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_gajipokok`
--

CREATE TABLE `tbl_gajipokok` (
  `id_jabatan` int(4) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `gaji_pokok` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_gajipokok`
--

INSERT INTO `tbl_gajipokok` (`id_jabatan`, `jabatan`, `gaji_pokok`) VALUES
(1, 'Manager', 8000000),
(2, 'Supervisor', 4000000),
(3, 'Secretary', 3000000),
(4, 'HES COORDINATOR', 3500000),
(5, 'OPERATOR', 2500000),
(6, 'Finance & Accounting', 3000000),
(7, 'Office Boy', 2000000),
(8, 'HELPER', 2300000),
(9, 'Security', 2500000),
(10, 'Mechanic', 3000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hak_akses`
--

CREATE TABLE `tbl_hak_akses` (
  `id` int(11) NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_hak_akses`
--

INSERT INTO `tbl_hak_akses` (`id`, `id_user_level`, `id_menu`) VALUES
(15, 1, 1),
(19, 1, 3),
(21, 2, 1),
(28, 2, 3),
(29, 2, 2),
(30, 1, 2),
(31, 2, 10),
(32, 2, 11),
(33, 2, 12),
(35, 2, 14),
(36, 2, 15),
(37, 2, 16),
(38, 1, 16),
(39, 1, 13),
(40, 1, 15),
(41, 1, 12),
(42, 1, 11),
(43, 1, 10),
(44, 2, 17),
(45, 1, 17),
(47, 1, 18),
(48, 2, 18);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_karyawan`
--

CREATE TABLE `tbl_karyawan` (
  `id_karyawan` int(4) NOT NULL,
  `nomor_karyawan` int(15) NOT NULL,
  `nama_karyawan` varchar(25) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan','','') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat_karyawan` varchar(30) NOT NULL,
  `pendidikan_terakhir` varchar(20) NOT NULL,
  `divisi_karyawan` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_karyawan`
--

INSERT INTO `tbl_karyawan` (`id_karyawan`, `nomor_karyawan`, `nama_karyawan`, `jenis_kelamin`, `tanggal_lahir`, `alamat_karyawan`, `pendidikan_terakhir`, `divisi_karyawan`) VALUES
(3, 902, 'Lil Skies', 'Laki-laki', '1987-05-28', 'Jl.Desa Harapan gg. Abdi  No.1', 'S2', 'Manager'),
(4, 806, 'Akbar Abdellah', 'Laki-laki', '1979-03-17', 'Jl.Suka Maju No.9 Duri-Riau', 'S1', 'Manager'),
(6, 801, 'Norman Kamaru', 'Perempuan', '1983-02-19', 'Jl. Kejaksaan No.20 Duri-Riau', 'D3', 'Manager'),
(11, 1101, 'Edi Saputra', 'Laki-laki', '1995-02-09', 'Jl.Desa Harapan Gg.Karya', 'SMP', 'Office Boy');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_main_menu` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL COMMENT 'y=yes,n=no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `title`, `url`, `icon`, `is_main_menu`, `is_aktif`) VALUES
(1, 'KELOLA MENU', 'kelolamenu', 'fa fa-server', 0, 'n'),
(2, 'KELOLA PENGGUNA', 'user', 'fa fa-user-o', 0, 'n'),
(3, 'level PENGGUNA', 'userlevel', 'fa fa-users', 0, 'n'),
(9, 'Contoh Form', 'welcome/form', 'fa fa-id-card', 0, 'y'),
(10, 'Tunjangan', 'tunjangan', 'fa fa-car', 13, 'y'),
(11, 'GAJI POKOK', 'gajipokok', 'fa fa-money', 13, 'y'),
(12, 'KARYAWAN', 'karyawan', 'fa fa-users', 13, 'y'),
(13, 'DATA MASTER', '#', 'fa fa-tasks', 0, 'y'),
(15, 'Penggajian', 'penggajian', 'fa fa-book', 0, 'y'),
(16, 'Overtime', 'overtime', 'fa fa-clock-o', 13, 'y'),
(17, 'Potongan', 'potongan', 'fa fa-hand-scissors-o', 13, 'y'),
(18, 'LAPORAN PENGGAJIAN', 'penggajian/cetak_lapor4n', 'fa fa-file', 0, 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_overtime`
--

CREATE TABLE `tbl_overtime` (
  `id_overtime` int(4) NOT NULL,
  `overtime` int(4) NOT NULL,
  `tambahan_overtime` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_overtime`
--

INSERT INTO `tbl_overtime` (`id_overtime`, `overtime`, `tambahan_overtime`) VALUES
(1, 1, 50000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penggajian`
--

CREATE TABLE `tbl_penggajian` (
  `id_gaji` int(4) NOT NULL,
  `nama_karyawan` varchar(25) NOT NULL,
  `nomor_karyawan` int(15) NOT NULL,
  `divisi_karyawan` varchar(25) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_penggajian`
--

INSERT INTO `tbl_penggajian` (`id_gaji`, `nama_karyawan`, `nomor_karyawan`, `divisi_karyawan`, `tanggal`) VALUES
(5, 'Norman Kamaru', 801, 'Manager', '2019-02-04'),
(6, 'Akbar Abdellah', 806, 'Manager', '2019-02-04'),
(7, 'Lil Skies', 902, 'Manager', '2019-02-04'),
(8, 'Edi Saputra', 1101, 'Office Boy', '2019-02-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_potongan`
--

CREATE TABLE `tbl_potongan` (
  `id_potongan` int(4) NOT NULL,
  `nama_potongan` varchar(20) NOT NULL,
  `potongan` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_potongan`
--

INSERT INTO `tbl_potongan` (`id_potongan`, `nama_potongan`, `potongan`) VALUES
(1, 'Jamsostek', 70000),
(2, 'Alfa', 50000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_riwayatgajipokok`
--

CREATE TABLE `tbl_riwayatgajipokok` (
  `id_riwayat` int(11) NOT NULL,
  `id_gaji` int(11) NOT NULL,
  `jabatan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_riwayatgajipokok`
--

INSERT INTO `tbl_riwayatgajipokok` (`id_riwayat`, `id_gaji`, `jabatan`) VALUES
(2, 2, 'Secretary'),
(3, 1, 'Manager'),
(4, 2, 'Secretary');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_riwayatovertime`
--

CREATE TABLE `tbl_riwayatovertime` (
  `id_riwayat` int(4) NOT NULL,
  `id_gaji` int(4) NOT NULL,
  `overtime` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_riwayatovertime`
--

INSERT INTO `tbl_riwayatovertime` (`id_riwayat`, `id_gaji`, `overtime`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 1, 2),
(4, 1, 1),
(5, 4, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_riwayatpotongan`
--

CREATE TABLE `tbl_riwayatpotongan` (
  `id_riwayat` int(4) NOT NULL,
  `id_gaji` int(4) NOT NULL,
  `nama_potongan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_riwayatpotongan`
--

INSERT INTO `tbl_riwayatpotongan` (`id_riwayat`, `id_gaji`, `nama_potongan`) VALUES
(1, 2, 'Jamsostek'),
(2, 3, 'Jamsostek'),
(3, 3, 'Alfa'),
(4, 1, 'Jamsostek'),
(5, 4, 'Jamsostek'),
(6, 8, 'Jamsostek'),
(7, 8, 'Alfa'),
(8, 7, 'Jamsostek'),
(9, 6, 'Jamsostek'),
(10, 5, 'Jamsostek');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id_setting` int(11) NOT NULL,
  `nama_setting` varchar(50) NOT NULL,
  `value` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_setting`
--

INSERT INTO `tbl_setting` (`id_setting`, `nama_setting`, `value`) VALUES
(1, 'Tampil Menu', 'ya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_total`
--

CREATE TABLE `tbl_total` (
  `id_total` int(4) NOT NULL,
  `id_gaji` int(4) NOT NULL,
  `total_penerimaan` int(20) NOT NULL,
  `total_potongan` int(20) NOT NULL,
  `total_akhir` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_total`
--

INSERT INTO `tbl_total` (`id_total`, `id_gaji`, `total_penerimaan`, `total_potongan`, `total_akhir`) VALUES
(1, 2, 6050000, 70000, 5980000),
(3, 3, 7050000, 120000, 6930000),
(4, 1, 12000000, 70000, 11930000),
(5, 4, 4050000, 70000, 3980000),
(6, 8, 4000000, 120000, 3880000),
(7, 7, 12000000, 70000, 11930000),
(8, 6, 12000000, 70000, 11930000),
(9, 5, 12000000, 70000, 11930000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_tunjangan`
--

CREATE TABLE `tbl_tunjangan` (
  `id_jabatan` int(4) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `tunjangan_jabatan` int(12) NOT NULL,
  `tunjangan_makan` int(12) NOT NULL,
  `tunjangan_transport` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_tunjangan`
--

INSERT INTO `tbl_tunjangan` (`id_jabatan`, `jabatan`, `tunjangan_jabatan`, `tunjangan_makan`, `tunjangan_transport`) VALUES
(1, 'Manager', 2000000, 1000000, 1000000),
(2, 'Supervisor', 1000000, 1000000, 1000000),
(3, 'Secretary', 1000000, 1000000, 1000000),
(4, 'Finance & Accounting', 1000000, 1000000, 1000000),
(5, 'HES COORDINATOR', 1000000, 1000000, 1000000),
(6, 'OPERATOR', 500000, 1000000, 1000000),
(7, 'HELPER', 0, 1000000, 1000000),
(8, 'Office Boy', 0, 1000000, 1000000),
(9, 'Security', 0, 1000000, 1000000),
(10, 'Mechanic', 500000, 1000000, 1000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_users` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_users`, `full_name`, `email`, `password`, `images`, `id_user_level`, `is_aktif`) VALUES
(1, 'Admin', 'admin@ajb.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', 'atomix_user31.png', 1, 'y'),
(3, 'Pimpinan', 'pimpinan@ajb.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', '7.png', 2, 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user_level`
--

CREATE TABLE `tbl_user_level` (
  `id_user_level` int(11) NOT NULL,
  `nama_level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user_level`
--

INSERT INTO `tbl_user_level` (`id_user_level`, `nama_level`) VALUES
(1, 'Super Admin'),
(2, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_gaji`
--
ALTER TABLE `tbl_gaji`
  ADD PRIMARY KEY (`idgaji`);

--
-- Indeks untuk tabel `tbl_gajipokok`
--
ALTER TABLE `tbl_gajipokok`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD UNIQUE KEY `nomor_karyawan` (`nomor_karyawan`);

--
-- Indeks untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `tbl_overtime`
--
ALTER TABLE `tbl_overtime`
  ADD PRIMARY KEY (`id_overtime`);

--
-- Indeks untuk tabel `tbl_penggajian`
--
ALTER TABLE `tbl_penggajian`
  ADD PRIMARY KEY (`id_gaji`),
  ADD UNIQUE KEY `nomor_karyawan` (`nomor_karyawan`);

--
-- Indeks untuk tabel `tbl_potongan`
--
ALTER TABLE `tbl_potongan`
  ADD PRIMARY KEY (`id_potongan`);

--
-- Indeks untuk tabel `tbl_riwayatgajipokok`
--
ALTER TABLE `tbl_riwayatgajipokok`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indeks untuk tabel `tbl_riwayatovertime`
--
ALTER TABLE `tbl_riwayatovertime`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indeks untuk tabel `tbl_riwayatpotongan`
--
ALTER TABLE `tbl_riwayatpotongan`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indeks untuk tabel `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indeks untuk tabel `tbl_total`
--
ALTER TABLE `tbl_total`
  ADD PRIMARY KEY (`id_total`);

--
-- Indeks untuk tabel `tbl_tunjangan`
--
ALTER TABLE `tbl_tunjangan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_users`);

--
-- Indeks untuk tabel `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  ADD PRIMARY KEY (`id_user_level`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_gaji`
--
ALTER TABLE `tbl_gaji`
  MODIFY `idgaji` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_gajipokok`
--
ALTER TABLE `tbl_gajipokok`
  MODIFY `id_jabatan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  MODIFY `id_karyawan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tbl_overtime`
--
ALTER TABLE `tbl_overtime`
  MODIFY `id_overtime` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_penggajian`
--
ALTER TABLE `tbl_penggajian`
  MODIFY `id_gaji` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_potongan`
--
ALTER TABLE `tbl_potongan`
  MODIFY `id_potongan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_riwayatgajipokok`
--
ALTER TABLE `tbl_riwayatgajipokok`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_riwayatovertime`
--
ALTER TABLE `tbl_riwayatovertime`
  MODIFY `id_riwayat` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_riwayatpotongan`
--
ALTER TABLE `tbl_riwayatpotongan`
  MODIFY `id_riwayat` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_total`
--
ALTER TABLE `tbl_total`
  MODIFY `id_total` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_tunjangan`
--
ALTER TABLE `tbl_tunjangan`
  MODIFY `id_jabatan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
