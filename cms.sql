-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.29-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for cms
DROP DATABASE IF EXISTS `cms`;
CREATE DATABASE IF NOT EXISTS `cms` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cms`;

-- Dumping structure for table cms.account
DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `account_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `account_status` tinyint(1) NOT NULL,
  `account_first_name` varchar(50) NOT NULL,
  `account_last_name` varchar(50) NOT NULL,
  `date_created` date NOT NULL,
  `account_email` varchar(50) NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table cms.account: ~0 rows (approximately)
DELETE FROM `account`;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
/*!40000 ALTER TABLE `account` ENABLE KEYS */;

-- Dumping structure for table cms.post
DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `post_id` int(100) NOT NULL AUTO_INCREMENT,
  `post_creator` int(10) NOT NULL,
  `post_date_created` date NOT NULL,
  `post_date_updated` date NOT NULL,
  `post_title` varchar(50) NOT NULL,
  `post_content` longtext NOT NULL,
  `post_seen` bigint(10) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table cms.post: ~0 rows (approximately)
DELETE FROM `post`;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

-- Dumping structure for table cms.uploadfile
DROP TABLE IF EXISTS `uploadfile`;
CREATE TABLE IF NOT EXISTS `uploadfile` (
  `uploadfile_id` int(100) NOT NULL AUTO_INCREMENT,
  `uploadfile_name` varchar(100) NOT NULL,
  `uploadfile_directory` varchar(100) NOT NULL,
  `date_created` date NOT NULL,
  `creator` int(10) NOT NULL,
  PRIMARY KEY (`uploadfile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table cms.uploadfile: ~0 rows (approximately)
DELETE FROM `uploadfile`;
/*!40000 ALTER TABLE `uploadfile` DISABLE KEYS */;
/*!40000 ALTER TABLE `uploadfile` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
