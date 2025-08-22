-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2025 at 12:29 PM
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
-- Database: `auonline_merch_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` bigint(20) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_description` text NOT NULL,
  `product_branding_message` text NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_image` text NOT NULL,
  `product_type` varchar(100) NOT NULL,
  `product_status` enum('Available','Sold Out','Limited Stock') NOT NULL DEFAULT 'Available',
  `datetime_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_branding_message`, `product_price`, `product_image`, `product_type`, `product_status`, `datetime_added`) VALUES
(100001, 'CHIEFS Spiral Notebook', 'The perfect companion for jotting down notes, ideas, and to-do lists, the CHIEFS  Spiral Notebook features a sleek and modern design with a durable black cover. Its lightweight structure makes it ideal for students or professionals. Featuring the official \"CHIEFS\" branding from Jose Abad Santos Arellano University, this notebook stands out with its high-quality paper and compact size, perfect for carrying in your bag or backpack.', 'Write Your Legacy, One Page at a Time', 100, 'AU-MERCH-PRODUCT-1-20240907195113.png', 'stationery', 'Available', '2024-09-07 20:14:10'),
(100002, 'CHIEFS Black Signature Tee', 'Show your pride with the CHIEFS Graphic T-Shirt! This comfortable and lightweight black tee is made from 100% soft cotton, featuring a bold black-and-blue \"CHIEFS\" design on the front. Whether you\'re a student, alumni, or a fan, this shirt is perfect for casual wear or as part of your university spirit collection. Available in multiple sizes to fit all Chief\'s fans.', 'Wear Your Pride. Live the CHIEFS Spirit', 250, 'AU-MERCH-PRODUCT-3-20240907195113.png', 'apparel', 'Available', '2024-09-07 20:14:10'),
(100003, 'CHIEFS White Hoodie', 'Stay warm and stylish with the CHIEFS Logo Hoodie! Made from premium, soft, and comfortable fabric, this hoodie showcases the signature \"CHIEFS\" logo in blue and black, giving a sharp, modern look. It\'s perfect for chilly days on campus or when you want to represent Jose Abad Santos Arellano University in comfort. Features a front pocket and adjustable drawstrings for added convenience.', 'Wrap Yourself in CHIEFS Comfort and Pride', 350, 'AU-MERCH-PRODUCT-7-20240907195113.png', 'apparel', 'Available', '2024-09-07 20:14:10'),
(100004, 'CHIEFS Tumbler', 'Keep your drinks at the perfect temperature with the CHIEFS Insulated Tumbler. Whether it\'s a hot coffee to jumpstart your morning or an iced drink to refresh you throughout the day, this tumbler ensures your beverage stays just right. Featuring the official \"CHIEFS\" branding from Jose Abad Santos Arellano University, the sleek, modern design makes it a stylish choice for students and professionals alike. The tumbler is made of high-quality, BPA-free materials and includes a spill-proof lid, making it perfect for travel, class, or the office.', 'Sip in Style, Stay in School Spirit', 450, 'AU-MERCH-PRODUCT-5-20240907195113.png', 'accessories', 'Available', '2024-09-07 20:14:10'),
(100005, 'CHIEFS Stainless Steel Water Bottle', 'Stay hydrated in style with the CHIEFS Stainless Steel Water Bottle. This durable, eco-friendly bottle is designed to keep your drinks cold for up to 24 hours or hot for up to 12 hours. Its sleek design features the official \"CHIEFS\" branding from Jose Abad Santos Arellano University, making it the perfect accessory for students and professionals alike.', 'Hydrate with Pride, Anywhere, Anytime', 350, 'AU-MERCH-PRODUCT-2-20240907195113.png', 'accessories', 'Available', '2024-09-07 20:14:10'),
(100006, 'CHIEFS White Signature Tee', 'Top off your look with the CHIEFS Campus T-Shirt! This adjustable, high-quality tee features the iconic \"CHIEFS \" logo embroidered on the front, showcasing your university pride wherever you go. Made with breathable cotton fabric, this shirt is perfect for sunny days or casual outings. Its comfortable fit ensures it\'s ideal for everyone.', 'Top Off Your Look with CHIEFS Pride', 250, 'AU-MERCH-PRODUCT-4-20240907195113.png', 'apparel', 'Sold Out', '2024-09-07 20:14:10'),
(100007, 'CHIEFS Tote Bag', 'Carry your essentials in style with the CHIEFS Tote Bag! This spacious and sturdy tote features the Jose Abad Santos Arellano University \"CHIEFS\" logo, making it both practical and fashionable for everyday use. Crafted from eco-friendly canvas material, it’s perfect for grocery shopping, study sessions, or a day at the beach.', 'Carry Your Essentials, Carry Your Spirit', 250, 'AU-MERCH-PRODUCT-6-20240907195113.png', 'accessories', 'Available', '2024-09-07 20:14:10'),
(100008, 'CHIEFS Black Hoodie', 'Stay cozy and show your school spirit with the CHIEFS Pullover Sweatshirt! Made from soft, high-quality cotton-blend fabric, this sweatshirt features the bold \"CHIEFS\" logo from Jose Abad Santos Arellano University on the front. Its comfortable fit makes it perfect for lounging, attending classes, or supporting your school during events.', 'Stay Warm, Stay Proud with CHIEFS Comfort', 350, 'AU-MERCH-PRODUCT-8-20240907195113.png', 'apparel', 'Available', '2024-09-07 20:14:10');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `size_id` bigint(250) NOT NULL,
  `product_id` bigint(250) NOT NULL,
  `extra_small` int(50) NOT NULL DEFAULT 20,
  `small` int(50) NOT NULL DEFAULT 20,
  `medium` int(50) NOT NULL DEFAULT 20,
  `large` int(50) NOT NULL DEFAULT 20,
  `extra_large` int(50) NOT NULL DEFAULT 20,
  `extra_long_large` int(50) NOT NULL DEFAULT 20,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`size_id`, `product_id`, `extra_small`, `small`, `medium`, `large`, `extra_large`, `extra_long_large`, `updated_at`) VALUES
