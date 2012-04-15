-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 15. Apr 2012 um 16:24
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

--
-- Daten für Tabelle `auftrag`
--

INSERT INTO `auftrag` (`auftragsnummer`, `beschreibung`, `zeit_von`, `zeit_bis`, `auftragsstatus`, `kundennummer`, `benutzername`) VALUES
(1, 'Toilette verstopft', '2012-04-17 13:00:00', '2012-04-17 15:00:00', 'R', 3, 'DOGANA'),
(2, 'Installation Gastherme Junkers Modell 3', '2012-04-18 11:00:00', '2012-04-18 15:00:00', 'R', 7, 'DOGANA'),
(3, 'Wasserhahn undicht', '2012-04-16 06:00:00', '2012-04-16 07:00:00', 'C', 1, 'DOGANA'),
(4, 'Wasserhahn undicht', '2012-04-16 08:00:00', '2012-04-16 09:00:00', 'C', 5, 'DOGANA'),
(5, 'Wartung Gastherme Junkers Modell 1', '2012-04-03 07:00:00', '2012-04-04 13:00:00', 'F', 6, 'DOGANA'),
(6, 'Wartung Gastherme Junkers Modell 2', '2012-04-23 12:30:00', '2012-04-23 13:30:00', 'A', 9, 'DOGANA'),
(7, 'Installation Gastherme Junkers Modell 3', '2012-04-19 11:00:00', '2012-04-19 15:00:00', 'A', 2, 'DOGANA'),
(8, 'Gasthermenregler austauschen', '2012-04-05 11:00:00', '2012-04-05 12:00:00', 'F', 10, 'DOGANA'),
(9, 'Installation Wasserhahn', '2012-04-06 07:00:00', '2012-04-06 09:00:00', 'F', 8, 'DOGANA'),
(10, 'Wartung Gastherme Junkers Modell1', '2012-04-22 12:30:00', '2012-04-23 13:30:00', 'A', 9, 'DOGANA'),
(11, 'Wasserhahn undicht', '2012-04-22 14:30:00', '2012-04-23 15:30:00', 'A', 9, 'DOGANA'),
(12, 'Installation Badewannenanschluss', '2012-04-22 06:30:00', '2012-04-23 08:30:00', 'A', 9, 'DOGANA'),
(13, 'Wasserhahn undicht', '2012-04-06 11:00:00', '2012-04-06 12:00:00', 'F', 8, 'DOGANA'),
(14, 'Toilettenspülung defekt / läuft dauerhaft', '2012-04-06 11:00:00', '2012-04-06 12:00:00', 'F', 4, 'DOGANA'),
(15, 'Undichtes Rohr - Wasserrohrbruch', '2012-04-18 13:00:00', '2012-04-18 14:00:00', 'R', 7, 'DOGANA'),
(16, 'Wasserhahn undicht', '2012-04-16 14:00:00', '2012-04-16 15:00:00', 'C', 7, 'DOGANA'),
(17, 'Installation Badewanne Typ Sprudelwanne', '2012-04-16 13:30:00', '2012-04-16 14:30:00', 'C', 1, 'DOGANA'),
(18, 'Installation Badewanne Typ Standard', '2012-04-17 13:30:00', '2012-04-17 14:30:00', 'C', 5, 'DOGANA'),
(19, 'Toilette verstopft', '2012-04-16 06:00:00', '2012-04-16 07:00:00', 'C', 7, 'DOGANA'),
(20, 'Wartung Gastherme Junkers Typ 0815', '2012-04-17 06:00:00', '2012-04-17 07:00:00', 'C', 10, 'DOGANA'),
(21, 'Wartung Gastherme Junkers Modell 1', '2012-04-03 07:00:00', '2012-04-04 13:00:00', 'F', 6, 'KUNZES'),
(22, 'Gasthermenregler austauschen', '2012-04-05 11:00:00', '2012-04-05 12:00:00', 'F', 10, 'KUNZES'),
(23, 'Installation Wasserhahn', '2012-04-06 07:00:00', '2012-04-06 09:00:00', 'F', 8, 'KUNZES'),
(24, 'Wartung Gastherme Junkers Modell 2', '2012-04-23 12:30:00', '2012-04-23 13:30:00', 'A', 9, 'KUNZES'),
(25, 'Wasserhahn undicht', '2012-04-22 14:30:00', '2012-04-23 15:30:00', 'A', 9, 'KUNZES'),
(26, 'Wartung Gastherme Junkers Modell1', '2012-04-22 12:30:00', '2012-04-23 13:30:00', 'A', 9, 'KUNZES'),
(27, 'Installation Badewannenanschluss', '2012-04-22 06:30:00', '2012-04-23 08:30:00', 'A', 9, 'KUNZES'),
(28, 'Installation Gastherme Junkers Modell 3', '2012-04-19 11:00:00', '2012-04-19 15:00:00', 'A', 2, 'KUNZES'),
(29, 'Undichtes Rohr - Wasserrohrbruch', '2012-04-18 13:00:00', '2012-04-18 14:00:00', 'R', 7, 'KUNZES'),
(30, 'Installation Gastherme Junkers Modell 3', '2012-04-18 11:00:00', '2012-04-18 15:00:00', 'R', 7, 'KUNZES'),
(31, 'Installation Badewanne Typ Standard', '2012-04-17 13:30:00', '2012-04-17 14:30:00', 'C', 5, 'KUNZES'),
(32, 'Toilette verstopft', '2012-04-17 13:00:00', '2012-04-17 15:00:00', 'R', 3, 'KUNZES'),
(33, 'Wartung Gastherme Junkers Typ 0815', '2012-04-17 06:00:00', '2012-04-17 07:00:00', 'C', 10, 'KUNZES'),
(34, 'Wasserhahn undicht', '2012-04-16 14:00:00', '2012-04-16 15:00:00', 'C', 7, 'KUNZES'),
(35, 'Installation Badewanne Typ Sprudelwanne', '2012-04-16 13:30:00', '2012-04-16 14:30:00', 'C', 1, 'KUNZES'),
(36, 'Wasserhahn undicht', '2012-04-16 08:00:00', '2012-04-16 09:00:00', 'C', 5, 'KUNZES'),
(37, 'Toilette verstopft', '2012-04-16 06:00:00', '2012-04-16 07:00:00', 'C', 7, 'KUNZES'),
(38, 'Wasserhahn undicht', '2012-04-16 06:00:00', '2012-04-16 07:00:00', 'C', 1, 'KUNZES'),
(39, 'Toilettenspülung defekt / läuft dauerhaft', '2012-04-06 11:00:00', '2012-04-06 12:00:00', 'F', 4, 'KUNZES'),
(40, 'Wasserhahn undicht', '2012-04-06 11:00:00', '2012-04-06 12:00:00', 'F', 8, 'KUNZES'),
(41, 'Wartung Gastherme Junkers Typ 0815', '2012-04-17 06:00:00', '2012-04-17 07:00:00', 'C', 10, 'PETERSM'),
(42, 'Gasthermenregler austauschen', '2012-04-05 11:00:00', '2012-04-05 12:00:00', 'F', 10, 'PETERSM'),
(43, 'Installation Wasserhahn', '2012-04-06 07:00:00', '2012-04-06 09:00:00', 'F', 8, 'PETERSM'),
(44, 'Wartung Gastherme Junkers Modell 2', '2012-04-23 12:30:00', '2012-04-23 13:30:00', 'A', 9, 'PETERSM'),
(45, 'Wasserhahn undicht', '2012-04-22 14:30:00', '2012-04-23 15:30:00', 'A', 9, 'PETERSM'),
(46, 'Wartung Gastherme Junkers Modell1', '2012-04-22 12:30:00', '2012-04-23 13:30:00', 'A', 9, 'PETERSM'),
(47, 'Installation Badewannenanschluss', '2012-04-22 06:30:00', '2012-04-23 08:30:00', 'A', 9, 'PETERSM'),
(48, 'Installation Gastherme Junkers Modell 3', '2012-04-19 11:00:00', '2012-04-19 15:00:00', 'A', 2, 'PETERSM'),
(49, 'Undichtes Rohr - Wasserrohrbruch', '2012-04-18 13:00:00', '2012-04-18 14:00:00', 'R', 7, 'PETERSM'),
(50, 'Installation Gastherme Junkers Modell 3', '2012-04-18 11:00:00', '2012-04-18 15:00:00', 'R', 7, 'PETERSM'),
(51, 'Installation Badewanne Typ Standard', '2012-04-17 13:30:00', '2012-04-17 14:30:00', 'C', 5, 'PETERSM'),
(52, 'Toilette verstopft', '2012-04-17 13:00:00', '2012-04-17 15:00:00', 'R', 3, 'PETERSM'),
(53, 'Wartung Gastherme Junkers Typ 0815', '2012-04-17 06:00:00', '2012-04-17 07:00:00', 'C', 10, 'PETERSM'),
(54, 'Wasserhahn undicht', '2012-04-16 14:00:00', '2012-04-16 15:00:00', 'C', 7, 'PETERSM'),
(55, 'Installation Badewanne Typ Sprudelwanne', '2012-04-16 13:30:00', '2012-04-16 14:30:00', 'C', 1, 'PETERSM'),
(56, 'Wasserhahn undicht', '2012-04-16 08:00:00', '2012-04-16 09:00:00', 'C', 5, 'PETERSM'),
(57, 'Toilette verstopft', '2012-04-16 06:00:00', '2012-04-16 07:00:00', 'C', 7, 'PETERSM'),
(58, 'Wasserhahn undicht', '2012-04-16 06:00:00', '2012-04-16 07:00:00', 'C', 1, 'PETERSM'),
(59, 'Toilettenspülung defekt / läuft dauerhaft', '2012-04-06 11:00:00', '2012-04-06 12:00:00', 'F', 4, 'PETERSM'),
(60, 'Wasserhahn undicht', '2012-04-06 11:00:00', '2012-04-06 12:00:00', 'F', 8, 'PETERSM');

