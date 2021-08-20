-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 07, 2020 at 12:01 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drycleandb`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(15) NOT NULL,
  `category_desc` varchar(30) NOT NULL,
  `last_modified_by` int(11) DEFAULT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_desc`, `last_modified_by`, `last_modified_date`) VALUES
(1, 'Dry Cleaning', 'Dry Cleaning', NULL, '2020-09-26 09:15:06'),
(2, 'Laundry', 'Laundry', NULL, '2020-09-26 09:15:06'),
(3, 'Pressed', 'Pressed', NULL, '2020-09-26 09:15:06'),
(4, 'Alteration', 'Alteration', NULL, '2020-09-26 09:15:06');

-- --------------------------------------------------------

--
-- Table structure for table `charge_type`
--

CREATE TABLE `charge_type` (
  `charge_type_id` int(11) NOT NULL,
  `charge_type_desc` varchar(40) NOT NULL,
  `charge_type_price` double(7,2) NOT NULL,
  `last_modified_by` int(11) DEFAULT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `config_id` int(11) NOT NULL,
  `config_key` varchar(15) NOT NULL,
  `config_value` varchar(100) NOT NULL,
  `config_type` varchar(20) NOT NULL,
  `last_modified_by` int(11) DEFAULT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`config_id`, `config_key`, `config_value`, `config_type`, `last_modified_by`, `last_modified_date`) VALUES
(1, 'gst_percent', '9', 'GST', 1, '2020-10-05 13:59:42'),
(2, 'company_address', '50 Clarence St, Sydney NSW 2000', 'company_profile', 1, '2020-10-05 13:23:05'),
(3, 'company_phone', '(02) 9262 4822', 'company_profile', 1, '2020-10-05 12:55:01'),
(4, 'company_abn', '86 134 673 171 16', 'company_profile', 1, '2020-10-05 12:55:01'),
(5, 'company_email', '', 'company_profile', 1, '2020-10-05 12:47:11'),
(9, 'company_name', 'Clean As A Whistle', 'company_profile', 1, '2020-10-05 12:47:49');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(60) NOT NULL,
  `customer_streetaddress` varchar(30) NOT NULL,
  `customer_suburb` varchar(20) NOT NULL,
  `customer_state` varchar(4) NOT NULL,
  `customer_postcode` varchar(4) NOT NULL,
  `customer_mobile` varchar(15) NOT NULL,
  `customer_email` varchar(30) NOT NULL,
  `customer_type` varchar(10) NOT NULL,
  `last_modified_by` int(11) DEFAULT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_streetaddress`, `customer_suburb`, `customer_state`, `customer_postcode`, `customer_mobile`, `customer_email`, `customer_type`, `last_modified_by`, `last_modified_date`) VALUES
(1, 'Johanna', '10 Barrack St', 'Sydney', 'NSW', '2000', '0412123123', 'johanna@gmail.com', 'individual', 1, '2020-10-02 05:51:19'),
(2, 'Ram', '', '', '', '', '041111111', 'ram@gmail.com', 'individual', 1, '2020-10-02 07:25:44'),
(3, 'Sin Yin', '', '', '', '', '0412123123', 'sin@gmail.com', 'individual', 1, '2020-10-02 07:43:11');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_item_charges`
--

