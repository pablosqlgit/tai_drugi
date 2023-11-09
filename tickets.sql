-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Lis 2023, 11:26
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `tickets`
--

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `cheapest`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `cheapest` (
`eventID` int(11)
,`lowest_value` float
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `location`, `date`) VALUES
(1, 'Travis Scott ', 'Koncert Travisa Scotta w Poznań, Poland', 'Poznań', '2023-11-29'),
(2, 'The Weeknd', 'Koncert The Weeknd w Poznań, Poland', 'Poznań', '2023-11-09'),
(3, 'Pitbull ', 'Koncert Pitbull w Poznań, Poland', 'Poznań', '2023-12-15'),
(4, 'Drake ', 'Koncert Drake w Poznań, Poland', 'Poznań', '2024-01-20'),
(5, 'Future ', 'Koncert Future w Poznań, Poland', 'Poznań', '2024-01-25');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `images`
--

CREATE TABLE `images` (
  `imgID` int(11) NOT NULL,
  `src` varchar(255) NOT NULL,
  `eventID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `images`
--

INSERT INTO `images` (`imgID`, `src`, `eventID`) VALUES
(1, 'travis.jpg', 1),
(2, 'weeknd.jpg', 2),
(3, 'pitbull.webp', 3),
(4, 'future.jpg', 5),
(5, 'drake.webp', 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `userName` int(11) NOT NULL,
  `eventName` varchar(255) NOT NULL,
  `eventID` int(11) NOT NULL,
  `ticketPrice` float NOT NULL,
  `ticketDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tickets`
--

CREATE TABLE `tickets` (
  `ticketID` int(11) NOT NULL,
  `eventID` int(11) NOT NULL,
  `ticketName` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `tickets`
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
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
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
(14, 'admin', 'admin', '');

-- --------------------------------------------------------

--
-- Struktura widoku `cheapest`
--
DROP TABLE IF EXISTS `cheapest`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cheapest`  AS SELECT `eventID` AS `eventID`, min(`price`) AS `lowest_value` FROM `tickets` GROUP BY `eventID` ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgID`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indeksy dla tabeli `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticketID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `images`
--
ALTER TABLE `images`
  MODIFY `imgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticketID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
