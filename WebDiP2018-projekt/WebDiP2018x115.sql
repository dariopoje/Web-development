-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 17, 2019 at 01:12 PM
-- Server version: 5.5.62-0+deb8u1
-- PHP Version: 7.2.17-1+0~20190412070953.20+jessie~1.gbp23a36d

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WebDiP2018x115`
--

-- --------------------------------------------------------

--
-- Table structure for table `dnevnikRada`
--

CREATE TABLE `dnevnikRada` (
  `iddnevnikRada` int(11) NOT NULL,
  `vrijeme_pristupa` datetime NOT NULL,
  `opis` text,
  `tip_loga` varchar(45) NOT NULL,
  `id_korisnik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dnevnikRada`
--

INSERT INTO `dnevnikRada` (`iddnevnikRada`, `vrijeme_pristupa`, `opis`, `tip_loga`, `id_korisnik`) VALUES
(1, '2019-06-15 19:54:35', 'Prijava korisnika u sustav', 'Prijava', 2),
(2, '2019-06-15 19:54:37', 'Prijava korisnika u sustav', 'Prijava', 2),
(3, '2019-06-15 19:58:40', 'Prijava korisnika u sustav', 'Prijava', 2),
(4, '2019-06-15 21:23:13', 'Prijava korisnika u sustav', 'prijava', 2),
(5, '2019-06-15 21:26:12', 'Prijava korisnika u sustav', 'prijava', 2),
(6, '2019-06-15 21:30:27', 'Pregled centara', 'pregled centara', 2),
(7, '2019-06-15 21:30:43', 'Pregled korisnika centra', 'pregled korisnika', 2),
(8, '2019-06-15 21:41:33', 'Odjava', 'Odjava', 2),
(9, '2019-06-15 21:42:19', 'Prijava korisnika u sustav', 'prijava', 7),
(10, '2019-06-15 21:42:33', 'Odjava', 'Odjava', 7),
(11, '2019-06-16 11:38:39', 'Prijava korisnika u sustav', 'prijava', 2),
(12, '2019-06-16 11:58:52', 'Prijava korisnika u sustav', 'prijava', 2),
(13, '2019-06-16 12:05:32', 'Prijava korisnika u sustav', 'prijava', 7),
(14, '2019-06-16 12:05:43', 'Prijava korisnika u sustav', 'prijava', 2),
(15, '2019-06-16 12:32:38', 'Odjava', 'Odjava', 2),
(16, '2019-06-16 15:06:35', 'Prijava korisnika u sustav', 'prijava', 2),
(17, '2019-06-16 15:09:42', 'Prijava korisnika u sustav', 'prijava', 2),
(18, '2019-06-16 15:10:22', 'Prijava korisnika u sustav', 'prijava', 2),
(19, '2019-06-16 15:15:23', 'Prijava korisnika u sustav', 'prijava', 2),
(20, '2019-06-16 15:33:06', 'Admin je blokirao korisnikaddarkic', 'blokiranje', 2),
(21, '2019-06-16 15:34:05', 'Admin je odblokirao korisnika ddarkic', 'blokiranje', 2),
(22, '2019-06-16 15:38:47', 'Admin je odblokirao korisnika zrog', 'blokiranje', 2),
(23, '2019-06-16 15:39:04', 'Admin je odblokirao korisnika ddarkic', 'odblokiranje', 2),
(24, '2019-06-16 15:39:43', 'Admin je odblokirao korisnika zrog', 'odblokiranje', 2),
(25, '2019-06-16 15:40:22', 'Admin je blokirao korisnika ddarkic', 'blokiranje', 2),
(26, '2019-06-16 15:40:51', 'Admin je blokirao korisnika mplantak', 'blokiranje', 2),
(27, '2019-06-16 15:41:25', 'Admin je odblokirao korisnika mplantak', 'odblokiranje', 2),
(28, '2019-06-16 16:05:08', 'Prijava korisnika u sustav', 'prijava', 2),
(29, '2019-06-16 16:06:51', 'Admin je promaknuo korisnika ddarkic u moderatora', 'moderator', 2),
(30, '2019-06-16 16:20:31', 'dodjela moderatora centru', 'dodjela', 2),
(31, '2019-06-16 16:20:57', 'dodjela moderatora centru', 'dodjela', 2),
(32, '2019-06-16 16:30:06', 'dodjela moderatora centru', 'dodjela', 2),
(33, '2019-06-16 16:30:59', 'Dodavanje novog centra', 'Dodavanje', 2),
(34, '2019-06-16 16:34:45', 'Dodavanje novog centra', 'Dodavanje', 2),
(35, '2019-06-16 16:38:41', 'Dodavanje novog centra', 'Dodavanje', 2),
(36, '2019-06-16 16:56:10', 'Dodavanje nove lokacije', 'Dodavanje', 2),
(37, '2019-06-16 16:56:53', 'Dodavanje nove lokacije', 'Dodavanje', 2),
(38, '2019-06-16 16:57:33', 'Dodavanje nove lokacije', 'Dodavanje', 2),
(39, '2019-06-16 16:58:45', 'Dodavanje novog centra', 'Dodavanje', 2),
(40, '2019-06-16 17:53:57', 'Dodavanje novog centra', 'Dodavanje', 2),
(41, '2019-06-16 17:58:21', 'Pregled korisnika centra', 'pregled korisnika', 2),
(42, '2019-06-16 17:58:26', 'Pregled korisnika centra', 'pregled korisnika', 2),
(43, '2019-06-16 18:48:26', 'Odjava', 'Odjava', 2),
(44, '2019-06-16 18:48:31', 'Prijava korisnika u sustav', 'prijava', 5),
(45, '2019-06-16 19:11:08', 'Prijava korisnika u sustav', 'prijava', 2),
(46, '2019-06-16 19:16:25', 'Odjava', 'Odjava', 2),
(47, '2019-06-16 19:28:02', 'Prijava korisnika u sustav', 'prijava', 2),
(48, '2019-06-16 19:28:12', 'Pregled korisnika centra', 'pregled korisnika', 2),
(49, '2019-06-16 19:42:43', 'Odjava', 'Odjava', 2),
(50, '2019-06-16 19:50:44', 'Prijava korisnika u sustav', 'prijava', 2),
(51, '2019-06-16 19:51:15', 'Dodavanje novog centra', 'Dodavanje', 2),
(52, '2019-06-16 19:58:30', 'Dodavanje novog centra', 'Dodavanje', 2),
(53, '2019-06-16 19:59:12', 'dodjela moderatora centru', 'dodjela', 2),
(54, '2019-06-16 20:01:23', 'dodjela moderatora centru', 'dodjela', 2),
(55, '2019-06-16 20:01:28', 'Dodavanje novog centra', 'Dodavanje', 2),
(56, '2019-06-16 20:04:25', 'Dodavanje novog centra', 'Dodavanje', 2),
(57, '2019-06-16 20:05:49', 'Dodavanje novog centra', 'Dodavanje', 2),
(58, '2019-06-16 20:15:09', 'Pregled korisnika centra', 'pregled korisnika', 2),
(59, '2019-06-16 20:40:47', 'Prijava korisnika u sustav', 'prijava', 12),
(60, '2019-06-16 21:04:31', 'Prijava korisnika u sustav', 'prijava', 2),
(61, '2019-06-16 21:55:16', 'Dodavanje nove lokacije', 'Dodavanje', 2),
(62, '2019-06-16 22:03:15', 'Admin je promaknuo korisnika  u moderatora', 'moderator', 2),
(63, '2019-06-16 22:04:28', 'Admin je odobrio lokaciju Tenki', 'odoravanje', 2),
(64, '2019-06-16 22:40:53', 'Odjava', 'Odjava', 2),
(65, '2019-06-16 22:40:56', 'Prijava korisnika u sustav', 'prijava', 2),
(66, '2019-06-16 22:41:05', 'Admin je blokirao korisnika ahorvat', 'blokiranje', 2),
(67, '2019-06-16 22:55:51', 'Odjava', 'Odjava', 2),
(68, '2019-06-16 22:56:30', 'Prijava korisnika u sustav', 'prijava', 12),
(69, '2019-06-16 22:59:17', 'Prijava korisnika u sustav', 'prijava', 9),
(70, '2019-06-16 23:18:16', 'Odjava', 'Odjava', 9),
(71, '2019-06-16 23:18:20', 'Prijava korisnika u sustav', 'prijava', 2),
(72, '2019-06-16 23:25:45', 'Odjava', 'Odjava', 2),
(73, '2019-06-16 23:29:43', 'Prijava korisnika u sustav', 'prijava', 2),
(74, '2019-06-16 23:33:46', 'Pregled centara', 'pregled centara', 2),
(75, '2019-06-16 23:33:48', 'Pregled korisnika centra', 'pregled korisnika', 2),
(76, '2019-06-16 23:33:50', 'Pregled korisnika centra', 'pregled korisnika', 2),
(77, '2019-06-16 23:34:45', 'Odjava', 'Odjava', 2),
(78, '2019-06-16 23:40:23', 'Prijava korisnika u sustav', 'prijava', 2);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id_korisnik` int(11) NOT NULL,
  `id_uloga` int(11) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `korisnicko_ime` varchar(45) NOT NULL,
  `email` text NOT NULL,
  `lozinka` char(20) NOT NULL,
  `lozinka_kriptirano` varchar(20) NOT NULL,
  `blokiran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id_korisnik`, `id_uloga`, `ime`, `prezime`, `korisnicko_ime`, `email`, `lozinka`, `lozinka_kriptirano`, `blokiran`) VALUES
