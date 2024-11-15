-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2024 at 05:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spip`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@gmail.com', 'superadmin', NULL, '$2y$10$RC07kinPd3eT5NoczoHq3eIjKvaMg1bmvioqQfxpNVBnsOKvjtiIW', NULL, '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(3, 'Casey Rodriquez', 'qabyko@mailinator.com', 'harutenu', NULL, '$2y$10$ws0duWQs6uLcX0JLHh3Ub.vZRqWGqTNwYAYh8YpSSY5OPteFVxG6u', NULL, '2024-11-09 06:34:51', '2024-11-09 06:34:51'),
(4, 'jdeva', 'jdevaofficial@gmail.com', 'jdeva@gmail.com', NULL, '$2y$10$l2bUrgxzgj8wT46nNJP7ROINLkUUdlh7y87UbEoEeTiyngkiTs.CO', NULL, '2024-11-09 06:55:54', '2024-11-09 06:55:54'),
(5, 'gopek', 'gopek@gmail.com', 'gopek', NULL, '$2y$10$WrZ098DLebk6WNvAEOcR1uGJJXIs4khaCvQI1P75AwYHwR0rl4DL6', NULL, '2024-11-10 12:15:31', '2024-11-10 12:15:31'),
(7, 'andaka', 'andakaramdhanisantoso@gmail.com', 'andaka', NULL, '$2y$10$eDuxfNGtqOl4XArVANKs8u5iwVOkideLTAGVQhiYIPMArN3/w5rRW', NULL, '2024-11-15 15:30:56', '2024-11-15 15:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_07_24_184706_create_permission_tables', 1),
(5, '2020_09_12_043205_create_admins_table', 1),
(14, '2024_11_15_212822_create_spips_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1),
(3, 'App\\Models\\Admin', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.view', 'admin', 'dashboard', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(2, 'admin.create', 'admin', 'admin', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(3, 'admin.view', 'admin', 'admin', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(4, 'admin.edit', 'admin', 'admin', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(5, 'admin.delete', 'admin', 'admin', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(6, 'role.create', 'admin', 'role', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(7, 'role.view', 'admin', 'role', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(8, 'role.edit', 'admin', 'role', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(9, 'role.delete', 'admin', 'role', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(10, 'master.data.view', 'admin', 'master data', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(11, 'barang.jasa.create', 'admin', 'barang.jasa', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(12, 'barang.jasa.view', 'admin', 'barang.jasa', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(13, 'barang.jasa.edit', 'admin', 'barang.jasa', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(14, 'barang.jasa.delete', 'admin', 'barang.jasa', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(15, 'merk.create', 'admin', 'merk', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(16, 'merk.view', 'admin', 'merk', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(17, 'merk.edit', 'admin', 'merk', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(18, 'merk.delete', 'admin', 'merk', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(19, 'satuan.create', 'admin', 'satuan', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(20, 'satuan.view', 'admin', 'satuan', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(21, 'satuan.edit', 'admin', 'satuan', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(22, 'satuan.delete', 'admin', 'satuan', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(23, 'customer.create', 'admin', 'customer', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(24, 'customer.view', 'admin', 'customer', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(25, 'customer.edit', 'admin', 'customer', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(26, 'customer.delete', 'admin', 'customer', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(27, 'pph.create', 'admin', 'pph', '2024-09-13 15:06:23', '2024-09-13 15:06:23'),
(28, 'pph.view', 'admin', 'pph', '2024-09-13 15:06:23', '2024-09-13 15:06:23'),
(29, 'pph.edit', 'admin', 'pph', '2024-09-13 15:06:23', '2024-09-13 15:06:23'),
(30, 'pph.delete', 'admin', 'pph', '2024-09-13 15:06:23', '2024-09-13 15:06:23'),
(31, 'transaksi.create', 'admin', 'transaksi', '2024-09-13 15:06:23', '2024-09-13 15:06:23'),
(32, 'transaksi.view', 'admin', 'transaksi', '2024-09-13 15:06:23', '2024-09-13 15:06:23'),
(33, 'transaksi.edit', 'admin', 'transaksi', '2024-09-13 15:06:23', '2024-09-13 15:06:23'),
(34, 'transaksi.delete', 'admin', 'transaksi', '2024-09-13 15:06:23', '2024-09-13 15:06:23'),
(35, 'transaksi.invoice', 'admin', 'transaksi', '2024-09-13 15:06:23', '2024-09-13 15:06:23'),
(36, 'transaksi.rekap', 'admin', 'transaksi', '2024-09-13 15:06:23', '2024-09-13 15:06:23'),
(37, 'transaksi.update.status', 'admin', 'transaksi', '2024-09-13 15:06:23', '2024-09-13 15:06:23'),
(38, 'laporan.view', 'admin', 'laporan', '2024-09-13 15:06:23', '2024-09-13 15:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'admin', '2024-09-13 15:06:22', '2024-09-13 15:06:22'),
(3, 'user', 'admin', '2024-09-14 06:17:19', '2024-09-14 06:17:19');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 3),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1);

-- --------------------------------------------------------

--
-- Table structure for table `spips`
--

CREATE TABLE `spips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `merek` varchar(255) NOT NULL,
  `jenis_unit` varchar(255) NOT NULL,
  `perusahaan` varchar(255) NOT NULL,
  `nomor_unit` varchar(255) NOT NULL,
  `commisioner` varchar(255) NOT NULL,
  `tanggal_commisioning` date DEFAULT NULL,
  `deviasi` text DEFAULT NULL,
  `user` int(11) NOT NULL,
  `sticker` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `tanggal_expired` date DEFAULT NULL,
  `upload_foto` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spips`
--

INSERT INTO `spips` (`id`, `jenis`, `merek`, `jenis_unit`, `perusahaan`, `nomor_unit`, `commisioner`, `tanggal_commisioning`, `deviasi`, `user`, `sticker`, `status`, `tanggal_expired`, `upload_foto`, `type`, `created_at`, `updated_at`) VALUES
(2, 'Ab ut eos qui sunt', 'Sint porro nostrud', 'Velit iusto ut persp', 'Dignissimos atque te', 'Minima tempora nostr', 'Sit quam consequat', '2022-07-22', 'Qui voluptatem tenet', 4, 'Tidak', 'Tenetur maiores elig', '1982-07-26', '1731684298.png', 'Prasarana', '2024-11-15 15:24:58', '2024-11-15 15:24:58'),
(3, 'Sapiente non est rat', 'Quos obcaecati volup', 'Perspiciatis offici', 'Voluptas iure pariat', 'Dignissimos recusand', 'Exercitationem volup', '1993-06-09', 'Sed qui ipsa unde r', 7, 'Tidak', 'LULUS', '2024-12-07', NULL, 'Sarana', '2024-11-15 15:32:59', '2024-11-15 15:39:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `spips`
--
ALTER TABLE `spips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `spips`
--
ALTER TABLE `spips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
