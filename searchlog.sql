-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 24, 2013 at 02:46 PM
-- Server version: 5.5.31-0ubuntu0.12.04.1-log
-- PHP Version: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `google`
--

-- --------------------------------------------------------

--
-- Table structure for table `searchlog`
--

CREATE TABLE IF NOT EXISTS `searchlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id and  A_I ',
  `keyword` varchar(2000) NOT NULL COMMENT 'keywords searched',
  `machineid` varchar(32) NOT NULL COMMENT 'macid.{linux|win7|winxp}',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isuploaded` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否已被同步，默认否，值为0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
