-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 12 Maj 2022, 02:06
-- Wersja serwera: 10.4.17-MariaDB
-- Wersja PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `ogloszenia48`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dane_ogloszen`
--

CREATE TABLE `dane_ogloszen` (
  `id_ogloszenia` int(11) NOT NULL,
  `autor` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `tytul` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `kategoria` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `obraz` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `tekst` varchar(400) COLLATE utf8_polish_ci DEFAULT NULL,
  `data_utworzenia` date DEFAULT NULL,
  `czas_utworzenia` varchar(6) COLLATE utf8_polish_ci DEFAULT NULL,
  `nr_tel` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `e_mail` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `adres` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `dane_ogloszen`
--

INSERT INTO `dane_ogloszen` (`id_ogloszenia`, `autor`, `tytul`, `kategoria`, `obraz`, `tekst`, `data_utworzenia`, `czas_utworzenia`, `nr_tel`, `e_mail`, `adres`) VALUES
(2, 'Konto', 'Test2', 'Zwierzęta', 'tuba.png', 'TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TESTTEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TESTTEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TESTTEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST', '2011-05-22', '00:31', '213122222', '', ''),
(3, 'Konto', 'Test3', 'Kultura i sztuka', 'tuba.png', '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. In laoreet ligula quis tellus sagittis volutpat. Donec ut tempor quam, eu vehicula neque. Proin ac ultrices justo, sit amet semper nisi. In pellentesque, orci id ornare finibus, nisl nulla vestibulum nisi, quis posuere elit urna ac neque. Donec commodo nisl vitae tellus mattis dictum. Proin sit amet porttitor eros, in eleifend est. Aliquam', '2011-05-22', '00:38', '132133212', '', ''),
(5, 'Test', 'Zaginął rower', 'Pomoc', 'rower.png', 'W nocy w Jaworznie miało miejsce włamanie do dobrze zabezpieczonego domu mieszkalnego. Widziano uciekających dwóch chłopaków/mężczyzn. Złodzieje wiedzieli co chcą ukraść i gdzie się znajduje ponieważ nie odnotowano innych strat. Skradziono m.in. unikalne ramy rowerowe i dwa unikalne rowery:\r\n\r\nBergamont Straitlite L (z tego co mi wiadomo to jedyna taka w PL)\r\n\r\nSpecialized Demo M 2006 (jedyna na ś', '2022-05-12', '01:37', '100100100', 'test@test.pl', 'Test, test 12');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dane_uzytkownika`
--

CREATE TABLE `dane_uzytkownika` (
  `id_konta` int(11) NOT NULL,
  `login` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `haslo` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `nr_tel` varchar(10) COLLATE utf8_polish_ci DEFAULT NULL,
  `email` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `imie` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `nazwisko` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `data_ur` date DEFAULT NULL,
  `plec` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `dane_uzytkownika`
--

INSERT INTO `dane_uzytkownika` (`id_konta`, `login`, `haslo`, `nr_tel`, `email`, `imie`, `nazwisko`, `data_ur`, `plec`) VALUES
(1, 'Konto', 'test', '100100100', 'test@test.test', 'Test', 'Test', '2022-05-05', 'Male'),
(2, 'Test', 'test', '555555555', 'test@test.pl', 'Test', 'Test', '1995-02-01', 'Female');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `dane_ogloszen`
--
ALTER TABLE `dane_ogloszen`
  ADD PRIMARY KEY (`id_ogloszenia`);

--
-- Indeksy dla tabeli `dane_uzytkownika`
--
ALTER TABLE `dane_uzytkownika`
  ADD PRIMARY KEY (`id_konta`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `dane_ogloszen`
--
ALTER TABLE `dane_ogloszen`
  MODIFY `id_ogloszenia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `dane_uzytkownika`
--
ALTER TABLE `dane_uzytkownika`
  MODIFY `id_konta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
