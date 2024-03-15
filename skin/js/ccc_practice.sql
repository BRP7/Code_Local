-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2024 at 11:51 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ccc_catalog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(100) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `password`) VALUES
(1, 'admin@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `banner_id` int(11) NOT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `show_on` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`banner_id`, `banner_image`, `status`, `show_on`) VALUES
(1, '1385175.jpg', 1, 'vivek'),
(2, 'b1.jpeg', 0, 'Homepage'),
(3, 'photocomposition-horizontal-shopping-banner-with-woman-big-smartphone.jpg', 1, 'Homepage'),
(4, 'flowchart.png', 0, 'abc');

-- --------------------------------------------------------

--
-- Table structure for table `catalog_category`
--

CREATE TABLE `catalog_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catalog_category`
--

INSERT INTO `catalog_category` (`category_id`, `category_name`, `status`) VALUES
(1, 'SUV', 0),
(2, 'Hatchback', 1),
(3, 'Sedan', 1),
(4, 'Convertible', 0),
(5, 'Super Car', 1);

-- --------------------------------------------------------

--
-- Table structure for table `catalog_product`
--

CREATE TABLE `catalog_product` (
  `product_id` int(11) NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_link` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `mfr_cost` decimal(12,2) DEFAULT NULL,
  `shipping_cost` decimal(12,2) DEFAULT NULL,
  `total_cost` decimal(12,2) DEFAULT NULL,
  `margin_percentage` int(11) DEFAULT NULL,
  `min_price` decimal(12,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catalog_product`
--

INSERT INTO `catalog_product` (`product_id`, `sku`, `name`, `color`, `size`, `description`, `image_link`, `link`, `category_id`, `price`, `mfr_cost`, `shipping_cost`, `total_cost`, `margin_percentage`, `min_price`, `status`) VALUES
(3, 'SKU003', 'harrier', 'black', 'big', 'This is the description for Product 3', 'Harrier.png', 'https://example.com/product3', 1, '4000000.00', '25.00', '4.00', '29.00', 28, '35.00', 0),
(4, 'SKU004', 'Lamboghini', 'white', 'large', 'This is the description for Product 4', 'lamboghini.webp', 'https://example.com/product4', 3, '60000000.00', '35.00', '6.00', '41.00', 32, '50.00', 0),
(5, 'SKU005', 'Rang Rover', 'snow weight', 'Medium', 'This is the description for Product 5', 'rang_rover.jpeg', 'https://example.com/product5', 1, '80000000.00', '50.00', '8.00', '58.00', 35, '70.00', 0),
(6, 'SKU006', 'Supra', 'White', 'Small', 'This is the description for Product 6', 'supra.jpeg', 'https://example.com/product6', 5, '45000000.00', '28.00', '4.50', '32.50', 29, '40.00', 0),
(7, 'SKU007', 'Fortuner', 'white', 'Large', 'This is the description for Product 7', 'fortuner.png', 'https://example.com/product7', 1, '5500000.00', '33.00', '5.50', '38.50', 31, '45.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ccc_loan_calculator`
--

CREATE TABLE `ccc_loan_calculator` (
  `id` int(11) NOT NULL,
  `session_id` varchar(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `loan_amount` int(11) NOT NULL,
  `monthly_amount` float(10,2) NOT NULL,
  `bank_code` int(11) NOT NULL,
  `term` int(11) NOT NULL,
  `result` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ccc_temp_converter`
--

CREATE TABLE `ccc_temp_converter` (
  `id` int(100) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `temprature` float NOT NULL,
  `unit` varchar(255) NOT NULL,
  `convert_unit` varchar(255) NOT NULL,
  `result` float NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ccc_temp_converter`
--

INSERT INTO `ccc_temp_converter` (`id`, `session_id`, `user_name`, `temprature`, `unit`, `convert_unit`, `result`, `created_at`) VALUES
(1, '3j22stgtac76jnhaqei80ot5p2', 'vivek', 12, 'Celsius', '', 0, '2024-03-12'),
(2, '3j22stgtac76jnhaqei80ot5p2', 'vivek', 100, 'Fahrenheit', '', 0, '2024-03-12'),
(3, '3j22stgtac76jnhaqei80ot5p2', 'vivek', 100, 'Celsius', 'Celsius', 100, '2024-03-12'),
(4, '3j22stgtac76jnhaqei80ot5p2', 'vivek', 100, 'Celsius', 'Fahrenheit', 212, '2024-03-12'),
(5, '3j22stgtac76jnhaqei80ot5p2', 'vivek', 100, 'Kelvin', 'Fahrenheit', -279.67, '2024-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `billing_address` varchar(255) DEFAULT NULL,
  `billing_city` varchar(255) DEFAULT NULL,
  `billing_region` int(11) DEFAULT NULL,
  `billing_country` int(11) DEFAULT NULL,
  `billing_phone` varchar(255) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `shipping_city` varchar(255) DEFAULT NULL,
  `shipping_region` int(11) DEFAULT NULL,
  `shipping_country` int(11) DEFAULT NULL,
  `shipping_phone` varchar(255) DEFAULT NULL,
  `default` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_email`, `first_name`, `last_name`, `password`, `billing_address`, `billing_city`, `billing_region`, `billing_country`, `billing_phone`, `shipping_address`, `shipping_city`, `shipping_region`, `shipping_country`, `shipping_phone`, `default`) VALUES
(1, 'vivek@gmail.com', 'vivek', 'kalariya', '123', 'abc', 'abc', 0, 0, '1234567890', 'abc', 'abc', 0, 0, 'abc', 1),
(2, 'devendra@gmail.com', '', '', '123', '', '', 0, 0, '', '', '', 0, 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `address_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `billing_address` varchar(255) NOT NULL,
  `billing_city` varchar(255) NOT NULL,
  `billing_region` int(11) NOT NULL,
  `billing_country` int(11) NOT NULL,
  `billing_phone` varchar(255) NOT NULL,
  `shipping_address` text NOT NULL,
  `shipping_city` varchar(255) NOT NULL,
  `shipping_region` int(11) NOT NULL,
  `shipping_country` int(11) NOT NULL,
  `shipping_phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`address_id`, `customer_id`, `billing_address`, `billing_city`, `billing_region`, `billing_country`, `billing_phone`, `shipping_address`, `shipping_city`, `shipping_region`, `shipping_country`, `shipping_phone`) VALUES
(1, 1, 'abc', 'abc', 1, 1, 'abc', 'abc', 'abc', 1, 1, 'abc'),
(2, 1, 'xyz', 'xyz', 3, 3, 'xyz', 'xyz', 'xyz', 3, 3, 'xyz');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `order_id` int(100) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `tax_percent` int(11) DEFAULT NULL,
  `grand_total` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`order_id`, `payment_id`, `shipping_id`, `order_number`, `tax_percent`, `grand_total`) VALUES
(1, 1, 1, '2642934', 8, '4500000.00'),
(2, 0, 0, '9611862', 8, '50625000.00'),
(3, 2, 2, '7658315', 8, '50625000.00'),
(4, 3, 3, '9719164', 8, '4500000.00');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_customer`
--

CREATE TABLE `sales_order_customer` (
  `order_customer_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `billing_address` varchar(255) DEFAULT NULL,
  `billing_city` varchar(255) DEFAULT NULL,
  `billing_region` int(11) DEFAULT NULL,
  `billing_country` int(11) DEFAULT NULL,
  `billing_phone` varchar(255) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `shipping_city` varchar(255) DEFAULT NULL,
  `shipping_region` int(11) DEFAULT NULL,
  `shipping_country` int(11) DEFAULT NULL,
  `shipping_phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_order_customer`
--

INSERT INTO `sales_order_customer` (`order_customer_id`, `order_id`, `customer_id`, `email`, `billing_address`, `billing_city`, `billing_region`, `billing_country`, `billing_phone`, `shipping_address`, `shipping_city`, `shipping_region`, `shipping_country`, `shipping_phone`) VALUES
(1, 1, 1, 'vivek@gmail.com', 'xyz', 'xyz', 3, 3, 'xyz', 'abc', 'abc', 1, 1, 'abc'),
(2, 3, 1, 'vivek@gmail.com', 'abc', 'abc', 1, 1, 'abc', 'abc', 'abc', 1, 1, 'abc'),
(3, 4, 1, 'vivek@gmail.com', 'abc', 'abc', 1, 1, 'abc', 'abc', 'abc', 1, 1, 'abc');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_item`
--

CREATE TABLE `sales_order_item` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `row_total` decimal(12,2) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_order_item`
--

INSERT INTO `sales_order_item` (`item_id`, `order_id`, `product_id`, `price`, `qty`, `row_total`, `product_name`, `product_color`) VALUES
(1, 1, 3, '4000000.00', 1, '4000000.00', 'harrier', 'black'),
(2, 3, 6, '45000000.00', 1, '45000000.00', 'Supra', 'White'),
(3, 4, 3, '4000000.00', 1, '4000000.00', 'harrier', 'black');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_payment_method`
--

CREATE TABLE `sales_order_payment_method` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `card_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_order_payment_method`
--

INSERT INTO `sales_order_payment_method` (`payment_id`, `order_id`, `payment_method`, `card_number`) VALUES
(1, 1, 'cod', 0),
(2, 3, 'card', 0),
(3, 4, 'card', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_shipping_method`
--

CREATE TABLE `sales_order_shipping_method` (
  `shipping_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `shipping_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_order_shipping_method`
--

INSERT INTO `sales_order_shipping_method` (`shipping_id`, `order_id`, `shipping_method`) VALUES
(1, 1, 'same_day'),
(2, 3, 'normal_day'),
(3, 4, 'normal_day');

-- --------------------------------------------------------

--
-- Table structure for table `sales_quote`
--

CREATE TABLE `sales_quote` (
  `quote_id` int(11) NOT NULL,
  `tax_percent` int(11) DEFAULT NULL,
  `grand_total` decimal(12,2) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `shipping_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_quote`
--

INSERT INTO `sales_quote` (`quote_id`, `tax_percent`, `grand_total`, `order_id`, `payment_id`, `shipping_id`) VALUES
(1, 8, '4500000.00', 1, 1, 1),
(2, 8, '4500000.00', 0, 0, 0),
(3, 8, '50625000.00', 3, 2, 2),
(4, 8, '4500000.00', 4, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sales_quote_customer`
--

CREATE TABLE `sales_quote_customer` (
  `quote_customer_id` int(11) NOT NULL,
  `quote_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `billing_address` varchar(255) DEFAULT NULL,
  `billing_city` varchar(255) DEFAULT NULL,
  `billing_region` int(11) DEFAULT NULL,
  `billing_country` int(11) DEFAULT NULL,
  `billing_phone` varchar(255) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `shipping_city` varchar(255) DEFAULT NULL,
  `shipping_region` int(11) DEFAULT NULL,
  `shipping_country` int(11) DEFAULT NULL,
  `shipping_phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_quote_customer`
--

INSERT INTO `sales_quote_customer` (`quote_customer_id`, `quote_id`, `customer_id`, `email`, `billing_address`, `billing_city`, `billing_region`, `billing_country`, `billing_phone`, `shipping_address`, `shipping_city`, `shipping_region`, `shipping_country`, `shipping_phone`) VALUES
(1, 1, 1, 'vivek@gmail.com', 'xyz', 'xyz', 3, 3, 'xyz', 'abc', 'abc', 1, 1, 'abc'),
(2, 4, 1, 'vivek@gmail.com', 'abc', 'abc', 1, 1, 'abc', 'abc', 'abc', 1, 1, 'abc');

-- --------------------------------------------------------

--
-- Table structure for table `sales_quote_item`
--

CREATE TABLE `sales_quote_item` (
  `item_id` int(11) NOT NULL,
  `quote_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `row_total` decimal(12,2) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_quote_item`
--

INSERT INTO `sales_quote_item` (`item_id`, `quote_id`, `product_id`, `price`, `qty`, `row_total`, `customer_id`) VALUES
(1, 1, 3, '4000000.00', 1, '4000000.00', NULL),
(2, 2, 3, '4000000.00', 1, '4000000.00', 1),
(3, 3, 6, '45000000.00', 1, '45000000.00', 1),
(4, 4, 3, '4000000.00', 1, '4000000.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_quote_payment_method`
--

CREATE TABLE `sales_quote_payment_method` (
  `payment_id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `card_number` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_quote_payment_method`
--

INSERT INTO `sales_quote_payment_method` (`payment_id`, `quote_id`, `payment_method`, `card_number`) VALUES
(1, 1, 'cod', 0),
(2, 3, 'card', 0),
(3, 4, 'card', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sales_quote_shipping_method`
--

CREATE TABLE `sales_quote_shipping_method` (
  `shipping_id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `shipping_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_quote_shipping_method`
--

INSERT INTO `sales_quote_shipping_method` (`shipping_id`, `quote_id`, `shipping_method`) VALUES
(1, 1, 'same_day'),
(2, 3, 'normal_day'),
(3, 4, 'normal_day');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `catalog_category`
--
ALTER TABLE `catalog_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `catalog_product`
--
ALTER TABLE `catalog_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `FOREIGN` (`category_id`);

--
-- Indexes for table `ccc_loan_calculator`
--
ALTER TABLE `ccc_loan_calculator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ccc_temp_converter`
--
ALTER TABLE `ccc_temp_converter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `sales_order_customer`
--
ALTER TABLE `sales_order_customer`
  ADD PRIMARY KEY (`order_customer_id`);

--
-- Indexes for table `sales_order_item`
--
ALTER TABLE `sales_order_item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `sales_order_payment_method`
--
ALTER TABLE `sales_order_payment_method`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `sales_order_shipping_method`
--
ALTER TABLE `sales_order_shipping_method`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Indexes for table `sales_quote`
--
ALTER TABLE `sales_quote`
  ADD PRIMARY KEY (`quote_id`);

--
-- Indexes for table `sales_quote_customer`
--
ALTER TABLE `sales_quote_customer`
  ADD PRIMARY KEY (`quote_customer_id`);

--
-- Indexes for table `sales_quote_item`
--
ALTER TABLE `sales_quote_item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `quote_id` (`quote_id`);

--
-- Indexes for table `sales_quote_payment_method`
--
ALTER TABLE `sales_quote_payment_method`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `qoute_id` (`quote_id`);

--
-- Indexes for table `sales_quote_shipping_method`
--
ALTER TABLE `sales_quote_shipping_method`
  ADD PRIMARY KEY (`shipping_id`),
  ADD KEY `sales_quote_shipping_method_ibfk_1` (`quote_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `catalog_category`
--
ALTER TABLE `catalog_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `catalog_product`
--
ALTER TABLE `catalog_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `ccc_loan_calculator`
--
ALTER TABLE `ccc_loan_calculator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ccc_temp_converter`
--
ALTER TABLE `ccc_temp_converter`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales_order_customer`
--
ALTER TABLE `sales_order_customer`
  MODIFY `order_customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales_order_item`
--
ALTER TABLE `sales_order_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales_order_payment_method`
--
ALTER TABLE `sales_order_payment_method`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales_order_shipping_method`
--
ALTER TABLE `sales_order_shipping_method`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales_quote`
--
ALTER TABLE `sales_quote`
  MODIFY `quote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales_quote_customer`
--
ALTER TABLE `sales_quote_customer`
  MODIFY `quote_customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales_quote_item`
--
ALTER TABLE `sales_quote_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales_quote_payment_method`
--
ALTER TABLE `sales_quote_payment_method`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales_quote_shipping_method`
--
ALTER TABLE `sales_quote_shipping_method`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales_quote_item`
--
ALTER TABLE `sales_quote_item`
  ADD CONSTRAINT `sales_quote_item_ibfk_1` FOREIGN KEY (`quote_id`) REFERENCES `sales_quote` (`quote_id`);

--
-- Constraints for table `sales_quote_payment_method`
--
ALTER TABLE `sales_quote_payment_method`
  ADD CONSTRAINT `sales_quote_payment_method_ibfk_1` FOREIGN KEY (`quote_id`) REFERENCES `sales_quote` (`quote_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales_quote_shipping_method`
--
ALTER TABLE `sales_quote_shipping_method`
  ADD CONSTRAINT `sales_quote_shipping_method_ibfk_1` FOREIGN KEY (`quote_id`) REFERENCES `sales_quote` (`quote_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