CREATE TABLE `invoice_item_charges` (
  `invoice_item_charges_id` int(11) NOT NULL,
  `txn_invoice_item_id` int(11) NOT NULL,
  `charge_type_id` int(11) NOT NULL,
  `invoice_item_charge_qty` int(5) NOT NULL,
  `invoice_item_total_charge_amt` double(7,2) NOT NULL,
  `last_modified_by` int(11) DEFAULT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

CREATE TABLE `item_type` (
  `item_type_id` int(11) NOT NULL,
  `item_type_name` varchar(30) NOT NULL,
  `item_type_desc` varchar(30) DEFAULT NULL,
  `item_type_price` double(7,2) NOT NULL,
  `item_type_image` varchar(30) NOT NULL,
  `category_id` int(11) NOT NULL,
  `last_modified_by` int(11) DEFAULT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_type`
--

INSERT INTO `item_type` (`item_type_id`, `item_type_name`, `item_type_desc`, `item_type_price`, `item_type_image`, `category_id`, `last_modified_by`, `last_modified_date`) VALUES
(1, 'Suit', NULL, 20.50, 'img\\DryCleaning\\1.png', 1, NULL, '2020-10-05 02:43:17'),
(2, 'Trousers', NULL, 10.50, 'img\\DryCleaning\\2.png', 1, NULL, '2020-09-27 04:48:48'),
(3, 'Shirt', NULL, 5.50, 'img\\DryCleaning\\3.png', 1, NULL, '2020-09-27 04:48:48'),
(4, 'Jacket', NULL, 11.50, 'img\\DryCleaning\\4.png', 1, NULL, '2020-09-27 04:48:48'),
(5, 'Polo Shirt', NULL, 5.50, 'img\\DryCleaning\\5.png', 1, NULL, '2020-09-27 04:48:48'),
(6, 'Jeans', NULL, 10.50, 'img\\DryCleaning\\6.png', 1, NULL, '2020-09-27 04:48:48'),
(7, 'Blouse', NULL, 9.50, 'img\\DryCleaning\\7.png', 1, NULL, '2020-09-27 04:48:48'),
(8, 'Skirt', NULL, 10.50, 'img\\DryCleaning\\8.png', 1, NULL, '2020-09-27 04:48:48'),
(9, 'Skirt Pleated', NULL, 15.50, 'img\\DryCleaning\\9.png', 1, NULL, '2020-09-27 04:48:48'),
(10, 'Dress', NULL, 25.00, 'img\\DryCleaning\\10.png', 1, NULL, '2020-09-27 04:48:48'),
(11, 'Dress Evening', NULL, 45.00, 'img\\DryCleaning\\11.png', 1, NULL, '2020-09-27 04:48:48'),
(12, 'Jumpsuit', NULL, 25.00, 'img\\DryCleaning\\12.png', 1, NULL, '2020-09-27 04:48:48'),
(13, 'Waistcoat', NULL, 9.50, 'img\\DryCleaning\\13.png', 1, NULL, '2020-09-27 04:48:48'),
(14, 'Overcoat', NULL, 30.00, 'img\\DryCleaning\\14.png', 1, NULL, '2020-09-27 04:48:48'),
(15, 'Tie', NULL, 9.50, 'img\\DryCleaning\\15.png', 1, NULL, '2020-09-27 04:48:48'),
(16, 'Sweater', NULL, 12.00, 'img\\DryCleaning\\16.png', 1, NULL, '2020-09-27 04:48:48'),
(17, 'Scarf', NULL, 12.50, 'img\\DryCleaning\\17.png', 1, NULL, '2020-09-27 04:48:48'),
(18, 'Hat', NULL, 5.00, 'img\\DryCleaning\\18.png', 1, NULL, '2020-09-27 04:48:48'),
(19, 'img\\Laundry Per lb', NULL, 25.00, 'img\\Laundry\\01.png', 2, NULL, '2020-09-27 04:48:48'),
(20, 'Duvet', NULL, 5.00, 'img\\Laundry\\02.png', 2, NULL, '2020-09-27 04:48:48'),
(21, 'Duvet Cover', NULL, 15.00, 'img\\Laundry\\03.png', 2, NULL, '2020-09-27 04:48:48'),
(22, 'Duvet Feather', NULL, 55.00, 'img\\Laundry\\04.png', 2, NULL, '2020-09-27 04:48:48'),
(23, 'Pillow Case', NULL, 2.50, 'img\\Laundry\\05.png', 2, NULL, '2020-09-27 04:48:48'),
(24, 'Polo Shirt', NULL, 5.50, 'img\\Laundry\\06.png', 2, NULL, '2020-09-27 04:48:48'),
(25, 'Short', NULL, 5.00, 'img\\Laundry\\07.png', 2, NULL, '2020-09-27 04:48:48'),
(26, 'T-Shirt', NULL, 5.00, 'img\\Laundry\\08.png', 2, NULL, '2020-09-27 04:48:48'),
(27, 'Shirt', NULL, 5.00, 'img\\Laundry\\09.png', 2, NULL, '2020-09-27 04:48:48'),
(29, 'TabbleCloth', NULL, 15.00, 'img\\Laundry\\010.png', 2, NULL, '2020-09-27 04:48:48'),
(30, 'Towel L', NULL, 55.00, 'img\\Laundry\\011.png', 2, NULL, '2020-09-27 04:48:48'),
(31, 'Towel S', NULL, 2.50, 'img\\Laundry\\012.png', 2, NULL, '2020-09-27 04:48:48'),
(32, 'Bra', NULL, 5.50, 'img\\Laundry\\018.png', 2, NULL, '2020-09-27 04:48:48'),
(33, 'Undies', NULL, 5.00, 'img\\Laundry\\019.png', 2, NULL, '2020-09-27 04:48:48'),
(34, 'Singlet', NULL, 5.50, 'img\\Laundry\\020.png', 2, NULL, '2020-09-27 04:48:48'),
(35, 'Underpants', NULL, 5.00, 'img\\Laundry\\021.png', 2, NULL, '2020-09-27 04:48:48'),
(36, 'Socks', NULL, 5.00, 'img\\Laundry\\022.png', 2, NULL, '2020-09-27 04:48:48'),
(37, 'Swimsuit', NULL, 5.00, 'img\\Laundry\\023.png', 2, NULL, '2020-09-27 04:48:48'),
(38, 'Chef Jacket', NULL, 5.00, 'img\\Laundry\\024.png', 2, NULL, '2020-09-27 04:48:48'),
(39, 'Chef Pant', NULL, 15.00, 'img\\Laundry\\025.png', 2, NULL, '2020-09-27 04:48:48'),
(40, 'Apron', NULL, 55.00, 'img\\Laundry\\026.png', 2, NULL, '2020-09-27 04:48:48'),
(41, 'Leather Pants', NULL, 2.50, 'img\\Laundry\\027.png', 2, NULL, '2020-09-27 04:48:48'),
(42, 'Leather Shorts', NULL, 5.50, 'img\\Laundry\\028.png', 2, NULL, '2020-09-27 04:48:48'),
(43, 'Handkerchief', NULL, 5.00, 'img\\Laundry\\029.png', 2, NULL, '2020-09-27 04:48:48'),
(44, 'New Zip', NULL, 15.00, 'img\\Alteration\\013.png', 4, NULL, '2020-09-27 04:48:48'),
(45, 'Skirt Length', NULL, 55.00, 'img\\Alteration\\014.png', 4, NULL, '2020-09-27 04:48:48'),
(46, 'Sleeve Lengths', NULL, 2.50, 'img\\Alteration\\015.png', 4, NULL, '2020-09-27 04:48:48'),
(47, 'Trouser Length', NULL, 5.50, 'img\\Alteration\\016.png', 4, NULL, '2020-09-27 04:48:48'),
(48, 'Trouser Waist', NULL, 5.00, 'img\\Alteration\\017.png', 4, NULL, '2020-09-27 04:48:48'),
(49, 'Suit-P', NULL, 10.50, 'img\\Pressed\\1.png', 3, NULL, '2020-09-27 04:48:48'),
(54, 'item #4 name', 'item #4 description', 2.00, '\\img\\DryCleaning\\20.png', 3, NULL, '2020-10-05 01:53:43');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_invoice`
--

CREATE TABLE `transaction_invoice` (
  `txn_invoice_no` bigint(20) NOT NULL,
  `txn_invoice_date` datetime NOT NULL DEFAULT current_timestamp(),
  `txn_customer_id` int(11) NOT NULL,
  `txn_status` varchar(10) NOT NULL,
  `txn_total_qty` int(5) NOT NULL,
  `txn_gross_amt` double(7,2) NOT NULL,
  `txn_discount_amt` double(7,2) NOT NULL,
  `txn_prepaid_amt` double(7,2) NOT NULL,
  `txn_gst_amt` double(7,2) NOT NULL,
  `txn_net_amt` double(7,2) NOT NULL,
  `txn_payment_status` varchar(25) NOT NULL,
  `txn_pickup_date` datetime NOT NULL,
  `txn_notes` text NOT NULL,
  `txn_invoice_isvoid` tinyint(1) NOT NULL,
  `last_modified_by` int(11) DEFAULT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_invoice`
--

INSERT INTO `transaction_invoice` (`txn_invoice_no`, `txn_invoice_date`, `txn_customer_id`, `txn_status`, `txn_total_qty`, `txn_gross_amt`, `txn_discount_amt`, `txn_prepaid_amt`, `txn_gst_amt`, `txn_net_amt`, `txn_payment_status`, `txn_pickup_date`, `txn_notes`, `txn_invoice_isvoid`, `last_modified_by`, `last_modified_date`) VALUES
(210202000001, '2020-10-02 03:10:29', 1, 'collected', 1, 19.50, 0.20, 0.00, 1.35, 19.30, 'Pay on Collect', '2020-10-03 14:30:00', '', 0, 1, '2020-10-02 05:56:51'),
(210202000002, '2020-10-02 05:10:19', 1, 'Pending', 1, 39.00, 0.39, 0.00, 2.70, 38.61, 'Pay on Collect', '2020-10-16 16:30:00', '', 1, 1, '2020-10-02 07:22:47'),
(210202000003, '2020-10-02 05:10:06', 1, 'collected', 1, 5.50, 0.00, 0.00, 0.39, 5.50, 'Pay on Collect', '2020-10-05 09:00:00', '', 0, 1, '2020-10-02 07:23:08'),
(210202000004, '2020-10-02 05:10:48', 1, 'ready', 3, 60.50, 1.21, 0.00, 4.15, 59.29, 'Pay on Collect', '2020-10-12 13:00:00', '', 0, 1, '2020-10-02 07:36:22'),
(210202000005, '2020-10-02 05:10:28', 2, 'Pending', 1, 21.00, 0.00, 0.00, 1.47, 21.00, 'paid', '2020-10-06 08:00:00', '', 1, 1, '2020-10-02 07:36:12'),
(210202000006, '2020-10-02 05:10:52', 3, 'collected', 2, 71.00, 0.71, 0.00, 4.92, 70.29, 'Paid', '2020-10-03 10:30:00', '', 0, 1, '2020-10-02 07:44:56'),
(510202000001, '2020-10-05 01:10:53', 1, 'collected', 1, 20.50, 0.00, 0.00, 1.44, 20.50, 'Paid', '2020-10-06 09:00:00', '', 0, 1, '2020-10-05 02:44:28'),
(610202000001, '2020-10-06 09:10:48', 1, 'Pending', 2, 56.50, 0.00, 0.00, 5.08, 56.50, 'Paid', '2020-10-07 09:30:00', '', 0, 1, '2020-10-06 10:27:48'),
(610202000002, '2020-10-06 09:10:28', 1, 'Pending', 3, 27.50, 0.00, 0.00, 2.48, 27.50, 'Paid', '2020-10-08 10:30:00', '', 0, 1, '2020-10-06 10:28:28'),
(610202000003, '2020-10-06 11:10:55', 1, 'collected', 2, 35.50, 0.00, 0.00, 3.19, 35.50, 'Paid', '2020-10-06 09:30:00', '', 0, 1, '2020-10-06 12:56:14');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_invoice_item`
--

CREATE TABLE `transaction_invoice_item` (
  `txn_invoice_item_id` int(11) NOT NULL,
  `txn_invoice_no` bigint(20) NOT NULL,
  `item_type_id` int(11) NOT NULL,
  `txn_invoice_item_desc` varchar(50) DEFAULT NULL,
  `txn_invoice_item_qty` int(5) NOT NULL,
  `txn_invoice_total_charge_amt` double(7,2) DEFAULT NULL,
  `txn_invoice_item_subtotal` double(7,2) NOT NULL,
  `last_modified_by` int(11) DEFAULT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_invoice_item`
--

INSERT INTO `transaction_invoice_item` (`txn_invoice_item_id`, `txn_invoice_no`, `item_type_id`, `txn_invoice_item_desc`, `txn_invoice_item_qty`, `txn_invoice_total_charge_amt`, `txn_invoice_item_subtotal`, `last_modified_by`, `last_modified_date`) VALUES
(1, 210202000001, 1, NULL, 1, NULL, 19.50, 1, '2020-10-02 05:55:29'),
(2, 210202000002, 1, NULL, 2, NULL, 39.00, 1, '2020-10-02 07:18:19'),
(3, 210202000003, 3, NULL, 1, NULL, 5.50, 1, '2020-10-02 07:21:06'),
(4, 210202000004, 2, NULL, 1, NULL, 10.50, 1, '2020-10-02 07:31:48'),
(5, 210202000004, 12, NULL, 1, NULL, 25.00, 1, '2020-10-02 07:31:48'),
(6, 210202000004, 10, NULL, 1, NULL, 25.00, 1, '2020-10-02 07:31:48'),
(7, 210202000005, 2, NULL, 2, NULL, 21.00, 1, '2020-10-02 07:33:28'),
(8, 210202000006, 2, NULL, 2, NULL, 21.00, 1, '2020-10-02 07:43:52'),
(9, 210202000006, 10, NULL, 2, NULL, 50.00, 1, '2020-10-02 07:43:52'),
(10, 510202000001, 1, NULL, 1, NULL, 20.50, 1, '2020-10-05 02:43:53'),
(11, 610202000001, 1, NULL, 2, NULL, 41.00, 1, '2020-10-06 10:27:48'),
(12, 610202000001, 9, NULL, 1, NULL, 15.50, 1, '2020-10-06 10:27:48'),
(13, 610202000002, 4, NULL, 1, NULL, 11.50, 1, '2020-10-06 10:28:28'),
(14, 610202000002, 3, NULL, 1, NULL, 5.50, 1, '2020-10-06 10:28:28'),
(15, 610202000002, 2, NULL, 1, NULL, 10.50, 1, '2020-10-06 10:28:28'),
(16, 610202000003, 6, NULL, 1, NULL, 10.50, 1, '2020-10-06 12:55:55'),
(17, 610202000003, 12, NULL, 1, NULL, 25.00, 1, '2020-10-06 12:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `user_pin` mediumtext NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_modified_by` int(11) DEFAULT NULL,
  `last_modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pin`, `user_type`, `last_login`, `last_modified_by`, `last_modified_date`) VALUES
(1, 'admin', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 'admin', '2020-09-26 12:46:19', NULL, '0000-00-00 00:00:00'),
(3, 'user1', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'user', '2020-10-02 23:04:50', NULL, '0000-00-00 00:00:00'),
(4, 'user2', '*A4B6157319038724E3560894F7F932C8886EBFCF', 'user', '2020-10-02 23:08:15', NULL, '0000-00-00 00:00:00'),
(5, 'user4', '*DF216F57F1F2066124E1AA5491D995C3CB57E4C2', 'admin', '2020-10-05 01:55:14', NULL, '0000-00-00 00:00:00'),
(6, 'user5', '*EE0AEA25B21B2D11C36B82B27BF18794AAC3861E', 'user', '2020-10-06 13:00:23', NULL, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `charge_type`
--
ALTER TABLE `charge_type`
  ADD PRIMARY KEY (`charge_type_id`),
  ADD KEY `charge_type_id` (`charge_type_id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`config_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `invoice_item_charges`
--
ALTER TABLE `invoice_item_charges`
  ADD PRIMARY KEY (`invoice_item_charges_id`),
  ADD KEY `txn_invoice_item_id` (`txn_invoice_item_id`),
  ADD KEY `charge_type_id` (`charge_type_id`);

--
-- Indexes for table `item_type`
--
ALTER TABLE `item_type`
  ADD PRIMARY KEY (`item_type_id`),
  ADD KEY `item_type_id` (`item_type_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `transaction_invoice`
--
ALTER TABLE `transaction_invoice`
  ADD PRIMARY KEY (`txn_invoice_no`),
  ADD KEY `txn_invoice_no` (`txn_invoice_no`),
  ADD KEY `txn_customer_id` (`txn_customer_id`);

--
-- Indexes for table `transaction_invoice_item`
--
ALTER TABLE `transaction_invoice_item`
  ADD PRIMARY KEY (`txn_invoice_item_id`),
  ADD KEY `txn_invoice_no` (`txn_invoice_no`),
  ADD KEY `item_type_id` (`item_type_id`),
  ADD KEY `txn_invoice_item_id` (`txn_invoice_item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `charge_type`
--
ALTER TABLE `charge_type`
  MODIFY `charge_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `config_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice_item_charges`
--
ALTER TABLE `invoice_item_charges`
  MODIFY `invoice_item_charges_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_type`
--
ALTER TABLE `item_type`
  MODIFY `item_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `transaction_invoice_item`
--
ALTER TABLE `transaction_invoice_item`
  MODIFY `txn_invoice_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice_item_charges`
--
ALTER TABLE `invoice_item_charges`
  ADD CONSTRAINT `invoice_item_charges_ibfk_1` FOREIGN KEY (`txn_invoice_item_id`) REFERENCES `transaction_invoice_item` (`txn_invoice_item_id`),
  ADD CONSTRAINT `invoice_item_charges_ibfk_2` FOREIGN KEY (`charge_type_id`) REFERENCES `charge_type` (`charge_type_id`);

--
-- Constraints for table `item_type`
--
ALTER TABLE `item_type`
  ADD CONSTRAINT `item_type_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `transaction_invoice`
--
ALTER TABLE `transaction_invoice`
  ADD CONSTRAINT `transaction_invoice_ibfk_1` FOREIGN KEY (`txn_customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `transaction_invoice_item`
--
ALTER TABLE `transaction_invoice_item`
  ADD CONSTRAINT `transaction_invoice_item_ibfk_1` FOREIGN KEY (`txn_invoice_no`) REFERENCES `transaction_invoice` (`txn_invoice_no`),
  ADD CONSTRAINT `transaction_invoice_item_ibfk_2` FOREIGN KEY (`item_type_id`) REFERENCES `item_type` (`item_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
