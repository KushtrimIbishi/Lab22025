-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.26-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table cms_db.client_list
CREATE TABLE IF NOT EXISTS `doctors_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `doctor_code` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `fullname` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 2= Inactive',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cms_db.client_list: ~2 rows (approximately)
/*!40000 ALTER TABLE `client_list` DISABLE KEYS */;
REPLACE INTO `doctors_list` (`id`, `doctor_code`, `password`, `fullname`, `status`, `date_created`, `date_updated`) VALUES
	(1, '20210001', 'a88df23ac492e6e2782df6586a0c645f', 'Williams, Mike D', 1, '2021-11-05 13:12:15', '2021-11-05 14:58:01'),
	(4, '20210002', '100af4e620024b40bbfc49214ea66509', 'Lou, Samantha Jane C', 1, '2021-11-05 14:59:58', '2021-11-05 15:19:32');
/*!40000 ALTER TABLE `client_list` ENABLE KEYS */;

-- Dumping structure for table cms_db.client_meta
CREATE TABLE IF NOT EXISTS `doctor_meta` (
  `doctor_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  KEY `doctor_id` (`doctor_id`),
  CONSTRAINT `doctor_meta_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors_list` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cms_db.client_meta: ~20 rows (approximately)
/*!40000 ALTER TABLE `client_meta` DISABLE KEYS */;
REPLACE INTO `doctor_meta` (`doctor_id`, `meta_field`, `meta_value`) VALUES
	(1, 'lastname', 'Williams'),
	(1, 'firstname', 'Mike'),
	(1, 'middlename', 'D'),
	(1, 'gender', 'Male'),
	(1, 'dob', '1997-06-23'),
	(1, 'contact', '09223554991'),
	(1, 'address', 'My Address, Here City, There Province, 2306'),
	(1, 'email', 'mwilliams@sample.com'),
	(1, 'cpassword', 'mwilliams'),
	(1, 'cur_password', '20210001'),
	(4, 'lastname', 'Lou'),
	(4, 'firstname', 'Samantha Jane'),
	(4, 'middlename', 'C'),
	(4, 'gender', 'Female'),
	(4, 'dob', '1997-10-14'),
	(4, 'contact', '097876546522'),
	(4, 'address', 'Sample Address Only, Anywhere, 2306'),
	(4, 'email', 'sjlou@sample.com'),
	(4, 'cpassword', ''),
	(4, 'cur_password', '20210002');
/*!40000 ALTER TABLE `client_meta` ENABLE KEYS */;