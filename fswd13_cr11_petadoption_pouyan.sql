-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 21, 2021 at 04:03 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fswd13_cr11_petadoption_pouyan`
--
CREATE DATABASE IF NOT EXISTS `fswd13_cr11_petadoption_pouyan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fswd13_cr11_petadoption_pouyan`;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `pic_animal` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`id`, `name`, `location`, `description`, `hobbies`, `size`, `age`, `breed`, `pic_animal`) VALUES
(3, 'Chili', 'Linz', 'Cute ', 'Playing', 'Small', 4, 'Cat', 'c3.jpg'),
(4, 'Dora', 'Musterst 3', 'Cute', 'Sleeing', 'Small', 4, 'Cat', 'c1.jpg'),
(5, 'Srio', 'Wienstreet 22', 'Cute', 'Playing', 'Small', 5, 'Cat', 'c2.jpg'),
(6, 'Meshki', 'Leopoldau 12', 'Cute', 'Playing', 'Small', 9, 'Cat', 'c4.jpg'),
(7, 'Nora', 'Westbahhof 12', 'Cute', 'Sleeping', 'Small', 9, 'Dog', 'd1.jpg'),
(8, 'Shipo', 'Terastreet 12', 'Cute', 'Playing', 'Larg', 6, 'Dog', 'd2.jpg'),
(9, 'Mishi', 'Hasstreet 13', 'Cute', 'Playing', 'Larg', 9, 'Dog', 'd3.jpg'),
(10, 'Kira', 'Malostreet 72', 'Cute', 'Playing', 'Larg', 1, 'Dog', 'd4.jpg'),
(11, 'Naghi', 'urastreet 23', 'Cute', 'Playing', 'Larg', 10, 'Dog', 'd5.jpg'),
(12, 'Tara', 'Giostreet 12', 'Cute', 'Playing', 'Larg', 6, 'Dog', 'd6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `password`, `email`, `address`, `phone_number`, `picture`, `status`) VALUES
(1, 'john', 'doe', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'john@gmail.com', 'musterstreet 12', '432323133', NULL, 'adm'),
(2, 'salam', 'saasdf', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'asdf@gmail.com', '', '', 'avatar.png', 'user'),
(3, 'qwer', 'qwer', '61af973f00613a1af52703b8518c3ac34bd62b5a7bf8d84c242462b1e36f0173', 'zvc@gmail.com', '', '', 'avatar.png', 'user'),
(4, 'asdf', 'asdf', 'cfa7972721c6edb01652a3d0fed4b470ccd74a69877857f1d9a8bd489c2c1674', 'xcv@gmail.com', '', '', '1629476615avatar.png', 'user'),
(5, 'qwer', 'qwer', 'd326a3f1fa8f212da0ef393fecd8148b4d2ecbb29cf6120459ccdf8b78aed7b8', 'qwer@gmail.com', '', '', 'avatar.png', 'user'),
(6, 'zxcv', 'zxcv', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'zxcv@gmail.com', 'zxcvzxcvzxcv', '123412341', 'avatar.png', 'user'),
(7, 'dara', 'doe', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'dara@gmail.com', 'asdf', '1231245', 'avatar.png', 'user'),
(8, 'rad', 'rad', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'rad@gmail.com', 'qwe', '123123', 'avatar.png', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
