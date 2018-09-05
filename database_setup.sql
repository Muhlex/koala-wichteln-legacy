-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 04. Sep 2018 um 21:18
-- Server-Version: 10.3.8-MariaDB-1:10.3.8+maria~stretch
-- PHP-Version: 7.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `muhlex_wichteln`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `matches`
--

CREATE TABLE `matches` (
  `steamID64_origin` bigint(17) NOT NULL,
  `steamID64_match` bigint(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `steamID64` bigint(17) NOT NULL,
  `name` varchar(32) NOT NULL,
  `avatar` varchar(140) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `is_in_group` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `var`
--

CREATE TABLE `var` (
  `attribute` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `var`
--

INSERT INTO `var` (`attribute`, `value`) VALUES
('date.end', '2018-12-22 00:00:00'),
('date.gifts', '2018-12-14 00:00:00'),
('date.register', '2018-11-14 00:00:00'),
('players.matched', '0');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`steamID64_origin`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`steamID64`),
  ADD UNIQUE KEY `steamID64` (`steamID64`);

--
-- Indizes für die Tabelle `var`
--
ALTER TABLE `var`
  ADD PRIMARY KEY (`attribute`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
