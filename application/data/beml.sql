-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2016 at 08:24 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `beml`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `user_role` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `user_role`, `status`) VALUES
(1, 'princelonappan07@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE IF NOT EXISTS `api_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL,
  `user_id` int(11) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `api_keys`
--

INSERT INTO `api_keys` (`id`, `key`, `user_id`, `level`, `ignore_limits`, `date_created`) VALUES
(40, 'f4d3af2a2a75d5e3983d9cdb4bdee62ee8cbc51f', 1, 1, 1, 1466259282);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ci_sessions_id_ip` (`id`,`ip_address`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(200) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_date`) VALUES
(1, 'Super Admin', '2015-07-11 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(255) DEFAULT NULL COMMENT 'Employee Identification number',
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `date_of_join` date DEFAULT NULL,
  `gender` tinyint(2) DEFAULT NULL COMMENT '1 - Male 2 - Female',
  `phone_number` varchar(150) DEFAULT NULL,
  `address` text,
  `status` tinyint(2) NOT NULL COMMENT '1 - Active , 2 - Inactive',
  `created_date` date DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `employee_id`, `name`, `email`, `password`, `date_of_birth`, `date_of_join`, `gender`, `phone_number`, `address`, `status`, `created_date`, `modified_date`) VALUES
(1, '1001', 'PRINCE LONAPPAN', 'test@test.com', '2077e4a6bafa9b4e7b55e1fff16818af', '2016-04-05', '2016-06-08', 1, '8787', 'KOCHI', 0, NULL, '2016-06-19');


--
-- Table structure for table `post_category`
--

CREATE TABLE IF NOT EXISTS `post_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(200) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1 - Active 2 - Inactive',
  `created_date` date NOT NULL,
  `modified_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `post_category`
--

INSERT INTO `post_category` (`id`, `category_name`, `status`, `created_date`, `modified_date`) VALUES
(1, 'Test', 1, '2016-06-20', '2016-06-21'),
(2, 'NEW', 1, '2016-06-12', '2016-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `body` text,
  `category_id` int(11) DEFAULT NULL,
  `media_type` tinyint(4) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `media_url` text,
  `is_share` tinyint(2) NOT NULL DEFAULT '1',
  `is_comment` tinyint(2) NOT NULL DEFAULT '1',
  `is_like` tinyint(2) NOT NULL DEFAULT '1',
  `is_favorite` tinyint(4) NOT NULL DEFAULT '1',
  `created_date` date NOT NULL,
  `modified_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

----

CREATE TABLE IF NOT EXISTS `like` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `liked_by` int(10) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `favourite` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `liked_by` int(10) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `post` ADD `like_count` INT NULL DEFAULT '0' AFTER `is_like`;

ALTER TABLE `favourite` CHANGE `liked_by` `user_id` INT(10) UNSIGNED NOT NULL;



--
-- Table structure for table `post_comments`
--

CREATE TABLE IF NOT EXISTS `post_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `created_date` date DEFAULT NULL,
  `modified_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE `post_comments` CHANGE `modified_date` `modified_date` DATE NULL DEFAULT NULL;

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE IF NOT EXISTS `offices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `address` text,
  `contact_person_name` varchar(255) DEFAULT NULL,
  `contact_person_number` varchar(255) DEFAULT NULL,
  `office_image` text,
  `created_date` date DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `name`, `address`, `contact_person_name`, `contact_person_number`, `office_image`, `created_date`, `modified_date`) VALUES
(1, 'BEML Limited', 'BEML SOUDHA 23/1, 4th Main SR Nagar,Bangalore-560 027 Karnataka, India.
', '8022963240', 'Rakesh', 'http://52.90.2.159/assests/images/logo.jpg', '2016-06-21', '2016-06-21');
INSERT INTO `offices` (`id`, `name`, `address`, `contact_person_name`, `contact_person_number`, `office_image`, `created_date`, `modified_date`) VALUES (NULL, 'Investor Service Centre', 'BEML SOUDHA 23/1, 4th Main SR Nagar,Bangalore-560 027 Karnataka, India.', 'Rakesh', '8022963211', 'http://52.90.2.159/assests/images/logo.jpg', '2016-06-21', '2016-06-21');

ALTER TABLE `post` CHANGE `media_type` `media_type` TINYINT(4) NULL DEFAULT NULL COMMENT '1 - media link 2 - image upload';

ALTER TABLE `post` CHANGE `media_type` `media_type` TINYINT(4) NULL DEFAULT NULL COMMENT '1 - image link 2 - PDF link 3 - Website Link 4 - Video Link';
ALTER TABLE `post` ADD `comment_count` INT NULL DEFAULT '0' AFTER `like_count`;


ALTER TABLE `users`
  DROP `email`,
  DROP `gender`,
  DROP `phone_number`,
  DROP `address`;
ALTER TABLE `users` ADD `is_registered` TINYINT NOT NULL DEFAULT '0' COMMENT '0 - No 1 - Yes' AFTER `date_of_join`;

ALTER TABLE `offices` ADD `office_type` VARCHAR(200) NULL AFTER `id`;
ALTER TABLE `offices` ADD `telephone` VARCHAR(100) NULL AFTER `address`;
ALTER TABLE `offices` ADD `fax` VARCHAR(150) NULL AFTER `telephone`, ADD `email` VARCHAR(100) NULL AFTER `fax`;
ALTER TABLE `offices` ADD `regional_manager` VARCHAR(150) NULL AFTER `email`;
UPDATE `offices` SET `email` = 'office@pr.beml.co.in' WHERE `offices`.`id` = 1;
UPDATE `offices` SET `email` = 'office@pr.beml.co.in' WHERE `offices`.`id` = 2;
UPDATE `offices` SET `fax` = '+91 80 22963278' WHERE `offices`.`id` = 1;
UPDATE `offices` SET `fax` = '+91 80 22963278' WHERE `offices`.`id` = 2;

UPDATE `offices` SET `office_type` = 'Corporate Office' WHERE `offices`.`id` = 1;

UPDATE `offices` SET `office_type` = 'Investor Service Centre Office' WHERE `offices`.`id` = 2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

