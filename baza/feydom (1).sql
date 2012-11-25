-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 25, 2012 at 04:10 PM
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
  PRIMARY KEY (`idpic`),
  KEY `idmc` (`idmc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `left_sidebar`
--

CREATE TABLE IF NOT EXISTS `left_sidebar` (
  `id` int(11) NOT NULL,
  `sidebarURL` text CHARACTER SET utf8 NOT NULL,
  `contentTopURL` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `left_sidebar`
--

INSERT INTO `left_sidebar` (`id`, `sidebarURL`, `contentTopURL`) VALUES
(0, 'http://localhost/feydomproject/images/topbarImages/feydom_logo.png', '/feydomproject/admin/uploads/Regulator.jpg'),
(1, 'http://localhost/feydomproject/images/topbarImages/about_us.png', ''),
(2, 'http://localhost/feydomproject/images/topbarImages/product.png', ''),
(3, 'http://localhost/feydomproject/images/topbarImages/contact.png', ''),
(4, 'http://localhost/feydomproject/images/sidebarImages/factory.png', 'http://localhost/feydomproject/images/sidebarImages/q6.png'),
(5, 'http://localhost/feydomproject/images/sidebarImages/design_studio.png', ''),
(6, 'http://localhost/feydomproject/images/sidebarImages/events.png', ''),
(7, 'http://localhost/feydomproject/images/sidebarImages/show_room.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `main_content`
--

CREATE TABLE IF NOT EXISTS `main_content` (
  `id` int(11) NOT NULL,
  `idmc` int(11) NOT NULL,
  `contentBottomURL` text CHARACTER SET utf8 NOT NULL,
  `galeryCheck` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idmc`),
  UNIQUE KEY `idmc` (`idmc`),
  UNIQUE KEY `idmc_2` (`idmc`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_content`
--

INSERT INTO `main_content` (`id`, `idmc`, `contentBottomURL`, `galeryCheck`) VALUES
(2, 1, 'http://localhost/feydomproject/images/galeryThumb/fotelja_07.png', 'true'),
(2, 2, 'http://localhost/feydomproject/images/galeryThumb/thumbs_img_6926.jpg', 'true'),
(2, 3, 'http://localhost/feydomproject/images/galeryThumb/thumbs_img_6928.jpg', 'true'),
(2, 4, 'http://localhost/feydomproject/images/galeryThumb/thumbs_img_6929.jpg', 'true'),
(2, 5, 'http://localhost/feydomproject/images/galeryThumb/thumbs_img_6948.jpg', 'true'),
(2, 6, 'http://localhost/feydomproject/images/galeryThumb/thumbs_img_6950.jpg', 'true'),
(2, 7, 'http://localhost/feydomproject/images/galeryThumb/thumbs_img_6955.jpg', 'true'),
(2, 8, 'http://localhost/feydomproject/images/galeryThumb/thumbs_img_7039.jpg', 'true'),
(2, 9, 'http://localhost/feydomproject/images/galeryThumb/thumbs_img_7044.jpg', 'true');

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
