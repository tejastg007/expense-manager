-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2021 at 08:11 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expense_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(100) NOT NULL,
  `cat_name` varchar(50) DEFAULT NULL,
  `user_id` int(100) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cat_name`, `user_id`, `created_at`) VALUES
(13, 'grocery', 6, '2021-10-16'),
(14, 'stationary', 6, '2021-10-16'),
(15, 'junk food', 6, '2021-10-16'),
(16, 'travel', 6, '2021-10-16'),
(17, 'grocery', 5, '2021-10-16'),
(18, 'travel', 5, '2021-10-16');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(100) NOT NULL,
  `cat_id` int(100) DEFAULT NULL,
  `user_id` int(100) DEFAULT NULL,
  `amount` int(255) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `cat_id`, `user_id`, `amount`, `description`, `created_at`) VALUES
(20, 15, 6, 50, 'Inventore exercitati', '2021-10-16'),
(21, 14, 6, 93, 'Rerum temporibus vel', '2021-10-16'),
(22, 13, 6, 39, 'Consectetur deserunt', '2021-10-16'),
(23, 13, 6, 95, 'Consectetur ducimus', '2021-10-16'),
(24, 14, 6, 55, 'Officia expedita aut', '2021-10-16'),
(25, 13, 6, 83, 'Est qui nisi tempor', '2021-10-16'),
(26, 14, 6, 30, 'Exercitation quam ve', '2021-10-16'),
(27, 15, 6, 38, 'Facere ut do dolorib', '2021-10-16'),
(28, 15, 6, 83, 'Repudiandae perferen', '2021-10-16'),
(29, 16, 6, 50, 'trave updated', '2021-10-16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(5, 'tejastg', 'tejastg@gmail.com', '$2y$10$ebot66S64rMxlUrC4PArT.XZAQBQnBbLpTNrL5afHvCSrredgHXAG', '2021-10-16'),
(6, 'tejas', 'tejas@gmail.com', '$2y$10$ybxQ4TXa895Y6ycZ.h/vD.nLatIXFSuAkphN3zN.xaMMj3EdmfODm', '2021-10-16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `expenses_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
