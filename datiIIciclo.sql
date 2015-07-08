-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mag 20, 2015 alle 17:01
-- Versione del server: 5.5.43-0ubuntu0.14.10.1
-- PHP Version: 5.5.12-2ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Tesi`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Aprile`
--

CREATE TABLE IF NOT EXISTS `Aprile` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Aprile`
--

INSERT INTO `Aprile` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 1, 1, 1, 1, 1),
(1, 1, 1, 1, 1, 1),
(2, 1, 1, 1, 1, 1),
(3, 1, 1, 1, 1, 1),
(4, 0, 0, 0, 0, 0),
(5, 0, 0, 0, 0, 0),
(6, 0, 0, 0, 0, 0),
(7, 0, 0, 0, 0, 0),
(8, 0, 0, 0, 0, 0),
(9, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `Asperti`
--

CREATE TABLE IF NOT EXISTS `Asperti` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Asperti`
--

INSERT INTO `Asperti` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 0.75, 1, 1, 0, 0),
(1, 0.75, 1, 1, 0, 0),
(2, 0.75, 1, 1, 0, 0),
(3, 0.75, 1, 1, 0, 0),
(4, 0.75, 1, 1, 0, 0),
(5, 0.75, 1, 1, 0, 0),
(6, 0.75, 1, 1, 0, 0),
(7, 0.75, 1, 1, 0, 0),
(8, 0.75, 1, 1, 0, 0),
(9, 0.75, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `Aule`
--

CREATE TABLE IF NOT EXISTS `Aule` (
  `Nome` varchar(15) NOT NULL,
  `Ubicazione` varchar(25) NOT NULL,
  `Capienza` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Aule`
--

INSERT INTO `Aule` (`Nome`, `Ubicazione`, `Capienza`) VALUES
('E1', 'viale ercolani', 50),
('E2', 'viale ercolani', 150),
('E3', 'viale ercolani', 200),
('LABE', 'viale ercolani', 200),
('M1', 'via zamboni', 300);

-- --------------------------------------------------------

--
-- Struttura della tabella `babaoglu`
--

CREATE TABLE IF NOT EXISTS `Babaoglu` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `babaoglu`
--

INSERT INTO `Babaoglu` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 1, 1, 1, 1, 0),
(1, 1, 1, 1, 1, 0),
(2, 1, 1, 1, 1, 0),
(3, 1, 1, 1, 1, 0),
(4, 1, 1, 1, 1, 0),
(5, 1, 1, 1, 1, 0),
(6, 1, 1, 1, 1, 0),
(7, 1, 1, 1, 1, 0),
(8, 1, 1, 1, 1, 0),
(9, 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `Bertossi`
--

CREATE TABLE IF NOT EXISTS `Bertossi` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Bertossi`
--

INSERT INTO `Bertossi` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 0, 1, 1, 1, 0.5),
(1, 0, 1, 1, 1, 0.5),
(2, 0, 1, 1, 1, 0.5),
(3, 0, 1, 1, 1, 0.5),
(4, 0, 1, 1, 1, 0.5),
(5, 0, 1, 1, 1, 0.5),
(6, 0, 1, 1, 1, 0.5),
(7, 0, 0, 0, 0, 0),
(8, 0, 0, 0, 0, 0),
(9, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `Bononi`
--

CREATE TABLE IF NOT EXISTS `Bononi` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Bononi`
--

INSERT INTO `Bononi` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 0, 1, 1, 1, 1),
(1, 0, 1, 1, 1, 1),
(2, 0, 1, 1, 1, 1),
(3, 0, 1, 1, 1, 1),
(4, 0, 1, 1, 1, 1),
(5, 0, 1, 1, 1, 1),
(6, 0, 1, 1, 1, 1),
(7, 0, 1, 1, 1, 1),
(8, 0, 1, 1, 1, 1),
(9, 0, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `cagliari`
--

CREATE TABLE IF NOT EXISTS `Cagliari` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `cagliari`
--

INSERT INTO `Cagliari` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 1, 1, 1, 1, 1),
(1, 1, 0, 1, 1, 1),
(2, 1, 0, 1, 1, 1),
(3, 1, 0, 1, 1, 1),
(4, 1, 1, 1, 1, 1),
(5, 1, 1, 1, 1, 1),
(6, 1, 1, 1, 1, 1),
(7, 1, 1, 1, 1, 1),
(8, 1, 1, 1, 1, 1),
(9, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `Campanino`
--

CREATE TABLE IF NOT EXISTS `Campanino` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Campanino`
--

INSERT INTO `Campanino` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 0, 0.5, 0, 1, 1),
(1, 0, 0.5, 0, 1, 1),
(2, 0, 0.5, 0, 1, 1),
(3, 0, 0.5, 0, 1, 1),
(4, 0, 0.5, 0, 1, 1),
(5, 0, 0.5, 0, 1, 1),
(6, 1, 1, 1, 1, 1),
(7, 1, 1, 1, 1, 1),
(8, 1, 1, 1, 1, 1),
(9, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `Casadei`
--

CREATE TABLE IF NOT EXISTS `Casadei` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Casadei`
--

INSERT INTO `Casadei` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 1, 0, 1, 0, 1),
(1, 1, 0, 1, 0, 1),
(2, 1, 0, 1, 0, 1),
(3, 1, 0, 1, 0, 1),
(4, 1, 0, 1, 0, 1),
(5, 1, 0, 1, 0, 1),
(6, 1, 0, 1, 0, 1),
(7, 1, 0, 1, 0, 1),
(8, 1, 0, 1, 0, 1),
(9, 1, 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `Corsi`
--

CREATE TABLE IF NOT EXISTS `Corsi` (
  `NomeCorso` varchar(30) NOT NULL,
  `IdCorso` varchar(5) NOT NULL,
  `Professore` varchar(15) NOT NULL,
  `AnnoCorso` varchar(5) NOT NULL,
  `OreSett` int(2) NOT NULL,
  `Blocchi` varchar(10) NOT NULL,
  `Crediti` int(2) NOT NULL,
  `Status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Corsi`
--

INSERT INTO `Corsi` (`NomeCorso`, `IdCorso`, `Professore`, `AnnoCorso`, `OreSett`, `Blocchi`, `Crediti`, `Status`) VALUES
('Algebra', 'I-AG', 'Morigi', '1info', 5, '3-2-0-0-', 6, 1),
('Analisi Matematica', 'I-AM', 'Mughetti', '1info', 6, '3-3-0-0-', 9, 1),
('Strutture Dati', 'I-ASD', 'Bertossi', '1info', 9, '3-3-2-1-', 6, 1),
('CPS', 'I-CPS', 'Campanino', '2info', 5, '3-2-0-0-', 6, 1),
('Fisica', 'I-F', 'Rambaldi', '1info', 6, '2-2-2-0-', 6, 1),
('Informatica teorica', 'I-IT', 'Asperti', '3info', 5, '3-2-0-0-', 6, 1),
('LAM', 'I-LAM', 'Bononi', '3info', 5, '3-2-0-0-', 8, 1),
('Linguaggi', 'I-LP', 'Martini', '2info', 6, '2-2-2-0-', 6, 1),
('PSV', 'I-PSV', 'Davoli', '3info', 6, '2-2-2-0-', 6, 1),
('SistemiComplessi', 'I-SC', 'Babaoglu', '1mag', 6, '3-3-0-0-', 6, 1),
('SistemiComplessi2', 'I-SC2', 'Ferretti', '1mag', 3, '2-1-0-0-', 6, 1),
('Storia Informatica', 'I-SI', 'Casadei', '3info', 6, '2-2-2-0-', 6, 1),
('Sistemi Operativi', 'I-SO', 'Davoli', '1info', 4, '2-2-0-0-', 6, 1),
('TecnologieWeb', 'I-TW', 'Vitali', '2info', 6, '3-3-0-0-', 6, 1),
('ASP', 'M-ASP', 'Laneve', '2mag', 4, '2-2-0-0-', 6, 1),
('ADSA', 'M-ASS', 'Mollona', '2mag', 5, '3-2-0-0-', 6, 1),
('C', 'M-C', 'Dallago', '2mag', 4, '2-2-0-0-', 6, 1),
('IntelligenzaAritificiale', 'M-IA', 'Gaspari', '1mag', 5, '3-2-0-0-', 6, 1),
('IARC', 'M-IAR', 'Gaspari', '2mag', 6, '3-3-0-0-', 6, 1),
('IPC', 'M-IPC', 'Vitali', '1mag', 8, '2-3-3-0-', 6, 1),
('Matematica Computazionale', 'M-MC', 'Spaletta', '1mag', 6, '3-3-0-0-', 6, 1),
('MSC', 'M-MSC', 'Gorrieri', '2mag', 6, '3-3-0-0-', 6, 1),
('MTI', 'M-MTI', 'Roccetti', '2mag', 5, '3-2-0-0-', 6, 1),
('SistemiMiddleware', 'M-SM', 'Panzieri', '1mag', 6, '3-3-0-0-', 6, 1),
('AG', 'S-AG', 'Cagliari', '1ipm', 5, '2-3-0-0-', 6, 1),
('AI', 'S-AI', 'Roccetti', '1ipm', 6, '3-3-0-0-', 9, 1),
('ASD', 'S-ASD', 'Marzolla', '2ipm', 5, '3-2-0-0-', 6, 1),
('EA', 'S-EA', 'Aprile', '1ipm', 6, '3-3-0-0-', 6, 1),
('M', 'S-M', 'Fumagalli', '2ipm', 5, '3-2-0-0-', 6, 1),
('PI', 'S-PI', 'Messina', '1ipm', 4, '2-2-0-0-', 6, 1),
('SM', 'S-SM', 'Ghini', '2mag', 5, '2-3-0-0-', 6, 1),
('SN', 'S-SN', 'Loli', '2ipm', 6, '3-3-0-0-', 6, 1),
('SO', 'S-SO', 'Sangiorgi', '2ipm', 9, '5-3-1-0-', 6, 1),
('STI', 'S-TI', 'Fumagalli', '3ipm', 5, '3-2-0-0-', 6, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `dallago`
--

CREATE TABLE IF NOT EXISTS `Dallago` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `dallago`
--

INSERT INTO `Dallago` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 1, 0.5, 1, 1, 0),
(1, 1, 0.5, 1, 1, 0),
(2, 1, 0.5, 1, 1, 0),
(3, 1, 0.5, 1, 1, 0),
(4, 1, 0.5, 1, 1, 0),
(5, 1, 0.5, 1, 1, 0),
(6, 1, 0.5, 1, 1, 0),
(7, 1, 0.5, 1, 1, 0),
(8, 1, 0.5, 1, 1, 0),
(9, 1, 0.5, 1, 1, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `Davoli`
--

CREATE TABLE IF NOT EXISTS `Davoli` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Davoli`
--

INSERT INTO `Davoli` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 1, 1, 1, 1, 0),
(1, 1, 1, 1, 1, 0),
(2, 1, 1, 1, 1, 0),
(3, 1, 1, 1, 1, 0),
(4, 1, 1, 1, 1, 0),
(5, 1, 1, 1, 1, 0),
(6, 1, 1, 1, 1, 0),
(7, 1, 1, 1, 1, 0),
(8, 1, 1, 1, 1, 0),
(9, 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `DisponibilitaAule`
--

CREATE TABLE IF NOT EXISTS `DisponibilitaAule` (
  `IdCorso` varchar(10) NOT NULL,
  `E3` int(3) DEFAULT NULL,
  `E1` int(3) DEFAULT NULL,
  `E2` int(3) DEFAULT NULL,
  `M1` int(3) DEFAULT NULL,
  `LABE` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `DisponibilitaAule`
--

INSERT INTO `DisponibilitaAule` (`IdCorso`, `E3`, `E1`, `E2`, `M1`, `LABE`) VALUES
('I-AG', 1, 1, 1, 1, 1),
('I-AM', 1, 1, 1, 1, 1),
('I-ASD', 1, 1, 1, 1, 1),
('I-CPS', 1, 1, 1, 1, 1),
('I-F', 1, 1, 1, 1, 1),
('I-IT', 1, 1, 1, 1, 1),
('I-LAM', 1, 1, 1, 1, 1),
('I-LP', 1, 1, 1, 1, 1),
('I-PSV', 1, 1, 1, 1, 1),
('I-SC', 1, 1, 1, 1, 1),
('I-SC2', 1, 1, 1, 1, 1),
('I-SI', 1, 1, 1, 1, 0),
('I-SO', 1, 1, 1, 1, 0),
('I-TW', 1, 1, 1, 1, 0),
('M-ASP', 1, 1, 1, 1, 0),
('M-ASS', 1, 1, 1, 1, 1),
('M-C', 1, 1, 1, 1, 1),
('M-IA', 1, 1, 1, 1, 1),
('M-IAR', 1, 1, 1, 1, 1),
('M-IPC', 1, 1, 1, 1, 1),
('M-MC', 1, 1, 1, 1, 1),
('M-MSC', 1, 1, 1, 1, 1),
('M-MTI', 1, 0, 1, 0, 0),
('M-SM', 1, 0, 1, 0, 0),
('S-AG', 1, 0, 1, 1, 1),
('S-AI', 1, 0, 1, 1, 1),
('S-ASD', 1, 0, 1, 1, 1),
('S-EA', 1, 0, 1, 1, 1),
('S-M', 1, 0, 1, 1, 1),
('S-PI', 1, 1, 1, 1, 1),
('S-SM', 1, 1, 1, 1, 0),
('S-SN', 1, 1, 1, 1, 0),
('S-SO', 1, 1, 1, 1, 0),
('S-TI', 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `ferretti`
--

CREATE TABLE IF NOT EXISTS `Ferretti` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `ferretti`
--

INSERT INTO `Ferretti` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 1, 0.75, 1, 0, 0),
(1, 1, 0.75, 1, 0, 0),
(2, 1, 0.75, 1, 0, 0),
(3, 1, 0.75, 1, 0, 0),
(4, 1, 0.75, 1, 0, 0),
(5, 1, 0.75, 1, 0, 0),
(6, 1, 0.75, 1, 0, 0),
(7, 1, 0.75, 1, 0, 0),
(8, 1, 0.75, 1, 0, 0),
(9, 1, 0.75, 1, 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `fumagalli`
--

CREATE TABLE IF NOT EXISTS `Fumagalli` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `fumagalli`
--

INSERT INTO `Fumagalli` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 0, 1, 1, 0, 0.25),
(1, 0, 1, 1, 0, 0.25),
(2, 0, 1, 1, 0, 0.25),
(3, 0, 1, 1, 0, 0.25),
(4, 0, 1, 1, 0, 0.25),
(5, 0, 1, 1, 0, 0.25),
(6, 0, 1, 1, 0, 0.25),
(7, 0, 1, 1, 0, 0.25),
(8, 0, 0, 0, 0, 0.25),
(9, 0, 0, 0, 0, 0.25);

-- --------------------------------------------------------

--
-- Struttura della tabella `gaspari`
--

CREATE TABLE IF NOT EXISTS `Gaspari` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `gaspari`
--

INSERT INTO `Gaspari` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 1, 1, 1, 1, 0.5),
(1, 1, 1, 1, 1, 0.5),
(2, 1, 1, 1, 1, 0.5),
(3, 1, 1, 1, 1, 0.5),
(4, 1, 1, 1, 1, 0.5),
(5, 1, 1, 1, 1, 0.5),
(6, 1, 1, 1, 1, 0.5),
(7, 0, 0, 0, 0, 0),
(8, 0, 0, 0, 0, 0),
(9, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `ghini`
--

CREATE TABLE IF NOT EXISTS `Ghini` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `ghini`
--

INSERT INTO `Ghini` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 0.5, 1, 1, 1, 1),
(1, 0.5, 1, 1, 1, 1),
(2, 0.5, 1, 1, 1, 1),
(3, 0.5, 1, 1, 1, 1),
(4, 0.5, 1, 1, 1, 1),
(5, 0.5, 1, 1, 1, 1),
(6, 0.5, 1, 1, 1, 1),
(7, 0.5, 1, 1, 1, 1),
(8, 0.5, 1, 1, 1, 1),
(9, 0.5, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `gorrieri`
--

CREATE TABLE IF NOT EXISTS `Gorrieri` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `gorrieri`
--

INSERT INTO `Gorrieri` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 0, 1, 1, 1, 0),
(1, 0, 1, 1, 1, 0),
(2, 0, 1, 1, 1, 0),
(3, 0, 1, 1, 1, 0),
(4, 0, 1, 1, 1, 0),
(5, 0, 1, 1, 1, 0),
(6, 0, 1, 1, 1, 0),
(7, 0, 1, 1, 1, 0),
(8, 0, 1, 1, 1, 0),
(9, 0, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `ImpOrario`
--

CREATE TABLE IF NOT EXISTS `ImpOrario` (
  `id` int(2) NOT NULL,
  `maxb` int(2) NOT NULL,
  `max_slots_per_day` int(2) NOT NULL,
  `slots_per_day` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `ImpOrario`
--

INSERT INTO `ImpOrario` (`id`, `maxb`, `max_slots_per_day`, `slots_per_day`) VALUES
(0, 4, 5, 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `laneve`
--

CREATE TABLE IF NOT EXISTS `Laneve` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `laneve`
--

INSERT INTO `Laneve` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 1, 1, 1, 0, 0),
(1, 1, 1, 1, 0, 0),
(2, 1, 1, 1, 0, 0),
(3, 0, 0, 0, 0, 0),
(4, 0, 0, 0, 0, 0),
(5, 0, 0, 0, 0, 0),
(6, 1, 1, 1, 0, 0),
(7, 1, 1, 1, 0, 0),
(8, 1, 1, 1, 0, 0),
(9, 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `LogIn`
--

CREATE TABLE IF NOT EXISTS `LogIn` (
  `Nome` varchar(15) NOT NULL,
  `Cognome` varchar(15) NOT NULL,
  `Username` varchar(40) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `Ruolo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `LogIn`
--

INSERT INTO `LogIn` (`Nome`, `Cognome`, `Username`, `Password`, `Ruolo`) VALUES
('Alan', 'Bertossi', 'alan.bertossi', 'bertossi', 'professore'),
('Aprile', 'Aprile', 'aprile', 'aprile', 'professore'),
('Asperti', 'Asperti', 'asperti', 'asperti', 'professore'),
('Babaoglu', 'Babaoglu', 'babaoglu', 'babaoglu', 'professore'),
('Bononi', 'Bononi', 'bononi', 'bononi', 'professore'),
('Cagliari', 'Cagliari', 'cagliari', 'cagliari', 'professore'),
('Campanino', 'Campanino', 'campanino', 'campanino', 'professore'),
('Casadei', 'Casadei', 'casadei', 'casadei', 'professore'),
('Dallago', 'Dallago', 'dallago', 'dallago', 'professore'),
('Davoli', 'Davoli', 'davoli', 'davoli', 'professore'),
('Ferretti', 'Ferretti', 'ferretti', 'ferretti', 'professore'),
('Fumagalli', 'Fumagalli', 'fumagalli', 'fumagalli', 'professore'),
('Gaspari', 'Gaspari', 'gaspari', 'gaspari', 'professore'),
('Ghini', 'Ghini', 'ghini', 'ghini', 'professore'),
('Gorrieri', 'Gorrieri', 'gorrieri', 'gorrieri', 'professore'),
('Laneve', 'Laneve', 'laneve', 'laneve', 'professore'),
('Loli', 'Loli', 'loli', 'loli', 'professore'),
('Mario', 'Rossi', 'mario.rossi', 'mario', 'segreteria'),
('Martini', 'Martini', 'martini', 'martini', 'professore'),
('Moreno', 'Marzolla', 'marzolla', 'marzolla', 'professore'),
('Messina', 'Messina', 'messina', 'messina', 'professore'),
('Mollona', 'Mollona', 'mollona', 'mollona', 'professore'),
('Mori', 'Mori', 'mori', 'mori', 'mori'),
('Morigi', 'Morigi', 'morigi', 'morigi', 'professore'),
('Mughetti', 'Mughetti', 'mughetti', 'mughetti', 'professore'),
('Panzieri', 'Panzieri', 'panzieri', 'panzieri', 'professore'),
('Rambaldi', 'Rambaldi', 'rambaldi', 'rambaldi', 'professore'),
('Roccetti', 'Roccetti', 'roccetti', 'roccetti', 'professore'),
('Sangiorgi', 'Sangiorgi', 'sangiorgi', 'sangiorgi', 'professore'),
('Spaletta', 'Spaletta', 'spaletta', 'spaletta', 'professore'),
('Vitali', 'Vitali', 'vitali', 'vitali', 'professore');

-- --------------------------------------------------------

--
-- Struttura della tabella `loli`
--

CREATE TABLE IF NOT EXISTS `Loli` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `loli`
--

INSERT INTO `Loli` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 1, 1, 1, 1, 1),
(1, 1, 1, 1, 1, 1),
(2, 1, 1, 1, 1, 1),
(3, 1, 1, 1, 1, 1),
(4, 1, 1, 1, 1, 1),
(5, 1, 1, 1, 1, 1),
(6, 1, 1, 1, 1, 1),
(7, 0, 0, 0, 0, 0),
(8, 0, 0, 0, 0, 0),
(9, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `Mandatory`
--

CREATE TABLE IF NOT EXISTS `Mandatory` (
  `IdCorso` varchar(5) NOT NULL,
  `Aule` varchar(15) NOT NULL,
  `Giorno` varchar(3) NOT NULL,
  `Blocco` int(1) NOT NULL,
  `InitSlot` int(2) NOT NULL,
  `Selected` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Mandatory`
--

INSERT INTO `Mandatory` (`IdCorso`, `Aule`, `Giorno`, `Blocco`, `InitSlot`, `Selected`) VALUES
('I-F', 'E1', 'LUN', 1, 1, 1),
('I-F', 'E1', 'MER', 2, 1, 1),
('I-F', 'E1', 'VEN', 3, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `Martini`
--

CREATE TABLE IF NOT EXISTS `Martini` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Martini`
--

INSERT INTO `Martini` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 1, 1, 0, 1, 1),
(1, 1, 1, 0, 1, 1),
(2, 1, 1, 0, 1, 1),
(3, 1, 1, 0, 1, 1),
(4, 1, 1, 0, 1, 1),
(5, 1, 1, 0, 1, 1),
(6, 1, 1, 0, 1, 1),
(7, 1, 1, 0, 1, 1),
(8, 1, 1, 0, 1, 1),
(9, 1, 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `Marzolla`
--

CREATE TABLE IF NOT EXISTS `Marzolla` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Marzolla`
--

INSERT INTO `Marzolla` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 0, 0, 0, 0, 0),
(1, 0, 0, 0, 0, 0),
(2, 1, 1, 1, 1, 1),
(3, 1, 1, 1, 1, 1),
(4, 1, 1, 1, 1, 1),
(5, 1, 1, 1, 1, 1),
(6, 1, 1, 1, 1, 1),
(7, 1, 1, 1, 1, 1),
(8, 1, 1, 1, 1, 1),
(9, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `Messina`
--

CREATE TABLE IF NOT EXISTS `Messina` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `messina`
--

INSERT INTO `Messina` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 1, 0.5, 1, 0.25, 0),
(1, 1, 0.5, 1, 0.25, 0),
(2, 1, 0.5, 1, 0.25, 0),
(3, 1, 0.5, 1, 0.25, 0),
(4, 1, 0.5, 1, 0.25, 0),
(5, 0, 0, 0, 0, 0),
(6, 0, 0, 0, 0, 0),
(7, 1, 0.5, 1, 0.25, 0),
(8, 1, 0.5, 1, 0.25, 0),
(9, 1, 0.5, 1, 0.25, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `mollona`
--

CREATE TABLE IF NOT EXISTS `Mollona` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `mollona`
--

INSERT INTO `Mollona` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 1, 1, 1, 0, 0),
(1, 1, 1, 1, 0, 0),
(2, 1, 1, 1, 0, 0),
(3, 1, 1, 1, 0, 0),
(4, 1, 1, 1, 0, 0),
(5, 1, 1, 1, 0, 0),
(6, 1, 1, 1, 0, 0),
(7, 1, 1, 1, 0, 0),
(8, 1, 1, 1, 0, 0),
(9, 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `Morigi`
--

CREATE TABLE IF NOT EXISTS `Morigi` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Morigi`
--

INSERT INTO `Morigi` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 1, 0, 1, 1, 1),
(1, 1, 0, 1, 1, 1),
(2, 1, 0, 1, 1, 1),
(3, 1, 1, 1, 1, 1),
(4, 1, 1, 1, 1, 1),
(5, 1, 1, 1, 1, 1),
(6, 1, 1, 1, 1, 1),
(7, 1, 1, 1, 1, 1),
(8, 1, 1, 1, 1, 1),
(9, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `Mughetti`
--

CREATE TABLE IF NOT EXISTS `Mughetti` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Mughetti`
--

INSERT INTO `Mughetti` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 1, 1, 0, 1, 0.5),
(1, 1, 1, 0, 1, 0.5),
(2, 1, 1, 0, 1, 0.5),
(3, 1, 1, 0, 1, 0.5),
(4, 1, 1, 0, 1, 0.5),
(5, 1, 1, 0, 1, 0.5),
(6, 1, 1, 0, 1, 0.5),
(7, 1, 1, 0, 1, 0.5),
(8, 1, 1, 0, 1, 0.5),
(9, 1, 1, 0, 1, 0.5);

-- --------------------------------------------------------

--
-- Struttura della tabella `panzieri`
--

CREATE TABLE IF NOT EXISTS `Panzieri` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `panzieri`
--

INSERT INTO `Panzieri` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 0.5, 1, 1, 1, 1),
(1, 0.5, 1, 1, 1, 1),
(2, 0.5, 1, 1, 1, 1),
(3, 0.5, 1, 1, 1, 1),
(4, 0.5, 1, 1, 1, 1),
(5, 0.5, 1, 1, 1, 1),
(6, 0.5, 1, 1, 1, 1),
(7, 0.5, 1, 1, 1, 1),
(8, 0.5, 1, 1, 1, 1),
(9, 0.5, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `Rambaldi`
--

CREATE TABLE IF NOT EXISTS `Rambaldi` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Rambaldi`
--

INSERT INTO `Rambaldi` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 1, 0, 1, 0, 1),
(1, 1, 0, 1, 0, 1),
(2, 1, 0, 1, 0, 1),
(3, 1, 0, 1, 0, 1),
(4, 1, 0, 1, 0, 1),
(5, 1, 0, 1, 0, 1),
(6, 1, 0, 1, 0, 1),
(7, 1, 0, 1, 0, 1),
(8, 1, 0, 1, 0, 1),
(9, 1, 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `roccetti`
--

CREATE TABLE IF NOT EXISTS `Roccetti` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `roccetti`
--

INSERT INTO `Roccetti` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 0, 0, 0, 0, 0),
(1, 0, 0, 0, 0, 0),
(2, 0, 0, 0, 0, 0),
(3, 0, 0, 0, 0, 0),
(4, 0, 0, 0, 0, 0),
(5, 0, 0, 0, 0, 0),
(6, 0, 0, 0, 0, 0),
(7, 0, 0, 0, 0, 0),
(8, 0, 0, 0, 0, 0),
(9, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `sangiorgi`
--

CREATE TABLE IF NOT EXISTS `Sangiorgi` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `sangiorgi`
--

INSERT INTO `Sangiorgi` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 1, 1, 0, 1, 1),
(1, 1, 1, 0, 1, 1),
(2, 1, 1, 0, 1, 1),
(3, 1, 1, 0, 1, 1),
(4, 1, 1, 0, 1, 1),
(5, 1, 1, 0, 1, 1),
(6, 1, 1, 0, 1, 1),
(7, 1, 1, 0, 1, 1),
(8, 1, 1, 0, 1, 1),
(9, 1, 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `Spaletta`
--

CREATE TABLE IF NOT EXISTS `Spaletta` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Spaletta`
--

INSERT INTO `Spaletta` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 0, 0, 1, 1, 1),
(1, 0, 0, 1, 1, 1),
(2, 0, 0, 1, 1, 1),
(3, 0, 0, 1, 1, 1),
(4, 0, 0, 1, 1, 1),
(5, 0, 0, 1, 1, 1),
(6, 0, 0, 1, 1, 1),
(7, 0, 0, 1, 1, 1),
(8, 0, 0, 1, 1, 1),
(9, 0, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `Vitali`
--

CREATE TABLE IF NOT EXISTS `Vitali` (
  `ORE` int(2) DEFAULT NULL,
  `LUN` float DEFAULT NULL,
  `MAR` float DEFAULT NULL,
  `MER` float DEFAULT NULL,
  `GIO` float DEFAULT NULL,
  `VEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Vitali`
--

INSERT INTO `Vitali` (`ORE`, `LUN`, `MAR`, `MER`, `GIO`, `VEN`) VALUES
(0, 0.75, 0.5, 1, 0.75, 1),
(1, 0.75, 0.5, 1, 0.75, 1),
(2, 0.75, 0.5, 1, 0.75, 1),
(3, 0.75, 0.5, 1, 0.75, 1),
(4, 0.75, 0.5, 1, 0.75, 1),
(5, 0.75, 0.5, 1, 0.75, 1),
(6, 0.75, 0.5, 1, 0.75, 1),
(7, 0.75, 0.5, 1, 0.75, 1),
(8, 0.75, 0.5, 1, 0.75, 1),
(9, 0.75, 0.5, 1, 0.75, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Aule`
--
ALTER TABLE `Aule`
 ADD PRIMARY KEY (`Nome`);

--
-- Indexes for table `Corsi`
--
ALTER TABLE `Corsi`
 ADD PRIMARY KEY (`IdCorso`);

--
-- Indexes for table `DisponibilitaAule`
--
ALTER TABLE `DisponibilitaAule`
 ADD PRIMARY KEY (`IdCorso`);

--
-- Indexes for table `ImpOrario`
--
ALTER TABLE `ImpOrario`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `LogIn`
--
ALTER TABLE `LogIn`
 ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `Mandatory`
--
ALTER TABLE `Mandatory`
 ADD PRIMARY KEY (`IdCorso`,`Aule`,`Giorno`,`Blocco`,`InitSlot`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
