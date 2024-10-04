-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2024 at 03:48 PM
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
-- Database: `plant`
--

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `id` int(11) NOT NULL,
  `plant_name` varchar(255) NOT NULL,
  `plant_description` text NOT NULL,
  `plant_type` varchar(100) NOT NULL,
  `plant_size` varchar(50) NOT NULL,
  `plant_color` varchar(50) NOT NULL,
  `plant_image` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`id`, `plant_name`, `plant_description`, `plant_type`, `plant_size`, `plant_color`, `plant_image`, `uploaded_at`) VALUES
(1, 'Gumamela', 'Imported', 'Aquatic', 'Small', 'Red', 'uploads/66fee28e87e810.83792240.png', '2024-10-03 18:29:34'),
(2, 'Gumamela', 'Imported', 'Aquatic', 'Small', 'Red', 'uploads/66fee37f0da139.27752054.png', '2024-10-03 18:33:35'),
(3, 'Gumamela', 'Imported', 'Flowers', 'Small', 'Red', 'uploads/66fee3d65ccdd0.17375516.png', '2024-10-03 18:35:02'),
(4, 'Gumamelaaaaa', 'Importedd', 'Flowers', 'Small', 'Red', 'uploads/66fee3df9fb7c9.66460331.png', '2024-10-03 18:35:11'),
(5, 'Takaheru', 'Japanich', 'Aquatic', 'Small', 'Green', 'uploads/66fee3ff97c2e1.28235794.png', '2024-10-03 18:35:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
