-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 30, 2013 at 02:58 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test_form`
--
CREATE DATABASE IF NOT EXISTS `test_form` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `test_form`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` int(1) NOT NULL,
  `description` longtext NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `lastlogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `registred` timestamp NOT NULL ,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `email`, `gender`, `description`, `status`, `password`, `lastlogin`, `registred`) VALUES
(1, 'aaa', 'ssss', 'aaaaaa@aaa.aaa', 1, '111aaa', 0, '7815696ecbf1c96e6894b779456d330e', '2013-06-30 14:41:09', '2013-06-30 14:41:09'),
(2, 'aaaa', 'ssss', 'aaaaaa@aaa.aaa', 1, 'aasdasd', 0, '202cb962ac59075b964b07152d234b70', '2013-06-30 14:46:50', '2013-06-30 14:46:50'),
(5, 'aaa2', 'ssss', 'aaaaaa@aaa.aaa', 1, '11233', 0, '202cb962ac59075b964b07152d234b70', '2013-06-30 14:49:40', '2013-06-30 14:49:40');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
