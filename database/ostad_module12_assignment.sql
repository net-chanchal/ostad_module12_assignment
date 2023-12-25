-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 25, 2023 at 10:38 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ostad_module12_assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `id` bigint UNSIGNED NOT NULL,
  `bus_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`id`, `bus_name`, `model`, `capacity`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Green Line Deluxe', 'DLX-2000', 36, 1, '2023-12-22 02:55:00', '2023-12-22 03:12:48'),
(2, 'Green Line Express', 'GLX-1000', 52, 1, '2023-12-22 02:55:45', '2023-12-23 04:49:22'),
(5, 'Hanif Express', 'HEX-5001', 52, 0, '2023-12-25 03:46:10', '2023-12-25 03:46:10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2014_10_12_000000_create_users_table', 1),
(11, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(12, '2019_08_19_000000_create_failed_jobs_table', 1),
(13, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(14, '2023_12_22_072810_create_buses_table', 1),
(15, '2023_12_22_072932_create_routes_table', 1),
(16, '2023_12_22_073209_create_trips_table', 1),
(17, '2023_12_22_073846_create_passengers_table', 1),
(25, '2023_12_22_204326_create_sub_routes_table', 2),
(26, '2023_12_23_123353_create_tickets_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

CREATE TABLE `passengers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_or_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `passengers`
--

INSERT INTO `passengers` (`id`, `name`, `email_or_phone`, `created_at`, `updated_at`) VALUES
(1, 'Md. Chanchal Biswas', 'mchanchalbd@gmail.com', '2023-12-23 12:09:14', '2023-12-23 12:09:14'),
(2, 'Anika', 'anika@gmail.com', '2023-12-23 12:09:14', '2023-12-23 12:09:14'),
(3, 'Abdul Rahim', 'abdul@gmail.com', '2023-12-24 03:47:39', '2023-12-24 03:47:39'),
(4, 'Rahaman', 'Biswas', '2023-12-24 04:33:02', '2023-12-24 04:33:02'),
(5, 'Jasim', 'Khan', '2023-12-24 04:36:22', '2023-12-24 04:36:22'),
(6, 'Zulkar Nain', 'zulakar@gmail.com', '2023-12-24 06:13:43', '2023-12-24 06:13:43'),
(7, 'Hasan Iqubal', 'basan@gmail.com', '2023-12-24 07:26:03', '2023-12-24 07:26:03'),
(8, 'Liza', 'liza@gmail.com', '2023-12-24 07:28:19', '2023-12-24 07:28:19'),
(9, 'Ostad Team', 'info@ostad.app', '2023-12-24 07:29:05', '2023-12-24 07:29:05'),
(10, 'Akhi', 'akhi@gmail.com', '2023-12-24 13:40:00', '2023-12-24 13:40:00'),
(11, 'Jon Lex', 'jonlex@gmail.com', '2023-12-25 02:23:01', '2023-12-25 02:23:01'),
(12, 'Golam Kill', 'gool@mail.com', '2023-12-25 04:38:21', '2023-12-25 04:38:21');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` bigint UNSIGNED NOT NULL,
  `origin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` decimal(8,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `origin`, `destination`, `distance`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka', 'Cox\'s Bazaar', 397.60, 1, '2023-12-22 03:38:12', '2023-12-23 05:49:29'),
(5, 'Dhaka', 'India', 1465.10, 1, '2023-12-22 15:02:42', '2023-12-22 15:08:19'),
(6, 'Khulna', 'Jashore', 60.00, 1, '2023-12-23 07:18:56', '2023-12-23 07:18:56'),
(7, 'Cox\'s Bazaar', 'Dhaka', NULL, 1, '2023-12-25 02:54:51', '2023-12-25 02:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `sub_routes`
--

CREATE TABLE `sub_routes` (
  `id` bigint UNSIGNED NOT NULL,
  `trip_id` bigint UNSIGNED NOT NULL,
  `origin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` decimal(8,2) DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_routes`
--

