-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2022 at 03:32 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodcave`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `ct_id` int(11) NOT NULL,
  `ct_amount` int(11) NOT NULL,
  `ct_note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`ct_id`, `ct_amount`, `ct_note`, `s_id`, `f_id`, `c_id`) VALUES
(1, 1, '', 0, 0, 0),
(18, 1, '', 0, 0, 0),
(29, 3, '', 0, 0, 0),
(84, 1, '', 3, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_username` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_pwd` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_firstname` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_lastname` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_gender` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'M for Male, F for Female',
  `c_type` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Type of customer in this canteen (STD for student,STF for staff, GUE for guest, ADM for admin, OTH for other)',
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_username`, `c_pwd`, `c_firstname`, `c_lastname`, `c_email`, `c_gender`, `c_type`, `c_id`) VALUES
('chandini', '10262730', 'chandini', 'yallavula', 'yallavulac@gmail.com', 'F', 'STD', 1),
('chinni', '12344321', 'Sneha', 'Poorna', 'chinni@gmail.com', 'F', 'STD', 2),
('poorna', '12344321', 'Poorna', 'Sai', 'poorna@gmail.com', 'M', 'STD', 3),
('SVEC_Admin01', 'Admin01@SVEC', 'Admin', 'Poorna', 'admin01@gmail.com', 'M', 'ADM', 4),
('anjibabu', '12344321', 'Anji', 'Babu', 'anjigoudtonta55@gmail.com', 'M', 'STD', 5),
('naveen', '87654321', 'Naveen', 'Tata', 'naveen@gmail.com', 'M', 'STD', 6);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `f_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `f_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_price` decimal(6,2) NOT NULL,
  `f_pic` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`f_id`, `s_id`, `f_name`, `f_price`, `f_pic`) VALUES
(7, 2, 'Tea', '10.00', '7_2.jpg'),
(8, 2, 'Coffee', '15.00', '8_2.jpg'),
(9, 3, 'Veg Puff', '20.00', '9_3.jpg'),
(10, 3, 'Chicken Cheece Burger', '80.00', '10_3.jpg'),
(11, 2, 'Chat', '25.00', NULL),
(12, 2, 'Milk', '20.00', '12_2.png'),
(13, 2, 'Lassi', '25.00', '13_2.png'),
(14, 2, 'Mixture', '25.00', '14_2.png'),
(15, 2, 'Panipuri', '25.00', '15_2.png'),
(16, 2, 'Samosa(2 pcs)', '10.00', '16_2.png'),
(17, 2, 'Sweet Corn', '25.00', '17_2.png'),
(18, 2, 'Ginger Tea', '10.00', NULL),
(19, 2, 'Badham Tea', '15.00', NULL),
(20, 2, 'Lemon Tea', '15.00', NULL),
(22, 3, 'Chicken Manchuria', '100.00', '22_3.png'),
(23, 3, 'Chicken Puff', '30.00', '23_3.png'),
(24, 3, 'Egg Puff', '25.00', '24_3.png'),
(25, 3, 'French Fries', '35.00', '25_3.png'),
(26, 3, 'Chicken Tikki Burger', '70.00', NULL),
(27, 3, 'Grilled Sandwitch', '40.00', NULL),
(29, 6, 'Kharbooja Juice', '40.00', '29_6.png'),
(30, 6, 'Banana Juice', '40.00', '30_6.png'),
(31, 6, 'Pineapple Juice', '40.00', '31_6.png'),
(32, 6, 'Grape Juice', '40.00', '32_6.png'),
(33, 6, 'Orange Juice', '40.00', '33_6.png'),
(34, 6, 'Sapota Juice', '40.00', '34_6.png'),
(35, 6, 'Chocolate Milk Shake', '60.00', '35_6.png'),
(36, 6, 'Cashew Milk Shake', '60.00', '36_6.png'),
(37, 6, 'Strawberry Milk Shake', '60.00', '37_6.png'),
(38, 6, 'Oreo Milk Shake', '80.00', '38_6.png'),
(39, 5, 'Idli', '25.00', '39_5.jpg'),
(40, 5, 'Gari', '20.00', '40_5.png'),
(41, 5, 'Mirchi Bajji', '20.00', '41_5.jpg'),
(42, 5, 'Uthappam', '30.00', '42_5.jpg'),
(44, 5, 'Plain Dosa', '25.00', '44_5.png'),
(45, 5, 'Masala Dosa', '35.00', '45_5.jpg'),
(46, 5, 'Paneer Masala Dosa', '70.00', NULL),
(47, 5, 'Puri', '35.00', '47_5.jpg'),
(48, 5, 'Onion Dosa', '35.00', NULL),
(49, 5, 'Upma', '25.00', '49_5.jpg'),
(50, 5, 'Chapathi', '35.00', '50_5.jpg'),
(51, 5, 'Parota', '40.00', '51_5.jpg'),
(52, 4, ' Veg Fried Rice', '55.00', '52_4.jpg'),
(53, 4, 'Veg Noodles', '55.00', '53_4.png'),
(54, 4, 'Veg Biryani', '85.00', '54_4.png'),
(55, 4, 'Veg Paneer Fried Rice', '100.00', '55_4.png'),
(56, 4, 'Egg Noodles', '80.00', '56_4.jpg'),
(57, 4, 'Chicken Fried Rice', '90.00', '57_4.jpg'),
(58, 4, 'Chicken Noodles', '90.00', '58_4.jpg'),
(59, 4, 'Chicken Dum Biryani', '130.00', '59_4.jpg'),
(60, 4, 'Chicken Curry Biryani', '130.00', '60_4.jpg'),
(61, 4, 'Chicken Fry Piece Biryani', '130.00', '61_4.png'),
(62, 4, 'Chicken Lollipop', '120.00', '62_4.jpg'),
(63, 4, 'Mutton Dum Biryani', '220.00', '63_4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `ord_id` int(11) NOT NULL,
  `orh_id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `ord_amount` int(11) NOT NULL,
  `ord_buyprice` decimal(6,2) NOT NULL,
  `ord_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`ord_id`, `orh_id`, `f_id`, `ord_amount`, `ord_buyprice`, `ord_note`) VALUES
(102, 72, 22, 1, '100.00', ''),
(103, 0, 25, 1, '35.00', ''),
(106, 47, 29, 1, '40.00', ''),
(107, 75, 15, 1, '25.00', ''),
(108, 49, 13, 1, '25.00', ''),
(109, 50, 16, 3, '10.00', ''),
(110, 51, 10, 1, '80.00', ''),
(112, 77, 11, 1, '25.00', ''),
(113, 54, 36, 1, '60.00', ''),
(114, 79, 24, 1, '25.00', ''),
(115, 80, 27, 1, '40.00', ''),
(116, 81, 17, 1, '25.00', ''),
(117, 82, 62, 1, '120.00', ''),
(118, 83, 25, 1, '35.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_header`
--

