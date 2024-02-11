-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2024 at 04:48 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fund-2`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order2`
--

CREATE TABLE `order2` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `flat` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `pin_code` int(255) NOT NULL,
  `total_products` varchar(255) NOT NULL,
  `total_price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order2`
--

INSERT INTO `order2` (`id`, `name`, `number`, `email`, `method`, `flat`, `street`, `city`, `state`, `country`, `pin_code`, `total_products`, `total_price`) VALUES
(1, 'เธียร รอดกนก', 823987986, 'yung_999@hotmail.com', 'cash on delivery', '314/14 ดำริ', 'บ้านคลอง', 'เมือง', 'พิษณุโลก', 'ไทย', 65000, '0', 227),
(2, 'Sans -', 823987986, 'yu555n@gmail.com', 'credit cart', '34/21', 'บ้านคลอง', 'เมือง', 'พิษณุโลก', 'ไทย', 65000, '0', 227),
(3, 'MR B', 823987986, 'yung5757@hotmail.com', 'paypal', '314', 'บ้านคลอง', 'เมือง', 'พิษณุโลก', 'ไทย', 65000, '0', 248),
(4, 'เวอร์จิล', 823987986, 'vergi@hotmail.com', 'cash on delivery', '251/11', 'LA', 'NEW', 'USA', 'USA', 122222, '0', 403),
(5, 'Sans -', 823987986, 'sssss@gmail.com', 'credit cart', '34/21', 'LA', 'เมือง', 'พิษณุโลก', 'ไทย', 65000, '0', 605),
(6, 'LOLO', 823980000, 'LALAO@hotmail.com', 'credit cart', '314/14 ดำริ', 'บ้านคลอง', 'เมือง', 'พิษณุโลก', 'ไทย', 65000, '0', 1045),
(7, 'kokoky', 823987986, 'jjjjunfg@gmail.com', 'paypal', '34/21', 'บ้านคลอง', 'เมือง', 'พิษณุโลก', 'ไทย', 65000, '0', 1107),
(8, 'Nissan', 839979869, 'DIO@hotmail.com', 'credit cart', '77/8', 'บ้านคลอง', 'Nissan', 'พิษณุโลก', 'ไทย', 65000, 'กิฟฟารีน ไหมขัดฟัน แอคทีฟ ฟลอส เคลือบขี้ผึ้ง (3) , คอลเกตน้ำยาบ้วนปากพลักซ์เกลือสมุนไพร (1) ', 395),
(9, 'Uchiha', 823987977, 'Madara@hotmail.com', 'paypal', '3145', 'Konoha', 'Konoha', 'พิษณุโลก', 'ไทย', 65000, 'คอลเกตน้ำยาบ้วนปากพลักซ์เกลือสมุนไพร (4) , ยาสีฟันคอลเกต รสสดชื่นเย็นซ่า (1) ', 682),
(10, 'Sasuke', 823987986, 'tyty@gmail.com', 'credit cart', '34/21', 'บ้านคลอง', 'เมือง', 'พิษณุโลก', 'ไทย', 65000, 'ยาสีฟันคอลเกต รสสดชื่นเย็นซ่า (10) ', 620),
(11, 'Gojo Satoru', 823987977, 'Gojoxx@hotmail.com', 'cash on delivery', '88/9', 'Tokyo', 'Japan city', 'Japan', 'Japan', 17786, 'ไหมขัดฟัน Oral-B essential floss 5เมตร (2) , CHORKOON ยาสีฟันสมุนไพร (1) , ยาสีฟัน ซิสเท็มมา อัลตร้า แคร์ แอนด์ (1) , คอลเกตน้ำยาบ้วนปากพลักซ์เกลือสมุนไพร (1) , ยาสีฟันคอลเกต รสสดชื่นเย็นซ่า (1) ', 669),
(12, 'cccc', 823985981, 'cccc@hotmail.com', 'cash on delivery', '314/17', 'บ้านคลอง', 'เมือง', 'พิษณุโลก', 'ไทย', 65000, 'ไหมขัดฟัน Oral-B essential floss 5เมตร (8) , CHORKOON ยาสีฟันสมุนไพร (4) , ยาสีฟัน ซิสเท็มมา อัลตร้า แคร์ แอนด์ (1) , คอลเกตน้ำยาบ้วนปากพลักซ์เกลือสมุนไพร (3) , ยาสีฟันคอลเกต รสสดชื่นเย็นซ่า (3) ', 2312);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(3, 'ยาสีฟันคอลเกต รสสดชื่นเย็นซ่า', 62, 'Product1.png'),
(4, 'CHORKOON ยาสีฟันสมุนไพร', 165, 'Product2.png'),
(6, 'ยาสีฟัน ซิสเท็มมา อัลตร้า แคร์ แอนด์', 49, '2.png'),
(7, 'กิฟฟารีน ไหมขัดฟัน แอคทีฟ ฟลอส เคลือบขี้ผึ้ง', 80, '4.png'),
(8, 'ไหมขัดฟัน Oral-B essential floss 5เมตร', 119, '5.png'),
(9, 'คอลเกตน้ำยาบ้วนปากพลักซ์เกลือสมุนไพร', 155, '7.png'),
(10, 'คอลเกตน้ำยาบ้วนปากพลักซ์เปปเปอร์มิ้นท์', 155, '8.png'),
(11, 'คอลเกต อ๊อพติคไวท์ น้ำยาบ้วนปาก ชาร์โคลเฟรชมินต์ ', 99, 'Product8.png'),
(12, 'เดนทิสเต้ ยาสีฟันชนิดแปรงแห้ง ไม่ต้องใช้น้ำ ', 200, '10.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order2`
--
ALTER TABLE `order2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `order2`
--
ALTER TABLE `order2`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
