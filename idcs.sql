-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2019 at 04:23 PM
-- Server version: 5.7.11-log
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `idcs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--
-- password = `123456`
INSERT INTO `admins` (`id`, `name`, `email`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'john', 'john@gmail.com', '$2y$10$6ubLrG.3Q6UEgQyfIMoMKeT7q/jkLZJid1NYrH2ZevrGp/0H44Lza', 1, 'aVzqZmZwzYOTDwtnxyEuTV3nGC6pRmv7poxre3QasjDTxFFKzCJcyKl2d7nU', NULL, '2018-05-28 16:58:19'),
(2, 'kirio', 'admin1@admin1.com', '$2y$10$Deq/GBgWyY6ZYQR880HfO.tJEgPAVyJOP2gsxaUKz4VuqwLJLadWe', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_no` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Dob` date NOT NULL,
  `phoneNumber` int(11) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `depart_id` int(10) UNSIGNED NOT NULL,
  `depart_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accessLevel` int(10) UNSIGNED NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verifyToken` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_no`, `name`, `Dob`, `phoneNumber`, `email`, `image`, `address`, `gender`, `position_id`, `depart_id`, `depart_type`, `accessLevel`, `password`, `verifyToken`, `remember_token`, `active`, `created_at`, `updated_at`) VALUES
(5, 111111, 'neweede', '1990-01-01', 112323, 'newdetee@gmail.com', '1522215507.jpg', 'rert', '1', '3', 4, '', 1, '', NULL, NULL, 1, '2018-03-28 02:38:27', '2018-03-28 02:38:27'),
(6, 123456, 'neweede', '1990-01-01', 112323, 'nedwdetee@gmail.com', '1522215624.jpg', 'rert', '1', '3', 4, '', 2, '', NULL, NULL, 1, '2018-03-28 02:40:24', '2018-03-28 02:40:24'),
(7, 122345, 'eww', '1990-01-01', 112323, 'neeww@gmail.com', '1522349780.png', 'rert', '2', '1', 4, '', 1, '', NULL, NULL, 2, '2018-03-29 15:56:20', '2018-03-29 15:56:20'),
(8, 123345, 'eww', '1990-01-01', 112323, 'ee@gmail.com', '1522350140.jpg', '123 Nairobi', '1', '5', 7, '', 5, '', NULL, NULL, 1, '2018-03-29 16:02:20', '2018-03-29 16:02:20'),
(13, 123445, 'old', '1990-01-01', 9988, 'old@old.com', '1522405379.jpg', '22 Mombasa', '1', '5', 8, '', 3, '', NULL, NULL, 0, '2018-03-30 07:22:59', '2018-03-30 07:22:59'),
(14, 123455, 'eww', '1990-01-01', 112323, 'ttttw@gmail.com', '1522407878.jpg', '123 Nairobi', '2', '3', 9, '', 4, '', NULL, NULL, 1, '2018-03-30 08:04:38', '2018-03-30 08:04:38'),
(15, 112345, 'neweee', '1990-01-01', 112323, 'wwwppp@gmail.com', '1522477138.png', '123 Nairobi', '2', '5', 11, '', 2, '', NULL, NULL, 1, '2018-03-31 03:18:58', '2018-03-31 03:18:58'),
(16, 353961, 'new test', '1990-01-01', 112323, 'new@new.com', '1523269390.jpg', '123 Nairobi', '2', '1', 10, 'App\\Employee', 3, '', NULL, NULL, 1, '2018-04-09 07:23:10', '2018-04-09 07:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `employee_id`, `name`, `size`, `description`, `type`, `created_at`, `updated_at`) VALUES
(1, 6, 'filename', '14000', 'filename', 'jpg', NULL, NULL),
(2, 6, 'filename', '6000', 'folder', 'jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fileshareds`
--

