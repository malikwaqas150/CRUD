-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2024 at 10:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_date` timestamp NULL DEFAULT NULL,
  `product_image` varchar(50) NOT NULL,
  `product_thumbnail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `status`, `created_date`, `updated_date`, `product_image`, `product_thumbnail`) VALUES
(1, 'Scarf', 'summer collection', 1, '2024-02-07 02:09:22', '2024-02-07 02:09:22', '65c31e92543f4.jpg', ''),
(2, 'Facial Recognition camera', 'Electronics', 1, '2024-02-07 02:28:01', '2024-02-07 02:28:01', '65c322f1137f0.jpg', ''),
(3, 'Laptop Battery', 'Laptop accessories, Electronics', 1, '2024-02-07 02:32:27', '2024-02-07 02:32:27', '65c323fb9250c.webp', ''),
(4, 'Samsol Shampoo', 'cosmetics', 1, '2024-02-07 02:37:44', '2024-02-07 02:37:44', '65c325385c033.jpg', ''),
(5, 'Hair Color', 'cosmetics', 1, '2024-02-27 09:47:18', '0000-00-00 00:00:00', 'ezgif-4-2b9c830afc.jpg', ''),
(6, 'Bracelet', 'jewellery ', 1, '2024-02-15 13:21:29', '2024-02-07 02:41:21', '65ce0f617056c.jpg', ''),
(7, 'Joggers', 'jogging shoes, sports shoes ', 1, '2024-02-07 03:12:17', '2024-02-07 03:12:17', '65c32d51a7871.jpg', ''),
(8, 'sheet set ', 'home decoration ', 1, '2024-02-07 03:15:08', '2024-02-07 03:15:08', '65c32dfc54d77.jpeg', ''),
(9, 'Scented candles', 'Decoration', 1, '2024-02-27 09:46:38', '0000-00-00 00:00:00', 'ezgif-6-c8d40a7d39.jpg', ''),
(10, 'Smart Watch', 'Electronics', 1, '2024-02-27 09:46:54', '0000-00-00 00:00:00', 'smart_watch1.webp', ''),
(11, 'Nail Polish', 'Cosmetics Product', 1, '2024-02-27 09:46:24', '0000-00-00 00:00:00', 'istockphoto-454371463-612x612.jpg', ''),
(12, 'Ipad Pro', 'Apple tablet, Electronics', 1, '2024-02-09 01:46:53', '2024-02-09 01:46:53', '65c5bc4d2418c.jpg', ''),
(13, 'Car phone holder', 'Vehicle appliances', 1, '2024-02-09 01:49:09', '2024-02-09 01:49:09', '65c5bcd57d7cf.webp', ''),
(14, 'Neck massager', 'Electronics', 1, '2024-02-09 01:51:03', '2024-02-09 01:51:03', '65c5bd477aea2.jpg', ''),
(15, 'Bluetooth speaker', 'Electronics', 1, '2024-02-09 01:52:21', '2024-02-09 01:52:21', '65c5bd95833c8.jpg', ''),
(16, 'Stainless steel water bottle', 'Home Appliances', 1, '2024-02-27 09:46:10', '0000-00-00 00:00:00', 'ezgif-3-abcc984028.jpg', ''),
(17, 'Cat food', 'animal products', 1, '2024-02-27 09:45:59', '0000-00-00 00:00:00', 'ezgif-5-548786df2d.jpg', ''),
(18, 'Posture corrector', 'belts products', 1, '2024-02-27 09:45:50', '0000-00-00 00:00:00', '121_eb6046603011ff845a7ccce78346f989_800x.jpg', ''),
(19, 'Wireless charger', 'Electronics', 1, '2024-02-09 02:58:04', '2024-02-09 02:58:04', '65c5ccfc69ce2.jpg', ''),
(20, 'Wifi extender', 'Internet of things', 1, '2024-02-27 09:45:38', '0000-00-00 00:00:00', '2c898fee702c5da098042140b596df82.jpg', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
