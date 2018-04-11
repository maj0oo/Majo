-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Gru 2017, 21:09
-- Wersja serwera: 10.1.19-MariaDB
-- Wersja PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projekt`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `alerty`
--

CREATE TABLE `alerty` (
  `id` int(11) NOT NULL,
  `wyswietlono` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `alerty`
--

INSERT INTO `alerty` (`id`, `wyswietlono`) VALUES
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oddzialy`
--

CREATE TABLE `oddzialy` (
  `id` int(11) NOT NULL,
  `nazwa_oddzialu` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `oddzialy`
--

INSERT INTO `oddzialy` (`id`, `nazwa_oddzialu`) VALUES
(1, 'BRZEG1'),
(2, 'BRZEG2'),
(3, 'BRZEG3'),
(9, 'OddziaÅ‚');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `raporty`
--

CREATE TABLE `raporty` (
  `id` int(11) NOT NULL,
  `imie` varchar(255) CHARACTER SET latin1 NOT NULL,
  `nazwisko` varchar(255) CHARACTER SET latin1 NOT NULL,
  `nazwa_uzytkownika` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pesel` varchar(11) CHARACTER SET latin1 NOT NULL,
  `dostepny` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `godzina_rozp` datetime NOT NULL,
  `godzina_zak` datetime NOT NULL,
  `lokalizacja` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `raporty`
--

INSERT INTO `raporty` (`id`, `imie`, `nazwisko`, `nazwa_uzytkownika`, `pesel`, `dostepny`, `godzina_rozp`, `godzina_zak`, `lokalizacja`) VALUES
(13, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-09 15:39:51', '2017-10-09 15:39:53', ''),
(14, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-09 16:14:15', '2017-10-09 16:14:17', ''),
(15, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-09 16:14:27', '2017-10-09 16:15:42', ''),
(16, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-09 16:15:43', '2017-10-09 16:15:48', ''),
(17, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-09 16:54:28', '2017-10-09 16:55:07', ''),
(18, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-09 16:57:02', '2017-10-10 16:45:45', ''),
(19, 'Sebastian', 'Kogut', 'Seba', '22222222222', 'niedostÄ™pny', '2017-10-11 18:41:44', '2017-10-11 18:41:54', ''),
(20, 'Sebastian', 'Kogut', 'Seba', '22222222222', 'niedostÄ™pny', '2017-10-18 23:31:40', '2017-10-18 23:32:36', ''),
(21, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 14:18:33', '2017-10-20 14:19:04', ''),
(22, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 14:20:02', '2017-10-20 14:20:03', ''),
(23, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 16:10:59', '2017-10-20 16:11:04', ''),
(24, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 16:12:51', '2017-10-20 16:12:54', ''),
(25, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 16:23:50', '2017-10-20 16:23:53', ''),
(26, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 16:24:38', '2017-10-20 16:24:39', ''),
(27, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 16:24:40', '2017-10-20 16:24:41', ''),
(28, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 16:25:41', '2017-10-20 16:25:44', ''),
(29, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 16:30:33', '2017-10-20 16:30:35', ''),
(30, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 16:31:00', '2017-10-20 16:31:01', ''),
(31, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 16:52:19', '2017-10-20 16:52:59', ''),
(32, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 16:55:19', '2017-10-20 16:56:09', ''),
(33, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 16:56:11', '2017-10-20 16:56:39', ''),
(34, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 16:59:10', '2017-10-20 16:59:14', ''),
(35, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 16:59:16', '2017-10-20 16:59:18', ''),
(36, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 17:01:40', '2017-10-20 17:01:43', ''),
(37, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 17:01:45', '2017-10-20 17:01:56', ''),
(38, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 17:06:19', '2017-10-20 17:06:21', ''),
(39, 'Krzysztof', 'Kowalski', 'Krzychu', '99999999999', 'niedostÄ™pny', '2017-10-20 17:14:44', '2017-10-20 17:14:52', ''),
(40, 'Krzysztof', 'Kowalski', 'Krzychu', '99999999999', 'niedostÄ™pny', '2017-10-20 17:14:57', '2017-10-20 17:15:01', ''),
(41, 'Krzysztof', 'Kowalski', 'Krzychu', '99999999999', 'dostÄ™pny', '2017-10-20 17:15:43', '0000-00-00 00:00:00', ''),
(42, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 17:27:13', '2017-10-20 17:27:17', ''),
(43, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 17:32:32', '2017-10-20 17:32:33', ''),
(44, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 17:32:41', '2017-10-20 17:32:43', ''),
(45, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'dostÄ™pny', '2017-10-20 17:33:25', '0000-00-00 00:00:00', ''),
(46, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 17:33:53', '2017-10-20 17:33:54', ''),
(47, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 17:33:56', '2017-10-20 17:34:05', ''),
(48, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 17:36:37', '2017-10-20 17:37:04', ''),
(49, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 17:43:50', '2017-10-20 17:43:51', ''),
(50, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 17:43:53', '2017-10-20 17:43:55', ''),
(51, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'dostÄ™pny', '2017-10-20 17:44:13', '0000-00-00 00:00:00', ''),
(52, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'dostÄ™pny', '2017-10-20 17:44:22', '0000-00-00 00:00:00', ''),
(53, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 17:44:32', '2017-10-20 17:45:41', ''),
(54, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 17:46:18', '2017-10-20 17:46:22', ''),
(55, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 17:46:39', '2017-10-20 17:46:41', ''),
(56, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 17:48:03', '2017-10-20 17:48:18', ''),
(57, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 17:48:18', '2017-10-20 17:48:19', ''),
(58, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 17:48:35', '2017-10-20 17:48:37', ''),
(59, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 18:00:14', '2017-10-20 18:01:10', ''),
(60, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 18:01:11', '2017-10-20 18:01:24', ''),
(61, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 18:45:27', '2017-10-20 18:45:29', ''),
(62, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 18:45:39', '2017-10-20 18:45:52', ''),
(63, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 18:45:52', '2017-10-20 18:45:54', ''),
(64, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 18:46:09', '2017-10-20 18:46:10', ''),
(65, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 18:46:10', '2017-10-20 18:46:11', ''),
(66, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 18:46:27', '2017-10-20 18:46:28', ''),
(67, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 18:46:55', '2017-10-20 18:46:56', ''),
(68, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 18:46:57', '2017-10-20 18:46:59', ''),
(69, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 18:57:49', '2017-10-20 18:58:12', '0'),
(70, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 19:01:05', '2017-10-20 19:01:08', ''),
(71, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 19:04:07', '2017-10-20 19:04:14', ''),
(72, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-20 19:04:32', '2017-10-20 19:04:33', ''),
(73, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-23 14:47:24', '2017-10-23 14:48:27', ''),
(74, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-23 14:48:28', '2017-10-23 14:48:30', ''),
(75, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-23 14:48:51', '2017-10-23 14:48:55', ''),
(76, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-23 14:49:22', '2017-10-23 14:49:26', ''),
(77, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-23 14:49:59', '2017-10-23 14:50:04', ''),
(78, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-23 14:51:56', '2017-10-23 14:56:54', ''),
(79, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-23 14:56:56', '2017-10-23 14:56:57', ''),
(80, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-23 14:57:19', '2017-10-23 14:58:10', ''),
(81, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-23 14:58:11', '2017-10-23 15:12:38', ''),
(82, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-23 16:02:37', '2017-10-23 16:02:42', '50.8491297,17.4474448'),
(83, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-23 16:03:12', '2017-10-23 16:03:20', ''),
(84, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-23 16:03:37', '2017-10-23 16:03:51', '50.849148899999996,17.447546199999998'),
(85, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-23 16:04:44', '2017-10-23 16:28:27', '50.84913100000001,17.4474809'),
(86, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-10-23 16:34:29', '2017-10-23 16:41:00', '50.849128699999994,17.4475115'),
(87, 'ImiÄ™', 'Nazwisko', 'Pracownik1', '00000000000', 'niedostÄ™pny', '2017-10-23 16:38:56', '2017-10-23 16:39:00', ''),
(88, 'ImiÄ™', 'Nazwisko', 'Pracownik1', '00000000000', 'niedostÄ™pny', '2017-10-23 16:39:30', '2017-10-23 16:40:53', '50.8491419,17.447552599999998'),
(89, 'ImiÄ™', 'Nazwisko', 'Pracownik1', '00000000000', 'niedostÄ™pny', '2017-10-23 16:49:17', '2017-10-23 16:51:19', '50.8491509,17.4475032'),
(90, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-22 19:29:02', '2017-11-22 19:29:33', '50.849103299999996,17.447533'),
(91, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-23 16:19:07', '2017-11-23 16:19:32', '50.849117199999995,17.4475509'),
(92, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-23 19:04:10', '2017-11-23 19:04:11', '50.8491011,17.4475362'),
(93, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-24 15:24:11', '2017-11-24 15:24:13', '50.8491141,17.4475294'),
(94, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-24 15:24:17', '2017-11-24 15:24:19', '50.8491141,17.4475294'),
(95, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-24 15:24:20', '2017-11-24 15:24:20', '50.8491141,17.4475294'),
(96, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-24 15:24:21', '2017-11-24 15:24:21', '50.8491141,17.4475294'),
(97, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-24 15:24:22', '2017-11-24 15:24:23', '50.8491141,17.4475294'),
(98, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-24 15:24:23', '2017-11-24 15:24:24', '50.8491141,17.4475294'),
(99, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-24 15:24:24', '2017-11-24 15:24:25', '50.8491141,17.4475294'),
(100, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-24 15:24:25', '2017-11-24 15:25:00', '50.8491141,17.4475294'),
(101, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-24 15:25:02', '2017-11-24 15:25:03', '50.849120899999996,17.447537999999998'),
(102, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-24 15:44:22', '2017-11-24 15:46:09', '50.8491162,17.4475429'),
(103, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-24 15:46:21', '2017-11-24 15:46:24', '50.8491114,17.4475156'),
(104, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-24 15:48:50', '2017-11-24 15:48:51', '50.8491114,17.4475156'),
(105, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-24 15:48:52', '2017-11-24 15:48:53', '50.849105599999994,17.447530399999998'),
(106, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-24 15:48:53', '2017-11-24 15:48:54', '50.849105599999994,17.447530399999998'),
(107, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-24 17:59:13', '2017-11-24 17:59:30', '50.8491085,17.4474974'),
(108, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-24 18:03:37', '2017-11-24 18:03:39', '50.849112500000004,17.447471'),
(109, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-24 18:03:40', '2017-11-24 18:03:41', '50.849095,17.447501799999998'),
(110, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-24 18:03:43', '2017-11-24 18:03:49', '50.849095,17.447501799999998'),
(111, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-28 12:31:11', '2017-11-28 12:31:14', '50.849095999999996,17.447505'),
(112, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-28 12:31:15', '2017-11-28 12:31:17', '50.849095999999996,17.447505'),
(113, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-28 12:31:29', '2017-11-28 12:31:30', '50.849095999999996,17.447505'),
(114, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-28 12:32:56', '2017-11-28 12:32:57', '50.8491085,17.4475287'),
(115, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-28 12:38:45', '2017-11-28 12:38:47', '50.849103,17.4475521'),
(116, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-28 14:58:05', '2017-11-28 14:58:06', '50.849108099999995,17.4474995'),
(117, 'MichaÅ‚', 'Majecki', 'Login', '66666666666', 'niedostÄ™pny', '2017-11-28 16:43:25', '2017-12-02 19:32:58', '50.8490952,17.447504'),
(118, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-30 16:58:07', '2017-11-30 16:58:09', '50.8490999,17.4475206'),
(119, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-11-30 17:37:31', '2017-12-02 19:32:25', '50.8491086,17.4475435'),
(120, 'Marek', 'Branowski', 'Mareczek2', '12345678901', 'niedostÄ™pny', '2017-12-02 19:31:36', '2017-12-02 19:32:02', '50.8491369,17.4475443'),
(121, 'Marek', 'Branowski', 'Mareczek2', '12345678901', 'niedostÄ™pny', '2017-12-02 19:32:05', '2017-12-02 19:32:06', '50.8491369,17.4475443'),
(122, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-12-02 19:39:36', '2017-12-02 19:40:34', '50.849100199999995,17.4475651'),
(123, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-12-02 19:40:36', '2017-12-02 19:40:37', '50.8491176,17.4475286'),
(124, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-12-02 19:40:38', '2017-12-02 19:40:39', '50.8491176,17.4475286'),
(125, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-12-02 19:40:41', '2017-12-02 19:40:42', '50.8491176,17.4475286'),
(126, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-12-02 19:40:49', '2017-12-02 19:40:50', '50.8491176,17.4475286'),
(127, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-12-02 19:41:26', '2017-12-02 19:41:27', '50.8491089,17.4475558'),
(128, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-12-02 19:41:33', '2017-12-02 19:41:34', '50.8491089,17.4475558'),
(129, 'Marek', 'Baranowski', 'Mareczek', '11111111111', 'niedostÄ™pny', '2017-12-02 19:41:46', '2017-12-02 19:41:47', '50.8491089,17.4475558');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `imie` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `nazwisko` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pesel` varchar(11) CHARACTER SET latin1 NOT NULL,
  `nazwa` varchar(255) CHARACTER SET latin1 NOT NULL,
  `haslo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `typ_konta` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tel` int(11) NOT NULL,
  `oddzial` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `imie`, `nazwisko`, `pesel`, `nazwa`, `haslo`, `email`, `typ_konta`, `tel`, `oddzial`) VALUES
(12, 'Michał', 'Majecki', '98092106854', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'mail@michalmajecki.pl', 'admin', 795173838, ''),
(13, 'Marek', 'Baranowski', '11111111111', 'Mareczek', '207023ccb44feb4d7dadca005ce29a64', 'mareczek@gmail.com', 'user', 111111111, 'BRZEG1'),
(14, 'Sebastian', 'Kogut', '22222222222', 'Seba', '207023ccb44feb4d7dadca005ce29a64', 'mail@email.pl', 'user', 222222222, 'BRZEG2'),
(15, 'Kuba', 'Zambrzycki', '33333333333', 'Kuba', '207023ccb44feb4d7dadca005ce29a64', 'kuba@mail.pl', 'user', 333333333, 'BRZEG2'),
(16, 'Michał', 'Majecki', '55555555555', 'Majo', '207023ccb44feb4d7dadca005ce29a64', 'mail@michalmajecki.pl', 'user', 795173838, 'BRZEG2'),
(17, 'Krzysztof', 'Kowalski', '99999999999', 'Krzychu', '207023ccb44feb4d7dadca005ce29a64', 'mail@email.pl', 'user', 789789789, 'BRZEG1'),
(18, 'Imię', 'Nazwisko', '00000000000', 'Pracownik1', '207023ccb44feb4d7dadca005ce29a64', 'email@mail.pl', 'user', 555555555, 'OddziaÅ‚ 001');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zlecenia`
--

CREATE TABLE `zlecenia` (
  `id` int(11) NOT NULL,
  `zleceniodawca` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `nazwa_zlecenia` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `lokalizacja` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `opis` longtext COLLATE utf8_polish_ci NOT NULL,
  `termin` date NOT NULL,
  `oddzial` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `zdjecie1` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `zdjecie2` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `zdjecie3` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `opis_wykonania` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zlecenia`
--

INSERT INTO `zlecenia` (`id`, `zleceniodawca`, `nazwa_zlecenia`, `lokalizacja`, `opis`, `termin`, `oddzial`, `status`, `zdjecie1`, `zdjecie2`, `zdjecie3`, `opis_wykonania`) VALUES
(20, 'qwefqwef', 'fqwef', 'qwefqef', 'qwefq', '2017-11-28', 'BRZEG1', 'Wykonane', '', '', '', ''),
(21, 'qwefwqe', 'qwefqwef', 'eqwefqwef', 'qwefqwef', '2017-11-28', 'BRZEG1', 'Wykonane', '', '', '', ''),
(22, 'qwefq', 'fqwefqwef', 'qwefqwef', 'efqwefq', '2017-11-28', 'BRZEG1', 'Wykonane', 'IMG_20170912_193430393.jpg', 'IMG_20170912_193638621.jpg', 'IMG_20170912_193620767.jpg', 'wefwef'),
(23, 'qweqwef', 'wefqwef', 'qwefqwef', 'qwefqwef', '2017-11-28', 'BRZEG1', 'Wykonane', 'IMG_20170912_193430393.jpg', 'IMG_20170912_193620767.jpg', 'IMG_20170912_193638621.jpg', 'weqweqwef'),
(24, 'Zleceniodawca1', 'Nazwa1', 'WrocÅ‚aw', 'Opis zlecenia Opis zlecenia Opis zlecenia Opis zlecenia Opis zlecenia Opis zleceniaOpis zlecenia Opis zlecenia Opis zleceniaOpis zlecenia Opis zlecenia Opis zleceniaOpis zlecenia Opis zlecenia Opis zlecenia', '2017-11-30', 'BRZEG1', 'Wykonane', 'IMG_20170912_193553769.jpg', 'IMG_20170912_193638621.jpg', 'IMG_20170912_193430393.jpg', 'qwefqwefqwef'),
(25, 'Zlecenie2', 'Nazwa2', 'WrocÅ‚aw', 'kjbrjhfbjqwhebfjqhwebfjqhwbefqwefqwef', '2017-12-01', 'BRZEG1', 'Wykonane', 'IMG_20170912_193326647.jpg', 'IMG_20170912_193553769.jpg', 'IMG_20170912_193638621.jpg', 'qwefqwefqwef'),
(26, 'Zlecenie3', 'Nazwa3', 'Opole', 'qwefqewfqergqergergqg', '2017-12-02', 'BRZEG1', 'Wykonane', 'IMG_20170912_193430393.jpg', 'IMG_20170912_193620767.jpg', 'IMG_20170912_193638621.jpg', 'wefqwefqwef'),
(27, 'qwd', 'qwd', 'qwdqw', '', '2017-12-03', 'BRZEG1', 'Nie wykonane', '', '', '', ''),
(28, 'qwdqwd', 'qwdqwd', 'qwdqwd', 'qwdqwd', '2017-12-03', 'BRZEG1', 'W trakcie', '', '', '', '');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `alerty`
--
ALTER TABLE `alerty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oddzialy`
--
ALTER TABLE `oddzialy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raporty`
--
ALTER TABLE `raporty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zlecenia`
--
ALTER TABLE `zlecenia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `oddzialy`
--
ALTER TABLE `oddzialy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT dla tabeli `raporty`
--
ALTER TABLE `raporty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT dla tabeli `zlecenia`
--
ALTER TABLE `zlecenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
