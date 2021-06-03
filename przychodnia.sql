-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Lis 2020, 20:33
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `przychodnia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lekarz`
--

CREATE TABLE `lekarz` (
  `id_lekarz` int(11) NOT NULL,
  `imie` text COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` text COLLATE utf8_polish_ci NOT NULL,
  `specjalizacja` text COLLATE utf8_polish_ci NOT NULL,
  `nr_telefonu` text COLLATE utf8_polish_ci NOT NULL,
  `ulica` text COLLATE utf8_polish_ci NOT NULL,
  `nr_domu` text COLLATE utf8_polish_ci NOT NULL,
  `pesel` text COLLATE utf8_polish_ci NOT NULL,
  `nr_mieszkania` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `lekarz`
--

INSERT INTO `lekarz` (`id_lekarz`, `imie`, `nazwisko`, `specjalizacja`, `nr_telefonu`, `ulica`, `nr_domu`, `pesel`, `nr_mieszkania`) VALUES
(1, 'Bolesław', 'Nocny', 'Angiologia', '765765765', 'Trwała', '1', '76050253531', '2'),
(2, 'Damian', 'Jacewicz', 'Okulistyka', '473416054', 'Ogólna', '4', '70091263741', '5'),
(3, 'Martyna', 'Hańcza', 'Otorynolaryngologia', '757252156', 'Klonowa', '12', '86122000800', '9');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pacjent`
--

CREATE TABLE `pacjent` (
  `id_pacjent` int(11) NOT NULL,
  `imie` text COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` text COLLATE utf8_polish_ci NOT NULL,
  `nr_telefonu` text COLLATE utf8_polish_ci NOT NULL,
  `ulica` text COLLATE utf8_polish_ci NOT NULL,
  `nr_domu` text COLLATE utf8_polish_ci NOT NULL,
  `pesel` text COLLATE utf8_polish_ci NOT NULL,
  `nr_mieszkania` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pacjent`
--

INSERT INTO `pacjent` (`id_pacjent`, `imie`, `nazwisko`, `nr_telefonu`, `ulica`, `nr_domu`, `pesel`, `nr_mieszkania`) VALUES
(1, 'Jan', 'Kowalski', '574536915', 'Krótka', '2', '96020215262', '5'),
(2, 'Maciej', 'Dąbrowski', '316062619', 'Wąska', '3', '89111885212', '6');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wizyta`
--

CREATE TABLE `wizyta` (
  `id_wizyta` int(11) NOT NULL,
  `id_pacjent` int(11) NOT NULL,
  `id_lekarz` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp(),
  `odbyta` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `wizyta`
--

INSERT INTO `wizyta` (`id_wizyta`, `id_pacjent`, `id_lekarz`, `data`, `odbyta`) VALUES
(1, 1, 1, '2020-11-07 16:32:20', 1),
(2, 1, 2, '2020-12-08 16:32:49', 0),
(3, 1, 1, '2020-09-08 11:12:10', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `lekarz`
--
ALTER TABLE `lekarz`
  ADD PRIMARY KEY (`id_lekarz`);

--
-- Indeksy dla tabeli `pacjent`
--
ALTER TABLE `pacjent`
  ADD PRIMARY KEY (`id_pacjent`);

--
-- Indeksy dla tabeli `wizyta`
--
ALTER TABLE `wizyta`
  ADD PRIMARY KEY (`id_wizyta`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `lekarz`
--
ALTER TABLE `lekarz`
  MODIFY `id_lekarz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `pacjent`
--
ALTER TABLE `pacjent`
  MODIFY `id_pacjent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `wizyta`
--
ALTER TABLE `wizyta`
  MODIFY `id_wizyta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
