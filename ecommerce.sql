-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2025 at 12:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `status`, `created_at`) VALUES
(1, 2, 1201.08, 'Pending', '2025-09-16 07:23:05'),
(2, 3, 4410.00, 'Pending', '2025-09-16 09:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 1, 1200.00),
(2, 1, 7, 1, 1.08),
(3, 2, 31, 3, 600.00),
(4, 2, 22, 2, 180.00),
(5, 2, 18, 1, 1400.00),
(6, 2, 30, 1, 500.00),
(7, 2, 29, 1, 350.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `category`, `stock`, `description`) VALUES
(1, 'Gaming Laptop', 1200.00, 'laptop1.avif', 'Laptops', 5, 'High performance gaming laptop'),
(2, 'Mechanical Keyboard', 80.00, 'keyboard2.avif', 'Keyboards', 20, 'RGB backlit mechanical keyboard'),
(3, 'Wireless Mouse', 25.00, 'mouse.avif', 'Mouse', 50, 'Ergonomic wireless mouse'),
(4, '27\" Monitor', 200.00, 'monitor2.avif', 'Monitors', 15, 'Full HD IPS display'),
(5, 'Noise Cancelling Headphones', 150.00, 'headfones.avif', 'Headphones', 10, 'Wireless headphones'),
(6, 'Gaming Laptop', 0.12, 'laptop2.avif', 'Laptop', 10, 'Fully gaming laptop'),
(7, 'Gaming Laptop', 1.08, 'laptop1.avif', 'Laptop', 10, 'Fully fast'),
(16, 'Gaming Laptop Pro', 1500.00, 'laptop5.jpg', NULL, 10, 'High-end gaming laptop with advanced cooling.'),
(17, 'Gaming Laptop Ultra', 1800.00, 'laptop6.jpg', NULL, 5, 'Latest gaming laptop with RTX graphics.'),
(18, 'Gaming Laptop Slim', 1400.00, 'laptop7.jpg', NULL, 10, 'Slim design laptop with powerful performance.'),
(19, 'Gaming Laptop Max', 2000.00, 'laptop8.jpg', NULL, 15, 'Ultimate gaming laptop for professionals.'),
(20, 'Mechanical Keyboard Classic', 120.00, 'keyboard4.avif', NULL, 10, 'Durable mechanical keyboard with blue switches.'),
(21, 'RGB Gaming Keyboard', 150.00, 'keyboard5.avif', NULL, 8, 'RGB backlit mechanical keyboard for gamers.'),
(22, 'Wireless Mechanical Keyboard', 180.00, 'keyboard6.avif', NULL, 3, 'Portable wireless keyboard with long battery life.'),
(23, 'Ergonomic Keyboard Pro', 200.00, 'keyboard7.avif', NULL, 20, 'Ergonomic design mechanical keyboard for comfort.'),
(24, 'Wireless Gaming Mouse', 60.00, 'mouse4.avif', NULL, 7, 'Ergonomic wireless mouse with 6 programmable buttons.'),
(25, 'RGB Gaming Mouse', 80.00, 'mouse5.avif', NULL, 17, 'High precision RGB mouse with 16000 DPI sensor.'),
(26, 'Lightweight FPS Mouse', 70.00, 'mouse6.avif', NULL, 9, 'Ultra-light mouse designed for FPS gamers.'),
(27, 'Pro Esports Mouse', 100.00, 'mouse.avif', NULL, 10, 'Professional grade mouse used by esports players.'),
(28, '24-inch Office Monitor', 200.00, 'monitor4.avif', NULL, 11, 'Full HD 24-inch monitor for office productivity.'),
(29, '27-inch Curved Gaming Monitor', 350.00, 'monitor5.avif', NULL, 4, 'Immersive curved monitor with 144Hz refresh rate.'),
(30, '32-inch 4K Monitor', 500.00, 'monitor6.avif', NULL, 13, 'High resolution 4K UHD display for professionals.'),
(31, 'UltraWide Monitor 34-inch', 600.00, 'monitor7.avif', NULL, 25, 'UltraWide screen for multitasking and gaming.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Kamran Ali', 'kamranmirjat778@gmail.com', '$2y$10$5YYrdHqJe5A27lVKBpKR9uPyk7zkmMAaIDnLTSwC2x.iD2GLUrwVS', '2025-09-15 13:47:36'),
(2, 'Kamran Ali', 'kamranmirjat786@gmail.com', '$2y$10$p0ib42fvx4jIFbq5FtpsrOwargGUray7rSgsVMm3LF1pxGGw4t4OO', '2025-09-16 07:23:00'),
(3, 'Kamran Ali', 'kamramjat@gmail.com', '$2y$10$oENjsJzCvYlJP3D.KXORSuvrEOg04qpRKbvWYz5UA3EhcCqQngyyu', '2025-09-16 09:42:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
