-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 11, 2024 at 01:10 PM
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
-- Database: `fund`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointmen`
--

CREATE TABLE `appointmen` (
  `appointment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `information` varchar(255) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `patient` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointmen`
--

INSERT INTO `appointmen` (`appointment_id`, `user_id`, `doctor_id`, `information`, `appointment_date`, `appointment_time`, `patient`) VALUES
(3, 14, 7, 'ผ่าฟัน', '2024-02-12', '13:34:00', ''),
(4, 14, 7, 'ผ่าฟัน', '2024-02-12', '14:21:00', 'รารา นารา'),
(6, 14, 69, 'อื่นๆ', '2024-02-11', '13:13:00', 'ลาว');

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

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `name`, `price`, `image`, `quantity`) VALUES
(47, 'CHORKOON ยาสีฟันสมุนไพร', '165', 'Product2.png', 1),
(48, 'ยาสีฟันคอลเกต รสสดชื่นเย็นซ่า', '62', 'Product1.png', 1),
(49, 'ยาสีฟัน ซิสเท็มมา อัลตร้า แคร์ แอนด์', '49', '2.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE `clinic` (
  `ClinicID` int(3) NOT NULL,
  `Cname` varchar(100) NOT NULL,
  `CAddress` varchar(100) NOT NULL,
  `CPhonenumber` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`ClinicID`, `Cname`, `CAddress`, `CPhonenumber`) VALUES
(200, 'Fundclinic', '55', '0825252520');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `DoctorID` int(6) NOT NULL,
  `DFirstname` varchar(50) NOT NULL,
  `DLastname` varchar(50) NOT NULL,
  `Dage` int(3) NOT NULL,
  `Dsex` varchar(10) NOT NULL,
  `Dnation` varchar(20) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Education` varchar(50) NOT NULL,
  `PhoneNumber` varchar(10) NOT NULL,
  `Demail` varchar(50) NOT NULL,
  `RoleID` int(3) NOT NULL,
  `Exp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`DoctorID`, `DFirstname`, `DLastname`, `Dage`, `Dsex`, `Dnation`, `Address`, `Education`, `PhoneNumber`, `Demail`, `RoleID`, `Exp`) VALUES
(7, 'ริค', 'ซานเชส', 72, 'ชาย', 'อเมริกา', '123 Main St', 'ปริญาเอก', '0551234901', 'rick@email.com', 100, '10 years experience'),
(13, 'อารอน', 'คอมมอน', 35, 'ชาย', 'ไทย', '13/46 ต.อรัญญิก อ.เมือง จ.พิษณุโลก', 'ปริญญาตรี มหาวิทยาลัยนเรศวร', '0852741963', 'farfaraway@gmail.com', 100, 'ทำงานที่ยุโรป10ปี'),
(69, 'ปาณิสรา', 'เดียวตระกูล', 29, 'หญิง', 'ไทย', '250/69 ต.ท่าทอง อ.เมือง จ.พิษณุโลก', 'ปริญญาตรี จุฬาลงกรณ์มหาวิทยาลัย', '0819876596', 'panisara@gmail.com', 100, 'ทำงานที่ America , England , France');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmployeeID` int(6) NOT NULL,
  `RoleID` int(6) NOT NULL,
  `EFirstname` varchar(50) NOT NULL,
  `ELastname` varchar(50) NOT NULL,
  `Esex` varchar(10) NOT NULL,
  `Eage` int(3) NOT NULL,
  `ClinicID` int(3) NOT NULL,
  `Enation` varchar(20) NOT NULL,
  `EAddress` varchar(100) NOT NULL,
  `Ephonenumber` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeID`, `RoleID`, `EFirstname`, `ELastname`, `Esex`, `Eage`, `ClinicID`, `Enation`, `EAddress`, `Ephonenumber`) VALUES
(23, 101, 'ชนาพร', 'รุ่งทิพย์', 'หญิง', 45, 200, 'ไทย', '21/1  ต.ท่าโพิ์์ อ.เมือง จ.พิษณุโลก', '0987654321'),
(56, 102, 'อาเนีย', 'ฟอร์เจอร์', 'ชาย', 30, 200, 'หญิง', '125/24 ถนนดำริ ต.ในเมือง จ.พิษณุโลก', '022-292-22'),
(111, 102, 'คมสัน', 'มาแน่', 'ชาย', 50, 200, 'ไทย', '500/54 ถนนวังจันทร์ ต.ในเมือง จ.พิษณุโลก', '022-2222-2'),
(112, 102, 'ชาญวิทย์', 'ปากช่อง', 'ชาย', 27, 200, 'ไทย', '359/104 ต.ท่าโพธิ์ อ.เมือง จ.พิษณุโลก', '0845682254'),
(113, 101, 'พลาดล', 'หวานหวาน', 'ชาย', 40, 200, 'ไทย', '98/74 ต.หัวรอ อ.เมือง จ.พิษณุโลก', '0963741852'),
(100112, 102, 'มาศรี', 'มหาตาล', 'หญิง', 26, 200, 'ไทย', ' จ.พิษณุโลก', '0988907879');

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
(12, 'cccc', 823985981, 'cccc@hotmail.com', 'cash on delivery', '314/17', 'บ้านคลอง', 'เมือง', 'พิษณุโลก', 'ไทย', 65000, 'ไหมขัดฟัน Oral-B essential floss 5เมตร (8) , CHORKOON ยาสีฟันสมุนไพร (4) , ยาสีฟัน ซิสเท็มมา อัลตร้า แคร์ แอนด์ (1) , คอลเกตน้ำยาบ้วนปากพลักซ์เกลือสมุนไพร (3) , ยาสีฟันคอลเกต รสสดชื่นเย็นซ่า (3) ', 2312),
(13, 'sappaya', 989786789, 'sappaya@gmail.com', 'paypal', '33/2', 'พิตร', 'เมือง', 'รารารา', 'รารารา', 53120, 'CHORKOON ยาสีฟันสมุนไพร (3) , ยาสีฟัน ซิสเท็มมา อัลตร้า แคร์ แอนด์ (1) , ยาสีฟันคอลเกต รสสดชื่นเย็นซ่า (1) ', 606),
(14, 'ปกป้อง เเปลก', 989876545, 'sa@gmail.com', 'paypal', '22', 'ในเมือง', 'พิชัย', 'สุโขทัย', 'ไทย', 53120, 'ยาสีฟัน ซิสเท็มมา อัลตร้า แคร์ แอนด์ (1) , CHORKOON ยาสีฟันสมุนไพร (1) ', 214);

-- --------------------------------------------------------

--
-- Table structure for table `patien`
--

CREATE TABLE `patien` (
  `id` int(10) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `urole` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `age` int(3) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `patien`
--

INSERT INTO `patien` (`id`, `firstname`, `lastname`, `email`, `password`, `urole`, `created_at`, `age`, `gender`, `nationality`, `phone_number`, `address`) VALUES
(8, 'User', 'mart', 'user@gmail.com', '$2y$10$.CSKR/.0tCnZ3dz5UUvU/OGX.vLedgyhFxEY/Iopn0OaqWOPa0tPO', 'user', '2024-01-24 10:10:59', 21, 'ชาย', 'ไทย', '6698947898', 'พิษณุโลก'),
(13, 'sappaya', 'kasorn', 'sappaya@gmail.com', '$2y$10$GH5NZF5H5gFkFKkJbcjqN.oDGF9KCBMkqG2xr3QAzAHNGkCwmHoo6', 'user', '2024-01-30 18:38:39', 21, 'ชาย', 'ไทย', '0898987678', 'พิจิตร'),
(14, 'รารา', 'นารา', 'zx@gmail.com', '$2y$10$0PsjVuDs938oVSQXo5NwCu35h1d0HeDTpjcaSZiwLplcfGBfxGWdu', 'user', '2024-02-09 07:01:54', 12, 'หญิง', 'ลาว', '0897865435', 'สุโขทัย');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `PatientID` int(5) NOT NULL,
  `PFirstname` varchar(20) NOT NULL,
  `PLastname` varchar(20) NOT NULL,
  `PAge` int(3) NOT NULL,
  `PSex` varchar(10) NOT NULL,
  `PNation` varchar(20) NOT NULL,
  `PAddress` varchar(100) NOT NULL,
  `PPhonenumber` varchar(10) NOT NULL,
  `PEmail` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`PatientID`, `PFirstname`, `PLastname`, `PAge`, `PSex`, `PNation`, `PAddress`, `PPhonenumber`, `PEmail`, `Password`) VALUES
(8, 'เธียร', 'รอดกนก', 20, 'ชาย', 'ไทย', 'พิษณุโลก', '0123456789', 'fku@gmail.com', '123456789'),
(9, 'ธนดล', 'ทองดอนง้าว', 20, 'ชาย', 'ไทย', 'พิษณุโลก', '0804567777', 'nnon26@gmail.com', '999999999'),
(14, 'โกโจ', 'ซาโตรุ', 17, 'ชาย', 'ไทย', 'พิษณุโลก', '0129956789', 'ggu@gmail.com', '123456782'),
(122, 'นนท์', 'ธนนท์', 36, 'ชาย', 'ไทย', 'นครสวรรค์', '0123456781', 'nontannon@gmail.com', 'matamarai'),
(99999, 'ฟ่าง', 'สวยมาก', 23, 'หญิง', 'ไทย', 'America', '0819876596', 'fangfang@gmail.com', 'fanglovekay');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(6) NOT NULL,
  `Productname` varchar(50) NOT NULL,
  `Description` varchar(50) NOT NULL,
  `Price` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `Productname`, `Description`, `Price`) VALUES
(4, 'ยาสีฟันสูตรกัญชา', 'แปรงไปลอยไป', 299),
(100, 'แปรงสีฟันขนช้าง', 'ทำให้หินปูนหลุดกระจาย', 999),
(102, 'ยาสิฟันเทพไท', 'ไม่แพงนะค่ะไม่แพงเลยคะ', 29),
(103, 'ไหมขัดฟัน', 'ช่วยทำความสะอาดระหว่างซอกฟันได้อย่างมีประสิทธิภาพ', 129),
(112, 'แปรงสีฟันสำหรับวัยชรา', 'เหมาะสำผู้สูงวัยที่ฟันไม่แข็งแรง', 109),
(123, 'น้ำยาดับกลิ่นปาก ปากดี', 'ใช้สำหรับับกลิ่นปาก', 150),
(155, 'น้ำยาบ้วนปากพลักซ์เกลือสมุนไพร', 'ลดกลิ่นปาก', 155),
(1003, 'ยาบ้วนปากเซนโซดาร์จ', 'ใช้นิดเดียวปากสะอาด', 89);

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

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `PromotionID` int(3) NOT NULL,
  `Promotionname` varchar(50) NOT NULL,
  `DiscountPercentage` int(2) NOT NULL,
  `Pdescription` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`PromotionID`, `Promotionname`, `DiscountPercentage`, `Pdescription`) VALUES
(500, 'no', 0, 'ไม่ลดจ้า'),
(501, 'ลด10%', 10, 'ลด10%0จ่้า');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `doctor_name` varchar(255) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `patient` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `doctor_name`, `rating`, `comment`, `created_at`, `patient`) VALUES
(18, 'หมอE', 4, 'ดกดกดกด', '2024-02-09 05:48:10', 'sappaya kasorn'),
(19, 'หมอC', 6, 'ดีอะ', '2024-02-09 05:55:02', 'sappaya kasorn'),
(20, 'หมอA', 1, 'เจ็บบบบบบ', '2024-02-09 06:00:50', 'User mart'),
(21, 'หมอD', 2, 'ไม่ดี', '2024-02-09 07:02:48', 'รารา นารา');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `RoleID` int(6) NOT NULL,
  `Rolename` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`RoleID`, `Rolename`) VALUES
(100, 'หมอ'),
(101, 'พนักงานเก็บเงิน'),
(102, 'ผู้ช่วยหมอ');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `TransactionID` int(7) NOT NULL,
  `PatientID` int(5) NOT NULL,
  `ProductID` int(6) NOT NULL,
  `ClinicID` int(3) NOT NULL,
  `PromotionID` int(3) NOT NULL,
  `Quantity` int(4) NOT NULL,
  `Transactiondate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`TransactionID`, `PatientID`, `ProductID`, `ClinicID`, `PromotionID`, `Quantity`, `Transactiondate`) VALUES
