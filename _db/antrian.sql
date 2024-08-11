-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jul 2023 pada 19.47
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antrian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrians`
--

CREATE TABLE `antrians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loket_id` bigint(20) UNSIGNED NOT NULL,
  `no_antrian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `antrians`
--

INSERT INTO `antrians` (`id`, `loket_id`, `no_antrian`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'P01', 1, '2023-07-16 10:11:49', '2023-07-16 10:37:50'),
(2, 1, 'P02', 0, '2023-07-16 10:11:49', '2023-07-16 10:11:49'),
(3, 2, 'U01', 1, '2023-07-16 10:11:50', '2023-07-16 10:28:47'),
(4, 2, 'U02', 1, '2023-07-16 10:11:50', '2023-07-16 10:37:28'),
(5, 1, 'P03', 0, '2023-07-16 10:29:40', '2023-07-16 10:29:40'),
(6, 2, 'U03', 0, '2023-07-16 10:32:33', '2023-07-16 10:32:33'),
(7, 2, 'U04', 0, '2023-07-16 10:41:06', '2023-07-16 10:41:06'),
(8, 1, 'P04', 0, '2023-07-16 10:45:03', '2023-07-16 10:45:03'),
(9, 2, 'U05', 0, '2023-07-16 10:45:25', '2023-07-16 10:45:25'),
(10, 2, 'U06', 0, '2023-07-16 10:45:43', '2023-07-16 10:45:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokters`
--

CREATE TABLE `dokters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_dokter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spesialis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `layanan_id` bigint(20) UNSIGNED NOT NULL,
  `tgl_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dokters`
--

INSERT INTO `dokters` (`id`, `nama_dokter`, `spesialis`, `layanan_id`, `tgl_lahir`, `no_hp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Argo Pribadi, dr, Sp.A', 'Ibu dan Anak', 1, '1988-05-22', '087771525333', 'Jl. Rumah Sakit Umum No.1, Kotabaru, Kec. Serang, Kota Serang, Banten 42112', '2023-07-16 10:11:50', '2023-07-16 10:11:50'),
(2, 'Eris Sejahtera, drg', 'Gigi', 2, '1981-07-12', '087771525323', 'Jl. sochari, Kota Serang, Banten 42112', '2023-07-16 10:11:50', '2023-07-16 10:11:50'),
(3, 'M. Erwin Jaya Sanjaya, SpOG', 'Kehamilan', 3, '1970-05-22', '0877715211111', 'Jl. Rumah Sakit Umum No.1, Kotabaru, Kec. Serang, Kota Serang, Banten 42112', '2023-07-16 10:11:50', '2023-07-16 10:11:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanans`
--

CREATE TABLE `layanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_layanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_layanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `layanans`
--

INSERT INTO `layanans` (`id`, `kd_layanan`, `nama_layanan`, `created_at`, `updated_at`) VALUES
(1, 'kia', 'Poli KIA', '2023-07-16 10:11:50', '2023-07-16 10:11:50'),
(2, 'gigi', 'Poli Gigi', '2023-07-16 10:11:50', '2023-07-16 10:11:50'),
(3, 'obgin', 'Poli Obgin', '2023-07-16 10:11:50', '2023-07-16 10:11:50'),
(4, 'lab', 'Laboratorium', '2023-07-16 10:11:50', '2023-07-16 10:11:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokets`
--

CREATE TABLE `lokets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_loket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lokets`
--

INSERT INTO `lokets` (`id`, `nama_loket`, `kode`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Bpjs Kesehatan', 'P', 'Pasien Bpjs', '2023-07-16 10:11:49', '2023-07-16 10:11:49'),
(2, 'Umum', 'U', 'Pasien Umum', '2023-07-16 10:11:49', '2023-07-16 10:11:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_11_03_054402_create_lokets_table', 1),
(6, '2022_11_03_064254_create_antrians_table', 1),
(7, '2023_05_04_165935_create_pendaftarans_table', 1),
(8, '2023_05_22_124304_create_layanans_table', 1),
(9, '2023_05_22_124323_create_dokters_table', 1),
(10, '2023_05_22_131921_create_reg_pasiens_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftarans`
--

CREATE TABLE `pendaftarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_rm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ttl` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pj` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_pj` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendidikan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pendaftarans`
--

INSERT INTO `pendaftarans` (`id`, `no_rm`, `no_ktp`, `nama`, `ttl`, `jenis_kelamin`, `status`, `pj`, `no_pj`, `alamat`, `pendidikan`, `pekerjaan`, `agama`, `no_hp`, `created_at`, `updated_at`) VALUES
(1, '16-90-01', '222222222', 'ANADIKA', '1990-01-01', 'Laki-laki', 'Single', 'ASEP', '087888888899', 'ZSADASDA', 'S1', 'KARYAWAN', 'ISLAM', '087888888899', '2023-07-16 10:17:07', '2023-07-16 10:44:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reg_pasiens`
--

CREATE TABLE `reg_pasiens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `noregistrasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_bpjs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pasien_id` bigint(20) UNSIGNED NOT NULL,
  `dokter_id` bigint(20) UNSIGNED NOT NULL,
  `layanan_id` bigint(20) UNSIGNED NOT NULL,
  `tipe_pasien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `reg_pasiens`
--

INSERT INTO `reg_pasiens` (`id`, `noregistrasi`, `no_bpjs`, `pasien_id`, `dokter_id`, `layanan_id`, `tipe_pasien`, `status`, `created_at`, `updated_at`) VALUES
(1, '90340597', '454646456456', 1, 1, 2, 'BPJS', 1, '2023-07-16 10:38:35', '2023-07-16 10:38:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`) VALUES
(1, 'Ilham Maulana', 'ilham', 'admin@gmail.com', NULL, '$2y$10$sXNXZXsMsuYmbHK4xJEDBuNL.WIB7G973R9epG6RDIims5eRT17gq', NULL, '2023-07-16 10:11:49', '2023-07-16 10:11:49', 1),
(2, 'Janae Hilpert', 'gilberto.schimmel', 'dorian96@example.org', '2023-07-16 10:11:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'y7gCJ9V3ru', '2023-07-16 10:11:50', '2023-07-16 10:11:50', 0),
(3, 'Dr. Magnus Durgan DDS', 'parisian.ryder', 'iwiegand@example.com', '2023-07-16 10:11:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'IN2lE94grQ', '2023-07-16 10:11:50', '2023-07-16 10:11:50', 0),
(4, 'Mrs. Cindy Romaguera', 'schroeder.kameron', 'ortiz.americo@example.org', '2023-07-16 10:11:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'xJeB9Z2Dxp', '2023-07-16 10:11:50', '2023-07-16 10:11:50', 0),
(5, 'Bernita Hills', 'luna.hauck', 'elittel@example.org', '2023-07-16 10:11:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ys93aPKbB8', '2023-07-16 10:11:50', '2023-07-16 10:11:50', 0),
(6, 'Valerie Kub', 'morris.veum', 'qstroman@example.net', '2023-07-16 10:11:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hhtl4IevNV', '2023-07-16 10:11:50', '2023-07-16 10:11:50', 0),
(8, 'HAFA', 'hafa', 'hafa@gmail.com', NULL, '$2y$10$sXNXZXsMsuYmbHK4xJEDBuNL.WIB7G973R9epG6RDIims5eRT17gq', NULL, '2023-07-16 10:35:36', '2023-07-16 10:35:36', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `antrians`
--
ALTER TABLE `antrians`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dokters`
--
ALTER TABLE `dokters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `layanans`
--
ALTER TABLE `layanans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `lokets`
--
ALTER TABLE `lokets`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pendaftarans`
--
ALTER TABLE `pendaftarans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `reg_pasiens`
--
ALTER TABLE `reg_pasiens`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `antrians`
--
ALTER TABLE `antrians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `dokters`
--
ALTER TABLE `dokters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `layanans`
--
ALTER TABLE `layanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `lokets`
--
ALTER TABLE `lokets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pendaftarans`
--
ALTER TABLE `pendaftarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `reg_pasiens`
--
ALTER TABLE `reg_pasiens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
