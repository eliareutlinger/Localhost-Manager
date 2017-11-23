-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 23. Nov 2017 um 22:36
-- Server-Version: 10.1.25-MariaDB
-- PHP-Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `db_localmanager`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_file_data`
--

DROP TABLE IF EXISTS `tb_file_data`;
CREATE TABLE `tb_file_data` (
  `ID` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_description` text NOT NULL,
  `file_reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `github` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `tb_file_data`
--

INSERT INTO `tb_file_data` (`ID`, `file_name`, `file_description`, `file_reg_date`, `github`) VALUES
(58, 'busse.eliareutlinger.ch', '', '2017-11-23 09:34:08', 0),
(59, 'EliaReutlinger.ch', '', '2017-11-23 09:34:08', 0),
(60, 'M151-Project', '', '2017-11-23 09:34:08', 0),
(61, 'Modul-133', '', '2017-11-23 09:34:08', 0),
(62, 'Modul-151', '', '2017-11-23 09:34:08', 0),
(63, 'PHP-Weight-Manager', '', '2017-11-23 09:34:08', 0),
(64, 'Stundenplan-App', '', '2017-11-23 09:34:08', 0),
(65, 'Web-CMS', '', '2017-11-23 09:34:08', 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tb_file_data`
--
ALTER TABLE `tb_file_data`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tb_file_data`
--
ALTER TABLE `tb_file_data`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
