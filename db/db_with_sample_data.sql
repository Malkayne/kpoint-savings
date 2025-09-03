-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 31, 2025 at 12:55 AM
-- Server version: 11.4.8-MariaDB-cll-lve-log
-- PHP Version: 8.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;

--
-- Database: `intepkvx_kpoint_newdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
    `id` int(11) NOT NULL,
    `name` varchar(100) NOT NULL,
    `username` varchar(50) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(255) NOT NULL,
    `image` varchar(255) DEFAULT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO
    `admins` (
        `id`,
        `name`,
        `username`,
        `email`,
        `password`,
        `image`,
        `created_at`
    )
VALUES (
        1,
        'Kayode Owoseni',
        'malkayne',
        'lock3@admin.com',
        '$2y$10$CCgWbp1PSY6oe0ejFYyNC.MZjmNfrlC3tgaNbAJAhx3dQIVNWHc7C',
        NULL,
        '2025-07-15 21:57:27'
    ),
    (
        2,
        'Admin One',
        'kpoint',
        'lock@admin.com',
        '$2y$10$kvxz6uy21LCawZxHGoRnMu5nK1h4J11ab4GpMwwGyNRhz3FUvD0G2',
        NULL,
        '2025-07-16 01:09:12'
    ),
    (
        3,
        'Admin Two',
        'admin2',
        'lock2@admin.com',
        '$2y$10$ZqN9nN/M6NW7DC1oUnEj7uYFF9FbOh8W5A7E0HEUo5o5r3pb5yKqW',
        NULL,
        '2025-07-16 01:09:12'
    );

-- --------------------------------------------------------

--
-- Table structure for table `contributions`
--

CREATE TABLE `contributions` (
    `id` int(11) NOT NULL,
    `plan_id` int(11) NOT NULL,
    `amount` decimal(10, 2) NOT NULL,
    `description` text DEFAULT NULL,
    `contributed_on` date DEFAULT(curdate()),
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `contributions`
--

INSERT INTO
    `contributions` (
        `id`,
        `plan_id`,
        `amount`,
        `description`,
        `contributed_on`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        1,
        500.00,
        NULL,
        '2025-07-16',
        '2025-07-16 01:09:12',
        '2025-07-17 17:37:04'
    ),
    (
        2,
        1,
        500.00,
        NULL,
        '2025-07-17',
        '2025-07-16 01:09:12',
        '2025-07-17 17:37:04'
    ),
    (
        3,
        2,
        750.00,
        NULL,
        '2025-07-16',
        '2025-07-16 01:09:12',
        '2025-07-17 17:37:04'
    ),
    (
        5,
        4,
        20.00,
        NULL,
        '2025-07-17',
        '2025-07-17 22:25:03',
        '2025-07-17 22:25:03'
    ),
    (
        6,
        6,
        1500.00,
        NULL,
        '2025-07-27',
        '2025-07-28 01:08:19',
        '2025-07-28 01:08:19'
    ),
    (
        7,
        6,
        1500.00,
        NULL,
        '2025-07-28',
        '2025-07-28 01:16:53',
        '2025-07-28 01:16:53'
    ),
    (
        8,
        6,
        1500.00,
        NULL,
        '2025-07-29',
        '2025-07-28 01:19:29',
        '2025-07-28 01:19:29'
    ),
    (
        9,
        6,
        1500.00,
        NULL,
        '2025-07-30',
        '2025-07-28 01:19:35',
        '2025-07-28 01:19:35'
    ),
    (
        10,
        1,
        500.00,
        NULL,
        '2025-08-05',
        '2025-08-05 10:28:31',
        '2025-08-05 10:28:31'
    ),
    (
        11,
        1,
        500.00,
        NULL,
        '2025-07-19',
        '2025-08-05 10:30:59',
        '2025-08-05 10:30:59'
    ),
    (
        12,
        1,
        500.00,
        NULL,
        '2025-07-18',
        '2025-08-05 10:31:51',
        '2025-08-05 10:31:51'
    ),
    (
        13,
        1,
        500.00,
        NULL,
        '2025-07-21',
        '2025-08-05 10:32:43',
        '2025-08-05 10:32:43'
    ),
    (
        15,
        9,
        1000.00,
        NULL,
        '2025-08-05',
        '2025-08-05 21:18:18',
        '2025-08-05 21:18:18'
    ),
    (
        16,
        9,
        1000.00,
        NULL,
        '2025-08-07',
        '2025-08-05 21:18:48',
        '2025-08-05 21:18:48'
    ),
    (
        17,
        9,
        1000.00,
        NULL,
        '2025-08-08',
        '2025-08-05 21:19:25',
        '2025-08-05 21:19:25'
    ),
    (
        18,
        10,
        1000.00,
        NULL,
        '2025-08-06',
        '2025-08-07 02:57:12',
        '2025-08-07 02:57:12'
    ),
    (
        19,
        10,
        1000.00,
        NULL,
        '2025-08-08',
        '2025-08-07 03:11:26',
        '2025-08-07 03:11:26'
    ),
    (
        20,
        10,
        1000.00,
        NULL,
        '2025-08-07',
        '2025-08-07 03:12:24',
        '2025-08-07 03:12:24'
    ),
    (
        21,
        10,
        1000.00,
        NULL,
        '2025-08-09',
        '2025-08-07 03:14:13',
        '2025-08-07 03:14:13'
    ),
    (
        22,
        10,
        1000.00,
        NULL,
        '2025-08-14',
        '2025-08-07 03:15:36',
        '2025-08-07 03:15:36'
    ),
    (
        23,
        10,
        1000.00,
        NULL,
        '2025-08-15',
        '2025-08-07 03:16:30',
        '2025-08-07 03:16:30'
    ),
    (
        24,
        10,
        1000.00,
        NULL,
        '2025-08-19',
        '2025-08-07 03:17:23',
        '2025-08-07 03:17:23'
    ),
    (
        25,
        11,
        200.00,
        NULL,
        '2025-08-06',
        '2025-08-07 03:20:45',
        '2025-08-07 03:20:45'
    ),
    (
        26,
        11,
        200.00,
        NULL,
        '2025-08-07',
        '2025-08-07 03:21:14',
        '2025-08-07 03:21:14'
    ),
    (
        62,
        19,
        1000.00,
        NULL,
        '2025-08-09',
        '2025-08-09 10:45:23',
        '2025-08-09 10:45:23'
    ),
    (
        63,
        19,
        1000.00,
        NULL,
        '2025-08-10',
        '2025-08-09 10:45:31',
        '2025-08-09 10:45:31'
    ),
    (
        64,
        19,
        1000.00,
        NULL,
        '2025-08-11',
        '2025-08-09 10:48:20',
        '2025-08-09 10:48:20'
    ),
    (
        65,
        19,
        1000.00,
        NULL,
        '2025-08-12',
        '2025-08-09 11:09:10',
        '2025-08-09 11:09:10'
    ),
    (
        66,
        20,
        1000.00,
        NULL,
        '2025-08-10',
        '2025-08-10 14:37:33',
        '2025-08-10 14:37:33'
    ),
    (
        67,
        20,
        1000.00,
        NULL,
        '2025-08-11',
        '2025-08-10 14:37:40',
        '2025-08-10 14:37:40'
    ),
    (
        68,
        20,
        1000.00,
        NULL,
        '2025-08-12',
        '2025-08-10 14:37:45',
        '2025-08-10 14:37:45'
    ),
    (
        69,
        21,
        1000.00,
        NULL,
        '2025-08-12',
        '2025-08-12 11:53:26',
        '2025-08-12 11:53:26'
    ),
    (
        70,
        21,
        1000.00,
        NULL,
        '2025-08-14',
        '2025-08-12 11:53:58',
        '2025-08-12 11:53:58'
    ),
    (
        71,
        1,
        500.00,
        NULL,
        '2025-08-14',
        '2025-08-14 14:58:44',
        '2025-08-14 14:58:44'
    ),
    (
        72,
        22,
        700.00,
        NULL,
        '2025-08-14',
        '2025-08-14 15:10:23',
        '2025-08-14 15:10:23'
    ),
    (
        73,
        23,
        1000.00,
        NULL,
        '2025-08-14',
        '2025-08-14 15:58:33',
        '2025-08-14 15:58:33'
    ),
    (
        74,
        23,
        1000.00,
        NULL,
        '2025-08-15',
        '2025-08-14 15:58:39',
        '2025-08-14 15:58:39'
    ),
    (
        75,
        23,
        1000.00,
        NULL,
        '2025-08-16',
        '2025-08-14 15:58:44',
        '2025-08-14 15:58:44'
    ),
    (
        76,
        23,
        1000.00,
        NULL,
        '2025-08-17',
        '2025-08-14 15:58:51',
        '2025-08-14 15:58:51'
    ),
    (
        77,
        23,
        1000.00,
        NULL,
        '2025-08-18',
        '2025-08-14 15:58:56',
        '2025-08-14 15:58:56'
    ),
    (
        78,
        21,
        1000.00,
        NULL,
        '2025-08-13',
        '2025-08-14 16:08:21',
        '2025-08-14 16:08:21'
    ),
    (
        79,
        22,
        700.00,
        NULL,
        '2025-08-15',
        '2025-08-14 16:11:27',
        '2025-08-14 16:11:27'
    ),
    (
        80,
        22,
        700.00,
        NULL,
        '2025-08-18',
        '2025-08-14 16:17:43',
        '2025-08-14 16:17:43'
    ),
    (
        81,
        10,
        1000.00,
        NULL,
        '2025-08-10',
        '2025-08-14 16:19:05',
        '2025-08-14 16:19:05'
    ),
    (
        82,
        24,
        1000.00,
        NULL,
        '2025-08-14',
        '2025-08-14 20:22:42',
        '2025-08-14 20:22:42'
    ),
    (
        83,
        24,
        1000.00,
        NULL,
        '2025-08-15',
        '2025-08-14 20:22:51',
        '2025-08-14 20:22:51'
    ),
    (
        84,
        24,
        1000.00,
        NULL,
        '2025-08-16',
        '2025-08-14 20:23:23',
        '2025-08-14 20:23:23'
    ),
    (
        85,
        25,
        500.00,
        NULL,
        '2025-08-14',
        '2025-08-14 20:28:37',
        '2025-08-14 20:28:37'
    ),
    (
        86,
        25,
        500.00,
        NULL,
        '2025-08-15',
        '2025-08-14 20:28:43',
        '2025-08-14 20:28:43'
    ),
    (
        87,
        25,
        500.00,
        NULL,
        '2025-08-16',
        '2025-08-14 20:29:10',
        '2025-08-14 20:29:10'
    );

-- --------------------------------------------------------

--
-- Table structure for table `contribution_plans`
--

CREATE TABLE `contribution_plans` (
    `id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `rep_id` int(11) NOT NULL,
    `title` varchar(100) NOT NULL,
    `amount` decimal(10, 2) NOT NULL,
    `description` text DEFAULT NULL,
    `duration` int(11) NOT NULL,
    `start_date` date DEFAULT(curdate()),
    `status` enum(
        'active',
        'completed',
        'broken'
    ) DEFAULT 'active',
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `contribution_plans`
--

