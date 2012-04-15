-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 15. Apr 2012 um 16:21
-- Server Version: 5.5.16
-- PHP-Version: 5.3.8

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `tps`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `auftrag`
--
-- Erzeugt am: 15. Apr 2012 um 10:11
--

DROP TABLE IF EXISTS `auftrag`;
CREATE TABLE IF NOT EXISTS `auftrag` (
  `auftragsnummer` int(7) NOT NULL AUTO_INCREMENT,
  `beschreibung` char(100) NOT NULL,
  `zeit_von` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `zeit_bis` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `auftragsstatus` char(1) NOT NULL,
  `kundennummer` int(10) NOT NULL,
  `benutzername` char(10) NOT NULL,
  PRIMARY KEY (`auftragsnummer`),
  KEY `kundennummer` (`kundennummer`),
  KEY `benutzername` (`benutzername`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- RELATIONEN DER TABELLE `auftrag`:
--   `kundennummer`
--       `kunde` -> `kundennummer`
--   `benutzername`
--       `mitarbeiter` -> `benutzername`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kunde`
--
-- Erzeugt am: 15. Apr 2012 um 10:00
--

DROP TABLE IF EXISTS `kunde`;
CREATE TABLE IF NOT EXISTS `kunde` (
  `kundennummer` int(10) NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL,
  `strasse` char(50) NOT NULL,
  `hausnummer` char(5) NOT NULL,
  `plz` int(5) NOT NULL,
  `ort` char(50) NOT NULL,
  `telefonnummer` char(20) NOT NULL,
  PRIMARY KEY (`kundennummer`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mitarbeiter`
--
-- Erzeugt am: 15. Apr 2012 um 10:03
--

DROP TABLE IF EXISTS `mitarbeiter`;
CREATE TABLE IF NOT EXISTS `mitarbeiter` (
  `benutzername` char(10) NOT NULL,
  `passwort` char(10) NOT NULL,
  `mitarbeitertyp` char(2) NOT NULL,
  `vorname` char(20) NOT NULL,
  `nachname` char(20) NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`benutzername`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `auftrag`
--
ALTER TABLE `auftrag`
  ADD CONSTRAINT `auftrag_ibfk_1` FOREIGN KEY (`kundennummer`) REFERENCES `kunde` (`kundennummer`) ON UPDATE CASCADE,
  ADD CONSTRAINT `auftrag_ibfk_2` FOREIGN KEY (`benutzername`) REFERENCES `mitarbeiter` (`benutzername`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