(2, 1, 'Dario', 'Poje', 'dpoje', 'dpoje@foi.hr', '1', '75c39d05539af2d1e5af', 0),
(5, 7, 'Ivo', 'Hlad', 'ihlad', 'ihlad@gmail.com', '2', 'da4b9237bacccdf19c07', 0),
(6, 9, 'Tomislav', 'Lav', 'tlav', 'tlav@gmail.com', '3', '77de68daecd823babbb5', 0),
(7, 10, 'Helena', 'Horvat', 'hhorvat', 'hhorvat@gmail.com', '4', '1b6453892473a467d073', 0),
(8, 7, 'Ana', 'Horvat', 'ahorvat', 'ahorvat@gmail.com', '5', 'ac3478d69a3c81fa62e6', 1),
(9, 9, 'Ivica', 'Pajk', 'ipajk', 'ipajk@gmail.com', '6', 'c1dfd96eea8cc2b62785', 0),
(10, 7, 'Marko', 'Plantak', 'mplantak', 'mplantak@gmail.com', '7', '902ba3cda1883801594b', 0),
(11, 7, 'Hrvoje', 'Hrast', 'hhrast', 'hhrast@gmail.com', '8', 'fe5dbbcea5ce7e2988b8', 0),
(12, 10, 'Sonja', 'Balen', 'sbalen', 'sbalen@gmail.com', '9', '0ade7c2cf97f75d00997', 0),
(13, 10, 'Zrinka', 'Rog', 'zrog', 'zrog@gmail.com', '10', 'b1d5781111d84f7b3fe4', 1),
(19, 7, 'Darko', 'Darki?', 'ddarkic', 'dpoje@foi.hr', '11111111', '8d875f6cae1e6b82d419', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lokacije`
--

CREATE TABLE `lokacije` (
  `id_lokacije` int(11) NOT NULL,
  `id_ronilacki_centar` int(11) NOT NULL,
  `id_vrsta_lokacije` int(11) NOT NULL,
  `naziv_lokacije` varchar(45) CHARACTER SET utf8 NOT NULL,
  `dubina` float NOT NULL,
  `odobreno` char(1) NOT NULL,
  `vrijeme_prijevoza` time NOT NULL,
  `broj_mjesta` int(11) NOT NULL,
  `opis` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokacije`
--

INSERT INTO `lokacije` (`id_lokacije`, `id_ronilacki_centar`, `id_vrsta_lokacije`, `naziv_lokacije`, `dubina`, `odobreno`, `vrijeme_prijevoza`, `broj_mjesta`, `opis`) VALUES
(1, 12, 7, 'Lanterna, Zub', 20, 'd', '05:20:00', 20, NULL),
(2, 11, 2, 'Fujaga', 20, 'd', '00:26:00', 15, NULL),
(3, 10, 5, 'Lonjica', 47, 'd', '05:10:00', 10, NULL),
(4, 10, 7, 'Tenki', 33, 'd', '03:20:00', 5, 'zatvoreno'),
(5, 8, 1, 'Tabinja', 30, 'd', '01:10:00', 13, NULL),
(6, 9, 7, 'Dvostruka Stijena', 29, 'd', '03:10:00', 10, NULL),
(7, 6, 2, 'Maun', 40, 'd', '05:30:00', 14, NULL),
(8, 3, 7, 'Glavina', 30, 'n', '03:10:00', 0, 'zatvoreno'),
(9, 1, 5, 'Mana', 15, 'd', '02:10:00', 10, NULL),
(10, 5, 8, 'Strmac', 20, 'd', '04:30:00', 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `moderator`
--

CREATE TABLE `moderator` (
  `id_ronilacki_centar` int(11) NOT NULL,
  `id_korisnik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moderator`
--

INSERT INTO `moderator` (`id_ronilacki_centar`, `id_korisnik`) VALUES
(3, 10),
(5, 12),
(6, 13),
(7, 11),
(8, 9),
(9, 7),
(10, 8),
(11, 6),
(12, 5),
(1, 2),
(3, 10),
(5, 12),
(6, 13),
(7, 11),
(8, 9),
(9, 7),
(10, 8),
(11, 6),
(12, 5),
(1, 2),
(12, 5),
(12, 8),
(6, 5),
(6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pomakVremena`
--

CREATE TABLE `pomakVremena` (
  `pomakVremena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pomakVremena`
--

INSERT INTO `pomakVremena` (`pomakVremena`) VALUES
(10);

-- --------------------------------------------------------

--
-- Table structure for table `rezervacije`
--

CREATE TABLE `rezervacije` (
  `id_rezervacije` int(11) NOT NULL,
  `korisnik_id_korisnik` int(11) NOT NULL,
  `termini_id_termini` int(11) NOT NULL,
  `max_dubina` float NOT NULL,
  `datum` datetime NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rezervacije`
--

INSERT INTO `rezervacije` (`id_rezervacije`, `korisnik_id_korisnik`, `termini_id_termini`, `max_dubina`, `datum`, `status`) VALUES
(1, 2, 6, 10, '2019-04-18 00:00:00', 'p'),
(2, 13, 5, 15.3, '2019-04-27 00:00:00', 'o'),
(3, 5, 7, 21, '2019-06-23 00:00:00', 'p'),
(4, 12, 4, 20, '2019-05-25 00:00:00', 'o'),
(5, 6, 8, 21.1, '2019-06-13 00:00:00', 'o'),
(6, 11, 3, 30.12, '2019-04-24 00:00:00', 'o'),
(7, 7, 9, 20.1, '2019-04-20 00:00:00', 'p'),
(8, 10, 2, 20.3, '2019-04-21 00:00:00', 'p'),
(9, 8, 10, 15.2, '2019-04-29 00:00:00', 'p'),
(10, 9, 1, 30.1, '2019-04-18 00:00:00', 'o');

-- --------------------------------------------------------

--
-- Table structure for table `ronilacki_centar`
--

CREATE TABLE `ronilacki_centar` (
  `id_ronilacki_centar` int(11) NOT NULL,
  `naziv_centra` varchar(45) NOT NULL,
  `adresa` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefon` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ronilacki_centar`
--

INSERT INTO `ronilacki_centar` (`id_ronilacki_centar`, `naziv_centra`, `adresa`, `email`, `telefon`) VALUES
(1, 'R.C. Subaquatic A.D.S.', 'Turisti?ko naselje Stella Maris, M. Gupca 5', ' info@subaquatic.org', '+ 385 052 710 981'),
(3, 'Hidrobiro d.o.o.', 'Moela 7/1', ' milan.vuksic@pu.t-com.hr', '+ 385 052 742 017'),
(5, 'DC Plava laguna', 'Laguna b.b.', 'info@plava-laguna-diving.hr', '+ 385 052 647 160'),
(6, 'Orsera DC', ' A.C. Orsera, Gradina', ' pelicar@net.hr', '+ 385 (0)98 786 634'),
(7, 'Starfish DC', 'Auto-kamp Porto sole', 'starfish@pu.t-com.hr', '+ 385 052 442 119'),
(8, 'Scuba Valdaliso', 'Turisti?ko naselje Valdaliso, Monsena b.b.', ' valdaliso@scuba.hr ', ' + 385 052 815 992'),
(9, 'DC Indie', ' Camping Indie, Banjole 96', ' divingindie@divingindie.com', '+ 385 052 545 116'),
(10, 'Manta Plomin', 'Plominska luka b.b.', ' manta@st.t-com.hr', '+ 385 (0)98 265 923'),
(11, 'Diving club Medveja', 'Giuseppe Verdi 21', ' info@dcm-diving.hr', ' + 385 051 293 244'),
(12, 'Rare bird', 'Kricin 12', 'rare.bird@hi.htnet.hr', '+ 385 051 856 536');

-- --------------------------------------------------------

--
-- Table structure for table `status_termina`
--

CREATE TABLE `status_termina` (
  `id_status_termina` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `opis` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_termina`
--

INSERT INTO `status_termina` (`id_status_termina`, `status`, `opis`) VALUES
(1, 'odobren', 'Termin je odobren'),
(2, 'odbijen', 'Termin je odbijen'),
(5, 'zavrsen', 'Termin je zavrsen');

-- --------------------------------------------------------

--
-- Table structure for table `termini`
--

CREATE TABLE `termini` (
  `id_termini` int(11) NOT NULL,
  `id_status_termina` int(11) NOT NULL,
  `id_lokacije` int(11) NOT NULL,
  `broj_slobodnih_mjesta` int(11) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `termini`
--

INSERT INTO `termini` (`id_termini`, `id_status_termina`, `id_lokacije`, `broj_slobodnih_mjesta`, `datum`) VALUES
(1, 1, 1, 20, '0000-00-00'),
(2, 1, 2, 15, '0000-00-00'),
(3, 5, 3, 15, '0000-00-00'),
(4, 2, 4, 25, '0000-00-00'),
(5, 5, 5, 15, '0000-00-00'),
(6, 5, 6, 10, '0000-00-00'),
(7, 2, 7, 16, '0000-00-00'),
(8, 1, 8, 13, '0000-00-00'),
(9, 1, 9, 19, '0000-00-00'),
(10, 5, 10, 25, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `id_uloga` int(11) NOT NULL,
  `naziv_uloga` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`id_uloga`, `naziv_uloga`) VALUES
(1, 'administrator'),
(7, 'moderator'),
(9, 'registrirani korisnik'),
(10, 'neregistrirani korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `vrsta_lokacije`
--

CREATE TABLE `vrsta_lokacije` (
  `id_vrsta_lokacije` int(11) NOT NULL,
  `vrsta` varchar(45) NOT NULL,
  `opis` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vrsta_lokacije`
--

INSERT INTO `vrsta_lokacije` (`id_vrsta_lokacije`, `vrsta`, `opis`) VALUES
(1, 'u centru', NULL),
(2, 'zidovi', NULL),
(5, 'olupine', NULL),
(7, 'kanjon', NULL),
(8, 'kamenito dno', NULL),
(11, 'ostalo', 'NULL');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dnevnikRada`
--
ALTER TABLE `dnevnikRada`
  ADD PRIMARY KEY (`iddnevnikRada`),
  ADD KEY `id_korisnik` (`id_korisnik`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id_korisnik`),
  ADD UNIQUE KEY `id_korisnik_UNIQUE` (`id_korisnik`),
  ADD KEY `fk_korisnik_uloga_idx` (`id_uloga`);

--
-- Indexes for table `lokacije`
--
ALTER TABLE `lokacije`
  ADD PRIMARY KEY (`id_lokacije`),
  ADD UNIQUE KEY `id_lokacije_UNIQUE` (`id_lokacije`),
  ADD KEY `fk_lokacije_ronilacki centar1_idx` (`id_ronilacki_centar`),
  ADD KEY `fk_lokacije_vrsta lokacije1_idx` (`id_vrsta_lokacije`);

--
-- Indexes for table `moderator`
--
ALTER TABLE `moderator`
  ADD KEY `fk_moderator_ronilacki centar1_idx` (`id_ronilacki_centar`),
  ADD KEY `fk_moderator_korisnik1_idx` (`id_korisnik`);

--
-- Indexes for table `rezervacije`
--
ALTER TABLE `rezervacije`
  ADD PRIMARY KEY (`id_rezervacije`),
  ADD UNIQUE KEY `id_rezervacije_UNIQUE` (`id_rezervacije`),
  ADD KEY `fk_rezervacije_korisnik1_idx` (`korisnik_id_korisnik`),
  ADD KEY `fk_rezervacije_termini1_idx` (`termini_id_termini`);

--
-- Indexes for table `ronilacki_centar`
--
ALTER TABLE `ronilacki_centar`
  ADD PRIMARY KEY (`id_ronilacki_centar`),
  ADD UNIQUE KEY `id_ronilacki_centar_UNIQUE` (`id_ronilacki_centar`);

--
-- Indexes for table `status_termina`
--
ALTER TABLE `status_termina`
  ADD PRIMARY KEY (`id_status_termina`),
  ADD UNIQUE KEY `id_status_termina_UNIQUE` (`id_status_termina`);

--
-- Indexes for table `termini`
--
ALTER TABLE `termini`
  ADD PRIMARY KEY (`id_termini`),
  ADD UNIQUE KEY `id_termini_UNIQUE` (`id_termini`),
  ADD KEY `fk_termini_status_termina1_idx` (`id_status_termina`),
  ADD KEY `fk_termini_lokacije1_idx` (`id_lokacije`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`id_uloga`),
  ADD UNIQUE KEY `id_uloga_UNIQUE` (`id_uloga`);

--
-- Indexes for table `vrsta_lokacije`
--
ALTER TABLE `vrsta_lokacije`
  ADD PRIMARY KEY (`id_vrsta_lokacije`),
  ADD UNIQUE KEY `id_vrsta_lokacije_UNIQUE` (`id_vrsta_lokacije`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dnevnikRada`
--
ALTER TABLE `dnevnikRada`
  MODIFY `iddnevnikRada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id_korisnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `lokacije`
--
ALTER TABLE `lokacije`
  MODIFY `id_lokacije` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `rezervacije`
--
ALTER TABLE `rezervacije`
  MODIFY `id_rezervacije` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `ronilacki_centar`
--
ALTER TABLE `ronilacki_centar`
  MODIFY `id_ronilacki_centar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `status_termina`
--
ALTER TABLE `status_termina`
  MODIFY `id_status_termina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `termini`
--
ALTER TABLE `termini`
  MODIFY `id_termini` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `id_uloga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `vrsta_lokacije`
--
ALTER TABLE `vrsta_lokacije`
  MODIFY `id_vrsta_lokacije` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dnevnikRada`
--
ALTER TABLE `dnevnikRada`
  ADD CONSTRAINT `fk_dnevnik_korisnik` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnik` (`id_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `fk_korisnik_uloga` FOREIGN KEY (`id_uloga`) REFERENCES `uloga` (`id_uloga`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lokacije`
--
ALTER TABLE `lokacije`
  ADD CONSTRAINT `fk_lokacije_ronilacki centar1` FOREIGN KEY (`id_ronilacki_centar`) REFERENCES `ronilacki_centar` (`id_ronilacki_centar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lokacije_vrsta lokacije1` FOREIGN KEY (`id_vrsta_lokacije`) REFERENCES `vrsta_lokacije` (`id_vrsta_lokacije`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `moderator`
--
ALTER TABLE `moderator`
  ADD CONSTRAINT `fk_moderator_ronilacki centar1` FOREIGN KEY (`id_ronilacki_centar`) REFERENCES `ronilacki_centar` (`id_ronilacki_centar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_moderator_korisnik1` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnik` (`id_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rezervacije`
--
ALTER TABLE `rezervacije`
  ADD CONSTRAINT `fk_rezervacije_korisnik1` FOREIGN KEY (`korisnik_id_korisnik`) REFERENCES `korisnik` (`id_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rezervacije_termini1` FOREIGN KEY (`termini_id_termini`) REFERENCES `termini` (`id_termini`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `termini`
--
ALTER TABLE `termini`
  ADD CONSTRAINT `fk_termini_lokacije1` FOREIGN KEY (`id_lokacije`) REFERENCES `lokacije` (`id_lokacije`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_termini_status_termina1` FOREIGN KEY (`id_status_termina`) REFERENCES `status_termina` (`id_status_termina`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
