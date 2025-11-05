-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2025 at 09:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new`
--

-- --------------------------------------------------------

--
-- Table structure for table `approved_loans`
--

CREATE TABLE `approved_loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `item_loan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `loan_method` varchar(255) NOT NULL DEFAULT 'Cash',
  `loan_type` decimal(10,2) NOT NULL,
  `deduct_time_period` varchar(255) NOT NULL,
  `interest_percentage` decimal(5,2) NOT NULL,
  `interest_amount` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `monthly_amount` decimal(10,2) NOT NULL,
  `member_name` varchar(255) NOT NULL,
  `member_enlisted_no` varchar(255) NOT NULL,
  `member_regiment_no` varchar(255) NOT NULL,
  `member_army_id` varchar(255) NOT NULL,
  `guarantor1_name` varchar(255) NOT NULL,
  `guarantor1_enlisted_no` varchar(255) NOT NULL,
  `guarantor1_regiment_no` varchar(255) NOT NULL,
  `guarantor1_army_id` varchar(255) NOT NULL,
  `guarantor2_name` varchar(255) NOT NULL,
  `guarantor2_enlisted_no` varchar(255) NOT NULL,
  `guarantor2_regiment_no` varchar(255) NOT NULL,
  `guarantor2_army_id` varchar(255) NOT NULL,
  `deductions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`deductions`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `approved_loans`
--

