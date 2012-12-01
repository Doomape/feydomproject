-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2012 at 07:28 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `feydom`
--

-- --------------------------------------------------------

--
-- Table structure for table `galery`
--

CREATE TABLE IF NOT EXISTS `galery` (
  `idmc` int(11) NOT NULL,
  `idpic` int(11) NOT NULL,
  `galeryURL` text CHARACTER SET utf8 NOT NULL,
  `mainPicture` text CHARACTER SET utf8 NOT NULL,
  `videoURL` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idpic`),
  KEY `idmc` (`idmc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `galery`
--

INSERT INTO `galery` (`idmc`, `idpic`, `galeryURL`, `mainPicture`, `videoURL`) VALUES
(3, 1, 'http://localhost/feydomproject/images/galery/q6_main.png', 'true', ''),
(3, 2, 'http://localhost/feydomproject/images/galeryThumb/229348_470388199662099_1078802684_n.jpg', 'false', ''),
(4, 3, 'http://localhost/feydomproject/images/sidebarImages/top.jpg', 'true', '');

-- --------------------------------------------------------

--
-- Table structure for table `left_sidebar`
--

CREATE TABLE IF NOT EXISTS `left_sidebar` (
  `id` int(11) NOT NULL,
  `sidebarURL` text CHARACTER SET utf8 NOT NULL,
  `isContact` text CHARACTER SET utf8 NOT NULL,
  `isStartPage` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `left_sidebar`
--

INSERT INTO `left_sidebar` (`id`, `sidebarURL`, `isContact`, `isStartPage`) VALUES
(0, 'http://localhost/feydomproject/images/topbarImages/feydom_logo.png', '', ''),
(1, 'http://localhost/feydomproject/images/topbarImages/about_us.png', '', ''),
(2, 'http://localhost/feydomproject/images/topbarImages/product.png', '', 'true'),
(3, 'http://localhost/feydomproject/images/topbarImages/contact.png', 'true', ''),
(4, 'http://localhost/feydomproject/images/sidebarImages/factory.png', '', ''),
(5, 'http://localhost/feydomproject/images/sidebarImages/design_studio.png', '', ''),
(7, 'http://localhost/feydomproject/images/sidebarImages/show_room.png', '', ''),
(8, 'http://localhost/feydomproject/images/sidebarImages/feydom_catalog.png', '', ''),
(9, '/feydomproject/images/sidebarImages/q6_5.png', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `main_content`
--

CREATE TABLE IF NOT EXISTS `main_content` (
  `id` int(11) NOT NULL,
  `idmc` int(11) NOT NULL,
  `maincontentURL` text CHARACTER SET utf8 NOT NULL,
  `imageCheck` text CHARACTER SET utf8 NOT NULL,
  `imageText` text CHARACTER SET utf8 NOT NULL,
  `isOnTop` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idmc`),
  UNIQUE KEY `idmc` (`idmc`),
  UNIQUE KEY `idmc_2` (`idmc`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_content`
--

INSERT INTO `main_content` (`id`, `idmc`, `maincontentURL`, `imageCheck`, `imageText`, `isOnTop`) VALUES
(4, 1, 'http://localhost/feydomproject/images/17092011866.jpg', 'top', 'Opis na slikata', 'true'),
(4, 2, 'http://localhost/feydomproject/images/galeryThumb/229348_470388199662099_1078802684_n.jpg', 'top', 'Fabrika', 'false'),
(4, 3, 'http://localhost/feydomproject/images/galery/q6_5.png', 'galery', '', ''),
(1, 4, 'http://localhost/feydomproject/images/sidebarImages/241120121098.jpg', 'top', 'Cvrchi', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(65) NOT NULL DEFAULT '',
  `password` varchar(65) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `password`) VALUES
(1, 'john', '1234');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `galery`
--
ALTER TABLE `galery`
  ADD CONSTRAINT `galery_ibfk_1` FOREIGN KEY (`idmc`) REFERENCES `main_content` (`idmc`);

--
-- Constraints for table `main_content`
--
ALTER TABLE `main_content`
  ADD CONSTRAINT `main_content_ibfk_2` FOREIGN KEY (`id`) REFERENCES `left_sidebar` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