CREATE TABLE `fileshareds` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_id` int(10) UNSIGNED NOT NULL,
  `sent_by` int(10) UNSIGNED NOT NULL,
  `sent_to` int(10) UNSIGNED NOT NULL,
  `seen_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fileshareds`
--

INSERT INTO `fileshareds` (`id`, `file_id`, `sent_by`, `sent_to`, `seen_by`, `created_at`, `updated_at`) VALUES
(10, 1, 6, 7, 7, NULL, NULL),
(11, 1, 6, 6, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `maindepartments`
--

CREATE TABLE `maindepartments` (
  `id` int(11) UNSIGNED NOT NULL,
  `depart_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hod_id` int(11) DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `maindepartments`
--

INSERT INTO `maindepartments` (`id`, `depart_id`, `name`, `hod_id`, `description`, `created_at`, `updated_at`) VALUES
(4, 123, 'sales & Marketing', 1, 'Deals with marketing of the company products', '2018-03-31 04:28:41', '2018-03-31 04:28:41'),
(7, 123456, 'Human Resource', 1, 'Handles all the company human personnel', '2018-03-31 04:51:41', '2018-03-31 04:51:41'),
(8, 21234, 'Transport', 1, 'Management of all company vehicles', '2018-03-31 05:05:21', '2018-03-31 05:05:21'),
(9, 43212, 'Store and Record', 1, 'Keeps all the records in a company. Is responsible for acquiring equipments to be used within the company', '2018-04-03 04:57:16', '2018-04-03 04:57:16'),
(10, 3214, 'I.C.T', 1, 'Manages all computers and technical equipments', '2018-04-03 06:14:40', '2018-04-03 06:14:40'),
(11, 4312242, 'saleswet', 1, 'sdaf', '2018-04-03 06:47:29', '2018-04-03 06:47:29'),
(15, 994457, 'Doctors', 1, 'Supervises the doctors', '2018-04-05 07:32:20', '2018-04-05 07:32:20');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `from_user_id` int(10) UNSIGNED NOT NULL,
  `to_user_id` int(10) UNSIGNED NOT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_user_id`, `to_user_id`, `text`, `created_at`, `updated_at`) VALUES