INSERT INTO `approved_loans` (`id`, `loan_id`, `item_loan_id`, `loan_method`, `loan_type`, `deduct_time_period`, `interest_percentage`, `interest_amount`, `total_amount`, `monthly_amount`, `member_name`, `member_enlisted_no`, `member_regiment_no`, `member_army_id`, `guarantor1_name`, `guarantor1_enlisted_no`, `guarantor1_regiment_no`, `guarantor1_army_id`, `guarantor2_name`, `guarantor2_enlisted_no`, `guarantor2_regiment_no`, `guarantor2_army_id`, `deductions`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Cash', 300000.00, '36', 4.50, 13500.00, 313500.00, 8708.33, 'Bimal', 'E500', 'R0218', 'ADF1254', 'janith', 'aq4551515', 'R515141', '1215848', 'Aravinda', '1151525', '878588', '87842828', '[{\"month\":1,\"checked\":false,\"amount\":8708.33},{\"month\":2,\"checked\":false,\"amount\":8708.33},{\"month\":3,\"checked\":false,\"amount\":8708.33},{\"month\":4,\"checked\":false,\"amount\":8708.33},{\"month\":5,\"checked\":false,\"amount\":8708.33},{\"month\":6,\"checked\":false,\"amount\":8708.33},{\"month\":7,\"checked\":false,\"amount\":8708.33},{\"month\":8,\"checked\":false,\"amount\":8708.33},{\"month\":9,\"checked\":false,\"amount\":8708.33},{\"month\":10,\"checked\":false,\"amount\":8708.33},{\"month\":11,\"checked\":false,\"amount\":8708.33},{\"month\":12,\"checked\":false,\"amount\":8708.33},{\"month\":13,\"checked\":false,\"amount\":8708.33},{\"month\":14,\"checked\":false,\"amount\":8708.33},{\"month\":15,\"checked\":false,\"amount\":8708.33},{\"month\":16,\"checked\":false,\"amount\":8708.33},{\"month\":17,\"checked\":false,\"amount\":8708.33},{\"month\":18,\"checked\":false,\"amount\":8708.33},{\"month\":19,\"checked\":false,\"amount\":8708.33},{\"month\":20,\"checked\":false,\"amount\":8708.33},{\"month\":21,\"checked\":false,\"amount\":8708.33},{\"month\":22,\"checked\":false,\"amount\":8708.33},{\"month\":23,\"checked\":false,\"amount\":8708.33},{\"month\":24,\"checked\":false,\"amount\":8708.33},{\"month\":25,\"checked\":false,\"amount\":8708.33},{\"month\":26,\"checked\":false,\"amount\":8708.33},{\"month\":27,\"checked\":false,\"amount\":8708.33},{\"month\":28,\"checked\":false,\"amount\":8708.33},{\"month\":29,\"checked\":false,\"amount\":8708.33},{\"month\":30,\"checked\":false,\"amount\":8708.33},{\"month\":31,\"checked\":false,\"amount\":8708.33},{\"month\":32,\"checked\":false,\"amount\":8708.33},{\"month\":33,\"checked\":false,\"amount\":8708.33},{\"month\":34,\"checked\":false,\"amount\":8708.33},{\"month\":35,\"checked\":false,\"amount\":8708.33},{\"month\":36,\"checked\":false,\"amount\":8708.33}]', '2025-11-05 07:55:54', '2025-11-05 07:55:54'),
(5, NULL, 1, 'Item', 171000.00, '36', 4.50, 7695.00, 178695.00, 4963.75, 'shenal', '155151', 'R021', 'ADF12547', 'janith', 'aq4551515', 'R515141', '1215848', 'bimal', 'E503', '551151', '87842828', '\"[{\\\"month\\\":1,\\\"due_date\\\":\\\"2025-12-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":2,\\\"due_date\\\":\\\"2026-01-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":3,\\\"due_date\\\":\\\"2026-02-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":4,\\\"due_date\\\":\\\"2026-03-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":5,\\\"due_date\\\":\\\"2026-04-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":6,\\\"due_date\\\":\\\"2026-05-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":7,\\\"due_date\\\":\\\"2026-06-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":8,\\\"due_date\\\":\\\"2026-07-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":9,\\\"due_date\\\":\\\"2026-08-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":10,\\\"due_date\\\":\\\"2026-09-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":11,\\\"due_date\\\":\\\"2026-10-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":12,\\\"due_date\\\":\\\"2026-11-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":13,\\\"due_date\\\":\\\"2026-12-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":14,\\\"due_date\\\":\\\"2027-01-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":15,\\\"due_date\\\":\\\"2027-02-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":16,\\\"due_date\\\":\\\"2027-03-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":17,\\\"due_date\\\":\\\"2027-04-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":18,\\\"due_date\\\":\\\"2027-05-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":19,\\\"due_date\\\":\\\"2027-06-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":20,\\\"due_date\\\":\\\"2027-07-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":21,\\\"due_date\\\":\\\"2027-08-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":22,\\\"due_date\\\":\\\"2027-09-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":23,\\\"due_date\\\":\\\"2027-10-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":24,\\\"due_date\\\":\\\"2027-11-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":25,\\\"due_date\\\":\\\"2027-12-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":26,\\\"due_date\\\":\\\"2028-01-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":27,\\\"due_date\\\":\\\"2028-02-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":28,\\\"due_date\\\":\\\"2028-03-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":29,\\\"due_date\\\":\\\"2028-04-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":30,\\\"due_date\\\":\\\"2028-05-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":31,\\\"due_date\\\":\\\"2028-06-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":32,\\\"due_date\\\":\\\"2028-07-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":33,\\\"due_date\\\":\\\"2028-08-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":34,\\\"due_date\\\":\\\"2028-09-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":35,\\\"due_date\\\":\\\"2028-10-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null},{\\\"month\\\":36,\\\"due_date\\\":\\\"2028-11-05\\\",\\\"amount\\\":4963.75,\\\"status\\\":\\\"pending\\\",\\\"paid_amount\\\":0,\\\"paid_date\\\":null}]\"', '2025-11-05 08:18:31', '2025-11-05 08:18:31');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('nuwa@gmail.com|::1', 'i:1;', 1762328881),
('nuwa@gmail.com|::1:timer', 'i:1762328881;', 1762328881),
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:39:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:9:\"role-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:16;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:11:\"role-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:16;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:9:\"role-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:16;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"role-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:16;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:12:\"product-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:16;i:1;i:17;i:2;i:18;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:14:\"product-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:16;i:1;i:18;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:12:\"product-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:16;i:1;i:17;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:14:\"product-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:16;i:1;i:18;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"product-approve\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:16;i:1;i:17;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:14:\"product-reject\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:16;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:14:\"welfare-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:16;i:1;i:18;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:12:\"welfare-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:16;i:1;i:17;i:2;i:18;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:12:\"welfare-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:16;i:1;i:17;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:14:\"welfare-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:16;i:1;i:18;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:15:\"welfare-approve\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:16;i:1;i:17;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:14:\"welfare-reject\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:16;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:13:\"supplier-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:16;i:1;i:17;i:2;i:18;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:15:\"supplier-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:16;i:1;i:18;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:13:\"supplier-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:16;i:1;i:17;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:15:\"supplier-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:16;i:1;i:18;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:16:\"supplier-approve\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:16;i:1;i:17;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:15:\"supplier-reject\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:16;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:9:\"item-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:16;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:11:\"item-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:16;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:12:\"item-approve\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:16;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:11:\"item-reject\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:16;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:14:\"priceList-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:16;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:16:\"priceList-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:16;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:14:\"priceList-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:16;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:10:\"order-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:16;i:1;i:17;i:2;i:18;i:3;i:19;i:4;i:20;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:12:\"order-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:16;i:1;i:19;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:10:\"order-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:16;i:1;i:17;i:2;i:18;i:3;i:19;i:4;i:20;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:13:\"order-approve\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:16;i:1;i:17;i:2;i:18;i:3;i:20;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:12:\"order-reject\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:16;i:1;i:17;i:2;i:18;i:3;i:20;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:15:\"membership-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:16;i:1;i:21;i:2;i:22;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:17:\"membership-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:16;i:1;i:21;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:15:\"membership-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:16;i:1;i:22;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:18:\"membership-approve\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:16;i:1;i:22;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:17:\"membership-reject\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:16;}}}s:5:\"roles\";a:7:{i:0;a:3:{s:1:\"a\";i:16;s:1:\"b\";s:5:\"Admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:17;s:1:\"b\";s:13:\"Shop Coord OC\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:18;s:1:\"b\";s:16:\"Shop Coord Clerk\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:19;s:1:\"b\";s:18:\"Welfare Shop Clerk\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:20;s:1:\"b\";s:15:\"Welfare Shop OC\";s:1:\"c\";s:3:\"web\";}i:5;a:3:{s:1:\"a\";i:21;s:1:\"b\";s:16:\"Membership Clerk\";s:1:\"c\";s:3:\"web\";}i:6;a:3:{s:1:\"a\";i:22;s:1:\"b\";s:13:\"Membership OC\";s:1:\"c\";s:3:\"web\";}}}', 1762414628);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categorys`
--

CREATE TABLE `categorys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorys`
--

INSERT INTO `categorys` (`id`, `category`, `description`, `active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Laptops', 'Electronic Items', 1, 0, '2025-11-05 06:51:18', '2025-11-05 06:51:18'),
(2, 'Mobiles', 'Electronic Items', 1, 0, '2025-11-05 06:51:38', '2025-11-05 06:51:38');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_loans`
--

CREATE TABLE `item_loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_id` varchar(255) NOT NULL,
  `enlisted_no` varchar(255) NOT NULL,
  `regiment_no` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nic` varchar(255) NOT NULL,
  `army_id` varchar(255) NOT NULL,
  `office_address` text NOT NULL,
  `previous_unit` varchar(255) DEFAULT NULL,
  `welfare_membership` enum('Yes','No') NOT NULL,
  `welfare_membership_date` date DEFAULT NULL,
  `bill_no` varchar(255) DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `enlisted_date` date NOT NULL,
  `retire_date` date DEFAULT NULL,
  `required_welfare_item_category` varchar(255) DEFAULT NULL,
  `welfare_id` bigint(20) UNSIGNED DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `item_type` varchar(255) DEFAULT NULL,
  `model_no` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `land_no` varchar(255) DEFAULT NULL,
  `paying_installments` enum('Yes','No') NOT NULL,
  `deduct_time_period` varchar(255) DEFAULT NULL,
  `consent_agreement` tinyint(1) NOT NULL DEFAULT 0,
  `soldier_statement` varchar(255) DEFAULT NULL,
  `guarantor1_enlisted_no` varchar(255) NOT NULL,
  `guarantor1_regiment_no` varchar(255) NOT NULL,
  `guarantor1_rank` varchar(255) NOT NULL,
  `guarantor1_name` varchar(255) NOT NULL,
  `guarantor1_nic` varchar(255) NOT NULL,
  `guarantor1_army_id` varchar(255) NOT NULL,
  `guarantor1_office_address` text NOT NULL,
  `guarantor1_previous_unit` varchar(255) DEFAULT NULL,
  `guarantor1_welfare_membership` enum('Yes','No') NOT NULL,
  `guarantor1_enlisted_date` date NOT NULL,
  `guarantor1_retire_date` date DEFAULT NULL,
  `guarantor2_enlisted_no` varchar(255) NOT NULL,
  `guarantor2_regiment_no` varchar(255) NOT NULL,
  `guarantor2_rank` varchar(255) NOT NULL,
  `guarantor2_name` varchar(255) NOT NULL,
  `guarantor2_nic` varchar(255) NOT NULL,
  `guarantor2_army_id` varchar(255) NOT NULL,
  `guarantor2_office_address` text NOT NULL,
  `guarantor2_previous_unit` varchar(255) DEFAULT NULL,
  `guarantor2_welfare_membership` enum('Yes','No') NOT NULL,
  `guarantor2_enlisted_date` date NOT NULL,
  `guarantor2_retire_date` date DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','oc_approved','shop_coord_clerk_approved','shop_coord_oc_approved','clerk_approved','approved','rejected','shop_coord_rejected','shop_coord_oc_rejected') NOT NULL DEFAULT 'pending',
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `shop_coord_approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `shop_coord_approved_at` timestamp NULL DEFAULT NULL,
  `loan_checked` tinyint(1) NOT NULL DEFAULT 0,
  `membership_checked` tinyint(1) NOT NULL DEFAULT 0,
  `shop_coord_oc_approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `shop_coord_oc_approved_at` timestamp NULL DEFAULT NULL,
  `final_approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `final_approved_at` timestamp NULL DEFAULT NULL,
  `rejected_by` bigint(20) UNSIGNED DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_loans`
--

INSERT INTO `item_loans` (`id`, `application_id`, `enlisted_no`, `regiment_no`, `rank`, `name`, `nic`, `army_id`, `office_address`, `previous_unit`, `welfare_membership`, `welfare_membership_date`, `bill_no`, `bill_date`, `enlisted_date`, `retire_date`, `required_welfare_item_category`, `welfare_id`, `item_name`, `item_type`, `model_no`, `mobile_no`, `land_no`, `paying_installments`, `deduct_time_period`, `consent_agreement`, `soldier_statement`, `guarantor1_enlisted_no`, `guarantor1_regiment_no`, `guarantor1_rank`, `guarantor1_name`, `guarantor1_nic`, `guarantor1_army_id`, `guarantor1_office_address`, `guarantor1_previous_unit`, `guarantor1_welfare_membership`, `guarantor1_enlisted_date`, `guarantor1_retire_date`, `guarantor2_enlisted_no`, `guarantor2_regiment_no`, `guarantor2_rank`, `guarantor2_name`, `guarantor2_nic`, `guarantor2_army_id`, `guarantor2_office_address`, `guarantor2_previous_unit`, `guarantor2_welfare_membership`, `guarantor2_enlisted_date`, `guarantor2_retire_date`, `unit_id`, `created_by`, `status`, `approved_by`, `approved_at`, `shop_coord_approved_by`, `shop_coord_approved_at`, `loan_checked`, `membership_checked`, `shop_coord_oc_approved_by`, `shop_coord_oc_approved_at`, `final_approved_by`, `final_approved_at`, `rejected_by`, `rejection_reason`, `rejected_at`, `created_at`, `updated_at`) VALUES
(1, 'ILA-00001', '155151', 'R021', '2nd Lieutenant', 'shenal', '123456000321', 'ADF12547', 'Batharamulla', 'CR1', 'Yes', '2025-11-05', '1556151', '2025-11-05', '2025-11-05', NULL, 'Laptops', 1, 'Acer-i3-4353U', 'Electronic', '4353U', '0712518433', '0332618433', 'No', '36', 1, 'soldier_statements/mefuIQ6ha6UiBCIT4UruBHyG8Jyzt7lUdG2rddiJ.pdf', 'aq4551515', 'R515141', '2nd Lieutenant', 'janith', '11551515151v', '1215848', 'Batharamulla', 'CR1', 'Yes', '2025-11-05', NULL, 'E503', '551151', '2nd Lieutenant', 'bimal', '151945581878v', '87842828', 'Batharamulla', 'CR1', 'Yes', '2025-11-05', NULL, 1, 5, 'approved', 3, '2025-11-05 07:59:48', 6, '2025-11-05 08:00:21', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-05 07:59:18', '2025-11-05 08:18:31');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_id` varchar(255) NOT NULL,
  `loan_type` decimal(10,2) NOT NULL,
  `deduct_time_period` varchar(255) DEFAULT NULL,
  `enlisted_no` varchar(255) NOT NULL,
  `regiment_no` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nic` varchar(255) NOT NULL,
  `army_id` varchar(255) NOT NULL,
  `office_address` text NOT NULL,
  `previous_unit` varchar(255) DEFAULT NULL,
  `welfare_membership` enum('Yes','No') NOT NULL,
  `welfare_membership_date` date DEFAULT NULL,
  `bill_no` varchar(255) DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `enlisted_date` date NOT NULL,
  `retire_date` date DEFAULT NULL,
  `paying_installments` enum('Yes','No') NOT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `account_no` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `land_no` varchar(255) DEFAULT NULL,
  `consent_agreement` tinyint(1) NOT NULL DEFAULT 0,
  `soldier_statement` varchar(255) DEFAULT NULL,
  `guarantor1_enlisted_no` varchar(255) NOT NULL,
  `guarantor1_regiment_no` varchar(255) NOT NULL,
  `guarantor1_rank` varchar(255) NOT NULL,
  `guarantor1_name` varchar(255) NOT NULL,
  `guarantor1_nic` varchar(255) NOT NULL,
  `guarantor1_army_id` varchar(255) NOT NULL,
  `guarantor1_office_address` text NOT NULL,
  `guarantor1_previous_unit` varchar(255) DEFAULT NULL,
  `guarantor1_welfare_membership` enum('Yes','No') NOT NULL,
  `guarantor1_enlisted_date` date NOT NULL,
  `guarantor1_retire_date` date DEFAULT NULL,
  `guarantor2_enlisted_no` varchar(255) NOT NULL,
  `guarantor2_regiment_no` varchar(255) NOT NULL,
  `guarantor2_rank` varchar(255) NOT NULL,
  `guarantor2_name` varchar(255) NOT NULL,
  `guarantor2_nic` varchar(255) NOT NULL,
  `guarantor2_army_id` varchar(255) NOT NULL,
  `guarantor2_office_address` text NOT NULL,
  `guarantor2_previous_unit` varchar(255) DEFAULT NULL,
  `guarantor2_welfare_membership` enum('Yes','No') NOT NULL,
  `guarantor2_enlisted_date` date NOT NULL,
  `guarantor2_retire_date` date DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','oc_approved','approved','rejected') NOT NULL DEFAULT 'pending',
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `oc_approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `oc_approved_at` timestamp NULL DEFAULT NULL,
  `rejected_by` bigint(20) UNSIGNED DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `application_id`, `loan_type`, `deduct_time_period`, `enlisted_no`, `regiment_no`, `rank`, `name`, `nic`, `army_id`, `office_address`, `previous_unit`, `welfare_membership`, `welfare_membership_date`, `bill_no`, `bill_date`, `enlisted_date`, `retire_date`, `paying_installments`, `bank_name`, `branch`, `account_no`, `mobile_no`, `land_no`, `consent_agreement`, `soldier_statement`, `guarantor1_enlisted_no`, `guarantor1_regiment_no`, `guarantor1_rank`, `guarantor1_name`, `guarantor1_nic`, `guarantor1_army_id`, `guarantor1_office_address`, `guarantor1_previous_unit`, `guarantor1_welfare_membership`, `guarantor1_enlisted_date`, `guarantor1_retire_date`, `guarantor2_enlisted_no`, `guarantor2_regiment_no`, `guarantor2_rank`, `guarantor2_name`, `guarantor2_nic`, `guarantor2_army_id`, `guarantor2_office_address`, `guarantor2_previous_unit`, `guarantor2_welfare_membership`, `guarantor2_enlisted_date`, `guarantor2_retire_date`, `unit_id`, `created_by`, `status`, `approved_by`, `approved_at`, `oc_approved_by`, `oc_approved_at`, `rejected_by`, `rejection_reason`, `rejected_at`, `created_at`, `updated_at`) VALUES
(1, 'LN-00001', 300000.00, '36', 'E500', 'R0218', '2nd Lieutenant', 'Bimal', '123456000321', 'ADF1254', 'Batharamulla', 'CR1', 'Yes', '2025-11-03', '1556152', '2025-11-03', '2025-10-27', NULL, 'No', 'BOC', 'mihinthale', '1215512151', '0712518433', '0332618433', 1, 'loan_statements/ypbS1jdsnJRBKXLY0Ygf61RH63cpVAFTrEvfuzoU.pdf', 'aq4551515', 'R515141', '2nd Lieutenant', 'janith', '11551515151v', '1215848', 'Batharamulla', 'CR1', 'Yes', '2025-11-05', NULL, '1151525', '878588', '2nd Lieutenant', 'Aravinda', '151945581878v', '87842828', 'Batharamulla', 'CR1', 'Yes', '2025-11-05', NULL, 1, 4, 'approved', 2, '2025-11-05 07:55:54', 10, '2025-11-05 07:55:28', NULL, NULL, NULL, '2025-11-05 07:54:39', '2025-11-05 07:55:54');

-- --------------------------------------------------------

--
-- Table structure for table `loan_interests`
--

CREATE TABLE `loan_interests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `months` enum('4','8','12','24','36') NOT NULL,
  `interest` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_interests`
--

INSERT INTO `loan_interests` (`id`, `months`, `interest`, `created_at`, `updated_at`) VALUES
(1, '4', 2.50, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(2, '8', 3.00, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(3, '12', 3.50, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(4, '24', 4.00, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(5, '36', 4.50, '2025-11-05 06:29:07', '2025-11-05 06:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `membership_date` date DEFAULT NULL,
  `army_id` varchar(255) NOT NULL,
  `regiment_no` varchar(255) NOT NULL,
  `nic` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_01_31_063438_create_personal_access_tokens_table', 1),
(4, '2025_07_05_191923_create_permission_tables', 1),
(5, '2025_07_07_184724_create_regements_table', 1),
(6, '2025_07_07_190334_create_ranks_table', 1),
(7, '2025_07_08_044700_create_units_table', 1),
(8, '2025_07_08_150308_create_users_table', 1),
(9, '2025_07_23_042532_create_categorys_table', 1),
(10, '2025_09_29_092210_supplys_table', 1),
(11, '2025_09_29_104307_welfares_table', 1),
(12, '2025_09_29_123045_products_table', 1),
(13, '2025_10_01_082629_purchaseorders_table', 1),
(14, '2025_10_29_064404_create_memberships_table', 1),
(15, '2025_10_29_073234_create_welfare_memberships_table', 1),
(16, '2025_10_30_000001_create_purchase_orders_table', 1),
(17, '2025_10_30_000002_create_purchase_order_items_table', 1),
(18, '2025_10_31_130115_create_stocks_table', 1),
(19, '2025_11_01_111554_create_item_loans_table', 1),
(20, '2025_11_02_000000_create_loans_table', 1),
(21, '2025_11_02_195841_create_loan_interests_table', 1),
(22, '2025_11_02_225042_create_approved_loans_table', 1),
(23, '2025_11_03_005438_create_rejected_loans_table', 1),
(24, '2025_11_04_213754_create_person_issueds_table', 1),
(25, '2025_11_05_131031_add_approval_level_and_date_to_purchase_orders_table', 2);

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
(1, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 10),
(11, 'App\\Models\\User', 2),
(12, 'App\\Models\\User', 11),
(15, 'App\\Models\\User', 16),
(16, 'App\\Models\\User', 1),
(17, 'App\\Models\\User', 9),
(18, 'App\\Models\\User', 6),
(19, 'App\\Models\\User', 12),
(19, 'App\\Models\\User', 13),
(20, 'App\\Models\\User', 14),
(20, 'App\\Models\\User', 15),
(21, 'App\\Models\\User', 7),
(22, 'App\\Models\\User', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(2, 'role-create', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(3, 'role-edit', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(4, 'role-delete', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(5, 'product-list', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(6, 'product-create', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(7, 'product-edit', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(8, 'product-delete', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(9, 'product-approve', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(10, 'product-reject', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(11, 'welfare-create', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(12, 'welfare-list', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(13, 'welfare-edit', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(14, 'welfare-delete', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(15, 'welfare-approve', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(16, 'welfare-reject', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(17, 'supplier-list', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(18, 'supplier-create', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(19, 'supplier-edit', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(20, 'supplier-delete', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(21, 'supplier-approve', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(22, 'supplier-reject', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(23, 'item-list', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(24, 'item-create', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(25, 'item-approve', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(26, 'item-reject', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(27, 'priceList-list', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(28, 'priceList-create', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(29, 'priceList-edit', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(30, 'order-list', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(31, 'order-create', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(32, 'order-edit', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(33, 'order-approve', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(34, 'order-reject', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(35, 'membership-list', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(36, 'membership-create', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(37, 'membership-edit', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(38, 'membership-approve', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(39, 'membership-reject', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `person_issueds`
--

CREATE TABLE `person_issueds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_loan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_loan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stock_id` bigint(20) UNSIGNED DEFAULT NULL,
  `member_enlisted_no` varchar(255) NOT NULL,
  `member_enlisted_date` date DEFAULT NULL,
  `member_name` varchar(255) NOT NULL,
  `member_rank` varchar(255) NOT NULL,
  `member_regiment_no` varchar(255) NOT NULL,
  `member_nic` varchar(255) NOT NULL,
  `member_army_id` varchar(255) NOT NULL,
  `member_previous_unit` varchar(255) DEFAULT NULL,
  `guarantor1_enlisted_no` varchar(255) NOT NULL,
  `guarantor1_enlisted_date` date DEFAULT NULL,
  `guarantor1_name` varchar(255) NOT NULL,
  `guarantor1_rank` varchar(255) NOT NULL,
  `guarantor1_regiment_no` varchar(255) NOT NULL,
  `guarantor1_nic` varchar(255) NOT NULL,
  `guarantor1_army_id` varchar(255) NOT NULL,
  `guarantor1_previous_unit` varchar(255) DEFAULT NULL,
  `guarantor2_enlisted_no` varchar(255) NOT NULL,
  `guarantor2_enlisted_date` date DEFAULT NULL,
  `guarantor2_name` varchar(255) NOT NULL,
  `guarantor2_rank` varchar(255) NOT NULL,
  `guarantor2_regiment_no` varchar(255) NOT NULL,
  `guarantor2_nic` varchar(255) NOT NULL,
  `guarantor2_army_id` varchar(255) NOT NULL,
  `guarantor2_previous_unit` varchar(255) DEFAULT NULL,
  `item_code` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_model` varchar(255) DEFAULT NULL,
  `serial_number` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `person_issueds`
--

INSERT INTO `person_issueds` (`id`, `item_loan_id`, `approved_loan_id`, `stock_id`, `member_enlisted_no`, `member_enlisted_date`, `member_name`, `member_rank`, `member_regiment_no`, `member_nic`, `member_army_id`, `member_previous_unit`, `guarantor1_enlisted_no`, `guarantor1_enlisted_date`, `guarantor1_name`, `guarantor1_rank`, `guarantor1_regiment_no`, `guarantor1_nic`, `guarantor1_army_id`, `guarantor1_previous_unit`, `guarantor2_enlisted_no`, `guarantor2_enlisted_date`, `guarantor2_name`, `guarantor2_rank`, `guarantor2_regiment_no`, `guarantor2_nic`, `guarantor2_army_id`, `guarantor2_previous_unit`, `item_code`, `item_name`, `item_model`, `serial_number`, `category`, `created_at`, `updated_at`) VALUES
(3, 1, 5, 7, '155151', '2025-11-05', 'shenal', '2nd Lieutenant', 'R021', '123456000321', 'ADF12547', 'CR1', 'aq4551515', '2025-11-05', 'janith', '2nd Lieutenant', 'R515141', '11551515151v', '1215848', 'CR1', 'E503', '2025-11-05', 'bimal', '2nd Lieutenant', '551151', '151945581878v', '87842828', 'CR1', 'PT-0001', 'Acer-i3-4353U', '4553U', 'E;LMWJEIW56484', 'Laptops', '2025-11-05 08:18:31', '2025-11-05 08:18:31');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_number` varchar(255) NOT NULL,
  `product` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `normal_price` decimal(8,2) NOT NULL,
  `vat` decimal(8,2) NOT NULL,
  `tax` decimal(8,2) NOT NULL,
  `welfare_price` decimal(8,2) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_number`, `product`, `category_id`, `normal_price`, `vat`, `tax`, `welfare_price`, `active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'PT-0001', 'Acer-i3-4353U', 1, 150000.00, 8.00, 6.00, 171000.00, 0, 0, '2025-11-05 06:54:48', '2025-11-05 06:55:52'),
(2, 'PT-0002', 'Redmi-Note-10', 2, 85000.00, 6.00, 6.00, 95200.00, 0, 0, '2025-11-05 06:55:09', '2025-11-05 06:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `po_number` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `welfare_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `rejected_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `approval_level` int(11) NOT NULL DEFAULT 0,
  `rejection_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `po_number`, `date`, `welfare_id`, `created_by`, `approved_by`, `rejected_by`, `status`, `approval_level`, `rejection_reason`, `created_at`, `updated_at`) VALUES
(2, 'PO-20251105-001', '2025-11-05', 1, 13, 9, NULL, 'approved', 4, NULL, '2025-11-05 07:18:09', '2025-11-05 07:46:25');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_items`
--

CREATE TABLE `purchase_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `model_no` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `welfare_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `welfare_net_value` decimal(14,2) NOT NULL DEFAULT 0.00,
  `mrp` decimal(12,2) NOT NULL DEFAULT 0.00,
  `mrp_net_value` decimal(14,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order_items`
--

INSERT INTO `purchase_order_items` (`id`, `purchase_order_id`, `item_name`, `model_no`, `qty`, `welfare_price`, `welfare_net_value`, `mrp`, `mrp_net_value`, `created_at`, `updated_at`) VALUES
(2, 2, 'Acer-i3-4353U', '4553U', 10, 171000.00, 1710000.00, 30000.00, 300000.00, '2025-11-05 07:18:09', '2025-11-05 07:18:09');

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE `ranks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rank` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ranks`
--

INSERT INTO `ranks` (`id`, `rank`, `type`, `active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Field Marshal', 'Officer', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(2, 'General', 'Officer', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(3, 'Lieutenant General', 'Officer', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(4, 'Major General', 'Officer', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(5, 'Brigadier', 'Officer', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(6, 'Colonel', 'Officer', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(7, 'Lieutenant Colonel', 'Officer', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(8, 'Major', 'Officer', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(9, 'Captain', 'Officer', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(10, 'Lieutenant', 'Officer', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(11, '2nd Lieutenant', 'Officer', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(12, 'Warrant Officer Class I', 'Other', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(13, 'Warrant Officer Class II', 'Other', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(14, 'Staff Sergeant', 'Other', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(15, 'Sergeant', 'Other', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(16, 'Corporal', 'Other', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(17, 'Lance Corporal', 'Other', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(18, 'Private', 'Other', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `regements`
--

CREATE TABLE `regements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `regement` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regements`
--

INSERT INTO `regements` (`id`, `regement`, `active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Commando Regiment', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(2, 'Engineer Services Regiment', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(3, 'Gajaba Regiment', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(4, 'Gemunu Watch', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(5, 'Mechanized Infantry Regiment', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(6, 'Military Intelligence Corps', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(7, 'Special Forces Regiment', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(8, 'Sri Lanka Armoured Corps', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(9, 'Sri Lanka Army Corps of Agriculture and Livestock', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(10, 'Sri Lanka Army General Service Corps', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(11, 'Sri Lanka Army Medical Corps', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(12, 'Sri Lanka Army Ordnance Corps', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(13, 'Sri Lanka Army Pioneer Corps', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(14, 'Sri Lanka Army Service Corps', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(15, 'Sri Lanka Army Womens Corps', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(16, 'Sri Lanka Artillery', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(17, 'Sri Lanka Corps of Military Police', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(18, 'Sri Lanka Electrical and Mechanical Engineers', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(19, 'Sri Lanka Engineers', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(20, 'Sri Lanka Light Infantry', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(21, 'Sri Lanka National Guard', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(22, 'Sri Lanka Rifle Corps', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(23, 'Sri Lanka Signals Corps', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(24, 'Sri Lanka Sinha Regiment', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(25, 'Vijayabahu Infantry Regiment', 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `rejected_loans`
--

CREATE TABLE `rejected_loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `item_loan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `loan_method` varchar(255) NOT NULL DEFAULT 'Cash',
  `loan_type` decimal(10,2) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `member_name` varchar(255) NOT NULL,
  `member_enlisted_no` varchar(255) NOT NULL,
  `member_regiment_no` varchar(255) NOT NULL,
  `member_army_id` varchar(255) NOT NULL,
  `guarantor1_name` varchar(255) NOT NULL,
  `guarantor1_enlisted_no` varchar(255) NOT NULL,
  `guarantor1_regiment_no` varchar(255) NOT NULL,
  `guarantor1_army_id` varchar(255) NOT NULL,
  `guarantor2_name` varchar(255) NOT NULL,
  `guarantor2_enlisted_no` varchar(255) NOT NULL,
  `guarantor2_regiment_no` varchar(255) NOT NULL,
  `guarantor2_army_id` varchar(255) NOT NULL,
  `rejection_reason` text NOT NULL,
  `rejected_by` bigint(20) UNSIGNED NOT NULL,
  `rejected_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Unit Clerk', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(2, 'Unit OC', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(3, 'Loan Clerk', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(4, 'Loan OC', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(5, 'Ledger Clerk', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(6, 'Ledger OC', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(7, 'Audit Clerk', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(8, 'Audit OC', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(9, 'Account Clerk', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(10, 'Account OC', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(11, 'Account SO', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(12, 'Staff Officer', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(13, 'Colonel Welfare', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(14, 'Director Welfare', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(15, 'User', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(16, 'Admin', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(17, 'Shop Coord OC', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(18, 'Shop Coord Clerk', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(19, 'Welfare Shop Clerk', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(20, 'Welfare Shop OC', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(21, 'Membership Clerk', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00'),
(22, 'Membership OC', 'web', '2025-11-05 06:29:00', '2025-11-05 06:29:00');

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
(1, 16),
(2, 16),
(3, 16),
(4, 16),
(5, 16),
(5, 17),
(5, 18),
(6, 16),
(6, 18),
(7, 16),
(7, 17),
(8, 16),
(8, 18),
(9, 16),
(9, 17),
(10, 16),
(11, 16),
(11, 18),
(12, 16),
(12, 17),
(12, 18),
(13, 16),
(13, 17),
(14, 16),
(14, 18),
(15, 16),
(15, 17),
(16, 16),
(17, 16),
(17, 17),
(17, 18),
(18, 16),
(18, 18),
(19, 16),
(19, 17),
(20, 16),
(20, 18),
(21, 16),
(21, 17),
(22, 16),
(23, 16),
(24, 16),
(25, 16),
(26, 16),
(27, 16),
(28, 16),
(29, 16),
(30, 16),
(30, 17),
(30, 18),
(30, 19),
(30, 20),
(31, 16),
(31, 19),
(32, 16),
(32, 17),
(32, 18),
(32, 19),
(32, 20),
(33, 16),
(33, 17),
(33, 18),
(33, 20),
(34, 16),
(34, 17),
(34, 18),
(34, 20),
(35, 16),
(35, 21),
(35, 22),
(36, 16),
(36, 21),
(37, 16),
(37, 22),
(38, 16),
(38, 22),
(39, 16);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('CWZQxR4gqIMDij4KLWNB0sWMozVQjBSm4SOsceDh', 13, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZGwycVJidUNzMWx0bHhLQnlNOGFvaUFOM1JHN2RiNGt4TFJJT1hwRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3Qvd2VsZmFyZS9pdGVtbG9hbnMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxMztzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NjIzMjk2Njg7fX0=', 1762330712);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_item_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `welfare_id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_model` varchar(255) DEFAULT NULL,
  `item_code` varchar(255) DEFAULT NULL,
  `item_category` varchar(255) DEFAULT NULL,
  `item_normal_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `item_welfare_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `serial_number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `purchase_order_id`, `purchase_order_item_id`, `product_id`, `welfare_id`, `item_name`, `item_model`, `item_code`, `item_category`, `item_normal_price`, `item_welfare_price`, `serial_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 1, 1, 'Acer-i3-4353U', '4553U', 'PT-0001', 'Laptops', 150000.00, 171000.00, 'GDHSG155151', 'available', '2025-11-05 07:48:25', '2025-11-05 07:48:25'),
(2, 2, 2, 1, 1, 'Acer-i3-4353U', '4553U', 'PT-0001', 'Laptops', 150000.00, 171000.00, 'BDHWB465646', 'available', '2025-11-05 07:48:25', '2025-11-05 07:48:25'),
(3, 2, 2, 1, 1, 'Acer-i3-4353U', '4553U', 'PT-0001', 'Laptops', 150000.00, 171000.00, 'NRJEREJ54848', 'available', '2025-11-05 07:48:25', '2025-11-05 07:48:25'),
(4, 2, 2, 1, 1, 'Acer-i3-4353U', '4553U', 'PT-0001', 'Laptops', 150000.00, 171000.00, 'MFEFKF489451', 'issued', '2025-11-05 07:48:25', '2025-11-05 08:02:43'),
(5, 2, 2, 1, 1, 'Acer-i3-4353U', '4553U', 'PT-0001', 'Laptops', 150000.00, 171000.00, 'NFEJEUFE15561', 'available', '2025-11-05 07:48:25', '2025-11-05 07:48:25'),
(6, 2, 2, 1, 1, 'Acer-i3-4353U', '4553U', 'PT-0001', 'Laptops', 150000.00, 171000.00, 'MKWMWEWI5464', 'issued', '2025-11-05 07:48:25', '2025-11-05 08:15:19'),
(7, 2, 2, 1, 1, 'Acer-i3-4353U', '4553U', 'PT-0001', 'Laptops', 150000.00, 171000.00, 'E;LMWJEIW56484', 'issued', '2025-11-05 07:48:25', '2025-11-05 08:18:31'),
(8, 2, 2, 1, 1, 'Acer-i3-4353U', '4553U', 'PT-0001', 'Laptops', 150000.00, 171000.00, 'WWIWJ1561513', 'available', '2025-11-05 07:48:25', '2025-11-05 07:48:25'),
(9, 2, 2, 1, 1, 'Acer-i3-4353U', '4553U', 'PT-0001', 'Laptops', 150000.00, 171000.00, 'JIJSC4845151', 'available', '2025-11-05 07:48:25', '2025-11-05 07:48:25'),
(10, 2, 2, 1, 1, 'Acer-i3-4353U', '4553U', 'PT-0001', 'Laptops', 150000.00, 171000.00, 'WNJWNUWD5156', 'available', '2025-11-05 07:48:25', '2025-11-05 07:48:25');

-- --------------------------------------------------------

--
-- Table structure for table `supplys`
--

CREATE TABLE `supplys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supply_number` varchar(255) NOT NULL,
  `supply` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplys`
--

INSERT INTO `supplys` (`id`, `supply_number`, `supply`, `description`, `active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'ST-0001', 'Abans', 'Supplier is Abans', 0, 0, '2025-11-05 06:52:47', '2025-11-05 06:55:33'),
(2, 'ST-0002', 'LG', 'Supplier is LG', 0, 0, '2025-11-05 06:53:01', '2025-11-05 06:55:36'),
(3, 'ST-0003', 'Singer', 'Supplier is Singer', 0, 0, '2025-11-05 06:53:17', '2025-11-05 06:55:39');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit` varchar(255) NOT NULL,
  `regement_id` bigint(20) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit`, `regement_id`, `active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'CR1', 1, 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(2, 'CR2', 1, 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(3, 'ESR1', 2, 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(4, 'ESR2', 2, 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(5, 'GR1', 3, 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07'),
(6, 'GR2', 3, 1, 0, '2025-11-05 06:29:07', '2025-11-05 06:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `employee_no` varchar(255) NOT NULL,
  `regement_no` varchar(255) NOT NULL,
  `regement_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `rank_id` bigint(20) UNSIGNED NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `nic` varchar(255) DEFAULT NULL,
  `armyId` varchar(255) DEFAULT NULL,
  `officeAddress` varchar(255) DEFAULT NULL,
  `enlistedDate` date DEFAULT NULL,
  `retireDate` date DEFAULT NULL,
  `welfare_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `address`, `employee_no`, `regement_no`, `regement_id`, `unit_id`, `rank_id`, `email_verified_at`, `active`, `is_deleted`, `password`, `profile_image`, `nic`, `armyId`, `officeAddress`, `enlistedDate`, `retireDate`, `welfare_id`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Shenal', 'shenal@gmail.com', '0710000001', 'PahalaYagoda, Ganemulla', 'E501', 'R501', 1, 1, 1, NULL, 1, 0, '$2y$12$kEvVqMUMir4La0IhAm0p5uI6Qmqm8pzgowHH1GXzY6kPEGZrt2HI.', 'GXpn25sVW9W6GfX2u3XXnp48SL5Sz07zCf3FNQAL.jpg', '199900000001', 'DE00001', 'Batharamulla', NULL, NULL, NULL, 'Admin', NULL, '2025-11-05 06:29:06', '2025-11-05 06:31:18'),
(2, 'Lahiru', 'lahiru@gmail.com', '0710000002', 'PahalaYagoda, Ganemulla', 'E502', 'R502', 1, 1, 1, NULL, 1, 0, '$2y$12$UPMyE/NJ9ZubOVoBBxiXdewuundXzwJFQIl26Zi.zpaM7I7g3Li2O', NULL, '199900000002', 'DE00002', 'Batharamulla', NULL, NULL, NULL, 'Account SO', NULL, '2025-11-05 06:29:06', '2025-11-05 06:29:06'),
(3, 'Aravinda', 'aravinda@gmail.com', '0710000003', 'PahalaYagoda, Ganemulla', 'E503', 'R503', 1, 1, 1, NULL, 1, 0, '$2y$12$eaAqNxjJ3zJRt3qoddEQ8uHpL06hUALaXWl45E14.lmYUOmQWLT.q', NULL, '199900000003', 'DE00003', 'Batharamulla', NULL, NULL, NULL, 'Unit OC', NULL, '2025-11-05 06:29:06', '2025-11-05 06:29:06'),
(4, 'Aruna', 'aruna@gmail.com', '0710000004', 'PahalaYagoda, Ganemulla', 'E504', 'R504', 1, 1, 1, NULL, 1, 0, '$2y$12$8facEGsR7DvrL76UTrwzjeqCvHvr3C.7fWZ/6k25ryj3cngLtgVpu', NULL, '199900000004', 'DE00004', 'Batharamulla', NULL, NULL, NULL, 'Loan Clerk', NULL, '2025-11-05 06:29:06', '2025-11-05 06:29:06'),
(5, 'Ashri', 'ashri@gmail.com', '0710000005', 'PahalaYagoda, Ganemulla', 'E505', 'R505', 1, 1, 1, NULL, 1, 0, '$2y$12$A2SAL6ATQ0QkO5jvC98rre7vHja9QISCTcLmTySGbrvPdGeDUQqoy', NULL, '199900000005', 'DE00005', 'Batharamulla', NULL, NULL, NULL, 'Unit Clerk', NULL, '2025-11-05 06:29:06', '2025-11-05 06:29:06'),
(6, 'Bimal', 'bimal@gmail.com', '0710000006', 'PahalaYagoda, Ganemulla', 'E506', 'R506', 1, 1, 1, NULL, 1, 0, '$2y$12$6rE7CQHjfjPSESg3Et6FMeyS3DXHovsNLzCAynPKEJvqT3jFcw.kO', NULL, '199900000006', 'DE00006', 'Batharamulla', NULL, NULL, NULL, 'Shop Coord Clerk', NULL, '2025-11-05 06:29:06', '2025-11-05 06:29:06'),
(7, 'janith', 'janith@gmail.com', '0710000007', 'PahalaYagoda, Ganemulla', 'E507', 'R507', 1, 1, 1, NULL, 1, 0, '$2y$12$lNJotyPCTzXbg2kivEDt0eiBF3tKGdgEzjO4IhMtw4cS4MFqi1Bs.', NULL, '199900000007', 'DE00007', 'Batharamulla', NULL, NULL, NULL, 'Membership Clerk', NULL, '2025-11-05 06:29:06', '2025-11-05 06:29:06'),
(8, 'januth', 'januth@gmail.com', '0710000008', 'PahalaYagoda, Ganemulla', 'E508', 'R508', 1, 1, 1, NULL, 1, 0, '$2y$12$PZc08GWb5H1sDumjTTLP8.AioYSv6m/ldRiM.Y0vxfSX.RpS5hG/m', NULL, '199900000008', 'DE00008', 'Batharamulla', NULL, NULL, NULL, 'Membership OC', NULL, '2025-11-05 06:29:06', '2025-11-05 06:29:06'),
(9, 'jayathilaka', 'jayee@gmail.com', '0710000009', 'PahalaYagoda, Ganemulla', 'E509', 'R509', 1, 1, 1, NULL, 1, 0, '$2y$12$Vky7vGbiI6/S7vYVNNBmyeJzPgviwdiu1L39Xff.CEe4KprmlCQVK', NULL, '199900000009', 'DE00009', 'Batharamulla', NULL, NULL, NULL, 'Shop Coord OC', NULL, '2025-11-05 06:29:06', '2025-11-05 06:29:06'),
(10, 'kamal', 'kamal@gmail.com', '0710000010', 'PahalaYagoda, Ganemulla', 'E510', 'R510', 1, 1, 1, NULL, 1, 0, '$2y$12$f0f8u67Ku4FvW3eZYOWrl..YfGBRu2gOJM9LXqlkzkqrWd7PLCYau', NULL, '199900000010', 'DE00010', 'Batharamulla', NULL, NULL, NULL, 'Loan OC', NULL, '2025-11-05 06:29:06', '2025-11-05 06:29:06'),
(11, 'Isuru', 'isuru@gmail.com', '0710000011', 'PahalaYagoda, Ganemulla', 'E511', 'R511', 1, 1, 1, NULL, 1, 0, '$2y$12$VCTpY8D79ZfUnd8ZRIGqOOESA5cNp8OzFCRB2yipE/N5/RjrVc9QG', NULL, '199900000011', 'DE00011', 'Batharamulla', NULL, NULL, NULL, 'Staff Officer', NULL, '2025-11-05 06:29:06', '2025-11-05 06:29:06'),
(12, 'Naveen', 'naveen@gmail.com', '0710000012', 'PahalaYagoda, Ganemulla', 'E512', 'R512', 1, 1, 1, NULL, 1, 0, '$2y$12$M8y6wINK3IOy7C0.5DUzVO/3ESO0HzJBJkTwCY8CVIrADUdApPnt.', NULL, '199900000012', 'DE00012', 'Batharamulla', NULL, NULL, 2, 'Welfare Shop Clerk', NULL, '2025-11-05 06:29:06', '2025-11-05 06:56:45'),
(13, 'Nuwan', 'nuwan@gmail.com', '0710000013', 'PahalaYagoda, Ganemulla', 'E513', 'R513', 1, 1, 1, NULL, 1, 0, '$2y$12$pDK.cen9iEZRzBA1g6RD7uXEI8DLcyjpaPQ0Em.p7mNeHDc8T.zre', NULL, '199900000013', 'DE00013', 'Batharamulla', NULL, NULL, 1, 'Welfare Shop Clerk', NULL, '2025-11-05 06:29:06', '2025-11-05 06:56:31'),
(14, 'Suneth', 'suneth@gmail.com', '0710000014', 'PahalaYagoda, Ganemulla', 'E514', 'R514', 1, 1, 1, NULL, 1, 0, '$2y$12$1D2DfMF88qhzvs5yDeJ1z.xNrLfndgkXY.KSb328en1ZTU9cmHaGO', NULL, '199900000014', 'DE00014', 'Batharamulla', NULL, NULL, 2, 'Welfare Shop OC', NULL, '2025-11-05 06:29:06', '2025-11-05 06:56:52'),
(15, 'Ruwan', 'ruwan@gmail.com', '0710000015', 'PahalaYagoda, Ganemulla', 'E515', 'R515', 1, 1, 1, NULL, 1, 0, '$2y$12$l12s5YHfafVrgm8MRAvwiuDYqyann0iPmknEs6xKlK4.CE3HSHKWK', NULL, '199900000015', 'DE00015', 'Batharamulla', NULL, NULL, 1, 'Welfare Shop OC', NULL, '2025-11-05 06:29:06', '2025-11-05 06:56:39'),
(16, 'Vijay', 'vijay@gmail.com', '0710000016', 'PahalaYagoda, Ganemulla', 'E516', 'R516', 1, 1, 1, NULL, 1, 0, '$2y$12$OZI0/BuLLr24fTdqUZuyAuedWm9Rk1YehzK0G/fCBRrKqaGL6p2Zq', NULL, '199900000016', 'DE00016', 'Batharamulla', NULL, NULL, NULL, 'User', NULL, '2025-11-05 06:29:06', '2025-11-05 06:29:06');

-- --------------------------------------------------------

--
-- Table structure for table `welfares`
--

CREATE TABLE `welfares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `welfare_number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `delete` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `welfares`
--

INSERT INTO `welfares` (`id`, `welfare_number`, `name`, `location`, `active`, `delete`, `created_at`, `updated_at`) VALUES
(1, 'WT-0001', 'Colombo', '6.935114408572955,79.84473303459077', 0, 0, '2025-11-05 06:53:53', '2025-11-05 06:55:44'),
(2, 'WT-0002', 'jaffna', '9.668196371875569,80.01475475568063', 0, 0, '2025-11-05 06:54:20', '2025-11-05 06:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `welfare_memberships`
--

CREATE TABLE `welfare_memberships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `membership_date` date DEFAULT NULL,
  `army_id` varchar(255) NOT NULL,
  `regiment_no` varchar(255) NOT NULL,
  `nic` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approved_loans`
--
ALTER TABLE `approved_loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categorys_category_unique` (`category`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `item_loans`
--
ALTER TABLE `item_loans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_loans_application_id_unique` (`application_id`),
  ADD KEY `item_loans_welfare_id_foreign` (`welfare_id`),
  ADD KEY `item_loans_created_by_foreign` (`created_by`),
  ADD KEY `item_loans_approved_by_foreign` (`approved_by`),
  ADD KEY `item_loans_shop_coord_approved_by_foreign` (`shop_coord_approved_by`),
  ADD KEY `item_loans_shop_coord_oc_approved_by_foreign` (`shop_coord_oc_approved_by`),
  ADD KEY `item_loans_final_approved_by_foreign` (`final_approved_by`),
  ADD KEY `item_loans_rejected_by_foreign` (`rejected_by`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loans_application_id_unique` (`application_id`),
  ADD KEY `loans_created_by_foreign` (`created_by`),
  ADD KEY `loans_approved_by_foreign` (`approved_by`),
  ADD KEY `loans_oc_approved_by_foreign` (`oc_approved_by`),
  ADD KEY `loans_rejected_by_foreign` (`rejected_by`);

--
-- Indexes for table `loan_interests`
--
ALTER TABLE `loan_interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `memberships_email_unique` (`email`),
  ADD UNIQUE KEY `memberships_mobile_unique` (`mobile`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `person_issueds`
--
ALTER TABLE `person_issueds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_issueds_item_loan_id_foreign` (`item_loan_id`),
  ADD KEY `person_issueds_approved_loan_id_foreign` (`approved_loan_id`),
  ADD KEY `person_issueds_stock_id_foreign` (`stock_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_product_number_unique` (`product_number`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchase_orders_po_number_unique` (`po_number`),
  ADD KEY `purchase_orders_welfare_id_foreign` (`welfare_id`);

--
-- Indexes for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_order_items_purchase_order_id_foreign` (`purchase_order_id`);

--
-- Indexes for table `ranks`
--
ALTER TABLE `ranks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ranks_rank_unique` (`rank`);

--
-- Indexes for table `regements`
--
ALTER TABLE `regements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regements_regement_unique` (`regement`);

--
-- Indexes for table `rejected_loans`
--
ALTER TABLE `rejected_loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rejected_loans_loan_id_foreign` (`loan_id`),
  ADD KEY `rejected_loans_item_loan_id_foreign` (`item_loan_id`),
  ADD KEY `rejected_loans_rejected_by_foreign` (`rejected_by`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stocks_serial_number_unique` (`serial_number`),
  ADD KEY `stocks_purchase_order_id_foreign` (`purchase_order_id`),
  ADD KEY `stocks_purchase_order_item_id_foreign` (`purchase_order_item_id`),
  ADD KEY `stocks_product_id_foreign` (`product_id`),
  ADD KEY `stocks_welfare_id_foreign` (`welfare_id`);

--
-- Indexes for table `supplys`
--
ALTER TABLE `supplys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supplys_supply_number_unique` (`supply_number`),
  ADD UNIQUE KEY `supplys_supply_unique` (`supply`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `units_unit_unique` (`unit`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `users_employee_no_unique` (`employee_no`),
  ADD UNIQUE KEY `users_regement_no_unique` (`regement_no`),
  ADD UNIQUE KEY `users_nic_unique` (`nic`),
  ADD UNIQUE KEY `users_armyid_unique` (`armyId`);

--
-- Indexes for table `welfares`
--
ALTER TABLE `welfares`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `welfares_welfare_number_unique` (`welfare_number`),
  ADD UNIQUE KEY `welfares_name_unique` (`name`);

--
-- Indexes for table `welfare_memberships`
--
ALTER TABLE `welfare_memberships`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `welfare_memberships_email_unique` (`email`),
  ADD UNIQUE KEY `welfare_memberships_mobile_unique` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approved_loans`
--
ALTER TABLE `approved_loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categorys`
--
ALTER TABLE `categorys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_loans`
--
ALTER TABLE `item_loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loan_interests`
--
ALTER TABLE `loan_interests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `person_issueds`
--
ALTER TABLE `person_issueds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ranks`
--
ALTER TABLE `ranks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `regements`
--
ALTER TABLE `regements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `rejected_loans`
--
ALTER TABLE `rejected_loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplys`
--
ALTER TABLE `supplys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `welfares`
--
ALTER TABLE `welfares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `welfare_memberships`
--
ALTER TABLE `welfare_memberships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item_loans`
--
ALTER TABLE `item_loans`
  ADD CONSTRAINT `item_loans_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `item_loans_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_loans_final_approved_by_foreign` FOREIGN KEY (`final_approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `item_loans_rejected_by_foreign` FOREIGN KEY (`rejected_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `item_loans_shop_coord_approved_by_foreign` FOREIGN KEY (`shop_coord_approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `item_loans_shop_coord_oc_approved_by_foreign` FOREIGN KEY (`shop_coord_oc_approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `item_loans_welfare_id_foreign` FOREIGN KEY (`welfare_id`) REFERENCES `welfares` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `loans_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loans_oc_approved_by_foreign` FOREIGN KEY (`oc_approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `loans_rejected_by_foreign` FOREIGN KEY (`rejected_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

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
-- Constraints for table `person_issueds`
--
ALTER TABLE `person_issueds`
  ADD CONSTRAINT `person_issueds_approved_loan_id_foreign` FOREIGN KEY (`approved_loan_id`) REFERENCES `approved_loans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `person_issueds_item_loan_id_foreign` FOREIGN KEY (`item_loan_id`) REFERENCES `item_loans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `person_issueds_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD CONSTRAINT `purchase_orders_welfare_id_foreign` FOREIGN KEY (`welfare_id`) REFERENCES `welfares` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  ADD CONSTRAINT `purchase_order_items_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rejected_loans`
--
ALTER TABLE `rejected_loans`
  ADD CONSTRAINT `rejected_loans_item_loan_id_foreign` FOREIGN KEY (`item_loan_id`) REFERENCES `item_loans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rejected_loans_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rejected_loans_rejected_by_foreign` FOREIGN KEY (`rejected_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `stocks_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_purchase_order_item_id_foreign` FOREIGN KEY (`purchase_order_item_id`) REFERENCES `purchase_order_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_welfare_id_foreign` FOREIGN KEY (`welfare_id`) REFERENCES `welfares` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