CREATE TABLE `order_header` (
  `orh_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `orh_ordertime` timestamp NOT NULL DEFAULT current_timestamp(),
  `orh_orderstatus` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orh_finishedtime` datetime DEFAULT NULL,
  `t_id` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_header`
--

INSERT INTO `order_header` (`orh_id`, `c_id`, `s_id`, `p_id`, `orh_ordertime`, `orh_orderstatus`, `orh_finishedtime`, `t_id`) VALUES
(72, 2, 3, 45, '2022-11-13 13:54:40', 'CNCL', '0000-00-00 00:00:00', ''),
(81, 3, 2, 57, '2022-11-14 13:42:35', 'FNSH', '2022-11-14 19:39:59', 'T75693953497569'),
(82, 1, 4, 58, '2022-11-15 02:17:22', 'VRFY', NULL, 'T75693953497569'),
(83, 1, 3, 59, '2022-11-15 02:19:16', 'VRFY', NULL, 'T75693953497569');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `p_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `p_amount` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`p_id`, `c_id`, `p_amount`) VALUES
(45, 2, '100.00'),
(46, 5, '140.00'),
(47, 1, '40.00'),
(48, 1, '25.00'),
(49, 1, '25.00'),
(50, 1, '30.00'),
(51, 3, '80.00'),
(52, 3, '100.00'),
(53, 3, '25.00'),
(54, 3, '60.00'),
(55, 3, '25.00'),
(56, 3, '40.00'),
(57, 3, '25.00'),
(58, 1, '120.00'),
(59, 1, '35.00');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `s_username` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_pwd` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_location` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_phoneno` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_pic` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`s_username`, `s_pwd`, `s_name`, `s_location`, `s_email`, `s_phoneno`, `s_pic`, `s_id`) VALUES
('shop1', 'Shop1@vasavi', 'Vasavi Tea & Snacks', 'Point-1', 'shop01@email.com', '7569395349', 'shop2.png', 2),
('shop2', '12344321', 'Vasavi Bakery', 'Point-2', 'shop02@email.com', '7569395349', 'shop-2.png', 3),
('shop3', '12121212', 'Vasavi Food Court', 'Point-3', 'shop3@gmail.com', '7569395349', 'shop4.png', 4),
('shop4', '34343434', 'Vasavi Tiffins', 'Point-4', 'shop4@gmail.com', '7569395349', 'shop5.jpg', 5),
('shop5', '56565656', 'Vasavi Juice Corner', 'Point-5', 'shop5@gmail.com', '7569395349', 'shop6.jpg', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ct_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `f_id` (`f_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `c_username` (`c_username`),
  ADD UNIQUE KEY `c_email` (`c_email`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`ord_id`),
  ADD KEY `orh_id` (`orh_id`) USING BTREE,
  ADD KEY `f_id` (`f_id`) USING BTREE;

--
-- Indexes for table `order_header`
--
ALTER TABLE `order_header`
  ADD PRIMARY KEY (`orh_id`),
  ADD KEY `c_id` (`c_id`) USING BTREE,
  ADD KEY `s_id` (`s_id`) USING BTREE,
  ADD KEY `p_id` (`p_id`) USING BTREE;

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `order_header`
--
ALTER TABLE `order_header`
  MODIFY `orh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