(1, 6, 6, 'hello, there will be a meeting tomorrow noon', '2019-01-23 12:54:36', '2019-01-23 12:54:36'),
(2, 6, 6, 'nono am i a', '2019-01-28 10:52:31', '2019-01-28 10:52:31'),
(3, 6, 1, 'nananan', '2019-01-28 10:53:20', '2019-01-28 10:53:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_03_20_071120_create_employees_table', 1),
(4, '2018_03_23_211116_create_no_table', 1),
(5, '2018_03_23_211633_create_usersNew_table', 1),
(6, '2018_03_26_105032_create_new_table', 2),
(7, '2018_03_28_063917_edit_employees_table', 2),
(8, '2018_03_30_155726_create_department_table', 3),
(9, '2018_03_30_183239_create_main_departments_table', 4),
(10, '2018_03_30_191758_create_sub_departments_table', 5),
(11, '2018_03_30_193745_rename_table_column', 6),
(12, '2018_03_31_091851_edit_column_hod_id', 7),
(13, '2018_03_31_092253_edit_column_hod_id', 8),
(14, '2018_04_01_182148_create_projects_table', 9),
(15, '2018_04_01_185952_create_projects_table', 10),
(16, '2018_04_01_195554_edit_table_projects', 11),
(17, '2018_04_01_200753_drop_column_target_time', 12),
(18, '2018_04_02_040451_rename_column_target_members', 13),
(19, '2018_04_02_085917_rename_column_started_by', 14),
(20, '2018_04_03_073038_add_column_passwords', 15),
(21, '2018_04_03_094856_edit_column_depart_id', 15),
(22, '2018_04_03_100310_edit_column_deppart_id', 16),
(23, '2018_04_03_100931_edit_column_deppart_id', 17),
(24, '2018_04_05_075615_edit_column_depart_id', 18),
(25, '2018_04_05_093645_add_employee_no', 19),
(26, '2018_04_05_093936_add_employee_no', 20),
(27, '2018_04_05_094004_add_employee_no', 21),
(28, '2018_04_05_103928_edit_column_department', 22),
(29, '2018_04_06_051900_create_positions_table', 22),
(30, '2018_04_06_053129_create_positions_table', 23),
(31, '2018_04_06_053149_create_positions_table', 24),
(32, '2018_04_06_095053_edit_department_column', 25),
(33, '2018_04_06_102840_edit_column_depart_id', 26),
(34, '2018_04_06_103824_new_column_depart_id', 27),
(35, '2018_04_06_191017_rename_departmen', 28),
(36, '2018_04_06_191747_edit_access_level', 29),
(37, '2018_04_06_194256_edit_department_id_main', 30),
(38, '2018_04_06_195710_edit_position', 31),
(39, '2018_04_07_094124_create_department_hods_table', 32),
(40, '2018_04_07_095413_edit_employee_id', 33),
(41, '2018_04_09_092836_add_column_depart_type', 34),
(42, '2018_04_09_134856_create_tasks_table', 35),
(43, '2018_05_03_074833_create_positions_table', 36),
(44, '2018_05_05_073511_create_table_who', 37),
(45, '2018_05_10_104442_create_admin_table', 37),
(46, '2018_05_22_190150_create_table_files', 38),
(47, '2018_05_25_210410_edit_files_table', 39),
(48, '2018_05_26_110626_creat_admins_table', 40),
(49, '2018_05_29_123648_create_roles_table', 41),
(50, '2018_05_29_123712_create_role_admins_table', 41),
(51, '2018_05_30_043805_edit_users_table', 42),
(52, '2018_05_30_082949_file_shared', 43),
(53, '2018_06_01_032958_edit_files_table', 44),
(54, '2018_06_02_185806_create_tasks_table', 45),
(55, '2018_06_02_191029_create_tasks_table', 46),
(56, '2018_06_14_105237_create_table_messages', 47),
(57, '2019_01_23_134442_create_table_tasks', 48),
(58, '2019_01_23_141503_create_table_tasks', 49),
(59, '2019_01_23_142018_create_table_tasks', 50),
(60, '2019_01_23_143706_create_table_files', 51),
(61, '2019_01_23_144230_create_table_file_shared', 52),
(62, '2019_01_23_144638_create_table_file_shared', 53);

-- --------------------------------------------------------

--
-- Table structure for table `new`
--

