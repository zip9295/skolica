-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2018 at 04:13 AM
-- Server version: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skolica`
--
CREATE DATABASE IF NOT EXISTS `skolica` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `skolica`;

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `articleId` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `description` varchar(512) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `image` varchar(256) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`articleId`, `title`, `description`, `body`, `image`, `userId`, `categoryId`) VALUES
(1, 'Bitcoin je otrov za pacove, ne stvara ništa', 'Najpoznatiji svetski finansijski mag, američki milijarder Voren Bafet, ponovo je danas osuo paljbu po Bitcoin i drugim kriptovalutama.', 'Bafet je bez ustručavanja famoznu kriptovalutu nazvao \"otrovom za pacove\", koji \"ne stvara ništa\" već samo dodatne kupce koji bi da se uključe u prodaju.\r\n\r\nUporedivši tražnju za Bitcoin-om sa ludilom za \"lalama\" u 17. veku u Holandiji (što je začetak berze kao institucije na kojoj se proslavio Bafet), predsednik i izvršni direktor investicionog fonda „Berkšir Hatavej“ kaže da je mistika, koja je obavila ovu kriptovalutu \"krivac\" za rast njene vrednosti, prenosi Rojters.', 'hdhdhdh.jpg', 1, 1),
(2, 'Najbolja Windows 10 PC opcija stigla na Android!', 'Windows Timeline, jedna od najboljih Windows 10 opcija stiže na Android i iOS pametne uređaje.', 'Microsoft Build 2018, godišnje konferencija za programere i IT stručnjake, je počela, a nama je pažnju privukla velika najava kompanije Microsoft da će jednu od ključnih PC Windows 10 karakteristika doneti na mobilne Android i iOS uređaje - Timeline.\r\n\r\nTimeline: na Windows 10 računarima, omogućava korisnicima da se vrate kroz vreme i pronađu svoje materijale, na kojima su radili ranije tokom dana, prošle nedelje ili čak nekoliko nedelja unazad.', 'jnn.jpg', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `parentId` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `name`, `parentId`) VALUES
(1, 'glavna', NULL),
(2, 'glavna 2', NULL),
(3, 'sporedna', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(128) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `lastName` varchar(128) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `username` varchar(128) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `age` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `firstName`, `lastName`, `email`, `password`, `username`, `status`, `age`) VALUES
(2, '', '', 'smeeee@b.c', '123', 'vendiland', 0, 17),
(3, '', '', 'kkk@b.c', '123', 'panters', 1, 48),
(4, '', '', 'vendiland@b.c', '123', 'petarpan', 2, 65),
(5, '', '', 'panters@d.c', '123', 'kkk', 1, 99),
(6, '', '', 'panters@d.c', '123', 'vendi', 2, 39),
(9, 'Vladimir', 'Jankovic', 'test@example.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'Yogi', 1, 25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`articleId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `Status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `articleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