(200001, 100002, 20, 20, 20, 20, 20, 20, '0000-00-00 00:00:00'),
(200002, 100003, 20, 20, 20, 20, 20, 20, '0000-00-00 00:00:00'),
(200003, 100008, 20, 20, 20, 20, 20, 20, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users_accounts`
--

CREATE TABLE `users_accounts` (
  `user_id` bigint(20) NOT NULL,
  `user_name` text NOT NULL,
  `user_email` text NOT NULL,
  `user_phone_number` text NOT NULL,
  `user_password` text NOT NULL,
  `user_photo` text NOT NULL DEFAULT 'default-profile.png',
  `user_type` varchar(100) NOT NULL DEFAULT 'user',
  `account_status` varchar(100) NOT NULL DEFAULT 'active',
  `datetime_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_accounts`
--

INSERT INTO `users_accounts` (`user_id`, `user_name`, `user_email`, `user_phone_number`, `user_password`, `user_photo`, `user_type`, `account_status`, `datetime_created`) VALUES
(10001, 'Admin', 'admin@admin.com', '0', 'YWRtaW4xMjM=', 'default-profile.png', 'admin', 'active', '2024-09-08 20:13:20'),
(10005, 'Nicole ', 'nicole@gmail.com', '0', 'bmljb2xlMTIz', 'default-profile.png', 'user', 'active', '2024-09-10 12:53:04'),
(10006, 'Staff', 'staff@gmail.com', '0', 'c3RhZmYxMjM=', 'default-profile.png', 'staff', 'active', '2024-09-08 20:13:20');

-- --------------------------------------------------------

--
-- Table structure for table `users_cart`
--

CREATE TABLE `users_cart` (
  `cart_id` bigint(250) NOT NULL,
  `product_id` bigint(250) NOT NULL,
  `user_id` bigint(250) NOT NULL,
  `quantity` int(100) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_cart`
--

INSERT INTO `users_cart` (`cart_id`, `product_id`, `user_id`, `quantity`, `date_added`) VALUES
(175675, 100007, 10003, 1, '2025-01-11 15:49:17'),
(589284, 100006, 10003, 1, '2025-01-11 15:34:17');

-- --------------------------------------------------------

--
-- Table structure for table `users_order`
--

CREATE TABLE `users_order` (
  `order_id` bigint(250) NOT NULL,
  `product_id` bigint(250) NOT NULL,
  `user_id` bigint(250) NOT NULL,
  `total_price` text NOT NULL,
  `quantity` int(100) NOT NULL,
  `user_phone_number` int(150) NOT NULL,
  `order_status` text NOT NULL,
  `payment_type` varchar(150) NOT NULL DEFAULT 'cash on delivery',
  `gcash_image_receipt` text NOT NULL,
  `gcash_reference_number` text NOT NULL,
  `order_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `users_accounts`
--
ALTER TABLE `users_accounts`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_cart`
--
ALTER TABLE `users_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `users_order`
--
ALTER TABLE `users_order`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100011;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `size_id` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200004;

--
-- AUTO_INCREMENT for table `users_accounts`
--
ALTER TABLE `users_accounts`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10007;

--
-- AUTO_INCREMENT for table `users_cart`
--
ALTER TABLE `users_cart`
  MODIFY `cart_id` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=863345;

--
-- AUTO_INCREMENT for table `users_order`
--
ALTER TABLE `users_order`
  MODIFY `order_id` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
