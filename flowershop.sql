-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2024 at 05:38 AM
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
-- Database: `flowershop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_username` varchar(100) NOT NULL,
  `admin_password` text NOT NULL,
  `admin_email` varchar(100) DEFAULT NULL,
  `admin_phone` varchar(12) DEFAULT NULL,
  `admin_fullname` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cate_ID` int(11) NOT NULL,
  `cate_name` varchar(100) NOT NULL,
  `cate_img_link` varchar(100) DEFAULT NULL,
  `cate_desc` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cate_ID`, `cate_name`, `cate_img_link`, `cate_desc`) VALUES
(1, 'Bông Khai Trương', NULL, NULL),
(2, 'Bông Đám Cưới - Thành Hôn', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_username` varchar(50) NOT NULL,
  `customer_password` text NOT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_phone` varchar(12) DEFAULT NULL,
  `customer_fullname` text DEFAULT NULL,
  `customer_address` text DEFAULT NULL,
  `customer_district` varchar(50) DEFAULT NULL,
  `customer_city` varchar(50) DEFAULT NULL,
  `customer_status` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oder_details`
--

CREATE TABLE `oder_details` (
  `od_ID` int(11) NOT NULL,
  `prd_ID` char(5) NOT NULL,
  `order_ID` int(11) NOT NULL,
  `od_quantity` int(11) NOT NULL,
  `od_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_ID` int(11) NOT NULL,
  `customer_username` varchar(50) NOT NULL,
  `order_date` date NOT NULL,
  `order_status` tinyint(4) NOT NULL,
  `order_total-price` double NOT NULL,
  `order_payment-method` varchar(50) DEFAULT NULL,
  `order_address` text DEFAULT NULL,
  `order_district` varchar(50) DEFAULT NULL,
  `order_city` varchar(50) DEFAULT NULL,
  `oder_new-receiver` text DEFAULT NULL,
  `order_new-phone` varchar(12) DEFAULT NULL,
  `order_new-email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `cate_ID` int(11) NOT NULL,
  `prd_ID` char(5) NOT NULL,
  `prd_name` varchar(100) NOT NULL,
  `prd_desc` int(200) DEFAULT NULL,
  `prd_img` int(100) DEFAULT NULL,
  `prd_status` decimal(10,0) DEFAULT NULL,
  `prd_size` varchar(10) DEFAULT NULL,
  `prd_price` double DEFAULT NULL,
  `prd_color_rep` varchar(100) DEFAULT NULL,
  `prd_flower_rep` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`cate_ID`, `prd_ID`, `prd_name`, `prd_desc`, `prd_img`, `prd_status`, `prd_size`, `prd_price`, `prd_color_rep`, `prd_flower_rep`) VALUES
(2, 'DC001', 'Hoa mừng cưới 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1, 'KT001', 'Hoa xịn', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1, 'KT002', 'Hoa xinh', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1, 'KT003', 'Hoa phát tài', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `generate_prd_id` BEFORE INSERT ON `products` FOR EACH ROW BEGIN
    DECLARE last_id CHAR(3);
    DECLARE new_id CHAR(5);

    SET last_id = (
        SELECT SUBSTRING(prd_ID, 3) 
        FROM products 
        WHERE cate_ID = NEW.cate_ID 
        ORDER BY prd_ID DESC 
        LIMIT 1
    );

    CASE NEW.cate_ID
        WHEN 1 THEN SET new_id = CONCAT('KT', LPAD(IFNULL(CAST(last_id AS UNSIGNED) + 1, 1), 3, '0'));
        WHEN 2 THEN SET new_id = CONCAT('DC', LPAD(IFNULL(CAST(last_id AS UNSIGNED) + 1, 1), 3, '0'));
        WHEN 3 THEN SET new_id = CONCAT('TN', LPAD(IFNULL(CAST(last_id AS UNSIGNED) + 1, 1), 3, '0'));
        WHEN 4 THEN SET new_id = CONCAT('VL', LPAD(IFNULL(CAST(last_id AS UNSIGNED) + 1, 1), 3, '0'));
        ELSE SET new_id = NULL; -- Handle invalid category ID
    END CASE;

    SET NEW.prd_ID = new_id;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_username`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cate_ID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_username`);

--
-- Indexes for table `oder_details`
--
ALTER TABLE `oder_details`
  ADD PRIMARY KEY (`od_ID`),
  ADD KEY `prd_ID` (`prd_ID`),
  ADD KEY `order_ID` (`order_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_ID`),
  ADD KEY `customer_username` (`customer_username`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prd_ID`),
  ADD KEY `cate_ID` (`cate_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cate_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `oder_details`
--
ALTER TABLE `oder_details`
  ADD CONSTRAINT `oder_details_ibfk_1` FOREIGN KEY (`prd_ID`) REFERENCES `products` (`prd_ID`),
  ADD CONSTRAINT `oder_details_ibfk_2` FOREIGN KEY (`order_ID`) REFERENCES `orders` (`order_ID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_username`) REFERENCES `customers` (`customer_username`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cate_ID`) REFERENCES `categories` (`cate_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
