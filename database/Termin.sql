-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.26-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------
-- Dumping structure for table cms_db.termin_list
CREATE TABLE IF NOT EXISTS `termin_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `doctor_code` varchar(50) NOT NULL,
  `client_id` int(30) NOT NULL,
  `doctors_id` int(30) NOT NULL,
  `remarks` text,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=pending, 1=Paid',
  `date_created` time NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_ofTermin` date NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `doctors_id` (`doctors_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cms_db.termin_list: ~2 rows (approximately)
/*!40000 ALTER TABLE `termin_list` DISABLE KEYS */;
REPLACE INTO `termin_list` (`id`, `doctor_code`, `client_id`, `doctors_id`, `remarks`, `status`, `date_created`, `date_ofTermin`, `date_updated`) VALUES
	(1, '202100001', 1, 1, 'Sample Only', 1, '13:12:43', '2021-11-05', '2021-11-05'),
	(3, '202100002', 4, 1,  'Sample termin 2', 1, '15:10:47', '2021-11-05', '2021-11-05');
/*!40000 ALTER TABLE `termin_list` ENABLE KEYS */;