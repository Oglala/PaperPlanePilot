-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 05, 2013 at 07:15 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pilot`
--

-- --------------------------------------------------------

--
-- Table structure for table `clanak`
--

CREATE TABLE IF NOT EXISTS `clanak` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `id_korisnik` int(12) NOT NULL,
  `id_kategorija` int(12) NOT NULL,
  `naslov` text COLLATE utf8_unicode_ci NOT NULL,
  `opis` text COLLATE utf8_unicode_ci NOT NULL,
  `tekst` text COLLATE utf8_unicode_ci NOT NULL,
  `slika` text COLLATE utf8_unicode_ci NOT NULL,
  `vreme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_korisnik` (`id_korisnik`,`id_kategorija`),
  KEY `id_kategorija` (`id_kategorija`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=123 ;

--
-- Dumping data for table `clanak`
--

INSERT INTO `clanak` (`id`, `id_korisnik`, `id_kategorija`, `naslov`, `opis`, `tekst`, `slika`, `vreme`) VALUES
(114, 77, 1, 'naslov', 'opis', 'tekst', '/pilot/img/plazenje.jpg', '2013-08-29 11:12:30'),
(116, 0, 1, 'naslov od vetiri reci', 'opis malo duzi nego sto je onaj prethodni', 'eeefa af af  f fewwfwfwf w fe', '/pilot/img/packe.jpg', '2013-08-29 11:12:39'),
(117, 1, 1, 'novi naslov', 'opis trece po redu vesti', 'ovo je tekst koji bi trebalo da bude treca vest ali naravno nije jer bi bilo glupo da ovako jadno vesti izgledaju; samo test znaci.', '/pilot/img/mahanje.jpg', '2013-08-29 11:18:04'),
(118, 96, 1, 'Ovo je test vest', 'Test zato sto je prva koja se unosi putem same aplikacije a ne rucno u bazu.', 'Nadam se da nece biti gresaka, mada je to gotovo nemoguze; uvek ih bude. Ako citas ovaj tekst znaci da ih nije bilo jer je ovo bukvalno prvi pokusaj.', '/pilot/img/background-5-point.jpg', '2013-08-29 17:10:46'),
(119, 96, 1, 'Ovo je test vest', 'Test zato sto je prva koja se unosi putem same aplikacije a ne rucno u bazu.', 'Nadam se da nece biti gresaka, mada je to gotovo nemoguze; uvek ih bude. Ako citas ovaj tekst znaci da ih nije bilo jer je ovo bukvalno prvi pokusaj.', '/pilot/img/background-5-point.jpg', '2013-08-29 17:12:19'),
(122, 96, 1, 'Novi clanak', 'opis novog clanka', 'tekst tog istog clanka', '/pilot/img/background-5-point.jpg', '2013-09-05 13:11:18');

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE IF NOT EXISTS `kategorija` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `opis` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`id`, `naziv`, `opis`) VALUES
(1, 'Vesti', 'novosti i vesti u svetu kosarke');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `user` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `id_pravo` int(12) NOT NULL DEFAULT '4',
  `avatar` text COLLATE utf8_unicode_ci NOT NULL,
  `ime` varchar(55) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'John Doe',
  `vreme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_pravo` (`id_pravo`),
  KEY `id_pravo_2` (`id_pravo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=99 ;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `user`, `pass`, `mail`, `id_pravo`, `avatar`, `ime`, `vreme`) VALUES
(96, 'Oglala', 'ca80450322b8ec8a968a8780e9a83e4f', 'tenej1988@gmail.com', 1, '/pilot/img/mahanje.jpg', 'John Doe', '2013-09-04 17:25:44'),
(97, 'DilanDog', 'e10adc3949ba59abbe56e057f20f883e', 'dilan@dog', 4, '', 'John Doe', '2013-08-26 10:44:38');

-- --------------------------------------------------------

--
-- Table structure for table `pravo`
--

CREATE TABLE IF NOT EXISTS `pravo` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `opis` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pravo`
--

INSERT INTO `pravo` (`id`, `naziv`, `opis`) VALUES
(1, 'administrator', 'Privilegovani korisnik sa svim opcijama rada nad sistemom.'),
(2, 'moderator', 'Ograničeno pravo rada nad sistemom.'),
(3, 'korisnik', 'Bez prava rada nad sistemom.'),
(4, 'neaktivan', 'Bez prava rada nad sistemom i licnim panelom.');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clanak`
--
ALTER TABLE `clanak`
  ADD CONSTRAINT `clanak_ibfk_1` FOREIGN KEY (`id_kategorija`) REFERENCES `kategorija` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `korisnik_ibfk_1` FOREIGN KEY (`id_pravo`) REFERENCES `pravo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