INSERT INTO
    `contribution_plans` (
        `id`,
        `user_id`,
        `rep_id`,
        `title`,
        `amount`,
        `description`,
        `duration`,
        `start_date`,
        `status`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        1,
        1,
        'Monthly Savings Plan',
        500.00,
        'Monthly contribution for savings',
        31,
        '2025-07-16',
        'active',
        '2025-07-16 01:09:12',
        '2025-08-03 05:13:23'
    ),
    (
        2,
        2,
        2,
        'Quarterly Business Fund',
        750.00,
        'Funding for small business growth',
        3,
        '2025-07-16',
        'active',
        '2025-07-16 01:09:12',
        '2025-07-17 17:36:19'
    ),
    (
        3,
        4,
        1,
        'Monthly Ajo',
        1000.00,
        'Kayode\'s salary savings',
        30,
        '2025-07-17',
        'active',
        '2025-07-17 21:38:32',
        '2025-07-17 21:38:32'
    ),
    (
        4,
        4,
        1,
        'Sample Weekly Plan',
        20.00,
        'Sample Weekly Plan',
        31,
        '2025-07-17',
        'active',
        '2025-07-17 22:24:04',
        '2025-08-05 01:29:04'
    ),
    (
        5,
        6,
        5,
        'Christmas',
        1000.00,
        'this is for christmas goat',
        30,
        '2025-07-27',
        'active',
        '2025-07-28 01:04:49',
        '2025-07-28 01:04:49'
    ),
    (
        6,
        7,
        5,
        'End of year saving',
        1500.00,
        'end of year party savings',
        60,
        '2025-07-27',
        'active',
        '2025-07-28 01:06:21',
        '2025-07-28 01:20:08'
    ),
    (
        7,
        10,
        1,
        'Food stuff',
        1000.00,
        NULL,
        365,
        '2025-08-05',
        'broken',
        '2025-08-05 10:34:45',
        '2025-08-05 10:42:38'
    ),
    (
        8,
        5,
        1,
        'jan',
        1000.00,
        NULL,
        31,
        '2025-08-05',
        'broken',
        '2025-08-05 21:09:36',
        '2025-08-05 22:43:45'
    ),
    (
        9,
        5,
        1,
        'feb',
        1000.00,
        NULL,
        31,
        '2025-08-05',
        'broken',
        '2025-08-05 21:10:08',
        '2025-08-05 22:45:30'
    ),
    (
        10,
        5,
        1,
        'plans',
        1000.00,
        NULL,
        62,
        '2025-08-06',
        'active',
        '2025-08-07 02:56:33',
        '2025-08-07 02:56:33'
    ),
    (
        11,
        5,
        1,
        'food',
        200.00,
        NULL,
        2,
        '2025-08-06',
        'completed',
        '2025-08-07 03:20:00',
        '2025-08-07 03:21:14'
    ),
    (
        12,
        5,
        1,
        'Game',
        500.00,
        NULL,
        5,
        '2025-08-07',
        'broken',
        '2025-08-07 16:39:57',
        '2025-08-08 22:48:34'
    ),
    (
        19,
        5,
        1,
        'Buy',
        1000.00,
        NULL,
        5,
        '2025-08-09',
        'broken',
        '2025-08-09 10:44:51',
        '2025-08-09 11:19:10'
    ),
    (
        20,
        5,
        1,
        'Page',
        1000.00,
        NULL,
        3,
        '2025-08-10',
        'completed',
        '2025-08-10 14:37:16',
        '2025-08-10 14:37:45'
    ),
    (
        21,
        5,
        1,
        'Food stuff',
        1000.00,
        NULL,
        3,
        '2025-08-12',
        'completed',
        '2025-08-12 11:53:13',
        '2025-08-14 16:08:21'
    ),
    (
        22,
        13,
        1,
        'dev test',
        700.00,
        'this is devafo test plan',
        30,
        '2025-08-14',
        'active',
        '2025-08-14 15:09:42',
        '2025-08-14 15:09:42'
    ),
    (
        23,
        5,
        1,
        'Food stuff',
        1000.00,
        NULL,
        5,
        '2025-08-14',
        'completed',
        '2025-08-14 15:58:20',
        '2025-08-14 15:58:56'
    ),
    (
        24,
        5,
        1,
        'dj',
        1000.00,
        NULL,
        5,
        '2025-08-14',
        'active',
        '2025-08-14 20:22:26',
        '2025-08-14 20:22:26'
    ),
    (
        25,
        5,
        1,
        'stuff',
        500.00,
        NULL,
        5,
        '2025-08-14',
        'active',
        '2025-08-14 20:28:22',
        '2025-08-14 20:28:22'
    );

