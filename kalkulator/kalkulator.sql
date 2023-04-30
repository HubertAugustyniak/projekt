-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2023 at 01:01 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kalkulator`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `instalation`
--

CREATE TABLE `instalation` (
  `room_id` int(11) NOT NULL,
  `id_instalation` int(11) NOT NULL,
  `user` varchar(30) NOT NULL,
  `surf_floor` int(11) NOT NULL,
  `material_type` varchar(30) NOT NULL,
  `pcs` int(11) NOT NULL,
  `addition` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `paint`
--

CREATE TABLE `paint` (
  `room_id` int(11) NOT NULL,
  `id_paint` int(11) NOT NULL,
  `user` varchar(40) NOT NULL,
  `surf_room` float NOT NULL,
  `liters` float NOT NULL,
  `type_paint` varchar(20) NOT NULL,
  `color_paint` varchar(20) NOT NULL,
  `price_for_liter` float NOT NULL,
  `addition` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user` varchar(40) NOT NULL,
  `renoName` text NOT NULL,
  `dateReno` date NOT NULL,
  `isActive` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `passwordhash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `passwordhash`) VALUES
(14, 'jan', 'jan@wp.pl', '36f17c3939ac3e7b2fc9396fa8e953ea');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `instalation`
--
ALTER TABLE `instalation`
  ADD PRIMARY KEY (`id_instalation`),
  ADD KEY `room_id` (`room_id`);

--
-- Indeksy dla tabeli `paint`
--
ALTER TABLE `paint`
  ADD PRIMARY KEY (`id_paint`),
  ADD KEY `fk_paint_users` (`user`),
  ADD KEY `room_id` (`room_id`);

--
-- Indeksy dla tabeli `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instalation`
--
ALTER TABLE `instalation`
  MODIFY `id_instalation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `paint`
--
ALTER TABLE `paint`
  MODIFY `id_paint` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `instalation`
--
ALTER TABLE `instalation`
  ADD CONSTRAINT `instalation_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`);

--
-- Constraints for table `paint`
--
ALTER TABLE `paint`
  ADD CONSTRAINT `paint_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