INSERT INTO `sub_routes` (`id`, `trip_id`, `origin`, `destination`, `distance`, `departure_time`, `arrival_time`, `price`) VALUES
(3, 10, 'Noapara', 'India', 120.00, '17:29:00', NULL, 1200.00),
(8, 1, 'Comilla', 'Cox\'s Bazaar', 294.50, '07:00:00', '01:00:00', 1000.00),
(9, 1, 'Chittagong', 'Cox\'s Bazaar', 145.50, '22:00:00', '13:00:00', 800.00),
(10, 12, 'Cox\'s Bazaar', 'Comilla', NULL, NULL, NULL, 1000.00),
(11, 12, 'Cox\'s Bazaar', 'Chittagong', NULL, NULL, NULL, 800.00);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `passenger_id` bigint UNSIGNED NOT NULL,
  `trip_id` bigint UNSIGNED NOT NULL,
  `sub_route_id` bigint UNSIGNED DEFAULT NULL,
  `ticket_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seat_number` int NOT NULL,
  `booking_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `passenger_id`, `trip_id`, `sub_route_id`, `ticket_number`, `seat_number`, `booking_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, '1703423657', 5, '2023-12-24', '2023-12-24 16:11:48', '2023-12-24 16:11:48'),
(2, 1, 1, NULL, '1703423657', 6, '2023-12-24', '2023-12-23 16:11:48', '2023-12-23 16:11:48'),
(3, 2, 1, 9, '1703423658', 7, '2023-12-24', '2023-12-23 16:11:48', '2023-12-23 16:11:48'),
(4, 3, 1, NULL, '1703423659', 17, '2023-12-24', '2023-12-24 03:47:39', '2023-12-24 03:47:39'),
(5, 3, 1, NULL, '1703423659', 18, '2023-12-24', '2023-12-24 03:47:39', '2023-12-24 03:47:39'),
(6, 3, 1, NULL, '1703423659', 20, '2023-12-24', '2023-12-24 03:48:57', '2023-12-24 03:48:57'),
(7, 4, 1, NULL, '1703423700', 1, '2023-12-24', '2023-12-24 04:33:02', '2023-12-24 04:33:02'),
(8, 4, 1, NULL, '1703423700', 2, '2023-12-24', '2023-12-24 04:33:02', '2023-12-24 04:33:02'),
(9, 5, 10, NULL, '1703423701', 9, '2023-12-26', '2023-12-24 04:36:22', '2023-12-24 04:36:22'),
(10, 5, 10, NULL, '1703423701', 10, '2023-12-26', '2023-12-24 04:36:22', '2023-12-24 04:36:22'),
(11, 6, 1, 9, '1703423702', 27, '2023-12-24', '2023-12-24 06:13:43', '2023-12-24 06:13:43'),
(12, 6, 1, 9, '1703423702', 28, '2023-12-24', '2023-12-24 06:13:43', '2023-12-24 06:13:43'),
(13, 7, 1, 8, '1703424363', 3, '2023-12-24', '2023-12-24 07:26:03', '2023-12-24 07:26:03'),
(14, 8, 1, 8, '1703424499', 4, '2023-12-24', '2023-12-24 07:28:19', '2023-12-24 07:28:19'),
(15, 9, 1, NULL, '1703424545', 21, '2023-12-24', '2023-12-24 07:29:05', '2023-12-24 07:29:05'),
(16, 9, 1, NULL, '1703424545', 22, '2023-12-24', '2023-12-24 07:29:05', '2023-12-24 07:29:05'),
(17, 9, 1, NULL, '1703424545', 25, '2023-12-24', '2023-12-24 07:29:05', '2023-12-24 07:29:05'),
(18, 9, 1, NULL, '1703424545', 26, '2023-12-24', '2023-12-24 07:29:05', '2023-12-24 07:29:05'),
(19, 9, 1, NULL, '1703424545', 29, '2023-12-24', '2023-12-24 07:29:05', '2023-12-24 07:29:05'),
(20, 9, 1, NULL, '1703424545', 30, '2023-12-24', '2023-12-24 07:29:05', '2023-12-24 07:29:05'),
(21, 9, 1, NULL, '1703424545', 33, '2023-12-24', '2023-12-24 07:29:05', '2023-12-24 07:29:05'),
(22, 9, 1, NULL, '1703424545', 34, '2023-12-24', '2023-12-24 07:29:05', '2023-12-24 07:29:05'),
(23, 10, 1, NULL, '1703446800', 35, '2023-12-24', '2023-12-24 13:40:00', '2023-12-24 13:40:00'),
(24, 10, 1, NULL, '1703446800', 36, '2023-12-24', '2023-12-24 13:40:00', '2023-12-24 13:40:00'),
(25, 11, 1, NULL, '1703492581', 9, '2023-12-25', '2023-12-25 02:23:01', '2023-12-25 02:23:01'),
(26, 11, 1, NULL, '1703492581', 10, '2023-12-25', '2023-12-25 02:23:01', '2023-12-25 02:23:01'),
(27, 11, 1, NULL, '1703492581', 11, '2023-12-25', '2023-12-25 02:23:01', '2023-12-25 02:23:01'),
(28, 11, 1, NULL, '1703492581', 12, '2023-12-25', '2023-12-25 02:23:01', '2023-12-25 02:23:01'),
(29, 12, 12, NULL, '1703500701', 13, '2023-12-26', '2023-12-25 04:38:21', '2023-12-25 04:38:21'),
(30, 12, 12, NULL, '1703500701', 14, '2023-12-26', '2023-12-25 04:38:21', '2023-12-25 04:38:21');

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` bigint UNSIGNED NOT NULL,
  `bus_id` bigint UNSIGNED NOT NULL,
  `route_id` bigint UNSIGNED NOT NULL,
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `days` set('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `bus_id`, `route_id`, `departure_time`, `arrival_time`, `days`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '05:00:00', '13:00:00', 'Sunday,Monday,Tuesday', 1200.00, 1, '2023-12-22 04:43:14', '2023-12-25 03:44:33'),
(10, 2, 5, '16:00:00', '16:00:00', 'Friday', 600.00, 0, '2023-12-23 04:59:10', '2023-12-25 03:45:30'),
(11, 2, 6, '19:00:00', '20:30:00', 'Monday,Tuesday,Wednesday', 600.00, 1, '2023-12-23 07:19:31', '2023-12-23 09:54:43'),
(12, 1, 7, '13:00:00', '20:00:00', 'Sunday,Monday,Tuesday', NULL, 1, '2023-12-25 03:43:09', '2023-12-25 03:43:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Md. Chanchal Biswas', 'admin@gmail.com', '2023-12-22 02:23:46', '$2y$12$xyXutEMTAdVUqfokHqHmqevCHQDQcrk3r5SQwhwT3PJ8M9OlGaD0S', 'c82sNTXa4W', '2023-12-22 02:23:46', '2023-12-22 02:23:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_or_phone` (`email_or_phone`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_routes`
--
ALTER TABLE `sub_routes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_routes_trip_id_foreign` (`trip_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_passenger_id_foreign` (`passenger_id`),
  ADD KEY `tickets_trip_id_foreign` (`trip_id`),
  ADD KEY `tickets_sub_route_id_foreign` (`sub_route_id`),
  ADD KEY `ticket_number` (`ticket_number`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trips_bus_id_foreign` (`bus_id`),
  ADD KEY `trips_route_id_foreign` (`route_id`);

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
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `passengers`
--
ALTER TABLE `passengers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sub_routes`
--
ALTER TABLE `sub_routes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sub_routes`
--
ALTER TABLE `sub_routes`
  ADD CONSTRAINT `sub_routes_trip_id_foreign` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_passenger_id_foreign` FOREIGN KEY (`passenger_id`) REFERENCES `passengers` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_sub_route_id_foreign` FOREIGN KEY (`sub_route_id`) REFERENCES `sub_routes` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_trip_id_foreign` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `trips`
--
ALTER TABLE `trips`
  ADD CONSTRAINT `trips_bus_id_foreign` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `trips_route_id_foreign` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