--
-- Daten für Tabelle `kunde`
--

INSERT INTO `kunde` (`kundennummer`, `name`, `strasse`, `hausnummer`, `plz`, `ort`, `telefonnummer`) VALUES
(1, 'Stephan Kunze', 'Raderthaler Straße', '10', 50968, 'Köln', '01709107787'),
(2, 'Michael Best', 'Ostendstraße', '3', 64319, 'Pfungstadt', '015164770509'),
(3, 'Marcel Peters', 'Wiesbadener Straße', '54', 55252, 'Mainz-Kastel', '017632517850'),
(4, 'Ahmet Dogan', 'Georg-Zapf-Straße', '10', 51061, 'Köln', '01751744545'),
(5, 'Max Mustermann', 'Musterstraße', '1', 12345, 'Musterstadt', '01701234567'),
(6, 'Heinrich Meier', 'Meierstraße', '47 b', 54321, 'Meierstadt', '01234567890'),
(7, 'Helge Schneider', 'Schneiderstraße', '1', 45468, 'Mühlheim an der Ruhr', '015154324356'),
(8, 'Heinrich Schmitt', 'Hintergasse', '5', 86754, 'Hinterdorf', '011119999999'),
(9, 'Heiner Müller', 'Ums Eck', '9', 98765, 'Eckstadt', '09453434321'),
(10, 'Florian Schulze', 'Hohe Straße', '68', 76543, 'Oberstadt', '0111666666');

--
-- Daten für Tabelle `mitarbeiter`
--

INSERT INTO `mitarbeiter` (`benutzername`, `passwort`, `mitarbeitertyp`, `vorname`, `nachname`, `status`) VALUES
('BESTM', 'bestm', 'DP', 'Michael', 'Best', 'X'),
('DOGANA', 'dogana', 'OM', 'Ahmet', 'Dogan', 'X'),
('HENKELO', 'henkelo', 'OM', 'Olaf', 'Henkel', 'X'),
('KUNZES', 'kunzes', 'OM', 'Stephan', 'Kunze', 'X'),
('MEIERP', 'meierp', 'DP', 'Peter', 'Meier', ''),
('MUSTERM', 'musterm', 'DP', 'Max', 'Muster', 'X'),
('MÜLLERJ', 'müllerj', 'OM', 'Jürgen', 'Müller', 'X'),
('PETERSM', 'petersm', 'OM', 'Marcel', 'Peters', 'X'),
('SCHULZEF', 'schulzef', 'OM', 'Fred', 'Schulze', '');
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
