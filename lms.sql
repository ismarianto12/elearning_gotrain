-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Apr 2024 pada 15.22
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `addons`
--

CREATE TABLE `addons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unique_identifier` varchar(255) NOT NULL,
  `version` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `about` longtext DEFAULT NULL,
  `purchase_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `applications`
--

CREATE TABLE `applications` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bbb_meetings`
--

CREATE TABLE `bbb_meetings` (
  `id` int(20) NOT NULL,
  `course_id` int(11) NOT NULL,
  `meeting_id` varchar(255) DEFAULT NULL,
  `moderator_pw` varchar(255) DEFAULT NULL,
  `viewer_pw` varchar(255) DEFAULT NULL,
  `instructions` longtext DEFAULT NULL,
  `created_at` varchar(100) DEFAULT NULL,
  `updated_at` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` int(11) NOT NULL,
  `blog_category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `description` longtext NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `banner` varchar(100) NOT NULL,
  `is_popular` int(11) NOT NULL,
  `likes` longtext NOT NULL,
  `added_date` varchar(100) NOT NULL,
  `updated_date` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `blog_category`
--

CREATE TABLE `blog_category` (
  `blog_category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `added_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `blog_comments`
--

CREATE TABLE `blog_comments` (
  `blog_comment_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `likes` longtext NOT NULL,
  `added_date` varchar(100) NOT NULL,
  `updated_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id` int(11) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `parent` int(11) DEFAULT 0,
  `slug` varchar(255) DEFAULT NULL,
  `date_added` int(11) DEFAULT NULL,
  `last_modified` int(11) DEFAULT NULL,
  `font_awesome_class` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('6na7rr2f6o5qec2vkbanpc9t71o02sor', '::1', 1712581850, 0x5f5f63695f6c6173745f726567656e65726174657c693a313731323538313137313b636172745f6974656d737c613a303a7b7d6c616e67756167657c733a373a22656e676c697368223b637573746f6d5f73657373696f6e5f6c696d69747c693a313731333434353835303b757365725f69647c733a313a2231223b726f6c655f69647c733a313a2231223b726f6c657c733a353a2241646d696e223b6e616d657c733a31313a2261646d696e2061646d696e223b69735f696e7374727563746f727c733a313a2231223b61646d696e5f6c6f67696e7c733a313a2231223b6c61796f75747c733a343a226c697374223b636f756e7443616c6c7c693a313b5f5f63695f766172737c613a313a7b733a393a22636f756e7443616c6c223b733a333a226f6c64223b7d),
('l7q4ue753le3tfil0i59cqrom6idrl3p', '::1', 1712581172, 0x5f5f63695f6c6173745f726567656e65726174657c693a313731323538313137313b636f756e7443616c6c7c693a313b5f5f63695f766172737c613a313a7b733a393a22636f756e7443616c6c223b733a333a226f6c64223b7d636172745f6974656d737c613a303a7b7d6c616e67756167657c733a373a22656e676c697368223b),
('lmmdou2qtlvbhmgoudv8rlsrnguecmq8', '::1', 1712581172, 0x5f5f63695f6c6173745f726567656e65726174657c693a313731323538313137313b636f756e7443616c6c7c693a313b5f5f63695f766172737c613a313a7b733a393a22636f756e7443616c6c223b733a333a226e6577223b7d636172745f6974656d737c613a303a7b7d6c616e67756167657c733a373a22656e676c697368223b),
('fdl54fov4qd5k2qmgjrkatoupk7h1ngo', '::1', 1712581172, 0x5f5f63695f6c6173745f726567656e65726174657c693a313731323538313137313b636f756e7443616c6c7c693a313b5f5f63695f766172737c613a313a7b733a393a22636f756e7443616c6c223b733a333a226e6577223b7d636172745f6974656d737c613a303a7b7d6c616e67756167657c733a373a22656e676c697368223b),
('bdvc8tmu643e74m0ajsftqju2eeghk0i', '::1', 1712581172, 0x5f5f63695f6c6173745f726567656e65726174657c693a313731323538313137313b636f756e7443616c6c7c693a313b5f5f63695f766172737c613a313a7b733a393a22636f756e7443616c6c223b733a333a226e6577223b7d636172745f6974656d737c613a303a7b7d6c616e67756167657c733a373a22656e676c697368223b),
('p7591jgo90lbcop0h3k40pu5h13vbfds', '::1', 1712581172, 0x5f5f63695f6c6173745f726567656e65726174657c693a313731323538313137313b636f756e7443616c6c7c693a313b5f5f63695f766172737c613a313a7b733a393a22636f756e7443616c6c223b733a333a226e6577223b7d636172745f6974656d737c613a303a7b7d6c616e67756167657c733a373a22656e676c697368223b);

-- --------------------------------------------------------

--
-- Struktur dari tabel `comment`
--

CREATE TABLE `comment` (
  `id` int(11) UNSIGNED NOT NULL,
  `body` longtext DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `commentable_id` int(11) DEFAULT NULL,
  `commentable_type` varchar(50) DEFAULT NULL,
  `date_added` int(11) DEFAULT NULL,
  `last_modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact`
--

CREATE TABLE `contact` (
  `id` int(21) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `message` text DEFAULT NULL,
  `has_read` int(11) DEFAULT NULL,
  `replied` int(11) DEFAULT NULL,
  `created_at` varchar(100) DEFAULT NULL,
  `updated_at` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `discount_percentage` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `expiry_date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `discount_percentage`, `created_at`, `expiry_date`) VALUES
(1, '40N5X6V', '12', 1712548800, 1712548800);

-- --------------------------------------------------------

--
-- Struktur dari tabel `course`
--

CREATE TABLE `course` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `short_description` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `outcomes` longtext DEFAULT NULL,
  `faqs` text NOT NULL,
  `language` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `section` longtext DEFAULT NULL,
  `requirements` longtext DEFAULT NULL,
  `price` double DEFAULT NULL,
  `discount_flag` int(11) DEFAULT 0,
  `discounted_price` double DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `date_added` int(11) DEFAULT NULL,
  `last_modified` int(11) DEFAULT NULL,
  `course_type` varchar(255) DEFAULT NULL,
  `is_top_course` int(11) DEFAULT 0,
  `is_admin` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `course_overview_provider` varchar(255) DEFAULT NULL,
  `meta_keywords` longtext DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `is_free_course` int(11) DEFAULT NULL,
  `multi_instructor` int(11) NOT NULL DEFAULT 0,
  `enable_drip_content` int(11) NOT NULL,
  `creator` int(11) DEFAULT NULL,
  `expiry_period` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `symbol` varchar(255) DEFAULT NULL,
  `paypal_supported` int(11) DEFAULT NULL,
  `stripe_supported` int(11) DEFAULT NULL,
  `ccavenue_supported` int(11) DEFAULT 0,
  `iyzico_supported` int(11) DEFAULT 0,
  `paystack_supported` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `currency`
--

INSERT INTO `currency` (`id`, `name`, `code`, `symbol`, `paypal_supported`, `stripe_supported`, `ccavenue_supported`, `iyzico_supported`, `paystack_supported`) VALUES
(1, 'US Dollar', 'USD', '$', 1, 1, 0, 0, 0),
(2, 'Albanian Lek', 'ALL', 'Lek', 0, 1, 0, 0, 0),
(3, 'Algerian Dinar', 'DZD', 'دج', 1, 1, 0, 0, 0),
(4, 'Angolan Kwanza', 'AOA', 'Kz', 1, 1, 0, 0, 0),
(5, 'Argentine Peso', 'ARS', '$', 1, 1, 0, 0, 0),
(6, 'Armenian Dram', 'AMD', '֏', 1, 1, 0, 0, 0),
(7, 'Aruban Florin', 'AWG', 'ƒ', 1, 1, 0, 0, 0),
(8, 'Australian Dollar', 'AUD', '$', 1, 1, 0, 0, 0),
(9, 'Azerbaijani Manat', 'AZN', 'm', 1, 1, 0, 0, 0),
(10, 'Bahamian Dollar', 'BSD', 'B$', 1, 1, 0, 0, 0),
(11, 'Bahraini Dinar', 'BHD', '.د.ب', 1, 1, 0, 0, 0),
(12, 'Bangladeshi Taka', 'BDT', '৳', 1, 1, 0, 0, 0),
(13, 'Barbadian Dollar', 'BBD', 'Bds$', 1, 1, 0, 0, 0),
(14, 'Belarusian Ruble', 'BYR', 'Br', 0, 0, 0, 0, 0),
(15, 'Belgian Franc', 'BEF', 'fr', 1, 1, 0, 0, 0),
(16, 'Belize Dollar', 'BZD', '$', 1, 1, 0, 0, 0),
(17, 'Bermudan Dollar', 'BMD', '$', 1, 1, 0, 0, 0),
(18, 'Bhutanese Ngultrum', 'BTN', 'Nu.', 1, 1, 0, 0, 0),
(19, 'Bitcoin', 'BTC', '฿', 1, 1, 0, 0, 0),
(20, 'Bolivian Boliviano', 'BOB', 'Bs.', 1, 1, 0, 0, 0),
(21, 'Bosnia', 'BAM', 'KM', 1, 1, 0, 0, 0),
(22, 'Botswanan Pula', 'BWP', 'P', 1, 1, 0, 0, 0),
(23, 'Brazilian Real', 'BRL', 'R$', 1, 1, 0, 0, 0),
(24, 'British Pound Sterling', 'GBP', '£', 1, 1, 0, 0, 0),
(25, 'Brunei Dollar', 'BND', 'B$', 1, 1, 0, 0, 0),
(26, 'Bulgarian Lev', 'BGN', 'Лв.', 1, 1, 0, 0, 0),
(27, 'Burundian Franc', 'BIF', 'FBu', 1, 1, 0, 0, 0),
(28, 'Cambodian Riel', 'KHR', 'KHR', 1, 1, 0, 0, 0),
(29, 'Canadian Dollar', 'CAD', '$', 1, 1, 0, 0, 0),
(30, 'Cape Verdean Escudo', 'CVE', '$', 1, 1, 0, 0, 0),
(31, 'Cayman Islands Dollar', 'KYD', '$', 1, 1, 0, 0, 0),
(32, 'CFA Franc BCEAO', 'XOF', 'CFA', 1, 1, 0, 0, 0),
(33, 'CFA Franc BEAC', 'XAF', 'FCFA', 1, 1, 0, 0, 0),
(34, 'CFP Franc', 'XPF', '₣', 1, 1, 0, 0, 0),
(35, 'Chilean Peso', 'CLP', '$', 1, 1, 0, 0, 0),
(36, 'Chinese Yuan', 'CNY', '¥', 1, 1, 0, 0, 0),
(37, 'Colombian Peso', 'COP', '$', 1, 1, 0, 0, 0),
(38, 'Comorian Franc', 'KMF', 'CF', 1, 1, 0, 0, 0),
(39, 'Congolese Franc', 'CDF', 'FC', 1, 1, 0, 0, 0),
(40, 'Costa Rican ColÃ³n', 'CRC', '₡', 1, 1, 0, 0, 0),
(41, 'Croatian Kuna', 'HRK', 'kn', 1, 1, 0, 0, 0),
(42, 'Cuban Convertible Peso', 'CUC', '$, CUC', 1, 1, 0, 0, 0),
(43, 'Czech Republic Koruna', 'CZK', 'Kč', 1, 1, 0, 0, 0),
(44, 'Danish Krone', 'DKK', 'Kr.', 1, 1, 0, 0, 0),
(45, 'Djiboutian Franc', 'DJF', 'Fdj', 1, 1, 0, 0, 0),
(46, 'Dominican Peso', 'DOP', '$', 1, 1, 0, 0, 0),
(47, 'East Caribbean Dollar', 'XCD', '$', 1, 1, 0, 0, 0),
(48, 'Egyptian Pound', 'EGP', 'ج.م', 1, 1, 0, 0, 0),
(49, 'Eritrean Nakfa', 'ERN', 'Nfk', 1, 1, 0, 0, 0),
(50, 'Estonian Kroon', 'EEK', 'kr', 1, 1, 0, 0, 0),
(51, 'Ethiopian Birr', 'ETB', 'Nkf', 1, 1, 0, 0, 0),
(52, 'Euro', 'EUR', '€', 1, 1, 0, 0, 0),
(53, 'Falkland Islands Pound', 'FKP', '£', 1, 1, 0, 0, 0),
(54, 'Fijian Dollar', 'FJD', 'FJ$', 1, 1, 0, 0, 0),
(55, 'Gambian Dalasi', 'GMD', 'D', 1, 1, 0, 0, 0),
(56, 'Georgian Lari', 'GEL', 'ლ', 1, 1, 0, 0, 0),
(57, 'German Mark', 'DEM', 'DM', 1, 1, 0, 0, 0),
(58, 'Ghanaian Cedi', 'GHS', 'GH₵', 1, 1, 0, 0, 0),
(59, 'Gibraltar Pound', 'GIP', '£', 1, 1, 0, 0, 0),
(60, 'Greek Drachma', 'GRD', '₯, Δρχ, Δρ', 1, 1, 0, 0, 0),
(61, 'Guatemalan Quetzal', 'GTQ', 'Q', 1, 1, 0, 0, 0),
(62, 'Guinean Franc', 'GNF', 'FG', 1, 1, 0, 0, 0),
(63, 'Guyanaese Dollar', 'GYD', '$', 1, 1, 0, 0, 0),
(64, 'Haitian Gourde', 'HTG', 'G', 1, 1, 0, 0, 0),
(65, 'Honduran Lempira', 'HNL', 'L', 1, 1, 0, 0, 0),
(66, 'Hong Kong Dollar', 'HKD', '$', 1, 1, 0, 0, 0),
(67, 'Hungarian Forint', 'HUF', 'Ft', 1, 1, 0, 0, 0),
(68, 'Icelandic KrÃ³na', 'ISK', 'kr', 1, 1, 0, 0, 0),
(69, 'Indian Rupee', 'INR', '₹', 1, 1, 1, 0, 0),
(70, 'Indonesian Rupiah', 'IDR', 'Rp', 1, 1, 0, 0, 0),
(71, 'Iranian Rial', 'IRR', '﷼', 1, 1, 0, 0, 0),
(72, 'Iraqi Dinar', 'IQD', 'د.ع', 1, 1, 0, 0, 0),
(73, 'Israeli New Sheqel', 'ILS', '₪', 1, 1, 0, 0, 0),
(74, 'Italian Lira', 'ITL', 'L,£', 1, 1, 0, 0, 0),
(75, 'Jamaican Dollar', 'JMD', 'J$', 1, 1, 0, 0, 0),
(76, 'Japanese Yen', 'JPY', '¥', 1, 1, 0, 0, 0),
(77, 'Jordanian Dinar', 'JOD', 'ا.د', 1, 1, 0, 0, 0),
(78, 'Kazakhstani Tenge', 'KZT', 'лв', 1, 1, 0, 0, 0),
(79, 'Kenyan Shilling', 'KES', 'KSh', 1, 1, 0, 0, 0),
(80, 'Kuwaiti Dinar', 'KWD', 'ك.د', 1, 1, 0, 0, 0),
(81, 'Kyrgystani Som', 'KGS', 'лв', 1, 1, 0, 0, 0),
(82, 'Laotian Kip', 'LAK', '₭', 1, 1, 0, 0, 0),
(83, 'Latvian Lats', 'LVL', 'Ls', 0, 0, 0, 0, 0),
(84, 'Lebanese Pound', 'LBP', '£', 1, 1, 0, 0, 0),
(85, 'Lesotho Loti', 'LSL', 'L', 1, 1, 0, 0, 0),
(86, 'Liberian Dollar', 'LRD', '$', 1, 1, 0, 0, 0),
(87, 'Libyan Dinar', 'LYD', 'د.ل', 1, 1, 0, 0, 0),
(88, 'Lithuanian Litas', 'LTL', 'Lt', 0, 0, 0, 0, 0),
(89, 'Macanese Pataca', 'MOP', '$', 1, 1, 0, 0, 0),
(90, 'Macedonian Denar', 'MKD', 'ден', 1, 1, 0, 0, 0),
(91, 'Malagasy Ariary', 'MGA', 'Ar', 1, 1, 0, 0, 0),
(92, 'Malawian Kwacha', 'MWK', 'MK', 1, 1, 0, 0, 0),
(93, 'Malaysian Ringgit', 'MYR', 'RM', 1, 1, 0, 0, 0),
(94, 'Maldivian Rufiyaa', 'MVR', 'Rf', 1, 1, 0, 0, 0),
(95, 'Mauritanian Ouguiya', 'MRO', 'MRU', 1, 1, 0, 0, 0),
(96, 'Mauritian Rupee', 'MUR', '₨', 1, 1, 0, 0, 0),
(97, 'Mexican Peso', 'MXN', '$', 1, 1, 0, 0, 0),
(98, 'Moldovan Leu', 'MDL', 'L', 1, 1, 0, 0, 0),
(99, 'Mongolian Tugrik', 'MNT', '₮', 1, 1, 0, 0, 0),
(100, 'Moroccan Dirham', 'MAD', 'MAD', 1, 1, 0, 0, 0),
(101, 'Mozambican Metical', 'MZM', 'MT', 1, 1, 0, 0, 0),
(102, 'Myanmar Kyat', 'MMK', 'K', 1, 1, 0, 0, 0),
(103, 'Namibian Dollar', 'NAD', '$', 1, 1, 0, 0, 0),
(104, 'Nepalese Rupee', 'NPR', '₨', 1, 1, 0, 0, 0),
(105, 'Netherlands Antillean Guilder', 'ANG', 'ƒ', 1, 1, 0, 0, 0),
(106, 'New Taiwan Dollar', 'TWD', '$', 1, 1, 0, 0, 0),
(107, 'New Zealand Dollar', 'NZD', '$', 1, 1, 0, 0, 0),
(108, 'Nicaraguan CÃ³rdoba', 'NIO', 'C$', 1, 1, 0, 0, 0),
(109, 'Nigerian Naira', 'NGN', '₦', 1, 1, 0, 0, 1),
(110, 'North Korean Won', 'KPW', '₩', 0, 0, 0, 0, 0),
(111, 'Norwegian Krone', 'NOK', 'kr', 1, 1, 0, 0, 0),
(112, 'Omani Rial', 'OMR', '.ع.ر', 0, 0, 0, 0, 0),
(113, 'Pakistani Rupee', 'PKR', '₨', 1, 1, 0, 0, 0),
(114, 'Panamanian Balboa', 'PAB', 'B/.', 1, 1, 0, 0, 0),
(115, 'Papua New Guinean Kina', 'PGK', 'K', 1, 1, 0, 0, 0),
(116, 'Paraguayan Guarani', 'PYG', '₲', 1, 1, 0, 0, 0),
(117, 'Peruvian Nuevo Sol', 'PEN', 'S/.', 1, 1, 0, 0, 0),
(118, 'Philippine Peso', 'PHP', '₱', 1, 1, 0, 0, 0),
(119, 'Polish Zloty', 'PLN', 'zł', 1, 1, 0, 0, 0),
(120, 'Qatari Rial', 'QAR', 'ق.ر', 1, 1, 0, 0, 0),
(121, 'Romanian Leu', 'RON', 'lei', 1, 1, 0, 0, 0),
(122, 'Russian Ruble', 'RUB', '₽', 1, 1, 0, 0, 0),
(123, 'Rwandan Franc', 'RWF', 'FRw', 1, 1, 0, 0, 0),
(124, 'Salvadoran ColÃ³n', 'SVC', '₡', 0, 0, 0, 0, 0),
(125, 'Samoan Tala', 'WST', 'SAT', 1, 1, 0, 0, 0),
(126, 'Saudi Riyal', 'SAR', '﷼', 1, 1, 0, 0, 0),
(127, 'Serbian Dinar', 'RSD', 'din', 1, 1, 0, 0, 0),
(128, 'Seychellois Rupee', 'SCR', 'SRe', 1, 1, 0, 0, 0),
(129, 'Sierra Leonean Leone', 'SLL', 'Le', 1, 1, 0, 0, 0),
(130, 'Singapore Dollar', 'SGD', '$', 1, 1, 0, 0, 0),
(131, 'Slovak Koruna', 'SKK', 'Sk', 1, 1, 0, 0, 0),
(132, 'Solomon Islands Dollar', 'SBD', 'Si$', 1, 1, 0, 0, 0),
(133, 'Somali Shilling', 'SOS', 'Sh.so.', 1, 1, 0, 0, 0),
(134, 'South African Rand', 'ZAR', 'R', 1, 1, 0, 0, 0),
(135, 'South Korean Won', 'KRW', '₩', 1, 1, 0, 0, 0),
(136, 'Special Drawing Rights', 'XDR', 'SDR', 1, 1, 0, 0, 0),
(137, 'Sri Lankan Rupee', 'LKR', 'Rs', 1, 1, 0, 0, 0),
(138, 'St. Helena Pound', 'SHP', '£', 1, 1, 0, 0, 0),
(139, 'Sudanese Pound', 'SDG', '.س.ج', 1, 1, 0, 0, 0),
(140, 'Surinamese Dollar', 'SRD', '$', 1, 1, 0, 0, 0),
(141, 'Swazi Lilangeni', 'SZL', 'E', 1, 1, 0, 0, 0),
(142, 'Swedish Krona', 'SEK', 'kr', 1, 1, 0, 0, 0),
(143, 'Swiss Franc', 'CHF', 'CHf', 1, 1, 0, 0, 0),
(144, 'Syrian Pound', 'SYP', 'LS', 0, 0, 0, 0, 0),
(145, 'São Tomé and Príncipe Dobra', 'STD', 'Db', 1, 1, 0, 0, 0),
(146, 'Tajikistani Somoni', 'TJS', 'SM', 1, 1, 0, 0, 0),
(147, 'Tanzanian Shilling', 'TZS', 'TSh', 1, 1, 0, 0, 0),
(148, 'Thai Baht', 'THB', '฿', 1, 1, 0, 0, 0),
(149, 'Tongan pa\'anga', 'TOP', '$', 1, 1, 0, 0, 0),
(150, 'Trinidad & Tobago Dollar', 'TTD', '$', 1, 1, 0, 0, 0),
(151, 'Tunisian Dinar', 'TND', 'ت.د', 1, 1, 0, 0, 0),
(152, 'Turkish Lira', 'TRY', '₺', 1, 1, 0, 1, 0),
(153, 'Turkmenistani Manat', 'TMT', 'T', 1, 1, 0, 0, 0),
(154, 'Ugandan Shilling', 'UGX', 'USh', 1, 1, 0, 0, 0),
(155, 'Ukrainian Hryvnia', 'UAH', '₴', 1, 1, 0, 0, 0),
(156, 'United Arab Emirates Dirham', 'AED', 'إ.د', 1, 1, 0, 0, 0),
(157, 'Uruguayan Peso', 'UYU', '$', 1, 1, 0, 0, 0),
(158, 'Afghan Afghani', 'AFA', '؋', 1, 1, 0, 0, 0),
(159, 'Uzbekistan Som', 'UZS', 'лв', 1, 1, 0, 0, 0),
(160, 'Vanuatu Vatu', 'VUV', 'VT', 1, 1, 0, 0, 0),
(161, 'Venezuelan BolÃvar', 'VEF', 'Bs', 0, 0, 0, 0, 0),
(162, 'Vietnamese Dong', 'VND', '₫', 1, 1, 0, 0, 0),
(163, 'Yemeni Rial', 'YER', '﷼', 1, 1, 0, 0, 0),
(164, 'Zambian Kwacha', 'ZMK', 'ZK', 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `custom_page`
--

CREATE TABLE `custom_page` (
  `custom_page_id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_content` longtext NOT NULL,
  `page_url` varchar(255) NOT NULL,
  `button_title` varchar(255) NOT NULL,
  `button_position` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `enrol`
--

CREATE TABLE `enrol` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `gifted_by` int(11) NOT NULL DEFAULT 0,
  `expiry_date` varchar(255) DEFAULT NULL,
  `date_added` int(11) DEFAULT NULL,
  `last_modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `frontend_settings`
--

CREATE TABLE `frontend_settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `frontend_settings`
--

INSERT INTO `frontend_settings` (`id`, `key`, `value`) VALUES
(1, 'banner_title', 'Start learning from best Platform'),
(2, 'banner_sub_title', 'Study any topic, anytime. Explore thousands of courses for the lowest price ever!'),
(4, 'about_us', '<p></p><h2><span xss=\"removed\">About us</span></h2>'),
(10, 'terms_and_condition', '<h2>Terms and Condition</h2>'),
(11, 'privacy_policy', '<p></p><p></p><h2><span xss=\"removed\">Privacy Policy</span></h2>'),
(13, 'theme', 'default-new'),
(14, 'cookie_note', 'This website uses cookies to personalize content and analyse traffic in order to offer you a better experience.'),
(15, 'cookie_status', 'active'),
(16, 'cookie_policy', '<h1>Cookie policy</h1><ol><li>Cookies are small text files that can be used by websites to make a user\'s experience more efficient.</li><li>The law states that we can store cookies on your device if they are strictly necessary for the operation of this site. For all other types of cookies we need your permission.</li><li>This site uses different types of cookies. Some cookies are placed by third party services that appear on our pages.</li></ol>'),
(17, 'banner_image', '{\"home_1\":\"home-1.png\"}'),
(18, 'light_logo', 'logo-light.png'),
(19, 'dark_logo', 'logo-dark.png'),
(20, 'small_logo', 'logo-light-sm.png'),
(21, 'favicon', 'favicon.png'),
(22, 'recaptcha_status', '0'),
(23, 'recaptcha_secretkey', 'Valid-secret-key'),
(24, 'recaptcha_sitekey', 'Valid-site-key'),
(25, 'refund_policy', '<h2><span xss=\"removed\">Refund Policy</span></h2>'),
(26, 'facebook', 'https://facebook.com'),
(27, 'twitter', 'https://twitter.com'),
(28, 'linkedin', ''),
(31, 'blog_page_title', 'Where possibilities begin'),
(32, 'blog_page_subtitle', 'We’re a leading marketplace platform for learning and teaching online. Explore some of our most popular content and learn something new.'),
(33, 'blog_page_banner', 'blog-page.png'),
(34, 'instructors_blog_permission', '0'),
(35, 'blog_visibility_on_the_home_page', '1'),
(37, 'website_faqs', '[]'),
(38, 'motivational_speech', '[]'),
(39, 'home_page', 'home_1'),
(40, 'contact_info', '{\"email\":\"admin@example.com,\\r\\nsystem@example.com\",\"phone\":\"609-502-5899\\r\\n345-444-2122\",\"address\":\"455 Wolff Streets Suite 674\",\"office_hours\":\"10:00 AM - 6:00 PM\"}'),
(41, 'custom_css', ''),
(42, 'embed_code', ''),
(43, 'top_course_section', '1'),
(44, 'latest_course_section', '1'),
(45, 'top_category_section', '1'),
(46, 'upcoming_course_section', '1'),
(47, 'faq_section', '1'),
(48, 'top_instructor_section', '1'),
(49, 'motivational_speech_section', '1'),
(50, 'promotional_section', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `language`
--

CREATE TABLE `language` (
  `phrase_id` int(11) NOT NULL,
  `phrase` longtext DEFAULT NULL,
  `english` longtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `language`
--

INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES
(1, 'English', 'English'),
(2, '404_not_found', '404 not found'),
(3, '404_not_found', '404 not found'),
(4, 'courses', 'Courses'),
(5, 'courses', 'Courses'),
(6, 'courses', 'Courses'),
(7, 'courses', 'Courses'),
(8, 'courses', 'Courses'),
(9, 'all_courses', 'All courses'),
(10, 'all_courses', 'All courses'),
(11, 'all_courses', 'All courses'),
(12, 'all_courses', 'All courses'),
(13, 'all_courses', 'All courses'),
(14, 'search', 'Search'),
(15, 'search', 'Search'),
(16, 'search', 'Search'),
(17, 'search', 'Search'),
(18, 'search', 'Search'),
(19, 'search', 'Search'),
(20, 'you_have_no_items_in_your_cart!', 'You have no items in your cart!'),
(21, 'you_have_no_items_in_your_cart!', 'You have no items in your cart!'),
(22, 'you_have_no_items_in_your_cart!', 'You have no items in your cart!'),
(23, 'you_have_no_items_in_your_cart!', 'You have no items in your cart!'),
(24, 'you_have_no_items_in_your_cart!', 'You have no items in your cart!'),
(25, 'you_have_no_items_in_your_cart!', 'You have no items in your cart!'),
(26, 'checkout', 'Checkout'),
(27, 'checkout', 'Checkout'),
(28, 'checkout', 'Checkout'),
(29, 'checkout', 'Checkout'),
(30, 'checkout', 'Checkout'),
(31, 'checkout', 'Checkout'),
(32, 'login', 'Login'),
(33, 'login', 'Login'),
(34, 'login', 'Login'),
(35, 'login', 'Login'),
(36, 'login', 'Login'),
(37, 'login', 'Login'),
(38, 'join_now', 'Join now'),
(39, 'join_now', 'Join now'),
(40, 'join_now', 'Join now'),
(41, 'join_now', 'Join now'),
(42, 'join_now', 'Join now'),
(43, 'sign_up', 'Sign up'),
(44, 'sign_up', 'Sign up'),
(45, 'sign_up', 'Sign up'),
(46, 'sign_up', 'Sign up'),
(47, 'sign_up', 'Sign up'),
(48, 'sign_up', 'Sign up'),
(49, 'cart', 'Cart'),
(50, 'cart', 'Cart'),
(51, 'cart', 'Cart'),
(52, 'cart', 'Cart'),
(53, 'cart', 'Cart'),
(54, 'cart', 'Cart'),
(55, 'categories', 'Categories'),
(56, 'categories', 'Categories'),
(57, 'categories', 'Categories'),
(58, 'categories', 'Categories'),
(59, 'categories', 'Categories'),
(60, 'cookie_policy', 'Cookie policy'),
(61, 'cookie_policy', 'Cookie policy'),
(62, 'cookie_policy', 'Cookie policy'),
(63, 'cookie_policy', 'Cookie policy'),
(64, 'cookie_policy', 'Cookie policy'),
(65, 'accept', 'Accept'),
(66, 'accept', 'Accept'),
(67, 'accept', 'Accept'),
(68, 'accept', 'Accept'),
(69, 'accept', 'Accept'),
(70, 'home', 'Home'),
(71, 'home', 'Home'),
(72, 'home', 'Home'),
(73, 'home', 'Home'),
(74, 'home', 'Home'),
(75, 'home', 'Home'),
(76, 'the_page_you_requested_could_not_be_found', 'The page you requested could not be found'),
(77, 'the_page_you_requested_could_not_be_found', 'The page you requested could not be found'),
(78, 'the_page_you_requested_could_not_be_found', 'The page you requested could not be found'),
(79, 'the_page_you_requested_could_not_be_found', 'The page you requested could not be found'),
(80, 'the_page_you_requested_could_not_be_found', 'The page you requested could not be found'),
(81, 'check_the_spelling_of_the_url', 'Check the spelling of the url'),
(82, 'check_the_spelling_of_the_url', 'Check the spelling of the url'),
(83, 'check_the_spelling_of_the_url', 'Check the spelling of the url'),
(84, 'check_the_spelling_of_the_url', 'Check the spelling of the url'),
(85, 'if_you_are_still_puzzled,_click_on_the_home_link_below', 'If you are still puzzled, click on the home link below'),
(86, 'if_you_are_still_puzzled,_click_on_the_home_link_below', 'If you are still puzzled, click on the home link below'),
(87, 'if_you_are_still_puzzled,_click_on_the_home_link_below', 'If you are still puzzled, click on the home link below'),
(88, 'if_you_are_still_puzzled,_click_on_the_home_link_below', 'If you are still puzzled, click on the home link below'),
(89, 'back_to_home', 'Back to home'),
(90, 'back_to_home', 'Back to home'),
(91, 'back_to_home', 'Back to home'),
(92, 'back_to_home', 'Back to home'),
(93, 'back_to_home', 'Back to home'),
(94, 'back_to_home', 'Back to home'),
(95, 'top_categories', 'Top categories'),
(96, 'top_categories', 'Top categories'),
(97, 'top_categories', 'Top categories'),
(98, 'top_categories', 'Top categories'),
(99, 'top_categories', 'Top categories'),
(100, 'top_categories', 'Top categories'),
(101, 'useful_links', 'Useful links'),
(102, 'useful_links', 'Useful links'),
(103, 'useful_links', 'Useful links'),
(104, 'useful_links', 'Useful links'),
(105, 'useful_links', 'Useful links'),
(106, 'useful_links', 'Useful links'),
(107, 'become_an_instructor', 'Become an instructor'),
(108, 'become_an_instructor', 'Become an instructor'),
(109, 'become_an_instructor', 'Become an instructor'),
(110, 'become_an_instructor', 'Become an instructor'),
(111, 'become_an_instructor', 'Become an instructor'),
(112, 'blog', 'Blog'),
(113, 'blog', 'Blog'),
(114, 'blog', 'Blog'),
(115, 'blog', 'Blog'),
(116, 'blog', 'Blog'),
(117, 'help', 'Help'),
(118, 'help', 'Help'),
(119, 'help', 'Help'),
(120, 'help', 'Help'),
(121, 'help', 'Help'),
(122, 'help', 'Help'),
(123, 'contact_us', 'Contact us'),
(124, 'contact_us', 'Contact us'),
(125, 'contact_us', 'Contact us'),
(126, 'contact_us', 'Contact us'),
(127, 'contact_us', 'Contact us'),
(128, 'about_us', 'About us'),
(129, 'about_us', 'About us'),
(130, 'about_us', 'About us'),
(131, 'about_us', 'About us'),
(132, 'about_us', 'About us'),
(133, 'about_us', 'About us'),
(134, 'privacy_policy', 'Privacy policy'),
(135, 'privacy_policy', 'Privacy policy'),
(136, 'privacy_policy', 'Privacy policy'),
(137, 'privacy_policy', 'Privacy policy'),
(138, 'privacy_policy', 'Privacy policy'),
(139, 'terms_and_condition', 'Terms and condition'),
(140, 'terms_and_condition', 'Terms and condition'),
(141, 'terms_and_condition', 'Terms and condition'),
(142, 'terms_and_condition', 'Terms and condition'),
(143, 'terms_and_condition', 'Terms and condition'),
(144, 'terms_and_condition', 'Terms and condition'),
(145, 'faq', 'Faq'),
(146, 'faq', 'Faq'),
(147, 'faq', 'Faq'),
(148, 'faq', 'Faq'),
(149, 'faq', 'Faq'),
(150, 'faq', 'Faq'),
(151, 'refund_policy', 'Refund policy'),
(152, 'refund_policy', 'Refund policy'),
(153, 'refund_policy', 'Refund policy'),
(154, 'refund_policy', 'Refund policy'),
(155, 'refund_policy', 'Refund policy'),
(156, 'refund_policy', 'Refund policy'),
(157, 'subscribe_to_our_newsletter', 'Subscribe to our newsletter'),
(158, 'subscribe_to_our_newsletter', 'Subscribe to our newsletter'),
(159, 'subscribe_to_our_newsletter', 'Subscribe to our newsletter'),
(160, 'subscribe_to_our_newsletter', 'Subscribe to our newsletter'),
(161, 'subscribe_to_our_newsletter', 'Subscribe to our newsletter'),
(162, 'enter_your_email_address', 'Enter your email address'),
(163, 'enter_your_email_address', 'Enter your email address'),
(164, 'enter_your_email_address', 'Enter your email address'),
(165, 'enter_your_email_address', 'Enter your email address'),
(166, 'enter_your_email_address', 'Enter your email address'),
(167, 'enter_your_email_address', 'Enter your email address'),
(168, 'creativeitem', 'Creativeitem'),
(169, 'creativeitem', 'Creativeitem'),
(170, 'creativeitem', 'Creativeitem'),
(171, 'creativeitem', 'Creativeitem'),
(172, 'creativeitem', 'Creativeitem'),
(173, 'are_you_sure', 'Are you sure'),
(174, 'are_you_sure', 'Are you sure'),
(175, 'are_you_sure', 'Are you sure'),
(176, 'are_you_sure', 'Are you sure'),
(177, 'are_you_sure', 'Are you sure'),
(178, 'are_you_sure', 'Are you sure'),
(179, 'yes', 'Yes'),
(180, 'yes', 'Yes'),
(181, 'yes', 'Yes'),
(182, 'yes', 'Yes'),
(183, 'yes', 'Yes'),
(184, 'yes', 'Yes'),
(185, 'no', 'No'),
(186, 'no', 'No'),
(187, 'no', 'No'),
(188, 'no', 'No'),
(189, 'no', 'No'),
(190, 'no', 'No'),
(191, 'log_in', 'Log in'),
(192, 'explore,_learn,_and_grow_with_us._enjoy_a_seamless_and_enriching_educational_journey._lets_begin!', 'Explore, learn, and grow with us. enjoy a seamless and enriching educational journey. lets begin!'),
(193, 'your_email', 'Your email'),
(194, 'enter_your_email', 'Enter your email'),
(195, 'password', 'Password'),
(196, 'enter_your_valid_password', 'Enter your valid password'),
(197, 'forgot_password?', 'Forgot password?'),
(198, 'don`t_have_an_account?', 'Don`t have an account?'),
(199, 'or', 'Or'),
(200, 'invalid_login_credentials', 'Invalid login credentials'),
(201, 'welcome', 'Welcome'),
(202, 'dashboard', 'Dashboard'),
(203, 'quick_actions', 'Quick actions'),
(204, 'create_course', 'Create course'),
(205, 'add_course', 'Add course'),
(206, 'add_new_lesson', 'Add new lesson'),
(207, 'add_lesson', 'Add lesson'),
(208, 'add_student', 'Add student'),
(209, 'enrol_a_student', 'Enrol a student'),
(210, 'enrol_student', 'Enrol student'),
(211, 'help_center', 'Help center'),
(212, 'read_documentation', 'Read documentation'),
(213, 'watch_video_tutorial', 'Watch video tutorial'),
(214, 'get_customer_support', 'Get customer support'),
(215, 'order_customization', 'Order customization'),
(216, 'request_a_new_feature', 'Request a new feature'),
(217, 'browse_addons', 'Browse addons'),
(218, 'get_services', 'Get services'),
(219, 'remove_all', 'Remove all'),
(220, 'notification', 'Notification'),
(221, 'no_notification', 'No notification'),
(222, 'stay_tuned!', 'Stay tuned!'),
(223, 'notifications_about_your_activity_will_show_up_here.', 'Notifications about your activity will show up here.'),
(224, 'notification_settings', 'Notification settings'),
(225, 'mark_all_as_read', 'Mark all as read'),
(226, 'admin', 'Admin'),
(227, 'my_account', 'My account'),
(228, 'settings', 'Settings'),
(229, 'logout', 'Logout'),
(230, 'visit_website', 'Visit website'),
(231, 'navigation', 'Navigation'),
(232, 'manage_courses', 'Manage courses'),
(233, 'add_new_course', 'Add new course'),
(234, 'course_category', 'Course category'),
(235, 'coupons', 'Coupons'),
(236, 'enrollments', 'Enrollments'),
(237, 'course_enrollment', 'Course enrollment'),
(238, 'enrol_history', 'Enrol history'),
(239, 'report', 'Report'),
(240, 'admin_revenue', 'Admin revenue'),
(241, 'instructor_revenue', 'Instructor revenue'),
(242, 'purchase_history', 'Purchase history'),
(243, 'users', 'Users'),
(244, 'admins', 'Admins'),
(245, 'manage_admins', 'Manage admins'),
(246, 'add_new_admin', 'Add new admin'),
(247, 'instructors', 'Instructors'),
(248, 'manage_instructors', 'Manage instructors'),
(249, 'add_new_instructor', 'Add new instructor'),
(250, 'instructor_payout', 'Instructor payout'),
(251, 'instructor_settings', 'Instructor settings'),
(252, 'applications', 'Applications'),
(253, 'students', 'Students'),
(254, 'manage_students', 'Manage students'),
(255, 'add_new_student', 'Add new student'),
(256, 'message', 'Message'),
(257, 'newsletter', 'Newsletter'),
(258, 'all_newsletter', 'All newsletter'),
(259, 'subscribed_user', 'Subscribed user'),
(260, 'contact', 'Contact'),
(261, 'all_blogs', 'All blogs'),
(262, 'pending_blog', 'Pending blog'),
(263, 'blog_category', 'Blog category'),
(264, 'blog_settings', 'Blog settings'),
(265, 'addons', 'Addons'),
(266, 'themes', 'Themes'),
(267, 'system_settings', 'System settings'),
(268, 'website_settings', 'Website settings'),
(269, 'academy_cloud', 'Academy cloud'),
(270, 'drip_content_settings', 'Drip content settings'),
(271, 'wasabi_storage_settings', 'Wasabi storage settings'),
(272, 'bbb_live_class_settings', 'Bbb live class settings'),
(273, 'payment_settings', 'Payment settings'),
(274, 'language_settings', 'Language settings'),
(275, 'social_login', 'Social login'),
(276, 'custom_page_builder', 'Custom page builder'),
(277, 'data_center', 'Data center'),
(278, 'about', 'About'),
(279, 'manage_profile', 'Manage profile'),
(280, 'admin_revenue_this_year', 'Admin revenue this year'),
(281, 'number_courses', 'Number courses'),
(282, 'number_of_lessons', 'Number of lessons'),
(283, 'number_of_enrolment', 'Number of enrolment'),
(284, 'number_of_student', 'Number of student'),
(285, 'course_overview', 'Course overview'),
(286, 'active_courses', 'Active courses'),
(287, 'pending_courses', 'Pending courses'),
(288, 'requested_withdrawal', 'Requested withdrawal'),
(289, 'january', 'January'),
(290, 'february', 'February'),
(291, 'march', 'March'),
(292, 'april', 'April'),
(293, 'may', 'May'),
(294, 'june', 'June'),
(295, 'july', 'July'),
(296, 'august', 'August'),
(297, 'september', 'September'),
(298, 'october', 'October'),
(299, 'november', 'November'),
(300, 'december', 'December'),
(301, 'this_year', 'This year'),
(302, 'active_course', 'Active course'),
(303, 'pending_course', 'Pending course'),
(304, 'heads_up', 'Heads up'),
(305, 'congratulations', 'Congratulations'),
(306, 'oh_snap', 'Oh snap'),
(307, 'please_fill_all_the_required_fields', 'Please fill all the required fields'),
(308, 'close', 'Close'),
(309, 'cancel', 'Cancel'),
(310, 'continue', 'Continue'),
(311, 'ok', 'Ok'),
(312, 'success', 'Success'),
(313, 'your_server_does_not_allow_uploading_files_that_large.', 'Your server does not allow uploading files that large.'),
(314, 'your_servers_file_upload_limit_is_40mb', 'Your servers file upload limit is 40mb'),
(315, 'successfully', 'Successfully'),
(316, 'div_added_to_bottom_', 'Div added to bottom '),
(317, 'div_has_been_deleted_', 'Div has been deleted '),
(318, 'filter', 'Filter'),
(319, 'enrolled_course', 'Enrolled course'),
(320, 'total_amount', 'Total amount'),
(321, 'enrolment_date', 'Enrolment date'),
(322, 'instructor', 'Instructor'),
(323, 'upcoming_courses', 'Upcoming courses'),
(324, 'free_courses', 'Free courses'),
(325, 'paid_courses', 'Paid courses'),
(326, 'course_list', 'Course list'),
(327, 'all', 'All'),
(328, 'status', 'Status'),
(329, 'active', 'Active'),
(330, 'pending', 'Pending'),
(331, 'private', 'Private'),
(332, 'upcoming', 'Upcoming'),
(333, 'price', 'Price'),
(334, 'free', 'Free'),
(335, 'paid', 'Paid'),
(336, 'title', 'Title'),
(337, 'category', 'Category'),
(338, 'lesson_and_section', 'Lesson and section'),
(339, 'enrolled_student', 'Enrolled student'),
(340, 'actions', 'Actions'),
(341, 'course_adding_form', 'Course adding form'),
(342, 'back_to_course_list', 'Back to course list'),
(343, 'basic', 'Basic'),
(344, 'info', 'Info'),
(345, 'pricing', 'Pricing'),
(346, 'media', 'Media'),
(347, 'seo', 'Seo'),
(348, 'finish', 'Finish'),
(349, 'course_title', 'Course title'),
(350, 'enter_course_title', 'Enter course title'),
(351, 'short_description', 'Short description'),
(352, 'description', 'Description'),
(353, 'select_a_category', 'Select a category'),
(354, 'select_sub_category', 'Select sub category'),
(355, 'level', 'Level'),
(356, 'beginner', 'Beginner'),
(357, 'advanced', 'Advanced'),
(358, 'intermediate', 'Intermediate'),
(359, 'language_made_in', 'Language made in'),
(360, 'enable_drip_content', 'Enable drip content'),
(361, 'create_as_a', 'Create as a'),
(362, 'private_course', 'Private course'),
(363, 'upcoming_course', 'Upcoming course'),
(364, 'check_if_this_course_is_top_course', 'Check if this course is top course'),
(365, 'course_faq', 'Course faq'),
(366, 'faq_question', 'Faq question'),
(367, 'answer', 'Answer'),
(368, 'requirements', 'Requirements'),
(369, 'provide_requirements', 'Provide requirements'),
(370, 'outcomes', 'Outcomes'),
(371, 'provide_outcomes', 'Provide outcomes'),
(372, 'check_if_this_is_a_free_course', 'Check if this is a free course'),
(373, 'course_price', 'Course price'),
(374, 'enter_course_course_price', 'Enter course course price'),
(375, 'check_if_this_course_has_discount', 'Check if this course has discount'),
(376, 'discounted_price', 'Discounted price'),
(377, 'this_course_has', 'This course has'),
(378, 'discount', 'Discount'),
(379, 'expiry_period', 'Expiry period'),
(380, 'lifetime', 'Lifetime'),
(381, 'limited_time', 'Limited time'),
(382, 'number_of_month', 'Number of month'),
(383, 'after_purchase,_students_can_access_the_course_until_your_selected_time.', 'After purchase, students can access the course until your selected time.'),
(384, 'course_overview_provider', 'Course overview provider'),
(385, 'youtube', 'Youtube'),
(386, 'vimeo', 'Vimeo'),
(387, 'html5', 'Html5'),
(388, 'course_overview_url', 'Course overview url'),
(389, 'course_thumbnail', 'Course thumbnail'),
(390, 'meta_keywords', 'Meta keywords'),
(391, 'write_a_keyword_and_then_press_enter_button', 'Write a keyword and then press enter button'),
(392, 'meta_description', 'Meta description'),
(393, 'thank_you', 'Thank you'),
(394, 'you_are_just_one_click_away', 'You are just one click away'),
(395, 'submit', 'Submit'),
(396, 'administration', 'Administration'),
(397, 'log_out', 'Log out'),
(398, 'start_learning_from_best_platform', 'Start learning from best platform'),
(399, 'study_any_topic,_anytime._explore_thousands_of_courses_for_the_lowest_price_ever!', 'Study any topic, anytime. explore thousands of courses for the lowest price ever!'),
(400, 'what_do_you_want_to_learn', 'What do you want to learn'),
(401, 'happy', 'Happy'),
(402, 'experienced', 'Experienced'),
(403, 'online_courses', 'Online courses'),
(404, 'explore_a_variety_of_fresh_topics', 'Explore a variety of fresh topics'),
(405, 'expert_instruction', 'Expert instruction'),
(406, 'find_the_right_course_for_you', 'Find the right course for you'),
(407, 'smart_solution', 'Smart solution'),
(408, 'learn_on_your_schedule', 'Learn on your schedule'),
(409, 'top_courses', 'Top courses'),
(410, 'these_are_the_most_popular_courses_among_listen_courses_learners_worldwide', 'These are the most popular courses among listen courses learners worldwide'),
(411, 'top', 'Top'),
(412, 'latest_courses', 'Latest courses'),
(413, 'these_are_the_most_latest_courses_among_listen_courses_learners_worldwide', 'These are the most latest courses among listen courses learners worldwide'),
(414, 'join_now_to_start_learning', 'Join now to start learning'),
(415, 'learn_from_our_quality_instructors!', 'Learn from our quality instructors!'),
(416, 'get_started', 'Get started'),
(417, 'become_a_new_instructor', 'Become a new instructor'),
(418, 'teach_thousands_of_students_and_earn_money!', 'Teach thousands of students and earn money!'),
(419, 'all_category', 'All category'),
(420, 'show_more', 'Show more'),
(421, 'show_less', 'Show less'),
(422, 'language', 'Language'),
(423, 'ratings', 'Ratings'),
(424, 'list_view', 'List view'),
(425, 'grid_view', 'Grid view'),
(426, 'reset', 'Reset'),
(427, 'showing', 'Showing'),
(428, 'of', 'Of'),
(429, 'results', 'Results'),
(430, 'newly_published', 'Newly published'),
(431, 'highest_rating', 'Highest rating'),
(432, 'lowest_price', 'Lowest price'),
(433, 'highest_price', 'Highest price'),
(434, 'discounted', 'Discounted'),
(435, 'course_not_found', 'Course not found'),
(436, 'sorry,_try_using_more_similar_words_in_your_search.', 'Sorry, try using more similar words in your search.'),
(437, 'contact_users', 'Contact users'),
(438, 'name', 'Name'),
(439, 'action', 'Action'),
(440, 'instructors_pending_blog', 'Instructors pending blog'),
(441, 'total_pending', 'Total pending'),
(442, 'blogs', 'Blogs'),
(443, 'creator', 'Creator'),
(444, 'add_new_coupon', 'Add new coupon'),
(445, 'coupon_code', 'Coupon code'),
(446, 'discount_percentage', 'Discount percentage'),
(447, 'validity_till', 'Validity till'),
(448, 'add_coupons', 'Add coupons'),
(449, 'back_to_coupons', 'Back to coupons'),
(450, 'coupon_add_form', 'Coupon add form'),
(451, 'generate_a_random_coupon_code', 'Generate a random coupon code'),
(452, 'generate_random', 'Generate random'),
(453, 'expiry_date', 'Expiry date'),
(454, 'coupon_added_successfully', 'Coupon added successfully'),
(455, 'edit', 'Edit'),
(456, 'delete', 'Delete'),
(457, 'add_new_category', 'Add new category'),
(458, 'add_category', 'Add category'),
(459, 'category_add_form', 'Category add form'),
(460, 'category_code', 'Category code'),
(461, 'category_title', 'Category title'),
(462, 'parent', 'Parent'),
(463, 'none', 'None'),
(464, 'select_none_to_create_a_parent_category', 'Select none to create a parent category'),
(465, 'icon_picker', 'Icon picker'),
(466, 'category_thumbnail', 'Category thumbnail'),
(467, 'the_image_size_should_be', 'The image size should be'),
(468, 'choose_thumbnail', 'Choose thumbnail'),
(469, 'add_instructor', 'Add instructor'),
(470, 'photo', 'Photo'),
(471, 'email', 'Email'),
(472, 'phone', 'Phone'),
(473, 'enrolled_courses', 'Enrolled courses');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lesson`
--

CREATE TABLE `lesson` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `video_type` varchar(255) DEFAULT NULL,
  `cloud_video_id` int(20) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `audio_url` varchar(400) DEFAULT NULL,
  `date_added` int(11) DEFAULT NULL,
  `last_modified` int(11) DEFAULT NULL,
  `lesson_type` varchar(255) DEFAULT NULL,
  `attachment` longtext DEFAULT NULL,
  `attachment_type` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `summary` longtext DEFAULT NULL,
  `is_free` int(11) NOT NULL DEFAULT 0,
  `order` int(11) NOT NULL DEFAULT 0,
  `quiz_attempt` int(11) NOT NULL DEFAULT 0,
  `video_type_for_mobile_application` varchar(255) DEFAULT NULL,
  `video_url_for_mobile_application` varchar(255) DEFAULT NULL,
  `duration_for_mobile_application` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `from` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `message`
--

CREATE TABLE `message` (
  `message_id` int(20) NOT NULL,
  `message_thread_code` varchar(255) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `sender` int(20) DEFAULT NULL,
  `receiver` int(20) DEFAULT NULL,
  `timestamp` varchar(255) DEFAULT NULL,
  `read_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `message_thread`
--

CREATE TABLE `message_thread` (
  `message_thread_id` int(11) NOT NULL,
  `message_thread_code` varchar(255) DEFAULT NULL,
  `sender` varchar(255) DEFAULT '',
  `receiver` varchar(255) DEFAULT '',
  `last_message_timestamp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `newsletter_histories`
--

CREATE TABLE `newsletter_histories` (
  `id` int(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `tried_times` int(11) DEFAULT NULL,
  `sent_at` varchar(100) DEFAULT NULL,
  `created_at` varchar(100) DEFAULT NULL,
  `updated_at` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `newsletter_subscriber`
--

CREATE TABLE `newsletter_subscriber` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) NOT NULL,
  `from_user` int(11) DEFAULT NULL,
  `to_user` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `notification_settings`
--

CREATE TABLE `notification_settings` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `is_editable` int(11) DEFAULT NULL,
  `addon_identifier` varchar(255) DEFAULT NULL,
  `user_types` varchar(400) DEFAULT NULL,
  `system_notification` varchar(400) DEFAULT NULL,
  `email_notification` varchar(400) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `template` longtext DEFAULT NULL,
  `setting_title` varchar(255) DEFAULT NULL,
  `setting_sub_title` varchar(255) DEFAULT NULL,
  `date_updated` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `notification_settings`
--

INSERT INTO `notification_settings` (`id`, `type`, `is_editable`, `addon_identifier`, `user_types`, `system_notification`, `email_notification`, `subject`, `template`, `setting_title`, `setting_sub_title`, `date_updated`) VALUES
(1, 'signup', 1, NULL, '[\"admin\",\"user\"]', '{\"admin\":\"1\",\"user\":\"1\"}', '{\"admin\":\"0\",\"user\":\"0\"}', '{\"admin\":\"New user registered\",\"user\":\"Registered successfully\"}', '{\"admin\":\"New user registered [user_name] \\r\\n<br>User email: <b>[user_email]<\\/b>\",\"user\":\"You have successfully registered with us at [system_name].\"}', 'New user registration', 'Get notified when a new user signs up', '1693215071'),
(2, 'email_verification', 0, NULL, '[\"user\"]', '{\"user\":\"0\"}', '{\"user\":\"1\"}', '{\"user\":\"Email verification code\"}', '{\"user\":\"You have received a email verification code. Your verification code is [email_verification_code]\"}', 'Email verification', 'It is permanently enabled for student email verification.', '1684135777'),
(3, 'forget_password_mail', 0, NULL, '[\"user\"]', '{\"user\":\"0\"}', '{\"user\":\"1\"}', '{\"user\":\"Forgot password verification code\"}', '{\"user\":\"You have received a email verification code. Your verification code is [system_name] [verification_link] [minutes]\"}', 'Forgot password mail', 'It is permanently enabled for student email verification.', '1684145383'),
(4, 'new_device_login_confirmation', 0, NULL, '[\"user\"]', '{\"user\":\"0\"}', '{\"user\":\"1\"}', '{\"user\":\"Please confirm your login\"}', '{\"user\":\"Have you tried logging in with a different device? Confirm using the verification code. Your verification code is [verification_code]. Remember that you will lose access to your previous device after logging in to the new device <b>[user_agent]<\\/b>.<br> Use the verification code within [minutes] minutes\"}', 'Account security alert', 'Send verification code for login from a new device', '1684145383'),
(6, 'course_purchase', 1, NULL, '[\"admin\",\"student\",\"instructor\"]', '{\"admin\":\"1\",\"student\":\"1\",\"instructor\":\"1\"}', '{\"admin\":\"0\",\"student\":\"0\",\"instructor\":\"0\"}', '{\"admin\":\"A new course has been sold\",\"instructor\":\"A new course has been sold\",\"student\":\"You have purchased a new course\"}', '{\"admin\":\"<p>Course title: [course_title]<\\/p><p>Student: [student_name]\\r\\n<\\/p><p>Paid amount: [paid_amount]<\\/p><p>Instructor: [instructor_name]<\\/p>\",\"instructor\":\"Course title: [course_title]\\r\\nStudent: [student_name]\\r\\nPaid amount: [paid_amount]\",\"student\":\"Course title: [course_title]\\r\\nPaid amount: [paid_amount]\\r\\nInstructor: [instructor_name]\"}', 'Course purchase notification', 'Stay up-to-date on student course purchases.', '1684303456'),
(7, 'course_completion_mail', 1, NULL, '[\"student\",\"instructor\"]', '{\"student\":\"1\",\"instructor\":\"1\"}', '{\"student\":\"0\",\"instructor\":\"0\"}', '{\"instructor\":\"Course completion\",\"student\":\"You have completed a new course\"}', '{\"instructor\":\"Course completed [course_title]\\r\\nStudent: [student_name]\",\"student\":\"Course: [course_title]\\r\\nInstructor: [instructor_name]\"}', 'Course completion mail', 'Stay up to date on student course completion.', '1699431547'),
(8, 'certificate_eligibility', 1, 'certificate', '[\"student\",\"instructor\"]', '{\"student\":\"1\",\"instructor\":\"1\"}', '{\"student\":\"0\",\"instructor\":\"0\"}', '{\"instructor\":\"Certificate eligibility\",\"student\":\"certificate eligibility\"}', '{\"instructor\":\"Course: [course_title]\\r\\nStudent: [student_name]\\r\\nCertificate link: [certificate_link]\",\"student\":\"Course: [course_title]\\r\\nInstructor: [instructor_name]\\r\\nCertificate link: [certificate_link]\"}', 'Course eligibility notification', 'Stay up to date on course certificate eligibility.', '1684303460'),
(9, 'offline_payment_suspended_mail', 1, 'offline_payment', '[\"student\"]', '{\"student\":\"1\"}', '{\"student\":\"0\"}', '{\"student\":\"Your payment has been suspended\"}', '{\"student\":\"<p>Your offline payment has been <b style=\'color: red;\'>suspended</b> !</p><p>Please provide a valid document of your payment.</p>\"}', 'Offline payment suspended mail', 'If students provides fake information, notify them of the suspension', '1684303463'),
(10, 'bundle_purchase', 1, 'course_bundle', '[\"admin\",\"student\",\"instructor\"]', '{\"admin\":\"1\",\"student\":\"1\",\"instructor\":\"1\"}', '{\"admin\":\"0\",\"student\":\"0\",\"instructor\":\"0\"}', '{\"admin\":\"A new course bundle has been sold \",\"instructor\":\"A new course bundle has been sold \",\"student\":\"You have purchased a new course bundle test\"}', '{\"admin\":\"Course bundle: [bundle_title]\\r\\nStudent: [student_name]\\r\\nInstructor: [instructor_name] \",\"instructor\":\"Course bundle: [bundle_title]\\r\\nStudent: [student_name] \",\"student\":\"Course bundle: [bundle_title]\\r\\nInstructor: [instructor_name] \"}', 'Course bundle purchase notification', 'Stay up-to-date on student course bundle purchases.', '1684303467'),
(13, 'add_new_user_as_affiliator', 0, 'affiliate_course', '[\"affiliator\"]', '{\"affiliator\":\"0\"}', '{\"affiliator\":\"1\"}', '{\"affiliator\":\"Congratulation ! You are assigned as an affiliator\"}', '{\"affiliator\":\"You are assigned as a website Affiliator.\\r\\nWebsite: [website_link]\\r\\n<br>\\r\\nPassword: [password]\"}', 'New user added as affiliator', 'Send account information to the new user', '1684135777'),
(14, 'affiliator_approval_notification', 1, 'affiliate_course', '[\"affiliator\"]', '{\"affiliator\":\"1\"}', '{\"affiliator\":\"0\"}', '{\"affiliator\":\"Congratulations! Your affiliate request has been approved\"}', '{\"affiliator\":\"Congratulations! Your affiliate request has been approved\"}', 'Affiliate approval notification', 'Send affiliate approval mail to the user account', '1684303472'),
(15, 'affiliator_request_cancellation', 1, 'affiliate_course', '[\"affiliator\"]', '{\"affiliator\":\"1\"}', '{\"affiliator\":\"0\"}', '{\"affiliator\":\"Sorry ! Your request has been currently refused\"}', '{\"affiliator\":\"Sorry ! Your request has been currently refused.\"}', 'Affiliator request cancellation', 'Send mail, when you cancel the affiliation request', '1684303473'),
(16, 'affiliation_amount_withdrawal_request', 1, 'affiliate_course', '[\"admin\",\"affiliator\"]', '{\"admin\":\"1\",\"affiliator\":\"1\"}', '{\"admin\":\"0\",\"affiliator\":\"0\"}', '{\"admin\":\"New money withdrawal request\",\"affiliator\":\"New money withdrawal request\"}', '{\"admin\":\"New money withdrawal request by [user_name] [amount]\",\"affiliator\":\"Your Withdrawal request of [amount] has been sent to authority\"}', 'Affiliation money withdrawal request', 'Send mail, when the users request the withdrawal of money', '1684303476'),
(17, 'approval_affiliation_amount_withdrawal_request', 1, 'affiliate_course', '[\"affiliator\"]', '{\"affiliator\":\"1\"}', '{\"affiliator\":\"0\"}', '{\"affiliator\":\"Congartulation ! Your withdrawal request has been approved\"}', '{\"affiliator\":\"Congartulation ! Your payment request has been approved.\"}', 'Approval of withdrawal request of affiliation', 'Send mail, when you approved the affiliation withdrawal request', '1684303480'),
(18, 'course_gift', 1, NULL, '[\"payer\",\"receiver\"]', '{\"payer\":\"1\",\"receiver\":\"1\"}', '{\"payer\":\"1\",\"receiver\":\"1\"}', '{\"payer\":\"You have gift a course\",\"receiver\":\"You have received a course gift\"}', '{\"payer\":\"You have gift a course to [user_name] [course_title][instructor]\",\"receiver\":\"You have received a course gift by [payer][course_title][instructor]\"}', 'Course gift notification', 'Notify users after course gift', '1691818623'),
(20, 'noticeboard', 1, 'noticeboard', '[\"student\"]', '{\"student\":\"1\"}', '{\"student\":\"1\"}', '{\"student\":\"Noticeboard\"}', '{\"student\":\"Hi, You have a new notice by [instructor_name]. The course [course_title] [notice_title][notice_description]\"}', 'Course Noticeboard', 'Notify to enrolled students when announcements are created by the instructor for a particular course.\n', '1699525375');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE `payment` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `date_added` int(11) DEFAULT NULL,
  `last_modified` int(11) DEFAULT NULL,
  `admin_revenue` varchar(255) DEFAULT NULL,
  `instructor_revenue` varchar(255) DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `instructor_payment_status` int(11) DEFAULT 0,
  `transaction_id` varchar(255) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `coupon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` int(11) NOT NULL,
  `identifier` varchar(255) DEFAULT NULL,
  `currency` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `keys` text NOT NULL,
  `model_name` varchar(255) DEFAULT NULL,
  `enabled_test_mode` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_addon` int(11) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `identifier`, `currency`, `title`, `description`, `keys`, `model_name`, `enabled_test_mode`, `status`, `is_addon`, `created_at`, `updated_at`) VALUES
(1, 'paypal', 'USD', 'Paypal', '', '{\"sandbox_client_id\":\"AfGaziKslex-scLAyYdDYXNFaz2aL5qGau-SbDgE_D2E80D3AFauLagP8e0kCq9au7W4IasmFbirUUYc\",\"sandbox_secret_key\":\"EMa5pCTuOpmHkhHaCGibGhVUcKg0yt5-C3CzJw-OWJCzaXXzTlyD17SICob_BkfM_0Nlk7TWnN42cbGz\",\"production_client_id\":\"1234\",\"production_secret_key\":\"12345\"}', 'Payment_model', 1, 1, 0, '', '1673263724'),
(2, 'stripe', 'USD', 'Stripe', '', '{\"public_key\":\"pk_test_CAC3cB1mhgkJqXtypYBTGb4f\",\"secret_key\":\"sk_test_iatnshcHhQVRXdygXw3L2Pp2\",\"public_live_key\":\"pk_live_xxxxxxxxxxxxxxxxxxxxxxxx\",\"secret_live_key\":\"sk_live_xxxxxxxxxxxxxxxxxxxxxxxx\"}', 'Payment_model', 1, 1, 0, '', '1673263724'),
(3, 'razorpay', 'INR', 'Razorpay', '', '{\"key_id\":\"rzp_test_J60bqBOi1z1aF5\",\"secret_key\":\"uk935K7p4j96UCJgHK8kAU4q\",\"theme_color\":\"#23d792\"}', 'Payment_model', 1, 1, 0, '', '1708580304'),
(4, 'xendit', 'USD', 'Xendit', '', '{\"api_key\":\"xnd_development_44KVee2PG4HeeZxG69R5eXOJHVD7t84FZUIH8dMxa37ZU3bZ8KDKV9ugPfy5fRK\",\"secret_key\":\"your_xendit_secret_key\",\"other_parameter\":\"value\"}', 'Payment_model', 1, 1, 0, '', '1700647736'),
(5, 'payu', 'PLN', 'Payu', '', '{\"pos_id\":\"PKf789971N2ig5hbF71y1BX46k\",\"second_key\":\"vaWDmIqbwiVUOVitXet9ZlC9mQ\",\"client_id\":\"PKf789971N2ig5hbF71y1BX46k\",\"client_secret\":\"vaWDmIqbwiVUOVitXet9ZlC9mQ\"}', 'Payment_model', 1, 1, 0, '', '1707980726'),
(6, 'pagseguro', 'BRL', 'Pagseguro', '', '{\"api_key\":\"BAE981AF77CA4768A93849AFF5BF2331\",\"secret_key\":\"8045696DBFBF765FF4189FBAE1E02AB5\",\"other_parameter\":\"value\"}', 'Payment_model', 1, 1, 0, '', '1705559611'),
(7, 'sslcommerz', 'USD', 'SSL Commerz', '', '{\"store_id\":\"sslcommerz_store_id\",\"store_password\":\"sslcommerz_store_password\"}', 'Payment_model', 1, 1, 0, '', '1673264610'),
(8, 'skrill', 'USD', 'Skrill', '', '{\"skrill_merchant_email\":\"urwatech@gmail.com\",\"secret_passphrase\":\"your_skrill_secret_key\"}', 'Payment_model', 1, 1, 0, '', '1700647745'),
(10, 'doku', 'USD', 'Doku', '', '{\"client_id\":\"BRN-0271-1700996849302\",\"shared_key\":\"SK-BxOS4PfUdIEMHLccyMI3\"}', 'Payment_model', 1, 1, 0, '', '1708603994'),
(11, 'bkash', 'BDT', 'Bkash', '', '{\"app_key\":\"app-key\",\"app_secret\":\"app-secret\",\"username\":\"username\",\"password\":\"passwoed\"}', 'Payment_model', 1, 1, 0, '1700997440', '1701596645'),
(12, 'cashfree', 'INR', 'CashFree', '', '{\"client_id\":\"TEST100748308df0665cabda6c2f38b903847001\",\"client_secret\":\"cfsk_ma_test_71065d7cadf8695e7845e86244bd7011_fff5714b\"}', 'Payment_model', 1, 1, 0, '1700997440', '1701688995'),
(13, 'maxicash', 'USD', 'Maxicash', '', '{\"merchant_id\":\"TEST100748308df0665cabda6c2f38b903847001\",\"merchant_password\":\"cfsk_ma_test_71065d7cadf8695e7845e86244bd7011_fff5714b\"}', 'Payment_model', 1, 1, 0, '1700997440', '1701688995'),
(14, 'aamarpay', 'BDT', 'Aamarpay', '', '{\"store_id\":\"aamarpaytest\",\"signature_key\":\"dbb74894e82415a2f7ff0ec3a97e4183\"}', 'Payment_model', 1, 1, 0, '1700997440', '1711366991'),
(15, 'flutterwave', 'NGN', 'Flutterwave', '', '{\"public_key\":\"FLWPUBK_TEST-b6fbee21fd2d9f13be74bf4d87fe6197-X\",\"secret_key\":\"FLWSECK_TEST-70c3f071a83a1d14bb8a0061e53845a7-X\"}', 'Payment_model', 1, 1, 0, '1700997440', '1711366991'),
(16, 'tazapay', 'USD', 'Tazapay', '', '{\"public_key\":\"pk_test_audpDpZGmHmYT46kmHvA\",\"api_key\":\"ak_test_CRXTUMNGV4MVPO7RDGT2\",\"api_secret\":\"sk_test_0OfyPSFUX4YqcQGkeyOWCVkEQ7WAWeZ6SmsNNpfFQ989qm15f8mu2gqmYhiXkZ87iF26Ej1Ex9pgNuTq9YoxksPmQjDEbyATBoWw0bNH12mQPIJQ4VGqEPIB5FEizarZ\"}', 'Payment_model', 1, 1, 0, '1700997440', '1711366991');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payout`
--

CREATE TABLE `payout` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `date_added` int(11) DEFAULT NULL,
  `last_modified` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `permissions` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `question`
--

CREATE TABLE `question` (
  `id` int(11) UNSIGNED NOT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `title` longtext DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `number_of_options` int(11) DEFAULT NULL,
  `options` longtext DEFAULT NULL,
  `correct_answers` longtext DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `quiz_results`
--

CREATE TABLE `quiz_results` (
  `quiz_result_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_answers` longtext NOT NULL,
  `correct_answers` longtext NOT NULL COMMENT 'question_id',
  `total_obtained_marks` double NOT NULL,
  `date_added` varchar(100) NOT NULL,
  `date_updated` varchar(100) NOT NULL,
  `is_submitted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating`
--

CREATE TABLE `rating` (
  `id` int(11) UNSIGNED NOT NULL,
  `rating` double DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ratable_id` int(11) DEFAULT NULL,
  `ratable_type` varchar(50) DEFAULT NULL,
  `date_added` int(11) DEFAULT NULL,
  `last_modified` int(11) DEFAULT NULL,
  `review` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `resource_files`
--

CREATE TABLE `resource_files` (
  `id` int(11) NOT NULL,
  `lesson_id` int(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_added` int(11) DEFAULT NULL,
  `last_modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `name`, `date_added`, `last_modified`) VALUES
(1, 'Admin', 1234567890, 1234567890),
(2, 'User', 1234567890, 1234567890);

-- --------------------------------------------------------

--
-- Struktur dari tabel `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `restricted_by` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'language', 'english'),
(2, 'system_name', 'Gotrain'),
(3, 'system_title', 'Academy Learning Club'),
(4, 'system_email', 'academy@example.com'),
(5, 'address', 'Sydney, Australia'),
(6, 'phone', '+143-52-9933631'),
(7, 'purchase_code', 'your-purchase-code'),
(8, 'paypal', '[{\"active\":\"1\",\"mode\":\"sandbox\",\"sandbox_client_id\":\"AfGaziKslex-scLAyYdDYXNFaz2aL5qGau-SbDgE_D2E80D3AFauLagP8e0kCq9au7W4IasmFbirUUYc\",\"sandbox_secret_key\":\"EMa5pCTuOpmHkhHaCGibGhVUcKg0yt5-C3CzJw-OWJCzaXXzTlyD17SICob_BkfM_0Nlk7TWnN42cbGz\",\"production_client_id\":\"1234\",\"production_secret_key\":\"12345\"}]'),
(9, 'stripe_keys', '[{\"active\":\"1\",\"testmode\":\"on\",\"public_key\":\"pk_test_CAC3cB1mhgkJqXtypYBTGb4f\",\"secret_key\":\"sk_test_iatnshcHhQVRXdygXw3L2Pp2\",\"public_live_key\":\"pk_live_xxxxxxxxxxxxxxxxxxxxxxxx\",\"secret_live_key\":\"sk_live_xxxxxxxxxxxxxxxxxxxxxxxx\"}]'),
(10, 'youtube_api_key', 'youtube-and-google-drive-api-key'),
(11, 'vimeo_api_key', 'vimeo-api-key'),
(12, 'slogan', 'A course based video CMS'),
(13, 'text_align', NULL),
(14, 'allow_instructor', '1'),
(15, 'instructor_revenue', '70'),
(16, 'system_currency', 'USD'),
(17, 'paypal_currency', 'USD'),
(18, 'stripe_currency', 'USD'),
(19, 'author', 'Creativeitem'),
(20, 'currency_position', 'left'),
(21, 'website_description', 'Study any topic, anytime. explore thousands of courses for the lowest price ever!'),
(22, 'website_keywords', 'LMS,Learning Management System,Creativeitem,Academy LMS'),
(23, 'footer_text', 'Creativeitem'),
(24, 'footer_link', 'https://creativeitem.com/'),
(25, 'protocol', 'smtp'),
(26, 'smtp_host', 'smtp.gmail.com'),
(27, 'smtp_port', '587'),
(28, 'smtp_user', 'admin@example.com'),
(29, 'smtp_pass', 'Enter-your-app-password'),
(30, 'version', '6.7'),
(31, 'student_email_verification', 'disable'),
(32, 'instructor_application_note', 'Fill all the fields carefully and share if you want to share any document with us it will help us to evaluate you as an instructor.'),
(33, 'razorpay_keys', '[{\"active\":\"1\",\"key\":\"rzp_test_J60bqBOi1z1aF5\",\"secret_key\":\"uk935K7p4j96UCJgHK8kAU4q\",\"theme_color\":\"#c7a600\"}]'),
(34, 'razorpay_currency', 'USD'),
(35, 'fb_app_id', NULL),
(36, 'fb_app_secret', NULL),
(37, 'fb_social_login', NULL),
(38, 'drip_content_settings', '{\"lesson_completion_role\":\"percentage\",\"minimum_duration\":15,\"minimum_percentage\":\"30\",\"locked_lesson_message\":\"&lt;h3 xss=&quot;removed&quot; style=&quot;text-align: center; &quot;&gt;&lt;span xss=&quot;removed&quot;&gt;&lt;strong&gt;Permission denied!&lt;\\/strong&gt;&lt;\\/span&gt;&lt;\\/h3&gt;&lt;p xss=&quot;removed&quot; style=&quot;text-align: center; &quot;&gt;&lt;span xss=&quot;removed&quot;&gt;This course supports drip content, so you must complete the previous lessons.&lt;\\/span&gt;&lt;\\/p&gt;\"}'),
(41, 'course_accessibility', 'publicly'),
(42, 'smtp_crypto', 'tls'),
(43, 'allowed_device_number_of_loging', '5'),
(47, 'academy_cloud_access_token', 'jdfghasdfasdfasdfasdfasdf'),
(48, 'course_selling_tax', '0'),
(49, 'ccavenue_keys', '[{\"active\":\"1\",\"ccavenue_merchant_id\":\"cmi_xxxxxx\",\"ccavenue_working_key\":\"cwk_xxxxxxxxxxxx\",\"ccavenue_access_code\":\"ccc_xxxxxxxxxxxxx\"}]'),
(50, 'ccavenue_currency', 'INR'),
(51, 'iyzico_keys', '[{\"active\":\"1\",\"testmode\":\"on\",\"iyzico_currency\":\"TRY\",\"api_test_key\":\"atk_xxxxxxxx\",\"secret_test_key\":\"stk_xxxxxxxx\",\"api_live_key\":\"alk_xxxxxxxx\",\"secret_live_key\":\"slk_xxxxxxxx\"}]'),
(52, 'iyzico_currency', 'TRY'),
(53, 'paystack_keys', '[{\"active\":\"1\",\"testmode\":\"on\",\"secret_test_key\":\"sk_test_c746060e693dd50c6f397dffc6c3b2f655217c94\",\"public_test_key\":\"pk_test_0816abbed3c339b8473ff22f970c7da1c78cbe1b\",\"secret_live_key\":\"sk_live_xxxxxxxxxxxxxxxxxxxxx\",\"public_live_key\":\"pk_live_xxxxxxxxxxxxxxxxxxxxx\"}]'),
(54, 'paystack_currency', 'NGN'),
(55, 'paytm_keys', '[{\"PAYTM_MERCHANT_KEY\":\"PAYTM_MERCHANT_KEY\",\"PAYTM_MERCHANT_MID\":\"PAYTM_MERCHANT_MID\",\"PAYTM_MERCHANT_WEBSITE\":\"DEFAULT\",\"INDUSTRY_TYPE_ID\":\"Retail\",\"CHANNEL_ID\":\"WEB\"}]'),
(57, 'google_analytics_id', ''),
(58, 'meta_pixel_id', ''),
(59, 'smtp_from_email', 'admin@example.com'),
(61, 'language_dirs', '{\"english\":\"ltr\",\"hindi\":\"rtl\",\"arabic\":\"rtl\"}'),
(62, 'timezone', 'America/New_York'),
(63, 'account_disable', '0'),
(64, 'offline_bank_information', 'Enter your bank information'),
(65, 'randCallRange', '20'),
(70, 'wasabi_key', 'access-key'),
(71, 'wasabi_secret_key', 'secret-key'),
(72, 'wasabi_bucketname', 'bucket-name'),
(73, 'wasabi_region', 'region-name'),
(74, 'bbb_setting', '{\"endpoint\":\"https:\\/\\/manager.bigbluemeeting.com\\/bigbluebutton\\/\",\"secret\":\"shared-secret-or-salt\"}'),
(75, 'iso_country_codes', '{\"AF\": \"Afghanistan\",\"AX\": \"Åland Islands\",\"AL\": \"Albania\",\"DZ\": \"Algeria\",\"AS\": \"American Samoa\",\"AD\": \"Andorra\",\"AO\": \"Angola\",\"AI\": \"Anguilla\",\"AQ\": \"Antarctica\",\"AG\": \"Antigua and Barbuda\",\"AR\": \"Argentina\",\"AM\": \"Armenia\",\"AW\": \"Aruba\",\"AU\": \"Australia\",\"AT\": \"Austria\",\"AZ\": \"Azerbaijan\",\"BS\": \"Bahamas\",\"BH\": \"Bahrain\",\"BD\": \"Bangladesh\",\"BB\": \"Barbados\",\"BY\": \"Belarus\",\"BE\": \"Belgium\",\"BZ\": \"Belize\",\"BJ\": \"Benin\",\"BM\": \"Bermuda\",\"BT\": \"Bhutan\",\"BO\": \"Bolivia (Plurinational State of)\",\"BQ\": \"Bonaire, Sint Eustatius and Saba\",\"BA\": \"Bosnia and Herzegovina\",\"BW\": \"Botswana\",\"BV\": \"Bouvet Island\",\"BR\": \"Brazil\",\"IO\": \"British Indian Ocean Territory\",\"BN\": \"Brunei Darussalam\",\"BG\": \"Bulgaria\",\"BF\": \"Burkina Faso\",\"BI\": \"Burundi\",\"CV\": \"Cabo Verde\",\"KH\": \"Cambodia\",\"CM\": \"Cameroon\",\"CA\": \"Canada\",\"KY\": \"Cayman Islands\",\"CF\": \"Central African Republic\",\"TD\": \"Chad\",\"CL\": \"Chile\",\"CN\": \"China\",\"CX\": \"Christmas Island\",\"CC\": \"Cocos (Keeling) Islands\",\"CO\": \"Colombia\",\"KM\": \"Comoros\",\"CG\": \"Congo\",\"CD\": \"Congo (Democratic Republic of the)\",\"CK\": \"Cook Islands\",\"CR\": \"Costa Rica\",\"CI\": \"Côte d\'Ivoire\",\"HR\": \"Croatia\",\"CU\": \"Cuba\",\"CW\": \"Curaçao\",\"CY\": \"Cyprus\",\"CZ\": \"Czech Republic\",\"DK\": \"Denmark\",\"DJ\": \"Djibouti\",\"DM\": \"Dominica\",\"DO\": \"Dominican Republic\",\"EC\": \"Ecuador\",\"EG\": \"Egypt\",\"SV\": \"El Salvador\",\"GQ\": \"Equatorial Guinea\",\"ER\": \"Eritrea\",\"EE\": \"Estonia\",\"ET\": \"Ethiopia\",\"FK\": \"Falkland Islands (Malvinas)\",\"FO\": \"Faroe Islands\",\"FJ\": \"Fiji\",\"FI\": \"Finland\",\"FR\": \"France\",\"GF\": \"French Guiana\",\"PF\": \"French Polynesia\",\"TF\": \"French Southern Territories\",\"GA\": \"Gabon\",\"GM\": \"Gambia\",\"GE\": \"Georgia\",\"DE\": \"Germany\",\"GH\": \"Ghana\",\"GI\": \"Gibraltar\",\"GR\": \"Greece\",\"GL\": \"Greenland\",\"GD\": \"Grenada\",\"GP\": \"Guadeloupe\",\"GU\": \"Guam\",\"GT\": \"Guatemala\",\"GG\": \"Guernsey\",\"GN\": \"Guinea\",\"GW\": \"Guinea-Bissau\",\"GY\": \"Guyana\",\"HT\": \"Haiti\",\"HM\": \"Heard Island and McDonald Islands\",\"VA\": \"Holy See\",\"HN\": \"Honduras\",\"HK\": \"Hong Kong\",\"HU\": \"Hungary\",\"IS\": \"Iceland\",\"IN\": \"India\",\"ID\": \"Indonesia\",\"IR\": \"Iran (Islamic Republic of)\",\"IQ\": \"Iraq\",\"IE\": \"Ireland\",\"IM\": \"Isle of Man\",\"IL\": \"Israel\",\"IT\": \"Italy\",\"JM\": \"Jamaica\",\"JP\": \"Japan\",\"JE\": \"Jersey\",\"JO\": \"Jordan\",\"KZ\": \"Kazakhstan\",\"KE\": \"Kenya\",\"KI\": \"Kiribati\",\"KP\": \"Korea (Democratic People\'s Republic of)\",\"KR\": \"Korea (Republic of)\",\"KW\": \"Kuwait\",\"KG\": \"Kyrgyzstan\",\"LA\": \"Lao People\'s Democratic Republic\",\"LV\": \"Latvia\",\"LB\": \"Lebanon\",\"LS\": \"Lesotho\",\"LR\": \"Liberia\",\"LY\": \"Libya\",\"LI\": \"Liechtenstein\",\"LT\": \"Lithuania\",\"LU\": \"Luxembourg\",\"MO\": \"Macao\",\"MK\": \"North Macedonia\",\"MG\": \"Madagascar\",\"MW\": \"Malawi\",\"MY\": \"Malaysia\",\"MV\": \"Maldives\",\"ML\": \"Mali\",\"MT\": \"Malta\",\"MH\": \"Marshall Islands\",\"MQ\": \"Martinique\",\"MR\": \"Mauritania\",\"MU\": \"Mauritius\",\"YT\": \"Mayotte\",\"MX\": \"Mexico\",\"FM\": \"Micronesia (Federated States of)\",\"MD\": \"Moldova (Republic of)\",\"MC\": \"Monaco\",\"MN\": \"Mongolia\",\"ME\": \"Montenegro\",\"MS\": \"Montserrat\",\"MA\": \"Morocco\",\"MZ\": \"Mozambique\",\"MM\": \"Myanmar\",\"NA\": \"Namibia\",\"NR\": \"Nauru\",\"NP\": \"Nepal\",\"NL\": \"Netherlands\",\"NC\": \"New Caledonia\",\"NZ\": \"New Zealand\",\"NI\": \"Nicaragua\",\"NE\": \"Niger\",\"NG\": \"Nigeria\",\"NU\": \"Niue\",\"NF\": \"Norfolk Island\",\"MP\": \"Northern Mariana Islands\",\"NO\": \"Norway\",\"OM\": \"Oman\",\"PK\": \"Pakistan\",\"PW\": \"Palau\",\"PS\": \"Palestine, State of\",\"PA\": \"Panama\",\"PG\": \"Papua New Guinea\",\"PY\": \"Paraguay\",\"PE\": \"Peru\",\"PH\": \"Philippines\",\"PN\": \"Pitcairn\",\"PL\": \"Poland\",\"PT\": \"Portugal\",\"PR\": \"Puerto Rico\",\"QA\": \"Qatar\",\"RE\": \"Réunion\",\"RO\": \"Romania\",\"RU\": \"Russian Federation\",\"RW\": \"Rwanda\",\"BL\": \"Saint Barthélemy\",\"SH\": \"Saint Helena, Ascension and Tristan da Cunha\",\"KN\": \"Saint Kitts and Nevis\",\"LC\": \"Saint Lucia\",\"MF\": \"Saint Martin (French part)\",\"PM\": \"Saint Pierre and Miquelon\",\"VC\": \"Saint Vincent and the Grenadines\",\"WS\": \"Samoa\",\"SM\": \"San Marino\",\"ST\": \"Sao Tome and Principe\",\"SA\": \"Saudi Arabia\",\"SN\": \"Senegal\",\"RS\": \"Serbia\",\"SC\": \"Seychelles\",\"SL\": \"Sierra Leone\",\"SG\": \"Singapore\",\"SX\": \"Sint Maarten (Dutch part)\",\"SK\": \"Slovakia\",\"SI\": \"Slovenia\",\"SB\": \"Solomon Islands\",\"SO\": \"Somalia\",\"ZA\": \"South Africa\",\"GS\": \"South Georgia and the South Sandwich Islands\",\"SS\": \"South Sudan\",\"ES\": \"Spain\",\"LK\": \"Sri Lanka\",\"SD\": \"Sudan\",\"SR\": \"Suriname\",\"SJ\": \"Svalbard and Jan Mayen\",\"SE\": \"Sweden\",\"CH\": \"Switzerland\",\"SY\": \"Syrian Arab Republic\",\"TW\": \"Taiwan, Province of China\",\"TJ\": \"Tajikistan\",\"TZ\": \"Tanzania, United Republic of\",\"TH\": \"Thailand\",\"TL\": \"Timor-Leste\",\"TG\": \"Togo\",\"TK\": \"Tokelau\",\"TO\": \"Tonga\",\"TT\": \"Trinidad and Tobago\",\"TN\": \"Tunisia\",\"TR\": \"Turkey\",\"TM\": \"Turkmenistan\",\"TC\": \"Turks and Caicos Islands\",\"TV\": \"Tuvalu\",\"UG\": \"Uganda\",\"UA\": \"Ukraine\",\"AE\": \"United Arab Emirates\",\"GB\": \"United Kingdom of Great Britain and Northern Ireland\",\"UM\": \"United States Minor Outlying Islands\",\"US\": \"United States of America\",\"UY\": \"Uruguay\",\"UZ\": \"Uzbekistan\",\"VU\": \"Vanuatu\",\"VE\": \"Venezuela (Bolivarian Republic of)\",\"VN\": \"Viet Nam\",\"VG\": \"Virgin Islands (British)\",\"VI\": \"Virgin Islands (U.S.)\",\"WF\": \"Wallis and Futuna\",\"EH\": \"Western Sahara\",\"YE\": \"Yemen\",\"ZM\": \"Zambia\",\"ZW\": \"Zimbabwe\"}');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tag`
--

CREATE TABLE `tag` (
  `id` int(11) UNSIGNED NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `tagable_id` int(11) DEFAULT NULL,
  `tagable_type` varchar(255) DEFAULT NULL,
  `date_added` int(11) DEFAULT NULL,
  `last_modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `skills` longtext NOT NULL,
  `social_links` longtext DEFAULT NULL,
  `biography` longtext DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `date_added` int(11) DEFAULT NULL,
  `last_modified` int(11) DEFAULT NULL,
  `wishlist` longtext DEFAULT NULL,
  `title` longtext DEFAULT NULL,
  `payment_keys` longtext NOT NULL,
  `verification_code` longtext DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_instructor` int(11) DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `temp` longtext DEFAULT NULL,
  `sessions` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `address`, `password`, `skills`, `social_links`, `biography`, `role_id`, `date_added`, `last_modified`, `wishlist`, `title`, `payment_keys`, `verification_code`, `status`, `is_instructor`, `image`, `temp`, `sessions`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', NULL, NULL, '7c222fb2927d828af22f592134e8932480637c0d', '', '{\"facebook\":\"\",\"twitter\":\"\",\"linkedin\":\"\"}', NULL, 1, NULL, NULL, NULL, NULL, '', NULL, 1, 1, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `watched_duration`
--

CREATE TABLE `watched_duration` (
  `watched_id` int(11) UNSIGNED NOT NULL,
  `watched_student_id` int(11) DEFAULT NULL,
  `watched_course_id` int(11) DEFAULT NULL,
  `watched_lesson_id` int(11) DEFAULT NULL,
  `current_duration` int(20) DEFAULT NULL,
  `watched_counter` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `watch_histories`
--

CREATE TABLE `watch_histories` (
  `watch_history_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `completed_lesson` longtext NOT NULL,
  `course_progress` int(11) NOT NULL,
  `watching_lesson_id` int(11) NOT NULL,
  `quiz_result` longtext NOT NULL,
  `completed_date` varchar(255) DEFAULT NULL,
  `date_added` varchar(100) DEFAULT NULL,
  `date_updated` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `addons`
--
ALTER TABLE `addons`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bbb_meetings`
--
ALTER TABLE `bbb_meetings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indeks untuk tabel `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`blog_category_id`);

--
-- Indeks untuk tabel `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`blog_comment_id`);

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeks untuk tabel `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `custom_page`
--
ALTER TABLE `custom_page`
  ADD PRIMARY KEY (`custom_page_id`);

--
-- Indeks untuk tabel `enrol`
--
ALTER TABLE `enrol`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `frontend_settings`
--
ALTER TABLE `frontend_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`phrase_id`);

--
-- Indeks untuk tabel `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indeks untuk tabel `message_thread`
--
ALTER TABLE `message_thread`
  ADD PRIMARY KEY (`message_thread_id`);

--
-- Indeks untuk tabel `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `newsletter_histories`
--
ALTER TABLE `newsletter_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `newsletter_subscriber`
--
ALTER TABLE `newsletter_subscriber`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notification_settings`
--
ALTER TABLE `notification_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payout`
--
ALTER TABLE `payout`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeks untuk tabel `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`quiz_result_id`);

--
-- Indeks untuk tabel `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `resource_files`
--
ALTER TABLE `resource_files`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `watched_duration`
--
ALTER TABLE `watched_duration`
  ADD PRIMARY KEY (`watched_id`);

--
-- Indeks untuk tabel `watch_histories`
--
ALTER TABLE `watch_histories`
  ADD PRIMARY KEY (`watch_history_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `addons`
--
ALTER TABLE `addons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bbb_meetings`
--
ALTER TABLE `bbb_meetings`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `blog_category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `blog_comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT untuk tabel `custom_page`
--
ALTER TABLE `custom_page`
  MODIFY `custom_page_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `enrol`
--
ALTER TABLE `enrol`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `frontend_settings`
--
ALTER TABLE `frontend_settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `language`
--
ALTER TABLE `language`
  MODIFY `phrase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=474;

--
-- AUTO_INCREMENT untuk tabel `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `message_thread`
--
ALTER TABLE `message_thread`
  MODIFY `message_thread_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `newsletter_histories`
--
ALTER TABLE `newsletter_histories`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `newsletter_subscriber`
--
ALTER TABLE `newsletter_subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `notification_settings`
--
ALTER TABLE `notification_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `payout`
--
ALTER TABLE `payout`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `quiz_result_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `resource_files`
--
ALTER TABLE `resource_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT untuk tabel `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `watched_duration`
--
ALTER TABLE `watched_duration`
  MODIFY `watched_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `watch_histories`
--
ALTER TABLE `watch_histories`
  MODIFY `watch_history_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
