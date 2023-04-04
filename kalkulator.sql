-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 01 Kwi 2023, 12:37
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `kalkulator`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `instalacja`
--

CREATE TABLE `instalacja` (
  `uzytkownik_id` int(11) NOT NULL,
  `id_instalacji` int(11) NOT NULL,
  `user` varchar(30) NOT NULL,
  `pow_podlogi` int(11) NOT NULL,
  `rodzaj_materialu` varchar(30) NOT NULL,
  `ile_sztuk` int(11) NOT NULL,
  `suma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `malowanie`
--

CREATE TABLE `malowanie` (
  `uzytkownik_id` int(11) NOT NULL,
  `id_malowania` int(11) NOT NULL,
  `user` varchar(40) NOT NULL,
  `pow_pokoju` float NOT NULL,
  `ile_litrow_farby` float NOT NULL,
  `rodzaj_farby` varchar(20) NOT NULL,
  `kolor_farby` varchar(20) NOT NULL,
  `cena_za_litr` float NOT NULL,
  `suma` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `malowanie`
--

INSERT INTO `malowanie` (`uzytkownik_id`, `id_malowania`, `user`, `pow_pokoju`, `ile_litrow_farby`, `rodzaj_farby`, `kolor_farby`, `cena_za_litr`, `suma`) VALUES
(1, 1, 'adam', 30, 2.7, 'lateksowa', 'niebieski', 25, 67.5),
(2, 2, 'anna', 30, 2.7, 'akrylowa', 'bialy', 25, 67.5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `user` text NOT NULL,
  `pass` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `user`, `pass`, `email`) VALUES
(1, 'adam', 'qwerty', 'adam@gmail.com'),
(2, 'marek', 'asdfg', 'marek@gmail.com'),
(3, 'anna', 'zxcvb', 'anna@gmail.com'),
(4, 'andrzej', 'asdfg', 'andrzej@gmail.com'),
(5, 'justyna', 'yuiop', 'justyna@gmail.com'),
(6, 'kasia', 'hjkkl', 'kasia@gmail.com'),
(7, 'beata', 'fgthj', 'beata@gmail.com'),
(8, 'jakub', 'ertyu', 'jakub@gmail.com'),
(9, 'janusz', 'cvbnm', 'janusz@gmail.com'),
(10, 'roman', 'dfghj', 'roman@gmail.com');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `instalacja`
--
ALTER TABLE `instalacja`
  ADD PRIMARY KEY (`id_instalacji`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`);

--
-- Indeksy dla tabeli `malowanie`
--
ALTER TABLE `malowanie`
  ADD PRIMARY KEY (`id_malowania`),
  ADD KEY `fk_malowanie_uzytkownicy` (`user`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `instalacja`
--
ALTER TABLE `instalacja`
  MODIFY `id_instalacji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `malowanie`
--
ALTER TABLE `malowanie`
  MODIFY `id_malowania` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `instalacja`
--
ALTER TABLE `instalacja`
  ADD CONSTRAINT `instalacja_ibfk_1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownicy` (`id`);

--
-- Ograniczenia dla tabeli `malowanie`
--
ALTER TABLE `malowanie`
  ADD CONSTRAINT `malowanie_ibfk_1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownicy` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
