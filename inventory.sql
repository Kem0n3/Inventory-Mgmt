-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2024 at 06:32 AM
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
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `address`, `phone_number`) VALUES
(2, 'Niharika', 'Quebec', '0183024'),
(5, 'Tony', 'Beijing, china', '0190742');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_details`
--

CREATE TABLE `inventory_details` (
  `inventory_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `color` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_details`
--

INSERT INTO `inventory_details` (`inventory_id`, `product_id`, `size`, `color`, `quantity`) VALUES
(17, 14, '38', 'White', 30),
(18, 23, '40', 'Grey', 100);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user_id` int(20) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `user_name`, `user_password`) VALUES
(1, 'admin', 'pass');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`product_id`, `product_name`, `product_type`, `description`) VALUES
(14, 'Boost', 'Sneaker', 'low'),
(15, 'Air Smoke', 'Sneaker', 'Black grey smoke air '),
(16, 'NB690', 'Running', ' shoe.'),
(23, 'abc', 'Running', 'shoe a');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_transactions`
--

CREATE TABLE `purchase_transactions` (
  `purchase_trans_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `color` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_per_unit` decimal(10,2) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `purchase_cost` decimal(10,2) NOT NULL,
  `purchase_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_transactions`
--

INSERT INTO `purchase_transactions` (`purchase_trans_id`, `product_id`, `size`, `color`, `quantity`, `price_per_unit`, `supplier_id`, `purchase_cost`, `purchase_date`) VALUES
(27, 14, '38', 'White', 200, 80.00, 1, 16000.00, '2024-02-03'),
(28, 23, '40', 'Grey', 100, 120.00, 1, 12000.00, '2024-02-07');

-- --------------------------------------------------------

--
-- Table structure for table `sales_transactions`
--

CREATE TABLE `sales_transactions` (
  `sale_trans_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `color` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_per_unit` decimal(10,2) NOT NULL,
  `sale_total` decimal(10,2) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `sale_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_transactions`
--

INSERT INTO `sales_transactions` (`sale_trans_id`, `product_id`, `size`, `color`, `quantity`, `price_per_unit`, `sale_total`, `customer_id`, `sale_date`) VALUES
(1, 14, '38', 'White', 50, 80.00, 4000.00, 2, '2024-02-05'),
(2, 14, '38', 'White', 120, 90.00, 10800.00, 2, '2024-03-07');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `address`, `phone_number`) VALUES
(1, 'Hamm', 'HongKong', '7105289'),
(2, 'Ent.', 'SIngapore', '0179245');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `inventory_details`
--
ALTER TABLE `inventory_details`
  ADD PRIMARY KEY (`inventory_id`),
  ADD UNIQUE KEY `product_id` (`product_id`,`size`,`color`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `purchase_transactions`
--
ALTER TABLE `purchase_transactions`
  ADD PRIMARY KEY (`purchase_trans_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `sales_transactions`
--
ALTER TABLE `sales_transactions`
  ADD PRIMARY KEY (`sale_trans_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inventory_details`
--
ALTER TABLE `inventory_details`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `purchase_transactions`
--
ALTER TABLE `purchase_transactions`
  MODIFY `purchase_trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `sales_transactions`
--
ALTER TABLE `sales_transactions`
  MODIFY `sale_trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchase_transactions`
--
ALTER TABLE `purchase_transactions`
  ADD CONSTRAINT `purchase_transactions_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product_details` (`product_id`),
  ADD CONSTRAINT `purchase_transactions_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`);

--
-- Constraints for table `sales_transactions`
--
ALTER TABLE `sales_transactions`
  ADD CONSTRAINT `sales_transactions_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product_details` (`product_id`),
  ADD CONSTRAINT `sales_transactions_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
