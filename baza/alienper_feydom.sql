-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 08, 2012 at 06:18 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `alienper_feydom`
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
  `imageText` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idpic`),
  KEY `idmc` (`idmc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `galery`
--

INSERT INTO `galery` (`idmc`, `idpic`, `galeryURL`, `mainPicture`, `videoURL`, `imageText`) VALUES
(1, 1, 'http://localhost/feydomproject/images/galery/GEMINI1.jpg', 'true', '/', 'text 1'),
(1, 2, 'http://localhost/feydomproject/images/galery/GEMINI2.jpg', 'false', '/', 'text 2'),
(2, 3, 'http://localhost/feydomproject/images/galery/BB21.jpg', 'true', '/', 'text 3'),
(2, 4, 'http://localhost/feydomproject/images/galery/BB22.jpg', 'false', '/', ''),
(2, 5, 'http://localhost/feydomproject/images/galery/BB23.jpg', 'false', '/', ''),
(2, 6, 'http://localhost/feydomproject/images/galery/BB24.jpg', 'false', '/', ''),
(2, 7, 'http://localhost/feydomproject/images/galery/BB25.jpg', 'false', '/', ''),
(2, 8, 'http://localhost/feydomproject/images/galery/BB26.jpg', 'false', '/', ''),
(2, 9, 'http://localhost/feydomproject/images/galery/BB27.jpg', 'false', '/', ''),
(2, 10, 'http://localhost/feydomproject/images/galery/BB28.jpg', 'false', '/', ''),
(2, 11, 'http://localhost/feydomproject/images/galery/BB29.jpg', 'false', '/', ''),
(2, 12, 'http://localhost/feydomproject/images/galery/BB210.jpg', 'false', '/', ''),
(3, 13, 'http://localhost/feydomproject/images/galery/Q6NASLOV.jpg', 'true', 'http://www.youtube.com/embed/WRylxdt4848', 'text 1'),
(3, 14, 'http://localhost/feydomproject/images/galery/Q61.jpg', 'false', '/', 'text 2'),
(3, 15, 'http://localhost/feydomproject/images/galery/Q62.jpg', 'false', '/', 'text 3'),
(3, 16, 'http://localhost/feydomproject/images/galery/Q63.jpg', 'false', '/', ''),
(3, 17, 'http://localhost/feydomproject/images/galery/Q64.jpg', 'false', '/', ''),
(3, 18, 'http://localhost/feydomproject/images/galery/Q65.jpg', 'false', '/', ''),
(3, 19, 'http://localhost/feydomproject/images/galery/Q66.jpg', 'false', '/', ''),
(3, 20, 'http://localhost/feydomproject/images/galery/Q67.jpg', 'false', '/', ''),
(3, 21, 'http://localhost/feydomproject/images/galery/Q68.jpg', 'false', '/', ''),
(3, 22, 'http://localhost/feydomproject/images/galery/Q69.jpg', 'false', '/', ''),
(3, 23, 'http://localhost/feydomproject/images/galery/Q610.jpg', 'false', '/', ''),
(3, 24, 'http://localhost/feydomproject/images/galery/Q611.jpg', 'false', '/', ''),
(3, 25, 'http://localhost/feydomproject/images/galery/Q612.jpg', 'false', '/', ''),
(3, 26, 'http://localhost/feydomproject/images/galery/Q613.jpg', 'false', '/', ''),
(3, 27, 'http://localhost/feydomproject/images/galery/Q614.jpg', 'false', '/', '');

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
(0, 'images/topbarImages/feydom_logo.png', '', ''),
(1, 'http://localhost/feydomproject/images/topbarImages/about_us.png', '', ''),
(2, 'http://localhost/feydomproject/images/topbarImages/product.png', '', 'true'),
(3, 'http://localhost/feydomproject/images/topbarImages/contact.png', 'true', ''),
(4, 'http://localhost/feydomproject/images/sidebarImages/factory.png', '', ''),
(5, 'http://localhost/feydomproject/images/sidebarImages/design_studio.png', '', ''),
(7, 'http://localhost/feydomproject/images/sidebarImages/show_room.png', '', ''),
(8, 'http://localhost/feydomproject/images/sidebarImages/feydom_catalog.png', '', '');

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
  KEY `main_content_ibfk_2` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_content`
--

INSERT INTO `main_content` (`id`, `idmc`, `maincontentURL`, `imageCheck`, `imageText`, `isOnTop`) VALUES
(2, 1, 'http://localhost/feydomproject/images/galeryThumb/GEMINIAsl1.jpg', 'galery', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\n', 'true'),
(2, 2, 'http://localhost/feydomproject/images/galeryThumb/BB2sl6.jpg', 'top', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.\n\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.\n', ''),
(2, 3, 'http://localhost/feydomproject/images/galeryThumb/Q6slNASLOV.jpg', 'galery', '', ''),
(1, 4, 'http://localhost/feydomproject/images/sidebarImages/show_room.png', 'top', 'dfsdfs', 'true');

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
