-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2025 at 03:06 PM
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
-- Database: `kececake`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_id` int(11) NOT NULL,
  `Adminname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_id`, `Adminname`, `password`) VALUES
(1, 'Admin', 'Admin123');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `Order_id` varchar(255) NOT NULL,
  `Total_price` varchar(255) NOT NULL,
  `Order_status` varchar(255) NOT NULL,
  `Payment_type` varchar(255) NOT NULL,
  `Transaction_time` varchar(255) NOT NULL,
  `Customer_name` varchar(255) NOT NULL,
  `Customer_email` varchar(255) NOT NULL,
  `Customer_phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `Order_id`, `Total_price`, `Order_status`, `Payment_type`, `Transaction_time`, `Customer_name`, `Customer_email`, `Customer_phone`) VALUES
(25, '333102899', '16000.00', 'settlement', 'qris', '2025-10-15 18:33:48', 'dimas', 'dimas@gmail.com', '234234234324'),
(26, '619676696', '32000.00', 'settlement', 'qris', '2025-11-25 12:03:33', 'Fariz Abdulfatah Sellomo', 'Fariz1234@gmail.com', '081209080706'),
(28, '1659502797', '32000.00', 'settlement', 'qris', '2025-11-25 12:06:47', 'Fariz Abdulfatah Sellomo', 'Fariz1234@gmail.com', '081209080706');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `Order_id` varchar(255) NOT NULL,
  `Product_id` varchar(255) NOT NULL,
  `Product_category` varchar(255) NOT NULL,
  `Product_image` varchar(255) NOT NULL,
  `Product_name` varchar(255) NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Quantity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `Order_id`, `Product_id`, `Product_category`, `Product_image`, `Product_name`, `Price`, `Quantity`) VALUES
(41, '333102899', '7', 'kue basah', 'http://localhost/KeceCake/uploads/klepon.png', 'kue klepon', '8000', '1'),
(42, '333102899', '6', 'kue basah', 'http://localhost/KeceCake/uploads/kue-lumpur.png', 'kue lumpur', '5000', '1'),
(43, '333102899', '5', 'kue kering', 'http://localhost/KeceCake/uploads/serabi.png', 'kue serabi', '1000', '1'),
(44, '333102899', '2', 'kue basah', 'http://localhost/KeceCake/uploads/kue-ape.png', 'kue ape', '2000', '1'),
(45, '619676696', '2', 'kue basah', 'http://localhost/KeceCake/uploads/kue-ape.png', 'kue ape', '2000', '2'),
(46, '619676696', '5', 'kue kering', 'http://localhost/KeceCake/uploads/serabi.png', 'kue serabi', '1000', '3'),
(47, '619676696', '6', 'kue basah', 'http://localhost/KeceCake/uploads/kue-lumpur.png', 'kue lumpur', '5000', '5'),
(51, '1659502797', '2', 'kue basah', 'http://localhost/KeceCake/uploads/kue-ape.png', 'kue ape', '2000', '2'),
(52, '1659502797', '5', 'kue kering', 'http://localhost/KeceCake/uploads/serabi.png', 'kue serabi', '1000', '3'),
(53, '1659502797', '6', 'kue basah', 'http://localhost/KeceCake/uploads/kue-lumpur.png', 'kue lumpur', '5000', '5');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_id` int(11) NOT NULL,
  `Product_name` varchar(255) NOT NULL,
  `Product_price` int(11) NOT NULL,
  `Product_category` varchar(255) NOT NULL,
  `Product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_id`, `Product_name`, `Product_price`, `Product_category`, `Product_image`) VALUES
(2, 'kue ape', 2000, 'kue basah', 'http://localhost/KeceCake/uploads/kue-ape.png'),
(5, 'kue serabi', 1000, 'kue kering', 'http://localhost/KeceCake/uploads/serabi.png'),
(6, 'kue lumpur', 5000, 'kue basah', 'http://localhost/KeceCake/uploads/kue-lumpur.png'),
(7, 'kue klepon', 8000, 'kue basah', 'http://localhost/KeceCake/uploads/klepon.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_id` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_id`, `Username`, `Email`, `Password`) VALUES
(5, 'fariz abdulfatah', 'yoyo@gmal.com', 'Fariz123'),
(6, 'fariz', 'fariz@gmail.com', 'fariz123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
