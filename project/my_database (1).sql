-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 21, 2025 at 02:34 PM
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
-- Database: `my_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `acc_id` int(11) NOT NULL,
  `acc_name` varchar(50) NOT NULL,
  `acc_password` varchar(50) NOT NULL,
  `acc_status` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_id`, `acc_name`, `acc_password`, `acc_status`, `product_id`) VALUES
(3, 'abcccc', 'a123444', 0, 17);

-- --------------------------------------------------------

--
-- Table structure for table `buy_history`
--

CREATE TABLE `buy_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_username` varchar(100) NOT NULL,
  `game_password` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buy_history`
--

INSERT INTO `buy_history` (`id`, `user_id`, `game_username`, `game_password`, `price`, `date`) VALUES
(12, 14, 'aaaa', 'a123', 5, '2025-01-21 17:40:43'),
(13, 14, 'aaaa', 'a123', 5, '2025-01-21 17:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `payment_slips`
--

CREATE TABLE `payment_slips` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `slip_image` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_slips`
--

INSERT INTO `payment_slips` (`id`, `user_id`, `slip_image`, `amount`, `status`, `created_at`) VALUES
(1, 14, 'slips/slip.jpg', 10.00, 'approved', '2024-09-25 08:52:46'),
(2, 14, 'slips/slip.jpg', 500.00, 'approved', '2024-09-25 09:07:52'),
(3, 14, 'slips/IMG_2237.JPG', 5000.00, 'rejected', '2024-09-25 11:09:23'),
(4, 14, 'slips/miniproject.png', 100.00, 'approved', '2024-09-25 11:11:45'),
(5, 14, 'slips/moobod.png', 120.00, 'rejected', '2024-12-17 18:19:25'),
(6, 14, 'slips/whyuscanbro_qrcode.png', 500.00, 'approved', '2025-01-21 10:59:16'),
(7, 4, 'slips/moobod.png', 533.00, 'approved', '2025-01-21 11:20:50'),
(8, 4, 'slips/GYuDmlyXoAEC2Fa.jpg', 120.00, 'rejected', '2025-01-21 11:22:10');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` int(50) NOT NULL,
  `type_id` int(11) NOT NULL,
  `product_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `type_id`, `product_img`) VALUES
(17, 'aa', 100, 7, 'product/ascendant.png');

-- --------------------------------------------------------

--
-- Table structure for table `producttype`
--

CREATE TABLE `producttype` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `type_desc` varchar(100) NOT NULL,
  `type_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producttype`
--

INSERT INTO `producttype` (`type_id`, `type_name`, `type_desc`, `type_img`) VALUES
(7, 'ฟหกฟหก', 'ฟหกหก', 'typeImg/rank.png');

-- --------------------------------------------------------

--
-- Table structure for table `slip_history`
--

CREATE TABLE `slip_history` (
  `sh_id` int(11) NOT NULL,
  `sh_adminId` int(50) NOT NULL,
  `sh_slipId` int(50) NOT NULL,
  `sh_action` varchar(50) NOT NULL,
  `sh_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slip_history`
--

INSERT INTO `slip_history` (`sh_id`, `sh_adminId`, `sh_slipId`, `sh_action`, `sh_date`) VALUES
(1, 14, 6, 'Approve', '2025-01-21 18:09:53'),
(2, 14, 7, 'Approve', '2025-01-21 18:21:08'),
(3, 14, 8, 'Reject', '2025-01-21 18:22:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `created_at`, `point`) VALUES
(4, 'ddd', '$2y$10$P5qCpoK5g0eRdu8Te19WZ.uWPZI.LJcv.k0uiBxdYw7sc.YD8lnN2', 'dd@gmail.com', 'user', '2024-09-20 03:31:04', 733),
(5, 'lear', '$2y$10$sMkOAm9zwaBws2fKaAFhcek6o3CTtDhkyYd92TXwc2tf1pkR/krK6', 'eiei@gmail.com', 'user', '2024-09-20 05:27:45', 0),
(7, 'wan', '$2y$10$j6riTIzvWo9ZvNnh8zKaR.gWQc/cAdaUC.HDqzahcufPjNLmA3tCy', 'wan@gmail.com', 'user', '2024-09-21 12:15:22', 0),
(11, 'tesths', '$2y$10$4ncHGkniwVECVhcoo2dmh.zla6xIi0J3An5hPBUlGTYtxeXwYLkCu', 'testsh@gmail.com', 'user', '2024-09-24 03:42:16', 5000),
(12, 'koyomi', '$2y$10$iIsekew59mdy0jVzQuB0r.S1HJKRIIlJujs63fpYZ0tyIlNqXMZIq', 'koyomi@gmail.com', 'user', '2024-09-24 04:18:34', 2000),
(13, '7', '$2y$10$T2evfqN9kAntKZbAy39L2ee7oGNZy06kBL.7WCMOBKc6X9lSp2ckO', 'tyr@gmail.com', 'user', '2024-09-24 09:24:21', 0),
(14, 'pupparn', '$2y$10$QTlo5H7ZiBSkegM.UyPQFenz60GYW/KvcJYbc1fzGGHzUxeMKNlPe', 'natthawat.wk@gmail.com', 'admin', '2024-09-25 07:27:50', 1570),
(15, 'pupparn jr.', '$2y$10$LYKXFxyT7PDFl13M5vX/POMHSQ2bsiJda0BJWO9EuHmsnaRYXs62O', 'asdasd@gmail.com', 'admin', '2024-12-17 16:21:17', 150);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `buy_history`
--
ALTER TABLE `buy_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_slips`
--
ALTER TABLE `payment_slips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `producttype`
--
ALTER TABLE `producttype`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `slip_history`
--
ALTER TABLE `slip_history`
  ADD PRIMARY KEY (`sh_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `idx_username` (`username`),
  ADD UNIQUE KEY `idx_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `buy_history`
--
ALTER TABLE `buy_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payment_slips`
--
ALTER TABLE `payment_slips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `producttype`
--
ALTER TABLE `producttype`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `slip_history`
--
ALTER TABLE `slip_history`
  MODIFY `sh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment_slips`
--
ALTER TABLE `payment_slips`
  ADD CONSTRAINT `payment_slips_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
