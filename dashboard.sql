-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 12, 2014 at 05:57 
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_cms`
--

CREATE TABLE IF NOT EXISTS `db_cms` (
  `id_cms` int(11) NOT NULL AUTO_INCREMENT,
  `cms` varchar(50) NOT NULL,
  PRIMARY KEY (`id_cms`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `db_cms`
--

INSERT INTO `db_cms` (`id_cms`, `cms`) VALUES
(1, 'Prestashop v1.5.3.1');

-- --------------------------------------------------------

--
-- Table structure for table `db_email`
--

CREATE TABLE IF NOT EXISTS `db_email` (
  `id_email` int(3) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_host` int(3) NOT NULL,
  PRIMARY KEY (`id_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `db_email`
--

INSERT INTO `db_email` (`id_email`, `email`, `password`, `id_host`) VALUES
(7, 'cs@edu4indo.com', 'edu4indo.com', 1),
(9, 'support@edu4indo.com', 'edu4indo.com', 1),
(12, 'asdfsadf@asda', '@sdfsadfdasf', 1),
(13, 'wqerqwe@asdasd', 'wqerqwerqwe', 1),
(14, 'sdfasdf@safsad', 'sadsasf', 1),
(15, 'qwer@qqwqwe', 'qwreqwer', 1),
(16, 'asdf@sasdas', 'asdasd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `db_employee`
--

CREATE TABLE IF NOT EXISTS `db_employee` (
  `id_employee` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `id_type` int(1) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_employee`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `db_employee`
--

INSERT INTO `db_employee` (`id_employee`, `username`, `password`, `foto`, `id_type`, `active`) VALUES
(1, 'andri', 'kurnia', '', 1, 1),
(10, 'qwer', 'qwer', '7029_3411.png', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `db_host`
--

CREATE TABLE IF NOT EXISTS `db_host` (
  `id_host` int(3) NOT NULL AUTO_INCREMENT,
  `host` varchar(50) NOT NULL,
  `hostname` varchar(50) NOT NULL,
  PRIMARY KEY (`id_host`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `db_host`
--

INSERT INTO `db_host` (`id_host`, `host`, `hostname`) VALUES
(1, 'mop101.hostmop.com', 'Megatata');

-- --------------------------------------------------------

--
-- Table structure for table `db_type`
--

CREATE TABLE IF NOT EXISTS `db_type` (
  `id_type` int(1) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `db_type`
--

INSERT INTO `db_type` (`id_type`, `type`) VALUES
(1, 'Administrator'),
(2, 'Customer Service');

-- --------------------------------------------------------

--
-- Table structure for table `db_website`
--

CREATE TABLE IF NOT EXISTS `db_website` (
  `id_web` int(11) NOT NULL AUTO_INCREMENT,
  `web` varchar(30) NOT NULL,
  `id_cms` int(11) NOT NULL,
  `server_db` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `db_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_web`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `db_website`
--

INSERT INTO `db_website` (`id_web`, `web`, `id_cms`, `server_db`, `username`, `passwd`, `db_name`) VALUES
(1, 'www.edu4indo.com', 1, 'localhost', 'root', '', 'ps_1531'),
(2, 'EDU4INDO', 1, 'localhost', 'root', '', 'ps_1531');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