-- --------------------------------------------------------

--
-- Table structure for table `manual_funding_requests`
--

CREATE TABLE `manual_funding_requests` (
    `id` bigint(20) UNSIGNED NOT NULL,
    `user_id` bigint(20) UNSIGNED NOT NULL,
    `amount` decimal(15, 2) NOT NULL,
    `proof_of_payment` varchar(255) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = MyISAM DEFAULT CHARSET = latin1 COLLATE = latin1_swedish_ci;

--
-- Dumping data for table `manual_funding_requests`
--

INSERT INTO
    `manual_funding_requests` (
        `id`,
        `user_id`,
        `amount`,
        `proof_of_payment`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        1,
        3000.00,
        'manual_funding_proofs/688fb31d5b459.jpeg',
        '2025-08-03 23:06:05',
        '2025-08-03 23:06:05'
    ),
    (
        2,
        5,
        2000.00,
        'manual_funding_proofs/689440c855528.jpg',
        '2025-08-07 09:59:36',
        '2025-08-07 09:59:36'
    );

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
    `id` int(10) UNSIGNED NOT NULL,
    `migration` varchar(255) NOT NULL,
    `batch` int(11) NOT NULL
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
    `id` int(10) UNSIGNED NOT NULL,
    `email` varchar(255) NOT NULL,
    `token` varchar(255) NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = MyISAM DEFAULT CHARSET = latin1 COLLATE = latin1_swedish_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO
    `password_resets` (
        `id`,
        `email`,
        `token`,
        `created_at`,
        `updated_at`
    )
VALUES (
        2,
        'kpoint.ng@gmail.com',
        'wrgUMn48xV9VMQIYzW5FmFWkzvDbSXlVIP9L6Sor9KIJDJeJ9VsSdv2dVtKYiYt5',
        '2025-08-09 02:01:40',
        NULL
    ),
    (
        3,
        'oberechukwuemeka@gmail.com',
        'WlOTLtM50Qpfn6NM2rvYqXwT0VH8Q8e8sr4WawfsNkrMdtVfo1YMrnPy7lMnkgJx',
        '2025-08-09 11:06:04',
        NULL
    ),
    (
        4,
        'salawuhamid96@gmail.com',
        'FDlV0z3d1uJ9ccdCpPFR3kcTxuiNkJHtymhsVa3fwX6ggdPy59AiEWSOxyGV7a4k',
        '2025-08-09 11:04:18',
        NULL
    );

-- --------------------------------------------------------

--
-- Table structure for table `reps`
--

CREATE TABLE `reps` (
    `id` int(11) NOT NULL,
    `name` varchar(100) NOT NULL,
    `username` varchar(50) NOT NULL,
    `wallet_balance` decimal(12, 2) DEFAULT 0.00,
    `email` varchar(100) NOT NULL,
    `phone` varchar(20) DEFAULT NULL,
    `image` varchar(255) DEFAULT NULL,
    `status` enum('active', 'inactive') DEFAULT 'active',
    `password` varchar(255) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `reps`
--

INSERT INTO
    `reps` (
        `id`,
        `name`,
        `username`,
        `wallet_balance`,
        `email`,
        `phone`,
        `image`,
        `status`,
        `password`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        'local chairman',
        'sample',
        0.00,
        'rep1@gmail.com',
        '09012345678',
        NULL,
        'active',
        '$2y$10$uiAq0yu6uAQKGk.TyUZHYeelGE15wJ0zDmHFjMMZpaqJoyg6Y8eoy',
        '2025-07-15 23:13:45',
        '2025-07-17 21:27:03'
    ),
    (
        2,
        'Rep One',
        'rep1',
        5000.00,
        'rep1@example.com',
        '08011111111',
        NULL,
        'active',
        '$2y$10$CU.ExxrwP.C39Y73/N7JqeSU1FEMoh3ATLx4ouWNDF8c5YRXrLJKW',
        '2025-07-16 01:09:12',
        '2025-07-17 13:07:17'
    ),
    (
        4,
        'Olowo Adeyeye',
        'rep3',
        0.00,
        'rep3@gmail.com',
        '09087654321',
        NULL,
        'active',
        '$2y$10$zN0A30iSVjiUJVYAKkFaIuTkAxiFLf9l8pwSfN80wtKt4wE58x5T2',
        '2025-07-17 13:03:43',
        '2025-07-17 13:06:36'
    ),
    (
        5,
        'mr ajala',
        'ajala1',
        0.00,
        'ajala@kpointsavings.com',
        '+1 (896) 435-4858',
        NULL,
        'active',
        '$2y$10$pbezrxTYp4D4C0oTUrL42egnWc1UyBgGnA96jI21JLAHyBHR26mum',
        '2025-07-28 00:56:53',
        '2025-07-28 00:56:53'
    ),
    (
        6,
        'obere faith',
        'nice',
        0.00,
        'obereemeka99@gmail.com',
        '08166618178',
        NULL,
        'active',
        '$2y$10$Y/jHAPqiyCGokZTafhl9peekpfL4o86OezcLg7qsn4cYIqHqUgFCG',
        '2025-08-04 10:41:31',
        '2025-08-04 10:41:31'
    );

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
    `id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `rep_id` int(11) DEFAULT NULL,
    `plan_id` int(11) DEFAULT NULL,
    `wallet_type` enum('savings', 'business', 'user') NOT NULL,
    `type` enum('credit', 'debit') NOT NULL,
    `amount` decimal(12, 2) NOT NULL,
    `description` text DEFAULT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO
    `transactions` (
        `id`,
        `user_id`,
        `rep_id`,
        `plan_id`,
        `wallet_type`,
        `type`,
        `amount`,
        `description`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        1,
        1,
        1,
        'savings',
        'credit',
        500.00,
        'Initial deposit',
        '2025-07-16 01:09:12',
        '2025-07-17 17:37:53'
    ),
    (
        2,
        2,
        2,
        2,
        'savings',
        'credit',
        750.00,
        'First contribution',
        '2025-07-16 01:09:12',
        '2025-07-17 17:37:53'
    ),
    (
        3,
        1,
        1,
        NULL,
        'user',
        'debit',
        200.00,
        'Transfer to another wallet',
        '2025-07-16 01:09:12',
        '2025-07-17 17:37:53'
    ),
    (
        4,
        4,
        1,
        4,
        'user',
        'credit',
        20.00,
        'frt gtyu',
        '2025-07-17 22:25:03',
        '2025-07-17 22:25:03'
    ),
    (
        5,
        7,
        5,
        6,
        'user',
        'credit',
        1500.00,
        'Contribution for plan: End of year saving',
        '2025-07-28 01:08:19',
        '2025-07-28 01:08:19'
    ),
    (
        6,
        7,
        NULL,
        NULL,
        'savings',
        'credit',
        500.00,
        NULL,
        '2025-07-28 02:23:07',
        '2025-07-28 02:23:07'
    ),
    (
        7,
        10,
        NULL,
        NULL,
        'savings',
        'credit',
        10000.00,
        NULL,
        '2025-08-04 11:52:37',
        '2025-08-04 11:52:37'
    ),
    (
        8,
        10,
        NULL,
        NULL,
        'savings',
        'credit',
        10000.00,
        NULL,
        '2025-08-04 11:59:45',
        '2025-08-04 11:59:45'
    ),
    (
        9,
        5,
        NULL,
        NULL,
        'savings',
        'credit',
        10000.00,
        NULL,
        '2025-08-04 12:05:51',
        '2025-08-04 12:05:51'
    ),
    (
        10,
        11,
        6,
        NULL,
        'user',
        'credit',
        1999.00,
        NULL,
        '2025-08-04 11:16:01',
        '2025-08-04 11:16:01'
    ),
    (
        11,
        1,
        1,
        1,
        'user',
        'credit',
        500.00,
        'Contribution for plan: Monthly Savings Plan',
        '2025-08-05 10:28:31',
        '2025-08-05 10:28:31'
    ),
    (
        12,
        10,
        1,
        7,
        'user',
        'credit',
        1000.00,
        'Contribution for plan: Food stuff',
        '2025-08-05 10:35:51',
        '2025-08-05 10:35:51'
    ),
    (
        13,
        5,
        1,
        9,
        'user',
        'credit',
        1000.00,
        'Contribution for plan: feb',
        '2025-08-05 21:18:18',
        '2025-08-05 21:18:18'
    ),
    (
        14,
        5,
        NULL,
        NULL,
        'savings',
        'credit',
        1000.00,
        NULL,
        '2025-08-05 23:17:35',
        '2025-08-05 23:17:35'
    ),
    (
        15,
        5,
        NULL,
        NULL,
        'savings',
        'credit',
        1000.00,
        NULL,
        '2025-08-05 23:19:07',
        '2025-08-05 23:19:07'
    ),
    (
        16,
        5,
        NULL,
        NULL,
        'savings',
        'credit',
        1000.00,
        NULL,
        '2025-08-05 23:20:21',
        '2025-08-05 23:20:21'
    ),
    (
        17,
        5,
        NULL,
        NULL,
        'savings',
        'credit',
        1000.00,
        NULL,
        '2025-08-05 23:30:16',
        '2025-08-05 23:30:16'
    ),
    (
        18,
        5,
        1,
        NULL,
        'user',
        'debit',
        1000.00,
        NULL,
        '2025-08-05 22:53:47',
        '2025-08-05 22:53:47'
    ),
    (
        19,
        5,
        1,
        10,
        'user',
        'credit',
        1000.00,
        'Contribution for plan: plans',
        '2025-08-07 02:57:12',
        '2025-08-07 02:57:12'
    ),
    (
        20,
        5,
        1,
        11,
        'user',
        'credit',
        200.00,
        'Contribution for plan: food',
        '2025-08-07 03:20:45',
        '2025-08-07 03:20:45'
    ),
    (
        21,
        5,
        1,
        12,
        'user',
        'credit',
        500.00,
        'Contribution for plan: Game',
        '2025-08-07 16:40:18',
        '2025-08-07 16:40:18'
    ),
    (
        22,
        5,
        NULL,
        NULL,
        'savings',
        'credit',
        17000.00,
        NULL,
        '2025-08-07 18:05:22',
        '2025-08-07 18:05:22'
    ),
    (
        23,
        5,
        1,
        NULL,
        'user',
        'debit',
        1700.00,
        NULL,
        '2025-08-07 17:07:36',
        '2025-08-07 17:07:36'
    ),
    (
        24,
        5,
        1,
        NULL,
        'user',
        'credit',
        10000.00,
        NULL,
        '2025-08-07 17:12:12',
        '2025-08-07 17:12:12'
    ),
    (
        25,
        5,
        NULL,
        NULL,
        'savings',
        'credit',
        10000.00,
        NULL,
        '2025-08-09 02:42:18',
        '2025-08-09 02:42:18'
    ),
    (
        26,
        5,
        1,
        NULL,
        'user',
        'credit',
        2000.00,
        NULL,
        '2025-08-09 02:11:03',
        '2025-08-09 02:11:03'
    ),
    (
        27,
        5,
        1,
        NULL,
        'user',
        'debit',
        12000.00,
        NULL,
        '2025-08-09 02:12:07',
        '2025-08-09 02:12:07'
    ),
    (
        28,
        5,
        1,
        20,
        'user',
        'credit',
        1000.00,
        'Contribution for plan: Page',
        '2025-08-10 14:37:33',
        '2025-08-10 14:37:33'
    ),
    (
        29,
        1,
        1,
        1,
        'user',
        'credit',
        500.00,
        'Contribution for plan: Monthly Savings Plan',
        '2025-08-14 14:58:44',
        '2025-08-14 14:58:44'
    ),
    (
        30,
        13,
        1,
        22,
        'user',
        'credit',
        700.00,
        'Contribution for plan: dev test',
        '2025-08-14 15:10:23',
        '2025-08-14 15:10:23'
    ),
    (
        31,
        13,
        1,
        22,
        'user',
        'credit',
        700.00,
        'Contribution for plan: dev test',
        '2025-08-14 16:17:43',
        '2025-08-14 16:17:43'
    ),
    (
        32,
        5,
        1,
        10,
        'user',
        'credit',
        1000.00,
        'Contribution for plan: plans',
        '2025-08-14 16:19:05',
        '2025-08-14 16:19:05'
    ),
    (
        33,
        5,
        1,
        24,
        'user',
        'credit',
        1000.00,
        'Contribution for plan: dj',
        '2025-08-14 20:22:42',
        '2025-08-14 20:22:42'
    ),
    (
        34,
        5,
        1,
        24,
        'user',
        'credit',
        1000.00,
        'Contribution for plan: dj',
        '2025-08-14 20:22:51',
        '2025-08-14 20:22:51'
    ),
    (
        35,
        5,
        1,
        24,
        'user',
        'credit',
        1000.00,
        'Contribution for plan: dj',
        '2025-08-14 20:23:23',
        '2025-08-14 20:23:23'
    ),
    (
        36,
        5,
        1,
        25,
        'user',
        'credit',
        500.00,
        'Contribution for plan: stuff',
        '2025-08-14 20:28:37',
        '2025-08-14 20:28:37'
    ),
    (
        37,
        5,
        1,
        25,
        'user',
        'credit',
        500.00,
        'Contribution for plan: stuff',
        '2025-08-14 20:28:43',
        '2025-08-14 20:28:43'
    ),
    (
        38,
        5,
        1,
        25,
        'user',
        'credit',
        500.00,
        'Contribution for plan: stuff',
        '2025-08-14 20:29:10',
        '2025-08-14 20:29:10'
    ),
    (
        39,
        5,
        1,
        NULL,
        'user',
        'debit',
        2000.00,
        NULL,
        '2025-08-14 20:31:23',
        '2025-08-14 20:31:23'
    ),
    (
        40,
        5,
        1,
        NULL,
        'user',
        'credit',
        2000.00,
        NULL,
        '2025-08-14 20:32:00',
        '2025-08-14 20:32:00'
    );

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
    `id` int(11) NOT NULL,
    `name` varchar(100) NOT NULL,
    `username` varchar(50) NOT NULL,
    `email` varchar(100) DEFAULT NULL,
    `accNum` varchar(20) NOT NULL,
    `wallet_balance` decimal(12, 2) DEFAULT 0.00,
    `phone` varchar(20) DEFAULT NULL,
    `profession` varchar(100) DEFAULT NULL,
    `education` varchar(100) DEFAULT NULL,
    `address` text NOT NULL,
    `dob` date DEFAULT NULL,
    `image` varchar(255) DEFAULT NULL,
    `status` enum('active', 'inactive') DEFAULT 'active',
    `nok_name` varchar(100) NOT NULL,
    `nok_phone` varchar(20) NOT NULL,
    `nok_relationship` varchar(50) NOT NULL,
    `password` varchar(255) NOT NULL,
    `rep_id` int(11) DEFAULT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `is_lock` tinyint(1) DEFAULT 0,
    `signature` text DEFAULT NULL,
    `profile_pix` text DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO
    `users` (
        `id`,
        `name`,
        `username`,
        `email`,
        `accNum`,
        `wallet_balance`,
        `phone`,
        `profession`,
        `education`,
        `address`,
        `dob`,
        `image`,
        `status`,
        `nok_name`,
        `nok_phone`,
        `nok_relationship`,
        `password`,
        `rep_id`,
        `created_at`,
        `updated_at`,
        `is_lock`,
        `signature`,
        `profile_pix`
    )
VALUES (
        1,
        'John Doe',
        'johndoe',
        'salawuhamid96@gmail.com',
        '0012345678',
        2000.00,
        '08033333333',
        'Engineer',
        'B.Sc.',
        '123 Main Street',
        '1995-05-12',
        NULL,
        'active',
        'Jane Doe',
        '08099999999',
        'Sister',
        '$2y$10$UDMkTtK6rLzU9OAb3b5NjO8UpG/uEM0DJbzOIFeDfSMXAUBDj/dG6',
        1,
        '2025-07-16 01:09:12',
        '2025-08-14 14:58:44',
        0,
        '1754973227_3205.jpeg',
        '1755168070_6132.jpeg'
    ),
    (
        2,
        'Mary Smith',
        'marysmith',
        'mary@example.com',
        '0012345679',
        750.00,
        '08044444444',
        'Teacher',
        'M.Ed.',
        '456 Market Road',
        '1990-03-20',
        NULL,
        'active',
        'Tom Smith',
        '08088888888',
        'Brother',
        '$2y$10$Btp5UUZp9urTIpH.wRQkAe4Iy0E/aMF5ThbJLSHIwdis.d0.AHckm',
        2,
        '2025-07-16 01:09:12',
        '2025-07-17 11:54:02',
        0,
        NULL,
        NULL
    ),
    (
        3,
        'Salvador Meyers',
        'lakatana',
        'siziqyqena@mailinator.com',
        '1002025679',
        0.00,
        '+1 (196) 272-7649',
        NULL,
        NULL,
        'Atque veritatis repr',
        '2019-01-09',
        NULL,
        'active',
        'Forrest Romero',
        '+1 (218) 269-1372',
        'Child',
        '$2y$10$bQ3RBCNCOT4YWzZDPvah2eMGFQLk7FHw6.LFhbtdMQej6dkVQg.Ea',
        NULL,
        '2025-07-17 11:54:17',
        '2025-07-17 12:23:25',
        0,
        NULL,
        NULL
    ),
    (
        4,
        'Kayode Owoseni',
        'malkayne',
        'user1@gmail.com',
        '1002025680',
        20.00,
        '09012345678',
        NULL,
        NULL,
        'Federal University Oye Ekiti',
        '2001-03-07',
        NULL,
        'active',
        'Bola Hammed',
        '09087654321',
        'Brother',
        '$2y$10$S2ArwEIBettHJXU3ceIICO1hyC4X5aC4wRupSkc3rNRkY8bQ3E9aK',
        1,
        '2025-07-17 18:25:43',
        '2025-07-17 22:25:03',
        0,
        NULL,
        NULL
    ),
    (
        5,
        'Obere',
        'kajata',
        'oberechukwuemeka@gmail.com',
        '1002025681',
        6500.00,
        '08118161633',
        NULL,
        NULL,
        '21 isikwuatu',
        '2003-07-24',
        NULL,
        'active',
        'Faith',
        '08118161633',
        'Sister',
        '$2y$10$V0czWzynebsZ3BLHlu6G8uK5ydBCiU5qXHgnXrS6nKUUfOpDvX4wC',
        1,
        '2025-07-24 14:45:33',
        '2025-08-14 20:32:00',
        0,
        NULL,
        NULL
    ),
    (
        6,
        'Callum Fields',
        'harybavax',
        'xafuq@mailinator.com',
        '1002025682',
        0.00,
        '+1 (513) 635-2561',
        NULL,
        NULL,
        'Minima velit et inci',
        '2025-04-27',
        NULL,
        'active',
        'Dora Holloway',
        '+1 (979) 182-9856',
        'Et eiusmod blanditii',
        '$2y$10$C83yjiZZb8LLlNzU7nrmD.KhmDKOCTluq8gOys16KUNIe2tG4R3XC',
        5,
        '2025-07-28 00:57:48',
        '2025-07-28 00:57:48',
        0,
        NULL,
        NULL
    ),
    (
        7,
        'Miranda Grimes',
        'jarunu',
        'vyjubuwar@mailinator.com',
        '1002025683',
        1500.00,
        '+1 (995) 183-1118',
        NULL,
        NULL,
        'Modi in a eum esse',
        '1989-12-13',
        NULL,
        'active',
        'Preston Sanchez',
        '+1 (171) 953-7395',
        'Sint cillum vero sin',
        '$2y$10$FrBHSXv0SlA5CiepF8O7E.PrS0IZ6za3fjkeCICav97t4zUqi22w6',
        5,
        '2025-07-28 01:05:36',
        '2025-07-28 01:08:19',
        0,
        NULL,
        NULL
    ),
    (
        8,
        'Tyler Davidson',
        'hujohym',
        'guqew@mailinator.com',
        '1002025684',
        0.00,
        '+1 (846) 319-8409',
        NULL,
        NULL,
        'Duis in quibusdam re',
        '2003-05-12',
        NULL,
        'active',
        'Aline Coleman',
        '+1 (944) 235-3256',
        'Minus fugiat dolores',
        '$2y$10$69rMEDvVW0Flod//roGv6utsLeMQkaCnfni2aEXWPHaED2xLoEXZu',
        5,
        '2025-07-28 10:23:09',
        '2025-07-28 10:23:09',
        0,
        '1753683789_5814.png',
        NULL
    ),
    (
        9,
        'Kylan Owens',
        'voxux',
        'coxakody@mailinator.com',
        '1002025685',
        0.00,
        '+1 (818) 468-8662',
        NULL,
        NULL,
        'Recusandae Optio i',
        '1976-01-15',
        NULL,
        'active',
        'Kameko Sawyer',
        '+1 (502) 343-9777',
        'Accusantium sed est',
        '$2y$10$6GmjlIe0jZRqc/DKfyZlkesU5YhxtAgWWsrmz5AdiRO2cLTJE833W',
        5,
        '2025-07-28 10:29:51',
        '2025-07-28 10:29:51',
        0,
        '1753684191_8870.png',
        NULL
    ),
    (
        10,
        'Obere chukwuemeka France',
        'kajata01',
        'kpoint.ng@gmail.com',
        '1002025686',
        1000.00,
        '08118161633',
        NULL,
        NULL,
        '21 isikwuatu street okpoko',
        '2007-07-30',
        NULL,
        'active',
        'Faith',
        '08118161633',
        'Sister',
        '$2y$10$6oHc/RVG/YO7N2/adQN/F.Q1LzrDwT60TNfQjoJZyVnumh8UNwZO6',
        1,
        '2025-07-31 00:31:16',
        '2025-08-05 10:35:51',
        0,
        '1753907475_4316.jpeg',
        NULL
    ),
    (
        11,
        'Nweke Godswill Uchenna',
        'godswill',
        'Cuse1992@cuvox.de',
        '1002025687',
        1999.00,
        '08149502368',
        NULL,
        NULL,
        'No 5 okwara street Okpoko Anambra',
        '2004-05-15',
        NULL,
        'active',
        'Nweke Obumuneme Emmanuel',
        '09066992963',
        'brother',
        '$2y$10$Vb73dDX1f/IS24b4fneeYe3FkhyL78/thujHceCKEJOIqz3bKNj.W',
        6,
        '2025-08-04 11:13:05',
        '2025-08-04 11:16:01',
        0,
        '1754291585_5550.jpeg',
        NULL
    ),
    (
        12,
        'Cairo Gaines',
        'sogewahy',
        'pono@mailinator.com',
        '1002025688',
        0.00,
        '+1 (211) 649-4233',
        NULL,
        NULL,
        'Excepteur aperiam la',
        '1978-05-23',
        NULL,
        'active',
        'Amir Lamb',
        '+1 (932) 616-6054',
        'Voluptatem exercitat',
        '$2y$10$b2ZK2AhFijkSBu..UdG4tO/oiOcr6uXsdCaNyoo226WOMv7PlAgWO',
        1,
        '2025-08-12 08:33:47',
        '2025-08-12 08:33:47',
        0,
        '1754973227_3205.jpeg',
        '1754973227_5328.jpeg'
    ),
    (
        13,
        'Calista Chase',
        'jujep',
        'towyq@mailinator.com',
        '1002025689',
        1400.00,
        '+1 (767) 956-2882',
        NULL,
        NULL,
        'Hic earum et sed aut',
        '2010-10-04',
        NULL,
        'active',
        'Flynn Klein',
        '+1 (853) 445-8555',
        'Deserunt eiusmod ver',
        '$2y$10$A2ZEMB6mW19jPI6lnlU69OERTZQZQxdXupLdImT9VoNESQ7XwuAGi',
        1,
        '2025-08-14 14:41:10',
        '2025-08-14 16:17:43',
        0,
        '1755168070_6182.jpeg',
        '1755168070_6132.jpeg'
    );

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
    `id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `savings_wallet` decimal(12, 2) DEFAULT 0.00,
    `business_wallet` decimal(12, 2) DEFAULT 0.00,
    `user_wallet` decimal(12, 2) DEFAULT 0.00,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `amount` text DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO
    `wallets` (
        `id`,
        `user_id`,
        `savings_wallet`,
        `business_wallet`,
        `user_wallet`,
        `created_at`,
        `updated_at`,
        `amount`
    )
VALUES (
        1,
        1,
        1000.00,
        0.00,
        100.00,
        '2025-07-16 01:09:12',
        '2025-07-17 17:38:21',
        NULL
    ),
    (
        2,
        2,
        0.00,
        750.00,
        50.00,
        '2025-07-16 01:09:12',
        '2025-07-17 17:38:21',
        NULL
    ),
    (
        3,
        7,
        0.00,
        0.00,
        0.00,
        '2025-07-28 01:23:07',
        '2025-07-28 01:23:07',
        '-500'
    ),
    (
        4,
        10,
        0.00,
        0.00,
        0.00,
        '2025-08-04 10:52:37',
        '2025-08-04 10:59:45',
        '20000'
    ),
    (
        5,
        5,
        0.00,
        0.00,
        0.00,
        '2025-08-04 11:05:50',
        '2025-08-09 01:42:17',
        '-19000'
    );

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
    `id` bigint(20) UNSIGNED NOT NULL,
    `user_id` bigint(20) UNSIGNED NOT NULL,
    `amount` decimal(15, 2) NOT NULL,
    `bank_name` varchar(255) NOT NULL,
    `account_number` varchar(255) NOT NULL,
    `account_name` varchar(255) NOT NULL,
    `status` enum(
        'pending',
        'approved',
        'rejected'
    ) DEFAULT 'pending',
    `signature_path` varchar(255) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = MyISAM DEFAULT CHARSET = latin1 COLLATE = latin1_swedish_ci;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO
    `withdrawals` (
        `id`,
        `user_id`,
        `amount`,
        `bank_name`,
        `account_number`,
        `account_name`,
        `status`,
        `signature_path`,
        `created_at`,
        `updated_at`
    )
VALUES (
        3,
        5,
        1000.00,
        'Access bank',
        '1415265073',
        'Obere chukwuemeka France',
        'pending',
        'withdrawal_signature/689246d9c754e.jpg',
        '2025-08-05 22:00:57',
        '2025-08-05 22:00:57'
    ),
    (
        2,
        1,
        6800.00,
        'Thaddeus Wilkerson',
        '306',
        'Marvin Montoya',
        'pending',
        'withdrawal_signature/688ad5789053d.png',
        '2025-07-31 06:31:20',
        '2025-07-31 06:31:20'
    );

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `username` (`username`),
ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `contributions`
--
ALTER TABLE `contributions`
ADD PRIMARY KEY (`id`),
ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `contribution_plans`
--
ALTER TABLE `contribution_plans`
ADD PRIMARY KEY (`id`),
ADD KEY `user_id` (`user_id`),
ADD KEY `rep_id` (`rep_id`);

--
-- Indexes for table `manual_funding_requests`
--
ALTER TABLE `manual_funding_requests`
ADD PRIMARY KEY (`id`),
ADD KEY `fk_withdrawals_user` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations` ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
ADD PRIMARY KEY (`id`),
ADD KEY `email` (`email`);

--
-- Indexes for table `reps`
--
ALTER TABLE `reps`
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `username` (`username`),
ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
ADD PRIMARY KEY (`id`),
ADD KEY `user_id` (`user_id`),
ADD KEY `rep_id` (`rep_id`),
ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `username` (`username`),
ADD UNIQUE KEY `accNum` (`accNum`),
ADD UNIQUE KEY `email` (`email`),
ADD KEY `rep_id` (`rep_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
ADD PRIMARY KEY (`id`),
ADD KEY `fk_withdrawals_user` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT for table `contributions`
--
ALTER TABLE `contributions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 88;

--
-- AUTO_INCREMENT for table `contribution_plans`
--
ALTER TABLE `contribution_plans`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 26;

--
-- AUTO_INCREMENT for table `manual_funding_requests`
--
ALTER TABLE `manual_funding_requests`
MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 5;

--
-- AUTO_INCREMENT for table `reps`
--
ALTER TABLE `reps`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 7;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 14;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 6;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contributions`
--
ALTER TABLE `contributions`
ADD CONSTRAINT `contributions_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `contribution_plans` (`id`);

--
-- Constraints for table `contribution_plans`
--
ALTER TABLE `contribution_plans`
ADD CONSTRAINT `contribution_plans_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
ADD CONSTRAINT `contribution_plans_ibfk_2` FOREIGN KEY (`rep_id`) REFERENCES `reps` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`rep_id`) REFERENCES `reps` (`id`),
ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`plan_id`) REFERENCES `contribution_plans` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`rep_id`) REFERENCES `reps` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
ADD CONSTRAINT `wallets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;