CREATE TABLE `new` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('helo@helo.com', '$2y$10$lmb.gYmMZlIDx0Jhom6mwO4iBZt8W9YbfnQeahLxCtSfE3IhK5Li.', '2018-05-26 12:19:54'),
('new@new.com', '$2y$10$zPRuumhFcqr/0o8uVs7xyetdIeWFh1LotXIGkm1rGP5OFXwPlslAq', '2018-05-26 13:12:41'),
('john.com', '$2y$10$YIvfeHf2hIULLxhdjfXIRO3rrmDzGAefHwzzySQNlvg26KRLLlsA6', '2018-05-27 13:28:44'),
('admin1@admin1.com', '$2y$10$gnZnOhxLWDA61k6ENbyWzeixmvOOixnkW2g2aXcXm0/XtY6282NEG', '2018-05-27 13:37:31');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2018-05-04 21:00:00', '2018-05-04 21:00:00'),
(2, 'System Administrator', '2018-05-04 21:00:00', '2018-05-04 21:00:00'),
(3, 'CEO', '2018-05-04 21:00:00', '2018-05-04 21:00:00'),
(4, 'Finance', '2018-05-04 21:00:00', '2018-05-04 21:00:00'),
(5, 'Manager', '2018-05-04 21:00:00', '2018-05-04 21:00:00'),
(6, 'Staff', '2018-05-04 21:00:00', '2018-05-04 21:00:00'),
(7, 'None', '2018-05-04 21:00:00', '2018-05-04 21:00:00'),
(8, 'I.C.T', '2018-05-04 21:00:00', '2018-05-04 21:00:00'),
(9, 'Secretary', '2018-05-04 21:00:00', '2018-05-04 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `reminder_date` date DEFAULT NULL,
  `reminder_time` time DEFAULT NULL,
  `reminder_message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_date` date DEFAULT NULL,
  `target_message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_members` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_id`, `name`, `start_date`, `end_date`, `status`, `user_id`, `reminder_date`, `reminder_time`, `reminder_message`, `target_date`, `target_message`, `description`, `team_members`, `created_at`, `updated_at`) VALUES
(3, 0, 'first', '2018-02-12', '2018-04-01', '0', 2, '2018-03-03', '12:12:12', 'lorem', '2018-02-02', 'dsfds', 'loremss', '1,2,,4', '2018-04-02 01:07:55', '2018-04-02 01:07:55'),
(6, 34563, 'second', '2018-02-12', '2018-04-01', '0', 1, '2018-03-03', '12:12:12', 'lorem', '2018-02-02', 'dsfds', 'loremss', '1,2,,4', '2018-04-02 01:14:57', '2018-04-02 01:14:57'),
(12, 5354, 'third', '2018-04-02', '2018-04-03', '0', 2, NULL, NULL, NULL, NULL, NULL, 'oops', '1,2,,4', '2018-04-02 03:43:37', '2018-04-02 03:43:37'),
(13, 4444, 'second projecdt', '2018-03-12', '2018-04-13', '30', 3, '2018-03-12', '12:12:12', 'ipsum lorem none', '2018-12-12', 'who are you today', 'second project', '1,2,3,4,5', '2018-04-02 04:16:55', '2018-04-02 04:16:55'),
(15, 554354, 'hello new', '2018-04-02', '2018-04-04', '0', 2, NULL, NULL, NULL, NULL, NULL, 'noops', '1,2,,4', '2018-04-02 06:58:33', '2018-04-02 06:58:33'),
(17, 5544354, 'hello newer', '2018-04-02', '2018-04-04', '0', 2, NULL, NULL, NULL, NULL, NULL, 'noops', '1,2,,4', '2018-04-02 07:03:05', '2018-04-02 07:03:05'),
(18, 55444354, 'hello newere', '2018-04-02', '2018-04-04', '0', 2, NULL, NULL, NULL, NULL, NULL, 'noops', '1,2,,4', '2018-04-02 07:03:38', '2018-04-02 07:03:38'),
(20, 51354, 'nono', '2018-04-02', '2018-04-04', '0', 2, NULL, NULL, NULL, NULL, NULL, 'noops', '1,2,,4', '2018-04-02 07:04:36', '2018-04-02 07:04:36'),
(21, 513540, 'nonoert', '2018-04-02', '2018-04-04', '0', 2, NULL, NULL, NULL, NULL, NULL, 'noops', '1,2,,4', '2018-04-02 07:08:56', '2018-04-02 07:08:56'),
(24, 511354, 'oopsdf', '2018-04-04', '2018-04-05', '0', 2, NULL, NULL, NULL, NULL, NULL, 'jdsf', '1,2,,4', '2018-04-02 07:13:16', '2018-04-02 07:13:16'),
(26, 51134554, 'Count the money', '2018-04-02', '2018-04-03', '0', 1, NULL, NULL, NULL, NULL, NULL, 'Go to the accounts desk and check the books. Do all the balance and confirm all is okay', '1,2,,4', '2018-04-02 07:44:50', '2018-04-02 07:44:50'),
(28, 511343554, 'Creating a new company logo', '2018-04-03', '2018-04-10', '0', 1, NULL, NULL, NULL, NULL, NULL, 'Do it fast', '1,2,,4', '2018-04-02 07:50:21', '2018-04-02 07:50:21'),
(29, 511349554, 'People', '2018-06-12', '2019-06-12', '0', 1, NULL, NULL, NULL, NULL, NULL, 'sgdDrfdgdfcfg', '1,2,,4', '2018-05-18 16:36:22', '2018-05-18 16:36:22'),
(35, 5154, 'sadf', '2018-09-09', '2018-10-10', '0', 6, NULL, NULL, NULL, NULL, NULL, 'sdf', '1,2,,4', '2018-06-01 15:50:07', '2018-06-01 15:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `subdepartments`
--

CREATE TABLE `subdepartments` (
  `id` int(10) UNSIGNED NOT NULL,
  `depart_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mainDepartment_id` int(10) UNSIGNED NOT NULL,
  `hod_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subdepartments`
--

INSERT INTO `subdepartments` (`id`, `depart_id`, `name`, `mainDepartment_id`, `hod_id`, `description`, `created_at`, `updated_at`) VALUES
(2, 1234, 'cashier ', 4, 6, 'lorem ipsum', '2018-04-05 05:41:45', '2018-04-05 05:41:45'),
(4, 12348, 'procurement', 4, 6, 'wertyu', '2018-04-05 05:45:05', '2018-04-05 05:45:05'),
(8, 124348, 'procurement1', 9, 6, 'buying and selling goods', '2018-04-05 06:24:14', '2018-04-05 06:24:14'),
(9, 635869, 'Reception', 4, 8, 'Receiving visitors', '2018-04-05 07:23:15', '2018-04-05 07:23:15'),
(10, 929336, 'nurse', 15, 15, 'nurses', '2018-04-05 07:34:00', '2018-04-05 07:34:00'),
(11, 624568, 'networking', 10, 6, 'manage networking cables', '2018-04-09 02:49:07', '2018-04-09 02:49:07');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `from_user_id` int(10) UNSIGNED NOT NULL,
  `to_user_id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complete` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `from_user_id`, `to_user_id`, `subject`, `description`, `complete`, `created_at`, `updated_at`) VALUES
(1, 6, 7, 'Lorem ipsum message', 'Lorem ipsum message', 1, '2019-01-22 21:00:00', '2019-01-22 21:00:00'),
(2, 6, 7, 'Lorem ipsum message', 'Lorem ipsum message', 0, '2019-01-21 21:00:00', '2019-01-21 21:00:00'),
(3, 6, 7, 'Lorem ipsum message', 'Lorem ipsum message', 1, '2019-01-22 21:00:00', '2019-01-22 21:00:00'),
(4, 6, 7, 'Lorem ipsum message', 'Lorem ipsum message', 0, '2019-01-22 21:00:00', '2019-01-22 21:00:00'),
(5, 6, 1, '1', 'New tasks', 0, '2019-01-28 11:20:56', '2019-01-28 11:20:56'),
(6, 6, 6, '1', 'New tasks', 0, '2019-01-28 11:20:56', '2019-01-28 11:20:56'),
(7, 6, 7, '1', 'New tasks', 0, '2019-01-28 11:20:56', '2019-01-28 11:20:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Dob` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `depart_id` int(10) UNSIGNED NOT NULL,
  `depart_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accesslevel` int(11) NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` int(11) NOT NULL,
  `verifyToken` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `Dob`, `phoneNumber`, `image`, `address`, `role`, `depart_id`, `depart_type`, `accesslevel`, `password`, `gender`, `verifyToken`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Moto Mambo', 'new@new.com', '2018-01-10', 1, '1', '1', 3, 4, '0', 0, '$2y$10$MLQ6JDbOv8G3.q5ZpnPUVOivmzlb4gP5FNQTMx1yeOqpOpoLsc/nO', 3, NULL, 1, 'aA5Ak8S48bAs6K0OcVsjETXPfoLzb7P5F1b5C2P889EAp6dtkdMlqoSi2EgQ', '2018-05-30 02:13:51', '2018-05-30 02:16:23'),
(6, 'Johnie Joe', 'johnie@gmail.com', '2018-01-10', 1111111111, '1', '1', 1, 10, '1', 1, '$2y$10$il3FqZb69XQDEllTtvVkGOHZp66NbCsEQ3Sz4tSVABRi.R3w4xhrW', 1, NULL, 0, 'QH1aPOTL5SEykoa2Xrk2wc2gIWCoDqt0O5msC3Ghh67G11FU4VbOc9talOkP', '2018-05-30 02:53:56', '2018-05-30 02:54:26'),
(7, 'mary Jones', 'mary@mary.com', '1963-03-03', 123456, 'null', '12 Momnbasa', 0, 15, '0', 0, '$2y$10$il3FqZb69XQDEllTtvVkGOHZp66NbCsEQ3Sz4tSVABRi.R3w4xhrW', 3, NULL, 1, '$2y$10$il3FqZb69XQDEllTtvVkGOHZp66NbCsEQ3Sz4tSVABRi.R3w4xhrW', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD UNIQUE KEY `employees_employee_no_unique` (`employee_no`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `fileshareds`
--
ALTER TABLE `fileshareds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fileshared_file_id_foreign` (`file_id`),
  ADD KEY `fileshared_sent_by_foreign` (`sent_by`),
  ADD KEY `fileshared_sent_to_foreign` (`sent_to`),
  ADD KEY `fileshared_seen_by_foreign` (`seen_by`);

--
-- Indexes for table `maindepartments`
--
ALTER TABLE `maindepartments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `maindepartments_depart_id_unique` (`depart_id`),
  ADD UNIQUE KEY `maindepartments_name_unique` (`name`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_from_user_id_foreign` (`from_user_id`),
  ADD KEY `messages_to_user_id_foreign` (`to_user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new`
--
ALTER TABLE `new`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `positions_name_unique` (`name`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_project_id_unique` (`project_id`),
  ADD UNIQUE KEY `projects_name_unique` (`name`);

--
-- Indexes for table `subdepartments`
--
ALTER TABLE `subdepartments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subdepartments_depart_id_unique` (`depart_id`),
  ADD UNIQUE KEY `subdepartments_name_unique` (`name`),
  ADD KEY `subdepartments_maindepartment_id_foreign` (`mainDepartment_id`),
  ADD KEY `subdepartments_hod_id_foreign` (`hod_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_from_user_id_foreign` (`from_user_id`),
  ADD KEY `tasks_to_user_id_foreign` (`to_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_depart_id_foreign` (`depart_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fileshareds`
--
ALTER TABLE `fileshareds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `maindepartments`
--
ALTER TABLE `maindepartments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `new`
--
ALTER TABLE `new`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `subdepartments`
--
ALTER TABLE `subdepartments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fileshareds`
--
ALTER TABLE `fileshareds`
  ADD CONSTRAINT `fileshared_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`),
  ADD CONSTRAINT `fileshared_seen_by_foreign` FOREIGN KEY (`seen_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fileshared_sent_by_foreign` FOREIGN KEY (`sent_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fileshared_sent_to_foreign` FOREIGN KEY (`sent_to`) REFERENCES `users` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_from_user_id_foreign` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_to_user_id_foreign` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subdepartments`
--
ALTER TABLE `subdepartments`
  ADD CONSTRAINT `subdepartments_hod_id_foreign` FOREIGN KEY (`hod_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subdepartments_maindepartment_id_foreign` FOREIGN KEY (`mainDepartment_id`) REFERENCES `maindepartments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_from_user_id_foreign` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_to_user_id_foreign` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_depart_id_foreign` FOREIGN KEY (`depart_id`) REFERENCES `maindepartments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