(45, 8, 100, 200, 500, 5, '2024-01-16'),
(156, 9, 103, 200, 500, 2, '2024-01-15'),
(1144, 14, 155, 200, 500, 1, '2024-01-14'),
(1145, 8, 102, 200, 500, 2, '2024-01-10'),
(1148, 122, 155, 200, 501, 10, '2023-10-15'),
(1150, 122, 155, 200, 501, 5, '2023-11-15'),
(1219, 122, 102, 200, 501, 21, '2023-09-11'),
(155155, 122, 155, 200, 501, 15, '2023-10-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointmen`
--
ALTER TABLE `appointmen`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`ClinicID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`DoctorID`),
  ADD KEY `RoleID` (`RoleID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD KEY `ClinicID` (`ClinicID`),
  ADD KEY `RoleID` (`RoleID`);

--
-- Indexes for table `order2`
--
ALTER TABLE `order2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patien`
--
ALTER TABLE `patien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`PromotionID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`RoleID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `ProductID` (`ProductID`),
  ADD KEY `PromotionID` (`PromotionID`),
  ADD KEY `ClinicID` (`ClinicID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointmen`
--
ALTER TABLE `appointmen`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `order2`
--
ALTER TABLE `order2`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `patien`
--
ALTER TABLE `patien`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `role` (`RoleID`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`ClinicID`) REFERENCES `clinic` (`ClinicID`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`RoleID`) REFERENCES `role` (`RoleID`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `patient` (`PatientID`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`),
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`PromotionID`) REFERENCES `promotion` (`PromotionID`),
  ADD CONSTRAINT `transaction_ibfk_4` FOREIGN KEY (`ClinicID`) REFERENCES `clinic` (`ClinicID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
