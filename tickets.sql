-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 09, 2023 at 11:05 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tickets`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `cheapest`
-- (See below for the actual view)
--
CREATE TABLE `cheapest` (
`eventID` int
,`lowest_value` float
);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `location`, `date`) VALUES
(1, 'Travis Scott', 'Koncert Travisa Scotta w Poznań, Poland', 'Poznań', '2023-11-29'),
(2, 'The Weeknd', 'Koncert The Weeknd w Poznań, Poland', 'Poznań', '2023-11-09'),
(3, 'Pitbull', 'Koncert Pitbull w Poznań, Poland', 'Poznań', '2023-12-15'),
(4, 'Drake', 'Koncert Drake w Poznań, Poland', 'Poznań', '2024-01-20'),
(5, 'Future', 'Koncert Future w Poznań, Poland', 'Poznań', '2024-01-25');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgID` int NOT NULL,
  `src` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `eventID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgID`, `src`, `eventID`) VALUES
(1, 'travis.jpg', 1),
(2, 'weeknd.jpg', 2),
(3, 'pitbull.webp', 3),
(4, 'future.jpg', 5),
(5, 'drake.webp', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int NOT NULL,
  `userName` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `eventName` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `eventID` int NOT NULL,
  `ticketPrice` float NOT NULL,
  `ticketName` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ticketDate` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `userName`, `eventName`, `eventID`, `ticketPrice`, `ticketName`, `ticketDate`) VALUES
(1, 'magic123', 'Pitbull', 3, 350, 'Standard Ticket', '2023-11-09 20:34:12'),
(24, 'admin', 'Drake', 4, 1000, 'Gold Ticket', ''),
(25, 'admin', 'The Weeknd', 2, 700, 'VIP Ticket', ''),
(26, 'admin', 'Pitbull', 3, 1000, 'VIP+ Ticket', ''),
(27, 'magic123', 'Pitbull', 3, 350, 'Standard Ticket', '2023-11-09 21:30:55'),
(28, 'magic123', 'Pitbull', 3, 350, 'Standard Ticket', '2023-11-09 22:30:55'),
(29, 'magic123', 'Drake', 4, 1000, 'Gold Ticket', '2023-11-09 22:58:58'),
(30, 'magic123', 'Pitbull', 3, 1000, 'VIP+ Ticket', '2023-11-09 23:01:18'),
(31, 'magic123', 'Pitbull', 3, 1000, 'VIP+ Ticket', '2023-11-09 23:02:49');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticketID` int NOT NULL,
  `eventID` int NOT NULL,
  `ticketName` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` float NOT NULL,
  `quantity` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticketID`, `eventID`, `ticketName`, `price`, `quantity`) VALUES
(1, 1, 'Standard Ticket', 300, 1000),
(2, 1, 'Gold Ticket', 600, 800),
(3, 2, 'Standard Ticket', 299.99, 1200),
(4, 2, 'VIP Ticket', 700, 1100),
(5, 3, 'Standard Ticket', 350, 1300),
(6, 3, 'VIP Ticket', 500, 900),
(7, 3, 'VIP+ Ticket', 1000, 500),
(8, 4, 'Gold Ticket', 1000, 540),
(9, 5, 'Standard Ticket', 420, 1500),
(10, 4, 'Standard Ticket', 400, 1250);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `phone`) VALUES
(8, '', '', ''),
(5, 'zaq1@WSX', 'zaq1@WSX', '111111111'),
(7, 'magic123', 'zaq1@WSX', '111111111'),
(9, 'azazaz', 'zaq1@WSX', '222222222'),
(10, 'azazaz1', 'zaq1@WSX', '222222222'),
(11, 'azazaz12', 'zaq1@WSX', '222222222'),
(12, 'azazaz123', 'zaq1@WSX', '222222222'),
(13, 'zaqzaq', 'zaq1@WSX', '12446778899'),
(14, 'admin', 'admin', ''),
(15, 'chokemedaddy1', '$2y$10$c.DAon0mwmA6709IRLOZ5.uHv02Z3HiUWqUphxKyzVoChtD3g4kcO', '111111111');

-- --------------------------------------------------------

--
-- Structure for view `cheapest`
--
DROP TABLE IF EXISTS `cheapest`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cheapest`  AS SELECT `eventID` AS `eventID`, min(`price`) AS `lowest_value` FROM `tickets` GROUP BY `eventID` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
