-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2025 at 08:27 AM
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
-- Database: `accountion`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_businesses`
--

CREATE TABLE `add_businesses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `legal_name` varchar(255) NOT NULL,
  `business_type` varchar(255) DEFAULT NULL,
  `industry_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `gst_number` text DEFAULT NULL,
  `phone_number` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_businesses`
--

INSERT INTO `add_businesses` (`id`, `company_name`, `legal_name`, `business_type`, `industry_type`, `created_at`, `updated_at`, `deleted_at`, `created_by_id`, `gst_number`, `phone_number`, `email`, `address`) VALUES
(1, 'EEMOTRACK INDIA', 'EEMOTRACK INDIA', 'Pvt Ltd', 'Manufacturing', '2025-08-27 01:26:11', '2025-08-27 01:26:11', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'maruti suzaki venture', 'maruti suzaki venture', 'Partnership', 'Manufacturing', '2025-08-27 01:29:21', '2025-12-03 04:38:39', NULL, NULL, '10AQFPK9218D1ZA', '8863897163', 'ajayfilliptect@gmail.com', 'Patna , Bihar , Rk Bhatacharya Road, Patna , Bihar , Rk Bhatacharya Road, Patna, Bihar 800001, India, Phone: 7857868055');

-- --------------------------------------------------------

--
-- Table structure for table `add_business_user`
--

CREATE TABLE `add_business_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `add_business_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_business_user`
--

INSERT INTO `add_business_user` (`user_id`, `add_business_id`) VALUES
(2, 1),
(3, 2),
(4, 2),
(5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `add_items`
--

CREATE TABLE `add_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_type` varchar(255) DEFAULT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_hsn` varchar(255) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `sale_price` varchar(255) NOT NULL,
  `select_type` varchar(255) DEFAULT NULL,
  `disc_on_sale_price` varchar(255) DEFAULT NULL,
  `disc_type` varchar(255) DEFAULT NULL,
  `wholesale_price` varchar(255) DEFAULT NULL,
  `select_type_wholesale` varchar(255) DEFAULT NULL,
  `minimum_wholesale_qty` varchar(255) DEFAULT NULL,
  `purchase_price` varchar(255) DEFAULT NULL,
  `select_purchase_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `select_unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `select_tax_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `opening_stock` int(11) DEFAULT NULL,
  `low_stock_warning` int(11) DEFAULT NULL,
  `warehouse_location` varchar(255) DEFAULT NULL,
  `online_store_title` varchar(255) DEFAULT NULL,
  `online_store_description` longtext DEFAULT NULL,
  `online_store_image` varchar(255) DEFAULT NULL,
  `json_data` longtext DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `product_type` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_items`
--

INSERT INTO `add_items` (`id`, `item_type`, `item_name`, `item_hsn`, `item_code`, `sale_price`, `select_type`, `disc_on_sale_price`, `disc_type`, `wholesale_price`, `select_type_wholesale`, `minimum_wholesale_qty`, `purchase_price`, `select_purchase_type`, `created_at`, `updated_at`, `deleted_at`, `select_unit_id`, `select_tax_id`, `created_by_id`, `quantity`, `opening_stock`, `low_stock_warning`, `warehouse_location`, `online_store_title`, `online_store_description`, `online_store_image`, `json_data`, `unit_id`, `product_type`) VALUES
(7, 'product', 'LOCATOR', 'AKUYG434', 'ITM-6258-8965', '1500', 'Without Tax', '10', 'percentage', '1200', 'Without Tax', '10', '1000', 'Without Tax', '2025-09-09 03:13:41', '2025-09-09 03:13:41', NULL, 1, 1, 2, 4, 10, 1, 'kamla market', 'EEMOTRACK INDIA', 'Zcx e 4gregg34 erg 4egr', 'item_images/HYwY41Cr8aUTF94LmndVSZGv9mBoUd77wX5SpMeC.png', '\"{\\\"item_type\\\":\\\"product\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"4\\\",\\\"item_code\\\":\\\"ITM-6258-8965\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"1500\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"1\\\"},\\\"wholesale\\\":{\\\"wholesale_price\\\":\\\"1200\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\"},\\\"purchase\\\":{\\\"purchase_price\\\":\\\"1000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":\\\"10\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\"},\\\"online\\\":{\\\"title\\\":\\\"EEMOTRACK INDIA\\\",\\\"description\\\":\\\"Zcx e 4gregg34 erg 4egr\\\"}}\"', NULL, NULL),
(8, 'product', 'GPS 1X', 'AKUYG435', 'ITM-3825-6054', '3600', 'Without Tax', '10', 'percentage', '3000', 'Without Tax', '100', '1000', 'Without Tax', '2025-09-09 03:35:43', '2025-09-09 03:35:43', NULL, 1, 1, 2, 18, 100, 10, 'kamla market', 'EEMOTRACK INDIA', '2q r2 3e er 3f we f 2f cf 2rf', 'item_images/lpHcckX8Xr8tQqFhdsMWwOe9vK8Gly3PT9dhCdSI.png', '\"{\\\"item_type\\\":\\\"product\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-3825-6054\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"3600\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"1\\\"},\\\"wholesale\\\":{\\\"wholesale_price\\\":\\\"3000\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"100\\\"},\\\"purchase\\\":{\\\"purchase_price\\\":\\\"1000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":\\\"100\\\",\\\"low_stock_warning\\\":\\\"10\\\",\\\"warehouse_location\\\":\\\"kamla market\\\"},\\\"online\\\":{\\\"title\\\":\\\"EEMOTRACK INDIA\\\",\\\"description\\\":\\\" 2q r2 3e er 3f we f 2f cf 2rf \\\"}}\"', NULL, NULL),
(9, 'service', 'Service', 'AKUYG434', 'ITM-7196-3313', '123', 'Without Tax', '1', 'percentage', NULL, 'Without Tax', NULL, NULL, 'Without Tax', '2025-09-20 01:21:00', '2025-09-20 01:21:00', NULL, 1, 1, 3, 4, NULL, NULL, NULL, NULL, NULL, NULL, '\"{\\\"item_type\\\":\\\"service\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"4\\\",\\\"item_code\\\":\\\"ITM-7196-3313\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"123\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"1\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"1\\\"},\\\"wholesale\\\":{\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null},\\\"purchase\\\":{\\\"purchase_price\\\":null,\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":null,\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null},\\\"online\\\":{\\\"title\\\":null,\\\"description\\\":null}}\"', NULL, NULL),
(10, 'product', 'Howard Chaney', 'AHUYG434', 'ITM-5875-4778', '1000', 'Without Tax', NULL, 'percentage', NULL, 'Without Tax', NULL, NULL, 'Without Tax', '2025-10-04 02:44:57', '2025-10-04 02:44:57', NULL, 1, NULL, 2, 18, NULL, NULL, NULL, NULL, NULL, NULL, '\"{\\\"item_type\\\":\\\"product\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-5875-4778\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"1000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null},\\\"wholesale\\\":{\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null},\\\"purchase\\\":{\\\"purchase_price\\\":null,\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":null,\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null},\\\"online\\\":{\\\"title\\\":null,\\\"description\\\":null}}\"', NULL, NULL),
(11, 'product', 'Robin Shaffer', 'NEGHI89U8U9', 'ITM-3354-0915', '969', 'Without Tax', '138', 'percentage', '234352', 'Without Tax', '42', '5454', 'Without Tax', '2025-10-04 02:57:06', '2025-10-04 02:57:06', NULL, 1, 1, 2, 481, 435, 53, '34', NULL, NULL, NULL, '\"{\\\"item_type\\\":\\\"product\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"481\\\",\\\"item_code\\\":\\\"ITM-3354-0915\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"969\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"138\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"1\\\"},\\\"wholesale\\\":{\\\"wholesale_price\\\":\\\"234352\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"42\\\"},\\\"purchase\\\":{\\\"purchase_price\\\":\\\"5454\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":\\\"435\\\",\\\"low_stock_warning\\\":\\\"53\\\",\\\"warehouse_location\\\":\\\"34\\\"},\\\"online\\\":{\\\"title\\\":null,\\\"description\\\":null}}\"', NULL, NULL),
(20, 'raw_material', 'Andoride Box', 'dsver', 'ITM-7362-9293', '100', 'Without Tax', '10', 'percentage', '80', 'Without Tax', '10', '50', 'Without Tax', '2025-10-15 06:06:36', '2025-10-15 06:06:36', NULL, 4, NULL, 3, 18, 18, 1, 'kamla market', NULL, NULL, NULL, '\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Box\\\",\\\"item_hsn\\\":\\\"dsver\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-7362-9293\\\",\\\"sale_price\\\":\\\"100\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"80\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"50\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\"', NULL, 'raw_material'),
(21, 'raw_material', 'Andoride Reelay', 'AKUYG434', 'ITM-8937-3458', '100', 'Without Tax', '10', 'percentage', '80', 'Without Tax', '10', '50', 'Without Tax', '2025-10-15 06:07:50', '2025-10-15 06:07:50', NULL, 4, NULL, 3, 18, 18, 1, 'kamla market', NULL, NULL, NULL, '\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Reelay\\\",\\\"item_hsn\\\":\\\"AKUYG434\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-8937-3458\\\",\\\"sale_price\\\":\\\"100\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"80\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"50\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\"', NULL, 'raw_material'),
(22, 'product', 'Andoride Basic', 'AHUYG435', 'ITM-5609-7631', '3000', 'Without Tax', '10', 'percentage', '2500', 'Without Tax', '10', '2000', 'Without Tax', '2025-10-16 01:48:35', '2025-10-16 01:48:35', NULL, 3, NULL, 3, 5, 5, 1, 'kamla market', NULL, NULL, NULL, '\"{\\\"_token\\\":\\\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"Andoride Basic\\\",\\\"item_hsn\\\":\\\"AHUYG435\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"5\\\",\\\"item_code\\\":\\\"ITM-5609-7631\\\",\\\"sale_price\\\":\\\"3000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"2500\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"2000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"5\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"select_raw_materials\\\":[\\\"20\\\",\\\"21\\\",\\\"9\\\"],\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"5\\\\\\\"}\\\"}\"', NULL, 'finished_goods'),
(24, 'raw_material', 'Andoride Display', 'AKUYG431', 'ITM-4524-3825', '3000', 'Without Tax', '10', 'percentage', '2500', 'Without Tax', '10', '2000', 'Without Tax', '2025-10-16 02:49:35', '2025-10-16 02:49:35', NULL, 4, NULL, 3, 18, 18, 1, 'kamla market', NULL, NULL, NULL, '\"{\\\"_token\\\":\\\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\\\",\\\"item_type\\\":\\\"raw_material\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Display\\\",\\\"item_hsn\\\":\\\"AKUYG431\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-4524-3825\\\",\\\"sale_price\\\":\\\"3000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"2500\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"2000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\"', NULL, 'raw_material'),
(25, 'raw_material', 'Andoride Display', 'AKUYG434', 'ITM-1597-1704', '120', 'Without Tax', NULL, 'percentage', NULL, 'Without Tax', NULL, '100', 'Without Tax', '2025-11-03 01:17:08', '2025-11-03 01:17:08', NULL, 5, NULL, 5, 18, 18, NULL, NULL, NULL, NULL, NULL, '\"{\\\"_token\\\":\\\"ezLUyx8LO611FC0pdeNfinv7Zrdyxq5xovFM8jsI\\\",\\\"item_type\\\":\\\"raw_material\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Display\\\",\\\"item_hsn\\\":\\\"AKUYG434\\\",\\\"select_unit_id\\\":\\\"5\\\",\\\"select_category\\\":[\\\"5\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-1597-1704\\\",\\\"sale_price\\\":\\\"120\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null,\\\"purchase_price\\\":\\\"100\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null,\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\",\\\\\\\"opening_stock\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\"', NULL, 'raw_material'),
(26, 'product', 'Andoride', 'NEGHI89U8U9', 'ITM-3728-1211', '3000', 'With Tax', NULL, 'percentage', NULL, 'Without Tax', NULL, '2000', 'Without Tax', '2025-11-03 01:43:11', '2025-11-03 01:43:11', NULL, 5, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '\"{\\\"_token\\\":\\\"ezLUyx8LO611FC0pdeNfinv7Zrdyxq5xovFM8jsI\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"Andoride\\\",\\\"item_hsn\\\":\\\"NEGHI89U8U9\\\",\\\"select_unit_id\\\":\\\"5\\\",\\\"select_category\\\":[\\\"5\\\"],\\\"quantity\\\":null,\\\"item_code\\\":\\\"ITM-3728-1211\\\",\\\"sale_price\\\":\\\"3000\\\",\\\"select_type\\\":\\\"With Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"7\\\",\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null,\\\"purchase_price\\\":\\\"2000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":null,\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null,\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"select_raw_materials\\\":[\\\"25\\\"],\\\"raw_qty\\\":{\\\"25\\\":\\\"2\\\"},\\\"raw_sale_price\\\":{\\\"25\\\":\\\"120\\\"},\\\"raw_purchase_price\\\":{\\\"25\\\":\\\"100\\\"},\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":null,\\\\\\\"opening_stock\\\\\\\":null,\\\\\\\"composition_totals\\\\\\\":{\\\\\\\"total_sale_value\\\\\\\":240,\\\\\\\"total_purchase_value\\\\\\\":200}}\\\",\\\"composition_summary\\\":{\\\"finished_goods_composition\\\":{\\\"total_qty_used\\\":2,\\\"total_sale_value\\\":240,\\\"total_purchase_value\\\":200}}}\"', NULL, 'finished_goods'),
(27, 'raw_material', 'Andoride Display', 'AKUYG435', 'ITM-6659-7432', '200', 'Without Tax', NULL, 'percentage', NULL, 'Without Tax', NULL, '100', 'Without Tax', '2025-11-04 00:55:46', '2025-11-04 00:55:46', NULL, 6, NULL, 4, 10, 10, NULL, NULL, NULL, NULL, NULL, '\"{\\\"_token\\\":\\\"THnUvAsOcOO0w7VNuMPxoYz6EC9WmWxDmyRoSuMT\\\",\\\"item_type\\\":\\\"raw_material\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Display\\\",\\\"item_hsn\\\":\\\"AKUYG435\\\",\\\"select_unit_id\\\":\\\"6\\\",\\\"select_category\\\":[\\\"6\\\"],\\\"quantity\\\":\\\"10\\\",\\\"item_code\\\":\\\"ITM-6659-7432\\\",\\\"sale_price\\\":\\\"200\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null,\\\"purchase_price\\\":\\\"100\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"10\\\",\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null,\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"10\\\\\\\",\\\\\\\"opening_stock\\\\\\\":\\\\\\\"10\\\\\\\",\\\\\\\"composition_totals\\\\\\\":{\\\\\\\"total_sale_value\\\\\\\":0,\\\\\\\"total_purchase_value\\\\\\\":0}}\\\"}\"', NULL, 'raw_material'),
(28, 'raw_material', 'Andoride Box', 'AKUYG435', 'ITM-9253-4715', '300', 'Without Tax', NULL, 'percentage', NULL, 'Without Tax', NULL, '200', 'Without Tax', '2025-11-04 00:56:42', '2025-11-05 06:22:32', NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '\"{\\\"item_type\\\":\\\"raw_material\\\",\\\"unit_id\\\":null,\\\"select_category\\\":\\\"2\\\",\\\"quantity\\\":null,\\\"item_code\\\":\\\"ITM-9253-4715\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"300\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null},\\\"wholesale\\\":{\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null},\\\"purchase\\\":{\\\"purchase_price\\\":\\\"200\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":null,\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null},\\\"online\\\":{\\\"title\\\":null,\\\"description\\\":null}}\"', NULL, 'raw_material'),
(29, 'product', 'current stock check', 'currentstock', 'ITM-5015-0511', '200', 'Without Tax', NULL, 'percentage', NULL, 'Without Tax', NULL, '100', 'Without Tax', '2025-11-05 06:24:00', '2025-11-05 06:30:22', '2025-11-05 06:30:22', 3, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"current stock check\\\",\\\"item_hsn\\\":\\\"currentstock\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":null,\\\"item_code\\\":\\\"ITM-5015-0511\\\",\\\"sale_price\\\":\\\"200\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null,\\\"purchase_price\\\":\\\"100\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":null,\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null,\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"raw_qty\\\":{\\\"20\\\":\\\"0\\\",\\\"21\\\":\\\"0\\\",\\\"24\\\":\\\"0\\\",\\\"9\\\":\\\"0\\\"},\\\"raw_sale_price\\\":{\\\"20\\\":\\\"100\\\",\\\"21\\\":\\\"100\\\",\\\"24\\\":\\\"3000\\\",\\\"9\\\":\\\"123\\\"},\\\"raw_purchase_price\\\":{\\\"20\\\":\\\"50\\\",\\\"21\\\":\\\"50\\\",\\\"24\\\":\\\"2000\\\",\\\"9\\\":\\\"0\\\"},\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":null,\\\\\\\"opening_stock\\\\\\\":null,\\\\\\\"composition_totals\\\\\\\":{\\\\\\\"total_sale_value\\\\\\\":0,\\\\\\\"total_purchase_value\\\\\\\":0}}\\\",\\\"composition_summary\\\":{\\\"finished_goods_composition\\\":{\\\"total_qty_used\\\":0,\\\"total_sale_value\\\":0,\\\"total_purchase_value\\\":0}}}\"', NULL, 'finished_goods'),
(30, 'product', 'stock check', 'stockcheck', 'ITM-6665-4176', '1200', 'Without Tax', NULL, 'percentage', NULL, 'Without Tax', NULL, '1000', 'Without Tax', '2025-11-05 06:33:44', '2025-11-05 06:33:44', NULL, 3, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"stock check\\\",\\\"item_hsn\\\":\\\"stockcheck\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":null,\\\"item_code\\\":\\\"ITM-6665-4176\\\",\\\"sale_price\\\":\\\"1200\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null,\\\"purchase_price\\\":\\\"1000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":null,\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null,\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"raw_qty\\\":{\\\"20\\\":\\\"0\\\",\\\"21\\\":\\\"0\\\",\\\"24\\\":\\\"0\\\",\\\"9\\\":\\\"0\\\"},\\\"raw_sale_price\\\":{\\\"20\\\":\\\"100\\\",\\\"21\\\":\\\"100\\\",\\\"24\\\":\\\"3000\\\",\\\"9\\\":\\\"123\\\"},\\\"raw_purchase_price\\\":{\\\"20\\\":\\\"50\\\",\\\"21\\\":\\\"50\\\",\\\"24\\\":\\\"2000\\\",\\\"9\\\":\\\"0\\\"},\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":null,\\\\\\\"opening_stock\\\\\\\":null,\\\\\\\"composition_totals\\\\\\\":{\\\\\\\"total_sale_value\\\\\\\":0,\\\\\\\"total_purchase_value\\\\\\\":0}}\\\",\\\"composition_summary\\\":{\\\"finished_goods_composition\\\":{\\\"total_qty_used\\\":0,\\\"total_sale_value\\\":0,\\\"total_purchase_value\\\":0}}}\"', NULL, 'finished_goods'),
(31, 'service', 'Service2', 'AKUYG4341', 'ITM-7926-4560', '299', 'Without Tax', NULL, 'percentage', NULL, 'Without Tax', NULL, NULL, 'Without Tax', '2025-11-08 04:58:12', '2025-11-08 04:58:12', NULL, 3, NULL, 3, 0, 0, NULL, NULL, NULL, NULL, NULL, '\"{\\\"_token\\\":\\\"vM6YzvJ0GBWE2fVkOS8uMdS0WCGZ0OBb39EgAxNO\\\",\\\"item_type\\\":\\\"service\\\",\\\"product_type\\\":null,\\\"item_name\\\":\\\"Service2\\\",\\\"item_hsn\\\":\\\"AKUYG4341\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"0\\\",\\\"item_code\\\":\\\"ITM-7926-4560\\\",\\\"sale_price\\\":\\\"299\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null,\\\"purchase_price\\\":null,\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"0\\\",\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null,\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"raw_qty\\\":{\\\"20\\\":\\\"0\\\",\\\"21\\\":\\\"0\\\",\\\"24\\\":\\\"0\\\",\\\"9\\\":\\\"0\\\"},\\\"raw_sale_price\\\":{\\\"20\\\":\\\"100\\\",\\\"21\\\":\\\"100\\\",\\\"24\\\":\\\"3000\\\",\\\"9\\\":\\\"123\\\"},\\\"raw_purchase_price\\\":{\\\"20\\\":\\\"50\\\",\\\"21\\\":\\\"50\\\",\\\"24\\\":\\\"2000\\\",\\\"9\\\":\\\"0\\\"},\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"service\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"0\\\\\\\",\\\\\\\"opening_stock\\\\\\\":\\\\\\\"0\\\\\\\",\\\\\\\"composition_totals\\\\\\\":{\\\\\\\"total_sale_value\\\\\\\":0,\\\\\\\"total_purchase_value\\\\\\\":0}}\\\"}\"', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `add_item_category`
--

CREATE TABLE `add_item_category` (
  `add_item_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_item_category`
--

INSERT INTO `add_item_category` (`add_item_id`, `category_id`) VALUES
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(20, 4),
(21, 4),
(22, 3),
(24, 3),
(25, 5),
(26, 5),
(27, 6),
(28, 2),
(29, 4),
(30, 4),
(31, 3);

-- --------------------------------------------------------

--
-- Table structure for table `add_item_current_stock`
--

CREATE TABLE `add_item_current_stock` (
  `current_stock_id` bigint(20) UNSIGNED NOT NULL,
  `add_item_id` bigint(20) UNSIGNED NOT NULL,
  `qty` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_item_current_stock`
--

INSERT INTO `add_item_current_stock` (`current_stock_id`, `add_item_id`, `qty`) VALUES
(6, 7, '21'),
(7, 8, '12'),
(8, 11, NULL),
(14, 20, NULL),
(15, 21, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `add_item_estimate_quotation`
--

CREATE TABLE `add_item_estimate_quotation` (
  `estimate_quotation_id` bigint(20) UNSIGNED NOT NULL,
  `add_item_id` bigint(20) UNSIGNED NOT NULL,
  `amount` text DEFAULT NULL,
  `created_by_id` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `discount` text DEFAULT NULL,
  `discount_type` text DEFAULT NULL,
  `json_data` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `qty` text DEFAULT NULL,
  `tax` text DEFAULT NULL,
  `tax_type` text DEFAULT NULL,
  `unit` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_item_estimate_quotation`
--

INSERT INTO `add_item_estimate_quotation` (`estimate_quotation_id`, `add_item_id`, `amount`, `created_by_id`, `description`, `discount`, `discount_type`, `json_data`, `price`, `qty`, `tax`, `tax_type`, `unit`, `created_at`, `updated_at`) VALUES
(1, 31, '299.00', '3', NULL, '0', 'value', '{\"add_item_id\":\"31\",\"qty\":\"1\",\"price\":\"299.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"299.00\"}', '299.00', '1', '18', 'with', '', '0000-00-00 00:00:00', NULL),
(1, 20, '100.00', '3', NULL, '0', 'value', '{\"add_item_id\":\"20\",\"qty\":\"1\",\"price\":\"100.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"100.00\"}', '100.00', '1', '18', 'with', '', '0000-00-00 00:00:00', NULL),
(1, 22, '30000.00', '3', NULL, '0', 'value', '{\"add_item_id\":\"22\",\"qty\":\"10\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"30000.00\"}', '3000.00', '10', '18', 'with', '', '0000-00-00 00:00:00', NULL),
(2, 9, '123.00', '3', NULL, '0', 'value', '{\"add_item_id\":\"9\",\"qty\":\"1\",\"price\":\"123.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"123.00\"}', '123.00', '1', '18', 'with', '', '0000-00-00 00:00:00', NULL),
(2, 21, '100.00', '3', NULL, '0', 'value', '{\"add_item_id\":\"21\",\"qty\":\"1\",\"price\":\"100.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"100.00\"}', '100.00', '1', '18', 'with', '', '0000-00-00 00:00:00', NULL),
(2, 30, '1200.00', '3', NULL, '0', 'value', '{\"add_item_id\":\"30\",\"qty\":\"1\",\"price\":\"1200.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"1200.00\"}', '1200.00', '1', '18', 'with', '', '0000-00-00 00:00:00', NULL),
(2, 31, '299.00', '3', NULL, '0', 'value', '{\"add_item_id\":\"31\",\"qty\":\"1\",\"price\":\"299.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"299.00\"}', '299.00', '1', '18', 'with', '', '0000-00-00 00:00:00', NULL),
(2, 22, '3000.00', '3', NULL, '0', 'value', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"3000.00\"}', '3000.00', '1', '18', 'with', '', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `add_item_proforma_invoice`
--

CREATE TABLE `add_item_proforma_invoice` (
  `proforma_invoice_id` bigint(20) UNSIGNED NOT NULL,
  `add_item_id` bigint(20) UNSIGNED NOT NULL,
  `amount` text DEFAULT NULL,
  `created_by_id` text NOT NULL,
  `description` text DEFAULT NULL,
  `discount` text DEFAULT NULL,
  `discount_type` text DEFAULT NULL,
  `json_data` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `tax` text DEFAULT NULL,
  `tax_type` text DEFAULT NULL,
  `unit` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `add_item_purchase_bill`
--

CREATE TABLE `add_item_purchase_bill` (
  `purchase_bill_id` bigint(20) UNSIGNED NOT NULL,
  `add_item_id` bigint(20) UNSIGNED NOT NULL,
  `qty` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `unit` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `discount_type` text DEFAULT NULL,
  `discount` text DEFAULT NULL,
  `tax_type` text DEFAULT NULL,
  `tax` text DEFAULT NULL,
  `amount` text DEFAULT NULL,
  `created_by_id` text DEFAULT NULL,
  `json_data` text DEFAULT NULL,
  `created_at` text DEFAULT NULL,
  `updated_at` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_item_purchase_bill`
--

INSERT INTO `add_item_purchase_bill` (`purchase_bill_id`, `add_item_id`, `qty`, `description`, `unit`, `price`, `discount_type`, `discount`, `tax_type`, `tax`, `amount`, `created_by_id`, `json_data`, `created_at`, `updated_at`) VALUES
(20, 7, '10', NULL, NULL, '1000', 'value', '100', 'with', '6', '10494.00', '1', '{\"id\":\"7\",\"qty\":\"10\",\"price\":\"1000\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"6\",\"amount\":\"10494.00\"}', '2025-10-09 07:21:12', '2025-10-09 07:21:12'),
(20, 9, '10', NULL, NULL, '300', 'value', '100', 'with', '12', '3248.00', '1', '{\"id\":\"9\",\"qty\":\"10\",\"price\":\"300\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"12\",\"amount\":\"3248.00\"}', '2025-10-09 07:21:12', '2025-10-09 07:21:12'),
(21, 7, '20', NULL, NULL, '1000', 'value', '100', 'with', '10', '21890.00', '1', '{\"id\":\"7\",\"qty\":\"20\",\"price\":\"1000\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"10\",\"amount\":\"21890.00\"}', '2025-10-09 08:04:32', '2025-10-09 08:04:32'),
(21, 11, '1', NULL, NULL, '5454', 'value', '100', 'with', '100', '10708.00', '1', '{\"id\":\"11\",\"qty\":\"1\",\"price\":\"5454\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"100\",\"amount\":\"10708.00\"}', '2025-10-09 08:04:32', '2025-10-09 08:04:32'),
(22, 22, '10', NULL, NULL, '2000', 'value', '0', 'without', '0', '20000.00', '3', '{\"id\":\"22\",\"qty\":\"10\",\"price\":\"2000\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"20000.00\"}', '2025-11-05 11:40:11', '2025-11-05 11:40:11'),
(23, 22, '3', NULL, NULL, '2000', 'value', '0', 'without', '0', '6000.00', '3', '{\"id\":\"22\",\"qty\":\"3\",\"price\":\"2000\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"6000.00\"}', '2025-11-05 11:42:21', '2025-11-05 11:42:21'),
(24, 30, '10', NULL, NULL, '1000', 'value', '0', 'without', '0', '10000.00', '3', '{\"id\":\"30\",\"qty\":\"10\",\"price\":\"1000\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"10000.00\"}', '2025-11-05 12:04:52', '2025-11-05 12:04:52');

-- --------------------------------------------------------

--
-- Table structure for table `add_item_purchase_order`
--

CREATE TABLE `add_item_purchase_order` (
  `purchase_order_id` bigint(20) UNSIGNED NOT NULL,
  `add_item_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `add_item_sale_invoice`
--

CREATE TABLE `add_item_sale_invoice` (
  `sale_invoice_id` bigint(20) UNSIGNED NOT NULL,
  `add_item_id` bigint(20) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `qty` text DEFAULT NULL,
  `unit` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `discount_type` text DEFAULT NULL,
  `discount` text DEFAULT NULL,
  `tax_type` text DEFAULT NULL,
  `tax` text DEFAULT NULL,
  `amount` text DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `json_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json_data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_item_sale_invoice`
--

INSERT INTO `add_item_sale_invoice` (`sale_invoice_id`, `add_item_id`, `description`, `qty`, `unit`, `price`, `discount_type`, `discount`, `tax_type`, `tax`, `amount`, `created_by_id`, `json_data`, `created_at`, `updated_at`) VALUES
(10, 7, NULL, '6', NULL, '1500', 'value', '200', 'with', '10', '9680.00', 1, '{\"add_item_id\":\"7\",\"qty\":\"6\",\"price\":\"1500\",\"discount_type\":\"value\",\"discount\":\"200\",\"tax_type\":\"with\",\"tax\":\"10\",\"amount\":\"9680.00\"}', '2025-10-07 05:03:15', '2025-10-07 05:03:15'),
(10, 11, NULL, '10', NULL, '969', 'value', '200', 'with', '10', '10439.00', 1, '{\"add_item_id\":\"11\",\"qty\":\"10\",\"price\":\"969\",\"discount_type\":\"value\",\"discount\":\"200\",\"tax_type\":\"with\",\"tax\":\"10\",\"amount\":\"10439.00\"}', '2025-10-07 05:03:15', '2025-10-07 05:03:15'),
(11, 7, NULL, '2', NULL, '1500', 'value', '100', 'with', '10', '3190.00', 1, '{\"add_item_id\":\"7\",\"qty\":\"2\",\"price\":\"1500\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"10\",\"amount\":\"3190.00\"}', '2025-10-09 03:49:03', '2025-10-09 03:49:03'),
(11, 9, NULL, '1', NULL, '123', 'value', '10', 'with', '10', '124.30', 1, '{\"add_item_id\":\"9\",\"qty\":\"1\",\"price\":\"123\",\"discount_type\":\"value\",\"discount\":\"10\",\"tax_type\":\"with\",\"tax\":\"10\",\"amount\":\"124.30\"}', '2025-10-09 03:49:03', '2025-10-09 03:49:03'),
(12, 9, NULL, '1', NULL, '100', 'value', '0', 'without', '0', '100.00', 1, '{\"add_item_id\":\"9\",\"qty\":\"1\",\"price\":\"100\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"100.00\"}', '2025-10-09 03:54:16', '2025-10-09 03:54:16'),
(13, 7, NULL, '1', NULL, '1500', 'value', '100', 'with', '6', '1484.00', 1, '{\"add_item_id\":\"7\",\"qty\":\"1\",\"price\":\"1500\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"6\",\"amount\":\"1484.00\"}', '2025-10-09 08:16:53', '2025-10-09 08:16:53'),
(13, 11, NULL, '1', NULL, '969', 'value', '0', 'without', '0', '969.00', 1, '{\"add_item_id\":\"11\",\"qty\":\"1\",\"price\":\"969\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"969.00\"}', '2025-10-09 08:16:53', '2025-10-09 08:16:53'),
(14, 22, NULL, '1', NULL, '2000.00', 'value', '0', 'without', '0', '2000.00', 3, '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"2000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"2000.00\"}', '2025-11-03 05:15:43', '2025-11-03 05:15:43'),
(14, 9, NULL, '1', NULL, '300', 'value', '0', 'without', '0', '300.00', 3, '{\"add_item_id\":\"9\",\"qty\":\"1\",\"price\":\"300\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"300.00\"}', '2025-11-03 05:15:43', '2025-11-03 05:15:43'),
(15, 22, NULL, '1', NULL, '2500.00', 'value', '0', 'without', '0', '2500.00', 3, '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"2500.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"2500.00\"}', '2025-11-04 06:06:08', '2025-11-04 06:06:08'),
(16, 22, NULL, '5', NULL, '2600.00', 'value', '0', 'without', '0', '13000.00', 3, '{\"add_item_id\":\"22\",\"qty\":\"5\",\"price\":\"2600.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"13000.00\"}', '2025-11-05 05:32:45', '2025-11-05 05:32:45'),
(16, 9, NULL, '5', NULL, '400', 'value', '0', 'without', '0', '2000.00', 3, '{\"add_item_id\":\"9\",\"qty\":\"5\",\"price\":\"400\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"2000.00\"}', '2025-11-05 05:32:45', '2025-11-05 05:32:45'),
(17, 22, NULL, '1', NULL, '3000.00', 'value', '0', 'with', '18', '3000.00', 3, '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"3000.00\"}', '2025-11-08 02:14:57', '2025-11-08 02:14:57'),
(18, 22, NULL, '1', NULL, '3000.00', 'value', '0', 'with', '18', '3000.00', 3, '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"3000.00\"}', '2025-12-02 04:32:36', '2025-12-02 04:32:36'),
(18, 9, NULL, '1', NULL, '123.00', 'value', '0', 'with', '18', '123.00', 3, '{\"add_item_id\":\"9\",\"qty\":\"1\",\"price\":\"123.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"123.00\"}', '2025-12-02 04:32:36', '2025-12-02 04:32:36'),
(19, 22, NULL, '1', NULL, '3000.00', 'value', '0', 'with', '18', '3000.00', 3, '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"3000.00\"}', '2025-12-02 06:12:20', '2025-12-02 06:12:20'),
(21, 9, NULL, '1', NULL, '123.00', NULL, NULL, NULL, '18', '123.00', 3, NULL, '2025-12-10 06:38:13', '2025-12-10 06:38:13'),
(21, 21, NULL, '1', NULL, '100.00', NULL, NULL, NULL, '18', '100.00', 3, NULL, '2025-12-10 06:38:13', '2025-12-10 06:38:13'),
(21, 30, NULL, '1', NULL, '1200.00', NULL, NULL, NULL, '18', '1200.00', 3, NULL, '2025-12-10 06:38:13', '2025-12-10 06:38:13'),
(21, 31, NULL, '1', NULL, '299.00', NULL, NULL, NULL, '18', '299.00', 3, NULL, '2025-12-10 06:38:13', '2025-12-10 06:38:13'),
(21, 22, NULL, '1', NULL, '3000.00', NULL, NULL, NULL, '18', '3000.00', 3, NULL, '2025-12-10 06:38:13', '2025-12-10 06:38:13'),
(22, 9, NULL, '1', NULL, '123.00', NULL, NULL, NULL, '18', '123.00', 3, NULL, '2025-12-11 01:03:28', '2025-12-11 01:03:28'),
(22, 21, NULL, '1', NULL, '100.00', NULL, NULL, NULL, '18', '100.00', 3, NULL, '2025-12-11 01:03:28', '2025-12-11 01:03:28'),
(22, 30, NULL, '1', NULL, '1200.00', NULL, NULL, NULL, '18', '1200.00', 3, NULL, '2025-12-11 01:03:28', '2025-12-11 01:03:28'),
(22, 31, NULL, '1', NULL, '299.00', NULL, NULL, NULL, '18', '299.00', 3, NULL, '2025-12-11 01:03:28', '2025-12-11 01:03:28'),
(22, 22, NULL, '1', NULL, '3000.00', NULL, NULL, NULL, '18', '3000.00', 3, NULL, '2025-12-11 01:03:28', '2025-12-11 01:03:28'),
(23, 9, NULL, '1', NULL, '123.00', NULL, NULL, NULL, '18', '123.00', 3, '{\"add_item_id\":\"9\",\"qty\":\"1\",\"price\":\"123.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"123.00\"}', '2025-12-11 01:39:52', '2025-12-11 01:39:52'),
(23, 21, NULL, '1', NULL, '100.00', NULL, NULL, NULL, '18', '100.00', 3, '{\"add_item_id\":\"21\",\"qty\":\"1\",\"price\":\"100.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"100.00\"}', '2025-12-11 01:39:52', '2025-12-11 01:39:52'),
(23, 30, NULL, '1', NULL, '1200.00', NULL, NULL, NULL, '18', '1200.00', 3, '{\"add_item_id\":\"30\",\"qty\":\"1\",\"price\":\"1200.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"1200.00\"}', '2025-12-11 01:39:52', '2025-12-11 01:39:52'),
(23, 31, NULL, '1', NULL, '299.00', NULL, NULL, NULL, '18', '299.00', 3, '{\"add_item_id\":\"31\",\"qty\":\"1\",\"price\":\"299.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"299.00\"}', '2025-12-11 01:39:52', '2025-12-11 01:39:52'),
(23, 22, NULL, '1', NULL, '3000.00', NULL, NULL, NULL, '18', '3000.00', 3, '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"3000.00\"}', '2025-12-11 01:39:52', '2025-12-11 01:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `adjust_bank_balances`
--

CREATE TABLE `adjust_bank_balances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `adjustment_date` date DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `from_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` text DEFAULT NULL,
  `host` varchar(46) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES
(1, 'audit:created', 1, 'App\\Models\\AddBusiness#1', 1, '{\"company_name\":\"EEMOTRACK INDIA\",\"legal_name\":\"EEMOTRACK INDIA\",\"business_type\":\"Pvt Ltd\",\"industry_type\":\"Manufacturing\",\"updated_at\":\"2025-08-27 06:56:11\",\"created_at\":\"2025-08-27 06:56:11\",\"id\":1,\"logo_upload\":[],\"media\":[]}', '127.0.0.1', '2025-08-27 01:26:11', '2025-08-27 01:26:11'),
(2, 'audit:created', 2, 'App\\Models\\User#2', 1, '{\"name\":\"Emmot\",\"email\":\"eemotrack@gmail.com\",\"updated_at\":\"2025-08-27 06:57:11\",\"created_at\":\"2025-08-27 06:57:11\",\"id\":2}', '127.0.0.1', '2025-08-27 01:27:11', '2025-08-27 01:27:11'),
(3, 'audit:created', 2, 'App\\Models\\AddBusiness#2', 1, '{\"company_name\":\"maruti suzaki venture\",\"legal_name\":\"maruti suzaki venture\",\"business_type\":\"Partnership\",\"industry_type\":\"Manufacturing\",\"updated_at\":\"2025-08-27 06:59:21\",\"created_at\":\"2025-08-27 06:59:21\",\"id\":2,\"logo_upload\":[],\"media\":[]}', '127.0.0.1', '2025-08-27 01:29:21', '2025-08-27 01:29:21'),
(4, 'audit:created', 3, 'App\\Models\\User#3', 1, '{\"name\":\"MSV\",\"email\":\"msv@gmail.com\",\"updated_at\":\"2025-08-27 07:00:09\",\"created_at\":\"2025-08-27 07:00:09\",\"id\":3}', '127.0.0.1', '2025-08-27 01:30:09', '2025-08-27 01:30:09'),
(5, 'audit:created', 1, 'App\\Models\\ExpenseCategory#1', 3, '{\"expense_category\":\"MILK\",\"type\":\"Liability\",\"created_by_id\":3,\"updated_at\":\"2025-08-27 07:01:52\",\"created_at\":\"2025-08-27 07:01:52\",\"id\":1}', '127.0.0.1', '2025-08-27 01:31:52', '2025-08-27 01:31:52'),
(6, 'audit:created', 1, 'App\\Models\\PartyDetail#1', 1, '{\"party_name\":\"Sade Boyle\",\"gstin\":\"121212121212121\",\"phone_number\":\"8863897163\",\"pan_number\":\"kiipk7404n\",\"type_of_supply\":\"Intra-State\",\"gst_type\":\"Registered_Business_Regular\",\"pincode\":\"805130\",\"state\":\"patna\",\"city\":\"patna\",\"billing_address\":\"<p>svccv xc xc dx&nbsp;<\\/p>\",\"shipping_address\":\"<p>serdvesv cdx&nbsp;<\\/p>\",\"email\":\"ajayfilliptect@gmail.com\",\"opening_balance\":\"1000000\",\"as_of_date\":\"2025-08-27\",\"opening_balance_type\":\"Debit\",\"credit_limit\":\"off\",\"credit_limit_amount\":\"10000\",\"payment_terms\":\"Elit facilis velit\",\"ifsc_code\":\"AIRP0000001\",\"account_number\":\"13243546466\",\"bank_name\":\"Airtel Payments Bank\",\"branch\":\"patna\",\"notes\":\"<p>sgvdfbfg &nbsp;4egr tdrg grg<\\/p>\",\"status\":\"enable\",\"updated_at\":\"2025-08-27 07:58:05\",\"created_at\":\"2025-08-27 07:58:05\",\"id\":1}', '127.0.0.1', '2025-08-27 02:28:05', '2025-08-27 02:28:05'),
(7, 'audit:updated', 1, 'App\\Models\\User#1', 1, '{\"remember_token\":\"DQOTJDftflvhb75rfpuSjX8jVWd7U6iZMqRTsSZZGUElSOvSwpUZ2f0hDqWS\"}', '127.0.0.1', '2025-08-30 01:57:08', '2025-08-30 01:57:08'),
(8, 'audit:updated', 1, 'App\\Models\\User#1', 1, '{\"remember_token\":\"9cm9RKM3aL4QTJ2KfEuz7z0t25NYe9PWWnKbapwlsPnzk87Jo8f8HVk9fJdq\"}', '127.0.0.1', '2025-08-30 01:57:20', '2025-08-30 01:57:20'),
(9, 'audit:created', 1, 'App\\Models\\Category#1', 1, '{\"name\":\"Accesories\",\"updated_at\":\"2025-09-01 10:15:20\",\"created_at\":\"2025-09-01 10:15:20\",\"id\":1}', '127.0.0.1', '2025-09-01 04:45:20', '2025-09-01 04:45:20'),
(10, 'audit:created', 1, 'App\\Models\\Unit#1', 1, '{\"base_unit\":\"none\",\"secondary_unit\":\"none\",\"updated_at\":\"2025-09-01 10:27:39\",\"created_at\":\"2025-09-01 10:27:39\",\"id\":1}', '127.0.0.1', '2025-09-01 04:57:39', '2025-09-01 04:57:39'),
(11, 'audit:created', 1, 'App\\Models\\TaxRate#1', 1, '{\"name\":\"IGST\",\"parcentage\":\"6\",\"updated_at\":\"2025-09-01 10:29:03\",\"created_at\":\"2025-09-01 10:29:03\",\"id\":1}', '127.0.0.1', '2025-09-01 04:59:03', '2025-09-01 04:59:03'),
(12, 'audit:created', 2, 'App\\Models\\TaxRate#2', 1, '{\"name\":\"CGST\",\"parcentage\":\"6\",\"updated_at\":\"2025-09-01 10:29:21\",\"created_at\":\"2025-09-01 10:29:21\",\"id\":2}', '127.0.0.1', '2025-09-01 04:59:21', '2025-09-01 04:59:21'),
(13, 'audit:created', 1, 'App\\Models\\AddItem#1', 1, '{\"item_name\":\"LOCATOR\",\"item_hsn\":\"AKUYG434\",\"unit_id\":\"1\",\"select_category\":\"1\",\"quantity\":\"4\",\"item_code\":\"ITM-8957-5264\",\"sale_price\":\"2500\",\"select_type\":\"With Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"select_tax_id\":\"1\",\"wholesale_price\":\"2000\",\"select_type_wholesale\":\"With Tax\",\"minimum_wholesale_qty\":\"100\",\"purchase_price\":\"1200\",\"select_purchase_type\":\"With Tax\",\"opening_stock\":\"30\",\"low_stock_warning\":\"5\",\"warehouse_location\":\"kamla market\",\"online_store_title\":\"EEMOTRACK INDIA\",\"online_store_description\":\"ONLINE STORE\",\"online_store_image\":{},\"updated_at\":\"2025-09-01 11:05:46\",\"created_at\":\"2025-09-01 11:05:46\",\"id\":1}', '127.0.0.1', '2025-09-01 05:35:46', '2025-09-01 05:35:46'),
(14, 'audit:created', 2, 'App\\Models\\AddItem#2', 1, '{\"item_name\":\"LOCATOR\",\"item_hsn\":\"AKUYG434\",\"item_code\":\"ITM-3598-7638\",\"sale_price\":\"3000\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"wholesale_price\":\"2500\",\"minimum_wholesale_qty\":\"100\",\"purchase_price\":\"2000\",\"quantity\":\"4\",\"created_by_id\":1,\"item_type\":\"product\",\"select_unit_id\":\"1\",\"json_data\":{\"item_type\":\"service\",\"unit_id\":\"1\",\"select_category\":\"1\",\"quantity\":\"4\",\"item_code\":\"ITM-3598-7638\",\"pricing\":{\"sale_price\":\"3000\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"select_tax_id\":\"2\"},\"wholesale\":{\"wholesale_price\":\"2500\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"100\"},\"purchase\":{\"purchase_price\":\"2000\",\"select_purchase_type\":\"Without Tax\"},\"stock\":{\"opening_stock\":\"20\",\"low_stock_warning\":\"2\",\"warehouse_location\":\"kamla market\"},\"online\":{\"title\":\"EEMOTRACK INDIA\",\"description\":\"A GPS Comapny\"}},\"updated_at\":\"2025-09-01 11:32:17\",\"created_at\":\"2025-09-01 11:32:17\",\"id\":2}', '127.0.0.1', '2025-09-01 06:02:17', '2025-09-01 06:02:17'),
(16, 'audit:created', 4, 'App\\Models\\AddItem#4', 1, '{\"item_name\":\"Brenna Perez\",\"item_hsn\":\"AKUYG434\",\"item_code\":\"ITM-7878-1230\",\"sale_price\":\"3000\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"wholesale_price\":\"2500\",\"minimum_wholesale_qty\":\"100\",\"purchase_price\":\"2000\",\"quantity\":\"880\",\"json_data\":{\"item_type\":\"product\",\"unit_id\":\"1\",\"select_category\":\"1\",\"quantity\":\"880\",\"item_code\":\"ITM-7878-1230\",\"pricing\":{\"sale_price\":\"3000\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"select_tax_id\":\"1\"},\"wholesale\":{\"wholesale_price\":\"2500\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"100\"},\"purchase\":{\"purchase_price\":\"2000\",\"select_purchase_type\":\"Without Tax\"},\"stock\":{\"opening_stock\":\"40\",\"low_stock_warning\":\"5\",\"warehouse_location\":\"kamla market\"},\"online\":{\"title\":\"Omnis illum fugiat \",\"description\":\"Voluptatum voluptate\"}},\"online_store_image\":\"uploads\\/items\\/f4n5XGcBdNlZAdowSpeIQXyvD8P89yMTP6uXJhf5.jpg\",\"updated_at\":\"2025-09-01 11:58:08\",\"created_at\":\"2025-09-01 11:58:08\",\"id\":4}', '127.0.0.1', '2025-09-01 06:28:08', '2025-09-01 06:28:08'),
(17, 'audit:created', 5, 'App\\Models\\AddItem#5', 1, '{\"item_name\":\"Howard Chaney\",\"item_hsn\":\"AKUYG434\",\"select_unit_id\":\"1\",\"quantity\":\"732\",\"item_code\":\"ITM-5754-7048\",\"sale_price\":\"628\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"3\",\"disc_type\":\"percentage\",\"wholesale_price\":\"264\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"506\",\"purchase_price\":\"176\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":\"1\",\"opening_stock\":\"40\",\"low_stock_warning\":\"10\",\"warehouse_location\":\"kamla market\",\"online_store_title\":\"EEMOTRACK INDIA\",\"online_store_description\":\"vdsvdbfdb\",\"online_store_image\":\"item_images\\/lptVBQaiVsAdJBgHAiaHwrCYCDfnN5y6mgMryyFW.webp\",\"json_data\":\"{\\\"item_type\\\":\\\"service\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"732\\\",\\\"item_code\\\":\\\"ITM-5754-7048\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"628\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"3\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"1\\\"},\\\"wholesale\\\":{\\\"wholesale_price\\\":\\\"264\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"506\\\"},\\\"purchase\\\":{\\\"purchase_price\\\":\\\"176\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":\\\"40\\\",\\\"low_stock_warning\\\":\\\"10\\\",\\\"warehouse_location\\\":\\\"kamla market\\\"},\\\"online\\\":{\\\"title\\\":\\\"EEMOTRACK INDIA\\\",\\\"description\\\":\\\"vdsvdbfdb\\\"}}\",\"created_by_id\":1,\"updated_at\":\"2025-09-01 12:19:35\",\"created_at\":\"2025-09-01 12:19:35\",\"id\":5}', '127.0.0.1', '2025-09-01 06:49:35', '2025-09-01 06:49:35'),
(18, 'audit:updated', 5, 'App\\Models\\AddItem#5', 1, '{\"updated_at\":\"2025-09-05 10:45:20\",\"opening_stock\":\"35\",\"json_data\":\"\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"service\\\\\\\",\\\\\\\"unit_id\\\\\\\":\\\\\\\"1\\\\\\\",\\\\\\\"select_category\\\\\\\":\\\\\\\"1\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"732\\\\\\\",\\\\\\\"item_code\\\\\\\":\\\\\\\"ITM-5754-7048\\\\\\\",\\\\\\\"pricing\\\\\\\":{\\\\\\\"sale_price\\\\\\\":\\\\\\\"628\\\\\\\",\\\\\\\"select_type\\\\\\\":\\\\\\\"Without Tax\\\\\\\",\\\\\\\"disc_on_sale_price\\\\\\\":\\\\\\\"3\\\\\\\",\\\\\\\"disc_type\\\\\\\":\\\\\\\"percentage\\\\\\\",\\\\\\\"select_tax_id\\\\\\\":\\\\\\\"1\\\\\\\"},\\\\\\\"wholesale\\\\\\\":{\\\\\\\"wholesale_price\\\\\\\":\\\\\\\"264\\\\\\\",\\\\\\\"select_type_wholesale\\\\\\\":\\\\\\\"Without Tax\\\\\\\",\\\\\\\"minimum_wholesale_qty\\\\\\\":\\\\\\\"506\\\\\\\"},\\\\\\\"purchase\\\\\\\":{\\\\\\\"purchase_price\\\\\\\":\\\\\\\"176\\\\\\\",\\\\\\\"select_purchase_type\\\\\\\":\\\\\\\"Without Tax\\\\\\\"},\\\\\\\"stock\\\\\\\":{\\\\\\\"opening_stock\\\\\\\":\\\\\\\"35\\\\\\\",\\\\\\\"low_stock_warning\\\\\\\":\\\\\\\"10\\\\\\\",\\\\\\\"warehouse_location\\\\\\\":\\\\\\\"kamla market\\\\\\\"},\\\\\\\"online\\\\\\\":{\\\\\\\"title\\\\\\\":\\\\\\\"EEMOTRACK INDIA\\\\\\\",\\\\\\\"description\\\\\\\":\\\\\\\"vdsvdbfdb\\\\\\\"}}\\\"\"}', '127.0.0.1', '2025-09-05 05:15:20', '2025-09-05 05:15:20'),
(19, 'audit:created', 1, 'App\\Models\\CurrentStock#1', 1, '{\"parties_id\":null,\"qty\":\"35\",\"type\":\"Opening Stock\",\"created_by_id\":1,\"updated_at\":\"2025-09-05 10:45:20\",\"created_at\":\"2025-09-05 10:45:20\",\"id\":1}', '127.0.0.1', '2025-09-05 05:15:20', '2025-09-05 05:15:20'),
(20, 'audit:updated', 5, 'App\\Models\\AddItem#5', 1, '{\"updated_at\":\"2025-09-05 11:00:32\",\"opening_stock\":\"34\",\"json_data\":\"\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"Product\\\\\\\",\\\\\\\"unit_id\\\\\\\":\\\\\\\"1\\\\\\\",\\\\\\\"select_category\\\\\\\":\\\\\\\"1\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"732\\\\\\\",\\\\\\\"item_code\\\\\\\":\\\\\\\"ITM-5754-7048\\\\\\\",\\\\\\\"pricing\\\\\\\":{\\\\\\\"sale_price\\\\\\\":\\\\\\\"628\\\\\\\",\\\\\\\"select_type\\\\\\\":\\\\\\\"Without Tax\\\\\\\",\\\\\\\"disc_on_sale_price\\\\\\\":\\\\\\\"3\\\\\\\",\\\\\\\"disc_type\\\\\\\":\\\\\\\"percentage\\\\\\\",\\\\\\\"select_tax_id\\\\\\\":\\\\\\\"1\\\\\\\"},\\\\\\\"wholesale\\\\\\\":{\\\\\\\"wholesale_price\\\\\\\":\\\\\\\"264\\\\\\\",\\\\\\\"select_type_wholesale\\\\\\\":\\\\\\\"Without Tax\\\\\\\",\\\\\\\"minimum_wholesale_qty\\\\\\\":\\\\\\\"506\\\\\\\"},\\\\\\\"purchase\\\\\\\":{\\\\\\\"purchase_price\\\\\\\":\\\\\\\"176\\\\\\\",\\\\\\\"select_purchase_type\\\\\\\":\\\\\\\"Without Tax\\\\\\\"},\\\\\\\"stock\\\\\\\":{\\\\\\\"opening_stock\\\\\\\":\\\\\\\"34\\\\\\\",\\\\\\\"low_stock_warning\\\\\\\":\\\\\\\"10\\\\\\\",\\\\\\\"warehouse_location\\\\\\\":\\\\\\\"kamla market\\\\\\\"},\\\\\\\"online\\\\\\\":{\\\\\\\"title\\\\\\\":\\\\\\\"EEMOTRACK INDIA\\\\\\\",\\\\\\\"description\\\\\\\":\\\\\\\"vdsvdbfdb\\\\\\\"}}\\\"\"}', '127.0.0.1', '2025-09-05 05:30:32', '2025-09-05 05:30:32'),
(21, 'audit:updated', 1, 'App\\Models\\CurrentStock#1', 1, '{\"qty\":\"34\",\"type\":\"Opening Stock Updated\",\"updated_at\":\"2025-09-05 11:03:28\"}', '127.0.0.1', '2025-09-05 05:33:28', '2025-09-05 05:33:28'),
(22, 'audit:created', 4, 'App\\Models\\CurrentStock#4', 1, '{\"parties_id\":1,\"qty\":\"34\",\"type\":\"Opening Stock\",\"created_by_id\":1,\"updated_at\":\"2025-09-05 11:11:13\",\"created_at\":\"2025-09-05 11:11:13\",\"id\":4}', '127.0.0.1', '2025-09-05 05:41:13', '2025-09-05 05:41:13'),
(23, 'audit:created', 6, 'App\\Models\\AddItem#6', 1, '{\"item_name\":\"Howard Chaney\",\"item_hsn\":\"AKUYG434\",\"select_unit_id\":\"1\",\"quantity\":\"4\",\"item_code\":\"ITM-6125-4606\",\"sale_price\":\"2400\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"12\",\"disc_type\":\"percentage\",\"wholesale_price\":\"1500\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"12\",\"purchase_price\":\"1600\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":\"2\",\"opening_stock\":\"12\",\"low_stock_warning\":\"1\",\"warehouse_location\":\"kamla market\",\"online_store_title\":\"EEMOTRACK INDIA\",\"online_store_description\":\"sdv vedv ev\",\"online_store_image\":\"item_images\\/wNROk8UzbVVtBTebCCOEZcP6ZAh6BFnjHzVMcb9f.png\",\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"4\\\",\\\"item_code\\\":\\\"ITM-6125-4606\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"2400\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"12\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"2\\\"},\\\"wholesale\\\":{\\\"wholesale_price\\\":\\\"1500\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"12\\\"},\\\"purchase\\\":{\\\"purchase_price\\\":\\\"1600\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":\\\"12\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\"},\\\"online\\\":{\\\"title\\\":\\\"EEMOTRACK INDIA\\\",\\\"description\\\":\\\"sdv vedv ev \\\"}}\",\"created_by_id\":1,\"updated_at\":\"2025-09-09 08:19:36\",\"created_at\":\"2025-09-09 08:19:36\",\"id\":6}', '127.0.0.1', '2025-09-09 02:49:36', '2025-09-09 02:49:36'),
(24, 'audit:created', 5, 'App\\Models\\CurrentStock#5', 1, '{\"qty\":\"12\",\"type\":\"Opening Stock\",\"created_by_id\":1,\"updated_at\":\"2025-09-09 08:19:36\",\"created_at\":\"2025-09-09 08:19:36\",\"id\":5}', '127.0.0.1', '2025-09-09 02:49:36', '2025-09-09 02:49:36'),
(25, 'audit:updated', 4, 'App\\Models\\CurrentStock#4', 1, '{\"type\":\"Opening Stock Updated\",\"updated_at\":\"2025-09-09 08:31:47\"}', '127.0.0.1', '2025-09-09 03:01:47', '2025-09-09 03:01:47'),
(26, 'audit:updated', 4, 'App\\Models\\CurrentStock#4', 1, '{\"updated_at\":\"2025-09-09 08:32:37\",\"json_data\":\"{\\\"item_type\\\":\\\"Product\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"732\\\",\\\"item_code\\\":\\\"ITM-5754-7048\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"628\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"3\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"1\\\"},\\\"wholesale\\\":{\\\"wholesale_price\\\":\\\"264\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"506\\\"},\\\"purchase\\\":{\\\"purchase_price\\\":\\\"176\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":\\\"34\\\",\\\"low_stock_warning\\\":\\\"10\\\",\\\"warehouse_location\\\":\\\"kamla market\\\"},\\\"online\\\":{\\\"title\\\":\\\"EEMOTRACK INDIA\\\",\\\"description\\\":\\\"vdsvdbfdb\\\"}}\"}', '127.0.0.1', '2025-09-09 03:02:37', '2025-09-09 03:02:37'),
(27, 'audit:created', 7, 'App\\Models\\AddItem#7', 1, '{\"item_name\":\"LOCATOR\",\"item_hsn\":\"AKUYG434\",\"select_unit_id\":\"1\",\"quantity\":\"4\",\"item_code\":\"ITM-6258-8965\",\"sale_price\":\"1500\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"wholesale_price\":\"1200\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"10\",\"purchase_price\":\"1000\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":\"1\",\"opening_stock\":\"10\",\"low_stock_warning\":\"1\",\"warehouse_location\":\"kamla market\",\"online_store_title\":\"EEMOTRACK INDIA\",\"online_store_description\":\"Zcx e 4gregg34 erg 4egr\",\"online_store_image\":\"item_images\\/HYwY41Cr8aUTF94LmndVSZGv9mBoUd77wX5SpMeC.png\",\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"4\\\",\\\"item_code\\\":\\\"ITM-6258-8965\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"1500\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"1\\\"},\\\"wholesale\\\":{\\\"wholesale_price\\\":\\\"1200\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\"},\\\"purchase\\\":{\\\"purchase_price\\\":\\\"1000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":\\\"10\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\"},\\\"online\\\":{\\\"title\\\":\\\"EEMOTRACK INDIA\\\",\\\"description\\\":\\\"Zcx e 4gregg34 erg 4egr\\\"}}\",\"created_by_id\":1,\"updated_at\":\"2025-09-09 08:43:41\",\"created_at\":\"2025-09-09 08:43:41\",\"id\":7}', '127.0.0.1', '2025-09-09 03:13:41', '2025-09-09 03:13:41'),
(28, 'audit:created', 6, 'App\\Models\\CurrentStock#6', 1, '{\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"4\\\",\\\"item_code\\\":\\\"ITM-6258-8965\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"1500\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"1\\\"},\\\"wholesale\\\":{\\\"wholesale_price\\\":\\\"1200\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\"},\\\"purchase\\\":{\\\"purchase_price\\\":\\\"1000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":\\\"10\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\"},\\\"online\\\":{\\\"title\\\":\\\"EEMOTRACK INDIA\\\",\\\"description\\\":\\\"Zcx e 4gregg34 erg 4egr\\\"}}\",\"user_id\":1,\"qty\":\"10\",\"type\":\"Opening Stock\",\"created_by_id\":1,\"updated_at\":\"2025-09-09 08:43:41\",\"created_at\":\"2025-09-09 08:43:41\",\"id\":6}', '127.0.0.1', '2025-09-09 03:13:41', '2025-09-09 03:13:41'),
(29, 'audit:created', 8, 'App\\Models\\AddItem#8', 1, '{\"item_name\":\"GPS 1X\",\"item_hsn\":\"AKUYG435\",\"select_unit_id\":\"1\",\"quantity\":\"18\",\"item_code\":\"ITM-3825-6054\",\"sale_price\":\"3600\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"wholesale_price\":\"3000\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"100\",\"purchase_price\":\"1000\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":\"1\",\"opening_stock\":\"100\",\"low_stock_warning\":\"10\",\"warehouse_location\":\"kamla market\",\"online_store_title\":\"EEMOTRACK INDIA\",\"online_store_description\":\"2q r2 3e er 3f we f 2f cf 2rf\",\"online_store_image\":\"item_images\\/lpHcckX8Xr8tQqFhdsMWwOe9vK8Gly3PT9dhCdSI.png\",\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-3825-6054\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"3600\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"1\\\"},\\\"wholesale\\\":{\\\"wholesale_price\\\":\\\"3000\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"100\\\"},\\\"purchase\\\":{\\\"purchase_price\\\":\\\"1000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":\\\"100\\\",\\\"low_stock_warning\\\":\\\"10\\\",\\\"warehouse_location\\\":\\\"kamla market\\\"},\\\"online\\\":{\\\"title\\\":\\\"EEMOTRACK INDIA\\\",\\\"description\\\":\\\" 2q r2 3e er 3f we f 2f cf 2rf \\\"}}\",\"created_by_id\":1,\"updated_at\":\"2025-09-09 09:05:43\",\"created_at\":\"2025-09-09 09:05:43\",\"id\":8}', '127.0.0.1', '2025-09-09 03:35:43', '2025-09-09 03:35:43'),
(30, 'audit:created', 7, 'App\\Models\\CurrentStock#7', 1, '{\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-3825-6054\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"3600\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"1\\\"},\\\"wholesale\\\":{\\\"wholesale_price\\\":\\\"3000\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"100\\\"},\\\"purchase\\\":{\\\"purchase_price\\\":\\\"1000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":\\\"100\\\",\\\"low_stock_warning\\\":\\\"10\\\",\\\"warehouse_location\\\":\\\"kamla market\\\"},\\\"online\\\":{\\\"title\\\":\\\"EEMOTRACK INDIA\\\",\\\"description\\\":\\\" 2q r2 3e er 3f we f 2f cf 2rf \\\"}}\",\"user_id\":1,\"qty\":\"100\",\"type\":\"Opening Stock\",\"created_by_id\":1,\"updated_at\":\"2025-09-09 09:05:43\",\"created_at\":\"2025-09-09 09:05:43\",\"id\":7}', '127.0.0.1', '2025-09-09 03:35:43', '2025-09-09 03:35:43'),
(31, 'audit:created', 9, 'App\\Models\\AddItem#9', 1, '{\"item_type\":\"service\",\"item_name\":\"Service\",\"item_hsn\":\"AKUYG434\",\"select_unit_id\":\"1\",\"quantity\":\"4\",\"item_code\":\"ITM-7196-3313\",\"sale_price\":\"123\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"1\",\"disc_type\":\"percentage\",\"wholesale_price\":null,\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":null,\"purchase_price\":null,\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":\"1\",\"opening_stock\":null,\"low_stock_warning\":null,\"warehouse_location\":null,\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"item_type\\\":\\\"service\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"4\\\",\\\"item_code\\\":\\\"ITM-7196-3313\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"123\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"1\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"1\\\"},\\\"wholesale\\\":{\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null},\\\"purchase\\\":{\\\"purchase_price\\\":null,\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":null,\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null},\\\"online\\\":{\\\"title\\\":null,\\\"description\\\":null}}\",\"created_by_id\":1,\"updated_at\":\"2025-09-20 06:51:00\",\"created_at\":\"2025-09-20 06:51:00\",\"id\":9}', '127.0.0.1', '2025-09-20 01:21:00', '2025-09-20 01:21:00'),
(32, 'audit:created', 1, 'App\\Models\\BankAccount#1', 1, '{\"account_name\":\"Ferdinand English\",\"opening_balance\":\"Enim voluptatem qui\",\"as_of_date\":\"1975-02-25\",\"account_number\":\"198\",\"ifsc_code\":\"Voluptatem sequi rep\",\"bank_name\":\"Noelle Shaw\",\"account_holder_name\":\"Tiger Reynolds\",\"upi\":\"Quia tempore enim r\",\"print_upi_qr\":\"1\",\"print_bank_details\":\"0\",\"updated_at\":\"2025-09-20 07:10:24\",\"created_at\":\"2025-09-20 07:10:24\",\"id\":1}', '127.0.0.1', '2025-09-20 01:40:24', '2025-09-20 01:40:24'),
(33, 'audit:updated', 1, 'App\\Models\\User#1', 1, '{\"remember_token\":\"l01d821JyqCM5wsQAHRViDnp5iT0Kf1ytcCfSLt0k3fuu8Z49Yk1wjIM4sa6\"}', '127.0.0.1', '2025-09-20 07:14:36', '2025-09-20 07:14:36'),
(34, 'audit:created', 1, 'App\\Models\\MainCostCenter#1', 1, '{\"cost_center_name\":\"Melodie Holloway\",\"unique_code\":\"Est a iusto minim ip\",\"status\":\"active\",\"link_with_company_id\":\"1\",\"responsible_manager_id\":\"1\",\"budget_amount\":\"30\",\"actual_amount\":\"80\",\"start_date\":\"2024-09-07\",\"details_of_cost_center\":\"<p>FinSmartHub \\u2013 Helping you make smarter money choices. Learn, plan, and manage your finances confidently.<\\/p><p>Take charge of your financial journey with trusted tips and guidance from FinSmartHub.<\\/p><p>Want to understand finance better? FinSmartHub brings learning resources and tools for smart money management.<\\/p><p>From budgeting to planning \\u2013 FinSmartHub is your partner in smarter financial decisions.<\\/p><p>Discover easy-to-follow resources on financial literacy with FinSmartHub.<\\/p>\",\"location\":\"<p>FinSmartHub \\u2013 Helping you make smarter money choices. Learn, plan, and manage your finances confidently.<\\/p><p>Take charge of your financial journey with trusted tips and guidance from FinSmartHub.<\\/p><p>Want to understand finance better? FinSmartHub brings learning resources and tools for smart money management.<\\/p><p>From budgeting to planning \\u2013 FinSmartHub is your partner in smarter financial decisions.<\\/p><p>Discover easy-to-follow resources on financial literacy with FinSmartHub.<\\/p>\",\"updated_at\":\"2025-09-22 07:55:01\",\"created_at\":\"2025-09-22 07:55:01\",\"id\":1}', '127.0.0.1', '2025-09-22 02:25:01', '2025-09-22 02:25:01'),
(35, 'audit:updated', 1, 'App\\Models\\MainCostCenter#1', 1, '{\"cost_center_name\":\"West Bangel\",\"updated_at\":\"2025-09-22 07:55:41\"}', '127.0.0.1', '2025-09-22 02:25:41', '2025-09-22 02:25:41'),
(36, 'audit:created', 1, 'App\\Models\\SubCostCenter#1', 1, '{\"main_cost_center_id\":\"1\",\"sub_cost_center_name\":\"Holly Holmes\",\"unique_code\":\"Consequatur quo debi\",\"responsible_manager\":\"Dolor et sit neque\",\"budget_allocated\":\"36\",\"actual_expense\":\"7\",\"start_date\":\"2024-09-07\",\"status\":\"active\",\"details_of_sub_cost_center\":\"Doloribus consequat\",\"updated_at\":\"2025-09-22 08:10:12\",\"created_at\":\"2025-09-22 08:10:12\",\"id\":1}', '127.0.0.1', '2025-09-22 02:40:12', '2025-09-22 02:40:12'),
(37, 'audit:created', 2, 'App\\Models\\MainCostCenter#2', 1, '{\"cost_center_name\":\"Gujrat\",\"unique_code\":\"In culpa fugit qui\",\"status\":\"active\",\"link_with_company_id\":\"1\",\"responsible_manager_id\":\"1\",\"budget_amount\":\"57\",\"actual_amount\":\"90\",\"start_date\":\"2024-09-07\",\"details_of_cost_center\":\"<p>qwvfewv wbverfb&nbsp;<\\/p>\",\"location\":\"<p>evf cverfdg evfr vc<\\/p>\",\"updated_at\":\"2025-09-25 08:43:57\",\"created_at\":\"2025-09-25 08:43:57\",\"id\":2}', '127.0.0.1', '2025-09-25 03:13:57', '2025-09-25 03:13:57'),
(38, 'audit:created', 2, 'App\\Models\\PurchaseBill#2', 1, '{\"select_customer_id\":\"1\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"billing_name\":\"Sade Boyle\",\"phone_number\":\"8863897163\",\"billing_address\":\"<p>svccv xc xc dx&nbsp;<\\/p>\",\"shipping_address\":\"<p>serdvesv cdx&nbsp;<\\/p>\",\"po_no\":\"8943784\",\"po_date\":\"2025-09-25\",\"e_way_bill_no\":\"7832\",\"payment_type_id\":\"1\",\"reference_no\":\"uhsfjhe88\",\"purchase_bill_no\":\"PB4073897125\",\"json_data\":\"{\\\"_token\\\":\\\"TTMVMJD35E8edEiiIi65GfMFvDAwyOXMZVuS8KXl\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"billing_name\\\":\\\"Sade Boyle\\\",\\\"phone_number\\\":\\\"8863897163\\\",\\\"billing_address\\\":\\\"<p>svccv xc xc dx&nbsp;<\\\\\\/p>\\\",\\\"shipping_address\\\":\\\"<p>serdvesv cdx&nbsp;<\\\\\\/p>\\\",\\\"po_no\\\":\\\"8943784\\\",\\\"po_date\\\":\\\"2025-09-25\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"items\\\":[{\\\"id\\\":\\\"6\\\",\\\"description\\\":\\\"HSN: AKUYG434\\\",\\\"qty\\\":\\\"10\\\",\\\"unit\\\":\\\"Piece\\\",\\\"price\\\":\\\"1000\\\",\\\"amount\\\":\\\"10000.00\\\"},{\\\"id\\\":\\\"7\\\",\\\"description\\\":\\\"HSN: AKUYG435\\\",\\\"qty\\\":\\\"100\\\",\\\"unit\\\":\\\"Piece\\\",\\\"price\\\":\\\"1000\\\",\\\"amount\\\":\\\"100000.00\\\"}],\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"notes\\\":\\\"jbhfyufyujh  bhiugbh nbug bugijbbhiguhvj iu\\\",\\\"image\\\":{},\\\"document\\\":{},\\\"purchase_bill_no\\\":\\\"PB4073897125\\\",\\\"user_id\\\":1}\",\"updated_at\":\"2025-09-25 11:37:18\",\"created_at\":\"2025-09-25 11:37:18\",\"id\":2,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-09-25 06:07:18', '2025-09-25 06:07:18'),
(39, 'audit:created', 3, 'App\\Models\\PurchaseBill#3', 1, '{\"select_customer_id\":\"1\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"billing_name\":\"Sade Boyle\",\"phone_number\":\"8863897163\",\"billing_address\":\"<p>svccv xc xc dx&nbsp;<\\/p>\",\"shipping_address\":\"<p>serdvesv cdx&nbsp;<\\/p>\",\"po_no\":\"8943784\",\"po_date\":\"2025-09-25\",\"e_way_bill_no\":\"7832\",\"payment_type_id\":\"1\",\"reference_no\":\"uhsfjhe88\",\"purchase_bill_no\":\"PB6075245162\",\"json_data\":\"{\\\"_token\\\":\\\"TTMVMJD35E8edEiiIi65GfMFvDAwyOXMZVuS8KXl\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"billing_name\\\":\\\"Sade Boyle\\\",\\\"phone_number\\\":\\\"8863897163\\\",\\\"billing_address\\\":\\\"<p>svccv xc xc dx&nbsp;<\\\\\\/p>\\\",\\\"shipping_address\\\":\\\"<p>serdvesv cdx&nbsp;<\\\\\\/p>\\\",\\\"po_no\\\":\\\"8943784\\\",\\\"po_date\\\":\\\"2025-09-25\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"items\\\":[{\\\"id\\\":\\\"6\\\",\\\"description\\\":\\\"HSN: AKUYG434\\\",\\\"qty\\\":\\\"10\\\",\\\"unit\\\":\\\"Piece\\\",\\\"price\\\":\\\"1000\\\",\\\"amount\\\":\\\"10000.00\\\"},{\\\"id\\\":\\\"7\\\",\\\"description\\\":\\\"HSN: AKUYG435\\\",\\\"qty\\\":\\\"100\\\",\\\"unit\\\":\\\"Piece\\\",\\\"price\\\":\\\"1000\\\",\\\"amount\\\":\\\"100000.00\\\"}],\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"notes\\\":\\\"jbhfyufyujh  bhiugbh nbug bugijbbhiguhvj iu\\\",\\\"image\\\":{},\\\"document\\\":{},\\\"purchase_bill_no\\\":\\\"PB6075245162\\\",\\\"user_id\\\":1}\",\"updated_at\":\"2025-09-25 11:38:26\",\"created_at\":\"2025-09-25 11:38:26\",\"id\":3,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-09-25 06:08:26', '2025-09-25 06:08:26'),
(40, 'audit:updated', 6, 'App\\Models\\CurrentStock#6', 1, '{\"qty\":20,\"updated_at\":\"2025-09-25 11:38:26\"}', '127.0.0.1', '2025-09-25 06:08:26', '2025-09-25 06:08:26'),
(41, 'audit:updated', 7, 'App\\Models\\CurrentStock#7', 1, '{\"qty\":200,\"updated_at\":\"2025-09-25 11:38:26\"}', '127.0.0.1', '2025-09-25 06:08:26', '2025-09-25 06:08:26'),
(42, 'audit:created', 4, 'App\\Models\\PurchaseBill#4', 1, '{\"select_customer_id\":\"1\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"billing_name\":\"Sade Boyle\",\"phone_number\":\"8863897163\",\"billing_address\":\"<p>svccv xc xc dx&nbsp;<\\/p>\",\"shipping_address\":\"<p>serdvesv cdx&nbsp;<\\/p>\",\"po_no\":\"8943784\",\"po_date\":\"2025-09-25\",\"e_way_bill_no\":\"7832\",\"payment_type_id\":\"1\",\"reference_no\":\"uhsfjhe88\",\"purchase_bill_no\":\"PB2033118819\",\"json_data\":\"{\\\"_token\\\":\\\"TTMVMJD35E8edEiiIi65GfMFvDAwyOXMZVuS8KXl\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"billing_name\\\":\\\"Sade Boyle\\\",\\\"phone_number\\\":\\\"8863897163\\\",\\\"billing_address\\\":\\\"<p>svccv xc xc dx&nbsp;<\\\\\\/p>\\\",\\\"shipping_address\\\":\\\"<p>serdvesv cdx&nbsp;<\\\\\\/p>\\\",\\\"po_no\\\":\\\"8943784\\\",\\\"po_date\\\":\\\"2025-09-25\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"items\\\":[{\\\"id\\\":\\\"6\\\",\\\"description\\\":\\\"HSN: AKUYG434\\\",\\\"qty\\\":\\\"6\\\",\\\"unit\\\":\\\"Piece\\\",\\\"price\\\":\\\"1000\\\",\\\"amount\\\":\\\"6000.00\\\"},{\\\"id\\\":\\\"7\\\",\\\"description\\\":\\\"HSN: AKUYG435\\\",\\\"qty\\\":\\\"8\\\",\\\"unit\\\":\\\"Piece\\\",\\\"price\\\":\\\"1000\\\",\\\"amount\\\":\\\"8000.00\\\"}],\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"notes\\\":\\\"wertyuiop[] benrmty fwghtyu dqwfegrhtyu 23tymh\\\",\\\"image\\\":{},\\\"document\\\":{},\\\"purchase_bill_no\\\":\\\"PB2033118819\\\",\\\"user_id\\\":1}\",\"updated_at\":\"2025-09-25 11:48:10\",\"created_at\":\"2025-09-25 11:48:10\",\"id\":4,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-09-25 06:18:10', '2025-09-25 06:18:10'),
(43, 'audit:updated', 6, 'App\\Models\\CurrentStock#6', 1, '{\"qty\":26,\"updated_at\":\"2025-09-25 11:48:10\"}', '127.0.0.1', '2025-09-25 06:18:10', '2025-09-25 06:18:10'),
(44, 'audit:updated', 7, 'App\\Models\\CurrentStock#7', 1, '{\"qty\":208,\"updated_at\":\"2025-09-25 11:48:10\"}', '127.0.0.1', '2025-09-25 06:18:10', '2025-09-25 06:18:10'),
(45, 'audit:created', 10, 'App\\Models\\AddItem#10', 1, '{\"item_type\":\"product\",\"item_name\":\"Howard Chaney\",\"item_hsn\":\"AHUYG434\",\"select_unit_id\":\"1\",\"quantity\":\"18\",\"item_code\":\"ITM-5875-4778\",\"sale_price\":\"1000\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":null,\"disc_type\":\"percentage\",\"wholesale_price\":null,\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":null,\"purchase_price\":null,\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":null,\"opening_stock\":null,\"low_stock_warning\":null,\"warehouse_location\":null,\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-5875-4778\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"1000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null},\\\"wholesale\\\":{\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null},\\\"purchase\\\":{\\\"purchase_price\\\":null,\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":null,\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null},\\\"online\\\":{\\\"title\\\":null,\\\"description\\\":null}}\",\"created_by_id\":1,\"updated_at\":\"2025-10-04 08:14:57\",\"created_at\":\"2025-10-04 08:14:57\",\"id\":10}', '127.0.0.1', '2025-10-04 02:44:57', '2025-10-04 02:44:57'),
(46, 'audit:created', 11, 'App\\Models\\AddItem#11', 1, '{\"item_type\":\"product\",\"item_name\":\"Robin Shaffer\",\"item_hsn\":\"NEGHI89U8U9\",\"select_unit_id\":\"1\",\"quantity\":\"481\",\"item_code\":\"ITM-3354-0915\",\"sale_price\":\"969\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"138\",\"disc_type\":\"percentage\",\"wholesale_price\":\"234352\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"42\",\"purchase_price\":\"5454\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":\"1\",\"opening_stock\":\"435\",\"low_stock_warning\":\"53\",\"warehouse_location\":\"34\",\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"481\\\",\\\"item_code\\\":\\\"ITM-3354-0915\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"969\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"138\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"1\\\"},\\\"wholesale\\\":{\\\"wholesale_price\\\":\\\"234352\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"42\\\"},\\\"purchase\\\":{\\\"purchase_price\\\":\\\"5454\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":\\\"435\\\",\\\"low_stock_warning\\\":\\\"53\\\",\\\"warehouse_location\\\":\\\"34\\\"},\\\"online\\\":{\\\"title\\\":null,\\\"description\\\":null}}\",\"created_by_id\":1,\"updated_at\":\"2025-10-04 08:27:06\",\"created_at\":\"2025-10-04 08:27:06\",\"id\":11}', '127.0.0.1', '2025-10-04 02:57:06', '2025-10-04 02:57:06'),
(47, 'audit:created', 8, 'App\\Models\\CurrentStock#8', 1, '{\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"481\\\",\\\"item_code\\\":\\\"ITM-3354-0915\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"969\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"138\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"1\\\"},\\\"wholesale\\\":{\\\"wholesale_price\\\":\\\"234352\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"42\\\"},\\\"purchase\\\":{\\\"purchase_price\\\":\\\"5454\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":\\\"435\\\",\\\"low_stock_warning\\\":\\\"53\\\",\\\"warehouse_location\\\":\\\"34\\\"},\\\"online\\\":{\\\"title\\\":null,\\\"description\\\":null}}\",\"user_id\":1,\"qty\":\"435\",\"type\":\"Opening Stock\",\"created_by_id\":1,\"updated_at\":\"2025-10-04 08:27:06\",\"created_at\":\"2025-10-04 08:27:06\",\"id\":8}', '127.0.0.1', '2025-10-04 02:57:06', '2025-10-04 02:57:06'),
(48, 'audit:created', 5, 'App\\Models\\PurchaseBill#5', 1, '{\"select_customer_id\":\"1\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"billing_name\":\"Sade Boyle\",\"phone_number\":\"8863897163\",\"billing_address\":\"<p>svccv xc xc dx&nbsp;<\\/p>\",\"shipping_address\":\"<p>serdvesv cdx&nbsp;<\\/p>\",\"po_no\":\"8943784\",\"po_date\":\"2025-10-06\",\"e_way_bill_no\":\"7832\",\"payment_type_id\":null,\"reference_no\":null,\"purchase_bill_no\":\"PB9956020116\",\"json_data\":\"{\\\"_token\\\":\\\"GMHk4sAcs97XgMycQBhSL0gYDsv9KjHhjEsKk08I\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"billing_name\\\":\\\"Sade Boyle\\\",\\\"phone_number\\\":\\\"8863897163\\\",\\\"billing_address\\\":\\\"<p>svccv xc xc dx&nbsp;<\\\\\\/p>\\\",\\\"shipping_address\\\":\\\"<p>serdvesv cdx&nbsp;<\\\\\\/p>\\\",\\\"po_no\\\":\\\"8943784\\\",\\\"po_date\\\":\\\"2025-10-06\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"items\\\":[{\\\"id\\\":\\\"3\\\",\\\"description\\\":\\\"HSN: AKUYG434\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"0\\\",\\\"tax_rate_id\\\":null,\\\"discount\\\":\\\"0\\\",\\\"amount\\\":\\\"0.00\\\"}],\\\"payment_type_id\\\":null,\\\"reference_no\\\":null,\\\"notes\\\":null,\\\"purchase_bill_no\\\":\\\"PB9956020116\\\",\\\"user_id\\\":1}\",\"updated_at\":\"2025-10-06 09:42:14\",\"created_at\":\"2025-10-06 09:42:14\",\"id\":5,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-06 04:12:14', '2025-10-06 04:12:14'),
(49, 'audit:created', 1, 'App\\Models\\SaleInvoice#1', 1, '{\"sale_invoice_number\":\"ET-20251007094810941\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251007-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-07\",\"due_date\":\"2025-10-07 00:00:00\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"ewfpuwehfuewf q 0woi0w9rauofi09aroifc o9\",\"terms\":\"pweoifwe09 sow9a fjiojwsu9zfiojcp o\",\"overall_discount\":\"100\",\"subtotal\":\"5390.00\",\"tax\":\"539.00\",\"discount\":\"300.00\",\"total\":\"5829.00\",\"attachment\":null,\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"s0DPzqkbrhfqtwnUSJDO3dhMudiXIXa1IXz4I2ym\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251007-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-07\\\",\\\"due_date\\\":\\\"2025-10-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"7\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"1500\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"1540.00\\\"},{\\\"add_item_id\\\":\\\"8\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3600\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"3850.00\\\"}],\\\"notes\\\":\\\"ewfpuwehfuewf q 0woi0w9rauofi09aroifc o9\\\",\\\"terms\\\":\\\"pweoifwe09 sow9a fjiojwsu9zfiojcp o\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"5390.00\\\",\\\"tax\\\":\\\"539.00\\\",\\\"discount\\\":\\\"300.00\\\",\\\"total\\\":\\\"5829.00\\\"}\",\"status\":\"pending\",\"updated_at\":\"2025-10-07 09:48:10\",\"created_at\":\"2025-10-07 09:48:10\",\"id\":1,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-07 04:18:10', '2025-10-07 04:18:10'),
(50, 'audit:created', 2, 'App\\Models\\SaleInvoice#2', 1, '{\"sale_invoice_number\":\"ET-20251007095212208\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251007-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-07\",\"due_date\":\"2025-10-07 00:00:00\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"ewfpuwehfuewf q 0woi0w9rauofi09aroifc o9\",\"terms\":\"pweoifwe09 sow9a fjiojwsu9zfiojcp o\",\"overall_discount\":\"100\",\"subtotal\":\"5390.00\",\"tax\":\"539.00\",\"discount\":\"300.00\",\"total\":\"5829.00\",\"attachment\":null,\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"s0DPzqkbrhfqtwnUSJDO3dhMudiXIXa1IXz4I2ym\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251007-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-07\\\",\\\"due_date\\\":\\\"2025-10-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"7\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"1500\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"1540.00\\\"},{\\\"add_item_id\\\":\\\"8\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3600\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"3850.00\\\"}],\\\"notes\\\":\\\"ewfpuwehfuewf q 0woi0w9rauofi09aroifc o9\\\",\\\"terms\\\":\\\"pweoifwe09 sow9a fjiojwsu9zfiojcp o\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"5390.00\\\",\\\"tax\\\":\\\"539.00\\\",\\\"discount\\\":\\\"300.00\\\",\\\"total\\\":\\\"5829.00\\\"}\",\"status\":\"pending\",\"updated_at\":\"2025-10-07 09:52:12\",\"created_at\":\"2025-10-07 09:52:12\",\"id\":2,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-07 04:22:12', '2025-10-07 04:22:12'),
(51, 'audit:created', 3, 'App\\Models\\SaleInvoice#3', 1, '{\"sale_invoice_number\":\"ET-20251007095257250\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251007-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-07\",\"due_date\":\"2025-10-07 00:00:00\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"ewfpuwehfuewf q 0woi0w9rauofi09aroifc o9\",\"terms\":\"pweoifwe09 sow9a fjiojwsu9zfiojcp o\",\"overall_discount\":\"100\",\"subtotal\":\"5390.00\",\"tax\":\"539.00\",\"discount\":\"300.00\",\"total\":\"5829.00\",\"attachment\":null,\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"s0DPzqkbrhfqtwnUSJDO3dhMudiXIXa1IXz4I2ym\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251007-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-07\\\",\\\"due_date\\\":\\\"2025-10-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"7\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"1500\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"1540.00\\\"},{\\\"add_item_id\\\":\\\"8\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3600\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"3850.00\\\"}],\\\"notes\\\":\\\"ewfpuwehfuewf q 0woi0w9rauofi09aroifc o9\\\",\\\"terms\\\":\\\"pweoifwe09 sow9a fjiojwsu9zfiojcp o\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"5390.00\\\",\\\"tax\\\":\\\"539.00\\\",\\\"discount\\\":\\\"300.00\\\",\\\"total\\\":\\\"5829.00\\\"}\",\"status\":\"pending\",\"updated_at\":\"2025-10-07 09:52:57\",\"created_at\":\"2025-10-07 09:52:57\",\"id\":3,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-07 04:22:57', '2025-10-07 04:22:57'),
(52, 'audit:created', 4, 'App\\Models\\SaleInvoice#4', 1, '{\"sale_invoice_number\":\"ET-20251007095319873\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251007-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-07\",\"due_date\":\"2025-10-07 00:00:00\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"ewfpuwehfuewf q 0woi0w9rauofi09aroifc o9\",\"terms\":\"pweoifwe09 sow9a fjiojwsu9zfiojcp o\",\"overall_discount\":\"100\",\"subtotal\":\"5390.00\",\"tax\":\"539.00\",\"discount\":\"300.00\",\"total\":\"5829.00\",\"attachment\":null,\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"s0DPzqkbrhfqtwnUSJDO3dhMudiXIXa1IXz4I2ym\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251007-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-07\\\",\\\"due_date\\\":\\\"2025-10-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"7\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"1500\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"1540.00\\\"},{\\\"add_item_id\\\":\\\"8\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3600\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"3850.00\\\"}],\\\"notes\\\":\\\"ewfpuwehfuewf q 0woi0w9rauofi09aroifc o9\\\",\\\"terms\\\":\\\"pweoifwe09 sow9a fjiojwsu9zfiojcp o\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"5390.00\\\",\\\"tax\\\":\\\"539.00\\\",\\\"discount\\\":\\\"300.00\\\",\\\"total\\\":\\\"5829.00\\\"}\",\"status\":\"pending\",\"updated_at\":\"2025-10-07 09:53:19\",\"created_at\":\"2025-10-07 09:53:19\",\"id\":4,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-07 04:23:19', '2025-10-07 04:23:19'),
(53, 'audit:created', 5, 'App\\Models\\SaleInvoice#5', 1, '{\"sale_invoice_number\":\"ET-20251007095354107\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251007-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-07\",\"due_date\":\"2025-10-07 00:00:00\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"ewfpuwehfuewf q 0woi0w9rauofi09aroifc o9\",\"terms\":\"pweoifwe09 sow9a fjiojwsu9zfiojcp o\",\"overall_discount\":\"100\",\"subtotal\":\"5390.00\",\"tax\":\"539.00\",\"discount\":\"300.00\",\"total\":\"5829.00\",\"attachment\":null,\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"s0DPzqkbrhfqtwnUSJDO3dhMudiXIXa1IXz4I2ym\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251007-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-07\\\",\\\"due_date\\\":\\\"2025-10-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"7\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"1500\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"1540.00\\\"},{\\\"add_item_id\\\":\\\"8\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3600\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"3850.00\\\"}],\\\"notes\\\":\\\"ewfpuwehfuewf q 0woi0w9rauofi09aroifc o9\\\",\\\"terms\\\":\\\"pweoifwe09 sow9a fjiojwsu9zfiojcp o\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"5390.00\\\",\\\"tax\\\":\\\"539.00\\\",\\\"discount\\\":\\\"300.00\\\",\\\"total\\\":\\\"5829.00\\\"}\",\"status\":\"pending\",\"updated_at\":\"2025-10-07 09:53:54\",\"created_at\":\"2025-10-07 09:53:54\",\"id\":5,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-07 04:23:54', '2025-10-07 04:23:54');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES
(54, 'audit:updated', 7, 'App\\Models\\CurrentStock#7', 1, '{\"qty\":207,\"updated_at\":\"2025-10-07 09:53:54\"}', '127.0.0.1', '2025-10-07 04:23:54', '2025-10-07 04:23:54'),
(55, 'audit:updated', 8, 'App\\Models\\CurrentStock#8', 1, '{\"qty\":434,\"updated_at\":\"2025-10-07 09:53:54\"}', '127.0.0.1', '2025-10-07 04:23:54', '2025-10-07 04:23:54'),
(56, 'audit:created', 6, 'App\\Models\\SaleInvoice#6', 1, '{\"sale_invoice_number\":\"ET-20251007102107800\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251007-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-07\",\"due_date\":\"2025-10-07 00:00:00\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"fdvb  34erdgb 34ertf\",\"terms\":\"23werdfgcr 34ertf\",\"overall_discount\":\"100\",\"subtotal\":\"4153.60\",\"tax\":\"415.36\",\"discount\":\"200.00\",\"total\":\"4468.96\",\"attachment\":\"attachments\\/afPVPzfAnt3ZJaNAbRjsPq5ygmN6pP9Kln9xQ4AX.pdf\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"s0DPzqkbrhfqtwnUSJDO3dhMudiXIXa1IXz4I2ym\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251007-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-07\\\",\\\"due_date\\\":\\\"2025-10-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"11\\\",\\\"qty\\\":\\\"4\\\",\\\"price\\\":\\\"969\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"4153.60\\\"}],\\\"notes\\\":\\\"fdvb  34erdgb 34ertf\\\",\\\"terms\\\":\\\"23werdfgcr 34ertf\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"4153.60\\\",\\\"tax\\\":\\\"415.36\\\",\\\"discount\\\":\\\"200.00\\\",\\\"total\\\":\\\"4468.96\\\",\\\"attachment\\\":{}}\",\"status\":\"pending\",\"updated_at\":\"2025-10-07 10:21:07\",\"created_at\":\"2025-10-07 10:21:07\",\"id\":6,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-07 04:51:07', '2025-10-07 04:51:07'),
(57, 'audit:created', 7, 'App\\Models\\SaleInvoice#7', 1, '{\"sale_invoice_number\":\"ET-20251007102131795\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251007-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-07\",\"due_date\":\"2025-10-07 00:00:00\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"fdvb  34erdgb 34ertf\",\"terms\":\"23werdfgcr 34ertf\",\"overall_discount\":\"100\",\"subtotal\":\"4153.60\",\"tax\":\"415.36\",\"discount\":\"200.00\",\"total\":\"4468.96\",\"attachment\":\"attachments\\/ROmNeuuclSh2VfK43cBGSyAAtEKwoB5Y5wDf8o0G.pdf\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"s0DPzqkbrhfqtwnUSJDO3dhMudiXIXa1IXz4I2ym\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251007-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-07\\\",\\\"due_date\\\":\\\"2025-10-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"11\\\",\\\"qty\\\":\\\"4\\\",\\\"price\\\":\\\"969\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"4153.60\\\"}],\\\"notes\\\":\\\"fdvb  34erdgb 34ertf\\\",\\\"terms\\\":\\\"23werdfgcr 34ertf\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"4153.60\\\",\\\"tax\\\":\\\"415.36\\\",\\\"discount\\\":\\\"200.00\\\",\\\"total\\\":\\\"4468.96\\\",\\\"attachment\\\":{}}\",\"status\":\"pending\",\"updated_at\":\"2025-10-07 10:21:31\",\"created_at\":\"2025-10-07 10:21:31\",\"id\":7,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-07 04:51:31', '2025-10-07 04:51:31'),
(58, 'audit:created', 8, 'App\\Models\\SaleInvoice#8', 1, '{\"sale_invoice_number\":\"ET-20251007102814992\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251007-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-07\",\"due_date\":\"2025-10-07 00:00:00\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"fdvb  34erdgb 34ertf\",\"terms\":\"23werdfgcr 34ertf\",\"overall_discount\":\"100\",\"subtotal\":\"4153.60\",\"tax\":\"415.36\",\"discount\":\"200.00\",\"total\":\"4468.96\",\"attachment\":\"attachments\\/YnI1dF5HdFg0czq96vQ4HIrm92zIWZ9I1aH2bjgC.pdf\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"s0DPzqkbrhfqtwnUSJDO3dhMudiXIXa1IXz4I2ym\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251007-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-07\\\",\\\"due_date\\\":\\\"2025-10-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"11\\\",\\\"qty\\\":\\\"4\\\",\\\"price\\\":\\\"969\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"4153.60\\\"}],\\\"notes\\\":\\\"fdvb  34erdgb 34ertf\\\",\\\"terms\\\":\\\"23werdfgcr 34ertf\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"4153.60\\\",\\\"tax\\\":\\\"415.36\\\",\\\"discount\\\":\\\"200.00\\\",\\\"total\\\":\\\"4468.96\\\",\\\"attachment\\\":{}}\",\"status\":\"pending\",\"updated_at\":\"2025-10-07 10:28:14\",\"created_at\":\"2025-10-07 10:28:14\",\"id\":8,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-07 04:58:14', '2025-10-07 04:58:14'),
(59, 'audit:created', 9, 'App\\Models\\SaleInvoice#9', 1, '{\"sale_invoice_number\":\"ET-20251007102831750\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251007-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-07\",\"due_date\":\"2025-10-07 00:00:00\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"fdvb  34erdgb 34ertf\",\"terms\":\"23werdfgcr 34ertf\",\"overall_discount\":\"100\",\"subtotal\":\"4153.60\",\"tax\":\"415.36\",\"discount\":\"200.00\",\"total\":\"4468.96\",\"attachment\":\"attachments\\/5hOEHJVaIjLj46n4B8z4yyXIoqgpoPj1eMEWZG8n.pdf\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"s0DPzqkbrhfqtwnUSJDO3dhMudiXIXa1IXz4I2ym\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251007-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-07\\\",\\\"due_date\\\":\\\"2025-10-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"11\\\",\\\"qty\\\":\\\"4\\\",\\\"price\\\":\\\"969\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"4153.60\\\"}],\\\"notes\\\":\\\"fdvb  34erdgb 34ertf\\\",\\\"terms\\\":\\\"23werdfgcr 34ertf\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"4153.60\\\",\\\"tax\\\":\\\"415.36\\\",\\\"discount\\\":\\\"200.00\\\",\\\"total\\\":\\\"4468.96\\\",\\\"attachment\\\":{}}\",\"status\":\"pending\",\"updated_at\":\"2025-10-07 10:28:31\",\"created_at\":\"2025-10-07 10:28:31\",\"id\":9,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-07 04:58:31', '2025-10-07 04:58:31'),
(60, 'audit:updated', 8, 'App\\Models\\CurrentStock#8', 1, '{\"qty\":430,\"updated_at\":\"2025-10-07 10:28:31\"}', '127.0.0.1', '2025-10-07 04:58:31', '2025-10-07 04:58:31'),
(61, 'audit:created', 10, 'App\\Models\\SaleInvoice#10', 1, '{\"sale_invoice_number\":\"ET-20251007103315512\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251007-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-07\",\"due_date\":\"2025-10-07 00:00:00\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"scvs  w r4ewswr 2\",\"terms\":\"w3feseg\",\"overall_discount\":\"200\",\"subtotal\":\"20119.00\",\"tax\":\"2011.90\",\"discount\":\"600.00\",\"total\":\"21930.90\",\"attachment\":\"attachments\\/8afzqRIxlTA1fCyaw7cob9t13GRvHwb8ZHAVaDyr.pdf\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"s0DPzqkbrhfqtwnUSJDO3dhMudiXIXa1IXz4I2ym\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251007-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-07\\\",\\\"due_date\\\":\\\"2025-10-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"7\\\",\\\"qty\\\":\\\"6\\\",\\\"price\\\":\\\"1500\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"200\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"9680.00\\\"},{\\\"add_item_id\\\":\\\"11\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"969\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"200\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"10439.00\\\"}],\\\"notes\\\":\\\"scvs  w r4ewswr 2\\\",\\\"terms\\\":\\\"w3feseg\\\",\\\"overall_discount\\\":\\\"200\\\",\\\"subtotal\\\":\\\"20119.00\\\",\\\"tax\\\":\\\"2011.90\\\",\\\"discount\\\":\\\"600.00\\\",\\\"total\\\":\\\"21930.90\\\",\\\"attachment\\\":{}}\",\"status\":\"pending\",\"updated_at\":\"2025-10-07 10:33:15\",\"created_at\":\"2025-10-07 10:33:15\",\"id\":10,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-07 05:03:15', '2025-10-07 05:03:15'),
(62, 'audit:updated', 8, 'App\\Models\\CurrentStock#8', 1, '{\"qty\":420,\"updated_at\":\"2025-10-07 10:33:15\"}', '127.0.0.1', '2025-10-07 05:03:15', '2025-10-07 05:03:15'),
(63, 'audit:created', 6, 'App\\Models\\PurchaseBill#6', 1, '{\"select_customer_id\":\"1\",\"po_no\":\"ET-20251007-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-07\",\"due_date\":\"2025-10-07\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"qwerfg\",\"terms\":\"ertyh\",\"overall_discount\":\"1000\",\"subtotal\":\"214308.00\",\"tax\":\"214308.00\",\"discount\":\"1300.00\",\"total\":\"427616.00\",\"attachment\":null,\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"s0DPzqkbrhfqtwnUSJDO3dhMudiXIXa1IXz4I2ym\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251007-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"ref_no\\\":\\\"2354354\\\",\\\"po_date\\\":\\\"2025-10-07\\\",\\\"due_date\\\":\\\"2025-10-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"100\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"199800.00\\\"},{\\\"id\\\":\\\"9\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"200\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"3800.00\\\"},{\\\"id\\\":\\\"11\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"5454\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"10708.00\\\"}],\\\"notes\\\":\\\"qwerfg\\\",\\\"terms\\\":\\\"ertyh\\\",\\\"overall_discount\\\":\\\"1000\\\",\\\"subtotal\\\":\\\"214308.00\\\",\\\"tax\\\":\\\"214308.00\\\",\\\"discount\\\":\\\"1300.00\\\",\\\"total\\\":\\\"427616.00\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"image\\\":{},\\\"document\\\":{}}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-07 13:09:39\",\"created_at\":\"2025-10-07 13:09:39\",\"id\":6,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-07 07:39:39', '2025-10-07 07:39:39'),
(64, 'audit:updated', 6, 'App\\Models\\CurrentStock#6', 1, '{\"qty\":126,\"updated_at\":\"2025-10-07 13:09:39\"}', '127.0.0.1', '2025-10-07 07:39:39', '2025-10-07 07:39:39'),
(65, 'audit:created', 7, 'App\\Models\\PurchaseBill#7', 1, '{\"select_customer_id\":\"1\",\"po_no\":\"ET-20251007-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-07\",\"due_date\":\"2025-10-07\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"qwerfg\",\"terms\":\"ertyh\",\"overall_discount\":\"1000\",\"subtotal\":\"214308.00\",\"tax\":\"214308.00\",\"discount\":\"1300.00\",\"total\":\"427616.00\",\"attachment\":null,\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"s0DPzqkbrhfqtwnUSJDO3dhMudiXIXa1IXz4I2ym\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251007-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"ref_no\\\":\\\"2354354\\\",\\\"po_date\\\":\\\"2025-10-07\\\",\\\"due_date\\\":\\\"2025-10-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"100\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"199800.00\\\"},{\\\"id\\\":\\\"9\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"200\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"3800.00\\\"},{\\\"id\\\":\\\"11\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"5454\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"10708.00\\\"}],\\\"notes\\\":\\\"qwerfg\\\",\\\"terms\\\":\\\"ertyh\\\",\\\"overall_discount\\\":\\\"1000\\\",\\\"subtotal\\\":\\\"214308.00\\\",\\\"tax\\\":\\\"214308.00\\\",\\\"discount\\\":\\\"1300.00\\\",\\\"total\\\":\\\"427616.00\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"image\\\":{},\\\"document\\\":{}}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-07 13:10:05\",\"created_at\":\"2025-10-07 13:10:05\",\"id\":7,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-07 07:40:05', '2025-10-07 07:40:05'),
(66, 'audit:updated', 6, 'App\\Models\\CurrentStock#6', 1, '{\"qty\":226,\"updated_at\":\"2025-10-07 13:10:05\"}', '127.0.0.1', '2025-10-07 07:40:05', '2025-10-07 07:40:05'),
(67, 'audit:created', 8, 'App\\Models\\PurchaseBill#8', 1, '{\"select_customer_id\":\"1\",\"po_no\":\"ET-20251007-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-07\",\"due_date\":\"2025-10-07\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"qwerfg\",\"terms\":\"ertyh\",\"overall_discount\":\"1000\",\"subtotal\":\"214308.00\",\"tax\":\"214308.00\",\"discount\":\"1300.00\",\"total\":\"427616.00\",\"attachment\":null,\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"s0DPzqkbrhfqtwnUSJDO3dhMudiXIXa1IXz4I2ym\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251007-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"ref_no\\\":\\\"2354354\\\",\\\"po_date\\\":\\\"2025-10-07\\\",\\\"due_date\\\":\\\"2025-10-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"100\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"199800.00\\\"},{\\\"id\\\":\\\"9\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"200\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"3800.00\\\"},{\\\"id\\\":\\\"11\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"5454\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"10708.00\\\"}],\\\"notes\\\":\\\"qwerfg\\\",\\\"terms\\\":\\\"ertyh\\\",\\\"overall_discount\\\":\\\"1000\\\",\\\"subtotal\\\":\\\"214308.00\\\",\\\"tax\\\":\\\"214308.00\\\",\\\"discount\\\":\\\"1300.00\\\",\\\"total\\\":\\\"427616.00\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"image\\\":{},\\\"document\\\":{}}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-07 13:10:21\",\"created_at\":\"2025-10-07 13:10:21\",\"id\":8,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-07 07:40:21', '2025-10-07 07:40:21'),
(68, 'audit:updated', 6, 'App\\Models\\CurrentStock#6', 1, '{\"qty\":326,\"updated_at\":\"2025-10-07 13:10:21\"}', '127.0.0.1', '2025-10-07 07:40:21', '2025-10-07 07:40:21'),
(69, 'audit:created', 9, 'App\\Models\\PurchaseBill#9', 1, '{\"select_customer_id\":\"1\",\"po_no\":\"ET-20251007-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-07\",\"due_date\":\"2025-10-07\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"qwerfg\",\"terms\":\"ertyh\",\"overall_discount\":\"1000\",\"subtotal\":\"214308.00\",\"tax\":\"214308.00\",\"discount\":\"1300.00\",\"total\":\"427616.00\",\"attachment\":null,\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"s0DPzqkbrhfqtwnUSJDO3dhMudiXIXa1IXz4I2ym\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251007-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"ref_no\\\":\\\"2354354\\\",\\\"po_date\\\":\\\"2025-10-07\\\",\\\"due_date\\\":\\\"2025-10-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"100\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"199800.00\\\"},{\\\"id\\\":\\\"9\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"200\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"3800.00\\\"},{\\\"id\\\":\\\"11\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"5454\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"10708.00\\\"}],\\\"notes\\\":\\\"qwerfg\\\",\\\"terms\\\":\\\"ertyh\\\",\\\"overall_discount\\\":\\\"1000\\\",\\\"subtotal\\\":\\\"214308.00\\\",\\\"tax\\\":\\\"214308.00\\\",\\\"discount\\\":\\\"1300.00\\\",\\\"total\\\":\\\"427616.00\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"image\\\":{},\\\"document\\\":{}}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-07 13:10:50\",\"created_at\":\"2025-10-07 13:10:50\",\"id\":9,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-07 07:40:50', '2025-10-07 07:40:50'),
(70, 'audit:updated', 6, 'App\\Models\\CurrentStock#6', 1, '{\"qty\":426,\"updated_at\":\"2025-10-07 13:10:50\"}', '127.0.0.1', '2025-10-07 07:40:50', '2025-10-07 07:40:50'),
(71, 'audit:created', 10, 'App\\Models\\PurchaseBill#10', 1, '{\"select_customer_id\":\"1\",\"po_no\":\"ET-20251007-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-07\",\"due_date\":\"2025-10-07\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"qwerfg\",\"terms\":\"ertyh\",\"overall_discount\":\"1000\",\"subtotal\":\"214308.00\",\"tax\":\"214308.00\",\"discount\":\"1300.00\",\"total\":\"427616.00\",\"attachment\":null,\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"s0DPzqkbrhfqtwnUSJDO3dhMudiXIXa1IXz4I2ym\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251007-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"ref_no\\\":\\\"2354354\\\",\\\"po_date\\\":\\\"2025-10-07\\\",\\\"due_date\\\":\\\"2025-10-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"100\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"199800.00\\\"},{\\\"id\\\":\\\"9\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"200\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"3800.00\\\"},{\\\"id\\\":\\\"11\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"5454\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"10708.00\\\"}],\\\"notes\\\":\\\"qwerfg\\\",\\\"terms\\\":\\\"ertyh\\\",\\\"overall_discount\\\":\\\"1000\\\",\\\"subtotal\\\":\\\"214308.00\\\",\\\"tax\\\":\\\"214308.00\\\",\\\"discount\\\":\\\"1300.00\\\",\\\"total\\\":\\\"427616.00\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"image\\\":{},\\\"document\\\":{}}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-07 13:12:02\",\"created_at\":\"2025-10-07 13:12:02\",\"id\":10,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-07 07:42:02', '2025-10-07 07:42:02'),
(72, 'audit:updated', 6, 'App\\Models\\CurrentStock#6', 1, '{\"qty\":526,\"updated_at\":\"2025-10-07 13:12:02\"}', '127.0.0.1', '2025-10-07 07:42:02', '2025-10-07 07:42:02'),
(73, 'audit:created', 11, 'App\\Models\\PurchaseBill#11', 1, '{\"select_customer_id\":\"1\",\"po_no\":\"ET-20251007-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-07\",\"due_date\":\"2025-10-07\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"qwerfg\",\"terms\":\"ertyh\",\"overall_discount\":\"1000\",\"subtotal\":\"214308.00\",\"tax\":\"214308.00\",\"discount\":\"1300.00\",\"total\":\"427616.00\",\"attachment\":null,\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"s0DPzqkbrhfqtwnUSJDO3dhMudiXIXa1IXz4I2ym\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251007-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"ref_no\\\":\\\"2354354\\\",\\\"po_date\\\":\\\"2025-10-07\\\",\\\"due_date\\\":\\\"2025-10-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"100\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"199800.00\\\"},{\\\"id\\\":\\\"9\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"200\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"3800.00\\\"},{\\\"id\\\":\\\"11\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"5454\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"10708.00\\\"}],\\\"notes\\\":\\\"qwerfg\\\",\\\"terms\\\":\\\"ertyh\\\",\\\"overall_discount\\\":\\\"1000\\\",\\\"subtotal\\\":\\\"214308.00\\\",\\\"tax\\\":\\\"214308.00\\\",\\\"discount\\\":\\\"1300.00\\\",\\\"total\\\":\\\"427616.00\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"image\\\":{},\\\"document\\\":{}}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-07 13:12:38\",\"created_at\":\"2025-10-07 13:12:38\",\"id\":11,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-07 07:42:38', '2025-10-07 07:42:38'),
(74, 'audit:updated', 6, 'App\\Models\\CurrentStock#6', 1, '{\"qty\":626,\"updated_at\":\"2025-10-07 13:12:38\"}', '127.0.0.1', '2025-10-07 07:42:38', '2025-10-07 07:42:38'),
(75, 'audit:created', 12, 'App\\Models\\PurchaseBill#12', 1, '{\"select_customer_id\":\"1\",\"po_no\":\"ET-20251008-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-08\",\"due_date\":\"2025-10-08\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"wesdfcvwesdf\",\"terms\":\"asdxcv\",\"overall_discount\":\"100\",\"subtotal\":\"1100.00\",\"tax\":\"110.00\",\"discount\":\"200.00\",\"total\":\"1110.00\",\"attachment\":null,\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"vahA0YzEIQfAi4QCULpUbGiIGXYYwMb1aQwbUgRG\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251008-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"ref_no\\\":\\\"2354354\\\",\\\"po_date\\\":\\\"2025-10-08\\\",\\\"due_date\\\":\\\"2025-10-08\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"990.00\\\"},{\\\"id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"100\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"110.00\\\"}],\\\"notes\\\":\\\"wesdfcvwesdf\\\",\\\"terms\\\":\\\"asdxcv\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"1100.00\\\",\\\"tax\\\":\\\"110.00\\\",\\\"discount\\\":\\\"200.00\\\",\\\"total\\\":\\\"1110.00\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"image\\\":{},\\\"document\\\":{}}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-08 06:32:45\",\"created_at\":\"2025-10-08 06:32:45\",\"id\":12,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-08 01:02:45', '2025-10-08 01:02:45'),
(76, 'audit:updated', 6, 'App\\Models\\CurrentStock#6', 1, '{\"qty\":627,\"updated_at\":\"2025-10-08 06:32:45\"}', '127.0.0.1', '2025-10-08 01:02:45', '2025-10-08 01:02:45'),
(77, 'audit:created', 13, 'App\\Models\\PurchaseBill#13', 1, '{\"select_customer_id\":\"1\",\"po_no\":\"ET-20251008-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-08\",\"due_date\":\"2025-10-08\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"wesdfcvwesdf\",\"terms\":\"asdxcv\",\"overall_discount\":\"100\",\"subtotal\":\"1100.00\",\"tax\":\"110.00\",\"discount\":\"200.00\",\"total\":\"1110.00\",\"attachment\":null,\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"vahA0YzEIQfAi4QCULpUbGiIGXYYwMb1aQwbUgRG\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251008-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"ref_no\\\":\\\"2354354\\\",\\\"po_date\\\":\\\"2025-10-08\\\",\\\"due_date\\\":\\\"2025-10-08\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"990.00\\\"},{\\\"id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"100\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"110.00\\\"}],\\\"notes\\\":\\\"wesdfcvwesdf\\\",\\\"terms\\\":\\\"asdxcv\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"1100.00\\\",\\\"tax\\\":\\\"110.00\\\",\\\"discount\\\":\\\"200.00\\\",\\\"total\\\":\\\"1110.00\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"image\\\":{},\\\"document\\\":{}}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-08 06:41:06\",\"created_at\":\"2025-10-08 06:41:06\",\"id\":13,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-08 01:11:06', '2025-10-08 01:11:06'),
(78, 'audit:created', 14, 'App\\Models\\PurchaseBill#14', 1, '{\"select_customer_id\":\"1\",\"po_no\":\"ET-20251008-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-08\",\"due_date\":\"2025-10-08\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"wesdfcvwesdf\",\"terms\":\"asdxcv\",\"overall_discount\":\"100\",\"subtotal\":\"1100.00\",\"tax\":\"110.00\",\"discount\":\"200.00\",\"total\":\"1110.00\",\"attachment\":null,\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"vahA0YzEIQfAi4QCULpUbGiIGXYYwMb1aQwbUgRG\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251008-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"ref_no\\\":\\\"2354354\\\",\\\"po_date\\\":\\\"2025-10-08\\\",\\\"due_date\\\":\\\"2025-10-08\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"990.00\\\"},{\\\"id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"100\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"110.00\\\"}],\\\"notes\\\":\\\"wesdfcvwesdf\\\",\\\"terms\\\":\\\"asdxcv\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"1100.00\\\",\\\"tax\\\":\\\"110.00\\\",\\\"discount\\\":\\\"200.00\\\",\\\"total\\\":\\\"1110.00\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"image\\\":{},\\\"document\\\":{}}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-08 06:43:26\",\"created_at\":\"2025-10-08 06:43:26\",\"id\":14,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-08 01:13:26', '2025-10-08 01:13:26'),
(79, 'audit:created', 15, 'App\\Models\\PurchaseBill#15', 1, '{\"select_customer_id\":\"1\",\"po_no\":\"ET-20251008-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-08\",\"due_date\":\"2025-10-08\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"wesdfcvwesdf\",\"terms\":\"asdxcv\",\"overall_discount\":\"100\",\"subtotal\":\"1100.00\",\"tax\":\"110.00\",\"discount\":\"200.00\",\"total\":\"1110.00\",\"attachment\":null,\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"vahA0YzEIQfAi4QCULpUbGiIGXYYwMb1aQwbUgRG\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251008-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"ref_no\\\":\\\"2354354\\\",\\\"po_date\\\":\\\"2025-10-08\\\",\\\"due_date\\\":\\\"2025-10-08\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"990.00\\\"},{\\\"id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"100\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"110.00\\\"}],\\\"notes\\\":\\\"wesdfcvwesdf\\\",\\\"terms\\\":\\\"asdxcv\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"1100.00\\\",\\\"tax\\\":\\\"110.00\\\",\\\"discount\\\":\\\"200.00\\\",\\\"total\\\":\\\"1110.00\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"image\\\":{},\\\"document\\\":{}}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-08 06:48:13\",\"created_at\":\"2025-10-08 06:48:13\",\"id\":15,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-08 01:18:13', '2025-10-08 01:18:13'),
(80, 'audit:updated', 6, 'App\\Models\\CurrentStock#6', 1, '{\"qty\":628,\"updated_at\":\"2025-10-08 06:48:13\"}', '127.0.0.1', '2025-10-08 01:18:13', '2025-10-08 01:18:13'),
(81, 'audit:created', 16, 'App\\Models\\PurchaseBill#16', 1, '{\"select_customer_id\":\"1\",\"po_no\":\"ET-20251008-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-08\",\"due_date\":\"2025-10-08\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"wesdfcvwesdf\",\"terms\":\"asdxcv\",\"overall_discount\":\"100\",\"subtotal\":\"1100.00\",\"tax\":\"110.00\",\"discount\":\"200.00\",\"total\":\"1110.00\",\"attachment\":null,\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"vahA0YzEIQfAi4QCULpUbGiIGXYYwMb1aQwbUgRG\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251008-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"ref_no\\\":\\\"2354354\\\",\\\"po_date\\\":\\\"2025-10-08\\\",\\\"due_date\\\":\\\"2025-10-08\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"990.00\\\"},{\\\"id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"100\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"110.00\\\"}],\\\"notes\\\":\\\"wesdfcvwesdf\\\",\\\"terms\\\":\\\"asdxcv\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"1100.00\\\",\\\"tax\\\":\\\"110.00\\\",\\\"discount\\\":\\\"200.00\\\",\\\"total\\\":\\\"1110.00\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"image\\\":{},\\\"document\\\":{}}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-08 06:52:27\",\"created_at\":\"2025-10-08 06:52:27\",\"id\":16,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-08 01:22:27', '2025-10-08 01:22:27'),
(82, 'audit:updated', 6, 'App\\Models\\CurrentStock#6', 1, '{\"qty\":629,\"updated_at\":\"2025-10-08 06:52:27\"}', '127.0.0.1', '2025-10-08 01:22:27', '2025-10-08 01:22:27'),
(83, 'audit:created', 17, 'App\\Models\\PurchaseBill#17', 1, '{\"select_customer_id\":\"1\",\"po_no\":\"ET-20251008-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-08\",\"due_date\":\"2025-10-08\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"advsf\",\"terms\":\"sdv cx\",\"overall_discount\":\"100\",\"subtotal\":\"13178.00\",\"tax\":\"1317.80\",\"discount\":\"120.00\",\"total\":\"14395.80\",\"attachment\":null,\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"vahA0YzEIQfAi4QCULpUbGiIGXYYwMb1aQwbUgRG\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251008-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"ref_no\\\":\\\"2354354\\\",\\\"po_date\\\":\\\"2025-10-08\\\",\\\"due_date\\\":\\\"2025-10-08\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"10\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"10989.00\\\"},{\\\"id\\\":\\\"9\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"200\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"10\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"2189.00\\\"}],\\\"notes\\\":\\\"advsf\\\",\\\"terms\\\":\\\"sdv cx\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"13178.00\\\",\\\"tax\\\":\\\"1317.80\\\",\\\"discount\\\":\\\"120.00\\\",\\\"total\\\":\\\"14395.80\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"image\\\":{},\\\"document\\\":{}}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-08 07:03:39\",\"created_at\":\"2025-10-08 07:03:39\",\"id\":17,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-08 01:33:39', '2025-10-08 01:33:39'),
(84, 'audit:updated', 6, 'App\\Models\\CurrentStock#6', 1, '{\"qty\":639,\"updated_at\":\"2025-10-08 07:03:39\"}', '127.0.0.1', '2025-10-08 01:33:39', '2025-10-08 01:33:39'),
(85, 'audit:created', 18, 'App\\Models\\PurchaseBill#18', 1, '{\"purchase_invoice_number\":\"ET-20251008085231478\",\"select_customer_id\":\"1\",\"po_no\":\"ET-20251008-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-08\",\"due_date\":\"2025-10-05\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"<p>svccv xc xc dx&nbsp;<\\/p>\",\"shipping_address\":\"<p>serdvesv cdx&nbsp;<\\/p>\",\"notes\":\"qwedf\",\"terms\":\"ertfgh\",\"overall_discount\":\"0\",\"subtotal\":\"1000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"1000.00\",\"attachment\":null,\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"vahA0YzEIQfAi4QCULpUbGiIGXYYwMb1aQwbUgRG\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251008-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"purchase_bill_no\\\":\\\"2343453\\\",\\\"po_date\\\":\\\"2025-10-08\\\",\\\"due_date\\\":\\\"2025-10-05\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"<p>svccv xc xc dx&nbsp;<\\\\\\/p>\\\",\\\"shipping_address_invoice\\\":\\\"<p>serdvesv cdx&nbsp;<\\\\\\/p>\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"1000.00\\\"},{\\\"id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":null,\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"0.00\\\"}],\\\"description\\\":\\\"wqergfhqw\\\",\\\"terms\\\":\\\"ertfgh\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"1000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"1000.00\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"qwer\\\",\\\"notes\\\":\\\"qwedf\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"reference_no\":\"qwer\",\"payment_type_id\":\"1\",\"updated_at\":\"2025-10-08 08:52:31\",\"created_at\":\"2025-10-08 08:52:31\",\"id\":18,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-08 03:22:31', '2025-10-08 03:22:31'),
(86, 'audit:updated', 6, 'App\\Models\\CurrentStock#6', 1, '{\"qty\":640,\"updated_at\":\"2025-10-08 08:52:31\"}', '127.0.0.1', '2025-10-08 03:22:31', '2025-10-08 03:22:31'),
(87, 'audit:created', 19, 'App\\Models\\PurchaseBill#19', 1, '{\"purchase_invoice_number\":\"ET-20251008115807979\",\"select_customer_id\":\"1\",\"po_no\":\"ET-20251008-0001\",\"reference_no\":\"qwert\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-08\",\"due_date\":\"2025-10-08\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"<p>svccv xc xc dx&nbsp;<\\/p>\",\"shipping_address\":\"<p>serdvesv cdx&nbsp;<\\/p>\",\"notes\":\"werty\",\"terms\":\"rdfgh\",\"overall_discount\":\"100\",\"subtotal\":\"10200.00\",\"tax\":\"0.00\",\"discount\":\"100.00\",\"total\":\"10100.00\",\"attachment\":null,\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"payment_type_id\":\"1\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"NBBqa57i0FzsvJJHpciu2DO6lJpj4nXsOIr5shl5\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251008-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"purchase_bill_no\\\":\\\"2343453\\\",\\\"po_date\\\":\\\"2025-10-08\\\",\\\"due_date\\\":\\\"2025-10-08\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"<p>svccv xc xc dx&nbsp;<\\\\\\/p>\\\",\\\"shipping_address_invoice\\\":\\\"<p>serdvesv cdx&nbsp;<\\\\\\/p>\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"10000.00\\\"},{\\\"id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"200\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"200.00\\\"}],\\\"description\\\":\\\"sdfg\\\",\\\"terms\\\":\\\"rdfgh\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"10200.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"100.00\\\",\\\"total\\\":\\\"10100.00\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"qwert\\\",\\\"notes\\\":\\\"werty\\\",\\\"image\\\":{},\\\"document\\\":{}}\",\"updated_at\":\"2025-10-08 11:58:07\",\"created_at\":\"2025-10-08 11:58:07\",\"id\":19,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-08 06:28:07', '2025-10-08 06:28:07'),
(88, 'audit:updated', 6, 'App\\Models\\CurrentStock#6', 1, '{\"qty\":650,\"updated_at\":\"2025-10-08 11:58:07\"}', '127.0.0.1', '2025-10-08 06:28:07', '2025-10-08 06:28:07'),
(89, 'audit:updated', 1, 'App\\Models\\PartyDetail#1', 1, '{\"opening_balance\":1010100,\"updated_at\":\"2025-10-08 11:58:07\"}', '127.0.0.1', '2025-10-08 06:28:07', '2025-10-08 06:28:07'),
(90, 'audit:created', 20, 'App\\Models\\PurchaseBill#20', 1, '{\"purchase_invoice_number\":\"ET-20251009072112639\",\"select_customer_id\":\"1\",\"po_no\":\"ET-20251009-0001\",\"reference_no\":\"qwer\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":\"2025-10-09\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx&nbsp;\",\"shipping_address\":\"serdvesv cdx&nbsp;\",\"notes\":\"asdfcvb\",\"terms\":\"sdfghjm\",\"overall_discount\":\"1000\",\"subtotal\":\"13742.00\",\"tax\":\"1019.40\",\"discount\":\"1200.00\",\"total\":\"13761.40\",\"attachment\":null,\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"payment_type_id\":\"1\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251009-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"purchase_bill_no\\\":\\\"2343453\\\",\\\"po_date\\\":\\\"2025-10-09\\\",\\\"due_date\\\":\\\"2025-10-09\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx&nbsp;\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx&nbsp;\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"6\\\",\\\"amount\\\":\\\"10494.00\\\"},{\\\"id\\\":\\\"9\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"300\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"12\\\",\\\"amount\\\":\\\"3248.00\\\"}],\\\"description\\\":\\\"sdxfcgvbn\\\",\\\"terms\\\":\\\"sdfghjm\\\",\\\"overall_discount\\\":\\\"1000\\\",\\\"subtotal\\\":\\\"13742.00\\\",\\\"tax\\\":\\\"1019.40\\\",\\\"discount\\\":\\\"1200.00\\\",\\\"total\\\":\\\"13761.40\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"qwer\\\",\\\"notes\\\":\\\"asdfcvb\\\",\\\"image\\\":{},\\\"document\\\":{}}\",\"updated_at\":\"2025-10-09 07:21:12\",\"created_at\":\"2025-10-09 07:21:12\",\"id\":20,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-09 01:51:12', '2025-10-09 01:51:12'),
(91, 'audit:updated', 6, 'App\\Models\\CurrentStock#6', 1, '{\"qty\":660,\"updated_at\":\"2025-10-09 07:21:12\"}', '127.0.0.1', '2025-10-09 01:51:12', '2025-10-09 01:51:12'),
(92, 'audit:updated', 1, 'App\\Models\\PartyDetail#1', 1, '{\"updated_at\":\"2025-10-09 07:21:12\",\"current_balance\":13861.4,\"current_balance_type\":\"Debit\"}', '127.0.0.1', '2025-10-09 01:51:12', '2025-10-09 01:51:12');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES
(93, 'audit:created', 21, 'App\\Models\\PurchaseBill#21', 1, '{\"purchase_invoice_number\":\"ET-20251009080425838\",\"select_customer_id\":\"1\",\"po_no\":\"ET-20251009-0002\",\"reference_no\":\"uhsfjhe88\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":\"2025-10-09\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx&nbsp;\",\"shipping_address\":\"serdvesv cdx&nbsp;\",\"notes\":\"sdert\",\"terms\":\"uyd\",\"overall_discount\":\"1000\",\"subtotal\":\"32598.00\",\"tax\":\"12897.00\",\"discount\":\"1200.00\",\"total\":\"44495.00\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"payment_type_id\":\"1\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251009-0002\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"purchase_bill_no\\\":\\\"2343453\\\",\\\"po_date\\\":\\\"2025-10-09\\\",\\\"due_date\\\":\\\"2025-10-09\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx&nbsp;\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx&nbsp;\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"20\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"21890.00\\\"},{\\\"id\\\":\\\"11\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"5454\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"10708.00\\\"}],\\\"description\\\":\\\"lkjhgf\\\",\\\"terms\\\":\\\"uyd\\\",\\\"overall_discount\\\":\\\"1000\\\",\\\"subtotal\\\":\\\"32598.00\\\",\\\"tax\\\":\\\"12897.00\\\",\\\"discount\\\":\\\"1200.00\\\",\\\"total\\\":\\\"44495.00\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"notes\\\":\\\"sdert\\\",\\\"image\\\":{},\\\"document\\\":{}}\",\"updated_at\":\"2025-10-09 08:04:25\",\"created_at\":\"2025-10-09 08:04:25\",\"id\":21,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-09 02:34:25', '2025-10-09 02:34:25'),
(94, 'audit:updated', 6, 'App\\Models\\CurrentStock#6', 1, '{\"qty\":680,\"updated_at\":\"2025-10-09 08:04:32\"}', '127.0.0.1', '2025-10-09 02:34:32', '2025-10-09 02:34:32'),
(95, 'audit:updated', 8, 'App\\Models\\CurrentStock#8', 1, '{\"qty\":421,\"updated_at\":\"2025-10-09 08:04:32\"}', '127.0.0.1', '2025-10-09 02:34:32', '2025-10-09 02:34:32'),
(96, 'audit:updated', 1, 'App\\Models\\PartyDetail#1', 1, '{\"updated_at\":\"2025-10-09 08:04:32\",\"current_balance\":58356.4}', '127.0.0.1', '2025-10-09 02:34:32', '2025-10-09 02:34:32'),
(97, 'audit:created', 11, 'App\\Models\\SaleInvoice#11', 1, '{\"sale_invoice_number\":\"ET-20251009091902499\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251009-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":null,\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"sd\",\"terms\":\"wqerfgf\",\"overall_discount\":\"100\",\"subtotal\":\"3314.30\",\"tax\":\"331.43\",\"discount\":\"210.00\",\"total\":\"3545.73\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251009-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-09\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"7\\\",\\\"qty\\\":\\\"2\\\",\\\"price\\\":\\\"1500\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"3190.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"123\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"10\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"124.30\\\"}],\\\"notes\\\":\\\"sd\\\",\\\"terms\\\":\\\"wqerfgf\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"3314.30\\\",\\\"tax\\\":\\\"331.43\\\",\\\"discount\\\":\\\"210.00\\\",\\\"total\\\":\\\"3545.73\\\",\\\"attachment\\\":{}}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-09 09:19:02\",\"created_at\":\"2025-10-09 09:19:02\",\"id\":11,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-09 03:49:02', '2025-10-09 03:49:02'),
(98, 'audit:updated', 1, 'App\\Models\\PartyDetail#1', 1, '{\"updated_at\":\"2025-10-09 09:19:03\",\"current_balance\":54810.67}', '127.0.0.1', '2025-10-09 03:49:03', '2025-10-09 03:49:03'),
(99, 'audit:updated', 6, 'App\\Models\\CurrentStock#6', 1, '{\"qty\":678,\"updated_at\":\"2025-10-09 09:19:03\"}', '127.0.0.1', '2025-10-09 03:49:03', '2025-10-09 03:49:03'),
(100, 'audit:created', 12, 'App\\Models\\SaleInvoice#12', 1, '{\"sale_invoice_number\":\"ET-20251009092416679\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251009-0002\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":null,\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"sdvf\",\"terms\":\"asdf\",\"overall_discount\":\"0\",\"subtotal\":\"100.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"100.00\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251009-0002\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-09\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"100\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"100.00\\\"}],\\\"notes\\\":\\\"sdvf\\\",\\\"terms\\\":\\\"asdf\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"100.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"100.00\\\",\\\"attachment\\\":{}}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-09 09:24:16\",\"created_at\":\"2025-10-09 09:24:16\",\"id\":12,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-09 03:54:16', '2025-10-09 03:54:16'),
(101, 'audit:updated', 1, 'App\\Models\\PartyDetail#1', 1, '{\"updated_at\":\"2025-10-09 09:24:16\",\"current_balance\":54710.67}', '127.0.0.1', '2025-10-09 03:54:16', '2025-10-09 03:54:16'),
(102, 'audit:created', 13, 'App\\Models\\SaleInvoice#13', 1, '{\"sale_invoice_number\":\"ET-20251009134653248\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251009-0003\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":null,\"e_way_bill_no\":null,\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"2453.00\",\"tax\":\"89.04\",\"discount\":\"100.00\",\"total\":\"2542.04\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"Fo6CTOR4BQvP7trjCp3lQiwMTn8fAP8VLsoZ5EBT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251009-0003\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-09\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":null,\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"7\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"1500\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"6\\\",\\\"amount\\\":\\\"1484.00\\\"},{\\\"add_item_id\\\":\\\"11\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"969\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"969.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2453.00\\\",\\\"tax\\\":\\\"89.04\\\",\\\"discount\\\":\\\"100.00\\\",\\\"total\\\":\\\"2542.04\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-09 13:46:53\",\"created_at\":\"2025-10-09 13:46:53\",\"id\":13,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-10-09 08:16:53', '2025-10-09 08:16:53'),
(103, 'audit:updated', 1, 'App\\Models\\PartyDetail#1', 1, '{\"updated_at\":\"2025-10-09 13:46:53\",\"current_balance\":52168.63}', '127.0.0.1', '2025-10-09 08:16:53', '2025-10-09 08:16:53'),
(104, 'audit:updated', 6, 'App\\Models\\CurrentStock#6', 1, '{\"qty\":677,\"updated_at\":\"2025-10-09 13:46:53\"}', '127.0.0.1', '2025-10-09 08:16:53', '2025-10-09 08:16:53'),
(105, 'audit:updated', 8, 'App\\Models\\CurrentStock#8', 1, '{\"qty\":420,\"updated_at\":\"2025-10-09 13:46:53\"}', '127.0.0.1', '2025-10-09 08:16:53', '2025-10-09 08:16:53'),
(106, 'audit:updated', 1, 'App\\Models\\User#1', 1, '{\"remember_token\":\"W8CmYrHRpC4KeafKSc6nGTxGD8kyylmYkvy52qJqxb0XXs7Hj1UDg9KUirIv\"}', '127.0.0.1', '2025-10-13 00:52:29', '2025-10-13 00:52:29'),
(107, 'audit:created', 4, 'App\\Models\\User#4', 3, '{\"name\":\"MSV SERVICE\",\"email\":\"msvservice@gmail.com\",\"created_by_id\":3,\"updated_at\":\"2025-10-13 07:26:24\",\"created_at\":\"2025-10-13 07:26:24\",\"id\":4}', '127.0.0.1', '2025-10-13 01:56:24', '2025-10-13 01:56:24'),
(108, 'audit:updated', 1, 'App\\Models\\User#1', 1, '{\"remember_token\":\"RVwb7RwjDPJrRqKG8UbRaq7Zrym9QiUgZ0UpGdIbuEEI3JkJepUdaBy2f9B9\"}', '127.0.0.1', '2025-10-14 04:20:17', '2025-10-14 04:20:17'),
(109, 'audit:created', 4, 'App\\Models\\PartyDetail#4', 3, '{\"party_name\":\"Sade Holden\",\"gstin\":\"121212121212121\",\"phone_number\":\"9229779459\",\"pan_number\":\"7941111111\",\"email\":\"vijicupigu@mailinator.com\",\"place_of_supply\":\"Eos vel facilis cons\",\"type_of_supply\":\"Intra-State\",\"gst_type\":\"Registered_Business_Composition\",\"status\":\"enable\",\"state\":\"Et quia aliqua Expe\",\"city\":\"Consequat Omnis qua\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"opening_balance\":\"1\",\"opening_balance_type\":\"Debit\",\"as_of_date\":\"1987-09-15\",\"payment_terms\":\"Voluptatum mollitia\",\"credit_limit\":\"off\",\"credit_limit_amount\":null,\"bank_name\":\"Phelan Hurley\",\"account_number\":\"4092343243432\",\"ifsc_code\":\"Sit dolore ut maxim\",\"branch\":\"Accusantium numquam\",\"notes\":\"Id eos est voluptas\",\"created_by_id\":3,\"updated_at\":\"2025-10-14 09:57:33\",\"created_at\":\"2025-10-14 09:57:33\",\"id\":4}', '127.0.0.1', '2025-10-14 04:27:33', '2025-10-14 04:27:33'),
(110, 'audit:created', 2, 'App\\Models\\Unit#2', 2, '{\"base_unit\":\"none\",\"secondary_unit\":\"none\",\"created_by_id\":2,\"updated_at\":\"2025-10-14 10:15:26\",\"created_at\":\"2025-10-14 10:15:26\",\"id\":2}', '127.0.0.1', '2025-10-14 04:45:26', '2025-10-14 04:45:26'),
(111, 'audit:created', 2, 'App\\Models\\Category#2', 2, '{\"name\":\"GPS\",\"created_by_id\":2,\"updated_at\":\"2025-10-14 10:15:44\",\"created_at\":\"2025-10-14 10:15:44\",\"id\":2}', '127.0.0.1', '2025-10-14 04:45:44', '2025-10-14 04:45:44'),
(112, 'audit:created', 3, 'App\\Models\\TaxRate#3', 2, '{\"name\":\"12%\",\"parcentage\":\"12\",\"created_by_id\":2,\"updated_at\":\"2025-10-14 10:16:40\",\"created_at\":\"2025-10-14 10:16:40\",\"id\":3}', '127.0.0.1', '2025-10-14 04:46:40', '2025-10-14 04:46:40'),
(113, 'audit:created', 4, 'App\\Models\\TaxRate#4', 2, '{\"name\":\"6%\",\"parcentage\":\"6\",\"created_by_id\":2,\"updated_at\":\"2025-10-14 10:16:54\",\"created_at\":\"2025-10-14 10:16:54\",\"id\":4}', '127.0.0.1', '2025-10-14 04:46:54', '2025-10-14 04:46:54'),
(114, 'audit:created', 5, 'App\\Models\\TaxRate#5', 2, '{\"name\":\"18%\",\"parcentage\":\"18\",\"created_by_id\":2,\"updated_at\":\"2025-10-14 10:17:04\",\"created_at\":\"2025-10-14 10:17:04\",\"id\":5}', '127.0.0.1', '2025-10-14 04:47:04', '2025-10-14 04:47:04'),
(115, 'audit:created', 6, 'App\\Models\\TaxRate#6', 2, '{\"name\":\"24%\",\"parcentage\":\"24\",\"created_by_id\":2,\"updated_at\":\"2025-10-14 10:17:14\",\"created_at\":\"2025-10-14 10:17:14\",\"id\":6}', '127.0.0.1', '2025-10-14 04:47:14', '2025-10-14 04:47:14'),
(116, 'audit:updated', 1, 'App\\Models\\User#1', 1, '{\"remember_token\":\"gDYamGA3j9OtrNI0VNhY9Ns1QIBapzUyDeQHC8wmYttPzYNNb9oRh8vu1MyH\"}', '127.0.0.1', '2025-10-14 04:49:46', '2025-10-14 04:49:46'),
(117, 'audit:created', 3, 'App\\Models\\MainCostCenter#3', 2, '{\"cost_center_name\":\"West Bangel\",\"unique_code\":\"234324\",\"status\":\"active\",\"link_with_company_id\":\"1\",\"responsible_manager_id\":\"2\",\"budget_amount\":\"10000\",\"actual_amount\":\"20000\",\"start_date\":\"2024-09-07\",\"details_of_cost_center\":null,\"location\":null,\"updated_at\":\"2025-10-14 10:22:43\",\"created_at\":\"2025-10-14 10:22:43\",\"id\":3}', '127.0.0.1', '2025-10-14 04:52:43', '2025-10-14 04:52:43'),
(118, 'audit:created', 3, 'App\\Models\\Unit#3', 3, '{\"base_unit\":\"none\",\"secondary_unit\":\"none\",\"updated_at\":\"2025-10-15 07:30:53\",\"created_at\":\"2025-10-15 07:30:53\",\"id\":3}', '127.0.0.1', '2025-10-15 02:00:53', '2025-10-15 02:00:53'),
(119, 'audit:created', 3, 'App\\Models\\Category#3', 3, '{\"name\":\"Asscorise\",\"updated_at\":\"2025-10-15 07:31:23\",\"created_at\":\"2025-10-15 07:31:23\",\"id\":3}', '127.0.0.1', '2025-10-15 02:01:23', '2025-10-15 02:01:23'),
(120, 'audit:created', 4, 'App\\Models\\Category#4', 3, '{\"name\":\"Row Matrial\",\"created_by_id\":3,\"updated_at\":\"2025-10-15 07:33:40\",\"created_at\":\"2025-10-15 07:33:40\",\"id\":4}', '127.0.0.1', '2025-10-15 02:03:40', '2025-10-15 02:03:40'),
(121, 'audit:created', 4, 'App\\Models\\Unit#4', 3, '{\"base_unit\":\"Pices\",\"secondary_unit\":\"Pices\",\"created_by_id\":3,\"updated_at\":\"2025-10-15 07:37:52\",\"created_at\":\"2025-10-15 07:37:52\",\"id\":4}', '127.0.0.1', '2025-10-15 02:07:52', '2025-10-15 02:07:52'),
(122, 'audit:created', 12, 'App\\Models\\AddItem#12', 3, '{\"product_type\":\"raw_material\",\"item_type\":\"product\",\"item_name\":\"Andoride Box\",\"item_hsn\":\"4534JHJ\",\"select_unit_id\":\"4\",\"quantity\":\"18\",\"item_code\":\"ITM-4638-3856\",\"sale_price\":\"342\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"43\",\"disc_type\":\"percentage\",\"wholesale_price\":\"3443\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"12\",\"purchase_price\":\"2134\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":null,\"opening_stock\":\"18\",\"low_stock_warning\":\"10\",\"warehouse_location\":\"10\",\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"quantity\\\":\\\"18\\\"}\",\"created_by_id\":3,\"updated_at\":\"2025-10-15 07:42:58\",\"created_at\":\"2025-10-15 07:42:58\",\"id\":12}', '127.0.0.1', '2025-10-15 02:12:58', '2025-10-15 02:12:58'),
(123, 'audit:created', 9, 'App\\Models\\CurrentStock#9', 3, '{\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"quantity\\\":\\\"18\\\"}\",\"user_id\":1,\"qty\":\"18\",\"type\":\"Opening Stock\",\"created_by_id\":3,\"item_id\":12,\"product_type\":\"raw_material\",\"updated_at\":\"2025-10-15 07:42:58\",\"created_at\":\"2025-10-15 07:42:58\",\"id\":9}', '127.0.0.1', '2025-10-15 02:12:58', '2025-10-15 02:12:58'),
(124, 'audit:created', 13, 'App\\Models\\AddItem#13', 3, '{\"product_type\":\"raw_material\",\"item_type\":\"product\",\"item_name\":\"Andoride Ralle\",\"item_hsn\":\"354DGFB\",\"select_unit_id\":\"4\",\"quantity\":\"100\",\"item_code\":\"ITM-5280-8942\",\"sale_price\":\"1212\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"12\",\"disc_type\":\"percentage\",\"wholesale_price\":\"1234\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"12\",\"purchase_price\":\"122\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":null,\"opening_stock\":\"100\",\"low_stock_warning\":\"10\",\"warehouse_location\":\"kamla market\",\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"quantity\\\":\\\"100\\\"}\",\"created_by_id\":3,\"updated_at\":\"2025-10-15 08:05:03\",\"created_at\":\"2025-10-15 08:05:03\",\"id\":13}', '127.0.0.1', '2025-10-15 02:35:03', '2025-10-15 02:35:03'),
(125, 'audit:created', 10, 'App\\Models\\CurrentStock#10', 3, '{\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"quantity\\\":\\\"100\\\"}\",\"user_id\":1,\"qty\":\"100\",\"type\":\"Opening Stock\",\"created_by_id\":3,\"item_id\":13,\"product_type\":\"raw_material\",\"updated_at\":\"2025-10-15 08:05:03\",\"created_at\":\"2025-10-15 08:05:03\",\"id\":10}', '127.0.0.1', '2025-10-15 02:35:03', '2025-10-15 02:35:03'),
(126, 'audit:created', 14, 'App\\Models\\AddItem#14', 3, '{\"product_type\":\"finished_goods\",\"item_type\":\"product\",\"item_name\":\"Andoride\",\"item_hsn\":\"1242SFKHDE\",\"select_unit_id\":\"4\",\"quantity\":\"10\",\"item_code\":\"ITM-2431-3484\",\"sale_price\":\"2000\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"wholesale_price\":\"1800\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"10\",\"purchase_price\":\"1200\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":null,\"opening_stock\":\"10\",\"low_stock_warning\":\"1\",\"warehouse_location\":\"kamla market\",\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"quantity\\\":\\\"10\\\"}\",\"created_by_id\":3,\"updated_at\":\"2025-10-15 09:59:38\",\"created_at\":\"2025-10-15 09:59:38\",\"id\":14}', '127.0.0.1', '2025-10-15 04:29:38', '2025-10-15 04:29:38'),
(127, 'audit:created', 15, 'App\\Models\\AddItem#15', 3, '{\"product_type\":\"finished_goods\",\"item_type\":\"product\",\"item_name\":\"Andoride\",\"item_hsn\":\"34234DDGF\",\"select_unit_id\":\"4\",\"quantity\":\"5\",\"item_code\":\"ITM-1420-0249\",\"sale_price\":\"2000\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"wholesale_price\":\"1900\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"10\",\"purchase_price\":\"1500\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":null,\"opening_stock\":\"5\",\"low_stock_warning\":null,\"warehouse_location\":null,\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"quantity\\\":\\\"5\\\"}\",\"created_by_id\":3,\"updated_at\":\"2025-10-15 10:24:01\",\"created_at\":\"2025-10-15 10:24:01\",\"id\":15}', '127.0.0.1', '2025-10-15 04:54:01', '2025-10-15 04:54:01'),
(128, 'audit:created', 16, 'App\\Models\\AddItem#16', 3, '{\"product_type\":\"finished_goods\",\"item_type\":\"product\",\"item_name\":\"Andoride\",\"item_hsn\":\"7832HBJHJB\",\"select_unit_id\":\"4\",\"quantity\":\"10\",\"item_code\":\"ITM-3226-1583\",\"sale_price\":\"2000\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"wholesale_price\":\"1900\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"10\",\"purchase_price\":\"1500\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":null,\"opening_stock\":\"10\",\"low_stock_warning\":\"1\",\"warehouse_location\":\"kamla market\",\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"Andoride\\\",\\\"item_hsn\\\":\\\"7832HBJHJB\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"10\\\",\\\"item_code\\\":\\\"ITM-3226-1583\\\",\\\"sale_price\\\":\\\"2000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"1900\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"1500\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"10\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"select_raw_materials\\\":[\\\"12\\\",\\\"13\\\"],\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"10\\\\\\\"}\\\"}\",\"created_by_id\":3,\"updated_at\":\"2025-10-15 10:29:10\",\"created_at\":\"2025-10-15 10:29:10\",\"id\":16}', '127.0.0.1', '2025-10-15 04:59:10', '2025-10-15 04:59:10'),
(129, 'audit:created', 17, 'App\\Models\\AddItem#17', 3, '{\"product_type\":\"finished_goods\",\"item_type\":\"product\",\"item_name\":\"Andoride\",\"item_hsn\":\"H7H67\",\"select_unit_id\":\"4\",\"quantity\":\"5\",\"item_code\":\"ITM-9278-6332\",\"sale_price\":\"2000\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"wholesale_price\":\"1900\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"10\",\"purchase_price\":\"1500\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":null,\"opening_stock\":\"5\",\"low_stock_warning\":\"1\",\"warehouse_location\":\"kamla market\",\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"Andoride\\\",\\\"item_hsn\\\":\\\"H7H67\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"5\\\",\\\"item_code\\\":\\\"ITM-9278-6332\\\",\\\"sale_price\\\":\\\"2000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"1900\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"1500\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"5\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"select_raw_materials\\\":[\\\"12\\\"],\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"5\\\\\\\"}\\\"}\",\"created_by_id\":3,\"updated_at\":\"2025-10-15 10:51:07\",\"created_at\":\"2025-10-15 10:51:07\",\"id\":17}', '127.0.0.1', '2025-10-15 05:21:07', '2025-10-15 05:21:07'),
(130, 'audit:created', 11, 'App\\Models\\CurrentStock#11', 3, '{\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"Andoride\\\",\\\"item_hsn\\\":\\\"H7H67\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"5\\\",\\\"item_code\\\":\\\"ITM-9278-6332\\\",\\\"sale_price\\\":\\\"2000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"1900\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"1500\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"5\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"select_raw_materials\\\":[\\\"12\\\"],\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"5\\\\\\\"}\\\"}\",\"user_id\":1,\"qty\":\"5\",\"type\":\"Finished Goods\",\"created_by_id\":3,\"item_id\":17,\"product_type\":\"finished_goods\",\"updated_at\":\"2025-10-15 10:51:07\",\"created_at\":\"2025-10-15 10:51:07\",\"id\":11}', '127.0.0.1', '2025-10-15 05:21:07', '2025-10-15 05:21:07'),
(131, 'audit:created', 18, 'App\\Models\\AddItem#18', 3, '{\"product_type\":\"raw_material\",\"item_type\":\"product\",\"item_name\":\"Andoride Reelay\",\"item_hsn\":\"JKH12\",\"select_unit_id\":\"4\",\"quantity\":\"18\",\"item_code\":\"ITM-7329-3442\",\"sale_price\":\"100\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"wholesale_price\":\"90\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"10\",\"purchase_price\":\"40\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":null,\"opening_stock\":\"18\",\"low_stock_warning\":\"1\",\"warehouse_location\":\"kamla market\",\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Reelay\\\",\\\"item_hsn\\\":\\\"JKH12\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-7329-3442\\\",\\\"sale_price\\\":\\\"100\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"90\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"40\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"select_raw_materials\\\":[\\\"12\\\"],\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"created_by_id\":3,\"updated_at\":\"2025-10-15 11:12:11\",\"created_at\":\"2025-10-15 11:12:11\",\"id\":18}', '127.0.0.1', '2025-10-15 05:42:11', '2025-10-15 05:42:11'),
(132, 'audit:created', 19, 'App\\Models\\AddItem#19', 3, '{\"product_type\":\"raw_material\",\"item_type\":\"product\",\"item_name\":\"Andoride Reelay\",\"item_hsn\":\"JKHHJ76\",\"select_unit_id\":\"4\",\"quantity\":\"18\",\"item_code\":\"ITM-7161-4417\",\"sale_price\":\"200\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"wholesale_price\":\"180\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"10\",\"purchase_price\":\"120\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":null,\"opening_stock\":\"18\",\"low_stock_warning\":\"1\",\"warehouse_location\":\"kamla market\",\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Reelay\\\",\\\"item_hsn\\\":\\\"JKHHJ76\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-7161-4417\\\",\\\"sale_price\\\":\\\"200\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"180\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"120\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"created_by_id\":3,\"updated_at\":\"2025-10-15 11:17:33\",\"created_at\":\"2025-10-15 11:17:33\",\"id\":19}', '127.0.0.1', '2025-10-15 05:47:33', '2025-10-15 05:47:33'),
(133, 'audit:created', 12, 'App\\Models\\CurrentStock#12', 3, '{\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Reelay\\\",\\\"item_hsn\\\":\\\"JKHHJ76\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-7161-4417\\\",\\\"sale_price\\\":\\\"200\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"180\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"120\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"user_id\":1,\"qty\":\"18\",\"type\":\"Opening Stock\",\"created_by_id\":3,\"item_id\":19,\"product_type\":\"raw_material\",\"updated_at\":\"2025-10-15 11:17:33\",\"created_at\":\"2025-10-15 11:17:33\",\"id\":12}', '127.0.0.1', '2025-10-15 05:47:33', '2025-10-15 05:47:33'),
(134, 'audit:created', 13, 'App\\Models\\CurrentStock#13', 3, '{\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Reelay\\\",\\\"item_hsn\\\":\\\"JKHHJ76\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-7161-4417\\\",\\\"sale_price\\\":\\\"200\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"180\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"120\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"user_id\":1,\"qty\":\"18\",\"type\":\"Raw Material Stock\",\"created_by_id\":3,\"item_id\":19,\"product_type\":\"raw_material\",\"updated_at\":\"2025-10-15 11:17:33\",\"created_at\":\"2025-10-15 11:17:33\",\"id\":13}', '127.0.0.1', '2025-10-15 05:47:33', '2025-10-15 05:47:33'),
(135, 'audit:created', 20, 'App\\Models\\AddItem#20', 3, '{\"product_type\":\"raw_material\",\"item_type\":\"product\",\"item_name\":\"Andoride Box\",\"item_hsn\":\"dsver\",\"select_unit_id\":\"4\",\"quantity\":\"18\",\"item_code\":\"ITM-7362-9293\",\"sale_price\":\"100\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"wholesale_price\":\"80\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"10\",\"purchase_price\":\"50\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":null,\"opening_stock\":\"18\",\"low_stock_warning\":\"1\",\"warehouse_location\":\"kamla market\",\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Box\\\",\\\"item_hsn\\\":\\\"dsver\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-7362-9293\\\",\\\"sale_price\\\":\\\"100\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"80\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"50\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"created_by_id\":3,\"updated_at\":\"2025-10-15 11:36:36\",\"created_at\":\"2025-10-15 11:36:36\",\"id\":20}', '127.0.0.1', '2025-10-15 06:06:36', '2025-10-15 06:06:36'),
(136, 'audit:created', 14, 'App\\Models\\CurrentStock#14', 3, '{\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Box\\\",\\\"item_hsn\\\":\\\"dsver\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-7362-9293\\\",\\\"sale_price\\\":\\\"100\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"80\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"50\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"user_id\":1,\"qty\":\"18\",\"type\":\"Opening Stock\",\"created_by_id\":3,\"item_id\":20,\"product_type\":\"raw_material\",\"updated_at\":\"2025-10-15 11:36:36\",\"created_at\":\"2025-10-15 11:36:36\",\"id\":14}', '127.0.0.1', '2025-10-15 06:06:36', '2025-10-15 06:06:36'),
(137, 'audit:created', 21, 'App\\Models\\AddItem#21', 3, '{\"product_type\":\"raw_material\",\"item_type\":\"product\",\"item_name\":\"Andoride Reelay\",\"item_hsn\":\"AKUYG434\",\"select_unit_id\":\"4\",\"quantity\":\"18\",\"item_code\":\"ITM-8937-3458\",\"sale_price\":\"100\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"wholesale_price\":\"80\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"10\",\"purchase_price\":\"50\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":null,\"opening_stock\":\"18\",\"low_stock_warning\":\"1\",\"warehouse_location\":\"kamla market\",\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Reelay\\\",\\\"item_hsn\\\":\\\"AKUYG434\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-8937-3458\\\",\\\"sale_price\\\":\\\"100\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"80\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"50\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"created_by_id\":3,\"updated_at\":\"2025-10-15 11:37:50\",\"created_at\":\"2025-10-15 11:37:50\",\"id\":21}', '127.0.0.1', '2025-10-15 06:07:50', '2025-10-15 06:07:50'),
(138, 'audit:created', 15, 'App\\Models\\CurrentStock#15', 3, '{\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Reelay\\\",\\\"item_hsn\\\":\\\"AKUYG434\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-8937-3458\\\",\\\"sale_price\\\":\\\"100\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"80\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"50\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"user_id\":1,\"qty\":\"18\",\"type\":\"Opening Stock\",\"created_by_id\":3,\"item_id\":21,\"product_type\":\"raw_material\",\"updated_at\":\"2025-10-15 11:37:50\",\"created_at\":\"2025-10-15 11:37:50\",\"id\":15}', '127.0.0.1', '2025-10-15 06:07:50', '2025-10-15 06:07:50'),
(139, 'audit:updated', 3, 'App\\Models\\User#3', 3, '{\"remember_token\":\"7lklKvJ4DxOxvXDbdvNlcjEMdEGx4DGWMoH1VtH7XaGqgtSBnjb9r5wkvdPW\"}', '127.0.0.1', '2025-10-16 00:54:19', '2025-10-16 00:54:19'),
(140, 'audit:created', 22, 'App\\Models\\AddItem#22', 3, '{\"product_type\":\"finished_goods\",\"item_type\":\"product\",\"item_name\":\"Andoride Basic\",\"item_hsn\":\"AHUYG435\",\"select_unit_id\":\"3\",\"quantity\":\"5\",\"item_code\":\"ITM-5609-7631\",\"sale_price\":\"3000\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"wholesale_price\":\"2500\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"10\",\"purchase_price\":\"2000\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":null,\"opening_stock\":\"5\",\"low_stock_warning\":\"1\",\"warehouse_location\":\"kamla market\",\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"_token\\\":\\\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"Andoride Basic\\\",\\\"item_hsn\\\":\\\"AHUYG435\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"5\\\",\\\"item_code\\\":\\\"ITM-5609-7631\\\",\\\"sale_price\\\":\\\"3000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"2500\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"2000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"5\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"select_raw_materials\\\":[\\\"20\\\",\\\"21\\\",\\\"9\\\"],\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"5\\\\\\\"}\\\"}\",\"created_by_id\":3,\"updated_at\":\"2025-10-16 07:18:35\",\"created_at\":\"2025-10-16 07:18:35\",\"id\":22}', '127.0.0.1', '2025-10-16 01:48:36', '2025-10-16 01:48:36'),
(141, 'audit:created', 16, 'App\\Models\\CurrentStock#16', 3, '{\"json_data\":\"{\\\"_token\\\":\\\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"Andoride Basic\\\",\\\"item_hsn\\\":\\\"AHUYG435\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"5\\\",\\\"item_code\\\":\\\"ITM-5609-7631\\\",\\\"sale_price\\\":\\\"3000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"2500\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"2000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"5\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"select_raw_materials\\\":[\\\"20\\\",\\\"21\\\",\\\"9\\\"],\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"5\\\\\\\"}\\\"}\",\"user_id\":1,\"qty\":10,\"type\":\"Manufactured Stock\",\"created_by_id\":3,\"item_id\":22,\"product_type\":\"finished_goods\",\"updated_at\":\"2025-10-16 07:18:36\",\"created_at\":\"2025-10-16 07:18:36\",\"id\":16}', '127.0.0.1', '2025-10-16 01:48:36', '2025-10-16 01:48:36'),
(142, 'audit:created', 23, 'App\\Models\\AddItem#23', 3, '{\"product_type\":\"raw_material\",\"item_type\":\"raw_material\",\"item_name\":\"Andoride Display\",\"item_hsn\":\"AKUYG431\",\"select_unit_id\":\"4\",\"quantity\":\"4\",\"item_code\":\"ITM-9328-3174\",\"sale_price\":\"2000\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"wholesale_price\":\"1800\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"10\",\"purchase_price\":\"1500\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":null,\"opening_stock\":\"4\",\"low_stock_warning\":\"1\",\"warehouse_location\":\"kamla market\",\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"_token\\\":\\\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\\\",\\\"item_type\\\":\\\"raw_material\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Display\\\",\\\"item_hsn\\\":\\\"AKUYG431\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"4\\\",\\\"item_code\\\":\\\"ITM-9328-3174\\\",\\\"sale_price\\\":\\\"2000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"1800\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"1500\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"4\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"4\\\\\\\"}\\\"}\",\"created_by_id\":3,\"updated_at\":\"2025-10-16 08:12:46\",\"created_at\":\"2025-10-16 08:12:46\",\"id\":23}', '127.0.0.1', '2025-10-16 02:42:46', '2025-10-16 02:42:46'),
(143, 'audit:created', 24, 'App\\Models\\AddItem#24', 3, '{\"product_type\":\"raw_material\",\"item_type\":\"raw_material\",\"item_name\":\"Andoride Display\",\"item_hsn\":\"AKUYG431\",\"select_unit_id\":\"4\",\"quantity\":\"18\",\"item_code\":\"ITM-4524-3825\",\"sale_price\":\"3000\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"wholesale_price\":\"2500\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"10\",\"purchase_price\":\"2000\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":null,\"opening_stock\":\"18\",\"low_stock_warning\":\"1\",\"warehouse_location\":\"kamla market\",\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"_token\\\":\\\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\\\",\\\"item_type\\\":\\\"raw_material\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Display\\\",\\\"item_hsn\\\":\\\"AKUYG431\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-4524-3825\\\",\\\"sale_price\\\":\\\"3000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"2500\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"2000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"created_by_id\":3,\"updated_at\":\"2025-10-16 08:19:35\",\"created_at\":\"2025-10-16 08:19:35\",\"id\":24}', '127.0.0.1', '2025-10-16 02:49:35', '2025-10-16 02:49:35'),
(144, 'audit:created', 17, 'App\\Models\\CurrentStock#17', 3, '{\"json_data\":\"{\\\"_token\\\":\\\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\\\",\\\"item_type\\\":\\\"raw_material\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Display\\\",\\\"item_hsn\\\":\\\"AKUYG431\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-4524-3825\\\",\\\"sale_price\\\":\\\"3000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"2500\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"2000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"user_id\":1,\"qty\":\"18\",\"type\":\"Opening Stock\",\"created_by_id\":3,\"item_id\":24,\"product_type\":\"raw_material\",\"updated_at\":\"2025-10-16 08:19:35\",\"created_at\":\"2025-10-16 08:19:35\",\"id\":17}', '127.0.0.1', '2025-10-16 02:49:35', '2025-10-16 02:49:35'),
(145, 'audit:created', 5, 'App\\Models\\User#5', 3, '{\"name\":\"msv bihar\",\"email\":\"msvbihar@gmail.com\",\"created_by_id\":3,\"updated_at\":\"2025-11-01 08:41:16\",\"created_at\":\"2025-11-01 08:41:16\",\"id\":5}', '127.0.0.1', '2025-11-01 03:11:16', '2025-11-01 03:11:16'),
(146, 'audit:updated', 3, 'App\\Models\\User#3', 3, '{\"remember_token\":\"lLyNCyw1Li1ih3hBCuGkaFYw6qdmd1ONJCusyTGhpyMIAyUeJ1X58vEGz8c5\"}', '127.0.0.1', '2025-11-01 03:12:29', '2025-11-01 03:12:29'),
(147, 'audit:created', 2, 'App\\Models\\BankAccount#2', 4, '{\"account_name\":\"Jonas Dunn\",\"opening_balance\":\"4000\",\"as_of_date\":\"2001-05-18\",\"account_number\":\"8863897163\",\"ifsc_code\":\"AIRP0000001\",\"bank_name\":\"Airtel Payments Bank\",\"account_holder_name\":\"Ajay Mehta\",\"upi\":\"Quia vero beatae dol\",\"print_upi_qr\":\"0\",\"print_bank_details\":\"0\",\"created_by_id\":4,\"updated_at\":\"2025-11-01 08:43:34\",\"created_at\":\"2025-11-01 08:43:34\",\"id\":2}', '127.0.0.1', '2025-11-01 03:13:34', '2025-11-01 03:13:34');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES
(148, 'audit:updated', 3, 'App\\Models\\User#3', 3, '{\"remember_token\":\"Rhri79MPLF8D1wfGdc7VE7VyJKXw8qfxrErAfr8UcUQORXs1BQaheh6QcfBh\"}', '127.0.0.1', '2025-11-01 03:27:29', '2025-11-01 03:27:29'),
(149, 'audit:created', 3, 'App\\Models\\BankAccount#3', 4, '{\"account_name\":\"Cash Account\",\"opening_balance\":\"0.00\",\"as_of_date\":null,\"account_number\":null,\"ifsc_code\":null,\"bank_name\":null,\"account_holder_name\":null,\"created_by_id\":4,\"updated_at\":\"2025-11-01 10:14:50\",\"created_at\":\"2025-11-01 10:14:50\",\"id\":3}', '127.0.0.1', '2025-11-01 04:44:50', '2025-11-01 04:44:50'),
(150, 'audit:deleted', 3, 'App\\Models\\BankAccount#3', 4, '{\"id\":3,\"account_name\":\"Cash Account\",\"opening_balance\":\"0.00\",\"as_of_date\":null,\"account_number\":null,\"ifsc_code\":null,\"bank_name\":null,\"account_holder_name\":null,\"upi\":null,\"print_upi_qr\":0,\"print_bank_details\":0,\"created_at\":\"2025-11-01 10:14:50\",\"updated_at\":\"2025-11-01 10:15:07\",\"deleted_at\":\"2025-11-01 10:15:07\",\"created_by_id\":4}', '127.0.0.1', '2025-11-01 04:45:07', '2025-11-01 04:45:07'),
(151, 'audit:created', 1, 'App\\Models\\CashInHand#1', 4, '{\"status\":\"pending\",\"account_name\":\"Cash Account\",\"opening_balance\":\"0.00\",\"as_of_date\":null,\"account_number\":null,\"ifsc_code\":null,\"bank_name\":null,\"account_holder_name\":null,\"created_by_id\":4,\"updated_at\":\"2025-11-01 10:16:43\",\"created_at\":\"2025-11-01 10:16:43\",\"id\":1}', '127.0.0.1', '2025-11-01 04:46:43', '2025-11-01 04:46:43'),
(152, 'audit:updated', 1, 'App\\Models\\User#1', 1, '{\"remember_token\":\"QCCStYANTadyDGV8KgTDNRC352nM0O69xpwxim2d8KyrBOw0HnErVRYC4nq0\"}', '127.0.0.1', '2025-11-01 04:55:16', '2025-11-01 04:55:16'),
(153, 'audit:updated', 3, 'App\\Models\\User#3', 3, '{\"remember_token\":\"wtwMhJN1kjD2npsEfyCO98pQaFF48vS1Vn5gQlcHPkXAjMT7mlbIc2H79AOv\"}', '127.0.0.1', '2025-11-01 05:40:06', '2025-11-01 05:40:06'),
(154, 'audit:created', 5, 'App\\Models\\Unit#5', 5, '{\"base_unit\":\"none\",\"secondary_unit\":\"none\",\"created_by_id\":5,\"updated_at\":\"2025-11-03 06:43:08\",\"created_at\":\"2025-11-03 06:43:08\",\"id\":5}', '127.0.0.1', '2025-11-03 01:13:08', '2025-11-03 01:13:08'),
(155, 'audit:created', 5, 'App\\Models\\Category#5', 5, '{\"name\":\"Raw Matrial Of Andoride\",\"created_by_id\":5,\"updated_at\":\"2025-11-03 06:43:32\",\"created_at\":\"2025-11-03 06:43:32\",\"id\":5}', '127.0.0.1', '2025-11-03 01:13:32', '2025-11-03 01:13:32'),
(156, 'audit:created', 7, 'App\\Models\\TaxRate#7', 5, '{\"name\":\"Gst 18%\",\"parcentage\":\"18\",\"created_by_id\":5,\"updated_at\":\"2025-11-03 06:43:58\",\"created_at\":\"2025-11-03 06:43:58\",\"id\":7}', '127.0.0.1', '2025-11-03 01:13:58', '2025-11-03 01:13:58'),
(157, 'audit:created', 25, 'App\\Models\\AddItem#25', 5, '{\"product_type\":\"raw_material\",\"item_type\":\"raw_material\",\"item_name\":\"Andoride Display\",\"item_hsn\":\"AKUYG434\",\"select_unit_id\":\"5\",\"quantity\":\"18\",\"item_code\":\"ITM-1597-1704\",\"sale_price\":\"120\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":null,\"disc_type\":\"percentage\",\"wholesale_price\":null,\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":null,\"purchase_price\":\"100\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":null,\"opening_stock\":\"18\",\"low_stock_warning\":null,\"warehouse_location\":null,\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"_token\\\":\\\"ezLUyx8LO611FC0pdeNfinv7Zrdyxq5xovFM8jsI\\\",\\\"item_type\\\":\\\"raw_material\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Display\\\",\\\"item_hsn\\\":\\\"AKUYG434\\\",\\\"select_unit_id\\\":\\\"5\\\",\\\"select_category\\\":[\\\"5\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-1597-1704\\\",\\\"sale_price\\\":\\\"120\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null,\\\"purchase_price\\\":\\\"100\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null,\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\",\\\\\\\"opening_stock\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"created_by_id\":5,\"updated_at\":\"2025-11-03 06:47:08\",\"created_at\":\"2025-11-03 06:47:08\",\"id\":25}', '127.0.0.1', '2025-11-03 01:17:08', '2025-11-03 01:17:08'),
(158, 'audit:created', 18, 'App\\Models\\CurrentStock#18', 5, '{\"json_data\":\"{\\\"_token\\\":\\\"ezLUyx8LO611FC0pdeNfinv7Zrdyxq5xovFM8jsI\\\",\\\"item_type\\\":\\\"raw_material\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Display\\\",\\\"item_hsn\\\":\\\"AKUYG434\\\",\\\"select_unit_id\\\":\\\"5\\\",\\\"select_category\\\":[\\\"5\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-1597-1704\\\",\\\"sale_price\\\":\\\"120\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null,\\\"purchase_price\\\":\\\"100\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null,\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\",\\\\\\\"opening_stock\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"user_id\":1,\"qty\":\"18\",\"type\":\"Opening Stock\",\"created_by_id\":5,\"item_id\":25,\"product_type\":\"raw_material\",\"updated_at\":\"2025-11-03 06:47:08\",\"created_at\":\"2025-11-03 06:47:08\",\"id\":18}', '127.0.0.1', '2025-11-03 01:17:08', '2025-11-03 01:17:08'),
(159, 'audit:created', 26, 'App\\Models\\AddItem#26', 5, '{\"product_type\":\"finished_goods\",\"item_type\":\"product\",\"item_name\":\"Andoride\",\"item_hsn\":\"NEGHI89U8U9\",\"select_unit_id\":\"5\",\"quantity\":null,\"item_code\":\"ITM-3728-1211\",\"sale_price\":\"3000\",\"select_type\":\"With Tax\",\"disc_on_sale_price\":null,\"disc_type\":\"percentage\",\"wholesale_price\":null,\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":null,\"purchase_price\":\"2000\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":\"7\",\"opening_stock\":null,\"low_stock_warning\":null,\"warehouse_location\":null,\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"_token\\\":\\\"ezLUyx8LO611FC0pdeNfinv7Zrdyxq5xovFM8jsI\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"Andoride\\\",\\\"item_hsn\\\":\\\"NEGHI89U8U9\\\",\\\"select_unit_id\\\":\\\"5\\\",\\\"select_category\\\":[\\\"5\\\"],\\\"quantity\\\":null,\\\"item_code\\\":\\\"ITM-3728-1211\\\",\\\"sale_price\\\":\\\"3000\\\",\\\"select_type\\\":\\\"With Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"7\\\",\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null,\\\"purchase_price\\\":\\\"2000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":null,\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null,\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"select_raw_materials\\\":[\\\"25\\\"],\\\"raw_qty\\\":{\\\"25\\\":\\\"2\\\"},\\\"raw_sale_price\\\":{\\\"25\\\":\\\"120\\\"},\\\"raw_purchase_price\\\":{\\\"25\\\":\\\"100\\\"},\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":null,\\\\\\\"opening_stock\\\\\\\":null,\\\\\\\"composition_totals\\\\\\\":{\\\\\\\"total_sale_value\\\\\\\":240,\\\\\\\"total_purchase_value\\\\\\\":200}}\\\"}\",\"created_by_id\":5,\"updated_at\":\"2025-11-03 07:13:11\",\"created_at\":\"2025-11-03 07:13:11\",\"id\":26}', '127.0.0.1', '2025-11-03 01:43:11', '2025-11-03 01:43:11'),
(160, 'audit:created', 19, 'App\\Models\\CurrentStock#19', 5, '{\"json_data\":\"{\\\"_token\\\":\\\"ezLUyx8LO611FC0pdeNfinv7Zrdyxq5xovFM8jsI\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"Andoride\\\",\\\"item_hsn\\\":\\\"NEGHI89U8U9\\\",\\\"select_unit_id\\\":\\\"5\\\",\\\"select_category\\\":[\\\"5\\\"],\\\"quantity\\\":null,\\\"item_code\\\":\\\"ITM-3728-1211\\\",\\\"sale_price\\\":\\\"3000\\\",\\\"select_type\\\":\\\"With Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"7\\\",\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null,\\\"purchase_price\\\":\\\"2000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":null,\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null,\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"select_raw_materials\\\":[\\\"25\\\"],\\\"raw_qty\\\":{\\\"25\\\":\\\"2\\\"},\\\"raw_sale_price\\\":{\\\"25\\\":\\\"120\\\"},\\\"raw_purchase_price\\\":{\\\"25\\\":\\\"100\\\"},\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":null,\\\\\\\"opening_stock\\\\\\\":null,\\\\\\\"composition_totals\\\\\\\":{\\\\\\\"total_sale_value\\\\\\\":240,\\\\\\\"total_purchase_value\\\\\\\":200}}\\\"}\",\"user_id\":1,\"qty\":2,\"type\":\"Manufactured Stock\",\"created_by_id\":5,\"item_id\":26,\"product_type\":\"finished_goods\",\"updated_at\":\"2025-11-03 07:13:11\",\"created_at\":\"2025-11-03 07:13:11\",\"id\":19}', '127.0.0.1', '2025-11-03 01:43:11', '2025-11-03 01:43:11'),
(161, 'audit:updated', 26, 'App\\Models\\AddItem#26', 5, '{\"json_data\":\"\\\"{\\\\\\\"_token\\\\\\\":\\\\\\\"ezLUyx8LO611FC0pdeNfinv7Zrdyxq5xovFM8jsI\\\\\\\",\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"item_name\\\\\\\":\\\\\\\"Andoride\\\\\\\",\\\\\\\"item_hsn\\\\\\\":\\\\\\\"NEGHI89U8U9\\\\\\\",\\\\\\\"select_unit_id\\\\\\\":\\\\\\\"5\\\\\\\",\\\\\\\"select_category\\\\\\\":[\\\\\\\"5\\\\\\\"],\\\\\\\"quantity\\\\\\\":null,\\\\\\\"item_code\\\\\\\":\\\\\\\"ITM-3728-1211\\\\\\\",\\\\\\\"sale_price\\\\\\\":\\\\\\\"3000\\\\\\\",\\\\\\\"select_type\\\\\\\":\\\\\\\"With Tax\\\\\\\",\\\\\\\"disc_on_sale_price\\\\\\\":null,\\\\\\\"disc_type\\\\\\\":\\\\\\\"percentage\\\\\\\",\\\\\\\"select_tax_id\\\\\\\":\\\\\\\"7\\\\\\\",\\\\\\\"wholesale_price\\\\\\\":null,\\\\\\\"select_type_wholesale\\\\\\\":\\\\\\\"Without Tax\\\\\\\",\\\\\\\"minimum_wholesale_qty\\\\\\\":null,\\\\\\\"purchase_price\\\\\\\":\\\\\\\"2000\\\\\\\",\\\\\\\"select_purchase_type\\\\\\\":\\\\\\\"Without Tax\\\\\\\",\\\\\\\"opening_stock\\\\\\\":null,\\\\\\\"low_stock_warning\\\\\\\":null,\\\\\\\"warehouse_location\\\\\\\":null,\\\\\\\"online_store_title\\\\\\\":null,\\\\\\\"online_store_description\\\\\\\":null,\\\\\\\"select_raw_materials\\\\\\\":[\\\\\\\"25\\\\\\\"],\\\\\\\"raw_qty\\\\\\\":{\\\\\\\"25\\\\\\\":\\\\\\\"2\\\\\\\"},\\\\\\\"raw_sale_price\\\\\\\":{\\\\\\\"25\\\\\\\":\\\\\\\"120\\\\\\\"},\\\\\\\"raw_purchase_price\\\\\\\":{\\\\\\\"25\\\\\\\":\\\\\\\"100\\\\\\\"},\\\\\\\"json_data\\\\\\\":\\\\\\\"{\\\\\\\\\\\\\\\"item_type\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"product\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"product_type\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"finished_goods\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"quantity\\\\\\\\\\\\\\\":null,\\\\\\\\\\\\\\\"opening_stock\\\\\\\\\\\\\\\":null,\\\\\\\\\\\\\\\"composition_totals\\\\\\\\\\\\\\\":{\\\\\\\\\\\\\\\"total_sale_value\\\\\\\\\\\\\\\":240,\\\\\\\\\\\\\\\"total_purchase_value\\\\\\\\\\\\\\\":200}}\\\\\\\",\\\\\\\"composition_summary\\\\\\\":{\\\\\\\"finished_goods_composition\\\\\\\":{\\\\\\\"total_qty_used\\\\\\\":2,\\\\\\\"total_sale_value\\\\\\\":240,\\\\\\\"total_purchase_value\\\\\\\":200}}}\\\"\"}', '127.0.0.1', '2025-11-03 01:43:11', '2025-11-03 01:43:11'),
(162, 'audit:created', 4, 'App\\Models\\MainCostCenter#4', 3, '{\"cost_center_name\":\"Constance Briggs\",\"unique_code\":\"Ea est in aut eos t\",\"status\":\"active\",\"link_with_company_id\":\"2\",\"responsible_manager_id\":\"3\",\"budget_amount\":\"93\",\"actual_amount\":\"87\",\"start_date\":\"2024-09-07\",\"details_of_cost_center\":null,\"location\":null,\"created_by_id\":3,\"updated_at\":\"2025-11-03 08:40:19\",\"created_at\":\"2025-11-03 08:40:19\",\"id\":4}', '127.0.0.1', '2025-11-03 03:10:19', '2025-11-03 03:10:19'),
(163, 'audit:created', 2, 'App\\Models\\SubCostCenter#2', 3, '{\"main_cost_center_id\":\"3\",\"sub_cost_center_name\":\"Irma Barr\",\"unique_code\":\"234324\",\"details_of_sub_cost_center\":\"Voluptate et ab mini\",\"responsible_manager\":\"Maxime qui doloremqu\",\"budget_allocated\":\"Reprehenderit dolor\",\"actual_expense\":\"Possimus sint lauda\",\"start_date\":\"2018-09-15\",\"status\":\"active\",\"created_by_id\":3,\"updated_at\":\"2025-11-03 08:43:45\",\"created_at\":\"2025-11-03 08:43:45\",\"id\":2}', '127.0.0.1', '2025-11-03 03:13:45', '2025-11-03 03:13:45'),
(164, 'audit:updated', 2, 'App\\Models\\SubCostCenter#2', 3, '{\"updated_at\":\"2025-11-03 08:44:34\",\"main_cost_center_id\":\"4\"}', '127.0.0.1', '2025-11-03 03:14:34', '2025-11-03 03:14:34'),
(165, 'audit:updated', 3, 'App\\Models\\User#3', 3, '{\"remember_token\":\"EmY7DNS5xcIgaVKCt74H6FXjkMq08lhLTXP8gDGPj09EUi252I28YbFxDbcS\"}', '127.0.0.1', '2025-11-03 03:15:12', '2025-11-03 03:15:12'),
(166, 'audit:created', 14, 'App\\Models\\SaleInvoice#14', 3, '{\"sale_invoice_number\":\"ET-20251103104543519\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251103-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-11-03\",\"due_date\":\"2025-11-03 00:00:00\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"tnmgjhkj\",\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"2300.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"2300.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"9SlzqBE8v1fmGNgB5xkNdizYUkTJ0Isd7IRCc8NH\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"PO-20251103-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-03\\\",\\\"due_date\\\":\\\"2025-11-03\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"tnmgjhkj\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"2000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"2000.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"300\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"300.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2300.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"2300.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"updated_at\":\"2025-11-03 10:45:43\",\"created_at\":\"2025-11-03 10:45:43\",\"id\":14,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-11-03 05:15:43', '2025-11-03 05:15:43'),
(167, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"updated_at\":\"2025-11-03 10:45:43\",\"current_balance\":2299,\"current_balance_type\":\"Credit\"}', '127.0.0.1', '2025-11-03 05:15:43', '2025-11-03 05:15:43'),
(168, 'audit:updated', 14, 'App\\Models\\CurrentStock#14', 3, '{\"qty\":8,\"updated_at\":\"2025-11-03 10:45:43\"}', '127.0.0.1', '2025-11-03 05:15:43', '2025-11-03 05:15:43'),
(169, 'audit:updated', 15, 'App\\Models\\CurrentStock#15', 3, '{\"qty\":8,\"updated_at\":\"2025-11-03 10:45:43\"}', '127.0.0.1', '2025-11-03 05:15:43', '2025-11-03 05:15:43'),
(170, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":9,\"updated_at\":\"2025-11-03 10:45:43\"}', '127.0.0.1', '2025-11-03 05:15:43', '2025-11-03 05:15:43'),
(171, 'audit:updated', 3, 'App\\Models\\User#3', 3, '{\"remember_token\":\"4k7l8tTBgpnECPFCp91oMrEuM0CdWEKZ1naQ0A37Of357ZYzC1bxJtSZu5Lv\"}', '127.0.0.1', '2025-11-03 13:28:17', '2025-11-03 13:28:17'),
(172, 'audit:updated', 3, 'App\\Models\\User#3', 3, '{\"remember_token\":\"hwwqMXaLM4HjRLHFB0D7LCLy4Qp1nrqJttA04vtzNVN11g6i7mQXOX0KySAK\"}', '127.0.0.1', '2025-11-03 13:29:38', '2025-11-03 13:29:38'),
(173, 'audit:created', 6, 'App\\Models\\Unit#6', 4, '{\"base_unit\":\"none\",\"secondary_unit\":\"none\",\"created_by_id\":4,\"updated_at\":\"2025-11-04 06:11:18\",\"created_at\":\"2025-11-04 06:11:18\",\"id\":6}', '127.0.0.1', '2025-11-04 00:41:18', '2025-11-04 00:41:18'),
(174, 'audit:created', 6, 'App\\Models\\Category#6', 4, '{\"name\":\"Accesories\",\"created_by_id\":4,\"updated_at\":\"2025-11-04 06:24:16\",\"created_at\":\"2025-11-04 06:24:16\",\"id\":6}', '127.0.0.1', '2025-11-04 00:54:16', '2025-11-04 00:54:16'),
(175, 'audit:created', 8, 'App\\Models\\TaxRate#8', 4, '{\"name\":\"GST 18 %\",\"parcentage\":\"18\",\"created_by_id\":4,\"updated_at\":\"2025-11-04 06:24:42\",\"created_at\":\"2025-11-04 06:24:42\",\"id\":8}', '127.0.0.1', '2025-11-04 00:54:42', '2025-11-04 00:54:42'),
(176, 'audit:created', 27, 'App\\Models\\AddItem#27', 4, '{\"product_type\":\"raw_material\",\"item_type\":\"raw_material\",\"item_name\":\"Andoride Display\",\"item_hsn\":\"AKUYG435\",\"select_unit_id\":\"6\",\"quantity\":\"10\",\"item_code\":\"ITM-6659-7432\",\"sale_price\":\"200\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":null,\"disc_type\":\"percentage\",\"wholesale_price\":null,\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":null,\"purchase_price\":\"100\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":null,\"opening_stock\":\"10\",\"low_stock_warning\":null,\"warehouse_location\":null,\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"_token\\\":\\\"THnUvAsOcOO0w7VNuMPxoYz6EC9WmWxDmyRoSuMT\\\",\\\"item_type\\\":\\\"raw_material\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Display\\\",\\\"item_hsn\\\":\\\"AKUYG435\\\",\\\"select_unit_id\\\":\\\"6\\\",\\\"select_category\\\":[\\\"6\\\"],\\\"quantity\\\":\\\"10\\\",\\\"item_code\\\":\\\"ITM-6659-7432\\\",\\\"sale_price\\\":\\\"200\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null,\\\"purchase_price\\\":\\\"100\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"10\\\",\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null,\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"10\\\\\\\",\\\\\\\"opening_stock\\\\\\\":\\\\\\\"10\\\\\\\",\\\\\\\"composition_totals\\\\\\\":{\\\\\\\"total_sale_value\\\\\\\":0,\\\\\\\"total_purchase_value\\\\\\\":0}}\\\"}\",\"created_by_id\":4,\"updated_at\":\"2025-11-04 06:25:46\",\"created_at\":\"2025-11-04 06:25:46\",\"id\":27}', '127.0.0.1', '2025-11-04 00:55:46', '2025-11-04 00:55:46'),
(177, 'audit:created', 20, 'App\\Models\\CurrentStock#20', 4, '{\"json_data\":\"{\\\"_token\\\":\\\"THnUvAsOcOO0w7VNuMPxoYz6EC9WmWxDmyRoSuMT\\\",\\\"item_type\\\":\\\"raw_material\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Display\\\",\\\"item_hsn\\\":\\\"AKUYG435\\\",\\\"select_unit_id\\\":\\\"6\\\",\\\"select_category\\\":[\\\"6\\\"],\\\"quantity\\\":\\\"10\\\",\\\"item_code\\\":\\\"ITM-6659-7432\\\",\\\"sale_price\\\":\\\"200\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null,\\\"purchase_price\\\":\\\"100\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"10\\\",\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null,\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"10\\\\\\\",\\\\\\\"opening_stock\\\\\\\":\\\\\\\"10\\\\\\\",\\\\\\\"composition_totals\\\\\\\":{\\\\\\\"total_sale_value\\\\\\\":0,\\\\\\\"total_purchase_value\\\\\\\":0}}\\\"}\",\"user_id\":1,\"qty\":\"10\",\"type\":\"Opening Stock\",\"created_by_id\":4,\"item_id\":27,\"product_type\":\"raw_material\",\"updated_at\":\"2025-11-04 06:25:47\",\"created_at\":\"2025-11-04 06:25:47\",\"id\":20}', '127.0.0.1', '2025-11-04 00:55:47', '2025-11-04 00:55:47'),
(178, 'audit:created', 28, 'App\\Models\\AddItem#28', 4, '{\"product_type\":\"raw_material\",\"item_type\":\"raw_material\",\"item_name\":\"Andoride Box\",\"item_hsn\":\"AKUYG435\",\"select_unit_id\":\"6\",\"quantity\":null,\"item_code\":\"ITM-9253-4715\",\"sale_price\":\"300\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":null,\"disc_type\":\"percentage\",\"wholesale_price\":null,\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":null,\"purchase_price\":\"200\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":null,\"opening_stock\":null,\"low_stock_warning\":null,\"warehouse_location\":null,\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"_token\\\":\\\"THnUvAsOcOO0w7VNuMPxoYz6EC9WmWxDmyRoSuMT\\\",\\\"item_type\\\":\\\"raw_material\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Box\\\",\\\"item_hsn\\\":\\\"AKUYG435\\\",\\\"select_unit_id\\\":\\\"6\\\",\\\"select_category\\\":[\\\"6\\\"],\\\"quantity\\\":null,\\\"item_code\\\":\\\"ITM-9253-4715\\\",\\\"sale_price\\\":\\\"300\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null,\\\"purchase_price\\\":\\\"200\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":null,\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null,\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"raw_qty\\\":{\\\"27\\\":\\\"0\\\"},\\\"raw_sale_price\\\":{\\\"27\\\":\\\"200\\\"},\\\"raw_purchase_price\\\":{\\\"27\\\":\\\"100\\\"},\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":null,\\\\\\\"opening_stock\\\\\\\":null,\\\\\\\"composition_totals\\\\\\\":{\\\\\\\"total_sale_value\\\\\\\":0,\\\\\\\"total_purchase_value\\\\\\\":0}}\\\"}\",\"created_by_id\":4,\"updated_at\":\"2025-11-04 06:26:42\",\"created_at\":\"2025-11-04 06:26:42\",\"id\":28}', '127.0.0.1', '2025-11-04 00:56:42', '2025-11-04 00:56:42'),
(179, 'audit:created', 5, 'App\\Models\\PartyDetail#5', 4, '{\"party_name\":\"Brenna Mcdonald\",\"gstin\":\"Molestiae in commodo\",\"phone_number\":\"8863897161\",\"pan_number\":\"163\",\"email\":\"ajayfilliptect@gmail.com\",\"place_of_supply\":\"Quia ut doloremque a\",\"type_of_supply\":\"Inter-State\",\"gst_type\":\"Registered_Business_Composition\",\"status\":\"enable\",\"pin_code\":\"800001\",\"state\":\"Bihar\",\"city\":\"Patna\",\"billing_address\":\"B.C. Road, Patna, Bihar\",\"shipping_address\":\"B.C. Road, Patna, Bihar\",\"opening_balance\":\"0.00\",\"opening_balance_type\":\"Debit\",\"as_of_date\":\"2025-11-04\",\"payment_terms\":\"ijhjji\",\"credit_limit\":\"off\",\"credit_limit_amount\":null,\"ifsc_code\":\"AIRP0000001\",\"bank_name\":\"Airtel Payments Bank\",\"branch\":\"AIRTEL PAYMENTS BRANCH\",\"account_number\":\"13243546466\",\"notes\":null,\"created_by_id\":4,\"updated_at\":\"2025-11-04 06:43:17\",\"created_at\":\"2025-11-04 06:43:17\",\"id\":5}', '127.0.0.1', '2025-11-04 01:13:17', '2025-11-04 01:13:17'),
(180, 'audit:updated', 3, 'App\\Models\\User#3', 3, '{\"remember_token\":\"2JwCtGHgOH88ZDfIyD3N9wUTOE2ExgSWb8oiM4WtKnvuvU63gXE0r3zHntHM\"}', '127.0.0.1', '2025-11-04 02:20:44', '2025-11-04 02:20:44'),
(181, 'audit:deleted', 5, 'App\\Models\\PartyDetail#5', 4, '{\"id\":5,\"party_name\":\"Brenna Mcdonald\",\"gstin\":\"Molestiae in commodo\",\"phone_number\":\"8863897161\",\"pan_number\":\"163\",\"place_of_supply\":\"Quia ut doloremque a\",\"type_of_supply\":\"Inter-State\",\"gst_type\":\"Registered_Business_Composition\",\"pin_code\":\"800001\",\"state\":\"Bihar\",\"city\":\"Patna\",\"billing_address\":\"B.C. Road, Patna, Bihar\",\"shipping_address\":\"B.C. Road, Patna, Bihar\",\"email\":\"ajayfilliptect@gmail.com\",\"opening_balance\":\"0.00\",\"as_of_date\":\"2025-11-04\",\"opening_balance_type\":\"Debit\",\"credit_limit\":\"off\",\"credit_limit_amount\":null,\"payment_terms\":\"ijhjji\",\"ifsc_code\":\"AIRP0000001\",\"account_number\":\"13243546466\",\"bank_name\":\"Airtel Payments Bank\",\"branch\":\"AIRTEL PAYMENTS BRANCH\",\"notes\":null,\"status\":\"enable\",\"created_at\":\"2025-11-04 06:43:17\",\"updated_at\":\"2025-11-04 08:09:13\",\"deleted_at\":\"2025-11-04 08:09:13\",\"created_by_id\":4,\"current_balance\":null,\"current_balance_type\":null}', '127.0.0.1', '2025-11-04 02:39:13', '2025-11-04 02:39:13'),
(182, 'audit:deleted', 2, 'App\\Models\\BankAccount#2', 4, '{\"id\":2,\"account_name\":\"Jonas Dunn\",\"opening_balance\":\"4000\",\"as_of_date\":\"2001-05-18\",\"account_number\":\"8863897163\",\"ifsc_code\":\"AIRP0000001\",\"bank_name\":\"Airtel Payments Bank\",\"account_holder_name\":\"Ajay Mehta\",\"upi\":\"Quia vero beatae dol\",\"print_upi_qr\":0,\"print_bank_details\":0,\"created_at\":\"2025-11-01 08:43:34\",\"updated_at\":\"2025-11-04 08:09:33\",\"deleted_at\":\"2025-11-04 08:09:33\",\"created_by_id\":4,\"opening_balance_type\":null}', '127.0.0.1', '2025-11-04 02:39:33', '2025-11-04 02:39:33'),
(183, 'audit:deleted', 6, 'App\\Models\\Unit#6', 4, '{\"id\":6,\"base_unit\":\"none\",\"secondary_unit\":\"none\",\"created_at\":\"2025-11-04 06:11:18\",\"updated_at\":\"2025-11-04 08:09:49\",\"deleted_at\":\"2025-11-04 08:09:49\",\"created_by_id\":4}', '127.0.0.1', '2025-11-04 02:39:49', '2025-11-04 02:39:49'),
(184, 'audit:deleted', 6, 'App\\Models\\Category#6', 4, '{\"id\":6,\"name\":\"Accesories\",\"created_at\":\"2025-11-04 06:24:16\",\"updated_at\":\"2025-11-04 08:09:54\",\"deleted_at\":\"2025-11-04 08:09:54\",\"created_by_id\":4}', '127.0.0.1', '2025-11-04 02:39:54', '2025-11-04 02:39:54'),
(185, 'audit:deleted', 8, 'App\\Models\\TaxRate#8', 4, '{\"id\":8,\"name\":\"GST 18 %\",\"parcentage\":\"18\",\"created_at\":\"2025-11-04 06:24:42\",\"updated_at\":\"2025-11-04 08:10:00\",\"deleted_at\":\"2025-11-04 08:10:00\",\"created_by_id\":4}', '127.0.0.1', '2025-11-04 02:40:00', '2025-11-04 02:40:00'),
(186, 'audit:updated', 3, 'App\\Models\\User#3', 3, '{\"remember_token\":\"bEMobLpSlE2Fui9TCwfn0VGuI19RdJdaYSmjUq05lUT7sCNnl5T1AecvPp8L\"}', '127.0.0.1', '2025-11-04 02:45:22', '2025-11-04 02:45:22'),
(187, 'audit:updated', 3, 'App\\Models\\User#3', 3, '{\"remember_token\":\"wPpv36XZYxQPngM00KDHaEZg0VCzEM9d0UB5OAnhWPTtOlJPwhttfxm3m1M8\"}', '127.0.0.1', '2025-11-04 02:46:32', '2025-11-04 02:46:32'),
(188, 'audit:created', 4, 'App\\Models\\BankAccount#4', 3, '{\"account_name\":\"Airtel Bank\",\"opening_balance\":\"12\",\"as_of_date\":\"2025-11-04\",\"account_number\":\"12212342343434\",\"ifsc_code\":\"punb0089600\",\"bank_name\":\"Punjab National Bank\",\"account_holder_name\":\"ak\",\"upi\":null,\"print_upi_qr\":\"1\",\"print_bank_details\":\"1\",\"updated_at\":\"2025-11-04 09:25:53\",\"created_at\":\"2025-11-04 09:25:53\",\"id\":4}', '127.0.0.1', '2025-11-04 03:55:53', '2025-11-04 03:55:53'),
(189, 'audit:created', 5, 'App\\Models\\BankAccount#5', 4, '{\"account_name\":\"PNB\",\"opening_balance\":\"2342\",\"as_of_date\":\"2025-11-04\",\"account_number\":\"13243546466\",\"ifsc_code\":\"AIRP0000001\",\"bank_name\":\"Airtel Payments Bank\",\"account_holder_name\":\"Ajay Mehta\",\"upi\":null,\"print_upi_qr\":\"1\",\"print_bank_details\":\"1\",\"created_by_id\":4,\"updated_at\":\"2025-11-04 09:29:01\",\"created_at\":\"2025-11-04 09:29:01\",\"id\":5}', '127.0.0.1', '2025-11-04 03:59:01', '2025-11-04 03:59:01'),
(190, 'audit:created', 15, 'App\\Models\\SaleInvoice#15', 3, '{\"sale_invoice_number\":\"ET-20251104113608642\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251104-0001\",\"docket_no\":\"45654\",\"po_date\":\"2025-11-04\",\"due_date\":\"2025-11-04 00:00:00\",\"e_way_bill_no\":\"4354\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":null,\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"2500.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"2500.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"6ASVoJ3pV8P0JUq8D76lg5Cd0FLKdZhpICTmJvim\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"PO-20251104-0001\\\",\\\"docket_no\\\":\\\"45654\\\",\\\"po_date\\\":\\\"2025-11-04\\\",\\\"due_date\\\":\\\"2025-11-04\\\",\\\"e_way_bill_no\\\":\\\"4354\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":null,\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"2500.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"2500.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2500.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"2500.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"updated_at\":\"2025-11-04 11:36:08\",\"created_at\":\"2025-11-04 11:36:08\",\"id\":15,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-11-04 06:06:08', '2025-11-04 06:06:08'),
(191, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"updated_at\":\"2025-11-04 11:36:08\",\"current_balance\":4799}', '127.0.0.1', '2025-11-04 06:06:08', '2025-11-04 06:06:08'),
(192, 'audit:updated', 14, 'App\\Models\\CurrentStock#14', 3, '{\"qty\":3,\"updated_at\":\"2025-11-04 11:36:08\"}', '127.0.0.1', '2025-11-04 06:06:08', '2025-11-04 06:06:08'),
(193, 'audit:updated', 15, 'App\\Models\\CurrentStock#15', 3, '{\"qty\":3,\"updated_at\":\"2025-11-04 11:36:08\"}', '127.0.0.1', '2025-11-04 06:06:08', '2025-11-04 06:06:08'),
(194, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":8,\"updated_at\":\"2025-11-04 11:36:08\"}', '127.0.0.1', '2025-11-04 06:06:08', '2025-11-04 06:06:08'),
(195, 'audit:created', 16, 'App\\Models\\SaleInvoice#16', 3, '{\"sale_invoice_number\":\"ET-20251104120356123\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251104-0002\",\"docket_no\":\"32423\",\"po_date\":\"2025-11-04\",\"due_date\":\"2025-11-04 00:00:00\",\"e_way_bill_no\":\"4354\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":null,\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"3000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"6ASVoJ3pV8P0JUq8D76lg5Cd0FLKdZhpICTmJvim\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"PO-20251104-0002\\\",\\\"docket_no\\\":\\\"32423\\\",\\\"po_date\\\":\\\"2025-11-04\\\",\\\"due_date\\\":\\\"2025-11-04\\\",\\\"e_way_bill_no\\\":\\\"4354\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":null,\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"2600.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"2600.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"400\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"400.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"3000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"updated_at\":\"2025-11-04 12:03:56\",\"created_at\":\"2025-11-04 12:03:56\",\"id\":16,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-11-04 06:33:56', '2025-11-04 06:33:56'),
(196, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"updated_at\":\"2025-11-04 12:03:56\",\"current_balance\":7799}', '127.0.0.1', '2025-11-04 06:33:56', '2025-11-04 06:33:56'),
(197, 'audit:updated', 14, 'App\\Models\\CurrentStock#14', 3, '{\"qty\":0,\"updated_at\":\"2025-11-04 12:03:56\"}', '127.0.0.1', '2025-11-04 06:33:56', '2025-11-04 06:33:56'),
(198, 'audit:updated', 15, 'App\\Models\\CurrentStock#15', 3, '{\"qty\":0,\"updated_at\":\"2025-11-04 12:03:56\"}', '127.0.0.1', '2025-11-04 06:33:56', '2025-11-04 06:33:56'),
(199, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":7,\"updated_at\":\"2025-11-04 12:03:56\"}', '127.0.0.1', '2025-11-04 06:33:56', '2025-11-04 06:33:56'),
(200, 'audit:updated', 3, 'App\\Models\\User#3', 3, '{\"remember_token\":\"xcoidAgKcsFQQPZlu0Zrc84EmtC6YtZIltIQPhtQUYOU3icppOl7CAhs7T7h\"}', '127.0.0.1', '2025-11-04 06:40:37', '2025-11-04 06:40:37'),
(201, 'audit:updated', 1, 'App\\Models\\User#1', 1, '{\"remember_token\":\"gon1qQSsdntvFwbF4gObdiGzYXbdg4depN3CoWa0Yv7355Z3Uw9neyy8p3kC\"}', '127.0.0.1', '2025-11-04 06:44:00', '2025-11-04 06:44:00'),
(202, 'audit:updated', 3, 'App\\Models\\User#3', 3, '{\"remember_token\":\"bImXEPc8c7fkELxz5IOr2Ruov0nLizEDxqFUfykW9y8TtsxgW5YSaHzlGyr0\"}', '127.0.0.1', '2025-11-05 01:26:42', '2025-11-05 01:26:42'),
(203, 'audit:updated', 1, 'App\\Models\\User#1', 1, '{\"remember_token\":\"x2AGSAY1ffKqQjF7Ak0PhKb4ukSsnyBK4ZbBPV82StuovqphhIP525ve7UwD\"}', '127.0.0.1', '2025-11-05 01:27:41', '2025-11-05 01:27:41'),
(204, 'audit:updated', 5, 'App\\Models\\BankAccount#5', 3, '{\"print_upi_qr\":\"0\",\"updated_at\":\"2025-11-05 08:29:28\"}', '127.0.0.1', '2025-11-05 02:59:28', '2025-11-05 02:59:28'),
(205, 'audit:updated', 4, 'App\\Models\\BankAccount#4', 3, '{\"print_bank_details\":\"1\",\"updated_at\":\"2025-11-05 08:30:24\"}', '127.0.0.1', '2025-11-05 03:00:24', '2025-11-05 03:00:24'),
(206, 'audit:updated', 5, 'App\\Models\\BankAccount#5', 3, '{\"print_bank_details\":\"0\",\"updated_at\":\"2025-11-05 08:30:30\"}', '127.0.0.1', '2025-11-05 03:00:30', '2025-11-05 03:00:30'),
(207, 'audit:updated', 16, 'App\\Models\\SaleInvoice#16', 3, '{\"shipping_address\":\"Architecto eos cum n\",\"updated_at\":\"2025-11-05 11:02:28\",\"due_date\":null,\"subtotal\":\"6000.00\",\"total\":\"6000.00\",\"json_data\":\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"_method\\\":\\\"PUT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"po_no\\\":\\\"PO-20251104-0002\\\",\\\"docket_no\\\":\\\"32423\\\",\\\"po_date\\\":\\\"2025-11-04\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":\\\"4354\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"Architecto eos cum n\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"2\\\",\\\"price\\\":\\\"2600.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"5200.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"2\\\",\\\"price\\\":\\\"400\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"800.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"6000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"6000.00\\\"}\"}', '127.0.0.1', '2025-11-05 05:32:28', '2025-11-05 05:32:28'),
(208, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"updated_at\":\"2025-11-05 11:02:28\",\"current_balance\":13799}', '127.0.0.1', '2025-11-05 05:32:28', '2025-11-05 05:32:28'),
(209, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":5,\"updated_at\":\"2025-11-05 11:02:28\"}', '127.0.0.1', '2025-11-05 05:32:28', '2025-11-05 05:32:28'),
(210, 'audit:updated', 16, 'App\\Models\\SaleInvoice#16', 3, '{\"updated_at\":\"2025-11-05 11:02:45\",\"subtotal\":\"15000.00\",\"total\":\"15000.00\",\"json_data\":\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"_method\\\":\\\"PUT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"po_no\\\":\\\"PO-20251104-0002\\\",\\\"docket_no\\\":\\\"32423\\\",\\\"po_date\\\":\\\"2025-11-04\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":\\\"4354\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"Architecto eos cum n\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"5\\\",\\\"price\\\":\\\"2600.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"13000.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"5\\\",\\\"price\\\":\\\"400\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"2000.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"15000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"15000.00\\\"}\"}', '127.0.0.1', '2025-11-05 05:32:45', '2025-11-05 05:32:45'),
(211, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"updated_at\":\"2025-11-05 11:02:45\",\"current_balance\":28799}', '127.0.0.1', '2025-11-05 05:32:45', '2025-11-05 05:32:45'),
(212, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":0,\"updated_at\":\"2025-11-05 11:02:45\"}', '127.0.0.1', '2025-11-05 05:32:45', '2025-11-05 05:32:45'),
(213, 'audit:created', 22, 'App\\Models\\PurchaseBill#22', 3, '{\"purchase_invoice_number\":\"ET-20251105114011943\",\"select_customer_id\":\"4\",\"po_no\":\"ET-20251105-0001\",\"reference_no\":\"uhsfjhe88\",\"docket_no\":\"23434\",\"po_date\":\"2025-11-05\",\"due_date\":\"2025-11-05\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"notes\":null,\"terms\":\"waesrdtfgh\",\"overall_discount\":\"0\",\"subtotal\":\"20000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"20000.00\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"payment_type_id\":\"4\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"ET-20251105-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"purchase_bill_no\\\":\\\"2343453\\\",\\\"po_date\\\":\\\"2025-11-05\\\",\\\"due_date\\\":\\\"2025-11-05\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"Architecto eos cum n\\\",\\\"items\\\":[{\\\"id\\\":\\\"22\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"2000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"20000.00\\\"}],\\\"description\\\":\\\"qewfsdgbh\\\",\\\"terms\\\":\\\"waesrdtfgh\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"20000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"20000.00\\\",\\\"payment_type_id\\\":\\\"4\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"notes\\\":null}\",\"updated_at\":\"2025-11-05 11:40:11\",\"created_at\":\"2025-11-05 11:40:11\",\"id\":22,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-11-05 06:10:11', '2025-11-05 06:10:11'),
(214, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":10,\"updated_at\":\"2025-11-05 11:40:11\"}', '127.0.0.1', '2025-11-05 06:10:11', '2025-11-05 06:10:11'),
(215, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"updated_at\":\"2025-11-05 11:40:11\",\"current_balance\":8799}', '127.0.0.1', '2025-11-05 06:10:11', '2025-11-05 06:10:11'),
(216, 'audit:created', 23, 'App\\Models\\PurchaseBill#23', 3, '{\"purchase_invoice_number\":\"ET-20251105114221659\",\"select_customer_id\":\"4\",\"po_no\":\"ET-20251105-0002\",\"reference_no\":\"dfbnfgb\",\"docket_no\":null,\"po_date\":\"2025-11-05\",\"due_date\":\"2025-11-05\",\"e_way_bill_no\":null,\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"notes\":null,\"terms\":\"sdbvdfb\",\"overall_discount\":\"0\",\"subtotal\":\"6000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"6000.00\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"payment_type_id\":\"4\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"ET-20251105-0002\\\",\\\"docket_no\\\":null,\\\"purchase_bill_no\\\":null,\\\"po_date\\\":\\\"2025-11-05\\\",\\\"due_date\\\":\\\"2025-11-05\\\",\\\"e_way_bill_no\\\":null,\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"Architecto eos cum n\\\",\\\"items\\\":[{\\\"id\\\":\\\"22\\\",\\\"qty\\\":\\\"3\\\",\\\"price\\\":\\\"2000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"6000.00\\\"}],\\\"description\\\":\\\"asfdfb\\\",\\\"terms\\\":\\\"sdbvdfb\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"6000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"6000.00\\\",\\\"payment_type_id\\\":\\\"4\\\",\\\"reference_no\\\":\\\"dfbnfgb\\\",\\\"notes\\\":null}\",\"updated_at\":\"2025-11-05 11:42:21\",\"created_at\":\"2025-11-05 11:42:21\",\"id\":23,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-11-05 06:12:21', '2025-11-05 06:12:21'),
(217, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":13,\"updated_at\":\"2025-11-05 11:42:21\"}', '127.0.0.1', '2025-11-05 06:12:21', '2025-11-05 06:12:21'),
(218, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"updated_at\":\"2025-11-05 11:42:21\",\"current_balance\":2799}', '127.0.0.1', '2025-11-05 06:12:21', '2025-11-05 06:12:21'),
(219, 'audit:updated', 28, 'App\\Models\\AddItem#28', 3, '{\"updated_at\":\"2025-11-05 11:52:32\",\"select_unit_id\":null,\"json_data\":\"\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"unit_id\\\\\\\":null,\\\\\\\"select_category\\\\\\\":\\\\\\\"2\\\\\\\",\\\\\\\"quantity\\\\\\\":null,\\\\\\\"item_code\\\\\\\":\\\\\\\"ITM-9253-4715\\\\\\\",\\\\\\\"pricing\\\\\\\":{\\\\\\\"sale_price\\\\\\\":\\\\\\\"300\\\\\\\",\\\\\\\"select_type\\\\\\\":\\\\\\\"Without Tax\\\\\\\",\\\\\\\"disc_on_sale_price\\\\\\\":null,\\\\\\\"disc_type\\\\\\\":\\\\\\\"percentage\\\\\\\",\\\\\\\"select_tax_id\\\\\\\":null},\\\\\\\"wholesale\\\\\\\":{\\\\\\\"wholesale_price\\\\\\\":null,\\\\\\\"select_type_wholesale\\\\\\\":\\\\\\\"Without Tax\\\\\\\",\\\\\\\"minimum_wholesale_qty\\\\\\\":null},\\\\\\\"purchase\\\\\\\":{\\\\\\\"purchase_price\\\\\\\":\\\\\\\"200\\\\\\\",\\\\\\\"select_purchase_type\\\\\\\":\\\\\\\"Without Tax\\\\\\\"},\\\\\\\"stock\\\\\\\":{\\\\\\\"opening_stock\\\\\\\":null,\\\\\\\"low_stock_warning\\\\\\\":null,\\\\\\\"warehouse_location\\\\\\\":null},\\\\\\\"online\\\\\\\":{\\\\\\\"title\\\\\\\":null,\\\\\\\"description\\\\\\\":null}}\\\"\"}', '127.0.0.1', '2025-11-05 06:22:32', '2025-11-05 06:22:32'),
(220, 'audit:created', 29, 'App\\Models\\AddItem#29', 3, '{\"product_type\":\"finished_goods\",\"item_type\":\"product\",\"item_name\":\"current stock check\",\"item_hsn\":\"currentstock\",\"select_unit_id\":\"3\",\"quantity\":null,\"item_code\":\"ITM-5015-0511\",\"sale_price\":\"200\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":null,\"disc_type\":\"percentage\",\"wholesale_price\":null,\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":null,\"purchase_price\":\"100\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":null,\"opening_stock\":null,\"low_stock_warning\":null,\"warehouse_location\":null,\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"current stock check\\\",\\\"item_hsn\\\":\\\"currentstock\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":null,\\\"item_code\\\":\\\"ITM-5015-0511\\\",\\\"sale_price\\\":\\\"200\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null,\\\"purchase_price\\\":\\\"100\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":null,\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null,\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"raw_qty\\\":{\\\"20\\\":\\\"0\\\",\\\"21\\\":\\\"0\\\",\\\"24\\\":\\\"0\\\",\\\"9\\\":\\\"0\\\"},\\\"raw_sale_price\\\":{\\\"20\\\":\\\"100\\\",\\\"21\\\":\\\"100\\\",\\\"24\\\":\\\"3000\\\",\\\"9\\\":\\\"123\\\"},\\\"raw_purchase_price\\\":{\\\"20\\\":\\\"50\\\",\\\"21\\\":\\\"50\\\",\\\"24\\\":\\\"2000\\\",\\\"9\\\":\\\"0\\\"},\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":null,\\\\\\\"opening_stock\\\\\\\":null,\\\\\\\"composition_totals\\\\\\\":{\\\\\\\"total_sale_value\\\\\\\":0,\\\\\\\"total_purchase_value\\\\\\\":0}}\\\"}\",\"created_by_id\":3,\"updated_at\":\"2025-11-05 11:54:00\",\"created_at\":\"2025-11-05 11:54:00\",\"id\":29}', '127.0.0.1', '2025-11-05 06:24:00', '2025-11-05 06:24:00');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES
(221, 'audit:updated', 29, 'App\\Models\\AddItem#29', 3, '{\"json_data\":\"\\\"{\\\\\\\"_token\\\\\\\":\\\\\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\\\\\",\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"item_name\\\\\\\":\\\\\\\"current stock check\\\\\\\",\\\\\\\"item_hsn\\\\\\\":\\\\\\\"currentstock\\\\\\\",\\\\\\\"select_unit_id\\\\\\\":\\\\\\\"3\\\\\\\",\\\\\\\"select_category\\\\\\\":[\\\\\\\"4\\\\\\\"],\\\\\\\"quantity\\\\\\\":null,\\\\\\\"item_code\\\\\\\":\\\\\\\"ITM-5015-0511\\\\\\\",\\\\\\\"sale_price\\\\\\\":\\\\\\\"200\\\\\\\",\\\\\\\"select_type\\\\\\\":\\\\\\\"Without Tax\\\\\\\",\\\\\\\"disc_on_sale_price\\\\\\\":null,\\\\\\\"disc_type\\\\\\\":\\\\\\\"percentage\\\\\\\",\\\\\\\"select_tax_id\\\\\\\":null,\\\\\\\"wholesale_price\\\\\\\":null,\\\\\\\"select_type_wholesale\\\\\\\":\\\\\\\"Without Tax\\\\\\\",\\\\\\\"minimum_wholesale_qty\\\\\\\":null,\\\\\\\"purchase_price\\\\\\\":\\\\\\\"100\\\\\\\",\\\\\\\"select_purchase_type\\\\\\\":\\\\\\\"Without Tax\\\\\\\",\\\\\\\"opening_stock\\\\\\\":null,\\\\\\\"low_stock_warning\\\\\\\":null,\\\\\\\"warehouse_location\\\\\\\":null,\\\\\\\"online_store_title\\\\\\\":null,\\\\\\\"online_store_description\\\\\\\":null,\\\\\\\"raw_qty\\\\\\\":{\\\\\\\"20\\\\\\\":\\\\\\\"0\\\\\\\",\\\\\\\"21\\\\\\\":\\\\\\\"0\\\\\\\",\\\\\\\"24\\\\\\\":\\\\\\\"0\\\\\\\",\\\\\\\"9\\\\\\\":\\\\\\\"0\\\\\\\"},\\\\\\\"raw_sale_price\\\\\\\":{\\\\\\\"20\\\\\\\":\\\\\\\"100\\\\\\\",\\\\\\\"21\\\\\\\":\\\\\\\"100\\\\\\\",\\\\\\\"24\\\\\\\":\\\\\\\"3000\\\\\\\",\\\\\\\"9\\\\\\\":\\\\\\\"123\\\\\\\"},\\\\\\\"raw_purchase_price\\\\\\\":{\\\\\\\"20\\\\\\\":\\\\\\\"50\\\\\\\",\\\\\\\"21\\\\\\\":\\\\\\\"50\\\\\\\",\\\\\\\"24\\\\\\\":\\\\\\\"2000\\\\\\\",\\\\\\\"9\\\\\\\":\\\\\\\"0\\\\\\\"},\\\\\\\"json_data\\\\\\\":\\\\\\\"{\\\\\\\\\\\\\\\"item_type\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"product\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"product_type\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"finished_goods\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"quantity\\\\\\\\\\\\\\\":null,\\\\\\\\\\\\\\\"opening_stock\\\\\\\\\\\\\\\":null,\\\\\\\\\\\\\\\"composition_totals\\\\\\\\\\\\\\\":{\\\\\\\\\\\\\\\"total_sale_value\\\\\\\\\\\\\\\":0,\\\\\\\\\\\\\\\"total_purchase_value\\\\\\\\\\\\\\\":0}}\\\\\\\",\\\\\\\"composition_summary\\\\\\\":{\\\\\\\"finished_goods_composition\\\\\\\":{\\\\\\\"total_qty_used\\\\\\\":0,\\\\\\\"total_sale_value\\\\\\\":0,\\\\\\\"total_purchase_value\\\\\\\":0}}}\\\"\"}', '127.0.0.1', '2025-11-05 06:24:00', '2025-11-05 06:24:00'),
(222, 'audit:deleted', 29, 'App\\Models\\AddItem#29', 3, '{\"id\":29,\"item_type\":\"product\",\"item_name\":\"current stock check\",\"item_hsn\":\"currentstock\",\"item_code\":\"ITM-5015-0511\",\"sale_price\":\"200\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":null,\"disc_type\":\"percentage\",\"wholesale_price\":null,\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":null,\"purchase_price\":\"100\",\"select_purchase_type\":\"Without Tax\",\"created_at\":\"2025-11-05 11:54:00\",\"updated_at\":\"2025-11-05 12:00:22\",\"deleted_at\":\"2025-11-05 12:00:22\",\"select_unit_id\":3,\"select_tax_id\":null,\"created_by_id\":3,\"quantity\":null,\"opening_stock\":null,\"low_stock_warning\":null,\"warehouse_location\":null,\"online_store_title\":null,\"online_store_description\":null,\"online_store_image\":null,\"json_data\":\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"current stock check\\\",\\\"item_hsn\\\":\\\"currentstock\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":null,\\\"item_code\\\":\\\"ITM-5015-0511\\\",\\\"sale_price\\\":\\\"200\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null,\\\"purchase_price\\\":\\\"100\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":null,\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null,\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"raw_qty\\\":{\\\"20\\\":\\\"0\\\",\\\"21\\\":\\\"0\\\",\\\"24\\\":\\\"0\\\",\\\"9\\\":\\\"0\\\"},\\\"raw_sale_price\\\":{\\\"20\\\":\\\"100\\\",\\\"21\\\":\\\"100\\\",\\\"24\\\":\\\"3000\\\",\\\"9\\\":\\\"123\\\"},\\\"raw_purchase_price\\\":{\\\"20\\\":\\\"50\\\",\\\"21\\\":\\\"50\\\",\\\"24\\\":\\\"2000\\\",\\\"9\\\":\\\"0\\\"},\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":null,\\\\\\\"opening_stock\\\\\\\":null,\\\\\\\"composition_totals\\\\\\\":{\\\\\\\"total_sale_value\\\\\\\":0,\\\\\\\"total_purchase_value\\\\\\\":0}}\\\",\\\"composition_summary\\\":{\\\"finished_goods_composition\\\":{\\\"total_qty_used\\\":0,\\\"total_sale_value\\\":0,\\\"total_purchase_value\\\":0}}}\",\"unit_id\":null,\"product_type\":\"finished_goods\"}', '127.0.0.1', '2025-11-05 06:30:22', '2025-11-05 06:30:22'),
(223, 'audit:created', 30, 'App\\Models\\AddItem#30', 3, '{\"product_type\":\"finished_goods\",\"item_type\":\"product\",\"item_name\":\"stock check\",\"item_hsn\":\"stockcheck\",\"select_unit_id\":\"3\",\"quantity\":null,\"item_code\":\"ITM-6665-4176\",\"sale_price\":\"1200\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":null,\"disc_type\":\"percentage\",\"wholesale_price\":null,\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":null,\"purchase_price\":\"1000\",\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":null,\"opening_stock\":null,\"low_stock_warning\":null,\"warehouse_location\":null,\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"stock check\\\",\\\"item_hsn\\\":\\\"stockcheck\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":null,\\\"item_code\\\":\\\"ITM-6665-4176\\\",\\\"sale_price\\\":\\\"1200\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null,\\\"purchase_price\\\":\\\"1000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":null,\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null,\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"raw_qty\\\":{\\\"20\\\":\\\"0\\\",\\\"21\\\":\\\"0\\\",\\\"24\\\":\\\"0\\\",\\\"9\\\":\\\"0\\\"},\\\"raw_sale_price\\\":{\\\"20\\\":\\\"100\\\",\\\"21\\\":\\\"100\\\",\\\"24\\\":\\\"3000\\\",\\\"9\\\":\\\"123\\\"},\\\"raw_purchase_price\\\":{\\\"20\\\":\\\"50\\\",\\\"21\\\":\\\"50\\\",\\\"24\\\":\\\"2000\\\",\\\"9\\\":\\\"0\\\"},\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":null,\\\\\\\"opening_stock\\\\\\\":null,\\\\\\\"composition_totals\\\\\\\":{\\\\\\\"total_sale_value\\\\\\\":0,\\\\\\\"total_purchase_value\\\\\\\":0}}\\\"}\",\"created_by_id\":3,\"updated_at\":\"2025-11-05 12:03:44\",\"created_at\":\"2025-11-05 12:03:44\",\"id\":30}', '127.0.0.1', '2025-11-05 06:33:44', '2025-11-05 06:33:44'),
(224, 'audit:created', 21, 'App\\Models\\CurrentStock#21', 3, '{\"json_data\":\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"stock check\\\",\\\"item_hsn\\\":\\\"stockcheck\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":null,\\\"item_code\\\":\\\"ITM-6665-4176\\\",\\\"sale_price\\\":\\\"1200\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null,\\\"purchase_price\\\":\\\"1000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":null,\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null,\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"raw_qty\\\":{\\\"20\\\":\\\"0\\\",\\\"21\\\":\\\"0\\\",\\\"24\\\":\\\"0\\\",\\\"9\\\":\\\"0\\\"},\\\"raw_sale_price\\\":{\\\"20\\\":\\\"100\\\",\\\"21\\\":\\\"100\\\",\\\"24\\\":\\\"3000\\\",\\\"9\\\":\\\"123\\\"},\\\"raw_purchase_price\\\":{\\\"20\\\":\\\"50\\\",\\\"21\\\":\\\"50\\\",\\\"24\\\":\\\"2000\\\",\\\"9\\\":\\\"0\\\"},\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":null,\\\\\\\"opening_stock\\\\\\\":null,\\\\\\\"composition_totals\\\\\\\":{\\\\\\\"total_sale_value\\\\\\\":0,\\\\\\\"total_purchase_value\\\\\\\":0}}\\\"}\",\"user_id\":1,\"qty\":0,\"type\":\"Manufactured Stock\",\"created_by_id\":3,\"item_id\":30,\"product_type\":\"finished_goods\",\"updated_at\":\"2025-11-05 12:03:44\",\"created_at\":\"2025-11-05 12:03:44\",\"id\":21}', '127.0.0.1', '2025-11-05 06:33:44', '2025-11-05 06:33:44'),
(225, 'audit:updated', 30, 'App\\Models\\AddItem#30', 3, '{\"json_data\":\"\\\"{\\\\\\\"_token\\\\\\\":\\\\\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\\\\\",\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"item_name\\\\\\\":\\\\\\\"stock check\\\\\\\",\\\\\\\"item_hsn\\\\\\\":\\\\\\\"stockcheck\\\\\\\",\\\\\\\"select_unit_id\\\\\\\":\\\\\\\"3\\\\\\\",\\\\\\\"select_category\\\\\\\":[\\\\\\\"4\\\\\\\"],\\\\\\\"quantity\\\\\\\":null,\\\\\\\"item_code\\\\\\\":\\\\\\\"ITM-6665-4176\\\\\\\",\\\\\\\"sale_price\\\\\\\":\\\\\\\"1200\\\\\\\",\\\\\\\"select_type\\\\\\\":\\\\\\\"Without Tax\\\\\\\",\\\\\\\"disc_on_sale_price\\\\\\\":null,\\\\\\\"disc_type\\\\\\\":\\\\\\\"percentage\\\\\\\",\\\\\\\"select_tax_id\\\\\\\":null,\\\\\\\"wholesale_price\\\\\\\":null,\\\\\\\"select_type_wholesale\\\\\\\":\\\\\\\"Without Tax\\\\\\\",\\\\\\\"minimum_wholesale_qty\\\\\\\":null,\\\\\\\"purchase_price\\\\\\\":\\\\\\\"1000\\\\\\\",\\\\\\\"select_purchase_type\\\\\\\":\\\\\\\"Without Tax\\\\\\\",\\\\\\\"opening_stock\\\\\\\":null,\\\\\\\"low_stock_warning\\\\\\\":null,\\\\\\\"warehouse_location\\\\\\\":null,\\\\\\\"online_store_title\\\\\\\":null,\\\\\\\"online_store_description\\\\\\\":null,\\\\\\\"raw_qty\\\\\\\":{\\\\\\\"20\\\\\\\":\\\\\\\"0\\\\\\\",\\\\\\\"21\\\\\\\":\\\\\\\"0\\\\\\\",\\\\\\\"24\\\\\\\":\\\\\\\"0\\\\\\\",\\\\\\\"9\\\\\\\":\\\\\\\"0\\\\\\\"},\\\\\\\"raw_sale_price\\\\\\\":{\\\\\\\"20\\\\\\\":\\\\\\\"100\\\\\\\",\\\\\\\"21\\\\\\\":\\\\\\\"100\\\\\\\",\\\\\\\"24\\\\\\\":\\\\\\\"3000\\\\\\\",\\\\\\\"9\\\\\\\":\\\\\\\"123\\\\\\\"},\\\\\\\"raw_purchase_price\\\\\\\":{\\\\\\\"20\\\\\\\":\\\\\\\"50\\\\\\\",\\\\\\\"21\\\\\\\":\\\\\\\"50\\\\\\\",\\\\\\\"24\\\\\\\":\\\\\\\"2000\\\\\\\",\\\\\\\"9\\\\\\\":\\\\\\\"0\\\\\\\"},\\\\\\\"json_data\\\\\\\":\\\\\\\"{\\\\\\\\\\\\\\\"item_type\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"product\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"product_type\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"finished_goods\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"quantity\\\\\\\\\\\\\\\":null,\\\\\\\\\\\\\\\"opening_stock\\\\\\\\\\\\\\\":null,\\\\\\\\\\\\\\\"composition_totals\\\\\\\\\\\\\\\":{\\\\\\\\\\\\\\\"total_sale_value\\\\\\\\\\\\\\\":0,\\\\\\\\\\\\\\\"total_purchase_value\\\\\\\\\\\\\\\":0}}\\\\\\\",\\\\\\\"composition_summary\\\\\\\":{\\\\\\\"finished_goods_composition\\\\\\\":{\\\\\\\"total_qty_used\\\\\\\":0,\\\\\\\"total_sale_value\\\\\\\":0,\\\\\\\"total_purchase_value\\\\\\\":0}}}\\\"\"}', '127.0.0.1', '2025-11-05 06:33:44', '2025-11-05 06:33:44'),
(226, 'audit:created', 24, 'App\\Models\\PurchaseBill#24', 3, '{\"purchase_invoice_number\":\"ET-20251105120452643\",\"select_customer_id\":\"4\",\"po_no\":\"ET-20251105-0003\",\"reference_no\":\"rghryjtuh\",\"docket_no\":\"23434\",\"po_date\":\"2025-11-05\",\"due_date\":\"2025-11-05\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"10000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"10000.00\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"payment_type_id\":\"4\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"ET-20251105-0003\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"purchase_bill_no\\\":\\\"2343453\\\",\\\"po_date\\\":\\\"2025-11-05\\\",\\\"due_date\\\":\\\"2025-11-05\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"Architecto eos cum n\\\",\\\"items\\\":[{\\\"id\\\":\\\"30\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"10000.00\\\"}],\\\"description\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"10000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"10000.00\\\",\\\"payment_type_id\\\":\\\"4\\\",\\\"reference_no\\\":\\\"rghryjtuh\\\",\\\"notes\\\":null}\",\"updated_at\":\"2025-11-05 12:04:52\",\"created_at\":\"2025-11-05 12:04:52\",\"id\":24,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-11-05 06:34:52', '2025-11-05 06:34:52'),
(227, 'audit:updated', 21, 'App\\Models\\CurrentStock#21', 3, '{\"qty\":10,\"updated_at\":\"2025-11-05 12:04:52\"}', '127.0.0.1', '2025-11-05 06:34:52', '2025-11-05 06:34:52'),
(228, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"updated_at\":\"2025-11-05 12:04:52\",\"current_balance\":7201,\"current_balance_type\":\"Debit\"}', '127.0.0.1', '2025-11-05 06:34:52', '2025-11-05 06:34:52'),
(229, 'audit:updated', 3, 'App\\Models\\User#3', 3, '{\"remember_token\":\"gMqcG6Vml5AK17mc4ZfvFeb7zPaAFZXzm1X0PlspkEzyZ0EuXT1WYJpLV39W\"}', '127.0.0.1', '2025-11-07 03:59:40', '2025-11-07 03:59:40'),
(230, 'audit:created', 3, 'App\\Models\\SubCostCenter#3', 5, '{\"main_cost_center_id\":\"4\",\"sub_cost_center_name\":\"Punjab\",\"unique_code\":\"Non debitis quo magn\",\"details_of_sub_cost_center\":\"Quia nemo inventore\",\"responsible_manager\":\"Nulla numquam omnis\",\"budget_allocated\":\"Consequuntur suscipi\",\"actual_expense\":\"Id quis ipsum et qu\",\"start_date\":\"1991-11-15\",\"status\":\"inactive\",\"created_by_id\":5,\"updated_at\":\"2025-11-07 09:32:06\",\"created_at\":\"2025-11-07 09:32:06\",\"id\":3}', '127.0.0.1', '2025-11-07 04:02:07', '2025-11-07 04:02:07'),
(231, 'audit:updated', 3, 'App\\Models\\SubCostCenter#3', 5, '{\"status\":\"active\",\"updated_at\":\"2025-11-07 09:32:42\"}', '127.0.0.1', '2025-11-07 04:02:42', '2025-11-07 04:02:42'),
(232, 'audit:created', 17, 'App\\Models\\SaleInvoice#17', 5, '{\"sale_invoice_number\":\"ET-20251107101306583\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251107-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-11-07\",\"due_date\":\"2025-11-07 00:00:00\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"wefve\",\"notes\":\"esdv c\",\"terms\":\"esdv\",\"overall_discount\":\"0\",\"subtotal\":\"3000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"created_by_id\":5,\"json_data\":\"{\\\"_token\\\":\\\"lryCAJ2BK2lCWt7HIBLA0uhe2CPECqu8nYT1SPxS\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251107-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-07\\\",\\\"due_date\\\":\\\"2025-11-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"wefve\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"3000.00\\\"}],\\\"notes\\\":\\\"esdv c\\\",\\\"terms\\\":\\\"esdv\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"3000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"updated_at\":\"2025-11-07 10:13:06\",\"created_at\":\"2025-11-07 10:13:06\",\"id\":17,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-11-07 04:43:06', '2025-11-07 04:43:06'),
(233, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 5, '{\"updated_at\":\"2025-11-07 10:13:06\",\"current_balance\":4201}', '127.0.0.1', '2025-11-07 04:43:06', '2025-11-07 04:43:06'),
(234, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 5, '{\"qty\":12,\"updated_at\":\"2025-11-07 10:13:06\"}', '127.0.0.1', '2025-11-07 04:43:06', '2025-11-07 04:43:06'),
(235, 'audit:updated', 17, 'App\\Models\\SaleInvoice#17', 3, '{\"updated_at\":\"2025-11-07 10:55:20\",\"status\":\"Other\"}', '127.0.0.1', '2025-11-07 05:25:20', '2025-11-07 05:25:20'),
(236, 'audit:updated', 17, 'App\\Models\\SaleInvoice#17', 3, '{\"updated_at\":\"2025-11-07 10:55:40\",\"status\":\"Approved\"}', '127.0.0.1', '2025-11-07 05:25:40', '2025-11-07 05:25:40'),
(237, 'audit:updated', 17, 'App\\Models\\SaleInvoice#17', 3, '{\"updated_at\":\"2025-11-07 10:58:23\",\"status\":\"Pending\"}', '127.0.0.1', '2025-11-07 05:28:23', '2025-11-07 05:28:23'),
(238, 'audit:updated', 15, 'App\\Models\\SaleInvoice#15', 3, '{\"updated_at\":\"2025-11-07 11:03:48\",\"status\":\"Pending\"}', '127.0.0.1', '2025-11-07 05:33:48', '2025-11-07 05:33:48'),
(239, 'audit:updated', 1, 'App\\Models\\User#1', 1, '{\"remember_token\":\"IDCtjoKaSLCgRMJK2WM88K5Yv68mAtpEd4ut612uLw5JJxEsuX0KATG4Pbid\"}', '127.0.0.1', '2025-11-08 01:15:21', '2025-11-08 01:15:21'),
(240, 'audit:created', 1, 'App\\Models\\PaymentIn#1', 3, '{\"parties_id\":\"4\",\"payment_type_id\":\"4\",\"date\":\"2025-11-08\",\"reference_no\":\"wqfcac\",\"amount\":\"4000\",\"discount\":null,\"total\":\"4000.00\",\"description\":null,\"created_by_id\":3,\"updated_by_id\":3,\"updated_at\":\"2025-11-08 06:46:02\",\"created_at\":\"2025-11-08 06:46:02\",\"id\":1,\"attechment\":null,\"media\":[]}', '127.0.0.1', '2025-11-08 01:16:02', '2025-11-08 01:16:02'),
(241, 'audit:created', 2, 'App\\Models\\PaymentIn#2', 3, '{\"parties_id\":\"4\",\"payment_type_id\":\"4\",\"date\":\"2025-11-08\",\"reference_no\":\"wqfcac\",\"amount\":\"4000\",\"discount\":null,\"total\":\"4000.00\",\"description\":null,\"created_by_id\":3,\"updated_by_id\":3,\"updated_at\":\"2025-11-08 06:48:55\",\"created_at\":\"2025-11-08 06:48:55\",\"id\":2,\"attechment\":null,\"media\":[]}', '127.0.0.1', '2025-11-08 01:18:55', '2025-11-08 01:18:55'),
(242, 'audit:created', 3, 'App\\Models\\PaymentIn#3', 3, '{\"parties_id\":\"4\",\"payment_type_id\":\"4\",\"date\":\"2025-11-08\",\"reference_no\":\"wqfcac\",\"amount\":\"4000\",\"discount\":null,\"total\":\"4000.00\",\"description\":null,\"created_by_id\":3,\"updated_by_id\":3,\"updated_at\":\"2025-11-08 06:49:16\",\"created_at\":\"2025-11-08 06:49:16\",\"id\":3,\"attechment\":null,\"media\":[]}', '127.0.0.1', '2025-11-08 01:19:16', '2025-11-08 01:19:16'),
(243, 'audit:created', 4, 'App\\Models\\PaymentIn#4', 3, '{\"parties_id\":\"4\",\"payment_type_id\":\"4\",\"date\":\"2025-11-08\",\"reference_no\":\"wqfcac\",\"amount\":\"4000\",\"discount\":null,\"total\":\"4000.00\",\"description\":null,\"created_by_id\":3,\"updated_by_id\":3,\"updated_at\":\"2025-11-08 06:49:37\",\"created_at\":\"2025-11-08 06:49:37\",\"id\":4,\"attechment\":null,\"media\":[]}', '127.0.0.1', '2025-11-08 01:19:37', '2025-11-08 01:19:37'),
(244, 'audit:updated', 4, 'App\\Models\\BankAccount#4', 3, '{\"opening_balance\":4012,\"updated_at\":\"2025-11-08 06:49:37\",\"opening_balance_type\":\"debit\"}', '127.0.0.1', '2025-11-08 01:19:37', '2025-11-08 01:19:37'),
(245, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"updated_at\":\"2025-11-08 06:49:37\",\"current_balance\":8201}', '127.0.0.1', '2025-11-08 01:19:37', '2025-11-08 01:19:37'),
(246, 'audit:deleted', 4, 'App\\Models\\PaymentIn#4', 3, '{\"id\":4,\"parties_id\":4,\"payment_type_id\":4,\"date\":\"2025-11-08\",\"reference_no\":\"wqfcac\",\"amount\":\"4000.00\",\"discount\":null,\"total\":\"4000.00\",\"description\":null,\"created_by_id\":3,\"updated_by_id\":3,\"created_at\":\"2025-11-08 06:49:37\",\"updated_at\":\"2025-11-08 06:50:01\",\"deleted_at\":\"2025-11-08 06:50:01\",\"attechment\":null,\"media\":[]}', '127.0.0.1', '2025-11-08 01:20:01', '2025-11-08 01:20:01'),
(247, 'audit:deleted', 3, 'App\\Models\\PaymentIn#3', 3, '{\"id\":3,\"parties_id\":4,\"payment_type_id\":4,\"date\":\"2025-11-08\",\"reference_no\":\"wqfcac\",\"amount\":\"4000.00\",\"discount\":null,\"total\":\"4000.00\",\"description\":null,\"created_by_id\":3,\"updated_by_id\":3,\"created_at\":\"2025-11-08 06:49:16\",\"updated_at\":\"2025-11-08 06:50:04\",\"deleted_at\":\"2025-11-08 06:50:04\",\"attechment\":null,\"media\":[]}', '127.0.0.1', '2025-11-08 01:20:04', '2025-11-08 01:20:04'),
(248, 'audit:deleted', 2, 'App\\Models\\PaymentIn#2', 3, '{\"id\":2,\"parties_id\":4,\"payment_type_id\":4,\"date\":\"2025-11-08\",\"reference_no\":\"wqfcac\",\"amount\":\"4000.00\",\"discount\":null,\"total\":\"4000.00\",\"description\":null,\"created_by_id\":3,\"updated_by_id\":3,\"created_at\":\"2025-11-08 06:48:55\",\"updated_at\":\"2025-11-08 06:50:08\",\"deleted_at\":\"2025-11-08 06:50:08\",\"attechment\":null,\"media\":[]}', '127.0.0.1', '2025-11-08 01:20:08', '2025-11-08 01:20:08'),
(249, 'audit:deleted', 1, 'App\\Models\\PaymentIn#1', 3, '{\"id\":1,\"parties_id\":4,\"payment_type_id\":4,\"date\":\"2025-11-08\",\"reference_no\":\"wqfcac\",\"amount\":\"4000.00\",\"discount\":null,\"total\":\"4000.00\",\"description\":null,\"created_by_id\":3,\"updated_by_id\":3,\"created_at\":\"2025-11-08 06:46:02\",\"updated_at\":\"2025-11-08 07:02:49\",\"deleted_at\":\"2025-11-08 07:02:49\",\"attechment\":null,\"media\":[]}', '127.0.0.1', '2025-11-08 01:32:49', '2025-11-08 01:32:49'),
(250, 'audit:created', 5, 'App\\Models\\PaymentIn#5', 3, '{\"parties_id\":\"4\",\"payment_type_id\":\"4\",\"date\":\"2025-11-08\",\"reference_no\":\"uhsfjhe88\",\"amount\":\"201\",\"discount\":null,\"total\":\"201.00\",\"description\":\"scsd\",\"created_by_id\":3,\"updated_by_id\":3,\"updated_at\":\"2025-11-08 07:03:31\",\"created_at\":\"2025-11-08 07:03:31\",\"id\":5,\"attechment\":null,\"media\":[]}', '127.0.0.1', '2025-11-08 01:33:31', '2025-11-08 01:33:31'),
(251, 'audit:updated', 4, 'App\\Models\\BankAccount#4', 3, '{\"opening_balance\":4213,\"updated_at\":\"2025-11-08 07:03:31\"}', '127.0.0.1', '2025-11-08 01:33:31', '2025-11-08 01:33:31'),
(252, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"updated_at\":\"2025-11-08 07:03:31\",\"current_balance\":8402}', '127.0.0.1', '2025-11-08 01:33:31', '2025-11-08 01:33:31'),
(253, 'audit:created', 6, 'App\\Models\\PaymentIn#6', 3, '{\"parties_id\":\"4\",\"payment_type_id\":\"4\",\"date\":\"2025-11-08\",\"reference_no\":\"uhsfjhe88\",\"amount\":\"402\",\"discount\":null,\"total\":\"402.00\",\"description\":null,\"created_by_id\":3,\"updated_by_id\":3,\"updated_at\":\"2025-11-08 07:05:29\",\"created_at\":\"2025-11-08 07:05:29\",\"id\":6,\"attechment\":null,\"media\":[]}', '127.0.0.1', '2025-11-08 01:35:29', '2025-11-08 01:35:29'),
(254, 'audit:updated', 4, 'App\\Models\\BankAccount#4', 3, '{\"opening_balance\":4615,\"updated_at\":\"2025-11-08 07:05:29\"}', '127.0.0.1', '2025-11-08 01:35:29', '2025-11-08 01:35:29'),
(255, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"updated_at\":\"2025-11-08 07:05:29\",\"current_balance\":8804}', '127.0.0.1', '2025-11-08 01:35:29', '2025-11-08 01:35:29'),
(256, 'audit:created', 7, 'App\\Models\\PaymentIn#7', 3, '{\"parties_id\":\"4\",\"payment_type_id\":\"4\",\"date\":\"2025-11-08\",\"reference_no\":\"804\",\"amount\":\"804\",\"discount\":null,\"total\":\"804.00\",\"description\":null,\"created_by_id\":3,\"updated_by_id\":3,\"updated_at\":\"2025-11-08 07:08:32\",\"created_at\":\"2025-11-08 07:08:32\",\"id\":7,\"attechment\":null,\"media\":[]}', '127.0.0.1', '2025-11-08 01:38:32', '2025-11-08 01:38:32'),
(257, 'audit:updated', 4, 'App\\Models\\BankAccount#4', 3, '{\"opening_balance\":3811,\"updated_at\":\"2025-11-08 07:08:32\"}', '127.0.0.1', '2025-11-08 01:38:32', '2025-11-08 01:38:32'),
(258, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"updated_at\":\"2025-11-08 07:08:32\",\"current_balance\":9608}', '127.0.0.1', '2025-11-08 01:38:32', '2025-11-08 01:38:32'),
(259, 'audit:created', 8, 'App\\Models\\PaymentIn#8', 3, '{\"parties_id\":\"4\",\"payment_type_id\":\"4\",\"date\":\"2025-11-08\",\"reference_no\":\"wqfesc\",\"amount\":\"608\",\"discount\":null,\"total\":\"608.00\",\"description\":null,\"created_by_id\":3,\"updated_by_id\":3,\"updated_at\":\"2025-11-08 07:11:13\",\"created_at\":\"2025-11-08 07:11:13\",\"id\":8,\"attechment\":null,\"media\":[]}', '127.0.0.1', '2025-11-08 01:41:13', '2025-11-08 01:41:13'),
(260, 'audit:updated', 4, 'App\\Models\\BankAccount#4', 3, '{\"opening_balance\":4419,\"updated_at\":\"2025-11-08 07:11:13\"}', '127.0.0.1', '2025-11-08 01:41:14', '2025-11-08 01:41:14'),
(261, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"updated_at\":\"2025-11-08 07:11:14\",\"current_balance\":9000}', '127.0.0.1', '2025-11-08 01:41:14', '2025-11-08 01:41:14'),
(262, 'audit:created', 9, 'App\\Models\\PaymentIn#9', 3, '{\"parties_id\":\"4\",\"payment_type_id\":\"4\",\"date\":\"2025-11-08\",\"reference_no\":null,\"amount\":\"400\",\"discount\":null,\"total\":\"400.00\",\"description\":null,\"created_by_id\":3,\"updated_by_id\":3,\"updated_at\":\"2025-11-08 07:39:32\",\"created_at\":\"2025-11-08 07:39:32\",\"id\":9,\"attechment\":null,\"media\":[]}', '127.0.0.1', '2025-11-08 02:09:32', '2025-11-08 02:09:32'),
(263, 'audit:updated', 4, 'App\\Models\\BankAccount#4', 3, '{\"opening_balance\":4819,\"updated_at\":\"2025-11-08 07:39:32\"}', '127.0.0.1', '2025-11-08 02:09:32', '2025-11-08 02:09:32'),
(264, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"updated_at\":\"2025-11-08 07:39:32\",\"current_balance\":8600}', '127.0.0.1', '2025-11-08 02:09:32', '2025-11-08 02:09:32'),
(265, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"updated_at\":\"2025-11-08 07:44:23\",\"current_balance\":7201}', '127.0.0.1', '2025-11-08 02:14:23', '2025-11-08 02:14:23'),
(266, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":13,\"updated_at\":\"2025-11-08 07:44:23\"}', '127.0.0.1', '2025-11-08 02:14:23', '2025-11-08 02:14:23'),
(267, 'audit:updated', 14, 'App\\Models\\CurrentStock#14', 3, '{\"qty\":5,\"updated_at\":\"2025-11-08 07:44:23\"}', '127.0.0.1', '2025-11-08 02:14:23', '2025-11-08 02:14:23'),
(268, 'audit:updated', 15, 'App\\Models\\CurrentStock#15', 3, '{\"qty\":5,\"updated_at\":\"2025-11-08 07:44:23\"}', '127.0.0.1', '2025-11-08 02:14:23', '2025-11-08 02:14:23'),
(269, 'audit:updated', 17, 'App\\Models\\SaleInvoice#17', 3, '{\"po_date\":\"2025-11-08\",\"updated_at\":\"2025-11-08 07:44:23\",\"overall_discount\":\"0.00\",\"json_data\":\"{\\\"_token\\\":\\\"W2Q6uMHJGMYYBZa9TKWVG89wGDh0NDLSTpTJj6Di\\\",\\\"_method\\\":\\\"PUT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251107-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-08\\\",\\\"due_date\\\":\\\"2025-11-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"wefve\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0.00\\\",\\\"amount\\\":\\\"3000.00\\\"}],\\\"notes\\\":\\\"esdv c\\\",\\\"terms\\\":\\\"esdv\\\",\\\"overall_discount\\\":\\\"0.00\\\",\\\"subtotal\\\":\\\"3000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\"}', '127.0.0.1', '2025-11-08 02:14:23', '2025-11-08 02:14:23'),
(270, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"current_balance\":4201}', '127.0.0.1', '2025-11-08 02:14:23', '2025-11-08 02:14:23'),
(271, 'audit:updated', 14, 'App\\Models\\CurrentStock#14', 3, '{\"qty\":0,\"updated_at\":\"2025-11-08 07:44:24\"}', '127.0.0.1', '2025-11-08 02:14:24', '2025-11-08 02:14:24'),
(272, 'audit:updated', 15, 'App\\Models\\CurrentStock#15', 3, '{\"qty\":0,\"updated_at\":\"2025-11-08 07:44:24\"}', '127.0.0.1', '2025-11-08 02:14:24', '2025-11-08 02:14:24'),
(273, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":12,\"updated_at\":\"2025-11-08 07:44:24\"}', '127.0.0.1', '2025-11-08 02:14:24', '2025-11-08 02:14:24'),
(274, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"updated_at\":\"2025-11-08 07:44:57\",\"current_balance\":7201}', '127.0.0.1', '2025-11-08 02:14:57', '2025-11-08 02:14:57'),
(275, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":13,\"updated_at\":\"2025-11-08 07:44:57\"}', '127.0.0.1', '2025-11-08 02:14:57', '2025-11-08 02:14:57'),
(276, 'audit:updated', 14, 'App\\Models\\CurrentStock#14', 3, '{\"qty\":5,\"updated_at\":\"2025-11-08 07:44:57\"}', '127.0.0.1', '2025-11-08 02:14:57', '2025-11-08 02:14:57'),
(277, 'audit:updated', 15, 'App\\Models\\CurrentStock#15', 3, '{\"qty\":5,\"updated_at\":\"2025-11-08 07:44:57\"}', '127.0.0.1', '2025-11-08 02:14:57', '2025-11-08 02:14:57'),
(278, 'audit:updated', 17, 'App\\Models\\SaleInvoice#17', 3, '{\"updated_at\":\"2025-11-08 07:44:57\",\"subtotal\":\"2542.37\",\"tax\":\"457.63\",\"json_data\":\"{\\\"_token\\\":\\\"W2Q6uMHJGMYYBZa9TKWVG89wGDh0NDLSTpTJj6Di\\\",\\\"_method\\\":\\\"PUT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251107-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-08\\\",\\\"due_date\\\":\\\"2025-11-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"wefve\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"18\\\",\\\"amount\\\":\\\"3000.00\\\"}],\\\"notes\\\":\\\"esdv c\\\",\\\"terms\\\":\\\"esdv\\\",\\\"overall_discount\\\":\\\"0.00\\\",\\\"subtotal\\\":\\\"2542.37\\\",\\\"tax\\\":\\\"457.63\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\"}', '127.0.0.1', '2025-11-08 02:14:57', '2025-11-08 02:14:57'),
(279, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"current_balance\":4201}', '127.0.0.1', '2025-11-08 02:14:57', '2025-11-08 02:14:57'),
(280, 'audit:updated', 14, 'App\\Models\\CurrentStock#14', 3, '{\"qty\":0}', '127.0.0.1', '2025-11-08 02:14:57', '2025-11-08 02:14:57'),
(281, 'audit:updated', 15, 'App\\Models\\CurrentStock#15', 3, '{\"qty\":0}', '127.0.0.1', '2025-11-08 02:14:57', '2025-11-08 02:14:57'),
(282, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":12}', '127.0.0.1', '2025-11-08 02:14:57', '2025-11-08 02:14:57'),
(283, 'audit:updated', 3, 'App\\Models\\User#3', 3, '{\"remember_token\":\"5UCObvHm1tFr96HxbRFpGoBlMC4lDdkrdRRCRfoPookkXQgslZxc7imO9koM\"}', '127.0.0.1', '2025-11-08 02:22:01', '2025-11-08 02:22:01'),
(286, 'audit:created', 31, 'App\\Models\\AddItem#31', 3, '{\"product_type\":null,\"item_type\":\"service\",\"item_name\":\"Service2\",\"item_hsn\":\"AKUYG4341\",\"select_unit_id\":\"3\",\"quantity\":\"0\",\"item_code\":\"ITM-7926-4560\",\"sale_price\":\"299\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":null,\"disc_type\":\"percentage\",\"wholesale_price\":null,\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":null,\"purchase_price\":null,\"select_purchase_type\":\"Without Tax\",\"select_tax_id\":null,\"opening_stock\":\"0\",\"low_stock_warning\":null,\"warehouse_location\":null,\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"_token\\\":\\\"vM6YzvJ0GBWE2fVkOS8uMdS0WCGZ0OBb39EgAxNO\\\",\\\"item_type\\\":\\\"service\\\",\\\"product_type\\\":null,\\\"item_name\\\":\\\"Service2\\\",\\\"item_hsn\\\":\\\"AKUYG4341\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"0\\\",\\\"item_code\\\":\\\"ITM-7926-4560\\\",\\\"sale_price\\\":\\\"299\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null,\\\"purchase_price\\\":null,\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"0\\\",\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null,\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"raw_qty\\\":{\\\"20\\\":\\\"0\\\",\\\"21\\\":\\\"0\\\",\\\"24\\\":\\\"0\\\",\\\"9\\\":\\\"0\\\"},\\\"raw_sale_price\\\":{\\\"20\\\":\\\"100\\\",\\\"21\\\":\\\"100\\\",\\\"24\\\":\\\"3000\\\",\\\"9\\\":\\\"123\\\"},\\\"raw_purchase_price\\\":{\\\"20\\\":\\\"50\\\",\\\"21\\\":\\\"50\\\",\\\"24\\\":\\\"2000\\\",\\\"9\\\":\\\"0\\\"},\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"service\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"0\\\\\\\",\\\\\\\"opening_stock\\\\\\\":\\\\\\\"0\\\\\\\",\\\\\\\"composition_totals\\\\\\\":{\\\\\\\"total_sale_value\\\\\\\":0,\\\\\\\"total_purchase_value\\\\\\\":0}}\\\"}\",\"created_by_id\":3,\"updated_at\":\"2025-11-08 10:28:12\",\"created_at\":\"2025-11-08 10:28:12\",\"id\":31}', '127.0.0.1', '2025-11-08 04:58:12', '2025-11-08 04:58:12'),
(287, 'audit:updated', 3, 'App\\Models\\User#3', 3, '{\"remember_token\":\"rvhmlHZqVA2DNOryLDYH4j02gpv7HBHXaVKe8RfNbyJo7LghSSiAi2rhweq2\"}', '127.0.0.1', '2025-11-08 05:21:41', '2025-11-08 05:21:41'),
(288, 'audit:updated', 1, 'App\\Models\\User#1', 1, '{\"remember_token\":\"HaRghKX1KPvZILc8zhLgu1DdVlCjvvuGjGuc71zkhjVr6sefLyFUZyWLz3dQ\"}', '127.0.0.1', '2025-11-08 05:22:10', '2025-11-08 05:22:10'),
(289, 'audit:created', 6, 'App\\Models\\BankAccount#6', 2, '{\"account_name\":\"Airtel Bank\",\"opening_balance\":\"1000\",\"as_of_date\":\"2025-11-08\",\"account_number\":\"13243546466\",\"ifsc_code\":\"AIRP0000001\",\"bank_name\":\"Airtel Payments Bank\",\"account_holder_name\":\"Ajay Mehta\",\"upi\":null,\"print_upi_qr\":\"1\",\"print_bank_details\":\"1\",\"created_by_id\":2,\"updated_at\":\"2025-11-08 10:57:20\",\"created_at\":\"2025-11-08 10:57:20\",\"id\":6,\"upi_qr\":null,\"media\":[]}', '127.0.0.1', '2025-11-08 05:27:20', '2025-11-08 05:27:20'),
(290, 'audit:updated', 3, 'App\\Models\\User#3', 3, '{\"remember_token\":\"xZENSwQQ0l00sTHhQAlUhQy3mBRa2RYnxwlcP5uZDCjihEchxFKqSv5HVbYw\"}', '127.0.0.1', '2025-11-08 05:28:18', '2025-11-08 05:28:18'),
(291, 'audit:created', 4, 'App\\Models\\SubCostCenter#4', 2, '{\"main_cost_center_id\":\"3\",\"sub_cost_center_name\":\"kolkata\",\"unique_code\":null,\"details_of_sub_cost_center\":null,\"responsible_manager\":\"aja\",\"budget_allocated\":null,\"actual_expense\":null,\"start_date\":null,\"status\":\"active\",\"created_by_id\":2,\"updated_at\":\"2025-11-08 11:01:14\",\"created_at\":\"2025-11-08 11:01:14\",\"id\":4}', '127.0.0.1', '2025-11-08 05:31:14', '2025-11-08 05:31:14'),
(292, 'audit:updated', 1, 'App\\Models\\User#1', 1, '{\"remember_token\":\"zrdaMW7jobrxWnf7AT5KHiZAEd2JGZixGivSuCsqm0M8jCuPjWRzz0e4fE83\"}', '127.0.0.1', '2025-12-02 03:45:39', '2025-12-02 03:45:39'),
(308, 'audit:created', 16, 'App\\Models\\ProformaInvoice#16', 3, '{\"select_customer_id\":\"4\",\"po_no\":\"PO-20251202-0001\",\"po_date\":\"2025-12-02\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"q3w4ertt\",\"created_by_id\":3,\"updated_at\":\"2025-12-02 10:00:46\",\"created_at\":\"2025-12-02 10:00:46\",\"id\":16,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-12-02 04:30:46', '2025-12-02 04:30:46'),
(309, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":11,\"updated_at\":\"2025-12-02 10:00:46\"}', '127.0.0.1', '2025-12-02 04:30:46', '2025-12-02 04:30:46'),
(310, 'audit:created', 18, 'App\\Models\\SaleInvoice#18', 3, '{\"sale_invoice_number\":\"ET-20251202100236802\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251202-0001\",\"docket_no\":\"qwerty\",\"po_date\":\"2025-12-02\",\"due_date\":null,\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"234erty\",\"notes\":\"sdcv\",\"terms\":\"qwsdcv\",\"overall_discount\":\"0\",\"subtotal\":\"2646.61\",\"tax\":\"476.39\",\"discount\":\"0.00\",\"total\":\"3123.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"REcPD33kSQLYdgO5G86rimCXV5d8piIyCi4mdSGN\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251202-0001\\\",\\\"docket_no\\\":\\\"qwerty\\\",\\\"po_date\\\":\\\"2025-12-02\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"234erty\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"18\\\",\\\"amount\\\":\\\"3000.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"123.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"18\\\",\\\"amount\\\":\\\"123.00\\\"}],\\\"notes\\\":\\\"sdcv\\\",\\\"terms\\\":\\\"qwsdcv\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2646.61\\\",\\\"tax\\\":\\\"476.39\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3123.00\\\"}\",\"status\":\"Draft\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"updated_at\":\"2025-12-02 10:02:36\",\"created_at\":\"2025-12-02 10:02:36\",\"id\":18,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-12-02 04:32:36', '2025-12-02 04:32:36'),
(311, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"updated_at\":\"2025-12-02 10:02:36\",\"current_balance\":1078}', '127.0.0.1', '2025-12-02 04:32:36', '2025-12-02 04:32:36'),
(312, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":10,\"updated_at\":\"2025-12-02 10:02:36\"}', '127.0.0.1', '2025-12-02 04:32:36', '2025-12-02 04:32:36'),
(313, 'audit:created', 17, 'App\\Models\\ProformaInvoice#17', 3, '{\"select_customer_id\":\"4\",\"po_no\":\"PO-20251202-0002\",\"po_date\":\"2025-12-02\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"qwerfg\",\"created_by_id\":3,\"updated_at\":\"2025-12-02 10:04:56\",\"created_at\":\"2025-12-02 10:04:56\",\"id\":17,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-12-02 04:34:56', '2025-12-02 04:34:56'),
(314, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":9,\"updated_at\":\"2025-12-02 10:04:56\"}', '127.0.0.1', '2025-12-02 04:34:56', '2025-12-02 04:34:56'),
(315, 'audit:created', 18, 'App\\Models\\ProformaInvoice#18', 3, '{\"select_customer_id\":\"4\",\"po_no\":\"PO-20251202-0002\",\"docket_no\":\"234567\",\"po_date\":\"2025-12-02\",\"due_date\":\"2025-12-02\",\"e_way_bill_no\":\"12345\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"awsedtfghj\",\"notes\":\"sdfg\",\"terms\":\"asdfghn\",\"overall_discount\":\"9\",\"created_by_id\":3,\"status\":\"Draft\",\"updated_at\":\"2025-12-02 10:33:45\",\"created_at\":\"2025-12-02 10:33:45\",\"id\":18,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-12-02 05:03:45', '2025-12-02 05:03:45'),
(316, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":7,\"updated_at\":\"2025-12-02 10:33:47\"}', '127.0.0.1', '2025-12-02 05:03:47', '2025-12-02 05:03:47'),
(317, 'audit:created', 19, 'App\\Models\\ProformaInvoice#19', 3, '{\"select_customer_id\":\"4\",\"po_no\":\"PO-20251202-0002\",\"docket_no\":null,\"po_date\":\"2025-12-02\",\"due_date\":\"2025-12-02\",\"e_way_bill_no\":null,\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":null,\"notes\":\"sdfghj\",\"terms\":\"asdfgh\",\"overall_discount\":\"9\",\"created_by_id\":3,\"status\":\"Draft\",\"updated_at\":\"2025-12-02 10:38:08\",\"created_at\":\"2025-12-02 10:38:08\",\"id\":19,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-12-02 05:08:08', '2025-12-02 05:08:08'),
(318, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":6,\"updated_at\":\"2025-12-02 10:38:08\"}', '127.0.0.1', '2025-12-02 05:08:08', '2025-12-02 05:08:08'),
(319, 'audit:created', 20, 'App\\Models\\ProformaInvoice#20', 3, '{\"select_customer_id\":\"4\",\"po_no\":\"PO-20251202-0002\",\"docket_no\":\"12345345\",\"po_date\":\"2025-12-02\",\"due_date\":\"2025-12-02\",\"e_way_bill_no\":\"56987654\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"asdfghm\",\"notes\":\"sdfghm\",\"terms\":\"sdfghj\",\"overall_discount\":\"100\",\"created_by_id\":3,\"status\":\"Draft\",\"main_cost_centers_id\":null,\"sub_cost_centers_id\":null,\"updated_at\":\"2025-12-02 10:41:27\",\"created_at\":\"2025-12-02 10:41:27\",\"id\":20,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-12-02 05:11:27', '2025-12-02 05:11:27'),
(320, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":5,\"updated_at\":\"2025-12-02 10:41:27\"}', '127.0.0.1', '2025-12-02 05:11:27', '2025-12-02 05:11:27'),
(321, 'audit:created', 21, 'App\\Models\\ProformaInvoice#21', 3, '{\"select_customer_id\":\"4\",\"po_no\":\"PO-20251202-0002\",\"docket_no\":\"1234567543\",\"po_date\":\"2025-12-02\",\"due_date\":\"2025-12-02\",\"e_way_bill_no\":\"23456754\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"wedfghjhgfds\",\"notes\":\"sdfghhgfdsdfghjkjhyuioutreefgh\",\"terms\":\"dfghjkhgfdsdfghjklhgfdsdfghjkhjgff\",\"overall_discount\":\"100\",\"created_by_id\":3,\"status\":\"Draft\",\"main_cost_centers_id\":\"4\",\"sub_cost_centers_id\":\"3\",\"updated_at\":\"2025-12-02 10:43:00\",\"created_at\":\"2025-12-02 10:43:00\",\"id\":21,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-12-02 05:13:00', '2025-12-02 05:13:00'),
(322, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":4,\"updated_at\":\"2025-12-02 10:43:00\"}', '127.0.0.1', '2025-12-02 05:13:00', '2025-12-02 05:13:00'),
(323, 'audit:created', 22, 'App\\Models\\ProformaInvoice#22', 3, '{\"delivery_challan_number\":\"DC-20251202111220759\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251202-0002\",\"docket_no\":\"12345678654\",\"po_date\":\"2025-12-02\",\"due_date\":\"2025-12-02\",\"e_way_bill_no\":\"234567898765\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"sdfghjkjhgfd\",\"notes\":\"wertyhj\",\"terms\":\"sdfghm\",\"overall_discount\":\"0\",\"subtotal\":\"2542.37\",\"tax\":\"457.63\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"REcPD33kSQLYdgO5G86rimCXV5d8piIyCi4mdSGN\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_centers_id\\\":\\\"4\\\",\\\"sub_cost_centers_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251202-0002\\\",\\\"docket_no\\\":\\\"12345678654\\\",\\\"po_date\\\":\\\"2025-12-02\\\",\\\"due_date\\\":\\\"2025-12-02\\\",\\\"e_way_bill_no\\\":\\\"234567898765\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"sdfghjkjhgfd\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"18\\\",\\\"amount\\\":\\\"3000.00\\\"}],\\\"notes\\\":\\\"wertyhj\\\",\\\"terms\\\":\\\"sdfghm\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2542.37\\\",\\\"tax\\\":\\\"457.63\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\",\\\"attachment\\\":{}}\",\"status\":\"Draft\",\"updated_at\":\"2025-12-02 11:12:20\",\"created_at\":\"2025-12-02 11:12:20\",\"id\":22,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-12-02 05:42:20', '2025-12-02 05:42:20'),
(324, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":3,\"updated_at\":\"2025-12-02 11:12:21\"}', '127.0.0.1', '2025-12-02 05:42:21', '2025-12-02 05:42:21'),
(325, 'audit:created', 23, 'App\\Models\\ProformaInvoice#23', 3, '{\"delivery_challan_number\":\"DC-20251202113512619\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251202-0002\",\"docket_no\":\"98765\",\"po_date\":\"2025-12-02\",\"due_date\":\"2025-12-02\",\"e_way_bill_no\":\"4567\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"ertyui\",\"notes\":\"qwerthj\",\"terms\":\"wertyui\",\"overall_discount\":\"100\",\"subtotal\":\"2542.37\",\"tax\":\"457.63\",\"discount\":\"100.00\",\"total\":\"2900.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"REcPD33kSQLYdgO5G86rimCXV5d8piIyCi4mdSGN\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_centers_id\\\":\\\"4\\\",\\\"sub_cost_centers_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251202-0002\\\",\\\"docket_no\\\":\\\"98765\\\",\\\"po_date\\\":\\\"2025-12-02\\\",\\\"due_date\\\":\\\"2025-12-02\\\",\\\"e_way_bill_no\\\":\\\"4567\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"ertyui\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"18\\\",\\\"amount\\\":\\\"3000.00\\\"}],\\\"notes\\\":\\\"qwerthj\\\",\\\"terms\\\":\\\"wertyui\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"2542.37\\\",\\\"tax\\\":\\\"457.63\\\",\\\"discount\\\":\\\"100.00\\\",\\\"total\\\":\\\"2900.00\\\",\\\"attachment\\\":{}}\",\"status\":\"Draft\",\"updated_at\":\"2025-12-02 11:35:12\",\"created_at\":\"2025-12-02 11:35:12\",\"id\":23,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-12-02 06:05:12', '2025-12-02 06:05:12'),
(326, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":2,\"updated_at\":\"2025-12-02 11:35:14\"}', '127.0.0.1', '2025-12-02 06:05:14', '2025-12-02 06:05:14');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES
(327, 'audit:created', 19, 'App\\Models\\SaleInvoice#19', 3, '{\"sale_invoice_number\":\"ET-20251202114220322\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251202-0002\",\"docket_no\":\"98765\",\"po_date\":\"2025-12-02\",\"due_date\":\"2025-12-02 00:00:00\",\"e_way_bill_no\":\"4567\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"ertyui\",\"notes\":\"qwerthj\",\"terms\":\"wertyui\",\"overall_discount\":\"100\",\"subtotal\":\"2542.37\",\"tax\":\"457.63\",\"discount\":\"100.00\",\"total\":\"2900.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"REcPD33kSQLYdgO5G86rimCXV5d8piIyCi4mdSGN\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"po_no\\\":\\\"PO-20251202-0002\\\",\\\"docket_no\\\":\\\"98765\\\",\\\"po_date\\\":\\\"2025-12-02\\\",\\\"due_date\\\":\\\"2025-12-02\\\",\\\"e_way_bill_no\\\":\\\"4567\\\",\\\"phone_number\\\":\\\"9229779459\\\",\\\"billing_address\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address\\\":\\\"ertyui\\\",\\\"notes\\\":\\\"qwerthj\\\",\\\"terms\\\":\\\"wertyui\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"2542.37\\\",\\\"tax\\\":\\\"457.63\\\",\\\"discount\\\":\\\"100.00\\\",\\\"total\\\":\\\"2900.00\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"description\\\":null,\\\"qty\\\":\\\"1\\\",\\\"unit\\\":null,\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"18\\\",\\\"amount\\\":\\\"3000.00\\\",\\\"json_data\\\":\\\"{\\\\\\\"add_item_id\\\\\\\":\\\\\\\"22\\\\\\\",\\\\\\\"qty\\\\\\\":\\\\\\\"1\\\\\\\",\\\\\\\"price\\\\\\\":\\\\\\\"3000.00\\\\\\\",\\\\\\\"discount_type\\\\\\\":\\\\\\\"value\\\\\\\",\\\\\\\"discount\\\\\\\":\\\\\\\"0\\\\\\\",\\\\\\\"tax_type\\\\\\\":\\\\\\\"with\\\\\\\",\\\\\\\"tax\\\\\\\":\\\\\\\"18\\\\\\\",\\\\\\\"amount\\\\\\\":\\\\\\\"3000.00\\\\\\\"}\\\"}]}\",\"status\":\"Pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"updated_at\":\"2025-12-02 11:42:20\",\"created_at\":\"2025-12-02 11:42:20\",\"id\":19,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-12-02 06:12:20', '2025-12-02 06:12:20'),
(328, 'audit:updated', 23, 'App\\Models\\ProformaInvoice#23', 3, '{\"status\":\"Converted\",\"updated_at\":\"2025-12-02 11:42:20\"}', '127.0.0.1', '2025-12-02 06:12:20', '2025-12-02 06:12:20'),
(329, 'audit:updated', 19, 'App\\Models\\SaleInvoice#19', 3, '{\"updated_at\":\"2025-12-02 11:47:41\",\"status\":\"Approved\"}', '127.0.0.1', '2025-12-02 06:17:41', '2025-12-02 06:17:41'),
(330, 'audit:updated', 3, 'App\\Models\\User#3', 3, '{\"remember_token\":\"CG1OzlQNZIQ6LkmwiprkXjKacuqjLuuMnhYspCR4KLhIKmZqQyDtA1cSD2sL\"}', '127.0.0.1', '2025-12-03 04:19:36', '2025-12-03 04:19:36'),
(331, 'audit:updated', 1, 'App\\Models\\User#1', 1, '{\"remember_token\":\"42SYVc3Dg17mDn9vk18gbPBuEqlsftiSs4X12CVHnJhkxwIujw3JxarstLSm\"}', '127.0.0.1', '2025-12-03 04:21:59', '2025-12-03 04:21:59'),
(332, 'audit:updated', 3, 'App\\Models\\User#3', 3, '{\"remember_token\":\"x0OmlhEOYPysPgnoUn5iLjXBXrVqbZjzLpd6RDz4S3DJ1z7xYeKqzjUDt0Wx\"}', '127.0.0.1', '2025-12-03 04:34:54', '2025-12-03 04:34:54'),
(333, 'audit:updated', 2, 'App\\Models\\AddBusiness#2', 1, '{\"updated_at\":\"2025-12-03 10:08:39\",\"gst_number\":\"10AQFPK9218D1ZA\",\"phone_number\":\"8863897163\",\"email\":\"ajayfilliptect@gmail.com\",\"address\":\"Patna , Bihar , Rk Bhatacharya Road, Patna , Bihar , Rk Bhatacharya Road, Patna, Bihar 800001, India, Phone: 7857868055\"}', '127.0.0.1', '2025-12-03 04:38:39', '2025-12-03 04:38:39'),
(334, 'audit:updated', 1, 'App\\Models\\User#1', 1, '{\"remember_token\":\"Z69QBazLYo2gvVIPDbmsbzTFblr9JSdLE55TXZXhuHKQNeIKhvJOOHnB1V6c\"}', '127.0.0.1', '2025-12-03 04:40:43', '2025-12-03 04:40:43'),
(335, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":3,\"updated_at\":\"2025-12-03 11:03:02\"}', '127.0.0.1', '2025-12-03 05:33:02', '2025-12-03 05:33:02'),
(336, 'audit:updated', 14, 'App\\Models\\CurrentStock#14', 3, '{\"qty\":5,\"updated_at\":\"2025-12-03 11:03:02\"}', '127.0.0.1', '2025-12-03 05:33:02', '2025-12-03 05:33:02'),
(337, 'audit:updated', 15, 'App\\Models\\CurrentStock#15', 3, '{\"qty\":5,\"updated_at\":\"2025-12-03 11:03:02\"}', '127.0.0.1', '2025-12-03 05:33:02', '2025-12-03 05:33:02'),
(338, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":4,\"updated_at\":\"2025-12-03 11:06:43\"}', '127.0.0.1', '2025-12-03 05:36:43', '2025-12-03 05:36:43'),
(339, 'audit:updated', 14, 'App\\Models\\CurrentStock#14', 3, '{\"qty\":10,\"updated_at\":\"2025-12-03 11:06:43\"}', '127.0.0.1', '2025-12-03 05:36:43', '2025-12-03 05:36:43'),
(340, 'audit:updated', 15, 'App\\Models\\CurrentStock#15', 3, '{\"qty\":10,\"updated_at\":\"2025-12-03 11:06:43\"}', '127.0.0.1', '2025-12-03 05:36:43', '2025-12-03 05:36:43'),
(341, 'audit:updated', 22, 'App\\Models\\ProformaInvoice#22', 3, '{\"status\":\"DC Returned\",\"updated_at\":\"2025-12-03 11:06:43\"}', '127.0.0.1', '2025-12-03 05:36:43', '2025-12-03 05:36:43'),
(342, 'audit:created', 1, 'App\\Models\\EstimateQuotation#1', 3, '{\"estimate_quotations_number\":\"EST-20251209112509432\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251209-0001\",\"po_date\":\"2025-12-09\",\"due_date\":\"2025-12-09\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"1234567890\",\"notes\":\"asdfghjkl\",\"overall_discount\":\"100\",\"subtotal\":\"25761.86\",\"tax\":\"4637.14\",\"discount\":\"100.00\",\"total\":\"30299.00\",\"created_by_id\":3,\"main_cost_centers_id\":\"4\",\"sub_cost_centers_id\":\"4\",\"updated_at\":\"2025-12-09 11:25:09\",\"created_at\":\"2025-12-09 11:25:09\",\"id\":1,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-12-09 05:55:09', '2025-12-09 05:55:09'),
(343, 'audit:created', 2, 'App\\Models\\EstimateQuotation#2', 3, '{\"estimate_quotations_number\":\"EST-20251210083027786\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251210-0001\",\"po_date\":\"2025-12-10\",\"due_date\":\"2025-12-10\",\"billing_address\":\"Patna vatacharya road kamla market 2nd floor\",\"shipping_address\":\"Patna vatacharya road kamla market 2nd floor\",\"notes\":\"this is estimate quatition bill\",\"overall_discount\":\"200\",\"subtotal\":\"4001.69\",\"tax\":\"720.31\",\"discount\":\"200.00\",\"total\":\"4522.00\",\"created_by_id\":3,\"main_cost_centers_id\":\"1\",\"sub_cost_centers_id\":\"2\",\"updated_at\":\"2025-12-10 08:30:27\",\"created_at\":\"2025-12-10 08:30:27\",\"id\":2,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-12-10 03:00:28', '2025-12-10 03:00:28'),
(345, 'audit:created', 21, 'App\\Models\\SaleInvoice#21', 3, '{\"sale_invoice_number\":\"SI-20251210120813157\",\"payment_type\":\"credit\",\"select_customer_id\":4,\"po_no\":\"PO-20251210-0001\",\"po_date\":\"2025-12-10\",\"due_date\":\"2025-12-10 00:00:00\",\"billing_address\":\"Patna vatacharya road kamla market 2nd floor\",\"shipping_address\":\"Patna vatacharya road kamla market 2nd floor\",\"subtotal\":\"4001.69\",\"tax\":\"720.31\",\"discount\":\"200.00\",\"overall_discount\":\"200\",\"total\":\"4522.00\",\"status\":\"converted from estimate\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"2\",\"created_by_id\":3,\"json_data\":\"{\\\"id\\\":2,\\\"estimate_quotations_number\\\":\\\"EST-20251210083027786\\\",\\\"phone_number\\\":null,\\\"e_way_bill_no\\\":null,\\\"billing_address\\\":\\\"Patna vatacharya road kamla market 2nd floor\\\",\\\"shipping_address\\\":\\\"Patna vatacharya road kamla market 2nd floor\\\",\\\"po_no\\\":\\\"PO-20251210-0001\\\",\\\"po_date\\\":\\\"2025-12-10\\\",\\\"qty\\\":null,\\\"sub_cost_centers_id\\\":\\\"2\\\",\\\"main_cost_centers_id\\\":\\\"1\\\",\\\"description\\\":null,\\\"created_at\\\":\\\"2025-12-10 08:30:27\\\",\\\"updated_at\\\":\\\"2025-12-10 08:30:27\\\",\\\"deleted_at\\\":null,\\\"select_customer_id\\\":4,\\\"created_by_id\\\":3,\\\"due_date\\\":\\\"2025-12-10\\\",\\\"status\\\":null,\\\"docket_no\\\":null,\\\"terms\\\":null,\\\"notes\\\":\\\"this is estimate quatition bill\\\",\\\"overall_discount\\\":\\\"200\\\",\\\"tax_amount\\\":null,\\\"adjustment\\\":null,\\\"round_off\\\":null,\\\"total\\\":\\\"4522.00\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"subtotal\\\":\\\"4001.69\\\",\\\"tax\\\":\\\"720.31\\\",\\\"discount\\\":\\\"200.00\\\",\\\"json_data\\\":null,\\\"image\\\":null,\\\"document\\\":{\\\"id\\\":21,\\\"model_type\\\":\\\"App\\\\\\\\Models\\\\\\\\EstimateQuotation\\\",\\\"model_id\\\":2,\\\"uuid\\\":\\\"5cb383dd-c5e5-495c-ae24-0a5840a8dac2\\\",\\\"collection_name\\\":\\\"document\\\",\\\"name\\\":\\\"profit-loss-18\\\",\\\"file_name\\\":\\\"profit-loss-18.pdf\\\",\\\"mime_type\\\":\\\"application\\\\\\/pdf\\\",\\\"disk\\\":\\\"public\\\",\\\"conversions_disk\\\":\\\"public\\\",\\\"size\\\":92014,\\\"manipulations\\\":[],\\\"custom_properties\\\":[],\\\"generated_conversions\\\":[],\\\"responsive_images\\\":[],\\\"order_column\\\":1,\\\"created_at\\\":\\\"2025-12-10T08:30:30.000000Z\\\",\\\"updated_at\\\":\\\"2025-12-10T08:30:30.000000Z\\\",\\\"original_url\\\":\\\"http:\\\\\\/\\\\\\/127.0.0.1:8000\\\\\\/storage\\\\\\/21\\\\\\/profit-loss-18.pdf\\\",\\\"preview_url\\\":\\\"\\\"},\\\"media\\\":[{\\\"id\\\":21,\\\"model_type\\\":\\\"App\\\\\\\\Models\\\\\\\\EstimateQuotation\\\",\\\"model_id\\\":2,\\\"uuid\\\":\\\"5cb383dd-c5e5-495c-ae24-0a5840a8dac2\\\",\\\"collection_name\\\":\\\"document\\\",\\\"name\\\":\\\"profit-loss-18\\\",\\\"file_name\\\":\\\"profit-loss-18.pdf\\\",\\\"mime_type\\\":\\\"application\\\\\\/pdf\\\",\\\"disk\\\":\\\"public\\\",\\\"conversions_disk\\\":\\\"public\\\",\\\"size\\\":92014,\\\"manipulations\\\":[],\\\"custom_properties\\\":[],\\\"generated_conversions\\\":[],\\\"responsive_images\\\":[],\\\"order_column\\\":1,\\\"created_at\\\":\\\"2025-12-10T08:30:30.000000Z\\\",\\\"updated_at\\\":\\\"2025-12-10T08:30:30.000000Z\\\",\\\"original_url\\\":\\\"http:\\\\\\/\\\\\\/127.0.0.1:8000\\\\\\/storage\\\\\\/21\\\\\\/profit-loss-18.pdf\\\",\\\"preview_url\\\":\\\"\\\"}]}\",\"updated_at\":\"2025-12-10 12:08:13\",\"created_at\":\"2025-12-10 12:08:13\",\"id\":21,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-12-10 06:38:13', '2025-12-10 06:38:13'),
(346, 'audit:updated', 21, 'App\\Models\\CurrentStock#21', 3, '{\"qty\":9,\"updated_at\":\"2025-12-10 12:08:13\"}', '127.0.0.1', '2025-12-10 06:38:13', '2025-12-10 06:38:13'),
(347, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":3,\"updated_at\":\"2025-12-10 12:08:13\"}', '127.0.0.1', '2025-12-10 06:38:13', '2025-12-10 06:38:13'),
(348, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"updated_at\":\"2025-12-10 12:08:13\",\"current_balance\":5600}', '127.0.0.1', '2025-12-10 06:38:13', '2025-12-10 06:38:13'),
(349, 'audit:created', 22, 'App\\Models\\SaleInvoice#22', 3, '{\"sale_invoice_number\":\"SI-20251211063328162\",\"payment_type\":\"credit\",\"select_customer_id\":4,\"po_no\":\"PO-20251210-0001\",\"po_date\":\"2025-12-10\",\"due_date\":\"2025-12-10 00:00:00\",\"billing_address\":\"Patna vatacharya road kamla market 2nd floor\",\"shipping_address\":\"Patna vatacharya road kamla market 2nd floor\",\"subtotal\":\"4001.69\",\"tax\":\"720.31\",\"discount\":\"200.00\",\"overall_discount\":\"200\",\"total\":\"4522.00\",\"status\":\"converted from estimate\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"2\",\"created_by_id\":3,\"json_data\":\"{\\\"id\\\":2,\\\"estimate_quotations_number\\\":\\\"EST-20251210083027786\\\",\\\"phone_number\\\":null,\\\"e_way_bill_no\\\":null,\\\"billing_address\\\":\\\"Patna vatacharya road kamla market 2nd floor\\\",\\\"shipping_address\\\":\\\"Patna vatacharya road kamla market 2nd floor\\\",\\\"po_no\\\":\\\"PO-20251210-0001\\\",\\\"po_date\\\":\\\"2025-12-10\\\",\\\"qty\\\":null,\\\"sub_cost_centers_id\\\":\\\"2\\\",\\\"main_cost_centers_id\\\":\\\"1\\\",\\\"description\\\":null,\\\"created_at\\\":\\\"2025-12-10 08:30:27\\\",\\\"updated_at\\\":\\\"2025-12-10 08:30:27\\\",\\\"deleted_at\\\":null,\\\"select_customer_id\\\":4,\\\"created_by_id\\\":3,\\\"due_date\\\":\\\"2025-12-10\\\",\\\"status\\\":null,\\\"docket_no\\\":null,\\\"terms\\\":null,\\\"notes\\\":\\\"this is estimate quatition bill\\\",\\\"overall_discount\\\":\\\"200\\\",\\\"tax_amount\\\":null,\\\"adjustment\\\":null,\\\"round_off\\\":null,\\\"total\\\":\\\"4522.00\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"subtotal\\\":\\\"4001.69\\\",\\\"tax\\\":\\\"720.31\\\",\\\"discount\\\":\\\"200.00\\\",\\\"json_data\\\":null,\\\"image\\\":null,\\\"document\\\":{\\\"id\\\":21,\\\"model_type\\\":\\\"App\\\\\\\\Models\\\\\\\\EstimateQuotation\\\",\\\"model_id\\\":2,\\\"uuid\\\":\\\"5cb383dd-c5e5-495c-ae24-0a5840a8dac2\\\",\\\"collection_name\\\":\\\"document\\\",\\\"name\\\":\\\"profit-loss-18\\\",\\\"file_name\\\":\\\"profit-loss-18.pdf\\\",\\\"mime_type\\\":\\\"application\\\\\\/pdf\\\",\\\"disk\\\":\\\"public\\\",\\\"conversions_disk\\\":\\\"public\\\",\\\"size\\\":92014,\\\"manipulations\\\":[],\\\"custom_properties\\\":[],\\\"generated_conversions\\\":[],\\\"responsive_images\\\":[],\\\"order_column\\\":1,\\\"created_at\\\":\\\"2025-12-10T08:30:30.000000Z\\\",\\\"updated_at\\\":\\\"2025-12-10T08:30:30.000000Z\\\",\\\"original_url\\\":\\\"http:\\\\\\/\\\\\\/127.0.0.1:8000\\\\\\/storage\\\\\\/21\\\\\\/profit-loss-18.pdf\\\",\\\"preview_url\\\":\\\"\\\"},\\\"media\\\":[{\\\"id\\\":21,\\\"model_type\\\":\\\"App\\\\\\\\Models\\\\\\\\EstimateQuotation\\\",\\\"model_id\\\":2,\\\"uuid\\\":\\\"5cb383dd-c5e5-495c-ae24-0a5840a8dac2\\\",\\\"collection_name\\\":\\\"document\\\",\\\"name\\\":\\\"profit-loss-18\\\",\\\"file_name\\\":\\\"profit-loss-18.pdf\\\",\\\"mime_type\\\":\\\"application\\\\\\/pdf\\\",\\\"disk\\\":\\\"public\\\",\\\"conversions_disk\\\":\\\"public\\\",\\\"size\\\":92014,\\\"manipulations\\\":[],\\\"custom_properties\\\":[],\\\"generated_conversions\\\":[],\\\"responsive_images\\\":[],\\\"order_column\\\":1,\\\"created_at\\\":\\\"2025-12-10T08:30:30.000000Z\\\",\\\"updated_at\\\":\\\"2025-12-10T08:30:30.000000Z\\\",\\\"original_url\\\":\\\"http:\\\\\\/\\\\\\/127.0.0.1:8000\\\\\\/storage\\\\\\/21\\\\\\/profit-loss-18.pdf\\\",\\\"preview_url\\\":\\\"\\\"}]}\",\"updated_at\":\"2025-12-11 06:33:28\",\"created_at\":\"2025-12-11 06:33:28\",\"id\":22,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-12-11 01:03:28', '2025-12-11 01:03:28'),
(350, 'audit:updated', 21, 'App\\Models\\CurrentStock#21', 3, '{\"qty\":8,\"updated_at\":\"2025-12-11 06:33:28\"}', '127.0.0.1', '2025-12-11 01:03:28', '2025-12-11 01:03:28'),
(351, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":2,\"updated_at\":\"2025-12-11 06:33:28\"}', '127.0.0.1', '2025-12-11 01:03:28', '2025-12-11 01:03:28'),
(352, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"updated_at\":\"2025-12-11 06:33:28\",\"current_balance\":10122}', '127.0.0.1', '2025-12-11 01:03:28', '2025-12-11 01:03:28'),
(353, 'audit:created', 23, 'App\\Models\\SaleInvoice#23', 3, '{\"sale_invoice_number\":\"SI-20251211070952250\",\"payment_type\":\"credit\",\"select_customer_id\":4,\"po_no\":\"PO-20251210-0001\",\"po_date\":\"2025-12-10\",\"due_date\":\"2025-12-10 00:00:00\",\"billing_address\":\"Patna vatacharya road kamla market 2nd floor\",\"shipping_address\":\"Patna vatacharya road kamla market 2nd floor\",\"notes\":\"this is estimate quatition bill\",\"terms\":null,\"subtotal\":\"4001.69\",\"tax\":\"720.31\",\"discount\":\"200.00\",\"overall_discount\":\"200\",\"total\":\"4522.00\",\"status\":\"converted from estimate\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"2\",\"created_by_id\":3,\"json_data\":\"{\\\"estimate_id\\\":2,\\\"estimate_no\\\":\\\"EST-20251210083027786\\\",\\\"customer_id\\\":4,\\\"subtotal\\\":\\\"4001.69\\\",\\\"tax\\\":\\\"720.31\\\",\\\"discount\\\":\\\"200.00\\\",\\\"total\\\":\\\"4522.00\\\"}\",\"updated_at\":\"2025-12-11 07:09:52\",\"created_at\":\"2025-12-11 07:09:52\",\"id\":23,\"image\":null,\"document\":null,\"media\":[]}', '127.0.0.1', '2025-12-11 01:39:52', '2025-12-11 01:39:52'),
(354, 'audit:updated', 21, 'App\\Models\\CurrentStock#21', 3, '{\"qty\":7,\"updated_at\":\"2025-12-11 07:09:52\"}', '127.0.0.1', '2025-12-11 01:39:52', '2025-12-11 01:39:52'),
(355, 'audit:updated', 16, 'App\\Models\\CurrentStock#16', 3, '{\"qty\":1,\"updated_at\":\"2025-12-11 07:09:52\"}', '127.0.0.1', '2025-12-11 01:39:52', '2025-12-11 01:39:52'),
(356, 'audit:updated', 4, 'App\\Models\\PartyDetail#4', 3, '{\"updated_at\":\"2025-12-11 07:09:52\",\"current_balance\":14644}', '127.0.0.1', '2025-12-11 01:39:52', '2025-12-11 01:39:52'),
(357, 'audit:updated', 2, 'App\\Models\\EstimateQuotation#2', 3, '{\"updated_at\":\"2025-12-11 07:09:52\",\"status\":\"converted\",\"converted_sale_invoice_id\":23}', '127.0.0.1', '2025-12-11 01:39:52', '2025-12-11 01:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `opening_balance` varchar(255) NOT NULL,
  `as_of_date` date DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `ifsc_code` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `account_holder_name` varchar(255) DEFAULT NULL,
  `upi` varchar(255) DEFAULT NULL,
  `print_upi_qr` tinyint(1) DEFAULT 0,
  `print_bank_details` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `opening_balance_type` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `account_name`, `opening_balance`, `as_of_date`, `account_number`, `ifsc_code`, `bank_name`, `account_holder_name`, `upi`, `print_upi_qr`, `print_bank_details`, `created_at`, `updated_at`, `deleted_at`, `created_by_id`, `opening_balance_type`) VALUES
(1, 'Ferdinand English', 'Enim voluptatem qui', '1975-02-25', '198', 'Voluptatem sequi rep', 'Noelle Shaw', 'Tiger Reynolds', 'Quia tempore enim r', 1, 0, '2025-09-20 01:40:24', '2025-09-20 01:40:24', NULL, NULL, NULL),
(2, 'Jonas Dunn', '4000', '2001-05-18', '8863897163', 'AIRP0000001', 'Airtel Payments Bank', 'Ajay Mehta', 'Quia vero beatae dol', 0, 0, '2025-11-01 03:13:34', '2025-11-04 02:39:33', '2025-11-04 02:39:33', 4, NULL),
(3, 'Cash Account', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2025-11-01 04:44:50', '2025-11-01 04:45:07', '2025-11-01 04:45:07', 4, NULL),
(4, 'Airtel Bank', '4819', '2025-11-04', '12212342343434', 'punb0089600', 'Punjab National Bank', 'ak', NULL, 1, 1, '2025-11-04 03:55:53', '2025-11-08 02:09:32', NULL, 3, 'debit'),
(5, 'PNB', '2342', '2025-11-04', '13243546466', 'AIRP0000001', 'Airtel Payments Bank', 'Ajay Mehta', NULL, 0, 0, '2025-11-04 03:59:01', '2025-11-05 03:00:30', NULL, 4, NULL),
(6, 'Airtel Bank', '1000', '2025-11-08', '13243546466', 'AIRP0000001', 'Airtel Payments Bank', 'Ajay Mehta', NULL, 1, 1, '2025-11-08 05:27:20', '2025-11-08 05:27:20', NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bank_to_banks`
--

CREATE TABLE `bank_to_banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `adjustment_date` date DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `from_id` bigint(20) UNSIGNED DEFAULT NULL,
  `to_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_to_cashes`
--

CREATE TABLE `bank_to_cashes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `to` varchar(255) DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `adjustment_date` date DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `from_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_transactions`
--

CREATE TABLE `bank_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `party_id` bigint(20) UNSIGNED NOT NULL,
  `party_name` varchar(255) DEFAULT NULL,
  `opening_balance_type` enum('Debit','Credit') DEFAULT NULL,
  `current_balance` decimal(15,2) DEFAULT NULL,
  `current_balance_type` enum('Debit','Credit') DEFAULT NULL,
  `payment_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `payment_in_id` text DEFAULT NULL,
  `opening_balance` text DEFAULT NULL,
  `json` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_transactions`
--

INSERT INTO `bank_transactions` (`id`, `party_id`, `party_name`, `opening_balance_type`, `current_balance`, `current_balance_type`, `payment_type_id`, `amount`, `created_by_id`, `updated_by_id`, `description`, `created_at`, `updated_at`, `deleted_at`, `payment_in_id`, `opening_balance`, `json`) VALUES
(1, 4, 'Sade Holden', NULL, 4201.00, 'Debit', 4, 4000.00, 3, 3, NULL, '2025-11-08 01:19:37', '2025-11-08 01:19:37', NULL, '4', '12', '{\"payment_in\":{\"parties_id\":\"4\",\"payment_type_id\":\"4\",\"date\":\"2025-11-08\",\"reference_no\":\"wqfcac\",\"amount\":\"4000\",\"discount\":null,\"total\":\"4000.00\",\"description\":null,\"created_by_id\":3,\"updated_by_id\":3,\"updated_at\":\"2025-11-08 06:49:37\",\"created_at\":\"2025-11-08 06:49:37\",\"id\":4,\"attechment\":null,\"media\":[],\"parties\":{\"id\":4,\"party_name\":\"Sade Holden\",\"gstin\":\"121212121212121\",\"phone_number\":\"9229779459\",\"pan_number\":\"7941111111\",\"place_of_supply\":\"Eos vel facilis cons\",\"type_of_supply\":\"Intra-State\",\"gst_type\":\"Registered_Business_Composition\",\"pin_code\":null,\"state\":\"Et quia aliqua Expe\",\"city\":\"Consequat Omnis qua\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"email\":\"vijicupigu@mailinator.com\",\"opening_balance\":\"1.00\",\"as_of_date\":\"1987-09-15\",\"opening_balance_type\":\"Debit\",\"credit_limit\":\"off\",\"credit_limit_amount\":null,\"payment_terms\":\"Voluptatum mollitia\",\"ifsc_code\":\"Sit dolore ut maxim\",\"account_number\":\"4092343243432\",\"bank_name\":\"Phelan Hurley\",\"branch\":\"Accusantium numquam\",\"notes\":\"Id eos est voluptas\",\"status\":\"enable\",\"created_at\":\"2025-10-14 09:57:33\",\"updated_at\":\"2025-11-07 10:13:06\",\"deleted_at\":null,\"created_by_id\":3,\"current_balance\":\"4201\",\"current_balance_type\":\"Debit\"},\"payment_type\":{\"id\":4,\"account_name\":\"Airtel Bank\",\"opening_balance\":\"12\",\"as_of_date\":\"2025-11-04\",\"account_number\":\"12212342343434\",\"ifsc_code\":\"punb0089600\",\"bank_name\":\"Punjab National Bank\",\"account_holder_name\":\"ak\",\"upi\":null,\"print_upi_qr\":1,\"print_bank_details\":1,\"created_at\":\"2025-11-04 09:25:53\",\"updated_at\":\"2025-11-05 08:30:24\",\"deleted_at\":null,\"created_by_id\":3,\"opening_balance_type\":null,\"upi_qr\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"media\":[{\"id\":13,\"model_type\":\"App\\\\Models\\\\BankAccount\",\"model_id\":4,\"uuid\":\"70153cec-cf3a-4d43-a7b2-eac67e43d62b\",\"collection_name\":\"upi_qr\",\"name\":\"WhatsApp Image 2025-11-04 at 17.41.13_48027b0d\",\"file_name\":\"WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"mime_type\":\"image\\/jpeg\",\"disk\":\"public\",\"conversions_disk\":\"public\",\"size\":98859,\"manipulations\":[],\"custom_properties\":[],\"generated_conversions\":{\"thumb\":true,\"preview\":true},\"responsive_images\":[],\"order_column\":1,\"created_at\":\"2025-11-05T08:29:37.000000Z\",\"updated_at\":\"2025-11-05T08:29:38.000000Z\",\"original_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"preview_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/conversions\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d-preview.jpg\"}]}},\"party\":{\"id\":4,\"party_name\":\"Sade Holden\",\"gstin\":\"121212121212121\",\"phone_number\":\"9229779459\",\"pan_number\":\"7941111111\",\"place_of_supply\":\"Eos vel facilis cons\",\"type_of_supply\":\"Intra-State\",\"gst_type\":\"Registered_Business_Composition\",\"pin_code\":null,\"state\":\"Et quia aliqua Expe\",\"city\":\"Consequat Omnis qua\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"email\":\"vijicupigu@mailinator.com\",\"opening_balance\":\"1.00\",\"as_of_date\":\"1987-09-15\",\"opening_balance_type\":\"Debit\",\"credit_limit\":\"off\",\"credit_limit_amount\":null,\"payment_terms\":\"Voluptatum mollitia\",\"ifsc_code\":\"Sit dolore ut maxim\",\"account_number\":\"4092343243432\",\"bank_name\":\"Phelan Hurley\",\"branch\":\"Accusantium numquam\",\"notes\":\"Id eos est voluptas\",\"status\":\"enable\",\"created_at\":\"2025-10-14 09:57:33\",\"updated_at\":\"2025-11-07 10:13:06\",\"deleted_at\":null,\"created_by_id\":3,\"current_balance\":\"4201\",\"current_balance_type\":\"Debit\"},\"bank\":{\"id\":4,\"account_name\":\"Airtel Bank\",\"opening_balance\":\"12\",\"as_of_date\":\"2025-11-04\",\"account_number\":\"12212342343434\",\"ifsc_code\":\"punb0089600\",\"bank_name\":\"Punjab National Bank\",\"account_holder_name\":\"ak\",\"upi\":null,\"print_upi_qr\":1,\"print_bank_details\":1,\"created_at\":\"2025-11-04 09:25:53\",\"updated_at\":\"2025-11-05 08:30:24\",\"deleted_at\":null,\"created_by_id\":3,\"opening_balance_type\":null,\"upi_qr\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"media\":[{\"id\":13,\"model_type\":\"App\\\\Models\\\\BankAccount\",\"model_id\":4,\"uuid\":\"70153cec-cf3a-4d43-a7b2-eac67e43d62b\",\"collection_name\":\"upi_qr\",\"name\":\"WhatsApp Image 2025-11-04 at 17.41.13_48027b0d\",\"file_name\":\"WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"mime_type\":\"image\\/jpeg\",\"disk\":\"public\",\"conversions_disk\":\"public\",\"size\":98859,\"manipulations\":[],\"custom_properties\":[],\"generated_conversions\":{\"thumb\":true,\"preview\":true},\"responsive_images\":[],\"order_column\":1,\"created_at\":\"2025-11-05T08:29:37.000000Z\",\"updated_at\":\"2025-11-05T08:29:38.000000Z\",\"original_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"preview_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/conversions\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d-preview.jpg\"}]},\"user\":{\"id\":3,\"name\":\"MSV\",\"email\":\"msv@gmail.com\"}}'),
(2, 4, 'Sade Holden', 'Debit', 8201.00, 'Debit', 4, 201.00, 3, 3, 'scsd', '2025-11-08 01:33:31', '2025-11-08 01:33:31', NULL, '5', '4012', '{\"payment_in\":{\"parties_id\":\"4\",\"payment_type_id\":\"4\",\"date\":\"2025-11-08\",\"reference_no\":\"uhsfjhe88\",\"amount\":\"201\",\"discount\":null,\"total\":\"201.00\",\"description\":\"scsd\",\"created_by_id\":3,\"updated_by_id\":3,\"updated_at\":\"2025-11-08 07:03:31\",\"created_at\":\"2025-11-08 07:03:31\",\"id\":5,\"attechment\":null,\"media\":[],\"parties\":{\"id\":4,\"party_name\":\"Sade Holden\",\"gstin\":\"121212121212121\",\"phone_number\":\"9229779459\",\"pan_number\":\"7941111111\",\"place_of_supply\":\"Eos vel facilis cons\",\"type_of_supply\":\"Intra-State\",\"gst_type\":\"Registered_Business_Composition\",\"pin_code\":null,\"state\":\"Et quia aliqua Expe\",\"city\":\"Consequat Omnis qua\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"email\":\"vijicupigu@mailinator.com\",\"opening_balance\":\"1.00\",\"as_of_date\":\"1987-09-15\",\"opening_balance_type\":\"Debit\",\"credit_limit\":\"off\",\"credit_limit_amount\":null,\"payment_terms\":\"Voluptatum mollitia\",\"ifsc_code\":\"Sit dolore ut maxim\",\"account_number\":\"4092343243432\",\"bank_name\":\"Phelan Hurley\",\"branch\":\"Accusantium numquam\",\"notes\":\"Id eos est voluptas\",\"status\":\"enable\",\"created_at\":\"2025-10-14 09:57:33\",\"updated_at\":\"2025-11-08 06:49:37\",\"deleted_at\":null,\"created_by_id\":3,\"current_balance\":\"8201\",\"current_balance_type\":\"Debit\"},\"payment_type\":{\"id\":4,\"account_name\":\"Airtel Bank\",\"opening_balance\":\"4012\",\"as_of_date\":\"2025-11-04\",\"account_number\":\"12212342343434\",\"ifsc_code\":\"punb0089600\",\"bank_name\":\"Punjab National Bank\",\"account_holder_name\":\"ak\",\"upi\":null,\"print_upi_qr\":1,\"print_bank_details\":1,\"created_at\":\"2025-11-04 09:25:53\",\"updated_at\":\"2025-11-08 06:49:37\",\"deleted_at\":null,\"created_by_id\":3,\"opening_balance_type\":\"debit\",\"upi_qr\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"media\":[{\"id\":13,\"model_type\":\"App\\\\Models\\\\BankAccount\",\"model_id\":4,\"uuid\":\"70153cec-cf3a-4d43-a7b2-eac67e43d62b\",\"collection_name\":\"upi_qr\",\"name\":\"WhatsApp Image 2025-11-04 at 17.41.13_48027b0d\",\"file_name\":\"WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"mime_type\":\"image\\/jpeg\",\"disk\":\"public\",\"conversions_disk\":\"public\",\"size\":98859,\"manipulations\":[],\"custom_properties\":[],\"generated_conversions\":{\"thumb\":true,\"preview\":true},\"responsive_images\":[],\"order_column\":1,\"created_at\":\"2025-11-05T08:29:37.000000Z\",\"updated_at\":\"2025-11-05T08:29:38.000000Z\",\"original_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"preview_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/conversions\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d-preview.jpg\"}]}},\"party\":{\"id\":4,\"party_name\":\"Sade Holden\",\"gstin\":\"121212121212121\",\"phone_number\":\"9229779459\",\"pan_number\":\"7941111111\",\"place_of_supply\":\"Eos vel facilis cons\",\"type_of_supply\":\"Intra-State\",\"gst_type\":\"Registered_Business_Composition\",\"pin_code\":null,\"state\":\"Et quia aliqua Expe\",\"city\":\"Consequat Omnis qua\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"email\":\"vijicupigu@mailinator.com\",\"opening_balance\":\"1.00\",\"as_of_date\":\"1987-09-15\",\"opening_balance_type\":\"Debit\",\"credit_limit\":\"off\",\"credit_limit_amount\":null,\"payment_terms\":\"Voluptatum mollitia\",\"ifsc_code\":\"Sit dolore ut maxim\",\"account_number\":\"4092343243432\",\"bank_name\":\"Phelan Hurley\",\"branch\":\"Accusantium numquam\",\"notes\":\"Id eos est voluptas\",\"status\":\"enable\",\"created_at\":\"2025-10-14 09:57:33\",\"updated_at\":\"2025-11-08 06:49:37\",\"deleted_at\":null,\"created_by_id\":3,\"current_balance\":\"8201\",\"current_balance_type\":\"Debit\"},\"bank\":{\"id\":4,\"account_name\":\"Airtel Bank\",\"opening_balance\":\"4012\",\"as_of_date\":\"2025-11-04\",\"account_number\":\"12212342343434\",\"ifsc_code\":\"punb0089600\",\"bank_name\":\"Punjab National Bank\",\"account_holder_name\":\"ak\",\"upi\":null,\"print_upi_qr\":1,\"print_bank_details\":1,\"created_at\":\"2025-11-04 09:25:53\",\"updated_at\":\"2025-11-08 06:49:37\",\"deleted_at\":null,\"created_by_id\":3,\"opening_balance_type\":\"debit\",\"upi_qr\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"media\":[{\"id\":13,\"model_type\":\"App\\\\Models\\\\BankAccount\",\"model_id\":4,\"uuid\":\"70153cec-cf3a-4d43-a7b2-eac67e43d62b\",\"collection_name\":\"upi_qr\",\"name\":\"WhatsApp Image 2025-11-04 at 17.41.13_48027b0d\",\"file_name\":\"WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"mime_type\":\"image\\/jpeg\",\"disk\":\"public\",\"conversions_disk\":\"public\",\"size\":98859,\"manipulations\":[],\"custom_properties\":[],\"generated_conversions\":{\"thumb\":true,\"preview\":true},\"responsive_images\":[],\"order_column\":1,\"created_at\":\"2025-11-05T08:29:37.000000Z\",\"updated_at\":\"2025-11-05T08:29:38.000000Z\",\"original_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"preview_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/conversions\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d-preview.jpg\"}]},\"user\":{\"id\":3,\"name\":\"MSV\",\"email\":\"msv@gmail.com\"}}'),
(3, 4, 'Sade Holden', 'Debit', 8402.00, 'Debit', 4, 402.00, 3, 3, NULL, '2025-11-08 01:35:29', '2025-11-08 01:35:29', NULL, '6', '4213', '{\"payment_in\":{\"parties_id\":\"4\",\"payment_type_id\":\"4\",\"date\":\"2025-11-08\",\"reference_no\":\"uhsfjhe88\",\"amount\":\"402\",\"discount\":null,\"total\":\"402.00\",\"description\":null,\"created_by_id\":3,\"updated_by_id\":3,\"updated_at\":\"2025-11-08 07:05:29\",\"created_at\":\"2025-11-08 07:05:29\",\"id\":6,\"attechment\":null,\"media\":[],\"parties\":{\"id\":4,\"party_name\":\"Sade Holden\",\"gstin\":\"121212121212121\",\"phone_number\":\"9229779459\",\"pan_number\":\"7941111111\",\"place_of_supply\":\"Eos vel facilis cons\",\"type_of_supply\":\"Intra-State\",\"gst_type\":\"Registered_Business_Composition\",\"pin_code\":null,\"state\":\"Et quia aliqua Expe\",\"city\":\"Consequat Omnis qua\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"email\":\"vijicupigu@mailinator.com\",\"opening_balance\":\"1.00\",\"as_of_date\":\"1987-09-15\",\"opening_balance_type\":\"Debit\",\"credit_limit\":\"off\",\"credit_limit_amount\":null,\"payment_terms\":\"Voluptatum mollitia\",\"ifsc_code\":\"Sit dolore ut maxim\",\"account_number\":\"4092343243432\",\"bank_name\":\"Phelan Hurley\",\"branch\":\"Accusantium numquam\",\"notes\":\"Id eos est voluptas\",\"status\":\"enable\",\"created_at\":\"2025-10-14 09:57:33\",\"updated_at\":\"2025-11-08 07:03:31\",\"deleted_at\":null,\"created_by_id\":3,\"current_balance\":\"8402\",\"current_balance_type\":\"Debit\"},\"payment_type\":{\"id\":4,\"account_name\":\"Airtel Bank\",\"opening_balance\":\"4213\",\"as_of_date\":\"2025-11-04\",\"account_number\":\"12212342343434\",\"ifsc_code\":\"punb0089600\",\"bank_name\":\"Punjab National Bank\",\"account_holder_name\":\"ak\",\"upi\":null,\"print_upi_qr\":1,\"print_bank_details\":1,\"created_at\":\"2025-11-04 09:25:53\",\"updated_at\":\"2025-11-08 07:03:31\",\"deleted_at\":null,\"created_by_id\":3,\"opening_balance_type\":\"debit\",\"upi_qr\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"media\":[{\"id\":13,\"model_type\":\"App\\\\Models\\\\BankAccount\",\"model_id\":4,\"uuid\":\"70153cec-cf3a-4d43-a7b2-eac67e43d62b\",\"collection_name\":\"upi_qr\",\"name\":\"WhatsApp Image 2025-11-04 at 17.41.13_48027b0d\",\"file_name\":\"WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"mime_type\":\"image\\/jpeg\",\"disk\":\"public\",\"conversions_disk\":\"public\",\"size\":98859,\"manipulations\":[],\"custom_properties\":[],\"generated_conversions\":{\"thumb\":true,\"preview\":true},\"responsive_images\":[],\"order_column\":1,\"created_at\":\"2025-11-05T08:29:37.000000Z\",\"updated_at\":\"2025-11-05T08:29:38.000000Z\",\"original_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"preview_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/conversions\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d-preview.jpg\"}]}},\"party\":{\"id\":4,\"party_name\":\"Sade Holden\",\"gstin\":\"121212121212121\",\"phone_number\":\"9229779459\",\"pan_number\":\"7941111111\",\"place_of_supply\":\"Eos vel facilis cons\",\"type_of_supply\":\"Intra-State\",\"gst_type\":\"Registered_Business_Composition\",\"pin_code\":null,\"state\":\"Et quia aliqua Expe\",\"city\":\"Consequat Omnis qua\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"email\":\"vijicupigu@mailinator.com\",\"opening_balance\":\"1.00\",\"as_of_date\":\"1987-09-15\",\"opening_balance_type\":\"Debit\",\"credit_limit\":\"off\",\"credit_limit_amount\":null,\"payment_terms\":\"Voluptatum mollitia\",\"ifsc_code\":\"Sit dolore ut maxim\",\"account_number\":\"4092343243432\",\"bank_name\":\"Phelan Hurley\",\"branch\":\"Accusantium numquam\",\"notes\":\"Id eos est voluptas\",\"status\":\"enable\",\"created_at\":\"2025-10-14 09:57:33\",\"updated_at\":\"2025-11-08 07:03:31\",\"deleted_at\":null,\"created_by_id\":3,\"current_balance\":\"8402\",\"current_balance_type\":\"Debit\"},\"bank\":{\"id\":4,\"account_name\":\"Airtel Bank\",\"opening_balance\":\"4213\",\"as_of_date\":\"2025-11-04\",\"account_number\":\"12212342343434\",\"ifsc_code\":\"punb0089600\",\"bank_name\":\"Punjab National Bank\",\"account_holder_name\":\"ak\",\"upi\":null,\"print_upi_qr\":1,\"print_bank_details\":1,\"created_at\":\"2025-11-04 09:25:53\",\"updated_at\":\"2025-11-08 07:03:31\",\"deleted_at\":null,\"created_by_id\":3,\"opening_balance_type\":\"debit\",\"upi_qr\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"media\":[{\"id\":13,\"model_type\":\"App\\\\Models\\\\BankAccount\",\"model_id\":4,\"uuid\":\"70153cec-cf3a-4d43-a7b2-eac67e43d62b\",\"collection_name\":\"upi_qr\",\"name\":\"WhatsApp Image 2025-11-04 at 17.41.13_48027b0d\",\"file_name\":\"WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"mime_type\":\"image\\/jpeg\",\"disk\":\"public\",\"conversions_disk\":\"public\",\"size\":98859,\"manipulations\":[],\"custom_properties\":[],\"generated_conversions\":{\"thumb\":true,\"preview\":true},\"responsive_images\":[],\"order_column\":1,\"created_at\":\"2025-11-05T08:29:37.000000Z\",\"updated_at\":\"2025-11-05T08:29:38.000000Z\",\"original_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"preview_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/conversions\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d-preview.jpg\"}]},\"user\":{\"id\":3,\"name\":\"MSV\",\"email\":\"msv@gmail.com\"}}'),
(4, 4, 'Sade Holden', 'Debit', 8804.00, 'Debit', 4, 804.00, 3, 3, NULL, '2025-11-08 01:38:32', '2025-11-08 01:38:32', NULL, '7', '4615', '{\"payment_in\":{\"parties_id\":\"4\",\"payment_type_id\":\"4\",\"date\":\"2025-11-08\",\"reference_no\":\"804\",\"amount\":\"804\",\"discount\":null,\"total\":\"804.00\",\"description\":null,\"created_by_id\":3,\"updated_by_id\":3,\"updated_at\":\"2025-11-08 07:08:32\",\"created_at\":\"2025-11-08 07:08:32\",\"id\":7,\"attechment\":null,\"media\":[],\"parties\":{\"id\":4,\"party_name\":\"Sade Holden\",\"gstin\":\"121212121212121\",\"phone_number\":\"9229779459\",\"pan_number\":\"7941111111\",\"place_of_supply\":\"Eos vel facilis cons\",\"type_of_supply\":\"Intra-State\",\"gst_type\":\"Registered_Business_Composition\",\"pin_code\":null,\"state\":\"Et quia aliqua Expe\",\"city\":\"Consequat Omnis qua\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"email\":\"vijicupigu@mailinator.com\",\"opening_balance\":\"1.00\",\"as_of_date\":\"1987-09-15\",\"opening_balance_type\":\"Debit\",\"credit_limit\":\"off\",\"credit_limit_amount\":null,\"payment_terms\":\"Voluptatum mollitia\",\"ifsc_code\":\"Sit dolore ut maxim\",\"account_number\":\"4092343243432\",\"bank_name\":\"Phelan Hurley\",\"branch\":\"Accusantium numquam\",\"notes\":\"Id eos est voluptas\",\"status\":\"enable\",\"created_at\":\"2025-10-14 09:57:33\",\"updated_at\":\"2025-11-08 07:05:29\",\"deleted_at\":null,\"created_by_id\":3,\"current_balance\":\"8804\",\"current_balance_type\":\"Debit\"},\"payment_type\":{\"id\":4,\"account_name\":\"Airtel Bank\",\"opening_balance\":\"4615\",\"as_of_date\":\"2025-11-04\",\"account_number\":\"12212342343434\",\"ifsc_code\":\"punb0089600\",\"bank_name\":\"Punjab National Bank\",\"account_holder_name\":\"ak\",\"upi\":null,\"print_upi_qr\":1,\"print_bank_details\":1,\"created_at\":\"2025-11-04 09:25:53\",\"updated_at\":\"2025-11-08 07:05:29\",\"deleted_at\":null,\"created_by_id\":3,\"opening_balance_type\":\"debit\",\"upi_qr\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"media\":[{\"id\":13,\"model_type\":\"App\\\\Models\\\\BankAccount\",\"model_id\":4,\"uuid\":\"70153cec-cf3a-4d43-a7b2-eac67e43d62b\",\"collection_name\":\"upi_qr\",\"name\":\"WhatsApp Image 2025-11-04 at 17.41.13_48027b0d\",\"file_name\":\"WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"mime_type\":\"image\\/jpeg\",\"disk\":\"public\",\"conversions_disk\":\"public\",\"size\":98859,\"manipulations\":[],\"custom_properties\":[],\"generated_conversions\":{\"thumb\":true,\"preview\":true},\"responsive_images\":[],\"order_column\":1,\"created_at\":\"2025-11-05T08:29:37.000000Z\",\"updated_at\":\"2025-11-05T08:29:38.000000Z\",\"original_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"preview_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/conversions\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d-preview.jpg\"}]}},\"party\":{\"id\":4,\"party_name\":\"Sade Holden\",\"gstin\":\"121212121212121\",\"phone_number\":\"9229779459\",\"pan_number\":\"7941111111\",\"place_of_supply\":\"Eos vel facilis cons\",\"type_of_supply\":\"Intra-State\",\"gst_type\":\"Registered_Business_Composition\",\"pin_code\":null,\"state\":\"Et quia aliqua Expe\",\"city\":\"Consequat Omnis qua\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"email\":\"vijicupigu@mailinator.com\",\"opening_balance\":\"1.00\",\"as_of_date\":\"1987-09-15\",\"opening_balance_type\":\"Debit\",\"credit_limit\":\"off\",\"credit_limit_amount\":null,\"payment_terms\":\"Voluptatum mollitia\",\"ifsc_code\":\"Sit dolore ut maxim\",\"account_number\":\"4092343243432\",\"bank_name\":\"Phelan Hurley\",\"branch\":\"Accusantium numquam\",\"notes\":\"Id eos est voluptas\",\"status\":\"enable\",\"created_at\":\"2025-10-14 09:57:33\",\"updated_at\":\"2025-11-08 07:05:29\",\"deleted_at\":null,\"created_by_id\":3,\"current_balance\":\"8804\",\"current_balance_type\":\"Debit\"},\"bank\":{\"id\":4,\"account_name\":\"Airtel Bank\",\"opening_balance\":\"4615\",\"as_of_date\":\"2025-11-04\",\"account_number\":\"12212342343434\",\"ifsc_code\":\"punb0089600\",\"bank_name\":\"Punjab National Bank\",\"account_holder_name\":\"ak\",\"upi\":null,\"print_upi_qr\":1,\"print_bank_details\":1,\"created_at\":\"2025-11-04 09:25:53\",\"updated_at\":\"2025-11-08 07:05:29\",\"deleted_at\":null,\"created_by_id\":3,\"opening_balance_type\":\"debit\",\"upi_qr\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"media\":[{\"id\":13,\"model_type\":\"App\\\\Models\\\\BankAccount\",\"model_id\":4,\"uuid\":\"70153cec-cf3a-4d43-a7b2-eac67e43d62b\",\"collection_name\":\"upi_qr\",\"name\":\"WhatsApp Image 2025-11-04 at 17.41.13_48027b0d\",\"file_name\":\"WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"mime_type\":\"image\\/jpeg\",\"disk\":\"public\",\"conversions_disk\":\"public\",\"size\":98859,\"manipulations\":[],\"custom_properties\":[],\"generated_conversions\":{\"thumb\":true,\"preview\":true},\"responsive_images\":[],\"order_column\":1,\"created_at\":\"2025-11-05T08:29:37.000000Z\",\"updated_at\":\"2025-11-05T08:29:38.000000Z\",\"original_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"preview_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/conversions\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d-preview.jpg\"}]},\"user\":{\"id\":3,\"name\":\"MSV\",\"email\":\"msv@gmail.com\"}}'),
(5, 4, 'Sade Holden', NULL, NULL, NULL, 4, 608.00, 3, 3, NULL, '2025-11-08 01:41:13', '2025-11-08 01:41:13', NULL, '8', NULL, '{\"payment_in\":{\"parties_id\":\"4\",\"payment_type_id\":\"4\",\"date\":\"2025-11-08\",\"reference_no\":\"wqfesc\",\"amount\":\"608\",\"discount\":null,\"total\":\"608.00\",\"description\":null,\"created_by_id\":3,\"updated_by_id\":3,\"updated_at\":\"2025-11-08 07:11:13\",\"created_at\":\"2025-11-08 07:11:13\",\"id\":8,\"attechment\":null,\"media\":[],\"parties\":{\"id\":4,\"party_name\":\"Sade Holden\",\"gstin\":\"121212121212121\",\"phone_number\":\"9229779459\",\"pan_number\":\"7941111111\",\"place_of_supply\":\"Eos vel facilis cons\",\"type_of_supply\":\"Intra-State\",\"gst_type\":\"Registered_Business_Composition\",\"pin_code\":null,\"state\":\"Et quia aliqua Expe\",\"city\":\"Consequat Omnis qua\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"email\":\"vijicupigu@mailinator.com\",\"opening_balance\":\"1.00\",\"as_of_date\":\"1987-09-15\",\"opening_balance_type\":\"Debit\",\"credit_limit\":\"off\",\"credit_limit_amount\":null,\"payment_terms\":\"Voluptatum mollitia\",\"ifsc_code\":\"Sit dolore ut maxim\",\"account_number\":\"4092343243432\",\"bank_name\":\"Phelan Hurley\",\"branch\":\"Accusantium numquam\",\"notes\":\"Id eos est voluptas\",\"status\":\"enable\",\"created_at\":\"2025-10-14 09:57:33\",\"updated_at\":\"2025-11-08 07:08:32\",\"deleted_at\":null,\"created_by_id\":3,\"current_balance\":\"9608\",\"current_balance_type\":\"Debit\"},\"payment_type\":{\"id\":4,\"account_name\":\"Airtel Bank\",\"opening_balance\":\"3811\",\"as_of_date\":\"2025-11-04\",\"account_number\":\"12212342343434\",\"ifsc_code\":\"punb0089600\",\"bank_name\":\"Punjab National Bank\",\"account_holder_name\":\"ak\",\"upi\":null,\"print_upi_qr\":1,\"print_bank_details\":1,\"created_at\":\"2025-11-04 09:25:53\",\"updated_at\":\"2025-11-08 07:08:32\",\"deleted_at\":null,\"created_by_id\":3,\"opening_balance_type\":\"debit\",\"upi_qr\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"media\":[{\"id\":13,\"model_type\":\"App\\\\Models\\\\BankAccount\",\"model_id\":4,\"uuid\":\"70153cec-cf3a-4d43-a7b2-eac67e43d62b\",\"collection_name\":\"upi_qr\",\"name\":\"WhatsApp Image 2025-11-04 at 17.41.13_48027b0d\",\"file_name\":\"WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"mime_type\":\"image\\/jpeg\",\"disk\":\"public\",\"conversions_disk\":\"public\",\"size\":98859,\"manipulations\":[],\"custom_properties\":[],\"generated_conversions\":{\"thumb\":true,\"preview\":true},\"responsive_images\":[],\"order_column\":1,\"created_at\":\"2025-11-05T08:29:37.000000Z\",\"updated_at\":\"2025-11-05T08:29:38.000000Z\",\"original_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"preview_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/conversions\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d-preview.jpg\"}]}},\"party\":{\"id\":4,\"party_name\":\"Sade Holden\",\"gstin\":\"121212121212121\",\"phone_number\":\"9229779459\",\"pan_number\":\"7941111111\",\"place_of_supply\":\"Eos vel facilis cons\",\"type_of_supply\":\"Intra-State\",\"gst_type\":\"Registered_Business_Composition\",\"pin_code\":null,\"state\":\"Et quia aliqua Expe\",\"city\":\"Consequat Omnis qua\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"email\":\"vijicupigu@mailinator.com\",\"opening_balance\":\"1.00\",\"as_of_date\":\"1987-09-15\",\"opening_balance_type\":\"Debit\",\"credit_limit\":\"off\",\"credit_limit_amount\":null,\"payment_terms\":\"Voluptatum mollitia\",\"ifsc_code\":\"Sit dolore ut maxim\",\"account_number\":\"4092343243432\",\"bank_name\":\"Phelan Hurley\",\"branch\":\"Accusantium numquam\",\"notes\":\"Id eos est voluptas\",\"status\":\"enable\",\"created_at\":\"2025-10-14 09:57:33\",\"updated_at\":\"2025-11-08 07:08:32\",\"deleted_at\":null,\"created_by_id\":3,\"current_balance\":\"9608\",\"current_balance_type\":\"Debit\"},\"bank\":{\"id\":4,\"account_name\":\"Airtel Bank\",\"opening_balance\":\"3811\",\"as_of_date\":\"2025-11-04\",\"account_number\":\"12212342343434\",\"ifsc_code\":\"punb0089600\",\"bank_name\":\"Punjab National Bank\",\"account_holder_name\":\"ak\",\"upi\":null,\"print_upi_qr\":1,\"print_bank_details\":1,\"created_at\":\"2025-11-04 09:25:53\",\"updated_at\":\"2025-11-08 07:08:32\",\"deleted_at\":null,\"created_by_id\":3,\"opening_balance_type\":\"debit\",\"upi_qr\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"media\":[{\"id\":13,\"model_type\":\"App\\\\Models\\\\BankAccount\",\"model_id\":4,\"uuid\":\"70153cec-cf3a-4d43-a7b2-eac67e43d62b\",\"collection_name\":\"upi_qr\",\"name\":\"WhatsApp Image 2025-11-04 at 17.41.13_48027b0d\",\"file_name\":\"WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"mime_type\":\"image\\/jpeg\",\"disk\":\"public\",\"conversions_disk\":\"public\",\"size\":98859,\"manipulations\":[],\"custom_properties\":[],\"generated_conversions\":{\"thumb\":true,\"preview\":true},\"responsive_images\":[],\"order_column\":1,\"created_at\":\"2025-11-05T08:29:37.000000Z\",\"updated_at\":\"2025-11-05T08:29:38.000000Z\",\"original_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"preview_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/conversions\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d-preview.jpg\"}]},\"user\":{\"id\":3,\"name\":\"MSV\",\"email\":\"msv@gmail.com\"}}'),
(6, 4, 'Sade Holden', NULL, NULL, NULL, 4, 400.00, 3, 3, NULL, '2025-11-08 02:09:32', '2025-11-08 02:09:32', NULL, '9', NULL, '{\"payment_in\":{\"parties_id\":\"4\",\"payment_type_id\":\"4\",\"date\":\"2025-11-08\",\"reference_no\":null,\"amount\":\"400\",\"discount\":null,\"total\":\"400.00\",\"description\":null,\"created_by_id\":3,\"updated_by_id\":3,\"updated_at\":\"2025-11-08 07:39:32\",\"created_at\":\"2025-11-08 07:39:32\",\"id\":9,\"attechment\":null,\"media\":[],\"parties\":{\"id\":4,\"party_name\":\"Sade Holden\",\"gstin\":\"121212121212121\",\"phone_number\":\"9229779459\",\"pan_number\":\"7941111111\",\"place_of_supply\":\"Eos vel facilis cons\",\"type_of_supply\":\"Intra-State\",\"gst_type\":\"Registered_Business_Composition\",\"pin_code\":null,\"state\":\"Et quia aliqua Expe\",\"city\":\"Consequat Omnis qua\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"email\":\"vijicupigu@mailinator.com\",\"opening_balance\":\"1.00\",\"as_of_date\":\"1987-09-15\",\"opening_balance_type\":\"Debit\",\"credit_limit\":\"off\",\"credit_limit_amount\":null,\"payment_terms\":\"Voluptatum mollitia\",\"ifsc_code\":\"Sit dolore ut maxim\",\"account_number\":\"4092343243432\",\"bank_name\":\"Phelan Hurley\",\"branch\":\"Accusantium numquam\",\"notes\":\"Id eos est voluptas\",\"status\":\"enable\",\"created_at\":\"2025-10-14 09:57:33\",\"updated_at\":\"2025-11-08 07:11:14\",\"deleted_at\":null,\"created_by_id\":3,\"current_balance\":\"9000\",\"current_balance_type\":\"Debit\"},\"payment_type\":{\"id\":4,\"account_name\":\"Airtel Bank\",\"opening_balance\":\"4419\",\"as_of_date\":\"2025-11-04\",\"account_number\":\"12212342343434\",\"ifsc_code\":\"punb0089600\",\"bank_name\":\"Punjab National Bank\",\"account_holder_name\":\"ak\",\"upi\":null,\"print_upi_qr\":1,\"print_bank_details\":1,\"created_at\":\"2025-11-04 09:25:53\",\"updated_at\":\"2025-11-08 07:11:13\",\"deleted_at\":null,\"created_by_id\":3,\"opening_balance_type\":\"debit\",\"upi_qr\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"media\":[{\"id\":13,\"model_type\":\"App\\\\Models\\\\BankAccount\",\"model_id\":4,\"uuid\":\"70153cec-cf3a-4d43-a7b2-eac67e43d62b\",\"collection_name\":\"upi_qr\",\"name\":\"WhatsApp Image 2025-11-04 at 17.41.13_48027b0d\",\"file_name\":\"WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"mime_type\":\"image\\/jpeg\",\"disk\":\"public\",\"conversions_disk\":\"public\",\"size\":98859,\"manipulations\":[],\"custom_properties\":[],\"generated_conversions\":{\"thumb\":true,\"preview\":true},\"responsive_images\":[],\"order_column\":1,\"created_at\":\"2025-11-05T08:29:37.000000Z\",\"updated_at\":\"2025-11-05T08:29:38.000000Z\",\"original_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"preview_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/conversions\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d-preview.jpg\"}]}},\"party\":{\"id\":4,\"party_name\":\"Sade Holden\",\"gstin\":\"121212121212121\",\"phone_number\":\"9229779459\",\"pan_number\":\"7941111111\",\"place_of_supply\":\"Eos vel facilis cons\",\"type_of_supply\":\"Intra-State\",\"gst_type\":\"Registered_Business_Composition\",\"pin_code\":null,\"state\":\"Et quia aliqua Expe\",\"city\":\"Consequat Omnis qua\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"email\":\"vijicupigu@mailinator.com\",\"opening_balance\":\"1.00\",\"as_of_date\":\"1987-09-15\",\"opening_balance_type\":\"Debit\",\"credit_limit\":\"off\",\"credit_limit_amount\":null,\"payment_terms\":\"Voluptatum mollitia\",\"ifsc_code\":\"Sit dolore ut maxim\",\"account_number\":\"4092343243432\",\"bank_name\":\"Phelan Hurley\",\"branch\":\"Accusantium numquam\",\"notes\":\"Id eos est voluptas\",\"status\":\"enable\",\"created_at\":\"2025-10-14 09:57:33\",\"updated_at\":\"2025-11-08 07:11:14\",\"deleted_at\":null,\"created_by_id\":3,\"current_balance\":\"9000\",\"current_balance_type\":\"Debit\"},\"bank\":{\"id\":4,\"account_name\":\"Airtel Bank\",\"opening_balance\":\"4419\",\"as_of_date\":\"2025-11-04\",\"account_number\":\"12212342343434\",\"ifsc_code\":\"punb0089600\",\"bank_name\":\"Punjab National Bank\",\"account_holder_name\":\"ak\",\"upi\":null,\"print_upi_qr\":1,\"print_bank_details\":1,\"created_at\":\"2025-11-04 09:25:53\",\"updated_at\":\"2025-11-08 07:11:13\",\"deleted_at\":null,\"created_by_id\":3,\"opening_balance_type\":\"debit\",\"upi_qr\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"media\":[{\"id\":13,\"model_type\":\"App\\\\Models\\\\BankAccount\",\"model_id\":4,\"uuid\":\"70153cec-cf3a-4d43-a7b2-eac67e43d62b\",\"collection_name\":\"upi_qr\",\"name\":\"WhatsApp Image 2025-11-04 at 17.41.13_48027b0d\",\"file_name\":\"WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"mime_type\":\"image\\/jpeg\",\"disk\":\"public\",\"conversions_disk\":\"public\",\"size\":98859,\"manipulations\":[],\"custom_properties\":[],\"generated_conversions\":{\"thumb\":true,\"preview\":true},\"responsive_images\":[],\"order_column\":1,\"created_at\":\"2025-11-05T08:29:37.000000Z\",\"updated_at\":\"2025-11-05T08:29:38.000000Z\",\"original_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg\",\"preview_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/13\\/conversions\\/WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d-preview.jpg\"}]},\"user\":{\"id\":3,\"name\":\"MSV\",\"email\":\"msv@gmail.com\"}}');

-- --------------------------------------------------------

--
-- Table structure for table `cash_in_hands`
--

CREATE TABLE `cash_in_hands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `opening_balance` decimal(15,2) DEFAULT NULL,
  `as_of_date` date DEFAULT NULL,
  `account_number` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ifsc_code` text DEFAULT NULL,
  `bank_name` text DEFAULT NULL,
  `account_holder_name` text DEFAULT NULL,
  `status` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cash_in_hands`
--

INSERT INTO `cash_in_hands` (`id`, `account_name`, `opening_balance`, `as_of_date`, `account_number`, `created_at`, `updated_at`, `deleted_at`, `created_by_id`, `ifsc_code`, `bank_name`, `account_holder_name`, `status`) VALUES
(1, 'Cash Account', 0.00, NULL, NULL, '2025-11-01 04:46:43', '2025-11-01 04:46:43', NULL, 4, NULL, NULL, NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `cash_to_banks`
--

CREATE TABLE `cash_to_banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` varchar(255) DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `adjustment_date` date DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `to_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`, `created_by_id`) VALUES
(1, 'Accesories', '2025-09-01 04:45:20', '2025-09-01 04:45:20', NULL, NULL),
(2, 'GPS', '2025-10-14 04:45:44', '2025-10-14 04:45:44', NULL, 2),
(3, 'Asscorise', '2025-10-15 02:01:23', '2025-10-15 02:01:23', NULL, 3),
(4, 'Row Matrial', '2025-10-15 02:03:40', '2025-10-15 02:03:40', NULL, 3),
(5, 'Raw Matrial Of Andoride', '2025-11-03 01:13:32', '2025-11-03 01:13:32', NULL, 5),
(6, 'Accesories', '2025-11-04 00:54:16', '2025-11-04 02:39:54', '2025-11-04 02:39:54', 4);

-- --------------------------------------------------------

--
-- Table structure for table `current_stocks`
--

CREATE TABLE `current_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `json_data` text DEFAULT NULL,
  `item_id` text DEFAULT NULL,
  `product_type` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `current_stocks`
--

INSERT INTO `current_stocks` (`id`, `qty`, `type`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `created_by_id`, `json_data`, `item_id`, `product_type`) VALUES
(6, '677', 'Opening Stock', '2025-09-09 03:13:41', '2025-10-09 08:16:53', NULL, 1, 1, '{\"item_type\":\"product\",\"unit_id\":\"1\",\"select_category\":\"1\",\"quantity\":\"4\",\"item_code\":\"ITM-6258-8965\",\"pricing\":{\"sale_price\":\"1500\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"select_tax_id\":\"1\"},\"wholesale\":{\"wholesale_price\":\"1200\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"10\"},\"purchase\":{\"purchase_price\":\"1000\",\"select_purchase_type\":\"Without Tax\"},\"stock\":{\"opening_stock\":\"10\",\"low_stock_warning\":\"1\",\"warehouse_location\":\"kamla market\"},\"online\":{\"title\":\"EEMOTRACK INDIA\",\"description\":\"Zcx e 4gregg34 erg 4egr\"}}', '7', NULL),
(7, '207', 'Opening Stock', '2025-09-09 03:35:43', '2025-10-07 04:23:54', NULL, 1, 1, '{\"item_type\":\"product\",\"unit_id\":\"1\",\"select_category\":\"1\",\"quantity\":\"18\",\"item_code\":\"ITM-3825-6054\",\"pricing\":{\"sale_price\":\"3600\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"select_tax_id\":\"1\"},\"wholesale\":{\"wholesale_price\":\"3000\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"100\"},\"purchase\":{\"purchase_price\":\"1000\",\"select_purchase_type\":\"Without Tax\"},\"stock\":{\"opening_stock\":\"100\",\"low_stock_warning\":\"10\",\"warehouse_location\":\"kamla market\"},\"online\":{\"title\":\"EEMOTRACK INDIA\",\"description\":\" 2q r2 3e er 3f we f 2f cf 2rf \"}}', NULL, NULL),
(8, '420', 'Opening Stock', '2025-10-04 02:57:06', '2025-10-09 08:16:53', NULL, 1, 1, '{\"item_type\":\"product\",\"unit_id\":\"1\",\"select_category\":\"1\",\"quantity\":\"481\",\"item_code\":\"ITM-3354-0915\",\"pricing\":{\"sale_price\":\"969\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"138\",\"disc_type\":\"percentage\",\"select_tax_id\":\"1\"},\"wholesale\":{\"wholesale_price\":\"234352\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"42\"},\"purchase\":{\"purchase_price\":\"5454\",\"select_purchase_type\":\"Without Tax\"},\"stock\":{\"opening_stock\":\"435\",\"low_stock_warning\":\"53\",\"warehouse_location\":\"34\"},\"online\":{\"title\":null,\"description\":null}}', '11', NULL),
(14, '10', 'Opening Stock', '2025-10-15 06:06:36', '2025-12-03 05:36:43', NULL, 1, 3, '{\"_token\":\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\",\"item_type\":\"product\",\"product_type\":\"raw_material\",\"item_name\":\"Andoride Box\",\"item_hsn\":\"dsver\",\"select_unit_id\":\"4\",\"select_category\":[\"4\"],\"quantity\":\"18\",\"item_code\":\"ITM-7362-9293\",\"sale_price\":\"100\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"select_tax_id\":null,\"wholesale_price\":\"80\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"10\",\"purchase_price\":\"50\",\"select_purchase_type\":\"Without Tax\",\"opening_stock\":\"18\",\"low_stock_warning\":\"1\",\"warehouse_location\":\"kamla market\",\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"quantity\\\":\\\"18\\\"}\"}', '20', 'raw_material'),
(15, '10', 'Opening Stock', '2025-10-15 06:07:50', '2025-12-03 05:36:43', NULL, 1, 3, '{\"_token\":\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\",\"item_type\":\"product\",\"product_type\":\"raw_material\",\"item_name\":\"Andoride Reelay\",\"item_hsn\":\"AKUYG434\",\"select_unit_id\":\"4\",\"select_category\":[\"4\"],\"quantity\":\"18\",\"item_code\":\"ITM-8937-3458\",\"sale_price\":\"100\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"select_tax_id\":null,\"wholesale_price\":\"80\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"10\",\"purchase_price\":\"50\",\"select_purchase_type\":\"Without Tax\",\"opening_stock\":\"18\",\"low_stock_warning\":\"1\",\"warehouse_location\":\"kamla market\",\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"quantity\\\":\\\"18\\\"}\"}', '21', 'raw_material'),
(16, '1', 'Manufactured Stock', '2025-10-16 01:48:36', '2025-12-11 01:39:52', NULL, 1, 3, '{\"_token\":\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\",\"item_type\":\"product\",\"product_type\":\"finished_goods\",\"item_name\":\"Andoride Basic\",\"item_hsn\":\"AHUYG435\",\"select_unit_id\":\"3\",\"select_category\":[\"3\"],\"quantity\":\"5\",\"item_code\":\"ITM-5609-7631\",\"sale_price\":\"3000\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"select_tax_id\":null,\"wholesale_price\":\"2500\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"10\",\"purchase_price\":\"2000\",\"select_purchase_type\":\"Without Tax\",\"opening_stock\":\"5\",\"low_stock_warning\":\"1\",\"warehouse_location\":\"kamla market\",\"online_store_title\":null,\"online_store_description\":null,\"select_raw_materials\":[\"20\",\"21\",\"9\"],\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"quantity\\\":\\\"5\\\"}\"}', '22', 'finished_goods'),
(17, '18', 'Opening Stock', '2025-10-16 02:49:35', '2025-10-16 02:49:35', NULL, 1, 3, '{\"_token\":\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\",\"item_type\":\"raw_material\",\"product_type\":\"raw_material\",\"item_name\":\"Andoride Display\",\"item_hsn\":\"AKUYG431\",\"select_unit_id\":\"4\",\"select_category\":[\"3\"],\"quantity\":\"18\",\"item_code\":\"ITM-4524-3825\",\"sale_price\":\"3000\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"select_tax_id\":null,\"wholesale_price\":\"2500\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"10\",\"purchase_price\":\"2000\",\"select_purchase_type\":\"Without Tax\",\"opening_stock\":\"18\",\"low_stock_warning\":\"1\",\"warehouse_location\":\"kamla market\",\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"quantity\\\":\\\"18\\\"}\"}', '24', 'raw_material'),
(18, '18', 'Opening Stock', '2025-11-03 01:17:08', '2025-11-03 01:17:08', NULL, 1, 5, '{\"_token\":\"ezLUyx8LO611FC0pdeNfinv7Zrdyxq5xovFM8jsI\",\"item_type\":\"raw_material\",\"product_type\":\"raw_material\",\"item_name\":\"Andoride Display\",\"item_hsn\":\"AKUYG434\",\"select_unit_id\":\"5\",\"select_category\":[\"5\"],\"quantity\":\"18\",\"item_code\":\"ITM-1597-1704\",\"sale_price\":\"120\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":null,\"disc_type\":\"percentage\",\"select_tax_id\":null,\"wholesale_price\":null,\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":null,\"purchase_price\":\"100\",\"select_purchase_type\":\"Without Tax\",\"opening_stock\":\"18\",\"low_stock_warning\":null,\"warehouse_location\":null,\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"quantity\\\":\\\"18\\\",\\\"opening_stock\\\":\\\"18\\\"}\"}', '25', 'raw_material'),
(19, '2', 'Manufactured Stock', '2025-11-03 01:43:11', '2025-11-03 01:43:11', NULL, 1, 5, '{\"_token\":\"ezLUyx8LO611FC0pdeNfinv7Zrdyxq5xovFM8jsI\",\"item_type\":\"product\",\"product_type\":\"finished_goods\",\"item_name\":\"Andoride\",\"item_hsn\":\"NEGHI89U8U9\",\"select_unit_id\":\"5\",\"select_category\":[\"5\"],\"quantity\":null,\"item_code\":\"ITM-3728-1211\",\"sale_price\":\"3000\",\"select_type\":\"With Tax\",\"disc_on_sale_price\":null,\"disc_type\":\"percentage\",\"select_tax_id\":\"7\",\"wholesale_price\":null,\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":null,\"purchase_price\":\"2000\",\"select_purchase_type\":\"Without Tax\",\"opening_stock\":null,\"low_stock_warning\":null,\"warehouse_location\":null,\"online_store_title\":null,\"online_store_description\":null,\"select_raw_materials\":[\"25\"],\"raw_qty\":{\"25\":\"2\"},\"raw_sale_price\":{\"25\":\"120\"},\"raw_purchase_price\":{\"25\":\"100\"},\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"quantity\\\":null,\\\"opening_stock\\\":null,\\\"composition_totals\\\":{\\\"total_sale_value\\\":240,\\\"total_purchase_value\\\":200}}\"}', '26', 'finished_goods'),
(20, '10', 'Opening Stock', '2025-11-04 00:55:47', '2025-11-04 00:55:47', NULL, 1, 4, '{\"_token\":\"THnUvAsOcOO0w7VNuMPxoYz6EC9WmWxDmyRoSuMT\",\"item_type\":\"raw_material\",\"product_type\":\"raw_material\",\"item_name\":\"Andoride Display\",\"item_hsn\":\"AKUYG435\",\"select_unit_id\":\"6\",\"select_category\":[\"6\"],\"quantity\":\"10\",\"item_code\":\"ITM-6659-7432\",\"sale_price\":\"200\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":null,\"disc_type\":\"percentage\",\"select_tax_id\":null,\"wholesale_price\":null,\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":null,\"purchase_price\":\"100\",\"select_purchase_type\":\"Without Tax\",\"opening_stock\":\"10\",\"low_stock_warning\":null,\"warehouse_location\":null,\"online_store_title\":null,\"online_store_description\":null,\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"quantity\\\":\\\"10\\\",\\\"opening_stock\\\":\\\"10\\\",\\\"composition_totals\\\":{\\\"total_sale_value\\\":0,\\\"total_purchase_value\\\":0}}\"}', '27', 'raw_material'),
(21, '7', 'Manufactured Stock', '2025-11-05 06:33:44', '2025-12-11 01:39:52', NULL, 1, 3, '{\"_token\":\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\",\"item_type\":\"product\",\"product_type\":\"finished_goods\",\"item_name\":\"stock check\",\"item_hsn\":\"stockcheck\",\"select_unit_id\":\"3\",\"select_category\":[\"4\"],\"quantity\":null,\"item_code\":\"ITM-6665-4176\",\"sale_price\":\"1200\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":null,\"disc_type\":\"percentage\",\"select_tax_id\":null,\"wholesale_price\":null,\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":null,\"purchase_price\":\"1000\",\"select_purchase_type\":\"Without Tax\",\"opening_stock\":null,\"low_stock_warning\":null,\"warehouse_location\":null,\"online_store_title\":null,\"online_store_description\":null,\"raw_qty\":{\"20\":\"0\",\"21\":\"0\",\"24\":\"0\",\"9\":\"0\"},\"raw_sale_price\":{\"20\":\"100\",\"21\":\"100\",\"24\":\"3000\",\"9\":\"123\"},\"raw_purchase_price\":{\"20\":\"50\",\"21\":\"50\",\"24\":\"2000\",\"9\":\"0\"},\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"quantity\\\":null,\\\"opening_stock\\\":null,\\\"composition_totals\\\":{\\\"total_sale_value\\\":0,\\\"total_purchase_value\\\":0}}\"}', '30', 'finished_goods');

-- --------------------------------------------------------

--
-- Table structure for table `estimate_quotations`
--

CREATE TABLE `estimate_quotations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estimate_quotations_number` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `e_way_bill_no` varchar(255) DEFAULT NULL,
  `billing_address` longtext DEFAULT NULL,
  `shipping_address` longtext DEFAULT NULL,
  `po_no` varchar(255) DEFAULT NULL,
  `po_date` date DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `sub_cost_centers_id` text DEFAULT NULL,
  `main_cost_centers_id` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `select_customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `due_date` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `docket_no` text DEFAULT NULL,
  `terms` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `overall_discount` text DEFAULT NULL,
  `tax_amount` text DEFAULT NULL,
  `adjustment` text DEFAULT NULL,
  `round_off` text DEFAULT NULL,
  `total` text DEFAULT NULL,
  `payment_type` text DEFAULT NULL,
  `subtotal` text DEFAULT NULL,
  `tax` text DEFAULT NULL,
  `discount` text DEFAULT NULL,
  `json_data` text DEFAULT NULL,
  `converted_sale_invoice_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `estimate_quotations`
--

INSERT INTO `estimate_quotations` (`id`, `estimate_quotations_number`, `phone_number`, `e_way_bill_no`, `billing_address`, `shipping_address`, `po_no`, `po_date`, `qty`, `sub_cost_centers_id`, `main_cost_centers_id`, `description`, `created_at`, `updated_at`, `deleted_at`, `select_customer_id`, `created_by_id`, `due_date`, `status`, `docket_no`, `terms`, `notes`, `overall_discount`, `tax_amount`, `adjustment`, `round_off`, `total`, `payment_type`, `subtotal`, `tax`, `discount`, `json_data`, `converted_sale_invoice_id`) VALUES
(1, 'EST-20251209112509432', NULL, NULL, 'Voluptatem aut moll', '1234567890', 'PO-20251209-0001', '2025-12-09', NULL, '4', '4', NULL, '2025-12-09 05:55:09', '2025-12-09 05:55:09', NULL, 4, 3, '2025-12-09', NULL, NULL, NULL, 'asdfghjkl', '100', NULL, NULL, NULL, '30299.00', 'credit', '25761.86', '4637.14', '100.00', NULL, NULL),
(2, 'EST-20251210083027786', NULL, NULL, 'Patna vatacharya road kamla market 2nd floor', 'Patna vatacharya road kamla market 2nd floor', 'PO-20251210-0001', '2025-12-10', NULL, '2', '1', NULL, '2025-12-10 03:00:27', '2025-12-11 01:39:52', NULL, 4, 3, '2025-12-10', 'converted', NULL, NULL, 'this is estimate quatition bill', '200', NULL, NULL, NULL, '4522.00', 'credit', '4001.69', '720.31', '200.00', NULL, 23);

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_category` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `expense_category`, `type`, `created_at`, `updated_at`, `deleted_at`, `created_by_id`) VALUES
(1, 'MILK', 'Liability', '2025-08-27 01:31:52', '2025-08-27 01:31:52', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `expense_lists`
--

CREATE TABLE `expense_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entry_date` date DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `tax_include` varchar(255) DEFAULT NULL,
  `notes` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `finished_goods_raw_material`
--

CREATE TABLE `finished_goods_raw_material` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `select_raw_material_id` bigint(20) UNSIGNED DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `item_hsn` varchar(255) DEFAULT NULL,
  `json_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json_data`)),
  `sale_price_at_time` text DEFAULT NULL,
  `purchase_price_at_time` text DEFAULT NULL,
  `total_sale_value` text DEFAULT NULL,
  `total_purchase_value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `finished_goods_raw_material`
--

INSERT INTO `finished_goods_raw_material` (`id`, `item_id`, `select_raw_material_id`, `qty`, `item_name`, `item_hsn`, `json_data`, `sale_price_at_time`, `purchase_price_at_time`, `total_sale_value`, `total_purchase_value`, `created_at`, `updated_at`) VALUES
(8, 22, 20, 5, 'Andoride Basic', 'AHUYG435', '{\"_token\":\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\",\"item_type\":\"product\",\"product_type\":\"finished_goods\",\"item_name\":\"Andoride Basic\",\"item_hsn\":\"AHUYG435\",\"select_unit_id\":\"3\",\"select_category\":[\"3\"],\"quantity\":\"5\",\"item_code\":\"ITM-5609-7631\",\"sale_price\":\"3000\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"select_tax_id\":null,\"wholesale_price\":\"2500\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"10\",\"purchase_price\":\"2000\",\"select_purchase_type\":\"Without Tax\",\"opening_stock\":\"5\",\"low_stock_warning\":\"1\",\"warehouse_location\":\"kamla market\",\"online_store_title\":null,\"online_store_description\":null,\"select_raw_materials\":[\"20\",\"21\",\"9\"],\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"quantity\\\":\\\"5\\\"}\"}', NULL, NULL, NULL, NULL, '2025-10-16 01:48:36', '2025-10-16 01:48:36'),
(9, 22, 21, 5, 'Andoride Basic', 'AHUYG435', '{\"_token\":\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\",\"item_type\":\"product\",\"product_type\":\"finished_goods\",\"item_name\":\"Andoride Basic\",\"item_hsn\":\"AHUYG435\",\"select_unit_id\":\"3\",\"select_category\":[\"3\"],\"quantity\":\"5\",\"item_code\":\"ITM-5609-7631\",\"sale_price\":\"3000\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"select_tax_id\":null,\"wholesale_price\":\"2500\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"10\",\"purchase_price\":\"2000\",\"select_purchase_type\":\"Without Tax\",\"opening_stock\":\"5\",\"low_stock_warning\":\"1\",\"warehouse_location\":\"kamla market\",\"online_store_title\":null,\"online_store_description\":null,\"select_raw_materials\":[\"20\",\"21\",\"9\"],\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"quantity\\\":\\\"5\\\"}\"}', NULL, NULL, NULL, NULL, '2025-10-16 01:48:36', '2025-10-16 01:48:36'),
(10, 22, 9, 5, 'Andoride Basic', 'AHUYG435', '{\"_token\":\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\",\"item_type\":\"product\",\"product_type\":\"finished_goods\",\"item_name\":\"Andoride Basic\",\"item_hsn\":\"AHUYG435\",\"select_unit_id\":\"3\",\"select_category\":[\"3\"],\"quantity\":\"5\",\"item_code\":\"ITM-5609-7631\",\"sale_price\":\"3000\",\"select_type\":\"Without Tax\",\"disc_on_sale_price\":\"10\",\"disc_type\":\"percentage\",\"select_tax_id\":null,\"wholesale_price\":\"2500\",\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":\"10\",\"purchase_price\":\"2000\",\"select_purchase_type\":\"Without Tax\",\"opening_stock\":\"5\",\"low_stock_warning\":\"1\",\"warehouse_location\":\"kamla market\",\"online_store_title\":null,\"online_store_description\":null,\"select_raw_materials\":[\"20\",\"21\",\"9\"],\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"quantity\\\":\\\"5\\\"}\"}', NULL, NULL, NULL, NULL, '2025-10-16 01:48:36', '2025-10-16 01:48:36'),
(11, 26, 25, 2, 'Andoride', 'NEGHI89U8U9', '{\"_token\":\"ezLUyx8LO611FC0pdeNfinv7Zrdyxq5xovFM8jsI\",\"item_type\":\"product\",\"product_type\":\"finished_goods\",\"item_name\":\"Andoride\",\"item_hsn\":\"NEGHI89U8U9\",\"select_unit_id\":\"5\",\"select_category\":[\"5\"],\"quantity\":null,\"item_code\":\"ITM-3728-1211\",\"sale_price\":\"3000\",\"select_type\":\"With Tax\",\"disc_on_sale_price\":null,\"disc_type\":\"percentage\",\"select_tax_id\":\"7\",\"wholesale_price\":null,\"select_type_wholesale\":\"Without Tax\",\"minimum_wholesale_qty\":null,\"purchase_price\":\"2000\",\"select_purchase_type\":\"Without Tax\",\"opening_stock\":null,\"low_stock_warning\":null,\"warehouse_location\":null,\"online_store_title\":null,\"online_store_description\":null,\"select_raw_materials\":[\"25\"],\"raw_qty\":{\"25\":\"2\"},\"raw_sale_price\":{\"25\":\"120\"},\"raw_purchase_price\":{\"25\":\"100\"},\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"quantity\\\":null,\\\"opening_stock\\\":null,\\\"composition_totals\\\":{\\\"total_sale_value\\\":240,\\\"total_purchase_value\\\":200}}\"}', '120', '100', '240', '200', '2025-11-03 01:43:11', '2025-11-03 01:43:11');

-- --------------------------------------------------------

--
-- Table structure for table `ledgers`
--

CREATE TABLE `ledgers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ledger_name` varchar(255) NOT NULL,
  `opening_balance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `expense_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `main_cost_centers`
--

CREATE TABLE `main_cost_centers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cost_center_name` varchar(255) NOT NULL,
  `unique_code` varchar(255) DEFAULT NULL,
  `details_of_cost_center` longtext DEFAULT NULL,
  `location` longtext DEFAULT NULL,
  `budget_amount` decimal(15,2) DEFAULT NULL,
  `actual_amount` decimal(15,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `link_with_company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `responsible_manager_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `main_cost_centers`
--

INSERT INTO `main_cost_centers` (`id`, `cost_center_name`, `unique_code`, `details_of_cost_center`, `location`, `budget_amount`, `actual_amount`, `start_date`, `status`, `created_at`, `updated_at`, `deleted_at`, `link_with_company_id`, `responsible_manager_id`, `created_by_id`) VALUES
(1, 'West Bangel', 'Est a iusto minim ip', '<p>FinSmartHub – Helping you make smarter money choices. Learn, plan, and manage your finances confidently.</p><p>Take charge of your financial journey with trusted tips and guidance from FinSmartHub.</p><p>Want to understand finance better? FinSmartHub brings learning resources and tools for smart money management.</p><p>From budgeting to planning – FinSmartHub is your partner in smarter financial decisions.</p><p>Discover easy-to-follow resources on financial literacy with FinSmartHub.</p>', '<p>FinSmartHub – Helping you make smarter money choices. Learn, plan, and manage your finances confidently.</p><p>Take charge of your financial journey with trusted tips and guidance from FinSmartHub.</p><p>Want to understand finance better? FinSmartHub brings learning resources and tools for smart money management.</p><p>From budgeting to planning – FinSmartHub is your partner in smarter financial decisions.</p><p>Discover easy-to-follow resources on financial literacy with FinSmartHub.</p>', 30.00, 80.00, '2024-09-07', 'active', '2025-09-22 02:25:01', '2025-09-22 02:25:41', NULL, 1, 1, NULL),
(2, 'Gujrat', 'In culpa fugit qui', '<p>qwvfewv wbverfb&nbsp;</p>', '<p>evf cverfdg evfr vc</p>', 57.00, 90.00, '2024-09-07', 'active', '2025-09-25 03:13:57', '2025-09-25 03:13:57', NULL, 1, 1, NULL),
(3, 'West Bangel', '234324', NULL, NULL, 10000.00, 20000.00, '2024-09-07', 'active', '2025-10-14 04:52:43', '2025-10-14 04:52:43', NULL, 1, 2, 2),
(4, 'Constance Briggs', 'Ea est in aut eos t', NULL, NULL, 93.00, 87.00, '2024-09-07', 'active', '2025-11-03 03:10:19', '2025-11-03 03:10:19', NULL, 2, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `collection_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `disk` varchar(255) NOT NULL,
  `conversions_disk` varchar(255) DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\PurchaseBill', 3, 'f6506aa3-bda2-4dc9-8a01-3cefc85df7b5', 'image', 'images (1)', 'images-(1).jpeg', 'image/jpeg', 'public', 'public', 4426, '[]', '[]', '{\"thumb\":true,\"preview\":true}', '[]', 1, '2025-09-25 06:08:28', '2025-09-25 06:08:33'),
(3, 'App\\Models\\PurchaseBill', 3, 'ff0f598e-6b96-429d-9140-5ab9566293cf', 'document', 'payroll_22', 'payroll_22.pdf', 'application/pdf', 'public', 'public', 878266, '[]', '[]', '[]', '[]', 2, '2025-09-25 06:08:34', '2025-09-25 06:08:34'),
(4, 'App\\Models\\PurchaseBill', 4, '72a7b7bb-a4f3-4345-aa28-cabc0b80632a', 'image', 'images (1)', 'images-(1).jpeg', 'image/jpeg', 'public', 'public', 4426, '[]', '[]', '{\"thumb\":true,\"preview\":true}', '[]', 1, '2025-09-25 06:18:10', '2025-09-25 06:18:11'),
(5, 'App\\Models\\PurchaseBill', 4, 'a78acd79-c622-489e-ae5b-bffd1c92a676', 'document', 'payroll_22', 'payroll_22.pdf', 'application/pdf', 'public', 'public', 878266, '[]', '[]', '[]', '[]', 2, '2025-09-25 06:18:11', '2025-09-25 06:18:11'),
(6, 'App\\Models\\PurchaseBill', 21, '14ff973b-b336-4349-8cb2-f33ce24d4521', 'image', 'WhatsApp Image 2025-10-05 at 15.02.42_5c1f31fa', 'WhatsApp-Image-2025-10-05-at-15.02.42_5c1f31fa.jpg', 'image/jpeg', 'public', 'public', 57803, '[]', '[]', '{\"thumb\":true,\"preview\":true}', '[]', 1, '2025-10-09 02:34:27', '2025-10-09 02:34:32'),
(7, 'App\\Models\\PurchaseBill', 21, '414b6b52-c14b-4233-bb48-b9c08d694deb', 'document', 'IMG_20251005_103941', 'IMG_20251005_103941.pdf', 'application/pdf', 'public', 'public', 221714, '[]', '[]', '[]', '[]', 2, '2025-10-09 02:34:32', '2025-10-09 02:34:32'),
(8, 'App\\Models\\SaleInvoice', 11, '57f7b15c-af1a-44a7-b546-5056fffba0b9', 'document', 'images (2)', 'images-(2).jpeg', 'image/jpeg', 'public', 'public', 8378, '[]', '[]', '{\"thumb\":true,\"preview\":true}', '[]', 1, '2025-10-09 03:49:02', '2025-10-09 03:49:03'),
(9, 'App\\Models\\SaleInvoice', 12, '8ae772d8-f679-4662-9d72-8608ac8986e3', 'document', 'img', 'img.png', 'image/png', 'public', 'public', 253432, '[]', '[]', '{\"thumb\":true,\"preview\":true}', '[]', 1, '2025-10-09 03:54:16', '2025-10-09 03:54:16'),
(10, 'App\\Models\\AddBusiness', 2, 'f9445830-a96f-4946-bd4c-6c1762ca8a29', 'logo_upload', '6909ede249ae4_msv-logo', '6909ede249ae4_msv-logo.png', 'image/png', 'public', 'public', 93508, '[]', '[]', '{\"thumb\":true,\"preview\":true}', '[]', 1, '2025-11-04 06:43:26', '2025-11-04 06:43:30'),
(11, 'App\\Models\\AddBusiness', 1, '3c23d35f-2a19-4ee6-9308-1d9fbbf1cac8', 'logo_upload', '6909ee002d8be_logo', '6909ee002d8be_logo.png', 'image/png', 'public', 'public', 57921, '[]', '[]', '{\"thumb\":true,\"preview\":true}', '[]', 1, '2025-11-04 06:43:53', '2025-11-04 06:43:54'),
(12, 'App\\Models\\BankAccount', 5, '345c36ef-11f8-4a6b-906b-3bb52f25a625', 'upi_qr', 'WhatsApp Image 2025-11-04 at 17.41.13_48027b0d', 'WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg', 'image/jpeg', 'public', 'public', 98859, '[]', '[]', '{\"thumb\":true,\"preview\":true}', '[]', 1, '2025-11-05 02:33:52', '2025-11-05 02:33:58'),
(13, 'App\\Models\\BankAccount', 4, '70153cec-cf3a-4d43-a7b2-eac67e43d62b', 'upi_qr', 'WhatsApp Image 2025-11-04 at 17.41.13_48027b0d', 'WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg', 'image/jpeg', 'public', 'public', 98859, '[]', '[]', '{\"thumb\":true,\"preview\":true}', '[]', 1, '2025-11-05 02:59:37', '2025-11-05 02:59:38'),
(14, 'App\\Models\\ProformaInvoice', 18, '45ca2805-82f5-48dd-8d8b-856c09209ec0', 'document', 'WhatsApp Image 2025-11-04 at 17.41.13_48027b0d', 'WhatsApp-Image-2025-11-04-at-17.41.13_48027b0d.jpg', 'image/jpeg', 'public', 'public', 98859, '[]', '[]', '{\"thumb\":true,\"preview\":true}', '[]', 1, '2025-12-02 05:03:45', '2025-12-02 05:03:47'),
(15, 'App\\Models\\ProformaInvoice', 19, '725bcf8d-3b7b-4809-a2a7-645b66f857f8', 'document', 'profit-loss-18', 'profit-loss-18.pdf', 'application/pdf', 'public', 'public', 92014, '[]', '[]', '[]', '[]', 1, '2025-12-02 05:08:08', '2025-12-02 05:08:08'),
(16, 'App\\Models\\ProformaInvoice', 20, '6d74e6fa-412a-4cd8-8671-e8fe33ce31ce', 'document', 'profit-loss-18', 'profit-loss-18.pdf', 'application/pdf', 'public', 'public', 92014, '[]', '[]', '[]', '[]', 1, '2025-12-02 05:11:27', '2025-12-02 05:11:27'),
(17, 'App\\Models\\ProformaInvoice', 21, 'cf4be178-16e2-4cf4-ad1d-6a8220205ddf', 'document', 'profit-loss-18', 'profit-loss-18.pdf', 'application/pdf', 'public', 'public', 92014, '[]', '[]', '[]', '[]', 1, '2025-12-02 05:13:00', '2025-12-02 05:13:00'),
(18, 'App\\Models\\ProformaInvoice', 22, '4df7cb0b-8501-472a-a6da-5169b13d1144', 'document', 'map-of-india-vector', 'map-of-india-vector.jpg', 'image/jpeg', 'public', 'public', 14096, '[]', '[]', '{\"thumb\":true,\"preview\":true}', '[]', 1, '2025-12-02 05:42:20', '2025-12-02 05:42:21'),
(19, 'App\\Models\\ProformaInvoice', 23, 'c1d41bc1-a2a3-4d1a-a695-ccbd38fb5ba9', 'document', 'profit-loss-18', 'profit-loss-18.pdf', 'application/pdf', 'public', 'public', 92014, '[]', '[]', '[]', '[]', 1, '2025-12-02 06:05:14', '2025-12-02 06:05:14'),
(20, 'App\\Models\\EstimateQuotation', 1, '00f860a1-eba2-4942-a4ee-b33900a6ec6d', 'document', 'Screenshot 2025-12-03 131035', 'Screenshot-2025-12-03-131035.png', 'image/png', 'public', 'public', 147496, '[]', '[]', '{\"thumb\":true,\"preview\":true}', '[]', 1, '2025-12-09 05:55:13', '2025-12-09 05:55:21'),
(21, 'App\\Models\\EstimateQuotation', 2, '5cb383dd-c5e5-495c-ae24-0a5840a8dac2', 'document', 'profit-loss-18', 'profit-loss-18.pdf', 'application/pdf', 'public', 'public', 92014, '[]', '[]', '[]', '[]', 1, '2025-12-10 03:00:30', '2025-12-10 03:00:30');

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
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2025_08_26_000001_create_audit_logs_table', 1),
(4, '2025_08_26_000002_create_media_table', 1),
(5, '2025_08_26_000003_create_permissions_table', 1),
(6, '2025_08_26_000004_create_roles_table', 1),
(7, '2025_08_26_000005_create_users_table', 1),
(8, '2025_08_26_000006_create_user_alerts_table', 1),
(9, '2025_08_26_000007_create_add_businesses_table', 1),
(10, '2025_08_26_000008_create_party_details_table', 1),
(11, '2025_08_26_000009_create_add_items_table', 1),
(12, '2025_08_26_000010_create_units_table', 1),
(13, '2025_08_26_000011_create_categories_table', 1),
(14, '2025_08_26_000012_create_tax_rates_table', 1),
(15, '2025_08_26_000013_create_sale_invoices_table', 1),
(16, '2025_08_26_000014_create_estimate_quotations_table', 1),
(17, '2025_08_26_000015_create_proforma_invoices_table', 1),
(18, '2025_08_26_000016_create_bank_accounts_table', 1),
(19, '2025_08_26_000017_create_bank_to_cashes_table', 1),
(20, '2025_08_26_000018_create_cash_to_banks_table', 1),
(21, '2025_08_26_000019_create_bank_to_banks_table', 1),
(22, '2025_08_26_000020_create_adjust_bank_balances_table', 1),
(23, '2025_08_26_000021_create_cash_in_hands_table', 1),
(24, '2025_08_26_000022_create_purchase_bills_table', 1),
(25, '2025_08_26_000023_create_current_stocks_table', 1),
(26, '2025_08_26_000024_create_payment_outs_table', 1),
(27, '2025_08_26_000025_create_expense_categories_table', 1),
(28, '2025_08_26_000026_create_expense_lists_table', 1),
(29, '2025_08_26_000027_create_purchase_orders_table', 1),
(30, '2025_08_26_000028_create_permission_role_pivot_table', 1),
(31, '2025_08_26_000029_create_add_business_user_pivot_table', 1),
(32, '2025_08_26_000030_create_role_user_pivot_table', 1),
(33, '2025_08_26_000031_create_user_user_alert_pivot_table', 1),
(34, '2025_08_26_000032_create_add_item_category_pivot_table', 1),
(35, '2025_08_26_000033_create_add_item_sale_invoice_pivot_table', 1),
(36, '2025_08_26_000034_create_add_item_estimate_quotation_pivot_table', 1),
(37, '2025_08_26_000035_create_add_item_proforma_invoice_pivot_table', 1),
(38, '2025_08_26_000036_create_add_item_purchase_bill_pivot_table', 1),
(39, '2025_08_26_000037_create_add_item_current_stock_pivot_table', 1),
(40, '2025_08_26_000038_create_add_item_purchase_order_pivot_table', 1),
(41, '2025_08_26_000039_add_relationship_fields_to_user_alerts_table', 1),
(42, '2025_08_26_000040_add_relationship_fields_to_add_businesses_table', 1),
(43, '2025_08_26_000041_add_relationship_fields_to_party_details_table', 1),
(44, '2025_08_26_000042_add_relationship_fields_to_add_items_table', 1),
(45, '2025_08_26_000043_add_relationship_fields_to_units_table', 1),
(46, '2025_08_26_000044_add_relationship_fields_to_categories_table', 1),
(47, '2025_08_26_000045_add_relationship_fields_to_tax_rates_table', 1),
(48, '2025_08_26_000046_add_relationship_fields_to_sale_invoices_table', 1),
(49, '2025_08_26_000047_add_relationship_fields_to_estimate_quotations_table', 1),
(50, '2025_08_26_000048_add_relationship_fields_to_proforma_invoices_table', 1),
(51, '2025_08_26_000049_add_relationship_fields_to_bank_accounts_table', 1),
(52, '2025_08_26_000050_add_relationship_fields_to_bank_to_cashes_table', 1),
(53, '2025_08_26_000051_add_relationship_fields_to_cash_to_banks_table', 1),
(54, '2025_08_26_000052_add_relationship_fields_to_bank_to_banks_table', 1),
(55, '2025_08_26_000053_add_relationship_fields_to_adjust_bank_balances_table', 1),
(56, '2025_08_26_000054_add_relationship_fields_to_cash_in_hands_table', 1),
(57, '2025_08_26_000055_add_relationship_fields_to_purchase_bills_table', 1),
(58, '2025_08_26_000056_add_relationship_fields_to_current_stocks_table', 1),
(59, '2025_08_26_000057_add_relationship_fields_to_payment_outs_table', 1),
(60, '2025_08_26_000058_add_relationship_fields_to_expense_categories_table', 1),
(61, '2025_08_26_000059_add_relationship_fields_to_expense_lists_table', 1),
(62, '2025_08_26_000060_add_relationship_fields_to_purchase_orders_table', 1),
(63, '2025_08_26_000061_create_qa_topics_table', 1),
(64, '2025_08_26_000062_create_qa_messages_table', 1),
(65, '2025_09_01_104302_update_add_items_table_for_all_fields', 2),
(66, '2025_09_20_000028_create_main_cost_centers_table', 3),
(67, '2025_09_20_000029_create_sub_cost_centers_table', 3),
(68, '2025_09_20_000063_add_relationship_fields_to_main_cost_centers_table', 3),
(69, '2025_09_20_000064_add_relationship_fields_to_sub_cost_centers_table', 3),
(70, '2025_09_25_094818_create_purchase_logs_table', 4),
(71, '2025_10_07_092703_create_sale_logs_table', 5),
(72, '2025_10_07_092439_create_terms_and_conditions_table', 6),
(73, '2025_10_08_115041_create_transactions_table', 7),
(74, '2025_10_08_115526_add_cost_centers_to_transactions_table', 8),
(75, '2025_10_15_095526_create_finished_goods_raw_material_pivot_table', 9),
(76, '2025_10_14_122533_create_bank_transactions_table', 10),
(77, '2025_10_16_103458_create_payment_ins_table', 11),
(78, '2025_11_01_083917_create_ledgers_table', 12),
(79, '2025_11_03_075350_create_sale_profit_losses_table', 13),
(80, '2025_11_07_104216_create_sale_invoice_status_histories_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `party_details`
--

CREATE TABLE `party_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `party_name` varchar(255) NOT NULL,
  `gstin` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `pan_number` varchar(255) DEFAULT NULL,
  `place_of_supply` varchar(255) DEFAULT NULL,
  `type_of_supply` varchar(255) DEFAULT NULL,
  `gst_type` varchar(255) DEFAULT NULL,
  `pin_code` text DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `billing_address` longtext DEFAULT NULL,
  `shipping_address` longtext DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `opening_balance` decimal(15,2) NOT NULL,
  `as_of_date` date DEFAULT NULL,
  `opening_balance_type` varchar(255) DEFAULT NULL,
  `credit_limit` varchar(255) DEFAULT NULL,
  `credit_limit_amount` decimal(15,2) DEFAULT NULL,
  `payment_terms` varchar(255) DEFAULT NULL,
  `ifsc_code` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `notes` longtext DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `current_balance` text DEFAULT NULL,
  `current_balance_type` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `party_details`
--

INSERT INTO `party_details` (`id`, `party_name`, `gstin`, `phone_number`, `pan_number`, `place_of_supply`, `type_of_supply`, `gst_type`, `pin_code`, `state`, `city`, `billing_address`, `shipping_address`, `email`, `opening_balance`, `as_of_date`, `opening_balance_type`, `credit_limit`, `credit_limit_amount`, `payment_terms`, `ifsc_code`, `account_number`, `bank_name`, `branch`, `notes`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by_id`, `current_balance`, `current_balance_type`) VALUES
(1, 'Sade Boyle', '121212121212123', '8863897163', 'kiipk7404n', NULL, 'Intra-State', 'Registered_Business_Regular', NULL, 'patna', 'patna', '<p>svccv xc xc dx&nbsp;</p>', '<p>serdvesv cdx&nbsp;</p>', 'ajayfilliptect@gmail.com', 100.00, '2025-08-27', 'Debit', 'off', 10000.00, 'Elit facilis velit', 'AIRP0000001', '13243546466', 'Airtel Payments Bank', 'patna', '<p>sgvdfbfg &nbsp;4egr tdrg grg</p>', 'enable', '2025-08-27 02:28:05', '2025-10-09 08:16:53', NULL, 2, '52168.63', 'Debit'),
(4, 'Sade Holden', '121212121212121', '9229779459', '7941111111', 'Eos vel facilis cons', 'Intra-State', 'Registered_Business_Composition', NULL, 'Et quia aliqua Expe', 'Consequat Omnis qua', 'Voluptatem aut moll', 'Architecto eos cum n', 'vijicupigu@mailinator.com', 1.00, '1987-09-15', 'Debit', 'off', NULL, 'Voluptatum mollitia', 'Sit dolore ut maxim', '4092343243432', 'Phelan Hurley', 'Accusantium numquam', 'Id eos est voluptas', 'enable', '2025-10-14 04:27:33', '2025-12-11 01:39:52', NULL, 3, '14644', 'Debit'),
(5, 'Brenna Mcdonald', 'Molestiae in commodo', '8863897161', '163', 'Quia ut doloremque a', 'Inter-State', 'Registered_Business_Composition', '800001', 'Bihar', 'Patna', 'B.C. Road, Patna, Bihar', 'B.C. Road, Patna, Bihar', 'ajayfilliptect@gmail.com', 0.00, '2025-11-04', 'Debit', 'off', NULL, 'ijhjji', 'AIRP0000001', '13243546466', 'Airtel Payments Bank', 'AIRTEL PAYMENTS BRANCH', NULL, 'enable', '2025-11-04 01:13:17', '2025-11-04 02:39:13', '2025-11-04 02:39:13', 4, NULL, NULL);

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
-- Table structure for table `payment_ins`
--

CREATE TABLE `payment_ins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parties_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `reference_no` varchar(255) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `discount` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_ins`
--

INSERT INTO `payment_ins` (`id`, `parties_id`, `payment_type_id`, `date`, `reference_no`, `amount`, `discount`, `total`, `description`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 4, '2025-11-08', 'wqfcac', 4000.00, NULL, 4000.00, NULL, 3, 3, '2025-11-08 01:16:02', '2025-11-08 01:32:49', '2025-11-08 01:32:49'),
(2, 4, 4, '2025-11-08', 'wqfcac', 4000.00, NULL, 4000.00, NULL, 3, 3, '2025-11-08 01:18:55', '2025-11-08 01:20:08', '2025-11-08 01:20:08'),
(3, 4, 4, '2025-11-08', 'wqfcac', 4000.00, NULL, 4000.00, NULL, 3, 3, '2025-11-08 01:19:16', '2025-11-08 01:20:04', '2025-11-08 01:20:04'),
(4, 4, 4, '2025-11-08', 'wqfcac', 4000.00, NULL, 4000.00, NULL, 3, 3, '2025-11-08 01:19:37', '2025-11-08 01:20:01', '2025-11-08 01:20:01'),
(5, 4, 4, '2025-11-08', 'uhsfjhe88', 201.00, NULL, 201.00, 'scsd', 3, 3, '2025-11-08 01:33:31', '2025-11-08 01:33:31', NULL),
(6, 4, 4, '2025-11-08', 'uhsfjhe88', 402.00, NULL, 402.00, NULL, 3, 3, '2025-11-08 01:35:29', '2025-11-08 01:35:29', NULL),
(7, 4, 4, '2025-11-08', '804', 804.00, NULL, 804.00, NULL, 3, 3, '2025-11-08 01:38:32', '2025-11-08 01:38:32', NULL),
(8, 4, 4, '2025-11-08', 'wqfesc', 608.00, NULL, 608.00, NULL, 3, 3, '2025-11-08 01:41:13', '2025-11-08 01:41:13', NULL),
(9, 4, 4, '2025-11-08', NULL, 400.00, NULL, 400.00, NULL, 3, 3, '2025-11-08 02:09:32', '2025-11-08 02:09:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_outs`
--

CREATE TABLE `payment_outs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `reference_no` varchar(255) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `parties_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user_management_access', NULL, NULL, NULL),
(2, 'permission_create', NULL, NULL, NULL),
(3, 'permission_edit', NULL, NULL, NULL),
(4, 'permission_show', NULL, NULL, NULL),
(5, 'permission_delete', NULL, NULL, NULL),
(6, 'permission_access', NULL, NULL, NULL),
(7, 'role_create', NULL, NULL, NULL),
(8, 'role_edit', NULL, NULL, NULL),
(9, 'role_show', NULL, NULL, NULL),
(10, 'role_delete', NULL, NULL, NULL),
(11, 'role_access', NULL, NULL, NULL),
(12, 'user_create', NULL, NULL, NULL),
(13, 'user_edit', NULL, NULL, NULL),
(14, 'user_show', NULL, NULL, NULL),
(15, 'user_delete', NULL, NULL, NULL),
(16, 'user_access', NULL, NULL, NULL),
(17, 'audit_log_show', NULL, NULL, NULL),
(18, 'audit_log_access', NULL, NULL, NULL),
(19, 'user_alert_create', NULL, NULL, NULL),
(20, 'user_alert_show', NULL, NULL, NULL),
(21, 'user_alert_delete', NULL, NULL, NULL),
(22, 'user_alert_access', NULL, NULL, NULL),
(23, 'add_business_create', NULL, NULL, NULL),
(24, 'add_business_edit', NULL, NULL, NULL),
(25, 'add_business_show', NULL, NULL, NULL),
(26, 'add_business_delete', NULL, NULL, NULL),
(27, 'add_business_access', NULL, NULL, NULL),
(28, 'party_access', NULL, NULL, NULL),
(29, 'party_detail_create', NULL, NULL, NULL),
(30, 'party_detail_edit', NULL, NULL, NULL),
(31, 'party_detail_show', NULL, NULL, NULL),
(32, 'party_detail_delete', NULL, NULL, NULL),
(33, 'party_detail_access', NULL, NULL, NULL),
(34, 'loyalty_point_create', NULL, NULL, NULL),
(35, 'loyalty_point_edit', NULL, NULL, NULL),
(36, 'loyalty_point_show', NULL, NULL, NULL),
(37, 'loyalty_point_delete', NULL, NULL, NULL),
(38, 'loyalty_point_access', NULL, NULL, NULL),
(39, 'whatsapp_connect_create', NULL, NULL, NULL),
(40, 'whatsapp_connect_edit', NULL, NULL, NULL),
(41, 'whatsapp_connect_show', NULL, NULL, NULL),
(42, 'whatsapp_connect_delete', NULL, NULL, NULL),
(43, 'whatsapp_connect_access', NULL, NULL, NULL),
(44, 'item_access', NULL, NULL, NULL),
(45, 'add_item_create', NULL, NULL, NULL),
(46, 'add_item_edit', NULL, NULL, NULL),
(47, 'add_item_show', NULL, NULL, NULL),
(48, 'add_item_delete', NULL, NULL, NULL),
(49, 'add_item_access', NULL, NULL, NULL),
(50, 'master_data_access', NULL, NULL, NULL),
(51, 'unit_create', NULL, NULL, NULL),
(52, 'unit_edit', NULL, NULL, NULL),
(53, 'unit_show', NULL, NULL, NULL),
(54, 'unit_delete', NULL, NULL, NULL),
(55, 'unit_access', NULL, NULL, NULL),
(56, 'category_create', NULL, NULL, NULL),
(57, 'category_edit', NULL, NULL, NULL),
(58, 'category_show', NULL, NULL, NULL),
(59, 'category_delete', NULL, NULL, NULL),
(60, 'category_access', NULL, NULL, NULL),
(61, 'tax_rate_create', NULL, NULL, NULL),
(62, 'tax_rate_edit', NULL, NULL, NULL),
(63, 'tax_rate_show', NULL, NULL, NULL),
(64, 'tax_rate_delete', NULL, NULL, NULL),
(65, 'tax_rate_access', NULL, NULL, NULL),
(66, 'sale_access', NULL, NULL, NULL),
(67, 'sale_invoice_create', NULL, NULL, NULL),
(68, 'sale_invoice_edit', NULL, NULL, NULL),
(69, 'sale_invoice_show', NULL, NULL, NULL),
(70, 'sale_invoice_delete', NULL, NULL, NULL),
(71, 'sale_invoice_access', NULL, NULL, NULL),
(72, 'estimate_quotation_create', NULL, NULL, NULL),
(73, 'estimate_quotation_edit', NULL, NULL, NULL),
(74, 'estimate_quotation_show', NULL, NULL, NULL),
(75, 'estimate_quotation_delete', NULL, NULL, NULL),
(76, 'estimate_quotation_access', NULL, NULL, NULL),
(77, 'proforma_invoice_create', NULL, NULL, NULL),
(78, 'proforma_invoice_edit', NULL, NULL, NULL),
(79, 'proforma_invoice_show', NULL, NULL, NULL),
(80, 'proforma_invoice_delete', NULL, NULL, NULL),
(81, 'proforma_invoice_access', NULL, NULL, NULL),
(82, 'purchase_access', NULL, NULL, NULL),
(83, 'bank_access', NULL, NULL, NULL),
(84, 'bank_account_create', NULL, NULL, NULL),
(85, 'bank_account_edit', NULL, NULL, NULL),
(86, 'bank_account_show', NULL, NULL, NULL),
(87, 'bank_account_delete', NULL, NULL, NULL),
(88, 'bank_account_access', NULL, NULL, NULL),
(89, 'deposit_withdraw_access', NULL, NULL, NULL),
(90, 'bank_to_cash_create', NULL, NULL, NULL),
(91, 'bank_to_cash_edit', NULL, NULL, NULL),
(92, 'bank_to_cash_show', NULL, NULL, NULL),
(93, 'bank_to_cash_delete', NULL, NULL, NULL),
(94, 'bank_to_cash_access', NULL, NULL, NULL),
(95, 'cash_to_bank_create', NULL, NULL, NULL),
(96, 'cash_to_bank_edit', NULL, NULL, NULL),
(97, 'cash_to_bank_show', NULL, NULL, NULL),
(98, 'cash_to_bank_delete', NULL, NULL, NULL),
(99, 'cash_to_bank_access', NULL, NULL, NULL),
(100, 'bank_to_bank_create', NULL, NULL, NULL),
(101, 'bank_to_bank_edit', NULL, NULL, NULL),
(102, 'bank_to_bank_show', NULL, NULL, NULL),
(103, 'bank_to_bank_delete', NULL, NULL, NULL),
(104, 'bank_to_bank_access', NULL, NULL, NULL),
(105, 'adjust_bank_balance_create', NULL, NULL, NULL),
(106, 'adjust_bank_balance_edit', NULL, NULL, NULL),
(107, 'adjust_bank_balance_show', NULL, NULL, NULL),
(108, 'adjust_bank_balance_delete', NULL, NULL, NULL),
(109, 'adjust_bank_balance_access', NULL, NULL, NULL),
(110, 'cash_in_hand_create', NULL, NULL, NULL),
(111, 'cash_in_hand_edit', NULL, NULL, NULL),
(112, 'cash_in_hand_show', NULL, NULL, NULL),
(113, 'cash_in_hand_delete', NULL, NULL, NULL),
(114, 'cash_in_hand_access', NULL, NULL, NULL),
(115, 'purchase_bill_create', NULL, NULL, NULL),
(116, 'purchase_bill_edit', NULL, NULL, NULL),
(117, 'purchase_bill_show', NULL, NULL, NULL),
(118, 'purchase_bill_delete', NULL, NULL, NULL),
(119, 'purchase_bill_access', NULL, NULL, NULL),
(120, 'stock_access', NULL, NULL, NULL),
(121, 'current_stock_create', NULL, NULL, NULL),
(122, 'current_stock_edit', NULL, NULL, NULL),
(123, 'current_stock_show', NULL, NULL, NULL),
(124, 'current_stock_delete', NULL, NULL, NULL),
(125, 'current_stock_access', NULL, NULL, NULL),
(126, 'stocks_report_create', NULL, NULL, NULL),
(127, 'stocks_report_edit', NULL, NULL, NULL),
(128, 'stocks_report_show', NULL, NULL, NULL),
(129, 'stocks_report_delete', NULL, NULL, NULL),
(130, 'stocks_report_access', NULL, NULL, NULL),
(131, 'stock_history_create', NULL, NULL, NULL),
(132, 'stock_history_edit', NULL, NULL, NULL),
(133, 'stock_history_show', NULL, NULL, NULL),
(134, 'stock_history_delete', NULL, NULL, NULL),
(135, 'stock_history_access', NULL, NULL, NULL),
(136, 'payment_out_create', NULL, NULL, NULL),
(137, 'payment_out_edit', NULL, NULL, NULL),
(138, 'payment_out_show', NULL, NULL, NULL),
(139, 'payment_out_delete', NULL, NULL, NULL),
(140, 'payment_out_access', NULL, NULL, NULL),
(141, 'expense_category_create', NULL, NULL, NULL),
(142, 'expense_category_edit', NULL, NULL, NULL),
(143, 'expense_category_show', NULL, NULL, NULL),
(144, 'expense_category_delete', NULL, NULL, NULL),
(145, 'expense_category_access', NULL, NULL, NULL),
(146, 'expense_access', NULL, NULL, NULL),
(147, 'expense_list_create', NULL, NULL, NULL),
(148, 'expense_list_edit', NULL, NULL, NULL),
(149, 'expense_list_show', NULL, NULL, NULL),
(150, 'expense_list_delete', NULL, NULL, NULL),
(151, 'expense_list_access', NULL, NULL, NULL),
(152, 'purchase_order_create', NULL, NULL, NULL),
(153, 'purchase_order_edit', NULL, NULL, NULL),
(154, 'purchase_order_show', NULL, NULL, NULL),
(155, 'purchase_order_delete', NULL, NULL, NULL),
(156, 'purchase_order_access', NULL, NULL, NULL),
(157, 'report_access', NULL, NULL, NULL),
(158, 'transaction_report_access', NULL, NULL, NULL),
(159, 'sale_report_create', NULL, NULL, NULL),
(160, 'sale_report_edit', NULL, NULL, NULL),
(161, 'sale_report_show', NULL, NULL, NULL),
(162, 'sale_report_delete', NULL, NULL, NULL),
(163, 'sale_report_access', NULL, NULL, NULL),
(164, 'purchase_report_create', NULL, NULL, NULL),
(165, 'purchase_report_edit', NULL, NULL, NULL),
(166, 'purchase_report_show', NULL, NULL, NULL),
(167, 'purchase_report_delete', NULL, NULL, NULL),
(168, 'purchase_report_access', NULL, NULL, NULL),
(169, 'day_book_create', NULL, NULL, NULL),
(170, 'day_book_edit', NULL, NULL, NULL),
(171, 'day_book_show', NULL, NULL, NULL),
(172, 'day_book_delete', NULL, NULL, NULL),
(173, 'day_book_access', NULL, NULL, NULL),
(174, 'all_transaction_create', NULL, NULL, NULL),
(175, 'all_transaction_edit', NULL, NULL, NULL),
(176, 'all_transaction_show', NULL, NULL, NULL),
(177, 'all_transaction_delete', NULL, NULL, NULL),
(178, 'all_transaction_access', NULL, NULL, NULL),
(179, 'profit_loss_create', NULL, NULL, NULL),
(180, 'profit_loss_edit', NULL, NULL, NULL),
(181, 'profit_loss_show', NULL, NULL, NULL),
(182, 'profit_loss_delete', NULL, NULL, NULL),
(183, 'profit_loss_access', NULL, NULL, NULL),
(184, 'bill_wise_profit_create', NULL, NULL, NULL),
(185, 'bill_wise_profit_edit', NULL, NULL, NULL),
(186, 'bill_wise_profit_show', NULL, NULL, NULL),
(187, 'bill_wise_profit_delete', NULL, NULL, NULL),
(188, 'bill_wise_profit_access', NULL, NULL, NULL),
(189, 'balance_sheet_create', NULL, NULL, NULL),
(190, 'balance_sheet_edit', NULL, NULL, NULL),
(191, 'balance_sheet_show', NULL, NULL, NULL),
(192, 'balance_sheet_delete', NULL, NULL, NULL),
(193, 'balance_sheet_access', NULL, NULL, NULL),
(194, 'party_report_access', NULL, NULL, NULL),
(195, 'party_statement_create', NULL, NULL, NULL),
(196, 'party_statement_edit', NULL, NULL, NULL),
(197, 'party_statement_show', NULL, NULL, NULL),
(198, 'party_statement_delete', NULL, NULL, NULL),
(199, 'party_statement_access', NULL, NULL, NULL),
(200, 'party_wise_profit_loss_create', NULL, NULL, NULL),
(201, 'party_wise_profit_loss_edit', NULL, NULL, NULL),
(202, 'party_wise_profit_loss_show', NULL, NULL, NULL),
(203, 'party_wise_profit_loss_delete', NULL, NULL, NULL),
(204, 'party_wise_profit_loss_access', NULL, NULL, NULL),
(205, 'all_party_create', NULL, NULL, NULL),
(206, 'all_party_edit', NULL, NULL, NULL),
(207, 'all_party_show', NULL, NULL, NULL),
(208, 'all_party_delete', NULL, NULL, NULL),
(209, 'all_party_access', NULL, NULL, NULL),
(210, 'party_report_by_item_create', NULL, NULL, NULL),
(211, 'party_report_by_item_edit', NULL, NULL, NULL),
(212, 'party_report_by_item_show', NULL, NULL, NULL),
(213, 'party_report_by_item_delete', NULL, NULL, NULL),
(214, 'party_report_by_item_access', NULL, NULL, NULL),
(215, 'sale_purchase_by_party_create', NULL, NULL, NULL),
(216, 'sale_purchase_by_party_edit', NULL, NULL, NULL),
(217, 'sale_purchase_by_party_show', NULL, NULL, NULL),
(218, 'sale_purchase_by_party_delete', NULL, NULL, NULL),
(219, 'sale_purchase_by_party_access', NULL, NULL, NULL),
(220, 'stock_report_access', NULL, NULL, NULL),
(221, 'stocks_summary_create', NULL, NULL, NULL),
(222, 'stocks_summary_edit', NULL, NULL, NULL),
(223, 'stocks_summary_show', NULL, NULL, NULL),
(224, 'stocks_summary_delete', NULL, NULL, NULL),
(225, 'stocks_summary_access', NULL, NULL, NULL),
(226, 'item_report_by_party_create', NULL, NULL, NULL),
(227, 'item_report_by_party_edit', NULL, NULL, NULL),
(228, 'item_report_by_party_show', NULL, NULL, NULL),
(229, 'item_report_by_party_delete', NULL, NULL, NULL),
(230, 'item_report_by_party_access', NULL, NULL, NULL),
(231, 'item_wise_profit_and_loass_create', NULL, NULL, NULL),
(232, 'item_wise_profit_and_loass_edit', NULL, NULL, NULL),
(233, 'item_wise_profit_and_loass_show', NULL, NULL, NULL),
(234, 'item_wise_profit_and_loass_delete', NULL, NULL, NULL),
(235, 'item_wise_profit_and_loass_access', NULL, NULL, NULL),
(236, 'low_stock_summary_create', NULL, NULL, NULL),
(237, 'low_stock_summary_edit', NULL, NULL, NULL),
(238, 'low_stock_summary_show', NULL, NULL, NULL),
(239, 'low_stock_summary_delete', NULL, NULL, NULL),
(240, 'low_stock_summary_access', NULL, NULL, NULL),
(241, 'stock_detail_create', NULL, NULL, NULL),
(242, 'stock_detail_edit', NULL, NULL, NULL),
(243, 'stock_detail_show', NULL, NULL, NULL),
(244, 'stock_detail_delete', NULL, NULL, NULL),
(245, 'stock_detail_access', NULL, NULL, NULL),
(246, 'expense_report_access', NULL, NULL, NULL),
(247, 'expense_report_list_create', NULL, NULL, NULL),
(248, 'expense_report_list_edit', NULL, NULL, NULL),
(249, 'expense_report_list_show', NULL, NULL, NULL),
(250, 'expense_report_list_delete', NULL, NULL, NULL),
(251, 'expense_report_list_access', NULL, NULL, NULL),
(252, 'expense_category_report_create', NULL, NULL, NULL),
(253, 'expense_category_report_edit', NULL, NULL, NULL),
(254, 'expense_category_report_show', NULL, NULL, NULL),
(255, 'expense_category_report_delete', NULL, NULL, NULL),
(256, 'expense_category_report_access', NULL, NULL, NULL),
(257, 'expense_item_report_create', NULL, NULL, NULL),
(258, 'expense_item_report_edit', NULL, NULL, NULL),
(259, 'expense_item_report_show', NULL, NULL, NULL),
(260, 'expense_item_report_delete', NULL, NULL, NULL),
(261, 'expense_item_report_access', NULL, NULL, NULL),
(262, 'sale_purchase_report_access', NULL, NULL, NULL),
(263, 'sale_purchase_create', NULL, NULL, NULL),
(264, 'sale_purchase_edit', NULL, NULL, NULL),
(265, 'sale_purchase_show', NULL, NULL, NULL),
(266, 'sale_purchase_delete', NULL, NULL, NULL),
(267, 'sale_purchase_access', NULL, NULL, NULL),
(268, 'sale_purchase_item_create', NULL, NULL, NULL),
(269, 'sale_purchase_item_edit', NULL, NULL, NULL),
(270, 'sale_purchase_item_show', NULL, NULL, NULL),
(271, 'sale_purchase_item_delete', NULL, NULL, NULL),
(272, 'sale_purchase_item_access', NULL, NULL, NULL),
(273, 'profile_password_edit', NULL, NULL, NULL),
(274, 'cost_center_access', '2025-09-20 04:21:37', '2025-09-20 04:21:37', NULL),
(275, 'main_cost_center_create', '2025-09-20 04:22:15', '2025-09-20 04:22:15', NULL),
(276, 'main_cost_center_edit', '2025-09-20 04:22:25', '2025-09-20 04:22:25', NULL),
(277, 'main_cost_center_show', '2025-09-20 04:22:42', '2025-09-20 04:22:42', NULL),
(278, 'main_cost_center_delete', '2025-09-20 04:22:52', '2025-09-20 04:22:52', NULL),
(279, 'sub_cost_center_access', '2025-09-20 04:23:44', '2025-09-20 04:23:44', NULL),
(280, 'sub_cost_center_create', '2025-09-20 04:24:00', '2025-09-20 04:24:00', NULL),
(281, 'sub_cost_center_edit', '2025-09-20 04:24:11', '2025-09-20 04:24:11', NULL),
(282, 'sub_cost_center_show', '2025-09-20 04:24:21', '2025-09-20 04:24:21', NULL),
(283, 'sub_cost_center_delete', '2025-09-20 04:24:30', '2025-09-20 04:24:30', NULL),
(284, 'cost_center_access', '2025-09-20 04:28:14', '2025-09-20 04:28:14', NULL),
(285, 'main_cost_center_access', '2025-09-20 04:34:53', '2025-09-20 04:34:53', NULL),
(286, 'payment_in_access', '2025-10-16 05:01:02', '2025-10-16 05:01:02', NULL),
(287, 'payment_in_create', '2025-10-16 05:01:15', '2025-10-16 05:01:15', NULL),
(288, 'bank_transaction_access', '2025-10-16 05:01:35', '2025-10-16 05:01:35', NULL),
(289, 'bank_transaction_index', '2025-10-16 05:01:46', '2025-10-16 05:01:46', NULL),
(290, 'payment_in_access', '2025-11-01 04:51:49', '2025-11-01 04:51:49', NULL),
(291, 'payment_in_create', '2025-11-01 04:51:58', '2025-11-01 04:51:58', NULL),
(292, 'term_access', '2025-11-04 06:34:38', '2025-11-04 06:34:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(1, 70),
(1, 71),
(1, 72),
(1, 73),
(1, 74),
(1, 75),
(1, 76),
(1, 77),
(1, 78),
(1, 79),
(1, 80),
(1, 81),
(1, 82),
(1, 83),
(1, 84),
(1, 85),
(1, 86),
(1, 87),
(1, 88),
(1, 89),
(1, 90),
(1, 91),
(1, 92),
(1, 93),
(1, 94),
(1, 95),
(1, 96),
(1, 97),
(1, 98),
(1, 99),
(1, 100),
(1, 101),
(1, 102),
(1, 103),
(1, 104),
(1, 105),
(1, 106),
(1, 107),
(1, 108),
(1, 109),
(1, 110),
(1, 111),
(1, 112),
(1, 113),
(1, 114),
(1, 115),
(1, 116),
(1, 117),
(1, 118),
(1, 119),
(1, 120),
(1, 121),
(1, 122),
(1, 123),
(1, 124),
(1, 125),
(1, 126),
(1, 127),
(1, 128),
(1, 129),
(1, 130),
(1, 131),
(1, 132),
(1, 133),
(1, 134),
(1, 135),
(1, 136),
(1, 137),
(1, 138),
(1, 139),
(1, 140),
(1, 141),
(1, 142),
(1, 143),
(1, 144),
(1, 145),
(1, 146),
(1, 147),
(1, 148),
(1, 149),
(1, 150),
(1, 151),
(1, 152),
(1, 153),
(1, 154),
(1, 155),
(1, 156),
(1, 157),
(1, 158),
(1, 159),
(1, 160),
(1, 161),
(1, 162),
(1, 163),
(1, 164),
(1, 165),
(1, 166),
(1, 167),
(1, 168),
(1, 169),
(1, 170),
(1, 171),
(1, 172),
(1, 173),
(1, 174),
(1, 175),
(1, 176),
(1, 177),
(1, 178),
(1, 179),
(1, 180),
(1, 181),
(1, 182),
(1, 183),
(1, 184),
(1, 185),
(1, 186),
(1, 187),
(1, 188),
(1, 189),
(1, 190),
(1, 191),
(1, 192),
(1, 193),
(1, 194),
(1, 195),
(1, 196),
(1, 197),
(1, 198),
(1, 199),
(1, 200),
(1, 201),
(1, 202),
(1, 203),
(1, 204),
(1, 205),
(1, 206),
(1, 207),
(1, 208),
(1, 209),
(1, 210),
(1, 211),
(1, 212),
(1, 213),
(1, 214),
(1, 215),
(1, 216),
(1, 217),
(1, 218),
(1, 219),
(1, 220),
(1, 221),
(1, 222),
(1, 223),
(1, 224),
(1, 225),
(1, 226),
(1, 227),
(1, 228),
(1, 229),
(1, 230),
(1, 231),
(1, 232),
(1, 233),
(1, 234),
(1, 235),
(1, 236),
(1, 237),
(1, 238),
(1, 239),
(1, 240),
(1, 241),
(1, 242),
(1, 243),
(1, 244),
(1, 245),
(1, 246),
(1, 247),
(1, 248),
(1, 249),
(1, 250),
(1, 251),
(1, 252),
(1, 253),
(1, 254),
(1, 255),
(1, 256),
(1, 257),
(1, 258),
(1, 259),
(1, 260),
(1, 261),
(1, 262),
(1, 263),
(1, 264),
(1, 265),
(1, 266),
(1, 267),
(1, 268),
(1, 269),
(1, 270),
(1, 271),
(1, 272),
(1, 273),
(2, 17),
(2, 18),
(2, 23),
(2, 24),
(2, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 31),
(2, 32),
(2, 33),
(2, 34),
(2, 35),
(2, 36),
(2, 37),
(2, 38),
(2, 39),
(2, 40),
(2, 41),
(2, 42),
(2, 43),
(2, 44),
(2, 45),
(2, 46),
(2, 47),
(2, 48),
(2, 49),
(2, 50),
(2, 51),
(2, 52),
(2, 53),
(2, 54),
(2, 55),
(2, 56),
(2, 57),
(2, 58),
(2, 59),
(2, 60),
(2, 61),
(2, 62),
(2, 63),
(2, 64),
(2, 65),
(2, 66),
(2, 67),
(2, 68),
(2, 69),
(2, 70),
(2, 71),
(2, 72),
(2, 73),
(2, 74),
(2, 75),
(2, 76),
(2, 77),
(2, 78),
(2, 79),
(2, 80),
(2, 81),
(2, 82),
(2, 83),
(2, 84),
(2, 85),
(2, 86),
(2, 87),
(2, 88),
(2, 89),
(2, 90),
(2, 91),
(2, 92),
(2, 93),
(2, 94),
(2, 95),
(2, 96),
(2, 97),
(2, 98),
(2, 99),
(2, 100),
(2, 101),
(2, 102),
(2, 103),
(2, 104),
(2, 105),
(2, 106),
(2, 107),
(2, 108),
(2, 109),
(2, 110),
(2, 111),
(2, 112),
(2, 113),
(2, 114),
(2, 115),
(2, 116),
(2, 117),
(2, 118),
(2, 119),
(2, 120),
(2, 121),
(2, 122),
(2, 123),
(2, 124),
(2, 125),
(2, 126),
(2, 127),
(2, 128),
(2, 129),
(2, 130),
(2, 131),
(2, 132),
(2, 133),
(2, 134),
(2, 135),
(2, 136),
(2, 137),
(2, 138),
(2, 139),
(2, 140),
(2, 141),
(2, 142),
(2, 143),
(2, 144),
(2, 145),
(2, 146),
(2, 147),
(2, 148),
(2, 149),
(2, 150),
(2, 151),
(2, 152),
(2, 153),
(2, 154),
(2, 155),
(2, 156),
(2, 157),
(2, 158),
(2, 159),
(2, 160),
(2, 161),
(2, 162),
(2, 163),
(2, 164),
(2, 165),
(2, 166),
(2, 167),
(2, 168),
(2, 169),
(2, 170),
(2, 171),
(2, 172),
(2, 173),
(2, 174),
(2, 175),
(2, 176),
(2, 177),
(2, 178),
(2, 179),
(2, 180),
(2, 181),
(2, 182),
(2, 183),
(2, 184),
(2, 185),
(2, 186),
(2, 187),
(2, 188),
(2, 189),
(2, 190),
(2, 191),
(2, 192),
(2, 193),
(2, 194),
(2, 195),
(2, 196),
(2, 197),
(2, 198),
(2, 199),
(2, 200),
(2, 201),
(2, 202),
(2, 203),
(2, 204),
(2, 205),
(2, 206),
(2, 207),
(2, 208),
(2, 209),
(2, 210),
(2, 211),
(2, 212),
(2, 213),
(2, 214),
(2, 215),
(2, 216),
(2, 217),
(2, 218),
(2, 219),
(2, 220),
(2, 221),
(2, 222),
(2, 223),
(2, 224),
(2, 225),
(2, 226),
(2, 227),
(2, 228),
(2, 229),
(2, 230),
(2, 231),
(2, 232),
(2, 233),
(2, 234),
(2, 235),
(2, 236),
(2, 237),
(2, 238),
(2, 239),
(2, 240),
(2, 241),
(2, 242),
(2, 243),
(2, 244),
(2, 245),
(2, 246),
(2, 247),
(2, 248),
(2, 249),
(2, 250),
(2, 251),
(2, 252),
(2, 253),
(2, 254),
(2, 255),
(2, 256),
(2, 257),
(2, 258),
(2, 259),
(2, 260),
(2, 261),
(2, 262),
(2, 263),
(2, 264),
(2, 265),
(2, 266),
(2, 267),
(2, 268),
(2, 269),
(2, 270),
(2, 271),
(2, 272),
(2, 273),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(3, 18),
(3, 19),
(3, 20),
(3, 21),
(3, 22),
(3, 23),
(3, 24),
(3, 25),
(3, 26),
(3, 27),
(3, 28),
(3, 29),
(3, 30),
(3, 31),
(3, 32),
(3, 33),
(3, 34),
(3, 35),
(3, 36),
(3, 37),
(3, 38),
(3, 39),
(3, 40),
(3, 41),
(3, 42),
(3, 43),
(3, 44),
(3, 45),
(3, 46),
(3, 47),
(3, 48),
(3, 49),
(3, 50),
(3, 51),
(3, 52),
(3, 53),
(3, 54),
(3, 55),
(3, 56),
(3, 57),
(3, 58),
(3, 59),
(3, 60),
(3, 61),
(3, 62),
(3, 63),
(3, 64),
(3, 65),
(3, 66),
(3, 67),
(3, 68),
(3, 69),
(3, 70),
(3, 71),
(3, 72),
(3, 73),
(3, 74),
(3, 75),
(3, 76),
(3, 77),
(3, 78),
(3, 79),
(3, 80),
(3, 81),
(3, 82),
(3, 83),
(3, 84),
(3, 85),
(3, 86),
(3, 87),
(3, 88),
(3, 89),
(3, 90),
(3, 91),
(3, 92),
(3, 93),
(3, 94),
(3, 95),
(3, 96),
(3, 97),
(3, 98),
(3, 99),
(3, 100),
(3, 101),
(3, 102),
(3, 103),
(3, 104),
(3, 105),
(3, 106),
(3, 107),
(3, 108),
(3, 109),
(3, 110),
(3, 111),
(3, 112),
(3, 113),
(3, 114),
(3, 115),
(3, 116),
(3, 117),
(3, 118),
(3, 119),
(3, 120),
(3, 121),
(3, 122),
(3, 123),
(3, 124),
(3, 125),
(3, 126),
(3, 127),
(3, 128),
(3, 129),
(3, 130),
(3, 131),
(3, 132),
(3, 133),
(3, 134),
(3, 135),
(3, 136),
(3, 137),
(3, 138),
(3, 139),
(3, 140),
(3, 141),
(3, 142),
(3, 143),
(3, 144),
(3, 145),
(3, 146),
(3, 147),
(3, 148),
(3, 149),
(3, 150),
(3, 151),
(3, 152),
(3, 153),
(3, 154),
(3, 155),
(3, 156),
(3, 157),
(3, 158),
(3, 159),
(3, 160),
(3, 161),
(3, 162),
(3, 163),
(3, 164),
(3, 165),
(3, 166),
(3, 167),
(3, 168),
(3, 169),
(3, 170),
(3, 171),
(3, 172),
(3, 173),
(3, 174),
(3, 175),
(3, 176),
(3, 177),
(3, 178),
(3, 179),
(3, 180),
(3, 181),
(3, 182),
(3, 183),
(3, 184),
(3, 185),
(3, 186),
(3, 187),
(3, 188),
(3, 189),
(3, 190),
(3, 191),
(3, 192),
(3, 193),
(3, 194),
(3, 195),
(3, 196),
(3, 197),
(3, 198),
(3, 199),
(3, 200),
(3, 201),
(3, 202),
(3, 203),
(3, 204),
(3, 205),
(3, 206),
(3, 207),
(3, 208),
(3, 209),
(3, 210),
(3, 211),
(3, 212),
(3, 213),
(3, 214),
(3, 215),
(3, 216),
(3, 217),
(3, 218),
(3, 219),
(3, 220),
(3, 221),
(3, 222),
(3, 223),
(3, 224),
(3, 225),
(3, 226),
(3, 227),
(3, 228),
(3, 229),
(3, 230),
(3, 231),
(3, 232),
(3, 233),
(3, 234),
(3, 235),
(3, 236),
(3, 237),
(3, 238),
(3, 239),
(3, 240),
(3, 241),
(3, 242),
(3, 243),
(3, 244),
(3, 245),
(3, 246),
(3, 247),
(3, 248),
(3, 249),
(3, 250),
(3, 251),
(3, 252),
(3, 253),
(3, 254),
(3, 255),
(3, 256),
(3, 257),
(3, 258),
(3, 259),
(3, 260),
(3, 261),
(3, 262),
(3, 263),
(3, 264),
(3, 265),
(3, 266),
(3, 267),
(3, 268),
(3, 269),
(3, 270),
(3, 271),
(3, 272),
(3, 273),
(1, 274),
(1, 275),
(1, 276),
(1, 277),
(1, 278),
(1, 279),
(1, 280),
(1, 281),
(1, 282),
(1, 283),
(1, 284),
(1, 285),
(4, 19),
(4, 20),
(4, 21),
(4, 22),
(4, 28),
(4, 29),
(4, 30),
(4, 31),
(4, 32),
(4, 33),
(4, 34),
(4, 35),
(4, 36),
(4, 37),
(4, 38),
(4, 39),
(4, 40),
(4, 41),
(4, 42),
(4, 43),
(4, 44),
(4, 45),
(4, 46),
(4, 47),
(4, 48),
(4, 49),
(4, 50),
(4, 51),
(4, 52),
(4, 53),
(4, 54),
(4, 55),
(4, 56),
(4, 57),
(4, 58),
(4, 59),
(4, 60),
(4, 61),
(4, 62),
(4, 63),
(4, 64),
(4, 65),
(4, 66),
(4, 67),
(4, 68),
(4, 69),
(4, 70),
(4, 71),
(4, 72),
(4, 73),
(4, 74),
(4, 75),
(4, 76),
(4, 77),
(4, 78),
(4, 79),
(4, 80),
(4, 81),
(4, 82),
(4, 83),
(4, 84),
(4, 85),
(4, 86),
(4, 87),
(4, 88),
(4, 89),
(4, 90),
(4, 91),
(4, 92),
(4, 93),
(4, 94),
(4, 95),
(4, 96),
(4, 97),
(4, 98),
(4, 99),
(4, 100),
(4, 101),
(4, 102),
(4, 103),
(4, 104),
(4, 105),
(4, 106),
(4, 107),
(4, 108),
(4, 109),
(4, 110),
(4, 111),
(4, 112),
(4, 113),
(4, 114),
(4, 115),
(4, 116),
(4, 117),
(4, 118),
(4, 119),
(4, 120),
(4, 121),
(4, 122),
(4, 123),
(4, 124),
(4, 125),
(4, 126),
(4, 127),
(4, 128),
(4, 129),
(4, 130),
(4, 131),
(4, 132),
(4, 133),
(4, 134),
(4, 135),
(4, 136),
(4, 137),
(4, 138),
(4, 139),
(4, 140),
(4, 141),
(4, 142),
(4, 143),
(4, 144),
(4, 145),
(4, 146),
(4, 147),
(4, 148),
(4, 149),
(4, 150),
(4, 151),
(4, 152),
(4, 153),
(4, 154),
(4, 155),
(4, 156),
(4, 157),
(4, 158),
(4, 159),
(4, 160),
(4, 161),
(4, 162),
(4, 163),
(4, 164),
(4, 165),
(4, 166),
(4, 167),
(4, 168),
(4, 169),
(4, 170),
(4, 171),
(4, 172),
(4, 173),
(4, 174),
(4, 175),
(4, 176),
(4, 177),
(4, 178),
(4, 179),
(4, 180),
(4, 181),
(4, 182),
(4, 183),
(4, 184),
(4, 185),
(4, 186),
(4, 187),
(4, 188),
(4, 189),
(4, 190),
(4, 191),
(4, 192),
(4, 193),
(4, 194),
(4, 195),
(4, 196),
(4, 197),
(4, 198),
(4, 199),
(4, 200),
(4, 201),
(4, 202),
(4, 203),
(4, 204),
(4, 205),
(4, 206),
(4, 207),
(4, 208),
(4, 209),
(4, 210),
(4, 211),
(4, 212),
(4, 213),
(4, 214),
(4, 215),
(4, 216),
(4, 217),
(4, 218),
(4, 219),
(4, 220),
(4, 221),
(4, 222),
(4, 223),
(4, 224),
(4, 225),
(4, 226),
(4, 227),
(4, 228),
(4, 229),
(4, 230),
(4, 231),
(4, 232),
(4, 233),
(4, 234),
(4, 235),
(4, 236),
(4, 237),
(4, 238),
(4, 239),
(4, 240),
(4, 241),
(4, 242),
(4, 243),
(4, 244),
(4, 245),
(4, 246),
(4, 247),
(4, 248),
(4, 249),
(4, 250),
(4, 251),
(4, 252),
(4, 253),
(4, 254),
(4, 255),
(4, 256),
(4, 257),
(4, 258),
(4, 259),
(4, 260),
(4, 261),
(4, 262),
(4, 263),
(4, 264),
(4, 265),
(4, 266),
(4, 267),
(4, 268),
(4, 269),
(4, 270),
(4, 271),
(4, 272),
(4, 273),
(4, 274),
(4, 275),
(4, 276),
(4, 277),
(4, 278),
(4, 279),
(4, 280),
(4, 281),
(4, 282),
(4, 283),
(4, 284),
(4, 285),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(5, 6),
(5, 7),
(5, 8),
(5, 9),
(5, 10),
(5, 11),
(5, 12),
(5, 13),
(5, 14),
(5, 15),
(5, 16),
(5, 17),
(5, 18),
(5, 19),
(5, 20),
(5, 21),
(5, 22),
(5, 23),
(5, 24),
(5, 25),
(5, 26),
(5, 27),
(5, 28),
(5, 29),
(5, 30),
(5, 31),
(5, 32),
(5, 33),
(5, 34),
(5, 35),
(5, 36),
(5, 37),
(5, 38),
(5, 39),
(5, 40),
(5, 41),
(5, 42),
(5, 43),
(5, 44),
(5, 45),
(5, 46),
(5, 47),
(5, 48),
(5, 49),
(5, 50),
(5, 51),
(5, 52),
(5, 53),
(5, 54),
(5, 55),
(5, 56),
(5, 57),
(5, 58),
(5, 59),
(5, 60),
(5, 61),
(5, 62),
(5, 63),
(5, 64),
(5, 65),
(5, 66),
(5, 67),
(5, 68),
(5, 69),
(5, 70),
(5, 71),
(5, 72),
(5, 73),
(5, 74),
(5, 75),
(5, 76),
(5, 77),
(5, 78),
(5, 79),
(5, 80),
(5, 81),
(5, 82),
(5, 83),
(5, 84),
(5, 85),
(5, 86),
(5, 87),
(5, 88),
(5, 89),
(5, 90),
(5, 91),
(5, 92),
(5, 93),
(5, 94),
(5, 95),
(5, 96),
(5, 97),
(5, 98),
(5, 99),
(5, 100),
(5, 101),
(5, 102),
(5, 103),
(5, 104),
(5, 105),
(5, 106),
(5, 107),
(5, 108),
(5, 109),
(5, 110),
(5, 111),
(5, 112),
(5, 113),
(5, 114),
(5, 115),
(5, 116),
(5, 117),
(5, 118),
(5, 119),
(5, 120),
(5, 121),
(5, 122),
(5, 123),
(5, 124),
(5, 125),
(5, 126),
(5, 127),
(5, 128),
(5, 129),
(5, 130),
(5, 131),
(5, 132),
(5, 133),
(5, 134),
(5, 135),
(5, 136),
(5, 137),
(5, 138),
(5, 139),
(5, 140),
(5, 141),
(5, 142),
(5, 143),
(5, 144),
(5, 145),
(5, 146),
(5, 147),
(5, 148),
(5, 149),
(5, 150),
(5, 151),
(5, 152),
(5, 153),
(5, 154),
(5, 155),
(5, 156),
(5, 157),
(5, 158),
(5, 159),
(5, 160),
(5, 161),
(5, 162),
(5, 163),
(5, 164),
(5, 165),
(5, 166),
(5, 167),
(5, 168),
(5, 169),
(5, 170),
(5, 171),
(5, 172),
(5, 173),
(5, 174),
(5, 175),
(5, 176),
(5, 177),
(5, 178),
(5, 179),
(5, 180),
(5, 181),
(5, 182),
(5, 183),
(5, 184),
(5, 185),
(5, 186),
(5, 187),
(5, 188),
(5, 189),
(5, 190),
(5, 191),
(5, 192),
(5, 193),
(5, 194),
(5, 195),
(5, 196),
(5, 197),
(5, 198),
(5, 199),
(5, 200),
(5, 201),
(5, 202),
(5, 203),
(5, 204),
(5, 205),
(5, 206),
(5, 207),
(5, 208),
(5, 209),
(5, 210),
(5, 211),
(5, 212),
(5, 213),
(5, 214),
(5, 215),
(5, 216),
(5, 217),
(5, 218),
(5, 219),
(5, 220),
(5, 221),
(5, 222),
(5, 223),
(5, 224),
(5, 225),
(5, 226),
(5, 227),
(5, 228),
(5, 229),
(5, 230),
(5, 231),
(5, 232),
(5, 233),
(5, 234),
(5, 235),
(5, 236),
(5, 237),
(5, 238),
(5, 239),
(5, 240),
(5, 241),
(5, 242),
(5, 243),
(5, 244),
(5, 245),
(5, 246),
(5, 247),
(5, 248),
(5, 249),
(5, 250),
(5, 251),
(5, 252),
(5, 253),
(5, 254),
(5, 255),
(5, 256),
(5, 257),
(5, 258),
(5, 259),
(5, 260),
(5, 261),
(5, 262),
(5, 263),
(5, 264),
(5, 265),
(5, 266),
(5, 267),
(5, 268),
(5, 269),
(5, 270),
(5, 271),
(5, 272),
(5, 273),
(5, 274),
(5, 275),
(5, 276),
(5, 277),
(5, 278),
(5, 279),
(5, 280),
(5, 281),
(5, 282),
(5, 283),
(5, 284),
(5, 285),
(1, 286),
(1, 287),
(1, 288),
(1, 289),
(5, 286),
(5, 287),
(5, 288),
(5, 289),
(5, 290),
(5, 291),
(4, 291),
(4, 290),
(4, 289),
(4, 288),
(4, 287),
(4, 286),
(3, 291),
(3, 290),
(3, 289),
(3, 288),
(3, 287),
(3, 286),
(3, 285),
(3, 284),
(3, 283),
(3, 274),
(3, 275),
(3, 276),
(3, 277),
(3, 278),
(3, 279),
(3, 282),
(3, 281),
(3, 280),
(2, 291),
(2, 290),
(2, 289),
(2, 288),
(2, 287),
(2, 286),
(2, 285),
(2, 284),
(2, 283),
(2, 282),
(2, 281),
(2, 274),
(2, 275),
(2, 276),
(2, 277),
(2, 278),
(2, 279),
(2, 280),
(1, 290),
(1, 291),
(4, 1),
(5, 292),
(1, 292);

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
-- Table structure for table `proforma_invoices`
--

CREATE TABLE `proforma_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_challan_number` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `e_way_bill_no` varchar(255) DEFAULT NULL,
  `billing_address` longtext DEFAULT NULL,
  `shipping_address` longtext DEFAULT NULL,
  `po_no` varchar(255) DEFAULT NULL,
  `po_date` date DEFAULT NULL,
  `qty` text DEFAULT NULL,
  `sub_cost_centers_id` text DEFAULT NULL,
  `main_cost_centers_id` text DEFAULT NULL,
  `due_date` text DEFAULT NULL,
  `status` text NOT NULL DEFAULT 'pending',
  `docket_no` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `select_customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `terms` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `overall_discount` text DEFAULT NULL,
  `tax_amount` text DEFAULT NULL,
  `adjustment` text DEFAULT NULL,
  `round_off` text DEFAULT NULL,
  `total` text DEFAULT NULL,
  `payment_type` text DEFAULT NULL,
  `subtotal` text DEFAULT NULL,
  `tax` text DEFAULT NULL,
  `discount` text DEFAULT NULL,
  `json_data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_bills`
--

CREATE TABLE `purchase_bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_invoice_number` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `e_way_bill_no` varchar(255) DEFAULT NULL,
  `billing_address` longtext DEFAULT NULL,
  `shipping_address` longtext DEFAULT NULL,
  `po_no` varchar(255) DEFAULT NULL,
  `po_date` date DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `reference_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `select_customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `main_cost_center_id` int(10) DEFAULT NULL,
  `sub_cost_center_id` int(10) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `purchase_bill_no` text DEFAULT NULL,
  `json_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `docket_no` text DEFAULT NULL,
  `due_date` text DEFAULT NULL,
  `terms` text DEFAULT NULL,
  `overall_discount` text DEFAULT NULL,
  `subtotal` text DEFAULT NULL,
  `tax` text DEFAULT NULL,
  `discount` text DEFAULT NULL,
  `total` text DEFAULT NULL,
  `attachment` text DEFAULT NULL,
  `status` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_bills`
--

INSERT INTO `purchase_bills` (`id`, `purchase_invoice_number`, `phone_number`, `e_way_bill_no`, `billing_address`, `shipping_address`, `po_no`, `po_date`, `description`, `reference_no`, `created_at`, `updated_at`, `deleted_at`, `select_customer_id`, `payment_type_id`, `created_by_id`, `main_cost_center_id`, `sub_cost_center_id`, `notes`, `purchase_bill_no`, `json_data`, `docket_no`, `due_date`, `terms`, `overall_discount`, `subtotal`, `tax`, `discount`, `total`, `attachment`, `status`) VALUES
(20, 'ET-20251009072112639', '8863897163', '7832', 'svccv xc xc dx&nbsp;', 'serdvesv cdx&nbsp;', 'ET-20251009-0001', '2025-10-09', NULL, 'qwer', '2025-10-09 01:51:12', '2025-10-09 01:51:12', NULL, 1, 1, 1, 1, 1, 'asdfcvb', NULL, '\"{\\\"_token\\\":\\\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251009-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"purchase_bill_no\\\":\\\"2343453\\\",\\\"po_date\\\":\\\"2025-10-09\\\",\\\"due_date\\\":\\\"2025-10-09\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx&nbsp;\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx&nbsp;\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"6\\\",\\\"amount\\\":\\\"10494.00\\\"},{\\\"id\\\":\\\"9\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"300\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"12\\\",\\\"amount\\\":\\\"3248.00\\\"}],\\\"description\\\":\\\"sdxfcgvbn\\\",\\\"terms\\\":\\\"sdfghjm\\\",\\\"overall_discount\\\":\\\"1000\\\",\\\"subtotal\\\":\\\"13742.00\\\",\\\"tax\\\":\\\"1019.40\\\",\\\"discount\\\":\\\"1200.00\\\",\\\"total\\\":\\\"13761.40\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"qwer\\\",\\\"notes\\\":\\\"asdfcvb\\\",\\\"image\\\":{},\\\"document\\\":{}}\"', '23434', '2025-10-09', 'sdfghjm', '1000', '13742.00', '1019.40', '1200.00', '13761.40', NULL, 'pending'),
(21, 'ET-20251009080425838', '8863897163', '7832', 'svccv xc xc dx&nbsp;', 'serdvesv cdx&nbsp;', 'ET-20251009-0002', '2025-10-09', NULL, 'uhsfjhe88', '2025-10-09 02:34:25', '2025-10-09 02:34:25', NULL, 1, 1, 1, 1, 1, 'sdert', NULL, '\"{\\\"_token\\\":\\\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251009-0002\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"purchase_bill_no\\\":\\\"2343453\\\",\\\"po_date\\\":\\\"2025-10-09\\\",\\\"due_date\\\":\\\"2025-10-09\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx&nbsp;\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx&nbsp;\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"20\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"21890.00\\\"},{\\\"id\\\":\\\"11\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"5454\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"10708.00\\\"}],\\\"description\\\":\\\"lkjhgf\\\",\\\"terms\\\":\\\"uyd\\\",\\\"overall_discount\\\":\\\"1000\\\",\\\"subtotal\\\":\\\"32598.00\\\",\\\"tax\\\":\\\"12897.00\\\",\\\"discount\\\":\\\"1200.00\\\",\\\"total\\\":\\\"44495.00\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"notes\\\":\\\"sdert\\\",\\\"image\\\":{},\\\"document\\\":{}}\"', '23434', '2025-10-09', 'uyd', '1000', '32598.00', '12897.00', '1200.00', '44495.00', NULL, 'pending'),
(22, 'ET-20251105114011943', '9229779459', '7832', 'Voluptatem aut moll', 'Architecto eos cum n', 'ET-20251105-0001', '2025-11-05', NULL, 'uhsfjhe88', '2025-11-05 06:10:11', '2025-11-05 06:10:11', NULL, 4, 4, 3, 4, 2, NULL, NULL, '\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"ET-20251105-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"purchase_bill_no\\\":\\\"2343453\\\",\\\"po_date\\\":\\\"2025-11-05\\\",\\\"due_date\\\":\\\"2025-11-05\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"Architecto eos cum n\\\",\\\"items\\\":[{\\\"id\\\":\\\"22\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"2000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"20000.00\\\"}],\\\"description\\\":\\\"qewfsdgbh\\\",\\\"terms\\\":\\\"waesrdtfgh\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"20000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"20000.00\\\",\\\"payment_type_id\\\":\\\"4\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"notes\\\":null}\"', '23434', '2025-11-05', 'waesrdtfgh', '0', '20000.00', '0.00', '0.00', '20000.00', NULL, 'pending'),
(23, 'ET-20251105114221659', '9229779459', NULL, 'Voluptatem aut moll', 'Architecto eos cum n', 'ET-20251105-0002', '2025-11-05', NULL, 'dfbnfgb', '2025-11-05 06:12:21', '2025-11-05 06:12:21', NULL, 4, 4, 3, 4, 2, NULL, NULL, '\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"ET-20251105-0002\\\",\\\"docket_no\\\":null,\\\"purchase_bill_no\\\":null,\\\"po_date\\\":\\\"2025-11-05\\\",\\\"due_date\\\":\\\"2025-11-05\\\",\\\"e_way_bill_no\\\":null,\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"Architecto eos cum n\\\",\\\"items\\\":[{\\\"id\\\":\\\"22\\\",\\\"qty\\\":\\\"3\\\",\\\"price\\\":\\\"2000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"6000.00\\\"}],\\\"description\\\":\\\"asfdfb\\\",\\\"terms\\\":\\\"sdbvdfb\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"6000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"6000.00\\\",\\\"payment_type_id\\\":\\\"4\\\",\\\"reference_no\\\":\\\"dfbnfgb\\\",\\\"notes\\\":null}\"', NULL, '2025-11-05', 'sdbvdfb', '0', '6000.00', '0.00', '0.00', '6000.00', NULL, 'pending'),
(24, 'ET-20251105120452643', '9229779459', '7832', 'Voluptatem aut moll', 'Architecto eos cum n', 'ET-20251105-0003', '2025-11-05', NULL, 'rghryjtuh', '2025-11-05 06:34:52', '2025-11-05 06:34:52', NULL, 4, 4, 3, 4, 2, NULL, NULL, '\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"ET-20251105-0003\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"purchase_bill_no\\\":\\\"2343453\\\",\\\"po_date\\\":\\\"2025-11-05\\\",\\\"due_date\\\":\\\"2025-11-05\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"Architecto eos cum n\\\",\\\"items\\\":[{\\\"id\\\":\\\"30\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"10000.00\\\"}],\\\"description\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"10000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"10000.00\\\",\\\"payment_type_id\\\":\\\"4\\\",\\\"reference_no\\\":\\\"rghryjtuh\\\",\\\"notes\\\":null}\"', '23434', '2025-11-05', NULL, '0', '10000.00', '0.00', '0.00', '10000.00', NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_logs`
--

CREATE TABLE `purchase_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `party_id` bigint(20) UNSIGNED DEFAULT NULL,
  `main_cost_center_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_cost_center_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `json_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `extra_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`extra_data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `purchase_bill_id` int(10) DEFAULT NULL,
  `stock_id` text DEFAULT NULL,
  `previous_qty` text DEFAULT NULL,
  `purchased_qty` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `purchased_amount` text DEFAULT NULL,
  `created_by_id` text DEFAULT NULL,
  `json_data_add_item_purchase_invoice` text DEFAULT NULL,
  `json_data_current_stock` text DEFAULT NULL,
  `json_data_purchase_invoice` text DEFAULT NULL,
  `item_type` text DEFAULT NULL,
  `purchased_to_user_id` text DEFAULT NULL,
  `item_id` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_logs`
--

INSERT INTO `purchase_logs` (`id`, `party_id`, `main_cost_center_id`, `sub_cost_center_id`, `payment_type_id`, `json_data`, `extra_data`, `created_at`, `updated_at`, `purchase_bill_id`, `stock_id`, `previous_qty`, `purchased_qty`, `price`, `purchased_amount`, `created_by_id`, `json_data_add_item_purchase_invoice`, `json_data_current_stock`, `json_data_purchase_invoice`, `item_type`, `purchased_to_user_id`, `item_id`) VALUES
(16, 1, 1, 1, 1, '{\"_token\":\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\",\"select_customer_id\":\"1\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"po_no\":\"ET-20251009-0001\",\"docket_no\":\"23434\",\"purchase_bill_no\":\"2343453\",\"po_date\":\"2025-10-09\",\"due_date\":\"2025-10-09\",\"e_way_bill_no\":\"7832\",\"customer_phone_invoice\":\"8863897163\",\"billing_address_invoice\":\"svccv xc xc dx&nbsp;\",\"shipping_address_invoice\":\"serdvesv cdx&nbsp;\",\"items\":[{\"id\":\"7\",\"qty\":\"10\",\"price\":\"1000\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"6\",\"amount\":\"10494.00\"},{\"id\":\"9\",\"qty\":\"10\",\"price\":\"300\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"12\",\"amount\":\"3248.00\"}],\"description\":\"sdxfcgvbn\",\"terms\":\"sdfghjm\",\"overall_discount\":\"1000\",\"subtotal\":\"13742.00\",\"tax\":\"1019.40\",\"discount\":\"1200.00\",\"total\":\"13761.40\",\"payment_type_id\":\"1\",\"reference_no\":\"qwer\",\"notes\":\"asdfcvb\",\"image\":{},\"document\":{}}', NULL, '2025-10-09 01:51:12', '2025-10-09 01:51:12', 20, '6', '650', '10', '1000', '10494.00', '1', '{\"purchase_invoice_number\":\"ET-20251009072112639\",\"select_customer_id\":\"1\",\"po_no\":\"ET-20251009-0001\",\"reference_no\":\"qwer\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":\"2025-10-09\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx&nbsp;\",\"shipping_address\":\"serdvesv cdx&nbsp;\",\"notes\":\"asdfcvb\",\"terms\":\"sdfghjm\",\"overall_discount\":\"1000\",\"subtotal\":\"13742.00\",\"tax\":\"1019.40\",\"discount\":\"1200.00\",\"total\":\"13761.40\",\"attachment\":null,\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"payment_type_id\":\"1\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251009-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"purchase_bill_no\\\":\\\"2343453\\\",\\\"po_date\\\":\\\"2025-10-09\\\",\\\"due_date\\\":\\\"2025-10-09\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx&nbsp;\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx&nbsp;\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"6\\\",\\\"amount\\\":\\\"10494.00\\\"},{\\\"id\\\":\\\"9\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"300\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"12\\\",\\\"amount\\\":\\\"3248.00\\\"}],\\\"description\\\":\\\"sdxfcgvbn\\\",\\\"terms\\\":\\\"sdfghjm\\\",\\\"overall_discount\\\":\\\"1000\\\",\\\"subtotal\\\":\\\"13742.00\\\",\\\"tax\\\":\\\"1019.40\\\",\\\"discount\\\":\\\"1200.00\\\",\\\"total\\\":\\\"13761.40\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"qwer\\\",\\\"notes\\\":\\\"asdfcvb\\\",\\\"image\\\":{},\\\"document\\\":{}}\",\"updated_at\":\"2025-10-09 07:21:12\",\"created_at\":\"2025-10-09 07:21:12\",\"id\":20,\"image\":null,\"document\":null,\"media\":[]}', '{\"id\":6,\"qty\":660,\"type\":\"Opening Stock\",\"created_at\":\"2025-09-09 08:43:41\",\"updated_at\":\"2025-10-09 07:21:12\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":1,\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"4\\\",\\\"item_code\\\":\\\"ITM-6258-8965\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"1500\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"1\\\"},\\\"wholesale\\\":{\\\"wholesale_price\\\":\\\"1200\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\"},\\\"purchase\\\":{\\\"purchase_price\\\":\\\"1000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":\\\"10\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\"},\\\"online\\\":{\\\"title\\\":\\\"EEMOTRACK INDIA\\\",\\\"description\\\":\\\"Zcx e 4gregg34 erg 4egr\\\"}}\",\"item_id\":\"7\"}', '{\"id\":\"7\",\"qty\":\"10\",\"price\":\"1000\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"6\",\"amount\":\"10494.00\"}', NULL, '1', NULL),
(17, 1, 1, 1, 1, '{\"_token\":\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\",\"select_customer_id\":\"1\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"po_no\":\"ET-20251009-0001\",\"docket_no\":\"23434\",\"purchase_bill_no\":\"2343453\",\"po_date\":\"2025-10-09\",\"due_date\":\"2025-10-09\",\"e_way_bill_no\":\"7832\",\"customer_phone_invoice\":\"8863897163\",\"billing_address_invoice\":\"svccv xc xc dx&nbsp;\",\"shipping_address_invoice\":\"serdvesv cdx&nbsp;\",\"items\":[{\"id\":\"7\",\"qty\":\"10\",\"price\":\"1000\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"6\",\"amount\":\"10494.00\"},{\"id\":\"9\",\"qty\":\"10\",\"price\":\"300\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"12\",\"amount\":\"3248.00\"}],\"description\":\"sdxfcgvbn\",\"terms\":\"sdfghjm\",\"overall_discount\":\"1000\",\"subtotal\":\"13742.00\",\"tax\":\"1019.40\",\"discount\":\"1200.00\",\"total\":\"13761.40\",\"payment_type_id\":\"1\",\"reference_no\":\"qwer\",\"notes\":\"asdfcvb\",\"image\":{},\"document\":{}}', NULL, '2025-10-09 01:51:12', '2025-10-09 01:51:12', 20, NULL, NULL, '10', '300', '3248.00', '1', '{\"purchase_invoice_number\":\"ET-20251009072112639\",\"select_customer_id\":\"1\",\"po_no\":\"ET-20251009-0001\",\"reference_no\":\"qwer\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":\"2025-10-09\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx&nbsp;\",\"shipping_address\":\"serdvesv cdx&nbsp;\",\"notes\":\"asdfcvb\",\"terms\":\"sdfghjm\",\"overall_discount\":\"1000\",\"subtotal\":\"13742.00\",\"tax\":\"1019.40\",\"discount\":\"1200.00\",\"total\":\"13761.40\",\"attachment\":null,\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"payment_type_id\":\"1\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251009-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"purchase_bill_no\\\":\\\"2343453\\\",\\\"po_date\\\":\\\"2025-10-09\\\",\\\"due_date\\\":\\\"2025-10-09\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx&nbsp;\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx&nbsp;\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"6\\\",\\\"amount\\\":\\\"10494.00\\\"},{\\\"id\\\":\\\"9\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"300\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"12\\\",\\\"amount\\\":\\\"3248.00\\\"}],\\\"description\\\":\\\"sdxfcgvbn\\\",\\\"terms\\\":\\\"sdfghjm\\\",\\\"overall_discount\\\":\\\"1000\\\",\\\"subtotal\\\":\\\"13742.00\\\",\\\"tax\\\":\\\"1019.40\\\",\\\"discount\\\":\\\"1200.00\\\",\\\"total\\\":\\\"13761.40\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"qwer\\\",\\\"notes\\\":\\\"asdfcvb\\\",\\\"image\\\":{},\\\"document\\\":{}}\",\"updated_at\":\"2025-10-09 07:21:12\",\"created_at\":\"2025-10-09 07:21:12\",\"id\":20,\"image\":null,\"document\":null,\"media\":[]}', NULL, '{\"id\":\"9\",\"qty\":\"10\",\"price\":\"300\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"12\",\"amount\":\"3248.00\"}', NULL, '1', NULL),
(18, 1, 1, 1, 1, '{\"_token\":\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\",\"select_customer_id\":\"1\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"po_no\":\"ET-20251009-0002\",\"docket_no\":\"23434\",\"purchase_bill_no\":\"2343453\",\"po_date\":\"2025-10-09\",\"due_date\":\"2025-10-09\",\"e_way_bill_no\":\"7832\",\"customer_phone_invoice\":\"8863897163\",\"billing_address_invoice\":\"svccv xc xc dx&nbsp;\",\"shipping_address_invoice\":\"serdvesv cdx&nbsp;\",\"items\":[{\"id\":\"7\",\"qty\":\"20\",\"price\":\"1000\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"10\",\"amount\":\"21890.00\"},{\"id\":\"11\",\"qty\":\"1\",\"price\":\"5454\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"100\",\"amount\":\"10708.00\"}],\"description\":\"lkjhgf\",\"terms\":\"uyd\",\"overall_discount\":\"1000\",\"subtotal\":\"32598.00\",\"tax\":\"12897.00\",\"discount\":\"1200.00\",\"total\":\"44495.00\",\"payment_type_id\":\"1\",\"reference_no\":\"uhsfjhe88\",\"notes\":\"sdert\",\"image\":{},\"document\":{}}', NULL, '2025-10-09 02:34:32', '2025-10-09 02:34:32', 21, '6', '660', '20', '1000', '21890.00', '1', '{\"purchase_invoice_number\":\"ET-20251009080425838\",\"select_customer_id\":\"1\",\"po_no\":\"ET-20251009-0002\",\"reference_no\":\"uhsfjhe88\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":\"2025-10-09\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx&nbsp;\",\"shipping_address\":\"serdvesv cdx&nbsp;\",\"notes\":\"sdert\",\"terms\":\"uyd\",\"overall_discount\":\"1000\",\"subtotal\":\"32598.00\",\"tax\":\"12897.00\",\"discount\":\"1200.00\",\"total\":\"44495.00\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"payment_type_id\":\"1\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251009-0002\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"purchase_bill_no\\\":\\\"2343453\\\",\\\"po_date\\\":\\\"2025-10-09\\\",\\\"due_date\\\":\\\"2025-10-09\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx&nbsp;\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx&nbsp;\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"20\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"21890.00\\\"},{\\\"id\\\":\\\"11\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"5454\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"10708.00\\\"}],\\\"description\\\":\\\"lkjhgf\\\",\\\"terms\\\":\\\"uyd\\\",\\\"overall_discount\\\":\\\"1000\\\",\\\"subtotal\\\":\\\"32598.00\\\",\\\"tax\\\":\\\"12897.00\\\",\\\"discount\\\":\\\"1200.00\\\",\\\"total\\\":\\\"44495.00\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"notes\\\":\\\"sdert\\\",\\\"image\\\":{},\\\"document\\\":{}}\",\"updated_at\":\"2025-10-09 08:04:25\",\"created_at\":\"2025-10-09 08:04:25\",\"id\":21,\"image\":null,\"document\":null,\"media\":[]}', '{\"id\":6,\"qty\":680,\"type\":\"Opening Stock\",\"created_at\":\"2025-09-09 08:43:41\",\"updated_at\":\"2025-10-09 08:04:32\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":1,\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"4\\\",\\\"item_code\\\":\\\"ITM-6258-8965\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"1500\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"1\\\"},\\\"wholesale\\\":{\\\"wholesale_price\\\":\\\"1200\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\"},\\\"purchase\\\":{\\\"purchase_price\\\":\\\"1000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":\\\"10\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\"},\\\"online\\\":{\\\"title\\\":\\\"EEMOTRACK INDIA\\\",\\\"description\\\":\\\"Zcx e 4gregg34 erg 4egr\\\"}}\",\"item_id\":\"7\"}', '{\"id\":\"7\",\"qty\":\"20\",\"price\":\"1000\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"10\",\"amount\":\"21890.00\"}', NULL, '1', NULL),
(19, 1, 1, 1, 1, '{\"_token\":\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\",\"select_customer_id\":\"1\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"po_no\":\"ET-20251009-0002\",\"docket_no\":\"23434\",\"purchase_bill_no\":\"2343453\",\"po_date\":\"2025-10-09\",\"due_date\":\"2025-10-09\",\"e_way_bill_no\":\"7832\",\"customer_phone_invoice\":\"8863897163\",\"billing_address_invoice\":\"svccv xc xc dx&nbsp;\",\"shipping_address_invoice\":\"serdvesv cdx&nbsp;\",\"items\":[{\"id\":\"7\",\"qty\":\"20\",\"price\":\"1000\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"10\",\"amount\":\"21890.00\"},{\"id\":\"11\",\"qty\":\"1\",\"price\":\"5454\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"100\",\"amount\":\"10708.00\"}],\"description\":\"lkjhgf\",\"terms\":\"uyd\",\"overall_discount\":\"1000\",\"subtotal\":\"32598.00\",\"tax\":\"12897.00\",\"discount\":\"1200.00\",\"total\":\"44495.00\",\"payment_type_id\":\"1\",\"reference_no\":\"uhsfjhe88\",\"notes\":\"sdert\",\"image\":{},\"document\":{}}', NULL, '2025-10-09 02:34:32', '2025-10-09 02:34:32', 21, '8', '420', '1', '5454', '10708.00', '1', '{\"purchase_invoice_number\":\"ET-20251009080425838\",\"select_customer_id\":\"1\",\"po_no\":\"ET-20251009-0002\",\"reference_no\":\"uhsfjhe88\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":\"2025-10-09\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx&nbsp;\",\"shipping_address\":\"serdvesv cdx&nbsp;\",\"notes\":\"sdert\",\"terms\":\"uyd\",\"overall_discount\":\"1000\",\"subtotal\":\"32598.00\",\"tax\":\"12897.00\",\"discount\":\"1200.00\",\"total\":\"44495.00\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"payment_type_id\":\"1\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251009-0002\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"purchase_bill_no\\\":\\\"2343453\\\",\\\"po_date\\\":\\\"2025-10-09\\\",\\\"due_date\\\":\\\"2025-10-09\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx&nbsp;\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx&nbsp;\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"20\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"21890.00\\\"},{\\\"id\\\":\\\"11\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"5454\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"10708.00\\\"}],\\\"description\\\":\\\"lkjhgf\\\",\\\"terms\\\":\\\"uyd\\\",\\\"overall_discount\\\":\\\"1000\\\",\\\"subtotal\\\":\\\"32598.00\\\",\\\"tax\\\":\\\"12897.00\\\",\\\"discount\\\":\\\"1200.00\\\",\\\"total\\\":\\\"44495.00\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"notes\\\":\\\"sdert\\\",\\\"image\\\":{},\\\"document\\\":{}}\",\"updated_at\":\"2025-10-09 08:04:25\",\"created_at\":\"2025-10-09 08:04:25\",\"id\":21,\"image\":null,\"document\":null,\"media\":[]}', '{\"id\":8,\"qty\":421,\"type\":\"Opening Stock\",\"created_at\":\"2025-10-04 08:27:06\",\"updated_at\":\"2025-10-09 08:04:32\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":1,\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"481\\\",\\\"item_code\\\":\\\"ITM-3354-0915\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"969\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"138\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"1\\\"},\\\"wholesale\\\":{\\\"wholesale_price\\\":\\\"234352\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"42\\\"},\\\"purchase\\\":{\\\"purchase_price\\\":\\\"5454\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":\\\"435\\\",\\\"low_stock_warning\\\":\\\"53\\\",\\\"warehouse_location\\\":\\\"34\\\"},\\\"online\\\":{\\\"title\\\":null,\\\"description\\\":null}}\",\"item_id\":\"11\"}', '{\"id\":\"11\",\"qty\":\"1\",\"price\":\"5454\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"100\",\"amount\":\"10708.00\"}', NULL, '1', NULL),
(20, 4, 4, 2, 4, '{\"_token\":\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\",\"select_customer_id\":\"4\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"po_no\":\"ET-20251105-0001\",\"docket_no\":\"23434\",\"purchase_bill_no\":\"2343453\",\"po_date\":\"2025-11-05\",\"due_date\":\"2025-11-05\",\"e_way_bill_no\":\"7832\",\"customer_phone_invoice\":\"9229779459\",\"billing_address_invoice\":\"Voluptatem aut moll\",\"shipping_address_invoice\":\"Architecto eos cum n\",\"items\":[{\"id\":\"22\",\"qty\":\"10\",\"price\":\"2000\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"20000.00\"}],\"description\":\"qewfsdgbh\",\"terms\":\"waesrdtfgh\",\"overall_discount\":\"0\",\"subtotal\":\"20000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"20000.00\",\"payment_type_id\":\"4\",\"reference_no\":\"uhsfjhe88\",\"notes\":null}', NULL, '2025-11-05 06:10:11', '2025-11-05 06:10:11', 22, '16', '0', '10', '2000', '20000.00', '3', '{\"purchase_invoice_number\":\"ET-20251105114011943\",\"select_customer_id\":\"4\",\"po_no\":\"ET-20251105-0001\",\"reference_no\":\"uhsfjhe88\",\"docket_no\":\"23434\",\"po_date\":\"2025-11-05\",\"due_date\":\"2025-11-05\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"notes\":null,\"terms\":\"waesrdtfgh\",\"overall_discount\":\"0\",\"subtotal\":\"20000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"20000.00\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"payment_type_id\":\"4\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"ET-20251105-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"purchase_bill_no\\\":\\\"2343453\\\",\\\"po_date\\\":\\\"2025-11-05\\\",\\\"due_date\\\":\\\"2025-11-05\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"Architecto eos cum n\\\",\\\"items\\\":[{\\\"id\\\":\\\"22\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"2000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"20000.00\\\"}],\\\"description\\\":\\\"qewfsdgbh\\\",\\\"terms\\\":\\\"waesrdtfgh\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"20000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"20000.00\\\",\\\"payment_type_id\\\":\\\"4\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"notes\\\":null}\",\"updated_at\":\"2025-11-05 11:40:11\",\"created_at\":\"2025-11-05 11:40:11\",\"id\":22,\"image\":null,\"document\":null,\"media\":[]}', '{\"id\":16,\"qty\":10,\"type\":\"Manufactured Stock\",\"created_at\":\"2025-10-16 07:18:36\",\"updated_at\":\"2025-11-05 11:40:11\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"Andoride Basic\\\",\\\"item_hsn\\\":\\\"AHUYG435\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"5\\\",\\\"item_code\\\":\\\"ITM-5609-7631\\\",\\\"sale_price\\\":\\\"3000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"2500\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"2000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"5\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"select_raw_materials\\\":[\\\"20\\\",\\\"21\\\",\\\"9\\\"],\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"5\\\\\\\"}\\\"}\",\"item_id\":\"22\",\"product_type\":\"finished_goods\"}', '{\"id\":\"22\",\"qty\":\"10\",\"price\":\"2000\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"20000.00\"}', NULL, '4', NULL),
(21, 4, 4, 2, 4, '{\"_token\":\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\",\"select_customer_id\":\"4\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"po_no\":\"ET-20251105-0002\",\"docket_no\":null,\"purchase_bill_no\":null,\"po_date\":\"2025-11-05\",\"due_date\":\"2025-11-05\",\"e_way_bill_no\":null,\"customer_phone_invoice\":\"9229779459\",\"billing_address_invoice\":\"Voluptatem aut moll\",\"shipping_address_invoice\":\"Architecto eos cum n\",\"items\":[{\"id\":\"22\",\"qty\":\"3\",\"price\":\"2000\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"6000.00\"}],\"description\":\"asfdfb\",\"terms\":\"sdbvdfb\",\"overall_discount\":\"0\",\"subtotal\":\"6000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"6000.00\",\"payment_type_id\":\"4\",\"reference_no\":\"dfbnfgb\",\"notes\":null}', NULL, '2025-11-05 06:12:21', '2025-11-05 06:12:21', 23, '16', '10', '3', '2000', '6000.00', '3', '{\"purchase_invoice_number\":\"ET-20251105114221659\",\"select_customer_id\":\"4\",\"po_no\":\"ET-20251105-0002\",\"reference_no\":\"dfbnfgb\",\"docket_no\":null,\"po_date\":\"2025-11-05\",\"due_date\":\"2025-11-05\",\"e_way_bill_no\":null,\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"notes\":null,\"terms\":\"sdbvdfb\",\"overall_discount\":\"0\",\"subtotal\":\"6000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"6000.00\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"payment_type_id\":\"4\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"ET-20251105-0002\\\",\\\"docket_no\\\":null,\\\"purchase_bill_no\\\":null,\\\"po_date\\\":\\\"2025-11-05\\\",\\\"due_date\\\":\\\"2025-11-05\\\",\\\"e_way_bill_no\\\":null,\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"Architecto eos cum n\\\",\\\"items\\\":[{\\\"id\\\":\\\"22\\\",\\\"qty\\\":\\\"3\\\",\\\"price\\\":\\\"2000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"6000.00\\\"}],\\\"description\\\":\\\"asfdfb\\\",\\\"terms\\\":\\\"sdbvdfb\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"6000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"6000.00\\\",\\\"payment_type_id\\\":\\\"4\\\",\\\"reference_no\\\":\\\"dfbnfgb\\\",\\\"notes\\\":null}\",\"updated_at\":\"2025-11-05 11:42:21\",\"created_at\":\"2025-11-05 11:42:21\",\"id\":23,\"image\":null,\"document\":null,\"media\":[]}', '{\"id\":16,\"qty\":13,\"type\":\"Manufactured Stock\",\"created_at\":\"2025-10-16 07:18:36\",\"updated_at\":\"2025-11-05 11:42:21\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"Andoride Basic\\\",\\\"item_hsn\\\":\\\"AHUYG435\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"5\\\",\\\"item_code\\\":\\\"ITM-5609-7631\\\",\\\"sale_price\\\":\\\"3000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"2500\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"2000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"5\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"select_raw_materials\\\":[\\\"20\\\",\\\"21\\\",\\\"9\\\"],\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"5\\\\\\\"}\\\"}\",\"item_id\":\"22\",\"product_type\":\"finished_goods\"}', '{\"id\":\"22\",\"qty\":\"3\",\"price\":\"2000\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"6000.00\"}', NULL, '4', NULL),
(22, 4, 4, 2, 4, '{\"_token\":\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\",\"select_customer_id\":\"4\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"po_no\":\"ET-20251105-0003\",\"docket_no\":\"23434\",\"purchase_bill_no\":\"2343453\",\"po_date\":\"2025-11-05\",\"due_date\":\"2025-11-05\",\"e_way_bill_no\":\"7832\",\"customer_phone_invoice\":\"9229779459\",\"billing_address_invoice\":\"Voluptatem aut moll\",\"shipping_address_invoice\":\"Architecto eos cum n\",\"items\":[{\"id\":\"30\",\"qty\":\"10\",\"price\":\"1000\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"10000.00\"}],\"description\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"10000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"10000.00\",\"payment_type_id\":\"4\",\"reference_no\":\"rghryjtuh\",\"notes\":null}', NULL, '2025-11-05 06:34:52', '2025-11-05 06:34:52', 24, '21', '0', '10', '1000', '10000.00', '3', '{\"purchase_invoice_number\":\"ET-20251105120452643\",\"select_customer_id\":\"4\",\"po_no\":\"ET-20251105-0003\",\"reference_no\":\"rghryjtuh\",\"docket_no\":\"23434\",\"po_date\":\"2025-11-05\",\"due_date\":\"2025-11-05\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"10000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"10000.00\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"payment_type_id\":\"4\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"ET-20251105-0003\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"purchase_bill_no\\\":\\\"2343453\\\",\\\"po_date\\\":\\\"2025-11-05\\\",\\\"due_date\\\":\\\"2025-11-05\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"Architecto eos cum n\\\",\\\"items\\\":[{\\\"id\\\":\\\"30\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"10000.00\\\"}],\\\"description\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"10000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"10000.00\\\",\\\"payment_type_id\\\":\\\"4\\\",\\\"reference_no\\\":\\\"rghryjtuh\\\",\\\"notes\\\":null}\",\"updated_at\":\"2025-11-05 12:04:52\",\"created_at\":\"2025-11-05 12:04:52\",\"id\":24,\"image\":null,\"document\":null,\"media\":[]}', '{\"id\":21,\"qty\":10,\"type\":\"Manufactured Stock\",\"created_at\":\"2025-11-05 12:03:44\",\"updated_at\":\"2025-11-05 12:04:52\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"stock check\\\",\\\"item_hsn\\\":\\\"stockcheck\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":null,\\\"item_code\\\":\\\"ITM-6665-4176\\\",\\\"sale_price\\\":\\\"1200\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":null,\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":null,\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":null,\\\"purchase_price\\\":\\\"1000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":null,\\\"low_stock_warning\\\":null,\\\"warehouse_location\\\":null,\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"raw_qty\\\":{\\\"20\\\":\\\"0\\\",\\\"21\\\":\\\"0\\\",\\\"24\\\":\\\"0\\\",\\\"9\\\":\\\"0\\\"},\\\"raw_sale_price\\\":{\\\"20\\\":\\\"100\\\",\\\"21\\\":\\\"100\\\",\\\"24\\\":\\\"3000\\\",\\\"9\\\":\\\"123\\\"},\\\"raw_purchase_price\\\":{\\\"20\\\":\\\"50\\\",\\\"21\\\":\\\"50\\\",\\\"24\\\":\\\"2000\\\",\\\"9\\\":\\\"0\\\"},\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":null,\\\\\\\"opening_stock\\\\\\\":null,\\\\\\\"composition_totals\\\\\\\":{\\\\\\\"total_sale_value\\\\\\\":0,\\\\\\\"total_purchase_value\\\\\\\":0}}\\\"}\",\"item_id\":\"30\",\"product_type\":\"finished_goods\"}', '{\"id\":\"30\",\"qty\":\"10\",\"price\":\"1000\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"10000.00\"}', NULL, '4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `billing_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `e_way_bill_no` varchar(255) DEFAULT NULL,
  `billing_address` longtext DEFAULT NULL,
  `shipping_address` longtext DEFAULT NULL,
  `po_no` varchar(255) DEFAULT NULL,
  `po_date` date DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `description` longtext DEFAULT NULL,
  `reference_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `select_customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qa_messages`
--

CREATE TABLE `qa_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `topic_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qa_topics`
--

CREATE TABLE `qa_topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `creator_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', NULL, NULL, NULL),
(2, 'User', NULL, NULL, NULL),
(3, 'Company', '2025-08-27 01:25:17', '2025-08-27 01:25:17', NULL),
(4, 'Branch', '2025-10-13 00:34:08', '2025-10-13 00:34:08', NULL),
(5, 'Super Admin', '2025-10-13 00:42:27', '2025-10-13 00:42:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(3, 1),
(4, 4),
(1, 5),
(2, 1),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sale_invoices`
--

CREATE TABLE `sale_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `e_way_bill_no` varchar(255) DEFAULT NULL,
  `billing_address` longtext DEFAULT NULL,
  `shipping_address` longtext DEFAULT NULL,
  `po_no` varchar(255) DEFAULT NULL,
  `po_date` date DEFAULT NULL,
  `notes` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `select_customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `docket_no` text DEFAULT NULL,
  `due_date` text DEFAULT NULL,
  `terms` text DEFAULT NULL,
  `overall_discount` text DEFAULT NULL,
  `subtotal` text DEFAULT NULL,
  `tax` text DEFAULT NULL,
  `discount` text DEFAULT NULL,
  `total` text DEFAULT NULL,
  `attachment` text DEFAULT NULL,
  `sale_invoice_number` text DEFAULT NULL,
  `json_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json_data`)),
  `status` text DEFAULT NULL,
  `main_cost_center_id` int(10) DEFAULT NULL,
  `sub_cost_center_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_invoices`
--

INSERT INTO `sale_invoices` (`id`, `payment_type`, `phone_number`, `e_way_bill_no`, `billing_address`, `shipping_address`, `po_no`, `po_date`, `notes`, `created_at`, `updated_at`, `deleted_at`, `select_customer_id`, `created_by_id`, `docket_no`, `due_date`, `terms`, `overall_discount`, `subtotal`, `tax`, `discount`, `total`, `attachment`, `sale_invoice_number`, `json_data`, `status`, `main_cost_center_id`, `sub_cost_center_id`) VALUES
(10, 'credit', '8863897163', '7832', 'svccv xc xc dx', 'serdvesv cdx', 'PO-20251007-0001', '2025-10-07', 'scvs  w r4ewswr 2', '2025-10-07 05:03:15', '2025-10-07 05:03:15', NULL, 1, 1, '23434', '2025-10-07 00:00:00', 'w3feseg', '200', '20119.00', '2011.90', '600.00', '21930.90', 'attachments/8afzqRIxlTA1fCyaw7cob9t13GRvHwb8ZHAVaDyr.pdf', 'ET-20251007103315512', '{\"_token\":\"s0DPzqkbrhfqtwnUSJDO3dhMudiXIXa1IXz4I2ym\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251007-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-07\",\"due_date\":\"2025-10-07\",\"e_way_bill_no\":\"7832\",\"customer_phone_invoice\":\"8863897163\",\"billing_address_invoice\":\"svccv xc xc dx\",\"shipping_address_invoice\":\"serdvesv cdx\",\"items\":[{\"add_item_id\":\"7\",\"qty\":\"6\",\"price\":\"1500\",\"discount_type\":\"value\",\"discount\":\"200\",\"tax_type\":\"with\",\"tax\":\"10\",\"amount\":\"9680.00\"},{\"add_item_id\":\"11\",\"qty\":\"10\",\"price\":\"969\",\"discount_type\":\"value\",\"discount\":\"200\",\"tax_type\":\"with\",\"tax\":\"10\",\"amount\":\"10439.00\"}],\"notes\":\"scvs  w r4ewswr 2\",\"terms\":\"w3feseg\",\"overall_discount\":\"200\",\"subtotal\":\"20119.00\",\"tax\":\"2011.90\",\"discount\":\"600.00\",\"total\":\"21930.90\",\"attachment\":{}}', 'pending', NULL, 0),
(11, 'credit', '8863897163', '7832', 'svccv xc xc dx', 'serdvesv cdx', 'PO-20251009-0001', '2025-10-09', 'sd', '2025-10-09 03:49:02', '2025-10-09 03:49:02', NULL, 1, 1, '23434', NULL, 'wqerfgf', '100', '3314.30', '331.43', '210.00', '3545.73', NULL, 'ET-20251009091902499', '{\"_token\":\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"po_no\":\"PO-20251009-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":null,\"e_way_bill_no\":\"7832\",\"customer_phone_invoice\":\"8863897163\",\"billing_address_invoice\":\"svccv xc xc dx\",\"shipping_address_invoice\":\"serdvesv cdx\",\"items\":[{\"add_item_id\":\"7\",\"qty\":\"2\",\"price\":\"1500\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"10\",\"amount\":\"3190.00\"},{\"add_item_id\":\"9\",\"qty\":\"1\",\"price\":\"123\",\"discount_type\":\"value\",\"discount\":\"10\",\"tax_type\":\"with\",\"tax\":\"10\",\"amount\":\"124.30\"}],\"notes\":\"sd\",\"terms\":\"wqerfgf\",\"overall_discount\":\"100\",\"subtotal\":\"3314.30\",\"tax\":\"331.43\",\"discount\":\"210.00\",\"total\":\"3545.73\",\"attachment\":{}}', 'pending', 1, 1),
(12, 'credit', '8863897163', '7832', 'svccv xc xc dx', 'serdvesv cdx', 'PO-20251009-0002', '2025-10-09', 'sdvf', '2025-10-09 03:54:16', '2025-10-09 03:54:16', NULL, 1, 1, '23434', NULL, 'asdf', '0', '100.00', '0.00', '0.00', '100.00', NULL, 'ET-20251009092416679', '{\"_token\":\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"po_no\":\"PO-20251009-0002\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":null,\"e_way_bill_no\":\"7832\",\"customer_phone_invoice\":\"8863897163\",\"billing_address_invoice\":\"svccv xc xc dx\",\"shipping_address_invoice\":\"serdvesv cdx\",\"items\":[{\"add_item_id\":\"9\",\"qty\":\"1\",\"price\":\"100\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"100.00\"}],\"notes\":\"sdvf\",\"terms\":\"asdf\",\"overall_discount\":\"0\",\"subtotal\":\"100.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"100.00\",\"attachment\":{}}', 'pending', 1, 1),
(13, 'credit', '8863897163', NULL, 'svccv xc xc dx', 'serdvesv cdx', 'PO-20251009-0003', '2025-10-09', NULL, '2025-10-09 08:16:53', '2025-10-09 08:16:53', NULL, 1, 1, '23434', NULL, NULL, '0', '2453.00', '89.04', '100.00', '2542.04', NULL, 'ET-20251009134653248', '{\"_token\":\"Fo6CTOR4BQvP7trjCp3lQiwMTn8fAP8VLsoZ5EBT\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"po_no\":\"PO-20251009-0003\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":null,\"e_way_bill_no\":null,\"customer_phone_invoice\":\"8863897163\",\"billing_address_invoice\":\"svccv xc xc dx\",\"shipping_address_invoice\":\"serdvesv cdx\",\"items\":[{\"add_item_id\":\"7\",\"qty\":\"1\",\"price\":\"1500\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"6\",\"amount\":\"1484.00\"},{\"add_item_id\":\"11\",\"qty\":\"1\",\"price\":\"969\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"969.00\"}],\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"2453.00\",\"tax\":\"89.04\",\"discount\":\"100.00\",\"total\":\"2542.04\"}', 'pending', 1, 1),
(14, 'credit', '9229779459', '7832', 'Voluptatem aut moll', 'tnmgjhkj', 'PO-20251103-0001', '2025-11-03', NULL, '2025-11-03 05:15:43', '2025-11-04 06:11:33', NULL, 4, 3, '23434', '2025-11-03 00:00:00', NULL, '0', '2300.00', '0.00', '0.00', '2300.00', NULL, 'ET-20251103104543519', '{\"_token\":\"9SlzqBE8v1fmGNgB5xkNdizYUkTJ0Isd7IRCc8NH\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"po_no\":\"PO-20251103-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-11-03\",\"due_date\":\"2025-11-03\",\"e_way_bill_no\":\"7832\",\"customer_phone_invoice\":\"9229779459\",\"billing_address_invoice\":\"Voluptatem aut moll\",\"shipping_address_invoice\":\"tnmgjhkj\",\"items\":[{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"2000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"2000.00\"},{\"add_item_id\":\"9\",\"qty\":\"1\",\"price\":\"300\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"300.00\"}],\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"2300.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"2300.00\"}', 'Manufacture Confirmed', 4, 2),
(15, 'credit', '9229779459', '4354', 'Voluptatem aut moll', NULL, 'PO-20251104-0001', '2025-11-04', NULL, '2025-11-04 06:06:08', '2025-11-07 05:33:48', NULL, 4, 3, '45654', '2025-11-04 00:00:00', NULL, '0', '2500.00', '0.00', '0.00', '2500.00', NULL, 'ET-20251104113608642', '{\"_token\":\"6ASVoJ3pV8P0JUq8D76lg5Cd0FLKdZhpICTmJvim\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"po_no\":\"PO-20251104-0001\",\"docket_no\":\"45654\",\"po_date\":\"2025-11-04\",\"due_date\":\"2025-11-04\",\"e_way_bill_no\":\"4354\",\"customer_phone_invoice\":\"9229779459\",\"billing_address_invoice\":\"Voluptatem aut moll\",\"shipping_address_invoice\":null,\"items\":[{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"2500.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"2500.00\"}],\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"2500.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"2500.00\"}', 'Pending', 4, 2),
(16, 'credit', '9229779459', '4354', 'Voluptatem aut moll', 'Architecto eos cum n', 'PO-20251104-0002', '2025-11-04', NULL, '2025-11-04 06:33:56', '2025-11-07 01:48:55', NULL, 4, 3, '32423', NULL, NULL, '0', '15000.00', '0.00', '0.00', '15000.00', NULL, 'ET-20251104120356123', '{\"_token\":\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\",\"_method\":\"PUT\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251104-0002\",\"docket_no\":\"32423\",\"po_date\":\"2025-11-04\",\"due_date\":null,\"e_way_bill_no\":\"4354\",\"customer_phone_invoice\":\"9229779459\",\"billing_address_invoice\":\"Voluptatem aut moll\",\"shipping_address_invoice\":\"Architecto eos cum n\",\"items\":[{\"add_item_id\":\"22\",\"qty\":\"5\",\"price\":\"2600.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"13000.00\"},{\"add_item_id\":\"9\",\"qty\":\"5\",\"price\":\"400\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"2000.00\"}],\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"15000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"15000.00\"}', 'Pending', 4, 2),
(17, 'credit', '9229779459', '7832', 'Voluptatem aut moll', 'wefve', 'PO-20251107-0001', '2025-11-08', 'esdv c', '2025-11-07 04:43:06', '2025-11-08 02:14:57', NULL, 4, 5, '23434', '2025-11-07 00:00:00', 'esdv', '0.00', '2542.37', '457.63', '0.00', '3000.00', NULL, 'ET-20251107101306583', '{\"_token\":\"W2Q6uMHJGMYYBZa9TKWVG89wGDh0NDLSTpTJj6Di\",\"_method\":\"PUT\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"po_no\":\"PO-20251107-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-11-08\",\"due_date\":\"2025-11-07\",\"e_way_bill_no\":\"7832\",\"customer_phone_invoice\":\"9229779459\",\"billing_address_invoice\":\"Voluptatem aut moll\",\"shipping_address_invoice\":\"wefve\",\"items\":[{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"3000.00\"}],\"notes\":\"esdv c\",\"terms\":\"esdv\",\"overall_discount\":\"0.00\",\"subtotal\":\"2542.37\",\"tax\":\"457.63\",\"discount\":\"0.00\",\"total\":\"3000.00\"}', 'Pending', 4, 3),
(18, 'credit', '9229779459', '7832', 'Voluptatem aut moll', '234erty', 'PO-20251202-0001', '2025-12-02', 'sdcv', '2025-12-02 04:32:36', '2025-12-02 04:32:36', NULL, 4, 3, 'qwerty', NULL, 'qwsdcv', '0', '2646.61', '476.39', '0.00', '3123.00', NULL, 'ET-20251202100236802', '{\"_token\":\"REcPD33kSQLYdgO5G86rimCXV5d8piIyCi4mdSGN\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"po_no\":\"PO-20251202-0001\",\"docket_no\":\"qwerty\",\"po_date\":\"2025-12-02\",\"due_date\":null,\"e_way_bill_no\":\"7832\",\"customer_phone_invoice\":\"9229779459\",\"billing_address_invoice\":\"Voluptatem aut moll\",\"shipping_address_invoice\":\"234erty\",\"items\":[{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"3000.00\"},{\"add_item_id\":\"9\",\"qty\":\"1\",\"price\":\"123.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"123.00\"}],\"notes\":\"sdcv\",\"terms\":\"qwsdcv\",\"overall_discount\":\"0\",\"subtotal\":\"2646.61\",\"tax\":\"476.39\",\"discount\":\"0.00\",\"total\":\"3123.00\"}', 'Draft', 4, 3),
(19, 'credit', '9229779459', '4567', 'Voluptatem aut moll', 'ertyui', 'PO-20251202-0002', '2025-12-02', 'qwerthj', '2025-12-02 06:12:20', '2025-12-02 06:17:41', NULL, 4, 3, '98765', '2025-12-02 00:00:00', 'wertyui', '100', '2542.37', '457.63', '100.00', '2900.00', NULL, 'ET-20251202114220322', '{\"_token\":\"REcPD33kSQLYdgO5G86rimCXV5d8piIyCi4mdSGN\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251202-0002\",\"docket_no\":\"98765\",\"po_date\":\"2025-12-02\",\"due_date\":\"2025-12-02\",\"e_way_bill_no\":\"4567\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"ertyui\",\"notes\":\"qwerthj\",\"terms\":\"wertyui\",\"overall_discount\":\"100\",\"subtotal\":\"2542.37\",\"tax\":\"457.63\",\"discount\":\"100.00\",\"total\":\"2900.00\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"items\":[{\"add_item_id\":\"22\",\"description\":null,\"qty\":\"1\",\"unit\":null,\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"3000.00\",\"json_data\":\"{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"18\\\",\\\"amount\\\":\\\"3000.00\\\"}\"}]}', 'Approved', 4, 3),
(21, 'credit', NULL, NULL, 'Patna vatacharya road kamla market 2nd floor', 'Patna vatacharya road kamla market 2nd floor', 'PO-20251210-0001', '2025-12-10', NULL, '2025-12-10 06:38:13', '2025-12-10 06:38:13', NULL, 4, 3, NULL, '2025-12-10 00:00:00', NULL, '200', '4001.69', '720.31', '200.00', '4522.00', NULL, 'SI-20251210120813157', '{\"id\":2,\"estimate_quotations_number\":\"EST-20251210083027786\",\"phone_number\":null,\"e_way_bill_no\":null,\"billing_address\":\"Patna vatacharya road kamla market 2nd floor\",\"shipping_address\":\"Patna vatacharya road kamla market 2nd floor\",\"po_no\":\"PO-20251210-0001\",\"po_date\":\"2025-12-10\",\"qty\":null,\"sub_cost_centers_id\":\"2\",\"main_cost_centers_id\":\"1\",\"description\":null,\"created_at\":\"2025-12-10 08:30:27\",\"updated_at\":\"2025-12-10 08:30:27\",\"deleted_at\":null,\"select_customer_id\":4,\"created_by_id\":3,\"due_date\":\"2025-12-10\",\"status\":null,\"docket_no\":null,\"terms\":null,\"notes\":\"this is estimate quatition bill\",\"overall_discount\":\"200\",\"tax_amount\":null,\"adjustment\":null,\"round_off\":null,\"total\":\"4522.00\",\"payment_type\":\"credit\",\"subtotal\":\"4001.69\",\"tax\":\"720.31\",\"discount\":\"200.00\",\"json_data\":null,\"image\":null,\"document\":{\"id\":21,\"model_type\":\"App\\\\Models\\\\EstimateQuotation\",\"model_id\":2,\"uuid\":\"5cb383dd-c5e5-495c-ae24-0a5840a8dac2\",\"collection_name\":\"document\",\"name\":\"profit-loss-18\",\"file_name\":\"profit-loss-18.pdf\",\"mime_type\":\"application\\/pdf\",\"disk\":\"public\",\"conversions_disk\":\"public\",\"size\":92014,\"manipulations\":[],\"custom_properties\":[],\"generated_conversions\":[],\"responsive_images\":[],\"order_column\":1,\"created_at\":\"2025-12-10T08:30:30.000000Z\",\"updated_at\":\"2025-12-10T08:30:30.000000Z\",\"original_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/21\\/profit-loss-18.pdf\",\"preview_url\":\"\"},\"media\":[{\"id\":21,\"model_type\":\"App\\\\Models\\\\EstimateQuotation\",\"model_id\":2,\"uuid\":\"5cb383dd-c5e5-495c-ae24-0a5840a8dac2\",\"collection_name\":\"document\",\"name\":\"profit-loss-18\",\"file_name\":\"profit-loss-18.pdf\",\"mime_type\":\"application\\/pdf\",\"disk\":\"public\",\"conversions_disk\":\"public\",\"size\":92014,\"manipulations\":[],\"custom_properties\":[],\"generated_conversions\":[],\"responsive_images\":[],\"order_column\":1,\"created_at\":\"2025-12-10T08:30:30.000000Z\",\"updated_at\":\"2025-12-10T08:30:30.000000Z\",\"original_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/21\\/profit-loss-18.pdf\",\"preview_url\":\"\"}]}', 'converted from estimate', 1, 2),
(22, 'credit', NULL, NULL, 'Patna vatacharya road kamla market 2nd floor', 'Patna vatacharya road kamla market 2nd floor', 'PO-20251210-0001', '2025-12-10', NULL, '2025-12-11 01:03:28', '2025-12-11 01:03:28', NULL, 4, 3, NULL, '2025-12-10 00:00:00', NULL, '200', '4001.69', '720.31', '200.00', '4522.00', NULL, 'SI-20251211063328162', '{\"id\":2,\"estimate_quotations_number\":\"EST-20251210083027786\",\"phone_number\":null,\"e_way_bill_no\":null,\"billing_address\":\"Patna vatacharya road kamla market 2nd floor\",\"shipping_address\":\"Patna vatacharya road kamla market 2nd floor\",\"po_no\":\"PO-20251210-0001\",\"po_date\":\"2025-12-10\",\"qty\":null,\"sub_cost_centers_id\":\"2\",\"main_cost_centers_id\":\"1\",\"description\":null,\"created_at\":\"2025-12-10 08:30:27\",\"updated_at\":\"2025-12-10 08:30:27\",\"deleted_at\":null,\"select_customer_id\":4,\"created_by_id\":3,\"due_date\":\"2025-12-10\",\"status\":null,\"docket_no\":null,\"terms\":null,\"notes\":\"this is estimate quatition bill\",\"overall_discount\":\"200\",\"tax_amount\":null,\"adjustment\":null,\"round_off\":null,\"total\":\"4522.00\",\"payment_type\":\"credit\",\"subtotal\":\"4001.69\",\"tax\":\"720.31\",\"discount\":\"200.00\",\"json_data\":null,\"image\":null,\"document\":{\"id\":21,\"model_type\":\"App\\\\Models\\\\EstimateQuotation\",\"model_id\":2,\"uuid\":\"5cb383dd-c5e5-495c-ae24-0a5840a8dac2\",\"collection_name\":\"document\",\"name\":\"profit-loss-18\",\"file_name\":\"profit-loss-18.pdf\",\"mime_type\":\"application\\/pdf\",\"disk\":\"public\",\"conversions_disk\":\"public\",\"size\":92014,\"manipulations\":[],\"custom_properties\":[],\"generated_conversions\":[],\"responsive_images\":[],\"order_column\":1,\"created_at\":\"2025-12-10T08:30:30.000000Z\",\"updated_at\":\"2025-12-10T08:30:30.000000Z\",\"original_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/21\\/profit-loss-18.pdf\",\"preview_url\":\"\"},\"media\":[{\"id\":21,\"model_type\":\"App\\\\Models\\\\EstimateQuotation\",\"model_id\":2,\"uuid\":\"5cb383dd-c5e5-495c-ae24-0a5840a8dac2\",\"collection_name\":\"document\",\"name\":\"profit-loss-18\",\"file_name\":\"profit-loss-18.pdf\",\"mime_type\":\"application\\/pdf\",\"disk\":\"public\",\"conversions_disk\":\"public\",\"size\":92014,\"manipulations\":[],\"custom_properties\":[],\"generated_conversions\":[],\"responsive_images\":[],\"order_column\":1,\"created_at\":\"2025-12-10T08:30:30.000000Z\",\"updated_at\":\"2025-12-10T08:30:30.000000Z\",\"original_url\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/21\\/profit-loss-18.pdf\",\"preview_url\":\"\"}]}', 'converted from estimate', 1, 2),
(23, 'credit', NULL, NULL, 'Patna vatacharya road kamla market 2nd floor', 'Patna vatacharya road kamla market 2nd floor', 'PO-20251210-0001', '2025-12-10', 'this is estimate quatition bill', '2025-12-11 01:39:52', '2025-12-11 01:39:52', NULL, 4, 3, NULL, '2025-12-10 00:00:00', NULL, '200', '4001.69', '720.31', '200.00', '4522.00', NULL, 'SI-20251211070952250', '{\"estimate_id\":2,\"estimate_no\":\"EST-20251210083027786\",\"customer_id\":4,\"subtotal\":\"4001.69\",\"tax\":\"720.31\",\"discount\":\"200.00\",\"total\":\"4522.00\"}', 'converted from estimate', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sale_invoice_status_histories`
--

CREATE TABLE `sale_invoice_status_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_invoice_id` bigint(20) UNSIGNED NOT NULL,
  `old_status` varchar(255) DEFAULT NULL,
  `new_status` varchar(255) NOT NULL,
  `remark` text DEFAULT NULL,
  `changed_by_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_invoice_status_histories`
--

INSERT INTO `sale_invoice_status_histories` (`id`, `sale_invoice_id`, `old_status`, `new_status`, `remark`, `changed_by_id`, `created_at`, `updated_at`) VALUES
(1, 17, 'pending', 'Other', 'sefvsdv', 3, '2025-11-07 05:25:20', '2025-11-07 05:25:20'),
(2, 17, 'Other', 'Approved', NULL, 3, '2025-11-07 05:25:40', '2025-11-07 05:25:40'),
(3, 17, 'Approved', 'Pending', 'egerge', 3, '2025-11-07 05:28:23', '2025-11-07 05:28:23'),
(4, 15, 'Manufacture Confirmed', 'Pending', NULL, 3, '2025-11-07 05:33:48', '2025-11-07 05:33:48'),
(5, 19, 'converted dc to sale', 'Approved', NULL, 3, '2025-12-02 06:17:41', '2025-12-02 06:17:41');

-- --------------------------------------------------------

--
-- Table structure for table `sale_logs`
--

CREATE TABLE `sale_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_invoice_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `item_type` varchar(255) DEFAULT NULL,
  `stock_id` bigint(20) UNSIGNED DEFAULT NULL,
  `previous_qty` int(11) DEFAULT NULL,
  `sold_qty` int(11) DEFAULT NULL,
  `previous_amount` decimal(15,2) DEFAULT NULL,
  `sold_amount` decimal(15,2) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `created_by_id` varchar(255) DEFAULT NULL,
  `json_data_add_item_sale_invoice` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json_data_add_item_sale_invoice`)),
  `json_data_current_stock` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json_data_current_stock`)),
  `json_data_sale_invoice` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json_data_sale_invoice`)),
  `sold_to_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_logs`
--

INSERT INTO `sale_logs` (`id`, `sale_invoice_id`, `item_id`, `item_type`, `stock_id`, `previous_qty`, `sold_qty`, `previous_amount`, `sold_amount`, `price`, `created_by_id`, `json_data_add_item_sale_invoice`, `json_data_current_stock`, `json_data_sale_invoice`, `sold_to_user_id`, `created_at`, `updated_at`) VALUES
(4, 10, 11, 'product', 8, 430, 10, 416670.00, 10439.00, 969.00, '1', '{\"add_item_id\":\"11\",\"qty\":\"10\",\"price\":\"969\",\"discount_type\":\"value\",\"discount\":\"200\",\"tax_type\":\"with\",\"tax\":\"10\",\"amount\":\"10439.00\"}', '{\"id\":8,\"qty\":420,\"type\":\"Opening Stock\",\"created_at\":\"2025-10-04 08:27:06\",\"updated_at\":\"2025-10-07 10:33:15\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":1,\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"481\\\",\\\"item_code\\\":\\\"ITM-3354-0915\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"969\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"138\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"1\\\"},\\\"wholesale\\\":{\\\"wholesale_price\\\":\\\"234352\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"42\\\"},\\\"purchase\\\":{\\\"purchase_price\\\":\\\"5454\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":\\\"435\\\",\\\"low_stock_warning\\\":\\\"53\\\",\\\"warehouse_location\\\":\\\"34\\\"},\\\"online\\\":{\\\"title\\\":null,\\\"description\\\":null}}\",\"item_id\":\"11\"}', '{\"sale_invoice_number\":\"ET-20251007103315512\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251007-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-07\",\"due_date\":\"2025-10-07 00:00:00\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"scvs  w r4ewswr 2\",\"terms\":\"w3feseg\",\"overall_discount\":\"200\",\"subtotal\":\"20119.00\",\"tax\":\"2011.90\",\"discount\":\"600.00\",\"total\":\"21930.90\",\"attachment\":\"attachments\\/8afzqRIxlTA1fCyaw7cob9t13GRvHwb8ZHAVaDyr.pdf\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"s0DPzqkbrhfqtwnUSJDO3dhMudiXIXa1IXz4I2ym\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251007-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-07\\\",\\\"due_date\\\":\\\"2025-10-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"7\\\",\\\"qty\\\":\\\"6\\\",\\\"price\\\":\\\"1500\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"200\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"9680.00\\\"},{\\\"add_item_id\\\":\\\"11\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"969\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"200\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"10439.00\\\"}],\\\"notes\\\":\\\"scvs  w r4ewswr 2\\\",\\\"terms\\\":\\\"w3feseg\\\",\\\"overall_discount\\\":\\\"200\\\",\\\"subtotal\\\":\\\"20119.00\\\",\\\"tax\\\":\\\"2011.90\\\",\\\"discount\\\":\\\"600.00\\\",\\\"total\\\":\\\"21930.90\\\",\\\"attachment\\\":{}}\",\"status\":\"pending\",\"updated_at\":\"2025-10-07 10:33:15\",\"created_at\":\"2025-10-07 10:33:15\",\"id\":10,\"image\":null,\"document\":null,\"media\":[]}', 1, '2025-10-07 05:03:15', '2025-10-07 05:03:15'),
(5, 11, 7, 'product', 6, 680, 2, 1020000.00, 3190.00, 1500.00, '1', '{\"add_item_id\":\"7\",\"qty\":\"2\",\"price\":\"1500\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"10\",\"amount\":\"3190.00\"}', '{\"id\":6,\"qty\":678,\"type\":\"Opening Stock\",\"created_at\":\"2025-09-09 08:43:41\",\"updated_at\":\"2025-10-09 09:19:03\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":1,\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"4\\\",\\\"item_code\\\":\\\"ITM-6258-8965\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"1500\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"1\\\"},\\\"wholesale\\\":{\\\"wholesale_price\\\":\\\"1200\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\"},\\\"purchase\\\":{\\\"purchase_price\\\":\\\"1000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":\\\"10\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\"},\\\"online\\\":{\\\"title\\\":\\\"EEMOTRACK INDIA\\\",\\\"description\\\":\\\"Zcx e 4gregg34 erg 4egr\\\"}}\",\"item_id\":\"7\"}', '{\"sale_invoice_number\":\"ET-20251009091902499\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251009-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":null,\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"sd\",\"terms\":\"wqerfgf\",\"overall_discount\":\"100\",\"subtotal\":\"3314.30\",\"tax\":\"331.43\",\"discount\":\"210.00\",\"total\":\"3545.73\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251009-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-09\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"7\\\",\\\"qty\\\":\\\"2\\\",\\\"price\\\":\\\"1500\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"3190.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"123\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"10\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"124.30\\\"}],\\\"notes\\\":\\\"sd\\\",\\\"terms\\\":\\\"wqerfgf\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"3314.30\\\",\\\"tax\\\":\\\"331.43\\\",\\\"discount\\\":\\\"210.00\\\",\\\"total\\\":\\\"3545.73\\\",\\\"attachment\\\":{}}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-09 09:19:02\",\"created_at\":\"2025-10-09 09:19:02\",\"id\":11,\"image\":null,\"document\":null,\"media\":[]}', 1, '2025-10-09 03:49:03', '2025-10-09 03:49:03'),
(6, 11, 9, 'service', NULL, NULL, 1, NULL, 124.30, 123.00, NULL, '{\"add_item_id\":\"9\",\"qty\":\"1\",\"price\":\"123\",\"discount_type\":\"value\",\"discount\":\"10\",\"tax_type\":\"with\",\"tax\":\"10\",\"amount\":\"124.30\"}', NULL, '{\"sale_invoice_number\":\"ET-20251009091902499\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251009-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":null,\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"sd\",\"terms\":\"wqerfgf\",\"overall_discount\":\"100\",\"subtotal\":\"3314.30\",\"tax\":\"331.43\",\"discount\":\"210.00\",\"total\":\"3545.73\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251009-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-09\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"7\\\",\\\"qty\\\":\\\"2\\\",\\\"price\\\":\\\"1500\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"3190.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"123\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"10\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"124.30\\\"}],\\\"notes\\\":\\\"sd\\\",\\\"terms\\\":\\\"wqerfgf\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"3314.30\\\",\\\"tax\\\":\\\"331.43\\\",\\\"discount\\\":\\\"210.00\\\",\\\"total\\\":\\\"3545.73\\\",\\\"attachment\\\":{}}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-09 09:19:02\",\"created_at\":\"2025-10-09 09:19:02\",\"id\":11,\"image\":null,\"document\":null,\"media\":[]}', 1, '2025-10-09 03:49:03', '2025-10-09 03:49:03'),
(7, 12, 9, 'service', NULL, NULL, 1, NULL, 100.00, 100.00, NULL, '{\"add_item_id\":\"9\",\"qty\":\"1\",\"price\":\"100\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"100.00\"}', NULL, '{\"sale_invoice_number\":\"ET-20251009092416679\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251009-0002\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":null,\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"sdvf\",\"terms\":\"asdf\",\"overall_discount\":\"0\",\"subtotal\":\"100.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"100.00\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251009-0002\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-09\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"100\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"100.00\\\"}],\\\"notes\\\":\\\"sdvf\\\",\\\"terms\\\":\\\"asdf\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"100.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"100.00\\\",\\\"attachment\\\":{}}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-09 09:24:16\",\"created_at\":\"2025-10-09 09:24:16\",\"id\":12,\"image\":null,\"document\":null,\"media\":[]}', 1, '2025-10-09 03:54:16', '2025-10-09 03:54:16'),
(8, 13, 7, 'product', 6, 678, 1, 1017000.00, 1484.00, 1500.00, '1', '{\"add_item_id\":\"7\",\"qty\":\"1\",\"price\":\"1500\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"6\",\"amount\":\"1484.00\"}', '{\"id\":6,\"qty\":677,\"type\":\"Opening Stock\",\"created_at\":\"2025-09-09 08:43:41\",\"updated_at\":\"2025-10-09 13:46:53\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":1,\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"4\\\",\\\"item_code\\\":\\\"ITM-6258-8965\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"1500\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"1\\\"},\\\"wholesale\\\":{\\\"wholesale_price\\\":\\\"1200\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\"},\\\"purchase\\\":{\\\"purchase_price\\\":\\\"1000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":\\\"10\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\"},\\\"online\\\":{\\\"title\\\":\\\"EEMOTRACK INDIA\\\",\\\"description\\\":\\\"Zcx e 4gregg34 erg 4egr\\\"}}\",\"item_id\":\"7\"}', '{\"sale_invoice_number\":\"ET-20251009134653248\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251009-0003\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":null,\"e_way_bill_no\":null,\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"2453.00\",\"tax\":\"89.04\",\"discount\":\"100.00\",\"total\":\"2542.04\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"Fo6CTOR4BQvP7trjCp3lQiwMTn8fAP8VLsoZ5EBT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251009-0003\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-09\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":null,\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"7\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"1500\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"6\\\",\\\"amount\\\":\\\"1484.00\\\"},{\\\"add_item_id\\\":\\\"11\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"969\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"969.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2453.00\\\",\\\"tax\\\":\\\"89.04\\\",\\\"discount\\\":\\\"100.00\\\",\\\"total\\\":\\\"2542.04\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-09 13:46:53\",\"created_at\":\"2025-10-09 13:46:53\",\"id\":13,\"image\":null,\"document\":null,\"media\":[]}', 1, '2025-10-09 08:16:53', '2025-10-09 08:16:53'),
(9, 13, 11, 'product', 8, 421, 1, 407949.00, 969.00, 969.00, '1', '{\"add_item_id\":\"11\",\"qty\":\"1\",\"price\":\"969\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"969.00\"}', '{\"id\":8,\"qty\":420,\"type\":\"Opening Stock\",\"created_at\":\"2025-10-04 08:27:06\",\"updated_at\":\"2025-10-09 13:46:53\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":1,\"json_data\":\"{\\\"item_type\\\":\\\"product\\\",\\\"unit_id\\\":\\\"1\\\",\\\"select_category\\\":\\\"1\\\",\\\"quantity\\\":\\\"481\\\",\\\"item_code\\\":\\\"ITM-3354-0915\\\",\\\"pricing\\\":{\\\"sale_price\\\":\\\"969\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"138\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":\\\"1\\\"},\\\"wholesale\\\":{\\\"wholesale_price\\\":\\\"234352\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"42\\\"},\\\"purchase\\\":{\\\"purchase_price\\\":\\\"5454\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\"},\\\"stock\\\":{\\\"opening_stock\\\":\\\"435\\\",\\\"low_stock_warning\\\":\\\"53\\\",\\\"warehouse_location\\\":\\\"34\\\"},\\\"online\\\":{\\\"title\\\":null,\\\"description\\\":null}}\",\"item_id\":\"11\"}', '{\"sale_invoice_number\":\"ET-20251009134653248\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251009-0003\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":null,\"e_way_bill_no\":null,\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"2453.00\",\"tax\":\"89.04\",\"discount\":\"100.00\",\"total\":\"2542.04\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"Fo6CTOR4BQvP7trjCp3lQiwMTn8fAP8VLsoZ5EBT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251009-0003\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-09\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":null,\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"7\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"1500\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"6\\\",\\\"amount\\\":\\\"1484.00\\\"},{\\\"add_item_id\\\":\\\"11\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"969\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"969.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2453.00\\\",\\\"tax\\\":\\\"89.04\\\",\\\"discount\\\":\\\"100.00\\\",\\\"total\\\":\\\"2542.04\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-09 13:46:53\",\"created_at\":\"2025-10-09 13:46:53\",\"id\":13,\"image\":null,\"document\":null,\"media\":[]}', 1, '2025-10-09 08:16:53', '2025-10-09 08:16:53'),
(10, 14, 20, 'raw_material', 14, 13, 5, NULL, 0.00, 0.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"2000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"2000.00\"}', '{\"id\":14,\"qty\":8,\"type\":\"Opening Stock\",\"created_at\":\"2025-10-15 11:36:36\",\"updated_at\":\"2025-11-03 10:45:43\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Box\\\",\\\"item_hsn\\\":\\\"dsver\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-7362-9293\\\",\\\"sale_price\\\":\\\"100\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"80\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"50\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"item_id\":\"20\",\"product_type\":\"raw_material\"}', '{\"sale_invoice_number\":\"ET-20251103104543519\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251103-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-11-03\",\"due_date\":\"2025-11-03 00:00:00\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"tnmgjhkj\",\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"2300.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"2300.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"9SlzqBE8v1fmGNgB5xkNdizYUkTJ0Isd7IRCc8NH\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"PO-20251103-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-03\\\",\\\"due_date\\\":\\\"2025-11-03\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"tnmgjhkj\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"2000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"2000.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"300\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"300.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2300.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"2300.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"updated_at\":\"2025-11-03 10:45:43\",\"created_at\":\"2025-11-03 10:45:43\",\"id\":14,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-03 05:15:43', '2025-11-03 05:15:43'),
(11, 14, 21, 'raw_material', 15, 13, 5, NULL, 0.00, 0.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"2000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"2000.00\"}', '{\"id\":15,\"qty\":8,\"type\":\"Opening Stock\",\"created_at\":\"2025-10-15 11:37:50\",\"updated_at\":\"2025-11-03 10:45:43\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Reelay\\\",\\\"item_hsn\\\":\\\"AKUYG434\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-8937-3458\\\",\\\"sale_price\\\":\\\"100\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"80\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"50\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"item_id\":\"21\",\"product_type\":\"raw_material\"}', '{\"sale_invoice_number\":\"ET-20251103104543519\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251103-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-11-03\",\"due_date\":\"2025-11-03 00:00:00\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"tnmgjhkj\",\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"2300.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"2300.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"9SlzqBE8v1fmGNgB5xkNdizYUkTJ0Isd7IRCc8NH\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"PO-20251103-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-03\\\",\\\"due_date\\\":\\\"2025-11-03\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"tnmgjhkj\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"2000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"2000.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"300\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"300.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2300.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"2300.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"updated_at\":\"2025-11-03 10:45:43\",\"created_at\":\"2025-11-03 10:45:43\",\"id\":14,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-03 05:15:43', '2025-11-03 05:15:43'),
(12, 14, 22, 'product', 16, 10, 1, 20000.00, 2000.00, 2000.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"2000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"2000.00\"}', '{\"id\":16,\"qty\":9,\"type\":\"Manufactured Stock\",\"created_at\":\"2025-10-16 07:18:36\",\"updated_at\":\"2025-11-03 10:45:43\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"Andoride Basic\\\",\\\"item_hsn\\\":\\\"AHUYG435\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"5\\\",\\\"item_code\\\":\\\"ITM-5609-7631\\\",\\\"sale_price\\\":\\\"3000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"2500\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"2000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"5\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"select_raw_materials\\\":[\\\"20\\\",\\\"21\\\",\\\"9\\\"],\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"5\\\\\\\"}\\\"}\",\"item_id\":\"22\",\"product_type\":\"finished_goods\"}', '{\"sale_invoice_number\":\"ET-20251103104543519\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251103-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-11-03\",\"due_date\":\"2025-11-03 00:00:00\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"tnmgjhkj\",\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"2300.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"2300.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"9SlzqBE8v1fmGNgB5xkNdizYUkTJ0Isd7IRCc8NH\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"PO-20251103-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-03\\\",\\\"due_date\\\":\\\"2025-11-03\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"tnmgjhkj\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"2000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"2000.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"300\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"300.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2300.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"2300.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"updated_at\":\"2025-11-03 10:45:43\",\"created_at\":\"2025-11-03 10:45:43\",\"id\":14,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-03 05:15:43', '2025-11-03 05:15:43'),
(13, 14, 9, 'service', NULL, NULL, 1, NULL, 300.00, 300.00, NULL, '{\"add_item_id\":\"9\",\"qty\":\"1\",\"price\":\"300\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"300.00\"}', NULL, '{\"sale_invoice_number\":\"ET-20251103104543519\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251103-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-11-03\",\"due_date\":\"2025-11-03 00:00:00\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"tnmgjhkj\",\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"2300.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"2300.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"9SlzqBE8v1fmGNgB5xkNdizYUkTJ0Isd7IRCc8NH\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"PO-20251103-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-03\\\",\\\"due_date\\\":\\\"2025-11-03\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"tnmgjhkj\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"2000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"2000.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"300\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"300.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2300.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"2300.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"updated_at\":\"2025-11-03 10:45:43\",\"created_at\":\"2025-11-03 10:45:43\",\"id\":14,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-03 05:15:43', '2025-11-03 05:15:43'),
(14, 15, 20, 'raw_material', 14, 8, 5, NULL, 0.00, 0.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"2500.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"2500.00\"}', '{\"id\":14,\"qty\":3,\"type\":\"Opening Stock\",\"created_at\":\"2025-10-15 11:36:36\",\"updated_at\":\"2025-11-04 11:36:08\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Box\\\",\\\"item_hsn\\\":\\\"dsver\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-7362-9293\\\",\\\"sale_price\\\":\\\"100\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"80\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"50\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"item_id\":\"20\",\"product_type\":\"raw_material\"}', '{\"sale_invoice_number\":\"ET-20251104113608642\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251104-0001\",\"docket_no\":\"45654\",\"po_date\":\"2025-11-04\",\"due_date\":\"2025-11-04 00:00:00\",\"e_way_bill_no\":\"4354\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":null,\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"2500.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"2500.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"6ASVoJ3pV8P0JUq8D76lg5Cd0FLKdZhpICTmJvim\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"PO-20251104-0001\\\",\\\"docket_no\\\":\\\"45654\\\",\\\"po_date\\\":\\\"2025-11-04\\\",\\\"due_date\\\":\\\"2025-11-04\\\",\\\"e_way_bill_no\\\":\\\"4354\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":null,\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"2500.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"2500.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2500.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"2500.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"updated_at\":\"2025-11-04 11:36:08\",\"created_at\":\"2025-11-04 11:36:08\",\"id\":15,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-04 06:06:08', '2025-11-04 06:06:08'),
(15, 15, 21, 'raw_material', 15, 8, 5, NULL, 0.00, 0.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"2500.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"2500.00\"}', '{\"id\":15,\"qty\":3,\"type\":\"Opening Stock\",\"created_at\":\"2025-10-15 11:37:50\",\"updated_at\":\"2025-11-04 11:36:08\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Reelay\\\",\\\"item_hsn\\\":\\\"AKUYG434\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-8937-3458\\\",\\\"sale_price\\\":\\\"100\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"80\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"50\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"item_id\":\"21\",\"product_type\":\"raw_material\"}', '{\"sale_invoice_number\":\"ET-20251104113608642\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251104-0001\",\"docket_no\":\"45654\",\"po_date\":\"2025-11-04\",\"due_date\":\"2025-11-04 00:00:00\",\"e_way_bill_no\":\"4354\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":null,\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"2500.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"2500.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"6ASVoJ3pV8P0JUq8D76lg5Cd0FLKdZhpICTmJvim\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"PO-20251104-0001\\\",\\\"docket_no\\\":\\\"45654\\\",\\\"po_date\\\":\\\"2025-11-04\\\",\\\"due_date\\\":\\\"2025-11-04\\\",\\\"e_way_bill_no\\\":\\\"4354\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":null,\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"2500.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"2500.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2500.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"2500.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"updated_at\":\"2025-11-04 11:36:08\",\"created_at\":\"2025-11-04 11:36:08\",\"id\":15,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-04 06:06:08', '2025-11-04 06:06:08'),
(16, 15, 22, 'product', 16, 9, 1, 22500.00, 2500.00, 2500.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"2500.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"2500.00\"}', '{\"id\":16,\"qty\":8,\"type\":\"Manufactured Stock\",\"created_at\":\"2025-10-16 07:18:36\",\"updated_at\":\"2025-11-04 11:36:08\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"Andoride Basic\\\",\\\"item_hsn\\\":\\\"AHUYG435\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"5\\\",\\\"item_code\\\":\\\"ITM-5609-7631\\\",\\\"sale_price\\\":\\\"3000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"2500\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"2000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"5\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"select_raw_materials\\\":[\\\"20\\\",\\\"21\\\",\\\"9\\\"],\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"5\\\\\\\"}\\\"}\",\"item_id\":\"22\",\"product_type\":\"finished_goods\"}', '{\"sale_invoice_number\":\"ET-20251104113608642\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251104-0001\",\"docket_no\":\"45654\",\"po_date\":\"2025-11-04\",\"due_date\":\"2025-11-04 00:00:00\",\"e_way_bill_no\":\"4354\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":null,\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"2500.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"2500.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"6ASVoJ3pV8P0JUq8D76lg5Cd0FLKdZhpICTmJvim\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"PO-20251104-0001\\\",\\\"docket_no\\\":\\\"45654\\\",\\\"po_date\\\":\\\"2025-11-04\\\",\\\"due_date\\\":\\\"2025-11-04\\\",\\\"e_way_bill_no\\\":\\\"4354\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":null,\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"2500.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"2500.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2500.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"2500.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"updated_at\":\"2025-11-04 11:36:08\",\"created_at\":\"2025-11-04 11:36:08\",\"id\":15,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-04 06:06:08', '2025-11-04 06:06:08'),
(17, 16, 20, 'raw_material', 14, 3, 5, NULL, 0.00, 0.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"2600.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"2600.00\"}', '{\"id\":14,\"qty\":0,\"type\":\"Opening Stock\",\"created_at\":\"2025-10-15 11:36:36\",\"updated_at\":\"2025-11-04 12:03:56\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Box\\\",\\\"item_hsn\\\":\\\"dsver\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-7362-9293\\\",\\\"sale_price\\\":\\\"100\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"80\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"50\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"item_id\":\"20\",\"product_type\":\"raw_material\"}', '{\"sale_invoice_number\":\"ET-20251104120356123\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251104-0002\",\"docket_no\":\"32423\",\"po_date\":\"2025-11-04\",\"due_date\":\"2025-11-04 00:00:00\",\"e_way_bill_no\":\"4354\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":null,\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"3000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"6ASVoJ3pV8P0JUq8D76lg5Cd0FLKdZhpICTmJvim\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"PO-20251104-0002\\\",\\\"docket_no\\\":\\\"32423\\\",\\\"po_date\\\":\\\"2025-11-04\\\",\\\"due_date\\\":\\\"2025-11-04\\\",\\\"e_way_bill_no\\\":\\\"4354\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":null,\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"2600.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"2600.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"400\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"400.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"3000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"updated_at\":\"2025-11-04 12:03:56\",\"created_at\":\"2025-11-04 12:03:56\",\"id\":16,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-04 06:33:56', '2025-11-04 06:33:56'),
(18, 16, 21, 'raw_material', 15, 3, 5, NULL, 0.00, 0.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"2600.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"2600.00\"}', '{\"id\":15,\"qty\":0,\"type\":\"Opening Stock\",\"created_at\":\"2025-10-15 11:37:50\",\"updated_at\":\"2025-11-04 12:03:56\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Reelay\\\",\\\"item_hsn\\\":\\\"AKUYG434\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-8937-3458\\\",\\\"sale_price\\\":\\\"100\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"80\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"50\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"item_id\":\"21\",\"product_type\":\"raw_material\"}', '{\"sale_invoice_number\":\"ET-20251104120356123\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251104-0002\",\"docket_no\":\"32423\",\"po_date\":\"2025-11-04\",\"due_date\":\"2025-11-04 00:00:00\",\"e_way_bill_no\":\"4354\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":null,\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"3000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"6ASVoJ3pV8P0JUq8D76lg5Cd0FLKdZhpICTmJvim\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"PO-20251104-0002\\\",\\\"docket_no\\\":\\\"32423\\\",\\\"po_date\\\":\\\"2025-11-04\\\",\\\"due_date\\\":\\\"2025-11-04\\\",\\\"e_way_bill_no\\\":\\\"4354\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":null,\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"2600.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"2600.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"400\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"400.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"3000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"updated_at\":\"2025-11-04 12:03:56\",\"created_at\":\"2025-11-04 12:03:56\",\"id\":16,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-04 06:33:56', '2025-11-04 06:33:56');
INSERT INTO `sale_logs` (`id`, `sale_invoice_id`, `item_id`, `item_type`, `stock_id`, `previous_qty`, `sold_qty`, `previous_amount`, `sold_amount`, `price`, `created_by_id`, `json_data_add_item_sale_invoice`, `json_data_current_stock`, `json_data_sale_invoice`, `sold_to_user_id`, `created_at`, `updated_at`) VALUES
(19, 16, 22, 'product', 16, 8, 1, 20800.00, 2600.00, 2600.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"2600.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"2600.00\"}', '{\"id\":16,\"qty\":7,\"type\":\"Manufactured Stock\",\"created_at\":\"2025-10-16 07:18:36\",\"updated_at\":\"2025-11-04 12:03:56\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"Andoride Basic\\\",\\\"item_hsn\\\":\\\"AHUYG435\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"5\\\",\\\"item_code\\\":\\\"ITM-5609-7631\\\",\\\"sale_price\\\":\\\"3000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"2500\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"2000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"5\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"select_raw_materials\\\":[\\\"20\\\",\\\"21\\\",\\\"9\\\"],\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"5\\\\\\\"}\\\"}\",\"item_id\":\"22\",\"product_type\":\"finished_goods\"}', '{\"sale_invoice_number\":\"ET-20251104120356123\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251104-0002\",\"docket_no\":\"32423\",\"po_date\":\"2025-11-04\",\"due_date\":\"2025-11-04 00:00:00\",\"e_way_bill_no\":\"4354\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":null,\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"3000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"6ASVoJ3pV8P0JUq8D76lg5Cd0FLKdZhpICTmJvim\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"PO-20251104-0002\\\",\\\"docket_no\\\":\\\"32423\\\",\\\"po_date\\\":\\\"2025-11-04\\\",\\\"due_date\\\":\\\"2025-11-04\\\",\\\"e_way_bill_no\\\":\\\"4354\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":null,\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"2600.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"2600.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"400\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"400.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"3000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"updated_at\":\"2025-11-04 12:03:56\",\"created_at\":\"2025-11-04 12:03:56\",\"id\":16,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-04 06:33:56', '2025-11-04 06:33:56'),
(20, 16, 9, 'service', NULL, NULL, 1, NULL, 400.00, 400.00, NULL, '{\"add_item_id\":\"9\",\"qty\":\"1\",\"price\":\"400\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"400.00\"}', NULL, '{\"sale_invoice_number\":\"ET-20251104120356123\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251104-0002\",\"docket_no\":\"32423\",\"po_date\":\"2025-11-04\",\"due_date\":\"2025-11-04 00:00:00\",\"e_way_bill_no\":\"4354\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":null,\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"3000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"6ASVoJ3pV8P0JUq8D76lg5Cd0FLKdZhpICTmJvim\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"PO-20251104-0002\\\",\\\"docket_no\\\":\\\"32423\\\",\\\"po_date\\\":\\\"2025-11-04\\\",\\\"due_date\\\":\\\"2025-11-04\\\",\\\"e_way_bill_no\\\":\\\"4354\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":null,\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"2600.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"2600.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"400\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"400.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"3000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"updated_at\":\"2025-11-04 12:03:56\",\"created_at\":\"2025-11-04 12:03:56\",\"id\":16,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-04 06:33:56', '2025-11-04 06:33:56'),
(21, 16, 22, 'product', 16, 7, 2, 18200.00, 5200.00, 2600.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"2\",\"price\":\"2600.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"5200.00\"}', '{\"id\":16,\"qty\":5,\"type\":\"Manufactured Stock\",\"created_at\":\"2025-10-16 07:18:36\",\"updated_at\":\"2025-11-05 11:02:28\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"Andoride Basic\\\",\\\"item_hsn\\\":\\\"AHUYG435\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"5\\\",\\\"item_code\\\":\\\"ITM-5609-7631\\\",\\\"sale_price\\\":\\\"3000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"2500\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"2000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"5\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"select_raw_materials\\\":[\\\"20\\\",\\\"21\\\",\\\"9\\\"],\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"5\\\\\\\"}\\\"}\",\"item_id\":\"22\",\"product_type\":\"finished_goods\"}', '{\"id\":16,\"payment_type\":\"credit\",\"phone_number\":\"9229779459\",\"e_way_bill_no\":\"4354\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"po_no\":\"PO-20251104-0002\",\"po_date\":\"2025-11-04\",\"notes\":null,\"created_at\":\"2025-11-04 12:03:56\",\"updated_at\":\"2025-11-05 11:02:28\",\"deleted_at\":null,\"select_customer_id\":\"4\",\"created_by_id\":3,\"docket_no\":\"32423\",\"due_date\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"6000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"6000.00\",\"attachment\":null,\"sale_invoice_number\":\"ET-20251104120356123\",\"json_data\":\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"_method\\\":\\\"PUT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"po_no\\\":\\\"PO-20251104-0002\\\",\\\"docket_no\\\":\\\"32423\\\",\\\"po_date\\\":\\\"2025-11-04\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":\\\"4354\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"Architecto eos cum n\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"2\\\",\\\"price\\\":\\\"2600.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"5200.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"2\\\",\\\"price\\\":\\\"400\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"800.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"6000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"6000.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":4,\"sub_cost_center_id\":2,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-05 05:32:28', '2025-11-05 05:32:28'),
(22, 16, 9, 'service', NULL, NULL, 2, NULL, 800.00, 400.00, NULL, '{\"add_item_id\":\"9\",\"qty\":\"2\",\"price\":\"400\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"800.00\"}', NULL, '{\"id\":16,\"payment_type\":\"credit\",\"phone_number\":\"9229779459\",\"e_way_bill_no\":\"4354\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"po_no\":\"PO-20251104-0002\",\"po_date\":\"2025-11-04\",\"notes\":null,\"created_at\":\"2025-11-04 12:03:56\",\"updated_at\":\"2025-11-05 11:02:28\",\"deleted_at\":null,\"select_customer_id\":\"4\",\"created_by_id\":3,\"docket_no\":\"32423\",\"due_date\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"6000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"6000.00\",\"attachment\":null,\"sale_invoice_number\":\"ET-20251104120356123\",\"json_data\":\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"_method\\\":\\\"PUT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"po_no\\\":\\\"PO-20251104-0002\\\",\\\"docket_no\\\":\\\"32423\\\",\\\"po_date\\\":\\\"2025-11-04\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":\\\"4354\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"Architecto eos cum n\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"2\\\",\\\"price\\\":\\\"2600.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"5200.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"2\\\",\\\"price\\\":\\\"400\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"800.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"6000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"6000.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":4,\"sub_cost_center_id\":2,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-05 05:32:28', '2025-11-05 05:32:28'),
(23, 16, 22, 'product', 16, 5, 5, 13000.00, 13000.00, 2600.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"5\",\"price\":\"2600.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"13000.00\"}', '{\"id\":16,\"qty\":0,\"type\":\"Manufactured Stock\",\"created_at\":\"2025-10-16 07:18:36\",\"updated_at\":\"2025-11-05 11:02:45\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"Andoride Basic\\\",\\\"item_hsn\\\":\\\"AHUYG435\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"5\\\",\\\"item_code\\\":\\\"ITM-5609-7631\\\",\\\"sale_price\\\":\\\"3000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"2500\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"2000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"5\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"select_raw_materials\\\":[\\\"20\\\",\\\"21\\\",\\\"9\\\"],\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"5\\\\\\\"}\\\"}\",\"item_id\":\"22\",\"product_type\":\"finished_goods\"}', '{\"id\":16,\"payment_type\":\"credit\",\"phone_number\":\"9229779459\",\"e_way_bill_no\":\"4354\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"po_no\":\"PO-20251104-0002\",\"po_date\":\"2025-11-04\",\"notes\":null,\"created_at\":\"2025-11-04 12:03:56\",\"updated_at\":\"2025-11-05 11:02:45\",\"deleted_at\":null,\"select_customer_id\":\"4\",\"created_by_id\":3,\"docket_no\":\"32423\",\"due_date\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"15000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"15000.00\",\"attachment\":null,\"sale_invoice_number\":\"ET-20251104120356123\",\"json_data\":\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"_method\\\":\\\"PUT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"po_no\\\":\\\"PO-20251104-0002\\\",\\\"docket_no\\\":\\\"32423\\\",\\\"po_date\\\":\\\"2025-11-04\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":\\\"4354\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"Architecto eos cum n\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"5\\\",\\\"price\\\":\\\"2600.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"13000.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"5\\\",\\\"price\\\":\\\"400\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"2000.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"15000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"15000.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":4,\"sub_cost_center_id\":2,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-05 05:32:45', '2025-11-05 05:32:45'),
(24, 16, 9, 'service', NULL, NULL, 5, NULL, 2000.00, 400.00, NULL, '{\"add_item_id\":\"9\",\"qty\":\"5\",\"price\":\"400\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"2000.00\"}', NULL, '{\"id\":16,\"payment_type\":\"credit\",\"phone_number\":\"9229779459\",\"e_way_bill_no\":\"4354\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"po_no\":\"PO-20251104-0002\",\"po_date\":\"2025-11-04\",\"notes\":null,\"created_at\":\"2025-11-04 12:03:56\",\"updated_at\":\"2025-11-05 11:02:45\",\"deleted_at\":null,\"select_customer_id\":\"4\",\"created_by_id\":3,\"docket_no\":\"32423\",\"due_date\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"15000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"15000.00\",\"attachment\":null,\"sale_invoice_number\":\"ET-20251104120356123\",\"json_data\":\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"_method\\\":\\\"PUT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"po_no\\\":\\\"PO-20251104-0002\\\",\\\"docket_no\\\":\\\"32423\\\",\\\"po_date\\\":\\\"2025-11-04\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":\\\"4354\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"Architecto eos cum n\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"5\\\",\\\"price\\\":\\\"2600.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"13000.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"5\\\",\\\"price\\\":\\\"400\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"2000.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"15000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"15000.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":4,\"sub_cost_center_id\":2,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-05 05:32:45', '2025-11-05 05:32:45'),
(25, 17, 20, 'raw_material', 14, 0, 5, NULL, 0.00, 0.00, '5', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"3000.00\"}', '{\"id\":14,\"qty\":0,\"type\":\"Opening Stock\",\"created_at\":\"2025-10-15 11:36:36\",\"updated_at\":\"2025-11-04 12:03:56\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Box\\\",\\\"item_hsn\\\":\\\"dsver\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-7362-9293\\\",\\\"sale_price\\\":\\\"100\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"80\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"50\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"item_id\":\"20\",\"product_type\":\"raw_material\"}', '{\"sale_invoice_number\":\"ET-20251107101306583\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251107-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-11-07\",\"due_date\":\"2025-11-07 00:00:00\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"wefve\",\"notes\":\"esdv c\",\"terms\":\"esdv\",\"overall_discount\":\"0\",\"subtotal\":\"3000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"created_by_id\":5,\"json_data\":\"{\\\"_token\\\":\\\"lryCAJ2BK2lCWt7HIBLA0uhe2CPECqu8nYT1SPxS\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251107-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-07\\\",\\\"due_date\\\":\\\"2025-11-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"wefve\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"3000.00\\\"}],\\\"notes\\\":\\\"esdv c\\\",\\\"terms\\\":\\\"esdv\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"3000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"updated_at\":\"2025-11-07 10:13:06\",\"created_at\":\"2025-11-07 10:13:06\",\"id\":17,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-07 04:43:06', '2025-11-07 04:43:06'),
(26, 17, 21, 'raw_material', 15, 0, 5, NULL, 0.00, 0.00, '5', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"3000.00\"}', '{\"id\":15,\"qty\":0,\"type\":\"Opening Stock\",\"created_at\":\"2025-10-15 11:37:50\",\"updated_at\":\"2025-11-04 12:03:56\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Reelay\\\",\\\"item_hsn\\\":\\\"AKUYG434\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-8937-3458\\\",\\\"sale_price\\\":\\\"100\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"80\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"50\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"item_id\":\"21\",\"product_type\":\"raw_material\"}', '{\"sale_invoice_number\":\"ET-20251107101306583\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251107-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-11-07\",\"due_date\":\"2025-11-07 00:00:00\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"wefve\",\"notes\":\"esdv c\",\"terms\":\"esdv\",\"overall_discount\":\"0\",\"subtotal\":\"3000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"created_by_id\":5,\"json_data\":\"{\\\"_token\\\":\\\"lryCAJ2BK2lCWt7HIBLA0uhe2CPECqu8nYT1SPxS\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251107-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-07\\\",\\\"due_date\\\":\\\"2025-11-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"wefve\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"3000.00\\\"}],\\\"notes\\\":\\\"esdv c\\\",\\\"terms\\\":\\\"esdv\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"3000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"updated_at\":\"2025-11-07 10:13:06\",\"created_at\":\"2025-11-07 10:13:06\",\"id\":17,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-07 04:43:06', '2025-11-07 04:43:06'),
(27, 17, 22, 'product', 16, 13, 1, 39000.00, 3000.00, 3000.00, '5', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"3000.00\"}', '{\"id\":16,\"qty\":12,\"type\":\"Manufactured Stock\",\"created_at\":\"2025-10-16 07:18:36\",\"updated_at\":\"2025-11-07 10:13:06\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"Andoride Basic\\\",\\\"item_hsn\\\":\\\"AHUYG435\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"5\\\",\\\"item_code\\\":\\\"ITM-5609-7631\\\",\\\"sale_price\\\":\\\"3000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"2500\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"2000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"5\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"select_raw_materials\\\":[\\\"20\\\",\\\"21\\\",\\\"9\\\"],\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"5\\\\\\\"}\\\"}\",\"item_id\":\"22\",\"product_type\":\"finished_goods\"}', '{\"sale_invoice_number\":\"ET-20251107101306583\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251107-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-11-07\",\"due_date\":\"2025-11-07 00:00:00\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"wefve\",\"notes\":\"esdv c\",\"terms\":\"esdv\",\"overall_discount\":\"0\",\"subtotal\":\"3000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"created_by_id\":5,\"json_data\":\"{\\\"_token\\\":\\\"lryCAJ2BK2lCWt7HIBLA0uhe2CPECqu8nYT1SPxS\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251107-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-07\\\",\\\"due_date\\\":\\\"2025-11-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"wefve\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"3000.00\\\"}],\\\"notes\\\":\\\"esdv c\\\",\\\"terms\\\":\\\"esdv\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"3000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"updated_at\":\"2025-11-07 10:13:06\",\"created_at\":\"2025-11-07 10:13:06\",\"id\":17,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-07 04:43:06', '2025-11-07 04:43:06'),
(28, 17, 22, 'product_reversal', 16, 12, -1, 36000.00, -3000.00, 3000.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"3000.00\"}', NULL, '{\"id\":17,\"payment_type\":\"credit\",\"phone_number\":\"9229779459\",\"e_way_bill_no\":\"7832\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"wefve\",\"po_no\":\"PO-20251107-0001\",\"po_date\":\"2025-11-07\",\"notes\":\"esdv c\",\"created_at\":\"2025-11-07 10:13:06\",\"updated_at\":\"2025-11-07 10:58:23\",\"deleted_at\":null,\"select_customer_id\":4,\"created_by_id\":5,\"docket_no\":\"23434\",\"due_date\":\"2025-11-07 00:00:00\",\"terms\":\"esdv\",\"overall_discount\":\"0\",\"subtotal\":\"3000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"attachment\":null,\"sale_invoice_number\":\"ET-20251107101306583\",\"json_data\":\"{\\\"_token\\\":\\\"lryCAJ2BK2lCWt7HIBLA0uhe2CPECqu8nYT1SPxS\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251107-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-07\\\",\\\"due_date\\\":\\\"2025-11-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"wefve\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"3000.00\\\"}],\\\"notes\\\":\\\"esdv c\\\",\\\"terms\\\":\\\"esdv\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"3000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"Pending\",\"main_cost_center_id\":4,\"sub_cost_center_id\":3,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-08 02:14:23', '2025-11-08 02:14:23'),
(29, 17, 20, 'raw_material_reversal', 14, 0, -5, NULL, 0.00, 0.00, '3', NULL, NULL, '{\"id\":17,\"payment_type\":\"credit\",\"phone_number\":\"9229779459\",\"e_way_bill_no\":\"7832\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"wefve\",\"po_no\":\"PO-20251107-0001\",\"po_date\":\"2025-11-07\",\"notes\":\"esdv c\",\"created_at\":\"2025-11-07 10:13:06\",\"updated_at\":\"2025-11-07 10:58:23\",\"deleted_at\":null,\"select_customer_id\":4,\"created_by_id\":5,\"docket_no\":\"23434\",\"due_date\":\"2025-11-07 00:00:00\",\"terms\":\"esdv\",\"overall_discount\":\"0\",\"subtotal\":\"3000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"attachment\":null,\"sale_invoice_number\":\"ET-20251107101306583\",\"json_data\":\"{\\\"_token\\\":\\\"lryCAJ2BK2lCWt7HIBLA0uhe2CPECqu8nYT1SPxS\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251107-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-07\\\",\\\"due_date\\\":\\\"2025-11-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"wefve\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"3000.00\\\"}],\\\"notes\\\":\\\"esdv c\\\",\\\"terms\\\":\\\"esdv\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"3000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"Pending\",\"main_cost_center_id\":4,\"sub_cost_center_id\":3,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-08 02:14:23', '2025-11-08 02:14:23'),
(30, 17, 21, 'raw_material_reversal', 15, 0, -5, NULL, 0.00, 0.00, '3', NULL, NULL, '{\"id\":17,\"payment_type\":\"credit\",\"phone_number\":\"9229779459\",\"e_way_bill_no\":\"7832\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"wefve\",\"po_no\":\"PO-20251107-0001\",\"po_date\":\"2025-11-07\",\"notes\":\"esdv c\",\"created_at\":\"2025-11-07 10:13:06\",\"updated_at\":\"2025-11-07 10:58:23\",\"deleted_at\":null,\"select_customer_id\":4,\"created_by_id\":5,\"docket_no\":\"23434\",\"due_date\":\"2025-11-07 00:00:00\",\"terms\":\"esdv\",\"overall_discount\":\"0\",\"subtotal\":\"3000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"attachment\":null,\"sale_invoice_number\":\"ET-20251107101306583\",\"json_data\":\"{\\\"_token\\\":\\\"lryCAJ2BK2lCWt7HIBLA0uhe2CPECqu8nYT1SPxS\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251107-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-07\\\",\\\"due_date\\\":\\\"2025-11-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"wefve\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"3000.00\\\"}],\\\"notes\\\":\\\"esdv c\\\",\\\"terms\\\":\\\"esdv\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"3000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"Pending\",\"main_cost_center_id\":4,\"sub_cost_center_id\":3,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-08 02:14:23', '2025-11-08 02:14:23'),
(31, 17, 20, 'raw_material', 14, 5, 5, NULL, 0.00, 0.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0.00\",\"amount\":\"3000.00\"}', '{\"id\":14,\"qty\":0,\"type\":\"Opening Stock\",\"created_at\":\"2025-10-15 11:36:36\",\"updated_at\":\"2025-11-08 07:44:24\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Box\\\",\\\"item_hsn\\\":\\\"dsver\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-7362-9293\\\",\\\"sale_price\\\":\\\"100\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"80\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"50\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"item_id\":\"20\",\"product_type\":\"raw_material\"}', '{\"id\":17,\"payment_type\":\"credit\",\"phone_number\":\"9229779459\",\"e_way_bill_no\":\"7832\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"wefve\",\"po_no\":\"PO-20251107-0001\",\"po_date\":\"2025-11-08\",\"notes\":\"esdv c\",\"created_at\":\"2025-11-07 10:13:06\",\"updated_at\":\"2025-11-08 07:44:23\",\"deleted_at\":null,\"select_customer_id\":\"4\",\"created_by_id\":5,\"docket_no\":\"23434\",\"due_date\":\"2025-11-07 00:00:00\",\"terms\":\"esdv\",\"overall_discount\":\"0.00\",\"subtotal\":\"3000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"attachment\":null,\"sale_invoice_number\":\"ET-20251107101306583\",\"json_data\":\"{\\\"_token\\\":\\\"W2Q6uMHJGMYYBZa9TKWVG89wGDh0NDLSTpTJj6Di\\\",\\\"_method\\\":\\\"PUT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251107-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-08\\\",\\\"due_date\\\":\\\"2025-11-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"wefve\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0.00\\\",\\\"amount\\\":\\\"3000.00\\\"}],\\\"notes\\\":\\\"esdv c\\\",\\\"terms\\\":\\\"esdv\\\",\\\"overall_discount\\\":\\\"0.00\\\",\\\"subtotal\\\":\\\"3000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"Pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-08 02:14:24', '2025-11-08 02:14:24'),
(32, 17, 21, 'raw_material', 15, 5, 5, NULL, 0.00, 0.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0.00\",\"amount\":\"3000.00\"}', '{\"id\":15,\"qty\":0,\"type\":\"Opening Stock\",\"created_at\":\"2025-10-15 11:37:50\",\"updated_at\":\"2025-11-08 07:44:24\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Reelay\\\",\\\"item_hsn\\\":\\\"AKUYG434\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-8937-3458\\\",\\\"sale_price\\\":\\\"100\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"80\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"50\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"item_id\":\"21\",\"product_type\":\"raw_material\"}', '{\"id\":17,\"payment_type\":\"credit\",\"phone_number\":\"9229779459\",\"e_way_bill_no\":\"7832\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"wefve\",\"po_no\":\"PO-20251107-0001\",\"po_date\":\"2025-11-08\",\"notes\":\"esdv c\",\"created_at\":\"2025-11-07 10:13:06\",\"updated_at\":\"2025-11-08 07:44:23\",\"deleted_at\":null,\"select_customer_id\":\"4\",\"created_by_id\":5,\"docket_no\":\"23434\",\"due_date\":\"2025-11-07 00:00:00\",\"terms\":\"esdv\",\"overall_discount\":\"0.00\",\"subtotal\":\"3000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"attachment\":null,\"sale_invoice_number\":\"ET-20251107101306583\",\"json_data\":\"{\\\"_token\\\":\\\"W2Q6uMHJGMYYBZa9TKWVG89wGDh0NDLSTpTJj6Di\\\",\\\"_method\\\":\\\"PUT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251107-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-08\\\",\\\"due_date\\\":\\\"2025-11-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"wefve\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0.00\\\",\\\"amount\\\":\\\"3000.00\\\"}],\\\"notes\\\":\\\"esdv c\\\",\\\"terms\\\":\\\"esdv\\\",\\\"overall_discount\\\":\\\"0.00\\\",\\\"subtotal\\\":\\\"3000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"Pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-08 02:14:24', '2025-11-08 02:14:24'),
(33, 17, 22, 'product', 16, 13, 1, 39000.00, 3000.00, 3000.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0.00\",\"amount\":\"3000.00\"}', '{\"id\":16,\"qty\":12,\"type\":\"Manufactured Stock\",\"created_at\":\"2025-10-16 07:18:36\",\"updated_at\":\"2025-11-08 07:44:24\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"Andoride Basic\\\",\\\"item_hsn\\\":\\\"AHUYG435\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"5\\\",\\\"item_code\\\":\\\"ITM-5609-7631\\\",\\\"sale_price\\\":\\\"3000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"2500\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"2000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"5\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"select_raw_materials\\\":[\\\"20\\\",\\\"21\\\",\\\"9\\\"],\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"5\\\\\\\"}\\\"}\",\"item_id\":\"22\",\"product_type\":\"finished_goods\"}', '{\"id\":17,\"payment_type\":\"credit\",\"phone_number\":\"9229779459\",\"e_way_bill_no\":\"7832\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"wefve\",\"po_no\":\"PO-20251107-0001\",\"po_date\":\"2025-11-08\",\"notes\":\"esdv c\",\"created_at\":\"2025-11-07 10:13:06\",\"updated_at\":\"2025-11-08 07:44:23\",\"deleted_at\":null,\"select_customer_id\":\"4\",\"created_by_id\":5,\"docket_no\":\"23434\",\"due_date\":\"2025-11-07 00:00:00\",\"terms\":\"esdv\",\"overall_discount\":\"0.00\",\"subtotal\":\"3000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"attachment\":null,\"sale_invoice_number\":\"ET-20251107101306583\",\"json_data\":\"{\\\"_token\\\":\\\"W2Q6uMHJGMYYBZa9TKWVG89wGDh0NDLSTpTJj6Di\\\",\\\"_method\\\":\\\"PUT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251107-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-08\\\",\\\"due_date\\\":\\\"2025-11-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"wefve\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0.00\\\",\\\"amount\\\":\\\"3000.00\\\"}],\\\"notes\\\":\\\"esdv c\\\",\\\"terms\\\":\\\"esdv\\\",\\\"overall_discount\\\":\\\"0.00\\\",\\\"subtotal\\\":\\\"3000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"Pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-08 02:14:24', '2025-11-08 02:14:24'),
(34, 17, 22, 'product_reversal', 16, 12, -1, 36000.00, -3000.00, 3000.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0.00\",\"amount\":\"3000.00\"}', NULL, '{\"id\":17,\"payment_type\":\"credit\",\"phone_number\":\"9229779459\",\"e_way_bill_no\":\"7832\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"wefve\",\"po_no\":\"PO-20251107-0001\",\"po_date\":\"2025-11-08\",\"notes\":\"esdv c\",\"created_at\":\"2025-11-07 10:13:06\",\"updated_at\":\"2025-11-08 07:44:23\",\"deleted_at\":null,\"select_customer_id\":4,\"created_by_id\":5,\"docket_no\":\"23434\",\"due_date\":\"2025-11-07 00:00:00\",\"terms\":\"esdv\",\"overall_discount\":\"0.00\",\"subtotal\":\"3000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"attachment\":null,\"sale_invoice_number\":\"ET-20251107101306583\",\"json_data\":\"{\\\"_token\\\":\\\"W2Q6uMHJGMYYBZa9TKWVG89wGDh0NDLSTpTJj6Di\\\",\\\"_method\\\":\\\"PUT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251107-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-08\\\",\\\"due_date\\\":\\\"2025-11-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"wefve\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0.00\\\",\\\"amount\\\":\\\"3000.00\\\"}],\\\"notes\\\":\\\"esdv c\\\",\\\"terms\\\":\\\"esdv\\\",\\\"overall_discount\\\":\\\"0.00\\\",\\\"subtotal\\\":\\\"3000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"Pending\",\"main_cost_center_id\":4,\"sub_cost_center_id\":3,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-08 02:14:57', '2025-11-08 02:14:57'),
(35, 17, 20, 'raw_material_reversal', 14, 0, -5, NULL, 0.00, 0.00, '3', NULL, NULL, '{\"id\":17,\"payment_type\":\"credit\",\"phone_number\":\"9229779459\",\"e_way_bill_no\":\"7832\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"wefve\",\"po_no\":\"PO-20251107-0001\",\"po_date\":\"2025-11-08\",\"notes\":\"esdv c\",\"created_at\":\"2025-11-07 10:13:06\",\"updated_at\":\"2025-11-08 07:44:23\",\"deleted_at\":null,\"select_customer_id\":4,\"created_by_id\":5,\"docket_no\":\"23434\",\"due_date\":\"2025-11-07 00:00:00\",\"terms\":\"esdv\",\"overall_discount\":\"0.00\",\"subtotal\":\"3000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"attachment\":null,\"sale_invoice_number\":\"ET-20251107101306583\",\"json_data\":\"{\\\"_token\\\":\\\"W2Q6uMHJGMYYBZa9TKWVG89wGDh0NDLSTpTJj6Di\\\",\\\"_method\\\":\\\"PUT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251107-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-08\\\",\\\"due_date\\\":\\\"2025-11-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"wefve\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0.00\\\",\\\"amount\\\":\\\"3000.00\\\"}],\\\"notes\\\":\\\"esdv c\\\",\\\"terms\\\":\\\"esdv\\\",\\\"overall_discount\\\":\\\"0.00\\\",\\\"subtotal\\\":\\\"3000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"Pending\",\"main_cost_center_id\":4,\"sub_cost_center_id\":3,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-08 02:14:57', '2025-11-08 02:14:57');
INSERT INTO `sale_logs` (`id`, `sale_invoice_id`, `item_id`, `item_type`, `stock_id`, `previous_qty`, `sold_qty`, `previous_amount`, `sold_amount`, `price`, `created_by_id`, `json_data_add_item_sale_invoice`, `json_data_current_stock`, `json_data_sale_invoice`, `sold_to_user_id`, `created_at`, `updated_at`) VALUES
(36, 17, 21, 'raw_material_reversal', 15, 0, -5, NULL, 0.00, 0.00, '3', NULL, NULL, '{\"id\":17,\"payment_type\":\"credit\",\"phone_number\":\"9229779459\",\"e_way_bill_no\":\"7832\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"wefve\",\"po_no\":\"PO-20251107-0001\",\"po_date\":\"2025-11-08\",\"notes\":\"esdv c\",\"created_at\":\"2025-11-07 10:13:06\",\"updated_at\":\"2025-11-08 07:44:23\",\"deleted_at\":null,\"select_customer_id\":4,\"created_by_id\":5,\"docket_no\":\"23434\",\"due_date\":\"2025-11-07 00:00:00\",\"terms\":\"esdv\",\"overall_discount\":\"0.00\",\"subtotal\":\"3000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"attachment\":null,\"sale_invoice_number\":\"ET-20251107101306583\",\"json_data\":\"{\\\"_token\\\":\\\"W2Q6uMHJGMYYBZa9TKWVG89wGDh0NDLSTpTJj6Di\\\",\\\"_method\\\":\\\"PUT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251107-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-08\\\",\\\"due_date\\\":\\\"2025-11-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"wefve\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0.00\\\",\\\"amount\\\":\\\"3000.00\\\"}],\\\"notes\\\":\\\"esdv c\\\",\\\"terms\\\":\\\"esdv\\\",\\\"overall_discount\\\":\\\"0.00\\\",\\\"subtotal\\\":\\\"3000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"Pending\",\"main_cost_center_id\":4,\"sub_cost_center_id\":3,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-08 02:14:57', '2025-11-08 02:14:57'),
(37, 17, 20, 'raw_material', 14, 5, 5, NULL, 0.00, 0.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"3000.00\"}', '{\"id\":14,\"qty\":0,\"type\":\"Opening Stock\",\"created_at\":\"2025-10-15 11:36:36\",\"updated_at\":\"2025-11-08 07:44:57\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Box\\\",\\\"item_hsn\\\":\\\"dsver\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-7362-9293\\\",\\\"sale_price\\\":\\\"100\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"80\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"50\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"item_id\":\"20\",\"product_type\":\"raw_material\"}', '{\"id\":17,\"payment_type\":\"credit\",\"phone_number\":\"9229779459\",\"e_way_bill_no\":\"7832\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"wefve\",\"po_no\":\"PO-20251107-0001\",\"po_date\":\"2025-11-08\",\"notes\":\"esdv c\",\"created_at\":\"2025-11-07 10:13:06\",\"updated_at\":\"2025-11-08 07:44:57\",\"deleted_at\":null,\"select_customer_id\":\"4\",\"created_by_id\":5,\"docket_no\":\"23434\",\"due_date\":\"2025-11-07 00:00:00\",\"terms\":\"esdv\",\"overall_discount\":\"0.00\",\"subtotal\":\"2542.37\",\"tax\":\"457.63\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"attachment\":null,\"sale_invoice_number\":\"ET-20251107101306583\",\"json_data\":\"{\\\"_token\\\":\\\"W2Q6uMHJGMYYBZa9TKWVG89wGDh0NDLSTpTJj6Di\\\",\\\"_method\\\":\\\"PUT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251107-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-08\\\",\\\"due_date\\\":\\\"2025-11-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"wefve\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"18\\\",\\\"amount\\\":\\\"3000.00\\\"}],\\\"notes\\\":\\\"esdv c\\\",\\\"terms\\\":\\\"esdv\\\",\\\"overall_discount\\\":\\\"0.00\\\",\\\"subtotal\\\":\\\"2542.37\\\",\\\"tax\\\":\\\"457.63\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"Pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-08 02:14:57', '2025-11-08 02:14:57'),
(38, 17, 21, 'raw_material', 15, 5, 5, NULL, 0.00, 0.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"3000.00\"}', '{\"id\":15,\"qty\":0,\"type\":\"Opening Stock\",\"created_at\":\"2025-10-15 11:37:50\",\"updated_at\":\"2025-11-08 07:44:57\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Reelay\\\",\\\"item_hsn\\\":\\\"AKUYG434\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-8937-3458\\\",\\\"sale_price\\\":\\\"100\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"80\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"50\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"item_id\":\"21\",\"product_type\":\"raw_material\"}', '{\"id\":17,\"payment_type\":\"credit\",\"phone_number\":\"9229779459\",\"e_way_bill_no\":\"7832\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"wefve\",\"po_no\":\"PO-20251107-0001\",\"po_date\":\"2025-11-08\",\"notes\":\"esdv c\",\"created_at\":\"2025-11-07 10:13:06\",\"updated_at\":\"2025-11-08 07:44:57\",\"deleted_at\":null,\"select_customer_id\":\"4\",\"created_by_id\":5,\"docket_no\":\"23434\",\"due_date\":\"2025-11-07 00:00:00\",\"terms\":\"esdv\",\"overall_discount\":\"0.00\",\"subtotal\":\"2542.37\",\"tax\":\"457.63\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"attachment\":null,\"sale_invoice_number\":\"ET-20251107101306583\",\"json_data\":\"{\\\"_token\\\":\\\"W2Q6uMHJGMYYBZa9TKWVG89wGDh0NDLSTpTJj6Di\\\",\\\"_method\\\":\\\"PUT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251107-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-08\\\",\\\"due_date\\\":\\\"2025-11-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"wefve\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"18\\\",\\\"amount\\\":\\\"3000.00\\\"}],\\\"notes\\\":\\\"esdv c\\\",\\\"terms\\\":\\\"esdv\\\",\\\"overall_discount\\\":\\\"0.00\\\",\\\"subtotal\\\":\\\"2542.37\\\",\\\"tax\\\":\\\"457.63\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"Pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-08 02:14:57', '2025-11-08 02:14:57'),
(39, 17, 22, 'product', 16, 13, 1, 39000.00, 3000.00, 3000.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"3000.00\"}', '{\"id\":16,\"qty\":12,\"type\":\"Manufactured Stock\",\"created_at\":\"2025-10-16 07:18:36\",\"updated_at\":\"2025-11-08 07:44:57\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"Andoride Basic\\\",\\\"item_hsn\\\":\\\"AHUYG435\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"5\\\",\\\"item_code\\\":\\\"ITM-5609-7631\\\",\\\"sale_price\\\":\\\"3000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"2500\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"2000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"5\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"select_raw_materials\\\":[\\\"20\\\",\\\"21\\\",\\\"9\\\"],\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"5\\\\\\\"}\\\"}\",\"item_id\":\"22\",\"product_type\":\"finished_goods\"}', '{\"id\":17,\"payment_type\":\"credit\",\"phone_number\":\"9229779459\",\"e_way_bill_no\":\"7832\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"wefve\",\"po_no\":\"PO-20251107-0001\",\"po_date\":\"2025-11-08\",\"notes\":\"esdv c\",\"created_at\":\"2025-11-07 10:13:06\",\"updated_at\":\"2025-11-08 07:44:57\",\"deleted_at\":null,\"select_customer_id\":\"4\",\"created_by_id\":5,\"docket_no\":\"23434\",\"due_date\":\"2025-11-07 00:00:00\",\"terms\":\"esdv\",\"overall_discount\":\"0.00\",\"subtotal\":\"2542.37\",\"tax\":\"457.63\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"attachment\":null,\"sale_invoice_number\":\"ET-20251107101306583\",\"json_data\":\"{\\\"_token\\\":\\\"W2Q6uMHJGMYYBZa9TKWVG89wGDh0NDLSTpTJj6Di\\\",\\\"_method\\\":\\\"PUT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251107-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-08\\\",\\\"due_date\\\":\\\"2025-11-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"wefve\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"18\\\",\\\"amount\\\":\\\"3000.00\\\"}],\\\"notes\\\":\\\"esdv c\\\",\\\"terms\\\":\\\"esdv\\\",\\\"overall_discount\\\":\\\"0.00\\\",\\\"subtotal\\\":\\\"2542.37\\\",\\\"tax\\\":\\\"457.63\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"Pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-11-08 02:14:57', '2025-11-08 02:14:57'),
(40, 18, 20, 'raw_material', 14, 0, 5, NULL, 0.00, 0.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"3000.00\"}', '{\"id\":14,\"qty\":0,\"type\":\"Opening Stock\",\"created_at\":\"2025-10-15 11:36:36\",\"updated_at\":\"2025-11-08 07:44:57\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Box\\\",\\\"item_hsn\\\":\\\"dsver\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-7362-9293\\\",\\\"sale_price\\\":\\\"100\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"80\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"50\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"item_id\":\"20\",\"product_type\":\"raw_material\"}', '{\"sale_invoice_number\":\"ET-20251202100236802\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251202-0001\",\"docket_no\":\"qwerty\",\"po_date\":\"2025-12-02\",\"due_date\":null,\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"234erty\",\"notes\":\"sdcv\",\"terms\":\"qwsdcv\",\"overall_discount\":\"0\",\"subtotal\":\"2646.61\",\"tax\":\"476.39\",\"discount\":\"0.00\",\"total\":\"3123.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"REcPD33kSQLYdgO5G86rimCXV5d8piIyCi4mdSGN\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251202-0001\\\",\\\"docket_no\\\":\\\"qwerty\\\",\\\"po_date\\\":\\\"2025-12-02\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"234erty\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"18\\\",\\\"amount\\\":\\\"3000.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"123.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"18\\\",\\\"amount\\\":\\\"123.00\\\"}],\\\"notes\\\":\\\"sdcv\\\",\\\"terms\\\":\\\"qwsdcv\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2646.61\\\",\\\"tax\\\":\\\"476.39\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3123.00\\\"}\",\"status\":\"Draft\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"updated_at\":\"2025-12-02 10:02:36\",\"created_at\":\"2025-12-02 10:02:36\",\"id\":18,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-12-02 04:32:36', '2025-12-02 04:32:36'),
(41, 18, 21, 'raw_material', 15, 0, 5, NULL, 0.00, 0.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"3000.00\"}', '{\"id\":15,\"qty\":0,\"type\":\"Opening Stock\",\"created_at\":\"2025-10-15 11:37:50\",\"updated_at\":\"2025-11-08 07:44:57\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"vuUqEoC4ndjZgy2pY6FzrgNnmHbzGqoiRi79S7Wn\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"raw_material\\\",\\\"item_name\\\":\\\"Andoride Reelay\\\",\\\"item_hsn\\\":\\\"AKUYG434\\\",\\\"select_unit_id\\\":\\\"4\\\",\\\"select_category\\\":[\\\"4\\\"],\\\"quantity\\\":\\\"18\\\",\\\"item_code\\\":\\\"ITM-8937-3458\\\",\\\"sale_price\\\":\\\"100\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"80\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"50\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"18\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"raw_material\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"18\\\\\\\"}\\\"}\",\"item_id\":\"21\",\"product_type\":\"raw_material\"}', '{\"sale_invoice_number\":\"ET-20251202100236802\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251202-0001\",\"docket_no\":\"qwerty\",\"po_date\":\"2025-12-02\",\"due_date\":null,\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"234erty\",\"notes\":\"sdcv\",\"terms\":\"qwsdcv\",\"overall_discount\":\"0\",\"subtotal\":\"2646.61\",\"tax\":\"476.39\",\"discount\":\"0.00\",\"total\":\"3123.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"REcPD33kSQLYdgO5G86rimCXV5d8piIyCi4mdSGN\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251202-0001\\\",\\\"docket_no\\\":\\\"qwerty\\\",\\\"po_date\\\":\\\"2025-12-02\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"234erty\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"18\\\",\\\"amount\\\":\\\"3000.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"123.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"18\\\",\\\"amount\\\":\\\"123.00\\\"}],\\\"notes\\\":\\\"sdcv\\\",\\\"terms\\\":\\\"qwsdcv\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2646.61\\\",\\\"tax\\\":\\\"476.39\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3123.00\\\"}\",\"status\":\"Draft\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"updated_at\":\"2025-12-02 10:02:36\",\"created_at\":\"2025-12-02 10:02:36\",\"id\":18,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-12-02 04:32:36', '2025-12-02 04:32:36'),
(42, 18, 22, 'product', 16, 11, 1, 33000.00, 3000.00, 3000.00, '3', '{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"3000.00\"}', '{\"id\":16,\"qty\":10,\"type\":\"Manufactured Stock\",\"created_at\":\"2025-10-16 07:18:36\",\"updated_at\":\"2025-12-02 10:02:36\",\"deleted_at\":null,\"user_id\":1,\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"bAycyNU62CGCf7NZJpi4WLcNsdsDAkkhvBo781lk\\\",\\\"item_type\\\":\\\"product\\\",\\\"product_type\\\":\\\"finished_goods\\\",\\\"item_name\\\":\\\"Andoride Basic\\\",\\\"item_hsn\\\":\\\"AHUYG435\\\",\\\"select_unit_id\\\":\\\"3\\\",\\\"select_category\\\":[\\\"3\\\"],\\\"quantity\\\":\\\"5\\\",\\\"item_code\\\":\\\"ITM-5609-7631\\\",\\\"sale_price\\\":\\\"3000\\\",\\\"select_type\\\":\\\"Without Tax\\\",\\\"disc_on_sale_price\\\":\\\"10\\\",\\\"disc_type\\\":\\\"percentage\\\",\\\"select_tax_id\\\":null,\\\"wholesale_price\\\":\\\"2500\\\",\\\"select_type_wholesale\\\":\\\"Without Tax\\\",\\\"minimum_wholesale_qty\\\":\\\"10\\\",\\\"purchase_price\\\":\\\"2000\\\",\\\"select_purchase_type\\\":\\\"Without Tax\\\",\\\"opening_stock\\\":\\\"5\\\",\\\"low_stock_warning\\\":\\\"1\\\",\\\"warehouse_location\\\":\\\"kamla market\\\",\\\"online_store_title\\\":null,\\\"online_store_description\\\":null,\\\"select_raw_materials\\\":[\\\"20\\\",\\\"21\\\",\\\"9\\\"],\\\"json_data\\\":\\\"{\\\\\\\"item_type\\\\\\\":\\\\\\\"product\\\\\\\",\\\\\\\"product_type\\\\\\\":\\\\\\\"finished_goods\\\\\\\",\\\\\\\"quantity\\\\\\\":\\\\\\\"5\\\\\\\"}\\\"}\",\"item_id\":\"22\",\"product_type\":\"finished_goods\"}', '{\"sale_invoice_number\":\"ET-20251202100236802\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251202-0001\",\"docket_no\":\"qwerty\",\"po_date\":\"2025-12-02\",\"due_date\":null,\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"234erty\",\"notes\":\"sdcv\",\"terms\":\"qwsdcv\",\"overall_discount\":\"0\",\"subtotal\":\"2646.61\",\"tax\":\"476.39\",\"discount\":\"0.00\",\"total\":\"3123.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"REcPD33kSQLYdgO5G86rimCXV5d8piIyCi4mdSGN\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251202-0001\\\",\\\"docket_no\\\":\\\"qwerty\\\",\\\"po_date\\\":\\\"2025-12-02\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"234erty\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"18\\\",\\\"amount\\\":\\\"3000.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"123.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"18\\\",\\\"amount\\\":\\\"123.00\\\"}],\\\"notes\\\":\\\"sdcv\\\",\\\"terms\\\":\\\"qwsdcv\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2646.61\\\",\\\"tax\\\":\\\"476.39\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3123.00\\\"}\",\"status\":\"Draft\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"updated_at\":\"2025-12-02 10:02:36\",\"created_at\":\"2025-12-02 10:02:36\",\"id\":18,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-12-02 04:32:36', '2025-12-02 04:32:36'),
(43, 18, 9, 'service', NULL, NULL, 1, NULL, 123.00, 123.00, NULL, '{\"add_item_id\":\"9\",\"qty\":\"1\",\"price\":\"123.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"123.00\"}', NULL, '{\"sale_invoice_number\":\"ET-20251202100236802\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251202-0001\",\"docket_no\":\"qwerty\",\"po_date\":\"2025-12-02\",\"due_date\":null,\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"234erty\",\"notes\":\"sdcv\",\"terms\":\"qwsdcv\",\"overall_discount\":\"0\",\"subtotal\":\"2646.61\",\"tax\":\"476.39\",\"discount\":\"0.00\",\"total\":\"3123.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"REcPD33kSQLYdgO5G86rimCXV5d8piIyCi4mdSGN\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251202-0001\\\",\\\"docket_no\\\":\\\"qwerty\\\",\\\"po_date\\\":\\\"2025-12-02\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"234erty\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"18\\\",\\\"amount\\\":\\\"3000.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"123.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"18\\\",\\\"amount\\\":\\\"123.00\\\"}],\\\"notes\\\":\\\"sdcv\\\",\\\"terms\\\":\\\"qwsdcv\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2646.61\\\",\\\"tax\\\":\\\"476.39\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3123.00\\\"}\",\"status\":\"Draft\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"updated_at\":\"2025-12-02 10:02:36\",\"created_at\":\"2025-12-02 10:02:36\",\"id\":18,\"image\":null,\"document\":null,\"media\":[]}', 4, '2025-12-02 04:32:36', '2025-12-02 04:32:36');

-- --------------------------------------------------------

--
-- Table structure for table `sale_profit_losses`
--

CREATE TABLE `sale_profit_losses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_invoice_id` bigint(20) UNSIGNED NOT NULL,
  `select_customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `main_cost_center_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_cost_center_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_purchase_value` decimal(16,2) NOT NULL DEFAULT 0.00,
  `total_sale_value` decimal(16,2) NOT NULL DEFAULT 0.00,
  `profit_loss_amount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `is_profit` tinyint(1) NOT NULL DEFAULT 1,
  `composition_json` longtext DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_profit_losses`
--

INSERT INTO `sale_profit_losses` (`id`, `sale_invoice_id`, `select_customer_id`, `main_cost_center_id`, `sub_cost_center_id`, `total_purchase_value`, `total_sale_value`, `profit_loss_amount`, `is_profit`, `composition_json`, `created_by_id`, `created_at`, `updated_at`) VALUES
(1, 10, 1, NULL, 0, 0.00, 18690.00, 18690.00, 1, '[{\"product_id\":7,\"product_name\":null,\"qty\":\"6\",\"purchase_price\":0,\"sale_price\":1500,\"total_purchase\":0,\"total_sale\":9000},{\"product_id\":11,\"product_name\":null,\"qty\":\"10\",\"purchase_price\":0,\"sale_price\":969,\"total_purchase\":0,\"total_sale\":9690}]', 1, '2025-11-03 02:39:28', '2025-11-03 02:39:28'),
(2, 11, 1, 1, 1, 0.00, 3123.00, 3123.00, 1, '[{\"product_id\":7,\"product_name\":null,\"qty\":\"2\",\"purchase_price\":0,\"sale_price\":1500,\"total_purchase\":0,\"total_sale\":3000},{\"product_id\":9,\"product_name\":null,\"qty\":\"1\",\"purchase_price\":0,\"sale_price\":123,\"total_purchase\":0,\"total_sale\":123}]', 1, '2025-11-03 02:39:28', '2025-11-03 02:39:28'),
(3, 12, 1, 1, 1, 0.00, 100.00, 100.00, 1, '[{\"product_id\":9,\"product_name\":null,\"qty\":\"1\",\"purchase_price\":0,\"sale_price\":100,\"total_purchase\":0,\"total_sale\":100}]', 1, '2025-11-03 02:39:28', '2025-11-03 02:39:28'),
(4, 13, 1, 1, 1, 0.00, 2469.00, 2469.00, 1, '[{\"product_id\":7,\"product_name\":null,\"qty\":\"1\",\"purchase_price\":0,\"sale_price\":1500,\"total_purchase\":0,\"total_sale\":1500},{\"product_id\":11,\"product_name\":null,\"qty\":\"1\",\"purchase_price\":0,\"sale_price\":969,\"total_purchase\":0,\"total_sale\":969}]', 1, '2025-11-03 02:39:28', '2025-11-03 02:39:28'),
(5, 14, 4, 4, 2, 2000.00, 2300.00, 300.00, 1, '[{\"product_name\":\"Andoride Basic\",\"qty\":\"1\",\"sale_price\":\"2,000.00\",\"purchase_price\":\"2,000.00\",\"total\":\"2,000.00\",\"raw_materials\":[{\"raw_material_name\":\"Andoride Box\",\"qty\":5,\"sale_price\":\"0.00\",\"purchase_price\":\"0.00\",\"total_sale_value\":\"0.00\",\"total_purchase_value\":\"0.00\"},{\"raw_material_name\":\"Andoride Reelay\",\"qty\":5,\"sale_price\":\"0.00\",\"purchase_price\":\"0.00\",\"total_sale_value\":\"0.00\",\"total_purchase_value\":\"0.00\"},{\"raw_material_name\":\"Service\",\"qty\":5,\"sale_price\":\"0.00\",\"purchase_price\":\"0.00\",\"total_sale_value\":\"0.00\",\"total_purchase_value\":\"0.00\"}]},{\"product_name\":\"Service\",\"qty\":\"1\",\"sale_price\":\"300.00\",\"purchase_price\":\"0.00\",\"total\":\"300.00\",\"raw_materials\":[]}]', 3, '2025-11-03 05:15:43', '2025-11-04 06:11:33'),
(6, 15, 4, 4, 2, 2000.00, 2500.00, 500.00, 1, '[{\"product_name\":\"Andoride Basic\",\"qty\":1,\"sale_price\":2500,\"purchase_price\":2000,\"total\":2500,\"raw_materials\":[{\"raw_material_name\":\"Andoride Box\",\"qty\":5,\"sale_price\":0,\"purchase_price\":0,\"total_sale_value\":0,\"total_purchase_value\":0},{\"raw_material_name\":\"Andoride Reelay\",\"qty\":5,\"sale_price\":0,\"purchase_price\":0,\"total_sale_value\":0,\"total_purchase_value\":0},{\"raw_material_name\":\"Service\",\"qty\":5,\"sale_price\":0,\"purchase_price\":0,\"total_sale_value\":0,\"total_purchase_value\":0}]}]', 3, '2025-11-04 06:06:08', '2025-11-07 02:19:59'),
(7, 16, 4, 4, 2, 10000.00, 15000.00, 5000.00, 1, '[{\"product_name\":\"Andoride Basic\",\"qty\":5,\"sale_price\":2600,\"purchase_price\":2000,\"total\":13000,\"raw_materials\":[{\"raw_material_name\":\"Andoride Box\",\"qty\":5,\"sale_price\":0,\"purchase_price\":0,\"total_sale_value\":0,\"total_purchase_value\":0},{\"raw_material_name\":\"Andoride Reelay\",\"qty\":5,\"sale_price\":0,\"purchase_price\":0,\"total_sale_value\":0,\"total_purchase_value\":0},{\"raw_material_name\":\"Service\",\"qty\":5,\"sale_price\":0,\"purchase_price\":0,\"total_sale_value\":0,\"total_purchase_value\":0}]},{\"product_name\":\"Service\",\"qty\":5,\"sale_price\":400,\"purchase_price\":0,\"total\":2000,\"raw_materials\":[]}]', 3, '2025-11-04 06:33:56', '2025-11-07 02:58:04'),
(10, 17, 4, 4, 3, 0.00, 3000.00, 3000.00, 1, '[{\"finished_item_id\":22,\"finished_item_name\":\"Andoride Basic\",\"raw_material_id\":20,\"raw_material_name\":\"Andoride Basic\",\"qty_used_per_finished\":5,\"used_total_qty\":5,\"sale_price_at_time\":0,\"purchase_price_at_time\":0,\"total_sale_value\":0,\"total_purchase_value\":0},{\"finished_item_id\":22,\"finished_item_name\":\"Andoride Basic\",\"raw_material_id\":21,\"raw_material_name\":\"Andoride Basic\",\"qty_used_per_finished\":5,\"used_total_qty\":5,\"sale_price_at_time\":0,\"purchase_price_at_time\":0,\"total_sale_value\":0,\"total_purchase_value\":0},{\"finished_item_id\":22,\"finished_item_name\":\"Andoride Basic\",\"raw_material_id\":9,\"raw_material_name\":\"Andoride Basic\",\"qty_used_per_finished\":5,\"used_total_qty\":5,\"sale_price_at_time\":0,\"purchase_price_at_time\":0,\"total_sale_value\":0,\"total_purchase_value\":0}]', 3, '2025-11-08 02:14:57', '2025-11-08 02:14:57'),
(11, 18, 4, 4, 3, 2000.00, 3123.00, 1123.00, 1, '[{\"product_name\":\"Andoride Basic\",\"qty\":1,\"sale_price\":3000,\"purchase_price\":2000,\"total\":3000,\"raw_materials\":[{\"raw_material_name\":\"Andoride Box\",\"qty\":5,\"sale_price\":0,\"purchase_price\":0,\"total_sale_value\":0,\"total_purchase_value\":0},{\"raw_material_name\":\"Andoride Reelay\",\"qty\":5,\"sale_price\":0,\"purchase_price\":0,\"total_sale_value\":0,\"total_purchase_value\":0},{\"raw_material_name\":\"Service\",\"qty\":5,\"sale_price\":0,\"purchase_price\":0,\"total_sale_value\":0,\"total_purchase_value\":0}]},{\"product_name\":\"Service\",\"qty\":1,\"sale_price\":123,\"purchase_price\":0,\"total\":123,\"raw_materials\":[]}]', 3, '2025-12-02 04:32:36', '2025-12-02 04:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `sub_cost_centers`
--

CREATE TABLE `sub_cost_centers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_cost_center_name` varchar(255) NOT NULL,
  `unique_code` varchar(255) DEFAULT NULL,
  `details_of_sub_cost_center` longtext DEFAULT NULL,
  `responsible_manager` varchar(255) NOT NULL,
  `budget_allocated` varchar(255) DEFAULT NULL,
  `actual_expense` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `main_cost_center_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_cost_centers`
--

INSERT INTO `sub_cost_centers` (`id`, `sub_cost_center_name`, `unique_code`, `details_of_sub_cost_center`, `responsible_manager`, `budget_allocated`, `actual_expense`, `start_date`, `status`, `created_at`, `updated_at`, `deleted_at`, `main_cost_center_id`, `created_by_id`) VALUES
(1, 'Holly Holmes', 'Consequatur quo debi', 'Doloribus consequat', 'Dolor et sit neque', '36', '7', '2024-09-07', 'active', '2025-09-22 02:40:12', '2025-09-22 02:40:12', NULL, 1, NULL),
(2, 'Irma Barr', '234324', 'Voluptate et ab mini', 'Maxime qui doloremqu', 'Reprehenderit dolor', 'Possimus sint lauda', '2018-09-15', 'active', '2025-11-03 03:13:45', '2025-11-03 03:14:34', NULL, 4, 3),
(3, 'Punjab', 'Non debitis quo magn', 'Quia nemo inventore', 'Nulla numquam omnis', 'Consequuntur suscipi', 'Id quis ipsum et qu', '1991-11-15', 'active', '2025-11-07 04:02:06', '2025-11-07 04:02:42', NULL, 4, 3),
(4, 'kolkata', NULL, NULL, 'aja', NULL, NULL, NULL, 'active', '2025-11-08 05:31:14', '2025-11-08 05:31:14', NULL, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tax_rates`
--

CREATE TABLE `tax_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `parcentage` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tax_rates`
--

INSERT INTO `tax_rates` (`id`, `name`, `parcentage`, `created_at`, `updated_at`, `deleted_at`, `created_by_id`) VALUES
(1, 'IGST', '6', '2025-09-01 04:59:03', '2025-09-01 04:59:03', NULL, NULL),
(2, 'CGST', '6', '2025-09-01 04:59:21', '2025-09-01 04:59:21', NULL, NULL),
(3, '12%', '12', '2025-10-14 04:46:40', '2025-10-14 04:46:40', NULL, 2),
(4, '6%', '6', '2025-10-14 04:46:54', '2025-10-14 04:46:54', NULL, 2),
(5, '18%', '18', '2025-10-14 04:47:04', '2025-10-14 04:47:04', NULL, 2),
(6, '24%', '24', '2025-10-14 04:47:14', '2025-10-14 04:47:14', NULL, 2),
(7, 'Gst 18%', '18', '2025-11-03 01:13:58', '2025-11-03 01:13:58', NULL, 5),
(8, 'GST 18 %', '18', '2025-11-04 00:54:42', '2025-11-04 02:40:00', '2025-11-04 02:40:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `terms_and_conditions`
--

CREATE TABLE `terms_and_conditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms_and_conditions`
--

INSERT INTO `terms_and_conditions` (`id`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Term And Condition', 'hen you land on a sample web page or open an email template and see content beginning with \"lorem ipsum,\" the page creator placed that apparent gibberish there on purpose.\r\n\r\nPage layouts look better with something in each section. Web page designers, content writers, and layout artists use lorem ipsum, also known as placeholder copy, to distinguish which areas on a page will hold advertisements, editorials, and filler before the final written content and website designs receive client approval.\r\n\r\nFun Lorem Ipsum text may appear in any size and font to simulate everything you create for your campaigns.', 'active', '2025-11-04 06:36:38', '2025-11-04 06:36:38');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_bill_id` bigint(20) UNSIGNED DEFAULT NULL,
  `select_customer_id` bigint(20) UNSIGNED NOT NULL,
  `main_cost_center_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_cost_center_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `purchase_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `opening_balance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `closing_balance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `transaction_type` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(20) NOT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `json_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json_data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sale_invoice_id` int(10) DEFAULT NULL,
  `sale_amount` decimal(15,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `purchase_bill_id`, `select_customer_id`, `main_cost_center_id`, `sub_cost_center_id`, `payment_type_id`, `purchase_amount`, `opening_balance`, `closing_balance`, `transaction_type`, `transaction_id`, `created_by_id`, `json_data`, `created_at`, `updated_at`, `sale_invoice_id`, `sale_amount`) VALUES
(2, 20, 1, 1, 1, 1, 13761.40, 100.00, 13861.40, 'purchase', 'TXN8169922312', 1, '{\"request\":{\"_token\":\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\",\"select_customer_id\":\"1\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"po_no\":\"ET-20251009-0001\",\"docket_no\":\"23434\",\"purchase_bill_no\":\"2343453\",\"po_date\":\"2025-10-09\",\"due_date\":\"2025-10-09\",\"e_way_bill_no\":\"7832\",\"customer_phone_invoice\":\"8863897163\",\"billing_address_invoice\":\"svccv xc xc dx&nbsp;\",\"shipping_address_invoice\":\"serdvesv cdx&nbsp;\",\"items\":[{\"id\":\"7\",\"qty\":\"10\",\"price\":\"1000\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"6\",\"amount\":\"10494.00\"},{\"id\":\"9\",\"qty\":\"10\",\"price\":\"300\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"12\",\"amount\":\"3248.00\"}],\"description\":\"sdxfcgvbn\",\"terms\":\"sdfghjm\",\"overall_discount\":\"1000\",\"subtotal\":\"13742.00\",\"tax\":\"1019.40\",\"discount\":\"1200.00\",\"total\":\"13761.40\",\"payment_type_id\":\"1\",\"reference_no\":\"qwer\",\"notes\":\"asdfcvb\",\"image\":{},\"document\":{}},\"invoice\":{\"purchase_invoice_number\":\"ET-20251009072112639\",\"select_customer_id\":\"1\",\"po_no\":\"ET-20251009-0001\",\"reference_no\":\"qwer\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":\"2025-10-09\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx&nbsp;\",\"shipping_address\":\"serdvesv cdx&nbsp;\",\"notes\":\"asdfcvb\",\"terms\":\"sdfghjm\",\"overall_discount\":\"1000\",\"subtotal\":\"13742.00\",\"tax\":\"1019.40\",\"discount\":\"1200.00\",\"total\":\"13761.40\",\"attachment\":null,\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"payment_type_id\":\"1\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251009-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"purchase_bill_no\\\":\\\"2343453\\\",\\\"po_date\\\":\\\"2025-10-09\\\",\\\"due_date\\\":\\\"2025-10-09\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx&nbsp;\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx&nbsp;\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"6\\\",\\\"amount\\\":\\\"10494.00\\\"},{\\\"id\\\":\\\"9\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"300\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"12\\\",\\\"amount\\\":\\\"3248.00\\\"}],\\\"description\\\":\\\"sdxfcgvbn\\\",\\\"terms\\\":\\\"sdfghjm\\\",\\\"overall_discount\\\":\\\"1000\\\",\\\"subtotal\\\":\\\"13742.00\\\",\\\"tax\\\":\\\"1019.40\\\",\\\"discount\\\":\\\"1200.00\\\",\\\"total\\\":\\\"13761.40\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"qwer\\\",\\\"notes\\\":\\\"asdfcvb\\\",\\\"image\\\":{},\\\"document\\\":{}}\",\"updated_at\":\"2025-10-09 07:21:12\",\"created_at\":\"2025-10-09 07:21:12\",\"id\":20,\"image\":null,\"document\":null,\"media\":[]},\"customer_before\":{\"balance\":100,\"type\":\"Debit\"},\"customer_after\":{\"balance\":13861.4,\"type\":\"Debit\"}}', '2025-10-09 01:51:12', '2025-10-09 01:51:12', NULL, NULL),
(3, 21, 1, 1, 1, 1, 44495.00, 13861.40, 58356.40, 'purchase', 'TXN4943727701', 1, '{\"request\":{\"_token\":\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\",\"select_customer_id\":\"1\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"po_no\":\"ET-20251009-0002\",\"docket_no\":\"23434\",\"purchase_bill_no\":\"2343453\",\"po_date\":\"2025-10-09\",\"due_date\":\"2025-10-09\",\"e_way_bill_no\":\"7832\",\"customer_phone_invoice\":\"8863897163\",\"billing_address_invoice\":\"svccv xc xc dx&nbsp;\",\"shipping_address_invoice\":\"serdvesv cdx&nbsp;\",\"items\":[{\"id\":\"7\",\"qty\":\"20\",\"price\":\"1000\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"10\",\"amount\":\"21890.00\"},{\"id\":\"11\",\"qty\":\"1\",\"price\":\"5454\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"100\",\"amount\":\"10708.00\"}],\"description\":\"lkjhgf\",\"terms\":\"uyd\",\"overall_discount\":\"1000\",\"subtotal\":\"32598.00\",\"tax\":\"12897.00\",\"discount\":\"1200.00\",\"total\":\"44495.00\",\"payment_type_id\":\"1\",\"reference_no\":\"uhsfjhe88\",\"notes\":\"sdert\",\"image\":{},\"document\":{}},\"invoice\":{\"purchase_invoice_number\":\"ET-20251009080425838\",\"select_customer_id\":\"1\",\"po_no\":\"ET-20251009-0002\",\"reference_no\":\"uhsfjhe88\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":\"2025-10-09\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx&nbsp;\",\"shipping_address\":\"serdvesv cdx&nbsp;\",\"notes\":\"sdert\",\"terms\":\"uyd\",\"overall_discount\":\"1000\",\"subtotal\":\"32598.00\",\"tax\":\"12897.00\",\"discount\":\"1200.00\",\"total\":\"44495.00\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"payment_type_id\":\"1\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"ET-20251009-0002\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"purchase_bill_no\\\":\\\"2343453\\\",\\\"po_date\\\":\\\"2025-10-09\\\",\\\"due_date\\\":\\\"2025-10-09\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx&nbsp;\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx&nbsp;\\\",\\\"items\\\":[{\\\"id\\\":\\\"7\\\",\\\"qty\\\":\\\"20\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"21890.00\\\"},{\\\"id\\\":\\\"11\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"5454\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"100\\\",\\\"amount\\\":\\\"10708.00\\\"}],\\\"description\\\":\\\"lkjhgf\\\",\\\"terms\\\":\\\"uyd\\\",\\\"overall_discount\\\":\\\"1000\\\",\\\"subtotal\\\":\\\"32598.00\\\",\\\"tax\\\":\\\"12897.00\\\",\\\"discount\\\":\\\"1200.00\\\",\\\"total\\\":\\\"44495.00\\\",\\\"payment_type_id\\\":\\\"1\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"notes\\\":\\\"sdert\\\",\\\"image\\\":{},\\\"document\\\":{}}\",\"updated_at\":\"2025-10-09 08:04:25\",\"created_at\":\"2025-10-09 08:04:25\",\"id\":21,\"image\":null,\"document\":null,\"media\":[]},\"customer_before\":{\"balance\":13861.4,\"type\":\"Debit\"},\"customer_after\":{\"balance\":58356.4,\"type\":\"Debit\"}}', '2025-10-09 02:34:32', '2025-10-09 02:34:32', NULL, NULL),
(4, NULL, 1, 1, 1, NULL, 0.00, 58356.40, 54810.67, 'sale', 'TXN9874177571', 1, '{\"request\":{\"_token\":\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"po_no\":\"PO-20251009-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":null,\"e_way_bill_no\":\"7832\",\"customer_phone_invoice\":\"8863897163\",\"billing_address_invoice\":\"svccv xc xc dx\",\"shipping_address_invoice\":\"serdvesv cdx\",\"items\":[{\"add_item_id\":\"7\",\"qty\":\"2\",\"price\":\"1500\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"10\",\"amount\":\"3190.00\"},{\"add_item_id\":\"9\",\"qty\":\"1\",\"price\":\"123\",\"discount_type\":\"value\",\"discount\":\"10\",\"tax_type\":\"with\",\"tax\":\"10\",\"amount\":\"124.30\"}],\"notes\":\"sd\",\"terms\":\"wqerfgf\",\"overall_discount\":\"100\",\"subtotal\":\"3314.30\",\"tax\":\"331.43\",\"discount\":\"210.00\",\"total\":\"3545.73\",\"attachment\":{}},\"invoice\":{\"sale_invoice_number\":\"ET-20251009091902499\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251009-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":null,\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"sd\",\"terms\":\"wqerfgf\",\"overall_discount\":\"100\",\"subtotal\":\"3314.30\",\"tax\":\"331.43\",\"discount\":\"210.00\",\"total\":\"3545.73\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251009-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-09\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"7\\\",\\\"qty\\\":\\\"2\\\",\\\"price\\\":\\\"1500\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"3190.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"123\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"10\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"10\\\",\\\"amount\\\":\\\"124.30\\\"}],\\\"notes\\\":\\\"sd\\\",\\\"terms\\\":\\\"wqerfgf\\\",\\\"overall_discount\\\":\\\"100\\\",\\\"subtotal\\\":\\\"3314.30\\\",\\\"tax\\\":\\\"331.43\\\",\\\"discount\\\":\\\"210.00\\\",\\\"total\\\":\\\"3545.73\\\",\\\"attachment\\\":{}}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-09 09:19:02\",\"created_at\":\"2025-10-09 09:19:02\",\"id\":11,\"image\":null,\"document\":null,\"media\":[]},\"customer_before\":{\"balance\":\"58356.4\",\"type\":\"Debit\"},\"customer_after\":{\"balance\":54810.67,\"type\":\"Debit\"}}', '2025-10-09 03:49:03', '2025-10-09 03:49:03', 11, 3545.73),
(5, NULL, 1, 1, 1, NULL, 0.00, 54810.67, 54710.67, 'sale', 'TXN5500588736', 1, '{\"request\":{\"_token\":\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"po_no\":\"PO-20251009-0002\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":null,\"e_way_bill_no\":\"7832\",\"customer_phone_invoice\":\"8863897163\",\"billing_address_invoice\":\"svccv xc xc dx\",\"shipping_address_invoice\":\"serdvesv cdx\",\"items\":[{\"add_item_id\":\"9\",\"qty\":\"1\",\"price\":\"100\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"100.00\"}],\"notes\":\"sdvf\",\"terms\":\"asdf\",\"overall_discount\":\"0\",\"subtotal\":\"100.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"100.00\",\"attachment\":{}},\"invoice\":{\"sale_invoice_number\":\"ET-20251009092416679\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251009-0002\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":null,\"e_way_bill_no\":\"7832\",\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":\"sdvf\",\"terms\":\"asdf\",\"overall_discount\":\"0\",\"subtotal\":\"100.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"100.00\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"4P6sNneL3PgAWUmG8q6NXCp4XRn9X2Pykwcltx9t\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251009-0002\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-09\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"100\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"100.00\\\"}],\\\"notes\\\":\\\"sdvf\\\",\\\"terms\\\":\\\"asdf\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"100.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"100.00\\\",\\\"attachment\\\":{}}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-09 09:24:16\",\"created_at\":\"2025-10-09 09:24:16\",\"id\":12,\"image\":null,\"document\":null,\"media\":[]},\"customer_before\":{\"balance\":\"54810.67\",\"type\":\"Debit\"},\"customer_after\":{\"balance\":54710.67,\"type\":\"Debit\"}}', '2025-10-09 03:54:16', '2025-10-09 03:54:16', 12, 100.00),
(6, NULL, 1, 1, 1, NULL, 0.00, 54710.67, 52168.63, 'sale', 'TXN7715245180', 1, '{\"request\":{\"_token\":\"Fo6CTOR4BQvP7trjCp3lQiwMTn8fAP8VLsoZ5EBT\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"po_no\":\"PO-20251009-0003\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":null,\"e_way_bill_no\":null,\"customer_phone_invoice\":\"8863897163\",\"billing_address_invoice\":\"svccv xc xc dx\",\"shipping_address_invoice\":\"serdvesv cdx\",\"items\":[{\"add_item_id\":\"7\",\"qty\":\"1\",\"price\":\"1500\",\"discount_type\":\"value\",\"discount\":\"100\",\"tax_type\":\"with\",\"tax\":\"6\",\"amount\":\"1484.00\"},{\"add_item_id\":\"11\",\"qty\":\"1\",\"price\":\"969\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"969.00\"}],\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"2453.00\",\"tax\":\"89.04\",\"discount\":\"100.00\",\"total\":\"2542.04\"},\"invoice\":{\"sale_invoice_number\":\"ET-20251009134653248\",\"payment_type\":\"credit\",\"select_customer_id\":\"1\",\"po_no\":\"PO-20251009-0003\",\"docket_no\":\"23434\",\"po_date\":\"2025-10-09\",\"due_date\":null,\"e_way_bill_no\":null,\"phone_number\":\"8863897163\",\"billing_address\":\"svccv xc xc dx\",\"shipping_address\":\"serdvesv cdx\",\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"2453.00\",\"tax\":\"89.04\",\"discount\":\"100.00\",\"total\":\"2542.04\",\"created_by_id\":1,\"json_data\":\"{\\\"_token\\\":\\\"Fo6CTOR4BQvP7trjCp3lQiwMTn8fAP8VLsoZ5EBT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"1\\\",\\\"main_cost_center_id\\\":\\\"1\\\",\\\"sub_cost_center_id\\\":\\\"1\\\",\\\"po_no\\\":\\\"PO-20251009-0003\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-10-09\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":null,\\\"customer_phone_invoice\\\":\\\"8863897163\\\",\\\"billing_address_invoice\\\":\\\"svccv xc xc dx\\\",\\\"shipping_address_invoice\\\":\\\"serdvesv cdx\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"7\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"1500\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"100\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"6\\\",\\\"amount\\\":\\\"1484.00\\\"},{\\\"add_item_id\\\":\\\"11\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"969\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"969.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2453.00\\\",\\\"tax\\\":\\\"89.04\\\",\\\"discount\\\":\\\"100.00\\\",\\\"total\\\":\\\"2542.04\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"1\",\"sub_cost_center_id\":\"1\",\"updated_at\":\"2025-10-09 13:46:53\",\"created_at\":\"2025-10-09 13:46:53\",\"id\":13,\"image\":null,\"document\":null,\"media\":[]},\"customer_before\":{\"balance\":\"54710.67\",\"type\":\"Debit\"},\"customer_after\":{\"balance\":52168.63,\"type\":\"Debit\"}}', '2025-10-09 08:16:53', '2025-10-09 08:16:53', 13, 2542.04),
(7, NULL, 4, 4, 2, NULL, 0.00, 1.00, 2299.00, 'sale', 'TXN8912854462', 3, '{\"request\":{\"_token\":\"9SlzqBE8v1fmGNgB5xkNdizYUkTJ0Isd7IRCc8NH\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"po_no\":\"PO-20251103-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-11-03\",\"due_date\":\"2025-11-03\",\"e_way_bill_no\":\"7832\",\"customer_phone_invoice\":\"9229779459\",\"billing_address_invoice\":\"Voluptatem aut moll\",\"shipping_address_invoice\":\"tnmgjhkj\",\"items\":[{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"2000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"2000.00\"},{\"add_item_id\":\"9\",\"qty\":\"1\",\"price\":\"300\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"300.00\"}],\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"2300.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"2300.00\"},\"invoice\":{\"sale_invoice_number\":\"ET-20251103104543519\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251103-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-11-03\",\"due_date\":\"2025-11-03 00:00:00\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"tnmgjhkj\",\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"2300.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"2300.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"9SlzqBE8v1fmGNgB5xkNdizYUkTJ0Isd7IRCc8NH\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"PO-20251103-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-03\\\",\\\"due_date\\\":\\\"2025-11-03\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"tnmgjhkj\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"2000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"2000.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"300\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"300.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2300.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"2300.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"updated_at\":\"2025-11-03 10:45:43\",\"created_at\":\"2025-11-03 10:45:43\",\"id\":14,\"image\":null,\"document\":null,\"media\":[]},\"customer_before\":{\"balance\":\"1.00\",\"type\":\"Debit\"},\"customer_after\":{\"balance\":2299,\"type\":\"Credit\"}}', '2025-11-03 05:15:43', '2025-11-03 05:15:43', 14, 2300.00),
(8, NULL, 4, 4, 2, NULL, 0.00, 2299.00, 4799.00, 'sale', 'TXN3215216313', 3, '{\"request\":{\"_token\":\"6ASVoJ3pV8P0JUq8D76lg5Cd0FLKdZhpICTmJvim\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"po_no\":\"PO-20251104-0001\",\"docket_no\":\"45654\",\"po_date\":\"2025-11-04\",\"due_date\":\"2025-11-04\",\"e_way_bill_no\":\"4354\",\"customer_phone_invoice\":\"9229779459\",\"billing_address_invoice\":\"Voluptatem aut moll\",\"shipping_address_invoice\":null,\"items\":[{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"2500.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"2500.00\"}],\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"2500.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"2500.00\"},\"invoice\":{\"sale_invoice_number\":\"ET-20251104113608642\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251104-0001\",\"docket_no\":\"45654\",\"po_date\":\"2025-11-04\",\"due_date\":\"2025-11-04 00:00:00\",\"e_way_bill_no\":\"4354\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":null,\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"2500.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"2500.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"6ASVoJ3pV8P0JUq8D76lg5Cd0FLKdZhpICTmJvim\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"PO-20251104-0001\\\",\\\"docket_no\\\":\\\"45654\\\",\\\"po_date\\\":\\\"2025-11-04\\\",\\\"due_date\\\":\\\"2025-11-04\\\",\\\"e_way_bill_no\\\":\\\"4354\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":null,\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"2500.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"2500.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2500.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"2500.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"updated_at\":\"2025-11-04 11:36:08\",\"created_at\":\"2025-11-04 11:36:08\",\"id\":15,\"image\":null,\"document\":null,\"media\":[]},\"customer_before\":{\"balance\":\"2299\",\"type\":\"Credit\"},\"customer_after\":{\"balance\":4799,\"type\":\"Credit\"}}', '2025-11-04 06:06:08', '2025-11-04 06:06:08', 15, 2500.00),
(9, NULL, 4, NULL, NULL, NULL, 0.00, 13799.00, 28799.00, 'sale', 'TXN4598633883', 3, '{\"request\":{\"_token\":\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\",\"_method\":\"PUT\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251104-0002\",\"docket_no\":\"32423\",\"po_date\":\"2025-11-04\",\"due_date\":null,\"e_way_bill_no\":\"4354\",\"customer_phone_invoice\":\"9229779459\",\"billing_address_invoice\":\"Voluptatem aut moll\",\"shipping_address_invoice\":\"Architecto eos cum n\",\"items\":[{\"add_item_id\":\"22\",\"qty\":\"5\",\"price\":\"2600.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"13000.00\"},{\"add_item_id\":\"9\",\"qty\":\"5\",\"price\":\"400\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"2000.00\"}],\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"15000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"15000.00\"},\"invoice\":{\"id\":16,\"payment_type\":\"credit\",\"phone_number\":\"9229779459\",\"e_way_bill_no\":\"4354\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"po_no\":\"PO-20251104-0002\",\"po_date\":\"2025-11-04\",\"notes\":null,\"created_at\":\"2025-11-04 12:03:56\",\"updated_at\":\"2025-11-05 11:02:45\",\"deleted_at\":null,\"select_customer_id\":\"4\",\"created_by_id\":3,\"docket_no\":\"32423\",\"due_date\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"15000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"15000.00\",\"attachment\":null,\"sale_invoice_number\":\"ET-20251104120356123\",\"json_data\":\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"_method\\\":\\\"PUT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"po_no\\\":\\\"PO-20251104-0002\\\",\\\"docket_no\\\":\\\"32423\\\",\\\"po_date\\\":\\\"2025-11-04\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":\\\"4354\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"Architecto eos cum n\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"5\\\",\\\"price\\\":\\\"2600.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"13000.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"5\\\",\\\"price\\\":\\\"400\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"2000.00\\\"}],\\\"notes\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"15000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"15000.00\\\"}\",\"status\":\"pending\",\"main_cost_center_id\":4,\"sub_cost_center_id\":2,\"image\":null,\"document\":null,\"media\":[]},\"customer_before\":{\"balance\":\"13799\",\"type\":\"Credit\"},\"customer_after\":{\"balance\":28799,\"type\":\"Credit\"}}', '2025-11-04 06:33:56', '2025-11-05 05:32:45', 16, 15000.00),
(10, 22, 4, 4, 2, 4, 20000.00, 28799.00, 8799.00, 'purchase', 'TXN3344828916', 3, '{\"request\":{\"_token\":\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\",\"select_customer_id\":\"4\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"po_no\":\"ET-20251105-0001\",\"docket_no\":\"23434\",\"purchase_bill_no\":\"2343453\",\"po_date\":\"2025-11-05\",\"due_date\":\"2025-11-05\",\"e_way_bill_no\":\"7832\",\"customer_phone_invoice\":\"9229779459\",\"billing_address_invoice\":\"Voluptatem aut moll\",\"shipping_address_invoice\":\"Architecto eos cum n\",\"items\":[{\"id\":\"22\",\"qty\":\"10\",\"price\":\"2000\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"20000.00\"}],\"description\":\"qewfsdgbh\",\"terms\":\"waesrdtfgh\",\"overall_discount\":\"0\",\"subtotal\":\"20000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"20000.00\",\"payment_type_id\":\"4\",\"reference_no\":\"uhsfjhe88\",\"notes\":null},\"invoice\":{\"purchase_invoice_number\":\"ET-20251105114011943\",\"select_customer_id\":\"4\",\"po_no\":\"ET-20251105-0001\",\"reference_no\":\"uhsfjhe88\",\"docket_no\":\"23434\",\"po_date\":\"2025-11-05\",\"due_date\":\"2025-11-05\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"notes\":null,\"terms\":\"waesrdtfgh\",\"overall_discount\":\"0\",\"subtotal\":\"20000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"20000.00\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"payment_type_id\":\"4\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"ET-20251105-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"purchase_bill_no\\\":\\\"2343453\\\",\\\"po_date\\\":\\\"2025-11-05\\\",\\\"due_date\\\":\\\"2025-11-05\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"Architecto eos cum n\\\",\\\"items\\\":[{\\\"id\\\":\\\"22\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"2000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"20000.00\\\"}],\\\"description\\\":\\\"qewfsdgbh\\\",\\\"terms\\\":\\\"waesrdtfgh\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"20000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"20000.00\\\",\\\"payment_type_id\\\":\\\"4\\\",\\\"reference_no\\\":\\\"uhsfjhe88\\\",\\\"notes\\\":null}\",\"updated_at\":\"2025-11-05 11:40:11\",\"created_at\":\"2025-11-05 11:40:11\",\"id\":22,\"image\":null,\"document\":null,\"media\":[]},\"customer_before\":{\"balance\":28799,\"type\":\"Credit\"},\"customer_after\":{\"balance\":8799,\"type\":\"Credit\"}}', '2025-11-05 06:10:11', '2025-11-05 06:10:11', NULL, 0.00),
(11, 23, 4, 4, 2, 4, 6000.00, 8799.00, 2799.00, 'purchase', 'TXN6718777687', 3, '{\"request\":{\"_token\":\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\",\"select_customer_id\":\"4\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"po_no\":\"ET-20251105-0002\",\"docket_no\":null,\"purchase_bill_no\":null,\"po_date\":\"2025-11-05\",\"due_date\":\"2025-11-05\",\"e_way_bill_no\":null,\"customer_phone_invoice\":\"9229779459\",\"billing_address_invoice\":\"Voluptatem aut moll\",\"shipping_address_invoice\":\"Architecto eos cum n\",\"items\":[{\"id\":\"22\",\"qty\":\"3\",\"price\":\"2000\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"6000.00\"}],\"description\":\"asfdfb\",\"terms\":\"sdbvdfb\",\"overall_discount\":\"0\",\"subtotal\":\"6000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"6000.00\",\"payment_type_id\":\"4\",\"reference_no\":\"dfbnfgb\",\"notes\":null},\"invoice\":{\"purchase_invoice_number\":\"ET-20251105114221659\",\"select_customer_id\":\"4\",\"po_no\":\"ET-20251105-0002\",\"reference_no\":\"dfbnfgb\",\"docket_no\":null,\"po_date\":\"2025-11-05\",\"due_date\":\"2025-11-05\",\"e_way_bill_no\":null,\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"notes\":null,\"terms\":\"sdbvdfb\",\"overall_discount\":\"0\",\"subtotal\":\"6000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"6000.00\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"payment_type_id\":\"4\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"ET-20251105-0002\\\",\\\"docket_no\\\":null,\\\"purchase_bill_no\\\":null,\\\"po_date\\\":\\\"2025-11-05\\\",\\\"due_date\\\":\\\"2025-11-05\\\",\\\"e_way_bill_no\\\":null,\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"Architecto eos cum n\\\",\\\"items\\\":[{\\\"id\\\":\\\"22\\\",\\\"qty\\\":\\\"3\\\",\\\"price\\\":\\\"2000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"6000.00\\\"}],\\\"description\\\":\\\"asfdfb\\\",\\\"terms\\\":\\\"sdbvdfb\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"6000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"6000.00\\\",\\\"payment_type_id\\\":\\\"4\\\",\\\"reference_no\\\":\\\"dfbnfgb\\\",\\\"notes\\\":null}\",\"updated_at\":\"2025-11-05 11:42:21\",\"created_at\":\"2025-11-05 11:42:21\",\"id\":23,\"image\":null,\"document\":null,\"media\":[]},\"customer_before\":{\"balance\":8799,\"type\":\"Credit\"},\"customer_after\":{\"balance\":2799,\"type\":\"Credit\"}}', '2025-11-05 06:12:21', '2025-11-05 06:12:21', NULL, 0.00),
(12, 24, 4, 4, 2, 4, 10000.00, 2799.00, 7201.00, 'purchase', 'TXN3826179611', 3, '{\"request\":{\"_token\":\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\",\"select_customer_id\":\"4\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"po_no\":\"ET-20251105-0003\",\"docket_no\":\"23434\",\"purchase_bill_no\":\"2343453\",\"po_date\":\"2025-11-05\",\"due_date\":\"2025-11-05\",\"e_way_bill_no\":\"7832\",\"customer_phone_invoice\":\"9229779459\",\"billing_address_invoice\":\"Voluptatem aut moll\",\"shipping_address_invoice\":\"Architecto eos cum n\",\"items\":[{\"id\":\"30\",\"qty\":\"10\",\"price\":\"1000\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"without\",\"tax\":\"0\",\"amount\":\"10000.00\"}],\"description\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"10000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"10000.00\",\"payment_type_id\":\"4\",\"reference_no\":\"rghryjtuh\",\"notes\":null},\"invoice\":{\"purchase_invoice_number\":\"ET-20251105120452643\",\"select_customer_id\":\"4\",\"po_no\":\"ET-20251105-0003\",\"reference_no\":\"rghryjtuh\",\"docket_no\":\"23434\",\"po_date\":\"2025-11-05\",\"due_date\":\"2025-11-05\",\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"Architecto eos cum n\",\"notes\":null,\"terms\":null,\"overall_discount\":\"0\",\"subtotal\":\"10000.00\",\"tax\":\"0.00\",\"discount\":\"0.00\",\"total\":\"10000.00\",\"status\":\"pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"2\",\"payment_type_id\":\"4\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"oiR8IjgIjkfQXORf2NIj0ALF8drqjq9d9Tyu9uHq\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"2\\\",\\\"po_no\\\":\\\"ET-20251105-0003\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"purchase_bill_no\\\":\\\"2343453\\\",\\\"po_date\\\":\\\"2025-11-05\\\",\\\"due_date\\\":\\\"2025-11-05\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"Architecto eos cum n\\\",\\\"items\\\":[{\\\"id\\\":\\\"30\\\",\\\"qty\\\":\\\"10\\\",\\\"price\\\":\\\"1000\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"without\\\",\\\"tax\\\":\\\"0\\\",\\\"amount\\\":\\\"10000.00\\\"}],\\\"description\\\":null,\\\"terms\\\":null,\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"10000.00\\\",\\\"tax\\\":\\\"0.00\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"10000.00\\\",\\\"payment_type_id\\\":\\\"4\\\",\\\"reference_no\\\":\\\"rghryjtuh\\\",\\\"notes\\\":null}\",\"updated_at\":\"2025-11-05 12:04:52\",\"created_at\":\"2025-11-05 12:04:52\",\"id\":24,\"image\":null,\"document\":null,\"media\":[]},\"customer_before\":{\"balance\":2799,\"type\":\"Credit\"},\"customer_after\":{\"balance\":7201,\"type\":\"Debit\"}}', '2025-11-05 06:34:52', '2025-11-05 06:34:52', NULL, 0.00),
(13, NULL, 4, 4, 3, NULL, 0.00, 7201.00, 4201.00, 'sale', 'TXN3923956160', 5, '{\"request\":{\"_token\":\"W2Q6uMHJGMYYBZa9TKWVG89wGDh0NDLSTpTJj6Di\",\"_method\":\"PUT\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"po_no\":\"PO-20251107-0001\",\"docket_no\":\"23434\",\"po_date\":\"2025-11-08\",\"due_date\":\"2025-11-07\",\"e_way_bill_no\":\"7832\",\"customer_phone_invoice\":\"9229779459\",\"billing_address_invoice\":\"Voluptatem aut moll\",\"shipping_address_invoice\":\"wefve\",\"items\":[{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"3000.00\"}],\"notes\":\"esdv c\",\"terms\":\"esdv\",\"overall_discount\":\"0.00\",\"subtotal\":\"2542.37\",\"tax\":\"457.63\",\"discount\":\"0.00\",\"total\":\"3000.00\"},\"invoice\":{\"id\":17,\"payment_type\":\"credit\",\"phone_number\":\"9229779459\",\"e_way_bill_no\":\"7832\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"wefve\",\"po_no\":\"PO-20251107-0001\",\"po_date\":\"2025-11-08\",\"notes\":\"esdv c\",\"created_at\":\"2025-11-07 10:13:06\",\"updated_at\":\"2025-11-08 07:44:57\",\"deleted_at\":null,\"select_customer_id\":\"4\",\"created_by_id\":5,\"docket_no\":\"23434\",\"due_date\":\"2025-11-07 00:00:00\",\"terms\":\"esdv\",\"overall_discount\":\"0.00\",\"subtotal\":\"2542.37\",\"tax\":\"457.63\",\"discount\":\"0.00\",\"total\":\"3000.00\",\"attachment\":null,\"sale_invoice_number\":\"ET-20251107101306583\",\"json_data\":\"{\\\"_token\\\":\\\"W2Q6uMHJGMYYBZa9TKWVG89wGDh0NDLSTpTJj6Di\\\",\\\"_method\\\":\\\"PUT\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251107-0001\\\",\\\"docket_no\\\":\\\"23434\\\",\\\"po_date\\\":\\\"2025-11-08\\\",\\\"due_date\\\":\\\"2025-11-07\\\",\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"wefve\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"18\\\",\\\"amount\\\":\\\"3000.00\\\"}],\\\"notes\\\":\\\"esdv c\\\",\\\"terms\\\":\\\"esdv\\\",\\\"overall_discount\\\":\\\"0.00\\\",\\\"subtotal\\\":\\\"2542.37\\\",\\\"tax\\\":\\\"457.63\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3000.00\\\"}\",\"status\":\"Pending\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"image\":null,\"document\":null,\"media\":[]},\"customer_before\":{\"balance\":\"7201\",\"type\":\"Debit\"},\"customer_after\":{\"balance\":4201,\"type\":\"Debit\"}}', '2025-11-07 04:43:06', '2025-11-08 02:14:57', 17, 3000.00),
(14, NULL, 4, 4, 3, NULL, 0.00, 4201.00, 1078.00, 'sale', 'TXN6701488512', 3, '{\"request\":{\"_token\":\"REcPD33kSQLYdgO5G86rimCXV5d8piIyCi4mdSGN\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"po_no\":\"PO-20251202-0001\",\"docket_no\":\"qwerty\",\"po_date\":\"2025-12-02\",\"due_date\":null,\"e_way_bill_no\":\"7832\",\"customer_phone_invoice\":\"9229779459\",\"billing_address_invoice\":\"Voluptatem aut moll\",\"shipping_address_invoice\":\"234erty\",\"items\":[{\"add_item_id\":\"22\",\"qty\":\"1\",\"price\":\"3000.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"3000.00\"},{\"add_item_id\":\"9\",\"qty\":\"1\",\"price\":\"123.00\",\"discount_type\":\"value\",\"discount\":\"0\",\"tax_type\":\"with\",\"tax\":\"18\",\"amount\":\"123.00\"}],\"notes\":\"sdcv\",\"terms\":\"qwsdcv\",\"overall_discount\":\"0\",\"subtotal\":\"2646.61\",\"tax\":\"476.39\",\"discount\":\"0.00\",\"total\":\"3123.00\"},\"invoice\":{\"sale_invoice_number\":\"ET-20251202100236802\",\"payment_type\":\"credit\",\"select_customer_id\":\"4\",\"po_no\":\"PO-20251202-0001\",\"docket_no\":\"qwerty\",\"po_date\":\"2025-12-02\",\"due_date\":null,\"e_way_bill_no\":\"7832\",\"phone_number\":\"9229779459\",\"billing_address\":\"Voluptatem aut moll\",\"shipping_address\":\"234erty\",\"notes\":\"sdcv\",\"terms\":\"qwsdcv\",\"overall_discount\":\"0\",\"subtotal\":\"2646.61\",\"tax\":\"476.39\",\"discount\":\"0.00\",\"total\":\"3123.00\",\"created_by_id\":3,\"json_data\":\"{\\\"_token\\\":\\\"REcPD33kSQLYdgO5G86rimCXV5d8piIyCi4mdSGN\\\",\\\"payment_type\\\":\\\"credit\\\",\\\"select_customer_id\\\":\\\"4\\\",\\\"main_cost_center_id\\\":\\\"4\\\",\\\"sub_cost_center_id\\\":\\\"3\\\",\\\"po_no\\\":\\\"PO-20251202-0001\\\",\\\"docket_no\\\":\\\"qwerty\\\",\\\"po_date\\\":\\\"2025-12-02\\\",\\\"due_date\\\":null,\\\"e_way_bill_no\\\":\\\"7832\\\",\\\"customer_phone_invoice\\\":\\\"9229779459\\\",\\\"billing_address_invoice\\\":\\\"Voluptatem aut moll\\\",\\\"shipping_address_invoice\\\":\\\"234erty\\\",\\\"items\\\":[{\\\"add_item_id\\\":\\\"22\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"3000.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"18\\\",\\\"amount\\\":\\\"3000.00\\\"},{\\\"add_item_id\\\":\\\"9\\\",\\\"qty\\\":\\\"1\\\",\\\"price\\\":\\\"123.00\\\",\\\"discount_type\\\":\\\"value\\\",\\\"discount\\\":\\\"0\\\",\\\"tax_type\\\":\\\"with\\\",\\\"tax\\\":\\\"18\\\",\\\"amount\\\":\\\"123.00\\\"}],\\\"notes\\\":\\\"sdcv\\\",\\\"terms\\\":\\\"qwsdcv\\\",\\\"overall_discount\\\":\\\"0\\\",\\\"subtotal\\\":\\\"2646.61\\\",\\\"tax\\\":\\\"476.39\\\",\\\"discount\\\":\\\"0.00\\\",\\\"total\\\":\\\"3123.00\\\"}\",\"status\":\"Draft\",\"main_cost_center_id\":\"4\",\"sub_cost_center_id\":\"3\",\"updated_at\":\"2025-12-02 10:02:36\",\"created_at\":\"2025-12-02 10:02:36\",\"id\":18,\"image\":null,\"document\":null,\"media\":[]},\"customer_before\":{\"balance\":\"4201\",\"type\":\"Debit\"},\"customer_after\":{\"balance\":1078,\"type\":\"Debit\"}}', '2025-12-02 04:32:36', '2025-12-02 04:32:36', 18, 3123.00);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `base_unit` varchar(255) NOT NULL,
  `secondary_unit` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `base_unit`, `secondary_unit`, `created_at`, `updated_at`, `deleted_at`, `created_by_id`) VALUES
(1, 'none', 'none', '2025-09-01 04:57:39', '2025-09-01 04:57:39', NULL, NULL),
(2, 'none', 'none', '2025-10-14 04:45:26', '2025-10-14 04:45:26', NULL, 2),
(3, 'none', 'none', '2025-10-15 02:00:53', '2025-10-15 02:00:53', NULL, 3),
(4, 'Pices', 'Pices', '2025-10-15 02:07:52', '2025-10-15 02:07:52', NULL, 3),
(5, 'none', 'none', '2025-11-03 01:13:08', '2025-11-03 01:13:08', NULL, 5),
(6, 'none', 'none', '2025-11-04 00:41:18', '2025-11-04 02:39:49', '2025-11-04 02:39:49', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `created_by_id`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$tduKs3Jp9xyzhDovcBspfeG5A0/o4KMyBYWOj1QP3Ob.sqYrIQxx.', 'Z69QBazLYo2gvVIPDbmsbzTFblr9JSdLE55TXZXhuHKQNeIKhvJOOHnB1V6c', NULL, NULL, NULL, 0),
(2, 'Emmot', 'eemotrack@gmail.com', NULL, '$2y$10$MSj0uzMaF/V9lHz4dxn1nOLZumH9MocLaA80hrEySMyjXGcQJGsEu', NULL, '2025-08-27 01:27:11', '2025-08-27 01:27:11', NULL, 0),
(3, 'MSV', 'msv@gmail.com', NULL, '$2y$10$EJtvBfT4nuySblA2l9BglO/B.taeWDE7c7/DUtzL2samNE.oTBJha', 'x0OmlhEOYPysPgnoUn5iLjXBXrVqbZjzLpd6RDz4S3DJ1z7xYeKqzjUDt0Wx', '2025-08-27 01:30:09', '2025-08-27 01:30:09', NULL, 0),
(4, 'MSV SERVICE', 'msvservice@gmail.com', NULL, '$2y$10$6o3K8mj1YY4ToHbXSCYbeeORveUhtGtuGZTnv/b7JI5OMsmMFEk6S', NULL, '2025-10-13 01:56:24', '2025-10-13 01:56:24', NULL, 3),
(5, 'msv bihar', 'msvbihar@gmail.com', NULL, '$2y$10$pEVU4QqhM2OUweKTmKmDWum47Zr.WtuvjXk2ig4d8jMGNrfcwKDsy', NULL, '2025-11-01 03:11:16', '2025-11-01 03:11:16', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_alerts`
--

CREATE TABLE `user_alerts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `alert_text` varchar(255) DEFAULT NULL,
  `alert_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_user_alert`
--

CREATE TABLE `user_user_alert` (
  `user_alert_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_businesses`
--
ALTER TABLE `add_businesses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by_fk_10696639` (`created_by_id`);

--
-- Indexes for table `add_business_user`
--
ALTER TABLE `add_business_user`
  ADD KEY `user_id_fk_10697376` (`user_id`),
  ADD KEY `add_business_id_fk_10697376` (`add_business_id`);

--
-- Indexes for table `add_items`
--
ALTER TABLE `add_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `select_unit_fk_10696693` (`select_unit_id`),
  ADD KEY `select_tax_fk_10696776` (`select_tax_id`),
  ADD KEY `created_by_fk_10696677` (`created_by_id`);

--
-- Indexes for table `add_item_category`
--
ALTER TABLE `add_item_category`
  ADD KEY `add_item_id_fk_10696735` (`add_item_id`),
  ADD KEY `category_id_fk_10696735` (`category_id`);

--
-- Indexes for table `add_item_current_stock`
--
ALTER TABLE `add_item_current_stock`
  ADD KEY `current_stock_id_fk_10697368` (`current_stock_id`),
  ADD KEY `add_item_id_fk_10697368` (`add_item_id`);

--
-- Indexes for table `add_item_estimate_quotation`
--
ALTER TABLE `add_item_estimate_quotation`
  ADD KEY `estimate_quotation_id_fk_10696830` (`estimate_quotation_id`),
  ADD KEY `add_item_id_fk_10696830` (`add_item_id`);

--
-- Indexes for table `add_item_proforma_invoice`
--
ALTER TABLE `add_item_proforma_invoice`
  ADD KEY `proforma_invoice_id_fk_10696848` (`proforma_invoice_id`),
  ADD KEY `add_item_id_fk_10696848` (`add_item_id`);

--
-- Indexes for table `add_item_purchase_bill`
--
ALTER TABLE `add_item_purchase_bill`
  ADD KEY `add_item_id_fk_10697037` (`add_item_id`),
  ADD KEY `purchase_bill_id_fk_10697037` (`purchase_bill_id`);

--
-- Indexes for table `add_item_purchase_order`
--
ALTER TABLE `add_item_purchase_order`
  ADD KEY `purchase_order_id_fk_10697516` (`purchase_order_id`),
  ADD KEY `add_item_id_fk_10697516` (`add_item_id`);

--
-- Indexes for table `add_item_sale_invoice`
--
ALTER TABLE `add_item_sale_invoice`
  ADD KEY `sale_invoice_id_fk_10696786` (`sale_invoice_id`),
  ADD KEY `add_item_id_fk_10696786` (`add_item_id`);

--
-- Indexes for table `adjust_bank_balances`
--
ALTER TABLE `adjust_bank_balances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_fk_10697009` (`from_id`),
  ADD KEY `created_by_fk_10697018` (`created_by_id`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by_fk_10696917` (`created_by_id`);

--
-- Indexes for table `bank_to_banks`
--
ALTER TABLE `bank_to_banks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_fk_10696997` (`from_id`),
  ADD KEY `to_fk_10696998` (`to_id`),
  ADD KEY `created_by_fk_10697006` (`created_by_id`);

--
-- Indexes for table `bank_to_cashes`
--
ALTER TABLE `bank_to_cashes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_fk_10696971` (`from_id`),
  ADD KEY `created_by_fk_10696980` (`created_by_id`);

--
-- Indexes for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_transactions_party_id_foreign` (`party_id`),
  ADD KEY `bank_transactions_payment_type_id_foreign` (`payment_type_id`),
  ADD KEY `bank_transactions_created_by_id_foreign` (`created_by_id`),
  ADD KEY `bank_transactions_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `cash_in_hands`
--
ALTER TABLE `cash_in_hands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by_fk_10697027` (`created_by_id`);

--
-- Indexes for table `cash_to_banks`
--
ALTER TABLE `cash_to_banks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to_fk_10696987` (`to_id`),
  ADD KEY `created_by_fk_10696995` (`created_by_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by_fk_10696699` (`created_by_id`);

--
-- Indexes for table `current_stocks`
--
ALTER TABLE `current_stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by_fk_10697375` (`created_by_id`);

--
-- Indexes for table `estimate_quotations`
--
ALTER TABLE `estimate_quotations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `select_customer_fk_10696822` (`select_customer_id`),
  ADD KEY `created_by_fk_10696838` (`created_by_id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by_fk_10697494` (`created_by_id`);

--
-- Indexes for table `expense_lists`
--
ALTER TABLE `expense_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_fk_10697497` (`category_id`),
  ADD KEY `payment_fk_10697500` (`payment_id`),
  ADD KEY `created_by_fk_10697506` (`created_by_id`);

--
-- Indexes for table `finished_goods_raw_material`
--
ALTER TABLE `finished_goods_raw_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledgers`
--
ALTER TABLE `ledgers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ledgers_expense_category_id_foreign` (`expense_category_id`),
  ADD KEY `ledgers_created_by_id_foreign` (`created_by_id`),
  ADD KEY `ledgers_updated_by_id_foreign` (`updated_by_id`);

--
-- Indexes for table `main_cost_centers`
--
ALTER TABLE `main_cost_centers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `link_with_company_fk_10720191` (`link_with_company_id`),
  ADD KEY `responsible_manager_fk_10720192` (`responsible_manager_id`),
  ADD KEY `created_by_fk_10720201` (`created_by_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `party_details`
--
ALTER TABLE `party_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `party_details_gstin_unique` (`gstin`),
  ADD UNIQUE KEY `party_details_phone_number_unique` (`phone_number`),
  ADD KEY `created_by_fk_10696669` (`created_by_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_ins`
--
ALTER TABLE `payment_ins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_outs`
--
ALTER TABLE `payment_outs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parties_fk_10697475` (`parties_id`),
  ADD KEY `payment_type_fk_10697476` (`payment_type_id`),
  ADD KEY `created_by_fk_10697487` (`created_by_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD KEY `role_id_fk_10696519` (`role_id`),
  ADD KEY `permission_id_fk_10696519` (`permission_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `proforma_invoices`
--
ALTER TABLE `proforma_invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `select_customer_fk_10696840` (`select_customer_id`),
  ADD KEY `created_by_fk_10696856` (`created_by_id`);

--
-- Indexes for table `purchase_bills`
--
ALTER TABLE `purchase_bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `select_customer_fk_10697029` (`select_customer_id`),
  ADD KEY `payment_type_fk_10697043` (`payment_type_id`),
  ADD KEY `created_by_fk_10697047` (`created_by_id`);

--
-- Indexes for table `purchase_logs`
--
ALTER TABLE `purchase_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `select_customer_fk_10697508` (`select_customer_id`),
  ADD KEY `payment_type_fk_10697522` (`payment_type_id`),
  ADD KEY `created_by_fk_10697526` (`created_by_id`);

--
-- Indexes for table `qa_messages`
--
ALTER TABLE `qa_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qa_messages_topic_id_foreign` (`topic_id`),
  ADD KEY `qa_messages_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `qa_topics`
--
ALTER TABLE `qa_topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qa_topics_creator_id_foreign` (`creator_id`),
  ADD KEY `qa_topics_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD KEY `user_id_fk_10696528` (`user_id`),
  ADD KEY `role_id_fk_10696528` (`role_id`);

--
-- Indexes for table `sale_invoices`
--
ALTER TABLE `sale_invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `select_customer_fk_10696778` (`select_customer_id`),
  ADD KEY `created_by_fk_10696794` (`created_by_id`);

--
-- Indexes for table `sale_invoice_status_histories`
--
ALTER TABLE `sale_invoice_status_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_invoice_status_histories_changed_by_id_foreign` (`changed_by_id`),
  ADD KEY `sale_invoice_status_histories_sale_invoice_id_created_at_index` (`sale_invoice_id`,`created_at`);

--
-- Indexes for table `sale_logs`
--
ALTER TABLE `sale_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_logs_sale_invoice_id_foreign` (`sale_invoice_id`);

--
-- Indexes for table `sale_profit_losses`
--
ALTER TABLE `sale_profit_losses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_profit_losses_sale_invoice_id_index` (`sale_invoice_id`);

--
-- Indexes for table `sub_cost_centers`
--
ALTER TABLE `sub_cost_centers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `main_cost_center_fk_10720203` (`main_cost_center_id`),
  ADD KEY `created_by_fk_10720215` (`created_by_id`);

--
-- Indexes for table `tax_rates`
--
ALTER TABLE `tax_rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by_fk_10696752` (`created_by_id`);

--
-- Indexes for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_transaction_id_unique` (`transaction_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by_fk_10696684` (`created_by_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_alerts`
--
ALTER TABLE `user_alerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by_fk_10696685` (`created_by_id`);

--
-- Indexes for table `user_user_alert`
--
ALTER TABLE `user_user_alert`
  ADD KEY `user_alert_id_fk_10696622` (`user_alert_id`),
  ADD KEY `user_id_fk_10696622` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_businesses`
--
ALTER TABLE `add_businesses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `add_items`
--
ALTER TABLE `add_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `adjust_bank_balances`
--
ALTER TABLE `adjust_bank_balances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=358;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bank_to_banks`
--
ALTER TABLE `bank_to_banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_to_cashes`
--
ALTER TABLE `bank_to_cashes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cash_in_hands`
--
ALTER TABLE `cash_in_hands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cash_to_banks`
--
ALTER TABLE `cash_to_banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `current_stocks`
--
ALTER TABLE `current_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `estimate_quotations`
--
ALTER TABLE `estimate_quotations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense_lists`
--
ALTER TABLE `expense_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `finished_goods_raw_material`
--
ALTER TABLE `finished_goods_raw_material`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ledgers`
--
ALTER TABLE `ledgers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `main_cost_centers`
--
ALTER TABLE `main_cost_centers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `party_details`
--
ALTER TABLE `party_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_ins`
--
ALTER TABLE `payment_ins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment_outs`
--
ALTER TABLE `payment_outs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proforma_invoices`
--
ALTER TABLE `proforma_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `purchase_bills`
--
ALTER TABLE `purchase_bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `purchase_logs`
--
ALTER TABLE `purchase_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qa_messages`
--
ALTER TABLE `qa_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qa_topics`
--
ALTER TABLE `qa_topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sale_invoices`
--
ALTER TABLE `sale_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sale_invoice_status_histories`
--
ALTER TABLE `sale_invoice_status_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sale_logs`
--
ALTER TABLE `sale_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `sale_profit_losses`
--
ALTER TABLE `sale_profit_losses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sub_cost_centers`
--
ALTER TABLE `sub_cost_centers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tax_rates`
--
ALTER TABLE `tax_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_alerts`
--
ALTER TABLE `user_alerts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_businesses`
--
ALTER TABLE `add_businesses`
  ADD CONSTRAINT `created_by_fk_10696639` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `add_business_user`
--
ALTER TABLE `add_business_user`
  ADD CONSTRAINT `add_business_id_fk_10697376` FOREIGN KEY (`add_business_id`) REFERENCES `add_businesses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id_fk_10697376` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `add_items`
--
ALTER TABLE `add_items`
  ADD CONSTRAINT `created_by_fk_10696677` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `select_tax_fk_10696776` FOREIGN KEY (`select_tax_id`) REFERENCES `tax_rates` (`id`),
  ADD CONSTRAINT `select_unit_fk_10696693` FOREIGN KEY (`select_unit_id`) REFERENCES `units` (`id`);

--
-- Constraints for table `add_item_category`
--
ALTER TABLE `add_item_category`
  ADD CONSTRAINT `add_item_id_fk_10696735` FOREIGN KEY (`add_item_id`) REFERENCES `add_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_id_fk_10696735` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `add_item_current_stock`
--
ALTER TABLE `add_item_current_stock`
  ADD CONSTRAINT `add_item_id_fk_10697368` FOREIGN KEY (`add_item_id`) REFERENCES `add_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `current_stock_id_fk_10697368` FOREIGN KEY (`current_stock_id`) REFERENCES `current_stocks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `add_item_estimate_quotation`
--
ALTER TABLE `add_item_estimate_quotation`
  ADD CONSTRAINT `add_item_id_fk_10696830` FOREIGN KEY (`add_item_id`) REFERENCES `add_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `estimate_quotation_id_fk_10696830` FOREIGN KEY (`estimate_quotation_id`) REFERENCES `estimate_quotations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `add_item_proforma_invoice`
--
ALTER TABLE `add_item_proforma_invoice`
  ADD CONSTRAINT `add_item_id_fk_10696848` FOREIGN KEY (`add_item_id`) REFERENCES `add_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `proforma_invoice_id_fk_10696848` FOREIGN KEY (`proforma_invoice_id`) REFERENCES `proforma_invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `add_item_purchase_bill`
--
ALTER TABLE `add_item_purchase_bill`
  ADD CONSTRAINT `purchase_bill_id_fk_10697037` FOREIGN KEY (`purchase_bill_id`) REFERENCES `purchase_bills` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `add_item_purchase_order`
--
ALTER TABLE `add_item_purchase_order`
  ADD CONSTRAINT `add_item_id_fk_10697516` FOREIGN KEY (`add_item_id`) REFERENCES `add_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_order_id_fk_10697516` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `add_item_sale_invoice`
--
ALTER TABLE `add_item_sale_invoice`
  ADD CONSTRAINT `add_item_id_fk_10696786` FOREIGN KEY (`add_item_id`) REFERENCES `add_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_invoice_id_fk_10696786` FOREIGN KEY (`sale_invoice_id`) REFERENCES `sale_invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `adjust_bank_balances`
--
ALTER TABLE `adjust_bank_balances`
  ADD CONSTRAINT `created_by_fk_10697018` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `from_fk_10697009` FOREIGN KEY (`from_id`) REFERENCES `bank_accounts` (`id`);

--
-- Constraints for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD CONSTRAINT `created_by_fk_10696917` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `bank_to_banks`
--
ALTER TABLE `bank_to_banks`
  ADD CONSTRAINT `created_by_fk_10697006` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `from_fk_10696997` FOREIGN KEY (`from_id`) REFERENCES `bank_accounts` (`id`),
  ADD CONSTRAINT `to_fk_10696998` FOREIGN KEY (`to_id`) REFERENCES `bank_accounts` (`id`);

--
-- Constraints for table `bank_to_cashes`
--
ALTER TABLE `bank_to_cashes`
  ADD CONSTRAINT `created_by_fk_10696980` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `from_fk_10696971` FOREIGN KEY (`from_id`) REFERENCES `bank_accounts` (`id`);

--
-- Constraints for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  ADD CONSTRAINT `bank_transactions_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bank_transactions_party_id_foreign` FOREIGN KEY (`party_id`) REFERENCES `party_details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bank_transactions_payment_type_id_foreign` FOREIGN KEY (`payment_type_id`) REFERENCES `bank_accounts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bank_transactions_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `cash_in_hands`
--
ALTER TABLE `cash_in_hands`
  ADD CONSTRAINT `created_by_fk_10697027` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cash_to_banks`
--
ALTER TABLE `cash_to_banks`
  ADD CONSTRAINT `created_by_fk_10696995` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `to_fk_10696987` FOREIGN KEY (`to_id`) REFERENCES `bank_accounts` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `created_by_fk_10696699` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `current_stocks`
--
ALTER TABLE `current_stocks`
  ADD CONSTRAINT `created_by_fk_10697375` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `estimate_quotations`
--
ALTER TABLE `estimate_quotations`
  ADD CONSTRAINT `created_by_fk_10696838` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `select_customer_fk_10696822` FOREIGN KEY (`select_customer_id`) REFERENCES `party_details` (`id`);

--
-- Constraints for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD CONSTRAINT `created_by_fk_10697494` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `expense_lists`
--
ALTER TABLE `expense_lists`
  ADD CONSTRAINT `category_fk_10697497` FOREIGN KEY (`category_id`) REFERENCES `expense_categories` (`id`),
  ADD CONSTRAINT `created_by_fk_10697506` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `payment_fk_10697500` FOREIGN KEY (`payment_id`) REFERENCES `bank_accounts` (`id`);

--
-- Constraints for table `ledgers`
--
ALTER TABLE `ledgers`
  ADD CONSTRAINT `ledgers_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `ledgers_expense_category_id_foreign` FOREIGN KEY (`expense_category_id`) REFERENCES `expense_categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `ledgers_updated_by_id_foreign` FOREIGN KEY (`updated_by_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `main_cost_centers`
--
ALTER TABLE `main_cost_centers`
  ADD CONSTRAINT `created_by_fk_10720201` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `link_with_company_fk_10720191` FOREIGN KEY (`link_with_company_id`) REFERENCES `add_businesses` (`id`),
  ADD CONSTRAINT `responsible_manager_fk_10720192` FOREIGN KEY (`responsible_manager_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `party_details`
--
ALTER TABLE `party_details`
  ADD CONSTRAINT `created_by_fk_10696669` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payment_outs`
--
ALTER TABLE `payment_outs`
  ADD CONSTRAINT `created_by_fk_10697487` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `parties_fk_10697475` FOREIGN KEY (`parties_id`) REFERENCES `party_details` (`id`),
  ADD CONSTRAINT `payment_type_fk_10697476` FOREIGN KEY (`payment_type_id`) REFERENCES `bank_accounts` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_id_fk_10696519` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_id_fk_10696519` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `proforma_invoices`
--
ALTER TABLE `proforma_invoices`
  ADD CONSTRAINT `created_by_fk_10696856` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `select_customer_fk_10696840` FOREIGN KEY (`select_customer_id`) REFERENCES `party_details` (`id`);

--
-- Constraints for table `purchase_bills`
--
ALTER TABLE `purchase_bills`
  ADD CONSTRAINT `created_by_fk_10697047` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `payment_type_fk_10697043` FOREIGN KEY (`payment_type_id`) REFERENCES `bank_accounts` (`id`),
  ADD CONSTRAINT `select_customer_fk_10697029` FOREIGN KEY (`select_customer_id`) REFERENCES `party_details` (`id`);

--
-- Constraints for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD CONSTRAINT `created_by_fk_10697526` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `payment_type_fk_10697522` FOREIGN KEY (`payment_type_id`) REFERENCES `bank_accounts` (`id`),
  ADD CONSTRAINT `select_customer_fk_10697508` FOREIGN KEY (`select_customer_id`) REFERENCES `party_details` (`id`);

--
-- Constraints for table `qa_messages`
--
ALTER TABLE `qa_messages`
  ADD CONSTRAINT `qa_messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `qa_messages_topic_id_foreign` FOREIGN KEY (`topic_id`) REFERENCES `qa_topics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `qa_topics`
--
ALTER TABLE `qa_topics`
  ADD CONSTRAINT `qa_topics_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `qa_topics_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_id_fk_10696528` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id_fk_10696528` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_invoices`
--
ALTER TABLE `sale_invoices`
  ADD CONSTRAINT `created_by_fk_10696794` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `select_customer_fk_10696778` FOREIGN KEY (`select_customer_id`) REFERENCES `party_details` (`id`);

--
-- Constraints for table `sale_invoice_status_histories`
--
ALTER TABLE `sale_invoice_status_histories`
  ADD CONSTRAINT `sale_invoice_status_histories_changed_by_id_foreign` FOREIGN KEY (`changed_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_invoice_status_histories_sale_invoice_id_foreign` FOREIGN KEY (`sale_invoice_id`) REFERENCES `sale_invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_logs`
--
ALTER TABLE `sale_logs`
  ADD CONSTRAINT `sale_logs_sale_invoice_id_foreign` FOREIGN KEY (`sale_invoice_id`) REFERENCES `sale_invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_cost_centers`
--
ALTER TABLE `sub_cost_centers`
  ADD CONSTRAINT `created_by_fk_10720215` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `main_cost_center_fk_10720203` FOREIGN KEY (`main_cost_center_id`) REFERENCES `main_cost_centers` (`id`);

--
-- Constraints for table `tax_rates`
--
ALTER TABLE `tax_rates`
  ADD CONSTRAINT `created_by_fk_10696752` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `created_by_fk_10696684` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_alerts`
--
ALTER TABLE `user_alerts`
  ADD CONSTRAINT `created_by_fk_10696685` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_user_alert`
--
ALTER TABLE `user_user_alert`
  ADD CONSTRAINT `user_alert_id_fk_10696622` FOREIGN KEY (`user_alert_id`) REFERENCES `user_alerts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id_fk_10696622` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
